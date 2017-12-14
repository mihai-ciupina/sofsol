<?php
$this->load->view('header');
                                  if(isset($page_left)) {
$this->load->view($page_left);                            }

$this->load->view('middle');
                                  if(isset($page_right)) {
$this->load->view($page_right);                           }

$this->load->view('footer');
?>
