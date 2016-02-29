<?php

class Bankdata extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url', 'codegen_helper'));
    $this->load->model('codegen_model', '', TRUE);
    $this->load->model('bankdata_model', 'bankdata_model', TRUE);
  }

  /**
   * INDEX PAGE
   */
  function index() {
    $this->load->view('v_laporanpenelitian');
  }

  function home() {
    $this->load->view('v_laporanpenelitian');
  }

  /**
   * LOAD DATA
   */
  function getDatas() {

    // $this->load->library('table');
    // $this->load->library('pagination');
    $itemPerPage = 30;

    $post = '';
    $currentPage = 0;
    $filter = NULL;
    $category = NULL;
    $type = NULL;
//    $type = "transcript";
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $filter = $post->search;
      $category = $post->writer;
      $type = $post->category;
      $currentPage = (($post->currentPage) - 1 );
    }

    $this->data['json'] = $this->bankdata_model->getDatas($itemPerPage, $currentPage, $filter, $category, $type);
    $this->data['totalrow'] = $this->bankdata_model->getRow($filter, $category, $type);

    $this->data['postData'] = $filter;
    $this->data['writer'] = $category;
    $this->data['currentPage'] = $currentPage;
    echo json_encode($this->data);
  }

  /**
   * GET total row data 
   */
  function getData($id = NULL, $type = NULL) {
    $data = "";
    $this->data['id'] = $id;
    $this->data['type'] = $type;
    $this->data['json'] = $this->bankdata_model->getData($id, $type);
    echo json_encode($this->data);
  }

  function save_data() {
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
        $fields = array('sub' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'penulis' => $data->author, 'pdf' => $filename);
      } else {
        $fields = array('sub' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'penulis' => $data->author);
      }
      if ($this->lp_model->updateData('laporanpenelitian', $fields, $data->id)) {
        $post['save'] = 'Data Anda berhasil dirubah';
      }
      $post["act"] = $fields;
    } else {
      $fields = array('sub' => $data->category, 'tahun' => $data->year, 'judul' => $data->title, 'penulis' => $data->author, 'pdf' => $filename);
      if ($this->lp_model->saveData('laporanpenelitian', $fields)) {
        $post['save'] = 'Data Anda berhasil disimpan';
      }
      $post["act"] = $fields;
    }
    echo json_encode($post);
  }

  /**
   * DELETE DATA
   */
  function delete() {

    $id = "";
    $post = "";
    $directory_root = "../uploads/";
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $id = $post->id;
      $doc = $post->title;

      if ($this->lp_model->delete($id)) {
        /**
         * DELETE FILE
         */
        if (file_exists(FCPATH . '/uploads/' . $doc)) {
          unlink(FCPATH . '/uploads/' . $doc);
        }
      }
    }
    $this->data['id'] = $id;
    echo json_encode($this->data);
  }

  /**
   * PAGE ADMIN
   */
  function manage() {

    $this->load->library('neologin');
    $this->neologin->login();

    $this->load->view('v_laporanpenelitian_admin');
  }

  function post() {
    $this->load->library('neologin');
    $this->neologin->login();

    $id = ($this->uri->segment(3)) ? $this->uri->segment(3) : NULL;
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();
    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');

    $this->load->view('v_laporanpenelitian_post');
  }

  /**
   * Upload File
   * @param string $tmpfile
   * @param string $filename
   * @return string
   */
  function upload_file($tmpfile, $filename) {
    $this->config->load('config', TRUE);
    $uploaddir = $this->config->item('diruploadfile');
    $uploadfile = $uploaddir . basename($filename);

    if (move_uploaded_file($tmpfile, $uploadfile)) {
      return "Selamat, file berhasil diunggah (upload)";
    } else {
      return "Maaf, tidak dapat mengunggah file";
    }
  }

  function add() {
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();

    $this->load->library('form_validation');
    $this->data['custom_error'] = '';

    $this->form_validation->set_rules($this->validation_config);
    if ($this->form_validation->run() == false) {
      $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
    } else {
      $data = array(
          'sub' => set_value('sub'),
          'email' => set_value('email'),
          'tahun' => set_value('tahun'),
          'judul' => set_value('judul'),
          'penulis' => set_value('penulis'),
          'pdf' => $_FILES['pdf']['name'],
          'isi' => set_value('isi')
      );

      if ($this->codegen_model->add('laporanpenelitian', $data) == TRUE) {
        if (is_uploaded_file($_FILES['pdf']['tmp_name'])) {
          $this->upload_file();
        }
        redirect(base_url() . 'laporanpenelitian/manage/');
//                redirect(base_url() . 'laporanpenelitian/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
      }
    }
    $this->data['combolevel'] = $this->level1_model->getcombo(1);
    $this->load->view('laporanpenelitian_add', $this->data);
    //$this->template->load('content', 'laporanpenelitian_add', $this->data);
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
      if (is_uploaded_file($_FILES['pdf']['tmp_name'])) {
        $data = array(
            'sub' => $this->input->post('sub'),
            'email' => $this->input->post('email'),
            'tahun' => $this->input->post('tahun'),
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'isi' => $this->input->post('isi'),
            'pdf' => $_FILES['pdf']['name']
        );
      } else {
        $data = array(
            'sub' => $this->input->post('sub'),
            'email' => $this->input->post('email'),
            'tahun' => $this->input->post('tahun'),
            'judul' => $this->input->post('judul'),
            'penulis' => $this->input->post('penulis'),
            'isi' => $this->input->post('isi')
        );
      }
      if ($this->codegen_model->edit('laporanpenelitian', $data, 'id', $this->input->post('id')) == TRUE) {
        if (is_uploaded_file($_FILES['pdf']['tmp_name'])) {
          $this->upload_file();
        }
//                redirect(base_url() . 'laporanpenelitian/manage/');
        redirect(base_url() . 'laporanpenelitian/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
      }
    }
    $this->data['combolevel'] = $this->level1_model->getcombo(1);
    $this->data['result'] = $this->codegen_model->get('laporanpenelitian', 'id,sub,email,tahun,judul,penulis,pdf,isi', 'id = ' . $this->uri->segment(3), 1, NULL, true);
    $this->load->view('laporanpenelitian_edit', $this->data);
    //$this->template->load('content', 'laporanpenelitian_edit', $this->data);
  }

}

/* End of file laporanpenelitian.php */
/* Location: ./system/application/controllers/laporanpenelitian.php */