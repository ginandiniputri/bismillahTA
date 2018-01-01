<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Services extends CI_Controller {
	private $signature; 
	function __construct() {
		parent::__construct ();
		$uri = $this->uri->segment(1);
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper ( array (
				'url',
				'form',
				'language' 
		) );
		$this->load->model ( array (
									'm_api',
									'm_login',
									'M_schedule',
									'M_flight_attendant'
									) 
							);
	}
	
	function index() {
		header ( "location: " . base_url () );
		die ();
	}
		
	function loginPilot(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->m_login->checkLoginAppsPilot($param['username'], $param['password']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function loginDriver(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->m_login->checkLoginAppsDriver($param['username'], $param['password']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function loginFA(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->m_login->checkLoginAppsFA($param['username'], $param['password']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function profilFA(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'username' =>  $this->input->post('username'),
				'password' =>  $this->input->post('password'),
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->m_login->checkLoginAppsFA($param['username'], $param['password']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function updateProfilFA(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'fa_id' 	=>  $this->input->post('fa_id'),
				'email' 	=>  $this->input->post('email'),
				'phone' 	=>  $this->input->post('phone'),
				'name' 		=>  $this->input->post('name'),
				'status' 	=>  $this->input->post('status'),
				'photo' 	=>  $this->input->post('photo'),
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_flight_attendant->updateProfilFA($param, $param['fa_id']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Login berhasil";
				$dataArray ['results']['profile'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Username atau password salah";
				$dataArray ['results']['profile'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	
	
	function listSchedule(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'date' =>  $this->input->post('date'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_schedule->getScheduleApps($param['date']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function scheduleDetail(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'schedule_id' =>  $this->input->post('schedule_id'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_schedule->getScheduleAppsDetailSchedule($param['schedule_id']);
			$data2 = $this->M_schedule->ScheduleInf($param['schedule_id']);
			/* echo $this->db->last_query();
			die; */
			$data3 = $this->M_schedule->ScheduleFA($param['schedule_id']);
			$data4 = $this->M_schedule->ScheduleTransport($param['schedule_id']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['schedule'] = (array) $data;
				$dataArray ['results']['flight_information'] = (array) $data2;
				$dataArray ['results']['list_of_crew'] = (array) $data3;
				$dataArray ['results']['transport'] = (array) $data4;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function emergencyDetail(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'schedule_id' =>  $this->input->post('schedule_id'),
				'fa_id' =>  $this->input->post('fa_id'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_schedule->getTulisanAtas($param['fa_id']);
			$data1 = $this->M_schedule->getScheduleAppsDetailSchedule($param['schedule_id']);
			$data2 = $this->M_schedule->ScheduleInf($param['schedule_id']);
			$data3 = $this->M_schedule->ScheduleFA($param['schedule_id']);
			$data4 = $this->M_schedule->ScheduleTransport($param['schedule_id']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['tulisan_atas'] = (array) $data;
				$dataArray ['results']['schedule'] = (array) $data1;
				$dataArray ['results']['flight_information'] = (array) $data2;
				$dataArray ['results']['list_of_crew'] = (array) $data3;
				$dataArray ['results']['transport'] = (array) $data4;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function notification(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'fa_id' =>  $this->input->post('fa_id'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_schedule->getScheduleAppsFA($param['fa_id']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function emgergencyAfterAccept(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'schedule_id' =>  $this->input->post('schedule_id'),
				'fa_id' =>  $this->input->post('fa_id'),
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_schedule->getScheduleAppsFA($param['fa_id']);
			$data1 = $this->M_schedule->getScheduleAppsDetailSchedule($param['schedule_id'], $param['fa_id']);
			$data2 = $this->M_schedule->ScheduleInf($param['schedule_id']);
			$data3 = $this->M_schedule->ScheduleFAAfterAccept($param['schedule_id']);
			$data4 = $this->M_schedule->ScheduleTransport($param['schedule_id']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['tulisan_atas'] = (array) $data;
				$dataArray ['results']['schedule'] = (array) $data1;
				$dataArray ['results']['flight_information'] = (array) $data2;
				$dataArray ['results']['list_of_crew'] = (array) $data3;
				$dataArray ['results']['transport'] = (array) $data4;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function checkIn(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'fa_id' 		=>  $this->input->post('fa_id')
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_flight_attendant->checkIn($param['fa_id']);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	function accept(){
		$dataArray = array ( 
				'pic' => 'Gina' 
		);
	
		$param = array(
				'fa_id' 		=>  $this->input->post('fa_id'),
				'location' 		=>  $this->input->post('location')
				
		);
		
		$check_require = $this->m_api->requireValidation( $param );
		if ($check_require ['status'] == true) {
			$data = $this->M_flight_attendant->accept($param['fa_id'], $param);
			if($data){
				$dataArray ['results']['status_request'] = "OK";
				$dataArray ['results']['msg'] = "Berhasil";
				$dataArray ['results']['data'] = (array) $data;
				$this->m_api->sendOutput( $dataArray, 200 );
			}else{
				$dataArray ['results']['status_request'] = "NOT_OK";
				$dataArray ['results']['msg'] = "Gagal";
				$dataArray ['results']['data'] = array();
				$this->m_api->sendOutput( $dataArray, 200 ); 
			}
		} else {
			$this->m_api->sendOutput ( $dataArray, 402 ); 
		}
	}
	
	
}