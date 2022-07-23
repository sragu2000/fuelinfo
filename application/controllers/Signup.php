<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signup extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_signup');
		$this->load->model('Mdl_login');
		if($this->Mdl_login->sessionCheck()){
			redirect("home");
		}
	}
	public function index()
	{
		$this->load->view('vw_header');
		$this->load->view('vw_signup');
		$this->load->view('vw_footer');
	}
	public function addnewuser(){
		$flag=$this->Mdl_signup->addnewuser();
		$this->sendJson(array("message"=>$flag["message"], "result"=>$flag["result"]));
	}
	private function sendJson($data) {
		$this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
