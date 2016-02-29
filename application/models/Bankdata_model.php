<?php

class Bankdata_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  /**
   * Get Statistic Datas
   * @param int $row_per_page
   * @param int $page
   * @param text $where
   * @param text $category
   * @return array
   */
  function getDatas($row_per_page, $page = 0, $where = NULL, $category = NULL, $type = NULL) {
    switch ($type) {
      case "ss":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.sumber', $category);
        }
        $this->db->select('a.id, a.judul as title, a.tahun as year, a.file, a.email, a.bagian, b.nama AS category');
        $this->db->from('kajianstrategis AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.judul', 'DESC');
        break;
        
      case "statisticdata":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.sumber', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.sumber', $category);
        }
        $this->db->select('a.id, a.judul as title, a.sumber as source, a.tahun as year, b.nama as category, a.file');
        $this->db->from('datastatistik AS a');
        $this->db->join('level1 AS b', 'a.kategori = b.id', 'left');
        $this->db->join('level1 AS c', 'a.bagian = c.id', 'left');
        $this->db->order_by('a.judul', 'DESC');
        break;

      case "transcript":
        if ($where) {
          $this->db->or_like('a.judulpenelitian', $where);
          $this->db->or_like('a.judulwawancara', $where);
          $this->db->or_like('a.tahun', $where);
          $this->db->or_like('a.narasumber', $where);
        }
        if ($category) {
          $this->db->like('a.narasumber', $category);
        }
        $this->db->select('a.id, a.judulpenelitian as title, a.judulwawancara as interview, a.tanggal as date,  a.tahun as year, a.narasumber, a.file');
        $this->db->from('transkrip AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "fgd":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.sumber', $category);
        }
        $this->db->select('a.id, a.judul as title,  a.tahun as year, a.file');
        $this->db->from('fgd AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "strategic":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.tahun', $category);
        }
        $this->db->select('a.id, a.judul as title,  a.tahun as year, a.file');
        $this->db->from('kajianstrategis AS a');
//        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "karyapeneliti":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
          $this->db->or_like('a.peneliti', $where);
        }
        if ($category) {
          $this->db->like('a.peneliti', $category);
        }
        $this->db->select('a.id, a.judul as title, a.peneliti, a.tahun as year, a.pdf, a.daftarisi');
        $this->db->from('karyapeneliti AS a');
//        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      default:
        break;
    }
    $this->db->limit($row_per_page, $page);
    return $this->db->get()->result_array();
  }

  function getData($id, $type = NULL) {
    switch ($type) {

      case "ss":
        $sql = "SELECT ss.id, ss.judul, ss.tahun, ss.file, ss.email, ss.bagian FROM kajianstrategis AS ss WHERE ss.id = ? ";
        $query = $this->db->query($sql, array($id));
        break;
      
      case "fgd":
        $sql = "SELECT fgd.id, fgd.judul, fgd.tahun, fgd.file, fgd.bagian FROM fgd AS fgd WHERE fgd.id = ? ";
        $query = $this->db->query($sql, array($id));
        break;

      case "ds":
        $sql = "SELECT ds.id, ds.judul, ds.sumber, ds.kategori, ds.tahun, ds.file, ds.bagian FROM datastatistik AS ds WHERE ds.id = ? ";
        $query = $this->db->query($sql, array($id));
        break;

      case "ts":
        $sql = " SELECT ts.id, ts.judulpenelitian, ts.judulwawancara, ts.tanggal, ts.tahun, ts.narasumber, ts.file, ts.bagian FROM transkrip AS ts WHERE ts.id = ? ";
        $query = $this->db->query($sql, array($id));
        break;

      case "transcript":
        if ($where) {
          $this->db->or_like('a.judulpenelitian', $where);
          $this->db->or_like('a.judulwawancara', $where);
          $this->db->or_like('a.tahun', $where);
          $this->db->or_like('a.narasumber', $where);
        }
        if ($category) {
          $this->db->like('a.narasumber', $category);
        }
        $this->db->select('a.id, a.judulpenelitian as title, a.judulwawancara as interview, a.tanggal as date,  a.tahun as year, a.narasumber, a.file');
        $this->db->from('transkrip AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "fgd":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.sumber', $category);
        }
        $this->db->select('a.id, a.judul as title,  a.tahun as year, a.file');
        $this->db->from('fgd AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "strategic":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.tahun', $category);
        }
        $this->db->select('a.id, a.judul as title,  a.tahun as year, a.file');
        $this->db->from('kajianstrategis AS a');
