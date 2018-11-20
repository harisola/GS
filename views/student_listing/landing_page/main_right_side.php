<?php
//var_dump( $student_profile );
?>
<div class="col-md-12 RightInformation_headerSection" id="RightInformationHeaderSection">
<div class="col-md-5 borderRightRed paddingLeft0">

<div class="col-md-4 paddingLeft0 paddingRight0">
	<?php 
	if( !empty( $student_profile["gr_no"] ) ){
		$sibling_photo = base_url() . 'assets/photos/sis/150x150/student/' . $student_profile['gr_no'] . '.png';
	if(!file_exists('assets/photos/sis/150x150/student/' . $student_profile['gr_no'] . '.png')){
		if($student_profile['gender'] == 'B' || $student_profile['gender'] == 'b'){
			$sibling_photo = base_url() . 'assets/photos/sis/150x150/male.png';
		}else{
			$sibling_photo = base_url() . 'assets/photos/sis/150x150/female.png';
		}
	}
	?>
<img width="100%" src="<?php echo $sibling_photo;?>" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;">		
	<?php }else{ ?>
		
<img width="100%" src="<?php echo base_url()?>assets/photos/sis/150x150/student/NoPhoto.png" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;">		
	<?php } ?>
		
	</div><!-- -->
	
	<div class="col-md-8 paddingRight0">
		<h2 class="headHeading"><?=$student_profile["official_name"];?></h2>
		<h6 class="normalFont"><span class="leftLab2">GS-ID:</span> <strong><?=$student_profile["gs_id"];?></strong> (<?=$student_profile["std_status_code"];?>)</h6>
		<h6 class="normalFont"><span class="leftLab2">Grade:</span> <strong><?=$student_profile["grade_dname"];?>-<?=$student_profile["section_dname"];?></strong> (<?=$student_profile["house_dname"];?>)</h6>
		<h6 class="normalFont"><span class="leftLab2">Att. Score:</span> 
		<?php
			if( $attendance_varification == 1){ 
				//Presence Verified
				$AttBox = "PV";
				$data_original_title ="Presence Verified";
			}elseif( $attendance_varification ==2){
				
				//Absent Unauthorized	
				$AttBox = "AU";
				$data_original_title ="Absent Unauthorized";
				
				
			}elseif( $attendance_varification ==3){
				//Absent Authorized	
				$AttBox = "AA";
				$data_original_title ="Absent Authorized";
				
				
				
				
			}elseif( $attendance_varification ==4){
				
				//Absence Verification Pending
				$AttBox = "AP";
				$data_original_title ="Absence Verification Pending";
				
			}elseif( $attendance_varification ==5){
				//Tap in Awaited
				$AttBox = "TA";
				$data_original_title ="Tap in Awaited";
			}elseif( $attendance_varification ==6){
				//Not Expected Today
				$AttBox = "NE";
				$data_original_title ="Not Expected Today";
			}else{
				//Presence Pending Verification
				$AttBox = "PP";
				$data_original_title ="Presence Pending Verification";
				
				
			}
			
			$A60D = ($student_profile["total_ps"]/60);
			$total_ps = round($A60D*10);
			
			?>
			
			<span class="AttBox <?=$AttBox;?>" style="width:50%;">
			<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="<?=$data_original_title;?>" data-pin-nopin="true"><?=$AttBox;?></span>
			<span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true"><?=$student_profile["total_pf"];?></span>
			<span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true"><?=$total_ps;?></span>
			</span>
		</h6>
	</div><!-- -->
