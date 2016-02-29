<?php

/**
 * @description home
 * @author XUPJ21AMR <afton@sangsurya.com>
 * 
 * @copyright
 */
class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    function index(){
        $this->load->view('home');
    }
}