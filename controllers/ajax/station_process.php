<?php 
Class Station_process extends CI_Controller{
	
	public function __construct(){
		parent::__construct();		
		$this->load->library('session');
	}

/*
 * Function for assigning marks to programme studnets
 */
public function thirdLevel(){


if($this->ion_auth->logged_in() == FALSE){
redirect("welcome");
}else{

	
$this->load->model('etab/teacher_side/teacher_side_model','DBB');

$detail_id  	= $this->input->post('ID');
$grade_id   	= $this->input->post('grdID');
$secion_id  	= $this->input->post('sectionID');
$title      	= $this->input->post('tableTitle');
$assID      	= $this->input->post('assID');
$blocID         = (int)$this->input->post('blocID');
$prgmID         = (int)$this->input->post('prgmID');
$pending_marks  = (int)$this->input->post('pending_marks');


$opt  = (int)$this->input->post('opt');
$academic  = (int)$this->input->post('academic');
$term  = (int)$this->input->post('term');
$subjectID  = (int)$this->input->post('subjectID');
$groupID  = $this->input->post('groupID');


$t = '';
$des = '';
$Total_Marks = '';

$db = "subject_grade";
$table = "assessment_detail";
$select = "id AS ID, date AS dt, title AS Title,max_marks AS Total_Marks, description AS des";
$where = array("id"=>$detail_id,"is_active"=>0,"record_deleted"=>0);
$results = $this->DBB->getAll( $db, $table, $select, $where );

$assTitle = $results[0]["Title"];
$des = $results[0]["des"];
$Total_Marks = $results[0]["Total_Marks"] ;

 
//$swhere = array( "a.grade_id" => $grade_id, "a.section_id" => $secion_id, "b.assessment_detail_id" =>$detail_id );
//$swhere = array( "a.grade_id" => $grade_id, "a.section_id" => $secion_id  );



if( $blocID == 0 ){
$students = $this->DBB->class_list($detail_id,$grade_id,$secion_id);	
}else{

/*$db = "subject";
$table = "subjectblock";
$select = "ID";
$where = array("programID"=>$prgmID);
$results = $this->DBB->getAll( $db, $table, $select, $where );
$blockID= (int)$results[0]["ID"];
$subjectBlock=$blocID;
$students = $this->DBB->class_list2($detail_id,$blockID,$subjectBlock);
*/


$grpID = 0;
$lists = array('A'=>1,'B'=>2,'C'=>3,'D'=>4,'E'=>5,'F'=>6,'G'=>7,'H'=>8,'I'=>9);
foreach( $lists AS $key => $value ){
	if( $groupID == $key ){
		$grpID = $value;
		break;
	}
}
$blockID = $this->DBB->getblockID($academic,$term, $grade_id,$subjectID, $grpID);
$blockID =  (int)$blockID["ID"];
$students = $this->DBB->class_list2( $detail_id,$blockID, $blocID );


}


$html2 = '';
$html2 .= '<div class="panel panel-grey" id="kms">';
$html2 .= '<div class="panel-heading">';
$html2 .= '<h3 class="panel-title"><i class="fa fa-tasks"></i>'.$title.'<span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor"></span></h3>';
$html2 .= '</div>';
$html2 .= '<div class="panel-body orb-form">';
$html2 .= '<div class="page-header"><h3>'.$assTitle.'</h3></div>';

if( $des != '' ){
	$html2 .= '<p class="leada" style="padding-top:10px;">'.$des.'</p>';
}
$html2 .= '<p class="leada" style="padding-top:10px;"> Total Marks Are '.$Total_Marks.'</p>';
$html2 .= '<br />';
$html2 .= '<div class="page-header"><h3>Student List</h3></div>';
$html2 .= '<br />';

$html2 .= '<div class="col-md-10">';

$html2 .= '<table class="tables table table-bordered studentList">';
$html2 .= '<input type="hidden" name="detail_id" value="'.$detail_id.'" class="detail_id" />';
$html2 .= '<input type="hidden" id="total_marks" name="total_marks" value="'.$Total_Marks.'" class="total_marks" />';
$html2 .= '<input type="hidden" value="'.$assID.'" id="catIDHidden" />';
$html2 .= '<input type="hidden" value="'.$secion_id.'" id="sectionID" />';
$html2 .= '<input type="hidden" value="'.$detail_id.'" id="detailIDHidden" />';
$html2 .= '<input type="hidden" value="'.$pending_marks.'" id="pending_marks" />';
$html2 .= '<input type="hidden" value="'.$opt.'" id="optional" />';

$html2 .= '<thead>';
$html2 .= '<tr>';
$html2 .= '<th>#</th>';
$html2 .= '<th>Abridged Name</th>';
$html2 .= '<th>Obtain Marks</th>';
$html2 .= '</tr>';
$html2 .= '</thead>';
$html2 .= '<tbody>';



$counter=1;
foreach($students AS $std ){
$html2 .= '<tr><input type="hidden" name="students[]" value="'.$std["student_id"].'" class="students"/>';
//$html2 .= '<input type="hidden" name="students[]" value="'.$std["student_id"].'" class="students"/>';
$html2 .= '<td>'.$counter.'</td>';
$html2 .= '<td><section class="col-md-8"><h5>'.$std["Name"].'</h5></section></td>';
$html2 .= '<td class="geometry" data-id="'.$std["student_id"].'">';
$html2 .= '<section class="col-md-4">';
//$html2 .= '<label class="input">';
//$html2 .= '<input type="number" pattern="[^0-9\.]" step="0.5" inputmode="numeric" name="marks[]" data-mini="true" class="marks" value="'.$std["OtainMarks"].'" />';
//$html2 .= '<input type="number" pattern="[0-9]+([\.][5-5]+)?" step="0.5" inputmode="numeric" name="marks[]" data-mini="true" class="marks" value="'.$std["OtainMarks"].'" />';


$html2 .= '<input type="hidden" name="OtainMarks[]" data-mini="true" class="OtainMarks" value="'.$std["OtainMarks"].'" />';




if( $std["pending_marks"] == 1 ){
	
$html2 .= '<label class="input"><i class="icon-append fa fa-asterisk"></i>';	
$html2 .= '<input type="type" name="marks[]" data-mini="true" class="marks" value="'.$std["pendingMarks"].'" />';
$html2 .= '</label>';
$html2 .= '<section class="">';	
$html2 .= '<small>( ';
$html2 .= $std["OtainMarks"];
$html2 .= '  Previous )</small></section>';

}else{
	
//$html2 .= '<section class="col-md-4">';		
$html2 .= '<label class="input"><i class="icon-append fa fa-asterisk"></i>';	
$html2 .= '<input type="type" name="marks[]" data-mini="true" class="marks" value="'.$std["OtainMarks"].'" />';
//$html2 .= '</section>';
$html2 .= '</label>';

}
$html2 .= '</section>';

$html2 .= '<section class="col-md-6">';
if( $std["OtainMarks"] != NULL ){
$html2 .= '<i class="fa fa-loading-icon fa-check" style="color: #008800;"></i>';	
$html2 .= '<i class="fa fa-pencil-square-o" aria-hidden="true" style="display:none;"></i>';
}else{
$html2 .= '<i class="fa fa-loading-icon fa-check" style="color: #008800;display:none;"></i>';
$html2 .= '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>';
}

$html2 .= '<i class="fa fa-refresh fa-spin fa-loading-icon" style="color: #008800;display:none;"></i>';
$html2 .= '<em for="number" class="invalid" style="color: #c83025;display:none;">Please enter a valid number</em>';

$html2 .= '<i class="fa fa-loading-icon fa-exclamation-triangle" style="color: #c83025;display:none;"></i>';
$html2 .= '<em for="number" class="invalid2" style="color: #c83025;display:none;"> Marks Increased Not Assigned</em>';
//$html2 .= '<i class="fa fa-loading-icon fa-exclamation-triangle" style="color: #c83025;display:none;"></i>';

if( $std["pending_marks"] == 1 ){
$html2 .= '<em for="number" class="invalid3" style="color: #c83025;"> Marks Assigned BUT will goes for APPROVAL </em>';
}else{
$html2 .= '<em for="number" class="invalid3" style="color: #c83025;display:none;"> Marks Assigned BUT will goes for APPROVAL </em>';	
}

$html2 .= '</label>';
$html2 .= '</section>';

$html2 .= '</td>';
$html2 .= '</tr>';
$counter++;
}
$html2 .= '</tbody>';
$html2 .= '</table>';
$html2 .= '</div>';
$html2 .= '</div>';
$html2 .= '</div>';

echo $html2;
//echo $students;

}

}




public function createAssessmentType(){

if($this->ion_auth->logged_in() == FALSE){
redirect("welcome");
}else{
		
//processtable_13_34_1_54
$processID = $this->input->post('process_id');
$user_id = $this->input->post('user_id');
$role_id = $this->input->post('role_id');
$title = $this->input->post('title');
$x = explode("_",$processID);
$grdID = $x[1];
$subjectID = $x[2];
$category = $x[3];
$catType = $x[4];
$Ass_in_grade_id = $x[5];



 $html2 = '';
 $html2 .= '<div class="panel panel-grey">';
 $html2 .= '<div class="panel-heading">';
 $html2 .= '<h3 class="panel-title"><i class="fa fa-tasks"></i>'.$title.'<span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor"></span></h3>';
 $html2 .= '</div>';
 $html2 .= '<div class="panel-body orb-form">';
 $html2 .= '<input type="hidden" value="'.$processID.'" id="tableID" />';
 $html2 .= '<input type="hidden" value="'.$user_id.'" id="user_id" />';
 $html2 .= '<input type="hidden" value="'.$role_id.'" id="role_id" />';
 
 $html2 .= '<input type="hidden" value="'.$grdID.'" id="grdID" />';
 $html2 .= '<input type="hidden" value="'.$subjectID.'" id="subjectID" />';
 $html2 .= '<input type="hidden" value="'.$category.'" id="category" />';
 $html2 .= '<input type="hidden" value="'.$catType.'" id="catType" />';
 $html2 .= '<input type="hidden" value="'.$Ass_in_grade_id.'" id="Ass_in_grade_id" />';

 $html2 .= '<div class="panel panel-default margin-bottom-40 orb-form"><div class="panel-heading"><h3 class="panel-title"><i class="fa fa-edit"></i> Assessment Type </h3></div>
 <div class="callout callout-danger" id="dateExceeded" style="min-height:24px;display:none;"><h4>Wait For Approval</h4></div>
 <table class="tables table table-striped"><tbody><tr><td>Title</td><td><label class="input"><input type="text" name="title" id="title"></label></td></tr><tr><td>Marks </td><td><label class="input"><input type="text" name="marks" id="marks" class="emarks"><span style="display:none;" class="error">A valid email address is required</span></label></td></tr><tr><td>Date</td><td><label class="input"><input type="text" name="date" id="date3" class="date3"></label></td></tr><tr><td>Description</td><td><label class="textarea"><textarea rows="3" name="description" id="description"></textarea></label></td></tr><tr><td></td><td><button class="btn btn-default" type="submit" id="submitType" name="submit">Submit</button></td></tr></tbody></table></div>';

 $html2 .= '</div>';
 $html2 .= '</div>';
 
 
//$html2 .= '<script type="text/javascript">$(document).on("click","#date3",function(){$("#date3").datepicker({dateFormat: "dd.mm.yy",prevText: "<i class="fa fa-chevron-left"></i>",nextText: "<i class="fa fa-chevron-right"></i>"});});</script>';

echo $html2;

}

}


public function typeDetail(){
$this->load->model('etab/teacher_side/teacher_side_model','DBB');
	
	$user_id = $this->input->post('user_id');
	$role_id = $this->input->post('role_id');
	$grdID = $this->input->post('grdID');
	$subjectID = $this->input->post('subjectID');
	$category = $this->input->post('category');
	$catType = $this->input->post('catType');
	$Ass_in_grade_id = $this->input->post('Ass_in_grade_id');
	
	$sectionID = $this->input->post('sectionID');
	$nowTime = time();
	
	$title = $this->input->post('title');
	$marks = $this->input->post('marks');
	$date3 = $this->input->post('date3');
	$description = $this->input->post('description');
	$is_active = 0;
	
	$db = "subject_grade";
	$table = "assessment_detail";
	$lastID = 0;
	
	$rangeDate = $this->DBB->allowDate();
	$rngDate = $rangeDate["RangeDate"];
	
	if( $date3 < $rngDate ){
		//echo 0;	
		$is_active = 1;
	}else{
		$is_active = 0;
	}
	
	$data = array(
		"assessment_in_grade_id" => $Ass_in_grade_id,
		"sectionID" => $sectionID,
		"date" => $date3,
		"title" => $title,
		"max_marks" => $marks,
		"description" =>$description,
		"role_id"=>$role_id,
		"is_active" => $is_active,
		"created" => $nowTime,
		"register_by" =>$user_id
	);
	$lastID = $this->DBB->insert( $db, $table, $data );
	
	if(  $lastID > 0 ){
		
		if( $is_active == 0 ){
			echo $lastID;
		}else{
			echo 0;
		}
	}else{
		echo 0;
	}
	
}
	
	public function getDetail(){
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$AssInGradeId = $this->input->post('AssInGradeId');
		$sectionID = $this->input->post('sectionID');
		
		$role_id = $this->input->post('role_id');
		
		$optional = $this->input->post('optional');
		
		
		$db = "subject_grade";
		$table = "assessment_detail";
		//$select = "id AS ID, date AS dt, title AS Title,created AS crtdDate";
		$select = "id AS ID, date AS dt, title AS Title,is_active,created AS crtdDate,ignore";
		
		//$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID,"role_id"=>$role_id, "record_deleted"=>0);
		
		//$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID,"record_deleted"=>0);
		
		if( $optional == 1){
			$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID,"role_id"=>$role_id, "record_deleted"=>0);	
		}else{
			$where = array("assessment_in_grade_id"=>$AssInGradeId,"sectionID"=>$sectionID, "record_deleted"=>0);	
		}
		
		$results = $this->DBB->getAll( $db, $table, $select, $where );
		$nowTime = time();
		$html = '';
		$counter = 1;
		if( $results != NULL ){
			foreach( $results as $r ){
				
				$date = $r["dt"];
				$day = date('l', strtotime($date));
				
				$crtdDate = $r["crtdDate"];
				
				
				$is_active = 0;
				$is_active = $r["is_active"];
				
				$workingDates = '';
				$skipdays = array("Saturday", "Sunday");
				$workingDates = $this->addDay( $crtdDate, 200, $skipdays, $skipdates = array());
				//$workingDates = date("Y-m-d",$workingDates);
				if( $nowTime >= $workingDates || $is_active == 1 ){
					$deadLine ="color:#f0ad4e";
					$btn = "btn btn-warning";
					$edit_students = "edit_students_panding";
				}else{
					$deadLine ="color:#82b964";
					$btn = "btn btn-success";
					$edit_students = "edit_students";
				}
				
				$day .= "&nbsp;&nbsp;";
				
			if( $r["ignore"] == 0 ){
					$checked = 'checked="checked"';
					$unchecked = '';
					$class= "";
					
				}else{
					$checked = '';
					$unchecked = 'checked="checked"';
					$class= "danger";
				}
				
				
				$day .= "&nbsp;&nbsp;";
				$html .="<tr data-uid='".$r["ID"]."' style=".$deadLine." title='".$r["Title"]."' class='".$class."'>";
				$html .='<td class="tdTitle">'.$counter.'</td>';
				$html .='<td class="tdTitle">'.$r["Title"]. "<br />Date: " . $day . $r["dt"]  . '</td>';
				if( $is_active == 1 ){
					$html .= "<td><span class='label label-danger' title='Please Contact To Your M.H For Unlock'>Status Lock</span></td>";
				}else{
					$html .= "<td><button class='".$btn." btn-xs ".$edit_students."' id='ass_".$r["ID"]."' title='Assign Marks To Students'><i class='fa fa-pencil'></i> Edit</button></td>";
				}
				$html .= '<td class="radioActionTD">';
				$html .= '<input type="hidden" value="'.$r["ID"].'" class="detailedID" />';
				$html .= '<div class="innerAction1">';
				$html .= '<input name="radio_inline_'.$r["ID"].'" value="1" type="radio" title="Accomplish this assessment" '.$checked.' class="radioAction"><i></i>  Accomplish &nbsp;';
				$html .= '<input name="radio_inline_'.$r["ID"].'" value="0" type="radio" title="Mistakenly created this assessment, please ignore." class="radioAction" '.$unchecked.'><i></i> Ignore &nbsp;';
				$html .= '</div>';
				$html .= '<div class="innerAction2" style="display:none;">
				  Are you sure?
                        <button class="innerAction3 btn btn-success btn-sm" id="submitConfirmFail">No</button>
                        <button class="innerAction3 btn btn-danger btn-sm" id="submitConfirmOk">Yes</button>
				</div>
				<div class="innerAction4" style="display:none">
				<ul class="fa-ul">
					 <li><i class="fa-li fa fa-spinner fa-spin"></i> Updating...</li>
				</ul>
				</div>
				<div class="innerAction5" style="display:none">
				<ul class="fa-ul">
					 <li><i class="fa-li fa fa-check-square"></i> Updated Sucessfully</li>
				</ul>
				</div>
				
				<div class="innerAction6" style="display:none">
				<ul class="fa-ul">
					 <li><i class="fa-li fa fa-square"></i> Transicational Problem</li>
				</ul>
				</div>
				</td>';
				$html .='</tr>';
				
				$counter++;
			}
			
		}else{
			$html .='<tr>';
			$html .='<td colspan="4">No Created!</td>';
			$html .='</tr>';	
		}
		echo $html;
		
	}
	
	public  function addDay($timestamp, $days, $skipdays, $skipdates = NULL) {
        // $skipdays: array (Monday-Sunday) eg. array("Saturday","Sunday")
        // $skipdates: array (YYYY-mm-dd) eg. array("2012-05-02","2015-08-01");
       //timestamp is strtotime of ur $startDate
        $i = 1;

        while ($days >= $i) {
            $timestamp = strtotime("+1 day", $timestamp);
            if ( (in_array(date("l", $timestamp), $skipdays)) || (in_array(date("Y-m-d", $timestamp), $skipdates)) )
            {
                $days++;
            }
            $i++;
        }

        return $timestamp;
        //return date("m/d/Y",$timestamp);
    }
	
	
	public function editDetail(){
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$ID = $this->input->post('trID');
		$tableTitle = $this->input->post('tableTitle');
		$assID = $this->input->post('assID');
		$user_id = $this->input->post('user_id');
		
		$exTitle = explode(":",$tableTitle);
		$tle = $exTitle[0];
		$type = $exTitle[1];
		
		$db = "subject_grade";
		$table = "assessment_detail";
		$select = "id AS ID, date AS dt, title AS Title,max_marks AS Marks, description AS DES";
		$where = array("id"=>$ID);
		$results = $this->DBB->getAll( $db, $table, $select, $where );
		
		$db4 = 'subject_marks';
		$tablename='assessment_marks';
		$select2 = "id";
		$whr = array("assessment_detail_id"=>$ID);
		$rs = $this->DBB->getSingleRow( $db4, $tablename, $select2, $whr );
		if( !empty($rs)){
			$detail_exists =1;
		}else{
			$detail_exists = 0;
		}
		
		$html = '';
		$html .='<div class="panel panel-grey">';
		$html .='<div class="panel-heading">';
		$html .='<h3 class="panel-title"><i class="fa fa-tasks"></i>'.$tle.' <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor"></span></h3>';
		$html .='</div>';
		$html .='<div class="panel-body orb-form">';
		
		$html .= ' <div class="alert alert-success" style="display:none;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="false"><i class="fa fa-times-circle"></i></button>
                  <strong>Category Type Updated</strong> successfully </div><br />';
				  $html .= '<div class="callout callout-danger" id="dateExceeded" style="min-height:24px;display:none;"><h4>Wait For Approval</h4></div>';
				  
		$html .= '<div class="panel panel-default margin-bottom-40 orb-form">';
		$html .= '<div class="panel-heading">';
		$html .= '<h3 class="panel-title"><i class="fa fa-edit"></i>'.$type.' </h3>';
		$html .= '</div>';
		
		$html .= '<table class="tables table table-striped">';
		$html .= '<tbody>';
		$html .= '<input type="hidden" value="'.$ID.'" id="detailIDHidden" />';
		$html .= '<input type="hidden" value="'.$assID.'" id="catIDHidden" />';
		
		foreach( $results AS $r ){
			$html .= '<tr>';
			$html .= '<td>Title</td>';
			$html .= '<td><label class="input"><input type="text" name="title" id="etitle" value="'.$r["Title"].'"></label></td>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<td>Marks </td>';
			
			//$html .= '<td><label class="input"><input type="text" class="emarks" name="marks" id="emarks" value="'.$r["Marks"].'"></label><span class="error" style="display:none;">A valid email address is required</span></td>';
			if( $detail_exists == 0 ){
			$html .= '<td><label class="input"><input type="text" class="emarks" name="marks" id="emarks" value="'.$r["Marks"].'" /></label><span class="error" style="display:none;">A valid email address is required</span></td>';	
			}else{
			$html .= '<td><label class="input"><input type="text" class="emarks" name="marks" id="emarks" value="'.$r["Marks"].'" readonly /></label><span class="error" style="display:none;">A valid email address is required</span></td>';	
			}
			
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<td>Date</td>';
			$html .= '<td><label class="input"><input type="text" name="date" id="edate3" class="date3" value="'.$r["dt"].'"></label></td>';
			$html .= '</tr>';
			$html .= '<tr>';
			$html .= '<td>Description</td>';
			$html .= '<td><label class="textarea"><textarea rows="3" name="description" id="edescription">'.$r["DES"].'</textarea></label></td>';
			$html .= '</tr>';
			
		}
		
			$html .= '<tr>';
			$html .= '<td></td><td><button class="btn btn-default" type="submit" id="updateType" name="updateType">Update</button></td>';
			$html .= '</tr>';
			$html .= '</tbody>';
			$html .= '</table>';
			$html .= '</div>';
			
			$html .= '</div>';
			$html .= '</div>';
			echo $html;
	}
	
	
	public function updateDetail(){
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$ID = $this->input->post('detailID');
		$etitle = $this->input->post('etitle');
		$emarks = $this->input->post('emarks');
		$edate3 = $this->input->post('edate3');
		$edes = $this->input->post('edes');
		$modified_by = $this->input->post('user_id');
		$modifiedDate = time();
		
		
		$rangeDate = $this->DBB->allowDate();
		$rngDate = $rangeDate["RangeDate"];
		
		if( $edate3 < $rngDate ){
			//echo 0;	
			$is_active = 1;
		}else{
			$is_active = 0;
		}
	
	
		
		$data = array(
			'date' => $edate3,
			'title'  => $etitle,
			'max_marks'  => $emarks,
			'description'  => $edes,
			"is_active" => $is_active,
			"modified" => $modifiedDate,
			"modified_by" =>$modified_by
		);
		
		
		$db = "subject_grade";
		$table = 'assessment_detail';
		$return = $this->DBB->replace2($db,$table,$data,$ID);
	/*	if(  $return > 0 ){
		
				if( $is_active == 0 ){
					echo $return;
				}else{
					echo 2;
				}
			}else{
				echo 0;
			} */
			
				if(  $return > 0 ){
		
				if( $is_active == 0 ){
					echo $return;
				}else{
					echo 0;
				}
			}else{
				echo 0;
			}
		
	}
	
	
	/*
		Get pedding request student list
		Marks Edited After Due Date
	*/
	
	public function pddgReq_Stds(){
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$grade_id = $this->input->post('grade_id');
		$section_id = $this->input->post('section_id');
		$detail_id = $this->input->post('detail_id');
		$request_type = $this->input->post('request_type');
		
		
		$table1 = 'atif_subject_marks.assessment_marks AS am';
		$table2 = 'atif.class_list AS cl';
		
		$joinOn = ("am.student_id = cl.id");
		$select = "am.id AS marksID, am.student_id AS stdID,am.marks_obtained AS OM,am.pendingMarks AS PM,cl.abridged_name AS stdName";
		//$or = "( cl.status_id = 1 or cl.status_id = 3 )";
		//$or = "( cl.status_id = 1 or cl.status_id = 3 )";
		$or = "( cl.std_status_category = 'Student' or cl.std_status_category = 'Fence' )";
		if( $request_type == 0 ){
			$where = array( "am.assessment_detail_id" =>$detail_id, "am.pending_marks"=>1 );	
			$students = $this->DBB->innerJoin( $table1, $table2, $joinOn, $select, $where, $or );
			
		}else{
			$where = array( "am.assessment_detail_id" =>$detail_id, "am.pending_marks"=>0 );
			//$grade_id = 13;
			$students = $this->DBB->class_list3( $detail_id,$grade_id,$section_id );
			///var_dump( $students );
			//exit;
			//class_list($detail_id,$grade_id,$section_id);
		}
		
		
	
		//$where_or = array( "cl.status_id" =>1, "cl.status_id" => 3 );
		
		
		
		
		
		
		
$html2 = '';
$html2 .= '<div class="panel panel-grey" id="kms">';

$html2 .= '<div class="panel-heading">';
$html2 .= '<h3 class="panel-title"><i class="fa fa-tasks"></i><span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor"></span></h3>';
$html2 .= '</div>';

$html2 .= '<div class="panel-body orb-form">';
//$html2 .= '<div class="page-header"><h3>Sub Title </h3></div>';
$des = "Testing";
$Total_Marks = 20;
if( $des != '' ){
	//$html2 .= '<p class="leada" style="padding-top:10px;">'.$des.'</p>';
}
//$html2 .= '<p class="leada" style="padding-top:10px;"> Total Marks Are '.$Total_Marks.'</p>';
//$html2 .= '<br />';
//$html2 .= '<div class="page-header"><h3>Student List</h3></div>';
//$html2 .= '<br />';

$html2 .= '<div class="col-md-10">';



$html2 .= '<table class="table">';
$html2 .= '<thead>';
$html2 .= '<tr>';
$html2 .= '<th width="5%">#</th>';
$html2 .= '<th width="20%">Abridged Name</th>';
$html2 .= '<th width="75%">Marks</th>';
//$html2 .= '<th>New Marks</th>';
//$html2 .= '<th> Action </th>';
$html2 .= '</tr>';
$html2 .= '</thead>';
$html2 .= '<tbody>';
$counter=1;
if( !empty( $students )){
	

foreach($students AS $std ){
$html2 .= '<tr data-id="'.$std["marksID"].'">';

$html2 .= '<input type="hidden" name="students[]" value="'.$std["stdID"].'" class="students"/>';
$html2 .= '<input type="hidden" name="marks_obtained[]" value="'.$std["OM"].'" class="marks_obtained"/>';
$html2 .= '<input type="hidden" name="pendingMarks[]" value="'.$std["PM"].'" class="pendingMarks"/>';
$html2 .= '<td>'.$counter.'</td>';

$html2 .= '<td><h5>'.$std["stdName"].'</h5>';
$html2 .= '<td>';



$html2 .= '<div class="col col-10" style="height:70px;padding-top:10px;" class="mainMInfo">';

$html2 .= '<div class="callout-gen undoDiv" style="display:none;">
<p>Are You Sure? <a href="#" class="undo">Undo</a> </p>
<p>
  <button type="button" class="btn btn-primary btn-xs" id="approve_'.$std["marksID"].'">Approve </button>
  <button type="button" class="btn btn-default btn-xs" id="deny_'.$std["marksID"].'"> Deny </button>
</p>
</div>';


if( $request_type == 0 ){
	
$html2 .= '<div class="marksDecision">
  <label class="radio2">
	<i class="fa fa-2x fa-check ignor" data-id="1"></i>
	Previous :'.$std["OM"].'</label>
	<label class="radio2">
	<i class="fa fa-2x fa-check accept" data-id="0"></i>
	New :'.$std["PM"].'</label>';
	
}else{
	
$html2 .='<ul class="list-group">';
$html2 .='<li class="list-group-item" data-id="'.$std["marksID"].'"><h5>'.$std["OM"].'</h5>';
$html2 .='</li>';
$html2 .='</ul>';

}
$html2 .= '</div>';	
$html2 .= '</div>';
$html2 .= '</td>';
$html2 .= '</tr>';
$counter++;
}// end foreach

} //not empty
$html2 .= '</tbody>';
$html2 .= '</table>';



$html2 .= '</div>';
$html2 .= '</div>';
$html2 .= '</div>';



$table = '';
$table .= '<div class="panel panel-grey" id="kms">';

$table .= '<div class="panel-heading">';
$table .= '<h3 class="panel-title"><i class="fa fa-tasks"></i><span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor"></span></h3>';
$table .= '</div>';

$table .= '<div class="panel-body orb-form">';
//$html2 .= '<div class="page-header"><h3>Sub Title </h3></div>';
$des = "Testing";
$Total_Marks = 20;


if( $request_type == 0 ){ 	
$table .='<ul class="list-group">';
}else{
$table .= '<table class="table table-bordered" style="background:none;color:none;">';
$table .= '<thead>';
$table .= '<tr>';
$table .= '<th>#</th>';
$table .= '<th>Marks Obtain</th>';
$table .= '<th>Marks Obtain</th>';
$table .= '</tr>';
$table .= '</thead>';
$table .= '<tbody>';	
}
$counter =1;
if( !empty($students) ) {
foreach($students AS $std ){

if( $request_type == 0 ){ 	
$table .='<li class="list-group-item" data-id="'.$std["marksID"].'"><h5>'.$std["stdName"].'</h5>';
$table .= '<input type="hidden" name="students[]" value="'.$std["stdID"].'" class="students"/>';
$table .= '<input type="hidden" name="marks_obtained[]" value="'.$std["OM"].'" class="marks_obtained"/>';
$table .= '<input type="hidden" name="pendingMarks[]" value="'.$std["PM"].'" class="pendingMarks"/>';
$table .='<div class="callout-gen undoDiv" style="padding: 10px; margin-top: 5px;display:none;">';
$table .='<p>Are You Sure? Assigning these marks to student : <span class="finalMarks"></span>  <a href="#" class="undo">Undo</a> </p>';
$table .='<p>';
$table .='<button type="button" class="btn btn-primary btn-xs btn_primary" id="approve_'.$std["marksID"].'">Approve </button>';
 //$table .='<button type="button" class="btn btn-default btn-xs" id="deny_'.$std["marksID"].'"> Deny </button>';
$table .='</p>';
$table .='<input type="hidden" value="" class="finalDecision" />';
$table .='</div>';

$table .='<div class="marksDecision" style="padding: 10px; margin-top: 5px;">';
$table .='<span class="label bg-black">';
$table .='<i class="fa fa-2x fa-check accept_obtain" data-id="1"></i>';
$table .='  Previous :  <m class="ob1">'.$std["OM"].'</m></span>';
$table .='<span class="label label-success">';
$table .='<i class="fa fa-2x fa-check accept_new" data-id="0"></i>';
$table .='  New : <m class="ob2">'.$std["PM"].'</m></span>';
$table .='</div>';
$table .='</li>';


}else{
	
$table .= '<tr>';
$table .= '<td>';
$table .= $counter;
$table .= '</td>';
$table .= '<td>';
$table .= $std["stdName"];
$table .= '</td>';
$table .= '<td>';
if( !empty($std["OM"] ) ){
$table .= $std["OM"];
}else{
	$table .= 'Marks Not Assigned!';
}
$table .= '</td>';
$table .= '</tr>';




}
$counter++;

}// endforeach

	}//end not empty
if( $request_type == 0 ){ 	
$table .='</ul>';
}else{
$table .= '</tbody>';
$table .= '</table>';	
}


			  

$table .= '</div>';
$table .= '</div>';

echo json_encode( array("HTML" => $table ) );
}



