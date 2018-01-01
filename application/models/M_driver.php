<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_driver extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("driver");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getDriverId($id){
		$this->db->select("*");
		$this->db->from("driver");
		$this->db->where("driver_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}