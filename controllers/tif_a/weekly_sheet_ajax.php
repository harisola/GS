<?php

class Weekly_sheet_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id');
	}

	/*
	@name:Rohail Aslam
	@desc:ajax request posted there
	@methods:get_update()
	@date:Aug 22,2017

	*/

	public function get_update(){
		
		$this->load->model('tif_a/weekly_time_sheet_model','wm');

		$time_flag = $this->input->post('time_flag');  // Either time_in or time_out
		$updated_id = $this->input->post('updated_id');

		if($time_flag == 'time-in'){  //Time In

			$time_in = $this->input->post('time');
			$where = array(
				'id' => $updated_id
			);

			$data = array(
				'time_in' => $time_in
			);

			$updation_status =  $this->wm->updation('atif_gs_events.weekly_time_sheet',$where,$data);

			echo $updation_status;


		}else if($time_flag == 'time-out'){  //Time Out

			$time_out = $this->input->post('time');

			$where = array(
				'id' => $updated_id
			);

			$data = array(
				'time_out' => $time_out
			);

			$updation_status =  $this->wm->updation('atif_gs_events.weekly_time_sheet',$where,$data);

			echo $updation_status;

		}

		
	}
}