public function teacherNotify(){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$this->load->library('user_agent');
		
		
		$teacher_id = (int)$this->input->post("user_id");
		
		$db = 'role_matrix';
		$tablename = 'setup_grade_lt';
		$select = "program_id";
		$where = array( "teacher_id" => $teacher_id );
		$leadProgramms = $this->ETS->getAll( $db, $tablename, $select, $where);
		//$this->quer($leadProgramms);
		
		
		$browser = $this->agent->browser();
		//echo "<br />";
		$ip = $this->input->ip_address();
		$user_agent = $this->input->user_agent();
		
		$data["user_ip"] = $ip;
		$data["user_agent"] = $user_agent;
		$data["user_id"] = $teacher_id;
		
		$login_user_id = $this->session->userdata("user_id"); //118 GAA
		$reg_user = $this->ETS->getStaffID( $login_user_id );
		$reg_user_id = $reg_user['id'];
		
		$branch_id = (int)$reg_user['branch_id'];
		
		
		$this->load->model('etab/academic/academic_model','AM');
		$sessions = $this->AM->getSession($branch_id);
		$c_sss_id = $sessions[0]["id"];	
		
		$sessionsTerm = $this->AM->getSesstrm($c_sss_id);
		$term = (int)$sessionsTerm[0]["TermID"];
		
		
		//$data['gradeProgramme'] = $this->gtGrdSbjtCtSbCt( $leadProgramms );
		$data = $this->gtGrdSbjtCtSbCt( $leadProgramms , $c_sss_id,$term  );
		
		
		$return = array("html"=>$data,"user_ip"=>$ip, "user_agent" => $user_agent, "user_id"=>$teacher_id);
		echo json_encode( $return );
		
		//$this->load->view("process/notifications/notifications_2.php",$data);

	}
	
	
	
		// Get Grade Subject category and its subcategory
	// Like Formmative -> Class Work
	public function gtGrdSbjtCtSbCt( $leadProgramms,$c_sss_id,$term ){		
	
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$html = '';
		$html .='<div id="content_1">';
		$html .='<div class="panel-heading">';
			$html .='<div class="panel-title pull-left">Notifications </div>';
			$html .='<div class="clearfix"></div>';
		$html .='</div>';
		$changeColor = true;	
		if( $leadProgramms != NULL ){
			
		foreach($leadProgramms AS $gs ){
		
		$where = array("c.id" => $gs["program_id"] );
			$types = $this->ETS->programGradeSub( $where);
			
			
			
			if(!empty($types)){
				
			foreach($types AS $type ){
				
			$ID = $type['Grade'];
				$Grade = $type['Grade'];
				$ProgrammeID = $type["ProgrammeID"];
				$count = $this->prgAssmntNtfct( $type["ProgrammeID"], $c_sss_id,$term  );
				
			  $html .='<div class="panel panel-default">';
              //$html .='<div class="panel-heading">';
			   if($changeColor){
				$html .='<div class="panel-heading" style="background-color: #595f66;">';  
				$changeColor = false;
			  }else{
				  $html .='<div class="panel-heading" style="background-color: #993838;">';
				  $changeColor = true; 
			  }
			  
                $html .='<div class="panel-title pull-left">'.$Grade.'<small>'.$type["subjectCode"].'</small></div>';
				
                $html .='<div class="pull-right">';
				$html .='<span class="badge">'.$count.' </span>';
				//$html .='<a href="#" data-toggle="modal" data-target="#panel-question" class="btn-question"><i class="fa fa-question-circle"></i></a>';
				$html .='<a href="#" class="btn-minmax"><i class="fa fa-chevron-circle-down"></i></a>';
				//$html .='<a href="#" class="btn-close"><i class="fa fa-times-circle"></i></a>';
				$html .='</div>';
				
                $html .='<div class="clearfix"></div>';
              $html .='</div>';
				
				// this id contains grade id subject id category id and cat type id.
				 $html .= '<div class="panel-body" style="display: none;">';
				 
				// $html .='<p class="leads">List groups are a flexible and powerful component for displaying not only simple lists of elements, but complex ones with custom content.</p>';
				 
				
				
					$html .= $this->gradeAssessment($ProgrammeID,$Grade,$c_sss_id);
				 
					
				
				$html .= '</div>';
            $html .= '</div>';
			
			}// end foreach types
		}
		} // End foreach retrieve array data main category
	}
	
	$html .= '</div>';
	$html .= '<div id="content_2"></div>';
	return $html;
	}
	
	
	
	
	public function gradeAssessment( $programme_id, $Grade,$c_sss_id ){
			
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETM');
		
		$table3 = 'atif_assessment.`assessment_category` AS `a`';
		$table4 = 'atif_assessment.`gradesubjectass` AS `b`';
		//$table5 = 'atif_assessment.`assessment_type` AS `c`';
		$select2 = 'a.id AS catID ,a.dname AS catName2';
		$ON2 = 'a.id = b.assessment_category_id';
		$where2 = array('b.program_id'=>$programme_id,'b.weightage > '=>0, 'b.record_deleted' => 0);
		$grdCategories = $this->ETM->joinTwoTables( $table3, $table4, $ON2, $select2, $where2 );
		
		$html = '';
		
		
		$table5 = 'atif_assessment.`assessment_type` AS `a`';
		$table6 = 'atif_assessment.`gradesubjectass` AS `b`';
		
		$select3 = 'a.id AS catID2 ,a.name AS catName,b.id AS Ass_id,b.program_id AS Programme';
		$ON3 = 'a.id = b.assessment_type_id';
		
	
			
		if( $grdCategories != NULL ){
			
		foreach($grdCategories AS $gs ){
			$catID = (int)$gs["catID"];
			$catName2 = $gs["catName2"];
			
			
			
			$where3 = array('b.program_id'=>$programme_id, 'b.assessment_category_id'=>$catID, 'b.weightage > '=>0, 'b.record_deleted' => 0);
			$assessmentsTypes = $this->ETM->joinTwoTables( $table5, $table6, $ON3, $select3, $where3 );
			
			
			
			
			
			$db = "subject_grade";
			$table = "assessment_detail";
			$select = "id AS Ids";
			//var_dump($assessmentsTypes)	;
			
			$changeColor = true;
			
			if( !empty($assessmentsTypes)){
			foreach($assessmentsTypes AS $lp ){
				
				
				$AssInGradeId = $lp["Ass_id"];
			
			
				
		   $where = array("assessment_in_grade_id"=>$AssInGradeId,"record_deleted"=>0);
			//$resultss = $this->ETM->getSingleRow( $db, $table, $select, $where );
			$resultss = $this->ETM->getAll( $db, $table, $select, $where );
			if( !empty( $resultss ) ){
				$count = $this->prgAssmntTypeNtfct( $programme_id, $resultss );
			}else{
				$count = 0;
			}
			
			
			
			$html .='<div class="panel panel-default" id="table1">';
			
            //$html .='<div class="panel-heading">';
			
			if( $count > 0 ){
			$html .='<div class="panel-heading" style="background-color: #5bc0de;">';
			$changeColor = false;
		  }else{
			$html .='<div class="panel-heading" style="background-color: #595f66;">';   
			  $changeColor = true; 
		  }
			  
			  
            $html .='<div class="panel-title pull-left">'.$catName2.'<small>'.$lp["catName"].'</small></div>';
            $html .='<div class="pull-right">';
			$html .='<span class="badge">'.$count.' </span>';
			$html .='<a href="#" class="btn-minmax"><i class="fa fa-chevron-circle-down"></i></a>';
			$html .='</div>';
            $html .='<div class="clearfix"></div>';
            $html .='</div>';
			
			
			$html .='<div class="panel-body inner-spacer" style="display:none" role="content">';
			//$html .='<p class="leads">List groups are a flexible content.</p>';
				//$html .= $this->get_List($lp["Ass_id"]);
				
				$html .='<table class="table table-bordered table-striped margin-0px detailTable">';
					
					$html .='<thead>';
						$html .='<tr>';
							$html .='<th>#</th>';
							$html .='<th>Assessment</th>';
							//$html .='<th>Type</th>';
							//$html .='<th>Date</th>';
							$html .='<th>Students </th>';
						$html .='</tr>';
					$html .='</thead>';
						$html .='<tbody>';
						$html .= $this->getDetailList( $lp["Ass_id"],$Grade );
						
						//$html .= '<tr>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '<td>';$html .= '</td>';$html .= '</tr>';
						
						
						$html .='</tbody>';
					$html .='</table>';
					
					
					
			$html .='</div>';
			
			
			
            $html .='</div>';
			
			}
			}			
			
		}
		}
			
			//exit;
            return $html;
			
			
			
			
		
		
	}
	
	
	
	
		public function getDetailList( $AssInGradeId,$Grade ){
			
		$this->load->model('etab/teacher_side/teacher_side_model','DBB');
		$db = "subject_grade";
		$table = "assessment_detail";
		$select = "id AS ID, date AS dt, title AS Title,created AS crtdDate, register_by AS teacher_id,role_id AS role_id, is_active AS active";
		
		$where = array("assessment_in_grade_id"=>$AssInGradeId,"record_deleted"=>0);
		
		$results = $this->DBB->getAll( $db, $table, $select, $where );
		
		$db2 = 'default';
		$tablename2 = 'staff_registered';
		$select2 = "employee_id,abridged_name";
		
		$db3 = 'role_matrix';
		$tablename3 = 'role_subject_teacher';
		$select3 = "id AS RoleID, gp_id AS Role,section_id AS Section";
		
		$db4 = 'subject_marks';
		$tablename='assessment_marks';
		$count = "count(*) as pendng";
		$count2 = "count(*) as total_edit";
		
		$db5 = 'default';
		$tablename1='class_list';
		$count3 = "count(*) as sectionStudent";
		
		
		$nowTime = time();
		$html = '';
		$counter = 1;
		if( $results != NULL ){
			foreach( $results as $r ){
				$date = $r["dt"];
				$day = date('l', strtotime($date));
				$strtodate = strtotime($date);
				$crtdDate = $r["crtdDate"];
				$teacher_id = $r["teacher_id"]; 
				$active = $r["active"]; 
				
				$where2 = array( "id" => $teacher_id );
				$teacher = $this->DBB->getSingleRow( $db2,  $tablename2, $select2, $where2 );


				$employee_id =  $teacher["employee_id"];
				$abridged_name = $teacher["abridged_name"];

				$role_id = $r["role_id"]; 
				$where3 = array( "id" => $role_id );
				$roles = $this->DBB->getSingleRow( $db3,  $tablename3, $select3, $where3 );
				
				$detail_id = $r["ID"];
				$where1 = array("assessment_detail_id" => $detail_id, "pending_marks" => 1);
				$total_pendding = $this->DBB->getSingleRow( $db4,  $tablename, $count, $where1 );
				
				
				$detail_id = $r["ID"];
				$where1 = array("assessment_detail_id" => $detail_id );
				$total_edit = $this->DBB->getSingleRow( $db4,  $tablename, $count2, $where1 );
				
				
				//var_dump( $roles ); exit;
				$role = $roles["Role"];
				$Section = $roles["Section"];
				
				
				$where4 = array("grade_name" => $Grade,"section_id" => $Section  );
				$section_students = $this->DBB->getSingleRow( $db5,  $tablename1, $count3, $where4 );
				
				

				/*$workingDates = $this->addDays( $crtdDate, 2, $skipdays, $skipdates = array());
				//$workingDates = date("Y-m-d",$workingDates);
				if( $nowTime >= $workingDates ){
					$deadLine ="color:#f0ad4e";
					$btn = "btn btn-warning";
					$edit_students = "edit_students_panding";
				}else{
					$deadLine ="color:#82b964";
					$btn = "btn btn-success";
					$edit_students = "edit_students";
				}
				*/
				
				$deadLine ="";
				$btn = "";
				$edit_students = "";
					
				$day .= "&nbsp;&nbsp;";
				$html .="<tr data-uid='".$r["ID"]."' style=".$deadLine." class='parentTR'>";
				$html .='<input type="hidden" class="hGrade" value="'.$Grade.'">';
				$html .='<input type="hidden" class="hSection" value="'.$Section.'">';
				$html .='<input type="hidden" value="'.$detail_id.'" class="detail_id">';
				$html .='<td class="tdTitle">'.$counter.'</td>';
				$html .='<td class="tdTitle2">';
				$html .='<div class="alert-blocks alert-blocks-pending alert-dismissable">';
				$html .='<img alt="" src="'.base_url().'Assets/photos/hcm/150x150/staff/'.$employee_id.'.png" class="rounded-x mCS_img_loaded">';
				$html .='<div class="overflow-h2">';
				$html .='<strong class="color-yellow">'.$abridged_name.'</strong>';
				$html .='<p>'.$role.'</p>';
				$html .='<p>Title: '.$r["Title"].'</p>';
				$html .='<p>Date: '. $day . $r["dt"]  .'</p>';
				$html .='</div>';
				$html .='</div>';
				//$html .='</td>';
				//$html .='<td class="tdTitle">'.$r["Title"].'</td>';
				//$html .='<td class="tdTitle">'. $day . $r["dt"]  . '</td>';
				$html .= "<td style='width:25%'>";
				
			$locked = "";
				
				if( $active == 0 ){
					$locked = "block";
					$locked2 = "none";
				}else{
					$locked = "none";
					$locked2 = "block";
				}
				
				$html .= '<div class="list-group lockedDiv" style="display:'.$locked.'">';
				if( $total_pendding["pendng"] > 0 ){
				$html .= '<a class="list-group-item pedding_request" href="#"><span class="badge">'.$total_pendding["pendng"].'</span>Pending</a>';
				}else{
					//$html .= "<button class='".$btn." btn-xs ".$edit_students."' id='ass_".$r["ID"]."'><i class='fa fa-pencil'></i> Edit</button>";	
				}
				////$html .= '<div class="list-group">';
				//$assigned = ( $section_students["sectionStudent"] - $total_edit["pendng"]  );
				if( $total_edit["total_edit"] > 0 ){
				//$html .= '<a class="list-group-item assigned_request" href="#"><span class="badge">'.$total_edit["total_edit"].'</span>Marks Assigned</a>';
				$html .= '<li class="list-group-item blanked_request"><span class="badge">'.$total_edit["total_edit"].'</span>Marks Assigned</li>';
				}else{
					$html .= '<a class="list-group-item total_request" href="#"><span class="badge">'.$total_edit["total_edit"].'</span>Programme Total</a>';
				}
				
				if( $section_students["sectionStudent"] > 0 ){
				$left = ( $section_students["sectionStudent"] - $total_edit["total_edit"]  );
				//$html .= '<a class="list-group-item blanked_request" href="#"><span class="badge">'.$left.'</span>Not Assigned</a>';	
				$html .= '<li class="list-group-item blanked_request"><span class="badge">'.$left.'</span>Not Assigned</li>';	
				$html .= '<a class="list-group-item total_request" href="#"><span class="badge">'.$section_students["sectionStudent"].'</span>Programme Total</a>';
				}else{}
				$html .= '</div>';
				
				$html .='<div class="callout-gen undoDiv2" style="padding: 10px; margin-top: 5px;display:none;">';
				$html .='<p>Are You Sure? To Unlock This Assessment Type <span class="finalMarks2"></span>  <a href="#" class="undo2">Undo</a> </p>';
				$html .='<p>';
				$html .='<br />';
				$html .='<br />';
				$html .='<button type="button" class="btn btn-primary btn-xs appAssTpy" id="approveA_'.$r["ID"].'">Approve </button>';
				$html .='</p>';
				//$html .='<input type="hidden" value="" class="finalDecision" />';
				$html .='</div>';

				$html .= '<div class="lockedDiv2" style="display:'.$locked2.'">';
				$html .= "<span class='label label-danger'>Status Lock</span>";
				$html .='<br />';$html .='<br />';$html .='<br />';
				$html .= '<span class="label label-primary unlocked" data-id="un_'.$r["ID"].'">Unlock</span>';
				$html .= '</div>';
				
				
				
				
				$html .= '</td>';
				$html .='</tr>';
				$counter++;
			}
			
		}else{
			$html .='<tr>';
			$html .='<td colspan="4">No Created!</td>';
			$html .='</tr>';	
		}
		return $html;
		
	}
	
	
	
	public function prgAssmntNtfct($proID){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$notifications = $this->ETS->countNotifications($proID);
		$return = $notifications["Notification"];
		return $return;
	}
	
	
	public function prgAssmntTypeNtfct($proID,$assTypes){
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$return = 0;
		foreach( $assTypes AS $t ){
			$assType = $t["Ids"];
			$notifications = $this->ETS->countNotificationsType($proID, $assType);	
			if( $notifications["Notification"] > 0 ){
				$return += $notifications["Notification"];	
			}
		}
		return $return;
	}
	
	
	public function approveAssmntType(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		$marksID = $this->input->post("marksID");
		$user_id = $this->input->post("user_id");
		$db = "subject_grade";
		$table = "assessment_detail";
		$select = "created AS crtdDate";
		$where = array( "id"=>$marksID );
		$detail = $this->ETS->getSingleRow( $db,  $table, $select, $where );
		$was_locked_date = $detail["crtdDate"];
		$nowTime = time();
		$data = array("is_active" => 0, "was_locked"=>1,"was_locked_date"=>$was_locked_date,"created"=>$nowTime,"modified"=>$nowTime,"modified_by"=>$user_id);
		$return = $this->ETS->replace2($db,$table,$data,$marksID);
		echo json_encode( array( "res" => $return ) );
		
	}






	public function programmeAsesmntList(){
        
        $user_id = $this->input->post("user_id");
        $role_id = $this->input->post("role_id");
        $sectionID = $this->input->post("sectionID");
        $gradeID = $this->input->post("gradeID");
        $optional = $this->input->post("optional");
        //$GPID = $this->input->post("GPID");
        $prgmID = $this->input->post("prgmID");
        $gpp_id = $this->input->post("gpp_id");
        $academic = $this->input->post("academic");
        $term = $this->input->post("term");
        $subjectID = $this->input->post("subjectID");


        $this->load->model('atif_sp/assessment_report_model');


        $GroupID = 0;
        $BlockID = 0;


        /**************************** Assessment Titles 
        /***********************************************/
        $this->data['assessment_titles'] = $this->assessment_report_model->get_grade_subject_assessments($gradeID, $subjectID, $role_id, $term);
        /******************************** Students Data 
        /***********************************************/
        if($optional == 0){
        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
        }else{
        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
        	if($GroupID == 'A'){$GroupID=1;}else
        	if($GroupID == 'B'){$GroupID=2;}else
        	if($GroupID == 'C'){$GroupID=3;}else
        	if($GroupID == 'D'){$GroupID=4;}else
        	if($GroupID == 'E'){$GroupID=5;}else
        	if($GroupID == 'F'){$GroupID=6;}

        	$BlockID = substr($gpp_id, -1);

        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
        }
        /***************************** Assessment Marks
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
	    }else{
	    	$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessments_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);
	    }else{
	    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }
        //var_dump($_POST);


        $table_header = '';
        $table_footer = '';
        $table_body = '';
        $student_marks_head_counter = 0;


        $html = '';





        $table_header .= '
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.">S.No.</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GS-ID">GS-ID</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Abridged Name">Abridged Name</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Call Name">Call Name</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status">Status</th>
        ';
        $table_footer .= '
        <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS-ID" class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter Call Name" class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_status" placeholder="Filter Status" class="search_init"></th>
        ';





        $table_header_counter = 0;
        foreach ($this->data['assessment_titles'] as $data) {
        	$table_header .= '
        		<th class="sorting_asc" role="columnheader" tabindex="'.$table_header_counter.'"  aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.">'.$data->full_name.'</th>
        	';

        	$table_footer .= '
        		<th rowspan="1" colspan="1"><input type="text" name="filter_"'.$data->assessment_type_id.' placeholder="Filter '.$data->full_name.'" class="search_init"></th>
        	';

        	if($data->this_order == '1'){$student_marks_head_counter++;}
        	$table_header_counter++;
        }
        $table_header .='<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Total Marks">Total (100)</th>';
        $table_header .='<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Percentage">Percentage</th>';
        

        $table_footer .= '<th rowspan="1" colspan="1"><input type="text" name="filter_totalMarks" placeholder="Filter Total Marks" class="search_init"></th>';
        $table_footer .= '<th rowspan="1" colspan="1"><input type="text" name="filter_percentage" placeholder="Filter Percentage" class="search_init"></th>';










        $y=1;
        $cell = '';
        $bgColor = '';
        $marks_Total = 0;
        $marksObtained = 0;
        foreach ($this->data['students_gs_data'] as $data) {

        	$cell = '';
        	$marks_Total = 0;
        	$bgColor = 'style="background-color: ' . $this->assessment_report_model->getBGColor($y) . ';"';
        	$table_body .= '<tr class="odd">';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$y.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->gs_id.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->abridged_name.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->call_name.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->std_status_code.'</td>';


        	foreach ($this->data['assessment_titles'] as $title) {
        		if($title->this_order == '1'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->ass_detail_id == $title->assessment_type_id
        					&& $marks->marks_obtained > 0){

        					$marksObtained = $marks->marks_obtained;
        				}
        			}
    				$cell .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$marksObtained.'</td>';
        			
        		}else if($title->this_order == '2'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_agg_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->assessment_id == $title->assessment_type_id
        					&& $marks->aggrAssessment > 0){

        					$marksObtained = $marks->aggrAssessment;
        				}
        			}

        			$cell .= '<td class=" sorting_1 centered-cell" style="background-color: #f5f5f5 !important;">'.$marksObtained.'</td>';
        			$marks_Total += $marksObtained;
        		}

				
        	}


        	$table_body .= $cell;
        	$marks_Total = ROUND($marks_Total, 1);
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$marks_Total.'</td>';
        	$marks_Total = ROUND($marks_Total, 0);
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$marks_Total.'</td>';
        	$table_body .= '</tr>';


        	$y++;
        }




        $html .= '
        <style>
        	.close_setup_4 {
        		float: right;
        	}
        </style>
        ';




        $html .= '
          <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">

            <div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gpp_id . '
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                  	<span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>

              <div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">

                  <table class="display table table-striped table-hover dataTable" id="subject_assessment_marks_table" aria-describedby="staff_info">

                    <thead>
                      <tr role="row">';

            		  $html .= $table_header;

            $html .= '</tr>
                    </thead>

                    <tfoot>
                      <tr>';
                      
                      $html .= $table_footer;

            $html .= '</tr>
                    </tfoot>

                  <tbody role="alert" aria-live="polite" aria-relevant="all">';

                  $html .= $table_body;

            $html .= '</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>';


        





		$html .='
		<script>
		
			if ($("#subject_assessment_marks_table").length) {
                var oTable = $("#subject_assessment_marks_table").dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"                        
                    },
                    "sDom": ' . "'" . 'T<"clear">lfrtip' . "'" . ',
                    tableTools: {
                        "sSwfPath": "' . base_url() . 'components/js/swf/copy_csv_xls_pdf.swf"
                    },
                    "bProcessing": true,
                    "sScrollX": "100%",
                    "bScrollCollapse": true,
                    "iDisplayLength": 50,
                    "fixedHeader": true
                });                

                $("tfoot input").keyup(function () {
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });


                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });

                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });

                $("tfoot input").blur(function (i) {
                    if (this.value === "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
                
            }
        
		</script>
		';


		echo $html;
        
    }









  // public function show_Assessment_Report_PDF(){
        
  //       $user_id = $this->input->get("user_id");
  //       $role_id = $this->input->get("role_id");
  //       $sectionID = $this->input->get("sectionID");
  //       $gradeID = $this->input->get("gradeID");
  //       $optional = $this->input->get("optional");
        
  //       $prgmID = $this->input->get("prgmID");
  //       $gpp_id = $this->input->get("gpp_id");
  //       $academic = $this->input->get("academic");
  //       $term = $this->input->get("term");
  //       $subjectID = $this->input->get("subjectID");




  //       $this->load->model('atif_sp/assessment_report_model');
  //       $GroupID = 0;
  //       $BlockID = 0;



  //       /**************************** Assessment Titles 
  //       /***********************************************/
  //       $this->data['assessment_titles'] = $this->assessment_report_model->get_grade_subject_assessments($gradeID, $subjectID, $role_id, $term);
  //       /******************************** Students Data 
  //       /***********************************************/
  //       if($optional == 0){
  //       	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
  //       }else{
  //       	$GroupID = substr(substr($gpp_id, -3), 0, 1);
  //       	if($GroupID == 'A'){$GroupID=1;}else
  //       	if($GroupID == 'B'){$GroupID=2;}else
  //       	if($GroupID == 'C'){$GroupID=3;}else
  //       	if($GroupID == 'D'){$GroupID=4;}else
  //       	if($GroupID == 'E'){$GroupID=5;}else
  //       	if($GroupID == 'F'){$GroupID=6;}

  //       	$BlockID = substr($gpp_id, -1);

  //       	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
  //       }
  //       /***************************** Assessment Marks
  //       /***********************************************/
  //       if($optional == 0){
	 //        $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
	 //    }else{
	 //    	$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	 //    }

  //       /******************* Assessment Aggregate Marks 
  //       /***********************************************/
  //       if($optional == 0){
	 //        $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessments_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);

	 //    }else{
	 //    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	 //    }

	 //    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	 //    $noOfStudents = sizeof($this->data['students_gs_data']);
  //   	$noOfAssessments = sizeof($this->data['assessment_titles']);
  //   	$A_plus_total = 0;
  //   	$A_total = 0;
  //   	$B_total = 0;
  //   	$C_total = 0;
  //   	$D_total = 0;
  //   	$U_total = 0;






     	


  //    	// Overall Font Size
		// $font_size = 8;
		// $font_name = 'Helvetica'; //Helvetica
		// $gender_mark_size = 26;
		// $now_date = date('d-M-Y');
		// $border = 1;

	



		// require_once('components/pdf/fpdf/fpdf_rotate.php');
		// require_once('components/pdf/fpdi/fpdi.php');

		


		
		// // initiate FPDI
		// if($noOfAssessments <= 27){
		// 	$pdf = new PDF('L', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
		// 	$pdf = new PDF('L','mm',array(270,370));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
		// 	$pdf = new PDF('L','mm',array(300,400));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(350,450));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(400,500));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(450,550));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		// $pdf->AddPage();
		// $pdf->SetFont($font_name,'',$font_size);
		// $i = 0;



		// $borderon = 0;
		// $rptheading_X = 7;
		// $rptheading_Y = 7;
		// $rptheading_CW = 65;
		// $rptheading_CH = 10;
		
		// if(empty($this->data['assessment_marks'][0]->subject_name)){
		// 	$subject_name = '';
		// }else{
		// 	$subject_name = $this->data['assessment_marks'][0]->subject_name;
		// }
		



		// $assessment_X = 81;
		// $assessment_Y = 7;

		// $student_X = 7;
		// $student_Y = 57;
		// $student_CH = 4;



		// /**************************************************** Report Heading
		// *********************************************************************/
		// $pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

		// $heading_font_name = 'CooperBT-Black';
		// $heading_font_size = 12;
		// $pdf->SetFont($heading_font_name,'',$heading_font_size);
  //   	$pdf->SetXY($rptheading_X,$rptheading_Y);
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'L');


  //   	$heading_font_name = 'Helvetica';
		// $heading_font_size = 10;
		// $pdf->SetFont($heading_font_name,'',$heading_font_size);
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH-5,"Formative Report",$borderon,2,'L');
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

		// /*************************************************** Assessment Titles
		// ***********************************************************************/




		// /*************************************************** Assessment Titles
		// ***********************************************************************/
		// foreach ($this->data['assessment_titles'] as $data) {

		// 	$lastx = 0;
		// 	$lasty = 0;

		// 	$col = $data->full_name;

		//    	// $pdf->Cell($X,$Y,,$border);

		// 	if($data->this_order == 2){
		// 		// Fill Grey
		// 		$pdf->SetFillColor(175,175,175);
		// 	}else{
		// 		// Fill White
		// 		$pdf->SetFillColor(255,255,255);
		// 	}
		//    	$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

		//    	$i += $assessment_Y;		
		// }
		// $pdf->SetFillColor(255,255,255);
		// $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
		// $pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
		// $pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);
		// $pdf->RotatedCell($assessment_X+$i+21,$assessment_Y,50,7,'Grades',1,0,'R',270,1);
		// $pdf->SetFont($font_name,'B',$font_size);
		// $pdf->SetXY($assessment_X+$i+21,$student_Y-$student_CH);
		// $pdf->Cell(30,$student_CH,'Student Name',1,0,'L');









		// /******************************************************** Student Info
		// ***********************************************************************/
		// $i = 0;
		// $counter = 1;
		// $marks_Total = 0;
		// $no_round_of_marks_total = 0;
		// $totalMarks_student = array();


		// // Heading
  //   	$pdf->SetFont($font_name,'B',$font_size);
  //   	$pdf->SetXY($student_X,$student_Y-$student_CH);
  //   	$pdf->Cell(7,$student_CH,'Sr',1,0,'C');
  //   	$pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
  //   	$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
  //   	$pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





  //   	$arr_y=0;
  //   	$arr_x=0;

  //   	$Aplus_name = '';
		// $A_name = '';
		// $B_name = '';
		// $C_name = '';
		// $D_name = '';
		// $U_name = '';
        
		// foreach ($this->data['students_gs_data'] as $data) {

		// 	$arr_x=0;
		// 	$font_size = 7;
		// 	$marks_Total = 0;
  //       	// Data
  //       	$pdf->SetFillColor(255,255,255); 
  //       	$pdf->SetFont($font_name,'',$font_size);
  //       	$pdf->SetXY($student_X,$student_Y+$i);
  //       	$pdf->Cell(7,$student_CH,$counter,1,0,'C');
  //       	$pdf->Cell(15,$student_CH,$data->gs_id,1,0,'C');
  //       	$pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L');
  //       	$pdf->Cell(15,$student_CH,$data->std_status_code,1,0,'C');



  //       	$z = -7;
  //       	$font_size = 8;
  //       	foreach ($this->data['assessment_titles'] as $title) {
  //       		if($title->this_order == '1'){
  //       			$marksObtained = 0;
  //       			foreach ($this->data['assessment_marks'] as $marks) {
  //       				if($marks->gs_id == $data->gs_id
  //       					&& $marks->ass_detail_id == $title->assessment_type_id
  //       					&& $marks->marks_obtained > 0){

  //       					$marksObtained = $marks->marks_obtained;
  //       				}
  //       			}

  //       			$pdf->SetFillColor(255,255,255);
  //       			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
  //       			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
  //       			$totalMarks[$arr_y][$arr_x] = $marksObtained;

  //       		}else if($title->this_order == '2'){
  //       			$marksObtained = 0;
  //       			foreach ($this->data['assessment_agg_marks'] as $marks) {
  //       				if($marks->gs_id == $data->gs_id
  //       					&& $marks->assessment_id == $title->assessment_type_id
  //       					&& $marks->aggrAssessment > 0){

  //       					$marksObtained = $marks->aggrAssessment;
  //       				}
  //       			}

  //       			$marks_Total += $marksObtained;
  //       			$pdf->SetFillColor(175,175,175);
  //       			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
  //       			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
  //       			$totalMarks[$arr_y][$arr_x] = $marksObtained;       			
  //       		}
  //       		$z+=7;
  //       		$arr_x++;				
  //       	}

  //       	$no_round_of_marks_total += $marks_Total;
  //       	$totalMarks_student[$arr_y] = $marks_Total;

		// 	$marks_Total = ROUND(($marks_Total), 1);        	
		// 	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C'); 

		// 	$marks_Total = ROUND(($marks_Total), 0);        	
		// 	$pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C');

		// 	$student_totalMarks[$arr_y] = $marks_Total;


		// 	//======================Grading =====================//
		// 	$Aplus_name = $select_grade[0]->name;
  //           $Aplus_weightage = $select_grade[0]->weightage;

  //           $A_name = $select_grade[1]->name;
  //           $A_weightage = $select_grade[1]->weightage;

  //           $B_name = $select_grade[2]->name;
  //           $B_weightage = $select_grade[2]->weightage;

  //           $C_name = $select_grade[3]->name;
  //           $C_weightage = $select_grade[3]->weightage;

  //           $D_name = $select_grade[4]->name;
  //           $D_weightage = $select_grade[4]->weightage;

  //           $U_name = $select_grade[5]->name;
  //           $U_weightage = $select_grade[5]->weightage;

  //           if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
  //               $grade_Aplus = $Aplus_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
  //           }

  //           if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
  //               $grade_A = $A_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
  //           }
            
  //           if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
  //               $grade_B = $B_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
  //           }

  //           if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
  //               $grade_C = $C_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
  //           }

  //           if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
  //               $grade_D = $D_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_D,1,0,'C', 1);
  //           }

  //           if($marks_Total < intval($U_weightage)){
  //               $grade_U = $U_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_U,1,0,'C', 1);
  //           }

  //           $pdf->SetFillColor(255,255,255);
  //           $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
  //           $pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L',1);

  //           //=======================End======================//

  //                       if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
  //                       $grade_Aplus = $Aplus_name;
  //                       $A_plus_total = $A_plus_total+1;
  //                   }

  //                   if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
  //                       $grade_A = $A_name;
  //                       $A_total = $A_total + 1 ;
  //                   }
                    
  //                   if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
  //                       $grade_B = $B_name;
  //                       $B_total = $B_total + 1;
  //                   }

  //                   if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
  //                       $grade_C = $C_name;
  //                       $C_total = $C_total + 1;
  //                   }

  //                   if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
  //                       $grade_D = $D_name;
  //                       $D_total = $D_total + 1;
  //                   }

  //                   if($marks_Total < intval($U_weightage)){
  //                       $grade_U = $U_name;
  //                       $U_total = $U_total + 1;
                        
  //                   }



  //       	$i += $student_CH;
  //       	$counter++;
  //       	$arr_y++;
  //       }



  //       /************************************************* Student Ranking
  //       /******************************************************************/
  //       $i=0;
  //       for($j=0; $j<$noOfStudents; $j++){
  //       	$studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
  //       	$pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
		// 	$i += $student_CH;
  //       }
  //       /******************************************************************/









  //       /********************************************* Average Computation
  //       /******************************************************************/
  //       $z = -7;
  //       $showMarks = 0;
  //       $pdf->SetXY($student_X+22,$student_Y+$i);
  //   	$pdf->Cell(45,$student_CH,'Average',1,0,'R');
  //   	$pdf->SetXY($student_X+22,$student_Y+$i+4);
  //   	$pdf->Cell(45,$student_CH,'Above Average',1,0,'R');
  //   	$pdf->SetXY($student_X+22,$student_Y+$i+8);
  //   	$pdf->Cell(45,$student_CH,'Below Average',1,0,'R');

  //   	$AboveAverageCount = 0;
  //   	$BelowAverageCount = 0;
  //       for($x=0; $x<$noOfAssessments; $x++){	// No of Assessment
  //       	$showMarks = 0;
  //       	$AboveAverageCount = 0;
  //   		$BelowAverageCount = 0;
  //       	for($y=0; $y<$noOfStudents; $y++){	// No of Students
  //       		$showMarks += $totalMarks[$y][$x];
  //       	}



  //       	if($this->data['assessment_titles'][$x]->this_order==1){
  //       		$pdf->SetFillColor(255,255,255);
  //       	}else {
  //       		$pdf->SetFillColor(175,175,175);
  //       	}
  //       	if($noOfStudents==0){
  //       		$showMarks=0;
  //       	}else{
  //   			$showMarks = ROUND($showMarks / $noOfStudents, 1);        		
  //       	}
  //       	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

		// 	for($y=0; $y<$noOfStudents; $y++){	// No of Students
  //       		if($totalMarks[$y][$x] >= $showMarks){
  //       			$AboveAverageCount++;
  //       		}else if($totalMarks[$y][$x] < $showMarks){
		// 			$BelowAverageCount++;
		// 		}
  //       	}

        	
  //       	$pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
		// 	$pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
			
  //       	$pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
		// 	$pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
        	

		// 	$z+=7;

		// 	// Class Total Marks Average Axis Set

		// 	$assessment_total_x = $assessment_X + $z;
		// 	$assessment_total_y = $student_Y+$i;

		// 	// Above Total Marks Average Axis Set

		// 	$assessment_above_total_x = $assessment_X + $z;
		// 	$assessment_above_total_y = $student_Y+$i+4;

		// 	// Below Total Marks Average Axis Set

		// 	$assessment_below_total_x = $assessment_X + $z;
		// 	$assessment_below_total_y = $student_Y + $i + 8;	 
  //       }

  //               // Calculating Total Marks

  //       if($noOfStudents==0){
  //       	$no_round_of_marks_total = 0;
  //       }else{
  //       	$no_round_of_marks_total = ROUND($no_round_of_marks_total/$noOfStudents,1);
  //       }

  //       $pdf->SetFillColor(255,255,255);
  //       $pdf->SetXY($assessment_total_x,$assessment_total_y);
  //       $pdf->Cell(7,$student_CH,$no_round_of_marks_total,1,0,'C',1);

  //       $above_average = 0;

  //      	for($j=0;$j<sizeof($totalMarks_student);$j++){
  //      		if($totalMarks_student[$j]>=$no_round_of_marks_total){
  //      			$above_average++;
  //      			;
  //      		}

  //      	}

  //      	$pdf->SetXY($assessment_above_total_x,$assessment_above_total_y);
  //       $pdf->Cell(7,$student_CH,$above_average,1,0,'C',1);

  //       $below_average = 0;
  //       for($j=0;$j<sizeof($totalMarks_student);$j++){
  //       	if($totalMarks_student[$j] < $no_round_of_marks_total){
  //       		$below_average++;
  //       	}
  //       }

  //       $pdf->SetXY($assessment_below_total_x,$assessment_below_total_y);
  //       $pdf->Cell(7,$student_CH,$below_average,1,0,'C',1);

  //       /******************************************************************/

  //       /********************************GRADE RANK ***********************/
  //       /******************************************************************/

  //       $classAssGrade = array();

  //       $cellHeight = 5;
  //       $cellWidth = 21;

  //       $pdf->SetFillColor(255,255,255);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





  //       //A++
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

  //       if($Aplus_name == 'A+'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
  //       }



  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



  //       //A
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

  //       if($A_name == 'A'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




  //       //B
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

  //       if($B_name == 'B'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
  //       }

  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);




  //       //C
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

  //       if($C_name == 'C'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

 


  //       //D
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

  //       if($D_name == 'D'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$D_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$D_total,1,0,'C',1);


  //       //U

  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

  //       if($U_name == 'U'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Below '.$U_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$U_total,1,0,'C',1);


  //       /******************************************************************/

  //       /****************************************Report Footer**************
		// *********************************************************/
		// $page_height = $pdf->h;	
  //       $this->load->model('staff/staff_registered_model');
		// $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		// $pdf->SetFillColor(0,0,0);
		// $pdf->SetTextColor(255,255,255);
  //   	$pdf->SetXY(7,$page_height-30);
  //   	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

			



		

		// // Output the new PDF
		// $pdf->Output('Assessment_Report' . '.pdf', 'I');   
  //   }	





      public function show_Assessment_Report_PDF(){
        
        $user_id = $this->input->get("user_id");
        $role_id = $this->input->get("role_id");
        $sectionID = $this->input->get("sectionID");
        $gradeID = $this->input->get("gradeID");
        $optional = $this->input->get("optional");
        
        $prgmID = $this->input->get("prgmID");
        $gpp_id = $this->input->get("gpp_id");
        $academic = $this->input->get("academic");
        $term = $this->input->get("term");
        $subjectID = $this->input->get("subjectID");




        $this->load->model('atif_sp/assessment_report_model');
        $GroupID = 0;
        $BlockID = 0;



        /**************************** Assessment Titles 
        /***********************************************/
        $this->data['assessment_titles'] = $this->assessment_report_model->get_grade_subject_assessments($gradeID, $subjectID, $role_id, $term);
        /******************************** Students Data 
        /***********************************************/
        if($optional == 0){
        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
        }else{
        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
        	if($GroupID == 'A'){$GroupID=1;}else
        	if($GroupID == 'B'){$GroupID=2;}else
        	if($GroupID == 'C'){$GroupID=3;}else
        	if($GroupID == 'D'){$GroupID=4;}else
        	if($GroupID == 'E'){$GroupID=5;}else
        	if($GroupID == 'F'){$GroupID=6;}

        	$BlockID = substr($gpp_id, -1);

        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
        }
        /***************************** Assessment Marks
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_assessments_marks($gradeID, $sectionID, $subjectID, $role_id, $term);
	    }else{
	    	$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_assessments_aggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);

	    }else{
	    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_aggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

	    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);


    	// FOR JUNOIRS	
	    if($gradeID >= 6 && $gradeID <= 9){

	    $A_plus_total = 0;
    	$A_total = 0;
    	$B_plus_total = 0;
    	$B_total = 0;
    	$C_plus_total = 0;
    	$C_total = 0;		
	    		
	    
	    }else{

    	$A_plus_total = 0;
    	$A_total = 0;
    	$B_total = 0;
    	$C_total = 0;
    	$D_total = 0;
    	$U_total = 0;

    	}






     	


     	// Overall Font Size
		$font_size = 8;
		$font_name = 'Helvetica'; //Helvetica
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$border = 1;

	



		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		if($noOfAssessments <= 27){
			$pdf = new PDF('L', 'mm', 'A4');
		}
		if($noOfAssessments > 27 and $noOfAssessments <= 30){
			//$pdf = new PDF('L', 'mm', 'A3');
			$pdf = new PDF('L','mm',array(270,370));
		}
		else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		{
			$pdf = new PDF('L','mm',array(300,400));
		}
		else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		{
			$pdf = new PDF('L','mm',array(350,450));

		}
		else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
			$pdf = new PDF('L','mm',array(400,500));

		}
		else if($noOfAssessments > 39 and $noOfAssessments <=42)
		{
			$pdf = new PDF('L','mm',array(450,550));
		}else{
			$pdf = new PDF('L','mm', 'A3');
		}

		$pdf->AddPage();
		$pdf->SetFont($font_name,'',$font_size);
		$i = 0;



		$borderon = 0;
		$rptheading_X = 7;
		$rptheading_Y = 7;
		$rptheading_CW = 65;
		$rptheading_CH = 10;
		
		if(empty($this->data['assessment_marks'][0]->subject_name)){
			$subject_name = '';
		}else{
			$subject_name = $this->data['assessment_marks'][0]->subject_name;
		}
		



		$assessment_X = 81;
		$assessment_Y = 7;

		$student_X = 7;
		$student_Y = 57;
		$student_CH = 4;



		/**************************************************** Report Heading
		*********************************************************************/
		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

		$heading_font_name = 'CooperBT-Black';
		$heading_font_size = 12;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($rptheading_X,$rptheading_Y);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'L');


    	$heading_font_name = 'Helvetica';
		$heading_font_size = 10;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->Cell($rptheading_CW,$rptheading_CH-5,"Formative Report",$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

		/*************************************************** Assessment Titles
		***********************************************************************/




		/*************************************************** Assessment Titles
		***********************************************************************/
		foreach ($this->data['assessment_titles'] as $data) {

			$lastx = 0;
			$lasty = 0;

			$col = $data->full_name;

		   	// $pdf->Cell($X,$Y,,$border);

			if($data->this_order == 2){
				// Fill Grey
				$pdf->SetFillColor(175,175,175);
			}else{
				// Fill White
				$pdf->SetFillColor(255,255,255);
			}
		   	$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

		   	$i += $assessment_Y;		
		}
		$pdf->SetFillColor(255,255,255);
		$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+21,$assessment_Y,50,7,'Grades',1,0,'R',270,1);
		$pdf->SetFont($font_name,'B',$font_size);
		$pdf->SetXY($assessment_X+$i+21,$student_Y-$student_CH);
		$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');









		/******************************************************** Student Info
		***********************************************************************/
		$i = 0;
		$counter = 1;
		$marks_Total = 0;
		$no_round_of_marks_total = 0;
		$totalMarks_student = array();


		// Heading
    	$pdf->SetFont($font_name,'B',$font_size);
    	$pdf->SetXY($student_X,$student_Y-$student_CH);
    	$pdf->Cell(7,$student_CH,'Sr',1,0,'C');
    	$pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
    	$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
    	$pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





    	$arr_y=0;
    	$arr_x=0;

    	if($gradeID >= 6 && $gradeID <= 9){

    	$A_plus_name = '';
    	$A_name = '';
    	$B_plus_name = '';
    	$B_name = '';
    	$C_plus_name = '';
    	$C_name = '';	

    	}else{
    	$Aplus_name = '';
		$A_name = '';
		$B_name = '';
		$C_name = '';
		$D_name = '';
		$U_name = '';
		}
        
		foreach ($this->data['students_gs_data'] as $data) {

			$arr_x=0;
			$font_size = 7;
			$marks_Total = 0;
        	// Data
        	$pdf->SetFillColor(255,255,255); 
        	$pdf->SetFont($font_name,'',$font_size);
        	$pdf->SetXY($student_X,$student_Y+$i);
        	$pdf->Cell(7,$student_CH,$counter,1,0,'C');
        	$pdf->Cell(15,$student_CH,$data->gs_id,1,0,'C');
        	$pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L');
        	$pdf->Cell(15,$student_CH,$data->std_status_code,1,0,'C');



        	$z = -7;
        	$font_size = 8;
        	foreach ($this->data['assessment_titles'] as $title) {
        		if($title->this_order == '1'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->ass_detail_id == $title->assessment_type_id
        					&& $marks->marks_obtained > 0){

        					$marksObtained = $marks->marks_obtained;
        				}
        			}

        			$pdf->SetFillColor(255,255,255);
        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
        			$totalMarks[$arr_y][$arr_x] = $marksObtained;

        		}else if($title->this_order == '2'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_agg_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->assessment_id == $title->assessment_type_id
        					&& $marks->aggrAssessment > 0){

        					$marksObtained = $marks->aggrAssessment;
        				}
        			}

        			$marks_Total += $marksObtained;
        			$pdf->SetFillColor(175,175,175);
        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
        			$totalMarks[$arr_y][$arr_x] = $marksObtained;       			
        		}
        		$z+=7;
        		$arr_x++;				
        	}

        	$no_round_of_marks_total += $marks_Total;
        	$totalMarks_student[$arr_y] = $marks_Total;

			$marks_Total = ROUND(($marks_Total), 1);        	
			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C'); 

			$marks_Total = ROUND(($marks_Total), 0);        	
			$pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C');

			$student_totalMarks[$arr_y] = $marks_Total;


			if($gradeID >= 6 && $gradeID <= 9){
			// Junior Section
			//var_dump($select_grade);
			$A_plus_name = $select_grade[0]->name;
            $Aplus_weightage = $select_grade[0]->weightage;

            $A_name = $select_grade[1]->name;
            $A_weightage = $select_grade[1]->weightage;

            $B_name = $select_grade[2]->name;
            $B_weightage = $select_grade[2]->weightage;

            $C_name = $select_grade[3]->name;
            $C_weightage = $select_grade[3]->weightage;

            $B_plus_name = $select_grade[6]->name;
            $B_plus_weightage = $select_grade[6]->weightage;

            $C_plus_name = $select_grade[7]->name;
            $C_plus_weightage = $select_grade[7]->weightage;

            if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
                $grade_Aplus = $A_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
            }

            if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
            }
            
            if($marks_Total >= intval($B_plus_weightage) && $marks_Total < $A_weightage){
                $grade_B_plus = $B_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B_plus ,1,0,'C', 1);
            }

            if($marks_Total >= intval($B_weightage) && $marks_Total < $B_plus_weightage){
                $grade_B = $B_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
            }

            if($marks_Total >= intval($C_plus_weightage) && $marks_Total < $B_weightage){
                $grade_C_plus = $C_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C_plus,1,0,'C', 1);
            }

            if($marks_Total < intval($C_weightage)){
                $grade_C = $C_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
            }

            $pdf->SetFillColor(255,255,255);
            $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
            $pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L',1);

            //=======================End======================//

			}else{


			//======================Grading Middler,Senior =====================//
			$Aplus_name = $select_grade[0]->name;
            $Aplus_weightage = $select_grade[0]->weightage;

            $A_name = $select_grade[1]->name;
            $A_weightage = $select_grade[1]->weightage;

            $B_name = $select_grade[2]->name;
            $B_weightage = $select_grade[2]->weightage;

            $C_name = $select_grade[3]->name;
            $C_weightage = $select_grade[3]->weightage;

            $D_name = $select_grade[4]->name;
            $D_weightage = $select_grade[4]->weightage;

            $U_name = $select_grade[5]->name;
            $U_weightage = $select_grade[5]->weightage;

            if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
            }

            if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
            }
            
            if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
                $grade_B = $B_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
            }

            if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
                $grade_C = $C_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
            }

            if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_D,1,0,'C', 1);
            }

            if($marks_Total < intval($U_weightage)){
                $grade_U = $U_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_U,1,0,'C', 1);
            }

            $pdf->SetFillColor(255,255,255);
            $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
            $pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L',1);

            //=======================End======================//
        }// End Else

        if($gradeID >= 3 && $gradeID <= 9){

        if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
            $grade_Aplus = $A_plus_name;
            $A_plus_total = $A_plus_total+1;
        }

         if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
            $grade_A = $A_name;
            $A_total = $A_total + 1 ;
         }
         
         if($marks_Total >= intval($B_plus_weightage) && $marks_Total < $A_weightage){
            $grade_B_plus = $B_plus_name;
            $B_plus_total = $B_plus_total + 1;
         }

         if($marks_Total >= intval($B_weightage) && $marks_Total < $B_plus_weightage){
            $grade_B = $B_name;
                
            $B_total = $B_total + 1;
         }

         if($marks_Total >= intval($C_plus_weightage) && $marks_Total < $B_weightage){
            $grade_C_plus = $C_plus_name;
            $C_plus_total = $C_plus_total + 1;
         }

         if($marks_Total < intval($C_weightage)){
            $grade_C = $C_name;
            $C_total = $C_total + 1;
                
         }

        }else{

    	        if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
                    $grade_Aplus = $Aplus_name;
                    $A_plus_total = $A_plus_total+1;
                }

                if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
                    $grade_A = $A_name;
                    $A_total = $A_total + 1 ;
                }
                
                if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
                    $grade_B = $B_name;
                    $B_total = $B_total + 1;
                }

                if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
                    $grade_C = $C_name;
                    $C_total = $C_total + 1;
                }

                if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
                    $grade_D = $D_name;
                    $D_total = $D_total + 1;
                }

                if($marks_Total < intval($U_weightage)){
                    $grade_U = $U_name;
                    $U_total = $U_total + 1;
                    
                }

        } // END IF




        	$i += $student_CH;
        	$counter++;
        	$arr_y++;
        }



        /************************************************* Student Ranking
        /******************************************************************/
        $i=0;
        for($j=0; $j<$noOfStudents; $j++){
        	$studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
        	$pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
			$i += $student_CH;
        }
        /******************************************************************/









        /********************************************* Average Computation
        /******************************************************************/
        $z = -7;
        $showMarks = 0;
        $pdf->SetXY($student_X+22,$student_Y+$i);
    	$pdf->Cell(45,$student_CH,'Average',1,0,'R');
    	$pdf->SetXY($student_X+22,$student_Y+$i+4);
    	$pdf->Cell(45,$student_CH,'Above Average',1,0,'R');
    	$pdf->SetXY($student_X+22,$student_Y+$i+8);
    	$pdf->Cell(45,$student_CH,'Below Average',1,0,'R');

    	$AboveAverageCount = 0;
    	$BelowAverageCount = 0;
        for($x=0; $x<$noOfAssessments; $x++){	// No of Assessment
        	$showMarks = 0;
        	$AboveAverageCount = 0;
    		$BelowAverageCount = 0;
        	for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		$showMarks += $totalMarks[$y][$x];
        	}



        	if($this->data['assessment_titles'][$x]->this_order==1){
        		$pdf->SetFillColor(255,255,255);
        	}else {
        		$pdf->SetFillColor(175,175,175);
        	}
        	if($noOfStudents==0){
        		$showMarks=0;
        	}else{
    			$showMarks = ROUND($showMarks / $noOfStudents, 1);        		
        	}
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

			for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		if($totalMarks[$y][$x] >= $showMarks){
        			$AboveAverageCount++;
        		}else if($totalMarks[$y][$x] < $showMarks){
					$BelowAverageCount++;
				}
        	}

        	
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
			$pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
			
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
			$pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
        	

			$z+=7;

			// Class Total Marks Average Axis Set

			$assessment_total_x = $assessment_X + $z;
			$assessment_total_y = $student_Y+$i;

			// Above Total Marks Average Axis Set

			$assessment_above_total_x = $assessment_X + $z;
			$assessment_above_total_y = $student_Y+$i+4;

			// Below Total Marks Average Axis Set

			$assessment_below_total_x = $assessment_X + $z;
			$assessment_below_total_y = $student_Y + $i + 8;	 
        }

                // Calculating Total Marks

        if($noOfStudents==0){
        	$no_round_of_marks_total = 0;
        }else{
        	$no_round_of_marks_total = ROUND($no_round_of_marks_total/$noOfStudents,1);
        }

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($assessment_total_x,$assessment_total_y);
        $pdf->Cell(7,$student_CH,$no_round_of_marks_total,1,0,'C',1);

        $above_average = 0;

       	for($j=0;$j<sizeof($totalMarks_student);$j++){
       		if($totalMarks_student[$j]>=$no_round_of_marks_total){
       			$above_average++;
       			;
       		}

       	}

       	$pdf->SetXY($assessment_above_total_x,$assessment_above_total_y);
        $pdf->Cell(7,$student_CH,$above_average,1,0,'C',1);

        $below_average = 0;
        for($j=0;$j<sizeof($totalMarks_student);$j++){
        	if($totalMarks_student[$j] < $no_round_of_marks_total){
        		$below_average++;
        	}
        }

        $pdf->SetXY($assessment_below_total_x,$assessment_below_total_y);
        $pdf->Cell(7,$student_CH,$below_average,1,0,'C',1);

        /******************************************************************/

        /********************************GRADE RANK ***********************/
        /******************************************************************/

        // For Juniors	
        if($gradeID >= 6 && $gradeID <= 9){

        $classAssGrade = array();

        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($A_plus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B+',1,0,'C',1);

        if($B_plus_name == 'B+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_plus_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_plus_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);

 


        //C+
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C+',1,0,'C',1);

        if($C_plus_name == 'C+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_plus_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_plus_total,1,0,'C',1);


        //C

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

        }else{	

        // For Seniors
        $classAssGrade = array();


        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($Aplus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);




        //C
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

 


        //D
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

        if($D_name == 'D'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$D_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$D_total,1,0,'C',1);


        //U

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

        if($U_name == 'U'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$U_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$U_total,1,0,'C',1);

        }


        /******************************************************************/

        /****************************************Report Footer**************
		*********************************************************/
		$page_height = $pdf->h;	
        $this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-30);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

			



		

		// Output the new PDF
		$pdf->Output('Assessment_Report' . '.pdf', 'I');   
    }








    public function getThisProgramAssessment_PDF(){
    	$html = '';


    	$user_id = $this->input->post("user_id");
        $role_id = $this->input->post("role_id");
        $sectionID = $this->input->post("sectionID");
        $gradeID = $this->input->post("gradeID");
        $optional = $this->input->post("optional");
        //$GPID = $this->input->post("GPID");
        $prgmID = $this->input->post("prgmID");
        $gpp_id = $this->input->post("gpp_id");
        $academic = $this->input->post("academic");
        $term = $this->input->post("term");
        $subjectID = $this->input->post("subjectID");

        
        $groupID = '0';
        $blockID = '0';
        if(substr(substr($gpp_id,-3),1) != '0'){
        	$groupID = substr(substr($gpp_id,-3),1);
        	$blockID = substr($gpp_id,1);
        }

        //var_dump($_POST);


    	$html .= '<style>
		.unit_report_pdf_iframe {
			position: relative;
			padding-bottom: 65.25%;
			padding-top: 30px;
			height: 0;
			overflow: auto; 
			-webkit-overflow-scrolling:touch; //<<--- THIS IS THE KEY 
			border: solid black 1px;
			} 
			.unit_report_pdf_iframe iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 90%;
		}
		</style>';


		$helper = 'user_id='.$user_id.'&role_id='.$role_id.'&sectionID='.$sectionID.'&optional='.$optional.'&prgmID='.$prgmID.'&gpp_id='.$gpp_id.'&academic='.$academic.'&term='.$term.'&subjectID='.$subjectID.'&gradeID='.$gradeID.'&groupID='.$groupID.'&blockID='.$blockID;


		$html .= '
		<div class="unit_report_pdf_iframe">
			<iframe src="'.site_url().'/ajax/station_process/show_Assessment_Report_PDF?'.$helper.'" frameborder="0">
			</iframe>
		</div>';

		
    	echo $html;
    }	
	
	
	
	
	
	

