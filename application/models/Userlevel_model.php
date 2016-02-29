<?php

class Userlevel_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }


  /**
   * 
   * @return type
   */
  function getcombo() {
    /**
     * Where condition for category;
     */

    $query = $this->db->query('
            SELECT
            a.id_level as id,
            a.nama_level as nama
            FROM
            userlevel AS a
            ORDER BY
            a.nama_level ASC
        ');
    return $query->result_array($query);
  }
}