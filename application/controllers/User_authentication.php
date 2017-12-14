<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class User_authentication extends CI_Controller {
	//http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/

	public function __construct() {

		parent::__construct();

		//Load database
		$this->load->model('login_database');
	}


	//implicit controller has to redirect
	public function index()
	{
		$this->user_login_show();
	}


	//send a new password to user email
	public function user_reset_password_send_email($generated_unic_code = '') {
		//var_dump($generated_unic_code);

		if($generated_unic_code != '') {
			//$data['message_display'] = 'A fost trimisa o parola noua la adresa solicitata.';
			//
			$data = array('resetcode' => $generated_unic_code);
			$result_as_email = $this->login_database->user_reset_password_reset($data);
			if($result_as_email !== FALSE) {
				//change password
				$condition	= array('user_email' => $result_as_email);
				$data		= array('user_password' => random_string());
				$result_as_password = $this->login_database->update_password_for_email($condition, $data);
				if($result_as_password !== FALSE) {
					//send password to email
					$mail_to_1			= 'ciupinamihai@yahoo.com';
					$system_from_mail 	= 'technics@probitorg.com';
					$message = '<p >Parola generata este ' . $result_as_password . '</p>';
				    mail($mail_to_1, 'Cerere pentru informatii termopane: ', $message, 'From: ' . $system_from_mail);

					$data['message_display'] = 'Un email cu parola a fost trimis la adresa solicitata.';
					$data['page_name'] = 'login_form';
					$this->load->view('template', $data);

				} else {
					$data['message_display'] = 'Eroare imposibila. Email-ul nu exista in baza de date.';
					$data['page_name'] = 'user_reset_password_form';
					$this->load->view('template', $data);
				}

			} else {
				$data['message_display'] = 'Codul generat nu exista in baza de date.';
				$data['page_name'] = 'user_reset_password_form';
				$this->load->view('template', $data);
			}


		} else {
			$data['message_display'] = 'Codul generat nu este recunoscut.';
			$data['page_name'] = 'user_reset_password_form';
			$this->load->view('template', $data);
		}


	}


	//show reset password window
	public function user_reset_password_reset() {
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			$data['page_name'] = 'user_reset_password_form';
			$this->load->view('template', $data);
		} else {
			$data = array(
				'user_email' => $this->input->post('email_value')
			);

			//check if email exists in database
			$result = $this->login_database->user_reset_password_reset($data);
			//generate unic code
			var_dump(hash('sha256', strval(time())));

			$condition = array(
				'user_email' => $result
			);
			$data = array(
				'resetcode' => hash('sha256', strval(time()))
			);
			$result = $this->login_database->user_reset_update_resetcode($condition, $data);

			if($result !== FALSE) {
				$mail_to_1			= 'ciupinamihai@yahoo.com';
				$system_from_mail 	= 'technics@probitorg.com';
				$message = '<a href="' . site_url('user_authentication/user_reset_password_send_email/'.$result.'/') . '">' . site_url('user_authentication/user_reset_password_send_email/'.$result.'/') . '</a>';
			    mail($mail_to_1, 'Cerere pentru informatii termopane: ', $message, 'From: ' . $system_from_mail);
				//echo  ;
				$data['message_display'] = 'Un email cu link-ul de activare a fost trimis la adresa solicitata.';
				//$data['message_display'] = $message;
			} else {
				$data['message_display'] = 'Email-ul nu exista in baza de date.';
			}

			$data['page_name'] = 'user_reset_password_form';
			$this->load->view('template', $data);
		}
	}

	//show reset password window
	public function user_reset_password_form() {
		$data['page_name'] = 'user_reset_password_form';
		$this->load->view('template',$data);
	}


	//show login page
	public function user_login_show() {
		$data['page_left'] = 'search';
		$data['page_right'] = 'login_form';
		$this->load->view('template', $data);
	}


	//show registration page
	public function user_registration_show() {

		$data['page_right'] = 'registration_form';
		$this->load->view('template', $data);

	}


	//validate and store data in database
	public function new_user_registration() {

		//check validation for user
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			$data['page_right'] = 'registration_form';
			$this->load->view('template', $data);
		} else {
			$user_password_salt = "Vb3VN1n9";
			$data = array(
				'name' => $this->input->post('name'),
				'user_name' => $this->input->post('username'),
				'user_email' => $this->input->post('email_value'),
				'user_password' => hash('sha256', $user_password_salt.$this->input->post('password')),
				'user_password_salt' => $user_password_salt
			);
			$result = $this->login_database->registration_insert($data);
			if($result == TRUE) {
				$data['message_display'] = 'Registration Successfully !';
				$data['page_right'] = 'login_form';
				$this->load->view('template', $data);
				//$this->load->view('login_form', $data);
			} else {
				$data['message_display'] = 'Username already exist!';
				$data['page_right'] = 'registration_form';
				$this->load->view('template', $data);
				//$this->load->view('registration_form', $data);
			}
		}
	}

	//check for user login
	public function user_login_process() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == FALSE) {
			$data['page_right'] = 'login_form';
			$this->load->view('template', $data);
		} else {
			$data = array(
				'user_name' => $this->input->post('username')
			);

			$result = $this->login_database->read_user_information($data);
			if($result !== FALSE) {

				$data['user_password'] = hash('sha256',$result[0]->user_password_salt.$this->input->post('password'));
				//print_r($data);
				$result = $this->login_database->login($data);

				if($result !== FALSE) {
					$sess_array = array(
						'username' => $this->input->post('username'),
						'logged_in' => TRUE,
						'user_category' => $result[0]->category,
						'user_id' => $result[0]->id
					);

					//$data['username'] = $this->input->post('username');

					//add user data in session
					$this->session->set_userdata($sess_array);
					$result = $this->login_database->read_user_information($data);
					//var_dump($result);
					if($result !== FALSE) {
						$data = array(
							'name'		=> $result[0]->name,
							'username'	=> $result[0]->user_name,
							'email'		=> $result[0]->user_email,
							'password'	=> $result[0]->user_password
						);

						redirect ('/question/index');

						//$this->load->view('admin_page', $data);
						//$data['page_name'] = 'index';
						//$this->load->view('template', $data);
					}
				} else {
					$data = array(
						'error_message' => 'Invalid Username or Passwords'
					);
					$data['page_right'] = 'login_form';
					$this->load->view('template', $data);
				}
			} else {
				$data = array(
					'error_message' => 'Invalid Username or Password'
				);
				$data['page_right'] = 'login_form';
				$this->load->view('template', $data);
			}
		}
	}

	//logout
	public function logout() {
		//removing session data
		$sess_array = array(
			'username' => '',
			'logged_in' => '',
			'user_category' => '',
			'user_id' => ''
		);

		//var_dump($sess_array);

		$this->session->unset_userdata($sess_array);
		$this->session->sess_destroy();

		//var_dump($this->session->userdata);

		redirect ('/user_authentication/user_login_show');

		$data['message_display'] = 'Successfully Logout';
		//$data['page_name'] = 'login_form';
		//$this->load->view('template', $data);
	}

}

?>