//        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "karyapeneliti":
		$sql = "SELECT a.id, a.judul, a.bentukkarya, a.peneliti, a.email, a.tahun, a.daftarisi, a.pdf, a.bagian FROM karyapeneliti AS a WHERE a.id = ? ";
      	$query = $this->db->query($sql, array($id));
      	break;

      default:
        break;
    }
    // $this->db->limit($row_per_page, $page);
    return $query->result_array();
  }

  /**
   * Get Total Rows (Data Statistic)
   * @param String $where
   * @param String $writer
   * @return Array
   */
  function getRow($where = NULL, $category = NULL, $type = NULL) {
    switch ($type) {
      case "statisticdata":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.sumber', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.sumber', $category);
        }
        $this->db->select('a.id, a.judul as title, a.sumber as source, a.tahun as year, b.nama as category, a.file');
        $this->db->from('datastatistik AS a');
        $this->db->join('level1 AS b', 'a.kategori = b.id', 'left');
        $this->db->join('level1 AS c', 'a.bagian = c.id', 'left');
        $this->db->order_by('a.judul', 'DESC');
        break;

      case "transcript":
        if ($where) {
          $this->db->or_like('a.judulpenelitian', $where);
          $this->db->or_like('a.judulwawancara', $where);
          $this->db->or_like('a.tahun', $where);
          $this->db->or_like('a.narasumber', $where);
        }
        if ($category) {
          $this->db->like('a.narasumber', $category);
        }
        $this->db->select('a.id, a.judulpenelitian as title, a.judulwawancara as interview, a.tanggal as date,  a.tahun as year, a.narasumber, a.file');
        $this->db->from('transkrip AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "fgd":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.sumber', $category);
        }
        $this->db->select('a.id, a.judul as title,  a.tahun as year, a.file');
        $this->db->from('fgd AS a');
        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "strategic":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
        }
        if ($category) {
          $this->db->like('a.tahun', $category);
        }
        $this->db->select('a.id, a.judul as title,  a.tahun as year, a.file');
        $this->db->from('kajianstrategis AS a');
//        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      case "karyapeneliti":
        if ($where) {
          $this->db->or_like('a.judul', $where);
          $this->db->or_like('a.tahun', $where);
          $this->db->or_like('a.peneliti', $where);
        }
        if ($category) {
          $this->db->like('a.peneliti', $category);
        }
        $this->db->select('a.id, a.judul as title, a.peneliti, a.tahun as year, a.pdf, a.daftarisi');
        $this->db->from('karyapeneliti AS a');
//        $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
        $this->db->order_by('a.tahun', 'DESC');
        break;

      default:
        break;
    }
    return $this->db->count_all_results();
  }

  /**
   * Get Data base on ID for Update/Edit
   * 
   * @param integer $id
   * @return Array 
   */
//  function getData($id) {
//
//    $this->db->select('a.id, a.judul, a.penulis, a.tahun, c.nama as category, b.id as bagianID, c.id as categoryID, a.pdf');
//    $this->db->from('laporanpenelitian AS a');
//    $this->db->join('level1 AS b', 'a.bagian = b.id', 'left');
//    $this->db->join('level1 AS c', 'a.sub = c.id', 'left');
//    $this->db->where('a.id', $id);
//
//    return $this->db->get()->result_array();
//  }
}
