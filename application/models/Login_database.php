<?php

Class Login_database extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	//user_reset_password_reset
	public function user_reset_password_reset($data) {
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($data);
		$this->db->limit(1);
		$query = $this->db->get();
		
		if ($this->db->_error_message()) {
			return FALSE;
		} else if($query->num_rows() == 1) {
			$result = $query->result();
			return $result[0]->user_email;
		} else {
			return FALSE;
		}
	}


	//update_password_for_email
	public function update_password_for_email($condition, $data) {
		$this->db->where($condition);
		$query = $this->db->update('users', $data);
		
		if ($this->db->_error_message()) {
			return FALSE;
		} else if($this->db->affected_rows() == 1) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where($condition);
			$this->db->limit(1);
			$query = $this->db->get();
			
			if ($this->db->_error_message()) {
				return FALSE;
			} else if($query->num_rows() == 1) {
				$result = $query->result();
				return $result[0]->user_password;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	
	//user_reset_update_generated_code
	public function user_reset_update_resetcode($condition, $data) {

		$this->db->where($condition);
		$query = $this->db->update('users', $data);
		
		if ($this->db->_error_message()) {
			return FALSE;
		} else if($this->db->affected_rows()) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where($data);
			$this->db->limit(1);
			$query = $this->db->get();
			
			if ($this->db->_error_message()) {
				return FALSE;
			} else if($query->num_rows() == 1) {
				$result = $query->result();
				return $result[0]->resetcode;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
	

	//login database function
	public function login($data) {
	
		$condition = "user_name =" . "'" . $data['user_name'] . "' AND " . "user_password =" . "'" . $data['user_password'] . "'";
		
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
	
	//insert registration data in database
	public function registration_insert($data) {
		
		//check for duplicated username
		$condition = "user_name =" . "'" . $data['user_name'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 0) {
			//no duplicated user so insert data in database
			$this->db->insert('users', $data);
			if($this->db->affected_rows() > 0) {
				return TRUE;
			}
		} else {
			return FALSE;
		}
	}
	
	//read user data from database
	public function read_user_information($data) {
		//var_dump($sess_array);
		//$condition = "user_name =" . "'" . $sess_array['username'] . "'";
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where($data);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}
	
	
}