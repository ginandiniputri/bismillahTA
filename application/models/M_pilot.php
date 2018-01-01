<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pilot extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("pilot");
		$this->db->join("licence","licence.licence_id = pilot.licence_id");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getPilotId($id){
		$this->db->select("*");
		$this->db->from("pilot");
		$this->db->join("licence","licence.licence_id = pilot.licence_id");
		$this->db->where("pilot_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function getPilotStandBy(){
		$this->db->select("*");
		$this->db->from("pilot");
		$this->db->where("status",2);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getFlightPilot($id){
		$this->db->select("total_flight_time");
		$this->db->from("pilot");
		$this->db->where("pilot_id",$id);
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
}