/* Summative */
	public function getSummativeInfo(){
        
        $user_id = $this->input->post("user_id");
        $role_id = $this->input->post("role_id");
        $sectionID = $this->input->post("sectionID");
        $gradeID = $this->input->post("gradeID");
        $optional = $this->input->post("optional");
        //$GPID = $this->input->post("GPID");
        $prgmID = $this->input->post("prgmID");
        $gpp_id = $this->input->post("gpp_id");
        $academic = $this->input->post("academic");
        $term = $this->input->post("term");
        $subjectID = $this->input->post("subjectID");
		$this->load->model('atif_sp/assessment_report_model');
		$GroupID = 0;
        $BlockID = 0;
		$mainCategory = 2;

		/**************************** Assessment Titles 
        /***********************************************/
		
		$this->data['assessment_titles'] = $this->assessment_report_model->getSummativeAss($gradeID, $subjectID, $role_id, $term,$mainCategory,$academic);
		//$this->data['assessment_titles'] = '';
		
		/******************************** Students Data 
        /***********************************************/
        if($optional == 0){
			$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
        }else{
			
        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
			
			if($GroupID == 'A'){$GroupID=1;}else
        	if($GroupID == 'B'){$GroupID=2;}else
        	if($GroupID == 'C'){$GroupID=3;}else
        	if($GroupID == 'D'){$GroupID=4;}else
        	if($GroupID == 'E'){$GroupID=5;}else
        	if($GroupID == 'F'){$GroupID=6;}

        	$BlockID = substr($gpp_id, -1);

        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
        }
        /***************************** Assessment Marks
        /***********************************************/
        if($optional == 0){
	      
			
			 $this->data['assessment_marks'] = $this->assessment_report_model->getGrdSbjctAssmntMarks( $gradeID, $sectionID, $subjectID, $role_id, $term,$academic, $mainCategory);
			
			
	    }else{
	    	//$this->data['assessment_marks'] = $this->assessment_report_model->get_grade_subject_optional_assessments_marks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
			
			$this->data['assessment_marks'] = $this->assessment_report_model->grdSbjtOptAssMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term,$mainCategory);
			

	    }

        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
			
	        $this->data['assessment_agg_marks'] = $this->assessment_report_model->grdSbjctAssmntAggMarks($gradeID, $sectionID, $subjectID, $role_id, $term,$academic, $mainCategory);
			
			
			
			
	    }else{
			
	    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->grdSbjtOptAssAggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term,$academic, $mainCategory);
			
		}
        //var_dump($_POST);


        $table_header = '';
        $table_footer = '';
        $table_body = '';
        $student_marks_head_counter = 0;


        $html = '';

        $table_header .= '
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.">S.No.</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GS-ID">GS-ID</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Abridged Name">Abridged Name</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Call Name">Call Name</th>
    	<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Status">Status</th>
        ';
        $table_footer .= '
        <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS-ID" class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter Call Name" class="search_init"></th>
        <th rowspan="1" colspan="1"><input type="text" name="filter_status" placeholder="Filter Status" class="search_init"></th>
        ';





        $table_header_counter = 0;
        foreach ($this->data['assessment_titles'] as $data) {
        	$table_header .= '
        		<th class="sorting_asc" role="columnheader" tabindex="'.$table_header_counter.'"  aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.">'.$data->full_name.'</th>
        	';

        	$table_footer .= '
        		<th rowspan="1" colspan="1"><input type="text" name="filter_"'.$data->assessment_type_id.' placeholder="Filter '.$data->full_name.'" class="search_init"></th>
        	';

        	if($data->this_order == '1'){$student_marks_head_counter++;}
        	$table_header_counter++;
        }
        $table_header .='<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Total Marks">Total (100)</th>';
        $table_header .='<th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="subject_assessment_marks_table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Percentage">Percentage</th>';
        

        $table_footer .= '<th rowspan="1" colspan="1"><input type="text" name="filter_totalMarks" placeholder="Filter Total Marks" class="search_init"></th>';
        $table_footer .= '<th rowspan="1" colspan="1"><input type="text" name="filter_percentage" placeholder="Filter Percentage" class="search_init"></th>';



        $y=1;
        $cell = '';
        $bgColor = '';
        $marks_Total = 0;
        $marksObtained = 0;
        foreach ($this->data['students_gs_data'] as $data) {

        	$cell = '';
        	$marks_Total = 0;
        	$bgColor = 'style="background-color: ' . $this->assessment_report_model->getBGColor($y) . ';"';
        	$table_body .= '<tr class="odd">';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$y.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->gs_id.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->abridged_name.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->call_name.'</td>';
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$data->std_status_code.'</td>';


        	foreach ($this->data['assessment_titles'] as $title) {
        		if($title->this_order == '1'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->ass_detail_id == $title->assessment_type_id
        					&& $marks->marks_obtained > 0){

        					$marksObtained = $marks->marks_obtained;
        				}
        			}
    				$cell .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$marksObtained.'</td>';
        			
        		}else if($title->this_order == '2'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_agg_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->assessment_id == $title->assessment_type_id
        					&& $marks->aggrAssessment > 0){

        					$marksObtained = $marks->aggrAssessment;
        				}
        			}

        			$cell .= '<td class=" sorting_1 centered-cell" style="background-color: #f5f5f5 !important;">'.$marksObtained.'</td>';
        			$marks_Total += $marksObtained;
        		}

				
        	}


        	$table_body .= $cell;
        	$marks_Total = ROUND($marks_Total, 1);
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$marks_Total.'</td>';
        	$marks_Total = ROUND($marks_Total, 0);
        	$table_body .= '<td class=" sorting_1 centered-cell" '.$bgColor.'>'.$marks_Total.'</td>';
        	$table_body .= '</tr>';


        	$y++;
        }
	$html .= '
        <style>
        	.close_setup_4 {
        		float: right;
        	}
        </style>
        ';

		$html .= '<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
		<div class="powerwidget purple" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
              <header role="heading">
                <i class="fa fa-tasks"></i> Report : '.$gpp_id . '
                <div class="powerwidget-ctrls" role="menu">
                  <h3>
                  	<span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor" style="top: -11px;"></span>
                  </h3>
                </div>
                <span class="powerwidget-loader"></span>
              </header>
			<div class="inner-spacer" role="content">
                <div id="staff_edit_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
					<table class="display table table-striped table-hover dataTable" id="subject_assessment_marks_table" aria-describedby="staff_info">
						<thead>
							<tr role="row">';
								$html .= $table_header;
								$html .= '</tr>
						</thead>
						<tfoot>
                      <tr>';
                      
                      $html .= $table_footer;

            $html .= '</tr>
                    </tfoot>

                  <tbody role="alert" aria-live="polite" aria-relevant="all">';

                  $html .= $table_body;

            $html .= '</tbody>
                </table>
              </div>
            </div>
          </div>
        </div>';


        

		$html .='
		<script>
		
			if ($("#subject_assessment_marks_table").length) {
                var oTable = $("#subject_assessment_marks_table").dataTable({
                    "oLanguage": {
                        "sSearch": "Search all columns:"                        
                    },
                    "sDom": ' . "'" . 'T<"clear">lfrtip' . "'" . ',
                    tableTools: {
                        "sSwfPath": "' . base_url() . 'components/js/swf/copy_csv_xls_pdf.swf"
                    },
                    "bProcessing": true,
                    "sScrollX": "100%",
                    "bScrollCollapse": true,
                    "iDisplayLength": 50,
                    "fixedHeader": true
                });                

                $("tfoot input").keyup(function () {
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });


                $("tfoot input").each(function (i) {
                    asInitVals[i] = this.value;
                });

                $("tfoot input").focus(function () {
                    if (this.className == "search_init") {
                        this.className = "";
                        this.value = "";
                    }
                });

                $("tfoot input").blur(function (i) {
                    if (this.value === "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
                
            }
        
		</script>
		';


		echo $html;
        
    } // end here
/* End summative*/


    // update detail to ignore or accomplished
	
		
		
		
		
	public function ignoreAccomplish(){
		
		$this->load->model('etab/teacher_side/teacher_side_model', 'ETS');
		
		$detailedID = (int)$this->input->post("detailedID");
		$actionToForm = (int)$this->input->post("actionToForm");
		
		
		if( $actionToForm == 3 ){
			$ignore = 1;
		}elseif( $actionToForm == 4 ){
			$ignore = 0;
		}else{
			$ignore = 0;
		}
		
		$db = "subject_grade";
		$table = "assessment_detail";
		$data = array("ignore" => $ignore );
		$return = $this->ETS->replace2($db,$table,$data,$detailedID);
		echo json_encode( array( "res" => $return ) );
	}
	
	
	
	
	/*
		* Function for create report in PDF Formate
		* 
	*/
  //   public function CreateReportPDF(){
        
  //       $user_id = $this->input->get("user_id");
  //       $role_id = $this->input->get("role_id");
  //       $sectionID = $this->input->get("sectionID");
  //       $gradeID = $this->input->get("gradeID");
  //       $optional = $this->input->get("optional");
        
  //       $prgmID = $this->input->get("prgmID");
  //       $gpp_id = $this->input->get("gpp_id");
  //       $academic = $this->input->get("academic");
  //       $term = $this->input->get("term");
  //       $subjectID = $this->input->get("subjectID");






  //       $this->load->model('atif_sp/assessment_report_model');
  //       $GroupID = 0;
  //       $BlockID = 0;


  //       $mainCategory = 2;
  //       $total_formative_summative = 0;
  //       /**************************** Assessment Titles 
  //       /***********************************************/
  //       $this->data['assessment_titles'] = $this->assessment_report_model->getSummativeAss($gradeID, $subjectID, $role_id, $term,$mainCategory,$academic);
  //       /******************************** Students Data 
  //       /***********************************************/
  //       if($optional == 0){
  //       	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
  //       }else{
  //       	$GroupID = substr(substr($gpp_id, -3), 0, 1);
  //       	if($GroupID == 'A'){$GroupID=1;}else
  //       	if($GroupID == 'B'){$GroupID=2;}else
  //       	if($GroupID == 'C'){$GroupID=3;}else
  //       	if($GroupID == 'D'){$GroupID=4;}else
  //       	if($GroupID == 'E'){$GroupID=5;}else
  //       	if($GroupID == 'F'){$GroupID=6;}

  //       	$BlockID = substr($gpp_id, -1);

  //       	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
  //       }
  //       /***************************** Assessment Marks
  //       /***********************************************/
  //       if($optional == 0){
	 //       $this->data['assessment_marks'] = $this->assessment_report_model->getGrdSbjctAssmntMarks( $gradeID, $sectionID, $subjectID, $role_id, $term,$academic, $mainCategory);
	 //    }else{
	 //    	$this->data['assessment_marks'] = $this->assessment_report_model->grdSbjtOptAssMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id,$term);
	 //    }



  //       /******************* Assessment Aggregate Marks 
  //       /***********************************************/
  //       if($optional == 0){
	 //        $this->data['assessment_agg_marks'] = $this->assessment_report_model->grdSbjctAssmntAggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);

	 //    }else{
	 //    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->grdSbjtOptAssAggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	 //    }

	 //    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	 //    $noOfStudents = sizeof($this->data['students_gs_data']);
  //   	$noOfAssessments = sizeof($this->data['assessment_titles']);
  //   	$A_plus_total = 0;
  //   	$A_total = 0;
  //   	$B_total = 0;
  //   	$C_total = 0;
  //   	$D_total = 0;
  //   	$U_total = 0;






     	


  //    	// Overall Font Size
		// $font_size = 8;
		// $font_name = 'Helvetica'; //Helvetica
		// $gender_mark_size = 26;
		// $now_date = date('d-M-Y');
		// $border = 1;

	



		// require_once('components/pdf/fpdf/fpdf_rotate.php');
		// require_once('components/pdf/fpdi/fpdi.php');

		


		
		// // initiate FPDI
		// if($noOfAssessments <= 27){
		// 	$pdf = new PDF('L', 'mm', 'A4');
		// }
		// if($noOfAssessments > 27 and $noOfAssessments <= 30){
		// 	//$pdf = new PDF('L', 'mm', 'A3');
		// 	$pdf = new PDF('L','mm',array(210,310));
		// }
		// else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		// {
		// 	$pdf = new PDF('L','mm',array(240,340));
		// }
		// else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		// {
		// 	$pdf = new PDF('L','mm',array(250,350));

		// }
		// else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
		// 	$pdf = new PDF('L','mm',array(270,370));

		// }
		// else if($noOfAssessments > 39 and $noOfAssessments <=42)
		// {
		// 	$pdf = new PDF('L','mm',array(300,400));
		// }else{
		// 	$pdf = new PDF('L','mm', 'A3');
		// }

		// $pdf->AddPage();
		// $pdf->SetFont($font_name,'',$font_size);
		// $i = 0;



		// $borderon = 0;
		// $rptheading_X = 7;
		// $rptheading_Y = 7;
		// $rptheading_CW = 65;
		// $rptheading_CH = 10;
		
		// if(empty($this->data['assessment_marks'][0]->subject_name)){
		// 	$subject_name = '';
		// }else{
		// 	$subject_name = $this->data['assessment_marks'][0]->subject_name;
		// }
		



		// $assessment_X = 81;
		// $assessment_Y = 7;

		// $student_X = 7;
		// $student_Y = 57;
		// $student_CH = 4;



		// /**************************************************** Report Heading
		// *********************************************************************/
		// $pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

		// $heading_font_name = 'CooperBT-Black';
		// $heading_font_size = 12;
		// $pdf->SetFont($heading_font_name,'',$heading_font_size);
  //   	$pdf->SetXY($rptheading_X,$rptheading_Y);
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'L');


  //   	$heading_font_name = 'Helvetica';
		// $heading_font_size = 10;
		// $pdf->SetFont($heading_font_name,'',$heading_font_size);
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH-5,"Summative Report",$borderon,2,'L');
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
  //   	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

		// /*************************************************** Assessment Titles
		// ***********************************************************************/




		// /*************************************************** Assessment Titles
		// ***********************************************************************/
		// foreach ($this->data['assessment_titles'] as $data) {

		// 	$lastx = 0;
		// 	$lasty = 0;

		// 	$col = $data->full_name;

		//    	// $pdf->Cell($X,$Y,,$border);

		// 	if($data->this_order == 2){
		// 		// Fill Grey
		// 		$pdf->SetFillColor(175,175,175);
		// 	}else{
		// 		// Fill White
		// 		$pdf->SetFillColor(255,255,255);
		// 	}
		//    	$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

		//    	$i += $assessment_Y;		
		// }
		// $pdf->SetFillColor(255,255,255);
		// $pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
		// $pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
		// $pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);
		// $pdf->RotatedCell($assessment_X+$i+21,$assessment_Y,50,7,'Grades',1,0,'R',270,1);
		
		// $pdf->SetFont($font_name,'B',$font_size);
		// $pdf->SetXY($assessment_X+$i+21,$student_Y-$student_CH);
		// $pdf->Cell(30,$student_CH,'Student Name',1,0,'L');









		// /******************************************************** Student Info
		// ***********************************************************************/
		// $i = 0;
		// $counter = 1;
		// $marks_Total = 0;


		// // Heading
  //   	$pdf->SetFont($font_name,'B',$font_size);
  //   	$pdf->SetXY($student_X,$student_Y-$student_CH);
  //   	$pdf->Cell(7,$student_CH,'Sr',1,0,'C');
  //   	$pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
  //   	$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
  //   	$pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





  //   	$arr_y=0;
  //   	$arr_x=0;

        
		// foreach ($this->data['students_gs_data'] as $data) {

		// 	$arr_x=0;
		// 	$font_size = 7;
		// 	$marks_Total = 0;
  //       	// Data
  //       	$pdf->SetFillColor(255,255,255); 
  //       	$pdf->SetFont($font_name,'',$font_size);
  //       	$pdf->SetXY($student_X,$student_Y+$i);
  //       	$pdf->Cell(7,$student_CH,$counter,1,0,'C');
  //       	$pdf->Cell(15,$student_CH,$data->gs_id,1,0,'C');
  //       	$pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L');
  //       	$pdf->Cell(15,$student_CH,$data->std_status_code,1,0,'C');



  //       	$z = -7;
  //       	$font_size = 8;
  //       	foreach ($this->data['assessment_titles'] as $title) {
  //       		if($title->this_order == '1'){
  //       			$marksObtained = 0;
  //       			foreach ($this->data['assessment_marks'] as $marks) {
  //       				if($marks->gs_id == $data->gs_id
  //       					&& $marks->ass_detail_id == $title->assessment_type_id
  //       					&& $marks->marks_obtained > 0){

  //       					$marksObtained = $marks->marks_obtained;
  //       				}
  //       			}

  //       			$pdf->SetFillColor(255,255,255);
  //       			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
  //       			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
  //       			$totalMarks[$arr_y][$arr_x] = $marksObtained;

  //       		}else if($title->this_order == '2'){
  //       			$marksObtained = 0;
  //       			//var_dump($this->data['assessment_agg_marks']);
  //       			foreach ($this->data['assessment_agg_marks'] as $marks) {
  //       				if($marks->gs_id == $data->gs_id
  //       					&& $marks->assessment_id == $title->assessment_type_id
  //       					&& $marks->aggrAssessment > 0){

  //       					$marksObtained = $marks->aggrAssessment;
  //       				}
  //       			}

  //       			$marks_Total += $marksObtained;
  //       			$pdf->SetFillColor(175,175,175);
  //       			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
  //       			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
  //       			$totalMarks[$arr_y][$arr_x] = $marksObtained;       			
  //       		}
  //       		$z+=7;
  //       		$arr_x++;				
  //       	}


		// 	$marks_Total = ROUND($marks_Total, 1);        	
		// 	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C'); 

		// 	$marks_Total = ROUND($marks_Total, 0);        	
		// 	$pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C');

		// 	$student_totalMarks[$arr_y] = $marks_Total;


		// 	//======================Grading =====================//

		// 	$Aplus_name = $select_grade[0]->name;
  //           $Aplus_weightage = $select_grade[0]->weightage;

  //           $A_name = $select_grade[1]->name;
  //           $A_weightage = $select_grade[1]->weightage;

  //           $B_name = $select_grade[2]->name;
  //           $B_weightage = $select_grade[2]->weightage;

  //           $C_name = $select_grade[3]->name;
  //           $C_weightage = $select_grade[3]->weightage;

  //           $D_name = $select_grade[4]->name;
  //           $D_weightage = $select_grade[4]->weightage;

  //           $U_name = $select_grade[5]->name;
  //           $U_weightage = $select_grade[5]->weightage;

  //           if($marks_Total >= intval($Aplus_weightage) && $total_formative_summative <= 100){
  //               $grade_Aplus = $Aplus_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
  //           }

  //           if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
  //               $grade_A = $A_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
  //           }
            
  //           if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
  //               $grade_B = $B_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
  //           }

  //           if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
  //               $grade_C = $C_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
  //           }

  //           if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
  //               $grade_D = $D_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_D,1,0,'C', 1);
  //           }

  //           if($marks_Total < intval($U_weightage)){
  //               $grade_U = $U_name;
  //               $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
  //               $pdf->Cell(7,$student_CH,$grade_U,1,0,'C', 1);
  //           }


  //           $pdf->SetFillColor(255,255,255);
  //           $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
  //           $pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L',1);

  //           //=======================End======================//

  //                       if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
  //                       $grade_Aplus = $Aplus_name;
  //                       $A_plus_total = $A_plus_total+1;
  //                   }

  //                   if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
  //                       $grade_A = $A_name;
  //                       $A_total = $A_total + 1 ;
  //                   }
                    
  //                   if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
  //                       $grade_B = $B_name;
  //                       $B_total = $B_total + 1;
  //                   }

  //                   if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
  //                       $grade_C = $C_name;
  //                       $C_total = $C_total + 1;
  //                   }

  //                   if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
  //                       $grade_D = $D_name;
  //                       $D_total = $D_total + 1;
  //                   }

  //                   if($marks_Total < intval($U_weightage)){
  //                       $grade_U = $U_name;
  //                       $U_total = $U_total + 1;
                        
  //                   }



  //       	$i += $student_CH;
  //       	$counter++;
  //       	$arr_y++;
  //       }



  //       /************************************************* Student Ranking
  //       /******************************************************************/
  //       $i=0;
  //       for($j=0; $j<$noOfStudents; $j++){
  //       	$studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
  //       	$pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
		// 	$i += $student_CH;
  //       }
  //       /******************************************************************/









  //       /********************************************* Average Computation
  //       /******************************************************************/
  //       $z = -7;
  //       $showMarks = 0;
  //       $pdf->SetXY($student_X+22,$student_Y+$i);
  //   	$pdf->Cell(45,$student_CH,'Average',1,0,'R');
  //   	$pdf->SetXY($student_X+22,$student_Y+$i+4);
  //   	$pdf->Cell(45,$student_CH,'Above Average',1,0,'R');
  //   	$pdf->SetXY($student_X+22,$student_Y+$i+8);
  //   	$pdf->Cell(45,$student_CH,'Below Average',1,0,'R');

  //   	$AboveAverageCount = 0;
  //   	$BelowAverageCount = 0;
  //       for($x=0; $x<$noOfAssessments; $x++){	// No of Assessment
  //       	$showMarks = 0;
  //       	$AboveAverageCount = 0;
  //   		$BelowAverageCount = 0;
  //       	for($y=0; $y<$noOfStudents; $y++){	// No of Students
  //       		$showMarks += $totalMarks[$y][$x];
  //       	}



  //       	if($this->data['assessment_titles'][$x]->this_order==1){
  //       		$pdf->SetFillColor(255,255,255);
  //       	}else {
  //       		$pdf->SetFillColor(175,175,175);
  //       	}
  //   		$showMarks = ROUND($showMarks / $noOfStudents, 1);
  //       	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
		// 	$pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

		// 	for($y=0; $y<$noOfStudents; $y++){	// No of Students
  //       		if($totalMarks[$y][$x] > $showMarks){
  //       			$AboveAverageCount++;
  //       		}else if($totalMarks[$y][$x] <= $showMarks){
		// 			$BelowAverageCount++;
		// 		}
  //       	}

        	
  //       	$pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
		// 	$pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
			
  //       	$pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
		// 	$pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
        	

		// 	$z+=7;	 
  //       }

  //       /******************************************************************/

  //       /********************************GRADE RANK ***********************/
  //       /******************************************************************/

  //       $classAssGrade = array();

  //       $cellHeight = 5;
  //       $cellWidth = 21;



  //       $pdf->SetFillColor(255,255,255);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);




  //       //A++
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

  //       if($Aplus_name == 'A+'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
  //       }



  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



  //       //A
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

  //       if($A_name == 'A'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




  //       //B
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

  //       if($B_name == 'B'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
  //       }

  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);




  //       //C
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

  //       if($C_name == 'C'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

 


  //       //D
  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

  //       if($D_name == 'D'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Above '.$D_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$D_total,1,0,'C',1);


  //       //U

  //       $counter++;
  //       $cellWidth = 21;
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

  //       if($U_name == 'U'){
  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,'Below '.$U_weightage.'%',1,0,'C',1);
  //       }


  //       $pdf->SetFillColor(211,211,211);
  //       $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
  //       $pdf->Cell($cellWidth,$cellHeight,$U_total,1,0,'C',1);


  //       /******************************************************************/

  //       /****************************************Report Footer**************
		// *********************************************************/
		// $page_height = $pdf->h;	
  //       $this->load->model('staff/staff_registered_model');
		// $this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		// $pdf->SetFillColor(0,0,0);
		// $pdf->SetTextColor(255,255,255);
  //   	$pdf->SetXY(7,$page_height-30);
  //   	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

			



		

		// // Output the new PDF
		// $pdf->Output('Assessment_Report' . '.pdf', 'I');   
  //   }

	    public function CreateReportPDF(){
        
        $user_id = $this->input->get("user_id");
        $role_id = $this->input->get("role_id");
        $sectionID = $this->input->get("sectionID");
        $gradeID = $this->input->get("gradeID");
        $optional = $this->input->get("optional");
        
        $prgmID = $this->input->get("prgmID");
        $gpp_id = $this->input->get("gpp_id");
        $academic = $this->input->get("academic");
        $term = $this->input->get("term");
        $subjectID = $this->input->get("subjectID");






        $this->load->model('atif_sp/assessment_report_model');
        $GroupID = 0;
        $BlockID = 0;


        $mainCategory = 2;
        $total_formative_summative = 0;
        /**************************** Assessment Titles 
        /***********************************************/
        $this->data['assessment_titles'] = $this->assessment_report_model->getSummativeAss($gradeID, $subjectID, $role_id, $term,$mainCategory,$academic);
        /******************************** Students Data 
        /***********************************************/
        if($optional == 0){
        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_section($gradeID, $sectionID);
        }else{
        	$GroupID = substr(substr($gpp_id, -3), 0, 1);
        	if($GroupID == 'A'){$GroupID=1;}else
        	if($GroupID == 'B'){$GroupID=2;}else
        	if($GroupID == 'C'){$GroupID=3;}else
        	if($GroupID == 'D'){$GroupID=4;}else
        	if($GroupID == 'E'){$GroupID=5;}else
        	if($GroupID == 'F'){$GroupID=6;}

        	$BlockID = substr($gpp_id, -1);

        	$this->data['students_gs_data'] = $this->assessment_report_model->get_students_grade_optional_group_block($gradeID, $subjectID, $GroupID, $BlockID);
        }
        /***************************** Assessment Marks
        /***********************************************/
        if($optional == 0){
	       $this->data['assessment_marks'] = $this->assessment_report_model->getGrdSbjctAssmntMarks( $gradeID, $sectionID, $subjectID, $role_id, $term,$academic, $mainCategory);
	    }else{
	    	$this->data['assessment_marks'] = $this->assessment_report_model->grdSbjtOptAssMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id,$term);
	    }



        /******************* Assessment Aggregate Marks 
        /***********************************************/
        if($optional == 0){
	        $this->data['assessment_agg_marks'] = $this->assessment_report_model->grdSbjctAssmntAggMarks($gradeID, $sectionID, $subjectID, $role_id, $term);

	    }else{
	    	$this->data['assessment_agg_marks'] = $this->assessment_report_model->grdSbjtOptAssAggMarks($gradeID, $subjectID, $GroupID, $BlockID, $role_id, $term);
	    }

	    $select_grade = $this->assessment_report_model->get_grade($academic,$prgmID);




	    $noOfStudents = sizeof($this->data['students_gs_data']);
    	$noOfAssessments = sizeof($this->data['assessment_titles']);

    	// $A_plus_total = 0;
    	// $A_total = 0;
    	// $B_total = 0;
    	// $C_total = 0;
    	// $D_total = 0;
    	// $U_total = 0;

    	// FOR JUNOIRS	
	    if($gradeID >= 6 && $gradeID <= 9){

	    $A_plus_total = 0;
    	$A_total = 0;
    	$B_plus_total = 0;
    	$B_total = 0;
    	$C_plus_total = 0;
    	$C_total = 0;		
	    		
	    
	    }else{

    	$A_plus_total = 0;
    	$A_total = 0;
    	$B_total = 0;
    	$C_total = 0;
    	$D_total = 0;
    	$U_total = 0;

    	}






     	


     	// Overall Font Size
		$font_size = 8;
		$font_name = 'Helvetica'; //Helvetica
		$gender_mark_size = 26;
		$now_date = date('d-M-Y');
		$border = 1;

	



		require_once('components/pdf/fpdf/fpdf_rotate.php');
		require_once('components/pdf/fpdi/fpdi.php');

		


		
		// initiate FPDI
		if($noOfAssessments <= 27){
			$pdf = new PDF('L', 'mm', 'A4');
		}
		if($noOfAssessments > 27 and $noOfAssessments <= 30){
			//$pdf = new PDF('L', 'mm', 'A3');
			$pdf = new PDF('L','mm',array(210,310));
		}
		else if($noOfAssessments  > 30 and $noOfAssessments <= 33)
		{
			$pdf = new PDF('L','mm',array(240,340));
		}
		else if($noOfAssessments > 33 and $noOfAssessments <= 36)
		{
			$pdf = new PDF('L','mm',array(250,350));

		}
		else if ($noOfAssessments > 36 and $noOfAssessments <= 39){
			
			$pdf = new PDF('L','mm',array(270,370));

		}
		else if($noOfAssessments > 39 and $noOfAssessments <=42)
		{
			$pdf = new PDF('L','mm',array(300,400));
		}else{
			$pdf = new PDF('L','mm', 'A3');
		}

		$pdf->AddPage();
		$pdf->SetFont($font_name,'',$font_size);
		$i = 0;



		$borderon = 0;
		$rptheading_X = 7;
		$rptheading_Y = 7;
		$rptheading_CW = 65;
		$rptheading_CH = 10;
		
		if(empty($this->data['assessment_marks'][0]->subject_name)){
			$subject_name = '';
		}else{
			$subject_name = $this->data['assessment_marks'][0]->subject_name;
		}
		



		$assessment_X = 81;
		$assessment_Y = 7;

		$student_X = 7;
		$student_Y = 57;
		$student_CH = 4;



		/**************************************************** Report Heading
		*********************************************************************/
		$pdf->AddFont('CooperBT-Black','','CooperBlackBT.php');

		$heading_font_name = 'CooperBT-Black';
		$heading_font_size = 12;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->SetXY($rptheading_X,$rptheading_Y);
    	$pdf->Cell($rptheading_CW,$rptheading_CH,"Generation's School",$borderon,2,'L');


    	$heading_font_name = 'Helvetica';
		$heading_font_size = 10;
		$pdf->SetFont($heading_font_name,'',$heading_font_size);
    	$pdf->Cell($rptheading_CW,$rptheading_CH-5,"Summative Report",$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$gpp_id,$borderon,2,'L');
    	$pdf->Cell($rptheading_CW,$rptheading_CH-6,$subject_name,$borderon,2,'L');

    	

		/*************************************************** Assessment Titles
		***********************************************************************/




		/*************************************************** Assessment Titles
		***********************************************************************/
		foreach ($this->data['assessment_titles'] as $data) {

			$lastx = 0;
			$lasty = 0;

			$col = $data->full_name;

		   	// $pdf->Cell($X,$Y,,$border);

			if($data->this_order == 2){
				// Fill Grey
				$pdf->SetFillColor(175,175,175);
			}else{
				// Fill White
				$pdf->SetFillColor(255,255,255);
			}
		   	$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,$col,1,0,'R',270,1);

		   	$i += $assessment_Y;		
		}
		$pdf->SetFillColor(255,255,255);
		$pdf->RotatedCell($assessment_X+$i,$assessment_Y,50,7,'Total (100)',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+7,$assessment_Y,50,7,'Percentage',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+14,$assessment_Y,50,7,'Rank',1,0,'R',270,1);
		$pdf->RotatedCell($assessment_X+$i+21,$assessment_Y,50,7,'Grades',1,0,'R',270,1);
		
		$pdf->SetFont($font_name,'B',$font_size);
		$pdf->SetXY($assessment_X+$i+21,$student_Y-$student_CH);
		$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');









		/******************************************************** Student Info
		***********************************************************************/
		$i = 0;
		$counter = 1;
		$marks_Total = 0;


		// Heading
    	$pdf->SetFont($font_name,'B',$font_size);
    	$pdf->SetXY($student_X,$student_Y-$student_CH);
    	$pdf->Cell(7,$student_CH,'Sr',1,0,'C');
    	$pdf->Cell(15,$student_CH,'GS-ID',1,0,'C');
    	$pdf->Cell(30,$student_CH,'Student Name',1,0,'L');
    	$pdf->Cell(15,$student_CH,'GS Status',1,0,'C');





    	$arr_y=0;
    	$arr_x=0;

    	if($gradeID >= 6 && $gradeID <= 9){

    	$A_plus_name = '';
    	$A_name = '';
    	$B_plus_name = '';
    	$B_name = '';
    	$C_plus_name = '';
    	$C_name = '';	

    	}else{
    	$Aplus_name = '';
		$A_name = '';
		$B_name = '';
		$C_name = '';
		$D_name = '';
		$U_name = '';
		}

        
		foreach ($this->data['students_gs_data'] as $data) {

			$arr_x=0;
			$font_size = 7;
			$marks_Total = 0;
        	// Data
        	$pdf->SetFillColor(255,255,255); 
        	$pdf->SetFont($font_name,'',$font_size);
        	$pdf->SetXY($student_X,$student_Y+$i);
        	$pdf->Cell(7,$student_CH,$counter,1,0,'C');
        	$pdf->Cell(15,$student_CH,$data->gs_id,1,0,'C');
        	$pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L');
        	$pdf->Cell(15,$student_CH,$data->std_status_code,1,0,'C');



        	$z = -7;
        	$font_size = 8;
        	foreach ($this->data['assessment_titles'] as $title) {
        		if($title->this_order == '1'){
        			$marksObtained = 0;
        			foreach ($this->data['assessment_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->ass_detail_id == $title->assessment_type_id
        					&& $marks->marks_obtained > 0){

        					$marksObtained = $marks->marks_obtained;
        				}
        			}

        			$pdf->SetFillColor(255,255,255);
        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1);
        			$totalMarks[$arr_y][$arr_x] = $marksObtained;

        		}else if($title->this_order == '2'){
        			$marksObtained = 0;
        			//var_dump($this->data['assessment_agg_marks']);
        			foreach ($this->data['assessment_agg_marks'] as $marks) {
        				if($marks->gs_id == $data->gs_id
        					&& $marks->assessment_id == $title->assessment_type_id
        					&& $marks->aggrAssessment > 0){

        					$marksObtained = $marks->aggrAssessment;
        				}
        			}

        			$marks_Total += $marksObtained;
        			$pdf->SetFillColor(175,175,175);
        			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
        			$pdf->Cell(7,$student_CH,$marksObtained,1,0,'C', 1); 
        			$totalMarks[$arr_y][$arr_x] = $marksObtained;       			
        		}
        		$z+=7;
        		$arr_x++;				
        	}


			$marks_Total = ROUND($marks_Total, 1);        	
			$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C'); 

			$marks_Total = ROUND($marks_Total, 0);        	
			$pdf->SetXY($assessment_X+$z+7,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$marks_Total,1,0,'C');

			$student_totalMarks[$arr_y] = $marks_Total;


			if($gradeID >= 6 && $gradeID <= 9){
			// Junior Section
			//var_dump($select_grade);
			$A_plus_name = $select_grade[0]->name;
            $Aplus_weightage = $select_grade[0]->weightage;

            $A_name = $select_grade[1]->name;
            $A_weightage = $select_grade[1]->weightage;

            $B_name = $select_grade[2]->name;
            $B_weightage = $select_grade[2]->weightage;

            $C_name = $select_grade[3]->name;
            $C_weightage = $select_grade[3]->weightage;

            $B_plus_name = $select_grade[6]->name;
            $B_plus_weightage = $select_grade[6]->weightage;

            $C_plus_name = $select_grade[7]->name;
            $C_plus_weightage = $select_grade[7]->weightage;

            if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
                $grade_Aplus = $A_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
            }

            if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
            }
            
            if($marks_Total >= intval($B_plus_weightage) && $marks_Total < $A_weightage){
                $grade_B_plus = $B_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B_plus ,1,0,'C', 1);
            }

            if($marks_Total >= intval($B_weightage) && $marks_Total < $B_plus_weightage){
                $grade_B = $B_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
            }

            if($marks_Total >= intval($C_plus_weightage) && $marks_Total < $B_weightage){
                $grade_C_plus = $C_plus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C_plus,1,0,'C', 1);
            }

            if($marks_Total < intval($C_weightage)){
                $grade_C = $C_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
            }

            $pdf->SetFillColor(255,255,255);
            $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
            $pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L',1);

            //=======================End======================//

			}else{


			//======================Grading Middler,Senior =====================//
			$Aplus_name = $select_grade[0]->name;
            $Aplus_weightage = $select_grade[0]->weightage;

            $A_name = $select_grade[1]->name;
            $A_weightage = $select_grade[1]->weightage;

            $B_name = $select_grade[2]->name;
            $B_weightage = $select_grade[2]->weightage;

            $C_name = $select_grade[3]->name;
            $C_weightage = $select_grade[3]->weightage;

            $D_name = $select_grade[4]->name;
            $D_weightage = $select_grade[4]->weightage;

            $U_name = $select_grade[5]->name;
            $U_weightage = $select_grade[5]->weightage;

            if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
                $grade_Aplus = $Aplus_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_Aplus,1,0,'C', 1);
            }

            if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
                $grade_A = $A_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_A,1,0,'C', 1);
            }
            
            if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
                $grade_B = $B_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_B,1,0,'C', 1);
            }

            if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
                $grade_C = $C_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_C,1,0,'C', 1);
            }

            if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
                $grade_D = $D_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_D,1,0,'C', 1);
            }

            if($marks_Total < intval($U_weightage)){
                $grade_U = $U_name;
                $pdf->SetXY($assessment_X+$z+21,$student_Y+$i);
                $pdf->Cell(7,$student_CH,$grade_U,1,0,'C', 1);
            }

            $pdf->SetFillColor(255,255,255);
            $pdf->SetXY($assessment_X+$z+28,$student_Y+$i);
            $pdf->Cell(30,$student_CH,$data->abridged_name,1,0,'L',1);

            //=======================End======================//
        }// End Else
        	if($gradeID >= 3 && $gradeID <= 9){

			    if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
			        $grade_Aplus = $A_plus_name;
			        $A_plus_total = $A_plus_total+1;
			    }

				if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
			    	$grade_A = $A_name;
			        $A_total = $A_total + 1 ;
			    }
         
         		if($marks_Total >= intval($B_plus_weightage) && $marks_Total < $A_weightage){
                    $grade_B_plus = $B_plus_name;
                    $B_plus_total = $B_plus_total + 1;
                }

                if($marks_Total >= intval($B_weightage) && $marks_Total < $B_plus_weightage){
                    $grade_B = $B_name;
                        
                    $B_total = $B_total + 1;
                }

                if($marks_Total >= intval($C_plus_weightage) && $marks_Total < $B_weightage){
                    $grade_C_plus = $C_plus_name;
                    $C_plus_total = $C_plus_total + 1;
                }

                if($marks_Total < intval($C_weightage)){
                    $grade_C = $C_name;
                    $C_total = $C_total + 1;
                        
                }

        	}else{

    	        if($marks_Total >= intval($Aplus_weightage) && $marks_Total <= 100){
                    $grade_Aplus = $Aplus_name;
                    $A_plus_total = $A_plus_total+1;
                }

                if($marks_Total >= intval($A_weightage) && $marks_Total < $Aplus_weightage){
                    $grade_A = $A_name;
                    $A_total = $A_total + 1 ;
                }
                
                if($marks_Total >= intval($B_weightage) && $marks_Total < $A_weightage){
                    $grade_B = $B_name;
                    $B_total = $B_total + 1;
                }

                if($marks_Total >= intval($C_weightage) && $marks_Total < $B_weightage){
                    $grade_C = $C_name;
                    $C_total = $C_total + 1;
                }

                if($marks_Total >= intval($D_weightage) && $marks_Total < $C_weightage){
                    $grade_D = $D_name;
                    $D_total = $D_total + 1;
                }

                if($marks_Total < intval($U_weightage)){
                    $grade_U = $U_name;
                    $U_total = $U_total + 1;
                    
                }

        } // END IF



        	$i += $student_CH;
        	$counter++;
        	$arr_y++;
        }



        /************************************************* Student Ranking
        /******************************************************************/
        $i=0;
        for($j=0; $j<$noOfStudents; $j++){
        	$studentRank = $this->assessment_report_model->getRankOf($student_totalMarks, $student_totalMarks[$j]);
        	$pdf->SetXY($assessment_X+$z+14,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$studentRank,1,0,'C');
			$i += $student_CH;
        }
        /******************************************************************/









        /********************************************* Average Computation
        /******************************************************************/
        $z = -7;
        $showMarks = 0;
        $pdf->SetXY($student_X+22,$student_Y+$i);
    	$pdf->Cell(45,$student_CH,'Average',1,0,'R');
    	$pdf->SetXY($student_X+22,$student_Y+$i+4);
    	$pdf->Cell(45,$student_CH,'Above Average',1,0,'R');
    	$pdf->SetXY($student_X+22,$student_Y+$i+8);
    	$pdf->Cell(45,$student_CH,'Below Average',1,0,'R');

    	$AboveAverageCount = 0;
    	$BelowAverageCount = 0;
        for($x=0; $x<$noOfAssessments; $x++){	// No of Assessment
        	$showMarks = 0;
        	$AboveAverageCount = 0;
    		$BelowAverageCount = 0;
        	for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		$showMarks += $totalMarks[$y][$x];
        	}



        	if($this->data['assessment_titles'][$x]->this_order==1){
        		$pdf->SetFillColor(255,255,255);
        	}else {
        		$pdf->SetFillColor(175,175,175);
        	}
    		$showMarks = ROUND($showMarks / $noOfStudents, 1);
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i);
			$pdf->Cell(7,$student_CH,$showMarks,1,0,'C', 1);

			for($y=0; $y<$noOfStudents; $y++){	// No of Students
        		if($totalMarks[$y][$x] > $showMarks){
        			$AboveAverageCount++;
        		}else if($totalMarks[$y][$x] <= $showMarks){
					$BelowAverageCount++;
				}
        	}

        	
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+4);
			$pdf->Cell(7,$student_CH,$AboveAverageCount,1,0,'C', 1);
			
        	$pdf->SetXY($assessment_X+$z,$student_Y+$i+8);
			$pdf->Cell(7,$student_CH,$BelowAverageCount,1,0,'C', 1);
        	

			$z+=7;	 
        }

        /******************************************************************/

        /********************************GRADE RANK ***********************/
        /******************************************************************/
        // For Juniors	
        if($gradeID >= 6 && $gradeID <= 9){

        $classAssGrade = array();

        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($A_plus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B+',1,0,'C',1);

        if($B_plus_name == 'B+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_plus_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_plus_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);

 


        //C+
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C+',1,0,'C',1);

        if($C_plus_name == 'C+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_plus_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_plus_total,1,0,'C',1);


        //C

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

        }else{	

        // For Seniors
        $classAssGrade = array();


        $cellHeight = 5;
        $cellWidth = 21;

        $pdf->SetFillColor(255,255,255);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grade',1,0,'C',1);

        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'%',1,0,'C',1);



        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Grades Total',1,0,'C',1);





        //A++
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A+',1,0,'C',1);

        if($Aplus_name == 'A+'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$Aplus_weightage.'%',1,0,'C',1);
        }



        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_plus_total,1,0,'C',1);



        //A
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'A',1,0,'C',1);

        if($A_name == 'A'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$A_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$A_total,1,0,'C',1);




        //B
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'B',1,0,'C',1);

        if($B_name == 'B'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$B_weightage.'%',1,0,'C',1);
        }

        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$B_total,1,0,'C',1);




        //C
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'C',1,0,'C',1);

        if($C_name == 'C'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$C_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$C_total,1,0,'C',1);

 


        //D
        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'D',1,0,'C',1);

        if($D_name == 'D'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Above '.$D_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$D_total,1,0,'C',1);


        //U

        $counter++;
        $cellWidth = 21;
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'U',1,0,'C',1);

        if($U_name == 'U'){
        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+$cellWidth,$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,'Below '.$U_weightage.'%',1,0,'C',1);
        }


        $pdf->SetFillColor(211,211,211);
        $pdf->SetXY($rptheading_X+($cellWidth*2),$student_Y+($counter*$cellHeight));
        $pdf->Cell($cellWidth,$cellHeight,$U_total,1,0,'C',1);

        }


        /******************************************************************/

        /****************************************Report Footer**************
		*********************************************************/
		$page_height = $pdf->h;	
        $this->load->model('staff/staff_registered_model');
		$this->data['staff_registered_data'] = $this->staff_registered_model->get_by(array('user_id' => (int)$this->session->userdata('user_id')));
		$pdf->SetFillColor(0,0,0);
		$pdf->SetTextColor(255,255,255);
    	$pdf->SetXY(7,$page_height-30);
    	$pdf->Cell(60, 4, date('D-d-M-Y H:i') . ' (' . ucwords($this->data['staff_registered_data'][0]->abridged_name) . ')', 1, 0, 'L', 1);

			



		

		// Output the new PDF
		$pdf->Output('Assessment_Report' . '.pdf', 'I');   
    }	
	
	// function PDF
	/* End function pdf report*/
}