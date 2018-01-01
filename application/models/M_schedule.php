<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_schedule extends CI_Model {
 
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
	
	public function getAll(){
		$this->db->select("*, p.pilot_id, p.name as pilot_name, pl.pilot_id,pl.name as co_pilot_name");
		$this->db->from("crew_schedule cs");
		$this->db->join("pilot p","p.pilot_id = cs.pilot_id");
		$this->db->join("pilot pl","pl.pilot_id = cs.co_pilot_id");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getScheduleId($id){
		$this->db->select("*, `p`.`pilot_id`, `p`.`name` as `pilot_name`, `pl`.`pilot_id` as `co_pilot_id`, `pl`.`name` as `co_pilot_name`,
fa.fa_id, fa.name as fa_name, fa.gender, fa.status, fa.location");
		$this->db->from("crew_schedule cs");
		$this->db->where("cs.schedule_id",$id);
		$this->db->join("pilot p","p.pilot_id = cs.pilot_id");
		$this->db->join("pilot pl","pl.pilot_id = cs.co_pilot_id");
		$this->db->join("crew_schedule_detail csd","csd.schedule_id = cs.schedule_id");
		$this->db->join("flight_attendant fa","fa.fa_id = csd.fa_id");
		
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function getFaId($id){
		$this->db->select("*");
		$this->db->from("crew_schedule_detail csd");
		$this->db->where("schedule_id",$id);
		$this->db->join("flight_attendant fa","fa.fa_id = csd.fa_id");
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function getFADriver($id){
		$sql = "select *
				from flight_attendant fa 
				WHERE fa.fa_id 
				NOT IN (
					SELECT dsc.fa_id
					FROM driver_schedule_detail dsc)
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	
	public function getDriverSchedule(){
		$this->db->select("*");
		$this->db->from("driver_schedule ds");
		$this->db->join("vehicle v","v.vehicle_id = ds.vehicle_id");
		$this->db->where("vehicle v","v.vehicle_id = ds.vehicle_id");
		$query  = $this->db->get();
		$result = $query->result();
		return $result;
	}
	
	public function getDriverScheduleId($id){
		$this->db->select("*");
		$this->db->from("driver_schedule ds");
		$this->db->join("vehicle v","v.vehicle_id = ds.vehicle_id");
		$this->db->where("ds.driver_schedule_id",$id);
		$query  = $this->db->get();
		$result = $query->row();
		return $result;
	}
	
	public function getScheduleApps($date){
		$sql = "select cs.schedule_id,cs.date, cs.flight_code, cs.origin_code, 		cs.take_off_time,cs.destination_code,cs.landing_time, cs.duration
				from crew_schedule cs
				where date = '".$date."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function getScheduleAppsDetailSchedule($id){
		$sql = "select cs.schedule_id,cs.date, cs.flight_code, cs.origin_code, 		cs.take_off_time,cs.destination_code,cs.landing_time, cs.duration 
				from crew_schedule cs
				inner join pilot p ON p.pilot_id = cs.pilot_id
				inner join pilot pl ON pl.pilot_id = cs.co_pilot_id
				where cs.schedule_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function ScheduleInf($id){
		$sql = "select p.name as pilot, pl.name as co_pilot, aircraft, CONCAT(cs.origin_code, ' at ', cs.date,'',cs.take_off_time) as departure,
				CONCAT(cs.destination_code, ' at ', cs.date,' ',cs.landing_time) as arrival, cs.duration

				from crew_schedule cs
				inner join pilot p ON p.pilot_id = cs.pilot_id
				inner join pilot pl ON pl.pilot_id = cs.co_pilot_id
				where cs.schedule_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function ScheduleFA($id){
		$sql = "select fa.name, fa.nationality, fa.gender
				from crew_schedule cs
				inner join crew_schedule_detail csd ON csd.schedule_id = cs.schedule_id
				inner join flight_attendant fa ON fa.fa_id = csd.fa_id
				where cs.schedule_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function ScheduleTransport($id){
		$sql = "select d.name as driver, v.description, v.vehicle_id
				from crew_schedule cs
				inner join driver_schedule ds ON ds.schedule_id = cs.schedule_id
				inner join vehicle v ON v.vehicle_id = ds.vehicle_id
				inner join driver d ON d.driver_id = ds.driver_id
				where cs.schedule_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function getScheduleAppsFA($id){
		$sql = "select cs.schedule_id, d.name as driver_name, csd.occupation, cs.flight_code as flight_number
		from crew_schedule cs
		inner join driver_schedule ds ON ds.schedule_id = cs.schedule_id
		inner join driver d ON d.driver_id = ds.driver_id
		inner join crew_schedule_detail csd ON csd.schedule_id = cs.schedule_id
		where csd.fa_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function getScheduleAcceptFA($id){
		$sql = "select cs.schedule_id,cs.date, cs.flight_code, cs.origin_code, 		cs.take_off_time,cs.destination_code,cs.landing_time, cs.duration 
				from crew_schedule cs
				inner join pilot p ON p.pilot_id = cs.pilot_id
				inner join pilot pl ON pl.pilot_id = cs.co_pilot_id
				inner join crew_schedule_detail csd ON csd.schedule_id = cs.schedule_id
				inner join flight_attendant fa ON fa.fa_id = csd.fa_id
				where cs.schedule_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function getTulisanAtas($id){
		$sql = "select csd.occupation, cs.flight_code
				from crew_schedule cs
				inner join pilot p ON p.pilot_id = cs.pilot_id
				inner join pilot pl ON pl.pilot_id = cs.co_pilot_id
				inner join crew_schedule_detail csd ON csd.schedule_id = cs.schedule_id
				inner join flight_attendant fa ON fa.fa_id = csd.fa_id
				where fa.fa_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	public function ScheduleFAAfterAccept($id){
		$sql = "select fa.name, fa.nationality, fa.gender, fa.location
				from crew_schedule cs
				inner join crew_schedule_detail csd ON csd.schedule_id = cs.schedule_id
				inner join flight_attendant fa ON fa.fa_id = csd.fa_id
				where cs.schedule_id = '".$id."'
				";
		$result = $this->db->query($sql)->result();
		return $result;
	}
	
	
}