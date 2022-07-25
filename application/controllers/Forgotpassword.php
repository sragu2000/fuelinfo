<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgotpassword extends CI_Controller {
    public function __construct($config="rest") {
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
		parent::__construct();
		$this->load->model('Mdl_forgotpassword');
	}

	public function index()
	{
		$this->load->view("vw_header");
		$this->load->view("vw_forgotpassword");
		$this->load->view("vw_footer");
	}

    public function resetpass(){
		$email=$this->input->post('email');
		if($this->Mdl_forgotpassword->is_a_person_user($email)){
			$config = array();
			$config['protocol'] = '';
			$config['smtp_host'] = '';
			$config['smtp_user'] = '';
			$config['smtp_pass'] = '';
			$config['smtp_port'] = 587;
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from('fuelinfo@mail.com', 'FUEL INFO ADMIN');
			$this->email->to($email);
			$this->email->subject('Password Reset');
			$resetLink=md5($email).md5($this->getName(20));
			$fullUrl=base_url('forgotpassword/resetrequest/').$resetLink;
			if($this->Mdl_forgotpassword->resetPass($resetLink,$email)){
				$this->email->message("Change your password here: $fullUrl");
				if($this->email->send()){
					$this->sendJson(array("message" =>"Password reset mail has been sent successfully","result"=>true));
				}else{
					//$this->sendJson(array("message" =>"Can't send an email. Please Try again later","result"=>false));
					$this->sendJson(array("message" =>$this->email->print_debugger(),"result"=>false));
				}
			}else{
				$this->sendJson(array("message" =>"0x454 Error Try again later","result"=>false));
			}
		}else{
			$this->sendJson(array("message" =>"Email not found","result"=>false));
		}
	}

    public function getName($n) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $n; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$randomString .= $characters[$index];
		}
		return $randomString;
	}

    private function sendJson($data) {
        $this->output->set_header('Content-Type: application/json; charset=utf-8')->set_output(json_encode($data));
    }

    public function resetrequest($resetText=NULL){
		$user=$this->Mdl_forgotpassword->chkUserOfResetText($resetText);
		//return array("email"=>$query->first_row()->fituseremail,"result"=>true);
		if($user["result"]==true){
			$userEmail=$user["email"];
			$this->session->set_userdata("useremailoffit",$userEmail);
			$this->load->view("vw_header");
			$this->load->view('vw_resetreq');
		}else{
			$this->load->view("vw_header",array("title"=>"Expired"));
			echo "<div class='alert alert-danger'>Password already changed... Link expired !</div>";
		}
	}

    public function submitPass(){
		$newpass = $this->input->post('newpassword');
		if($this->Mdl_forgotpassword->requestToChangePasswordByUserLink($newpass)){
			$this->sendJson(array("message" =>"Password Reset Success","result"=>true));
			$this->session->unset_userdata("useremailoffit");
		}else{
			$this->sendJson(array("message" =>"Password Reset Failed","result"=>false));
		}
	}
}
