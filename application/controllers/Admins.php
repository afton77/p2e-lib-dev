<?php

class Admins extends CI_Controller {

  var $validation_config = array(array(
          'field' => 'nama',
          'label' => 'Nama',
          'rules' => 'required|trim|xss_clean'
      ),
      array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'required|trim|valid_email|xss_clean'
      ),
      array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'required|trim|xss_clean'
      ),
      array(
          'field' => 'level',
          'label' => 'Level',
          'rules' => 'required|trim|xss_clean'
  ));

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url', 'codegen_helper'));
    $this->load->model('codegen_model', '', TRUE);
    $this->load->model('admins_model', 'admin_model', TRUE);
    $this->load->model('Userlevel_model', 'level', TRUE);
  }

  function index() {
    $this->manage();
  }

  function manage() {
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();

//        $this->load->library('Newlogin'); 
    $this->load->library('table');
    $this->load->library('pagination');

    //paging
    $config['base_url'] = base_url() . 'admins/manage/';
    $config['total_rows'] = $this->codegen_model->count('admins');
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


    $this->data['results'] = $this->admin_model->get($config['per_page'], $this->uri->segment(3));

    // $this->data['results'] = $this->codegen_model->get('admins', 'id,nama,email,password,level', '', $config['per_page'], $this->uri->segment(3));

    $this->load->view('admins_list', $this->data);
    //$this->template->load('content', 'admins_list', $this->data); // if have template library , http://maestric.com/doc/php/codeigniter_template
  }

  function add() {
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();
//        echo "<h1>";
//        var_dump($this->session->userdata('p3elipi'));
//        echo "</h1>";
    $this->load->library('form_validation');
    $this->data['custom_error'] = '';

    $this->form_validation->set_rules($this->validation_config);
    if ($this->form_validation->run() == false) {
      $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
    } else {
      $data = array(
          'nama' => set_value('nama'),
          'email' => set_value('email'),
          'password' => set_value('password'),
          'level' => set_value('level')
      );

      if ($this->codegen_model->add('admins', $data) == TRUE) {
        //$this->data['custom_error'] = '<div class="form_ok"><p>Added</p></div>';
        // or redirect
        redirect(base_url() . 'admins/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
      }
    }
    $this->data['combolevel'] = $this->level->getcombo();
    $this->load->view('admins_add', $this->data);
    //$this->template->load('content', 'admins_add', $this->data);
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
          'nama' => $this->input->post('nama'),
          'email' => $this->input->post('email'),
          'password' => $this->input->post('password'),
          'level' => $this->input->post('level')
      );

      if ($this->codegen_model->edit('admins', $data, 'id', $this->input->post('id')) == TRUE) {
        redirect(base_url() . 'admins/manage/');
      } else {
        $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
      }
    }
    $this->data['combolevel'] = $this->level->getcombo();
    $this->data['result'] = $this->codegen_model->get('admins', 'id,nama,email,password,level', 'id = ' . $this->uri->segment(3), 1, NULL, true);

    $this->load->view('admins_edit', $this->data);
    //$this->template->load('content', 'admins_edit', $this->data);
  }

  function delete() {
    $this->load->library('neologin');
    $cek_login = $this->neologin->login();
    $ID = $this->uri->segment(3);
    $this->codegen_model->delete('admins', 'id', $ID);
    redirect(base_url() . 'admins/manage/');
  }

  function login() {
    //Field validation succeeded.  Validate against database
    $this->data = '';
    $this->data['custom_error'] = '';
    $this->load->library('form_validation');
    $config = array(
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|trim|valid_email|xss_clean'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        )
    );

    $this->form_validation->set_rules($config);

    if ($this->form_validation->run()) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      $result = $this->admin_model->login($email, $password);
      if (count($result) > 0) {
        $sess_array = array();
        foreach ($result as $row) {
          $sess_array = array(
              'id' => $row['id'],
              'nama' => $row['nama'],
              'email' => $row['email'],
              'level' => $row['level']
          );
          $this->session->set_userdata('p3elipi', $sess_array);
          redirect(base_url());
        }
        return TRUE;
      } else {
        $this->data['custom_error'] = '<div class="text-error">Email atau password Anda salah. </div>';
        $this->form_validation->set_message('check_database', 'Invalid username or password');
        // return false;
      }
    } else {
//            $this->data['custom_error'] = '<div class="text-error">An Error Occured.</div>';
      // $this->form_validation->set_message('Check', 'email atau password Anda salah');
    }
    $this->load->view('v_login', $this->data);
  }

  function logout() {
    $this->session->unset_userdata('p2e.javantech.com');
    $this->session->sess_destroy();
    redirect(base_url());
  }

  function restricted_admin_area() {
    $this->load->view('restricted_admin_area');
  }

}

/* End of file admins.php */
/* Location: ./system/application/controllers/admins.php */