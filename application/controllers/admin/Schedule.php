<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('m_umum');
		$this->load->model('M_schedule');
		$this->load->model('M_vehicle');
		$this->load->model('M_pilot');
		$this->load->model('M_driver');
		$this->load->model('M_flight_attendant');
    }
	
	public function add(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['list_pilot']	= $this->M_pilot->getAll();
		$data['list_fa']	= $this->M_flight_attendant->getAll();
		$data['list_driver']	= $this->M_driver->getAll();
		$data['dataVehicle']	= $this->M_vehicle->getAll();
		$data['v_content']  = 'member/schedule/add';
		$this->load->view('member/layout', $data);
	}
	
	public function daftar(){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['listData']	= $this->M_schedule->getAll();
		
		$data['v_content']  = 'member/schedule/daftar';
		$this->load->view('member/layout', $data);
	}
	
	public function edit($id){
		$data['userLogin']  = $this->session->userdata('loginData');
		$data['detailData']	= $this->M_schedule->getScheduleId($id);
		$data['detailDataFA']	= $this->M_schedule->getFaId($id);
		
		$data['list_pilot']	= $this->M_pilot->getAll();
		$data['list_fa']	= $this->M_flight_attendant->getAll();
		$data['v_content']  = 'member/schedule/edit';
		$this->load->view('member/layout', $data);
	}
	
	public function doAdd(){
		$post = $this->input->post();
		
		$lembur             = array();

        $to_time = strtotime($post['landing_time']);
        $from_time = strtotime($post['take_off_time']);
        $format = '%02d:%02d';
        $hasil = round(abs($from_time-$to_time ) / 60,2);
        
        $hours = floor($hasil / 60);
        $minutes = ($hasil % 60);

        $hasil2 = sprintf($format, $hours, $minutes);

        $duration        = $hasil2;
		
		$dataArray = array(
			"date"		=> $post['date'],
			"take_off_time"	=> $post['take_off_time'],
			"landing_time"		=> $post['landing_time'],
			"duration"		=> $duration,
			"flight_code"	=>$post['flight_code'],
			"origin_code"	=> $post['origin_code'],
			"destination_code"	=>$post['destination_code'],
			"pilot_id"	=> $post['pilot'],
			"co_pilot_id"	=>$post['co_pilot'],
			"aircraft"	=>$post['aircraft'],
		);
		$insert = $this->db->insert("crew_schedule",$dataArray);
		$id = $this->db->insert_id();
		
		
		$to_time = strtotime($post['pickup_time']);
        $from_time = strtotime($post['arrived_time']);
        $format = '%02d:%02d';
        $hasil = round(abs($from_time-$to_time ) / 60,2);
        
        $hours = floor($hasil / 60);
        $minutes = ($hasil % 60);

        $hasil2 = sprintf($format, $hours, $minutes);

        $durationDriver        = $hasil2;
		
		$dataArray = array(
			"driver_id"		=> $post['driver'],
			"date"		=> $post['date'],
			"pickup_time"	=> $post['pickup_time'],
			"arrived_time"		=> $post['arrived_time'],
			"duration"		=> $durationDriver,
			"vehicle_id"	=> $post['vehicle']
		);
		$insert = $this->db->insert("driver_schedule",$dataArray);
		if($insert){
			$fasCount = count($post['fa']);
			foreach($post['fa'] as $key => $value){
			//foreach ($_POST['fa'] as $key => $value) {
				$datasimpan = array(
										'schedule_id' => $id,
										'fa_id' => $value,
										'occupation' => $post['occupation'][$key],
									);
				$insert = $this->db->insert("crew_schedule_detail",$datasimpan);
				
				$dataArray = array(
				"status"		=>2,
				);
				
				$update = $this->db->update("flight_attendant",$dataArray,array("fa_id" => $value));
				
				/* $pembelian = $this->M_pilot->getFlightPilot($post['pilot']);
				$totalFlight = $pembelian;
				$dataArray = array(
				"total_flight_time"		=>$totalFlight
				);
				
				$update = $this->db->update("pilot",$dataArray,array("pilot_id" => $post['pilot'])); */
			}
			$this->m_umum->generatePesan("Berhasil menambahkan data","berhasil");
			redirect('admin/schedule/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal menambahkan data","gagal");
			redirect('admin/schedule/add'); 
		}
	}
	
	public function doUpdate($id){
		$post = $this->input->post();
        $to_time = strtotime($post['landing_time']);
        $from_time = strtotime($post['take_off_time']);
        $format = '%02d:%02d';
        $hasil = round(abs($from_time-$to_time ) / 60,2);
        
        $hours = floor($hasil / 60);
        $minutes = ($hasil % 60);

        $hasil2 = sprintf($format, $hours, $minutes);

        $duration        = $hasil2;
		
		$delete = $this->db->delete("crew_schedule",array("schedule_id" => $id));
		
		$dataArray = array(
			"date"		=> $post['date'],
			"take_off_time"	=> $post['take_off_time'],
			"landing_time"		=> $post['landing_time'],
			"duration"		=> $duration,
			"flight_code"	=>$post['flight_code'],
			"origin_code"	=> $post['origin_code'],
			"destination_code"	=>$post['destination_code'],
			"pilot_id"	=> $post['pilot'],
			"co_pilot_id"	=>$post['co_pilot'],
			"aircraft"	=>$post['aircraft'],
		);
		$insert = $this->db->insert("crew_schedule",$dataArray);
		$id = $this->db->insert_id();
		if($insert){
			$delete = $this->db->delete("crew_schedule_detail",array("schedule_id" => $id));
			$fasCount = count($post['fa']);
			foreach ($_POST['fa'] as $key => $value) {
				$datasimpan = array(
										'schedule_id' => $id,
										'fa_id' => $value,
										'occupation' => $post['occupation'][$key],
									);
				$insert = $this->db->insert("crew_schedule_detail",$datasimpan);
				
				$dataArray = array(
				"status"		=>2,
				);
				
				$update = $this->db->update("flight_attendant",$dataArray,array("fa_id" => $value));
				
				
			}
			$this->m_umum->generatePesan("Berhasil update data","berhasil");
			redirect('admin/schedule/daftar');
		}else{
			$this->m_umum->generatePesan("Gagal update data","gagal");
			redirect('admin/schedule/daftar'); 
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
