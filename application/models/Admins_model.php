<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admins_model
 *
 * @author XUPJ21AMR
 */
class Admins_model extends CI_Model {

  //put your code here

  public function __construct() {
    parent::__construct();
  }

  /**
   * LOGIN 
   * @param type $email 
   * @param type $password
   * @return boolean
   */
  function login($email, $password) {
    $query = $this->db->query('
            SELECT
                a.id,
                a.nama,
                a.email,
                a.level,
                a.password
                
            FROM
                admins AS a
            WHERE a.email = "' . $email . '"
                AND
                a.password = "' . $password . '"
            LIMIT 1');
    return $query->result_array($query);
  }

  function get($row_per_page, $page = 0, $where = NULL) {

    $page = $page ? $page : 0;
    $query = $this->db->query('
              SELECT
              a.id,
              a.nama,
              a.email,
              a.`password`,
              -- a.`level`,
              b.nama_level as Level
              FROM
              admins AS a
              INNER JOIN userlevel AS b ON a.`level` = b.id_level
              ORDER BY
              a.nama ASC


              LIMIT ' . $page . ',' . $row_per_page . '');

    return $query->result_array($query);
  }

}

?>
