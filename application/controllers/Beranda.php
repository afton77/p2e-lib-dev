<?php

class Beranda extends CI_Controller {

  var $validation_config = array(array(
          'field' => 'halaman',
          'label' => 'Halaman',
          'rules' => 'required|trim|xss_clean'
      ),
      array(
          'field' => 'content',
          'label' => 'Content',
          'rules' => 'required|trim|xss_clean'
  ));

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url', 'codegen_helper'));
    $this->load->model('codegen_model', '', TRUE);
    $this->load->model('beranda_model', '', TRUE);
  }

  function index() {
//        $this->home();
    $this->load->view('v_beranda');
  }

  function getDatas() {
    // $this->load->library('table');
    // $this->load->library('pagination');
    $itemPerPage = 30;

    $post = '';
    $currentPage = 0;
    $filter = NULL;
    $writer = NULL;
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $filter = $post->search;
      $writer = $post->writer;
      $currentPage = (($post->currentPage) - 1 );
    }

    $this->data['json'] = $this->lp_model->getDatas($itemPerPage, $currentPage, $filter, $writer);
    $this->data['totalrow'] = $this->lp_model->getRow($filter, $writer);
    $this->data['postData'] = $filter;
    $this->data['writer'] = $writer;
    $this->data['currentPage'] = $currentPage;
    echo json_encode($this->data);
  }
  
  function getData() {
    // $this->load->library('table');
    // $this->load->library('pagination');
    $itemPerPage = 30;

    $post = '';
    $currentPage = 0;
    $filter = NULL;
    $writer = NULL;
    if ($this->input->raw_input_stream) {
      $post = json_decode($this->input->raw_input_stream);
      $filter = $post->search;
      $writer = $post->writer;
      $currentPage = (($post->currentPage) - 1 );
    }

    $this->data['json'] = $this->beranda_model->getData();
//    $this->data['totalrow'] = $this->beranda_model->getRow($filter, $writer);
    $this->data['postData'] = $filter;
    $this->data['writer'] = $writer;
    $this->data['currentPage'] = $currentPage;
    echo json_encode($this->data);
  }

  function home() {
    // $this->load->library('table');
    // $this->load->library('pagination');
    //paging
    $this->data['results'] = $this->beranda_model->get();

    // var_dump($this->data);
    $this->load->view('beranda_home', $this->data);
  }

  function manage() {

    $this->load->library('neologin');
    $cek_login = $this->neologin->login();

    $this->load->library('table');
    $this->load->library('pagination');

    //paging
    $config['base_url'] = base_url() . 'beranda/manage/';
    $config['total_rows'] = $this->codegen_model->count('beranda');
    $config['per_page'] = 3;

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
    //eg. 'userID,name as Name , lastname as Last_Name' , Name and Last_Name will be use as table header.
    // Last_Name will be converted into Last Name using humanize() function, under inflector helper of the CI core.
    $this->data['results'] = $this->codegen_model->get('beranda', 'id,halaman,content', '', $config['per_page'], $this->uri->segment(3));

    $this->load->view('beranda_list', $this->data);
    //$this->template->load('content', 'beranda_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
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
          'halaman' => set_value('halaman'),
          'content' => set_value('content')
      );

      if ($this->codegen_model->add('beranda', $data) == TRUE) {
        //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
        // or redirect
        redirect(base_url() . 'beranda/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
      }
    }
    $this->load->view('beranda_add', $this->data);
    //$this->template->load('content', 'beranda_add', $this->data);
  }

  function edit() {
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();

    $this->load->library('form_validation');
    $this->data['custom_error'] = '';

    $this->form_validation->set_rules($this->validation_config);
    if ($this->form_validation->run() == false) {
      $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
    } else {
      $data = array(
          'halaman' => $this->input->post('halaman'),
          'content' => $this->input->post('content')
      );

      if ($this->codegen_model->edit('beranda', $data, 'id', $this->input->post('id')) == TRUE) {
        redirect(base_url() . 'beranda/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
      }
    }

    $this->data['result'] = $this->codegen_model->get('beranda', 'id,halaman,content', 'id = ' . $this->uri->segment(3), 1, NULL, true);

    $this->load->view('beranda_edit', $this->data);
    //$this->template->load('content', 'beranda_edit', $this->data);
  }

  function delete() {
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();

    $ID = $this->uri->segment(3);
    $this->codegen_model->delete('beranda', 'id', $ID);
    redirect(base_url() . 'beranda/manage/');
  }

}

/* End of file beranda.php */
/* Location: ./system/application/controllers/beranda.php */