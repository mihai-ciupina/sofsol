<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class User_admin extends CI_Controller {
	//http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
	
	public function __construct() {
	
		parent::__construct();
	
		//if ((!isset($this->session->userdata['logged_in']))||(!$this->session->userdata['logged_in'])) // or whatever you use
		//{
		//	redirect ('user_authentication/user_login_show');
		//}

		//Load database
		$this->load->model('user_admin_database');
	}
	
	
	public function show_user_search_form()
	{   
		$data['page_name'] = 'user_search_result';
		$this->load->view('template', $data);
	}


	//show user details
	public function show_users_search_result() {
	
		$this->form_validation->set_rules('name', 'Nume utilizator: ', 'trim');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('search');
		} else {
			$data = array(
				'post_name' => $this->input->post('input_name'),
			);

			$result = $this->user_admin_database->read_user_all($data);
			
			$data['result'] = $result;
			if($result != FALSE) {
				
				$data['page_name'] = 'user_search_result';
				$this->load->view('template',$data);
			}
		}	
	
	}
	
	
	
	//show user details
	public function show_user_details($user_id = 0) {
		
		if(!isset($user_id) OR ($user_id == 0)) {
			$data['page_name'] = 'search';
			$this->load->view('template',$data);

		} else {

			$data = array(
				'id' => $user_id
			);

			$result = $this->user_admin_database->read_user_details($data);
			
			$data['result'] = $result;
			//var_dump($data);
			if($result != FALSE) {
			
				$data['page_name'] = 'user_details';
				$this->load->view('template',$data);
				
		
			}
		}	
	}
	
	
	
	//show cataloging page
				
	public function show_user_form($user_id = 0) {

		
		if($user_id != 0) {
			//update
			$data = array(
				'id' => $user_id,
			);

			$result = $this->user_admin_database->read_user_details($data);

			if($result != FALSE) {
				$data['result'] = $result;
				$data['category_page'] = $result[0]->category;
				
				$data['page_name'] = 'user_form_update';
				$this->load->view('template',$data);
			}
		} else {
			//insert
				$data['page_name'] = 'user_form_insert';
			$this->load->view('template',$data);
		}
		
		
	}
	
	/**
 * Functions that will display name of the variable, and it's value, and type
 * 
 * @param type $_var - variable to check
 * @param type $aDefinedVars - Always define it this way: get_defined_vars()
 * @return type
 */
public function vardump(&$_var, &$aDefinedVars = null){
    if($aDefinedVars){
         foreach ($aDefinedVars as $k=>$v)
            $aDefinedVars_0[$k] = $v; 
        $iVarSave = $_var; // now I copy the $_var value to ano
        $_var     = md5(time());

        $aDiffKeys = array_keys (array_diff_assoc ($aDefinedVars_0, $aDefinedVars));
        $_var      = $iVarSave;
        $name      = $aDiffKeys[0];
    }else{
        $name = 'variable';
    }

    echo '<pre>';
    echo $name . ': ';
    var_dump($_var);
    echo '</pre>';
}
	
	//validate and store data in database
	public function user_update() {

		$this->load->helper('MY_other');

		$user_id 	= $this->input->post('user_id');

		//check validation for user
		$this->form_validation->set_rules('user_name', 'Username utilizator', 'trim|required|min_length[5]');
		
		if($this->form_validation->run() == FALSE) {
			$data['user_id'] = $this->input->post('user_id');
			$data['page_name'] = 'user_form_update';
			$this->load->view('template', $data);
			
		} else {
			
			$data = array(
				'user_name' 	=> $this->input->post('user_name'),
				'name' 			=> $this->input->post('name'),
				'category' 		=> $this->input->post('category'),
				'user_email' 	=> $this->input->post('user_email'),
				'notes' 		=> $this->input->post('notes'),
			);
			$user_password = $this->input->post('user_password');
			if($user_password != '') {

				$user_password_salt = random_string();
				$user_password_hash =  hash('sha256', $user_password_salt . $user_password);

				$data['user_password'] = $user_password_hash;
				$data['user_password_salt'] = $user_password_salt;

			}
				
			$result = $this->user_admin_database->user_update($user_id, $data);

			if($result == TRUE) {
			
				$data['message_display'] = 'Utilizatorul a fost modificat cu succes.';
				$this->show_user_details($user_id);
				
			} else {
				$data['user_id'] = $this->input->post('user_id');
				$data['message_display'] = 'Eroare 324365 - anuntati administratorul!';
				$data['page_name'] = 'user_form_update';
				$this->load->view('template', $data);
			}
		}	
	}


	//validate and store data in database
	public function user_insert() {


		//check validation for user
		$this->form_validation->set_rules('user_name', 'Nume utilizator', 'trim|required|min_length[5]');
		$this->form_validation->set_rules('category', 'Categorie', 'trim|required');
		$this->form_validation->set_rules('user_password', 'Parola', 'trim|required|min_length[1]');
		$this->form_validation->set_rules('user_password_again', 'Parola', 'trim|required|min_length[1]');

		
		
		
		
		
		$user_password_salt = random_string();
		$user_password_hash =  hash('sha256', $user_password_salt . $this->input->post('user_password'));



		
		
		if($this->form_validation->run() == FALSE) {
			$data['page_name'] = 'user_form_insert';
			$this->load->view('template', $data);
		} else {
			$data = array(
				'user_name' 			=> $this->input->post('user_name'),
				'name' 					=> $this->input->post('user_name'),
				'user_password' 		=> $user_password_hash,
				'user_password_salt' 	=> $user_password_salt,
				'category' 				=> $this->input->post('category'),
				'user_email' 			=> $this->input->post('user_email'),
				'notes' 				=> $this->input->post('notes'),
			);
			
			$result = $this->user_admin_database->user_insert($data);
			
			if($result !== FALSE) {
				$user_id = $result;
				$data['message_display'] = 'Utilizatorul a fost adaugat cu succes.';
				$this->show_user_details($user_id);
			} else {
				$data['message_display'] = 'Utilizatorul exista deja!';
				$data['page_name'] = 'user_form_insert';
				$this->load->view('template', $data);
			}
		}
	}
	
	
	
	
	
	
}

?>