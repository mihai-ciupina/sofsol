<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Seo extends CI_Controller {

	public function __construct() {
	
		parent::__construct();
			
		//Load database
		$this->load->model('question_model');
	}

    //public function sitemap()
    //{
    //    $this->load->model('blog_model');
    //    $data['items'] = $this->blog_model->GetBlog(array(),'slug, created_on, tags');
    //    header("Content-Type: text/xml;charset=iso-8859-1");
    //    $this->load->view("sitemap",$data);
    //}

	public function sitemap()
	{
		// APPPATH will automatically figure out the correct path
		include APPPATH.'libraries/SitemapPHP/Sitemap.php';

		// your website url
		$sitemap = new Sitemap('http://stackoverflow.solutions');

		// This will also need to be set by you.
		// the full server path to the sitemap folder
		//$sitemap->setPath('/home/powerbit/mybackup/script/mybackup/plan/');
		$sitemap->setPath('/home/powerbit/public_html/stackoverflow.solutions/sitemap/');

		// the name of the file that is being written to
		$sitemap->setFilename('sitemap');

		// etc etc etc
		$sitemap->addItem('/welcome');

		$result = $this->question_model->get_public();
		foreach ($result as $question) {
			$sitemap->addItem('/question/show_question_details/' . $question->id, '0.6', 'weekly', $question->updated_at);
		}

		$sitemap->createSitemapIndex('http://stackoverflow.solutions/sitemap/', 'Today');
	}
}
?>