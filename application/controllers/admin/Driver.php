<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_driver');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		//$data['dataLevel']	= $this->M_pengguna->get_level();
		$data['v_content']  = 'member/driver/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_driver->getAll();
		$data['v_content']  = 'member/driver/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_driver->getDriverId($id);
		$data['v_content']  = 'member/driver/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$dataArray = array(
			"name"			=> $post['name'],
			"gender"		=> $post['gender'],
			"phone"			=> $post['phone'],
			"age"			=> $post['age'],
			"username"		=> $post['username'],
			"password"		=> md5($post['password']),
		);
		$insert = $this->db->insert("driver",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/driver/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/driver/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		if($post['password'] != ""){
			$dataArray = array(
				"name"			=> $post['name'],
				"gender"		=> $post['gender'],
				"phone"			=> $post['phone'],
				"age"			=> $post['age'],
				"username"		=> $post['username'],
				"password"		=> md5($post['password']),
			);
		}else{
			$dataArray = array(
				"name"			=> $post['name'],
				"gender"		=> $post['gender'],
				"phone"			=> $post['phone'],
				"age"			=> $post['age'],
				"username"		=> $post['username'],
			);
		}
		$update = $this->db->update("driver",$dataArray,array("driver_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/driver/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/driver/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("driver",array("driver_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/driver/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/driver/daftar'); 
		}
	}
	
}
