<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Activecase_current_modal extends CI_Controller {
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
      $this->load->model('student_attendance/activecase_model');
      $activeCase = $this->activecase_model->getActiveCase($StudentGSID);
      $ActionURL = site_url() . '/student_attendance/atd_hisory/add';
      $ActionURL2 = site_url() . '/student_attendance/atd_hisory/add2';

      

      if(empty($activeCase))
      {
        $this->load->model('students/students_current_classlist_model');
        $data['student_info'] = $this->students_current_classlist_model->get_by(array('gs_id' => $StudentGSID));

        $this->load->model('student_attendance/activecase_category_model');
        $data['activecase_category'] = $this->activecase_category_model->get();
        $categoryOptions = "";
        foreach ($data['activecase_category'] as $category) {        
          $categoryOptions .= '<option value = "' . $category->id . '">' . $category->name . '</option>';
        }


        $this->load->model('student_attendance/activecase_model');

        $title = '<h3>' . $data['student_info'][0]->abridged_name . '</h3>';
        $form = '<div class="powerwidget dark-red powerwidget-sortable" id="most-form-elements" data-widget-editbutton="false" role="widget" style="">
                <header role="heading">
                  <h2>' . $title . '</h2>
                <span class="powerwidget-loader"></span></header>
                <div class="inner-spacer" role="content">
                  <form action="' . $ActionURL . '" class="orb-form" method="POST">
                    <input type="hidden" id="gs_id" name="gs_id" value="' . $StudentGSID . '">
                    <fieldset> 
                      <section>
                        <label class="label">Select Case Type</label>
                        <label class="select">
                          <select id="activecase_category" name="activecase_category">'
                           . $categoryOptions .                         
                          '</select>
                          <i></i> </label>
                      </section>                    
                    </fieldset>
                    <footer>                      
                    </footer>
                  </form>
                </div>
              </div>';

        echo       
        $form;
      }else{        
        $title = $activeCase[0]['start_case_name'];        
        $ActiveCaseID = $activeCase[0]['id']; 
        $this->load->model('student_attendance/activecase_log_desc_model');
        $ACaseDesc = $this->activecase_log_desc_model->getStudentActiveCaseLog($ActiveCaseID);        

        $this->load->model('students/students_current_classlist_model');
        $data['student_info'] = $this->students_current_classlist_model->get_by(array('gs_id' => $StudentGSID));
        
        $CommentsForm = ' 
          <!--ActiveCase-form -->
            <form class="activecase_comments_form">
              <input type="hidden" id="gs_id" name="gs_id" value="' . $StudentGSID . '">
              <input type="hidden" id="activecase_id" name="activecase_id" value="' . $ActiveCaseID . '">
              <div class="chat-message-form">
                <div class="row">
                  <div class="col-md-12">
                    <textarea placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2" id="comments" name="comments" autofocus="autofocus" required="required"></textarea>
                  </div>                
                  
                  <div class="col-md-2 col-sm-4 col-xs-4">                    
                  </div>
                </div>
              </div>
            </form>
              <!-- ActiveCase-form END -->';

        if($ACaseDesc == "") {
          $ActiveCaseInfo = $CommentsForm;
          echo
          '<h3>' . $data['student_info'][0]->abridged_name . '</h3>' .
          '<div class="profile-header">' . $title . '</div>' .
          $ActiveCaseInfo;
        }else{
          $isLeft = true;


          // Staff Related Data
          $this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
          $this->data['photo_file'] = '.png';

          $ActiveCaseInfo = '<h3>' . $data['student_info'][0]->abridged_name . '</h3> 
            <div class="tab-pane active" id="chat">
              <div class="profile-header">' . $title . '</div>' . $CommentsForm . '                
              <div class="chat-messages user-profile-chat">
                <ul>';

            foreach ($ACaseDesc as $ActiveCase) {              
                $ImageName = base_url() . $this->data['staff_150_photo_path'] . $ActiveCase['employee_id'] . $this->data['photo_file'];
                $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
                $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
                $ImageFound = "Yes";

                if (!file_exists($this->data['staff_150_photo_path'] . $ActiveCase['employee_id'] . $this->data['photo_file'])) {
                    if($ActiveCase['gender'] == 'M'){
                        $ImageName = $ImageMale;
                    }else if($ActiveCase['gender'] == 'F'){
                        $ImageName = $ImageFemale;
                    }

                    $ImageFound = "No";              
                }

              if($isLeft == true){
                $ActiveCaseInfo .=
                  '<li class="left clearfix">
                    <div class="user-img pull-left"> <img src="' . $ImageName . '" alt="User Avatar"> </div>
                    <div class="chat-body clearfix">
                      <div class="header"> <span class="name">' . $ActiveCase['abridged_name'] . '</span><span class="name"></span> <span class="badge"><!--<i class="fa fa-clock-o"></i>-->' . unix_to_human($ActiveCase['created']) . '</span></div>
                      <p> ' . $ActiveCase['comments'] .' </p>
                    </div>
                  </li>';
                  $isLeft = false;
              }else{
                $ActiveCaseInfo .=
                  '<li class="right clearfix"><span class="user-img pull-right"> <img src="' . $ImageName . '" alt="User Avatar"> </span>
                    <div class="chat-body clearfix">
                      <div class="header"> <span class="name">' . $ActiveCase['abridged_name'] . '</span><span class=" badge"><!--<i class="fa fa-clock-o"></i>-->' . unix_to_human($ActiveCase['created']) . '</span> </div>
                      <p> ' . $ActiveCase['comments'] .' </p>
                    </div>
                  </li>';
                $isLeft = true;
              }                  
            }                  
          $ActiveCaseInfo .=
            '</ul>
          </div>';


          echo 
          $ActiveCaseInfo;
        }        
      }
    }
  }
}