<?php

class Category_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function getCmbCategory($id){
    
    $this->db->select('child.nama, child.id, parent.id AS parent_id, parent.nama AS parent_name');
    $this->db->from('level0 AS parent');
    $this->db->join('level1 AS child', 'parent.id = child.parent', 'left');
    $this->db->where('parent.id', $id );
    $this->db->order_by('child.nama', 'ASC');
    return $this->db->get()->result_array();
    
  }

  
  /**
   * 
   * @param INT $row_per_page
   * @param INT $page
   * @param String $where
   * @param String $writer
   * @return Array
   * 
   */
  function getDatas($row_per_page, $page = 0, $where = NULL, $writer = NULL) {

    if ($where) {
      $this->db->like('a.judul', $where);
    }
    if ($writer) {
      $this->db->like('a.penulis', $writer);
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
   * Get Data base on ID (just 1 row)
   * 
   * @param integer $id
   * @return Array 
   */
  function getData($id) {

    
    
    $this->db->select('a.id, a.judul, a.penulis, a.tahun, c.nama as Program_Penelitian, b.id as bagianID, c.id as SUBID, a.pdf');
    $this->db->from('laporanpenelitian AS a');
    $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
    $this->db->join('level1 AS c', 'a.sub = c.id', 'left');
    $this->db->where('a.id', $id);


    return $this->db->get()->result_array();
  }

  /**
   * 
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

  function delete($id) {
    if ($this->db->delete('laporanpenelitian', array('id' => $id))) {
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

  function count($table, $where = NULL) {
    if ($where) {
      $where = ' WHERE a.judul LIKE "%' . $where . '%" ';
    }
    return $this->db->count_all('laporanpenelitian', $where);
  }

  /**
   * 
   * @param string $where
   * @return int
   * 
   */
//  function getRow($title = NULL, $writer = NULL) {
//    if ($title) {
//      $this->db->like('judul', $title);
//    }
//    if ($writer) {
//      $this->db->like('judul', $writer);
//    }
//    $this->db->from('laporanpenelitian');
//    return $this->db->count_all_results();
//  }
}
