<?php
class Fif_student_info_model extends MY_Model{
	protected $_table_name = 'student_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'call_name desc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()
	{
		parent::__construct();
	}


	public function checkGSID_from_ClassList($GSID){
		$result = false;

		$query=$this->db->query("SELECT gs_id FROM atif.class_list WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($row['gs_id'] != ''){
				$result=true;
			}
		}

		return $result;
	}

	public function checkGSID($GSID){
		$result = false;

		$query=$this->db->query("SELECT gs_id FROM student_registered WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($row['gs_id'] != ''){
				$result=true;
			}
		}

		return $result;
	}


	public function getStudentInfo($GSID)
	{
		$cQuery = "select * from class_list where gs_id = '" . $GSID . "' group by gs_id";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getStudentGRNO($GSID)
	{
		$cQuery = "select * from class_list where gs_id = '" . $GSID . "'";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function makeGFID($ID){
		$makeGFID = "";

		if($ID <= 999){
			$makeGFID = "00" . "-" . str_pad(str_pad($ID, -3), 3, "0", STR_PAD_LEFT);
		}else if($ID <= 9999){
			$makeGFID = "0" . substr($ID, 0, 1) . "-" . substr($ID, -3);
		}else{
			$makeGFID = substr($ID, 0, 2) . "-" . substr($ID, -3);
		}

		return $makeGFID;
	}

	public function makeGFID_Num($ID){
		$makeGFID_Num = "";
		$makeGFID_Num = str_replace("-", "", $ID);

		return $makeGFID_Num;
	}


	public function getGFID($GSID){
		$getGFID = 0;

		$query=$this->db->query("SELECT gf_id FROM student_registered WHERE gs_id = '" . $GSID . "'"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getGFID = $row['gf_id'];
		}

		return $getGFID;
	}

	
	public function getSiblingsInfo($GFID)
	{
		$cQuery = "select * from students_all where gf_id = " . $GFID . " group by gs_id order by grade_id desc";
		/*$cQuery = "select * from (
		select `sr`.`id` AS `student_id`,`sr`.`gr_no` AS `gr_no`,
		`sar`.`previous_class` AS `previous_class`,`sar`.`detain` AS `detain`,
		`sar`.`grade_id` AS `grade_id`,`sar`.`section_id` AS `section_id`,
		`sar`.`house_id` AS `house_id`,`sar`.`status_id` AS `status_id`,
		`sar`.`academic_session_id` AS `academic_session_id`,
		`sar`.`rfid_dec_no` AS `rfid_dec_no`,`sar`.`rfid_hex_no` AS `rfid_hex_no`,
		`gg`.`dname` AS `grade_name`,`ss`.`dname` AS `section_name`,
		`sts`.`dname` AS `student_status_name`,`hh`.`dname` AS `house_name`,
		`hh`.`Red` AS `house_red`,`hh`.`Green` AS `house_green`,
		`hh`.`Blue` AS `house_blue`,`hh`.`color_hex` AS `house_color_hex`,
		`ass`.`dname` AS `academic_session_name`,`sr`.`official_name` AS `official_name`,
		`sr`.`abridged_name` AS `abridged_name`,`sr`.`call_name` AS `call_name`,
		`sr`.`gender` AS `gender`,`sr`.`DOB` AS `dob`,`sr`.`nationality_1` AS `nationality_1`,
		`sr`.`nationality_2` AS `nationality_2`,`sr`.`religion` AS `religion`,
		`sr`.`year_of_admission` AS `year_of_admission`,`sr`.`grade_of_admission` AS `grade_of_admission`,
		`sr`.`previous_school` AS `previous_school`,`sr`.`mobile_phone` AS `mobile_phone`,
		`sr`.`email` AS `email`,`sr`.`facebook` AS `facebook`,`sr`.`linkedin` AS `linkedin`,
		`sr`.`gs_id` AS `gs_id`,`sr`.`gf_id` AS `gf_id`,`sr`.`siblings_position` AS `siblings_position`,
		`sr`.`created` AS `created`,
		`sr`.`record_deleted` AS `record_deleted`,(extract(year from `ass`.`start_date`) + `gg`.`complete_in_years`) AS `generation_of`
		from ((((((`atif`.`student_registered` `sr` left join `atif`.`student_academic_record` `sar` on((`sar`.`student_id` = `sr`.`id`)))
		 left join `atif`.`_grade` `gg` on((`gg`.`id` = `sar`.`grade_id`)))
		  left join `atif`.`_section` `ss` on((`ss`.`id` = `sar`.`section_id`)))
		   left join `atif`.`_house` `hh` on((`hh`.`id` = `sar`.`house_id`)))
		    left join `atif`.`_academic_session` `ass` on((`ass`.`id` = `sar`.`academic_session_id`)))
		     left join `atif`.`_student_status` `sts` on((`sts`.`id` = `sar`.`status_id`)))) as ana
		      where ana.gf_id =  " . $GFID . " group by ana.gs_id order by ana.grade_id desc";*/
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	    				
    	
   		return $row;
	}


	public function getParentStaffInfo($GFID)
	{
		$cQuery = "select * from students_family_staff where record_deleted = 0 and gf_id = " . $GFID;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getHomeInfo($GFID)
	{
		$cQuery = "select * from student_contact_info where gf_id = " . $GFID . "  and record_deleted = 0 limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getParentsInfo($GFID)
	{
		$cQuery = "select * from student_family_record where gf_id = " . $GFID . "  and record_deleted = 0 order by parent_type asc limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getECInfo($GFID)
	{
		$cQuery = "select * from student_family_ec where gf_id = " . $GFID . " order by created desc limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	public function getFatherQualification($GFID)
	{
		$cQuery = "select * from student_family_qualification where gf_id = " . $GFID . " and parent_type = 1 and record_deleted = 0 order by created desc limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function getMotherQualification($GFID)
	{
		$cQuery = "select * from student_family_qualification where gf_id = " . $GFID . " and parent_type = 2 and record_deleted = 0 order by created desc limit 2";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function getFatherWorkDetail($GFID)
	{
		$cQuery = "select * from student_family_work_detail where gf_id = " . $GFID . " and parent_type = 1 and record_deleted = 0 order by created desc limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}

	public function getMotherWorkDetail($GFID)
	{
		$cQuery = "select * from student_family_work_detail where gf_id = " . $GFID . " and parent_type = 2 and record_deleted = 0 order by created desc limit 1";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}








	public function getFatherPhotoPath($GFID)
	{
		$getFatherPhotoPath = "xxx";

		$StudentPhotoPath = $this->data['student_150_photo_path'];
		$FatherPhotoPath = $this->data['stdf_150_photo_path'];
		$MotherPhotoPath = $this->data['stdm_150_photo_path'];
		$StaffPhotoPath = $this->data['staff_150_photo_path'];

		$siblings = $this->getSiblingsInfo($GFID);

		$FatherPhotoFound = false;
		$MotherPhotoFound = false;
		
		foreach ($siblings as $sibling) {			
			if(file_exists($FatherPhotoPath . $sibling['gr_no'] . ".png")){				
				$getFatherPhotoPath = $FatherPhotoPath . $sibling['gr_no'] . ".png";
				$FatherPhotoFound = true;
			}
		}


		$MaritalStatus = $this->getParentsInfo($GFID);
		// If Staff
		if($FatherPhotoFound == false){
			$ParentStaff = $this->getParentStaffInfo($GFID);
			if($ParentStaff[0]['staff_gender'] == "M"){
				$getFatherPhotoPath = $StaffPhotoPath . $ParentStaff[0]['employee_id'] . ".png";
				$FatherPhotoFound = true;
			}
		}

		// If Divorced		
		if ($FatherPhotoFound == false){			
			if($MaritalStatus[0]['marital_status'] == "Divorced"){
				$getFatherPhotoPath = $FatherPhotoPath . "PicDivorce_Dark.png";
				$FatherPhotoFound = true;
			}
		}

		// If Late
		if ($FatherPhotoFound == false){
			if($MaritalStatus[0]['yod'] == "Late"){
				$getFatherPhotoPath = $FatherPhotoPath . "PicLate_Dark.png";
				$FatherPhotoFound = true;				
			}
		}
		

		// If NO photo found
		if($FatherPhotoFound == false){
			$getFatherPhotoPath = $FatherPhotoPath . "NoPic.png";
		}

		
		return $getFatherPhotoPath;
	}



	public function getMotherPhotoPath($GFID)
	{
		$getMotherPhotoPath = "xxx";

		$StudentPhotoPath = $this->data['student_150_photo_path'];
		$FatherPhotoPath = $this->data['stdf_150_photo_path'];
		$MotherPhotoPath = $this->data['stdm_150_photo_path'];
		$StaffPhotoPath = $this->data['staff_150_photo_path'];

		$siblings = $this->getSiblingsInfo($GFID);

		$FatherPhotoFound = false;
		$MotherPhotoFound = false;
		
		foreach ($siblings as $sibling) {			
			if(file_exists($MotherPhotoPath . $sibling['gr_no'] . ".png")){				
				$getMotherPhotoPath = $MotherPhotoPath . $sibling['gr_no'] . ".png";
				$MotherPhotoFound = true;
			}
		}


		$MaritalStatus = $this->getParentsInfo($GFID);
		// If Staff
		if($MotherPhotoFound == false){
			$ParentStaff = $this->getParentStaffInfo($GFID);
			if($ParentStaff[0]['staff_gender'] == "F"){
				$getMotherPhotoPath = $StaffPhotoPath . $ParentStaff[0]['employee_id'] . ".png";
				$MotherPhotoFound = true;
			}
		}


		// If Divorced
		if ($MotherPhotoFound == false){
			if($MaritalStatus[1]['marital_status'] == "Divorced"){
				$getMotherPhotoPath = $MotherPhotoPath . "PicDivorce_Dark.png";
				$MotherPhotoFound = true;
			}
		}

		// If Late
		if ($MotherPhotoFound == false){
			if($MaritalStatus[1]['yod'] == "Late"){
				$getMotherPhotoPath = $MotherPhotoPath . "PicLate_Dark.png";
				$MotherPhotoFound = true;
			}
		}		


		// If NO photo found
		if($MotherPhotoFound == false){
			$getMotherPhotoPath = $MotherPhotoPath . "NoPic.png";
		}

		return $getMotherPhotoPath;
	}



	public function getStudentTrail($GSID)
	{
		$cQuery = "select
			student_id, gs_id, gf_id, official_name, abridged_name, call_name,
			gender, student_status_name, last_modified_date, last_modified_time, year_of_admission, grade_of_admission,
			sort_order, data, wef, old, new
			from
			(select
			cl.id as student_id, cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			cl.official_name, cl.abridged_name, cl.call_name, cl.gender, cl.student_status_name,
			from_unixtime(sr.modified, '%d-%M-%Y') as last_modified_date, from_unixtime(sr.modified, '%h:%i') as last_modified_time, cl.year_of_admission, cl.grade_of_admission,
			'1' as sort_order, 'Withdrawal' as data, IFNULL(wd.wef_date,'') as wef, IFNULL(wd_status_old.name,'') as old, '' as new
			from atif.class_list cl
			left join atif.req_withdrawal as wd on wd.student_id=cl.id
				left join atif._student_status as wd_status_old on wd_status_old.id=wd.old_status
			left join atif.student_registered as sr on sr.id=cl.id
			where cl.gs_id='$GSID'

			union

			select
			cl.id as student_id, cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			cl.official_name, cl.abridged_name, cl.call_name, cl.gender, cl.student_status_name,
			from_unixtime(sr.modified, '%d-%M-%Y') as last_modified_date, from_unixtime(sr.modified, '%h:%i') as last_modified_time, cl.year_of_admission, cl.grade_of_admission,
			'2' as sort_order, 'House' as data, IFNULL(house.wef_date,'') as wef, IFNULL(house_old.name,'') as old, IFNULL(house_new.name,'') as new
			from atif.class_list cl
			left join atif.req_house as house on house.student_id=cl.id
				left join atif._house as house_old on house_old.id=house.old_house
				left join atif._house as house_new on house_old.id=house.new_house
			left join atif.student_registered as sr on sr.id=cl.id
			where cl.gs_id='$GSID'

			union

			select
			cl.id as student_id, cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			cl.official_name, cl.abridged_name, cl.call_name, cl.gender, cl.student_status_name,
			from_unixtime(sr.modified, '%d-%M-%Y') as last_modified_date, from_unixtime(sr.modified, '%h:%i') as last_modified_time, cl.year_of_admission, cl.grade_of_admission,
			'3' as sort_order, 'Section' as data, IFNULL(section.wef_date,'') as wef, IFNULL(section_old.name,'') as old, IFNULL(section_new.name,'') as new
			from atif.class_list cl
			left join atif.req_section as section on section.student_id=cl.id
				left join atif._section as section_old on section_old.id=section.old_section
				left join atif._section as section_new on section_new.id=section.new_section
			left join atif.student_registered as sr on sr.id=cl.id
			where cl.gs_id='$GSID'

			union

			select
			cl.id as student_id, cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			cl.official_name, cl.abridged_name, cl.call_name, cl.gender, cl.student_status_name,
			from_unixtime(sr.modified, '%d-%M-%Y') as last_modified_date, from_unixtime(sr.modified, '%h:%i') as last_modified_time, cl.year_of_admission, cl.grade_of_admission,
			'4' as sort_order, 'Status' as data, IFNULL(status.wef_date,'') as wef, IFNULL(student_status_old.dname,'') as old, IFNULL(student_status_new.dname,'') as new
			from atif.class_list cl
			left join atif.req_statusai as status on status.student_id=cl.id
				left join atif._student_status as student_status_old on student_status_old.id=status.old_status
				left join atif._student_status as student_status_new on student_status_new.id=status.new_status
			left join atif.student_registered as sr on sr.id=cl.id
			where cl.gs_id='$GSID'


			union

			select
			cl.id as student_id, cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			cl.official_name, cl.abridged_name, cl.call_name, cl.gender, cl.student_status_name,
			from_unixtime(sr.modified, '%d-%M-%Y') as last_modified_date, from_unixtime(sr.modified, '%h:%i') as last_modified_time, cl.year_of_admission, cl.grade_of_admission,
			'5' as sort_order, 'Smart Card' as data, IFNULL(scard.req_date,'') as wef, '' as old, '' as new
			from atif.class_list cl
			left join atif.req_student_card as scard on scard.student_id=cl.id	
			left join atif.student_registered as sr on sr.id=cl.id
			where cl.gs_id='$GSID'

			union

			select
			cl.id as student_id, cl.gs_id, CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id,
			cl.official_name, cl.abridged_name, cl.call_name, cl.gender, cl.student_status_name,
			from_unixtime(sr.modified, '%d-%M-%Y') as last_modified_date, from_unixtime(sr.modified, '%h:%i') as last_modified_time, cl.year_of_admission, cl.grade_of_admission,
			'6' as sort_order, 'Admission' as data, IFNULL(adm.req_date, '') as wef, '' as old, '' as new
			from atif.class_list cl
			left join atif.req_admission as adm on adm.student_id=cl.id
			left join atif.student_registered as sr on sr.id=cl.id
			where cl.gs_id='$GSID') as student_log
			where wef!=''
			order by wef desc, sort_order asc";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}


	/*public function getStatusID($StudentID){
		$getStatusID = "";

		$query=$this->db->query("SELECT status_id FROM student_academic_record WHERE student_id = " . $StudentID); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getStatusID = $row['status_id'];
		}

		return $getStatusID;
	}



	public function getDuplicateCardNo($StudentID){
		$getDuplicateCardNo = 0;

		$query=$this->db->query("SELECT count(student_id) as num_of_cards FROM req_student_card WHERE (student_id = " . $StudentID . " and req_date >= '2014-08-01' and req_date <= '2015-06-30' and new_adm = 0)"); 
		
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			$getDuplicateCardNo = $row['num_of_cards'];
		}else{
			$getDuplicateCardNo = 1;
		}

		return $getDuplicateCardNo;
	}
	


	public function getAllDuplicateCardData()
	{
		$cQuery = "select
			sr.gs_id, sr.gf_id, sr.abridged_name,
			gg.dname as grade_name, ss.dname as section_name,
			reqsc.id, reqsc.student_id, reqsc.req_date, reqsc.description, reqsc.ip, reqsc.created
			from req_student_card reqsc
			left join student_registered sr on sr.id = reqsc.student_id
			left join student_academic_record sar on sar.student_id = reqsc.student_id
			left join _grade gg on gg.id = sar.grade_id
			left join _section ss on ss.id = sar.section_id
			where (sar.academic_session_id >= 3 or sar.academic_session_id <= 6)";
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}



	public function getDuplicateCardData($ID)
	{
		$cQuery = "select
			sr.gs_id, sr.gf_id, sr.abridged_name, sr.gr_no, sr.gender,
			sfr.name, sfr.parent_type,
			gg.dname as grade_name, ss.dname as section_name,
			reqsc.duplicate, reqsc.new_adm, reqsc.amount,
			reqsc.id, reqsc.student_id, reqsc.req_date, reqsc.description, reqsc.ip, reqsc.created
			from req_student_card reqsc
			left join student_registered sr on sr.id = reqsc.student_id
			left join student_academic_record sar on sar.student_id = reqsc.student_id
			left join student_family_record sfr on sfr.gf_id = sr.gf_id
			left join _grade gg on gg.id = sar.grade_id
			left join _section ss on ss.id = sar.section_id
			where (sar.academic_session_id >= 3 or sar.academic_session_id <= 6) and reqsc.id = " . $ID;
   		$query=$this->db->query($cQuery); 
   		$row = $query->result_array();	
    				
   		return $row;
	}*/
}