<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_login');
		$this->load->model('Mdl_admin');
		$usertype=($this->session->get_userdata())["fuelappusertype"];
		if($this->Mdl_login->sessionCheck()==false){
			redirect("login");
		}
		if($usertype!="admin"){
			redirect("home");
		}
	}
	public function index(){
		$this->load->view('vw_header');
		$this->load->view('vw_admin');
		$this->load->view('vw_footer');
	}

	public function addPetrolInfo(){
		$this->load->view('vw_header.php');
		$this->load->view('vw_addpetrolinfo.php');
		$this->load->view('vw_footer.php');
	}

	public function addPetrolRecord(){
		$this->form_validation->set_rules('provider', 'Provider Name', 'required');
		$this->form_validation->set_rules('stationname', 'Station Name', 'required');
		$this->form_validation->set_rules('stationaddress', 'Station Address', 'required');
		$this->form_validation->set_rules('district', 'District', 'required');
		$this->form_validation->set_rules('town', 'Town', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required|integer');
		$this->form_validation->set_rules('date', 'Date', 'required');
		$this->form_validation->set_rules('base', 'Based On', 'required');
		$this->form_validation->set_rules('lastnumber', 'Number Range', 'required');
		if($this->form_validation->run() == TRUE){
			$flag=$this->Mdl_admin->addPetrolRecord();
			$this->sendJson(array("message"=>$flag["message"],"result"=>$flag["result"]));
		}else{
			$this->sendJson(array("message"=>strip_tags(validation_errors()),"result"=>false));
		}
		
	}
	private function sendJson($data) {
		$this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
	}
}
