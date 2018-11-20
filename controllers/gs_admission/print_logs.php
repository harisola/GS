<?php
class print_logs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		// /https://www.codexworld.com/convert-html-to-pdf-in-codeigniter-using-dompdf/
		
        $this->load->model('gs_admission/frontoffice_followup_model', 'ff');
		$this->load->model('gs_admission/comment_log', 'CL');

		if( isset($_GET["form_id"]) )
		{
		$form_id= $_GET["form_id"];
		}else
		{
		$form_id=1;
		}
		

		$fInfo = $this->ff->getFormInfo($form_id);
		$grade_id = $fInfo["grade_id"];
		$this->data["student_name"] = $fInfo["official_name"];
		$this->data["formInfo"] = $fInfo;
		$this->data["formHistory"] = $this->CL->get_log($form_id);
		$this->load->view('gs_admission/print_logs/view_print_logs',$this->data );

		

        
	}



	



}	
		