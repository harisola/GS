<?php
class Master_calendar_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	public function CallBackHtml(){
		$StartDate = $this->input->post("EndDate");
		$endGenWe = $this->input->post("endGenWe"); // Generations week start from first august
		$WEEK_NMUBER = $this->input->post("WEEK_NMUBER"); // Annual Week
		
		//$endGenWe = ( $endGenWe + 1 );
		$d = explode("-", $StartDate );
		
		$CurYear  = (int)$d[0];
		$CurMonth = (int)$d[1];
		$CurDay   = (int)$d[2];
		
		
		
		$numberofmonth=3;
		$three_month_week_number=0;
		for($a=1;$a<$numberofmonth; $a++){
			$three_month_week_number += $this->weeks_in_month($CurYear, $CurMonth, 1);
			if($CurMonth==12){
				$CurMonth=1;
				//$CurYear++;
				//if( $CurMonth==1){ $CurYear++; }
			}else{
				
				$CurMonth++;
			}
		
		}
		$data["GenWe"]=$endGenWe;

		
		$r = $this->week_start_end_by_date( $StartDate, $format = 'Y-m-d');
		$data["WEEK_NMUBER"]= $r["week"];
		
		$EndDate = $r["last_day_of_week"];
		$data['CalenderDates'] = $this->getMasterCalender($StartDate,$EndDate);
		
		//$data["WEEK_NMUBER"]= $WEEK_NMUBER;
		
		$data["Week_Info"] = $r;
		$data["YEAR"]=$CurYear;
		$data["StartDate"]=$StartDate;
		
		$data['three_month_week_number']=$three_month_week_number;
		$data["controller"]=$this;
		$response = $this->load->view('master_calendar/load_html',$data,TRUE);
		$r = array("h"=> $response, "ld" => $EndDate);
		echo json_encode($r);
	}
	
	public function loadHtml(){
		$StartDate = '2017-02-05';
		$EndDate = '2017-04-30';
		$data['CalenderDates'] = $this->getMasterCalender($StartDate,$EndDate);
		$data["controller"]=$this;
		$response = $this->load->view('master_calendar/load_html',$data,TRUE);
		echo $response;
	}
	public function getMasterCalender($StartDate,$EndDate){
		$this->load->model("master_calendar/master_calender","MC");
		return $this->MC->GetDate($StartDate,$EndDate);
	}
	
	/**
	* Get week and its start and ending date
	*
	* @param unknown_type $date
	*/
	public function week_start_end_by_date($date, $format = 'Y-m-d') {
	    //Is $date timestamp or date?
		if (is_numeric($date) AND strlen($date) == 10) {
		$time = $date;
		}else{
		$time = strtotime($date);
		}
		$week['week'] = date('W', $time);
		$week['year'] = date('o', $time);
		$week['year_week'] = date('oW', $time);
		$first_day_of_week_timestamp = strtotime($week['year']."W".str_pad($week['week'],2,"0",STR_PAD_LEFT));
		$week['first_day_of_week'] = date($format, $first_day_of_week_timestamp);
		$week['first_day_of_week_timestamp'] = $first_day_of_week_timestamp;
		$last_day_of_week_timestamp = strtotime($week['first_day_of_week']. " +6 days");
		$week['last_day_of_week'] = date($format, $last_day_of_week_timestamp);
		$week['last_day_of_week_timestamp'] = $last_day_of_week_timestamp;
	    return $week;
	}
	
		
	public function getWeek( $month, $year ){
		$num_of_days = date("t", mktime(0,0,0,$month,1,$year)); 
        $lastday = date("t", mktime(0, 0, 0, $month, 1, $year)); 
        $no_of_weeks = 0; 
        $count_weeks = 0; 
        while($no_of_weeks < $lastday){ 
            $no_of_weeks += 7; 
            $count_weeks++; 
        } 
		return $count_weeks;
	}
	
	public function getIsmlicDateByDate($Date){
		$this->load->model("master_calendar/master_calender","MC");
		$Hi = $this->MC->Get_Hijri_By_Ger($Date);
			if( !empty($Hi)){
				$islami_date = $Hi["islami_date"];
				$Result_Hijri = $this->MC->Get_Events_Hijri_Wise($islami_date);
				if( !empty($Result_Hijri)){
					$HijriDate = $Result_Hijri[0]["Hijri_Date"];
					$HChecking=1;
				}else{
					$HijriDate = $islami_date;
					$HChecking=0;
				}
			}else{ 
				$HijriDate = '';
				$HChecking=0;
			}
		$return = array("HijriDate"=>$HijriDate, "HChecking"=>$HChecking);
		return $return;
	}
	
	/*
	* Create Holiday Parameter HTML
	*/
	function HParamter(){
		$this->load->model("master_calendar/master_calender","MC");
		$dataid = '';
		$dataid = $this->input->post("dataid");
		$MethodT = $this->input->post("MethodT");
		$HijriDateBox = $this->input->post("Hijri_Date");
		
		if( $MethodT == 'NHP'){
			//insertation
			$meth = 1;
			$HChecking = 0;
			
		}else{
			// updatation
			$meth = 2;
			$HChecking = 1;
		}
		
		if( $meth == 2){
			$dataid = (int)$dataid;
			$res = $this->MC->get_event($dataid);
			$IDate = $res["calendar_ID"];
			
			$RtHji = $this->getIsmlicDateByDate($IDate);
			$HijriDate = $RtHji["HijriDate"];
			//$HChecking = $RtHji["HChecking"];
			
			
			$holiday_profile = $res["event_ID"];
			$holiday_title = $res["event_title"];
			$holiday_short_title = $res["event_short_title"];
			$holiday_description = $res["event_description"];
			
		}else{
			$holiday_profile = '';
			$holiday_title = '';
			$holiday_short_title = '';
			$holiday_description = '';
			$Hdt=0;
			$HChecking = 0;
			$HijriDate= $HijriDateBox;
		}
		
		$html = '';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday type';
			$html .= '</div>';
			$UU = '';
			$VU = '';
			$DH = '';
			$PH = '';
			$NPH = '';
			
			$Holidays = $this->MC->Get_All_Event('Holiday');
			
			$html .= '<div class="col-md-9">';
				$html .= '<select name="holiday_profile" id="holiday_profile">';
				if(!empty($Holidays)):
					foreach($Holidays as $h ):
					if($holiday_profile== $h["ID"] ){  $UU='selected'; }else{ $UU=''; }
						$html .= '<option value="'.$h["ID"].'" '.$UU.' >'.$h["cat_name"].'</option>';
					endforeach;
				endif;
				$html .= '</select>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday Title';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<input type="text" placeholder="Holiday Title" name="holiday_title" id="holiday_title" value="'.$holiday_title.'" />';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Short Title';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<input type="text" placeholder="Short Title" name="holiday_short_title" id="holiday_short_title" value="'.$holiday_short_title.'" />';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
		$html .= '<div class="col-md-3" style="padding-top:5px;">';
			$html .= 'Holiday Description';
		$html .= '</div>';
		
		$html .= '<div class="col-md-9">';
		$html .= '<textarea name="holiday_description" id="holiday_description">'.$holiday_description.'</textarea>';
		
		if( $MethodT == 'NHP'){
			$html .= '<input type="hidden" value="'.$dataid.'" name="date_id" id="date_id" />';
			$html .= '<input type="hidden" value="'.$dataid.'" name="HijriDateBox" id="HijriDateBox" />';
		}else{
			$html .= '<input type="hidden" value="'.$dataid.'" name="date_id" id="date_id" />';
			$html .= '<input type="hidden" value="'.$HijriDateBox.'" name="HijriDateBox" id="HijriDateBox" />';
		}
		
		$html .= '<input type="hidden" value="'.$meth.'" name="OpType" id="OpType" />';
		
			
		$html .= '</div>';
		
		
		
		$html .= '</div>';
		
			$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			if( $HChecking==1){
				//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri" checked />';	
				//$html .= '<label for="Reflect_Hijri"> Reflect To Hijri Date </label>';
			}else{
				
				$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';	
				$html .= '<label for="Reflect_Hijri"> Add To Hijri Date </label>';
			}
			
			
		$html .= '</div></div>';
		echo $html;
		
		
	}
	
	
	/*
	* Create Holiday Parameter HTML
	*/
	function HParamterH(){
		
		$this->load->model("master_calendar/master_calender","MC");
		$dataid = '';
		$dataid = $this->input->post("dataid");
		$MethodT = $this->input->post("MethodT");
		$HijriDateBox = $this->input->post("Hijri_Date");
		
		if( $MethodT == 'Hlpara'){
			//insertation
			$meth = 2;
		}else{
			// updatation
			$meth = 1;
		}
		
		if( $meth == 2){
			$dataid = (int)$dataid;
			$res = $this->MC->Get_EventH($dataid);
			//var_dump( $res );
			//$IDate = $res["calendar_ID"];
			//$RtHji = $this->getIsmlicDateByDate($IDate);
			
			$HijriDate = $res["Hijri_Date"];
			$HChecking = 1;
			
			$holiday_profile = $res["event_ID"];
			$holiday_title = $res["event_title"];
			$holiday_short_title = $res["event_short_title"];
			$holiday_description = $res["event_description"];
			
		}else{
			$holiday_profile = '';
			$holiday_title = '';
			$holiday_short_title = '';
			$holiday_description = '';
			$Hdt=0;
			$HChecking = 0;
		}
		
		$html = '';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday type';
			$html .= '</div>';
			$UU = '';
			$VU = '';
			$DH = '';
			$PH = '';
			$NPH = '';
			
			$Holidays = $this->MC->Get_All_Event('Holiday');
			
			$html .= '<div class="col-md-9">';
				$html .= '<select name="holiday_profile" id="holiday_profile">';
				if(!empty($Holidays)):
					foreach($Holidays as $h ):
					if($holiday_profile== $h["ID"] ){  $UU='selected'; }else{ $UU=''; }
						$html .= '<option value="'.$h["ID"].'" '.$UU.' >'.$h["cat_name"].'</option>';
					endforeach;
				endif;
				$html .= '</select>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday Title';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<input type="text" placeholder="Holiday Title" name="holiday_title" id="holiday_title" value="'.$holiday_title.'" />';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Short Title';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<input type="text" placeholder="Short Title" name="holiday_short_title" id="holiday_short_title" value="'.$holiday_short_title.'" />';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
		$html .= '<div class="col-md-3" style="padding-top:5px;">';
			$html .= 'Holiday Description';
		$html .= '</div>';
		
		$html .= '<div class="col-md-9">';
			$html .= '<textarea name="holiday_description" id="holiday_description">'.$holiday_description.'</textarea>';
			$html .= '<input type="hidden" value="'.$dataid.'" name="date_id" id="date_id" />';
			$html .= '<input type="hidden" value="'.$meth.'" name="OpType" id="OpType" />';
			$html .= '<input type="hidden" value="'.$HijriDateBox.'" name="HijriDateBox" id="HijriDateBox" />';
			
		$html .= '</div>';
		
		
		
		$html .= '</div>';
		
			$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			if( $HChecking==1){
			$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri" checked  disabled />';	
			}else{
			$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';	
			}
			
			$html .= '<label for="Reflect_Hijri"> Add To Hijri Date </label>';
		$html .= '</div></div>';
		echo $html;
		
		
	}
	
	
	// Create Staff Parameter Modal html 
	// For add new and edit already created html for Staff parameter Modal
	function SfParamter(){
		$this->load->model("master_calendar/master_calender","MC");
		$dataid = '';
		$dataid = $this->input->post("dataid");
		$MethodT = $this->input->post("MethodT");
		$HijriDateBox = $this->input->post("Hijri_Date");
		
		if( $MethodT == 'NTP'){
			//insertation
			$meth = 1;
			$HChecking = 0;
		}else{
			// updatation
			$meth = 2;
			$HChecking = 1;
		}
		
		if( $meth == 2){
			$dataid = (int)$dataid;
			$res = $this->MC->get_event($dataid);
			
			$IDate = $res["calendar_ID"];
			$RtHji = $this->getIsmlicDateByDate($IDate);
			$HijriDate = $RtHji["HijriDate"];
			//$HChecking = $RtHji["HChecking"];
			//$HChecking = 0;
			
			
			$holiday_profile = $res["event_ID"];
			$holiday_title = $res["event_title"];
			$holiday_short_title = $res["event_short_title"];
			$holiday_description = $res["event_description"];
		}else{
			$holiday_profile = '';
			$holiday_title = '';
			$holiday_short_title = '';
			$holiday_description = '';
			//$HChecking = 0;
			$HijriDate = $HijriDateBox;
		}
		
		$UU = '';
		$VU = '';
		$DH = '';
		
	
		
		$Staff = $this->MC->Get_All_Event('Staff');		
		$html ='';
		$html .='<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Super Profile
		</div>';
		$html .='<div class="col-md-9">';
			$html .='<select name="SuperProfile" id="SuperProfile">';
			foreach($Staff as $s ){
				if( $s["ID"] == $holiday_profile ){
					$se = "selected";
				}else{
					$se = "";
				}
				$html .='<option value="'.$s["ID"].'"  '.$se.'>'.$s["cat_name"].'</option>';
			}
			$html .='</select>';
		$html .='</div>';
	$html .='</div>';
	$html .='<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Title
		</div>
		<div class="col-md-9">
			<input type="text" placeholder="Title" name="SPTitle" id="SPTitle" value="'.$holiday_title.'" />
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Short Title
		</div>
		<div class="col-md-9">
			<input type="text" placeholder="Short Title" name="SPShortTitle" id="SPShortTitle" value="'.$holiday_short_title.'" />
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Description
		</div>
		<div class="col-md-9">
			<textarea name="SPDescription" id="SPDescription">'.$holiday_description.'</textarea>';
			$html .= '<input type="hidden" value="'.$dataid.'" name="date_id_SP" id="date_id_SP" />';
			$html .= '<input type="hidden" value="'.$meth.'" name="OpType" id="OpType" />';
			$html .= '<input type="hidden" value="'.$HijriDateBox.'" name="HijriDateBox" id="HijriDateBox" />';
		$html .= '</div>';
		
		
		
		$html .='</div>';
		
		$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';
			if( $HChecking==1){
				//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri" checked />';	
				//$html .= '<label for="Reflect_Hijri"> Reflect To Hijri Date </label>';
			}else{
				$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';	
				$html .= '<label for="Reflect_Hijri"> Add To Hijri Date </label>';
			}
			
		$html .= '</div></div>';
		echo $html;
	}
	
	
	
	function SfParamterH(){
		$this->load->model("master_calendar/master_calender","MC");
		$dataid = '';
		$dataid = $this->input->post("dataid");
		$MethodT = $this->input->post("MethodT");
		$HijriDate = $this->input->post("Hijri_Date");
		
		if( $MethodT == 'NTP'){
			//insertation
			$meth = 1;
		}else{
			// updatation
			$meth = 2;
		}
		
		if( $meth == 2){
			$dataid = (int)$dataid;
			$res = $this->MC->Get_EventH($dataid);
			//var_dump( $res ); 
			
			
			$HijriDate = $res["Hijri_Date"];
			$HChecking =1;
			
			
			
			$holiday_profile = $res["event_ID"];
			$holiday_title = $res["event_title"];
			$holiday_short_title = $res["event_short_title"];
			$holiday_description = $res["event_description"];
		}else{
			$holiday_profile = '';
			$holiday_title = '';
			$holiday_short_title = '';
			$holiday_description = '';
			$HChecking = 0;
		}
		
		$UU = '';
		$VU = '';
		$DH = '';
		
	
		
		$Staff = $this->MC->Get_All_Event('Staff');		
		$html ='';
		$html .='<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Super Profile
		</div>';
		$html .='<div class="col-md-9">';
			$html .='<select name="SuperProfile" id="SuperProfile">';
			foreach($Staff as $s ){
				if( $s["ID"] == $holiday_profile ){
					$se = "selected";
				}else{
					$se = "";
				}
				$html .='<option value="'.$s["ID"].'"  '.$se.'>'.$s["cat_name"].'</option>';
			}
			$html .='</select>';
		$html .='</div>';
	$html .='</div>';
	$html .='<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Title
		</div>
		<div class="col-md-9">
			<input type="text" placeholder="Title" name="SPTitle" id="SPTitle" value="'.$holiday_title.'" />
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Short Title
		</div>
		<div class="col-md-9">
			<input type="text" placeholder="Short Title" name="SPShortTitle" id="SPShortTitle" value="'.$holiday_short_title.'" />
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Description
		</div>
		<div class="col-md-9">
			<textarea name="SPDescription" id="SPDescription">'.$holiday_description.'</textarea>';
			$html .= '<input type="hidden" value="'.$dataid.'" name="date_id_SP" id="date_id_SP" />';
			$html .= '<input type="hidden" value="'.$meth.'" name="OpType" id="OpType" />';
			
		$html .= '</div>';
		
		
		
		$html .='</div>';
		
		$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';
			if( $HChecking==1){
				$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri" checked disabled />';	
				$html .= '<label for="Reflect_Hijri"> Add To Hijri Date </label>';
			}else{
				//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';	
				//$html .= '<label for="Reflect_Hijri"> Reflect To Hijri Date </label>';
			}
			
		$html .= '</div></div>';
		echo $html;
	}
	
	
	function StdParameter(){
		$html = '';
			$html .= 'Ajax Response will be drag here..';
		echo $html;
	}
	
	function SchFParameter(){
		$this->load->model("master_calendar/master_calender","MC");
		$dataid = '';
		
		$dataid = $this->input->post("dataid");
		$MethodT = $this->input->post("MethodT");
		$HijriDate = $this->input->post("Hijri_Date");
		
		if( $MethodT == 'NSCF'){
			//insertation
			$dd = explode("_",$dataid);
			$dated = date("l, d F Y",strtotime($dd[1]));
			$dated2 = date("Y-m-d",strtotime($dd[1]));
			$meth = 1;
		}else{
			// updatation
			$meth = 2;
		}
		
		if( $meth == 2){
			$dataid = (int)$dataid;
			$res = $this->MC->get_event($dataid);
			
			$IDate = $res["calendar_ID"];
			$RtHji = $this->getIsmlicDateByDate($IDate);
			$HijriDate = $RtHji["HijriDate"];
			$HChecking = $RtHji["HChecking"];
			
			
			//var_dump($res);
			$holiday_profile = $res["event_ID"];
			$ScheduleFolllowupTitle = $res["event_title"];
			$ScheduleFolllowupDate = $res["followup_date"];
			$addfollow = $res["followup_respective_date"];
			$dd = $res["calendar_ID"];
			$dated = date("l, d F Y",strtotime($dd));
			$dated2 = date("Y-m-d",strtotime($dd));
			$OpType=2; // here is for updatation
			$EventID= (int)$dataid;
		}else{
			$ScheduleFolllowupTitle = '';
			$ScheduleFolllowupDate = '';
			$addfollow = 0;
			$OpType=1; // for insertation new record in database
			$EventID=0;
			$HChecking = 0;
		}
		
		
		
	
		$html ='';
		$html .='<style> input[type="checkbox"] { visibility:hidden; }</style>';
		$html .='
		
<div class="modal-header">
  <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Schedule Followup for '.$dated.'</h4>
</div>
<div class="modal-body">
<div class="row">
		<div class="col-md-12 no-padding">
		<div class="col-md-6 no-padding" style="margin-top: 13px !important;border-right: 1px solid #ccc;height: 361px;">
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Title
				</div>
				<div class="col-md-9">
					<input type="text" placeholder="Title" name="ScheduleFolllowupTitle" id="ScheduleFolllowupTitle" value="'.$ScheduleFolllowupTitle.'" />
				</div>
			</div>
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">Followup date</div>
				<div class="col-md-9">
					<input type="text" placeholder="2017-05-01" class="ScheduleFolllowupDate" name="ScheduleFolllowupDate" id="ScheduleFolllowupDate" value="'.$ScheduleFolllowupDate.'" />
				</div>
			</div>
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">&nbsp;</div>
				<div class="col-md-9">';
				if($addfollow==1){
				$html .='<input type="checkbox" name="addfollow" value="1" id="addfollow" checked> <label for="addfollow"> Add followup to the respective date</label>';	
				}else{
				$html .='<input type="checkbox" name="addfollow" value="1" id="addfollow"> <label for="addfollow"> Add followup to the respective date</label>';		
				}
				
				$html .= '<div class="alert alert-danger fade in" id="Respective_Date_CheckBox" style="display:none"><a href="#" class="close" data-dismiss="alert">&times;</a>
						<strong>Error!</strong> Respective date not available</div>';
				
				$html .='</div>';
			$html .='</div><!-- col-md-12 no-padding --> ';
			
			$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';
			if( $HChecking==1){
				//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri" checked />';	
				//$html .= '<label for="Reflect_Hijri"> Reflect To Hijri Date </label>';
			}else{
				//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';	
				//$html .= '<label for="Reflect_Hijri"> Reflect To Hijri Date </label>';
			}
			
			
		$html .= '</div></div>';
			
			
			
			$html .='</div><!-- col-md-6 -->';
			
			
			$html .= $this->Wing_Grade_HTML($EventID,'SF');
			
			
	
	$html .='</div>
	</div>
</div>
<div class="modal-footer">
  <input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Set Followup" id="SetFollowup">
</div>';
	$html .= '<input type="hidden" name="ScheduleFCurrentDate" id="ScheduleFCurrentDate" value="'.$dataid.'" />';
	$html .= '<input type="hidden" name="OpTypeForS" id="OpTypeForS" value="'.$OpType.'" />';
	
	echo $html;
}


