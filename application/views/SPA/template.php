<?php

$this->load->view('SPA/header');

if(isset($page_left)) {
  $this->load->view($page_left);
}

$this->load->view('SPA/middle');

if(isset($page_right)) {
  $this->load->view($page_right);
}

$this->load->view('SPA/footer');

?>
