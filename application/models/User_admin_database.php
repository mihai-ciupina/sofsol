<?php

Class User_admin_database extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	//insert registration data in database
	public function user_insert($data) {
		
		
		//check for duplicated user
		$condition = "user_name =" . "'" . $data['user_name'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 0) {
			//no duplicated users so insert data in database
			$this->db->trans_start();
			$this->db->insert('users', $data);
			if($this->db->affected_rows() > 0) {
				$result = $this->db->insert_id();
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE)
				{
					return FALSE;
				} else {
					return $result;
				}
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	
	//read user data from database
	public function read_user_details($data) {
		//var_dump($sess_array);
		$condition = "id =" . "'" . $data['id'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
	
	
	//read user data from database
	public function read_user_all($data) {
		//var_dump($sess_array);
		
		if(isset($data['post_name'])) {
			$condition = "user_name like" . "'%" . $data['post_name'] . "%'";
		} else {
			$condition = "";
		}

		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$query = $this->db->get();

		if($query->num_rows() >= 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
	

	//
	public function user_update($user_id, $data){
		$this->db->where('id', $user_id);
		$result = $this->db->update('users', $data);
		return $result;
	}

	


	
	
}