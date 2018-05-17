<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
* 使用者 Model，負責管理人員登入!
*/

class Member_data extends CI_Model{
    var $error = '';

    function __construct(){
        parent::__construct();
    }
    /*
    * 取得使用者資料
    */
    public function get_row_by_sn($sn=0, $status=null)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_member_data');
        $this->db->where('sn', $sn);
        if($status)
        {
            $this->db->where('status', $status);
        }
        $query = $this->db->get();
        return $query->row_array();
    }
    /*
    * 取得使用者資料
    */
    public function get_row_by_email($email=null)
    {
        $this->db->select('*');
        $this->db->from('pansf2018_member_data');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
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
            if(isset($data_update['password']))
            {
                $data_update['password'] = $this->lib_user->encrypt_password($data_update['password']);
            }
            return $this->db->update('pansf2018_member_data', $data_update, $update_where);
        }
    }
    /*
    * 新增帳號
    */
    public function insert_row($data_insert=null)
    {
        if($data_insert)
        {
            if($this->db->insert('pansf2018_member_data', $data_insert))
            {
                return $this->db->insert_id();
            }
        }
        return false;
    }
}