<?php

Class Question_model extends CI_Model {



	public function __construct() {
		parent::__construct();
	}



	//read all questions data from database
	public function get_all() {
		$query = $this->db->select('*')->from('questions')->order_by("UPPER(title)","asc")->get();
		if($query->num_rows() >= 1) {
			return $query->result();
		}
		return null;
	}

	//read public questions data from database
	public function get_public() {
		$condition = "private=0";

		$query = $this->db->select('*')->from('questions')->where($condition)->get();
		if($query->num_rows() >= 1) {
			return $query->result();
		}
		return null;
	}



	public function authorized() {
		if ((!isset($this->session->userdata['logged_in'])) || (!$this->session->userdata['logged_in'])) // or whatever you use
		{
			return false;
		} else {
			return true;
		}
	}

	//read questions data from database
	public function get_filtered($data) {

		$domain = "";
		if(isset($data['domain']) && ($data['domain']!=="")) {
			$domain = $data['domain'];
			$domain = ' AND (' . "domain like '%$domain%'" . ')';
		}

		if(isset($data['title'])) {

			$keywords = explode(" ", trim($data['title']," "));
			$string_query = "";


			$title_and_1 = "SELECT '***' as 'top', id, title, tags, domain FROM questions WHERE ";
			$c = 0;
			$condition = "(";
			foreach($keywords as $key) {
				if($c > 0) {$condition .= " AND ";}
				$condition .= "title like " . "'%" . $key . "%'";
				$c = $c + 1;
			}
			$condition .= ")";

			if(!$this->authorized()) {
				if($condition) {$condition .= " AND";}
				$condition .= " private=0";
			}
			$title_and_1 .= $condition . $domain;




			$title_or__2 = "SELECT '*' as 'top', id, title, tags, domain FROM questions WHERE ";
			$c = 0;
			$condition = "(";
			foreach($keywords as $key) {
				if($c > 0) {$condition .= " OR ";}
				$condition .= "title like " . "'%" . $key . "%'";
				$c = $c + 1;
			}
			$condition .= ")";

			if(!$this->authorized()) {
				if($condition) {$condition .= " AND";}
				$condition .= " private=0";
			}
			$title_or__2 .= $condition . $domain;








			$tags__or__3 = "SELECT '**' as 'top', id, title, tags, domain FROM questions WHERE ";
			$c = 0;
			$condition = "(";
			foreach($keywords as $key) {
				if($c > 0) {$condition .= " OR ";}
				$condition .= "tags like " . "'%" . $key . "%'";
				$c = $c + 1;
			}
			$condition .= ")";

			if(!$this->authorized()) {
				if($condition) {$condition .= " AND";}
				$condition .= " private=0";
			}
			$tags__or__3 .= $condition . $domain;





			$string_query = $title_and_1 . " UNION DISTINCT " . $tags__or__3 . " UNION DISTINCT " . $title_or__2;
			// var_dump($string_query);

			$query = $this->db->query($string_query);

			// var_dump($query);

			if($query->num_rows() >= 1) {
				return $query->result();
			}


		}//if title exists


		return null;

	}
	//$condition = "title like '%get%'";
	//$query = $this->db->select('*')->from('questions')->where($condition)->order_by("UPPER(title)","asc")->get();


	//
	public function question_insert($data) {
		$this->db->trans_start();
		$this->db->insert('questions', $data);
		if($this->db->affected_rows() > 0) {
			$result = $this->db->insert_id();
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE)
			{
				$result = FALSE;
			}
		} else {
			$result = FALSE;
		}

		return $result;
	}

	//
	public function question_update($question_id, $data){
		$this->db->where('id', $question_id);
		$result = $this->db->update('questions', $data);
		return $result;
	}




	//read product data from database
	public function read_question_details($data) {
		//var_dump($sess_array);
		$condition = "id =" . "'" . $data['id'] . "'";
		$this->db->select('*');
		$this->db->from('questions');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return FALSE;
		}
	}





}
