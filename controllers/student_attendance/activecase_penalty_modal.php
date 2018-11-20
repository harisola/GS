<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Activecase_penalty_modal extends CI_Controller {
  public function __construct(){
    parent::__construct();    
  }

  public function index()
  { 
    $this_gsid = $this->input->get(NULL, TRUE);
    if($this_gsid == false)
    {
    }else{
      $StudentGSID = $this_gsid['gsid'];
      $SNo = 0;
      $tableData = "";
      $AbsentReason = "";
      $AbsentCase = "";
      $ActionURL = site_url() . '/student_attendance/atd_history/add4';


      $this->load->model('students/students_current_classlist_model');
      $data['student_info'] = $this->students_current_classlist_model->get_by(array('gs_id' => $StudentGSID));


      $dateTo = date('Y-m-d');
      $workingDays = 1;
      $Grade = $data['student_info'][0]->grade_name;        //'V'; //$this->ClassTeacherGrade;
      $Section = $data['student_info'][0]->section_name;    //'E'; //$this->ClassTeacherSection;
      $this->load->model('student_attendance/std_atd_calendar_wise_model');
      $dateFrom = $this->std_atd_calendar_wise_model->getWorkingDayDate($Grade, $workingDays, $dateTo);
      $this->Student['attendance_dates'] = $this->std_atd_calendar_wise_model->getStudentAttendanceDates($dateFrom, $dateTo, $Grade, $Section, $workingDays);
      $this->Student['attendance_data'] = $this->std_atd_calendar_wise_model->getStudentsAttendanceOfGSID($dateFrom, $dateTo, $StudentGSID, $this->Student['attendance_dates']);     
      

      $this->load->model('student_attendance/student_attendance_absent_case_model');
      $data['absent_case'] = $this->student_attendance_absent_case_model->get();

      $this->load->model('student_attendance/student_attendance_absent_solved_model');
      $data['AbsentHistory'] = $this->student_attendance_absent_solved_model->getAbsentData($StudentGSID, $dateFrom, $dateTo);

                
      
      foreach ($this->Student['attendance_data'] as $attendanceData) {
        foreach ($this->Student['attendance_dates'] as $attendanceDate) {         
          if($attendanceData[$attendanceDate['date']] == NULL || strlen($attendanceData[$attendanceDate['date']]) == 1)
          {
            $SNo++;
            $tableData .= '
              <tr>
              <td width="1%"><span class="num">' . $SNo . '</span></td>
                  <td>' . date("d-M-Y", strtotime($attendanceDate['date'])) . '</td>
                  <input type="hidden" name="absentdate[]" value="' . $attendanceDate['date'] . '">';
              if(strlen($attendanceData[$attendanceDate['date']]) == 1) {
                foreach ($data['AbsentHistory'] as $AbsentHistory) {
                  if($attendanceDate['date'] == $AbsentHistory['date']){
                    $tableData .= '<td>' .  $AbsentHistory['absent_case'] . '</td>';
                    $tableData .= '<td>' .  $AbsentHistory['absent_reason'] . '</td>';
                  }
                }                
            }else{
              $tableData .= '<td></td>';
              $tableData .= '<td></td>';
            }             
              $tableData .= '</tr>';
            }
        }       
      }




      $Title = '<h3>' . $data['student_info'][0]->abridged_name . '</h3>';
      $Body = '
      <div class="inner-spacer" role="content">
        <input type="hidden" name="gs_id" value="' . $StudentGSID . '">
          <table class="table table-condensed table-bordered margin-0px">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Date</th>
                <th>Case</th>
                <th>Reason</th>                      
              </tr>
            </thead>
            <tbody>'
              . $tableData .
            '</tbody>
          </table>        
      </div>
      ';




      echo
      $Title .
      $Body;
    }
  }
}



/*<tr class="active">
                      <td>Calvin</td>
                      <td>Klein</td>
                      <td>@CalvinKlein</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr>
                      <td>Victor</td>
                      <td>Durant</td>
                      <td>@VictorDurant</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr class="success">
                      <td>George</td>
                      <td>Bush</td>
                      <td>@GeorgeBush</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr>
                      <td>Lady</td>
                      <td>Gaga</td>
                      <td>@LadyGaga</td>
                      <td><span class="label label-default">Suspended</span></td>
                    </tr>
                    <tr class="info">
                      <td>Fat</td>
                      <td>Cat</td>
                      <td>@FatCat</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr>
                      <td>Stacey</td>
                      <td>Malibu</td>
                      <td>@StaceyMalibu</td>
                      <td><span class="label label-danger">Banned</span></td>
                    </tr>
                    <tr class="warning">
                      <td>Silvia</td>
                      <td>Saint</td>
                      <td>@SilviaSaint</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr>
                      <td>Chuck</td>
                      <td>Norris</td>
                      <td>@ChuckNorris</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr class="danger">
                      <td>Adam</td>
                      <td>Sandler</td>
                      <td>@AdamSandler</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>*/