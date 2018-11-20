<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_profile_basic_view extends CI_Controller {
	public function __construct(){
		parent::__construct();
    $this->load->model('class_list/student_basic_profile_model');
	}

	public function index()
	{	
		$this_grno = $this->input->get(NULL, TRUE);
		if($this_grno == false)
		{
		}else{
      $StudentGRNO = $this_grno['grno'];

      // **********************************************
      // Setting all the required information variables
      $data['siblings_data'] = $this->student_basic_profile_model->get_siblings_data($StudentGRNO);
      $data['parent_data'] = $this->student_basic_profile_model->get_parent_data($data['siblings_data'][0]['gf_id']);

      $siblings_tab = "";
      $siblings_block = "";
      $this_student_on = "";  //Official Name
      $this_student_gender = "";
      $sibling_photo = ""; 
      $father_photo = "";
      $mother_photo = "";
      $father_photo_found = false;
      $mother_photo_found = false;
      $sibling_grade_section = "";
      $sibling_status = "";
      $sibling_house_detail = "";


      if($data['siblings_data'][0]['siblings_total'] > 1){
        // Setting sibling blocks        
        $siblings_tab = '<li class=""><a href="#siblings" data-toggle="tab">Siblings</a></li>';

        foreach ($data['siblings_data'] as $sibling) {
          // checking father, mother photo
          if(!$father_photo_found){
            $father_photo = base_url() . 'assets/photos/sis/150x150/father/' . $sibling['gr_no'] . '.png';
            if(file_exists('assets/photos/sis/150x150/father/' . $sibling['gr_no'] . '.png')){
              $father_photo_found = true;
            }
          }
          if(!$mother_photo_found){
            $mother_photo = base_url() . 'assets/photos/sis/150x150/mother/' . $sibling['gr_no'] . '.png';
            if(file_exists('assets/photos/sis/150x150/mother/' . $sibling['gr_no'] . '.png')){
              $mother_photo_found = true;
            }
          }

          // Checking clicked student
          if($sibling['gr_no'] == $StudentGRNO){
            $this_student_on = $sibling['official_name'];
            $this_student_gender = $sibling['gender'];
          }else{
            // checking siblings photo
            $sibling_photo = base_url() . 'assets/photos/sis/150x150/student/' . $sibling['gr_no'] . '.png';
            if(!file_exists('assets/photos/sis/150x150/student/' . $sibling['gr_no'] . '.png')){
              if($sibling['gender'] == 'B' || $sibling['gender'] == 'b'){
                $sibling_photo = base_url() . 'assets/photos/sis/150x150/male.png';
              }else{
                $sibling_photo = base_url() . 'assets/photos/sis/150x150/female.png';
              }
            }

            // checking sibling is active or alumnus
            if($sibling['grade_dname'] == ""){
              $sibling_grade_section = "Alumnus";              
            }else{
              $sibling_grade_section = $sibling['grade_dname'] . '-' . $sibling['section_dname'];
              $sibling_status = $sibling['std_status_code'];
            }

            // checking sibling house
            if($sibling['house_name'] == 'Jinnah'){
              $sibling_house_detail = '<center><span style="background-color:#' . $sibling['house_color_hex'] . '; width: 50%; display:block;"><span style="color:black">' . $sibling['house_dname'] . '</span></span></center>';
            }else{
              $sibling_house_detail = '<center><span style="background-color:#' . $sibling['house_color_hex'] . '; width: 50%; display:block;"><span style="color:white">' . $sibling['house_dname'] . '</span></span></center>';
            }

            $siblings_block .= '
            <!--Tiny User Block-->
              <div class="col-md-6 col-sm-6">
                <div class="tiny-user-block clearfix">
                  <div class="siblings-img"> <img src="' . $sibling_photo .'" alt="User"> </div>
                  <h3 id="abridged_name">' . $sibling['abridged_name'] . '</h3>
                  <ul>
                    <li>' . $sibling['gr_no'] . ' | ' . $sibling['gs_id'] . '</li>
                    <li><strong>' . $sibling_grade_section . '</strong></li>                                  
                    <li>' . $sibling_house_detail . '</li>
                    <li>' . date("d-M-Y", strtotime($sibling['dob'])) . '</li>                                  
                    <li><strong>' . $sibling_status . '</strong></li>
                  </ul>
                </div>
              </div>
            <!--/Tiny User Block-->';
          }
        }
      }else{
        $this_student_on = $data['siblings_data'][0]['official_name'];
        $father_photo = base_url() . 'assets/photos/sis/150x150/father/' . $StudentGRNO . '.png';      
        $mother_photo = base_url() . 'assets/photos/sis/150x150/mother/' . $StudentGRNO . '.png';
        $father_photo_found = true;
        $mother_photo_found = true;
        if(!file_exists('assets/photos/sis/150x150/father/' . $StudentGRNO . '.png')){
          $father_photo = base_url() . 'assets/photos/sis/150x150/male.png';
          $father_photo_found = false;
        }
        if(!file_exists('assets/photos/sis/150x150/mother/' . $StudentGRNO . '.png')){
          $mother_photo = base_url() . 'assets/photos/sis/150x150/female.png';
          $mother_photo_found = false;
        }
      }
      // **********************************************
      // **********************************************



      // **********************************************
      // Setting student, father and mother photo
      $student_image = base_url() . 'assets/photos/sis/150x150/student/' . $StudentGRNO . '.png';
      if(!file_exists('assets/photos/sis/150x150/student/' . $StudentGRNO . '.png')){
        if($this_student_gender == 'B' || $this_student_gender == 'b'){
          $student_image = base_url() . 'assets/photos/sis/150x150/male.png';
        }else{
          $student_image = base_url() . 'assets/photos/sis/150x150/female.png';
        }
      }

      // replacing father and mother photos if not found
      if(!$father_photo_found){
        $father_photo = base_url() . 'assets/photos/sis/150x150/male.png';
      }
      if(!$mother_photo_found){
        $mother_photo = base_url() . 'assets/photos/sis/150x150/female.png';
      }      
      // **********************************************
      // ********************************************** 



      // **********************************************
      // Setting student, father and mother photo     
      foreach($data['parent_data'] as $parent) {
        if($parent['parent_type'] == 1){
          $father_name = $parent['name'];
        }
        if($parent['parent_type'] == 2){
          $mother_name = $parent['name'];
        }
      }

      // **********************************************
      // ********************************************** 

			$student_profile_part1 = '
			<div class="inner-spacer" role="content">                 
          <!--Profile-->                
          <div class="user-profile">                  
            <div class="user-profile-info">
              <div class="tabs-white">
                <ul id="myTab" class="nav nav-tabs nav-justified">
                  <li class="active"><a href="#home" data-toggle="tab">' . $this_student_on . '</a></li>' . $siblings_tab . '
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div class="tab-pane active" id="home">
                    <div class="profile-header"></div>
                    <p><center>
                          <img class="img-circle" src="';

			echo $student_profile_part1 . $father_photo . '" alt="User Picture">
                          <img class="img-circle" src="' . $student_image . '" alt="User Picture">
                          <img class="img-circle" src="' . $mother_photo . '" alt="User Picture">
                      </center>                            
                    </p>
                      <table class="table-condensed margin-0px" style="table-layout:fixed; width=100%;">
                        <tbody><tr>                          
                          <td style="width:230px; !important; width:230px;"><strong>' . $father_name . '</strong></td>
                          <td style="width:120px; !important; width:120px;"></td>
                          <td style="width:230px; !important; width:230px;"><strong>' . $mother_name . '</strong></td>
                        </tr>                        
                      </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="siblings">                   
                  <div class="row">' . $siblings_block .                                                  
                  '</div>
                    
                </div>
                
              </div>
            </div>
            
            <!-- /Chat-form --> 
            
          </div>
        </div> 
        <!-- Profile -->                                    
              
      </div>';
		}
	}
}