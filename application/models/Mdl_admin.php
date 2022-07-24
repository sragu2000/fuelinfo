<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_admin extends CI_Model {
    public function addPetrolRecord(){
        $arr["provider"]=$this->input->post("provider");
        $arr["stationName"]=$this->input->post("stationname");
        $arr["stationAddress"]=$this->input->post("stationaddress");
        $arr["stationPhone"]=$this->input->post("phone");
        $arr["date"]=$this->input->post("date");
        $arr["isBasedOnLastNumber"]=$this->input->post("base");
        $arr["numberRange"]=$this->input->post("lastnumber");
        $arr["district"]=$this->input->post("district");
        $arr["town"]=$this->input->post("town");
        if($this->db->insert('petrolrecord',$arr)){
            return array("message"=>"Record Added Successfully","result"=>true);
        }else{
            return array("message"=>"Failed to add record","result"=>false);
        }
    }
}
