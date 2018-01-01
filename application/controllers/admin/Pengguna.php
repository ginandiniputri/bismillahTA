<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_pengguna');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		//$data['dataLevel']	= $this->M_pengguna->get_level();
		$data['v_content']  = 'member/pengguna/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_pengguna->getListPengguna();
		$data['v_content']  = 'member/pengguna/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		//$data['dataLevel']	= $this->M_pengguna->get_level();
		$data['detailData']	= $this->M_pengguna->getListPenggunaId($id);
		$data['v_content']  = 'member/pengguna/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$dataArray = array(
			"name"		=> $post['pengguna'],
			//"id_level"	=> $post['peran'],
			//"email"		=> $post['email'],
			"username"	=> $post['username'],
			"password"	=> md5($post['password']),
			//"tgl_lahir"	=> date("Y-m-d", strtotime($post['tanggal_lahir']))
		);
		$insert = $this->db->insert("user",$dataArray);
		if($insert){
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/pengguna/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/pengguna/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
		
		if($post['password'] != ""){
			$dataArray = array(
				"name"		=> $post['pengguna'],
			//"id_level"	=> $post['peran'],
			//"email"		=> $post['email'],
			"username"	=> $post['username'],
			"password"	=> md5($post['password']),
			//"tgl_lahir"	=> date("Y-m-d", strtotime($post['tanggal_lahir']))
			);
		}else{
			$dataArray = array(
				"nama"		=> $post['pengguna'],
				//"id_level"	=> $post['peran'],
				//"email"		=> $post['email'],
				"username"	=> $post['username'],
				//"tgl_lahir"	=> date("Y-m-d", strtotime($post['tanggal_lahir']))
			);
		}
		$update = $this->db->update("user",$dataArray,array("id_pengguna" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/pengguna/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/pengguna/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("pengguna",array("id_pengguna" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/pengguna/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/pengguna/daftar'); 
		}
	}
	
}
