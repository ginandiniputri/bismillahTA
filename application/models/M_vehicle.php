<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_vehicle extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("vehicle");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getVehicleId($id){
		$this->db->select("*");
		$this->db->from("vehicle");
		$this->db->where("vehicle_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}