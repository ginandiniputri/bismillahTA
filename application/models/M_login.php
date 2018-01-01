<?php

class M_login extends CI_Model {

    function checkLogin($username,$password){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get();
        if($query->num_rows()>0){
			$querycheck = $query->row();
			$dataArr = array(
				'UserID'    	=> $querycheck->user_id,
				'Username'  	=> $querycheck->username,
				'NamaUser'  	=> $querycheck->name,
				//'lvlUser'		=> $querycheck->id_level,
				'project_name' 	=> 'JKTOGC',
				'copyright' 	=> '&copy; 2017'
			);
			$this->session->set_userdata('loginData',$dataArr);
            return true;    
        }else{
			$this->session->set_flashdata('GagalLogin', 'Ya');    
            return false;
        }  
    }
	
	public function checkLoginAppsPilot($username,$password){
        $this->db->select('*');
        $this->db->from('pilot');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function checkLoginAppsDriver($username,$password){
        $this->db->select('*');
        $this->db->from('driver');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function checkLoginAppsFA($username,$password){
        $this->db->select('*');
        $this->db->from('flight_attendant');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function checkLoginApps($username,$password){
        $this->db->select('*');
        $this->db->from('pengguna');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
		$query = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
}
