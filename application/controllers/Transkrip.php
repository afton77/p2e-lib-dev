<?php

class Transkrip extends CI_Controller {

//  var $validation_config = array(array(
//          'field' => 'judulpenelitian',
//          'label' => 'Judulpenelitian',
//          'rules' => 'required|trim|xss_clean'
//      ),
//      array(
//          'field' => 'judulwawancara',
//          'label' => 'Judulwawancara',
//          'rules' => 'required|trim|xss_clean'
//      ),
//      array(
//          'field' => 'tanggal',
//          'label' => 'Tanggal',
//          'rules' => 'required|trim|xss_clean'
//      ),
//      array(
//          'field' => 'tahun',
//          'label' => 'Tahun',
//          'rules' => 'required|trim|xss_clean'
//      ),
//      array(
//          'field' => 'narasumber',
//          'label' => 'Narasumber',
//          'rules' => 'required|trim|xss_clean'
//      ),
//      array(
//          'field' => 'file',
//          'label' => 'File',
//          'rules' => 'trim|xss_clean'
//  ));

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url', 'codegen_helper'));
    $this->load->model('codegen_model', '', TRUE);
    $this->load->model('transkrip_model', 'ts_model', TRUE);
  }

  function index() {
    $this->load->view('v_transcript');
  }

  function manage() {

    $this->load->library('neologin');
    $this->neologin->login();

    $this->load->view('v_transcript_admin');
  }

  /*
    function home() {
    $this->load->library('table');
    $this->load->library('pagination');

    //paging
    $config['base_url'] = base_url() . 'transkrip/home/';
    $config['total_rows'] = $this->ts_model->count('transkrip');
    $config['per_page'] = 10;

    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><span>';
    $config['cur_tag_close'] = '</span></li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';


    $this->pagination->initialize($config);
    $this->data['results'] = $this->ts_model->get($config['per_page'], $this->uri->segment(3));
    $this->load->view('transkrip_home', $this->data);
    }
   */
  /*
   * 
    function manage() {
    $this->load->library('neologin');
    $this->neologin->login();

    $this->load->library('table');
    $this->load->library('pagination');

    //paging
    $config['base_url'] = base_url() . 'transkrip/manage/';
    $config['total_rows'] = $this->codegen_model->count('transkrip');
    $config['per_page'] = 10;
    $config['full_tag_open'] = '<div class="pagination"><ul>';
    $config['full_tag_close'] = '</ul></div>';

    $config['first_link'] = 'First';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';

    $config['next_link'] = '&gt;';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';

    $config['prev_link'] = '&lt;';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';

    $config['cur_tag_open'] = '<li class="active"><span>';
    $config['cur_tag_close'] = '</span></li>';

    $config['last_link'] = 'Last';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $this->pagination->initialize($config);
    // make sure to put the primarykey first when selecting ,
    // eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
    // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
    // $this->data['results'] = $this->codegen_model->get('transkrip', 'id,judulpenelitian,judulwawancara,tanggal,tahun,narasumber,file,bagian', '', $config['per_page'], $this->uri->segment(3));

    $this->data['results'] = $this->ts_model->get($config['per_page'], $this->uri->segment(3));

    $this->load->view('transkrip_list', $this->data);
    //$this->template->load('content', 'transkrip_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
    }

   */

  function post() {
    $this->load->library('neologin');
    $this->neologin->login();

    $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : NULL;
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();
    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');

    $this->load->view('v_transcript_post');
  }

  function upload_file() {
    $this->load->library('neologin');
    $this->neologin->login();

    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');
    $uploadfile = $uploaddir . basename($_FILES['file']['name']);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
      return "File is valid, and was successfully uploaded.\n";
    } else {
      return "Possible file upload attack!\n";
    }
  }

  function add() {
    $this->load->library('neologin');
    $this->neologin->login();

    $this->load->library('form_validation');
    $this->data['custom_error'] = '';

    $this->form_validation->set_rules($this->validation_config);
    if ($this->form_validation->run() == false) {
      $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
    } else {
      $data = array(
          'judulpenelitian' => set_value('judulpenelitian'),
          'judulwawancara' => set_value('judulwawancara'),
          'tanggal' => set_value('tanggal'),
          'tahun' => set_value('tahun'),
          'narasumber' => set_value('narasumber'),
          'file' => $_FILES['file']['name'],
          'bagian' => set_value('bagian')
      );

      if ($this->codegen_model->add('transkrip', $data) == TRUE) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
          $this->upload_file();
        }
        //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
        // or redirect
        redirect(base_url() . 'transkrip/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
      }
    }
    $this->load->view('transkrip_add', $this->data);
    //$this->template->load('content', 'transkrip_add', $this->data);
  }

  function edit() {
    $this->load->library('neologin');
    $this->neologin->login();

    $this->load->library('form_validation');
    $this->data['custom_error'] = '';

    $this->form_validation->set_rules($this->validation_config);
    if ($this->form_validation->run() == false) {
      $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
    } else {
      if (is_uploaded_file($_FILES['file']['tmp_name'])) {

        $data = array(
            'judulpenelitian' => $this->input->post('judulpenelitian'),
            'judulwawancara' => $this->input->post('judulwawancara'),
            'tanggal' => $this->input->post('tanggal'),
            'tahun' => $this->input->post('tahun'),
            'narasumber' => $this->input->post('narasumber'),
            'file' => $_FILES['file']['name'],
            'bagian' => $this->input->post('bagian')
        );
      } else {
        $data = array(
            'judulpenelitian' => $this->input->post('judulpenelitian'),
            'judulwawancara' => $this->input->post('judulwawancara'),
            'tanggal' => $this->input->post('tanggal'),
            'tahun' => $this->input->post('tahun'),
            'narasumber' => $this->input->post('narasumber'),
            'bagian' => $this->input->post('bagian')
        );
      }

      if ($this->codegen_model->edit('transkrip', $data, 'id', $this->input->post('id')) == TRUE) {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
          $this->upload_file();
        }
        redirect(base_url() . 'transkrip/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
      }
    }

    $this->data['result'] = $this->codegen_model->get('transkrip', 'id,judulpenelitian,judulwawancara,tanggal,tahun,narasumber,file,bagian', 'id = ' . $this->uri->segment(3), 1, NULL, true);

    $this->load->view('transkrip_edit', $this->data);
    //$this->template->load('content', 'transkrip_edit', $this->data);
  }

  /**
   * Delete Data
   */
  function delete() {

    $this->load->library('neologin');
    $this->neologin->login();

    $id = "";
    $post = "";
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $id = $post->id;
      $doc = $post->title;

      if ($this->ts_model->delete($id)) {
        $this->delete_file($doc); // delete file 
      }
    }
    $this->data['id'] = $id;
    echo json_encode($this->data);
  }

  /**
   * Delete File
   * @param varchar $doc
   */
  function delete_file($doc) {

    $this->load->library('neologin');
    $this->neologin->login();

    if (file_exists(FCPATH . '/uploads/' . $doc)) {
      unlink(FCPATH . '/uploads/' . $doc);
    }
  }


  function save_data() {
    $this->load->library('neologin');
    $this->neologin->login();
    
    $post = "";
    $filename = "";
    $data = json_decode($this->input->post('data', TRUE));
    $file = isset($_FILES['file']['name']) ? $_FILES['file'] : FALSE;

    /**
     * Upload File
     */
    if ($file) {
      $filename = $_FILES['file']['name'];
      $temp_filename = $_FILES['file']['tmp_name'];
      $post["upload"] = $this->upload_file($temp_filename, $filename);
    }
    /**
     * Save Data (Insert + Update)
     */
    if (($data->id)) {
      if ($filename) {
        $fields = array('judulwawancara' => $data->interview_title, 'bagian' => $data->category, 'tanggal' => $data->year, 'tahun' => substr($data->year,3) , 'judulpenelitian' => $data->title, 'narasumber' => $data->narasumber, 'file' => $filename);
      } else {
        // $fields = array('sub' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'penulis' => $data->author);
        $fields = array('judulwawancara' => $data->interview_title, 'bagian' => $data->category, 'tanggal' => $data->year, 'tahun' => substr($data->year,3) , 'judulpenelitian' => $data->title, 'narasumber' => $data->narasumber);
      }
      if ($this->ts_model->updateData('transkrip', $fields, $data->id)) {
        $post['save'] = 'Data Anda berhasil dirubah';
      }
      $post["act"] = $fields;
    } else {
      // $fields = array('sub' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'penulis' => $data->author, 'pdf' => $filename);
      $fields = array('judulwawancara' => $data->interview_title, 'bagian' => $data->category, 'tanggal' => $data->year, 'tahun' => substr($data->year,3) , 'judulpenelitian' => $data->title, 'narasumber' => $data->narasumber, 'file' => $filename);
      if ($this->ts_model->saveData('transkrip', $fields)) {
        $post['save'] = 'Data Anda berhasil disimpan';
      }
      $post["act"] = $fields;
    }
    echo json_encode($post);
  }

  /**
   * 
   * @param integer $id
   */
  function getData($id = null) {
    $data = "";
    $this->data['json'] = $this->ts_model->getData($id);
    $this->data['id'] = $id;
    echo json_encode($this->data);
  }
}

/* End of file transkrip.php */
/* Location: ./system/application/controllers/transkrip.php */