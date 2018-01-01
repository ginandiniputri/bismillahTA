<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_flight_attendant extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("flight_attendant");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getFAId($id){
		$this->db->select("*");
		$this->db->from("flight_attendant");
		$this->db->where("fa_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function getFaStandBy(){
		$this->db->select("*");
		$this->db->from("flight_attendant");
		$this->db->where("status",3);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function checkIn($fa_id){
		$data=array('status'=>1);
		$this->db->where('fa_id',$fa_id);
		$this->db->update('flight_attendant',$data);
	}
	
	public function accept($fa_id, $param){
		$data=array('status'=>2,
		'location' => $param['location']);
		$this->db->where('fa_id',$fa_id);
		$this->db->update('flight_attendant',$data);
	}
	
	public function updateProfilFA($param, $id){
		$dataArray = array(
						"email" 	=> $param['email'],
						'phone' 	=> $param['phone'],
						'name' 		=> $param['name'],
						'status' 	=> $param['status'],
						'photo' 	=> $param['photo']
					);
		$update = $this->db->update('flight_attendant',$dataArray,array("fa_id" => $id));
		//$update = $this->db->insert('flight_attendant',$dataArray);
		if($update){
			return  $update;
		}else{
			return false;
		}
	}

	
	
	

}