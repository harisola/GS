<style>
.bBottomD td {
  border-bottom:1px solid #888 !important;  
}
td {
    vertical-align: middle !important;
}
.orgChartSection table,
.TimingSectionTable {
  text-align:center;  
}
.reportingPersonal .PrimaryName,
.primaryReporting .PrimaryName {
  font-size:12px; 
}
</style>
<?php

class Master_staff extends CI_Controller{

    public function __construct(){
        parent::__construct();


    }
    public function index(){
        $this->load->view('gs_files/header');
        $this->load->view('gs_files/main-nav');
        $this->load->view('gs_files/master_staff_layout_breadcrumb');



        $this->load->model('tif_model/tif_a_form_model');
        $this->staffData = $this->tif_a_form_model->get_StaffList();
        $this->Department = $this->tif_a_form_model->getDepartment();
        $this->Section = $this->tif_a_form_model->getSection();


        $this->load->view('hcm/master_layout/master_layout_view');
        $this->load->view('hcm/master_layout/master_layout_footer');
    }














    public function getStaffInformation(){

        $html = '';
        if(count($_POST)){
          $GTID = $this->input->post('GTID');
            $html = '';


            /* Load Model */
            $this->load->model('tif_model/tif_a_form_model');
            $staffData = $this->tif_a_form_model->get_StaffInfo($GTID);


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
        <h6 class="normalFont"><span class="leftLab2">Campus:</span> <strong>'.$staffData[0]['branch'].'</strong></h6>
                     
            </div><!-- col-md-8 -->
                  </div><!-- col-md-4 -->
                  <div class="col-md-4 borderRightRed" style="height:126px;">
                  
                  </div><!-- col-md-4 -->
                  <div class="col-md-3"  style="height:126px;">
              
                  </div><!-- col-md-3 -->
              </div><!-- RightInformation_headerSection -->';
        }


        echo $html;
    }







