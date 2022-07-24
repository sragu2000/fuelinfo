<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_login extends CI_Model {
    public function validateLogin(){
        $arr["email"]=$this->input->post('email');
		$arr["password"]=$this->input->post('password');
        $email=$this->input->post('email');
        if($this->db->query("SELECT * FROM userinfo WHERE email='$email'")->num_rows()>0){
            $passwordHash=$this->db->query("Select password from userinfo where email='$email'")->first_row()->password;
            if(password_verify($arr["password"], $passwordHash)){
                $usertype=$this->db->query("Select usertype from userinfo where email='$email'")->first_row()->usertype;
                return array("message"=>"Login Success","result"=>true,"usertype"=>$usertype);
            }else{
                return array("message"=>"Email or Password is Wrong","result"=>false);
            }
        }else{
            return array("message"=>"Account not found! Please Signup","result"=>false);
        }
    }
	public function addnewuser(){
		$arr["firstname"]=$this->input->post('firstname');
		$arr["lastname"]=$this->input->post('lastname');
		$arr["district"]=$this->input->post('district');
		$arr["town"]=$this->input->post('town');
		$arr["email"]=$this->input->post('email');
		$arr["password"]=password_hash($this->input->post('password'),PASSWORD_DEFAULT);
        $email=$this->input->post('email');
        if($this->db->query("SELECT * FROM userinfo WHERE email='$email'")->num_rows()>0){
            return array("message"=>"Email Already exists. Please Signin","result"=>false);
        }else{
            if($this->db->insert('userinfo',$arr)){
                return array("message"=>"SignUp Success","result"=>true);
            }else{
                return array("message"=>"SignUp Failed","result"=>false);
            }
        }
	}
    public function sessionCheck(){
        $session_data = $this->session->get_userdata();
        if (is_null($session_data)) {
          return false;
        }
        else if (empty($session_data['fuelappcurrentuser'])) {
          return false;
        }
        else if ($session_data['fuelappcurrentuser']=="") {
          return false;
        }
        else{
          $ses=$session_data['fuelappcurrentuser'];
          return true;
        }
    }
}
