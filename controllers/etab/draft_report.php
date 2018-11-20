<?php 
Class Draft_report extends MY_Controller{
	public function __construct(){
		parent::__construct();

		$this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
		$this->data['photo_file'] = '.png';
	}
	public function index(){
		$this->load->model('class_list/class_list_sr_view_model');
		
    	$GradeName = $this->input->get("grade_name");
		$SectionName= $this->input->get("section_name");
		
    	$data['students'] = $this->class_list_sr_view_model->get_all_grade_section_students($GradeName, $SectionName);
		$data['GradeSec'] = $GradeName."-".$SectionName;
		$this->load->view("etab_reports/draft_report/index",$data);
		$this->load->view("etab_reports/draft_report/footer");
	}
}
?>