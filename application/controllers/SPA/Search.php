<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Search extends CI_Controller {

	public function __construct() {

		parent::__construct();

	}

	public function show_search_form()
	{
		$this->load->view('SPA/search', null);
	}

	public function index()
	{
		$this->show_search_form();
	}
}
?>