// Get Event
public function Category_Event($Cat_Event=NULL){
	$this->load->model("master_calendar/master_calender","MC");
	$return = $this->MC->get_cat_event();
	return $return;
}

// Get Event
public function Category_Event_Eff_Deprt($Cat_Event=NULL){
	$this->load->model("master_calendar/master_calender","MC");
	$return = $this->MC->event_effected_department();
	return $return;
}



function AddNewEventModalHtml(){
	$this->load->model("master_calendar/master_calender","MC");
	$dataid = '';
	
	$dataid = $this->input->post("dataid");
	$MethodT = $this->input->post("MethodT");
	
	
	 $Month_Name  = array(
		"Muharram", "Safar", "Rabiul-Awwal", "Rabi-uthani",
		"Jumadi-ul-Awwal", "Jumadi-uthani", "Rajab", "Shaban",
		"Ramadan", "Shawwal", "Zhul-Qaadha", "Zhul-Hijja"
	);
		
	if(  $this->input->post("Hijri_Date") != NULL) {
		$HijriDate = $this->input->post("Hijri_Date");
		$e = explode("-", $HijriDate );
		$HijriY = $e[0];
		$HijriM = $e[1];
		$HijriD = $e[2];	
		$Hi_Month = $Month_Name[($HijriM-1)];	
		
	}else{
		$HijriDate = '';
		$HijriY = '';
		$HijriM = '';
		$HijriD = '';
		$Hi_Month ='';
	}
	
	
	

		
		
	if( $MethodT == 'AdEnt'){
		//insertation
		$dd = explode("_",$dataid);
		$dated = date("l, d F Y",strtotime($dd[1]));
		$dated2 = date("Y-m-d",strtotime($dd[1]));
		$meth = 1;
		$Hijri_Event_He='Y';
	}else{
			// updatation
			$meth = 2;
		}
		
		if( $meth == 2){
			$dataid = (int)$dataid; // here it is ID not date 2017-05-01
			$res = $this->MC->get_event($dataid);
			//var_dump($res); exit;
			$Hijri_Event_He='N';
			if( !empty($res) ){
				$Hijri_Event_He='N';	
			}else{
				$res = $this->MC->Get_EventH($dataid);
				$Hijri_Event_He='Y';
			}
			
			$IDate = $res["calendar_ID"];
			$RtHji = $this->getIsmlicDateByDate($IDate);
			$HijriDate = $RtHji["HijriDate"];
			$HChecking = $RtHji["HChecking"];
			
			
			$holiday_profile = $res["event_ID"];
			$holiday_title = $res["event_title"];
			$holiday_short_title = $res["event_short_title"];
			$holiday_description = $res["event_description"];
			
			$event_level = $res["event_level"];
			$event_visibilty = $res["event_visibilty"];
			
			$EventID = $res["ID"]; // 
			
			$dd = $res["calendar_ID"];
			$dated = date("l, d F Y",strtotime($dd));
			$dated2 = date("Y-m-d",strtotime($dd));
			
			
			
			$event_start_time = $res["event_start_time"];
			$event_end_time = $res["event_end_time"];
			
			$full_day_event = $res["full_day_event"];
			$hiddenEventID = $dataid;
			
			
		}else{
			$holiday_profile = '';
			$holiday_title = '';
			$holiday_short_title = '';
			$holiday_description = '';
			
			$event_level = '';
			$event_visibilty = '';
			
			
			$event_start_time = 4;
			$event_end_time = 4;
			$full_day_event = '';
			$hiddenEventID=0;
			$EventID = 0;
			$HChecking =0;
			
		}
		if( $full_day_event == 1 ){
			$checked = "checked";
		}else{ $checked = ""; }
		
		
		
		$UU = '';
		$VU = '';
		$DH = '';
		
		if($event_level != '' ){
			switch($event_level){
				case 1 : $UU = 'selected'; break;
				case 2 : $VU = 'selected'; break;
				case 3 : $DH = 'selected'; break;
			}
		}
		
		
		$EV1 = '';
		$EV2 = '';
		$EV3 = '';
		$EV3 = '';
		$EV4 = '';
		
		if($event_visibilty != '' ){
			switch($event_visibilty){
				case 1 : $EV1 = 'selected'; break;
				case 2 : $EV2 = 'selected'; break;
				case 3 : $EV3 = 'selected'; break;
				case 4 : $EV4 = 'selected'; break;
			}
		}
		
		
		$Category_Event = $this->Category_Event();
		
		date_default_timezone_set("Asia/Karachi");
		
		$html='';
		$html .='<style> input[type="checkbox"] { visibility:hidden; }</style>';
		$html .='<div class="modal-header">
<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Add New Event - '.$dated.' <span style="float:right;">'.$HijriD.", ".$Hi_Month." ". $HijriY.'</span></h4>
</div>
<div class="modal-body">
<div class="row">
  
	<div class="col-md-12 no-padding paddinTop20">
		<div class="col-md-6 border-right">
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:0px;">
					Event Category
				</div><!-- col-md-3 -->
				<div class="col-md-9">';
					$html .='<select id="EventCategory">';
					  $html .='<option value="0">Select</option>';
					  if( !empty($Category_Event) ):
					  foreach($Category_Event as $cat):
					  if( $cat["ID"] == $holiday_profile){ $se = "selected"; }else{ $se = ""; }
					  $html .='<option value="'.$cat["ID"].'" '.$se.'>'.$cat["cat_name"].'</option>';
					  endforeach;
					  endif;
					$html .='</select>';
				$html .='</div>
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Title
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<input type="text" placeholder="Event Title" name="EventTitle" id="EventTitle" value="'.$holiday_title.'" />
					<input type="hidden" name="hiddenEventID" id="hiddenEventID" value="'.$hiddenEventID.'" />
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Level
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select id="EventLevel">
					  <option value="0">Select</option>
					  <option value="1" '.$UU.'>Master</option>
					  <option value="2" '.$VU.'>Major</option>
					  <option value="3" '.$DH.'>Minor</option>
					  </select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:0px;">
					Event Visibilty
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select id="EventVisibilty">
					  <option value="0">Select</option>
					  <option value="1" '.$EV1.'>Public</option>
					  <option value="2" '.$EV2.'>Staff</option>
					  <option value="3" '.$EV3.'>Management/Admin</option>
					  <option value="4" '.$EV4.'>Only Me</option>
					</select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Time
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<div class="col-md-5 no-padding">
					<select id="EventTimeStart">
					  <option value="0">Start Time</option>';
					  for($counter=1;$counter<=24; $counter++):
						
						if( $MethodT == 'AdEnt'){
							
							$se = "";
						}else{ 
							if( $counter == date("H",$event_start_time ) ){ $se="selected"; }else{ $se = ""; }
						}
						$html .= '<option value="'.$counter.'" '.$se.'>'.$counter.':00</option>';
					  endfor;
					$html .='</select>
					</div><!-- col-md-5 -->
					<div class="col-md-2 text-center" style="padding-top: 8px;">
						to
					</div><!-- col-md-2 -->
					<div class="col-md-5 no-padding">
					
						<select id="EventTimeEnd">
					  <option value="0">End Time</option>';
					  for($counter=1;$counter<=24; $counter++):
						if( $MethodT == 'AdEnt'){
							$se = "";
						}else{ 
						if( $counter == date("H",$event_end_time ) ){ $se="selected"; }else{ $se = ""; }
						}
					$html .= '<option value="'.$counter.'" '.$se.'>'.$counter.':00</option>';
					  endfor;
					$html .='</select>
					</div><!-- col-md-5 -->
					<div class="col-md-12" style="padding-top: 12px;">
						<input type="checkbox" name="fullday" value="fullday" id="fullday" '.$checked.' />
						<label for="fullday"> Full day event</label>
						
						
					</div><!-- col-md-12 -->
					
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">Event Description</div>
				<div class="col-md-9">
					<textarea id="EventDes">'.$holiday_description.'</textarea>
				</div>
			</div>';
			
			$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			if( $Hijri_Event_He !='Y'){
				//$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri" checked />';	
			}else{
				$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$HijriDate.'" id="Reflect_Hijri"  />';	
				$html .= '<label for="Reflect_Hijri"> Add To Hijri Date </label>';
			}
			
			$html .= '</div></div>';
		
		$html .='</div>';
		
		// Function for Creating Right Side Wing Grade HTML
		$html .= $this->Wing_Grade_HTML($EventID,'NE');
		
		
	$html .= '</div>';
 
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="modal-footer">';
		$html .= '<input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Add Event" id="AddEventButton">';
		$html .= '</div>';
		$html .= '<input type="hidden" value="'.$dataid.'" name="AdNwEnt" id="AdNwEnt" />';
		$html .= '<input type="hidden" value="'.$dated2.'" name="AdNwEntDate" id="AdNwEntDate" />';

		echo $html;
	}
	
	
	
	
