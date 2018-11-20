<?php
class Master_calendar extends CI_Controller{
	public function __construct(){
		parent::__construct();
	}
	public function index(){
		$this->load->model("master_calendar/master_calender","MC");
		$this->load->view('gs_files/header');
	    $this->load->view('gs_files/main-nav');
	    $this->load->view('gs_files/breadcrumb');
		//Week Start Date End Date
		
		//date_default_timezone_set("Asia/Karachi");
		
		$data["controller"]=$this;
		$CurYear  = (int)date("Y",time());
		$CurMonth = (int)date("m",time());
		$CurDay   = (int)date("d",time());
		
		/*$CurYear  = 2017;
		$CurMonth = 03;
		$CurDay   = 1;*/
		$CurMonthStartDate = $CurMonth;
		$CurMonthYear  = $CurYear;
		//echo "<br />"; exit;
		
		$numberofmonth=3;
		$three_month_week_number=0;
		
		for($a=1;$a<$numberofmonth; $a++){
			$three_month_week_number += $this->weeks_in_month($CurYear,$CurMonth, 1);
			if($CurMonth==12){
				$CurMonth=1;
				//$CurYear++;
			}else{
				$CurMonth++;
			}
		}
		
		$data['three_month_week_number']=$three_month_week_number;
		$firstDates = date('Y-m-01'); // hard-coded '01' for first day
		$firstDates2 = strtotime( $firstDates );
		$firstweekofmonth =  idate('W', mktime(0, 0, 0, $CurMonthStartDate, 1, $CurMonthYear));
		$r=$this->week_start_end_by_date(date("Y-m-d",time()), $format = 'Y-m-d');
		$data["WEEK_NMUBER"]= $firstweekofmonth;
		$lastDay = date("Y-m-t", strtotime($firstDates)); // Last date of the month
		$StartDate = date("Y-m-d",time());
		$EndDate = $lastDay;
		
		//$EndDate = '2017-01-31';
		
		$day = date('w');
		$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
		
		
		//$data['CalenderDates'] = $this->getMasterCalender($week_start,$EndDate); // changed to 2017-05-30
		$data['CalenderDates'] = $this->getMasterCalender($firstDates,$EndDate);
		//var_dump(  $data['CalenderDates'] ); exit;
		
		
		$data["Week_Info"] = $r;
		$data["YEAR"]=$CurYear;
		$data["StartDate"]=$StartDate;
		$this->load->view('master_calendar/calendar',$data);
		//$this->load->view('master_calendar/calendar_w',$data);
		$this->load->view('master_calendar/footer_new');
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
        while( $no_of_weeks < $lastday ){ 
            $no_of_weeks += 7; 
            $count_weeks++; 
        } 
		return $count_weeks;
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
  
  	public function get_date_header($date){
		$this->load->model("master_calendar/master_calender","MC");
		
		$TueBox=explode("_", $date);
		$date_id = $TueBox[1];
		
		
		$results = $this->MC->get_events($date_id);
		
		//$resultsh = $this->MC->get_events($Get_Events_Hijri_Wise);
		
		if( empty( $results ) ){
			$Hi = $this->MC->Get_Hijri_By_Ger($date_id);
			if( !empty($Hi)){
				$islami_date = $Hi["islami_date"];
				$results = $this->MC->Get_Events_Hijri_Wise($islami_date);	
			}else{
				$results = '';
			}
		}else{
			
		}
		
		
		$TodayDate = date("Y-m-d",time());
		if( $date_id < $TodayDate){
			$class1='HolidayParameter';
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
					$class1='HolidayParameter';
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
		
		$return = array( "Ht"=>$html,"RClass"=>$RClass, "HD" =>$Result_Hijri );
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
				$html .= '<a class="ViewMoreHere" id="H_'.$date_id.'" href="#" data-toggle="modal"> View '.$GrandTotal.' more..</a>';
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
    
    /*$date = array();
    $date['IslamicYear']  = $year;
    $date['IslamicMonth'] = $this->monthName($month);
    $date['IslamicDay']   = $day;*/
	
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
	
	function weeks_between($datefrom, $dateto)
{
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
	
	public function Get_Hijri_Date($Today_Data){
		$this->load->model("master_calendar/master_calender","MC");
		$Row_Result = $this->MC->Get_Hijri_Date($Today_Data);
		if( !empty( $Row_Result ) ){ 
		return $Row_Result;
		}else{ 
		return FALSE;
		}
		
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
	
}