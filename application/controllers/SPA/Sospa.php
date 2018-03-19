<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Sospa extends CI_Controller {

	public function __construct() {

		parent::__construct();

		//Load database
		$this->load->model('question_model');
	}



	/*
	 * show question list
	 */
	public function index() {
		// $this->check_if_admin();

		$result = $this->question_model->get_all();

		$data['result'] = $result;
		if($result != FALSE) {
			$data['page_left'] = 'SPA/index1'; // search
			$data['page_right'] = 'SPA/index2';
			$this->load->view('SPA/template', $data);
		}
	}



	public function search() {

		$data = array(
			'title' => $this->input->get('search_value'),
			'domain' => $this->input->get('domain')
		);

		$result = $this->question_model->get_filtered($data);

		if($result !== FALSE) {
			$data['result'] = $result;
			$this->load->view('SPA/result', $data);
		}
	}



	public function check_if_authenticated() {
		if ((!isset($this->session->userdata['logged_in'])) || (!$this->session->userdata['logged_in'])) // or whatever you use
		{
			redirect ('user_authentication/user_login_show');
		}
	}

	public function check_if_user_status_approved() {
		if($this->session->userdata['user_status'] === 'unapproved')
		{
			redirect ('search/index');
		}
	}

	public function check_if_author($question_author = -1) {
		if(($question_author !== -1)&&($question_author !== $this->session->userdata['user_id']))
		{
			redirect ('search/index');
		}
	}

	public function check_if_authorized($question_author = -1) {
		$this->check_if_authenticated();
		$this->check_if_user_status_approved();
		$this->check_if_author($question_author);
	}

	public function check_if_authorized_to_edit($question_author = -1) {
		$this->check_if_authenticated();
		$this->check_if_user_status_approved();
		$this->check_if_author($question_author);
	}

	public function check_if_admin() {
		if ((!isset($this->session->userdata['logged_in'])) || (!$this->session->userdata['logged_in'])) // or whatever you use
		{
			redirect ('user_authentication/user_login_show');
		} else if("admin" !== $this->session->userdata['user_category']) {
			redirect ('search/index');
		}
	}

	public function bool_check_if_admin() {
		if ((!isset($this->session->userdata['logged_in'])) || (!$this->session->userdata['logged_in'])) // or whatever you use
		{
			return false;
		} else if("admin" !== $this->session->userdata['user_category']) {
			return false;
		}

		return true;
	}

	//show cataloging page
	public function show_question_form($question_id = 0) {
		$this->check_if_authorized_to_edit();

		if($question_id != 0) {
			//update
			$data = array(
				'id' => $question_id,
			);

			$result = $this->question_model->read_question_details($data);

			if($result != FALSE) {
				$data['result'] = $result;
				$data['page_left'] = 'search';
				$data['page_right'] = 'question_form_update';
				$this->load->view('template',$data);
			}
		} else {
			$data['page_left'] = 'search';
			$data['page_right'] = 'question_form_insert';
			$this->load->view('template',$data);
			//var_dump($data);
		}

	}



	//validate and store data in database
	public function question_insert() {
		$this->check_if_authorized();

		//check validation for user
		//$this->form_validation->set_rules('title', 									'Nume produs', 'trim|required|xss_clean|min_length[5]|max_length[64]');
		//$this->form_validation->set_rules('tags', 									'Categorie', 'trim|required|xss_clean');
		//$this->form_validation->set_rules('desc', 									'Descriere', 'trim|xss_clean');
		//$this->form_validation->set_rules('code', 									'Descriere', 'trim|xss_clean');

		$data = array(
			'domain' => $this->input->post('domain'),
			'title' => $this->input->post('title'),
			'tags' => $this->input->post('tags'),
			'solution_tags' => $this->input->post('solution_tags'),
			'desc' => $this->input->post('desc'),
			'code' => $this->input->post('code'),
			'private' => $this->input->post('private')? "1" : "0",
			'author' => $this->session->userdata['user_id']
		);

		$question_id = $this->question_model->question_insert($data);
		$data['message_display'] = '';

		//$result = $this->question_model->get_all();

		//$data['result'] = $result;
		if($question_id !== FALSE) {
			//$data['page_name'] = 'index';
			//$this->load->view('template',$data);
			// $data['message_display'] .= ' The question was succesfully inserted.';
			// $this->show_question_details($question_id, $data['message_display']);
			redirect ('/question/show_question_details/'.$question_id);
		} else {
			$data['message_display'] .= 'Error 543653 - could not insert question';
			$data['page_right'] = 'question_form_insert';
			$this->load->view('template', $data);
		}
	}



	public function question_update() {
		$this->check_if_authorized();

		$question_id 	= $this->input->post('question_id');

		// var_dump($this->input->post('private'));
		//var_dump($question_id);

		$data = array(
			'domain' => $this->input->post('domain'),
			'title' => $this->input->post('title'),
			'tags' => $this->input->post('tags'),
			'solution_tags' => $this->input->post('solution_tags'),
			'desc' => $this->input->post('desc'),
			'code' => $this->input->post('code'),
			'private' => $this->input->post('private')
		);

		$result = $this->question_model->question_update($question_id, $data);
		$data['message_display'] = 'm: ';

		if($result === TRUE) {
			// $data['message_display'] .= 'The question was succesfully modified.';
			// $this->show_question_details($question_id, $data['message_display']);
			redirect ('/question/show_question_details/'.$question_id);

		} else {
			$data['question_id'] = $question_id;
			$data['message_display'] .= 'Eroare 324365';
			$data['page_right'] = 'question_form_update';
			$this->load->view('template', $data);
		}


	}










	//show question details
	public function show_question_details_test($question_id = 0, $message_display = '') {



		$this->load->library('markdown');

		if(!isset($question_id) OR ($question_id == 0)) {
			$data['message_display'] = $message_display;

			$data['page_left'] = 'index';
			$this->load->view('template',$data);

		} else {

			$data = array(
				'id' 		=> $question_id
			);

			$result = $this->question_model->read_question_details($data);

			if($result === false) { redirect ('/errors/page_missing'); }

			// if question is private then logout
			if($result[0]->private === "1") {$this->check_if_authorized($result[0]->author);}

			$data['result'] = $result;
			$data['composed_title'] =	$result[0]->title;
			$data['is_admin'] = $this->bool_check_if_admin();
			if($result[0]->domain) {	$data['composed_title'] .= " in " . $result[0]->domain;}
			$data['message_display'] = $message_display;

			if($result != FALSE) {



				$xxx = json_decode($result[0]->desc, true);
				var_dump(   $xxx["ep"]   );



				$data['page_left'] = 'search';
				$data['page_right'] = 'question_details';
				$this->load->view('template', $data);

				//$this->load->view('search_result', $data);
			}
		}



	}











	//show question details
	public function show_question_details($question_id = 0, $message_display = '') {
		// var_dump($message_display);
		$this->load->library('markdown');

		if(!isset($question_id) OR ($question_id == 0)) {
			$data['message_display'] = $message_display;

			$data['page_left'] = 'index';
			$this->load->view('template',$data);

		} else {

			$data = array(
				'id' 		=> $question_id
			);

			$result = $this->question_model->read_question_details($data);

			if($result === false) { redirect ('/errors/page_missing'); }
			// var_dump($result);

			// if question is private then logout
			if($result[0]->private === "1") {$this->check_if_authorized($result[0]->author);}

			$data['result'] = $result;
			$data['composed_title'] =	$result[0]->title;
			$data['is_admin'] = $this->bool_check_if_admin();
			if($result[0]->domain) {	$data['composed_title'] .= " in " . $result[0]->domain;}
			$data['message_display'] = $message_display;

			if($result != FALSE) {

				// $data['page_left'] = 'search';
				// $data['page_right'] = 'question_details';
				$this->load->view('SPA/question_details', $data);

				//$this->load->view('search_result', $data);

			}
		}
	}





}


// <pre style="white-space: pre-wrap;"><?=htmlspecialchars($result[0]->desc)<pre>
// <br >
// <pre style="white-space: pre-wrap;"><?=$this->markdown->parse(htmlspecialchars($result[0]->code))</pre>
// <br >


?>
