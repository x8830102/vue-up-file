<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {


	public function index()
	{
		show_404();
	}

	public function update()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'msg' => '');

        $this->load->model(['member_data']);

		if($email = $this->input->post('email', true))
		{
			if (valid_email($email))
			{
				if($member = $this->member_data->get_row_by_email($email))
				{
					$data_update = array();
					$data_update['name'] = $this->input->post('name', true);
					$data_update['pan_name	'] = $this->input->post('pan_name	', true);
					$data_update['phone'] = $this->input->post('phone', true);
					$data_update['admin'] = $this->input->post('admin', true);
					if($this->member_data->update_row_by_sn($member['sn'], $data_update))
					{
						$feedback['success'] = true;
						$feedback['msg'] = '變更帳號資訊成功';
					}
					else
					{
						$feedback['msg'] = '變更帳號資訊失敗';
					}

				}
				else
				{
					$data_insert = array();
					$data_insert['email'] = $email;
					$data_insert['name'] = $this->input->post('name', true);
					$data_insert['pan_name'] = $this->input->post('pan_name', true);
					$data_insert['phone'] = $this->input->post('phone', true);
					$data_insert['admin'] = $this->input->post('admin', true);
					$data_insert['create_time'] = date('Y-m-d H:i:s');
					$data_insert['status'] = 1;
					if($this->member_data->insert_row($data_insert))
					{
						$feedback['success'] = true;
						$feedback['msg'] = '新增帳號資訊成功';
					}
					else
					{
						$feedback['msg'] = '新增帳號資訊失敗';
					}
				}
			}
			else
			{
				$feedback['msg'] = '不是有效的 Email 格式';
			}
		}
		else
		{
			$feedback['msg'] = 'Email 不存在';
		}

        $this->ajax_feedback($feedback);
	}

	public function info()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'msg' => '');


        $this->load->model(['member_data']);

		if($email = $this->input->post('email', true))
		{
			if (valid_email($email))
			{
				if($member = $this->member_data->get_row_by_email($email))
				{
					$feedback['success'] = true;
					$feedback['data'] = $member;
				}
				else
				{
					$feedback['msg'] = '資料不存在';
				}
			}
			else
			{
				$feedback['msg'] = '不是有效的 Email 格式';
			}
		}
		else
		{
			$feedback['msg'] = 'Email 不存在';
		}

        $this->ajax_feedback($feedback);

	}
    
    private function header_cross_domain(){
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
