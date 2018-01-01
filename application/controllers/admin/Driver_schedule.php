<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Driver_schedule extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_schedule');
		$this->load->model('M_vehicle');
		$this->load->model('M_pilot');
		$this->load->model('M_flight_attendant');
    }
	
	public function add(){
		$data['userLogin']  	= $this->session->userdata('loginData');
		$data['dataVehicle']	= $this->M_vehicle->getAll();
		$data['list_pilot']		= $this->M_pilot->getAll();
		$data['list_fa']		= $this->M_schedule->getFADriver();
		$data['v_content']  	= 'member/driver_schedule/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_schedule->getDriverSchedule();
		$data['v_content']  = 'member/driver_schedule/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_driver->getDriverId($id);
		$data['v_content']  = 'member/driver_schedule/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		$to_time = strtotime($post['pickup_time']);
        $from_time = strtotime($post['arrived_time']);
        $format = '%02d:%02d';
        $hasil = round(abs($from_time-$to_time ) / 60,2);
        
        $hours = floor($hasil / 60);
        $minutes = ($hasil % 60);

        $hasil2 = sprintf($format, $hours, $minutes);

        $duration        = $hasil2;
		
		$dataArray = array(
			"date"		=> $post['date'],
			"pickup_time"	=> $post['pickup_time'],
			"arrived_time"		=> $post['arrived_time'],
			"duration"		=> $duration,
			"vehicle_id"	=> $post['vehicle']
		);
		$insert = $this->db->insert("driver_schedule",$dataArray);
		$id = $this->db->insert_id();
		if($insert){
			$fasCount = count($post['fa']);
			foreach ($_POST['fa'] as $key => $value) {
				$datasimpan = array(
										'driver_schedule_id' => $id,
										'fa_id' => $value,
									);
				$insert = $this->db->insert("driver_schedule_detail",$datasimpan);
				
			}
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/driver_schedule/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/driver_schedule/add'); 
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
		$update = $this->db->update("driver_schedule",$dataArray,array("driver_schedule_id" => $id));
		if($update){
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/driver_schedule/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/driver_schedule/daftar'); 
		}
	}
	
	public function doDelete($id){
		$delete = $this->db->delete("driver_schedule",array("driver_schedule_id" => $id));
		if($delete){
			$this->m_umum->generatePesan("Berhasil Delete data","berhasil");
			redirect('admin/driver_schedule/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal Delete data","gagal");
			redirect('admin/driver_schedule/daftar'); 
		}
	}
	
}
