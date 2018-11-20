<?php
class Master_calendar_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
	}
	
	public function CallBackHtml(){
		$StartDate = $this->input->post("EndDate");
		$endGenWe = $this->input->post("endGenWe");
		
		if( date("m",strtotime($StartDate)) == 8 ){
			$endGenWe=1;
			$data["GenWe"]=$endGenWe;
		}else{
			$data["GenWe"]=$endGenWe;
		}
			
		$StartDate = date('Y-m-d', strtotime($StartDate . ' +1 day'));
		
		$d = explode("-", $StartDate );
		
		$CurYear  = (int)$d[0];
		$CurMonth = (int)$d[1];
		$CurDay   = (int)$d[2];
		

		
		
		$r = $this->week_start_end_by_date( $StartDate, $format = 'Y-m-d');
		//var_dump($r);
		//echo $date = date("Y-m-d", strtotime(date("Y-m-d", strtotime($StartDate)) . " +1 week"));
		
		$data["WEEK_NMUBER"]= $r["week"];
		$EndDate = $r["last_day_of_week"];
		$data['CalenderDates'] = $this->getMasterCalender($StartDate,$EndDate);
		
		$data["Week_Info"] = $r;
		$data["YEAR"]=$CurYear;
		$data["StartDate"]=$StartDate;
		
		
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
	
	
	/*
	* Create Holiday Parameter HTML
	*/
	function HParamter(){
		$dataid = '';
		$dataid = $this->input->post("dataid");
		$html = '';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday type';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<select name="holiday_profile" id="holiday_profile">';
				  $html .= '<option value="1">Unscheduled Unrest</option>';
				  $html .= '<option value="2">Voluntary Holiday</option>';
				  $html .= '<option value="3">Directorate Holiday</option>';
				  $html .= '<option value="4">Provincial Holiday</option>';
				  $html .= '<option value="5">National/Public Holiday</option>';
				$html .= '</select>';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday Title';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<input type="text" placeholder="Holiday Title" name="holiday_title" id="holiday_title" />';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
			$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Short Title';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<input type="text" placeholder="Short Title" name="holiday_short_title" id="holiday_short_title" />';
			$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-md-12" style="padding:10px 0;">';
		$html .= '<div class="col-md-3" style="padding-top:5px;">';
				$html .= 'Holiday Description';
			$html .= '</div>';
			$html .= '<div class="col-md-9">';
				$html .= '<textarea name="holiday_description" id="holiday_description"></textarea>';
				$html .= '<input type="hidden" value="'.$dataid.'" name="date_id" id="date_id" />';
			$html .= '</div>';
		$html .= '</div>';
		echo $html;
		
		
	}
	
	function SfParamter(){
		$dataid = '';
		$dataid = $this->input->post("dataid");
		$html ='';
		$html .='<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Super Profile
		</div>
		<div class="col-md-9">
			<select name="SuperProfile" id="SuperProfile">
			  <option value="1">Ramadan</option>
			  <option value="2">June</option>
			  <option value="3">July</option>
			</select>
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Title
		</div>
		<div class="col-md-9">
			<input type="text" placeholder="Title" name="SPTitle" id="SPTitle" />
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Short Title
		</div>
		<div class="col-md-9">
			<input type="text" placeholder="Short Title" name="SPShortTitle" id="SPShortTitle" />
		</div>
	</div>
	<div class="col-md-12" style="padding:10px 0;">
		<div class="col-md-3" style="padding-top:5px;">
			Description
		</div>
		<div class="col-md-9">
			<textarea name="SPDescription" id="SPDescription"></textarea>';
			$html .= '<input type="hidden" value="'.$dataid.'" name="date_id_SP" id="date_id_SP" />';
		$html .= '</div></div>';
		echo $html;
	}
	
	function StdParameter(){
		$html = '';
			$html .= 'Ajax Response will be drag here..';
		echo $html;
	}
	
	function SchFParameter(){
		$dataid = '';
		$html ='';
		$html .='	<div class="col-md-12 no-padding">
		<div class="col-md-6 no-padding" style="margin-top: 13px !important;border-right: 1px solid #ccc;height: 361px;">
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Title
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<input type="text" placeholder="Title" />
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Followup date
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<input type="date" placeholder="Title" />
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					&nbsp;
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<input type="checkbox" name="addfollow" value="value" style="display:;" id="addfollow"> <label for="addfollow"> Add followup to the respective date</label>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
		</div><!-- col-md-6 -->
		<div class="col-md-6" id="OlaAccordion" style="padding-top: 22px;">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<input type="checkbox" name="Starter" value="Starter" style="display:;" id="Starter"> <label for="Starter" class="customCheck"></label>
							<a class="titleColl" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Starter</div>
							</a>
						</h4><!-- panel-title -->
					</div><!-- panel-heading -->
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="PG" value="PG" style="display:;" id="PG"> <label for="PG" class="">PG</label></li>
								<li><input type="checkbox" name="PN" value="PN" style="display:;" id="PNN"> <label for="PNN" class="">PN</label></li></li>
								<li><input type="checkbox" name="N" value="N" style="display:;" id="NN"> <label for="NN" class="">N</label></li>
								<li><input type="checkbox" name="KG" value="KG" style="display:;" id="KGG"> <label for="KGG" class="">KG</label></li>
								<li><input type="checkbox" name="I" value="I" style="display:;" id="I1"> <label for="I1" class="">I</label></li>
								<li><input type="checkbox" name="II" value="II" style="display:;" id="II2"> <label for="II2" class="">II</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseOne -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<input type="checkbox" name="Junior" value="Junior" style="display:;" id="Junior"> <label for="Junior" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Junior</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="III3" value="III3" style="display:;" id="III3"> <label for="III3" class="">III</label></li>
								<li><input type="checkbox" name="IV4" value="IV4" style="display:;" id="IV4"> <label for="IV4" class="">IV</label></li></li>
								<li><input type="checkbox" name="V5" value="V5" style="display:;" id="V5"> <label for="V5" class="">V</label></li>
								<li><input type="checkbox" name="VI6" value="VI6" style="display:;" id="VI6"> <label for="VI6" class="">VI</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseTwo -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<input type="checkbox" name="Middle" value="Middle" style="display:;" id="Junior"> <label for="Middle" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Middle</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="VII7" value="VII7" style="display:;" id="VII7"> <label for="VII7" class="">VII</label></li>
								<li><input type="checkbox" name="VIII8" value="VIII8" style="display:;" id="VIII8"> <label for="VIII8" class="">VIII</label></li></li>
								<li><input type="checkbox" name="IX9" value="IX9" style="display:;" id="IX9"> <label for="IX9" class="">IX</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseThree -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
						<h4 class="panel-title">
							<input type="checkbox" name="Starter" value="Starter" style="display:;" id="Starter"> <label for="Starter" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Senior</div>
							</a>
						</h4><!-- panel-title -->
					</div><!-- panel-heading -->
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="PG" value="PG" style="display:;" id="PG"> <label for="PG" class="">PG</label></li>
								<li><input type="checkbox" name="PN" value="PN" style="display:;" id="PNN"> <label for="PNN" class="">PN</label></li></li>
								<li><input type="checkbox" name="N" value="N" style="display:;" id="NN"> <label for="NN" class="">N</label></li>
								<li><input type="checkbox" name="KG" value="KG" style="display:;" id="KGG"> <label for="KGG" class="">KG</label></li>
								<li><input type="checkbox" name="I" value="I" style="display:;" id="I1"> <label for="I1" class="">I</label></li>
								<li><input type="checkbox" name="II" value="II" style="display:;" id="II2"> <label for="II2" class="">II</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseOne -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFive">
						<h4 class="panel-title">
							<input type="checkbox" name="Generosity" value="Generosity" style="display:;" id="Generosity"> <label for="Generosity" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Generosity</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="VII7" value="VII7" style="display:;" id="VII7"> <label for="VII7" class="">Gen U</label></li>
								<li><input type="checkbox" name="VIII8" value="VIII8" style="display:;" id="VIII8"> <label for="VIII8" class="">Coordination</label></li></li>
								<li><input type="checkbox" name="IX9" value="IX9" style="display:;" id="IX9"> <label for="IX9" class="">Software</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseTwo -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingSix">
						<h4 class="panel-title">
							<input type="checkbox" name="Admin" value="Admin" style="display:;" id="Admin"> <label for="Admin" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Admin</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="DI" value="DI" style="display:;" id="DI"> <label for="DI" class="">DI</label></li>
								<li><input type="checkbox" name="SIS" value="SIS" style="display:;" id="SIS"> <label for="SIS" class="">SIS</label></li></li>
								<li><input type="checkbox" name="Finance" value="Finance" style="display:;" id="Finance"> <label for="Finance" class="">Finance</label></li>
								<li><input type="checkbox" name="Operations" value="Operations" style="display:;" id="Operations"> <label for="Operations" class="">Operations</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseThree -->
				</div><!-- panel -->
			</div><!-- panel-group -->
		</div><!-- col-md-6 -->
	</div><!-- col-md-12 -->';
		echo $html;
	}
	
	
	/*
	* Method for add holiday parameter data	
	*/
	function db_hp(){
		$this->load->model("master_calendar/master_calender","MC");
		$Type = $this->input->post("OperationType");
		$ProfileID = $this->input->post("ProfileID");
		$Title = $this->input->post("Title");
		$STitle = $this->input->post("STitle");
		$Des = $this->input->post("Des");
		$DateID = $this->input->post("DateID");
		$ProfileType='';
		switch($Type){
			case 'Holiday'  : $ProfileType = "holiday_parameter_ID";  	break;
			case 'StaffP'   : $ProfileType = "staff_parameter_ID";		break;
			case 'StudentP' : $ProfileType = "student_parameter_ID"; 	break;
			case 'Schedule' : $ProfileType = "schedule_followup_ID"; 	break;
			case 'AddEvent' : $ProfileType = "event_ID"; 				break;
			default:$ProfileType='';
		}
		
		if( $DateID > 0 && $ProfileType != '' ){
		$data = array(
					"calendar_ID"=>$DateID,
					$ProfileType=>$ProfileID,
					"event_title"=>$Title,
					"event_short_title"=>$STitle,
					"event_description"=>$Des,
					"created"=>time(),
					"register_by"=>$this->session->userdata("user_id")
		);
		$table='calendar_events_managment';
		$last_id = $this->MC->set($table,$data); 
		}else{ $last_id=0;}
		$h = array("r"=>$ProfileID,"t"=>$Title,"s"=>$STitle, "des"=>$Des, "d"=>$DateID, "lId"=>$last_id);
		echo json_encode($h);
	}
	
	public function get_date_events($date_id){
		$this->load->model("master_calendar/master_calender","MC");
		return $this->MC->get_events($date_id);
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
    
    $date = array();
    $date['IslamicYear']  = $year;
    $date['IslamicMonth'] = $this->monthName($month);
    $date['IslamicDay']   = $day;

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
}