    public function getStaff_tifA(){
    $html = '';
    if(count($_POST)){
      $GTID = $this->input->post('GTID');



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
      /*
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
      */




      /*
      $html .= '
      <div class="col-md-12 RightInformation_headerSection">
              <div class="col-md-4 borderRightRed paddingLeft0">
                <div class="col-md-4 paddingLeft0 paddingRight0" style="max-width:105px;">
                  <img width="100%" src="'.$ImageName.'" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;padding-bottom:20px;"><span class="nameCode">'.$staffData[0]['name_code'].'</span>
                </div><!-- col-md-4 -->
                <div class="col-md-8 paddingRight0">
          <h2 class="headHeading">'.$staffData[0]['name'].'</h2>
          <h6 class="normalFont"><span class="leftLab2">GT-ID:</span> <strong>'.$GTID.'</strong></h6>
          <h6 class="normalFont"><span class="leftLab2">Status:</span> <strong>'.$staffData[0]['staff_status_code'].'</strong></h6>
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
        */

  $html .= '<div class="RightInformation">
              <div class="RightInformation_contentSection" >
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
                                <h6 class="normalFont pull-right"><span class="leftLab3" style="width:120px;">Class Role:</span> <strong> '.$classRole.' </strong></h6>
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
                                  <tr>
                                    <td class="text-center FunRep">FR</td>
                                    <td class="text-center ClassTeach">'.$staffData_MatrixCLT[0]['clt_type'].'</td>
                                    <td class="text-center ClassHere">'.$staffData_MatrixCLT[0]['class'].'</td>
                                    <td class="text-center ClassSectionHere">'.$staffData_MatrixCLT[0]['gp_id'].'</td>
                                    <td class="text-center StuStrength">'.$staffData_MatrixCLT[0]['students'].'</td>
                                    <td class="text-center TopBottomLine">'.$staffData_MatrixCLT[0]['role_title_tl'].'<br />'.$staffData_MatrixCLT[0]['abridged_name'].'</td>
                                    <td class="text-center ReportingCodeName">'.$staffData_MatrixCLT[0]['name_code'].'</td>
                                  </tr>
                                </table>';
                      }
                $html .= '</div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->';




              for($i=0; $i<=11; $i++){
              $html .= '<div class="col-md-12 paddingBottom20">
                          <div class="col-md-6">';

                            if($i==0){
                      if(!empty($staffData_MatrixSBJ[$i])){
                      $html .= '<table width="100%" border="0" class="FunDaMentalReportingChap" style="border:1px solid #000;">
                                  <tr>
                                    <td width="10%" class="text-center SRNO">'.($i+1+$ij).'</td>
                                    <td width="20%" class="text-center SubjectName">'.$staffData_MatrixSBJ[$i]['gp_id'].'</td>
                                    <td width="5%" class="text-center StuStrength">'.$staffData_MatrixSBJ[$i]['students'].'</td>
                                    <td width="5%" class="text-center Blocks">'.$staffData_MatrixSBJ[$i]['block'].'</td>
                                    <td width="30%" class="text-center TopBottomLine">'.$staffData_MatrixSBJ[$i]['role_title_tl'].'<br />'.$staffData_MatrixSBJ[$i]['abridged_name'].'</td>
                                    <td width="10%" class="text-center NameCodeHere">'.$staffData_MatrixSBJ[$i]['name_code'].'</td>
                                    <td width="10%" class="text-center RankHere">'.$staffData_MatrixSBJ[$i]['reporting_line'].'</td>
                                    <td width="10%" class="text-center"></td>
                                  </tr>
                                </table>';
                                /* <td width="10%" class="text-center FunRep">FR</td> */
                              }}else{if(!empty($staffData_MatrixSBJ[$i])){
                      $html .= '<table width="100%" border="0" class="FunDaMentalReportingChap">
                                  <tr>
                                    <td width="10%" class="text-center SRNO">'.($i+1+$ij).'</td>
                                    <td width="20%" class="text-center SubjectName">'.$staffData_MatrixSBJ[$i]['gp_id'].'</td>
                                    <td width="5%" class="text-center StuStrength">'.$staffData_MatrixSBJ[$i]['students'].'</td>
                                    <td width="5%" class="text-center Blocks">'.$staffData_MatrixSBJ[$i]['block'].'</td>
                                    <td width="30%" class="text-center TopBottomLine">'.$staffData_MatrixSBJ[$i]['role_title_tl'].'<br />'.$staffData_MatrixSBJ[$i]['abridged_name'].'</td>
                                    <td width="10%" class="text-center NameCodeHere">'.$staffData_MatrixSBJ[$i]['name_code'].'</td>
                                    <td width="10%" class="text-center RankHere">'.$staffData_MatrixSBJ[$i]['reporting_line'].'</td>
                                    <td width="10%" class="text-center FunRep White"></td>
                                  </tr>
                                </table>';
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
                                    <td class="text-center RankHere">'.$staffData_MatrixSBJ[($i+12)]['reporting_line'].'</td>
                                  </tr>
                                </table>';
                              }
                  $html .= '</div><!-- col-md-6 -->
                        </div><!-- col-md-12 -->';
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























  public function getStaff_tifB(){


    $html = '';
    if(count($_POST)){
        $GTID = $this->input->post('GTID');

        $this->load->model('tif_model/tif_form_model');    
        $basic_info = $this->tif_form_model->getStaffInfo($GTID);

        $staff_id = $basic_info[0]['id'];
        $where  = array(
            'staff_id' => $staff_id
        );
        $employe_supporting = $this->tif_form_model->get_by_tif('atif.staff_registered_supporting',$where);
       
         

        if(!empty($basic_info)){
            $name = $basic_info[0]['name'];
            $gender = $basic_info[0]['gender'];
            $name_code = $basic_info[0]['name_code'];
            $nic = $basic_info[0]['nic'];
            $gu_id = $basic_info[0]['gg_id'];
            $gt_id = $basic_info[0]['gt_id'];
            $dob = $basic_info[0]['dob'];
            $status_code = $basic_info[0]['category'];
            $mobile_phone = $basic_info[0]['mobile_phone'];
            $Landline = $basic_info[0]['land_line'];
            $eobi_no  = $basic_info[0]['eobi_no'];
            $sessi_no = $basic_info[0]['sessi_no'];
        }else{

            $name = '';
            $gender = '';
            $name_code = '';
            $nic = '';
            $gu_id = '';
            $gt_id = '';
            $dob = '';
            $status_code = '';
            $mobile_phone = '';
            $Landline = '';
            $eobi_no = '-';
            $sessi_no = '-';

        }

        if($eobi_no == ''){
          $eobi_no = '-';
        }

        if($sessi_no == ''){
          $sessi_no = '-';
        }

        if($gender == 'M'){
            $staff_gender = 'Male';
        }else{
            $staff_gender = 'Female';
        }


        if(!empty($employe_supporting)){
            $religion = $employe_supporting[0]->religion;
            $employment_status = $employe_supporting[0]->employment_status;
            $email_personal = $employe_supporting[0]->emailPersonal;
            $nationality = $employe_supporting[0]->nationality;
            $provident_fund = $employe_supporting[0]->providentFund;
            $national_tax = $employe_supporting[0]->nationalTaxNumber;
        }else{
            $religion = '';
            $employment_status = '';
            $email_personal = '';
            $nationality = '';
            $provident_fund = '';
            $national_tax = '';
        }


        // Supporting
        if($religion == '1'){
            $religion = 'Muslim';
        }else if($religion == ''){
            $religion = '';
        }else if($religion == '0'){
            $religion = 'Non-Muslim';
        }


        if($employment_status == 1){
            $employment_status = 'Married';
        }else if($employment_status == 2){
            $employment_status = 'Single';
        }else if($employment_status == 3){
            $employment_status = 'Divorce';
        }else if($employment_status == 4){
            $employment_status = 'Widow';
        }elseif ($employment_status == '') {
            $employment_status = '';
        }

        if($provident_fund == 1){
          $provident_fund = 'Yes';
        }else if($provident_fund == 0){
          $provident_fund = 'No';
        }



        // Address

        $where_address = array(
            'staff_id' => $staff_id
        );

        $address_info = $this->tif_form_model->get_by_tif('atif.staff_contact_info',$where_address);

        if(!empty($address_info)){
            $appartment = $address_info[0]->apartment_no;
            $building = $address_info[0]->building_name;
            $plot = $address_info[0]->plot_no;
            $street = $address_info[0]->street_name;
            $region_id = $address_info[0]->region;
            $sub_region_id = $address_info[0]->sub_region;


            // Get Region Name From Region ID
            $where_region_id = array(
                'id' => $region_id
            );
            $get_region = $this->tif_form_model->get_by_tif('atif._region',$where_region_id);           
            //$region_name = $get_region[0]->name;

            if(empty($get_region[0]->name)){
                $region_name = '';
            }
            else{
                $region_name = $get_region[0]->name;
            }
            //====== Get Sub Region Name From Sub Region ID =====//

            $where_sub_region_id = array(
                'id' => $sub_region_id
            );

            $get_sub_region = $this->tif_form_model->get_by_tif('atif._region_sub',$where_sub_region_id);
            if(empty($get_sub_region[0]->name)){
                $sub_region_name = '';
            }else{
                $sub_region_name = $get_sub_region[0]->name;                
            }


        }
        else{
            $appartment ='';
            $building = '';
            $plot = '';
            $street = '';
            $region_name = '';
            $sub_region_name = '';
        }


        // ====================Educational Information ========================//

        // School

        $where_school = array(
            'staff_id' => $staff_id,
            'level' => 1
        );

         $school_qualification =  $this->tif_form_model->get_by_tif('atif.staff_registered_qualification',$where_school);


        $schoolCounter = 1;
        if(!empty($school_qualification)){
            
            foreach($school_qualification as $school ){
                
                if($schoolCounter == 1){
                    $School_one =  str_replace("_", " ", $school->institute);
                    $School_subject_one = str_replace("_", " ", $school->subjects);
                    $School_degree_one = str_replace("_", " ", $school->qualification);
                    $School_result_one = str_replace("_", " ", $school->result);
                    $School_year_one= $school->year_of_completion;
                }
                    
                if($schoolCounter == 2){
                    $School_two =  str_replace("_", " ", $school->institute);
                    $School_subject_two= str_replace("_", " ", $school->subjects);
                    $School_degree_two = str_replace("_", " ", $school->qualification);
                    $School_result_two = str_replace("_", " ", $school->result);
                    $School_year_two= $school->year_of_completion;
                }
                    
                $schoolCounter++;
            }
        }

        if(empty($School_one)){
            $School_one = '-';
            $School_subject_one = '-';
            $School_degree_one = '-';
            $School_result_one = '-';
            $School_year_one = '-';
        }

        if(empty($School_two)){
            $School_two = '-';
            $School_subject_two = '-';
            $School_degree_two = '-';
            $School_result_two = '-';
            $School_year_two = '-';
        }


        // College Qualification

        // College

        $where_college = array(
            'staff_id' => $staff_id,
            'level' => 2
        );

         $college_qualification =  $this->tif_form_model->get_by_tif('atif.staff_registered_qualification',$where_college);


        $collegeCounter = 1;
        if(!empty($college_qualification)){
            
            foreach($college_qualification as $college ){
                
                if($collegeCounter == 1){
                    $college_one =  str_replace("_", " ", $college->institute);
                    $college_subject_one = str_replace("_", " ", $college->subjects);
                    $college_degree_one = str_replace("_", " ", $college->qualification);
                    $college_result_one = str_replace("_", " ", $college->result);
                    $college_year_one= $college->year_of_completion;
                }
                    
                if($collegeCounter == 2){
                    $college_two =  str_replace("_", " ", $college->institute);
                    $college_subject_two= str_replace("_", " ", $college->subjects);
                    $college_degree_two = str_replace("_", " ", $college->qualification);
                    $college_result_two = str_replace("_", " ", $college->result);
                    $college_year_two= $college->year_of_completion;
                }
                    
                $collegeCounter++;
            }
        }

        if(empty($college_one)){
            $college_one = '-';
            $college_subject_one = '-';
            $college_degree_one = '-';
            $college_result_one = '-';
            $college_year_one = '-';
        }

        if(empty($college_two)){
            $college_two = '-';
            $college_subject_two = '-';
            $college_degree_two = '-';
            $college_result_two = '-';
            $college_year_two = '-';
        }


         // University Qualification

        // University

        $where_uni = array(
            'staff_id' => $staff_id,
            'level' => 3
        );

         $uni_qualification =  $this->tif_form_model->get_by_tif('atif.staff_registered_qualification',$where_uni);


        $uniCounter = 1;
        if(!empty($uni_qualification)){
            
            foreach($uni_qualification as $uni ){
                
                if($uniCounter == 1){
                    $uni_one =  str_replace('_'," ",$uni->institute);
                    $uni_subject_one = str_replace('_',' ',$uni->subjects);
                    $uni_degree_one = str_replace('_',' ',$uni->qualification);
                    $uni_result_one = str_replace('_',' ',$uni->result);
                    $uni_year_one= $uni->year_of_completion;
                }
                    
                if($uniCounter == 2){
                    $uni_two =  str_replace("_", " ", $uni->institute);
                    $uni_subject_two= str_replace('_',' ',$uni->subjects);
                    $uni_degree_two = str_replace('_',' ',$uni->qualification);
                    $uni_result_two = str_replace('_',' ',$uni->result);
                    $uni_year_two= $uni->year_of_completion;
                }
                    
                $uniCounter++;
            }
        }



        if(empty($uni_one)){
            $uni_one = '-';
            $uni_subject_one = '-';
            $uni_degree_one = '-';
            $uni_result_one = '-';
            $uni_year_one = '-';
        }

        if(empty($uni_two)){
            $uni_two = '-';
            $uni_subject_two = '-';
            $uni_degree_two = '-';
            $uni_result_two = '-';
            $uni_year_two = '-';
        }



        // professional  Qualification

        // Professional

        $where_pro = array(
            'staff_id' => $staff_id,
            'level' => 4
        );

         $pro_qualification =  $this->tif_form_model->get_by_tif('atif.staff_registered_qualification',$where_pro);


        $proCounter = 1;
        if(!empty($pro_qualification)){
            
            foreach($pro_qualification as $pro ){
                
                if($proCounter == 1){
                    $pro_one =  str_replace("_", " ", $pro->institute);
                    $pro_subject_one = str_replace("_", " ", $pro->subjects);
                    $pro_degree_one = str_replace("_", " ", $pro->qualification);
                    $pro_result_one = str_replace("_", " ", $pro->result);
                    $pro_year_one= $pro->year_of_completion;
                }
                    
                if($proCounter == 2){
                    $pro_two =  str_replace("_", " ", $pro->institute);
                    $pro_subject_two= str_replace("_", " ", $pro->subjects);
                    $pro_degree_two = str_replace("_", " ", $pro->qualification);
                    $pro_result_two = str_replace("_", " ", $pro->result);
                    $pro_year_two= $pro->year_of_completion;
                }
                    
                $proCounter++;
            }
        }

        if(empty($pro_one)){
            $pro_one = '-';
            $pro_subject_one = '-';
            $pro_degree_one = '-';
            $pro_result_one = '-';
            $pro_year_one = '-';
        }

        if(empty($pro_two)){
            $pro_two = '-';
            $pro_subject_two = '-';
            $pro_degree_two = '-';
            $pro_result_two = '-';
            $pro_year_two = '-';
        }



         // Other  Qualification

        // Other

        $where_other = array(
            'staff_id' => $staff_id,
            'level' => 5
        );

         $other_qualification =  $this->tif_form_model->get_by_tif('atif.staff_registered_qualification',$where_other);


        $otherCounter = 1;
        if(!empty($other_qualification)){
            
            foreach($other_qualification as $other ){
                
                if($otherCounter == 1){
                    $other_one =  str_replace("_", " ", $other->institute);
                    $other_subject_one = str_replace("_", " ", $other->subjects);
                    $other_degree_one = str_replace("_", " ", $other->qualification);
                    $other_result_one = str_replace("_", " ", $other->result);
                    $other_year_one= $other->year_of_completion;
                }
                    
                if($otherCounter == 2){
                    $other_two =  str_replace("_", " ", $other->institute);
                    $other_subject_two= str_replace("_", " ", $other->subjects);
                    $other_degree_two = str_replace("_", " ", $other->qualification);
                    $other_result_two = str_replace("_", " ", $other->result);
                    $other_year_two= $other->year_of_completion;
                }
                    
                $otherCounter++;
            }
        }

        if(empty($other_one)){
            $other_one = '-';
            $other_subject_one = '-';
            $other_degree_one = '-';
            $other_result_one = '-';
            $other_year_one = '-';
        }

        if(empty($other_two)){
            $other_two = '-';
            $other_subject_two = '-';
            $other_degree_two = '-';
            $other_result_two = '-';
            $other_year_two = '-';
        }


        //============ Employment History =====================//

        $emp_history=$this->tif_form_model->getEmployeHistory($staff_id);

        // =============== Father Spouse Detail ===================//

        $where_father = array(
          'staff_id' => $staff_id,
          'spouseType' => 1
        );

        $father_detail = $this->tif_form_model->get_by_tif('atif.staff_registered_father_spouse',$where_father);
        
        if(!empty($father_detail)){

          $father_name =  $father_detail[0]->name;
          $father_profession = $father_detail[0]->profession;
          $father_qualification = $father_detail[0]->qualification;
          $father_designation = $father_detail[0]->designation;
          $father_company = $father_detail[0]->company;
          $father_department = $father_detail[0]->department;
          $father_nic = $father_detail[0]->nic;
          $father_mobile_phone =$father_detail[0]->mobile_phone;
          $father_address = $father_detail[0]->address;
          $father_marital_status = $father_detail[0]->marital_status;

        }else{

          $father_name =  '-';
          $father_profession = '-';
          $father_qualification = '-';
          $father_designation = '-';
          $father_company = '-';
          $father_department = '-';
          $father_nic = '-';
          $father_mobile_phone ='-';
          $father_address = '-';
          $father_marital_status = '-';

        }

        // Spouse Detail

        $where_spouse = array(
          'staff_id' => $staff_id,
          'spouseType' => 2
        );

        $spouse_detail = $this->tif_form_model->get_by_tif('atif.staff_registered_father_spouse',$where_spouse);

        if(!empty($spouse_detail)){

          $spouse_name =  $spouse_detail[0]->name;
          $spouse_profession = $spouse_detail[0]->profession;
          $spouse_qualification = $spouse_detail[0]->qualification;
          $spouse_designation = $spouse_detail[0]->designation;
          $spouse_company = $spouse_detail[0]->company;
          $spouse_department = $spouse_detail[0]->department;
          $spouse_nic = $spouse_detail[0]->nic;
          $spouse_mobile_phone =$spouse_detail[0]->mobile_phone;
          $spouse_address = $spouse_detail[0]->address;
          $spouse_marital_status = $spouse_detail[0]->marital_status;


        }else{

          $spouse_name =  '-';
          $spouse_profession = '-';
          $spouse_qualification = '-';
          $spouse_designation = '-';
          $spouse_company = '-';
          $spouse_department = '-';
          $spouse_nic = '-';
          $spouse_mobile_phone = '-';
          $spouse_address = '-';
          $spouse_marital_status = '-';

        }


        // ================ CHILDREN DETAIL ===================//

        $where_child = array(
          'staff_id' => $staff_id
        );

        $staff_child = $this->tif_form_model->get_by_tif('atif.staff_child',$where_child);
        if(!empty($staff_child)){
          $gf_id = $staff_child[0]->gf_id;


          $where_gfid = array(
            'gf_id' => $gf_id
          );

          $staff_child_detail= $this->tif_form_model->get_by_tif('atif.class_list',$where_gfid);

          if(!empty($staff_child_detail)){

          $staff_child_age = $this->tif_form_model->getAge($gf_id);
          $d_gf_id = $staff_child_detail[0]->gfid;
          }else{
             $staff_child_age = '';
             $d_gf_id = '';
          }
         
          // if(!empty($staff_child_detail)){
          //   foreach($staff_child_detail as $child_detail){
          //     $child_name[] = $child_detail->abridged_name;
          //     $child_class[] = $child_detail->grade_name."-".$child_detail->section_dname;
          //     $child_gs_id[] = $child_detail->gs_id;
          //     $d_gf_id = $child_detail->gfid;

          //   }

          // }
        } else{

          $d_gf_id = '';
          $staff_child_age='';
          $child_name = '';
          $child_class = '';
          $child_gs_id = '';
        }



        // ==================== EMERGENCY CONTACT ============//


        // KIN
        $kin = array(
          'staff_id' => $staff_id,
          'type' => 1
        );

        $kin_detail = $this->tif_form_model->get_by_tif('atif.staff_registered_alternativecontact',$kin);

        if(!empty($kin_detail)){

          $kin_name = $kin_detail[0]->name;
          $kin_address = $kin_detail[0]->address;
          $kin_email = $kin_detail[0]->email;
          $kin_phone = $kin_detail[0]->phone;
          $kin_relationships= $kin_detail[0]->relationships;

        }else{

          $kin_name = '-';
          $kin_address = '-';
          $kin_email = '-';
          $kin_phone = '-';
          $kin_relationships= '-';

        }

        // Emergency


       $emergency = array(
          'staff_id' => $staff_id,
          'type' => 2
        );

        $emergency_detail = $this->tif_form_model->get_by_tif('atif.staff_registered_alternativecontact',$emergency);

        if(!empty($emergency_detail)){

          $emergency_name = $emergency_detail[0]->name;
          $emergency_address = $emergency_detail[0]->address;
          $emergency_email = $emergency_detail[0]->email;
          $emergency_phone = $emergency_detail[0]->phone;
          $emergency_relationships= $emergency_detail[0]->relationships;

        }else{

          $emergency_name = '-';
          $emergency_address = '-';
          $emergency_email = '-';
          $emergency_phone = '-';
          $emergency_relationships = '-';

        }


        //=================== Bank Detail ==========================//

        $where_bank = array(
          'staff_id' => $staff_id
        );

        $bank_detail = $this->tif_form_model->get_by_tif('atif.staff_registered_bank_account',$where_bank);

        if(!empty($bank_detail)){

          $branch_name = $bank_detail[0]->branch;
          $branch_code = $bank_detail[0]->branch_code;
          $account_no = $bank_detail[0]->account_number;

        }else{

          $branch_name = '';
          $branch_code = '';
          $account_no = '';

        }

        if($branch_name == ''){
          $branch_name = '';
        }

        if($branch_code == 0){
          $branch_code = '';
        }

        if($account_no == ''){
          $account_no = '';
        }

        // ============= TAKAFUL =====================//

        $where_takaful = array(
          'staff_id' => $staff_id
        );

        $takaful_detail = $this->tif_form_model->get_by_tif('atif.staff_registered_takaful',$where_takaful);

        if(!empty($takaful_detail)){
          $takaful_self = $takaful_detail[0]->self;
          $takaful_spouse = $takaful_detail[0]->spouse;
          $takaful_children = $takaful_detail[0]->children;
          $takaful_certificate = $takaful_detail[0]->certificate_no; 
        }else{

          $takaful_self = 0;
          $takaful_spouse = 0;
          $takaful_children = 0;
          $takaful_certificate = ''; 

        }

        if($takaful_self == 0){
          $takaful_self = 'No';
        }else if($takaful_self == 1){
          $takaful_self = 'Yes';
        }

        if($takaful_spouse == 0){
          $takaful_spouse = 'No';
        }else if($takaful_spouse == 1){
          $takaful_spouse = 'Yes';
        }

        if($takaful_children == 0){
          $takaful_children = 'No';
        }else if($takaful_children == 1){
          $takaful_children = 'Yes';
        }



        $data['GG_ID'] = $this->tif_form_model->getEmail($GTID);
        $staff_id_array=$this->tif_form_model->getStaffID($GTID);
        //Staff ID Required
         $staffid=$staff_id_array[0]['id'];

        $html .= '<ul class="nav nav-tabs">';
        $html .= '<li class="active"><a data-toggle="tab" href="#BasicInformation">Basic</a></li>';
        $html .= '<li><a data-toggle="tab" href="#EducationRecord">Education</a></li>';
        $html .= '<li><a data-toggle="tab" href="#EmploymentHistory">Employment</a></li>';
        $html .= '<li><a data-toggle="tab" href="#ParentSopuseDetails">Parent / Spouse</a></li>';
        $html .= '<li><a data-toggle="tab" href="#ChildrenDetails">Children</a></li>';
        $html .= '<li><a data-toggle="tab" href="#AlternateContacts">Alternate Contacts</a></li>';
        $html .= '<li><a data-toggle="tab" href="#BankDetails">Other</a></li>';
        $html .= '</ul><!-- nav-tabs -->';
        $html .= '<div class="tab-content">';
        $html .= '<div id="BasicInformation" class="tab-pane fade in active">';
        $html .= '<h3 class="headingUnderline">Basic Information</h3>';
        $html .= '<table id="user" class="table table-bordered table-striped xedit" style="clear: both">';
        $html .= '<tbody>'; 
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Full Name <small></small>: </span> <a href="#">'.$name.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">CNIC: </span> <a href="#">'.$nic.'</a></td>';
        $html .= '</tr>';
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Religion: </span> <a href="#" >'.$religion.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">Nationality: </span> <a href="#">'.$nationality.'</a></td>';
        $html .= '</tr>';
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Gender: </span><a href="#">'.$staff_gender.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">DOB <small>(as per NIC)</small>: </span> <a href="#">'.date("d M Y",strtotime($dob)).'</a></td>';
        $html .=  '</tr>';
        $html .=  '<tr class="bBottomD">';         
        $html .= '<td width="50%"><span class="grayish">Marital Status : </span><a href="#">'.$employment_status.'</a></td>';
        $html .= '<td width="50%">&nbsp;</td>';
        $html .= '</tr>';
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Mobile Number: </span> <a href="#">'.$mobile_phone.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">Landline Number: </span><a href="#">'.$Landline.'</a></td>';
        $html .= '</tr>';
        $html .= '<tr class="bBottomD">';         
        $html .= '<td width="50%"><span class="grayish">Email <small>(Persoanal)</small>: </span> <a href="#">'.$email_personal.'</a></td>';
        $html .=  '<td width="50%"></td>';
        $html .= '</tr>';
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Apartment No : </span> <a href="#">'.$appartment.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">Street Name : </span><a href="#">'.$street.'</a></td>';
        $html .= '</tr>';
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Building Name : </span> <a href="#">'.$building.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">Plot No : </span><a href="#">'.$plot.'</a></td>';
        $html .= '</tr>';
        $html .= '<tr class="bBottomD">';         
        $html .= '<td width="50%"><span class="grayish">Region : </span> <a href="#">'.$region_name.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">Sub Region: </span><a href="#">'.$sub_region_name.'</a></td>';
        $html .= '</tr>';
        $html .= '<tr>';         
        $html .= '<td width="50%"><span class="grayish">Name Code : </span> <a href="#">'.$name_code.'</a></td>';
        $html .= '<td width="50%"><span class="grayish">Employment Status : </span> <a href="#">'.$status_code.'</a></td>';
        $html .= '</tr>';
                        
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '<div id="EducationRecord" class="tab-pane fade">';
        $html .= '<h3 class="headingUnderline">Education Record</h3>';
        $html .= '<table width="100%" border="0" class="table table-bordered">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th class="" width="40%">Institute</th>';
        $html .= '<th width="20%">Subjects</th>';
        $html .= '<th width="20%">Qualification</th>';
        $html .= '<th width="10%">Result</th>';
        $html .= '<th width="10%">Year of<br />Completion</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr class="bBottomD">';
        $html .= '<td colspan="5" class=""><strong>School</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>'.$School_one.'</td>';
        $html .= '<td>'.$School_subject_one.'</td>';
        $html .= '<td>'.$School_degree_one.'</td>';
        $html .= '<td>'.$School_result_one.'</td>';
        $html .= '<td>'.$School_year_one.'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>'.$School_two.'</td>';
        $html .= '<td>'.$School_subject_two.'</td>';
        $html .= '<td>'.$School_degree_two.'</td>';
        $html .= '<td>'.$School_result_two.'</td>';
        $html .= '<td>'.$School_year_two.'</td>';
        $html .= '</tr>';
        $html .= '<tr class="bBottomD">';
        $html .= '<td colspan="5" class=""><strong>College</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>'.$college_one.'</td>';
        $html .= '<td>'.$college_subject_one.'</td>';
        $html .=  '<td>'.$college_degree_one.'</td>';
        $html .= '<td>'.$college_result_one.'</td>';
        $html .= '<td>'.$college_year_one.'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>'.$college_two.'</td>';
        $html .= '<td>'.$college_subject_two.'</td>';
        $html .= '<td>'.$college_degree_two.'</td>';
        $html .= '<td>'.$college_result_two.'</td>';
        $html .= '<td>'.$college_year_two.'</td>';
        $html .= '</tr>';
        $html .= '<tr class="bBottomD">';
        $html .= '<td colspan="5" class=""><strong>University</strong></td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>'.$uni_one.'</td>';
        $html .= '<td>'.$uni_subject_one.'</td>';
        $html .= '<td>'.$uni_degree_one.'</td>';
        $html .= '<td>'.$uni_result_one.'</td>';
        $html .= '<td>'.$uni_year_one.'</td>';
        $html .= '</tr>';
        $html .= '<tr>';
        $html .= '<td>'.$uni_two.'</td>';
        $html .= '<td>'.$uni_subject_two.'</td>';
        $html .= '<td>'.$uni_degree_two.'</td>';
        $html .= '<td>'.$uni_result_two.'</td>';
        $html .= '<td>'.$uni_year_two.'</td>';
        $html .= '</tr>
                  <tr class="bBottomD">
                    <td colspan="5" class=""><strong>Professional</strong></td>
                  </tr>
                  <tr>';
        $html .= '<td>'.$pro_one.'</td>';
        $html .= '<td>'.$pro_subject_one.'</td>';
        $html .= '<td>'.$pro_degree_one.'</td>';
        $html .= '<td>'.$pro_result_one.'</td>';
        $html .= '<td>'.$pro_year_one.'</td>';
        $html .= '</tr>
                  <tr>';
        $html .= '<td>'.$pro_two.'</td>';
        $html .= '<td>'.$pro_subject_two.'</td>';
        $html .= '<td>'.$pro_degree_two.'</td>';
        $html .= '<td>'.$pro_result_two.'</td>';
        $html .= '<td>'.$pro_year_two.'</td>';
        $html .= '</tr>
                  <tr class="bBottomD">
                    <td colspan="5" class=""><strong>Others</strong></td>
                  </tr>
                  <tr>';
        $html .= '<td>'.$other_one.'</td>';
        $html .= '<td>'.$other_subject_one.'</td>';
        $html .= '<td>'.$other_degree_one.'</td>';
        $html .= '<td>'.$other_result_one.'</td>';
        $html .= '<td>'.$other_year_one.'</td>';
        
        $html .= '</tr>
                  <tr>';

        $html .= '<td>'.$other_two.'</td>';
        $html .= '<td>'.$other_subject_two.'</td>';
        $html .= '<td>'.$other_degree_two.'</td>';
        $html .= '<td>'.$other_result_two.'</td>';
        $html .= '<td>'.$other_year_two.'</td>';

        $html .= '</tr>
                  </tbody>
                </table>
            </div>';
        $html .= '<div id="EmploymentHistory" class="tab-pane fade">
                <h3 class="headingUnderline">Employment History</h3>
                <table width="100%" border="0" class="table table-bordered">
                  <thead>
                  <tr>
                    <th class="">Institution</th>
                    <th>Designation</th>
                    <th>Class(s)<br />taught</th>
                    <th>Subject(s)<br />taught</th>
                    <th>Salary</th>
                    <th>From<br /><small>(year)</small></th>
                    <th>To<br /><small>(year)</small></th>
                    <th>Reasons for Leaving</th>
                  </tr>
                  </thead>
                  <tbody>';


        if(!empty($emp_history)){
          foreach($emp_history as $emp_record){
            $html .= '<tr>';
            $html .= '<td>'.$emp_record['organization'].'</td>';
            $html .= '<td>'.$emp_record['designation'].'</td>';
            $html .= '<td>'.$emp_record['classes_taught'].'</td>';
            $html .= '<td>'.$emp_record['subject_taught'].'</td>';
            $html .= '<td>'.$emp_record['salary'].'</td>';
            $html .= '<td>'.$emp_record['from_year'].'</td>';
            $html .= '<td>'.$emp_record['to_year'].'</td>';
            $html .= '<td>'.$emp_record['reason_for_leaving'].'</td>';
            $html .= '</tr>';
          
          }
        }else{            
                  
             $html .= '<tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>';
          }
          $html .= '        </tbody>
                </table>
            </div>
            <div id="ParentSopuseDetails" class="tab-pane fade">
                <h3 class="headingUnderline">Parent / Spouse details</h3>
                <table width="100%" border="0" class="table table-bordered">
                  <thead>
                  <tr>
                    <th class="text-center" width="40%">Father</th>
                    <th class="text-center" width="20%">&nbsp;</th>
                    <th class="text-center" width="40%">Spouse</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td class="">'.$father_name.'</td>
                    <td class="text-center"><strong>Name</strong></td>
                    <td class="">'.$spouse_name.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_profession.'</td>
                    <td class="text-center"><strong>Profession</strong></td>
                    <td>'.$spouse_profession.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_qualification.'</td>
                    <td class="text-center"><strong>Qualification</strong></td>
                    <td>'.$spouse_qualification.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_designation.'</td>
                    <td class="text-center"><strong>Designation</strong></td>
                    <td>'.$spouse_designation.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_department.'</td>
                    <td class="text-center"><strong>Department</strong></td>
                    <td>'.$spouse_department.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_company.'</td>
                    <td class="text-center"><strong>Organisation</strong></td>
                    <td>'.$spouse_company.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_nic.'</td>
                    <td class="text-center"><strong>CNIC</strong></td>
                    <td>'.$spouse_nic.'</td>
                  </tr>
                  <tr>
                    <td>'.$father_mobile_phone.'</td>
                    <td class="text-center"><strong>Mobile</strong></td>
                    <td>'.$spouse_mobile_phone.'</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td class="text-center"><strong>Address</strong></td>
                    <td>&nbsp;</td>
                  </tr>
                  
                  </tbody>
                </table>
            </div>
            <div id="ChildrenDetails" class="tab-pane fade">
                <h3 class="headingUnderline">Children Details - <small>GF-ID: <strong>'.$d_gf_id.'</strong></small></h3>
                <table width="100%" border="0" class="table table-bordered">
                  <thead>
                  <tr>
                    <th class="" width="10%">S. No.</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Grade</th>
                    <th>GS-ID</th>
                    <th>University</th>
                    <th>Employer</th>
                  </tr>
                  </thead>
                  <tbody>';

                if(!empty($staff_child_detail)){ 
                  $count = 1;
                for($i = 0 ;$i<sizeof($staff_child_detail); $i++){
                  $html .= '<tr>';
                  $html .= '<td>'.$count.'</td>';
                  $html .= '<td>'.$staff_child_detail[$i]->abridged_name.'</td>';
                  $html .= '<td>'.$staff_child_age[$i]['age'].'</td>';
                  $html .= '<td>'.$staff_child_detail[$i]->grade_name.'-'. $staff_child_detail[$i]->section_dname.'</td>';
                  $html .= '<td>'.$staff_child_detail[$i]->gs_id.'</td>';
                  $html .= '<td>&nbsp;</td>';
                  $html .= '<td>&nbsp;</td>';
                  $html .= '<tr>' ;
                  $count++;
                  }
                }
                else{

                $html .='  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>

                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>';
                }

              $html .='</tbody>
                </table>
            </div>
            <div id="AlternateContacts" class="tab-pane fade">
                <h3 class="headingUnderline">Alternate Contacts</h3>
                <table width="100%" border="0" class="table table-bordered">
                  <thead>
                  <tr>
                    <th class="text-center" width="40%">Next of Kin</th>
                    <th class="text-center" width="20%">&nbsp;</th>
                    <th class="text-center" width="40%">Emergency Contact</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>'.$kin_name.'</td>
                    <td class="text-center"><strong>Name</strong></td>
                    <td>'.$emergency_name.'</td>
                  </tr>
                  <tr>
                    <td>'.$kin_address.'</td>
                    <td class="text-center"><strong>Address</strong></td>
                    <td>'.$emergency_address.'</td>
                  </tr>
                  <tr>
                    <td>'.$kin_email.'</td>
                    <td class="text-center"><strong>Email</strong></td>
                    <td>'.$emergency_email.'</td>
                  </tr>
                  <tr>
                    <td>'.$kin_phone.'</td>
                    <td class="text-center"><strong>Mobile</strong></td>
                    <td>'.$emergency_phone.'</td>
                  </tr>
                  <tr>
                    <td>'.$kin_relationships.'</td>
                    <td class="text-center"><strong>Relationship</strong></td>
                    <td>'.$emergency_relationships.'</td>
                  </tr>
                  </tbody>
                </table>
            </div>
            <div id="BankDetails" class="tab-pane fade">
                <h3 class="headingUnderline">Other Details</h3>
                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                    <tbody> 
                        <tr>         
                            <td width="50%"><span class="grayish">Provident Fund : </span> <a href="#">'.$provident_fund.'</a></td>
                            <td width="50%"><span class="grayish">NTN : </span> <a href="#">'.$national_tax.'</a></td>
                        </tr>
                        <tr>         
                            <td width="50%"><span class="grayish">EOBI/SESSI number: </span> <a href="#" >'.$eobi_no."/". $sessi_no.'</a></td>
                            <td width="50%">&nbsp;</td>
                        </tr>
                        
                    </tbody>
                </table>
                <h3 class="headingUnderline">Bank Details</h3>
                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                    <tbody> 
                        <tr>         
                            <td width="50%"><span class="grayish">Bank Name : </span> <a href="#">Meezan Bank</a></td>
                            <td width="50%"><span class="grayish">Branch: </span> <a href="#">'.$branch_name.'</a></td>
                        </tr>
                        <tr>         
                            <td width="50%"><span class="grayish">Account Number: </span> <a href="#" >'.$account_no.'</a></td>
                            <td width="50%">&nbsp;</td>
                        </tr>
                        
                    </tbody>
                </table>
                <h3 class="headingUnderline">Takaful</h3>
                <table id="user" class="table table-bordered table-striped xedit" style="clear: both">
                    <tbody> 
                        <tr>         
                            <td width="50%"><span class="grayish">Self : </span> <a href="#">'.$takaful_self.'</a></td>
                            <td width="50%"><span class="grayish">Spouse: </span> <a href="#">'.$takaful_spouse.'</a></td>
                        </tr>
                        <tr>         
                            <td width="50%"><span class="grayish">Children: </span> <a href="#" >'.$takaful_children.'</a></td>
                            <td width="50%"><span class="grayish">Certificate No: </span>'.$takaful_certificate.'<a href="#" ></a></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>';



    }

    echo $html;
  }
}