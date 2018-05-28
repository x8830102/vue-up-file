<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
*/

class Member_novel extends CI_Model{
    var $error = '';

    function __construct(){
        parent::__construct();
    }
    /*
    * 
    */
    public function get_row_by_sn($sn=0, $status=null)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->where('sn', $sn);
        if($status)
        {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        return $query->row_array();
    }
    /*
    * 
    */
    public function get_row_by_email($email=null)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    /*
    * 
    */
    public function get_row_by_email_and_type($email=null, $novel_type=0)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->where('email', $email);
        $this->db->where('novel_type', $novel_type);
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function get_list_by_type($novel_type=0)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->where('novel_type', $novel_type);
        //$this->db->where('complete_time IS NOT NULL');
        $this->db->where('status', 1);
        $this->db->order_by('up_date DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_count_by_type($novel_type=0)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->where('novel_type', $novel_type);
        //$this->db->where('complete_time IS NOT NULL');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }
    /*
    * update account info
    */
    public function update_row_by_sn($sn=null, $data_update=null)
    {
        if($data_update)
        {
            $update_where = array();
            $update_where['sn'] = $sn;
            return $this->db->update('pansf2018_novel', $data_update, $update_where);
        }
    }
    /*
    * 新增帳號
    */
    public function insert_row($data_insert=null)
    {
        if($data_insert)
        {
            if($this->db->insert('pansf2018_novel', $data_insert))
            {
                return $this->db->insert_id();
            }
        }
        return false;
    }


    //admin
    public function get_novel_list()
    {
        $this->db->select('*');
        $this->db->from('pansf2018_novel');
        $this->db->join('pansf2018_member_data', 'pansf2018_novel.email = pansf2018_member_data.email', 'left');
        $this->db->where('pansf2018_member_data.status', 1);
        $this->db->order_by('up_date DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_novel_list_by_search_key($key = null, $novel_type = 0, $pagestart = 0, $count = 25)
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
}