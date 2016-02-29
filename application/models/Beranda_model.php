<?php

class Beranda_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function getDatas($row_per_page, $page = 0, $where = NULL, $writer = NULL) {

    if ($where) {
      $this->db->or_like('a.judul', $where);
      $this->db->or_like('a.penulis', $where);
      $this->db->or_like('a.tahun', $where);
    }
    if ($writer) {
      $this->db->or_like('a.penulis', $writer);
    }

//    $query = $this->db->query('SELECT a.id, a.content, a.halaman FROM beranda a LIMIT 1');
    $this->db->select('a.id, a.content, a.halaman');
    $this->db->from('beranda AS a');
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
  function getData($id = NULL) {

    if ($id) {
      $this->db->select('a.id, a.judul, a.penulis, a.tahun, c.nama as category, b.id as bagianID, c.id as categoryID, a.pdf');
      $this->db->from('laporanpenelitian AS a');
      $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
      $this->db->join('level1 AS c', 'a.sub = c.id', 'left');
      $this->db->where('a.id', $id);
    } else {
//      $query = $this->db->query('SELECT a.id, a.content, a.halaman FROM beranda a LIMIT 1');
      $this->db->select('a.id, a.title, a.content, a.halaman, a.created_ts as date');
      $this->db->from('beranda AS a');
      $this->db->limit(1, 0);
    }
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
   * @return array
   */
  function get() {

    $query = $this->db->query('SELECT a.id, a.content, a.halaman FROM beranda a LIMIT 1');
    return $query->result_array($query);
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

  function delete($table, $fieldID, $ID) {
    $this->db->where($fieldID, $ID);
    $this->db->delete($table);
    if ($this->db->affected_rows() == '1') {
      return TRUE;
    }

    return FALSE;
  }

  function count($table) {
    return $this->db->count_all($table);
  }

}
