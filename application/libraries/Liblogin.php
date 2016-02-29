<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liblogin {

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->database();
        $this->CI->load->helper('url');
        $this->CI->load->library('encrypt');
    }

    public function login() {
        $session = $this->CI->session->userdata('p2e.javantech.com');
//        print_r($session);
        
//        print_r($session['level']);
        if ($session['level'] == 2 || $session['level'] == 3) {
            return true;
        } else {
            redirect(base_url() . 'admins/restricted_admin_area');
            exit();
        }
    }

}

/* End of file Someclass.php */