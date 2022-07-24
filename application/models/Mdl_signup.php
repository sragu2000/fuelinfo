<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_signup extends CI_Model {
	public function addnewuser(){
		$arr["firstname"]=$this->input->post('firstname');
		$arr["lastname"]=$this->input->post('lastname');
		$arr["district"]=$this->input->post('district');
		$arr["town"]=$this->input->post('town');
		$arr["email"]=$this->input->post('email');
		$arr["usertype"]="user";
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
}
