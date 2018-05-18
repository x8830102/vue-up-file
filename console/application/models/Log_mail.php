<?php

class Log_mail extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function insert_row($data=array())
	{
		if(isset($data['toemail']))
		{
			return $this->db->insert("log_email", $data);
		}
		return false;
	}
}