function AddNewEventHtmlHijri(){
	
	$this->load->model("master_calendar/master_calender","MC");
	$dataid = '';
	
	$dataid = $this->input->post("dataid"); // 	MonBox_1438-09-02 with Hijri
	$MethodT1 = $this->input->post("MethodT"); // AdEntHijri_2017-06-25
	$Hijri_Date = $this->input->post("Hijri_Date"); 
	
	
	$Gergorian_Date='';
	
	if( $MethodT1 == 'AdEntHijri'){
		$M = explode("_",$MethodT1);
		$MethodT = $M[0];
		$Gergorian_Date = $M[1];
	
		//insertation
		$dd = explode("_",$dataid);
		$dated = $Gergorian_Date;
		$dated2 = $dd[1];
		$dataid = $dd[0]."_".$dated;
		$Hijri_Date=$dd[1];
		$meth = 1;
	}else{
			// updatation
			$meth = 2;
			
		}
		
		if( $meth == 2 || $meth == 1 ){
			$dataid = (int)$dataid; // here it is ID not date 2017-05-01
			$res = $this->MC->Get_EventH($dataid);
			//var_dump($res);
			$holiday_profile = $res["event_ID"];
			$holiday_title = $res["event_title"];
			$holiday_short_title = $res["event_short_title"];
			$holiday_description = $res["event_description"];
			
			$event_level = $res["event_level"];
			$event_visibilty = $res["event_visibilty"];
			
			$EventID = $dataid; // 
			
			$Hijri_Date=$res["Hijri_Date"];
			
			$dd = $res["created"];
			$dated = date("l, d F Y",strtotime($dd));
			$dated2 = date("Y-m-d",strtotime($dd));
			
			
			
			$event_start_time = $res["event_start_time"];
			$event_end_time = $res["event_end_time"];
			
			$full_day_event = $res["full_day_event"];
			$hiddenEventID = $dataid;
			$MethodT = $this->input->post("MethodT"); // AdEntHijri_2017-06-25
			
		}else{
			$holiday_profile = '';
			$holiday_title = '';
			$holiday_short_title = '';
			$holiday_description = '';
			
			$event_level = '';
			$event_visibilty = '';
			
			
			$event_start_time = 4;
			$event_end_time = 4;
			$full_day_event = '';
			$hiddenEventID=0;
			$EventID = 0;
			
		}
		if( $full_day_event == 1 ){
			$checked = "checked";
		}else{ $checked = ""; }
		
		
		
		$UU = '';
		$VU = '';
		$DH = '';
		
		if($event_level != '' ){
			switch($event_level){
				case 1 : $UU = 'selected'; break;
				case 2 : $VU = 'selected'; break;
				case 3 : $DH = 'selected'; break;
			}
		}
		
		
		$EV1 = '';
		$EV2 = '';
		$EV3 = '';
		$EV3 = '';
		$EV4 = '';
		
		if($event_visibilty != '' ){
			switch($event_visibilty){
				case 1 : $EV1 = 'selected'; break;
				case 2 : $EV2 = 'selected'; break;
				case 3 : $EV3 = 'selected'; break;
				case 4 : $EV4 = 'selected'; break;
			}
		}
		
		
		$Category_Event = $this->Category_Event();
		
		date_default_timezone_set("Asia/Karachi");
		
		$html='';
		$html .='<style> input[type="checkbox"] { visibility:hidden; }</style>';
		$html .='<div class="modal-header">
<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Add New Event - '.$Hijri_Date.'</h4>
</div>
<div class="modal-body">
<div class="row">
  
	<div class="col-md-12 no-padding paddinTop20">
		<div class="col-md-6 border-right">
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:0px;">
					Event Category
				</div><!-- col-md-3 -->
				<div class="col-md-9">';
					$html .='<select id="EventCategory">';
					  $html .='<option value="0">Select</option>';
					  if( !empty($Category_Event) ):
					  foreach($Category_Event as $cat):
					  if( $cat["ID"] == $holiday_profile){ $se = "selected"; }else{ $se = ""; }
					  $html .='<option value="'.$cat["ID"].'" '.$se.'>'.$cat["cat_name"].'</option>';
					  endforeach;
					  endif;
					$html .='</select>';
				$html .='</div>
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Title
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<input type="text" placeholder="Event Title" name="EventTitle" id="EventTitle" value="'.$holiday_title.'" />
					<input type="hidden" name="hiddenEventIDH" id="hiddenEventIDH" value="'.$hiddenEventID.'" />
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Level
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select id="EventLevel">
					  <option value="0">Select</option>
					  <option value="1" '.$UU.'>Master</option>
					  <option value="2" '.$VU.'>Major</option>
					  <option value="3" '.$DH.'>Minor</option>
					  </select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:0px;">
					Event Visibilty
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select id="EventVisibilty">
					  <option value="0">Select</option>
					  <option value="1" '.$EV1.'>Public</option>
					  <option value="2" '.$EV2.'>Staff</option>
					  <option value="3" '.$EV3.'>Management/Admin</option>
					  <option value="4" '.$EV4.'>Only Me</option>
					</select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Time
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<div class="col-md-5 no-padding">
					<select id="EventTimeStart">
					  <option value="0">Start Time</option>';
					  for($counter=1;$counter<=24; $counter++):
						
						if( $MethodT == 'AdEntHijri'){
							
							$se = "";
						}else{ 
							if( $counter == date("H",$event_start_time ) ){ $se="selected"; }else{ $se = ""; }
						}
						$html .= '<option value="'.$counter.'" '.$se.'>'.$counter.':00</option>';
					  endfor;
					$html .='</select>
					</div><!-- col-md-5 -->
					<div class="col-md-2 text-center" style="padding-top: 8px;">
						to
					</div><!-- col-md-2 -->
					<div class="col-md-5 no-padding">
					
						<select id="EventTimeEnd">
					  <option value="0">End Time</option>';
					  for($counter=1;$counter<=24; $counter++):
						if( $MethodT == 'AdEntHijri'){
							$se = "";
						}else{ 
						if( $counter == date("H",$event_end_time ) ){ $se="selected"; }else{ $se = ""; }
						}
					$html .= '<option value="'.$counter.'" '.$se.'>'.$counter.':00</option>';
					  endfor;
					$html .='</select>
					</div><!-- col-md-5 -->
					<div class="col-md-12" style="padding-top: 12px;">
						<input type="checkbox" name="fullday" value="fullday" id="fullday" '.$checked.' />
						<label for="fullday"> Full day event</label>
					</div><!-- col-md-12 -->
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">Event Description</div>
				<div class="col-md-9">
					<textarea id="EventDes">'.$holiday_description.'</textarea>
				</div>
			</div>';
				$html .= '<div class="col-md-12" style="padding:10px 0;"><div class="col-md-3" style="padding-top:5px;"></div><div class="col-md-9">';
			$html .= '<input type="checkbox" name="Reflect_Hijri" value="'.$Hijri_Date.'" id="Reflect_Hijri" checked  />';	
			
			
			$html .= '<label for="Reflect_Hijri"> Add To Hijri Date </label>';
		$html .= '</div></div>';
		
		$html .= '</div>';
		
		
		// Function for Creating Right Side Wing Grade HTML
		$html .= $this->Wing_Grade_HTMLH($EventID,'NE');
		
		
	$html .= '</div>';
 
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="modal-footer">';
		$html .= '<input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Add Hijri Event" id="AddEventButtonHijri">';
		$html .= '</div>';
		$html .= '<input type="hidden" value="'.$dataid.'" name="AdNwEntHijri" id="AdNwEntHijri" />';
		$html .= '<input type="hidden" value="'.$dated2.'" name="AdNwEntDateHijri" id="AdNwEntDateHijri" />';

		echo $html;
	}
	
	
	/*
	 * Function for creating right side Wing and its grade HTML
	*/
	public function Wing_Grade_HTML($EventID,$hy){
		$this->load->model("master_calendar/master_calender","MC");
		$db="atif";
		$table="_wing";
		$Wings = $this->MC->get($db,$table,$ID=NULL);
		$display=true;
		$display2=true; 
		if($hy=='NE'){
			$ads_Checkbox="ads_Checkbox";
		}else{ $ads_Checkbox="ads_Checkbox2"; }
		
		$html = '';
		$html .= '<br />';
		$html .= '<div class="col-md-6" id="OlaAccordion">';
		$html .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
				if( !empty($Wings) ):
				 
				 foreach($Wings as $w):
				 $html .= '<div class="panel panel-default">';
				 $headingOne = "heading".$w["id"];
				 $collapse = "collapse".$w["id"];
				 $Starter = "Starter".$w["id"];
				 
				if($display){ $dsp='true';}else{ $dsp='false'; } 
				$dpt = $this->MC->getE($EventID,$w["dname"]);
				
				$html .= '<div class="panel-heading" role="tab" id="'.$headingOne.'">';
				$html .= '<h4 class="panel-title">';
				if( !empty($dpt) ){ 
				$html .= '<input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" id="'.$Starter.'"  checked="checked" /> <label for="'.$Starter.'" class="customCheck"></label>';
				}else{ 
				$html .= '<input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" id="'.$Starter.'"  /> <label for="'.$Starter.'" class="customCheck"></label>';
				}
					
							$html .= '<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$collapse.'" aria-expanded="'.$dsp.'" aria-controls="'.$collapse.'">';
						//	if($display){ 
								$html .= '<i class="more-less glyphicon glyphicon-plus"></i>';
								$html .= '<i class="more-less glyphicon glyphicon-minus"></i>';
						//	}else{ 
								
						//	}
						$html .= '<div class="col-md-10 no-padding">'.$w["dname"].'</div>';
						$html .= '</a>';
					$html .= '</h4>';
				$html .= '</div>';
					
					
					$display=false;
					$ID=$w["id"];
					$table="_wing_grade";
					$WingGrades = $this->MC->getWingGrade($ID,$EventID); // PN, N, KG
					if( !empty($WingGrades) ):
						 if($display2){ $dsp='in';  }else{ $dsp=''; }
						// $html .= '<div id="'.$collapse.'" class="panel-collapse collapse '.$dsp.'" role="tabpanel" aria-labelledby="'.$headingOne.'">';
						$html .= '<div id="'.$collapse.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="'.$headingOne.'">';
							$html .= '<div class="panel-body">';
								$html .= '<ul class="noBullets">';
								foreach($WingGrades as $w):
								
								if( !empty( $w["Event_ID"] )){
									if( $EventID == $w["Event_ID"]){
										$se = "checked";
							$html .= '<li><input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" style="display:;" id="'.$w["dname"].'" checked="checked" /> <label for="'.$w["dname"].'" class="">'.$w["dname"].'</label></li>';
									}else{
							$html .= '<li><input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" style="display:;" id="'.$w["dname"].'"  /> <label for="'.$w["dname"].'" class="">'.$w["dname"].'</label></li>';	
									}
								}else{ 
							$html .= '<li><input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" style="display:;" id="'.$w["dname"].'"  /> <label for="'.$w["dname"].'" class="">'.$w["dname"].'</label></li>';
								}
								
								endforeach;
								$html .= '</ul>';
							$html .= '</div>';
						$html .= '</div>';
						$display2=false;
					endif;
					$html .= '</div>';
				 endforeach;
				
				endif;
				if( $EventID != 0 ){
					$Admins = $this->MC->getDepartment($EventID);
				}else{ $Admins=''; }
				
				$Generosity='';
				$GenU='';
				$Coordination='';
				$Software='';
				$Admin='';
				$DI='';
				$SIS='';
				$Finance='';
				$Operations='';
				
				if(!empty($Admins)){
					foreach($Admins as $Adm ){
						switch($Adm["department_ID"]){
							case 'Generosity': 		$Generosity='checked'; 	break;
							case 'GenU':			$GenU='checked'; 		break;
							case 'Coordination': 	$Coordination='checked'; 	break;
							case 'Software': 		$Software='checked'; break;
							case 'Admin': 			$Admin='checked'; 	break;
							case 'DI':				$DI='checked'; 		break;
							case 'SIS': 			$SIS='checked'; 	break;
							case 'Finance': 		$Finance='checked'; break;
							case 'Operations':  	$Operations='checked'; break;
						}
					}
				}
				
				

				$html .= '<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingFive">
								<h4 class="panel-title">
									<input name="Generosity" value="Generosity" style="display:;" id="Generosity" type="checkbox" class="'.$ads_Checkbox.'" '.$Generosity.'>
									<label for="Generosity" class="customCheck"></label>
									<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										<i class="more-less glyphicon glyphicon-plus"></i>
										<i class="more-less glyphicon glyphicon-minus"></i>
										<div class="col-md-10 no-padding">Generosity</div>
									</a>
								</h4>
							</div><!-- panel-heading -->
							<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" style="height: 0px;">
								<div class="panel-body">
									<ul class="noBullets">
										<li><input name="GenU" value="GenU" style="display:;" id="GenU" type="checkbox" class="'.$ads_Checkbox.'" '.$GenU.'> 
										<label for="GenU" class="">Gen U</label></li>
										<li><input name="Coordination" value="Coordination" style="display:;" id="Coordination" type="checkbox" class="'.$ads_Checkbox.'" '.$Coordination.'> 
										<label for="Coordination" class="">Coordination</label></li>
										<li><input name="Software" value="Software" style="display:;" id="Software" type="checkbox" class="'.$ads_Checkbox.'" '.$Software.'> 
										<label for="Software" class="">Software</label></li>
									</ul>
								</div><!-- panel-body -->
							</div><!-- collapseTwo -->
				</div>';
				
				
				
				
				$html .= '<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingSix">
								<h4 class="panel-title">
									<input name="Admin" value="Admin" style="display:;" id="Admin" type="checkbox" class="'.$ads_Checkbox.'"   '.$Admin.' />
									<label for="Admin" class="customCheck"></label>
									<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
										<i class="more-less glyphicon glyphicon-plus"></i>
										<i class="more-less glyphicon glyphicon-minus"></i>
										<div class="col-md-10 no-padding">Admin</div>
									</a>
								</h4>
							</div><!-- panel-heading -->
							<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" style="height: 0px;">
								<div class="panel-body">
									<ul class="noBullets">
										<li><input name="DI" value="DI" style="display:;" id="DI" type="checkbox" class="'.$ads_Checkbox.'"  '.$DI.'> <label for="DI" class="">DI</label></li>
										<li><input name="SIS" value="SIS" style="display:;" id="SIS" type="checkbox" class="'.$ads_Checkbox.'"  '.$SIS.'> <label for="SIS" class="">SIS</label></li>
										<li><input name="Finance" value="Finance" style="display:;" id="Finance" type="checkbox" class="'.$ads_Checkbox.'"  '.$Finance.'> <label for="Finance" class="">Finance</label></li>
										<li><input name="Operations" value="Operations" style="display:;" id="Operations" type="checkbox" class="'.$ads_Checkbox.'"  '.$Operations.'> <label for="Operations" class="">Operations</label></li>
									</ul>
								</div><!-- panel-body -->
							</div><!-- collapseThree -->
						</div>';				
				
					
					
			$html .= '</div>';
		$html .= '</div><!--// End OlaAccordion--> ';
		return $html;
	}
	/* End Wing Grade HTML*/
	
	
	
	
	
	
	
		/*
	 * Function for creating right side Wing and its grade HTML
	*/
	public function Wing_Grade_HTMLH($EventID,$hy){
		$this->load->model("master_calendar/master_calender","MC");
		$db="atif";
		$table="_wing";
		$Wings = $this->MC->get($db,$table,$ID=NULL);
		$display=true;
		$display2=true; 
		if($hy=='NE'){
		$ads_Checkbox="ads_Checkbox";
		}else{ $ads_Checkbox="ads_Checkbox2"; }
		
		$html = '';
		$html .= '<br />';
		$html .= '<div class="col-md-6" id="OlaAccordion">';
			$html .= '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
				if( !empty($Wings) ):
				 
				 foreach($Wings as $w):
				 $html .= '<div class="panel panel-default">';
				 $headingOne = "heading".$w["id"];
				 $collapse = "collapse".$w["id"];
				 $Starter = "Starter".$w["id"];
				 
				if($display){ $dsp='true';}else{ $dsp='false'; } 
				$dpt = $this->MC->getEH($EventID,$w["dname"]);
				if( !empty($dpt) ){ $Main_CheckBox="checked='checked'"; }else{ $Main_CheckBox=""; }
				$html .= '<div class="panel-heading" role="tab" id="'.$headingOne.'">';
					$html .= '<h4 class="panel-title">';
							$html .= '<input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" id="'.$Starter.'"  '.$Main_CheckBox.'/> <label for="'.$Starter.'" class="customCheck"></label>';
							$html .= '<a class="titleColl" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$collapse.'" aria-expanded="'.$dsp.'" aria-controls="'.$collapse.'">';
							if($display){ 
								$html .= '<i class="more-less glyphicon glyphicon-minus"></i>';
							}else{ 
								$html .= '<i class="more-less glyphicon glyphicon-plus"></i>';
							}
						$html .= '<div class="col-md-10 no-padding">'.$w["dname"].'</div>';
						$html .= '</a>';
					$html .= '</h4>';
				$html .= '</div>';
					
					
					$display=false;
					$ID=$w["id"];
					$table="_wing_grade";
					$WingGrades = $this->MC->getWingGradeH($ID,$EventID); // PN, N, KG
					if( !empty($WingGrades) ):
						 if($display2){ $dsp='in';  }else{ $dsp=''; }
						$html .= '<div id="'.$collapse.'" class="panel-collapse collapse '.$dsp.'" role="tabpanel" aria-labelledby="'.$headingOne.'">';
							$html .= '<div class="panel-body">';
								$html .= '<ul class="noBullets">';
								foreach($WingGrades as $w):
								
								if( !empty( $w["Event_ID"] )){
									if( $EventID == $w["Event_ID"]){
										$se = "checked='checked'";
									}else{ $se = ""; }
								}else{ $se = ""; }
								$html .= '<li><input type="checkbox" class="'.$ads_Checkbox.'" name="'.$w["dname"].'" value="'.$w["dname"].'" style="display:;" id="'.$w["dname"].'" '.$se.' /> <label for="'.$w["dname"].'" class="">'.$w["dname"].'</label></li>';
								endforeach;
								$html .= '</ul>';
							$html .= '</div>';
						$html .= '</div>';
						$display2=false;
					endif;
					$html .= '</div>';
				 endforeach;
				
				endif;
				if( $EventID != 0 ){
					$Admins = $this->MC->getDepartmentH($EventID);
				}else{ $Admins=''; }
				
				$Generosity='';
				$GenU='';
				$Coordination='';
				$Software='';
				$Admin='';
				$DI='';
				$SIS='';
				$Finance='';
				$Operations='';
				
				if(!empty($Admins)){
					foreach($Admins as $Adm ){
						switch($Adm["department_ID"]){
							case 'Generosity': 		$Generosity='checked'; 	break;
							case 'GenU':			$GenU='checked'; 		break;
							case 'Coordination': 	$Coordination='checked'; 	break;
							case 'Software': 		$Software='checked'; break;
							case 'Admin': 			$Admin='checked'; 	break;
							case 'DI':				$DI='checked'; 		break;
							case 'SIS': 			$SIS='checked'; 	break;
							case 'Finance': 		$Finance='checked'; break;
							case 'Operations':  	$Operations='checked'; break;
						}
					}
				}
				
				

				$html .= '<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingFive">
								<h4 class="panel-title">
									<input name="Generosity" value="Generosity" style="display:;" id="Generosity" type="checkbox" class="'.$ads_Checkbox.'" '.$Generosity.'>
									<label for="Generosity" class="customCheck"></label>
									<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										<i class="more-less glyphicon glyphicon-plus"></i>
										<i class="more-less glyphicon glyphicon-minus"></i>
										<div class="col-md-10 no-padding">Generosity</div>
									</a>
								</h4>
							</div><!-- panel-heading -->
							<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive" style="height: 0px;">
								<div class="panel-body">
									<ul class="noBullets">
										<li><input name="GenU" value="GenU" style="display:;" id="GenU" type="checkbox" class="'.$ads_Checkbox.'" '.$GenU.'> 
										<label for="GenU" class="">Gen U</label></li>
										<li><input name="Coordination" value="Coordination" style="display:;" id="Coordination" type="checkbox" class="'.$ads_Checkbox.'" '.$Coordination.'> 
										<label for="Coordination" class="">Coordination</label></li>
										<li><input name="Software" value="Software" style="display:;" id="Software" type="checkbox" class="'.$ads_Checkbox.'" '.$Software.'> 
										<label for="Software" class="">Software</label></li>
									</ul>
								</div><!-- panel-body -->
							</div><!-- collapseTwo -->
				</div>';
				
				
				
				
				$html .= '<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="headingSix">
								<h4 class="panel-title">
									<input name="Admin" value="Admin" style="display:;" id="Admin" type="checkbox" class="'.$ads_Checkbox.'"   '.$Admin.' />
									<label for="Admin" class="customCheck"></label>
									<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
										<i class="more-less glyphicon glyphicon-plus"></i>
										<i class="more-less glyphicon glyphicon-minus"></i>
										<div class="col-md-10 no-padding">Admin</div>
									</a>
								</h4>
							</div><!-- panel-heading -->
							<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix" style="height: 0px;">
								<div class="panel-body">
									<ul class="noBullets">
										<li><input name="DI" value="DI" style="display:;" id="DI" type="checkbox" class="'.$ads_Checkbox.'"  '.$DI.'> <label for="DI" class="">DI</label></li>
										<li><input name="SIS" value="SIS" style="display:;" id="SIS" type="checkbox" class="'.$ads_Checkbox.'"  '.$SIS.'> <label for="SIS" class="">SIS</label></li>
										<li><input name="Finance" value="Finance" style="display:;" id="Finance" type="checkbox" class="'.$ads_Checkbox.'"  '.$Finance.'> <label for="Finance" class="">Finance</label></li>
										<li><input name="Operations" value="Operations" style="display:;" id="Operations" type="checkbox" class="'.$ads_Checkbox.'"  '.$Operations.'> <label for="Operations" class="">Operations</label></li>
									</ul>
								</div><!-- panel-body -->
							</div><!-- collapseThree -->
						</div>';				
				
					
					
			$html .= '</div>';
		$html .= '</div><!--// End OlaAccordion--> ';
		return $html;
	}
	/* End Wing Grade HTML*/
	
	
	
	
	function ViewMoreHereEvent(){
		$this->load->model("master_calendar/master_calender","MC");
		$Request_ = $this->input->post("dataid");
		$r = explode("_",$Request_);
		$Request_Date = $r[1];
		$MethodT = $this->input->post("MethodT");
		$Hijri_Date = $this->input->post("Hijri_Date");
		
		$results = $this->MC->get_events($Request_Date);
		$Result_Hijri = $this->MC->Get_Events_Hijri_Wise($Request_Date);
		
		
		
		date_default_timezone_set('Asia/Karachi');
	$html ='<table class="table table-striped">';
		$html .='<thead>';
			$html .='<tr>';
				
				$html .='<th>Type</th>';
				$html .='<th>Title</th>';
				$html .='<th>Category</th>';
				$html .='<th>Date Time</th>';
			$html .='</tr>';
		$html .='</thead>';
		$html .='<tbody>';
			if( !empty( $results ) ):
			foreach($results as $r):
			$html .='<tr>';
				if($r["Schedule"] == 1 ){
					$html .='<td>Schedule</td>';
				}else{ 
					$html .='<td>'.$r["Type"].'</td>'; 
				}
				$html .='<td>'.$r["Title"].'</td>';
				$html .='<td>'.$r["Category_Name"].'</td>';
				if($r["Schedule"] == 1 ){
					$html .='<td> </td>';
				}else{ 
					$html .='<td>'.date("Y-m-d",$r["Event_Start_Time"]).' @'.date("H:i",$r["Event_Start_Time"]).'-'.date("H:i",$r["Event_End_Time"]).'</td>';
				}
				
				
			$html .='</tr>';
			endforeach;
			endif;
			
			
			if( !empty( $Result_Hijri ) ):
			foreach($Result_Hijri as $r):
			$html .='<tr>';
				if($r["Schedule"] == 1 ){
					$html .='<td>Schedule</td>';
				}else{ 
					$html .='<td>'.$r["Type"].'</td>'; 
				}
				$html .='<td>'.$r["Title"].'</td>';
				$html .='<td>'.$r["Category_Name"].'</td>';
				if($r["Schedule"] == 1 ){
					$html .='<td> </td>';
				}else{ 
					$html .='<td>'.date("Y-m-d",$r["Event_Start_Time"]).' @'.date("H:i",$r["Event_Start_Time"]).'-'.date("H:i",$r["Event_End_Time"]).'</td>';
				}
				
				
			$html .='</tr>';
			endforeach;
			endif;
		$html .='</tbody>';
	$html .='</table>';
	echo $html;	
	}
	
	/*
	* Method for add holiday parameter data	
	*/
	protected $Type='';
	protected $ProfileID = '';
	protected $Title = '';
	protected $STitle = '';
	protected $Des = '';
	protected $OpType = 0;
	protected $DateID = array();
	protected $ProfileType ='';
	protected $EventID=0;
	
	protected $EventVisibilty='';
	protected $EventStartTime ='';
	protected $EventEndTime='';
	protected $FullDayEvent='';
	protected $EventDescription='';
	protected $EventAssginedTo=array();
	protected $ScheduleFollowupDate='';
	protected $FollowupRespectiveDate='';
	protected $hiddenID=0;
	protected $EventDate='';
	protected $Reflect_Hijri='';
	
	public function Save_Event(){
		$this->load->model("master_calendar/master_calender","MC");
		$di = explode("_", $this->DateID);
		$DateID =$di[1];
		$last_id =0;
		$data = array();
		$data_Schedule_Date = array();
		
		
		
		if( $this->Type == 'AddNewEvent' ){
			
			if($this->FullDayEvent=='fullday'){ $fullday=1; }else{ $fullday=0;}
			
			date_default_timezone_set("Asia/Karachi");
			$year  = (int)date("Y",strtotime($DateID));
			$month = (int) date("m",strtotime($DateID));
			$day   = (int)date("d",strtotime($DateID));
			
			$hours = (int)$this->EventStartTime;
			$EventStartTime = mktime($hours,0,0,$month,$day,$year);
			
			$hour = (int)$this->EventEndTime;
			$EventEndTime = mktime($hour,0,0,$month,$day,$year);
			
			
			$data = array(
				"calendar_ID"=>$DateID,
				//$ProfileType=>$this->ProfileID,
				"event_ID"=>$this->ProfileID,
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"event_level"=>$this->STitle,
				"event_visibilty"=>$this->EventVisibilty,
				"event_start_time"=>$EventStartTime,
				"event_end_time"=>$EventEndTime,
				"full_day_event"=>$fullday,
				"event_description"=>$this->Des,
				"created"=>time(),
				"register_by"=>$this->session->userdata("user_id"));
				
			$Data_For_Hijri = array(
				"Hijri_Date"=>$this->Reflect_Hijri,
				"event_ID"=>$this->ProfileID,
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"event_level"=>$this->STitle,
				"event_visibilty"=>$this->EventVisibilty,
				"event_start_time"=>$EventStartTime,
				"event_end_time"=>$EventEndTime,
				"full_day_event"=>$fullday,
				"event_description"=>$this->Des,
				"created"=>time(),
				"register_by"=>$this->session->userdata("user_id"));	
				
				
		}elseif( $this->Type == 'Schedule' ){
			// $this->STitle here we use this variable as date
			// $this->Des here we use this variable as followup_respective_date tiny int
			if( $this->Des == 1){ $followup_respective_date=1; }else{ $followup_respective_date=0; }
			
			$data = array(
				"calendar_ID"=>$DateID,
				"schedule_followup_ID"=>1,
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"followup_date"=>$this->STitle,
				"followup_respective_date"=>$followup_respective_date,
				"created"=>time(),
				"register_by"=>$this->session->userdata("user_id"));
				
			$data_Schedule_Date = array(
				"calendar_ID"=>$this->STitle,
				"schedule_followup_ID"=>1,
				"event_title"=> $this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"created"=>time(),
				"register_by"=>$this->session->userdata("user_id"));
				
			$Data_For_Hijri = array(
				"Hijri_Date"=>$this->Reflect_Hijri,
				"schedule_followup_ID"=>1,
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"followup_date"=>$this->STitle,
				"followup_respective_date"=>$followup_respective_date,
				"created"=>time(),
				"register_by"=>$this->session->userdata("user_id"));	
				
		
		}elseif( $this->Type == 'HolidayH' ){
			
			$data = array( 
					"calendar_ID"=>$DateID,
					//$ProfileType=>$this->ProfileID,
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"created"=>time(),
					"register_by"=>$this->session->userdata("user_id"));
					
			$Data_For_Hijri = array( 
					"Hijri_Date"=>$this->Reflect_Hijri,
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"created"=>time(),
					"register_by"=>$this->session->userdata("user_id"));
					
		}else{
			
			$data = array( 
					"calendar_ID"=>$DateID,
					//$ProfileType=>$this->ProfileID,
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"created"=>time(),
					"register_by"=>$this->session->userdata("user_id"));
					
			$Data_For_Hijri = array( 
					"Hijri_Date"=>$this->Reflect_Hijri,
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"created"=>time(),
					"register_by"=>$this->session->userdata("user_id"));		
		}
		
		$table='calendar_events_managment';
		
		if( $this->Reflect_Hijri == '' ){
			
			$last_id = $this->MC->set($table,$data);
			
			// This is for Schedule Followup For Respective Date
			if( $this->Des == 1 ){
				$Sechule_Id = $this->MC->set($table,$data_Schedule_Date);
			}else{ $Sechule_Id = 0; }
			
			// This is for event belongs to which department
			if( ( !empty( $this->EventAssginedTo ) ) && ( $this->Type == 'AddNewEvent' || $this->Type == 'Schedule') ){
					// Add Event to Domain wise like, event for operation dep, SW Dept, etc
					$table_evt_effc_dept='event_effected_department';
					foreach( $this->EventAssginedTo as $domain):
					$data_domain = array(
								"event_ID"=>$last_id,
								"department_ID"=>$domain,
								"created"=>time(),
								"register_by"=>$this->session->userdata("user_id"));
					$this->MC->set($table_evt_effc_dept,$data_domain);			
					endforeach; // end $domain checkbox
					
					if($Sechule_Id > 0 ){
						foreach( $this->EventAssginedTo as $domain):
						$data_domain = array(
									"event_ID"=>$Sechule_Id,
									"department_ID"=>$domain,
									"created"=>time(),
									"register_by"=>$this->session->userdata("user_id"));
						$this->MC->set($table_evt_effc_dept,$data_domain);			
						endforeach; // end $domain checkbox
					}
				
			}
			
		}else{
			
			
			// Check if Reflect to hijri checkbox is checked
			$table2='calendar_events_managment_hijri_date';
			$last_id = $this->MC->set($table2,$Data_For_Hijri);
			if( ( !empty( $this->EventAssginedTo ) ) && ( $this->Type == 'AddNewEvent' || $this->Type == 'Schedule') ){
					// Add Event to Domain wise like, event for operation dep, SW Dept, etc
					$table_evt_effc_dept2='event_effected_department_hijri_date';
					foreach( $this->EventAssginedTo as $domain):
					$data_domains = array(
								"event_ID"=>$last_id,
								"department_ID"=>$domain,
								"created"=>time(),
								"register_by"=>$this->session->userdata("user_id"));
					$this->MC->set($table_evt_effc_dept2,$data_domains);			
					endforeach; // end $domain checkbox
			}
		}
		return $last_id;
	}
	
	public function UpDate_Event(){
		$this->load->model("master_calendar/master_calender","MC");
	
		
		if( $this->Type =='AddNewEvent'){
			if($this->FullDayEvent=='fullday'){ $fullday=1;}else{ $fullday=0;}
			date_default_timezone_set("Asia/Karachi");
			$DateID= $this->EventDate;
			$year  = date("Y",strtotime($DateID));
			$month = date("m",strtotime($DateID));
			$day   = date("d",strtotime($DateID));
			
			
			$EventStartTime = mktime($this->EventStartTime,1,1,$month,$day,$year);
			$EventEndTime = mktime($this->EventEndTime,1,1,$month,$day,$year);
			
			$data = array(
					//$ProfileType=>$this->ProfileID,
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>substr($this->Title,0,22),
					"event_level"=>$this->STitle,
					"event_visibilty"=>$this->EventVisibilty,
					"event_start_time"=>$EventStartTime,
					"event_end_time"=>$EventEndTime,
					"full_day_event"=>$fullday,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));
					
			$Data_For_Hijri = array(
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>substr($this->Title,0,22),
					"event_level"=>$this->STitle,
					"event_visibilty"=>$this->EventVisibilty,
					"event_start_time"=>$EventStartTime,
					"event_end_time"=>$EventEndTime,
					"full_day_event"=>$fullday,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));		
				
			
			
		}elseif( $this->Type == 'Schedule' ){
			// $this->STitle here we use this variable as date
			// $this->Des here we use this variable as followup_respective_date tiny int
			if( $this->Des == 1){ $followup_respective_date=1; }else{ $followup_respective_date=0; }
			$data = array( 
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"followup_date"=>$this->STitle,
				"followup_respective_date"=>$followup_respective_date,
				"modified"=>time(),
				"modified_by"=>$this->session->userdata("user_id"));
				
				$Data_For_Hijri = array( 
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"followup_date"=>$this->STitle,
				"followup_respective_date"=>$followup_respective_date,
				"modified"=>time(),
				"modified_by"=>$this->session->userdata("user_id"));
				
		
		}elseif( $this->Type == 'HolidayH' ){
			
			$data = array(
					
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));
					
				$Data_For_Hijri = array(
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));	
					
					
		}else{
			$data = array(
					
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));
					
				$Data_For_Hijri = array(
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>$this->STitle,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));	
		}
		
		// Check if Reflect to hijri checkbox is checked
		
		if( $this->Reflect_Hijri == '' ){
			
			$table='calendar_events_managment';
			$where = array('ID' => $this->DateID );
			$EffectedRows = $this->MC->table_update($table,$data,$where);
			
			
			if( ( !empty( $this->EventAssginedTo ) ) && ( $this->Type == 'AddNewEvent' || $this->Type == 'Schedule') ){
					// Add Event to Domain wise like, event for operation dep, SW Dept, etc
					$table_evt_effc_dept='event_effected_department';
					$where2 = array("event_ID"=>$this->DateID);
					$this->MC->table_remove($table_evt_effc_dept,$where2); // update record_deleted to 1 mean removed
					
					foreach( $this->EventAssginedTo as $domain):
						$data_domain = array(
											"event_ID"=>$this->DateID,
											"department_ID"=>$domain,
											"created"=>time(),
											"register_by"=>$this->session->userdata("user_id"));
						$this->MC->set($table_evt_effc_dept,$data_domain);		
					endforeach; // end $domain checkbox
			}
			else{
				$table_evt_effc_dept='event_effected_department';
				$where2 = array("event_ID"=>$this->DateID);
				$this->MC->table_remove($table_evt_effc_dept,$where2); // update record_deleted to 1 mean removed
			}
			
			
		
		
		
			
			
			
		
			
		}else{
			
			$table2='calendar_events_managment_hijri_date';
			$where = array('ID' => $this->DateID );
			$EffectedRows = $this->MC->table_update($table2,$Data_For_Hijri,$where);
			
			
			if( ( !empty( $this->EventAssginedTo ) ) && ( $this->Type == 'AddNewEvent' || $this->Type == 'Schedule') ){
				// Add Event to Domain wise like, event for operation dep, SW Dept, etc
				$table_evt_effc_dept='event_effected_department_hijri_date';
				$where2 = array("event_ID"=>$this->DateID);
				$this->MC->table_remove($table_evt_effc_dept,$where2); // update record_deleted to 1 mean removed
				foreach( $this->EventAssginedTo as $domain):
					$data_domain = array(
										"event_ID"=>$this->DateID,
										"department_ID"=>$domain,
										"created"=>time(),
										"register_by"=>$this->session->userdata("user_id"));
					$this->MC->set($table_evt_effc_dept,$data_domain);		
				endforeach; // end $domain checkbox
			}
			
			
			
		
			
			
		}
		
		return $this->DateID;
	}
	
   /* OpType 1 means add new Holiday Para, Staff Param
    * OpType
	*/
	function db_hp(){
		$this->Type = $this->input->post("OperationType"); // like Holiday, StudentP, StaffP, Schedule AddNewEvent
		
		$this->Title  = $this->input->post("Title"); // title
		$this->STitle = $this->input->post("STitle"); // short title
		$this->OpType = $this->input->post("OpType"); // type 1 form new 2 for updation
		$this->DateID = $this->input->post("DateID"); // date formate like ThuBox_2017-05-25 here we use php explode fuction for getting date
		$this->Des    = $this->input->post("Des");
		
		if( $this->Type == 'Schedule' ){
			$this->EventAssginedTo = $this->input->post("ProfileID"); // here user user this variable as Schedule Followup assigned to domain 
		}else{
			$this->ProfileID = $this->input->post("ProfileID"); // like holiday type ie: UU,VH,DH,PH Staff Super Profile Ramdan June July
		}
		
		$this->Reflect_Hijri = $this->input->post("RH"); // This event reflect to Hijri As Well



		if( $this->OpType == 1){ 
			$last_id = $this->Save_Event();  
			
			$di = explode("_", $this->DateID);
			if(!empty( $di ) ){ $DateID =$di[1]; } else{ $DateID = date("Y-m-d"); }
			$DateID = date("Y-m-d",strtotime($DateID));
			
		}else{
			$last_id = $this->UpDate_Event();	
			
			$this->load->model("master_calendar/master_calender","MC");
			$Row = $this->MC->Get_Event_Date($this->DateID);
			$this->EventDate = $Row["Dated"];
			$DateID= $this->EventDate;
			
		}
		
		
		
		/* Updated Weekly time Sheet */
		if( $this->Type == 'StaffP' ){
			$From_date = $DateID;
			$To_date = $DateID;
			$this->Update_Weekly_Sheet($From_date, $To_date);
		}
		
		$h = array( "lId" => $last_id );
		
		echo json_encode($h);
	}
	
	
	// This function is for event add / edit functionality through database.
	function db_Event(){
		$this->Type = $this->input->post("OperationType");
		$this->ProfileID = $this->input->post("ProfileID"); // here this is event category
		$this->Title = $this->input->post("Title"); // here this is for event title
		$this->STitle = $this->input->post("STitle"); // here this is level
		$this->EventVisibilty = $this->input->post("EventVisibilty"); // 
		$this->EventStartTime = $this->input->post("EventTimeStart"); //
		$this->EventEndTime = $this->input->post("EventTimeEnd"); // 
		$this->FullDayEvent = $this->input->post("fullday"); 
		
		$this->Des = $this->input->post("EventDes");
		$this->OpType = $this->input->post("OpType");
		
		
		
		
		if( $this->input->post("RH") != NULL ){
			$this->Reflect_Hijri =  $this->input->post("RH");
		}else{
			$this->Reflect_Hijri =  '';
		}
		
		
		if( $this->input->post("checkboxs") != NULL ){
			$this->EventAssginedTo = $this->input->post("checkboxs");	
		}else{
			$this->EventAssginedTo = array();
		}
		
		if( $this->OpType == 1 ){ 
			$this->DateID = $this->input->post("DateID");
			$last_id = $this->Save_Event();  
		}else{
			
			$this->DateID = $this->input->post("hiddenID"); // ID For Updation
			$this->EventDate = $this->input->post("AdNwEntDate");
			$this->UpDate_Event();	
			$last_id = $this->DateID;
		}
		$h = array( "lId" => $last_id );
		echo json_encode($h);
	}
	
	public function get_date_header($date){
		$this->load->model("master_calendar/master_calender","MC");
		
		$TueBox=explode("_", $date);
		$date_id = $TueBox[1];
		
		
		$results = $this->MC->get_events($date_id);
		
		//$resultsh = $this->MC->get_events($Get_Events_Hijri_Wise);
		
		
		$TodayDate = date("Y-m-d",time());
		if( $date_id < $TodayDate){ 
			$class1='HolidayParameter3';
			$class2='StaffParameter3';
			$class3='StudentParameter3';
			$class4='ScheduleFollowup3';
			$AddEvent = "AddEventLinkNo";
		}else{ 
			$class1='HolidayParameter';
			$class2='StaffParameter';
			$class3='StudentParameter';
			$class4='ScheduleFollowup';
			$AddEvent = "AddEventLink";
		}
		$html='';
		$holiday_header='H';
		$Holiday_Title='Holiday Parameter';
		$staff_header='TP';
		$Student_header='SP';
		$Schedule_header='SF';
		$Event_Header='NE';
		$style2='';
		
		$Staff_Title='Staff Parameter';
		$Student_Title='Student Parameter';
		$Event_Title='';
		$Schedule_Title='Schedule Followup';
		
		
		if(!empty($results) ):
		
		foreach( $results as $r ):
		if( $r["Type"] != '' ){
			switch( $r["Type"] ){
				case 'Holiday':
					$holiday_header=$r["Short_Title"];
					$Holiday_Title = $r["Title"];
					$class1='HolidayParameter3';
				break;
				case 'Staff': 
					$staff_header=$r["Short_Title"];
					$Staff_Title = $r["Title"];
					$style2="background:#b964dc !important;";
					$class2='StaffParameter3';
				break;
				case 'Student'  : 
					$Student_header=$r["Short_Title"];
					$Student_Title = $r["Title"];
					$class3='StudentParameter3';
				break;
				
				case 'Event' : 
					$Event_Header=$r["Short_Title"];
					$Event_Title = $r["Title"];
				break;
				
				default:
					$Schedule_header=$r["event_short_title"];
					$Schedule_Title = $r["Title"];
			}
		}else{
			$Schedule_header='SF';
			$Schedule_header=strtoupper(substr( $r["Title"] , 0, 2));
			$Schedule_Title=$r["Title"];
			$class4='ScheduleFollowup3';
		}	
			
		endforeach;
		endif;
		
		$HResults = $this->MC->Get_Hijri_By_Ger($date_id);
		if( !empty($HResults) ){
			$Islami_Date = $HResults["islami_date"];
			$Result_Hijri = $this->MC->Get_Events_Hijri_Wise($Islami_Date);	
		}else{
			$Islami_Date = '';
			$Result_Hijri = '';
		}
		
		$html .= '<a class="'.$class1.' HolidayParOn tooltipp"  href="#" data-id="'.$date.'" id="'.$Islami_Date.'">'.$holiday_header.'<span class="tooltipptext" >'.$Holiday_Title.'</span></a>';
		$html .= '<a class="'.$class2.' StaffParOn tooltipp"    href="#" data-id="'.$date.'" style="'.$style2.'" id="'.$Islami_Date.'">'.$staff_header.'<span class="tooltipptext">'.$Staff_Title.'</span></a>';
		$html .= '<a class="'.$class3.' StudentParOn tooltipp"  href="#" data-id="'.$date.'" id="'.$Islami_Date.'">'.$Student_header.'<span class="tooltipptext">'.$Student_Title.'</span></a>';
		$html .= '<a class="'.$class4.' ScheduleFolOn tooltipp" href="#" data-id="'.$date.'" id="'.$Islami_Date.'">'.$Schedule_header.'<span class="tooltipptext">'.$Schedule_Title.'</span></a>';
		$RClass	= array("class1"=>$class1,"class2"=>$class2,"class3"=>$class3,"class4"=>$class4,"AddEvent"=>$AddEvent);
		
		$return = array( "Ht"=>$html,"RClass"=>$RClass , "HD" =>$Result_Hijri  );
		return json_encode($return);
		//return $html;
	}
	
	public function get_date_events($date_id,$MonBox){
		$this->load->model("master_calendar/master_calender","MC");
		$results = $this->MC->get_events($date_id);
		
		$Hi = $this->MC->Get_Hijri_By_Ger($date_id);
		if( !empty($Hi)){
			$islami_date = $Hi["islami_date"];
			$Result_Hijri = $this->MC->Get_Events_Hijri_Wise($islami_date);	
		}else{
			$Result_Hijri = '';
		}
		
		
		if(!empty($Result_Hijri) ):
			$R_Hijri = count( $Result_Hijri );
		else:
			$R_Hijri =0;
		endif;
		
		$TodayDate = date("Y-m-d",time());
		$date_id = date("Y-m-d",strtotime($date_id));
		
		$html='';
		$Loop_Counter=0;
		if(!empty($results) ):
		$Total1 = count( $results );
		$Total = ( $Total1 + $R_Hijri);
		
		foreach( $results as $r ):
		$class=''; 
		$class3=''; 
		$data_target='';
		if( $r["Type"] != '' ){
		switch($r["Type"]){
				case 'Holiday':
					$class = "HolidayParameterSet"; $class3 = "HolidayParameterSet3"; $data_target="SetHolidayParameter";
				break;
				case 'Staff': 
					$class = "StaffParameterSet";   $class3 = "StaffParameterSet3";   $data_target="SetStaffParameter";
				break;
				case 'Student'  : 
				$class = "StudentParameterSet"; $class3 = "StudentParameterSet3"; $data_target="SetStudentParameter";
				break;
				
				case 'Event' : 
					$class = "ScheduleFollowupSet EditAddEvent"; $class3 = "ScheduleFollowupSet"; $data_target="AddEventModal";
				break;
				//default: $class=''; $class3=''; $data_target='';
			}
		}else{
			$class = "ScheduleFollowupSet EditSchedule"; $class3 = "ScheduleFollowupSet3";
		}	
				
			if( $Loop_Counter < 4 ){
				if( $date_id < $TodayDate){
					$html .='<a class="'.$class3.'" href="#" id="H_'.$r["ID"].'" data-id="'.$MonBox.'">';	
				}else{
					// Greater then Event Can Be Editable
					$html .='<a class="'.$class.'" href="#" id="H_'.$r["ID"].'" data-id="'.$MonBox.'">';
				}
				$html .= $r["event_short_title"];
				$html .= '</a>';
				
			}else{
				$GrandTotal = ($Total-4);
				$GrandTotal = abs($GrandTotal);
				//$html .= '<a class="ViewMoreHere" id="H_'.$date_id.'" href="#" data-toggle="modal" data-target="#SetScheduleFollowup"> View '.$GrandTotal.' more..</a>';
				$html .= '<a class="ViewMoreHere" id="H_'.$date_id.'" href="#"> View '.$GrandTotal.' more..</a>';
				break;
			}
				$Loop_Counter++;		
		endforeach;
		endif;
		
		
	if( $Loop_Counter < 4 ){
			$Loop_Counter=$Loop_Counter;
			if(!empty($Result_Hijri) ):
				foreach( $Result_Hijri as $r ):
					$class=''; 
					$class3=''; 
					$data_target='';
					if( $r["Type"] != '' ){
						switch($r["Type"]){
							case 'Holiday':
								$class = "HolidayParameterSet3 HlP"; $class3 = "HolidayParameterSet3"; $data_target="SetHolidayParameter";
							break;
							case 'Staff': 
								$class = "StaffParameterSet";   $class3 = "StaffParameterSet3";   $data_target="SetStaffParameter";
							break;
							case 'Student'  : 
								$class = "StudentParameterSet"; $class3 = "StudentParameterSet3"; $data_target="SetStudentParameter";
							break;

							case 'Event' : 
								$class = "ScheduleFollowupSet EdtAdEntH"; $class3 = "ScheduleFollowupSet"; $data_target="AddEventModal";
							break;
						//default: $class=''; $class3=''; $data_target='';
						}
					}else{
					$class = "ScheduleFollowupSet EditSchedule"; $class3 = "ScheduleFollowupSet3";
					}	

					if( $Loop_Counter < 4 ){
						if( $date_id < $TodayDate){
							$html .='<a class="'.$class3.'" href="#" id="HH_'.$r["ID"].'" data-id="'.$MonBox.'">';	
						}else{
							// Greater then Event Can Be Editable
							$html .='<a class="'.$class.'" href="#" id="HH_'.$r["ID"].'" data-id="'.$MonBox.'">';
						}
						$html .= $r["event_short_title"];
						$html .= '</a>';

					}else{
						$GrandTotal = ($Total-4);
						$GrandTotal = abs($GrandTotal);
						//$html .= '<a class="ViewMoreHere" id="HH_'.$date_id.'" href="#" data-toggle="modal" data-target="#SetScheduleFollowup"> View '.$GrandTotal.' more..</a>';
						$html .= '<a class="ViewMoreHere" id="HH_'.$date_id.'" href="#"> View '.$GrandTotal.' more..</a>';
					break;
					}
					$Loop_Counter++;		
				endforeach;
			endif;
		}
		
		
		
		return $html;
		
	}
	
	
	
	function weeks_in_month($year, $month, $start_day_of_week){
		$num_of_days = date("t", mktime(0,0,0,$month,1,$year));
		$num_of_weeks = 0;
		for($i=1; $i<=$num_of_days; $i++){
		  $day_of_week = date('w', mktime(0,0,0,$month,$i,$year));
		  if($day_of_week==$start_day_of_week)
			$num_of_weeks++;
		}
		return $num_of_weeks;
	}
	
	public function getStartAndEndDate($week, $year){

	  $dto = new DateTime();
	  $dto->setISODate($year, $week);
	  
	  $dtoS = new DateTime();
	  $dtoS->setISODate($year, $week);
	  
	  $dtoT = new DateTime();
	  $dtoT->setISODate($year, $week);
	  
	  $dtoW = new DateTime();
	  $dtoW->setISODate($year, $week);
	  
	  $dtoTh = new DateTime();
	  $dtoTh->setISODate($year, $week);
	  
	  $dtoF = new DateTime();
	  $dtoF->setISODate($year, $week);
	  $ret['Monday'] = $dto->format('Y-M-d');
	  
	  $dtoT->modify('+1 days');
	  $ret['Tuesday'] = $dtoT->format('Y-M-d');
	  
	  
	  $dtoW->modify('+2 days');
	  $ret['Wednesday'] = $dtoW->format('Y-M-d');
	  
	  
	  $dtoTh->modify('+3 days');
	  $ret['Thursday'] = $dtoTh->format('Y-M-d');
	  
	  
	  $dtoF->modify('+4 days');
	  $ret['Friday'] = $dtoF->format('Y-M-d');
	  
	  
	  $dtoS->modify('+5 days');
	  $ret['Saturday'] = $dtoS->format('Y-M-d');
	  
	  $dto->modify('+6 days');
	  $ret['Sunday'] = $dto->format('Y-M-d');
	  
	  return $ret;
  
	
	}
	
	
	function getIsoWeeksInYear($year) {
    //$date = new DateTime;
	$date = new DateTime();
    $date->setISODate($year, 53);
    return ($date->format("W") === "53" ? 53 : 52);
	}
	
	public function firstDay($date){
		$d = new DateTime($date);
		$d->modify('first day of this month');
		return $d = $d->format('m');
	}
	
	function intPart($float){
		if ($float < -0.0000001)
			return ceil($float - 0.0000001);
		else
			return floor($float + 0.0000001);
	}


