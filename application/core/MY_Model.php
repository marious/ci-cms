<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    public $rules = array();
    protected $_timestamps = false;

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * get all records from the database
     * if is set id retrn this record that has this id
     * @param  int $id primary key table
     * @return Array of object
     */
    public function get($id = null, $single = false)
    {
        if ($id != null) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
             $method = 'row';
        }
        elseif($single == true){
            $method = 'row';
        }

        else {
            $method = 'result';
        }

        if (!empty($this->_order_by)) {
            $this->db->order_by($this->_order_by);
        }

        return $this->db->get($this->_table_name)->$method();
    }


    /**
     * get records by some conditions
     * @param    $where  array of condtions
     * @param  boolean $single [description]
     * @return array of objects of records
     */
    public function get_by($where, $single = false)
    {

        $this->db->where($where);
        return $this->get(null, $single);
    }


    /**
     * save and update recored in the database
     * @param  mix $data data that you want to update or insert
     * @param  int $id   table primary ke
     * @return $id
     */
    public function save($data, $id = null)
    {

        // set timestamps
        if ($this->_timestamps == true) {
            $now = date('Y-m-d H:i:s');
            $id OR $data['created'] = $now;
            $data['modified'] = $now;
        }

        // insert
        if ($id == null) {

            !isset($data[$this->_primary_key]) OR $data[$this->_primary_key] = null;
            $this->db->set($data);
            $this->db->insert($this->_table_name);
            $id = $this->db->insert_id();
        }
        // update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }

        return $id;
    }


    /**
     * delete record from the database
     * @param  int $id
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return false;
        }

        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        return $this->db->delete($this->_table_name);
    }


    public function array_from_post($fields = array())
    {
        $data = array();
        foreach($fields as $field) {
            $data[$field] = $this->input->post($field);
        }

        return $data;
    }
}
