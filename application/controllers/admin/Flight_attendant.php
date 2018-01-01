<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Flight_attendant extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_flight_attendant');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/flight_attendant/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_flight_attendant->getAll();
		$data['v_content']  = 'member/flight_attendant/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_flight_attendant->getFAId($id);
		$data['v_content']  = 'member/flight_attendant/edit';
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
			"status"	=> 3,
			"email"		=> $post['email'],
			"username"	=> $post['username'],
			"password"	=> md5($post['password']),
			'foto' 	=> $_FILES['photo']['name'],
		);
		$insert = $this->db->insert("flight_attendant",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/flight_attendant/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/flight_attendant/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		$data['detailData']	= $this->M_flight_attendant->getFAId($id);
		
		if($_FILES['photo']['name']!=""){
			$uploaddir = 'uploads/profil/';
			$uploadfile = $uploaddir . basename($_FILES['photo']['name']);
			move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		}
		
		if(is_null($_FILES['photo']['name']) || empty($_FILES['photo']['name']))
				$_FILES['photo']['name'] = $data['detailData']->foto;
		
		if($post['password'] != ""){
			$dataArray = array(
				"name"		=> $post['name'],
				"gender"	=> $post['gender'],
				"phone"		=> $post['phone'],
				"age"		=> $post['age'],
				"email"		=> $post['email'],
				"username"	=> $post['username'],
				"password"	=> md5($post['password']),
				"foto"		=>$_FILES['photo']['name'],
				);
		}else{
			$dataArray = array(
				"name"		=> $post['name'],
				"gender"	=> $post['gender'],
				"phone"		=> $post['phone'],
				"age"		=> $post['age'],
				"username"	=> $post['username'],
				"foto"		=>$_FILES['photo']['name'],
				);
			
		}
		
		
		
		$update = $this->db->update("flight_attendant",$dataArray,array("fa_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/flight_attendant/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/flight_attendant/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("flight_attendant",array("fa_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/flight_attendant/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/flight_attendant/daftar'); 
		}
	}
	
}
