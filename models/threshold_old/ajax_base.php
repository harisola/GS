<?php
class Ajax_base extends CI_Model{
	private $dbV;
	function __construct(){
		parent::__construct();
		
	}
	
	public function sMethod($nic,$type){
		$this->dbV = $this->load->database('visitors',TRUE);
		//$query = "SELECT id,name,nic,mobile_phone,purpose,contact_person,contact_department FROM `visitor` WHERE  `nic` = '".$nic."' AND `type_id` = 4";
		$query = "SELECT id,name,nic,mobile_phone,purpose,contact_person,contact_department FROM `visitor` WHERE  `nic` = '".$nic."'";
		
		$result = $this->dbV->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			//$this->dbV->last_query();
			return $results;
		}else{
			return FALSE;
		}
	}
	
	
	public function sMethodMobile($mobilePhone,$type){
		$this->dbV = $this->load->database('visitors',TRUE);
		$query = "SELECT id,name,nic,mobile_phone,purpose,contact_person,contact_department FROM `visitor` WHERE  `mobile_phone` = '".$mobilePhone."'";
		
		$result = $this->dbV->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->row_array();
			//$this->dbV->last_query();
			return $results;
		}else{
			return FALSE;
		}
	}
	
}
?>