// http://www.phpsimplicity.com/tips.php?id=17
	function Greg2Hijri($day, $month, $year, $string = false){
    $day   = (int) $day;
    $month = (int) $month;
    $year  = (int) $year;

    if (($year > 1582) or (($year == 1582) and ($month > 10)) or (($year == 1582) and ($month == 10) and ($day > 14))){
        $jd = $this->intPart((1461*($year+4800+$this->intPart(($month-14)/12)))/4)+$this->intPart((367*($month-2-12*($this->intPart(($month-14)/12))))/12)-
        $this->intPart( (3* ($this->intPart(  ($year+4900+    $this->intPart( ($month-14)/12)     )/100)    )   ) /4)+$day-32075;
    }else{
        $jd = 367*$year-$this->intPart((7*($year+5001+$this->intPart(($month-9)/7)))/4)+$this->intPart((275*$month)/9)+$day+1729777;
    }

    $l = $jd-1948440+10632;
    $n = $this->intPart(($l-1)/10631);
    $l = $l-10631*$n+354;
    $j = ($this->intPart((10985-$l)/5316))*($this->intPart((50*$l)/17719))+($this->intPart($l/5670))*($this->intPart((43*$l)/15238));
    $l = $l-($this->intPart((30-$j)/15))*($this->intPart((17719*$j)/50))-($this->intPart($j/16))*($this->intPart((15238*$j)/43))+29;
    
    $month = $this->intPart((24*$l)/709);
    $day   = $l-$this->intPart((709*$month)/24);
    $year  = 30*$n+$j-30;
    
	$mocode = array("MHR", "SFR", "RAW", "RTN", "JAW","JTN","RJB", "SHB", "RMN", "SHW", "DQD","DHJ");
	$smbl = array("| >> |", "| >> |", "| >> |", "| >> |", "||>||","||>||","||>||", "||>||", "| >> |", "| >> |", "| >> |","| >> |");
	
    $date = array();
    $date['IslamicYear']  = $year;
    $date['IslamicMonth'] = $this->monthName($month);
    $date['IslamicDay']   = $day;
	$date['month_code']   = $mocode[$month];
	$date['Symbol']  	  =	$smbl[$month];

    if (!$string)
        return $date;
    else
        return "{$year}-{$month}-{$day}";
}


	 function monthName($i){
			static $month  = array(
				"Muharram", "Safar", "Rabiul-Awwal", "Rabi-uthani",
				"Jumadi-ul-Awwal", "Jumadi-uthani", "Rajab", "Shaban",
				"Ramadan", "Shawwal", "Zhul-Qaadha", "Zhul-Hijja"
			);
			return $month[$i-1];
		}
	

	// php weeks between 2 dates
	function datediffInWeeks($date1, $date2){
		if($date1 > $date2) return $this->datediffInWeeks($date2, $date1);
		$first = DateTime::createFromFormat('m/d/Y', $date1);
		$second = DateTime::createFromFormat('m/d/Y', $date2);
		return floor($first->diff($second)->days/7);
	}
