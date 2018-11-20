<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_batch_setup extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id'); 
		$this->user_id = $user_id;

    }


  public function index(){
		$this->load->model('admission/admission_batch_model','abm');
	  
        $this->load->view('gs_files/header');
        $this->load->view('gs_files/main-nav');
        $this->load->view('gs_files/breadcrumb');
				
		

		$data['batch_available'] = $this->abm->get_sp_form_batch_availabe();



		$this->load->view('gs_admission/batch/batch_setup_view',$data);
        $this->load->view('gs_admission/batch/batch_footer');
    }

    public function get_batch_detail(){
    	
    	$this->load->model('admission/admission_batch_model','abm');
    	$batch_category = $this->input->post('batch_caegory');
    	$no_of_slots = $this->input->post('no_of_slots');
    	$batch_detail = $this->abm->sp_form_batch_detail($batch_category);
    	$batch_category_format = str_split($batch_category);


    	//================ Format A-01 ==================//
    	//================================================// 
    	$batch_category_one = $batch_category_format[0];
    	$batch_category_two = $batch_category_format[1];
    	$batch_category_three = $batch_category_format[2];
    	$batch_category_four = '-';
    	$batch_format = $batch_category_one . $batch_category_four.$batch_category_two.$batch_category_three;
    	$no_of_slots_available = $this->abm->available_slots($batch_format);

    	//=====================End=================================//

    	$total_slots = $this->abm->total_slots($batch_format);


    	$html = '';
    	$html .='<div class="modal-content">
                 <div class="modal-header">
                 <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">Batch Details - <strong>'.$batch_category.'</strong> <span class="pull-right">'.$no_of_slots_available[0]->total_slot_available.'/'.$total_slots[0]->total_slot_available.'</span></h4>
                 </div>';
    	$html .= '<div class="modal-body">';
    	$html .= '<p>';
    	$html .= '<table id="BatchListingList" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">';
    	$html .= '<thead>';
    	$html .= '<tr>';
    	$html .= '<th class="valignMiddle">Slot</th>';
        $html .= '<th class="valignMiddle">Default Appointment</th>';
        $html .= '<th class="valignMiddle text-center">Form #</th>';
        $html .= '<th class="">Applicant Name</th>';
        $html .= '<th class="text-center">Revised Batch</th>';
        $html .= '<th class="text-center">Revised Appointment</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach($batch_detail as $detail){
        $html .= '<tr>';
        $html .= '<td>'.$detail->slot.'</td>';
        $html .= '<td>'.$detail->default_appointment.'<input type="hidden" class="batch_slot_id" value="'.$detail->slot_id.'">&nbsp;&nbsp;&nbsp;<input type="time" class="batch_slot_time" value="'.$detail->slot_time.'"></td>';
        $html .= '<td>'.$detail->form_no.'</td>';
        $html .= '<td>'.$detail->applicant_name.'</td>';
        $html .= '<td>'.$detail->revised_batch.'</td>';
        $html .= '<td>'.$detail->revised_appointment.'</td>';
        $html .= '</tr>';
    	}
    	$html .= '</body>';
    	$html .= '</table>';
    	$html .= '</p>';
    	$html .= '</div>';
    	$html .= '<div class="modal-footer">
                  <button id="batch_slot_button" type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>';
    	$html .= '</div>';
    	$html .= '<script>';
    	$html .= '$(document).ready(function() {
 				  $("#BatchListingList").dataTable();
				  });';
		$html .= '</script>';
		$html .= '<style>';
		$html .= '.modal-dialog {
    			  width: 80%;
    			  margin: 10% auto !important;
		}';
		$html .= '</style>';
    	echo $html;
    }

    public function insert_batch_detail(){
    	$grade_id = $this->input->post('grade_id');
    	$this->load->model('admission/admission_batch_model','abm');
    	$batch_code = $this->abm->get_batch_code($grade_id);
    	echo json_encode($batch_code);
    }

   
	public function form_batch_insert(){
        /*var_dump($this->input->post());
        exit;*/
		$this->load->model('admission/admission_batch_model','abm');
		$grade_id = $this->input->post('grade');
		$batch_name = $this->input->post('batch_name');
		$date = $this->input->post('date');
		$start_time = $this->input->post('start_time');
		$end_time = $this->input->post('end_time');
		$no_of_slots = $this->input->post('no_of_slots');
		$duration_per_slot = $this->input->post('duration_per_slot');
		$duration_per_slot = $duration_per_slot .' min';
		$date = date_create($date);
		$date_create = date_format($date,'Y-m-d');

		//Batch ID
		if($grade_id <= 2 || $grade_id == 17){
			$batch_id = 1;
		}else if ($grade_id > 2 && $grade_id <= 14){
			$batch_id = 2;
		}else if($grade_id > 15 && $grade_id <= 16){
			$batch_id = 3;
		}

		$data = array(
			'grade_id' => $grade_id,
			'batch_id' => $batch_id,
			'batch_category' => $batch_name,
			'date' => $date_create,
			'time_start' => $start_time,
			'time_end' => $end_time,
			'no_of_slots' => $no_of_slots,
			'duration_per_slot' => $duration_per_slot,
			'created' => time(),
			'register_by' =>$this->user_id,
			'modified' => time(),
			'modified_by' =>$this->user_id
		);
		$affected_row = $this->abm->save($data);
        $batch_id = $affected_row;


        $endTime = '';

        //===============  AND CASESS =============== //
        //============================================//
	    if(!empty($affected_row) && ($grade_id <= 2 || $grade_id == 17 )){



            for($i = 1 ; $i <= $no_of_slots ; $i ++){


            if($endTime == ''){
                $selectedTime = $start_time;
                $endTime = $selectedTime;
                $endTime = date('h:i:s',strtotime($endTime));            }
            else{
                $selectedTime = $endTime;
                $endTime = strtotime("+15 minutes", strtotime($selectedTime));
                $endTime  = date('h:i:s',$endTime);
            }    
            //$selectedTime = $start_time ;

            //var_dump($endTime);

            $data = array(
                'form_batch_id' => $batch_id,
                'sno' => $i,
                'time_start' => $endTime,
                'admission_form_id'=> '',
                'revised_batch_slot_id'=> '',
                'created' => time(),
                'register_by' => $this->user_id,
                'modified' => time(),
                'modified_by' => $this->user_id
            );

            $row = $this->abm->insert_data('atif_gs_admission._form_batch_slots',$data);
        }


       }


       // ============================== ASO CASESS ======================//
       //=================================================================//

       if(!empty($affected_row) && $grade_id > 2 && $grade_id <= 14 ){

            for($i = 1 ; $i <= $no_of_slots ; $i ++){

            $data = array(
                'form_batch_id' => $batch_id,
                'sno' => $i,
                'time_start' => $start_time,
                'admission_form_id'=> '',
                'revised_batch_slot_id'=> '',
                'created' => time(),
                'register_by' => $this->user_id,
                'modified' => time(),
                'modified_by' => $this->user_id
            );

            $row = $this->abm->insert_data('atif_gs_admission._form_batch_slots',$data);
        }

       }


	}

	public function get_grade(){
		$this->load->model('admission/admission_batch_model','abm');
		$grade_id = $this->input->post('grade_id');
		$where = array(
			'id' => $grade_id
		);
		$select='';
		$grade_name =  $this->abm->get_by_all('atif._grade',$select,$where);
		echo json_encode($grade_name);

	}


    public function update_batch_detail(){

       $this->load->model('admission/admission_batch_model','abm');
       $slot_id = $this->input->post('slot_id');
       $slot_time = $this->input->post('slot_time');

       if(strlen($slot_time==5)){
        $slot_time = $slot_time . ":00";
       }

       $update = array(
        'time_start' => $slot_time
        );

       $where = array(
        'id' => $slot_id
        );

       $aa = $this->abm->update_data('atif_gs_admission._form_batch_slots',$where, $update);
       var_dump($aa);
    }
	
	
		
}