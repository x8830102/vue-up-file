<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Novel extends CI_Controller
{
	var $max_file_upload = 0;
	var $libraryFolder = '';
	var $sourceFolder = '';
	var $novel_no_prefix = array(1 => 'A', 2 => 'B');

    function __construct(){
        parent::__construct();
        $this->max_file_upload =1024*1024*10;
		$this->libraryFolder = FCPATH . "assets/file/uploads/";
		$this->sourceFolder = FCPATH . "assets/file/source/";
    }

	public function index()
	{
		show_404();
	}

	public function upload()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'msg' => '');

        $this->load->model(['member_data', 'member_novel']);

		if($email = $this->input->post('email', true))
		{
			if (valid_email($email))
			{
				if($member = $this->member_data->get_row_by_email($email))
				{
					// 檔案檢查
					//var_dump($_FILES['novel']);exit();
					//$file = $_FILES;
					$files = $_FILES['novel'];
					$originalFile = empty($files['tmp_name'])? $files['name']:$files['tmp_name'];
					$tmp = explode(".", $files['name']);
					$new_name = uniqid().'.'.$tmp[COUNT($tmp)-1];
					$sourceFile = rtrim($this->sourceFolder,'/') . '/' .$new_name;

					if(move_uploaded_file($originalFile,$sourceFile))
					{
						$file_size = filesize($sourceFile);
						$novel_type = $this->input->post('up_type', true);
						$novel_type = $novel_type!=2? 1:2;
						if($log = $this->member_novel->get_row_by_email_and_type($email, $novel_type))
						{
							// 存在上傳紀錄，下架舊的先
							$data_update = array();
							$data_update['status'] = 0;
							$this->member_novel->update_row_by_sn($log['sn'], $data_update);
						}

						$agreement_file = $_FILES['agreement'];
						$originalFile = empty($agreement_file['tmp_name'])? $agreement_file['name']:$agreement_file['tmp_name'];
						$tmp = explode(".", $agreement_file['name']);
						$new_agreement_name = uniqid().'.'.$tmp[COUNT($tmp)-1];
						$agreementFile = rtrim($this->libraryFolder,'/') . '/' .$new_agreement_name;

						$agreement_file_name = '';
						if(move_uploaded_file($originalFile,$agreementFile))
						{
							$agreement_file_name = $new_agreement_name;
						}

						$novel_no = $this->member_novel->get_count_by_type($novel_type)+1;

						$data_insert = array();
						$data_insert['email'] = $email;
						$data_insert['novel_type'] = $novel_type;
						$data_insert['novel_no'] = ($novel_type==1? "A":"B").sprintf("%04d", $novel_no);
						$data_insert['novel_file_name'] = $new_name;
						$data_insert['novel_file_size'] = $file_size;
						$data_insert['agreement_file_name'] = $agreement_file_name;
						$data_insert['up_date'] = date('Y-m-d H:i:s');
						if($this->member_novel->insert_row($data_insert))
						{
							$feedback['success'] = true;
							$feedback['msg'] = '上傳成功';
						}
						else
						{
							$feedback['msg'] = '上傳失敗';
						}
					}
					else
					{
						$feedback['msg'] = '檔案可能超過系統限制大小';
					}
				}
				else
				{
					$feedback['msg'] = '帳號不存在';
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

	public function my()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'msg' => '');


        $this->load->model(['member_data', 'member_novel']);

		if($email = $this->input->post('email', true))
		{
			if (valid_email($email))
			{
				if($log = $this->member_novel->get_row_by_email_and_type($email, $this->input->post('novel_type', true)))
				{
					$feedback['success'] = true;
					$feedback['data'] = $log;
				}
				else
				{
					$feedback['msg'] = '上傳紀錄不存在';
					$feedback['post_data'] = array(
						'email' => $this->input->post('email', true),
						'novel_type' => $this->input->post('novel_type', true)
					);
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

	public function all()
	{
        $this->header_cross_domain();
        $feedback = array('success' => false, 'data' => array(), 'msg' => '');


        $this->load->model(['member_data', 'member_novel']);

		$feedback['success'] = true;
		if($log = $this->member_novel->get_list_by_type($this->input->post('novel_type', true), 1))
		{
			foreach($log as $_l)
			{
				$_n = array();
				$_n['novel_no'] = $_l['novel_no'];
				$_n['up_date'] = $_l['up_date'];
				$feedback['data'][]=$_n;
			}
		}
		else
		{
			$feedback['msg'] = '尚無完成上傳作品';
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
