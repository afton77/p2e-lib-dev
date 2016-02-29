<?php

class Datastatistik_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /**
   * 
   * @param type $limit
   * @param type $page
   * @param type $where
   * @return type
   */
  function get($row_per_page, $page = 0, $where = NULL) {

    $page = $page ? $page : 0;
    $query = $this->db->query('
            SELECT
                a.id,
                a.judul,
                a.sumber,
                -- a.kategori,
                a.tahun,
                
                -- a.bagian,
                b.nama AS nama_kategori,
                -- c.nama AS nama_bagian,
                a.file
            FROM
                datastatistik AS a
            LEFT JOIN level1 AS b ON a.kategori = b.id
            LEFT JOIN level1 AS c ON a.bagian = c.id
            ORDER BY a.tahun DESC

            LIMIT ' . $page . ',' . $row_per_page . '');
    return $query->result_array($query);
  }

  function saveData($table, $data) {
    $this->db->insert($table, $data);
    if ($this->db->affected_rows() == '1') {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  
  function updateData($table, $data, $id){
    $this->db->where("id", $id);
    $this->db->update($table, $data);
    if ($this->db->affected_rows() == '1') {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  
  
  /**
   * 
   * @param type $table
   * @param type $data
   * @return boolean
   */
  function add($table, $data) {
    $this->db->insert($table, $data);

    if ($this->db->affected_rows() == '1') {
      return TRUE;
    }
    return FALSE;
  }

  function edit($table, $data, $fieldID, $ID) {
    $this->db->where($fieldID, $ID);
    // $this->db->limit(1,1);
    $this->db->update($table, $data);

    if ($this->db->affected_rows() >= 0) {
      return TRUE;
    }

    return FALSE;
  }

  function delete($id) {
    if ($this->db->delete('datastatistik', array('id' => $id))) {
      return TRUE;
    } else {
      return FALSE;
    }
  }

  function count($table) {
    return $this->db->count_all($table);
  }

}
