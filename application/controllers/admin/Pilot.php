<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pilot extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_schedule');
		$this->load->model('M_pilot');
		$this->load->model('M_licence');
	}
	
	public function add(){
		$data['userLogin']  	= $this->session->userdata('loginData');
		$data['list_licence']	= $this->M_licence->getAll();
		$data['v_content']  	= 'member/pilot/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_pilot->getAll();
		$data['v_content']  = 'member/pilot/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_pilot->getPilotId($id);
		$data['list_licence']	= $this->M_licence->getAll();
		$data['v_content']  = 'member/pilot/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		if($_FILES['photo']['name']!=""){
			$uploaddir = 'uploads/profil/';
			$uploadfile = $uploaddir . basename($_FILES['photo']['name']);
			move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		}
		$dataArray = array(
				"name"		=> $post['name'],
				"gender"	=> $post['gender'],
				"phone"		=> $post['phone'],
				"age"		=> $post['age'],
				"status"	=> 2,
				"username"	=> $post['username'],
				"password"	=> md5($post['password']),
				"licence_id"	=> $post['licence'],
				'photo' 	=> $_FILES['photo']['name'],
			);
			
		
		$insert = $this->db->insert("pilot",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/pilot/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/pilot/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		$data['detailData']	= $this->M_pilot->getPilotId($id);
		
		if($_FILES['photo']['name']!=""){
			$uploaddir = 'uploads/profil/';
			$uploadfile = $uploaddir . basename($_FILES['photo']['name']);
			move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		}
		
		if(is_null($_FILES['photo']['name']) || empty($_FILES['photo']['name']))
				$_FILES['photo']['name'] = $data['detailData']->photo;
		
		if($post['password'] != ""){
			$dataArray = array(
				"name"		=> $post['name'],
				"gender"	=> $post['gender'],
				"phone"		=> $post['phone'],
				"age"		=> $post['age'],
				"status"	=> 2,
				"username"	=> $post['username'],
				"password"	=> md5($post['password']),
				"licence_id"	=> $post['licence'],
				'photo' 	=> $_FILES['photo']['name'],
			);
			
		}else{
			$dataArray = array(
				"name"		=> $post['name'],
				"gender"	=> $post['gender'],
				"phone"		=> $post['phone'],
				"age"		=> $post['age'],
				"status"	=> 2,
				"username"	=> $post['username'],
				"licence_id"	=> $post['licence'],
				'photo' 	=> $_FILES['photo']['name'],
			);
			
		}
		
		$update = $this->db->update("pilot",$dataArray,array("pilot_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/pilot/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/pilot/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("pilot",array("pilot_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/pilot/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/pilot/daftar'); 
		}
	}
	
}
