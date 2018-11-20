<?php
class Vehicle_ajax_model extends CI_Model{
	private $db;
	function __construct(){
		parent::__construct();
	}
	
	public function get( $brand_id ){
		$this->db = $this->load->database('default',TRUE);
		$query = "SELECT id, brand_id, name FROM vehicle_make where brand_id =".$brand_id."";
		$QueryResult = $this->db->query( $query );
		if( $QueryResult->num_rows() > 0 ){
			$results = $QueryResult->result_array();
			return $results;
		}else{ return false; }
	}

	
	public function getById( $ID ){
		$this->db = $this->load->database('default',TRUE);
		$query = "SELECT vrt.name AS color_name, vr.register_type, vr.gv_id, vr.van_number,vr.name_code,vr.registration_no,vr.color_id,vr.rfid_dec_no,
			vr.rfid_hex_no,vr.is_active, vr.brand_id, vr.make_id AS brandType, st.id as svID, st.employee_id as employee_id FROM atif.vehicle_registered AS vr
			left join atif.vehicle_brand AS vb
			on( vb.id = vr.brand_id )
			left join atif.vehicle_make AS vm
			on (vm.id = vr.make_id )
			left join atif.vehicle_color AS vc
			on(vc.id = vr.color_id)
			left join atif.vehicle_registered_type AS vrt
			on(vrt.id = vr.register_type)
			left join atif.staff_vehicle AS st
			on(vr.gv_id = st.gv_id)	
			where vr.id = $ID";
		$QueryResult = $this->db->query( $query );
		if( $QueryResult->num_rows() > 0 ){
			$results = $QueryResult->row_array();
			return $results;
		}else{ return false; }
	}
	
}