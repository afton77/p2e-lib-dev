<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register
 *
 * @author XUPJ21AMR
 */
class Register extends CI_Controller{
  //put your code here
  
  
  function __construct() {
    parent::__construct();
    $this->load->model('register_model', 'mReg', TRUE);
  }
  
  
  function index(){
    $this->load->view('v_register');
  }
  
  /**
   * User register 
   */
  function register(){
    $post 			= '';
    $return 		= NULL;
    
    $postdata 		= file_get_contents("php://input");
    $post 			= json_decode($postdata);
    $data 	= array(
    		'nama' => $post->fName,
    		'lname' => $post->lName,
    		'email' => $post->email,
    		'password' => md5(base64_decode( $post->password)),
    		'instansi' => $post->instansi,
    		'address'  => $post->address
    );
    
    $this->return['result'] = $this->mReg->register($data);
    echo json_encode($this->return);
    
  }
  
  /**
   * 
   */
  function check_email() {
  	
  	$post 		= "";
  	$data		= 10;
  	$filename 	= "";
  	$postdata 	= file_get_contents("php://input");
  	$post 		= json_decode($postdata);
	$email 		= $post->email;
  	
//   	$data = json_decode($_POST['data']);
  	
//     $post = NULL;
//     $response = NULL;
//     if ($this->input->raw_input_stream) {
//       $post = json_decode($this->input->raw_input_stream);
//     }
//
	$this->data['result'] = $this->mReg->checkEmail($email);
    echo json_encode($this->data);
  }
}
