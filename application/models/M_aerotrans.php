<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_aerotrans extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("aerotrans");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getAerotransId($id){
		$this->db->select("*");
		$this->db->from("aerotrans");
		$this->db->where("aerotrans_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}