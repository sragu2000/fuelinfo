<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_login');
		if($this->Mdl_login->sessionCheck()){
			redirect("home");
		}
	}
	public function index(){
		$this->load->view('vw_login');
	}
	public function userlogin(){
		$flag=$this->Mdl_login->validateLogin();
		if($flag["result"]){
			$this->session->set_userdata("fuelappcurrentuser",$this->input->post('email'));
			if($flag["usertype"]=="admin"){
				$this->session->set_userdata("fuelappusertype","admin");
			}else{
				$this->session->set_userdata("fuelappusertype","user");
			}
		}
		$this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"]));
	}
	private function sendJson($data) {
		$this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
