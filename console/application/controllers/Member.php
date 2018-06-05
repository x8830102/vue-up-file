<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	var $email = null;

    function __construct(){
        parent::__construct();
        $this->email = $this->session->userdata('email');
    }

	public function index()
	{
		show_404();
	}

	public function update()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'msg' => '', 'code' => 0);

        $this->load->model(['member_data']);

		if($this->email == $this->input->post('email', true))
		{
			if($email = $this->input->post('email', true))
			{
				if (valid_email($email))
				{
					if($member = $this->member_data->get_row_by_email($email))
					{
						$data_update = array();
						$data_update['name'] = $this->input->post('name', true);
						$data_update['pan_name'] = $this->input->post('pan_name', true);
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
		}
		else
		{
			$feedback['msg'] = '身份不正確或資訊已過期';
            $feedback['code'] = 99;
		}

        $this->ajax_feedback($feedback);
	}

	public function info()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'msg' => '', 'code' => '');


        $this->load->model(['member_data']);

		if($this->email == $this->input->post('email', true))
		{
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
		}
		else
		{
			$feedback['msg'] = '身份不正確或資訊已過期';
            $feedback['code'] = 99;
		}

        $this->ajax_feedback($feedback);

	}

	public function signin()
	{
        $this->header_cross_domain();

		$feedback = array('success' => false, 'email' => null, 'msg' => '');
		if($para['identifier'] = $this->input->post('identifier', true))
		{
			$para['password'] = $this->input->post('password', true);
			$para['client_id'] = PANMEDIA_MEMBER_CLIENT_ID;
			// call api
			$api = 'https://members.panmedia.asia/api/server/login';
			$server_output = $this->curl_post($api, $para);
			$result_array = json_decode($server_output, true);
			if($result_array['code']==21 || $result_array['code']==22)
			{
				$authorization = $result_array['message']['access_token'];
				$api_profile = 'https://members.panmedia.asia/api/v1/profile?fields=id,email,nickname';
				$server_output = $this->curl_get($api_profile, $authorization);
				$profile_result_array = json_decode($server_output, true);
				if($profile_result_array['status']['code']==0)
				{
					$this->session->set_userdata('email', 'paku@panmedia.asia');
					$feedback['email'] = $profile_result_array['user']['email'];
                    $feedback['nickname'] = $profile_result_array['user']['nickname'];
					$feedback['success'] = true;
				}
				else
				{
					$feedback['msg'] = $profile_result_array['status']['text'];
				}
			}
			elseif($result_array['code']==41)
			{
				$feedback['msg'] = '這個帳號的信箱尚未通過驗證喔！';
			}
			elseif($result_array['code']==43)
			{
				$feedback['msg'] = '您輸入的信箱或密碼錯誤';
			}
			else
			{
				$feedback['msg'] = '登入資料驗證未通過';
			}
		}
		else
		{
			$feedback['msg'] = 'PERMISSION DENY';
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


    private function curl_post($api='', $para=array())
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($para));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
        curl_setopt($ch, CURLOPT_VERBOSE , 1);
        //curl_setopt($ch, CURLOPT_USERAGENT , "spider");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($ch, CURLOPT_AUTOREFERER , true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');

        $server_output = curl_exec($ch);
        if(curl_errno($ch))
        {
            $this->CI->load->model(['log_error_curl']);
            //echo 'error:' . curl_error($ch);
            $this->CI->log_error_curl->insert(curl_error($ch));
            return false;
        }
        curl_close ($ch);
        return $server_output;
    }

    private function curl_get($api='', $authorization=null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_POST, 0);
        //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($para));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER , false);
        curl_setopt($ch, CURLOPT_VERBOSE , 1);
        //curl_setopt($ch, CURLOPT_USERAGENT , "spider");
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION , true);
        curl_setopt($ch, CURLOPT_AUTOREFERER , true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        //curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
        if($authorization)
        {
        	$headr = array();
			//$headr[] = 'Authorization: '.$authorization;
			$headr[] = 'authorization: Bearer '.$authorization;
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
        }

        $server_output = curl_exec($ch);
        if(curl_errno($ch))
        {
            $this->CI->load->model(['log_error_curl']);
            echo 'error:' . curl_error($ch);
            $this->CI->log_error_curl->insert(curl_error($ch));
            return false;
        }
        curl_close ($ch);
        return $server_output;
    }
}
