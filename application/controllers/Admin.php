<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_login');
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
}
