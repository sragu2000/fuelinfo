<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {

	public function index()
	{
		$this->load->view('vw_header');
		$this->load->view('vw_signup');
		$this->load->view('vw_footer');
	}
}