//var_dump(datediffInWeeks('1/2/2013', '6/4/2013'));// 21

	public function getBackMonth(){
		$start_date=$this->input->post("start_date");
		$START_WEEK_NMUBER=$this->input->post("START_WEEK_NMUBER");
		$First_Monday=$this->input->post("First_Monday");
		
		
		$data = $this->Back_Dates2($start_date,$START_WEEK_NMUBER,$First_Monday);
		
		
		//var_dump($data); exit;
		$data["controller"]=$this;
		
		
		$EndDate=$data["EndDate"];
		$EndDate=$data["StartDate"];
		
		
		$data["START_WEEK_NMUBER"]=$START_WEEK_NMUBER;
		$current_month=date("F, Y", strtotime($EndDate));
		
		$date21 = str_replace('-', '/', $First_Monday);
		$current_month = date('F, Y',strtotime($date21 . "-1 days"));
		
		
		//$response = $this->load->view('master_calendar/preppend',$data,TRUE);
		$response = $this->load->view('master_calendar/preppend2',$data,TRUE);
		
		$r = array("h"=> $response, "ld" => $EndDate, "sd"=>$current_month);
		echo json_encode($r);
	}
	
	function Back_Dates2($start_date,$START_WEEK_NMUBER,$First_Monday){
		
		
		
		$date1 = str_replace('-', '/', $First_Monday);
		$yesterday = date('Y-m-d',strtotime($date1 . "-1 days"));
		
		//$start_date='2017-04-30';
		
		$start_date=$yesterday;
		
		$d = explode("-",$start_date);
		
		$CurYear = (int) $d[0];
		$CurMonth1 = (int)$d[1];
		$CurDay = $d[2];
		if( $CurMonth1 == 12){ $CurYear = ( $CurYear - 1); }
		$CurMonth2 =0;
		$CurMonth = 0;
		if( $CurMonth1 > 1 ){
			$CurMonth = ( $CurMonth1 - 1 );
			$CurMonth2 = ( $CurMonth1 - 1 );
		}else{
			$CurMonth = $CurMonth1;
			$CurMonth2 =  $CurMonth1;
		}
		
		
		$First_Date_Of_Previous_Month = date("Y-m-d",mktime(1,1,1,$CurMonth,1,$CurYear));
		$Last_Date_Of_Previous_Month  = date("Y-m-t", mktime(1,1,1,$CurMonth,1,$CurYear));
		
		$numberofmonth=2;
		$three_month_week_number=0;
		for($a=1;$a<$numberofmonth; $a++){
			$three_month_week_number += $this->weeks_in_month($CurYear,$CurMonth,1);
		
			if($CurMonth==12){
				$CurMonth=1;
				//$CurYear++;
			}else{
				$CurMonth++;
			}
		}
		
		$data['three_month_week_number']=$three_month_week_number;
		
		$first_week_of_month=idate('W', mktime(1, 1,1, $CurMonth2,1,$CurYear));
		
		//$r=$this->week_start_end_by_date(date("Y-m-d", strtotime($First_Date_Of_Previous_Month)), $format = 'Y-m-d');
		$r=$this->week_start_end_by_date(date("Y-m-d", strtotime($start_date)), $format = 'Y-m-d');
		
		$data["WEEK_NMUBER"]= $first_week_of_month;
		
		$data["StartDate"]=$First_Date_Of_Previous_Month;
		$data["EndDate"]=$Last_Date_Of_Previous_Month;
		
		$first_day_of_week = $r["first_day_of_week"];
		$last_day_of_week = $r["last_day_of_week"];
		
		//$data['CalenderDates'] = $this->getMasterCalender($First_Date_Of_Previous_Month, $Last_Date_Of_Previous_Month);	
		$data['CalenderDates'] = $this->getMasterCalender($first_day_of_week, $last_day_of_week);	
		
		$data["YEAR"] 		=$CurYear;
		$data["week_start"]	=NULL;
		$data["lastDay"]	=$Last_Date_Of_Previous_Month;
		$data["first_day_of_week"]	=$first_day_of_week;
	
		return $data;
	}
	
	function Back_Dates($start_date,$START_WEEK_NMUBER){
		//date_default_timezone_set("Asia/Karachi");
		$CurYear  = (int)date("Y",strtotime($start_date));
		$CurMonth = (int)date("m", strtotime($start_date));
		$CurDay   = (int)date("d",strtotime($start_date));
		$today = mktime(0,0,0,$CurMonth,$CurDay,$CurYear);
		$hour   = date("H", $today);
		$minute = date("i", $today);
		$second = date("s", $today);
		$month  = date("m", $today);
		$day    = date("d", $today);
		$year   = date("Y", $today);
		// Get Previous month info from givin date
		$start_date = date("Y-m-d",mktime($hour,$minute,$second,$month-1,1,$year));
		// Previous month info
		$LTDate		  = date("Y-m-d", strtotime($start_date));
		$LTYear		  = date("Y", strtotime($start_date));
		$LTMonth	  = date("m", strtotime($start_date));
		$LTDay   	  = date("d", strtotime($start_date));
		$LTFirstDates = date('Y-m-01', strtotime($LTDate));
		$CurYear  = (int)$LTYear;
		$CurMonth = (int)$LTMonth;
		$CurDay   = (int)$LTDay;
		$CurMonthStartDate = $CurMonth;
		$CurMonthYear  = $CurYear;
		$numberofmonth=2;
		$three_month_week_number=0;
		
		
		for($a=1;$a<$numberofmonth; $a++){
			$three_month_week_number += $this->weeks_in_month($CurYear,$CurMonth,1);
			if($CurMonth==12){
				$CurMonth=1;
				//$CurYear++;
			}else{
				$CurMonth++;
			}
		}
		$data['three_month_week_number']=$three_month_week_number;
		
	    $firstDates = date('Y-m-01',strtotime($LTDate) ); // hard-coded '01' for first day
		$firstDates2 = strtotime( $firstDates );
		$firstweekofmonth =  idate('W', mktime(0, 0, 0, $CurMonthStartDate, 1, $CurMonthYear));
		$r=$this->week_start_end_by_date(date("Y-m-d", strtotime($LTFirstDates)), $format = 'Y-m-d');
		$data["WEEK_NMUBER"]= $firstweekofmonth;
		$lastDay = date("Y-m-t", strtotime($firstDates)); // Last date of the month
		$StartDate = date("Y-m-d", strtotime($LTFirstDates) );
		$EndDate = $lastDay;
		$data['StartDate']=$StartDate;
		$data["EndDate"]=$start_date;
		$firstweekfirstdate = date("Y-m-d", strtotime("first monday $StartDate"));
		$data['CalenderDates'] = $this->getMasterCalender($firstweekfirstdate, $EndDate);	
		$data["Week_Info"] = $r;
		$data["YEAR"]=$CurYear;
		$data["StartDate"]=$StartDate;
		$data["week_start"]=$day;
		$data["lastDay"]=$lastDay;
		return $data;
	}
	
	function weeks_between($datefrom, $dateto){
		$day_of_week = date("w", $datefrom);
		$fromweek_start = $datefrom - ($day_of_week * 86400) - ($datefrom % 86400);
		$diff_days = $this->days_between($datefrom, $dateto);
		$diff_weeks = intval($diff_days / 7);
		$seconds_left = ($diff_days % 7) * 86400;

		if( ($datefrom - $fromweek_start) + $seconds_left > 604800 )
			$diff_weeks ++;

		return $diff_weeks;
	}
	
	function days_between($datefrom,$dateto){
    $fromday_start = mktime(0,0,0,date("m",$datefrom),date("d",$datefrom),date("Y",$datefrom));
    $diff = $dateto - $datefrom;
    $days = intval( $diff / 86400 ); // 86400  / day

    if( ($datefrom - $fromday_start) + ($diff % 86400) > 86400 )
        $days++;

    return  $days;
}

	function Followup_Availability_Date_Wise(){
		$this->load->model("master_calendar/master_calender","MC");
		$RDate = $this->input->post("RDate");
		if($this->MC->Followup_Availability_Date_Wise($RDate)){
			$return = 1;
		}else{
			$return = 0;
		}
		echo json_encode( array("Cr"=>$return) );
	}
	
	public function Get_Hijri_Date($Today_Data){
		$this->load->model("master_calendar/master_calender","MC");
		$Row_Result = $this->MC->Get_Hijri_Date($Today_Data);
		if( !empty( $Row_Result ) ){ 
		return $Row_Result;
		}else{ 
		return FALSE;
		}
		
	}

	public function Update_Hijri(){
		$this->load->model("master_calendar/master_calender","MC");
		$Hijr_Date = $this->input->post("Hijr_Date");
		$Hi_Month = $this->input->post("Hi_Month");
		$Hijri_Date4 = $this->input->post("Hijri_Date4");
		$SuperProfile2 = $this->input->post("SuperProfile2");
		$s = explode("-",$Hijri_Date4);
		$Hij_Year = (int)$s[0];
		$Hij_Month = sprintf("%02d", (int)$s[1] );
		$Hij_Date =  (int)$s[2];
		$Hij_Date2 = ($Hij_Date+1);
		$Complete_Hi = $Hij_Year."-".$Hij_Month."-".$Hij_Date2;
		
		$Row_Result = $this->MC->get_Hijri_Date2($Hijr_Date);
		
		//var_dump( $Row_Result ); exit;
		
		
		
		 $Month_Name  = array(
				"Muharram", "Safar", "Rabiul-Awwal", "Rabi-uthani",
				"Jumadi-ul-Awwal", "Jumadi-uthani", "Rajab", "Shaban",
				"Ramadan", "Shawwal", "Zhul-Qaadha", "Zhul-Hijja"
			);
		
		if(!empty($Row_Result)){
			
			$Date_To_Update = $Row_Result[0]["date"]; // 30 Ramdan here
			$table='hijri_calendar';
			$where = array('date' => $Date_To_Update );
			$data = array("islami_date"=>$Complete_Hi, "islami_month"=> $Hi_Month);
			
			if($SuperProfile2==30){
				$EffectedRows = $this->MC->table_update($table,$data,$where);
			}
		
			//$Islami_Date 	= $Row_Result[0]["islami_date"];
			
			$counter=1;
			$loop_Counter=0;
			if($SuperProfile2==30){
				$limit=29;
				$loop_Counter=1;
			}else{
				$limit=30;
				$loop_Counter=0;
			}
			$Hij_Month++;

			foreach($Row_Result as $Row){
				
				if($counter <= $limit){
					$Row_Result[$loop_Counter]["date"];
					$where2 = array( 'date' => $Row_Result[$loop_Counter]["date"]);
					
					$Islamic_Date = $Hij_Year."-".$Hij_Month."-".$counter; 
					
					
					$Hi_Month = $Month_Name[($Hij_Month-1)];
					
					$data2 = array("islami_date"=>$Islamic_Date, "islami_month"=> $Hi_Month);
					
					
					
					$this->MC->table_update($table,$data2,$where2);
					$loop_Counter++;
				}
				
				if( $counter > $limit){
					$Hij_Month++;
					$counter=0;
					
					if($limit==29){
						$limit=30;
					}else{
						$limit=29;
					}
					
					if($Hij_Month >= 13){
						$Hij_Month=1;
						$Hij_Year++;
					}
				}
				
			$counter++;
				
				
			}
		}
		echo json_encode( array("Cr"=>$Complete_Hi) );
	}
	
	
	
		// This function is for event add / edit functionality through database.
	function db_Hijri_Event(){
		
		$this->Type = $this->input->post("OperationType");
		$this->ProfileID = $this->input->post("ProfileID"); // here this is event category
		$this->Title = $this->input->post("Title"); // here this is for event title
		$this->STitle = $this->input->post("STitle"); // here this is level
		$this->EventVisibilty = $this->input->post("EventVisibilty"); // 
		$this->EventStartTime = $this->input->post("EventTimeStart"); //
		$this->EventEndTime = $this->input->post("EventTimeEnd"); // 
		$this->FullDayEvent = $this->input->post("fullday"); 
		$this->Des = $this->input->post("EventDes");
		$this->OpType = $this->input->post("OpType");
		$this->EventDate = $this->input->post("AdNwEntDate"); // This is Hijri Date Format: 1438-09-09
		
		
		$this->EventAssginedTo = $this->input->post("checkboxs");
		if( $this->OpType == 1 ){ 
			$this->DateID = $this->input->post("DateID");
			$last_id = $this->Save_HEvent();  
		}else{
			$this->DateID = $this->input->post("hiddenID"); // ID For Updation
			$this->UpDate_EventH();
			$last_id = $this->DateID;
		}
		$h = array( "lId" => $last_id );
		echo json_encode($h);
	}
	
	public function Save_HEvent(){
		
		$this->load->model("master_calendar/master_calender","MC");
		$di = explode("_", $this->DateID);
		$DateID =$di[1];
		$last_id =0;
		$data = array();
		if($this->FullDayEvent=='fullday'){ $fullday=1; }else{ $fullday=0; }
			
			date_default_timezone_set("Asia/Karachi");
			$year  = (int)date("Y",strtotime($DateID));
			$month = (int) date("m",strtotime($DateID));
			$day   = (int)date("d",strtotime($DateID));
			
			$hours = (int)$this->EventStartTime;
			$EventStartTime = mktime($hours,0,0,$month,$day,$year);
			
			$hour = (int)$this->EventEndTime;
			$EventEndTime = mktime($hour,0,0,$month,$day,$year);
			// calendar_ID this is date 2017-05-01
			
			$data = array(
				//"Gregorian_Date"=>$DateID,
				"Hijri_Date"=>$this->EventDate,
				"event_ID"=>$this->ProfileID,
				"event_title"=>$this->Title,
				"event_short_title"=>substr($this->Title,0,22),
				"event_level"=>$this->STitle,
				"event_visibilty"=>$this->EventVisibilty,
				"event_start_time"=>$EventStartTime,
				"event_end_time"=>$EventEndTime,
				"full_day_event"=>$fullday,
				"event_description"=>$this->Des,
				"created"=>time(),
				"register_by"=>$this->session->userdata("user_id")
			);
			$table='calendar_events_managment_hijri_date';
			$last_id = $this->MC->set($table,$data);
			return $last_id;
	}


	public function UpDate_EventH(){
		$this->load->model("master_calendar/master_calender","MC");
		
		date_default_timezone_set("Asia/Karachi");
		$DateID=date("Y-m-d");
		$year  = (int)date("Y",strtotime($DateID));
		$month = (int) date("m",strtotime($DateID));
		$day   = (int)date("d",strtotime($DateID));
		
		$hours = (int)$this->EventStartTime;
		$EventStartTime = mktime($hours,0,0,$month,$day,$year);
		
		$hour = (int)$this->EventEndTime;
		$EventEndTime = mktime($hour,0,0,$month,$day,$year);
		// calendar_ID this is date 2017-05-01
			if($this->FullDayEvent=='fullday'){ $fullday=1; }else{ $fullday=0;}
			
		$Data_For_Hijri = array(
					"event_ID"=>$this->ProfileID,
					"event_title"=>$this->Title,
					"event_short_title"=>substr($this->Title,0,22),
					"event_level"=>$this->STitle,
					"event_visibilty"=>$this->EventVisibilty,
					"event_start_time"=>$EventStartTime,
					"event_end_time"=>$EventEndTime,
					"full_day_event"=>$fullday,
					"event_description"=>$this->Des,
					"modified"=>time(),
					"modified_by"=>$this->session->userdata("user_id"));
					
					
		$table2='calendar_events_managment_hijri_date';
		$last = $this->DateID;
		$where6 = array('ID' => $last );
		$this->MC->table_update($table2,$Data_For_Hijri,$where6);
		if( ( !empty( $this->EventAssginedTo ) ) && ( $this->Type == 'AddNewEventH' || $this->Type == 'Schedule') && ( $last > 0 ) ){
			// Add Event to Domain wise like, event for operation dep, SW Dept, etc
			$table_evt_effc_dept='event_effected_department_hijri_date';
			$where2 = array("event_ID"=>$last);
			$this->MC->table_remove($table_evt_effc_dept,$where2); // update record_deleted to 1 mean removed
			
			foreach( $this->EventAssginedTo as $domain):
				$data_domain = array(
									"event_ID"=>$last,
									"department_ID"=>$domain,
									"created"=>time(),
									"register_by"=>$this->session->userdata("user_id"));
				$this->MC->set($table_evt_effc_dept,$data_domain);		
			endforeach; // end $domain checkbox
		}
		else{
		// Add Event to Domain wise like, event for operation dep, SW Dept, etc
			$table_evt_effc_dept='event_effected_department_hijri_date';
			$where2 = array("event_ID"=>$last);
			$this->MC->table_remove($table_evt_effc_dept,$where2); // update record_deleted to 1 mean removed	
		}
		
		return $this->DateID;
	}	
	
	
	public function Get_Hijri_Month_Info($Hijjri_Date){
		$this->load->model("master_calendar/master_calender","MC");
		$Row_Result = $this->MC->Get_Hijri_Date_Info($Hijjri_Date);
		if( !empty( $Row_Result ) ){ 
		return $Row_Result;
		}else{ 
		return FALSE;
		}
	}
	
	
	
	public function Update_Weekly_Sheet($From_date, $To_date)
	{
		$this->load->model("master_calendar/master_calender","MC");
		$this->MC->Update_Weekly_TimeSheet($From_date, $To_date);
	}
	
}