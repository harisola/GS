<?php 
Class Student_log_gsstudents extends CI_Controller{
	public function __construct(){
		parent::__construct();

		$this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
		$this->data['photo_file'] = '.png';
	}

	function index(){		
	}


	public function getStudentsList(){
		$html = '';
		if(count($_POST)){
			$this->load->model('class_list/class_list_sr_view_model');


	    	$gradeSection = $_POST['gradeSection'];
	    	$pos = strpos($gradeSection, '-');
	    	$GradeName = substr($gradeSection, 0, $pos);
	    	$SectionName = substr($gradeSection, ($pos+1), strlen($gradeSection));

	    	$data['students'] = $this->class_list_sr_view_model->get_all_grade_section_students($GradeName, $SectionName);
	    	

	    	$html .= '


	    	<div class="powerwidget black" id="student_log_std_name" data-widget-editbutton="false" role="widget" style="">
			    <header role="heading">
			      <h2>Students of ' . $gradeSection . '</h2>
			      <div class="powerwidget-ctrls" role="menu">
			      </div>
			      <span class="powerwidget-loader"></span>
			    </header>


			    <div class="inner-spacer" role="content" style="overflow-y: scroll; height: 75vh;">
			      <div id="student_log_std_callout"></div>
			      <table class="table table-hover margin-0px student_log_grade_section_std" id="student_log_grade_section_std">
			        <thead>
			        </thead>
			        <tbody>';
			            

		            foreach($data['students'] as $gs) {
		              $html .= '<tr>
		                <td class="studentID">' . $gs['gs_id'] . '</td>
		                <td>' . $gs['abridged_name'] . '</td>
		                <td>' . $gs['std_status_code'] . '</td>
		              </tr>';
		            }


			        $html .= '
			        </tbody>
			      </table>
			    </div>
		  	</div>
	    	';

	    }


	    echo $html;
	}












	public function getStudentInformation(){
		$html = '';

		if(count($_POST) && $_POST['gsid'] != null){

			$GSID = $_POST['gsid'];
			$selectedOption = trim($_POST['option']);
			$timelineOptions = trim($_POST['selectedTimeLine']);

			

			$html = '
			<style type="text/css">
				.fa-group{
					padding-right: 10px;
				}
				.fa-calendar{
					padding-right: 10px;
				}
				.fa-child{
					padding-right: 10px;
				}
				.fa-money{
					padding-right: 10px;
				}
				.fa-building{
					padding-right: 10px;
				}
				.fa-codepen{
					padding-right: 10px;
				}
				.fa-credit-card{
					padding-right: 10px;
				}
			</style>
			';


			$this->load->model('student_log/student_log_logtype');
			$this->data['log_type'] = $this->student_log_logtype->get();
			$StudentName = $this->student_log_logtype->getStudentName($GSID);

			$html .= '
			<div class="powerwidget black" role="widget">
				<header>
					<h2>'.$StudentName.'<small>Information</small></h2>

					<div class="powerwidget-ctrls" role="menu">
						<a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
					</div>
				</header>
				<div class="inner-spacer" style="height: 75vh;">

					 <ul class="nav nav-tabs" id="student_complete_information">';


					 foreach ($this->data['log_type'] as $log) {
					 	$html .= '<li ';

					 	if($log->name == $selectedOption){
					 		$html .= 'class="active"';
					 	}
					 	$html .= '>
					 		<a href="#'.$log->name.'" data-toggle="tab">
					 			<i class="fa '.$log->icon.'"></i> '.$log->name.'</a></li>';
					 }
					 

					$html .= '
					</ul>
					  <div class="tab-content">';

						foreach ($this->data['log_type'] as $log) {
					 	$html .= '<div class="tab-pane ';

	                        if($log->name == $selectedOption){
						 		$html .= 'active';
						 	}

	                       $html .= '" id="'.$log->name.'">';



							/*********************************    Student Profile
							******************************************************/
							if($selectedOption == "Attendance" and $log->name == "Attendance"){
									$html .= $this->get_student_attendance($GSID);
							}



							/******************************    Student Smart Card
							******************************************************/
							if($selectedOption == "Smart_Card" and $log->name == "Smart_Card"){
									$html .= $this->get_student_smartcard($GSID);
							}



							/************************************    All Comments
							******************************************************/
							if($selectedOption == "Comments" and $log->name == "Comments"){
									$html .= $this->get_comments($GSID);
							}






							/**********************************  Student Time Line
							******************************************************/
							if($selectedOption == "Time Line" and $log->name == "Time Line"){
									$html .= $this->get_student_timeline($GSID, $timelineOptions);
							}






	                       $html .= '</div>';
	                    }
	                $html .='
	                  </div>';


	            /**************************************  Student Time Line  /**************************************/
				/**************************************************************************************************/
				if($selectedOption == "Time Line"){
					$html .= '<style>
						.inputstl { 
						    padding: 9px; 
						    border: solid 1px #0077B0; 
						    outline: 0; 
						    background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #C6ECFF), to(#FFFFFF)); 
						    background: -moz-linear-gradient(top, #FFFFFF, #C6ECFF 1px, #FFFFFF 25px); 
						    box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
						    -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 
						    -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px; 

						    } 
						   
						</style>';




					$html .= '
                  	<div style="width: 40%; padding-top: 10px; float: left;">
                  		<select class="multi_select_comment_type inputstl" multiple="multiple" style="width:100%; height:66px; overflow-y: auto" placeholder="Tags are here!">';


                  	$data['log_type'] = $this->student_log_logtype->getAllLogNames();
                  	foreach ($data['log_type'] as $log) {
                  		if($log->name != "Time Line"){
							$html .= '<option value="'.$log->name.'">'.$log->name.'</option>';
                  		}                  		
                  	}



					$html.='</select>                      
                    </div>';



					$html .= '
		                      <div style="width: 50%; padding-top: 10px; padding-left: 10px; float: left;">
		                      	<label class="textarea textarea-resizable inputstl" style="width:100%;">
			                    	<textarea rows="2" style="width:100%;" id="comments_text" placeholder="Comments here..."></textarea>
		                      	</label>
		                      </div>

		                      <div style="width: 10%; padding-top: 25px; float: left; padding-left: 10px;">
		                      	<button type="submit" class="btn btn-info" onClick="saveComments()">Save</button>
		                      </div>
	            	';

	            	$html .= '
		                <script type="text/javascript">
							$(".multi_select_comment_type").select2();
						</script>';
				}
				/**************************************************************************************************/




				$html .='
				</div>
			</div>
			';

		}
		echo $html;
	}









	private function get_student_attendance($GSID){
		$this->load->model('student_log/student_log_logtype');
		$GradeName = $this->student_log_logtype->getStudentGradeName($GSID);
		$student['attendance'] = $this->student_log_logtype->getStudentAttendance($GSID, $GradeName, '2016-08-01', '2017-05-31');

		

		$html = '';
		
		$html .="<div class='row'><div id='calendar' style='overflow-y: scroll; height: 65vh;'></div></div>";

		//$html .= $this->comments_button(201);


		$html .= "<script>
            var date = new Date();
            var dd = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();


            $(document).ready(function () {
	            $('#calendar').fullCalendar({
	                header: {
	                    left: 'prev,next today,title',
	                    right: 'month,agendaWeek,agendaDay'
	                },

	                windowResize: function(view) {
		                $('.greenEvent').css('background-color','green');
			            $('.redEvent').css('background-color','red');
			            $('.blueEvent').css('background-color','blue');
			            $('.pinkEvent').css('background-color','pink');
			            $('.yellowEvent').css('background-color','yellow');
			            $('.orangeEvent').css('background-color','orange');
			            $('.fc-event-inner').css('background-color','transparent');
	                },


	                events: [";

	                foreach ($student['attendance'] as $data) {
	                	if(strtotime($data->date) <= strtotime(date("Y-m-d"))){
		                	if($data->grade_on == '0'){
	                			$html .= "
			                	{
				                    title: ' Grade O F F',
				                    start: new Date(" . intval($data->year) . ", " . (intval($data->month)-1) . ", " . intval($data->day) . "),
				                    className: ['event', 'pinkEvent']
				                },";                		
				            }

				            if($data->is_holiday == '1' && $data->is_weekend == '0'){
	                			$html .= "
			                	{
				                    title: '" . $data->day_description . "',
				                    start: new Date(" . intval($data->year) . ", " . (intval($data->month)-1) . ", " . intval($data->day) . "),
				                    className: ['event', 'blueEvent']
				                },";
	                		}


		                	if ($data->time != "") {
		                		if($data->tmp_card == 'Day Pass'){
						        	$html .= "
						        	{
					                    title: 'Day Pass',
					                    start: new Date(" . intval($data->year) . ", " . (intval($data->month)-1) . ", " . intval($data->day) . "),
					                    className: ['event', 'yellowEvent']
					                },";
						        }else if($data->tmp_card == 'Interim'){
						        	$html .= "
						        	{
					                    title: 'Interim',
					                    start: new Date(" . intval($data->year) . ", " . (intval($data->month)-1) . ", " . intval($data->day) . "),
					                    className: ['event', 'orangeEvent']
					                },";
						        }

			                	$html .= "
			                	{
				                    title: '',
				                    start: new Date(" . intval($data->year) . ", " . (intval($data->month)-1) . ", " . intval($data->day) . ", " . intval($data->hours) . ", " . intval($data->minutes) . "),
				                    className: ['event', 'greenEvent'],
				                    allDay: false
				                },";
			                }else if($data->time == "" && intval($data->grade_on) == 1){
	                			$html .= "
			                	{
				                    title: 'Absent',
				                    start: new Date(" . intval($data->year) . ", " . (intval($data->month)-1) . ", " . intval($data->day) . "),
				                    className: ['event', 'redEvent']
				                },";
				            }
				        }
		            }


	                /*{
	                    title: dd+' / '+m+' / '+y,
	                    start: new Date(2016, 7, 2),
	                    className: ['event', 'greenEvent'],
	                },

	                {
	                    title: 'Event',
	                    start: new Date(y, m, dd - 5),
	                    end: new Date(y, m, dd - 2),
	                    className:['event','redEvent']
	                },
	                {
	                    title:'This is the Test Case Of CommentThis is the Test Case Of CommentThis is the Test Case Of CommentThis is the Test Case Of Comment',
	                    start:new Date(y,m,dd-5,12,0),
	                    className:['event', 'redEvent'],
	                    allDay: false
	                },
	                {
	                    title:'This is the Test Case Of Comment This is the Test Case of Commnent ',
	                    start:new Date(y,m,dd-5,3,0),
	                    className:['event', 'redEvent'],
	                    allDay: false
	                }*/

                $html .="
	                ],

	            });

	            $('.greenEvent').css('background-color','green');
	            $('.redEvent').css('background-color','red');
	            $('.blueEvent').css('background-color','blue');
	            $('.pinkEvent').css('background-color','pink');
	            $('.yellowEvent').css('background-color','yellow');
	            $('.orangeEvent').css('background-color','orange');
	            $('.fc-event-inner').css('background-color','transparent');

	            $(document).click(function(){
	                
	            $('.greenEvent').css('background-color','green');
	            $('.redEvent').css('background-color','red');
	            $('.blueEvent').css('background-color','blue');
	            $('.pinkEvent').css('background-color','pink');
	            $('.yellowEvent').css('background-color','yellow');
	            $('.orangeEvent').css('background-color','orange');
	            $('.fc-event-inner').css('background-color','transparent');


	            });
	        });
            </script>";

		return $html;
	}










	private function get_student_smartcard($GSID){
		$html = '';
		$this->load->model('student_log/student_log_logtype');
		$student['smartcard'] = $this->student_log_logtype->getStudentSmartCardDetail($GSID);


		$html .= '<table class="table table-condensed table-bordered margin-0px">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Date</th>
                      <th>Description</th>
                      <th>Purpose</th>
                    </tr>
                  </thead>
                  <tbody>';
                    


		foreach ($student['smartcard'] as $gs) {
			if($gs->new_adm == '1'){
			$html .= '<tr class="success">
                      <td>'.$gs->num.'</td>
                      <td>'.$gs->req_date.'</td>
                      <td>'.$gs->description.'</td>
                      <td><span class="label label-success">'.$gs->card_description.'</span></td>
                    </tr>';	
            }else if($gs->duplicate == '1'){
            	$html .= '<tr>
                      <td>'.$gs->num.'</td>
                      <td>'.$gs->req_date.'</td>
                      <td>'.$gs->description.'</td>
                      <td><span class="label label-danger">'.$gs->card_description.'</span></td>
                    </tr>';
            }
		}

		$html .=  '</tbody>
                </table>';


        //$html .= $this->comments_button(101);

		return $html;
	}










	private function get_comments($GSID){
		$html = '';

		$html .= 'This is student comments: ' . $GSID;




		return $html;
	}







	private function comments_button($CommentsCode){
		$html = '<style>
		.comments_button {
			position: absolute;
			right:    20px;
			bottom:   20px;
		}
		</style>';


		
		$html .= '<a class="btn btn-danger comments_button" onClick="showComments(' . $CommentsCode . ');"><i class="fa fa-pencil-square-o"></i> Comments </a>';




		return $html;
	}













	public function get_these_comments(){
		$html = '';
		$commentsID = $_POST['commentsID'];
		$GSID = $_POST['GSID'];


		if(count($_POST)){

			$this->load->model('student_log/student_log_logtype');
			

			$html .= '';



			if($commentsID == 101){		// Student Smart Card
				$this->data['log_type'] = $this->student_log_logtype->get();
				$this->data['comments'] = $this->student_log_logtype->get_comments($GSID, 'Student Smart Card');


				$html .= '
				<div class="chat-messages user-profile-chat" style="overflow-y: scroll; height: 75vh;" id="all_comments_div">
                <ul>';



                foreach ($this->data['comments'] as $comment) {              
                $ImageName = base_url() . $this->data['staff_150_photo_path'] . $comment->employee_id . $this->data['photo_file'];
                $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                $ImageFound = "Yes";

                if (!file_exists($this->data['staff_150_photo_path'] . $comment->employee_id . $this->data['photo_file'])) {
                    if($comment->gender == 'M'){
                        $ImageName = $ImageMale;
                    }else if($comment->gender == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";              
                }
                	
                	if($comment->comments != ''){
                		if($comment->user_id == $this->session->userdata('user_id')){
                			$html .= '<li class="right clearfix">
		                    <div class="user-img pull-right"> <img src="'.$ImageName.'" alt="User Avatar"> </div>
			                    <div class="chat-body clearfix">
			                      <div class="header"> <span class="name">'.$comment->staff_name.'</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->'.$comment->created.'</span></div>
			                      <p> '.$comment->comments.' </p>
			                    </div>
		                  	</li>';
                		}else{
                			$html .= '<li class="left clearfix">
		                    <div class="user-img pull-left"> <img src="'.$ImageName.'" alt="User Avatar"> </div>
			                    <div class="chat-body clearfix">
			                      <div class="header"> <span class="name">'.$comment->staff_name.'</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->'.$comment->created.'</span></div>
			                      <p> '.$comment->comments.' </p>
			                    </div>
		                  	</li>';
                		}
	                }
	            }

                $html .= '</ul>
  				</div>';
	  			


                $html .= '<div class="chat-message-form" style="margin-top: 10px;">
                  <div class="row">
                  	<div class="col-md-3">
                  		<select class="multi_select_comment_type" multiple="multiple" style="width:100%;" placeholder="Tags are here!">';

                  	foreach ($this->data['log_type'] as $log) {
                  		if($log->name == "Student_Smart_Card"){
							$html .= '<option value="'.$log->dname.'" selected="selected">'.$log->dname.'</option>';
                  		}else{
                  			$html .= '<option value="'.$log->dname.'">'.$log->dname.'</option>';
                  		}                  		
                  	}

					$html.='</select>
                      
                    </div>
                    <div class="col-md-9">
                      <textarea id="comments_text" placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2"></textarea>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <button class="btn btn-info pull-right" type="button" onClick="saveComments();"> S a v e </button>
                    </div>
                  </div>
                </div>';





                $html .= '
                <script type="text/javascript">
					$(".multi_select_comment_type").select2();
				</script>';
			}else if($commentsID == 201){		// Student Attendance
				$this->data['log_type'] = $this->student_log_logtype->get();
				$this->data['comments'] = $this->student_log_logtype->get_comments($GSID, 'Student Attendance');


				$html .= '
				<div class="chat-messages user-profile-chat" style="overflow-y: scroll; height: 75vh;" id="all_comments_div">
                <ul>';



                foreach ($this->data['comments'] as $comment) {              
                $ImageName = base_url() . $this->data['staff_150_photo_path'] . $comment->employee_id . $this->data['photo_file'];
                $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                $ImageFound = "Yes";

                if (!file_exists($this->data['staff_150_photo_path'] . $comment->employee_id . $this->data['photo_file'])) {
                    if($comment->gender == 'M'){
                        $ImageName = $ImageMale;
                    }else if($comment->gender == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";              
                }
                	
                	if($comment->comments != ''){
                		if($comment->user_id == $this->session->userdata('user_id')){
                			$html .= '<li class="right clearfix">
		                    <div class="user-img pull-right"> <img src="'.$ImageName.'" alt="User Avatar"> </div>
			                    <div class="chat-body clearfix">
			                      <div class="header"> <span class="name">'.$comment->staff_name.'</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->'.$comment->created.'</span></div>
			                      <p> '.$comment->comments.' </p>
			                    </div>
		                  	</li>';
                		}else{
                			$html .= '<li class="left clearfix">
		                    <div class="user-img pull-left"> <img src="'.$ImageName.'" alt="User Avatar"> </div>
			                    <div class="chat-body clearfix">
			                      <div class="header"> <span class="name">'.$comment->staff_name.'</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->'.$comment->created.'</span></div>
			                      <p> '.$comment->comments.' </p>
			                    </div>
		                  	</li>';
                		}
	                }
	            }

                $html .= '</ul>
  				</div>';
	  			


                $html .= '<div class="chat-message-form" style="margin-top: 10px;">
                  <div class="row">
                  	<div class="col-md-3">
                  		<select class="multi_select_comment_type" multiple="multiple" style="width:100%;" placeholder="Tags are here!">';

                  	foreach ($this->data['log_type'] as $log) {
                  		if($log->name == "Student_Attendance"){
							$html .= '<option value="'.$log->dname.'" selected="selected">'.$log->dname.'</option>';
                  		}else{
                  			$html .= '<option value="'.$log->dname.'">'.$log->dname.'</option>';
                  		}                  		
                  	}

					$html.='</select>
                      
                    </div>
                    <div class="col-md-9">
                      <textarea id="comments_text" placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2"></textarea>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                      
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                      <button class="btn btn-info pull-right" type="button" onClick="saveComments();"> S a v e </button>
                    </div>
                  </div>
                </div>';





                $html .= '
                <script type="text/javascript">
					$(".multi_select_comment_type").select2();
				</script>';
			}
		}

		echo $html;
	}







	public function save_these_comments(){
		$html = '';

		if(count($_POST)){
			$this->load->model('student_log/student_log_comments');

			$Tags = $_POST['tag'];
			$Comments = $_POST['comments'];
			$GSID = $_POST['GSID'];

			$StudentID = $this->student_log_comments->getStudentID($GSID);


			if(strlen($Comments) > 3){
				$table_data = array(
					'student_id' => (int)$StudentID,
					'tag' => $Tags,
					'comments' => $Comments
				);
				$this->student_log_comments->save($table_data);
			}
		}
	}








	



	private function get_student_timeline($GSID, $timelineOptions){
		/*$this->load->model('student_log/student_log_logtype');
		$data['log_type'] = $this->student_log_logtype->getAllLogNames();*/


		$this->load->model('atif_sp/stored_procedure_model');
		$LimitFrom = 0;
		$LimitTo = 10;
		$LimitToFinal = $LimitTo + 1;


		if($timelineOptions==''){
			$student['timeline'] = $student['timeline'] = $this->stored_procedure_model->get_ThisStudent_TimeLine_Options($GSID, $LimitFrom, $LimitToFinal, "log_name = 'XXXXXXXXX'");
		}else{
			$student['timeline'] = $this->stored_procedure_model->get_ThisStudent_TimeLine_Options($GSID, $LimitFrom, $LimitToFinal, $timelineOptions);
		}

		$html = '';



		$html .= '
		<div class="row">
		  <div id="id_student_timeline" style="overflow-y: scroll; height: 55vh;">
            <div class="activity-block">
              <ul class="tmtimeline" id="tmtimeline">';


        $counter = $LimitFrom;
        $recordsAvailable = 0;
        foreach ($student['timeline'] as $data) {
	        if($counter < $LimitTo) {
		        $html .= '
		        	<li>
		              <time class="tmtime" datetime="' . $data->recorded_date . ', ' . $data->recorded_time .'"><span>' . $data->day_before . ',  ' . $data->recorded_time .'</span> <span>' . $data->recorded_date_format .'</span></time>
		              <div class="tmicon ' . $data->color_icon .' ' . $data->icon .'"></div>
		              <div class="tmlabel">
		                <h2>' . $data->log_name .'</h2>';


		        if($data->reason != '' && strpos($data->reason, ',') > 0){
		        	$StaffName = substr($data->reason, 0, strpos($data->reason, ','));
		        	$EmployeeID = substr($data->reason, strpos($data->reason, ',')+1, strlen($data->reason));
		        	$ImageName = base_url() . $this->data['staff_150_photo_path'] . $EmployeeID . $this->data['photo_file'];
					$ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
					$ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
					$ImageFound = "Yes";

					if (!file_exists($this->data['staff_150_photo_path'] . $EmployeeID . $this->data['photo_file'])) {
						$ImageName = $ImageMale;
						$ImageFound = "No";              
					}



					$html .= '
					<div class="user-img pull-right" style="position: absolute; visibility: visible; right: 5px; top: 4px; z-index: 200; text-align: right;">
						 <img src="'.$ImageName.'" alt="User Avatar" style="height: 60px; width: 60px;">
						 <div class="chat-body clearfix">
						  <div class="header"> <span class="name">'.$StaffName.'</span><span class="name"></span>
						  </div>
						</div>
					</div>
					';
		        }


		        $html .= '<p> (' . $data->day_name_short . ')  ' . $data->change_description .'.</p>
		              </div>
		            </li>
		        ';
	    	}else{
	    		$recordsAvailable = 1;
	    	}
        
        	$counter++;
        }


		$html .= '
			  </ul>
            </div>
          </div>';

        $RecordCounter = $counter - 1;
        if($recordsAvailable == 1){
        	$html .= '<div id="timeline_more_records">';
        	$html .= 'Displaying ' . $RecordCounter . ' records, <input type="hidden" id="timeline_records" value="' . $RecordCounter . '"> <input type="hidden" id="timeline_gsid" value="' . $GSID . '"> <a id="timeline_show_link" href="#">show more?</a>';
        	$html .= '</div>';
        }


        

        $html .= '</div>
		';


		return $html;
	}














	private function just_sample($GSID){
		$html = '';

		$html .= 'This is student ppfile: ' . $GSID;




		return $html;
	}

















	public function get_ThisStudent_LimeLine(){
		$html = '';

		if(count($_POST)){
			$this->load->model('atif_sp/stored_procedure_model');
			$GSID = $_POST['GSID'];
			$LimitFrom = $_POST['recordFrom'];
			$timelineOptions = trim($_POST['selectedTimeLine']);
			$LimitTo = $LimitFrom + 10;
			$LimitToFinal = $LimitTo + 1;
			

			if($timelineOptions==''){
				$student['timeline'] = $student['timeline'] = $student['timeline'] = $this->stored_procedure_model->get_ThisStudent_TimeLine_Options($GSID, $LimitFrom, $LimitToFinal, "log_name = 'XXXXXXXXX'");
			}else{
				$student['timeline'] = $this->stored_procedure_model->get_ThisStudent_TimeLine_Options($GSID, $LimitFrom, $LimitToFinal, $timelineOptions);
			}



			$counter = $LimitFrom;
	        $recordsAvailable = 0;
	        foreach ($student['timeline'] as $data) {
		        if($counter < $LimitTo) {
			        $html .= '
			        	<li>
			              <time class="tmtime" datetime="' . $data->recorded_date . ', ' . $data->recorded_time .'"><span>' . $data->day_before . ',  ' . $data->recorded_time .'</span> <span>' . $data->recorded_date_format .'</span></time>
			              <div class="tmicon ' . $data->color_icon .' ' . $data->icon .'"></div>
			              <div class="tmlabel">
			                <h2>' . $data->log_name .'</h2>
			                <p> (' . $data->day_name_short . ')  ' . $data->change_description .'.</p>
			              </div>
			            </li>
			        ';
		    	}else{
		    		$recordsAvailable = 1;
		    	}

	        	$counter++;
	        }


			$html .= '
				  </ul>
	            </div>
	          </div>';


	        $RecordCounter = $counter - 1;
        	if($recordsAvailable == 1){
        		$html .= '1';
        	}else{
        		$html .= '0';
        	}
		}


		echo $html;
	}











	public function get_TimeLine_Filters(){
		$html = '';


		$this->load->model('student_log/student_log_logtype');
		$data['log_type'] = $this->student_log_logtype->getAllLogNames();

		$html .= '
			<style>
				input[type=checkbox] {
				    width:20px;
				    height:20px;
				    position: relative;
				    top: 5px;
				}
			</style>';

		foreach ($data['log_type'] as $log) {
			$html .= '
			  <label class="checkbox-inline" for="cb_'.$log->name.'">
		        <input name="checkboxes" class="css-checkbox" id="cb_'.$log->name.'" value="'.$log->name.'" type="checkbox" checked="checked">
		        	<font size="3" color="black">'.$log->name.'&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </font>
		      </label>';
		}


		echo $html;
	}
}