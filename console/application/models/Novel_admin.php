<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
*/

class Novel_admin extends CI_Model{
    var $error = '';

    function __construct(){
        parent::__construct();
    }

    public function get_login_result($email = null)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_member_data');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_novel_list($count = 0, $pagestart = 0)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->join('pansf2018_member_data', 'pansf2018_novel.email = pansf2018_member_data.email', 'left');
        $this->db->where('pansf2018_member_data.status', 1);
        $this->db->order_by('up_date DESC');
        $this->db->limit($count, $pagestart);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_novel_list_by_search_key($key = null, $novel_type = 0, $pagestart = 0, $count = 0)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->join('pansf2018_member_data', 'pansf2018_novel.email = pansf2018_member_data.email', 'left');
        $this->db->where('pansf2018_member_data.status', 1);
        
        if ($key != null)
        {
            $this->db->where('pansf2018_member_data.name', $key);
            $this->db->or_where('pansf2018_member_data.pan_name', $key);
            $this->db->or_where('pansf2018_member_data.email', $key);
            $this->db->or_where('pansf2018_novel.novel_no', $key);
        }
        if ($novel_type != 0)
        {
            $this->db->where('pansf2018_novel.novel_type', $novel_type);
        }
        $this->db->order_by('up_date DESC');
        $this->db->limit($count, $pagestart);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_note($novel_no, $data = null)
    {
        if ($data) {
            $update_where = array('novel_no' => $novel_no);
            return $this->db->update('pansf2018_novel', $data, $update_where);
        }

    }
}