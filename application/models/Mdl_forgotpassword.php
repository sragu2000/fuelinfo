<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_forgotpassword extends CI_Model {
    public function is_a_person_user($email){
        if($this->db->query("select * from userinfo where email='$email'")->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    
    public function resetPass($resetText,$email){
        if($this->db->query("UPDATE userinfo SET resetText='$resetText' WHERE email='$email'")){
            return true;
        }else{
            return false;
        }
    }
    
    public function chkUserOfResetText($resetText){
        $query=$this->db->query("SELECT * FROM userinfo WHERE resetText='$resetText'");
        if($query->num_rows()==1){
            return array("email"=>$query->first_row()->email,"result"=>true);
        }else{
            return array("email"=>"","result"=>false);
        }
    }

    public function requestToChangePasswordByUserLink($newpass){
        $newpass= password_hash($newpass,PASSWORD_DEFAULT);
        $email=$_SESSION['useremailoffit'];
        if($this->db->query("UPDATE userinfo SET password='$newpass' WHERE email='$email'")){
            $this->db->query("UPDATE userinfo SET resetText='' WHERE email='$email'");
            return true;
        }else{
            return false;
        }
    }
}
