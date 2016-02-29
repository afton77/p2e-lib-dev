<?php

class Karyapeneliti_model extends CI_Model {

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
                    a.id,
                    a.judul,
                    -- a.bentukkarya,
                    a.peneliti,
                    
                    a.tahun,
                    a.daftarisi,
                    
                    -- a.bagian,
                    -- b.nama as nama_bagian,
                    c.nama as bentuk_karya,
                    a.email,
                    a.pdf
            FROM
                    karyapeneliti AS a
            INNER JOIN level1 AS b ON a.bagian = b.id
            INNER JOIN level1 AS c ON a.bentukkarya = c.id
            ORDER BY a.tahun DESC

            LIMIT '.$page.','.$row_per_page.'');
        return $query->result_array($query);
    }
    
    function get_list($row_per_page, $page=0, $where = NULL) {

        $page = $page ? $page : 0;
        $query = $this->db->query('
            SELECT
                    a.id,
                    a.judul,
                    -- a.bentukkarya,
                    a.peneliti,
                    a.email,
                    a.tahun,
                    a.daftarisi,
                    -- a.pdf,
                    -- a.bagian,
                    -- b.nama as nama_bagian,
                    c.nama as bentuk_karya
            FROM
                    karyapeneliti AS a
            INNER JOIN level1 AS b ON a.bagian = b.id
            INNER JOIN level1 AS c ON a.bentukkarya = c.id

            LIMIT '.$page.','.$row_per_page.'');
        return $query->result_array($query);
    }

    function count($table) {
    	return $this->db->count_all($table);
    }
    
    /**
     * Model : Save data 
     * @param varchar $table
     * @param array $data
     * @return boolean
     */
    function saveData($table, $data) {
    	$this->db->insert($table, $data);
    	if ($this->db->affected_rows() == '1') {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }
    
    /**
     * Model : Update data table
     * @param varchar $table
     * @param array $data
     * @param int $id
     * @return boolean
     */
    function updateData($table, $data, $id) {
    	$this->db->where("id", $id);
    	$this->db->update($table, $data);
    	if ($this->db->affected_rows() == '1') {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }
    
    /**
     * Model : Delete data base on ID
     * @param int $id
     * @return boolean
     */
    function delete($id) {
    	if ($this->db->delete('karyapeneliti', array('id' => $id))) {
    		return TRUE;
    	} else {
    		return FALSE;
    	}
    }
    
    

}