<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewtifa extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
  }
  


  


  public function index(){
    $this->load->view('gs_files/header');
    $this->load->view('gs_files/main-nav');
    $this->load->view('gs_files/breadcrumb_tifa');



    $this->load->model('tif_model/tif_a_form_model');
    $this->staffData = $this->tif_a_form_model->get_StaffList();
    $this->Department = $this->tif_a_form_model->getDepartment();
    $this->Section = $this->tif_a_form_model->getSection();


    $this->load->view('staff_information_form/tif_a_view');
    $this->load->view('staff_information_form/tif_a_footer_new');
  }











  public function getStaffListing(){
    $html = '';



    if(count($_POST)){
      $Department = $this->input->post('department');
      $Section = $this->input->post('section');

      $Departments = explode(",", $Department);
      $Sections = explode(",", $Section);

      $qDepartments = '';
      $qSections = '';
      if(strlen($Department) > 3){
        $qDepartments = '(';
        foreach ($Departments as $data) {
          $qDepartments .= "sr.department = '" . $data . "' or ";      
        }
        $qDepartments = substr($qDepartments, 0, -3);
        $qDepartments .= ')';
      }
      



      if(strlen($Section) > 3){
        $qSections = '(';
        foreach ($Sections as $data) {
          $qSections .= "sr.section = '" . $data . "' or ";   
        }
        $qSections = substr($qSections, 0, -3);
        $qSections .= ')';
      }

      $this->load->model('tif_model/tif_a_form_model');
      $this->staffData = $this->tif_a_form_model->get_StaffList_Of($qDepartments, $qSections);




      $i=1; 
      foreach ($this->staffData as $data) {
        $html .= '<tr id="row-'.$data['gt_id'].'">
          <td class="text-center">'.$i.'</td>
          <td class="text-center">'.$data['gt_id'].'</td>
          <td class="data-gt_id"><a href="#" data-toggle="tooltip" data-placement="top" data-original-title="GT-ID: '.$data['gt_id'].'" data-pin-nopin="true" class="anchorCol">'.$data['abridged_name'].'</a></td>
          <td class="text-center"><span class="AttBox PP" style="min-width:60px;">
                  <span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="Presence Pending Verification" data-pin-nopin="true">PP</span><span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">9</span><span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">8</span>
              </span></td>
        </tr>';
        $i++;
      }
    }



    echo $html;
  }




  public function getStaff_tifA(){
    $html = '';
    if(count($_POST)){
      $GTID = $this->input->post('GTID');



      $staff_2_SR = array();
      $MatrixRole_FR = array();


      /* Declaring Role 1 Variables */
      /******************************/
      $staff_PR[0]['gt_id'] = '';
      $staff_PR[0]['name_code'] = '';
      $staff_PR[0]['abridged_name'] = '';
      $staff_PR[0]['c_topline'] = '';
      $staff_PR[0]['c_bottomline'] = '';
      $staff_PR[0]['gp_id'] = '';
      $staff_PR[0]['report_ok'] = '';
      $staff_PR[0]['reporting_line'] = '';
      $staff_PR[0]['role_title_tl'] = '';

      $staff_PR_PR[0]['gt_id'] = '';
      $staff_PR_PR[0]['name_code'] = '';
      $staff_PR_PR[0]['abridged_name'] = '';
      $staff_PR_PR[0]['c_topline'] = '';
      $staff_PR_PR[0]['c_bottomline'] = '';
      $staff_PR_PR[0]['gp_id'] = '';
      $staff_PR_PR[0]['report_ok'] = '';
      $staff_PR_PR[0]['reporting_line'] = '';
      $staff_PR_PR[0]['role_title_tl'] = '';

      $staff_SR[0]['gt_id'] = '';
      $staff_SR[0]['name_code'] = '';
      $staff_SR[0]['abridged_name'] = '';
      $staff_SR[0]['c_topline'] = '';
      $staff_SR[0]['c_bottomline'] = '';
      $staff_SR[0]['gp_id'] = '';
      $staff_SR[0]['report_ok'] = '';
      $staff_SR[0]['reporting_line'] = '';
      $staff_SR[0]['role_title_tl'] = '';

      $staff_SR_PR[0]['gt_id'] = '';
      $staff_SR_PR[0]['name_code'] = '';
      $staff_SR_PR[0]['abridged_name'] = '';
      $staff_SR_PR[0]['c_topline'] = '';
      $staff_SR_PR[0]['c_bottomline'] = '';
      $staff_SR_PR[0]['gp_id'] = '';
      $staff_SR_PR[0]['report_ok'] = '';
      $staff_SR_PR[0]['reporting_line'] = '';
      $staff_SR_PR[0]['role_title_tl'] = '';

      /* Declaring Role 2 Variables */
      /******************************/
      $staff_2_PR[0]['gt_id'] = '';
      $staff_2_PR[0]['name_code'] = '';
      $staff_2_PR[0]['abridged_name'] = '';
      $staff_2_PR[0]['c_topline'] = '';
      $staff_2_PR[0]['c_bottomline'] = '';
      $staff_2_PR[0]['gp_id'] = '';
      $staff_2_PR[0]['report_ok'] = '';
      $staff_2_PR[0]['reporting_line'] = '';
      $staff_2_PR[0]['role_title_tl'] = '';

      $staff_2_PR_PR[0]['gt_id'] = '';
      $staff_2_PR_PR[0]['name_code'] = '';
      $staff_2_PR_PR[0]['abridged_name'] = '';
      $staff_2_PR_PR[0]['c_topline'] = '';
      $staff_2_PR_PR[0]['c_bottomline'] = '';
      $staff_2_PR_PR[0]['gp_id'] = '';
      $staff_2_PR_PR[0]['report_ok'] = '';
      $staff_2_PR_PR[0]['reporting_line'] = '';
      $staff_2_PR_PR[0]['role_title_tl'] = '';


      $staff_2_SR_PR[0]['gt_id'] = '';
      $staff_2_SR_PR[0]['name_code'] = '';
      $staff_2_SR_PR[0]['abridged_name'] = '';
      $staff_2_SR_PR[0]['c_topline'] = '';
      $staff_2_SR_PR[0]['c_bottomline'] = '';
      $staff_2_SR_PR[0]['gp_id'] = '';
      $staff_2_SR_PR[0]['report_ok'] = '';
      $staff_2_SR_PR[0]['reporting_line'] = '';
      $staff_2_SR_PR[0]['role_title_tl'] = '';















      /* Load Model */
      $this->load->model('tif_model/tif_a_form_model');
      $staffData = $this->tif_a_form_model->get_StaffInfo($GTID);
      $StaffReportee = array();
      $StaffReportee_SC = array();
      $StaffReportee2 = array();
      $StaffReportee2_SC = array();
      $staffTTProfile = array();




      $staffTTProfile = $this->tif_a_form_model->getStaff_TTProfile($GTID);
      $Timing_Profile = '';
      $Timing_AvgWeekHrs = '';
      $Timing_StdIN = '';
      $Timing_StdOut = '';
      $Timing_FriOut = '';
      $Timing_SatHrs = '';
      $Timing_SatOffs = '';
      $Timing_SatWorking = '';
      $Timing_SatOff = '';
      $Timing_ExtOut = '';
      $Timing_ExtFrq = '';
      $Timing_JulCat = '';
      $Timing_FriOutF = '';
      $Timing_MonIn = '';
      $Timing_TueIn = '';
      $Timing_WedIn = '';
      $Timing_ThuIn = '';
      $Timing_FriIn = '';
      $Timing_SatIn = '';
      $Timing_SunIn = '';
      $Timing_MonOut = '';
      $Timing_TueOut = '';
      $Timing_WedOut = '';
      $Timing_ThuOut = '';
      $Timing_FriOut = '';
      $Timing_SatOut = '';
      $Timing_SunOut = '';
      if(!empty($staffTTProfile)){
        $Timing_Profile = $staffTTProfile[0]['time_profile'];
        $Timing_AvgWeekHrs = $staffTTProfile[0]['avg_week_hrs'];
        $Timing_StdIN = $staffTTProfile[0]['std_in'];
        $Timing_StdOut = $staffTTProfile[0]['std_out'];
        $Timing_FriOutF = $staffTTProfile[0]['fri_out'];
        $Timing_SatHrs = $staffTTProfile[0]['sat_hrs'];
        $Timing_SatOffs = $staffTTProfile[0]['sat_off'];
        $Timing_SatWorking = $staffTTProfile[0]['sat_working'];
        $Timing_SatOff = $staffTTProfile[0]['sat_off'];
        $Timing_ExtOut = $staffTTProfile[0]['ext_time'];
        $Timing_ExtFrq = $staffTTProfile[0]['ext_frequency'];
        $Timing_JulCat = $staffTTProfile[0]['ext_july'];

        if($staffTTProfile[0]['ty_name'] != 'Standard'){
          $Timing_MonIn = $staffTTProfile[0]['mon_in'];
          $Timing_TueIn = $staffTTProfile[0]['tue_in'];
          $Timing_WedIn = $staffTTProfile[0]['wed_in'];
          $Timing_ThuIn = $staffTTProfile[0]['thu_in'];
          $Timing_FriIn = $staffTTProfile[0]['fri_in'];
          $Timing_SatIn = $staffTTProfile[0]['sat_in'];
          $Timing_SunIn = $staffTTProfile[0]['sun_in'];
          $Timing_MonOut = $staffTTProfile[0]['mon_out'];
          $Timing_TueOut = $staffTTProfile[0]['tue_out'];
          $Timing_WedOut = $staffTTProfile[0]['wed_out'];
          $Timing_ThuOut = $staffTTProfile[0]['thu_out'];
          $Timing_FriOut = $staffTTProfile[0]['fri_out'];
          $Timing_SatOut = $staffTTProfile[0]['sat_out'];
          $Timing_SunOut = $staffTTProfile[0]['sun_out'];
        }
      }







      $StaffReportee_TRP = array();
      if(!empty($staffData[0]['role_id'])){
        $StaffReportee = $this->tif_a_form_model->get_StaffReporteeInfo($staffData[0]['role_id']);
        $StaffReportee_SC = $this->tif_a_form_model->get_StaffReporteeSCInfo($staffData[0]['role_id']);

        $i = 0;
        foreach ($StaffReportee as $rr) {
          if($StaffReportee[$i]['report_ok'] == 'TRP'){
            $StaffReportee_TRP = $this->tif_a_form_model->get_StaffReporteeInfo($StaffReportee[$i]['role_id'], 'INDIR', $StaffReportee[$i]['name_code']);
            foreach ($StaffReportee_TRP as $trp) {
              array_push($StaffReportee, $trp);
            }
          }
          $i++;
        }
      }


      $StaffReportee2 = array();
      if(!empty($staffData[1]['role_id'])){
        $StaffReportee2 = $this->tif_a_form_model->get_StaffReporteeInfo($staffData[1]['role_id']);
        $StaffReportee2_SC = $this->tif_a_form_model->get_StaffReporteeSCInfo($staffData[1]['role_id']);


        
        $i = 0;
        foreach ($StaffReportee2 as $rr) {
          if($StaffReportee2[$i]['report_ok'] == 'TRP'){
            $StaffReportee_TRP = $this->tif_a_form_model->get_StaffReporteeInfo($StaffReportee2[$i]['role_id'], 'INDIR', $StaffReportee2[$i]['name_code']);
            foreach ($StaffReportee_TRP as $trp) {
              array_push($StaffReportee2, $trp);
            }
          }
          $i++;
        }
      }
      $i = 0;



      if(!empty($staffData[0]['pm_report_to'])){
        $staff_PR = $this->tif_a_form_model->get_StaffReportingInfo_CLTRole($staffData[0]['pm_report_to'], $GTID);
      }else{
        $staff_PR = $this->tif_a_form_model->get_StaffMatrixRole_CLT_Reportoo($GTID);
        if(empty($staff_PR)){
          $staff_PR = $this->tif_a_form_model->get_StaffReportingInfo_SBJRole($GTID);
        }

        if(empty($staff_PR)){
          $staff_PR[0]['gt_id'] = '';
          $staff_PR[0]['name_code'] = '';
          $staff_PR[0]['abridged_name'] = '';
          $staff_PR[0]['c_topline'] = '';
          $staff_PR[0]['c_bottomline'] = '';
          $staff_PR[0]['gp_id'] = '';
          $staff_PR[0]['report_ok'] = '';
          $staff_PR[0]['reporting_line'] = '';
          $staff_PR[0]['role_title_tl'] = '';
        }
      }
      if(!empty($staffData[0]['sc_report_to'])){
        $staff_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['sc_report_to']);
      }
      if(!empty($staff_PR[0]['pm_report_to'])){
        $staff_PR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_PR[0]['pm_report_to']);
      }
      if(!empty($staff_SR[0]['pm_report_to'])){
        $staff_SR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_SR[0]['pm_report_to']);
      }



      if(!empty($staffData[1]['pm_report_to'])){
        $staff_2_PR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[1]['pm_report_to']);
      }
      if(!empty($staffData[1]['sc_report_to'])){
        $staff_2_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[1]['sc_report_to']);
      }
      if(!empty($staff_2_PR[0]['pm_report_to'])){
        $staff_2_PR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_2_PR[0]['pm_report_to']);
      }
      if(!empty($staff_2_SR[0]['pm_report_to'])){
        $staff_2_SR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_2_SR[0]['pm_report_to']);
      }



      if(empty($staff_2_SR)){
        $staff_2_SR[0]['gt_id'] = '';
        $staff_2_SR[0]['name_code'] = '';
        $staff_2_SR[0]['abridged_name'] = '';
        $staff_2_SR[0]['c_topline'] = '';
        $staff_2_SR[0]['c_bottomline'] = '';
        $staff_2_SR[0]['gp_id'] = '';
        $staff_2_SR[0]['report_ok'] = '';
        $staff_2_SR[0]['reporting_line'] = '';
        $staff_2_SR[0]['role_title_tl'] = '';
      }



      $staffData_MatrixCLT = $this->tif_a_form_model->get_StaffMatrixRole_CLT($GTID);
      $staffData_MatrixSBJ = $this->tif_a_form_model->get_StaffMatrixRole_SBJ($GTID);



      $totalPF = 0;
      $totalP = 0;
      $totalSC = 0;
      $TotalStaffMembers = 0;
      $TotalStudentMemebers = 0;
      if(!empty($staffData)){
         $TotalStaffMembers = $staffData[0]['total_staff_members'];
      }
      foreach ($StaffReportee as $cal1) {
        if($cal1['reporting_type'] == 'FP'){
          $totalPF++;
        }
        $totalP++;
      }




      $totalPF2 = 0;
      $totalP2 = 0;
      $totalSC2 = 0;
      $TotalStaffMembers2 = 0;
      $TotalStudentMemebers2 = 0;
      if(!empty($staffData[1])){
         $TotalStaffMembers2 = $staffData[1]['total_staff_members'];
      }
      foreach ($StaffReportee2 as $cal2) {
        if($cal2['reporting_type'] == 'FP'){
          $totalPF2++;
        }
        $totalP2++;
      }

      

      $reporteesFundamental = $totalPF + $totalPF2;
      $reportteesSecondary = $totalSC + $totalSC2;
      $reporteesPrimary = $totalP + $totalP2;
      $reporteesTotal = $totalP+count($StaffReportee_SC)+$totalP2+count($StaffReportee2_SC);
      $membersTotal = $TotalStaffMembers + $TotalStaffMembers2;
      $classRole = '-';
      $roleTeachingTotal = 0;
      $roleTeachingBlocks = 0;
      $roleTeachingStudents = 0;
      $uniqueStudentsTotal = $this->tif_a_form_model->getUniqueStudents($GTID);
      $studentBlocksTotal = 0;
      if(!empty($staffData_MatrixCLT)){
        $classRole = $staffData_MatrixCLT[0]['gp_id'];
        $roleTeachingStudents += $staffData_MatrixCLT[0]['students'];
      }
      if(!empty($staffData_MatrixSBJ)){
        foreach ($staffData_MatrixSBJ as $data) {
          $roleTeachingTotal++;
          $roleTeachingBlocks += $data['block'];
          $roleTeachingStudents += $data['students'];
        }
      }






      /* Local Variables */
      $this->data['photo_file'] = '.png';
      $this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
      $ImageName = base_url() . $this->data['staff_150_photo_path'] . $staffData[0]['photo_id'] . $this->data['photo_file'];
      $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
      $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
      $ImageFound = "Yes";

      if (!file_exists($this->data['staff_150_photo_path'] . $staffData[0]['photo_id'] . $this->data['photo_file'])) {
        if($staffData[0]['gender'] == 'M'){
            $ImageName = $ImageMale;
        }else if($staffData[0]['gender'] == 'F'){
            $ImageName = $ImageFemale;
        }

        $ImageFound = "No";
      }






      $html .= '
      <div class="col-md-12 RightInformation_headerSection">
              <div class="col-md-4 borderRightRed paddingLeft0">
                <div class="col-md-4 paddingLeft0 paddingRight0" style="max-width:105px;">
                  <img width="100%" src="'.$ImageName.'" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;padding-bottom:20px;"><span class="nameCode">'.$staffData[0]['name_code'].'</span>
                </div><!-- col-md-4 -->
                <div class="col-md-8 paddingRight0">
          <h2 class="headHeading">'.$staffData[0]['name'].'</h2>
          <h6 class="normalFont"><span class="leftLab2">GT-ID:</span> <strong>'.$GTID.' </strong>('.$staffData[0]['staff_status_code'].')</h6>
          <h6 class="normalFont"><span class="leftLab2">GU-ID:</span> <strong>'.$staffData[0]['gg_id'].'</strong></h6>
          <h6 class="normalFont"><span class="leftLab2">Date of Joining:</span> <strong>'.date_format(date_create($staffData[0]['doj']), "d-M-y").'</strong></h6>
             
        </div><!-- col-md-8 -->
              </div><!-- col-md-4 -->
              <div class="col-md-4 borderRightRed" style="height:126px;">
              
              </div><!-- col-md-4 -->
              <div class="col-md-3"  style="height:126px;">
          
              </div><!-- col-md-3 -->
        <a href="'.site_url('staff_information_form_basic/viewtifa/getTIFA?GTID=').$GTID.'" class="PrintButtonTop" target="_blank">&nbsp;</a>
          </div><!-- RightInformation_headerSection -->';




      $html .= '
          <div class="RightInformation">
              <div class="RightInformation_contentSection" style="padding:0;">
                  <?php /* ?><?php */ ?>
                    <div class="summarySection col-md-12">
                      <div class="col-md-6">
                          <div class="col-md-6 paddingLeft0">
                              <div class="primaryReporting">
                                    <h4 class="PrimaryName"><span class="namePrimaryCode">'.$staff_PR[0]['name_code'].'</span>'.$staff_PR[0]['abridged_name'].'</h4>
                                    <h5 class="PrimaryTopLine">'.$staff_PR[0]['c_topline'].'</h5>
                                    <h5 class="PrimaryBottomLine">'.$staff_PR[0]['c_bottomline'].'</h5>
                                </div><!-- primaryReporting -->
                            </div><!-- col-md-6 -->
                            <div class="col-md-6 paddingRight0">
                              <div class="reportingPersonal">
                                    <h4 class="PrimaryName"><span class="namePrimaryCode">'.$staffData[0]['name_code'].'</span>'.$staffData[0]['abridged_name'].'</h4>
                                    <h5 class="PrimaryTopLine">'.$staffData[0]['c_topline'].'</h5>
                                    <h5 class="PrimaryBottomLine">'.$staffData[0]['c_bottomline'].'</h5>
                                </div><!-- primaryReporting -->
                            </div><!-- col-md-6 -->
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                          <div class="col-md-6 paddingLeft0 paddingRight0">
                              <h6 class="normalFont pull-right"><span class="leftLab3">Fundamental Reportees:</span> <strong> '.$reporteesFundamental.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Primary Reportees:</span> <strong> '.$reporteesPrimary.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Reportees:</span> <strong> '.$reporteesTotal.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Members:</span> <strong> '.$membersTotal.' </strong></h6>
                            </div><!-- -->
                            <div class="col-md-6 paddingLeft0 paddingRight0">
                                <h6 class="normalFont pull-right"><span class="leftLab3"> Total Teaching Roles:</span> <strong>'.$roleTeachingTotal.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Class Role:</span> <strong> '.$classRole.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Teaching Blocks:</span> <strong>'.$roleTeachingBlocks.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Teaching Students:</span> <strong> '.$roleTeachingStudents.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Unique Students:</span> <strong> '.$uniqueStudentsTotal.' </strong></h6>
                                <h6 class="normalFont pull-right"><span class="leftLab3">Total Student Blocks:</span> <strong> '.$studentBlocksTotal.' </strong></h6>
                            </div><!-- -->
                        </div><!-- col-md-6 -->
                    </div><!-- summarySection -->
                  <hr style="margin-top: 5px;" />
                    <div class="TimingSection col-md-12">
                      <div class="col-md-3 paddingLeft0 text-center ">
                          <h5>Timing Profile & Hours</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">Timing Profile</td>
                              </tr>
                              <tr>
                                <td colspan="2"><h4 style="margin:0;font-size:16px;font-weight:bold;"> '.$Timing_Profile.' </h4></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2">Average Weekly Hours</td>
                              </tr>
                              <tr>
                                <td colspan="2"><h4 style="margin:0;font-size:16px;font-weight:bold;"> '.$Timing_AvgWeekHrs.' </h4></td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                        </div><!-- col-md-3 -->
                        <div class="col-md-3 paddingLeft0 text-center">
                          <h5>Full Time Parameters</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Standard IN</td>
                                <td class="text-right"><strong> '.$Timing_StdIN.' </strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Standard OUT</td>
                                <td class="text-right"><strong> '.$Timing_StdOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Friday OUT</td>
                                <td class="text-right"><strong> '.$Timing_FriOutF.' </strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Saturday Hrs</td>
                                <td class="text-right"><strong> '.$Timing_SatHrs.' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                        </div><!-- col-md-3 -->
                        <div class="col-md-3 paddingLeft0 text-center">
                          <h5>Secondary Parameters</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Sats Working</td>
                                <td class="text-right"><strong> '.$Timing_SatWorking.' </strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Sats Off</td>
                                <td class="text-right"><strong> '.$Timing_SatOffs.' </strong></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td class="text-left">Ext. Out</td>
                                <td class="text-right"><strong> '.$Timing_ExtOut.' </strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">Ext. FREQ</td>
                                <td class="text-right"><strong> '.$Timing_ExtFrq.' </strong></td>
                              </tr>
                              <tr>
                                <td class="text-left">July Category</td>
                                <td class="text-right"><strong> '.$Timing_JulCat.' </strong></td>
                              </tr>
                              <tr>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                            </table>
                        </div><!-- col-md-3 -->
                        <div class="col-md-3 paddingLeft0 text-center">
                          <h5>Custom Timings</h5>
                            <table width="100%" border="0" class="TimingSectionTable">
                              <tr>
                                <td colspan="3">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>Mon</td>
                                <td><strong> '.$Timing_MonIn.' </strong></td>
                                <td><strong> '.$Timing_MonOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>Tue</td>
                                <td><strong> '.$Timing_TueIn.' </strong></td>
                                <td><strong> '.$Timing_TueOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>Wed</td>
                                <td><strong> '.$Timing_WedIn.' </strong></td>
                                <td><strong> '.$Timing_WedOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>Thu</td>
                                <td><strong> '.$Timing_ThuIn.' </strong></td>
                                <td><strong> '.$Timing_ThuOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>Fri</td>
                                <td><strong> '.$Timing_FriIn.' </strong></td>
                                <td><strong> '.$Timing_FriOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>Sat</td>
                                <td><strong> '.$Timing_SatIn.' </strong></td>
                                <td><strong> '.$Timing_SatOut.' </strong></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                              </tr>
                            </table>

                        </div><!-- col-md-3 -->
                    </div><!-- TimingSection -->
                    <hr style="margin-top: 5px;" />';






          $ij = 0;
          $html .= '<div class="MatrixRolesSection">
                      <h4 class="col-md-6 col-md-offset-3 text-center MatrixRoles">Matrix Role(s) <small>for Classes and Groups</small></h4>
                        <div class="col-md-12 paddingBottom40">
                          <div class="col-md-6 col-md-offset-3 paddingLeft0 paddingRight0">';


                      if(!empty($staffData_MatrixCLT)){
                      $ij = 1;
                      $html .= '<table width="100%" border="0" class="FunDaMentalReporting">
                                  <tr>';
                                  if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixCLT[0]['name_code'] == $staff_PR[0]['name_code']){
                                    $html .= '<td class="text-center FunRep">FR</td>';
                                  }
                          $html .= '<td class="text-center ClassTeach">'.$staffData_MatrixCLT[0]['clt_type'].'</td>
                                    <td class="text-center ClassHere">'.$staffData_MatrixCLT[0]['class'].'</td>
                                    <td class="text-center ClassSectionHere">'.$staffData_MatrixCLT[0]['gp_id'].'</td>
                                    <td class="text-center StuStrength">'.$staffData_MatrixCLT[0]['students'].'</td>
                                    <td class="text-center TopBottomLine">'.$staffData_MatrixCLT[0]['role_title_tl'].'<br />'.$staffData_MatrixCLT[0]['abridged_name'].'</td>
                                    <td class="text-center ReportingCodeName">'.$staffData_MatrixCLT[0]['name_code'].'</td>
                                  </tr>
                                </table>';

                                if($staffData_MatrixCLT[0]['lt_staff_id'] != ''){
                                  array_push($MatrixRole_FR, array('staff_id' => $staffData_MatrixCLT[0]['lt_staff_id'], 'abridged_name' => $staffData_MatrixCLT[0]['abridged_name']));
                                }
                      }
                $html .= '</div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->';




              $foundFR = false;
              for($i=0; $i<=11; $i++){
              $html .= '<div class="col-md-12 paddingBottom20">
                          <div class="col-md-6">';

                            if($i==0){
                      if(!empty($staffData_MatrixSBJ[$i])){
                      $html .= '<table width="100%" border="0" class="FunDaMentalReportingChap" style="//border:1px solid #000;">
                                  <tr>
                                    <td width="10%" class="text-center SRNO">'.($i+1+$ij).'</td>
                                    <td width="20%" class="text-center SubjectName">'.$staffData_MatrixSBJ[$i]['gp_id'].'</td>
                                    <td width="5%" class="text-center StuStrength">'.$staffData_MatrixSBJ[$i]['students'].'</td>
                                    <td width="5%" class="text-center Blocks">'.$staffData_MatrixSBJ[$i]['block'].'</td>
                                    <td width="30%" class="text-center TopBottomLine">'.$staffData_MatrixSBJ[$i]['role_title_tl'].'<br />'.$staffData_MatrixSBJ[$i]['abridged_name'].'</td>
                                    <td width="10%" class="text-center NameCodeHere">'.$staffData_MatrixSBJ[$i]['name_code'].'</td>
                                    <td width="10%" class="text-center RankHere">'.$staffData_MatrixSBJ[$i]['reporting_line'].'</td>';
                                if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixSBJ[$i]['name_code'] == $staff_PR[0]['name_code'] && !$foundFR){
                                  $html .= '<td width="10%" class="text-center FunRep">FR</td>
                                            </tr>
                                          </table>';
                                  $foundFR = true;
                                }else{
                                  $html .= '<td width="10%" class="text-center FunRep White"></td>
                                            </tr>
                                          </table>';
                                }


                                if($staffData_MatrixSBJ[$i]['yt_staff_id'] != ''){
                                  array_push($MatrixRole_FR, array('staff_id' => $staffData_MatrixSBJ[$i]['yt_staff_id'], 'abridged_name' => $staffData_MatrixSBJ[$i]['abridged_name']));
                                }

                              }}else{if(!empty($staffData_MatrixSBJ[$i])){
                      $html .= '<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td width="10%" class="text-center SRNO">'.($i+1+$ij).'</td>
                                    <td width="20%" class="text-center SubjectName">'.$staffData_MatrixSBJ[$i]['gp_id'].'</td>
                                    <td width="5%" class="text-center StuStrength">'.$staffData_MatrixSBJ[$i]['students'].'</td>
                                    <td width="5%" class="text-center Blocks">'.$staffData_MatrixSBJ[$i]['block'].'</td>
                                    <td width="30%" class="text-center TopBottomLine">'.$staffData_MatrixSBJ[$i]['role_title_tl'].'<br />'.$staffData_MatrixSBJ[$i]['abridged_name'].'</td>
                                    <td width="10%" class="text-center NameCodeHere">'.$staffData_MatrixSBJ[$i]['name_code'].'</td>
                                    <td width="10%" class="text-center RankHere">'.$staffData_MatrixSBJ[$i]['reporting_line'].'</td>';

                                if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixSBJ[$i]['name_code'] == $staff_PR[0]['name_code'] && !$foundFR){
                                  $html .= '<td width="10%" class="text-center FunRep">FR</td>
                                            </tr>
                                          </table>';
                                  $foundFR = true;
                                }else{
                                  $html .= '<td width="10%" class="text-center FunRep White"></td>
                                            </tr>
                                          </table>';
                                }
                                if($staffData_MatrixSBJ[$i]['yt_staff_id'] != ''){
                                  array_push($MatrixRole_FR, array('staff_id' => $staffData_MatrixSBJ[$i]['yt_staff_id'], 'abridged_name' => $staffData_MatrixSBJ[$i]['abridged_name']));
                                }
                              }}

                    $html .= '</div><!-- col-md-6 -->
                            <div class="col-md-6">';
                            if(!empty($staffData_MatrixSBJ[($i+12)])){
                      $html .= '<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td class="text-center SRNO">'.($i+13+$ij).'</td>
                                    <td class="text-center SubjectName">'.$staffData_MatrixSBJ[($i+12)]['gp_id'].'</td>
                                    <td class="text-center StuStrength">'.$staffData_MatrixSBJ[($i+12)]['students'].'</td>
                                    <td class="text-center Blocks">'.$staffData_MatrixSBJ[($i+12)]['block'].'</td>
                                    <td class="text-center TopBottomLine">'.$staffData_MatrixSBJ[($i+12)]['role_title_tl'].'<br />'.$staffData_MatrixSBJ[($i+12)]['abridged_name'].'</td>
                                    <td class="text-center NameCodeHere">'.$staffData_MatrixSBJ[($i+12)]['name_code'].'</td>
                                    <td class="text-center RankHere">'.$staffData_MatrixSBJ[($i+12)]['reporting_line'].'</td>';

                                if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixSBJ[$i+12]['name_code'] == $staff_PR[0]['name_code'] && !$foundFR){
                                  $html .= '<td width="10%" class="text-center FunRep">FR</td>
                                            </tr>
                                          </table>';
                                        $foundFR = true;
                                }else{
                                  $html .= '<td width="10%" class="text-center FunRep White"></td>
                                            </tr>
                                          </table>';
                                }
                                if($staffData_MatrixSBJ[$i]['yt_staff_id'] != ''){
                                  array_push($MatrixRole_FR, array('staff_id' => $staffData_MatrixSBJ[$i]['yt_staff_id'], 'abridged_name' => $staffData_MatrixSBJ[$i]['abridged_name']));
                                }
                              }
                  $html .= '</div><!-- col-md-6 -->
                            
                        </div><!-- col-md-12 -->';
              }

    
  if(count($MatrixRole_FR)>=2){ 
    $html .= '<select id="soflow">
               <option selected disabled>Select Fundamental Reporting</option>';

    //$MatrixRole_FR = array_unique($MatrixRole_FR);
    //$input = array_map("unserialize", array_unique(array_map("serialize", $input)));
    //$MatrixRole_FR = array_map("unserialize", array_unique(array_map("serialize", $MatrixRole_FR)));
    $MatrixRole_FR = array_unique($MatrixRole_FR, SORT_REGULAR);
    foreach ($MatrixRole_FR as $data) {
      $html .= '<option value="'.$data['staff_id'].'">'.$data['abridged_name'].'</option>';
    }
    $html .= '</select>';
  }




          if(!empty($staff_PR[0]['junkRole'])){
            $staff_PR[0]['gt_id'] = '';
            $staff_PR[0]['name_code'] = '';
            $staff_PR[0]['abridged_name'] = '';
            $staff_PR[0]['c_topline'] = '';
            $staff_PR[0]['c_bottomline'] = '';
            $staff_PR[0]['gp_id'] = '';
            $staff_PR[0]['report_ok'] = '';
            $staff_PR[0]['reporting_line'] = '';
            $staff_PR[0]['role_title_tl'] = '';
          }

          $html .= '</div><!-- MatrixRolesSection -->
                    <hr style="margin-top: 5px;" />
                    <div class="orgChartSection">
                      <h4 class="col-md-6 col-md-offset-3 text-center MatrixRoles">Org Chart Roles(s) <small>for Non-Classroom Roles</small> | Role 1</h4>
                        <?php /* ?><?php */ ?>
                      <div class="no-padding col-md-10 col-md-offset-1">
                            <div class="blackSolidBorder">&nbsp;</div>
                            <div class="graySolidBorder">&nbsp;</div>
                            <div class="grayDashedBorder">&nbsp;</div>
                          <div class="col-md-12 ">
                              <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>PRIMARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">'.$staff_PR_PR[0]['gp_id'].'</td>
                                        <td width="30%">'.$staff_PR_PR[0]['report_ok'].'</td>
                                        <td width="30%">1</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_PR_PR[0]['c_topline'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40">'.$staff_PR_PR[0]['gt_id'].'</td>
                                        <td colspan="2">'.$staff_PR_PR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_PR_PR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                  
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>SECONDARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">'.$staff_SR_PR[0]['gp_id'].'</td>
                                        <td width="30%">'.$staff_SR_PR[0]['report_ok'].'</td>
                                        <td width="30%">4</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_SR_PR[0]['c_topline'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40">'.$staff_SR_PR[0]['gt_id'].'</td>
                                        <td colspan="2">'.$staff_SR_PR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_SR_PR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                              <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>PRIMARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="#e5d998">'.$staff_PR[0]['gp_id'].'</td>
                                        <td width="30%" bgcolor="#ffff00">'.$staff_PR[0]['report_ok'].'</td>
                                        <td width="30%" bgcolor="#ffff00">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#e5d998">'.$staff_PR[0]['c_topline'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="#f4ecfd">'.$staff_PR[0]['gt_id'].'</td>
                                        <td colspan="2" bgcolor="#f4ecfd">'.$staff_PR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#f4ecfd">'.$staff_PR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>SECONDARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">'.$staff_SR[0]['gp_id'].'</td>
                                        <td width="30%">'.$staff_SR[0]['report_ok'].'</td>
                                        <td width="30%">5</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_SR[0]['c_topline'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40">'.$staff_SR[0]['gt_id'].'</td>
                                        <td colspan="2">'.$staff_SR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_SR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                              <div class="col-md-6 col-md-offset-3 text-center" style="background:#e2e2e2;padding:15px;">
                                  <table width="100%" border="1" bgcolor="#fff" class="firstLevelReporting" style="background:#fff;" >
                                      <tr>
                                        <td bgcolor="#ade4f2"><h5 style="color:#;">FR</h5></td>
                                        <td colspan="2" bgcolor="#ade4f2"><h5>ROLE A</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="#e5d998">'.$staffData[0]['gp_id'].'</td>
                                        <td width="30%" bgcolor="#ffff00">'.$staffData[0]['report_ok'].'</td>
                                        <td width="30%" bgcolor="#ffff00">3</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#e5d998">'.$staffData[0]['role_title_tl'].', '.$staffData[0]['role_title_bl'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="#ade4f2">'.$staffData[0]['roleCode'].'</td>
                                        <td colspan="2" bgcolor="#f4ecfd">'.$staffData[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                              <div class="col-md-6 col-md-offset-3 text-center" style="background:none;padding:15px;">
                                  <table width="100%" border="1">
                                      <tr>
                                        <td colspan="2" width="33%" height="90">Fundamental<br />Primary<br /><h5><strong>'.$totalPF.'</strong></h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Primary<br /><h5><strong>'.$totalP.'</strong></h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Reportee<br /><h5><strong>'.($totalP+count($StaffReportee_SC)).'</strong></h5></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" width="50%"  height="80">Total Staff<br />Members<br /><h5><strong>'.$TotalStaffMembers.'</strong></h5></td>
                                        <td colspan="3" width="50%"  height="80">Total Student<br />Members<br /><h5><strong>'.$TotalStudentMemebers.'</strong></h5></td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                        </div><!-- col-md-12 -->
                        <hr class="smallHR" />';

                 
                 $j = 1;
                 for($i=0; $i<=count($StaffReportee); $i++) {
                 $html .=  '
                          <div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                            <div class="col-md-6">';
                              if(!empty($StaffReportee[$i])) {
                              $html .= '<table width="100%" border="1" class="text-center" style="height:70px;color:#000;font-size:12px;">
                                <tr>
                                  <td width="10%" bgcolor="#f5f5f5">'.($i+1).'</td>
                                  <td width="10%" bgcolor="#f5f5f5">'.$StaffReportee[$i]['reporting_type'].'</td>
                                  <td width="40%" bgcolor="#f4ecfd"><strong>'.$StaffReportee[$i]['abridged_name'].'</strong></td>
                                  <td width="20%" bgcolor="#ade4f2">'.$StaffReportee[$i]['roleCode'].'</td>
                                  <td width="20%" bgcolor="#ade4f2"> '.$StaffReportee[$i]['total_reportee'].' ('. $StaffReportee[$i]['total_staff_members'] .') </td>
                                </tr>
                                <tr>
                                  <td bgcolor="#ffff00">'.$StaffReportee[$i]['report_ok'].'</td>';

                                  if($StaffReportee[$i]['reporting_type'] == 'INDIR'){
                                    $html .= '<td bgcolor="#ffff00">('.$StaffReportee[$i]['name_code'].')</td>';
                                  }else{
                                    $html .= '<td bgcolor="#ffff00"></td>';
                                  }

                                  $html .= '<td bgcolor="#e5d998">'.$StaffReportee[$i]['role_title_tl'].'</td>
                                  <td colspan="2" bgcolor="#e5d998">'.$StaffReportee[$i]['gp_id'].'</td>
                                </tr>
                              </table>';
                              }


                            $html .= '</div><!-- col-md-6 -->
                            <div class="col-md-6">';
                            if(!empty($StaffReportee_SC[$i])) {
                              $html .= '<table width="100%" border="1" class="text-center" style="height:70px;color:#000;font-size:12px;">
                                <tr>
                                  <td width="10%" bgcolor="#f5f5f5">'.($totalPF + $totalP + $j).'</td>
                                  <td width="10%" bgcolor="#f5f5f5">'.$StaffReportee_SC[$i]['reporting_type'].'</td>
                                  <td width="40%" bgcolor="#f4ecfd"><strong>'.$StaffReportee_SC[$i]['abridged_name'].'</strong></td>
                                  <td width="20%" bgcolor="#ade4f2">'.$StaffReportee_SC[$i]['roleCode'].'</td>
                                  <td width="20%" bgcolor="#ade4f2"> '.$StaffReportee_SC[$i]['total_reportee'].' ('. $StaffReportee_SC[$i]['total_staff_members'] .') </td>
                                </tr>
                                <tr>
                                  <td bgcolor="#ffff00">'.$StaffReportee_SC[$i]['report_ok'].'</td>';

                                  if($StaffReportee_SC[$i]['reporting_type'] == 'INDIR'){
                                    $html .= '<td bgcolor="#ffff00">('.$StaffReportee_SC[$i]['name_code'].')</td>';
                                  }else{
                                    $html .= '<td bgcolor="#ffff00"></td>';
                                  }

                                  $html .= '<td bgcolor="#e5d998">'.$StaffReportee_SC[$i]['role_title_tl'].'</td>
                                  <td colspan="2" bgcolor="#e5d998">'.$StaffReportee_SC[$i]['gp_id'].'</td>
                                </tr>
                              </table>';
                              /*$html .= '<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                <tr>
                                  <td width="15%" bgcolor="#f5f5f5">'.($totalPF + $totalP + $j).'</td>
                                  <td width="15%" bgcolor="#f5f5f5">SC</td>
                                  <td width="15%" bgcolor="">INDIR</td>
                                  <td width="15%" bgcolor="">'.$StaffReportee_SC[$i]['roleCode'].'</td>
                                  <td width="40%" bgcolor="#f5f5f5">'.$StaffReportee_SC[$i]['role_title_tl'].'</td>
                                </tr>
                                <tr>
                                  <td bgcolor="#e1e1e1" colspan="2"> </td>
                                  <td bgcolor="#e1e1e1"> </td>
                                  <td bgcolor="#f5f5f5"><strong>'.$StaffReportee_SC[$i]['name_code'].'</strong></td>
                                  <td colspan="" bgcolor="#f5f5f5">'.$StaffReportee_SC[$i]['abridged_name'].'</td>
                                </tr>
                              </table>';*/

                              $j++;
                            }
                            $html .= '</div><!-- col-md-6 -->
                          </div><!-- col-md-12 -->';
                 }

                $html .= '
                    </div><!-- orgChartSection -->
                    <hr style="margin-top: 5px;" />';


          if(!empty($staffData[1])) {
          $html .= '<div class="orgChartSection">
                      <h4 class="col-md-6 col-md-offset-3 text-center MatrixRoles">Org Chart Roles(s) <small>for Non-Classroom Roles</small> | Role 2</h4>
                        <?php /* ?><?php */ ?>
                      <div class="no-padding col-md-10 col-md-offset-1">
                            <div class="blackSolidBorder">&nbsp;</div>
                            <div class="graySolidBorder">&nbsp;</div>
                            <div class="grayDashedBorder">&nbsp;</div>
                          <div class="col-md-12 ">
                              <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>PRIMARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">'.$staff_2_PR_PR[0]['gp_id'].'</td>
                                        <td width="30%">'.$staff_2_PR_PR[0]['report_ok'].'</td>
                                        <td width="30%">1</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_2_PR_PR[0]['role_title_tl'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40">'.$staff_2_PR_PR[0]['gt_id'].'</td>
                                        <td colspan="2">'.$staff_2_PR_PR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_2_PR_PR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                  
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="secondLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>SECONDARY GRANDREPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">'.$staff_2_SR_PR[0]['gp_id'].'</td>
                                        <td width="30%">'.$staff_2_SR_PR[0]['report_ok'].'</td>
                                        <td width="30%">4</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_2_SR_PR[0]['role_title_tl'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40">'.$staff_2_SR_PR[0]['gt_id'].'</td>
                                        <td colspan="2">'.$staff_2_SR_PR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_2_SR_PR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                              <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>PRIMARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="#e5d998">'.$staff_2_PR[0]['gp_id'].'</td>
                                        <td width="30%" bgcolor="#ffff00">'.$staff_2_PR[0]['report_ok'].'</td>
                                        <td width="30%" bgcolor="#ffff00">2</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#e5d998">'.$staff_2_PR[0]['role_title_tl'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="#f4ecfd">'.$staff_2_PR[0]['gt_id'].'</td>
                                        <td colspan="2" bgcolor="#f4ecfd">'.$staff_2_PR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="#f4ecfd">'.$staff_2_PR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 text-center">
                                  <table width="100%" border="1" class="firstLevelReporting">
                                      <tr>
                                        <td colspan="3"><h5>SECONDARY REPORTOO</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40">'.$staff_2_SR[0]['gp_id'].'</td>
                                        <td width="30%">'.$staff_2_SR[0]['report_ok'].'</td>
                                        <td width="30%">5</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_2_SR[0]['role_title_tl'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40">'.$staff_2_SR[0]['gt_id'].'</td>
                                        <td colspan="2">'.$staff_2_SR[0]['name_code'].'</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30">'.$staff_2_SR[0]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                              <div class="col-md-6 col-md-offset-3 text-center" style="background:#e2e2e2;padding:15px;">
                                  <table width="100%" border="1" bgcolor="#fff" class="firstLevelReporting" style="background:#fff;" >
                                      <tr>
                                        <td colspan="3" bgcolor=""><h5>ROLE 2</h5></td>
                                      </tr>
                                      <tr>
                                        <td width="30%" height="40" bgcolor="">'.$staffData[1]['gp_id'].'</td>
                                        <td width="30%" bgcolor="">'.$staffData[1]['report_ok'].'</td>
                                        <td width="30%" bgcolor="">3</td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" height="30" bgcolor="">'.$staffData[1]['role_title_tl'].', '.$staffData[1]['role_title_bl'].'</td>
                                      </tr>
                                      <tr>
                                        <td height="40" bgcolor="">'.$staffData[1]['roleCode'].'</td>
                                        <td colspan="2" bgcolor="">'.$staffData[1]['abridged_name'].'</td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <div class="col-md-12 paddingTop50">
                              <div class="col-md-6 col-md-offset-3 text-center" style="background:none;padding:15px;">
                                  <table width="100%" border="1">
                                      <tr>
                                        <td colspan="2" width="33%" height="90">Fundamental<br />Primary<br /><h5>'.$totalPF2.'</h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Primary<br /><h5>'.$totalP2.'</h5></td>
                                        <td colspan="2" width="33%" height="90">Total<br />Reportee<br /><h5>'.($totalP2+count($StaffReportee2_SC)).'</h5></td>
                                      </tr>
                                      <tr>
                                        <td colspan="3" width="50%"  height="80">Total Staff<br />Members<br /><h5>'.$TotalStaffMembers2.'</h5></td>
                                        <td colspan="3" width="50%"  height="80">Total Student<br />Members<br /><h5>'.$TotalStudentMemebers2.'</h5></td>
                                      </tr>
                                    </table>
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                        </div><!-- col-md-12 -->
                        <hr class="smallHR" />';




              $j = 1;
              for($i=0; $i<=($totalPF2+count($StaffReportee2)); $i++) {
              $html .= '<div class="col-md-12 paddingLeft0 paddingRight0 paddingBottom20">
                          <div class="col-md-6">';

                      if(!empty($StaffReportee2[$i])) {
                      $html .= '<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                <tr>
                                  <td width="10%" bgcolor="#f5f5f5">'.($i+1).'</td>
                                  <td width="10%" bgcolor="#f5f5f5">'.$StaffReportee2[$i]['reporting_type'].'</td>
                                  <td width="40%" bgcolor="#f4ecfd"><strong>'.$StaffReportee2[$i]['abridged_name'].'</strong></td>
                                  <td width="20%" bgcolor="#ade4f2">'.$StaffReportee2[$i]['roleCode'].'</td>
                                  <td width="20%" bgcolor="#ade4f2"> '.$StaffReportee2[$i]['total_reportee'].' ('. $StaffReportee2[$i]['total_staff_members'] .') </td>
                                </tr>
                                <tr>
                                  <td bgcolor="#ffff00">'.$StaffReportee2[$i]['report_ok'].'</td>';

                                  if($StaffReportee2[$i]['reporting_type'] == 'INDIR'){
                                    $html .= '<td bgcolor="#ffff00">('.$StaffReportee2[$i]['name_code'].')</td>';
                                  }else{
                                    $html .= '<td bgcolor="#ffff00"></td>';
                                  }

                                  $html .= '<td bgcolor="#e5d998">'.$StaffReportee2[$i]['role_title_tl'].'</td>
                                  <td colspan="2" bgcolor="#e5d998">'.$StaffReportee2[$i]['gp_id'].'</td>
                                </tr>
                              </table>';
                      }



                  $html .= '</div><!-- col-md-6 -->
                            <div class="col-md-6">';
                            if(!empty($StaffReportee2_SC[$i])) {
                              $html .= '<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                <tr>
                                  <td width="10%" bgcolor="#f5f5f5">'.($totalPF2 + $j).'</td>
                                  <td width="10%" bgcolor="#f5f5f5">'.$StaffReportee2_SC[$i]['reporting_type'].'</td>
                                  <td width="40%" bgcolor="#f4ecfd"><strong>'.$StaffReportee2_SC[$i]['abridged_name'].'</strong></td>
                                  <td width="20%" bgcolor="#ade4f2">'.$StaffReportee2_SC[$i]['roleCode'].'</td>
                                  <td width="20%" bgcolor="#ade4f2"> '.$StaffReportee2_SC[$i]['total_reportee'].' ('. $StaffReportee2_SC[$i]['total_staff_members'] .') </td>
                                </tr>
                                <tr>
                                  <td bgcolor="#ffff00">'.$StaffReportee2_SC[$i]['report_ok'].'</td>
                                  <td bgcolor="#ffff00">('.$StaffReportee2_SC[$i]['name_code'].')</td>
                                  <td bgcolor="#e5d998">'.$StaffReportee2_SC[$i]['role_title_tl'].'</td>
                                  <td colspan="2" bgcolor="#e5d998">'.$StaffReportee2_SC[$i]['gp_id'].'</td>
                                </tr>
                              </table>';
                              /*$html .= '<table width="100%" border="1" class="text-center" style="height:70px;color:#000;">
                                <tr>
                                  <td width="15%" bgcolor="#f5f5f5">'.($totalPF2 + $j).'</td>
                                  <td width="15%" bgcolor="#f5f5f5">SC</td>
                                  <td width="15%" bgcolor="">INDIR</td>
                                  <td width="15%" bgcolor="">'.$StaffReportee2_SC[$i]['roleCode'].'</td>
                                  <td width="40%" bgcolor="#f5f5f5">'.$StaffReportee2_SC[$i]['role_title_tl'].'</td>
                                </tr>
                                <tr>
                                  <td bgcolor="#e1e1e1" colspan="2"> </td>
                                  <td bgcolor="#e1e1e1"> </td>
                                  <td bgcolor="#f5f5f5"><strong>'.$StaffReportee2_SC[$i]['name_code'].'</strong></td>
                                  <td colspan="" bgcolor="#f5f5f5">'.$StaffReportee2_SC[$i]['abridged_name'].'</td>
                                </tr>
                              </table>';*/

                              $j++;
                            }
                            $html .= '</div><!-- col-md-6 -->
                          </div><!-- col-md-12 -->';
              }


          $html .= '</div><!-- orgChartSection -->';
                  }
    $html .= '</div><!-- .RightInformation_contentSection -->
          </div><!-- RightInformation -->
      ';
    }


    echo $html;
  }




















  public function getTIFA()
  {
    //if(count($_POST)){

      $GTID = $this->input->get('GTID');



      $staff_2_SR = array();



      /* Declaring Role 1 Variables */
      /******************************/
      $staff_PR[0]['gt_id'] = '';
      $staff_PR[0]['name_code'] = '';
      $staff_PR[0]['abridged_name'] = '';
      $staff_PR[0]['c_topline'] = '';
      $staff_PR[0]['c_bottomline'] = '';
      $staff_PR[0]['gp_id'] = '';
      $staff_PR[0]['report_ok'] = '';
      $staff_PR[0]['reporting_line'] = '';
      $staff_PR[0]['role_title_tl'] = '';

      $staff_PR_PR[0]['gt_id'] = '';
      $staff_PR_PR[0]['name_code'] = '';
      $staff_PR_PR[0]['abridged_name'] = '';
      $staff_PR_PR[0]['c_topline'] = '';
      $staff_PR_PR[0]['c_bottomline'] = '';
      $staff_PR_PR[0]['gp_id'] = '';
      $staff_PR_PR[0]['report_ok'] = '';
      $staff_PR_PR[0]['reporting_line'] = '';
      $staff_PR_PR[0]['role_title_tl'] = '';

      $staff_SR[0]['gt_id'] = '';
      $staff_SR[0]['name_code'] = '';
      $staff_SR[0]['abridged_name'] = '';
      $staff_SR[0]['c_topline'] = '';
      $staff_SR[0]['c_bottomline'] = '';
      $staff_SR[0]['gp_id'] = '';
      $staff_SR[0]['report_ok'] = '';
      $staff_SR[0]['reporting_line'] = '';
      $staff_SR[0]['role_title_tl'] = '';

      $staff_SR_PR[0]['gt_id'] = '';
      $staff_SR_PR[0]['name_code'] = '';
      $staff_SR_PR[0]['abridged_name'] = '';
      $staff_SR_PR[0]['c_topline'] = '';
      $staff_SR_PR[0]['c_bottomline'] = '';
      $staff_SR_PR[0]['gp_id'] = '';
      $staff_SR_PR[0]['report_ok'] = '';
      $staff_SR_PR[0]['reporting_line'] = '';
      $staff_SR_PR[0]['role_title_tl'] = '';

      /* Declaring Role 2 Variables */
      /******************************/
      $staff_2_PR[0]['gt_id'] = '';
      $staff_2_PR[0]['name_code'] = '';
      $staff_2_PR[0]['abridged_name'] = '';
      $staff_2_PR[0]['c_topline'] = '';
      $staff_2_PR[0]['c_bottomline'] = '';
      $staff_2_PR[0]['gp_id'] = '';
      $staff_2_PR[0]['report_ok'] = '';
      $staff_2_PR[0]['reporting_line'] = '';
      $staff_2_PR[0]['role_title_tl'] = '';

      $staff_2_PR_PR[0]['gt_id'] = '';
      $staff_2_PR_PR[0]['name_code'] = '';
      $staff_2_PR_PR[0]['abridged_name'] = '';
      $staff_2_PR_PR[0]['c_topline'] = '';
      $staff_2_PR_PR[0]['c_bottomline'] = '';
      $staff_2_PR_PR[0]['gp_id'] = '';
      $staff_2_PR_PR[0]['report_ok'] = '';
      $staff_2_PR_PR[0]['reporting_line'] = '';
      $staff_2_PR_PR[0]['role_title_tl'] = '';


      $staff_2_SR_PR[0]['gt_id'] = '';
      $staff_2_SR_PR[0]['name_code'] = '';
      $staff_2_SR_PR[0]['abridged_name'] = '';
      $staff_2_SR_PR[0]['c_topline'] = '';
      $staff_2_SR_PR[0]['c_bottomline'] = '';
      $staff_2_SR_PR[0]['gp_id'] = '';
      $staff_2_SR_PR[0]['report_ok'] = '';
      $staff_2_SR_PR[0]['reporting_line'] = '';
      $staff_2_SR_PR[0]['role_title_tl'] = '';















      /* Load Model */
      $this->load->model('tif_model/tif_a_form_model');
      $staffData = $this->tif_a_form_model->get_StaffInfo($GTID);
      $StaffReportee = array();
      $StaffReportee_SC = array();
      $StaffReportee2 = array();
      $StaffReportee2_SC = array();
      $staffTTProfile = array();




      $staffTTProfile = $this->tif_a_form_model->getStaff_TTProfile($GTID);
      $Timing_Profile = '';
      $Timing_AvgWeekHrs = '';
      $Timing_StdIN = '';
      $Timing_StdOut = '';
      $Timing_FriOut = '';
      $Timing_SatHrs = '';
      $Timing_SatOffs = '';
      $Timing_SatWorking = '';
      $Timing_SatOff = '';
      $Timing_ExtOut = '';
      $Timing_ExtFrq = '';
      $Timing_JulCat = '';
      $Timing_FriOutF = '';
      $Timing_MonIn = '';
      $Timing_TueIn = '';
      $Timing_WedIn = '';
      $Timing_ThuIn = '';
      $Timing_FriIn = '';
      $Timing_SatIn = '';
      $Timing_SunIn = '';
      $Timing_MonOut = '';
      $Timing_TueOut = '';
      $Timing_WedOut = '';
      $Timing_ThuOut = '';
      $Timing_FriOut = '';
      $Timing_SatOut = '';
      $Timing_SunOut = '';
      if(!empty($staffTTProfile)){
        $Timing_Profile = $staffTTProfile[0]['time_profile'];
        $Timing_AvgWeekHrs = $staffTTProfile[0]['avg_week_hrs'];
        $Timing_StdIN = $staffTTProfile[0]['std_in'];
        $Timing_StdOut = $staffTTProfile[0]['std_out'];
        $Timing_FriOutF = $staffTTProfile[0]['fri_out'];
        $Timing_SatHrs = $staffTTProfile[0]['sat_hrs'];
        $Timing_SatOffs = $staffTTProfile[0]['sat_off'];
        $Timing_SatWorking = $staffTTProfile[0]['sat_working'];
        $Timing_SatOff = $staffTTProfile[0]['sat_off'];
        $Timing_ExtOut = $staffTTProfile[0]['ext_time'];
        $Timing_ExtFrq = $staffTTProfile[0]['ext_frequency'];
        $Timing_JulCat = $staffTTProfile[0]['ext_july'];

        if($staffTTProfile[0]['ty_name'] != 'Standard'){
          $Timing_MonIn = $staffTTProfile[0]['mon_in'];
          $Timing_TueIn = $staffTTProfile[0]['tue_in'];
          $Timing_WedIn = $staffTTProfile[0]['wed_in'];
          $Timing_ThuIn = $staffTTProfile[0]['thu_in'];
          $Timing_FriIn = $staffTTProfile[0]['fri_in'];
          $Timing_SatIn = $staffTTProfile[0]['sat_in'];
          $Timing_SunIn = $staffTTProfile[0]['sun_in'];
          $Timing_MonOut = $staffTTProfile[0]['mon_out'];
          $Timing_TueOut = $staffTTProfile[0]['tue_out'];
          $Timing_WedOut = $staffTTProfile[0]['wed_out'];
          $Timing_ThuOut = $staffTTProfile[0]['thu_out'];
          $Timing_FriOut = $staffTTProfile[0]['fri_out'];
          $Timing_SatOut = $staffTTProfile[0]['sat_out'];
          $Timing_SunOut = $staffTTProfile[0]['sun_out'];
        }
      }







      $StaffReportee_TRP = array();
      if(!empty($staffData[0]['role_id'])){
        $StaffReportee = $this->tif_a_form_model->get_StaffReporteeInfo($staffData[0]['role_id']);
        $StaffReportee_SC = $this->tif_a_form_model->get_StaffReporteeSCInfo($staffData[0]['role_id']);

        $i = 0;
        foreach ($StaffReportee as $rr) {
          if($StaffReportee[$i]['report_ok'] == 'TRP'){
            $StaffReportee_TRP = $this->tif_a_form_model->get_StaffReporteeInfo($StaffReportee[$i]['role_id'], 'INDIR', $StaffReportee[$i]['name_code']);
            foreach ($StaffReportee_TRP as $trp) {
              array_push($StaffReportee, $trp);
            }
          }
          $i++;
        }
      }


      $StaffReportee2 = array();
      if(!empty($staffData[1]['role_id'])){
        $StaffReportee2 = $this->tif_a_form_model->get_StaffReporteeInfo($staffData[1]['role_id']);
        $StaffReportee2_SC = $this->tif_a_form_model->get_StaffReporteeSCInfo($staffData[1]['role_id']);


        
        $i = 0;
        foreach ($StaffReportee2 as $rr) {
          if($StaffReportee2[$i]['report_ok'] == 'TRP'){
            $StaffReportee_TRP = $this->tif_a_form_model->get_StaffReporteeInfo($StaffReportee2[$i]['role_id'], 'INDIR', $StaffReportee2[$i]['name_code']);
            foreach ($StaffReportee_TRP as $trp) {
              array_push($StaffReportee2, $trp);
            }
          }
          $i++;
        }
      }
      $i = 0;


      if(!empty($staffData[0]['pm_report_to'])){
        $staff_PR = $this->tif_a_form_model->get_StaffReportingInfo_CLTRole($staffData[0]['pm_report_to'], $GTID);
      }else{
        $staff_PR = $this->tif_a_form_model->get_StaffMatrixRole_CLT_Reportoo($GTID);
        if(empty($staff_PR)){
          $staff_PR = $this->tif_a_form_model->get_StaffReportingInfo_SBJRole($GTID);
        }
        
        if(empty($staff_PR)){
          $staff_PR[0]['gt_id'] = '';
          $staff_PR[0]['name_code'] = '';
          $staff_PR[0]['abridged_name'] = '';
          $staff_PR[0]['c_topline'] = '';
          $staff_PR[0]['c_bottomline'] = '';
          $staff_PR[0]['gp_id'] = '';
          $staff_PR[0]['report_ok'] = '';
          $staff_PR[0]['reporting_line'] = '';
          $staff_PR[0]['role_title_tl'] = '';
        }
      }
      if(!empty($staffData[0]['sc_report_to'])){
        $staff_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[0]['sc_report_to']);
      }
      if(!empty($staff_PR[0]['pm_report_to'])){
        $staff_PR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_PR[0]['pm_report_to']);
      }
      if(!empty($staff_SR[0]['pm_report_to'])){
        $staff_SR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_SR[0]['pm_report_to']);
      }



      if(!empty($staffData[1]['pm_report_to'])){
        $staff_2_PR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[1]['pm_report_to']);
      }
      if(!empty($staffData[1]['sc_report_to'])){
        $staff_2_SR = $this->tif_a_form_model->get_StaffReportingInfo($staffData[1]['sc_report_to']);
      }
      if(!empty($staff_2_PR[0]['pm_report_to'])){
        $staff_2_PR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_2_PR[0]['pm_report_to']);
      }
      if(!empty($staff_2_SR[0]['pm_report_to'])){
        $staff_2_SR_PR = $this->tif_a_form_model->get_StaffReportingInfo($staff_2_SR[0]['pm_report_to']);
      }



      if(empty($staff_2_SR)){
        $staff_2_SR[0]['gt_id'] = '';
        $staff_2_SR[0]['name_code'] = '';
        $staff_2_SR[0]['abridged_name'] = '';
        $staff_2_SR[0]['c_topline'] = '';
        $staff_2_SR[0]['c_bottomline'] = '';
        $staff_2_SR[0]['gp_id'] = '';
        $staff_2_SR[0]['report_ok'] = '';
        $staff_2_SR[0]['reporting_line'] = '';
        $staff_2_SR[0]['role_title_tl'] = '';
      }



      $staffData_MatrixCLT = $this->tif_a_form_model->get_StaffMatrixRole_CLT($GTID);
      $staffData_MatrixSBJ = $this->tif_a_form_model->get_StaffMatrixRole_SBJ($GTID);



      $totalPF = 0;
      $totalP = 0;
      $totalSC = 0;
      $TotalStaffMembers = 0;
      $TotalStudentMemebers = 0;
      if(!empty($staffData)){
         $TotalStaffMembers = $staffData[0]['total_staff_members'];
      }
      foreach ($StaffReportee as $cal1) {
        if($cal1['reporting_type'] == 'FP'){
          $totalPF++;
        }
        $totalP++;
      }




      $totalPF2 = 0;
      $totalP2 = 0;
      $totalSC2 = 0;
      $TotalStaffMembers2 = 0;
      $TotalStudentMemebers2 = 0;
      if(!empty($staffData[1])){
         $TotalStaffMembers2 = $staffData[1]['total_staff_members'];
      }
      foreach ($StaffReportee2 as $cal2) {
        if($cal2['reporting_type'] == 'FP'){
          $totalPF2++;
        }
        $totalP2++;
      }

      

      $reporteesFundamental = $totalPF + $totalPF2;
      $reportteesSecondary = $totalSC + $totalSC2;
      $reporteesPrimary = $totalP + $totalP2;
      $reporteesTotal = $totalP+count($StaffReportee_SC)+$totalP2+count($StaffReportee2_SC);
      $membersTotal = $TotalStaffMembers + $TotalStaffMembers2;
      $classRole = '-';
      $roleTeachingTotal = 0;
      $roleTeachingBlocks = 0;
      $roleTeachingStudents = 0;
      $uniqueStudentsTotal = $this->tif_a_form_model->getUniqueStudents($GTID);
      $studentBlocksTotal = 0;
      if(!empty($staffData_MatrixCLT)){
        $classRole = $staffData_MatrixCLT[0]['gp_id'];
        $roleTeachingStudents += $staffData_MatrixCLT[0]['students'];
      }
      if(!empty($staffData_MatrixSBJ)){
        foreach ($staffData_MatrixSBJ as $data) {
          $roleTeachingTotal++;
          $roleTeachingBlocks += $data['block'];
          $roleTeachingStudents += $data['students'];
        }
      }







      /* Local Variables */
      $this->data['photo_file'] = '.png';
      $this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
      $ImageName = base_url() . $this->data['staff_150_photo_path'] . $staffData[0]['photo_id'] . $this->data['photo_file'];
      $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
      $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
      $ImageFound = "Yes";

      if (!file_exists($this->data['staff_150_photo_path'] . $staffData[0]['photo_id'] . $this->data['photo_file'])) {
        if($staffData[0]['gender'] == 'M'){
            $ImageName = $ImageMale;
        }else if($staffData[0]['gender'] == 'F'){
            $ImageName = $ImageFemale;
        }

        $ImageFound = "No";
      }






      // Overall Font Size
      $font_size = 10;
      $font_name = 'Helvetica';
      $gender_mark_size = 26;
      $now_date = date('d-M-Y');

      require_once('components/pdf/fpdf/fpdf.php');
      require_once('components/pdf/fpdi/fpdi.php');

      
      // initiate FPDI
      $pdf = new FPDI();

      // get the page count
      $pageCount = $pdf->setSourceFile('components/pdf/hcm/TIFA.pdf');
      // iterate through all pages
      for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
          // import a page
          $templateId = $pdf->importPage($pageNo);
          // get the size of the imported page
          $size = $pdf->getTemplateSize($templateId);

          // create a page (landscape or portrait depending on the imported page size)
          if ($size['w'] > $size['h']) {
              $pdf->AddPage('L', array($size['w'], $size['h']));
          } else {
              $pdf->AddPage('P', array($size['w'], $size['h']));
          }       

          // use the imported page
          $pdf->useTemplate($templateId);

          if ($templateId == 1){

            // Setting NameCode
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 70);
            $pdf->SetXY(49, 27);
            $pdf->Cell(85, 93, $staffData[0]['name_code'], 1, 0, 'C', 0);


            // Staff Pic Path
            $pdf->Image($ImageName, 351, 28, 90, 0,'PNG');

            
            // Setting GTID
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 30);
            $pdf->SetXY(540, 45);
            $pdf->Cell(90, 20, $GTID, 0, 0, 'L', 0);

            // Setting GUID
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 30);
            $pdf->SetXY(540, 63);
            $pdf->Cell(90, 20, $staffData[0]['gg_id'], 0, 0, 'L', 0);

            // Setting DOJ
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 30);
            $pdf->SetXY(540, 83);
            $pdf->Cell(90, 20, date_format(date_create($staffData[0]['doj']), "d-M-Y"), 0, 0, 'L', 0);



            if(!empty($staff_PR)){
              // Reportoo Name Code
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 40);
              $pdf->SetXY(120, 159);
              $pdf->Cell(43, 35, $staff_PR[0]['name_code'], 0, 0, 'C', 0);

              // Reportoo Abridged Name
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 25);
              $pdf->SetXY(163, 159);
              $pdf->Cell(101, 35, $staff_PR[0]['abridged_name'], 0, 0, 'C', 0);

              // Reportoo Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(120, 215);
              $pdf->Cell(144, 18, $staff_PR[0]['c_topline'], 0, 0, 'C', 0);

              // Reportoo Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(120, 232);
              $pdf->Cell(144, 18, $staff_PR[0]['c_bottomline'], 0, 0, 'C', 0);
            }



            // Staff Name Code
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 40);
            $pdf->SetXY(310, 159);
            $pdf->Cell(43, 35, $staffData[0]['name_code'], 0, 0, 'C', 0);

            // Staff Abridged Name
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 25);
            $pdf->SetXY(353, 159);
            $pdf->Cell(101, 35, $staffData[0]['abridged_name'], 0, 0, 'C', 0);

            // Staff Top Line
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(310, 215);
            $pdf->Cell(144, 18, $staffData[0]['c_topline'], 0, 0, 'C', 0);

            // Staff Top Line
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(310, 232);
            $pdf->Cell(144, 18, $staffData[0]['c_bottomline'], 0, 0, 'C', 0);

            // Staff Summary - Fundamental Reportees
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(612, 158);
            $pdf->Cell(43, 18, $reporteesFundamental, 0, 0, 'C', 0);

            // Staff Summary - Primary Reportees
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(612, 177);
            $pdf->Cell(43, 18, $reporteesPrimary, 0, 0, 'C', 0);

            // Staff Summary - Total Reportees
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(612, 195);
            $pdf->Cell(43, 18, $reporteesTotal, 0, 0, 'C', 0);

            // Staff Summary - Total Members
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(612, 214);
            $pdf->Cell(43, 18, $membersTotal, 0, 0, 'C', 0);



            // Staff Summary - Class Role
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(785, 158);
            $pdf->Cell(43, 18, $classRole, 0, 0, 'C', 0);

            // Staff Summary - Total Teaching Roles
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(785, 176);
            $pdf->Cell(43, 18, $roleTeachingTotal, 0, 0, 'C', 0);

            // Staff Summary - Total Teaching Blocks
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(785, 195);
            $pdf->Cell(43, 18, $roleTeachingBlocks, 0, 0, 'C', 0);

            // Staff Summary - Total Teaching Students
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(785, 214);
            $pdf->Cell(43, 18, $roleTeachingBlocks, 0, 0, 'C', 0);

            // Staff Summary - Total Unique Students
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(785, 232);
            $pdf->Cell(43, 18, $uniqueStudentsTotal, 0, 0, 'C', 0);

            // Staff Summary - Total Students Blocks
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(785, 251);
            $pdf->Cell(43, 18, $studentBlocksTotal, 0, 0, 'C', 0);









            // Timings - Timing Profile
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 28);
            $pdf->SetXY(178, 361);
            $pdf->Cell(115, 18, $Timing_Profile, 0, 0, 'C', 0);

            // Timings - Avg Weekly Hours
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 28);
            $pdf->SetXY(178, 435);
            $pdf->Cell(115, 18, $Timing_AvgWeekHrs, 0, 0, 'C', 0);

            // Timings - Full Time IN
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(420, 345);
            $pdf->Cell(42, 18, $Timing_StdIN, 0, 0, 'R', 0);

            // Timings - Full Time OUT
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(420, 364);
            $pdf->Cell(42, 18, $Timing_StdOut, 0, 0, 'R', 0);

            // Timings - Friday Time OUT
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(420, 420);
            $pdf->Cell(42, 18, $Timing_FriOutF, 0, 0, 'R', 0);

            // Timings - Std Hrs
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(420, 438);
            $pdf->Cell(42, 18, $Timing_SatHrs, 0, 0, 'R', 0);










            // Timings - Secondary - Sat Working
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(593, 346);
            $pdf->Cell(42, 18, $Timing_SatWorking, 0, 0, 'R', 0);

            // Timings - Secondary - Sat Off
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(593, 363);
            $pdf->Cell(42, 18, $Timing_SatOff, 0, 0, 'R', 0);

            // Timings - Secondary - Ext Out
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(593, 400);
            $pdf->Cell(42, 18, $Timing_ExtOut, 0, 0, 'R', 0);

            // Timings - Secondary - Ext Freq
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 22);
            $pdf->SetXY(593, 419);
            $pdf->Cell(42, 18, $Timing_ExtFrq, 0, 0, 'R', 0);

            // Timings - Secondary - Ext Freq
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 18);
            $pdf->SetXY(593, 439);
            $pdf->Cell(42, 18, date_format(date_create($Timing_JulCat), "d-M-Y"), 0, 0, 'R', 0);






            // Timings - Custom Timings - Mon
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(742, 347);
            $pdf->Cell(28, 16, $Timing_MonIn, 0, 0, 'C', 0);
            // Timings - Custom Timings - Tue
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(742, 365);
            $pdf->Cell(28, 16, $Timing_TueIn, 0, 0, 'C', 0);
            // Timings - Custom Timings - Wed
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(742, 383);
            $pdf->Cell(28, 16, $Timing_WedIn, 0, 0, 'C', 0);
            // Timings - Custom Timings - Thu
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(742, 402);
            $pdf->Cell(28, 16, $Timing_ThuIn, 0, 0, 'C', 0);
            // Timings - Custom Timings - Fri
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(742, 421);
            $pdf->Cell(28, 16, $Timing_FriIn, 0, 0, 'C', 0);
            // Timings - Custom Timings - Sat
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(742, 440);
            $pdf->Cell(28, 16, $Timing_SatIn, 0, 0, 'C', 0);

            // Timings - Custom Timings - Mon
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(785, 347);
            $pdf->Cell(28, 16, $Timing_MonOut, 0, 0, 'C', 0);
            // Timings - Custom Timings - Tue
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(785, 365);
            $pdf->Cell(28, 16, $Timing_TueOut, 0, 0, 'C', 0);
            // Timings - Custom Timings - Wed
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(785, 383);
            $pdf->Cell(28, 16, $Timing_WedOut, 0, 0, 'C', 0);
            // Timings - Custom Timings - Thu
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(785, 402);
            $pdf->Cell(28, 16, $Timing_ThuOut, 0, 0, 'C', 0);
            // Timings - Custom Timings - Fri
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(785, 421);
            $pdf->Cell(28, 16, $Timing_FriOut, 0, 0, 'C', 0);
            // Timings - Custom Timings - Sat
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 16);
            $pdf->SetXY(785, 440);
            $pdf->Cell(28, 16, $Timing_SatOut, 0, 0, 'C', 0);


            // Staff - Name Code
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 36);
            $pdf->SetXY(48, 595);
            $pdf->Cell(58, 30, $staffData[0]['name_code'], 0, 0, 'C', 0);

            // Staff - Abridged Name
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 36);
            $pdf->SetXY(106, 595);
            $pdf->Cell(158, 30, $staffData[0]['abridged_name'], 0, 0, 'C', 0);




            /* change here */
            $ij=0;
            if(!empty($staffData_MatrixCLT)){
              $ij=1;
              $x = -20;

              if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixCLT[0]['name_code'] == $staff_PR[0]['name_code']){
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(91, 110, 245);
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'B', 30);
                $pdf->SetXY(290+$x, 650);
                $pdf->Cell(23, 25, 'FR', 1, 0, 'C', 1);
              }else{
                $pdf->SetTextColor(255, 255, 255);
                $pdf->SetFillColor(91, 110, 245);
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'B', 30);
                $pdf->SetXY(290+$x, 650);
                $pdf->Cell(23, 25, '', 1, 0, 'C', 0);
              }
              

              $pdf->SetTextColor(0,0,0);
              $pdf->SetFillColor(91, 110, 245);
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(313+$x, 650);
              $pdf->Cell(46, 25, $staffData_MatrixCLT[0]['clt_type'], 1, 0, 'C', 0);

              $pdf->SetTextColor(0,0,0);
              $pdf->SetFillColor(91, 110, 245);
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(359+$x, 650);
              $pdf->Cell(46, 25, $staffData_MatrixCLT[0]['class'], 1, 0, 'C', 0);

              $pdf->SetTextColor(0,0,0);
              $pdf->SetFillColor(91, 110, 245);
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(405+$x, 650);
              $pdf->Cell(92, 25, $staffData_MatrixCLT[0]['gp_id'], 1, 0, 'C', 0);

              $pdf->SetTextColor(0,0,0);
              $pdf->SetFillColor(91, 110, 245);
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(497+$x, 650);
              $pdf->Cell(23, 25, $staffData_MatrixCLT[0]['students'], 1, 0, 'C', 0);

              $pdf->SetTextColor(0,0,0);
              $pdf->SetFillColor(91, 110, 245);
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(520+$x, 650);
              $pdf->Cell(92, 25, '', 1, 0, 'C', 0);
              $pdf->SetXY(520+$x, 650);
              $pdf->Cell(92, 12, $staffData_MatrixCLT[0]['role_title_tl'], 0, 0, 'C', 0);
              $pdf->SetXY(520+$x, 662);
              $pdf->Cell(92, 13, $staffData_MatrixCLT[0]['abridged_name'], 0, 0, 'C', 0);

              $pdf->SetTextColor(0,0,0);
              $pdf->SetFillColor(91, 110, 245);
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(612+$x, 650);
              $pdf->Cell(46, 25, $staffData_MatrixCLT[0]['name_code'], 1, 0, 'C', 0);
            }





            $foundFR = false;
            if(!empty($staffData_MatrixSBJ)){
              $x = 0;

              for($i=0; $i<=11; $i++){
                $sno = $i+1+$ij;
                $y = 40*$i;

                if(!empty($staffData_MatrixSBJ[$i])){
                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(106+$x, 700+$y);
                  $pdf->Cell(23, 25, $sno, 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(129+$x, 700+$y);
                  $pdf->Cell(92, 25, $staffData_MatrixSBJ[$i]['gp_id'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(221+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['students'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(244+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['block'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(267+$x, 700+$y);
                  $pdf->Cell(92, 25, '', 1, 0, 'C', 0);
                  $pdf->SetXY(267+$x, 700+$y);
                  $pdf->Cell(92, 12, $staffData_MatrixSBJ[$i]['role_title_tl'], 0, 0, 'C', 0);
                  $pdf->SetXY(267+$x, 712+$y);
                  $pdf->Cell(92, 13, $staffData_MatrixSBJ[$i]['abridged_name'], 0, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(359+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['name_code'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(382+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['reporting_line'], 1, 0, 'C', 0);


                  if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixSBJ[$i]['name_code'] == $staff_PR[0]['name_code'] && !$foundFR){
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->SetFillColor(91, 110, 245);
                    $pdf->SetFont($font_name);
                    $pdf->SetFont($font_name,'B', 22);
                    $pdf->SetXY(405+$x, 700+$y);
                    $pdf->Cell(23, 25, 'FR', 1, 0, 'C', 1);

                    $foundFR = true;
                  }
                }
              }



              $x = 362;
              for($i=12; $i<=23; $i++){
                $sno = $i+1+$ij;
                $y = 40*($i-12);

                if(!empty($staffData_MatrixSBJ[$i])){
                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(106+$x, 700+$y);
                  $pdf->Cell(23, 25, $sno, 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(129+$x, 700+$y);
                  $pdf->Cell(92, 25, $staffData_MatrixSBJ[$i]['gp_id'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(221+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['students'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(244+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['block'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(267+$x, 700+$y);
                  $pdf->Cell(92, 25, '', 1, 0, 'C', 0);
                  $pdf->SetXY(267+$x, 700+$y);
                  $pdf->Cell(92, 12, $staffData_MatrixSBJ[$i]['role_title_tl'], 0, 0, 'C', 0);
                  $pdf->SetXY(267+$x, 712+$y);
                  $pdf->Cell(92, 13, $staffData_MatrixSBJ[$i]['abridged_name'], 0, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(359+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['name_code'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(382+$x, 700+$y);
                  $pdf->Cell(23, 25, $staffData_MatrixSBJ[$i]['reporting_line'], 1, 0, 'C', 0);

                  if(!empty($staff_PR[0]['junkRole']) && $staffData_MatrixSBJ[$i]['name_code'] == $staff_PR[0]['name_code'] && !$foundFR){
                    $pdf->SetTextColor(255, 255, 255);
                    $pdf->SetFillColor(91, 110, 245);
                    $pdf->SetFont($font_name);
                    $pdf->SetFont($font_name,'B', 22);
                    $pdf->SetXY(405+$x, 700+$y);
                    $pdf->Cell(23, 25, 'FR', 1, 0, 'C', 1);

                    $foundFR = true;
                  }
                }
              }
            }




            
          }
















          if(!empty($staff_PR[0]['junkRole'])){
            $staff_PR[0]['gt_id'] = '';
            $staff_PR[0]['name_code'] = '';
            $staff_PR[0]['abridged_name'] = '';
            $staff_PR[0]['c_topline'] = '';
            $staff_PR[0]['c_bottomline'] = '';
            $staff_PR[0]['gp_id'] = '';
            $staff_PR[0]['report_ok'] = '';
            $staff_PR[0]['reporting_line'] = '';
            $staff_PR[0]['role_title_tl'] = '';
          }

          if ($templateId == 2){
            /********** ********** Org Chart Role - 1 ********** **********/
            // Staff - Name Code
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 36);
            $pdf->SetXY(48, 28);
            $pdf->Cell(88, 35, $staffData[0]['name_code'], 0, 0, 'C', 0);

            // Staff - Abridged Name
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 36);
            $pdf->SetXY(136, 28);
            $pdf->Cell(214, 35, $staffData[0]['abridged_name'], 0, 0, 'C', 0);

            if(!empty($staff_PR_PR)){
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 76);
              $pdf->Cell(57, 27, $staff_PR_PR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 76);
              $pdf->Cell(29, 27, $staff_PR_PR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149, 76);
              $pdf->Cell(29, 27, '1', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 103);
              $pdf->Cell(115, 14, $staff_PR_PR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 117);
              $pdf->Cell(58, 26, $staff_PR_PR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 117);
              $pdf->Cell(58, 26, $staff_PR_PR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 143);
              $pdf->Cell(115, 14, $staff_PR_PR[0]['abridged_name'], 0, 0, 'C', 0);
            }



            if(!empty($staff_SR_PR)){
              $x = 187;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 76);
              $pdf->Cell(57, 27, $staff_SR_PR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 76);
              $pdf->Cell(29, 27, $staff_SR_PR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149+$x, 76);
              $pdf->Cell(29, 27, '4', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 103);
              $pdf->Cell(115, 14, $staff_SR_PR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 117);
              $pdf->Cell(58, 26, $staff_SR_PR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 117);
              $pdf->Cell(58, 26, $staff_SR_PR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 143);
              $pdf->Cell(115, 14, $staff_SR_PR[0]['abridged_name'], 0, 0, 'C', 0);
            }
          


            if(!empty($staff_PR)){
              $y = 122;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 76+$y);
              $pdf->Cell(57, 27, $staff_PR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 76+$y);
              $pdf->Cell(29, 27, $staff_PR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149, 76+$y);
              $pdf->Cell(29, 27, '2', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 103+$y);
              $pdf->Cell(115, 14, $staff_PR[0]['c_topline'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 117+$y);
              $pdf->Cell(58, 26, $staff_PR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 117+$y);
              $pdf->Cell(58, 26, $staff_PR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 143+$y);
              $pdf->Cell(115, 14, $staff_PR[0]['abridged_name'], 0, 0, 'C', 0);
            }





            if(!empty($staff_SR)){
              $x = 187;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 76+$y);
              $pdf->Cell(57, 27, $staff_SR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 76+$y);
              $pdf->Cell(29, 27, $staff_SR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149+$x, 76+$y);
              $pdf->Cell(29, 27, '5', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 103+$y);
              $pdf->Cell(115, 14, $staff_SR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 117+$y);
              $pdf->Cell(58, 26, $staff_SR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 117+$y);
              $pdf->Cell(58, 26, $staff_SR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 143+$y);
              $pdf->Cell(115, 14, $staff_SR[0]['abridged_name'], 0, 0, 'C', 0);
            }







            if(!empty($staffData)){
              $x = 86;
              $y = 257;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 76+$y);
              $pdf->Cell(72, 27, $staffData[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(135+$x, 76+$y);
              $pdf->Cell(44, 27, $staffData[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(178+$x, 76+$y);
              $pdf->Cell(29, 27, '3', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(63+$x, 103+$y);
              $pdf->Cell(144, 27, $staffData[0]['c_topline'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 131+$y);
              $pdf->Cell(58, 27, $staffData[0]['role_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(121+$x, 130+$y);
              $pdf->Cell(86, 27, $staffData[0]['name_code'], 0, 0, 'C', 0);
            }


            $x = 20;
            $y = 366;
            // Staff - Reporting Summary
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 20);
            $pdf->SetXY(100+$x, 130+$y);
            $pdf->Cell(58, 27, $totalPF, 0, 0, 'C', 0);
            
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 20);
            $pdf->SetXY(158+$x, 130+$y);
            $pdf->Cell(57, 27, $totalP, 0, 0, 'C', 0);

            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 20);
            $pdf->SetXY(215+$x, 130+$y);
            $pdf->Cell(58, 27, ($totalP+count($StaffReportee_SC)), 0, 0, 'C', 0);
            
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 20);
            $pdf->SetXY(149+$x, 157+$y);
            $pdf->Cell(23, 27, $TotalStaffMembers, 0, 0, 'C', 0);
            
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 20);
            $pdf->SetXY(250+$x, 157+$y);
            $pdf->Cell(23, 27, $TotalStudentMemebers, 0, 0, 'C', 0);


            







            /********** ********** Org Chart Role - 2 ********** **********/
            // Staff - Name Code
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 36);
            $pdf->SetXY(48, 578);
            $pdf->Cell(88, 30, $staffData[0]['name_code'], 0, 0, 'C', 0);

            // Staff - Abridged Name
            $pdf->SetFont($font_name);
            $pdf->SetFont($font_name,'', 36);
            $pdf->SetXY(136, 578);
            $pdf->Cell(214, 30, $staffData[0]['abridged_name'], 0, 0, 'C', 0);


            $yy = 546;
            if(!empty($staff_2_PR_PR)){
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 76+$yy);
              $pdf->Cell(57, 27, $staff_2_PR_PR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 76+$yy);
              $pdf->Cell(29, 27, $staff_2_PR_PR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149, 76+$yy);
              $pdf->Cell(29, 27, '1', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 103+$yy);
              $pdf->Cell(115, 14, $staff_2_PR_PR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 117+$yy);
              $pdf->Cell(58, 26, $staff_2_PR_PR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 117+$yy);
              $pdf->Cell(58, 26, $staff_2_PR_PR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 143+$yy);
              $pdf->Cell(115, 14, $staff_2_PR_PR[0]['abridged_name'], 0, 0, 'C', 0);
            }



            if(!empty($staff_2_SR_PR)){
              $x = 187;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 76+$yy);
              $pdf->Cell(57, 27, $staff_2_SR_PR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 76+$yy);
              $pdf->Cell(29, 27, $staff_2_SR_PR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149+$x, 76+$yy);
              $pdf->Cell(29, 27, '4', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 103+$yy);
              $pdf->Cell(115, 14, $staff_2_SR_PR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 117+$yy);
              $pdf->Cell(58, 26, $staff_2_SR_PR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 117+$yy);
              $pdf->Cell(58, 26, $staff_2_SR_PR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 143+$yy);
              $pdf->Cell(115, 14, $staff_2_SR_PR[0]['abridged_name'], 0, 0, 'C', 0);
            }
            


            if(!empty($staff_2_PR)){
              $y = 122;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 76+$y+$yy);
              $pdf->Cell(57, 27, $staff_2_PR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 76+$y+$yy);
              $pdf->Cell(29, 27, $staff_2_PR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149, 76+$y+$yy);
              $pdf->Cell(29, 27, '2', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 103+$y+$yy);
              $pdf->Cell(115, 14, $staff_2_PR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 117+$y+$yy);
              $pdf->Cell(58, 26, $staff_2_PR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120, 117+$y+$yy);
              $pdf->Cell(58, 26, $staff_2_PR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63, 143+$y+$yy);
              $pdf->Cell(115, 14, $staff_2_PR[0]['abridged_name'], 0, 0, 'C', 0);
            }





            if(!empty($staff_2_SR)){
              $x = 187;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 76+$y+$yy);
              $pdf->Cell(57, 27, $staff_2_SR[0]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 76+$y+$yy);
              $pdf->Cell(29, 27, $staff_2_SR[0]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149+$x, 76+$y+$yy);
              $pdf->Cell(29, 27, '5', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 103+$y+$yy);
              $pdf->Cell(115, 14, $staff_2_SR[0]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 117+$y+$yy);
              $pdf->Cell(58, 26, $staff_2_SR[0]['gt_id'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(120+$x, 117+$y+$yy);
              $pdf->Cell(58, 26, $staff_2_SR[0]['name_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 143+$y+$yy);
              $pdf->Cell(115, 14, $staff_2_SR[0]['abridged_name'], 0, 0, 'C', 0);
            }







            if(!empty($staffData[1])){
              $x = 86;
              $y = 257;
              // Staff - PR PR - GPID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 76+$y+$yy);
              $pdf->Cell(72, 27, $staffData[1]['gp_id'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportOK
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(135+$x, 76+$y+$yy);
              $pdf->Cell(44, 27, $staffData[1]['report_ok'], 0, 0, 'C', 0);

              // Staff - PR PR - ReportingLine
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(178+$x, 76+$y+$yy);
              $pdf->Cell(29, 27, '3', 0, 0, 'C', 0);

              // Staff - PR PR - Role Top Line
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 22);
              $pdf->SetXY(63+$x, 103+$y+$yy);
              $pdf->Cell(144, 27, $staffData[1]['role_title_tl'], 0, 0, 'C', 0);

              // Staff - PR PR - GTID
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(63+$x, 130+$y+$yy);
              $pdf->Cell(29, 27, $staffData[1]['role_code'], 0, 0, 'C', 0);

              // Staff - PR PR - NameCode
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(92+$x, 130+$y+$yy);
              $pdf->Cell(115, 27, $staffData[1]['abridged_name'], 0, 0, 'C', 0);



              $x = 20;
              $y = 366;
              // Staff - Reporting Summary
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(100+$x, 130+$y+$yy);
              $pdf->Cell(58, 27, $totalPF2, 0, 0, 'C', 0);
              
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(158+$x, 130+$y+$yy);
              $pdf->Cell(57, 27, $totalP2, 0, 0, 'C', 0);

              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(215+$x, 130+$y+$yy);
              $pdf->Cell(58, 27, $totalSC2, 0, 0, 'C', 0);
              
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(149+$x, 157+$y+$yy);
              $pdf->Cell(23, 27, $TotalStaffMembers2, 0, 0, 'C', 0);
              
              $pdf->SetFont($font_name);
              $pdf->SetFont($font_name,'', 20);
              $pdf->SetXY(250+$x, 157+$y+$yy);
              $pdf->Cell(23, 27, $TotalStudentMemebers2, 0, 0, 'C', 0);
            }







            /********** Reportee **********/
            $x = -10;
            if(!empty($StaffReportee)){
              $arr = 0;

              for($i=0; $i<=11; $i++){
                $y = (40.6*$i);

                if(!empty($StaffReportee[$arr])){
                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(390+$x, 76+$y);
                  $pdf->Cell(23, 13, $StaffReportee[$arr]['reporting_line'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(413+$x, 76+$y);
                  $pdf->Cell(23, 13, $StaffReportee[$arr]['reporting_type'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(436+$x, 76+$y);
                  $pdf->Cell(92, 13, $StaffReportee[$arr]['abridged_name'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(528+$x, 76+$y);
                  $pdf->Cell(33, 13, $StaffReportee[$arr]['roleCode'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(561+$x, 76+$y);
                  $pdf->Cell(33, 13, $StaffReportee[$arr]['total_reportee'] . '(' . $StaffReportee[$arr]['total_staff_members'] . ')', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(390+$x, 89+$y);
                  $pdf->Cell(46, 13, $StaffReportee[$arr]['gp_id'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(436+$x, 89+$y);
                  $pdf->Cell(92, 13, $StaffReportee[$arr]['c_topline'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(528+$x, 89+$y);
                  $pdf->Cell(66, 13, '', 1, 0, 'C', 0);
                }
                $arr++;
              }
            }


            $x = 208;
            if(!empty($StaffReportee_SC)){
              $arr = 0;

              for($i=0; $i<=11; $i++){
                $y = (40.6*$i);

                if(!empty($StaffReportee_SC[$arr])){
                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(390+$x, 76+$y);
                  $pdf->Cell(23, 13, $StaffReportee_SC[$arr]['reporting_line'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(413+$x, 76+$y);
                  $pdf->Cell(23, 13, 'P', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(436+$x, 76+$y);
                  $pdf->Cell(36, 13, 'INDIR', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(472+$x, 76+$y);
                  $pdf->Cell(36, 13, '', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 18);
                  $pdf->SetXY(508+$x, 76+$y);
                  $pdf->Cell(92, 26, '', 1, 0, 'C', 0);
                  $pdf->SetXY(508+$x, 76+$y);
                  $pdf->Cell(92, 13, $StaffReportee_SC[$arr]['role_title_tl'], 0, 0, 'C', 0);

                  

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(390+$x, 89+$y);
                  $pdf->Cell(82, 13, $StaffReportee_SC[$arr]['gp_id'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(472+$x, 89+$y);
                  $pdf->Cell(36, 13, $StaffReportee_SC[$arr]['name_code'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(508+$x, 89+$y);
                  $pdf->Cell(92, 13, $StaffReportee_SC[$arr]['abridged_name'], 0, 0, 'C', 0);
                }
                $arr++;
              }
            }






























            $x = -10;
            if(!empty($StaffReportee2)){
              $arr = 0;
              $yy = 546;

              for($i=0; $i<=11; $i++){
                $y = (40.6*$i);

                if(!empty($StaffReportee2[$arr])){
                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(390+$x, 76+$y+$yy);
                  $pdf->Cell(23, 13, $StaffReportee2[$arr]['reporting_line'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(413+$x, 76+$y+$yy);
                  $pdf->Cell(23, 13, $StaffReportee2[$arr]['reporting_type'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(436+$x, 76+$y+$yy);
                  $pdf->Cell(92, 13, $StaffReportee2[$arr]['abridged_name'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(528+$x, 76+$y+$yy);
                  $pdf->Cell(33, 13, $StaffReportee2[$arr]['roleCode'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(561+$x, 76+$y+$yy);
                  $pdf->Cell(33, 13, $StaffReportee2[$arr]['total_reportee'] . '(' . $StaffReportee2[$arr]['total_staff_members'] . ')', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(390+$x, 89+$y+$yy);
                  $pdf->Cell(46, 13, $StaffReportee2[$arr]['gp_id'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(436+$x, 89+$y+$yy);
                  $pdf->Cell(92, 13, $StaffReportee2[$arr]['role_title_tl'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(528+$x, 89+$y+$yy);
                  $pdf->Cell(66, 13, '', 1, 0, 'C', 0);
                }
                $arr++;
              }
            }


            $x = 208;
            if(!empty($StaffReportee2_SC)){
              $arr = 0;
              $yy = 546;

              for($i=0; $i<=11; $i++){
                $y = (40.6*$i);

                if(!empty($StaffReportee2_SC[$arr])){
                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(390+$x, 76+$y+$yy);
                  $pdf->Cell(23, 13, $StaffReportee2_SC[$arr]['reporting_line'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(413+$x, 76+$y+$yy);
                  $pdf->Cell(23, 13, 'P', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(436+$x, 76+$y+$yy);
                  $pdf->Cell(36, 13, 'INDIR', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(472+$x, 76+$y+$yy);
                  $pdf->Cell(36, 13, '', 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 18);
                  $pdf->SetXY(508+$x, 76+$y+$yy);
                  $pdf->Cell(92, 26, '', 1, 0, 'C', 0);
                  $pdf->SetXY(508+$x, 76+$y+$yy);
                  $pdf->Cell(92, 13, $StaffReportee2_SC[$arr]['role_title_tl'], 0, 0, 'C', 0);

                  

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(390+$x, 89+$y+$yy);
                  $pdf->Cell(82, 13, $StaffReportee2_SC[$arr]['gp_id'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 20);
                  $pdf->SetXY(472+$x, 89+$y+$yy);
                  $pdf->Cell(36, 13, $StaffReportee2_SC[$arr]['name_code'], 1, 0, 'C', 0);

                  $pdf->SetTextColor(0,0,0);
                  $pdf->SetFillColor(91, 110, 245);
                  $pdf->SetFont($font_name,'', 22);
                  $pdf->SetXY(508+$x, 89+$y+$yy);
                  $pdf->Cell(92, 13, $StaffReportee2_SC[$arr]['abridged_name'], 0, 0, 'C', 0);
                }
                $arr++;
              }
            }




           
          }
        }




      

      // Output the new PDF
      $pdf->Output($GTID . '_tifA' . '.pdf', 'I');
      //$pdf->Output();
  }













  public function updateMatrixFR(){
    if(count($_POST)){
      $GTID = $this->input->post('GTID');
      $StaffID = $this->input->post('StaffID');

      $this->load->model('tif_model/tif_a_form_model');
      $staffData = $this->tif_a_form_model->get_StaffInfo($GTID);

      $this->tif_a_form_model->updateForced_FR($staffData[0]['staff_id'], $StaffID);
    }
  }
}