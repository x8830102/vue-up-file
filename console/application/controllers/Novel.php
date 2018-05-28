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
						if($file_size <= $this->max_file_upload)
						{
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
							$data_insert['ip'] = $this->input->ip_address();
							$data_insert['up_date'] = date('Y-m-d H:i:s');
							if($this->member_novel->insert_row($data_insert))
							{
								$feedback['success'] = true;
								$feedback['msg'] = '上傳成功';


	                			$bcc = array();
	                			$this->load->library("mailgun");

	                			$page_data = array();
								$page_data['email'] = $email;
								$page_data['novel_no'] = $data_insert['novel_no'];
								$page_data['up_date'] = $data_insert['up_date'];
								$page_data['novel_type_name'] = $novel_type==1? '短篇小說':'中短篇小說';
								$page_data['mamber_name'] = $member['name'];
								$page_data['mamber_pan_name'] = $member['pan_name']? $member['pan_name']:'';


								$data_mail = array();
								$data_mail['toemail'] = $email;
								$data_mail['subject'] = '[泛科幻獎] '.$member['name'].'，感謝您的投稿！';
								$data_mail['body'] = $this->load->view('email_novel_acception', $page_data, true);
								$data_mail['controller'] = $this->uri->uri_string();
								$data_mail['success'] = 0;

								$attachment_file = $this->sourceFolder.$data_insert['novel_file_name'];

	                			$bcc = array('jerrywu@panmedia.asia');
	                			$this->load->library("mailgun");
		                        if (!$this->mailgun->service_mail($data_mail['toemail'], $data_mail['subject'], $data_mail['body'], $bcc, '系統管理員', $attachment_file, $data_insert['novel_no'].'_'.$data_insert['novel_file_name']))
		                        {
		                            $data_mail["server_log"] = $this->mailgun->msg_error;
		                        } 
		                        else
		                        {
		                            $data_mail["success"] = 1;
		                            $data_mail["time_sent"] = date('Y-m-d H:i:s');
									$feedback['success'] = true;
		                        }

								$this->load->model("log_mail");
								$this->log_mail->insert_row($data_mail);
							}
							else
							{
								$feedback['msg'] = '上傳失敗';
							}

						}
						else
						{
							$feedback['msg'] = '檔案超過 10mb';
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

	public function admin_all()
	{
		$this->header_cross_domain();
		$feedback = array('success' => false, 'data' => array(), 'msg' => '');

		$data_count = $this->input->get('count', true);
        $this->load->model(['member_data', 'member_novel']);
        $feedback['success'] = true;
        if($log = $this->member_novel->get_novel_list($data_count))
		{
			foreach($log as $_l)
			{
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
				$feedback['data'][]=$_n;
			}
		}
		else
		{
			$feedback['msg'] = '尚無完成上傳作品';
		}

        $this->ajax_feedback($feedback);
	}

	public function search()
	{
		$this->header_cross_domain();
		$feedback = array('success' => false, 'data' => array(), 'msg' => '');

		$this->load->model(['member_novel']);
		$key = $this->input->post('key', true);
		$novel_type = $this->input->post('novel_type', true);
		$pagestart = $this->input->get('pagestart', true);
   		$data_count = $this->input->get('count', true);
        $feedback['success'] = true;

        if (!empty($this->input->get(null, true)))
        {
        	if ($log = $this->member_novel->get_novel_list_by_search_key($key, $novel_type, $pagestart, $data_count))
	        {
	        	foreach ($log as $_l)
				{
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
					$feedback['data'][]=$_n;
					$feedback['msggg'] = $pagestart . ' + ' . $data_count;
				}
	        }
	        else
			{
				$feedback['msg'] = '搜尋結果為0筆';
			}
        } else {
        	if ($log = $this->member_novel->get_novel_list_by_search_key($key, $novel_type))
	        {
	        	foreach ($log as $_l)
				{
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
					$feedback['data'][]=$_n;
				}
	        }
	        else
			{
				$feedback['msg'] = '搜尋結果為0筆';
			}
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
