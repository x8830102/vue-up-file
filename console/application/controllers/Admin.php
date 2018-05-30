<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        show_404();
    }
    public function login_admin()
    {
        $this->header_cross_domain();
        $this->load->model('novel_admin');
        $feedback = array('success' => false, 'data' => array(), 'msg' => '');

        $email = $this->input->post('email', true);
        $password = $this->input->post('passowrd', true);
        if ($member = $this->novel_admin->get_login_result($email)) {
            if ($member['admin'] == 1 && $member['status'] == 1 && $member['password'] == $password) {
                $feedback['success'] = true;
            }
        }
        $this->ajax_feedback($feedback);;
    }
    public function admin_all()
    {
        $this->header_cross_domain();
        $this->load->model('novel_admin');
        $feedback = array('success' => false, 'data' => array(), 'msg' => '');
        
        $feedback['success'] = true;
        if ($log = $this->novel_admin->get_novel_list()) {
            foreach ($log as $_l) {
                $_n = array();
                $_n['novel_no'] = $_l['novel_no'];
                $_n['up_date'] = $_l['up_date'];
                $_n['name'] = $_l['name'];
                $_n['pan_name'] = $_l['pan_name'];
                $_n['email'] = $_l['email'];
                $_n['novel_type'] = $_l['novel_type'];
                $_n['novel_file_size'] = $_l['novel_file_size'];
                $_n['novel_file_name'] = $_l['novel_file_name'];
                $_n['agreement_file_name'] = $_l['agreement_file_name'];
                $_n['note'] = $_l['note'];
                $feedback['data'][]=$_n;
            }
        } else {
            $feedback['msg'] = '尚無完成上傳作品';
        }

        $this->ajax_feedback($feedback);
    }

    public function search()
    {
        $this->header_cross_domain();
        $feedback = array('success' => false, 'data' => array(), 'msg' => '');

        $this->load->model('novel_admin');
        $key = $this->input->post('key', true);
        $novel_type = $this->input->post('novel_type', true);
        $pagestart = $this->input->get('pagestart', true);
        $data_count = $this->input->get('count', true);
        $feedback['success'] = true;

        if (!empty($this->input->get(null, true))) {
            if ($log = $this->novel_admin->get_novel_list_by_search_key($key, $novel_type, $pagestart, $data_count)) {
                foreach ($log as $_l) {
                    $_n = array();
                    $_n['novel_no'] = $_l['novel_no'];
                    $_n['up_date'] = $_l['up_date'];
                    $_n['name'] = $_l['name'];
                    $_n['pan_name'] = $_l['pan_name'];
                    $_n['email'] = $_l['email'];
                    $_n['novel_type'] = $_l['novel_type'];
                    $_n['novel_file_size'] = $_l['novel_file_size'];
                    $_n['novel_file_name'] = $_l['novel_file_name'];
                    $_n['agreement_file_name'] = $_l['agreement_file_name'];
                    $_n['note'] = $_l['note'];
                    $feedback['data'][]=$_n;
                }
            } else {
                $feedback['msg'] = '搜尋結果為0筆';
            }
        } else {
            if ($log = $this->novel_admin->get_novel_list_by_search_key($key, $novel_type)) {
                foreach ($log as $_l) {
                    $_n = array();
                    $_n['novel_no'] = $_l['novel_no'];
                    $_n['up_date'] = $_l['up_date'];
                    $_n['name'] = $_l['name'];
                    $_n['pan_name'] = $_l['pan_name'];
                    $_n['email'] = $_l['email'];
                    $_n['novel_type'] = $_l['novel_type'];
                    $_n['novel_file_size'] = $_l['novel_file_size'];
                    $_n['novel_file_name'] = $_l['novel_file_name'];
                    $_n['agreement_file_name'] = $_l['agreement_file_name'];
                    $_n['note'] = $_l['note'];
                    $feedback['data'][]=$_n;
                }
            } else {
                $feedback['msg'] = '搜尋結果為0筆';
            }
        }
        $this->ajax_feedback($feedback);
    }
    public function save_note()
    {
        $this->header_cross_domain();
        $feedback = array('success' => false, 'data' => array(), 'msg' => '');

        $this->load->model('novel_admin');
        $note = array('note' => $this->input->post('note', true));
        $novel_no = $this->input->post('novel_no', true);

        if ($log = $this->novel_admin->update_note($novel_no, $note)) {
            $feedback['success'] = true;
            $feedback['msg'] = '更新備註完成';
        }
        $this->ajax_feedback($feedback);
    }

    private function header_cross_domain()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Max-Age: 1000');
        header('Content-Type: text/plain; charset=utf-8');
        header("Access-Control-Allow-Headers: X-PINGOTHER, Origin, X-Requested-With, Content-Type, Accept");
    }


    public function ajax_feedback($feedback)
    {
        //header('Content-Type: text/plain; charset=utf-8');
        //echo json_encode($result);
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($feedback));
    }
}