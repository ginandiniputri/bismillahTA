<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicle extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_vehicle');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/vehicle/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_vehicle->getAll();
		$data['v_content']  = 'member/vehicle/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_vehicle->getVehicleId($id);
		$data['v_content']  = 'member/vehicle/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$dataArray = array(
			"vehicle_id"		=> $post['vehicle_id'],
			"capacity"			=> $post['capacity'],
			"description"		=> $post['description'],
		);
		$insert = $this->db->insert("vehicle",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/vehicle/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/vehicle/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		$dataArray = array(
			"vehicle_id"		=> $post['vehicle_id'],
			"capacity"			=> $post['capacity'],
			"description"		=> $post['description'],
		);
		$update = $this->db->update("vehicle",$dataArray,array("vehicle_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/vehicle/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/vehicle/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("vehicle",array("vehicle_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/vehicle/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/vehicle/daftar'); 
		}
	}
	
}
