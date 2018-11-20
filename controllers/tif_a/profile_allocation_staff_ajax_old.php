<?php 

class Profile_allocation_staff_ajax extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$user_id =  (int)$this->session->userdata('user_id');
	}


	// Allocate Standard Staff

	public function allocate_std_staff() {

		$this->load->model('tif_a/profile_allocation_model','pam');

		$profile_id = $this->input->post('profile_id');
		$profile_type_id = $this->input->post('profile_type_id');
		$staff = $this->input->post('staff_id');

		$where_profile = array(
			'profile_id' => $profile_id
		);
		
		$select = '';
		$profile_detail =  $this->pam->get_by('atif_gs_events.tt_profile_time',$select,$where_profile);
		
		$is_on_mon = $profile_detail[0]->is_on_mon;
		$use_ext = $profile_detail[0]->use_ext;
		$avg_hrs = $profile_detail[0]->avg_week_hrs;
		$ext_frequency = $profile_detail[0]->ext_frequency;
		$july_start = $profile_detail[0]->ext_july;
		$sat_hour = $profile_detail[0]->sat_hrs;
		$sat_off = $profile_detail[0]->sat_off;
		$sat_on = $profile_detail[0]->sat_working;
		$wed_time = $profile_detail[0]->wed_out;
		$fri_time = $profile_detail[0]->fri_out;

		if($is_on_mon == 1){
			$morning_time = $profile_detail[0]->mon_in;
			$afternoon_time = $profile_detail[0]->mon_out;
		}else{
			$morning_time = '';
			$afternoon_time = '';
		}

		if($use_ext == 1){
			$ext_time = $profile_detail[0]->ext_time;
		}else{
			$ext_time = '';
		}






	    foreach($staff as $staff_id){

	    // IS on Flag Morning And Afternoon

	    if($morning_time != '' && $afternoon_time != ''){
	      $is_on_mon = 1;
	      $is_on_tue = 1;
	      $is_on_wed = 1;
	      $is_on_thu = 1;
	      $is_on_fri = 1;
	      $is_on_sat = 1;
	      $is_on_sun = 1;
	    }else{

	      $is_on_mon = 0;
	      $is_on_tue = 0;
	      $is_on_wed = 0;
	      $is_on_thu = 0;
	      $is_on_fri = 0;
	      $is_on_sat = 0;
	      $is_on_sun = 0;

	    }

	    // Is On Flag on EXT Time

	    if($ext_time != ''){
	      $use_ext = 1;
	    }else{
	      $use_ext = 0;
	    }


	    $select = 'id';
	    $where_staff  = array(
	    	'staff_id' => $staff_id
	    );

	    $staff_profile =  $this->pam->get_by('atif_gs_events.tt_profile_time_staff',$select,$where_staff);

	    if(!empty($staff_profile)){

	    	$staff_profile_id = $staff_profile[0]->id;

	    	$where_staff_profile  = array(
      			'id' => $staff_profile_id
    		);

    		$data_staff_profile = array(
      			'profile_id' => $profile_id,
      			'is_on_mon' => $is_on_mon,
			    'is_on_tue' => $is_on_tue,
			    'is_on_wed' => $is_on_wed,
			    'is_on_thu' => $is_on_thu,
			    'is_on_fri' => $is_on_fri,
			    'is_on_sat' => $is_on_sat,
			    'is_on_sun' => $is_on_sun,
			    'staff_id' => $staff_id,
			    'mon_in' => $morning_time,
			    'tue_in' => $morning_time,
			    'wed_in' => $morning_time,
			    'thu_in' => $morning_time,
			    'fri_in' => $morning_time,
			    'sat_in' => $morning_time,
			    'sun_in' => $morning_time,
			    'mon_out' => $afternoon_time,
			    'tue_out' => $afternoon_time,
			    'wed_out' => $afternoon_time,
			    'thu_out' => $afternoon_time,
			    'fri_out' => $afternoon_time,
			    'sat_out' => $afternoon_time,
			    'sun_out' => $afternoon_time,
			    'avg_week_hrs' => $avg_hrs,
			    'use_ext' => $use_ext,
			    'ext_time' => $ext_time,
			    'ext_frequency' => $ext_frequency,
			    'ext_july' => $july_start,
			    'sat_hrs' => $sat_hour,
			    'sat_off' => $sat_off,
			    'sat_working' => $sat_on,
			    'created' => time(),
			    'created_by' => $this->session->userdata('user_id'),
			    'modified' => time(),
			    'modified_by' => $this->session->userdata('user_id')
    		);

    		$affected_row = $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where_staff_profile,$data_staff_profile);

    		// Update WED TIME 
		    if($wed_time != ''){

		      $where = array(
		        'id' => $staff_profile_id
		      );

		      $update_data = array(
		        'wed_out' => $wed_time
		      );

		      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
		      echo $affected_row;
		    }

		    if($fri_time != ''){

		      $where = array(
		        'id' => $staff_profile_id
		      );

		      $update_data = array(
		        'fri_out' => $fri_time
		      );

		      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
		      echo $affected_row;
		    } // Fri Time End


	    }else{





	    $data = array(
	      'profile_id' => $profile_id,
	      'is_on_mon' => $is_on_mon,
	      'is_on_tue' => $is_on_tue,
	      'is_on_wed' => $is_on_wed,
	      'is_on_thu' => $is_on_thu,
	      'is_on_fri' => $is_on_fri,
	      'is_on_sat' => $is_on_sat,
	      'is_on_sun' => $is_on_sun,
	      'staff_id' => $staff_id,
	      'mon_in' => $morning_time,
	      'tue_in' => $morning_time,
	      'wed_in' => $morning_time,
	      'thu_in' => $morning_time,
	      'fri_in' => $morning_time,
	      'sat_in' => $morning_time,
	      'sun_in' => $morning_time,
	      'mon_out' => $afternoon_time,
	      'tue_out' => $afternoon_time,
	      'wed_out' => $afternoon_time,
	      'thu_out' => $afternoon_time,
	      'fri_out' => $afternoon_time,
	      'sat_out' => $afternoon_time,
	      'sun_out' => $afternoon_time,
	      'avg_week_hrs' => $avg_hrs,
	      'use_ext' => $use_ext,
	      'ext_time' => $ext_time,
	      'ext_frequency' => $ext_frequency,
	      'ext_july' => $july_start,
	      'sat_hrs' => $sat_hour,
	      'sat_off' => $sat_off,
	      'sat_working' => $sat_on,
	      'created' => time(),
	      'created_by' => $this->session->userdata('user_id'),
	      'modified' => time(),
	      'modified_by' => $this->session->userdata('user_id')
	    );

	    $last_id = $this->pam->insert_data('atif_gs_events.tt_profile_time_staff',$data);
	    //echo $last_id;


	    // Update WED TIME 
	    if($wed_time != ''){

	      $where = array(
	        'id' => $last_id
	      );

	      $update_data = array(
	        'wed_out' => $wed_time
	      );

	      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
	      echo $affected_row;
	    }

	    if($fri_time != ''){

	      $where = array(
	        'id' => $last_id
	      );

	      $update_data = array(
	        'fri_out' => $fri_time
	      );

	      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
	      echo $affected_row;
	    } // Fri Time End

	} // End Else

	  } // End Foreach For Staff

	}




	// GET LEFT PANEL

	public function get_left_panel(){

		$this->load->model('tif_a/profile_allocation_model','pam');
		$staff_profile = $this->pam->get_StaffProfile();
		

		$html = '';
		$html .= '<table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width=""><input type="checkbox" id="checkAll"></th>
	                        <th class="" width="">Staff Name<br /><small>Dept / Designation</small></th>
                            <th class="text-left" width="">Name Code<br /><small>GT ID</small></th>
                            <th class="text-left" width="">Profile</th>
                          </tr>
	                  </thead><!-- thead -->
					   <tbody>';
		foreach($staff_profile as $staff){
	    $html .=  '<tr class="">';
	    $html .= '<td class="text-center"><input type="checkbox" class="staffCheck" value="'.$staff->staff_id.'"></td>';
	    $html .= '<td><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top"  data-pin-nopin="true" class="anchorCol select-staff" data-id='.$staff->staff_id.' data-profile='.$staff->profile_id.' data-profile_type="'.$staff->profile_type_id.'" data-staff_name="'.$staff->abridged_name.'">'.$staff->abridged_name.'</a><br /><small>'.$staff->designation.'/ '.$staff->department.'</small></td>
                            <td class="text-left">'.$staff->name_code.'<br /><small>'.$staff->gt_id.'</small></td>
                            <td class="text-left">'.$staff->profile_name.'</td>
                        </tr>';
        }
	    $html .= '</tbody>
	                </table><!-- ListingTable -->';


	    echo $html;


	}


		// Allocate Custom Staff

	 public function allocate_cus_staff() {

		$this->load->model('tif_a/profile_allocation_model','pam');

		$profile_id = $this->input->post('profile_id');
		$profile_type_id = $this->input->post('profile_type_id');
		$staff = $this->input->post('staff_id');

		$where_profile = array(
			'profile_id' => $profile_id
		);
		
		$select = '';
		$profile_detail =  $this->pam->get_by('atif_gs_events.tt_profile_time',$select,$where_profile);
		
		$is_on_mon = $profile_detail[0]->is_on_mon;
		$use_ext = $profile_detail[0]->use_ext;
		$avg_hrs = $profile_detail[0]->avg_week_hrs;
		$ext_frequency = $profile_detail[0]->ext_frequency;
		$july_start = $profile_detail[0]->ext_july;
		$sat_hour = $profile_detail[0]->sat_hrs;
		$sat_off = $profile_detail[0]->sat_off;
		$sat_on = $profile_detail[0]->sat_working;
		$wed_time = $profile_detail[0]->wed_out;
		$fri_time = $profile_detail[0]->fri_out;

		if($is_on_mon == 1){
			$morning_time = $profile_detail[0]->mon_in;
			$afternoon_time = $profile_detail[0]->mon_out;
		}else{
			$morning_time = '';
			$afternoon_time = '';
		}

		if($use_ext == 1){
			$ext_time = $profile_detail[0]->ext_time;
		}else{
			$ext_time = '';
		}






	    foreach($staff as $staff_id){

	    // IS on Flag Morning And Afternoon

	    if($morning_time != '' && $afternoon_time != ''){
	      $is_on_mon = 1;
	      $is_on_tue = 1;
	      $is_on_wed = 1;
	      $is_on_thu = 1;
	      $is_on_fri = 1;
	      $is_on_sat = 1;
	      $is_on_sun = 1;
	    }else{

	      $is_on_mon = 0;
	      $is_on_tue = 0;
	      $is_on_wed = 0;
	      $is_on_thu = 0;
	      $is_on_fri = 0;
	      $is_on_sat = 0;
	      $is_on_sun = 0;

	    }

	    // Is On Flag on EXT Time

	    if($ext_time != ''){
	      $use_ext = 1;
	    }else{
	      $use_ext = 0;
	    }


	    $select = 'id';
	    $where_staff  = array(
	    	'staff_id' => $staff_id
	    );

	    $staff_profile =  $this->pam->get_by('atif_gs_events.tt_profile_time_staff',$select,$where_staff);

	    if(!empty($staff_profile)){

	    	$staff_profile_id = $staff_profile[0]->id;

	    	$where_staff_profile  = array(
      			'id' => $staff_profile_id
    		);

    		$data_staff_profile = array(
      			'profile_id' => $profile_id,
      			'is_on_mon' => $is_on_mon,
			    'is_on_tue' => $is_on_tue,
			    'is_on_wed' => $is_on_wed,
			    'is_on_thu' => $is_on_thu,
			    'is_on_fri' => $is_on_fri,
			    'is_on_sat' => $is_on_sat,
			    'is_on_sun' => $is_on_sun,
			    'staff_id' => $staff_id,
			    'mon_in' => $morning_time,
			    'tue_in' => $morning_time,
			    'wed_in' => $morning_time,
			    'thu_in' => $morning_time,
			    'fri_in' => $morning_time,
			    'sat_in' => $morning_time,
			    'sun_in' => $morning_time,
			    'mon_out' => $afternoon_time,
			    'tue_out' => $afternoon_time,
			    'wed_out' => $afternoon_time,
			    'thu_out' => $afternoon_time,
			    'fri_out' => $afternoon_time,
			    'sat_out' => $afternoon_time,
			    'sun_out' => $afternoon_time,
			    'avg_week_hrs' => $avg_hrs,
			    'use_ext' => $use_ext,
			    'ext_time' => $ext_time,
			    'ext_frequency' => $ext_frequency,
			    'ext_july' => $july_start,
			    'sat_hrs' => $sat_hour,
			    'sat_off' => $sat_off,
			    'sat_working' => $sat_on,
			    'created' => time(),
			    'created_by' => $this->session->userdata('user_id'),
			    'modified' => time(),
			    'modified_by' => $this->session->userdata('user_id')
    		);

    		$affected_row = $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where_staff_profile,$data_staff_profile);

    		// Update WED TIME 
		    if($wed_time != ''){

		      $where = array(
		        'id' => $staff_profile_id
		      );

		      $update_data = array(
		        'wed_out' => $wed_time
		      );

		      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
		      echo $affected_row;
		    }

		    if($fri_time != ''){

		      $where = array(
		        'id' => $staff_profile_id
		      );

		      $update_data = array(
		        'fri_out' => $fri_time
		      );

		      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
		      echo $affected_row;
		    } // Fri Time End


	    }else{





	    $data = array(
	      'profile_id' => $profile_id,
	      'is_on_mon' => $is_on_mon,
	      'is_on_tue' => $is_on_tue,
	      'is_on_wed' => $is_on_wed,
	      'is_on_thu' => $is_on_thu,
	      'is_on_fri' => $is_on_fri,
	      'is_on_sat' => $is_on_sat,
	      'is_on_sun' => $is_on_sun,
	      'staff_id' => $staff_id,
	      'mon_in' => $morning_time,
	      'tue_in' => $morning_time,
	      'wed_in' => $morning_time,
	      'thu_in' => $morning_time,
	      'fri_in' => $morning_time,
	      'sat_in' => $morning_time,
	      'sun_in' => $morning_time,
	      'mon_out' => $afternoon_time,
	      'tue_out' => $afternoon_time,
	      'wed_out' => $afternoon_time,
	      'thu_out' => $afternoon_time,
	      'fri_out' => $afternoon_time,
	      'sat_out' => $afternoon_time,
	      'sun_out' => $afternoon_time,
	      'avg_week_hrs' => $avg_hrs,
	      'use_ext' => $use_ext,
	      'ext_time' => $ext_time,
	      'ext_frequency' => $ext_frequency,
	      'ext_july' => $july_start,
	      'sat_hrs' => $sat_hour,
	      'sat_off' => $sat_off,
	      'sat_working' => $sat_on,
	      'created' => time(),
	      'created_by' => $this->session->userdata('user_id'),
	      'modified' => time(),
	      'modified_by' => $this->session->userdata('user_id')
	    );

	    $last_id = $this->pam->insert_data('atif_gs_events.tt_profile_time_staff',$data);
	    //echo $last_id;


	    // Update WED TIME 
	    if($wed_time != ''){

	      $where = array(
	        'id' => $last_id
	      );

	      $update_data = array(
	        'wed_out' => $wed_time
	      );

	      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
	      echo $affected_row;
	    }

	    if($fri_time != ''){

	      $where = array(
	        'id' => $last_id
	      );

	      $update_data = array(
	        'fri_out' => $fri_time
	      );

	      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
	      echo $affected_row;
	    } // Fri Time End

	} // End Else

	  } // End Foreach For Staff

	}



	// Allocate Part Time Staff
	public function allocate_part_staff(){

		$this->load->model('tif_a/profile_allocation_model','pam');

		$profile_id = $this->input->post('profile_id');
		$profile_type_id = $this->input->post('profile_type_id');
		$staff_id = $this->input->post('staff_id');

		$where_profile = array(
			'profile_id' => $profile_id
		);
		
		$select = '';
		$profile_detail =  $this->pam->get_by('atif_gs_events.tt_profile_time',$select,$where_profile);

		$is_on_mon = $profile_detail[0]->is_on_mon;
		$is_on_tue = $profile_detail[0]->is_on_tue;
		$is_on_wed = $profile_detail[0]->is_on_wed;
		$is_on_thu = $profile_detail[0]->is_on_thu;
		$is_on_fri = $profile_detail[0]->is_on_fri;
		$is_on_sat = $profile_detail[0]->is_on_sat;
		$is_on_sun = $profile_detail[0]->is_on_sun;



		if($is_on_mon == 1){
			$mon_in = $profile_detail[0]->mon_in;
			$mon_out = $profile_detail[0]->mon_out;
		}else{
			$mon_in = '';
			$mon_out = '';
		}

		if($is_on_tue == 1){
			$tue_in = $profile_detail[0]->tue_in;
			$tue_out = $profile_detail[0]->tue_out;
		}else{
			$tue_in = '';
			$tue_out = '';
		}

		if($is_on_wed == 1){
			$wed_in = $profile_detail[0]->wed_in;
			$wed_out = $profile_detail[0]->wed_out;
		}else{
			$wed_in = '';
			$wed_out = '';
		}

		if($is_on_thu == 1){
			$thu_in = $profile_detail[0]->thu_in;
			$thu_out = $profile_detail[0]->thu_out;
		}else{
			$thu_in = '';
			$thu_out = '';
		}

		if($is_on_fri == 1){
			$fri_in = $profile_detail[0]->fri_in;
			$fri_out = $profile_detail[0]->fri_out;
		}else{
			$fri_in = '';
			$fri_out = '';
		}


		if($is_on_sat == 1){
			$sat_in = $profile_detail[0]->sat_in;
			$sat_out = $profile_detail[0]->sat_out;
		}else{
			$sat_in = '';
			$sat_out = '';
		}

		if($is_on_sun == 1){
			$sun_in = $profile_detail[0]->sun_in;
			$sun_out = $profile_detail[0]->sun_out;
		}else{
			$sun_in = '';
			$sun_out = '';
		}

		$avg_week_hrs = $profile_detail[0]->avg_week_hrs;
		$use_ext = $profile_detail[0]->use_ext;
		$ext_time = $profile_detail[0]->ext_time;
		$ext_frequency = $profile_detail[0]->ext_frequency;
		$ext_july = $profile_detail[0]->ext_july;
		$sat_hrs = $profile_detail[0]->sat_hrs;
		$sat_off = $profile_detail[0]->sat_off;
		$sat_working = $profile_detail[0]->sat_working;

		foreach($staff_id as $staff){

		$select = 'id';
	    $where_staff  = array(
	    	'staff_id' => $staff
	    );

	    $staff_profile =  $this->pam->get_by('atif_gs_events.tt_profile_time_staff',$select,$where_staff);

	    if(!empty($staff_profile)){

	    	$staff_profile_id = $staff_profile[0]->id;

	    	$where_staff_profile  = array(
      			'id' => $staff_profile_id
    		);

    		$data_staff_profile = array(
		      'profile_id' => $profile_id,
		      'is_on_mon' =>  $is_on_mon,
		      'is_on_tue' =>  $is_on_tue,
		      'is_on_wed' =>  $is_on_wed,
		      'is_on_thu' =>  $is_on_thu,
		      'is_on_fri' =>  $is_on_fri,
		      'is_on_sat' =>  $is_on_sat,
		      'is_on_sun' =>  0,
		      'staff_id' => $staff,
		      'mon_in' =>  $mon_in,
		      'tue_in' =>  $tue_in,
		      'wed_in' =>  $wed_in,
		      'thu_in' =>  $thu_in,
		      'fri_in' =>  $fri_in,
		      'sat_in' =>  $sat_in,
		      'sun_in' =>  $sun_in,
		      'mon_out' => $mon_out,
		      'tue_out' => $tue_out,
		      'wed_out' => $wed_out,
		      'thu_out' => $thu_out,
		      'fri_out' => $fri_out,
		      'sat_out' => $sat_out,
		      'sun_out' => $sun_out,
		      'avg_week_hrs' => $avg_week_hrs,
		      'use_ext' => $use_ext,
		      'ext_time' => $ext_time,
		      'ext_frequency' => $ext_frequency,
		      'ext_july' => $ext_july,
		      'sat_hrs' => $sat_hrs,
		      'sat_off' => $sat_off,
		      'sat_working' => $sat_working,
		      'created' => time(),
		      'created_by' => $this->session->userdata('user_id'),
		      'modified' => time(),
		      'modified_by' => $this->session->userdata('user_id')
    		);

    		$affected_row = $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where_staff_profile,$data_staff_profile);


    	}else{
		    $data = array(
		      'profile_id' => $profile_id,
		      'is_on_mon' =>  $is_on_mon,
		      'is_on_tue' =>  $is_on_tue,
		      'is_on_wed' =>  $is_on_wed,
		      'is_on_thu' =>  $is_on_thu,
		      'is_on_fri' =>  $is_on_fri,
		      'is_on_sat' =>  $is_on_sat,
		      'is_on_sun' =>  0,
		      'staff_id' => $staff,
		      'mon_in' =>  $mon_in,
		      'tue_in' =>  $tue_in,
		      'wed_in' =>  $wed_in,
		      'thu_in' =>  $thu_in,
		      'fri_in' =>  $fri_in,
		      'sat_in' =>  $sat_in,
		      'sun_in' =>  $sun_in,
		      'mon_out' => $mon_out,
		      'tue_out' => $tue_out,
		      'wed_out' => $wed_out,
		      'thu_out' => $thu_out,
		      'fri_out' => $fri_out,
		      'sat_out' => $sat_out,
		      'sun_out' => $sun_out,
		      'avg_week_hrs' => $avg_week_hrs,
		      'created' => time(),
		      'created_by' => $this->session->userdata('user_id'),
		      'modified' => time(),
		      'modified_by' => $this->session->userdata('user_id')

		    );

		    
		    $last_id = $this->pam->insert_data('atif_gs_events.tt_profile_time_staff',$data);
		} // End Else

		} // END STAFF``

	}


	// GET PROFILE

	public function get_profile(){

		$profile_id = $this->input->post('profile_id');
		$profile_type_id = $this->input->post('profile_type_id');

		$where = array(
			'profile_id' => $profile_id
		);

		$select = '';
		$this->load->model('tif_a/profile_allocation_model','pam');
		$profile_detail =  $this->pam->get_by('atif_gs_events.tt_profile_time',$select,$where);
		// var_dump($profile_detail);
		$html = '';

    //==================== Standard Profile ================//
    //======================================================//
    
		if($profile_type_id == 1){

		$html .= '<div class="standardDIV">';
        $html .= '<h3>Standard Timings</h3>';
        $html .= '<div id="StandardTimingWrapper">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable StandTime">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td colspan="4" width="34%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Morning</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Afternoon</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Wed</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Time</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Freq</td>';
        $html .= '<td width="10%" bgcolor="#daeef3" style="border-right: 1px solid #666;">July Start</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Hours</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Off</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Working</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';

        $html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
        $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />';
        if($profile_detail[0]->is_on_mon == 1){
        	$html .= '<td><input type="time"  value="'.$profile_detail[0]->mon_in.'" readonly id="std_morning" name="std_morning" /></td>';
        	$html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->mon_out.'" readonly id="std_afternoon" name="std_afternoon"/></td>';
        }else{
        	$html .= '<td><input type="time" placeholder="" id="std_morning" name="std_morning" /></td>';
        	$html .= '<td><input type="time" placeholder="" id="std_afternoon" name="std_afternoon" /></td>';
        }



       if($profile_detail[0]->mon_out != $profile_detail[0]->wed_out){
       		$html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->wed_out.'" readonly id="std_wed" name="std_wed"/></td>';
       }else{
       	    $html .= '<td><input type="time" placeholder=""  readonly id="std_wed" name="std_wed" /></td>';
       } 	
        
       if(!empty($profile_detail[0]->fri_out)){
       		$html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" value="'.$profile_detail[0]->fri_out.'" readonly id="std_fri" name="std_fri" /></td>';
       }else{
       		$html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" readonly id="std_fri" name="std_fri"  /></td>';
       } 

        
       if($profile_detail[0]->use_ext == 1){
       		$html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->ext_time.'" readonly id="std_ext" name="std_ext" /></td>';
       }else{
       		$html .= '<td><input type="time" placeholder="" readonly id="std_ext" name="std_ext" /></td>';
       } 
        
       if($profile_detail[0]->ext_frequency != 0){
       		$html .= '<td><input type="number" placeholder="" value="'.$profile_detail[0]->ext_frequency.'" readonly id="std_frequency" name="std_frequency" /></td>';
       }else{
       		$html .= '<td><input type="number"  value="" readonly id="std_frequency" name="std_frequency" /></td>';
       }

       if($profile_detail[0]->ext_july != '0000-00-00'){
       		$html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="'.$profile_detail[0]->ext_july.'" readonly id="std_july" name="std_july" /></td>';
       }else{
       		$html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="" id="std_july" name="std_july" readonly /></td>';
       }
        

       if($profile_detail[0]->sat_hrs !=  0){
       		$html .= '<td><input type="number" placeholder="e.g. 4.5" value="'.$profile_detail[0]->sat_hrs.'" readonly id="std_sat_hrs" name="std_sat_hrs"  /></td>';
       }else{
       		$html .= '<td><input type="number" placeholder="e.g. 4.5" readonly id="std_sat_hrs" name="std_sat_hrs" /></td>';
       }

       if($profile_detail[0]->sat_off != 0){
       		$html .= '<td><input type="number" placeholder="e.g. 3" value="'.$profile_detail[0]->sat_off.'" readonly id="std_off" name="std_off" /></td>';
       }else{
       		$html .= '<td><input type="number" placeholder="e.g. 3" readonly id="std_off" name="std_off" disabled /></td>';
       }
        
       if($profile_detail[0]->sat_working != 0){
       		$html .= '<td><input type="number" placeholder="" readonly value="'.$profile_detail[0]->sat_working.'" id="std_working" name="std_working" /></td>';
       }else{
       		$html .= '<td><input type="number" placeholder="e.g. 2" readonly value=""  id="std_working" disabled/></td>';
       }
        
        
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<hr />';
		$html .= '<div class="col-md-12">';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >M-T Hours</td>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >Fri Hours</td>';
        $html .= '<td width="">Avg Weekly Hours</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td><input type="text" disabled="disabled" id="mon_thurs_hours" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="fri_hrs" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="avg_hrs" value="'.$profile_detail[0]->avg_week_hrs.'" /></td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
		$html .= '</div>';
        $html .= '</div><!-- #StandardTimingWrapper -->';
        $html .= '</div><!-- standardDIV-->';                                
                                                                 	
		}

    // ==================== Custom Profile =========================//
    //=============================================================//

		if($profile_type_id == 2){
		$html .= '<div class="customDIV"  >';
        $html .= '<h3>Custom Timings</h3>';
        $html .= '<div id="StandardTimingWrapper">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable StandTime">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td colspan="4" width="34%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Morning</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Afternoon</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Wed</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Time</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Freq</td>';
        $html .= '<td width="10%" bgcolor="#daeef3" style="border-right: 1px solid #666;">July Start</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Hours</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Off</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Working</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';


        $html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
        $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />';  
        if($profile_detail[0]->is_on_mon == 1){
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->mon_in.'" id="cus_morning" name="cus_morning" readonly /></td>';
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->mon_out.'" id="cus_afternoon" name="cus_afternoon" readonly /></td>';
        }else{

          $html .= '<td><input type="time" placeholder="" id="cus_morning" name="cus_morning" readonly /></td>';
          $html .= '<td><input type="time" placeholder="" id="cus_afternoon" name="cus_afternoon" readonly /></td>';

        }

        if($profile_detail[0]->mon_out != $profile_detail[0]->wed_out){
          $html .= '<td><input type="time"  value="'.$profile_detail[0]->wed_out.'" id="cus_wed" name="cus_wed" readonly /></td>';
        }else{
          $html .= '<td><input type="time" id="cus_wed" name="cus_wed" readonly /></td>';
        }

        
        if(!empty($profile_detail[0]->fri_out)){
          $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" value="'.$profile_detail[0]->fri_out.'" id="cus_fri" name="cus_fri" readonly /></td>';
        }else{
          $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" id="cus_fri" name="cus_fri" readonly /></td>';
        }
        

        if($profile_detail[0]->use_ext == 1){
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->ext_time.'" id="cus_ext" name="cus_ext" readonly /></td>';
        }else{
          $html .= '<td><input type="time" placeholder="" id="cus_ext" name="cus_ext" readonly /></td>';

        }

        if($profile_detail[0]->ext_frequency != 0){
        $html .= '<td><input type="number"  value="'.$profile_detail[0]->ext_frequency.'"  id="cus_frequency" name="cus_frequency" readonly /></td>';

        }else{
          $html .= '<td><input type="number" placeholder="e.g. 2" id="cus_frequency" name="cus_frequency" readonly /></td>';
        }

        if($profile_detail[0]->ext_july != '0000-00-00'){
          $html .= '<td style="border-right: 1px solid #666;"><input type="date"   value="'.$profile_detail[0]->ext_july.'" id="cus_july" name="cus_july" readonly /></td>';
        }else{
          $html .= '<td style="border-right: 1px solid #666;"><input type="date"  id="cus_july" name="cus_july" readonly /></td>';
        }

        if($profile_detail[0]->sat_hrs != 0){
          $html .= '<td><input type="number" placeholder="e.g. 4.5" value="'.$profile_detail[0]->sat_hrs.'" id="cus_sat_hrs" name="cus_sat_hrs" readonly /></td>';
        }else{
          $html .= '<td><input type="number" placeholder="e.g. 4.5" id="cus_sat_hrs" name="cus_sat_hrs" readonly /></td>';
        }
        
        if($profile_detail[0]->sat_off != 0){
          $html .= '<td><input type="number" placeholder="e.g. 3" value="'.$profile_detail[0]->sat_off.'" id="cus_off" name="cus_off" readonly /></td>';
        }else{
          $html .= '<td><input type="number" placeholder="e.g. 3" value="" id="cus_off" name="cus_off" readonly  disabled/></td>';
        }
        

        if($profile_detail[0]->sat_working != 0){
          $html .= '<td><input type="number" placeholder="e.g. 2" value="'.$profile_detail[0]->sat_working.'" id = "cus_working" name = "cus_working" readonly /></td>';
        }else{
          $html .= '<td><input type="number" placeholder="e.g. 2"  id = "cus_working" name = "cus_working" readonly disabled /></td>';
        }
        
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<hr />';
		$html .= '<table width="100%" border="0" class="ProfileTimingTable">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >M-T Hours</td>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >Fri Hours</td>';
        $html .= '<td width="">Avg Weekly Hours</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td><input type="text" disabled="disabled" id="cus_mon_thu_cal" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="cus_fri_cal" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="avg_cus_cal" value="'.$profile_detail[0]->avg_week_hrs.'" /></td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</div><!-- #StandardTimingWrapper -->';
        $html .= '</div><!-- customDIV-->';

		}

		if($profile_type_id == 3){
		$html .= '<div class="partTIMEDIV" >';
		$html .= '<h3>Part Timer</h3>';
		$html .= '<div class="CutomTimingWrapper">';
		$html .= '<div class="col-md-12 paddingBottom20">';
		$html .= '<table width="100%" border="0" class="ProfileTimingTable">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>&nbsp;</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>';
		$html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
		$html .= '</tr>';

		$html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
    	$html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />';

		$html .= '<tr>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>In</strong></td>';
		if($profile_detail[0]->is_on_mon == 1){
			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_in)).'</a></td>';
			$html .= '<input type="hidden" id="avg_mon_in" value = '.$profile_detail[0]->mon_in.'>';
		}else{

			$html .= '<td  width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
			$html .= '<input type="hidden" id="avg_mon_in />"';

		}

		if($profile_detail[0]->is_on_tue == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_tue_in" value = '.$profile_detail[0]->tue_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_tue_in />"';

		}

		if($profile_detail[0]->is_on_wed == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_wed_in" value = '.$profile_detail[0]->wed_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_wed_in" >';

		}

		if($profile_detail[0]->is_on_thu == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_thu_in" value = '.$profile_detail[0]->thu_in.'>';


		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_thu_in" >';

		}

		if($profile_detail[0]->is_on_fri == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_fri_in" value = '.$profile_detail[0]->fri_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
			$html .= '<input type="hidden" id="avg_fri_in" >';

		}

		if($profile_detail[0]->is_on_sat == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_sat_in" value = '.$profile_detail[0]->sat_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
			$html .= '<input type="hidden" id="avg_sat_in" >';

		}
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2">07:30 AM</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>Out</strong></td>';
		if($profile_detail[0]->is_on_mon == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_mon_out" value = '.$profile_detail[0]->mon_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_mon_out">';

		}

		if($profile_detail[0]->is_on_tue == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_tue_out" value = '.$profile_detail[0]->tue_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_tue_out">';

		}

		if($profile_detail[0]->is_on_wed == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_wed_out" value = '.$profile_detail[0]->wed_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_wed_out">';


		}

		if($profile_detail[0]->is_on_thu == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_thu_out" value = '.$profile_detail[0]->thu_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_thu_out">';

		}

		if($profile_detail[0]->is_on_fri == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_fri_out" value = '.$profile_detail[0]->fri_out.'>';


		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_fri_out">';

		}


		if($profile_detail[0]->is_on_sat == 1){

			$html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_sat_out" value = '.$profile_detail[0]->sat_out.'>';

		}else{

			$html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_sat_out">';

		}
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2">12:00 PM</td>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '</table>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';


