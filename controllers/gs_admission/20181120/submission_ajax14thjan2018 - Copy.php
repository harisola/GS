<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Submission_ajax extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }

	
	/*
	 * --------------------------------------------------------------------
	 * 	Function for get Issuance Form Data and save in table by form no.
	 * --------------------------------------------------------------------
	 */
		public function getFormData(){
			$this->load->model('gs_admission/submission_model', 'SM');
			$form_no = $this->input->post("form_no");
			$result = $this->SM->getDataByFormNo($form_no);
			echo json_encode($result);
		}
    // ------------------------------------------------------ 
	
	
		
	/*
	 * ----------------------------------------------------------
	 * Get Form Batch Slot Grade Wise
	 * ----------------------------------------------------------
	*/
		public function formBatchSlots(){
			$this->load->model('gs_admission/submission_model', 'SM');
			$fbid = (int)$this->input->post("fbid");
			$form_id = (int)$this->input->post("form_id");
			//$slotInfo = $this->SM->getSlots($fbid);
			$slotInfo = $this->SM->getSlots($fbid,$form_id);
			$options = $this->slotOptions($slotInfo);
			$ar = array( "option" => $options );
			echo json_encode(  $ar );
		}	
		
		public function slotOptions($slotInfo){
			$html = '';
			$html .= '<option value="">Select Time*</option>';
			if( !empty($slotInfo) ){
				foreach( $slotInfo as $s ){
					$html .= '<option value='.$s["slotID"].'>'.$s["Duration"].'</option>';
				}
			}
			return $html;
		}
	////////
	
	
	public function availableBatch(){
		$this->load->model('gs_admission/submission_model', 'SM');
		$grade_id = (int)$this->input->post("form_id");
		$batches = $this->SM->batchAvailable($grade_id);
		
		$html = '<table id="" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">';
		$html .= '<tr>';
		$html .= '<th class="valignMiddle">Batch ID</th>';
		$html .= '<th class="valignMiddle">Date</th>';
		$html .= '<th class="valignMiddle">Time</th>';
		$html .= '<th class="text-center">Available slots<br />out of 15</th>';
		$html .= '</tr>';
		
		if(  !empty( $batches ) ){
		foreach( $batches as $b ){
			$html .= '<tr>';
			
			$html .= '<td>';
			$html .= $b["batch_category"];
			$html .= '</td>';
			
			$html .= '<td>';
			$html .= $b["batch_date"];
			$html .= '</td>';
			
			
			$html .= '<td>';
			$html .= $b["time_start"]; 
			$html .= '&nbsp;';
			$html .= 'to';
			$html .= '&nbsp;';
			$html .= $b["time_end"]; 
			$html .= '</td>';
			
			$html .= '<td class="text-center">';
			$html .= $b["available_slots"];
			$html .= '</td>';
			
			$html .= '</tr>';
		}
		}else{
			$html .= '<tr>';
			$html .= '<td colspan="4">';
			$html .= 'No Data Available';
			$html .= '</td>';
			$html .= '</tr>';
		}
					  
		$html .= '</table>';
		
		$return = array("b"=>$html);
		echo json_encode($return);
	}

	
}	