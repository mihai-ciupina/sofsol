<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Search extends CI_Controller {

	public function __construct() {

		parent::__construct();

	}

	public function show_search_form()
	{
		$data['page_left'] = 'search';
		$data['page_right'] = 'vision';
		
		$this->load->view('template', $data);
	}

	public function index()
	{
		$this->show_search_form();
	}
}
?>
