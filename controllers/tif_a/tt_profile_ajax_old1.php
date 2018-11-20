<?php

class Tt_profile_ajax extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
        $user_id =  (int)$this->session->userdata('user_id');
	}

	public function add_new_profile(){

		$html = '';
		$html .= '<div class="col-md-8" style="padding-right:25px;">';
	    $html .= '<div class="col-md-12 ProfileDetail">';
	    $html .= '<div class="headingArea"><h2>Add new Profile</h2></div>';
	    $html .= '<div class="col-md-12 no-padding borderRight">';
	    $html .= '<form action="" method="POST" id="form-profile">';
	    $html .= '<div class="col-md-6 paddingBottom20">';
	    $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
	    $html .= 'TT Profile Name';
	    $html .= '</div><!-- col-md-4 -->';
	    $html .= '<div class="col-md-8 no-padding">';
	    $html .= '<input type="text" placeholder="Teachers NC" name="profile_name" id="profile_name" />';
	    // $html .= '<span>Already Taken</span>';
	    $html .= '</div><!-- col-md-8 -->';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '<div class="col-md-6">';
	    $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
	    $html .= 'Profile Type';
	    $html .= '</div><!-- col-md-4 -->';
	    $html .= '<div class="col-md-8 no-padding">';
	    $html .= '<select required id="purpose" name="select_profile">';
	    $html .= '<option value="">Select</option>';
	    $html .= '<option value="1">Standard</option>';
	    $html .= '<option value="2">Custom</option>';
	    $html .= '<option value="3">Part Time</option>';
	    $html .= '</select>';
	    $html .= '</div><!-- col-md-8 -->';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '<br /><br /><br /><br />';

	    // Standard Timming Wrapper

	    $html .= '<div class="standardDIV" style="display:none;">';
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
	    $html .= '<td><input type="time"  name="morning_time" id="morning_time" /></td>';
	    $html .= '<td><input type="time"  name="afternoon_time" id="afternoon_time" /></td>';
	    $html .= '<td><input type="time" placeholder="" id="wed_time" /></td>';
	    $html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" id="fri_time" /></td>';
	    $html .= '<td><input type="time" placeholder="" id="ext_time" /></td>';
	    $html .= '<td><input type="number" placeholder="e.g. 2" id="ext_frequency" /></td>';
	    $html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder="" id="july_start" /></td>';
	    $html .= '<td><input type="number" placeholder="e.g. 4.5" id="sat_hour" /></td>';
	    $html .= '<td><input type="number" placeholder="e.g. 3" id="sat_off" /></td>';
	    $html .= '<td><input type="number" placeholder="e.g. 2" id="sat_on" /></td>';
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
	    $html .= '<td><input type="text"  disabled="disabled" id="mon_thurs_hours" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="fri_hrs" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="avg_hrs" /></td>';
	    $html .= '</tr>';
	    $html .= '</tbody>';
	    $html .= '</table>';
	    $html .= '</div>';
	    $html .= '</div><!-- #StandardTimingWrapper -->';
	    $html .= '</div><!-- standardDIV-->';

	    // End Standard Timing

	    // Start Custom Timing

	    $html .= '<div class="customDIV"  style="display:none;">';
	    $html .= '<h3>Custom Timings</h3>';
	    $html .= '<div id="StandardTimingWrapper">';
	    $html .= '<div class="col-md-12 paddingBottom20">';
	    $html .= '<table width="100%" border="0" class="ProfileTimingTable StandTime">';
	    $html .= '<thead>';
	    $html .= '<tr>';
	    $html .= '<td colspan="4" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>';
	    $html .= '<td colspan="3" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>';
	    $html .= '<td colspan="3" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>';
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
	    $html .= '<td><input type="time" id="cus_morning" name="custom_morning" /></td>';
	    $html .= '<td><input type="time" id="cus_afternoon" name="custom_afternoon" /></td>';
	    $html .= '<td><input type="time" id="cus_wed" name="custom_wed"  /></td>';
	    $html .= '<td style="border-right: 1px solid #666;"><input type="time" id="cus_fri" name="custom_fri" /></td>';
	    $html .= '<td><input type="time" id="cus_ext_time" name ="custom_ext_time" /></td>';
	    $html .= '<td><input type="number" id="cus_ext_freq" name="custom_ext_frequency" /></td>';
	    $html .= '<td style="border-right: 1px solid #666;"><input type="date" id="cus_july_start" name="custom_july_start" /></td>';
	    $html .= '<td><input type="number" id="cus_sat_hour" name="custom_sat_hour" /></td>';
	    $html .= '<td><input type="number" id="cus_sat_off" name="custom_sat_off" /></td>';
	    $html .= '<td><input type="number" id="cus_sat_working" name="custom_sat_working" /></td>';
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
	    $html .= '<td><input type="text" disabled="disabled" id="cus_mon_thu_hrs"  /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="cus_fri_hrs"  /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="cus_avg_weekly"  /></td>';
	    $html .= '</tr>';
	    $html .= '</tbody>';
	    $html .= '</table>';
	    $html .= '</div>';
	    $html .= '</div><!-- #StandardTimingWrapper -->';
	    $html .= '</div><!-- customDIV-->';

	    // Part timer

	    $html .= '<div class="partTIMEDIV" style="display:none;">
                            <h3>Part Timer</h3>';
	    $html .= '<div class="CutomTimingWrapper">';
	    $html .= '<div class="col-md-12 paddingBottom20">';

	    $html .= '<table width="100%" border="0" class="ProfileTimingTable ProfileTimingTablePT">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .=  '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>&nbsp;</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>';
        $html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>In</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="MonIN" data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
        $html .='<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2"><a href="#" id="SatIN" data-placement="top" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>Out</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';
        $html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="top" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';
        //$html .= '<table width="100%" border="0" class="ProfileTimingTable">';
	    // $html .= '<thead>';
	    // $html .= '<tr>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Mon</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Tue</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Wed</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Thu</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Fri</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
	    // $html .= '</tr>';
	    // $html .= '<tr>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width="">Out</td>';
	    // $html .= '</tr>';
	    // $html .= '</thead>';
	    // $html .= '<tbody>';
	    // $html .= '<tr>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="MonIN" class="mon"  data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '</tr>';
	    // $html .= '</tbody>';
	    // $html .= '</table>';
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
	    $html .= '<td><input type="text" disabled="disabled" id="part_time_mon_thu" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="part_time_fri" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="part_time_avg" /></td>';
	    $html .= '</tr>';
	    $html .= '</tbody>';
	    $html .= '</table>';
	    $html .= '</div><!-- paddingBottom20 -->';
	    $html .= '</div><!-- #CutomTimingWrapper-->';
	    $html .= '</div><!-- partTIMEDIV -->';
	    $html .= '</form>';
	            // Callout Function

	    $html .= '</div><!-- col-md-6-->';

	    $html .= '<div class="col-md-12 borderTop text-center">';
	    $html .= '<div class="alert alert-success" style="display:none">
                  <strong>Success!</strong> Insert SuccessFully.
                </div>';
	    $html .= '<input type="button" name="clear" class="grayBTN widthSmall" id="greenBTN3" value="Clear"> <input type="submit" name="submit" class="greenBTN widthSmall" id="insert_profile" value="Add new Profile">';
	    
	    $html .= '<input type="hidden" id="avg_mon_in"  />';
	    $html .= '<input type="hidden" id="avg_mon_out" />';
	    
	    $html .= '<input type="hidden" id="avg_tue_in"  />';
	    $html .= '<input type="hidden" id="avg_tue_out" />';
	    
	    $html .= '<input type="hidden" id="avg_wed_in" />';
	    $html .= '<input type="hidden" id="avg_wed_out" />';

	    $html .= '<input type="hidden" id="avg_thu_in" />';
	    $html .= '<input type="hidden" id="avg_thu_out" />';

	    $html .= '<input type="hidden" id="avg_fri_in" />';
	    $html .= '<input type="hidden" id="avg_fri_out" />';

	    $html .= '<input type="hidden" id="avg_sat_in" />';
	    $html .= '<input type="hidden" id="avg_sat_out" />';

	    


	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '</div><!-- col-md-8 -->';


	    $html .= "<script type='text/javascript'>
			$(document).ready(function() {


			    //toggle `popup` / `inline` mode
			    $.fn.editable.defaults.mode = 'popup';     
			    
			    
			    //make editable
			    $('#MonIN').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',

					});
				$('#MonOUT').editable({

					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',

					});
				$('#TueIN').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#TueOUT').editable({
					
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#WedIN').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#WedOUT').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#ThuIN').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#ThuOUT').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#FriIN').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#FriOUT').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#SatIN').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});
				$('#SatOUT').editable({
					type: 'text',
					format:'h:mm A',
                    viewformat:'h:mm A',
                    template: 'h:mm a',
					});


		});



		</script>";

		echo $html;

	}

	//========================== Profile Insertion =========================//
	//======================================================================//

	public function insert_tt_profile(){
		

		$profile_type_id = $this->input->post('profile_type');
		$profile_name = $this->input->post('profile_name');
		

		$this->load->model('tif_a/tif_a_model','tifa');

		$data = array(
			'profile_type_id' => $profile_type_id,
			'name' => $profile_name,
			'created' => time(),
			'created_by' => $this->session->userdata('user_id'),
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id'),
			'record_deleted' => 0
		);

		$last_id = $this->tifa->insert_data('atif_gs_events.tt_profile',$data);
		echo $last_id;

	}

	public function insert_profile_timing(){

		// var_dump($this->input->post());
		// exit;
		$this->load->model('tif_a/tif_a_model','tifa');
		$profile_id = $this->input->post('profile_id');
		$morning_time = $this->input->post('morning_time');
		$afternoon_time = $this->input->post('afternoon_time');
		$wed_time = $this->input->post('wed_time');
		$fri_time = $this->input->post('fri_time');
		$ext_time = $this->input->post('ext_time');
		$ext_frequency = $this->input->post('ext_frequency');
		$july_start = $this->input->post('july_start');
		$sat_hour = $this->input->post('sat_hour');
		$sat_off = $this->input->post('sat_off');
		$sat_on = $this->input->post('sat_on');
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
			'profile_id' => $profile_id,
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

		$last_id = $this->tifa->insert_data('atif_gs_events.tt_profile_time',$data);
		//echo $last_id;


		// Update WED TIME 
		if($wed_time != ''){

			$where = array(
				'id' => $last_id
			);

			$update_data = array(
				'wed_out' => $wed_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where,$update_data);
			echo $affected_row;
		}

		if($fri_time != ''){

			$where = array(
				'id' => $last_id
			);

			$update_data = array(
				'fri_out' => $fri_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where,$update_data);
			echo $affected_row;
		}

	}


		//======================Insert Custom Timing =======================//
		//==================================================================//

		public function insert_custom_timing(){

		$this->load->model('tif_a/tif_a_model','tifa');
		$profile_id = $this->input->post('profile_id');
		$morning_time = $this->input->post('morning_time');
		$afternoon_time = $this->input->post('afternoon_time');
		$wed_time = $this->input->post('wed_time');
		$fri_time = $this->input->post('fri_time');
		$ext_time = $this->input->post('ext_time');
		$ext_frequency = $this->input->post('ext_frequency');
		$july_start = $this->input->post('july_start');
		$sat_hour = $this->input->post('sat_hour');
		$sat_off = $this->input->post('sat_off');
		$sat_on = $this->input->post('sat_on');
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
			'profile_id' => $profile_id,
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

		$last_id = $this->tifa->insert_data('atif_gs_events.tt_profile_time',$data);
		echo $last_id;


		// Update WED TIME 
		if($wed_time != ''){

			$where = array(
				'id' => $last_id
			);

			$update_data = array(
				'wed_out' => $wed_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where,$update_data);
			echo $affected_row;
		}

		if($fri_time != ''){

			$where = array(
				'id' => $last_id
			);

			$update_data = array(
				'fri_out' => $fri_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where,$update_data);
			echo $affected_row;
		}

	}

	//============================= INSERT PART TIMER ==================================//
	//==================================================================================//

	public function insert_part_time_timing(){
		


		$this->load->model('tif_a/tif_a_model','tifa');
		$profile_id = $this->input->post('profile_id');
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
		$avg_weekly = $this->input->post('avg_weekly');

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
			'profile_id' => $profile_id,
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
			'avg_week_hrs' => $avg_weekly,
			'created' => time(),
			'created_by' => $this->session->userdata('user_id'),
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')

		);



		$last_id = $this->tifa->insert_data('atif_gs_events.tt_profile_time',$data);

	}


	// Profile Updation Interface

	public function profile_update_interface(){
		
		$profile_id = $this->input->post('id');
		$profile_name = $this->input->post('profile_name');

		//==============Profile_description ============//
		//==============================================//

		$this->load->model('tif_a/tif_a_model','tifa');
		$profile_desc =  $this->tifa->profile_description($profile_id);
		

		//=================Profile Timing =====================//
		//====================================================//


		$select = '';
	    $where  = array(
	    	'profile_id' => $profile_id 
	    );

	    $profile_timing = $this->tifa->get_by('atif_gs_events.tt_profile_time',$select,$where);
	   

		$html = '';
		$html .= '<input type="hidden" id="profile_id_update" value="'.$profile_id.'"/>';
		$html .= '<div class="col-md-8" style="padding-right:25px;">';
	    $html .= '<div class="col-md-12 ProfileDetail">';
	    $html .= '<div class="headingArea"><h2>'.$profile_name.'</h2></div>';
	    $html .= '<div class="col-md-12 no-padding borderRight">';
	    $html .= '<form action="" method="POST" id="form_profile_updated">';
	    $html .= '<div class="col-md-6 paddingBottom20">';
	    $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
	    $html .= 'TT Profile Name';
	    $html .= '</div><!-- col-md-4 -->';
	    $html .= '<div class="col-md-8 no-padding">';
	    $html .= '<input type="text" placeholder="Teachers NC" name="profile_name_update" id="profile_name_update" value="'.$profile_desc[0]->name.'"/>';
	    $html .= '</div><!-- col-md-8 -->';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '<div class="col-md-6">';
	    $html .= '<div class="col-md-4 text-right" style="padding-top: 5px;">';
	    $html .= 'Profile Type';
	    $html .= '</div><!-- col-md-4 -->';
	    $html .= '<div class="col-md-8 no-padding">';
	    $html .= '<select required id="purpose_update" name="select_profile_update">';
	    // $html .= '<option value="">Select</option>';
	    $html .= '<option value="'.$profile_desc[0]->profile_type_id.'" selected>'.$profile_desc[0]->profile_type_name.'</option>';
	    // $html .= '<option value="2">Custom</option>';
	    // $html .= '<option value="3">Part Time</option>';
	    $html .= '</select>';
	    $html .= '</div><!-- col-md-8 -->';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '<br /><br /><br /><br />';

	    // Standard Timming Wrapper

	    if($profile_desc[0]->profile_type_id == 1){



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


	    if($profile_timing[0]->is_on_mon == 1){
	    $html .= '<td><input type="time"  name="morning_time_update" id="morning_time_update" value="'.$profile_timing[0]->mon_in.'" /></td>';
	    $html .= '<td><input type="time"  name="afternoon_time_update" id="afternoon_time_update" value="'.$profile_timing[0]->thu_out.'" /></td>';
		}

		if($profile_timing[0]->wed_out != $profile_timing[0]->mon_out ){
	    $html .= '<td><input type="time" placeholder="" id="wed_time_update" value="'.$profile_timing[0]->wed_out.'" /></td>';
		}else{
			 $html .= '<td><input type="time" placeholder="" id="wed_time_update" /></td>';
		}

		if(!empty($profile_timing[0]->fri_out)){
	    	$html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" id="fri_time_update" value="'.$profile_timing[0]->fri_out.'" /></td>';
		}else{
			$html .= '<td style="border-right: 1px solid #666;"><input type="time" placeholder="" id="fri_time_update" /></td>';
		}


		if($profile_timing[0]->use_ext == 1){
	    $html .= '<td><input type="time" placeholder="" id="ext_time_update" value="'.$profile_timing[0]->ext_time.'" /></td>';
		}else{
			$html .= '<td><input type="time" placeholder="" id="ext_time_update" /></td>';
		}

		if($profile_timing[0]->ext_frequency != 0){
	    $html .= '<td><input type="number" placeholder="e.g. 2" id="ext_frequency_update" value="'.$profile_timing[0]->ext_frequency.'" /></td>';
		}else{
			$html .= '<td><input type="number" placeholder="e.g. 2" id="ext_frequency_update" /></td>';
		}


		if($profile_timing[0]->ext_july != '0000-00-00'){
	    $html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder="" value="'.$profile_timing[0]->ext_july.'" id="july_start_update" /></td>';
		}else{
			$html .= '<td style="border-right: 1px solid #666;"><input type="date" placeholder=""  id="july_start_update" /></td>';
		}


		if($profile_timing[0]->sat_hrs != '0'){
			$html .= '<td><input type="number" placeholder="e.g. 4.5" id="sat_hour_update" value="'.$profile_timing[0]->sat_hrs.'" /></td>';
		}else{
			$html .= '<td><input type="number" placeholder="e.g. 4.5" id="sat_hour_update" /></td>';
		}
	    
	    if($profile_timing[0]->sat_off != 0){
	    	$html .= '<td><input type="number" placeholder="e.g. 3" id="sat_off_update" value="'.$profile_timing[0]->sat_off.'" /></td>';
	    }else{
	    	$html .= '<td><input type="number" placeholder="e.g. 3" id="sat_off_update" disabled  /></td>';
	    }

	    if($profile_timing[0]->sat_working != 0){
	    	$html .= '<td><input type="number" placeholder="e.g. 2" id="sat_on_update" value="'.$profile_timing[0]->sat_working.'" /></td>';
	    }else{
	    	$html .= '<td><input type="number" placeholder="e.g. 2" id="sat_on_update" disabled /></td>';
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
	    $html .= '<td><input type="text" disabled="disabled" id="mon_thurs_hours" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="fri_hrs" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="avg_hrs" /></td>';
	    $html .= '</tr>';
	    $html .= '</tbody>';
	    $html .= '</table>';
	    $html .= '</div>';
	    $html .= '</div><!-- #StandardTimingWrapper -->';
	    $html .= '</div><!-- standardDIV-->';

	    // End Standard Timing

		}

	    // Start Custom Timing


		if($profile_desc[0]->profile_type_id == 2){
	    $html .= '<div class="customDIV"  style="">';
	    $html .= '<h3>Custom Timings</h3>';
	    $html .= '<div id="StandardTimingWrapper">';
	    $html .= '<div class="col-md-12 paddingBottom20">';
	    $html .= '<table width="100%" border="0" class="ProfileTimingTable StandTime">';
	    $html .= '<thead>';
	    $html .= '<tr>';
	    $html .= '<td colspan="4" bgcolor="#f2dcdb" style="border-right: 1px solid #666;"><strong>Standard Timings</strong></td>';
	    $html .= '<td colspan="3" bgcolor="#daeef3" style="border-right: 1px solid #666;"><strong>Extensions</strong></td>';
	    $html .= '<td colspan="3" bgcolor="#d8e4bc"><strong>Saturdays</strong></td>';
	    $html .= '</tr>';
	    $html .= '</thead>';
	    $html .= '<thead>';
	    $html .= '<tr>';
	    $html .= '<td width="10%" bgcolor="#f2dcdb">Morning</td>';
	    $html .= '<td width="10%" bgcolor="#f2dcdb">Afternoon</td>';
	    $html .= '<td width="10%" bgcolor="#f2dcdb">Wed Afternoon</td>';
	    $html .= '<td width="10%" bgcolor="#f2dcdb" style="border-right: 1px solid #666;">Fri Afternoon</td>';
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
	    
	    if($profile_timing[0]->is_on_mon == 1){
	    	$html .= '<td><input type="time" id="custom_morning_update" name="custom_morning_update" value="'.$profile_timing[0]->mon_in.'" /></td>';
	    	$html .= '<td><input type="time" id="cus_afternoon_update" name="custom_afternoon_udpate" value="'.$profile_timing[0]->thu_out.'" /></td>';
		}
	    
		if($profile_timing[0]->mon_out != $profile_timing[0]->wed_out){
	    	$html .= '<td><input type="time" id="cus_wed_update" name="custom_wed_update" value="'.$profile_timing[0]->wed_out.'"  /></td>';

		}else{
	    	$html .= '<td><input type="time" id="cus_wed_update" name="custom_wed_update"  /></td>';
		}

		if(!empty($profile_timing[0]->fri_out)){
	    $html .= '<td><input type="time" id="cus_fri_update" name="custom_fri_update" value="'.$profile_timing[0]->fri_out.'" /></td>';
		}else{
		$html .= '<td><input type="time" id="cus_fri_update" name="custom_fri" /></td>';	
		}

		if($profile_timing[0]->use_ext != 0){
	    	$html .= '<td><input type="time" id="cus_ext_time_update" name ="custom_ext_time_update" value="'.$profile_timing[0]->ext_time.'" /></td>';
		}else{
	    	$html .= '<td><input type="time" id="cus_ext_time_update" name ="custom_ext_time_update" /></td>';
		}

		if($profile_timing[0]->ext_frequency != 0){
			$html .= '<td><input type="number" id="cus_ext_freq_update" name="custom_ext_frequency_update" value="'.$profile_timing[0]->ext_frequency.'" /></td>';
		}else{
			$html .= '<td><input type="number" id="cus_ext_freq_update" name="custom_ext_frequency_update" /></td>';
		}

		if($profile_timing[0]->ext_july != '0000-00-00'){
			$html .= '<td><input type="date" id="cus_july_start_update" name="custom_july_start_update" value="'.$profile_timing[0]->ext_july.'" /></td>';
		}else{
			$html .= '<td><input type="date" id="cus_july_start_update" name="custom_july_start_update" /></td>';
		}


		if($profile_timing[0]->sat_hrs != 0){
			$html .= '<td><input type="number" id="cus_sat_hour_update" name="custom_sat_hour_update" value="'.$profile_timing[0]->sat_hrs.'" /></td>';
		}else{
			$html .= '<td><input type="number" id="cus_sat_hour_update" name="custom_sat_hour_update" /></td>';
		}
	    
	    
	    if($profile_timing[0]->sat_off != 0){
	    	$html .= '<td><input type="number" id="cus_sat_off_update" name="custom_sat_off_update" value="'.$profile_timing[0]->sat_off.'" /></td>';
	    }else{
	    	$html .= '<td><input type="number" id="cus_sat_off_update" name="custom_sat_off_update" /></td>';
	    }
	    
	    if($profile_timing[0]->sat_working != 0){
	    	$html .= '<td><input type="number" id="cus_sat_working_update" name="custom_sat_working_update" value="'.$profile_timing[0]->sat_working.'" /></td>';
	    }else{
	    	$html .= '<td><input type="number" id="cus_sat_working_update" name="custom_sat_working_update" disabled /></td>';
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
	    $html .= '<td><input type="text" disabled="disabled" id="cus_fri_cal"  /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="avg_cus_cal" /></td>';
	    $html .= '</tr>';
	    $html .= '</tbody>';
	    $html .= '</table>';
	    $html .= '</div>';
	    $html .= '</div><!-- #StandardTimingWrapper -->';
	    $html .= '</div><!-- customDIV-->';

		}

	    // Part timer

	    if($profile_desc[0]->profile_type_id == 3){

	    $html .= '<div class="partTIMEDIV" >
                            <h3>Part Timer</h3>';
	    $html .= '<div class="CutomTimingWrapper">';
	    $html .= '<div class="col-md-12 paddingBottom20">
                                <table width="100%" border="0" class="ProfileTimingTable">';
	    // $html .= '<thead>';
	    // $html .= '<tr>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Mon</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Tue</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Wed</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Thu</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6" class="tabletdBorderRight"><strong>Fri</strong></td>';
	    // $html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
	    // $html .= '</tr>';
	    // $html .= '<tr>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">Out</td>';
	    // $html .= '<td width=""  class="tabletdBorderRight">In</td>';
	    // $html .= '<td width="">Out</td>';
	    // $html .= '</tr>';
	    // $html .= '</thead>';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .=  '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>&nbsp;</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Mon</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Tue</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Wed</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Thu</strong></td>';
        $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;" bgcolor="#b5d9e6"><strong>Fri</strong></td>';
        $html .= '<td width="" colspan="2" bgcolor="#b5d9e6"><strong>Sat</strong></td>';
        $html .= '</tr>';
        $html .= '</thead>';


	    $html .= '<tbody>';
	    $html .= '<tr>';
	    $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>In</strong></td>';
	    if($profile_timing[0]->is_on_mon  == 1){
	    	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="MonIN"  data-placement="top" data-title="In time for Monday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->mon_in)).'</a></td>';
	    	// $html .= '<td class="tabletdBorderRight"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->mon_out)).'</a></td>';
	    }else{
	    	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="MonIN"  data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
	    	// $html .= '<td class="tabletdBorderRight"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';

	    }

	    if($profile_timing[0]->is_on_tue == 1){
	    	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->tue_in)).'</a></td>';
	    	 // $html .= '<td class="tabletdBorderRight"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->tue_out)).'</a></td>';

	    }else{

	    	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';
	    	 // $html .= '<td class="tabletdBorderRight"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';

	    }
	    
	   	if($profile_timing[0]->is_on_wed == 1){

	   	$html .= '<td  width="" colspan="2" class="tabletdBorderRight"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->wed_in)).'</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->wed_out)).'</a></td>';

	   	}else{
	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';

	   	}

	   	if($profile_timing[0]->is_on_thu == 1){
	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->thu_in)).'</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->thu_out)).'</a></td>';

	   	}else{
	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';

	   	}

	   	if($profile_timing[0]->is_on_fri == 1){

	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->fri_in)).'</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->fri_out)).'</a></td>';

	   	}else{

	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td class="tabletdBorderRight"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';

	   	}

	   	if($profile_timing[0]->is_on_sat ==1){

	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->sat_in)).'</a></td>';
	    // $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->sat_out)).'</a></td>';

	   	}else{
	   	$html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
	    // $html .= '<td><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';

	   	}


	    $html .= '</tr>';

	    $html .= '<tr>';
	    $html .= '<td width="" colspan="2" style="border-right: 1px solid #666;"><strong>Out</strong></td>';

	    	    if($profile_timing[0]->is_on_mon  == 1){
	    	//$html .= '<td class="tabletdBorderRight"><a href="#" id="MonIN"  data-placement="top" data-title="In time for Monday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->mon_in)).'</a></td>';
	    	 $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->mon_out)).'</a></td>';
	    }else{
	    	//$html .= '<td class="tabletdBorderRight"><a href="#" id="MonIN"  data-placement="top" data-title="In time for Monday" data-type="combodate">--:-- --</a></td>';
	    	 $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="MonOUT" data-placement="top" data-title="Out time for Monday" data-type="combodate">--:-- --</a></td>';

	    }

	    if($profile_timing[0]->is_on_tue == 1){
	    	//$html .= '<td class="tabletdBorderRight"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->tue_in)).'</a></td>';
	    	  $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->tue_out)).'</a></td>';

	    }else{

	    	//$html .= '<td class="tabletdBorderRight"><a href="#" id="TueIN" data-placement="top" data-title="In time for Tuesday" data-type="combodate">--:-- --</a></td>';
	    	  $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="TueOUT" data-placement="top" data-title="Out time for Tuesday" data-type="combodate">--:-- --</a></td>';

	    }
	    
	   	if($profile_timing[0]->is_on_wed == 1){

	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->wed_in)).'</a></td>';
	     $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->wed_out)).'</a></td>';

	   	}else{
	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="WedIN" data-placement="top" data-title="In time for Wednesday" data-type="combodate">--:-- --</a></td>';
	     $html .= '<td  width="" colspan="2" class="tabletdBorderRight"><a href="#" id="WedOUT" data-placement="top" data-title="Out time for Wednesday" data-type="combodate">--:-- --</a></td>';

	   	}

	   	if($profile_timing[0]->is_on_thu == 1){
	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->thu_in)).'</a></td>';
	     $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->thu_out)).'</a></td>';

	   	}else{
	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="ThuIN" data-placement="top" data-title="In time for Thursday" data-type="combodate">--:-- --</a></td>';
	     $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="ThuOUT" data-placement="top" data-title="Out time for Thursday" data-type="combodate">--:-- --</a></td>';

	   	}

	   	if($profile_timing[0]->is_on_fri == 1){

	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->fri_in)).'</a></td>';
	     $html .= '<td width="" colspan="2" class="tabletdBorderRight"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->fri_out)).'</a></td>';

	   	}else{

	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="FriIN" data-placement="top" data-title="In time for Friday" data-type="combodate">--:-- --</a></td>';
	     $html .= '<td  width="" colspan="2" class="tabletdBorderRight"><a href="#" id="FriOUT" data-placement="top" data-title="Out time for Friday" data-type="combodate">--:-- --</a></td>';

	   	}

	   	if($profile_timing[0]->is_on_sat ==1){

	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->sat_in)).'</a></td>';
	     $html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">'.date("g:i A", strtotime($profile_timing[0]->sat_out)).'</a></td>';

	   	}else{
	   	//$html .= '<td class="tabletdBorderRight"><a href="#" id="SatIN" data-placement="left" data-title="In time for Saturday" data-type="combodate">--:-- --</a></td>';
	     $html .= '<td width="" colspan="2"><a href="#" id="SatOUT" data-placement="left" data-title="Out time for Saturday" data-type="combodate">--:-- --</a></td>';

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
	    $html .= '<td><input type="text" disabled="disabled" id="part_time_mon_thu" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="part_time_fri" /></td>';
	    $html .= '<td><input type="text" disabled="disabled" id="part_time_avg" /></td>';
	    $html .= '</tr>';
	    $html .= '</tbody>';
	    $html .= '</table>';
	    $html .= '</div><!-- paddingBottom20 -->';
	    $html .= '</div><!-- #CutomTimingWrapper-->';
	    $html .= '</div><!-- partTIMEDIV -->';

		}

		// End Profile Type

	    $html .= '</form>';
	    $html .= '</div><!-- col-md-6-->';
	    $html .= '<div class="col-md-12 borderTop text-center">';
	    $html .= '<div class="alert alert-success update-success" style="display:none">
                  <strong>Success!</strong> Update SuccessFully.
                </div>';
	    $html .= '<input type="submit" name="submit" class="greenBTN widthSmall" id="update_profile" value="Update Profile">';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '</div><!-- col-md-12 -->';
	    $html .= '</div><!-- col-md-8 -->';

	    if($profile_timing[0]->is_on_mon  == 1){
		   	$html .= '<input type="hidden" id="avg_mon_in" value="'.date("g:i A", strtotime($profile_timing[0]->mon_in)).'"  />';
		    $html .= '<input type="hidden" id="avg_mon_out" value="'.date("g:i A", strtotime($profile_timing[0]->mon_out)).'" />';
		}else{
			$html .= '<input type="hidden" id="avg_mon_in"  />';
		    $html .= '<input type="hidden" id="avg_mon_out" />';
		}


	    if($profile_timing[0]->is_on_tue == 1){
	    	$html .= '<input type="hidden" id="avg_tue_in" value="'.date("g:i A", strtotime($profile_timing[0]->tue_in)).'" />';
	    	$html .= '<input type="hidden" id="avg_tue_out" value="'.date("g:i A", strtotime($profile_timing[0]->tue_out)).'" />';
	    }else{

	    	$html .= '<input type="hidden" id="avg_tue_in"  />';
	    	$html .= '<input type="hidden" id="avg_tue_out" />';
	    }


	    if($profile_timing[0]->is_on_wed == 1){
	    	$html .= '<input type="hidden" id="avg_wed_in" value="'.date("g:i A", strtotime($profile_timing[0]->wed_in)).'" />';
	    	$html .= '<input type="hidden" id="avg_wed_out" value="'.date("g:i A", strtotime($profile_timing[0]->wed_out)).'" />';
	    }else{
	    	$html .= '<input type="hidden" id="avg_wed_in" />';
	    	$html .= '<input type="hidden" id="avg_wed_out" />';
		}


		if($profile_timing[0]->is_on_thu == 1){
		    $html .= '<input type="hidden" id="avg_thu_in" value="'.date("g:i A", strtotime($profile_timing[0]->thu_in)).'" />';
		    $html .= '<input type="hidden" id="avg_thu_out" value="'.date("g:i A", strtotime($profile_timing[0]->thu_out)).'" />';
		}else{
			$html .= '<input type="hidden" id="avg_thu_in" />';
		    $html .= '<input type="hidden" id="avg_thu_out" />';
		}

		if($profile_timing[0]->is_on_fri == 1){
	    	$html .= '<input type="hidden" id="avg_fri_in" value="'.date("g:i A", strtotime($profile_timing[0]->fri_in)).'" />';
	   	 	$html .= '<input type="hidden" id="avg_fri_out" value="'.date("g:i A", strtotime($profile_timing[0]->fri_out)).'" />';
		}else{

			$html .= '<input type="hidden" id="avg_fri_in"  />';
	    	$html .= '<input type="hidden" id="avg_fri_out" />';

		}


		if($profile_timing[0]->is_on_sat ==1){
		    $html .= '<input type="hidden" id="avg_sat_in" value="'.date("g:i A", strtotime($profile_timing[0]->sat_in)).'" />';
		    $html .= '<input type="hidden" id="avg_sat_out" value="'.date("g:i A", strtotime($profile_timing[0]->sat_out)).'" />';
		}else{
			$html .= '<input type="hidden" id="avg_sat_in" />';
		    $html .= '<input type="hidden" id="avg_sat_out" />';
		}


	    $html .= "<script type='text/javascript'>
			$(document).ready(function() {
			    //toggle `popup` / `inline` mode
			    $.fn.editable.defaults.mode = 'popup';     
			    
			    //make editable
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
		});
		</script>";

		echo $html;
	}

	public function update_standard_profile(){


		$this->load->model('tif_a/tif_a_model','tifa');

		$profile_id = $this->input->post('profile_id');
		$profile_name = $this->input->post('profile_name');
		$morning_time = $this->input->post('morning_time');
		$afternoon_time = $this->input->post('afternoon_time');
		$wed_time = $this->input->post('wed_time');
		$fri_time = $this->input->post('fri_time');
		$ext_time = $this->input->post('ext_time');
		$ext_frequency = $this->input->post('ext_frequency');
		$july_start = $this->input->post('july_start');
		$sat_hour = $this->input->post('sat_hour');
		$sat_off = $this->input->post('sat_off');
		$sat_on  = $this->input->post('sat_on');
		$avg_hrs = $this->input->post('avg_hrs');


		$where_profile_update = array(
			'id' => $profile_id
		);

		$data_update = array(
			'name' => $profile_name,
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')
		);

		$affected_rows =  $this->tifa->update_data('atif_gs_events.tt_profile',$where_profile_update,$data_update);
		
		// Update Staff Profiling Timing

		$where_timing_update = array(
			'profile_id' => $profile_id
		);

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

		$data_time_update = array(
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
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')
		);

		$affected_row= $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_timing_update,$data_time_update);
		//echo $last_id;


		// Update WED TIME 
		if($wed_time != ''){



			$update_data = array(
				'wed_out' => $wed_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_timing_update,$update_data);
			echo $affected_row;
		}

		//Updated Fri Time
		if($fri_time != ''){



			$update_data = array(
				'fri_out' => $fri_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_timing_update,$update_data);
			echo $affected_row;
		}


	}

	// Update Custom Profile

	public function update_custom_profile(){


		$this->load->model('tif_a/tif_a_model','tifa');

		$profile_id = $this->input->post('profile_id');
		$profile_name = $this->input->post('profile_name');
		$morning_time = $this->input->post('morning_time');
		$afternoon_time = $this->input->post('afternoon_time');
		$wed_time = $this->input->post('wed_time');
		$fri_time = $this->input->post('fri_time');
		$ext_time = $this->input->post('ext_time');
		$ext_frequency = $this->input->post('ext_frequency');
		$july_start = $this->input->post('july_start');
		$sat_hour = $this->input->post('sat_hour');
		$sat_off = $this->input->post('sat_off');
		$sat_on  = $this->input->post('sat_on');
		$avg_hrs = $this->input->post('avg_hrs');



		$where_profile_update = array(
			'id' => $profile_id
		);

		$data_update = array(
			'name' => $profile_name,
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')
		);

		$affected_rows =  $this->tifa->update_data('atif_gs_events.tt_profile',$where_profile_update,$data_update);
		
		// Update Staff Profiling Timing

		$where_timing_update = array(
			'profile_id' => $profile_id
		);

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

		$data_time_update = array(
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
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')
		);

		$affected_row= $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_timing_update,$data_time_update);
		//echo $last_id;


		// Update WED TIME 
		if($wed_time != ''){



			$update_data = array(
				'wed_out' => $wed_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_timing_update,$update_data);
			echo $affected_row;
		}

		//Updated Fri Time
		if($fri_time != ''){



			$update_data = array(
				'fri_out' => $fri_time
			);

			$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_timing_update,$update_data);
			echo $affected_row;
		}

	}

	public function update_part_time_profile(){


		$this->load->model('tif_a/tif_a_model','tifa');

		$profile_id = $this->input->post('profile_id');
		$profile_name = $this->input->post('profile_name');
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
		$avg_hrs = $this->input->post('part_time_avg');


		// ========== Update Profile Name ===============//
		//===============================================//

		$where_update_profile = array(
			'id' => $profile_id
		);

		$data_update_profile = array(
			'name' => $profile_name,
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')
		); 

		$affected_row =  $this->tifa->update_data('atif_gs_events.tt_profile',$where_update_profile,$data_update_profile);

		// MON  Timing
		if($mon_in == '--:-- --' || $mon_out == '--:-- --' || $mon_in == 'Empty' || $mon_out == 'Empty' ){
			$is_on_mon = 0;
			$mon_in = '00:00:00';
			$mon_out = '00:00:00';
		}else{
			$is_on_mon = 1;
		}


		// Tuesday out

		if($tue_in == '--:-- --' || $tue_out == '--:-- --' || $tue_in == 'Empty' || $tue_out == 'Empty' ){
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

		if($thu_in == '--:-- --' || $thu_out == '--:-- --' || $thu_in == 'Empty' || $thu_out == 'Empty' ){
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

		$where_time_update = array(
			'profile_id' => $profile_id
		);

		$data_time_update = array(
			'profile_id' => $profile_id,
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
			'avg_week_hrs' => $avg_hrs,
			'created' => time(),
			'created_by' => $this->session->userdata('user_id'),
			'modified' => time(),
			'modified_by' => $this->session->userdata('user_id')

		);

		$last_id = $this->tifa->update_data('atif_gs_events.tt_profile_time',$where_time_update,$data_time_update);

	}

	public function get_update_table(){
		// var_dump($this->input->post());
		// exit
		$html = '';
		$html .= '<div class="col-md-4 BrowsingList" style="">';
	    $html .= '<div class="LeftListing" style="">';
            	
        $html .= '<div class="LeftListing_ContentSection">';
        $html .= '<div class="headingArea"><h2>Staff Profiles <a href="javascript:void(0)" class="absoluteBtn" id="add_profile">Add new Profile</a></h2></div>';
        $html .= '<table width="100%" border="1" id="TTListing" class="table table-striped table-bordered table-hover">';
	    $html .= '<thead>';
	    $html .= '<tr>';
	    $html .= '<th class="text-center no-sort" width="">SR</th>';
	    $html .= '<th class="" width="">Name</th>';
        $html .= '<th class="no-sort text-center" width="">Allocations</th>';
        $html .= '</tr>';
	    $html .= '</thead><!-- thead -->';
		$html .= '<tbody>';
		
		$select ='';
		$where = '';
		$count = 1;
		$this->load->model('tif_a/tif_a_model','tifa');
		$profile =  $this->tifa->profile_allocated();
		
		foreach($profile as $profile_name) {
	    $html .= '<tr class="">';
	    $html .= '<td class="text-center">'.$count.'</td>';
	    $html .= '<td><a href="#" data-toggle="tooltip" data-placement="top"  data-pin-nopin="true" class="anchorCol" id="profile_select" data-id ='.$profile_name->id. ' data-profileType='.$profile_name->profile_type_id.'>'.$profile_name->name.'</a></td>';
	    $count++; 
        $html .= '<td class="text-center">'.$profile_name->staff_allocation.'</td>';
        $html .= '</tr>';
    	}
                         
	    $html .= '</tbody>';
	    $html .= '</table><!-- ListingTable -->';
	    $html .= '</div><!-- LeftListing_ContentSection -->';
	    $html .= '</div><!-- .StudentListing -->';
	    $html .= '</div><!-- col-md-4 -->';
	    $html .= '<script>';
	    $html .= '  $("#TTListing").dataTable({
				      "columnDefs": [ {
				          "targets": "no-sort",
				          "orderable": false,
				    } ],
					"bLengthChange": false,
					"bInfo" : false,
				    "aLengthMenu": [[25, 50, 70, -1], [25, 50, 70, "All"]],
				    "iDisplayLength": 30
				  });';
		$html .= '</script>';
	    echo $html;
	}

	public function get_profile_name(){

		$profile_name = $this->input->post('profile_name');
		$this->load->model('tif_a/tif_a_model','tifa');
		$select = '';
		$where = array(
			'name' => $profile_name,
		);
		$found = $this->tifa->get_by('atif_gs_events.tt_profile',$select,$where);
		if(!empty($found)){
			echo "1";
		}else{
			echo "0";
		}

	}

}