<?php

class Statistics extends CI_Controller
{
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	}

	public function test() {
		$this->load->view('templates/styleCss');
		$this->load->view('templates/header');
		$this->load->view('Statistics/display');
		$this->load->view('templates/footer');
	}
}
