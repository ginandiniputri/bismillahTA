<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aerotrans extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_aerotrans');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		//$data['dataLevel']	= $this->M_pengguna->get_level();
		$data['v_content']  = 'member/aerotrans/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_aerotrans->getAll();
		$data['v_content']  = 'member/aerotrans/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_aerotrans->getAerotransId($id);
		$data['v_content']  = 'member/aerotrans/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$dataArray = array(
			"name"			=> $post['name'],
			"gender"		=> $post['gender'],
			"phone"			=> $post['phone'],
		);
		$insert = $this->db->insert("aerotrans",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/aerotrans/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/aerotrans/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		$dataArray = array(
			"name"			=> $post['name'],
			"gender"		=> $post['gender'],
			"phone"			=> $post['phone'],
		);
		$update = $this->db->update("aerotrans",$dataArray,array("aerotrans_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/aerotrans/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/aerotrans/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("aerotrans",array("aerotrans_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/aerotrans/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/aerotrans/daftar'); 
		}
	}
	
}
