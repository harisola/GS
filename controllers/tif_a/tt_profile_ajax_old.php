<?php

class tt_profile_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();

        $this->load->library('session');
        $user_id =  (int)$this->session->userdata('user_id');
	}

	public function view_add_profile(){
		

        $this->load->model('tif_a/tif_a_model','tif');
        $select = '';
        $where = '';
        $days = $this->tif->get_by('atif_staff.weekly_days',$select,$where); 

		$html = '';
		$html .= '<div class="col-md-8" style="padding-right:25px;">';
		$html .= '<div class="col-md-12 ProfileDetail">';
		$html .= '<div class="headingArea"><h2>Add new Profile</h2></div>';
		$html .= '<div class="col-md-6 no-padding borderRight">';
	    $html .= '<form action="" method="POST" id="insert-profile">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
        $html .= 'TT Profile Name';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-8 no-padding">';
        $html .= '<input type="text" placeholder="Teachers NC" id="profile_name" name="profile_name" />';
        $html .= '</div><!-- col-md-8 -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
        $html .= 'Profile Expires On';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-8 no-padding">';
        $html .= '<input class="ProfileExpiry" type="checkbox" name="ProfileExpiry" value="1" style="width:6%;float:left;margin-top:9px;margin-right:4%;"/>';
        $html .= '<input type="date" placeholder=""  id="profile_expiry" class="ProfileExpiryYes" style="width:90%;float:left;display:none;"/>';
        $html .= '</div><!-- col-md-8 -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '<h3>Standard Timings</h3>';

        // Week Days

        $html .= '<div id="StandardTimingWrapper">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .='<table width="100%" border="0" class="ProfileTimingTable StandTime">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="25%">Morning</td>';
        $html .= '<td width="25%">Afternoon</td>';
        $html .= '<td width="25%">Wed Afternoon</td>';
        $html .= '<td width="25%">Fri Afternoon</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $html .=  '<td><input type="time" placeholder="" id="morning_time" /></td>';
        $html .= '<td><input type="time" placeholder="" id="afternoon_time" /></td>';
        $html .= '<td><input type="time" placeholder="" id="wed_afternoon_time" /></td>';
        $html .= '<td><input type="time" placeholder="" id="fri_afternoon_time" /></td>';

        // foreach ($days as $weekly_days) {
        

        // $html .= '<tr>';
        // $html .= '<td><input type="hidden" name="days[]" value="'.$weekly_days->id.'"/>'.$weekly_days->name.'</td>';
        // $html .= '<td><input type="time" id="time_in"  name="time_in[]" class="clear time_in_'.$weekly_days->id.'" data-id="'.$weekly_days->id.'" /></td>';
        // $html .= '<td><input type="time" name = "time_out[]" class="clear time_out_'.$weekly_days->id.'" data-id="'.$weekly_days->id.'" id="time_out" /></td>';
        // $html .= '<td><input type="text" placeholder="Working hours" name=working_hour[] class="clear working_hour_'.$weekly_days->id.'" data-id="'.$weekly_days->id.'" readonly /></td>';
        // $html .= '</tr>';

        // }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- #StandardTimingWrapper -->';


        // ====================== Part Timer ==========================================//

        $html .='<h3>Part Timer &nbsp;&nbsp;<input class="CustomTiming" type="checkbox" name="CustomTiming" value="1"  style="margin-top:4px;"/></h3>';
        $html .= '<div class="CutomTimingWrapper" style="display:none;" >';
        $html .= '<div class="col-md-12 paddingBottom20">';


        $html .= '<table width="100%" border="0" class="ProfileTimingTable" id="partTimer">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="20%">Days</td>';
        $html .= '<td width="30%">Morning</td>';
        $html .= '<td width="30%">Afternoon</td>';
        $html .= '<td width="20%">Working Hours</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';


        foreach ($days as $weekly_days) {
        
        if($weekly_days->id == 7){}else{ 
        $html .= '<tr>';
        $html .= '<td><input type="hidden" name="days[]" value="'.$weekly_days->id.'"/>'.$weekly_days->name.'</td>';
        $html .= '<td><input type="time" id="time_in"  name="time_in[]" class="clear morning time_in_'.$weekly_days->id.'" data-id="'.$weekly_days->id.'" /></td>';
        $html .= '<td><input type="time" name = "time_out[]" class="clear afternoon time_out_'.$weekly_days->id.'" data-id="'.$weekly_days->id.'" id="time_out" /></td>';
        $html .= '<td><input type="text" placeholder="Working hours" name=working_hour[] class="clear working_hour_allocation working_hour_'.$weekly_days->id.'" data-id="'.$weekly_days->id.'" readonly /></td>';
        $html .= '</tr>';
    }

        }

        $html .='</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</div><!-- #CutomTimingWrapper-->';



        $html .= '<h3>Saturdays</h3>';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<div class="col-md-6 no-paddingLeft" >';
        $html .= '<input type="text" placeholder="Working Hours" id="sat_working_hours"/>';
        $html .= '</div><!-- col-md-3 -->';
        $html .= '<div class="col-md-6 no-paddingLeft">';
        $html .= '<input type="text" placeholder="Is ON"  id="saturday_on" class="saturday_on"/>';
        $html .= '</div><!-- col-md-3 -->';
        // $html .= '<div class="col-md-4 no-paddingLeft">';
        // $html .= '<input type="text" placeholder="Is OFF" id="saturday_off"/>';
        // $html .= '</div><!-- col-md-3 -->';
        $html .= '</div><!-- col-md-12 -->';

        // $html .= '<h3>Extension per week</h3>';
        // $html .= '<div class="col-md-12 paddingBottom20">';
        // $html .= '<div class="col-md-4 no-paddingLeft" >';
        // $html .= '<input type="time" placeholder="Extension Time" id="ext_time" />';
        // $html .= '</div><!-- col-md-3 -->';
        // $html .= '<div class="col-md-4 no-paddingLeft">';
        // $html .= '<input type="text" placeholder="Extension Frequency" id="ext_frequency" />';
        // $html .= '</div><!-- col-md-3 -->';
        // $html .= '<div class="col-md-4 no-paddingLeft">';
        // $html .= '<input type="text" placeholder="July Start"  id="july_start"/>';
        // $html .= '</div><!-- col-md-3 -->';
        // $html .= '</div><!-- col-md-12 -->';

        $html .= '<h3>Extension per week &nbsp;&nbsp;<input class="ExtensionInProfile" type="checkbox" name="ExtensionInProfile" value="1"  style="margin-top:4px;"/></h3>';
        $html .= '<div class="col-md-12 paddingBottom20 ExtensionYes"  style="display:none">';
        $html .= '<div class="col-md-4 no-paddingLeft" >';
        $html .= '<div class="col-md-6" style="padding-left:0;padding-right:0;">';
        $html .= '<input style="border-right: 0 none !important;border: 1px solid #a9a9a9;padding: 5px;" type="number" class="col-md-6"  placeholder="Hours" id="ext_hour">';
        $html .= '</div>';
        $html .= '<div class="col-md-6" style="padding-left:0;padding-right:0;">';
        $html .= '<input type="number" class="col-md-6" min="0" max="60" placeholder="min" id="ext_min">';
        $html .= '</div>';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-4 no-paddingLeft">';
        $html .= '<input type="number" placeholder="Extension Frequency" id="ext_frequency" />';
        $html .= '</div><!-- col-md-3 -->';
        $html .= '<div class="col-md-4 no-paddingLeft">';
        $html .= '<input placeholder="July Start" type="date" id="july_start" >'; 
        $html .= '</div><!-- col-md-3 -->
        </div><!-- col-md-12 -->';

        $html .= '</form>';
        $html .= '</div><!-- col-md-6-->';
        $html .= '<div class="col-md-6">';
        $html .= '<h3 class="secTitle">Select Staff for this Profile</h3>';
        $html .= '<table width="100%" border="1" id="StaffListHere" class="table table-striped table-bordered table-hover">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="text-center no-sort" width=""><input type="checkbox"  id="checkAll1"></th>';
        $html .= '<th class="" width="">Name</th>';
        $html .= '<th class="text-center" width="">Department</th>';
        $html .= '<th class="text-center" width="">Profile</th>';
        $html .= '</tr>';
        $html .= '</thead><!-- thead -->';
        $html .= '<tbody>';
        $this->load->model('tif_a/tif_a_model','tif');
        $select= '';
        $where = '';
        $staff_list = $this->tif->get_by('atif.staff_registered',$select,$where);


        // List of profile that is already allocated in Profile
        $staff_allocated = $this->tif->staff_profile_allocated();
        // var_dump($staff_allocated);
        // exit;
        foreach($staff_list as $staff){

            
                $found = 0;

                if(!empty($staff_allocated)){
                    foreach($staff_allocated as $staff_allocate){

                        if($staff_allocate->staff_id == $staff->id){
                            $html .='<tr class="grayedout">';
                            $html .='<td class="text-center"><input disabled="disabled" type="checkbox" name="staffCheck"></td>';
                            $html .= '<td><strong>'.$staff->name.'</strong><br /><small>'.$staff->designation.'</small></td>';
                            $html .= '<td class="text-center">'.$staff->department.'</td>';
                            $html .= '<td class="text-center">'.$staff_allocate->profile_name.'</td>';
                            $html .= '</tr>';
                            $found = 1;
                        }

                    }
                }

                if($found == 0){

                    $html .='<tr>';
                    $html .='<td class="text-center"><input  type="checkbox" name="staffCheck" class="selectAll"  value="'.$staff->id.'"></td>';
                    $html .= '<td><strong>'.$staff->name.'</strong><br /><small>'.$staff->designation.'</small></td>';
                    $html .= '<td class="text-center">'.$staff->department.'</td>';
                    $html .= '<td class="text-center">-</td>';
                    $html .= '</tr>';

                }
         


        

        }
        //$html .= '</tr>';
        $html .= ' </tbody>';
	    $html .= '</table>';
	    $html .= '</div><!-- col-md-6-->';
        // exit;
	    $html .= '<div class="col-md-12 borderTop text-center">';
        // Callout Function
        $html .= '<div class="alert alert-success" style="display:none">
                  <strong>Success!</strong> Insert SuccessFully.
                </div>';
        $html .='<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear"> <input type="submit" id="submit_profile" class="greenBTN widthSmall" id="greenBTN" value="Add new Profile">';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- col-md-12 -->';
	    $html .= '</div><!-- col-md-8 -->';
	    
	    $html .= '<script>';
		// $html .= '$(document).ready(function() {
 	// 			  $("#StaffListHere").dataTable();
		// 		  });';
		// $html .= "$('#checkAll1').click(function () {    
  //                   $(':checkbox.checkItem').prop('checked', this.checked);    
  //               });";
        // $html .= '$(document).on("click","#checkAll1",function(){
        //     $(":checkbox.checkItem").prop("checked", this.checked);
        // });';

        $html .= '$(document).on("click","#checkAll1",function(){
             $(":checkbox.selectAll").prop("checked", this.checked);
        });';
        $html .= '$("#StaffListHere").dataTable();';



       $html .='</script>';

	    echo $html;

	}


    public function insert_profile(){
        //$profile_name  = $this->inp
        // var_dump($this->input->post());
        // exit;

        $profile_name = $this->input->post('profile_name');
        $profile_expiry = $this->input->post('profile_expiry');
        $ext_hour = $this->input->post('ext_hour');
        $ext_min = $this->input->post('ext_min');
        $ext_frequency = $this->input->post('ext_frequency');
        $july_start  = $this->input->post('july_start');
        $sat_working_hours = $this->input->post('sat_working_hours');
        $saturday_on = $this->input->post('saturday_on');
        


        $data = array(
            'name' => $profile_name,
            'dname' => $profile_name,
            'expiry_date' => $profile_expiry,
            'extension_hour' => $ext_hour,
            'extension_min' => $ext_min,
            'extension_frequency' => $ext_frequency,
            'july_start' => $july_start,
            'saturday_working_hours' => $sat_working_hours,
            'saturday_on' => $saturday_on,
            'created' => time(),
            'register_by' => $this->session->userdata('user_id'),
            'modified' => time(),
            'modified_by' => $this->session->userdata('user_id')

        );

        $this->load->model('tif_a/tif_a_model','tif');
        $last_inserted_id =  $this->tif->insert_data('atif_staff.profile_setup',$data);
        echo $last_inserted_id;
    }

    public function insert_week_days(){

        // var_dump($this->input->post());
        // exit;
        
        $profile_id = $this->input->post('profile_id');
        $time_in = $this->input->post('time_in');
        $time_out = $this->input->post('time_out');
        $working_hour = $this->input->post('working_hours');
        $week_day = $this->input->post('week_day');

        for($i = 0 ;$i <sizeof($time_in);$i++){

            if($time_in[$i] == '' && $time_out[$i] == ''  && $working_hour[$i] == ''){
                $record_deleted = 1;
            }else{
                $record_deleted = 0;
            }

            $data = array(
                'profile_setup_id' => $profile_id,
                'weeky_days_id' => $week_day[$i],
                'time_in' => $time_in[$i],
                'time_out' => $time_out[$i],
                'working_hours' => $working_hour[$i],
                'created' => time(),
                'created_by' => $this->session->userdata('user_id'),
                'modified' => time(),
                'modified_by' => $this->session->userdata('user_id'),
                'record_deleted' => $record_deleted
            );

        $this->load->model('tif_a/tif_a_model','tif');
        $last_inserted_id =  $this->tif->insert_data('atif_staff.profile_days',$data);
        echo $last_inserted_id;

        }

    }

    public function insert_staff_allocation(){

        $profile_id = $this->input->post('profile_id');
        $staff_id = $this->input->post('staff_id');

        // var_dump($staff_id);
        // exit;

        for($i=0;$i<sizeof($staff_id);$i++){

            $data = array(
                'profile_setup_id' => $profile_id,
                'staff_id' => $staff_id[$i],
                'created' => time(),
                'created_by' => $this->session->userdata('user_id'),
                'modified' => time(),
                'modified_by' => $this->session->userdata('user_id'),
                'record_deleted' => 0
            );

        $this->load->model('tif_a/tif_a_model','tif');
        $last_inserted_id =  $this->tif->insert_data('atif_staff.staff_profile_allocation',$data);
        echo $last_inserted_id;
        }
    }


    // Edit Profile
    public function edit_profile(){

        $profile_id = $this->input->post('profile_id');
        $this->load->model('tif_a/tif_a_model','tif');
        $select = '';
        $where = '';
        $days = $this->tif->get_by('atif_staff.weekly_days',$select,$where);

        $where_profile = array(
            'id' => $profile_id
        );
        $profile = $this->tif->get_by('atif_staff.profile_setup',$select,$where_profile);

        
        $where_profile_weeks = array(
            'profile_setup_id' => $profile_id
        );
        $profile_weeks = $this->tif->get_by('atif_staff.profile_days',$select,$where_profile_weeks);

        //var_dump($profile_weeks);
        $html = '';
        $html .= '<div class="col-md-8" style="padding-right:25px;">';
        $html .= '<div class="col-md-12 ProfileDetail">';
        $html .= '<div class="headingArea"><h2>Edit Profile</h2></div>';
        $html .= '<div class="col-md-6 no-padding borderRight">';
        $html .= '<form action="" method="POST">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
        $html .= 'TT Profile Name';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-8 no-padding">';
        $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id">';
        $html .= '<input type="text" value="'.$profile[0]->name.'" id="profile_update_name" />';
        $html .= '</div><!-- col-md-8 -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';

        // var_dump($profile);
        // $html .= '<div class="col-md-12 paddingBottom20">';
        // $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
        // $html .= 'Profile Expires On';
        // $html .= '</div><!-- col-md-4 -->';
        // $html .= '<div class="col-md-8 no-padding">';
        // $html .= '<input class="ProfileExpiry" type="checkbox" name="ProfileExpiry" value="1" style="width:6%;float:left;margin-top:9px;margin-right:4%;"/>';
        // $html .= '<input type="date" placeholder=""  id="profile_expiry" class="ProfileExpiryYes" style="width:90%;float:left;display:none;"/>';
        // $html .= '</div><!-- col-md-8 -->';
        // $html .= '</div><!-- col-md-12 -->';

        $html .= 'Profile Expires On';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-8 no-padding">';
        if($profile[0]->expiry_date == '0000-00-00'){
            $html .= '<input class="ProfileExpiry" type="checkbox" name="ProfileExpiry" value="1" style="width:6%;float:left;margin-top:9px;margin-right:4%;"/>';
             $html .= '<input type="date" placeholder=""  id="profile_update_expiry" class="ProfileExpiryYes" style="width:90%;float:left;display:none;"/>';

        }else{
            $html .= '<input class="ProfileExpiry" type="checkbox" name="ProfileExpiry" value="1" style="width:6%;float:left;margin-top:9px;margin-right:4%;" checked />';
             $html .= '<input type="date" value="'.$profile[0]->expiry_date.'" id="profile_update_expiry" class="ProfileExpiryYes" style="width:90%;float:left;"/>';
        }
        
       
        $html .= '</div><!-- col-md-8 -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '<h3>Standard Timings</h3>';


        // Week days
        $html .= '<div id="StandardTimingWrapper">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .='<table width="100%" border="0" class="ProfileTimingTable">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="20%">Days</td>';
        $html .= '<td width="30%">Time In</td>';
        $html .= '<td width="30%">Time Out</td>';
        $html .= '<td width="20%">Working Hours</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';


        foreach ($days as $weekly_days) {
        
        foreach($profile_weeks as $profile_week){

        if($profile_week->weeky_days_id == $weekly_days->id){

            // if week days is not available
           // var_dump($profile_weeks);
            if($profile_week->record_deleted == 1){

                $html .= '<tr>';
                $html .= '<td><input type="hidden" name="days_update[]" value="'.$weekly_days->id.'"/>'.$weekly_days->name.'</td>';
                $html .= '<td><input type="time" id="time_in_update"  name="time_in_update[]" class="time_in_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" /></td>';
                $html .= '<td><input type="time" name = "time_out_update[]" class="time_out_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" id="time_out_update" /></td>';
                $html .= '<td><input type="text" placeholder="Working hours" name=working_hour_update[] class="working_hour_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" readonly/></td>';
                $html .= '</tr>';

                // $html .= '<div id="StandardTimingWrapper">';
                // $html .= '<div class="col-md-12 paddingBottom20">';
                // $html .= '<div class="col-md-3 no-paddingLeft" >';
                // $html .= '<select name="days_update[]" class="days_update">';
                
                // $html .= '<option value="'.$weekly_days->id.'" selected>'.$weekly_days->name.'</option>';

                // $html .= '</select>';
                //$html .= '</div><!-- col-md-3 -->';
                //$html .= '<div class="col-md-3 no-paddingLeft">';
                // $html .= '<input type="time"  name="time_in_update[]" class="time_in_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" id="time_in_update"  />';
                // $html .= '</div><!-- col-md-3 -->';
                // $html .= '<div class="col-md-3 no-paddingLeft">';
                // $html .= '<input type="time" name = "time_out_update[]" class="time_out_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" id="time_out_update"  />';
                // $html .= '</div><!-- col-md-3 -->';
                // $html .= '<div class="col-md-3 no-paddingLeft paddingRight0">';
                // $html .= '<input type="text" placeholder="Working hours" name=working_hour_update[] class="working_hour_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'"  />';
                // $html .=  '</div><!-- col-md-3 -->';
                // $html .= '</div><!-- col-md-12 -->';
                // $html .= '</div><!-- #StandardTimingWrapper -->';

            }else{

                $html .= '<tr>';
                $html .= '<td><input type="hidden" name="days_update[]" value="'.$weekly_days->id.'"/>'.$weekly_days->name.'</td>';
                $html .= '<td><input type="time" id="time_in_update"  name="time_in_update[]" class="time_in_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" value="'.$profile_week->time_in.'" /></td>';
                $html .= '<td><input type="time" name = "time_out_update[]" class="time_out_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" id="time_out_update" value="'.$profile_week->time_out.'" /></td>';
                $html .= '<td><input type="text" placeholder="Working hours" name=working_hour_update[] class="working_hour_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" value="'.$profile_week->working_hours.'" readonly /></td>';
                $html .= '</tr>';

                // $html .= '<div id="StandardTimingWrapper">';
                // $html .= '<div class="col-md-12 paddingBottom20">';
                // $html .= '<div class="col-md-3 no-paddingLeft" >';
                // $html .= '<select name="days_update[]" class="days_update">';
                
                // $html .= '<option value="'.$weekly_days->id.'" selected>'.$weekly_days->name.'</option>';

                // $html .= '</select>';
                // $html .= '</div><!-- col-md-3 -->';
                // $html .= '<div class="col-md-3 no-paddingLeft">';
                // $html .= '<input type="time"  name="time_in_update[]" class="time_in_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" value="'.$profile_week->time_in.'" id="time_in_update" />';
                // $html .= '</div><!-- col-md-3 -->';
                // $html .= '<div class="col-md-3 no-paddingLeft">';
                // $html .= '<input type="time" name = "time_out_update[]" class="time_out_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" id="time_out_update" value="'.$profile_week->time_out.'" />';
                // $html .= '</div><!-- col-md-3 -->';
                // $html .= '<div class="col-md-3 no-paddingLeft paddingRight0">';
                // $html .= '<input type="text" placeholder="Working hours" name=working_hour_update[] class="working_hour_update_'.$weekly_days->id.'" data-id_update="'.$weekly_days->id.'" value="'.$profile_week->working_hours.'" />';
                // $html .=  '</div><!-- col-md-3 -->';
                // $html .= '</div><!-- col-md-12 -->';
                // $html .= '</div><!-- #StandardTimingWrapper -->';
            }
          }

        }

      }

        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- #StandardTimingWrapper -->';
        

        $html .= '<h3>Saturdays</h3>';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<div class="col-md-6 no-paddingLeft" >';
        if($profile[0]->saturday_working_hours == 0){

            $html .= '<input type="text"  placeholder="Working Hours" id="sat_working_hours_update"/>';

        }else{
        $html .= '<input type="text" value="'.$profile[0]->saturday_working_hours.'" id="sat_working_hours_update"/>';
        }
        $html .= '</div><!-- col-md-3 -->';
        // $html .= '<div class="col-md-6 no-paddingLeft">';
        // $html .= '<input type="text" value="'.$profile[0]->saturday_off.'"  id="saturday_on_update" class="saturday_on" />';
        //$html .= '</div><!-- col-md-3 -->';
        $html .= '<div class="col-md-6 no-paddingLeft">';
        if($profile[0]->saturday_on == 0){
        $html .= '<input type="text"  id="saturday_on_update" placeholder="Is ON"/>';

        }else{
        $html .= '<input type="text" value="'.$profile[0]->saturday_on.'" id="saturday_on_update" placeholder="Is ON"/>';
        }
        $html .= '</div><!-- col-md-3 -->';
        $html .= '</div><!-- col-md-12 -->';

        if($profile[0]->extension_hour == 0 && $profile[0]->extension_min == 0 && $profile[0]->extension_frequency == 0  &&$profile[0]->july_start == 0){

        $html .= '<h3>Extension per week &nbsp;&nbsp;<input class="ExtensionInProfile" type="checkbox" name="ExtensionInProfile" value="1"  style="margin-top:4px;"/></h3>';
        $html .= '<div class="col-md-12 paddingBottom20 ExtensionYes"  style="display:none">';
        $html .= '<div class="col-md-4 no-paddingLeft" >';
        $html .= '<div class="col-md-6" style="padding-left:0;padding-right:0;">';
        $html .= '<input style="border-right: 0 none !important;border: 1px solid #a9a9a9;padding: 5px;" type="number" class="col-md-6" min="0" max="12" placeholder="Hours" id="ext_update_hour" value="'.$profile[0]->extension_hour.'">';
        $html .= '</div>';
        $html .= '<div class="col-md-6" style="padding-left:0;padding-right:0;">';
        $html .= '<input type="number" class="col-md-6" min="0" max="60" placeholder="min" id="ext_update_min" value="'.$profile[0]->extension_min.'">';
        $html .= '</div>';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-4 no-paddingLeft">';
        $html .= '<input type="number" value="'.$profile[0]->extension_frequency.'" id="ext_update_frequency" placeholder="Frequency" />';
        $html .= '</div><!-- col-md-3 -->';
        $html .= '<div class="col-md-4 no-paddingLeft">';
        $html .= '<input type="date" value="'.$profile[0]->july_start.'" id="july_update_start"/>'; 
        $html .= '</div><!-- col-md-3 -->
        </div><!-- col-md-12 -->';

        }else{
        $html .= '<h3>Extension per week &nbsp;&nbsp;<input class="ExtensionInProfile" type="checkbox" name="ExtensionInProfile" value="1"  style="margin-top:4px;" checked/></h3>';
        $html .= '<div class="col-md-12 paddingBottom20 ExtensionYes"  >';
        $html .= '<div class="col-md-4 no-paddingLeft" >';
        $html .= '<div class="col-md-6" style="padding-left:0;padding-right:0;">';
        $html .= '<input style="border-right: 0 none !important;border: 1px solid #a9a9a9;padding: 5px;" type="number" class="col-md-6" min="0" max="12" placeholder="Hours" id="ext_update_hour" value="'.$profile[0]->extension_hour.'">';
        $html .= '</div>';
        $html .= '<div class="col-md-6" style="padding-left:0;padding-right:0;">';
        $html .= '<input type="number" class="col-md-6" min="0" max="60" placeholder="min" id="ext_update_min" value="'.$profile[0]->extension_min.'">';
        $html .= '</div>';
        $html .= '</div><!-- col-md-4 -->';
        $html .= '<div class="col-md-4 no-paddingLeft">';
        $html .= '<input type="number" value="'.$profile[0]->extension_frequency.'" id="ext_update_frequency" />';
        $html .= '</div><!-- col-md-3 -->';
        $html .= '<div class="col-md-4 no-paddingLeft">';
        $html .= '<input type="date" value="'.$profile[0]->july_start.'" id="july_update_start"/>'; 
        $html .= '</div><!-- col-md-3 -->
        </div><!-- col-md-12 -->';
    }


        // $html .= '<h3>Extension per week</h3>';
        // $html .= '<div class="col-md-12 paddingBottom20">';
        // $html .= '<div class="col-md-4 no-paddingLeft" >';
        // $html .= '<input type="time" value="'.$profile[0]->extension_time.'" id="ext_update_time"  />';
        // $html .= '</div><!-- col-md-3 -->';
        // $html .= '<div class="col-md-4 no-paddingLeft">';
        // $html .= '<input type="text" value="'.$profile[0]->extension_frequency.'" id="ext_update_frequency"  />';
        // $html .= '</div><!-- col-md-3 -->';
        // $html .= '<div class="col-md-4 no-paddingLeft">';
        // $html .= '<input type="text" value="'.$profile[0]->july_start.'" id="july_update_start"/>';
        // $html .= '</div><!-- col-md-3 -->';
        // $html .= '</div><!-- col-md-12 -->';
        $html .= '</form>';
        $html .= '</div><!-- col-md-6-->';
        $html .= '<div class="col-md-6">';
        $html .= '<h3 class="secTitle">Select Staff for this Profile</h3>';
        $html .= '<table width="100%" border="1"  class="table table-striped table-bordered table-hover" id="calltable">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="text-center no-sort" width=""><input type="checkbox" value="" id="checkAlledit"></th>';
        $html .= '<th class="" width="">Name</th>';
        $html .= '<th class="text-center" width="">Department</th>';
        $html .= '<th class="text-center" width="">Profile</th>';
        $html .= '</tr>';
        $html .= '</thead><!-- thead -->';
        $html .= '<tbody>';


        $this->load->model('tif_a/tif_a_model','tif');
        $select= '';
        $where = '';
        $staff = $this->tif->get_by('atif.staff_registered',$select,$where);


        // Get Staff Profile Allocation 

        // $select = '';
        // $where  = array(
        //     'profile_setup_id' => $profile_id,
        //     'record_deleted' => 0
        // );

        // $staff_profile_allocation = $this->tif->get_by("atif_staff.staff_profile_allocation",$select,$where);

        $staff_profile_allocation = $this->tif->staff_profile_allocated();

        foreach($staff as $staff){
            $found = 0;
            foreach($staff_profile_allocation as $staff_allocation){
                if($staff_allocation->staff_id == $staff->id && $staff_allocation->profile_id == $profile_id ){

                $html .= '<tr class="">';
                $html .= '<td class="text-center"><input type="checkbox" name="staffCheckupdated" class="checkItem1" value="'.$staff->id.'" checked></td>';
                $html .= '<td><strong>'.$staff->name.'</strong><br /><small>'.$staff->designation.'</small></td>';
                $html .= '<td class="text-center">'.$staff->department.'</td>';
                $html .= '<td class="text-center">Current Profile</td>';
                $html .= '</tr>';
                $found = 2;
                }else if($staff_allocation->staff_id == $staff->id && $found != 2){

                $html .= '<tr class="grayedout">';
                $html .= '<td class="text-center"><input disabled="disabled" type="checkbox" name="staffCheckupdated" class="checkItem2" value="'.$staff->id.'"></td>';
                $html .= '<td><strong>'.$staff->name.'</strong><br /><small>'.$staff->designation.'</small></td>';
                $html .= '<td class="text-center">'.$staff->department.'</td>';
                $html .= '<td class="text-center">'.$staff_allocation->profile_name.'</td>';
                $html .= '</tr>';
                $found = 1;

                }
            }

            if($found == 0){

                $html .= '<tr class="">';
                $html .= '<td class="text-center"><input type="checkbox" name="staffCheckupdated" class="checkItem1" value="'.$staff->id.'"></td>';
                $html .= '<td><strong>'.$staff->name.'</strong><br /><small>'.$staff->designation.'</small></td>';
                $html .= '<td class="text-center">'.$staff->department.'</td>';
                $html .= '<td class="text-center">-</td>';
                $html .= '</tr>';

            }

        }
       // $html .= '</tr>';
        $html .= ' </tbody>';
        $html .= '</table>';
        $html .= '</div><!-- col-md-6-->';
        
        $html .= '<div class="col-md-12 borderTop text-center">';
        $html .= '<div class="alert alert-success" style="display:none">
                  <strong>Success!</strong> Update SuccessFully.
                </div>';
        $html .='<input type="submit" id="edit_profile" class="greenBTN widthSmall" id="greenBTN" value="Edit Profile">';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- col-md-8 -->';
        
        $html .= '<script>';
        $html .= '$(document).ready(function() {
                  $("#calltable").dataTable();
                  });';
        $html .= "$('#checkAlledit').click(function () {    
                    $(':checkbox.checkItem1').prop('checked', this.checked);    
                 });";
        $html .='</script>';

        echo $html;

    }


    // Profile Setup Updated

    public function update_profile_setup(){

        // var_dump($this->input->post());
        // exit;
        
        $profile_id = $this->input->post('profile_id');
        $profile_update_name = $this->input->post('profile_update_name');
        $profile_update_expiry = $this->input->post('profile_update_expiry');
        $ext_update_hour = $this->input->post('ext_update_hour');
        $ext_update_min = $this->input->post('ext_update_min');
        $ext_update_frequency = $this->input->post('ext_update_frequency');
        $july_update_start = $this->input->post('july_update_start');
        $sat_working_hours_update = $this->input->post('sat_working_hours_update');
        $saturday_on_update = $this->input->post('saturday_on_update');

        $where = array(
            'id'=> $profile_id
        );

        $data = array(
            'name' => $profile_update_name,
            'dname' => $profile_update_name,
            'expiry_date' => $profile_update_expiry,
            'extension_hour' => $ext_update_hour,
            'extension_min' => $ext_update_min,
            'extension_frequency' => $ext_update_frequency,
            'july_start' => $july_update_start,
            'saturday_working_hours' => $sat_working_hours_update,
            'saturday_on' => $saturday_on_update,
            'modified' => time(),
            'modified_by' => $this->session->userdata('user_id')

        );

        $this->load->model('tif_a/tif_a_model','tif');
        $affected_rows = $this->tif->update_data('atif_staff.profile_setup',$where,$data);
        echo $affected_rows;
    }


    public function edit_week_days(){
        // var_dump($this->input->post());
        // exit;
        $this->load->model('tif_a/tif_a_model','tif');

        $profile_id = $this->input->post('profile_id');
        $week_day_update = $this->input->post('week_day_update');
        $time_in_update = $this->input->post('time_in_update');
        $time_out_update = $this->input->post('time_out_update');
        $working_hour_update = $this->input->post('working_hour_update');

        for ($i=0;$i<sizeof($week_day_update);$i++){

            $where = array(
                'profile_setup_id' => $profile_id,
                'weeky_days_id' => $week_day_update[$i],
            );

            if($time_in_update[$i] == '' && $time_out_update[$i] == '' && ($working_hour_update[$i] == '' || $working_hour_update[$i] == 'NaN')){
                        $record_deleted = 1;
            }else{
                $record_deleted = 0;
            }

            $data = array(
                'time_in' => $time_in_update[$i],
                'time_out' => $time_out_update[$i],
                'working_hours' => $working_hour_update[$i],
                'modified' => time(),
                'modified_by' => $this->session->userdata('user_id'),
                'record_deleted' => $record_deleted

            );
            $affected_rows = $this->tif->update_data('atif_staff.profile_days',$where,$data);
            echo $affected_rows;
        }
    }

    public function edit_staff_allocation(){


        $this->load->model('tif_a/tif_a_model','tif');
   
        $profile_id = $this->input->post('profile_id');
        $staff_id = $this->input->post('staff_id');

        $where = array(
            'profile_setup_id' => $profile_id
        );

        $data = array(
            'record_deleted' => 1
        );
        $affected_rows = $this->tif->update_data('atif_staff.staff_profile_allocation',$where,$data);
        echo $affected_rows;

        if(!empty($staff_id)){
            for($i=0;$i<sizeof($staff_id);$i++){

                $data_inserted = array(
                    'staff_id' => $staff_id[$i],
                    'profile_setup_id' => $profile_id,
                    'created' => time(),
                    'created_by' => $this->session->userdata('user_id'),
                    'modified' => time(),
                    'modified_by' => $this->session->userdata('user_id'),
                );

                $inserted_data = $this->tif->insert_data('atif_staff.staff_profile_allocation',$data_inserted);
                echo $inserted_data;
            }
        }


    }

    public function get_profile(){

        $this->load->model('tif_a/tif_a_model','tif');
        $profile = $this->tif->profile_staff_allocation();
         $html = '';
         $html .='<div class="LeftListing" style="">';
            
           $html .='<div class="LeftListing_ContentSection">';
           $html .= '<div class="headingArea"><h2>Default Super Profiles <a href="#" class="absoluteBtn" id="add-profile">Add new Profile</a></h2></div>
                <table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">';
            $html .= '<thead>';
            $html .='<tr>';
            $html .='<th class="text-center no-sort" width="">SR</th>';
            $html .= '<th class="" width="">Name</th>';
            $html .='<th class="no-sort text-center" width="">Allocations</th>';
            $html .= '</tr>';
            $html .='</thead><!-- thead -->';
            $html .='<tbody>';
            $count_staff = 1; 
            foreach($profile as $profile) { 
            $html .='<tr class="" id="add_'.$profile->id.'">';
            $html .= '<td class="text-center">'. $count_staff. '</td>';
            $html .='<td><a href="javascript:void(0)"  id="profile_click" data-profile_id="'. $profile->id.'">'. $profile->name .'</a></td>';
            $html .='<td class="text-center">'. $profile->staff_allocated .'</td>';
            $html .= '</tr>';
            $count_staff++; 
            } 

            $html .= '</tbody>';
            $html .='</table><!-- ListingTable -->';
            $html .='</div><!-- LeftListing_ContentSection -->';
            $html .='</div><!-- .StudentListing -->';

            $html .= '<script>';
            $html .= '$("#TTListing").dataTable({
                      "columnDefs": [ {
                          "targets": "no-sort",
                          "orderable": false,
                    } ],
                    "bLengthChange": false,
                    "bInfo" : false,
                    "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
                    "iDisplayLength": 25
                  });';
            $html .= '</script>';

            echo $html;

    }
}