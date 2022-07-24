<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdl_home extends CI_Model {
    public function getDetailsTown(){
        date_default_timezone_set("Asia/Colombo");
        $date=date("Ymd");
        $arr=$this->Mdl_home->getTownAndDistrict();
        $town=$arr["town"];
        $district=$arr["district"];
        $re=$this->db->query("select recordid as id, provider, stationName, district, town, stationAddress,stationPhone, date, isBasedOnLastNumber as numberingDistribution, numberRange as nprange from petrolrecord where date >= $date and town='$town' and district='$district' order by date")->result();
        return json_encode($re,true);
    }
    public function getDetailsDistrict(){
        date_default_timezone_set("Asia/Colombo");
        $date=date("Ymd");
        $arr=$this->Mdl_home->getTownAndDistrict();
        $town=$arr["town"];
        $district=$arr["district"];
        $re=$this->db->query("select recordid as id, provider, stationName, district, town, stationAddress,stationPhone, date, isBasedOnLastNumber as numberingDistribution, numberRange as nprange from petrolrecord where date >= $date and town!='$town' and district='$district' order by date")->result();
        return json_encode($re,true);
    }
    public function getTownAndDistrict(){
        $email=$_SESSION["fuelappcurrentuser"];
        $sql=$this->db->query("select town,district, firstname from userinfo where email='$email'");
        $town=$sql->first_row()->town;
        $district=$sql->first_row()->district;
        $name=$sql->first_row()->firstname;
        return array("town"=>$town,"district"=>$district,"name"=>$name);
    }
}
