<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_licence extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*");
		$this->db->from("licence");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getLicenceId($id){
		$this->db->select("*");
		$this->db->from("licence");
		$this->db->where("licence_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}

}