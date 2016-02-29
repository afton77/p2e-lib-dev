<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register_model
 *
 * @author Afton M
 */
class Register_model extends CI_Model {

  public function __construct() {
    parent::__construct();
  }

  function register($data){
  	return $this->db->insert('admins', $data);
  	if ($this->db->affected_rows() == '1') {
  		return TRUE;
  	} else {
  		return FALSE;
  	}
  }
  
  function checkEmail($email) {
  	
  	$query = $this->db->query(' SELECT a.email FROM admins AS a WHERE a.email = "' . $email . '" ');
  	if ($query->num_rows() > 0 ) {
  		return FALSE;
  	} else {
  		return TRUE;
  	}
  }

  function login($email, $password) {
    $query = $this->db->query('
            SELECT
                a.id, a.nama, a.email,
                a.level, a.password
            FROM
                admins AS a
            WHERE a.email = "' . $email . '"
                AND
                a.password = "' . $password . '"
            LIMIT 1');
    return $query->result_array($query);
  }

  //put your code here
}
