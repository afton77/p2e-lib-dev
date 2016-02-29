<?php

class Laporanpenelitian_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }
  
  /**
   * Get All data base on condition/filter
   * @param INT $row_per_page
   * @param INT $page
   * @param String $where
   * @param String $writer
   * @return Array
   * 
   */
  function getDatas($row_per_page, $page = 0, $where = NULL, $writer = NULL, $year = NULL) {

    if ($where) {
      $this->db->or_like('a.judul', $where);
      $this->db->or_like('a.penulis', $where);
      $this->db->or_like('a.tahun', $where);
      
    }
    if (!is_null($year)){
    	$this->db->where('a.tahun', $year);
    }
    if ($writer) {
      $this->db->or_like('a.penulis', $writer);
    }

    $this->db->select('a.id, a.judul, a.penulis, a.tahun, c.nama as Program_Penelitian, a.pdf');
    $this->db->from('laporanpenelitian AS a');
    $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
    $this->db->join('level1 AS c', 'a.sub = c.id', 'left');
    $this->db->order_by('a.judul', 'DESC');
    $this->db->limit($row_per_page, $page);

    return $this->db->get()->result_array();
  }
  
  /**
   * Get Data base on ID for Update/Edit
   * 
   * @param integer $id
   * @return Array 
   */
  function getData($id) {

    $this->db->select('a.id, a.judul, a.penulis, a.tahun, c.nama as category, b.id as bagianID, c.id as categoryID, a.pdf');
    $this->db->from('laporanpenelitian AS a');
    $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
    $this->db->join('level1 AS c', 'a.sub = c.id', 'left');
    $this->db->where('a.id', $id);

    return $this->db->get()->result_array();
  }

  /**
   * Get Total Rows
   * @param String $where
   * @param String $writer
   * @return Array
   */
  function getRow($where = NULL, $writer = NULL) {

    if ($where) {
      $this->db->like('a.judul', $where);
    }
    if ($writer) {
      $this->db->like('a.penulis', $writer);
    }

    $this->db->select('a.id, a.judul');
    $this->db->from('laporanpenelitian AS a');
    $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
    $this->db->join('level1 AS c', 'a.sub = c.id', 'left');
    $this->db->order_by('a.judul', 'DESC');

    return $this->db->count_all_results();
  }

  /**
   * 
   * @param type $table
   * @param type $data
   * @return boolean
   */
//  function add($table, $data) {
//    $this->db->insert($table, $data);
//
//    if ($this->db->affected_rows() == '1') {
//      return TRUE;
//    }
//    return FALSE;
//  }
  
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
   * Delete -> base on ID
   * @param Int $id
   * @return boolean
   */
  function delete($id) {
    if ($this->db->delete('laporanpenelitian', array('id' => $id))) {
      return TRUE;
    } else {
      return FALSE;
    }
  }
  
  
  
//  function edit($table, $data, $fieldID, $ID) {
//    $this->db->where($fieldID, $ID);
//    // $this->db->limit(1,1);
//    $this->db->update($table, $data);
//
//    if ($this->db->affected_rows() >= 0) {
//      return TRUE;
//    }
//
//    return FALSE;
//  }

//  function count($table, $where = NULL) {
//    if ($where) {
//      $where = ' WHERE a.judul LIKE "%' . $where . '%" ';
//    }
//    return $this->db->count_all('laporanpenelitian', $where);
//  }

}
