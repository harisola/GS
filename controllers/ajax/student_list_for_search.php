<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_list_for_search extends CI_Controller {
	public function __construct(){
		parent::__construct();
    $this->load->model('class_list/student_basic_profile_model');
	}

	public function search_student_for_gfid()
	{
		echo '
			<div class="input-group input-group-lg">
	          <div class="input-group-btn">
	            
	          </div>
	          <!-- /btn-group -->
	          <input type="text" placeholder="Enter student name" class="form-control" id="student_name" autofocus>
	          <span class="input-group-btn">
	          <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
	          </span> 
	        </div>			

            <div id="student_search_result">
            </div>
			
			


			<br><br><br>
		';
		//echo '<button class="btn btn-danger student_list_gfid_button" name="" value="11-111">oddk</button>';
		//echo '<button class="btn btn-danger student_list_gfid_button" value="22-222">ok</button>';








		echo
		'
			<script>
				$(document).ready(function(){

					$("#student_name").keyup(function(){
				        $(this).val($(this).val().toUpperCase());
				        var studentName = $("#student_name").val();
				        
				        if($(this).val().length>4){

			                $.ajax({
			                    type:"post",
			                    url:"' . site_url() . '/ajax/student_list_for_search/search_this_student_htmlout",
			                    data:"student_name="+studentName,
			                    success:function(data){
			                    	$("#student_search_result").html(data);
			                    }
			                });

							var interval = setInterval(fn, 500);
				        }else{
				        	$("#student_search_result").html(' . "''" . ');
				        }
				    });

				});
			</script>
		';
	}






	public function search_this_student_htmlout()
	{
		$result = "";
		if(count($_POST))
		{
			$this->data['student_150_photo_path'] = 'assets/photos/sis/150x150/student/';

			$studentName = $_POST['student_name'];
			$data['StudentBasicInfo'] = $this->student_basic_profile_model->get_student_basic_info($studentName);		

			


			$result .= '
			<br>
			<table class="table table-striped table-bordered table-hover">
			  <thead>
				<tr>
				  <th width="50%" colspan="2">Student Information</th>
				  <th width="20%">Father Name</th>
				  <th width="20%">Mother Name</th>
				  <th width="10%">Class</th>
				</tr>
			  </thead>
			  <tbody>';


			$num=1;
      		foreach ($data['StudentBasicInfo'] as $student) {
      			if(file_exists($this->data['student_150_photo_path'] . $student['gr_no'] . ".png")){
					$female_photo = $this->data['student_150_photo_path'] . $student['gr_no'] . ".png";
					$male_photo = $this->data['student_150_photo_path'] . $student['gr_no'] . ".png";
				}else{
					$male_photo = 'assets/photos/sis/150x150/male.png';
					$female_photo = 'assets/photos/sis/150x150/female.png';                
				}

				$GFID = $student['gf_id'];

      			$result .='
      			<tr>
				  <td width="1%"><span class="num">' . $num . '</span></td>
				  <td>
				  	<div class="user-img pull-left">
				  		<button class="student_list_gfid_button" name="" style="background:none; border:none;" value="' . $GFID . '">';


				  		if($student['gender'] == 'G') 
						{
							$result .= '<img class="img-responsive img-thumbnail" style="width:65px;height:auto;" src="'. base_url() . $female_photo .'" alt="User Avatar"> </div>';
						}else{
			            	$result .= '<img class="img-responsive img-thumbnail" style="width:65px;height:auto;" src="'. base_url() . $male_photo .'" alt="User Avatar"> </div>';
			            }
				  		
				  	$result .= '</button><h5>' . $student['official_name'] . '</h5>
				  	<small>GS-ID : <strong>' . $student['gs_id'] . '</strong></small>
				  	<small>GF-ID : <strong>' . $student['gf_id'] . '</strong></small>
				  </td>
				  <td>' . $student['father_name'] . '</td>
				  <td> ' . $student['mother_name'] . '</td>
				  <td>' . $student['grade_name'] . '-' . $student['section_name'] . '</td>
				</tr>
      			';

      			$num++;
      		}



      		$result .='
      		  </tbody>

			  <tfoot>
				<tr>
				  <th colspan="2"></th>
				  <th></th>
				  <th></th>
				  <th></th>				  
				</tr>
			  </tfoot>
			</table>


			<script>
			$(document).ready(function(){
			    $(".student_list_gfid_button").click(function() {
			        var thisGFID = this.value;
			        $("#gfid").val(thisGFID);

			        $("#student_search_for_gfid_modal").modal(' . "'hide'" . ');
			    });
			});
			</script>
			';

		}

		echo $result;		
	}

}