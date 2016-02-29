<?php

class Codegen_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $table
     * @param type $fields
     * @param type $where
     * @param type $perpage
     * @param type $start
     * @param type $one
     * @param type $array
     * @return type
     */
    function get($table, $fields, $where = '', $perpage = 0, $start = 0, $one = false, $array = 'array') {

        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage, $start);
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get();

        $result = !$one ? $query->result($array) : $query->row();
        return $result;
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