/* Dynamic Content from here */
		
		// $html .= '<div class="partTIMEDIV" >';
		// $html .= '<h3>Part Timer</h3>';
		// $html .= '<div class="CutomTimingWrapper">';
		// $html .= '<div class="col-md-12 paddingBottom20">';
		// $html .= '<table width="100%" border="0" class="ProfileTimingTable">';
		// $html .= '<thead>';
		// $html .= '<tr>';
		// $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>';
		// $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>';
		// $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>';
		// $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>';
		// $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>';
		// $html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
		// $html .= '</tr>';
		// $html .= '<tr>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
		// $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
		// $html .= '<td width="">Out</td>';
		// $html .= '</tr>';
		// $html .= '</thead>';
		// $html .= '<tbody>';
		// $html .= '<tr>';

  //   $html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
  //   $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />'; 

  //   if($profile_detail[0]->is_on_mon == 1){

  //    $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_in)).'</a></td>';
  //    $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_out)).'</a></td>';

  //   }else{

  //     $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
  //    $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';

  //   }

  //   if($profile_detail[0]->is_on_tue == 1){

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_in)).'</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_out)).'</a></td>';

  //   }else{

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';
  //   }
		
  //   if($profile_detail[0]->is_on_wed == 1){

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_in)).'</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_out)).'</a></td>';

  //   }else{

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';

  //   }

  //   if($profile_detail[0]->is_on_thu == 1){
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_in)).'</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_out)).'</a></td>';
  //   }else{
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';
  //   }

		// if($profile_detail[0]->is_on_fri == 1){

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_in)).'</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_out)).'</a></td>';
  //   }else{

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';
  //   }

  //   if($profile_detail[0]->is_on_sat == 1){

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_in)).'</a></td>';
  //   $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_out)).'</a></td>';

  //   }else{

  //   $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
  //   $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';

  //   }


		// $html .= '</tr>';
		// $html .= '</tbody>';
		// $html .= '</table>';
		$html .= '<hr />';
		$html .= '<div class="col-md-12">';
		$html .= '<table width="100%" border="0" class="ProfileTimingTable">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<td width="" style="border-right: 1px solid #666;" >M-T Hours</td>';
		$html .= '<td width="" style="border-right: 1px solid #666;" >Fri Hours</td>';
		$html .= '<td width="">Avg Weekly Hours</td>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '<tbody>';
		$html .= '<tr>';
		$html .= '<td><input type="text" disabled="disabled" value="" id="part_time_mon_thu" /></td>';
		$html .= '<td><input type="text" disabled="disabled" value="" id="part_time_fri" /></td>';
		$html .= '<td><input type="text" disabled="disabled" value="'.$profile_detail[0]->avg_week_hrs.'" id="part_time_avg" /></td>';
		$html .= '</tr>';
		$html .= '</tbody>';
		$html .= '</table>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div><!-- #CutomTimingWrapper-->';
		$html .= ' </div><!-- partTIMEDIV -->';


    // $html .= "<script>
    // $(document).ready(function() {
    //     //toggle `popup` / `inline` mode
    //     $.fn.editable.defaults.mode = 'popup';

    //     $('#MonIN,#MonOUT,#TueIN,#TueOUT,#WedIN,#WedOUT,#ThuIN,#ThuOUT,#FriIN,#FriOUT,#SatOUT,#SatIN').editable('option', 'disabled', true);     
        
    //     //make username editable
    //     $('#MonIN').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //     });
    //     $('#MonOUT').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#TueIN').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#TueOUT').editable({
    //        type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#WedIN').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#WedOUT').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#ThuIN').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#ThuOUT').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#FriIN').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#FriOUT').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#SatIN').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
    //     $('#SatOUT').editable({
    //         type: 'text',
    //         format:'h:mm A',
    //         viewformat:'h:mm A',
    //         template: 'h:mm A'
    //       });
          
    //       //make status editable
    //       $('#status').editable({
    //           type: 'select',
    //           title: 'Select status',
    //           placement: 'right',
    //           value: 2,
    //           source: [
    //               {value: 1, text: 'status 1'},
    //               {value: 2, text: 'status 2'},
    //               {value: 3, text: 'status 3'}
    //           ]
    //           /*
    //           //uncomment these lines to send data on server
    //           ,pk: 1
    //           ,url: '/post'
    //           */
    //       });
    //   });
    //   </script>";
               
		}

    // $html .= '<div class="col-md-12 borderTop text-center">';

    // $html .= '<div class="alert alert-success" style="display:none">
    //               <strong>Success!</strong> Profile Allocated SuccessFully.
    //             </div>';
    // $html .= '<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear"> <input type="button" name="submit" class="greenBTN widthSmall" id="allocate_profile" value="Allocate Profile">';
    // $html .= '</div><!-- col-md-12 -->';

   

		echo $html;
		
	}


	public function get_update_allocation(){

	$staff_id = $this->input->post('staff_id');
    $profile_id = $this->input->post('profile_id');
    $staff_name = $this->input->post('staff_name');

    $select = '';
    $where = array(
      'staff_id' => $staff_id,
      'profile_id' => $profile_id,
      'record_deleted' => 0
    );

    $this->load->model('tif_a/profile_allocation_model','pam');
    $profile_detail =  $this->pam->get_by('atif_gs_events.tt_profile_time_staff',$select,$where);

    // ID For Updation

    $id = $profile_detail[0]->id;




    //var_dump($profile_detail);

    //var_dump($staff_profile);

    $where_profile_type = array(
      'id' => $profile_id
      );

    $profile_type_id = $this->pam->get_by('atif_gs_events.tt_profile',$select,$where_profile_type);


    // Profile Name And Profile Type
    $profile_name = $profile_type_id[0]->name;
    $profile_type_id = $profile_type_id[0]->profile_type_id;

    $html = '';

    $html .='<div class="headingArea">
                <h2>Profile Allocated To <strong>'.$staff_name.'</strong></h2>
                <a href="#" style="color:#fff;float:right;margin-top: -16px;"><i class="fa fa-refresh" aria-hidden="true" id="refresh" ></i></a>
              </div>';

    $html .= '<div class="col-md-12 no-padding borderRight">';

    $html .= '<form id="updated_staff_allocation">';
    $html .= '<div class="col-md-6">';
    $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
    $html .= 'Select Profile';
    $html .= '</div><!-- col-md-4 -->';
    $html .= '<div class="col-md-8 no-padding">';
    $html .= '<select required id="">';
    $html .= '<option value="'.$profile_id.'">'.$profile_name.'</option>';
    $html .= '</select>';
    $html .= '</div><!-- col-md-8 -->';
    $html .= '</div><!-- col-md-12 -->';
    $html .= '<br /><br /><br /><br />';

    //==================== Standard Profile ================//
    //======================================================//
    if($profile_type_id == 1){

        $html .= '<div class="standardDIV">';
        $html .= '<h3>Standard Timings</h3>';
        $html .= '<div id="StandardTimingWrapper">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable StandTime">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td colspan="4" width="34%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Morning</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Afternoon</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Wed</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Time</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Freq</td>';
        $html .= '<td width="10%" bgcolor="#daeef3" style="border-right: 1px solid #666;">July Start</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Hours</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Off</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Working</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';

        $html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
        $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />';
        if($profile_detail[0]->is_on_mon == 1){
          $html .= '<td><input type="time"  value="'.$profile_detail[0]->mon_in.'" readonly id="std_morning" name="std_morning" /></td>';
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->mon_out.'" readonly id="std_afternoon" name="std_afternoon"/></td>';
        }else{
          $html .= '<td><input type="time" placeholder="" id="std_morning" name="std_morning" /></td>';
          $html .= '<td><input type="time" placeholder="" id="std_afternoon" name="std_afternoon" /></td>';
        }



       if($profile_detail[0]->mon_out != $profile_detail[0]->wed_out){
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->wed_out.'" readonly id="std_wed" name="std_wed"/></td>';
       }else{
            $html .= '<td><input type="time" placeholder=""  readonly id="std_wed" name="std_wed" /></td>';
       }  
        
       if(!empty($profile_detail[0]->fri_out)){
          $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" value="'.$profile_detail[0]->fri_out.'" readonly id="std_fri" name="std_fri" /></td>';
       }else{
          $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" readonly id="std_fri" name="std_fri"  /></td>';
       } 

        
       if($profile_detail[0]->use_ext == 1){
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->ext_time.'" readonly id="std_ext" name="std_ext" /></td>';
       }else{
          $html .= '<td><input type="time" placeholder="" readonly id="std_ext" name="std_ext" /></td>';
       } 
        
       if($profile_detail[0]->ext_frequency != 0){
          $html .= '<td><input type="number" placeholder="" value="'.$profile_detail[0]->ext_frequency.'" readonly id="std_frequency" name="std_frequency" /></td>';
       }else{
          $html .= '<td><input type="number"  value="" readonly id="std_frequency" name="std_frequency" /></td>';
       }

       if($profile_detail[0]->ext_july != '0000-00-00'){
          $html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="'.$profile_detail[0]->ext_july.'" readonly id="std_july" name="std_july" /></td>';
       }else{
          $html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="" id="std_july" name="std_july" readonly /></td>';
       }
        

       if($profile_detail[0]->sat_hrs !=  0){
          $html .= '<td><input type="number" placeholder="e.g. 4.5" value="'.$profile_detail[0]->sat_hrs.'" readonly id="std_sat_hrs" name="std_sat_hrs"  /></td>';
       }else{
          $html .= '<td><input type="number" placeholder="e.g. 4.5" readonly id="std_sat_hrs" name="std_sat_hrs"  /></td>';
       }

       if($profile_detail[0]->sat_off != 0){
          $html .= '<td><input type="number" placeholder="e.g. 3" value="'.$profile_detail[0]->sat_off.'" readonly id="std_off" name="std_off" /></td>';
       }else{
          $html .= '<td><input type="number" placeholder="e.g. 3" readonly id="std_off" name="std_off"  /></td>';
       }
        
       if($profile_detail[0]->sat_working != 0){
          $html .= '<td><input type="number" placeholder="" readonly value="'.$profile_detail[0]->sat_working.'" id="std_working" name="std_working" /></td>';
       }else{
          $html .= '<td><input type="number" placeholder="e.g. 2" readonly value=""  id="std_working"/></td>';
       }
        
        
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<hr />';
        $html .= '<div class="col-md-12">';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >M-T Hours</td>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >Fri Hours</td>';
        $html .= '<td width="">Avg Weekly Hours</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td><input type="text" disabled="disabled" id="mon_thurs_hours" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="fri_hrs" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="avg_hrs" value="'.$profile_detail[0]->avg_week_hrs.'" /></td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div><!-- #StandardTimingWrapper -->';
        $html .= '</div><!-- standardDIV-->';                                
                                                                  
    }

    // ==================== Custom Profile =========================//
    //=============================================================//

    if($profile_type_id == 2){
    $html .= '<div class="customDIV"  >';
        $html .= '<h3>Custom Timings</h3>';
        $html .= '<div id="StandardTimingWrapper">';
        $html .= '<div class="col-md-12 paddingBottom20">';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable StandTime">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td colspan="4" width="34%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>';
        $html .= '<td colspan="3" width="33%" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Morning</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Afternoon</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb">Wed</td>';
        $html .= '<td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Time</td>';
        $html .= '<td width="10%" bgcolor="#daeef3">Freq</td>';
        $html .= '<td width="10%" bgcolor="#daeef3" style="border-right: 1px solid #666;">July Start</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Hours</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Off</td>';
        $html .= '<td width="10%" bgcolor="#d8e4bc">Working</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';

        $html .= '<input type="hidden" value="'.$id.'" name="update_id" id="update_id" />';
        $html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
        $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />';  
        if($profile_detail[0]->is_on_mon == 1){
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->mon_in.'" id="cus_morning" name="cus_morning"/></td>';
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->mon_out.'" id="cus_afternoon" name="cus_afternoon"/></td>';
        }else{

          $html .= '<td><input type="time" placeholder="" id="cus_morning" name="cus_morning"/></td>';
          $html .= '<td><input type="time" placeholder="" id="cus_afternoon" name="cus_afternoon"/></td>';

        }

        if($profile_detail[0]->mon_out != $profile_detail[0]->wed_out){
          $html .= '<td><input type="time"  value="'.$profile_detail[0]->wed_out.'" id="cus_wed" name="cus_wed"/></td>';
        }else{
          $html .= '<td><input type="time" id="cus_wed" name="cus_wed"/></td>';
        }

        
        if(!empty($profile_detail[0]->fri_out)){
          $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" value="'.$profile_detail[0]->fri_out.'" id="cus_fri" name="cus_fri"/></td>';
        }else{
          $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" id="cus_fri" name="cus_fri"/></td>';
        }
        

        if($profile_detail[0]->use_ext == 1){
          $html .= '<td><input type="time" placeholder="" value="'.$profile_detail[0]->ext_time.'" id="cus_ext" name="cus_ext"/></td>';
        }else{
          $html .= '<td><input type="time" placeholder="" id="cus_ext" name="cus_ext"/></td>';

        }

        if($profile_detail[0]->ext_frequency != 0){
        $html .= '<td><input type="number"  value="'.$profile_detail[0]->ext_frequency.'"  id="cus_frequency" name="cus_frequency"/></td>';

        }else{
          $html .= '<td><input type="number" placeholder="e.g. 2" id="cus_frequency" name="cus_frequency"/></td>';
        }

        if($profile_detail[0]->ext_july != '0000-00-00'){
          $html .= '<td style="border-right: 1px solid #666;"><input type="date"   value="'.$profile_detail[0]->ext_july.'" id="cus_july" name="cus_july"/></td>';
        }else{
          $html .= '<td style="border-right: 1px solid #666;"><input type="date"  id="cus_july" name="cus_july"/></td>';
        }

        if($profile_detail[0]->sat_hrs != 0){
          $html .= '<td><input type="number" placeholder="e.g. 4.5" value="'.$profile_detail[0]->sat_hrs.'" id="cus_sat_hrs" name="cus_sat_hrs"/></td>';
        }else{
          $html .= '<td><input type="number" placeholder="e.g. 4.5" id="cus_sat_hrs" name="cus_sat_hrs" readonly /></td>';
        }
        
        if($profile_detail[0]->sat_off != 0){
          $html .= '<td><input type="number" placeholder="e.g. 3" value="'.$profile_detail[0]->sat_off.'" id="cus_off" name="cus_off"/></td>';
        }else{
          $html .= '<td><input type="number" placeholder="e.g. 3" value="" id="cus_off" name="cus_off" disabled/></td>';
        }
        

        if($profile_detail[0]->sat_working != 0){
          $html .= '<td><input type="number" placeholder="e.g. 2" value="'.$profile_detail[0]->sat_working.'" id = "cus_working" name = "cus_working"/></td>';
        }else{
          $html .= '<td><input type="number" placeholder="e.g. 2"  id = "cus_working" name = "cus_working" disabled /></td>';
        }
        
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '<hr />';
        $html .= '<table width="100%" border="0" class="ProfileTimingTable">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >M-T Hours</td>';
        $html .= '<td width="" style="border-right: 1px solid #666;" >Fri Hours</td>';
        $html .= '<td width="">Avg Weekly Hours</td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td><input type="text" disabled="disabled" id="cus_mon_thu_cal" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="cus_fri_cal" /></td>';
        $html .= '<td><input type="text" disabled="disabled" id="avg_cus_cal" value="'.$profile_detail[0]->avg_week_hrs.'" /></td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '</div><!-- #StandardTimingWrapper -->';
        $html .= '</div><!-- customDIV-->';

    }

    if($profile_type_id == 3){


    	$html .= '<div class="partTIMEDIV" >';
		$html .= '<h3>Part Timer</h3>';
		$html .= '<div class="CutomTimingWrapper">';
		$html .= '<div class="col-md-12 paddingBottom20">';
		$html .= '<table width="100%" border="0" class="ProfileTimingTable">';
		$html .= '<thead>';
		$html .= '<tr>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>&nbsp;</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>';
		$html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
		$html .= '</tr>';

		 $html .= '<input type="hidden" value="'.$id.'" name="update_id" id="update_id" />';
		$html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
    	$html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />';

		$html .= '<tr>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>In</strong></td>';
		if($profile_detail[0]->is_on_mon == 1){
			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_in)).'</a></td>';
			$html .= '<input type="hidden" id="avg_mon_in" value = '.$profile_detail[0]->mon_in.'>';
		}else{

			$html .= '<td  width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
			$html .= '<input type="hidden" id="avg_mon_in />"';

		}

		if($profile_detail[0]->is_on_tue == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_tue_in" value = '.$profile_detail[0]->tue_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_tue_in />"';

		}

		if($profile_detail[0]->is_on_wed == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_wed_in" value = '.$profile_detail[0]->wed_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_wed_in" >';

		}

		if($profile_detail[0]->is_on_thu == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_thu_in" value = '.$profile_detail[0]->thu_in.'>';


		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_thu_in" >';

		}

		if($profile_detail[0]->is_on_fri == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_fri_in" value = '.$profile_detail[0]->fri_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
			$html .= '<input type="hidden" id="avg_fri_in" >';

		}

		if($profile_detail[0]->is_on_sat == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_in)).'</a></td>';

			$html .= '<input type="hidden" id="avg_sat_in" value = '.$profile_detail[0]->sat_in.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
			$html .= '<input type="hidden" id="avg_sat_in" >';

		}
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">07:00 AM</td>';
		//$html .= '<td width="" colspan="2">07:30 AM</td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>Out</strong></td>';
		if($profile_detail[0]->is_on_mon == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_mon_out" value = '.$profile_detail[0]->mon_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_mon_out">';

		}

		if($profile_detail[0]->is_on_tue == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_tue_out" value = '.$profile_detail[0]->tue_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_tue_out">';

		}

		if($profile_detail[0]->is_on_wed == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_wed_out" value = '.$profile_detail[0]->wed_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_wed_out">';


		}

		if($profile_detail[0]->is_on_thu == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_thu_out" value = '.$profile_detail[0]->thu_out.'>';

		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_thu_out">';

		}

		if($profile_detail[0]->is_on_fri == 1){

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_fri_out" value = '.$profile_detail[0]->fri_out.'>';


		}else{

			$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_fri_out">';

		}


		if($profile_detail[0]->is_on_sat == 1){

			$html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_out)).'</a></td>';

			$html .= '<input type="hidden" id="avg_sat_out" value = '.$profile_detail[0]->sat_out.'>';

		}else{

			$html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';

			$html .= '<input type="hidden" id="avg_sat_out">';

		}
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2" style="border-right: 1px solid #666;">04:00 PM</td>';
		//$html .= '<td width="" colspan="2">12:00 PM</td>';
		$html .= '</tr>';
		$html .= '</thead>';
		$html .= '</table>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

    // $html .= '<div class="partTIMEDIV" >';
    // $html .= '<h3>Part Timer</h3>';
    // $html .= '<div class="CutomTimingWrapper">';
    // $html .= '<div class="col-md-12 paddingBottom20">';
    // $html .= '<table width="100%" border="0" class="ProfileTimingTable">';
    // $html .= '<thead>';
    // $html .= '<tr>';
    // $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>';
    // $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>';
    // $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>';
    // $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>';
    // $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>';
    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
    // $html .= '</tr>';
    // $html .= '<tr>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">Out</td>';
    // $html .= '<td width="" style="border-right: 1px solid #666;">In</td>';
    // $html .= '<td width="">Out</td>';
    // $html .= '</tr>';
    // $html .= '</thead>';
    // $html .= '<tbody>';
    // $html .= '<tr>';

    // $html .= '<input type="hidden" value="'.$id.'" name="update_id" id="update_id" />';
    // $html .= '<input type="hidden" value="'.$profile_type_id .'" name="profile_type" id="profile_type_id" />';
    // $html .= '<input type="hidden" value="'.$profile_id.'" id="profile_id" name="profile_id" />'; 

    // if($profile_detail[0]->is_on_mon == 1){

    //  $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_in)).'</a></td>';
    //  $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->mon_out)).'</a></td>';

    // }else{

    //   $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
    //  $html .= '<td style="border-right: 1px solid #666;"><a href="javascript:void(0)" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';

    // }

    // if($profile_detail[0]->is_on_tue == 1){

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_in)).'</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->tue_out)).'</a></td>';

    // }else{

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';
    // }
    
    // if($profile_detail[0]->is_on_wed == 1){

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_in)).'</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->wed_out)).'</a></td>';

    // }else{

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';

    // }

    // if($profile_detail[0]->is_on_thu == 1){
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_in)).'</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->thu_out)).'</a></td>';
    // }else{
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';
    // }

    // if($profile_detail[0]->is_on_fri == 1){

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_in)).'</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->fri_out)).'</a></td>';
    // }else{

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';
    // }

    // if($profile_detail[0]->is_on_sat == 1){

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_in)).'</a></td>';
    // $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">'.date('g:i A',strtotime($profile_detail[0]->sat_out)).'</a></td>';

    // }else{

    // $html .= '<td style="border-right: 1px solid #666;"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
    // $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';

    // }


    // $html .= '</tr>';
    // $html .= '</tbody>';
    // $html .= '</table>';
    $html .= '<hr />';
    $html .= '<div class="col-md-12">';
    $html .= '<table width="100%" border="0" class="ProfileTimingTable">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<td width="33%" colspan="3" bgcolor=""><strong>Calculations</strong></td>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<td width="" style="border-right: 1px solid #666;" >M-T Hours</td>';
    $html .= '<td width="" style="border-right: 1px solid #666;" >Fri Hours</td>';
    $html .= '<td width="">Avg Weekly Hours</td>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= '<tr>';
	$html .= '<td><input type="text" disabled="disabled" value="" id="part_time_mon_thu" /></td>';
	$html .= '<td><input type="text" disabled="disabled" value="" id="part_time_fri" /></td>';
	$html .= '<td><input type="text" disabled="disabled" value="'.$profile_detail[0]->avg_week_hrs.'" id="part_time_avg" /></td>';
    $html .= '</tr>';
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div><!-- #CutomTimingWrapper-->';
    $html .= ' </div><!-- partTIMEDIV -->';


    $html .= "<script>
    $(document).ready(function() {

        //toggle `popup` / `inline` mode
        $.fn.editable.defaults.mode = 'popup';

        // $('#MonIN,#MonOUT,#TueIN,#TueOUT,#WedIN,#WedOUT,#ThuIN,#ThuOUT,#FriIN,#FriOUT,#SatOUT,#SatIN').editable();     
        
        //make username editable
        $('#MonIN').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
        });
        $('#MonOUT').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#TueIN').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#TueOUT').editable({
           type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#WedIN').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#WedOUT').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#ThuIN').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#ThuOUT').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#FriIN').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#FriOUT').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#SatIN').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
        $('#SatOUT').editable({
            type: 'text',
            format:'h:mm A',
            viewformat:'h:mm A',
            template: 'h:mm A'
          });
          
          //make status editable
          $('#status').editable({
              type: 'select',
              title: 'Select status',
              placement: 'right',
              value: 2,
              source: [
                  {value: 1, text: 'status 1'},
                  {value: 2, text: 'status 2'},
                  {value: 3, text: 'status 3'}
              ]
              /*
              //uncomment these lines to send data on server
              ,pk: 1
              ,url: '/post'
              */
          });
      });
      </script>";
               
    }

    // Not Show In Standard Profile type
    if($profile_type_id != 1){
      $html .= '<div class="col-md-12 borderTop text-center">';
      //$html .= '<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear">';
      $html .= '<div class="alert alert-success" style="display:none">
                  <strong>Success!</strong> Allocated Profile Updated.
                </div>';
      $html .= '<input type="button" name="submit" class="greenBTN widthSmall" id="updated_allocated_profile" value="Profile  Update">';
      $html .= '</div><!-- col-md-12 -->';
    }
    $html .= '</form>';
    $html .= '</div>';

    echo $html;

	}


  	// UPDATE CUSTOM PROFILE INDIVIDUAL
  	public function updated_custom_profile(){
    
    // var_dump($this->input->post());
    // exit;
    $this->load->model('tif_a/profile_allocation_model','pam');
    $id = $this->input->post('updated_id');
    $morning_time = $this->input->post('morning_time');
    $afternoon_time = $this->input->post('afternoon_time');
    $wed_time = $this->input->post('wed_timeout');
    $fri_time = $this->input->post('fri_timeout');
    $ext_time = $this->input->post('ext_time');
    $ext_frequency = $this->input->post('ext_frequency');
    $july_start = $this->input->post('ext_july');
    $sat_hour = $this->input->post('sat_hrs');
    $sat_off = $this->input->post('sat_off');
    $sat_on = $this->input->post('sat_working');
    $avg_hrs = $this->input->post('avg_hrs');
    // IS on Flag Morning And Afternoon

    if($morning_time != '' && $afternoon_time != ''){
      $is_on_mon = 1;
      $is_on_tue = 1;
      $is_on_wed = 1;
      $is_on_thu = 1;
      $is_on_fri = 1;
      $is_on_sat = 1;
      $is_on_sun = 1;
    }else{

      $is_on_mon = 0;
      $is_on_tue = 0;
      $is_on_wed = 0;
      $is_on_thu = 0;
      $is_on_fri = 0;
      $is_on_sat = 0;
      $is_on_sun = 0;

    }

    // Is On Flag on EXT Time

    if($ext_time != ''){
      $use_ext = 1;
    }else{
      $use_ext = 0;
    }

    $data = array(
      'is_on_mon' => $is_on_mon,
      'is_on_tue' => $is_on_tue,
      'is_on_wed' => $is_on_wed,
      'is_on_thu' => $is_on_thu,
      'is_on_fri' => $is_on_fri,
      'is_on_sat' => $is_on_sat,
      'is_on_sun' => $is_on_sun,
      'mon_in' => $morning_time,
      'tue_in' => $morning_time,
      'wed_in' => $morning_time,
      'thu_in' => $morning_time,
      'fri_in' => $morning_time,
      'sat_in' => $morning_time,
      'sun_in' => $morning_time,
      'mon_out' => $afternoon_time,
      'tue_out' => $afternoon_time,
      'wed_out' => $afternoon_time,
      'thu_out' => $afternoon_time,
      'fri_out' => $afternoon_time,
      'sat_out' => $afternoon_time,
      'sun_out' => $afternoon_time,
      'avg_week_hrs' => $avg_hrs,
      'use_ext' => $use_ext,
      'ext_time' => $ext_time,
      'ext_frequency' => $ext_frequency,
      'ext_july' => $july_start,
      'sat_hrs' => $sat_hour,
      'sat_off' => $sat_off,
      'sat_working' => $sat_on,
      'created' => time(),
      'created_by' => $this->session->userdata('user_id'),
      'modified' => time(),
      'modified_by' => $this->session->userdata('user_id')
    );

    $where = array(
      'id' => $id
    );

    $last_id = $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$data);
    //echo $last_id;


    // Update WED TIME 
    if($wed_time != ''){

      $where = array(
        'id' => $id
      );

      $update_data = array(
        'wed_out' => $wed_time
      );



      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
      echo $affected_row;
    }

    if($fri_time != ''){

      $where = array(
        'id' => $id
      );

      $update_data = array(
        'fri_out' => $fri_time
      );

      $affected_row =  $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$update_data);
      echo $affected_row;
    } // Fri Time End

  }

  //=================== Update Part Time Profile =========================//

  public function update_partTime_profile(){
    $id = $this->input->post('updated_id');
    $mon_in = $this->input->post('mon_in');
    $mon_out = $this->input->post('mon_out');
    $tue_in = $this->input->post('tue_in');
    $tue_out = $this->input->post('tue_out');
    $wed_in = $this->input->post('wed_in');
    $wed_out = $this->input->post('wed_out');
    $thu_in = $this->input->post('thu_in');
    $thu_out = $this->input->post('thu_out');
    $fri_in = $this->input->post('fri_in');
    $fri_out = $this->input->post('fri_out');
    $sat_in = $this->input->post('sat_in');
    $sat_out = $this->input->post('sat_out');
 
    $this->load->model('tif_a/profile_allocation_model','pam');
   



    //var_dump($profile_id);

    

    // MON  Timing
    if($mon_in == '--:-- --' || $mon_out == '--:-- --' || $mon_in == 'Empty' || $mon_out == 'Empty'){
      $is_on_mon = 0;
      $mon_in = '00:00:00';
      $mon_out = '00:00:00';
    }else{
      $is_on_mon = 1;
    }


    // Tuesday out

    if($tue_in == '--:-- --' || $tue_out == '--:-- --' || $tue_in == 'Empty' || $tue_out == 'Empty'){
      $is_on_tue = 0;
      $tue_in = '00:00:00';
      $tue_out = '00:00:00';
    }else{
      $is_on_tue = 1;
    }


    // Wednesday out

    if($wed_in == '--:-- --' || $wed_out == '--:-- --' || $wed_in == 'Empty' || $wed_out == 'Empty' ){
      $is_on_wed = 0;
      $wed_in = '00:00:00';
      $wed_out = '00:00:00';
    }else{
      $is_on_wed = 1;
    }

    // Thursday Out

    if($thu_in == '--:-- --' || $thu_out == '--:-- --' || $thu_in == 'Empty' || $thu_out == 'Empty'){
      $is_on_thu = 0;
      $thu_in = '00:00:00';
      $thu_out = '00:00:00';
    }else{
      $is_on_thu = 1;
    }

    // Friday Out

    if($fri_in == '--:-- --' || $fri_out == '--:-- --' || $fri_in == 'Empty' || $fri_out == 'Empty'){
      $is_on_fri = 0;
      $fri_in = '00:00:00';
      $fri_out = '00:00:00';
    }else{
      $is_on_fri = 1;
    }

    // Saturday Out

    if($sat_in == '--:-- --' || $sat_out == '--:-- --' || $sat_in == 'Empty' || $sat_out == 'Empty'){
      $is_on_sat = 0;
      $sat_in = '00:00:00';
      $sat_out = '00:00:00';
    }else{
      $is_on_sat = 1;
    }

   

    $data = array(
      'is_on_mon' => $is_on_mon,
      'is_on_tue' => $is_on_tue,
      'is_on_wed' => $is_on_wed,
      'is_on_thu' => $is_on_thu,
      'is_on_fri' => $is_on_fri,
      'is_on_sat' => $is_on_sat,
      'is_on_sun' => 0,
      'mon_in' => date("H:i", strtotime($mon_in)),
      'tue_in' => date("H:i", strtotime($tue_in)),
      'wed_in' => date("H:i", strtotime($wed_in)),
      'thu_in' => date("H:i", strtotime($thu_in)),
      'fri_in' => date("H:i", strtotime($fri_in)),
      'sat_in' => date("H:i", strtotime($sat_in)),
      'mon_out' => date("H:i", strtotime($mon_out)),
      'tue_out' => date("H:i", strtotime($tue_out)),
      'wed_out' => date("H:i", strtotime($wed_out)),
      'thu_out' => date("H:i", strtotime($thu_out)),
      'fri_out' => date("H:i", strtotime($fri_out)),
      'sat_out' => date("H:i", strtotime($sat_out)),
      'created' => time(),
      'created_by' => $this->session->userdata('user_id'),
      'modified' => time(),
      'modified_by' => $this->session->userdata('user_id')

    );

    $where = array(
      'id' => $id
    );

    
    $affected_row = $this->pam->update_data('atif_gs_events.tt_profile_time_staff',$where,$data);
    echo $affected_row;
  }

  // GET REFRESH
  public function get_refresh(){


    $this->load->model('tif_a/profile_allocation_model','pam');
    $select = '';
    $where = '';
    $profile_description = $this->pam->get_by('atif_gs_events.tt_profile',$select,$where);
    $html = '';

    //$html .= '<div class="col-md-8" style="padding-right:25px;">';
    $html .= '<div class="col-md-12 no-padding">';
    $html .= '<div class="headingArea">';
    $html .= '<h2>Profile <strong>Detail</strong></h2>';
    $html .= '</div>';
    $html .= '<div class="col-md-12 no-padding borderRight">';
    $html .= '<form>';
    $html .= '<div class="col-md-6">';
    $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
    $html .= 'Select Profile';
    $html .= '</div><!-- col-md-4 -->';
    $html .= '<div class="col-md-8 no-padding">';
    $html .= '<select required id="purpose">';
    $html .= '<option value="">Select</option>';
    foreach($profile_description as $profile) { 
    $html .= '<option value="'.$profile->id.'" data-id="'.$profile->profile_type_id.'">'.$profile->name.'</option>';
    } 
    $html .= '</select>';
    $html .= '</div><!-- col-md-8 -->';
    $html .= '</div><!-- col-md-12 -->';
    $html .= '<br /><br /><br /><br />';
                       
    $html .= '<div id="get_profile"></div>';
    $html .= '</form>';
    $html .= '</div><!-- col-md-6-->';
    $html .= '</div><!-- col-md-12 -->';
    //$html .= '</div><!-- col-md-8 -->';

    echo $html;
  }

}