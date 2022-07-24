<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_login');
		$this->load->model('Mdl_home');
		if(! $this->Mdl_login->sessionCheck()){
			redirect("login");
		}
	}
	public function index(){
		$arr=$this->Mdl_home->getTownAndDistrict();
		$this->load->view('vw_header.php');
		if($_SESSION["fuelappusertype"]=="admin"){ $this->load->view("vw_admin.php"); }
		$this->load->view('vw_home.php',$arr);
		$this->load->view('vw_footer.php');

	}

	public function getPetrolDetailsTown(){
		$flag=$this->Mdl_home->getDetailsTown();
		echo $flag;
	}
	public function getPetrolDetailsDistrict(){
		$flag=$this->Mdl_home->getDetailsDistrict();
		echo $flag;
	}
	
}
