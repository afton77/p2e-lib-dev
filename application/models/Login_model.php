<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Login_model
 *
 * @author Afton M
 */
class Login_model extends CI_Model {

  public function __construct() {
    parent::__construct();
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
