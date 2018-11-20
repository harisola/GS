<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_confirm_tpa extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->model('teachers/report_confirm_tpa_model');
		$this->totalDays = 7;
		$DayLess = 0;
		$Day7 = date('Y-m-d');


		$DayLess--;
		$Day6 = date('Y-m-d', strtotime($DayLess . ' days'));
		if($this->isWeekend($Day6)) {
			$DayLess--;
			$Day6 = date('Y-m-d', strtotime($DayLess . ' days'));
			if($this->isWeekend($Day6)) {
				$DayLess--;
				$Day6 = date('Y-m-d', strtotime($DayLess . ' days'));
			}
		}

		$DayLess--;
		$Day5 = date('Y-m-d', strtotime($DayLess . ' days'));
		if($this->isWeekend($Day5)) {
			$DayLess--;
			$Day5 = date('Y-m-d', strtotime($DayLess . ' days'));
			if($this->isWeekend($Day5)) {
				$DayLess--;
				$Day5 = date('Y-m-d', strtotime($DayLess . ' days'));
			}
		}

		$DayLess--;
		$Day4 = date('Y-m-d', strtotime($DayLess . ' days'));
		if($this->isWeekend($Day4)) {
			$DayLess--;
			$Day4 = date('Y-m-d', strtotime($DayLess . ' days'));
			if($this->isWeekend($Day4)) {
				$DayLess--;
				$Day4 = date('Y-m-d', strtotime($DayLess . ' days'));
			}
		}

		$DayLess--;
		$Day3 = date('Y-m-d', strtotime($DayLess . ' days'));
		if($this->isWeekend($Day3)) {
			$DayLess--;
			$Day3 = date('Y-m-d', strtotime($DayLess . ' days'));
			if($this->isWeekend($Day3)) {
				$DayLess--;
				$Day3 = date('Y-m-d', strtotime($DayLess . ' days'));
			}
		}

		$DayLess--;
		$Day2 = date('Y-m-d', strtotime($DayLess . ' days'));
		if($this->isWeekend($Day2)) {
			$DayLess--;
			$Day2 = date('Y-m-d', strtotime($DayLess . ' days'));
			if($this->isWeekend($Day2)) {
				$DayLess--;
				$Day2 = date('Y-m-d', strtotime($DayLess . ' days'));
			}
		}

		$DayLess--;
		$Day1 = date('Y-m-d', strtotime($DayLess . ' days'));
		if($this->isWeekend($Day1)) {
			$DayLess--;
			$Day1 = date('Y-m-d', strtotime($DayLess . ' days'));
			if($this->isWeekend($Day1)) {
				$DayLess--;
				$Day1 = date('Y-m-d', strtotime($DayLess . ' days'));
			}
		}

		$this->Day[0] = $Day7;
		$this->Day[1] = $Day6;
		$this->Day[2] = $Day5;
		$this->Day[3] = $Day4;
		$this->Day[4] = $Day3;
		$this->Day[5] = $Day2;
		$this->Day[6] = $Day1;

		
		
		$GradeID = 6;
		$this->ConfirmTPA_Grades = $this->report_confirm_tpa_model->getConfirmTPALog_Grades($Day7, $GradeID);

		$this->ConfirmTPA_Day[0] = $this->report_confirm_tpa_model->getConfirmTPALog($Day7, $GradeID);
		$this->ConfirmTPA_Day[1] = $this->report_confirm_tpa_model->getConfirmTPALog($Day6, $GradeID);
		$this->ConfirmTPA_Day[2] = $this->report_confirm_tpa_model->getConfirmTPALog($Day5, $GradeID);
		$this->ConfirmTPA_Day[3] = $this->report_confirm_tpa_model->getConfirmTPALog($Day4, $GradeID);
		$this->ConfirmTPA_Day[4] = $this->report_confirm_tpa_model->getConfirmTPALog($Day3, $GradeID);
		$this->ConfirmTPA_Day[5] = $this->report_confirm_tpa_model->getConfirmTPALog($Day2, $GradeID);
		$this->ConfirmTPA_Day[6] = $this->report_confirm_tpa_model->getConfirmTPALog($Day1, $GradeID);		


		$this->load->view('report/teachers/report_confirm_tpa_view');
		$this->load->view('report/teachers/report_confirm_tpa_footer_orb');
	}


	function isWeekend($date) {
	    return (date('N', strtotime($date)) >= 6);
	}
}
