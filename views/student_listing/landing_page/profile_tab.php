<div id="profile" class="tab-pane fade in active">
<?php //var_dump($student_profile); ?>	
<h3 class="headingUnderline">Personal Information</h3>
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