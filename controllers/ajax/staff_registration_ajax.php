<?php 
Class Staff_registration_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();		
	}

	function index(){		
	}


	function is_exists_name_code(){				
		if(isset($_POST['namecode'])) {		 
		    $nameCode = $_POST['namecode'];
		 
		    $this->load->model('staff/staff_registered_model');
			$is_exists = $this->staff_registered_model->is_exists_name_code($nameCode);

			if($is_exists){
				echo "Found";				
			}else{
				echo "OK";
			}		
		}
	}


	function get_gcid_of_nic(){		
		if(isset($_POST['nic'])) {			
		    $NIC = $_POST['nic'];
		 
		    $this->load->model('staff/staff_registered_model');
			$GCID = $this->staff_registered_model->get_staff_information_of_nic($NIC);

			echo json_encode($GCID);
		}
	}

	public function get_roles_primary(){
		
		$nic = $this->input->post('nic');
		$this->load->model('tif_a/tif_a_model','tif');
		$where = array(
			'nic' => $nic
		);
		$select = '';
		$staff = $this->tif->get_by('atif.staff_registered',$select,$where);
		$GTID = $staff[0]->gt_id;

		$this->load->model('tif_model/tif_a_form_model');

		$staffData = $this->tif_a_form_model->get_StaffInfo($GTID);

		$staff_PR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['pm_report_to']);
		echo json_encode($staff_PR);

		// $staff_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['sc_report_to']);

	}

	public function get_role_secondary(){
		
		$nic = $this->input->post('nic');
		$this->load->model('tif_a/tif_a_model','tif');
		$where = array(
			'nic' => $nic
		);
		$select = '';
		$staff = $this->tif->get_by('atif.staff_registered',$select,$where);
		$GTID = $staff[0]->gt_id;

		$this->load->model('tif_model/tif_a_form_model');

		$staffData = $this->tif_a_form_model->get_StaffInfo($GTID);


		$staff_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['sc_report_to']);

		echo json_encode($staff_SR);

	}
}