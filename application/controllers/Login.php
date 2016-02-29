<?php

class Login extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->helper(array('form', 'url', 'codegen_helper'));
    $this->load->model('codegen_model', '', TRUE);
    $this->load->model('Login_model', '', TRUE);
    $this->load->model('admins_model', 'admin_model', TRUE);
    $this->load->model('Userlevel_model', 'level', TRUE);
  }

  function index() {
    $this->load->view('v_login');
  }

  function login() {

    $result = "";
    $post = json_decode($this->input->raw_input_stream);
    $data = $this->Login_model->login($post->email, $post->password);

    if ($data) {
      $sessionData = array(
          'id' => $data[0]['id'],
          'name' => $data[0]['nama'],
          'email' => $data[0]['email'],
          'level' => $data[0]['level']
      );
      $this->session->set_userdata('p2e.javantech.com', $sessionData);
      $result['r'] = TRUE;
    } else {
      $result['r'] = FALSE;
    }
    echo json_encode($result);
  }

  function logout() {
    $this->session->sess_destroy();
    redirect(base_url());
  }

  function restricted_admin_area() {
    $this->load->view('restricted_admin_area');
  }

}

/* End of file admins.php */
/* Location: ./system/application/controllers/admins.php */