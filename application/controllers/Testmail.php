<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of category
 *
 * @author Afton
 */
class testmail extends CI_Controller {
  //put your code here
  
  function __construct() {
    parent::__construct();
  }
  
  function index(){
  	
  	$this->load->library('email'); // load email library
  	$this->email->from('perpustakaan.p2e@gmail.com', 'sender name');
  	$this->email->to('afton@sangsurya.com');
  	$this->email->cc('afton7@gmail.com');
  	$this->email->subject('Your Subject');
  	$this->email->message('Your Message');
  	// $this->email->attach('/path/to/file1.png'); // attach file
  	// $this->email->attach('/path/to/file2.pdf');
  	if ($this->email->send())
  		echo "Mail Sent!";
  		else
  			echo "There is error in sending mail!";
  }
}
