<?php

class formrequest_model extends CI_Model {

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
    function get($row_per_page, $page=0, $where = NULL) {

        $page = $page ? $page : 0;
        $query = $this->db->query('
            SELECT 
                -- a.id,
                a.nama,
                a.email,
                a.instansi,
                a.keterangan,
                a.status,
                -- a.kategori,
                a.file,
                a.email,
                -- a.bagian,
                b.nama AS nama_kategori,
                c.nama AS nama_bagian
            FROM
            beritaekonomi AS a
            LEFT JOIN level1 AS b ON a.kategori = b.id
            LEFT JOIN level1 AS c ON a.bagian = c.id
            LIMIT '.$page.','.$row_per_page.'');
        return $query->result_array($query);
    }
    
    /**
     * Select Combo BOX Level-1
     * @return type array
     */
    function getcombo(){
        $query = $this->db->query('
            SELECT
                a.id ,
                a.nama
            FROM
                level1 a
            ORDER BY
                a.nama ASC
        ');
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