</div><!-- col-md-5 -->
<div class="col-md-4 borderRightRed">
	<h6 style="font-weight:normal;margin-top:5px;">
		<span class="leftLab" style="margin-top: 5px;">GS Profiles:</span> 
		<?php
		$Profile='';
		$P_Academic=$student_profile["P_Academic"];
		if( $P_Academic != NULL){
			if($P_Academic == 'A' || $P_Academic == 'A+' || $P_Academic == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Academic == 'B' || $P_Academic == 'B+' || $P_Academic == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Academic == 'C' || $P_Academic == 'C+' || $P_Academic == 'C-'){
				$Profile='ProfileC';
			}elseif( $P_Academic == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Academic = '-'; }
		?>
		<span class="<?=$Profile;?>" style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">
		<?=$P_Academic?>
		</span> 
		<?php
			$Profile='';
			$P_Parental=$student_profile["P_Parental"];
		if( $P_Parental != NULL ){
			if($P_Parental == 'A' || $P_Parental == 'A+' || $P_Parental == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Parental == 'B' || $P_Parental == 'B+' || $P_Parental == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Parental == 'C' || $P_Parental == 'C+' || $P_Parental == 'C-'){
				$Profile='ProfileC';
			}elseif( $P_Parental == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Parental = '-'; }
		?>
		<span class="<?=$Profile;?>" style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">
		<?=$P_Parental;?>
		</span> 
		
		<?php
		
		$Profile='';
		$P_Social=$student_profile["P_Social"];
		if( $P_Social != NULL ){
			if($P_Social == 'A' || $P_Social == 'A+' || $P_Social == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Social == 'B' || $P_Social == 'B+' || $P_Social == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Social == 'C' || $P_Social == 'C+' || $P_Social == 'C-'){
				$Profile='ProfileC';
			}elseif( $P_Social == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Social = '-'; }
		
		?>
		<span class="<?=$Profile;?>" style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">
		<?=$P_Social;?>
		</span> 
		
		
		<?php
		
		$Profile='';
		$P_Accounts=$student_profile["P_Accounts"];
		if( $P_Accounts != NULL ){
			if($P_Accounts == 'A' || $P_Accounts == 'A+' || $P_Accounts == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Accounts == 'B' || $P_Accounts == 'B+' || $P_Accounts == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Accounts == 'C' || $P_Accounts == 'C-' || $P_Accounts == 'C+' ){
				$Profile='ProfileC';
			}elseif( $P_Accounts == 'D'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Accounts = '-'; }
		
		?>
		<span class="<?=$Profile;?>" style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">
		
		<?=$P_Accounts;?>
		</span>
	</h6>
	<h6 style="font-weight:normal;">
		<span class="leftLab" style="margin-top: 5px;">GF Profiles:</span> 
		<span class="ProfileB" style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="Support" data-pin-nopin="true"><?php echo $student_profile["P_Support"]?$student_profile["P_Support"]:'-';?></span>
		<span class="ProfileC" style="text-align:center;" data-toggle="tooltip" data-placement="top" data-original-title="Conduct" data-pin-nopin="true"><?php echo $student_profile["P_Conduct"]?$student_profile["P_Conduct"]:'-';?></span>
	</h6>
	<h6 style="font-weight:normal;">
		<span class="leftLab">GF-ID:</span> <strong><?=$student_profile["gfid"];?> </strong> (1/3)
	</h6>
	<h6 class="normalFont">
		<span class="leftLab">Admission:</span> <strong><?=$student_profile["year_of_admission"];?> 
		(<?=$student_profile["grade_of_admission"];?>)</strong>
	</h6>
</div><!-- col-md-4 -->
<div class="col-md-3">
	<div class="col-md-12 no-padding no-margin">
		<div class="col-md-6 no-padding no-margin">
			<img width="65" src="<?php echo $father_photo;?>" style="margin-bottom:5px;" class="borderRedImage" data-toggle="tooltip" data-placement="top" data-original-title="<?=$parent_info[0]["name"];?>" data-pin-nopin="true">
		</div><!-- col-md-6 -->
		
		<div class="col-md-6 no-padding no-margin">
			<img width="65" src="<?php echo $mother_photo;?>" class="borderRedImage" data-toggle="tooltip" data-placement="top" data-original-title="<?=$parent_info[1]["name"];?>" data-pin-nopin="true">
		</div><!-- -->
	</div>
</div><!-- col-md-3 -->

</div><!-- RightInformation_headerSection RightInformation_contentSection -->
<?php
$active = "";
switch( $tab_id ){
	case "profile" :
		$active_p = "active";
		$active_ss = "";
		$active_Att = "";
		$active_G = "";
		$active_B = "";
		$active_D = "";
		$active_AA = "";
		$active_T = "";
		break;
		
	case "SMS" :
		$active_p = "";
		$active_ss = "active";
		$active_Att = "";
		$active_G = "";
		$active_B = "";
		$active_D = "";
		$active_AA = "";
		$active_T = "";
		break;
		
	case "Attendance" :
		$active_p = "";
		$active_ss = "";
		$active_Att = "active";
		$active_G = "";
		$active_B = "";
		$active_D = "";
		$active_AA = "";
		$active_T = "";
		break;
		
	case "Grade" :
		$active_p = "";
		$active_ss = "";
		$active_Att = "";
		$active_G = "active";
		$active_B = "";
		$active_D = "";
		$active_AA = "";
		$active_T = "";
		break;
	case "Billing" :
		$active_p = "";
		$active_ss = "";
		$active_Att = "";
		$active_G = "";
		$active_B = "active";
		$active_D = "";
		$active_AA = "";
		$active_T = "";
		break;
	case "Discount" :
		$active_p = "";
		$active_ss = "";
		$active_Att = "";
		$active_G = "";
		$active_B = "";
		$active_D = "active";
		$active_AA = "";
		$active_T = "";
		break;
	case "Arrears-Advance" :
		$active_p = "";
		$active_ss = "";
		$active_Att = "";
		$active_G = "";
		$active_B = "";
		$active_D = "";
		$active_AA = "active";
		$active_T = "";
		break;
	case "Timeline" :
		$active_p = "";
		$active_ss = "";
		$active_Att = "";
		$active_G = "";
		$active_B = "";
		$active_D = "";
		$active_AA = "";
		$active_T = "active";
		break;	
		
	default:
		$active_p = "active";
		$active_ss = "";
		$active_Att = "";
		$active_G = "";
		$active_B = "";
		$active_D = "";
		$active_AA = "";
		$active_T = "";
	}
?>


<input type="hidden" name="student_id" id="student_id" value="<?=$student_profile["id"];?>" />
<input type="hidden" name="gs_id" id="gs_id" value="<?=$student_profile["gs_id"];?>" />
<input type="hidden" name="gr_no" id="gr_no" value="<?=$student_profile["gr_no"];?>" />
<input type="hidden" name="gf_id" id="gf_id" value="<?=$student_profile["gf_id"];?>" />


<div class="RightInformation">
<div class="RightInformation_contentSection">
	<ul class="nav nav-tabs">
	
		<li class="<?=$active_p;?>"><a data-toggle="tab" href="#profile" class="tab_action" id="profile_id">Profile</a></li>
		<li class="<?=$active_ss;?>"><a data-toggle="tab" href="#SMS" class="tab_action" id="SMS_id">SMS</a></li>
		<li class="<?=$active_Att;?>"><a data-toggle="tab" href="#Attendance" class="tab_action" id="Attendance_id">Attendance</a></li>
		<li class="<?=$active_G;?>"><a data-toggle="tab" href="#Grade" class="tab_action" id="Grade_id">Grade</a></li>
		<li class="<?=$active_B;?>"><a data-toggle="tab" href="#Billing" class="tab_action" id="Billing_id">Billing</a></li>
		<li class="<?=$active_D;?>"><a data-toggle="tab" href="#Discount" class="tab_action" id="Discount_id">Discount</a></li>
		<li class="<?=$active_AA;?>"><a data-toggle="tab" href="#Arrears-Advance" class="tab_action" id="Arrears-Advance_id">Arrears/Advance</a></li>
		<li class="<?=$active_T;?>"><a data-toggle="tab" href="#Timeline" class="tab_action" id="Timeline_id">Log</a></li>
		

		
		
	 </ul><!-- nav-tabs -->
	 
	<div class="tab-content">
		<div id="profile" class="tab-pane fade in <?=$active_p;?>">
			<h3 class="headingUnderline">Personal Information</h3>
			<?php
			
				if( !empty($student_profile) ){ ?>
					
				
			<table id="user" class="table table-bordered table-striped xedit" style="clear: both">
				<tbody> 
					<tr>         
						<td width="50%"><span class="grayish">Abridged Name: </span> <a href="#" id="abridgedName" data-type="text" data-pk="1" data-title="Abridged name"><?=$student_profile["abridged_name"];?></a></td>
						<td width="50%"><span class="grayish">Call Name: </span> <a href="#" id="callName" data-type="text" data-pk="1" data-title="Call name"><?=$student_profile["call_name"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Official Name: </span> <a href="#" id="officialName" data-type="text" data-pk="1" data-title="Official name"><?=$student_profile["official_name"];?></a></td>
						<td width="50%"><span class="grayish">DOB: </span> <a href="#" id="dobb" data-type="combodate" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="1"  data-title="Select Date of birth"><?=$student_profile["dob"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Grade section: </span> <a href="#" id="gradeSection" data-type="text" data-pk="1" data-title="Grade-Section"><?=$student_profile["grade_dname"];?>-<?=$student_profile["section_dname"];?></a></td>
						<td width="50%"><span class="grayish">Gender: </span><a href="#" id="gender" data-type="select2" data-pk="1" data-value="B" data-title="Select gender"><?=$student_profile["gender"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">House: </span><a href="#" id="house" data-type="select2" data-pk="1" data-value="J" data-title="Select house"><?=$student_profile["house_dname"];?></a></td>
						<td width="50%"><span class="grayish">&nbsp;</span></td>
					</tr>
				</tbody>
			</table>
			
			<h3 class="headingUnderline">Parents Information</h3>
			<table id="user" class="table table-bordered table-striped xedit" style="clear: both">
				<tbody> 
					<tr>         
						<td width="50%"><span class="grayish">Father Name: </span> <a href="#" id="fatherName" data-type="text" data-pk="1" data-title="Father name"><?=$parent_info[0]["name"];?></a></td>
						<td width="50%"><span class="grayish">Mother Name: </span> <a href="#" id="motherName" data-type="text" data-pk="1" data-title="Mother name"><?=$parent_info[1]["name"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father NIC: </span> <a href="#" id="fatherNIC" data-type="text" data-pk="1" data-title="Father NIC"><?=$parent_info[0]["nic"];?></a></td>
						<td width="50%"><span class="grayish">Mother NIC: </span> <a href="#" id="motherNIC" data-type="text" data-pk="1" data-title="Mother NIC"><?=$parent_info[1]["nic"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father Mobile: </span> <a href="#" id="fatherMobile" data-type="text" data-pk="1" data-title="Father Mobile"><?=$parent_info[0]["mobile_phone"];?></a></td>
						<td width="50%"><span class="grayish">Mother Mobile: </span> <a href="#" id="motherMobile" data-type="text" data-pk="1" data-title="Mother Mobile"><?=$parent_info[1]["mobile_phone"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father Speciality: </span><a href="#" id="fatherSpec" data-type="text" data-pk="1" data-title="Father Speciality"><?=$parent_info[0]["speciality"];?></a></td>
						<td width="50%"><span class="grayish">Mother Speciality: </span><a href="#" id="motherSpec" data-type="text" data-pk="1" data-title="Mother Speciality"><?=$parent_info[1]["speciality"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father Profession: </span><a href="#" id="fatherProf" data-type="text" data-pk="1" data-title="Father Profession"><?=$parent_info[0]["profession"];?></a></td>
						<td width="50%"><span class="grayish">Mother Profession: </span><a href="#" id="motherProf" data-type="text" data-pk="1" data-title="Mother Profession"><?=$parent_info[1]["profession"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father Organization: </span><a href="#" id="fatherOrg" data-type="text" data-pk="1" data-title="Father Organization"><?=$work_detail[0]["organization"];?></a></td>
						<td width="50%"><span class="grayish">Mother Organization: </span><a href="#" id="motherOrg" data-type="text" data-pk="1" data-title="Mother Organization"><?=$work_detail[1]["organization"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father Department: </span><a href="#" id="fatherDept" data-type="text" data-pk="1" data-title="Father Department"><?=$work_detail[0]["department"];?></a></td>
						<td width="50%"><span class="grayish">Mother Department: </span><a href="#" id="motherDept" data-type="text" data-pk="1" data-title="Mother Department"><?=$work_detail[1]["department"];?></a></td>
					</tr>
					<tr>         
						<td width="50%"><span class="grayish">Father Designation: </span><a href="#" id="fatherDes" data-type="text" data-pk="1" data-title="Father Designation"><?=$work_detail[0]["designation"];?></a></td>
						<td width="50%"><span class="grayish">Mother Designation: </span><a href="#" id="motherDes" data-type="text" data-pk="1" data-title="Mother Designation"><?=$work_detail[1]["designation"];?></a></td>
					</tr>
				</tbody>
			</table>
		
			<?php } ?>
		</div><!-- profile -->
	   
	   <div id="SMS" class="tab-pane fade <?=$active_p;?>"></div><!-- SMS -->
		

		<div id="Attendance" class="tab-pane fade <?=$active_p;?>"></div><!-- Attendance -->
		<div id="Grade" class="tab-pane fade <?=$active_p;?>"></div><!-- Grade -->
		<div id="Billing" class="tab-pane fade <?=$active_p;?>"></div><!-- Billing -->
		<div id="Discount" class="tab-pane fade <?=$active_p;?>"></div><!-- Discount -->
		<div id="Arrears-Advance" class="tab-pane fade <?=$active_p;?>"></div><!-- Arrears-Advance -->
		<div id="Timeline" class="tab-pane fade <?=$active_p;?>"></div><!-- Timeline -->
	</div><!-- tab-content -->
</div><!-- .RightInformation_contentSection -->
</div><!-- RightInformation -->
<style>

<div class="ajaxloader" id="ajaxloader" style="display:none1;">  <br /> <br /><br /> Loading... </div>
.ajaxloader{ background-color: silver }
.ajaxloader{
position: absolute;
border:none;
left:300px;
background-color: transparent;
text-align: center;
background-image: url(<?php echo base_url();?>/components/image/ajax-loader2.gif);
background-position: center center;
background-repeat: no-repeat;
}
</style>
<script type="text/javascript">
$(function () {
$('[data-toggle="tooltip"]').tooltip()
});
</script>