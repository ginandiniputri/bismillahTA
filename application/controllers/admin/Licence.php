<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Licence extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_licence');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['v_content']  = 'member/licence/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_licence->getAll();
		$data['v_content']  = 'member/licence/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_licence->getLicenceId($id);
		$data['v_content']  = 'member/licence/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$dataArray = array(
			"licence_name"		=> $post['licence_name'],
			"description"		=> $post['description'],
		);
		$insert = $this->db->insert("licence",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/licence/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/licence/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		$dataArray = array(
			"licence_name"		=> $post['licence_name'],
			"description"		=> $post['description'],
		);
		
		$update = $this->db->update("licence",$dataArray,array("licence_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/licence/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/licence/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("licence",array("licence_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/licence/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/licence/daftar'); 
		}
	}
	
}
