<?php
class Tif_a_form_model extends MY_Model{

	protected $_table_name = 'staff_registered';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'abridged_name asc';
	public $rules = array();
	protected $_timestamps = TRUE;

	public function __construct()

	{
		parent::__construct();
	}
	





	public function getDepartment()
	{
		$query="select sr.gt_id, sr.abridged_name, sr.department as c_topline from atif.staff_registered as sr where sr.is_active=1 and sr.is_posted=1 and sr.department  != '' and sr.department  != '0' group by sr.department  order by sr.department  ";
		$row=$this->db->query($query);
		return $row->result_array();
	}

	public function getSection()
	{
		$query="select sr.gt_id, sr.abridged_name, sr.section as c_bottomline from atif.staff_registered as sr where sr.is_active=1 and sr.is_posted=1 and sr.section != '' and sr.section != '0' group by sr.section order by sr.section ";
		$row=$this->db->query($query);
		return $row->result_array();
	}







	public function get_StaffList()
	{
		$query="select sr.gt_id, sr.abridged_name, sr.name_code, sr.c_topline, st.code as staff_status_code
			from atif.staff_registered as sr
			left join atif._staffstatus as st
				on st.id = sr.staff_status
			where sr.is_active=1 and sr.is_posted=1 
			order by sr.name";
		$row=$this->db->query($query);
		return $row->result_array();
	}






	public function get_StaffList_Of($Department, $Section)
	{
		$query="select sr.gt_id, sr.abridged_name from atif.staff_registered as sr where sr.is_active=1 and sr.is_posted=1 order by sr.name";
		if(strlen($Department) > 3 && strlen($Section) > 3){
			$query="select sr.gt_id, sr.abridged_name from atif.staff_registered as sr where sr.is_active=1 and sr.is_posted=1 and $Department and $Section order by sr.name";			
		}else if(strlen($Department) > 3){
			$query="select sr.gt_id, sr.abridged_name from atif.staff_registered as sr where sr.is_active=1 and sr.is_posted=1 and $Department order by sr.name";
		}else if(strlen($Section) > 3){
			$query="select sr.gt_id, sr.abridged_name from atif.staff_registered as sr where sr.is_active=1 and sr.is_posted=1 and $Section order by sr.name";
		}

		
		$row=$this->db->query($query);
		return $row->result_array();
	}




	public function get_StaffInfo($GTID)
	{
		$query="select
		ro.id as role_id, sr.id as staff_id, sr.user_id, ro.roleCode,
		sr.name, sr.name_code, sr.employee_id as photo_id, sr.gender, sr.abridged_name,if(sr.branch_id = 1,'North','South') as branch,  
		SUBSTR(sr.gg_id, 1, POSITION('@' IN sr.gg_id)-1) as gg_id,
		sr.doj,sr.c_topline, sr.c_bottomline, st.code as staff_status_code,


		ro.gp_id, 

		rd.dname as domain, rd.sname as domain_sname, rd.code as domain_code, rd.color_hex as domain_color,
		rt.dname as role, rt.sname as role_sname, rt.code as role_code, rt.color_hex as role_color,
		rc.dname as catetory, rc.sname as category_sname, rc.code as category_code, rc.color_hex as category_color, rc.position as reporting_line,

		ro.role_title_tl, ro.role_title_bl, ro.total_reportee, ro.total_staff_members,

		ro.wing_id, ro.grade_id, ro.section_id, ro.subject_id, ro.is_assistant, IF(ro.is_transparent=2, 'TRP', 'OPQ') as report_ok,
		IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
		ro.sc_report_to, ro.fundamentalRole

		from atif.staff_registered as sr
		left join atif_role_org.role_position as ro
			on ro.staff_id = sr.id
		left join atif._staffstatus as st
			on st.id = sr.staff_status

		left join atif_role_org.role_domain as rd
			on rd.id = ro.org_domain_id
		left join atif_role_org.role_type as rt
			on rt.id = ro.role_type_id
		left join atif_role_org.role_category as rc
			on rc.id = ro.staff_role_category_id

		where sr.gt_id = '".$GTID."'

		order by ro.fundamentalRole desc;";


		$row=$this->db->query($query);
		return $row->result_array();
	}


	






	public function get_StaffReportingInfo($RoleID)
	{
		$query="select 
		ro.id as role_id, ro.gp_id, IF(ro.is_transparent =2, 'TRP', 'OPQ') as report_ok, ro.roleCode,
		rc.position as reporting_line,
		IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
		sr.id as staff_id, sr.c_topline, sr.c_bottomline, CONCAT('GT ' , sr.gt_id) AS gt_id, sr.name_code, sr.name, sr.abridged_name,
		IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
		ro.sc_report_to, ro.fundamentalRole


		from atif_role_org.role_position as ro
		left join atif.staff_registered as sr
			on sr.id = ro.staff_id
		left join atif_role_org.role_category as rc
			on rc.id = ro.staff_role_category_id
			

		where ro.id = ".$RoleID;


		$row=$this->db->query($query);
		return $row->result_array();
	}






	public function get_StaffReportingInfo_CLTRole($RoleID, $GTID)
	{
		$query="select 
		ro.id as role_id, ro.gp_id, IF(ro.is_transparent =2, 'TRP', 'OPQ') as report_ok, ro.roleCode,
		rc.position as reporting_line,
		IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
		sr.id as staff_id, 
		IF(sr.c_topline='', sbjRole.role_title_tl,sr.c_topline) as c_topline, 
		IF(sr.c_bottomline='', sbjRole.role_title_bl, sr.c_bottomline) AS c_bottomline,
		CONCAT('GT ' , sr.gt_id) AS gt_id, 
		
		IF(sr.name_code='',sbjRole.name_code, sr.name_code) as name_code, sr.name, 
		IF(sr.abridged_name='', sbjRole.abridged_name, sr.abridged_name) as abridged_name,
		
		IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
		ro.sc_report_to, ro.fundamentalRole


		from atif_role_org.role_position as ro
		left join atif.staff_registered as sr
			on sr.id = ro.staff_id
		left join atif_role_org.role_category as rc
			on rc.id = ro.staff_role_category_id
			
		left join (select

		".$RoleID." as sbjRoleID, clt.blocks_per_week,
		IF(clt.teacher_type_id = 1, 'CLT', 'COT') as clt_type,
		CONCAT(gg.name, '-', ss.name) as class, clt.gp_id, st_gs.students,
		IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
		IFNULL(lt.abridged_name, '  ') as abridged_name, IFNULL(lt.name_code, '  ') as name_code

		from atif_role_matrix.role_class_teacher as clt
		left join atif.staff_registered as sr
			on sr.id = clt.staff_id
		left join atif._grade as gg
			on gg.id = clt.grade_id
		left join atif._section as ss
			on ss.id = clt.section_id
		left join atif_role_org.role_position as ro
			on  ro.grade_id = clt.grade_id
			and ro.role_title_tl like 'yt%'
		left join atif.staff_registered as lt
			on lt.id = ro.staff_id
		left join atif.school_strength_grade_section as st_gs
			on st_gs.grade_name = gg.name
			and st_gs.section_name = ss.name

		where sr.gt_id = '".$GTID."') as sbjRole
		on sbjRole.sbjRoleID = ro.id

		where ro.id = ".$RoleID;


		$row=$this->db->query($query);
		return $row->result_array();
	}









	public function get_StaffReportingInfo_SBJRole($GTID)
	{
		$query = "select
			0 as role_id, '' as gp_id, '' as report_ok, '' as roleCode, fr.fr_staff_id,
			'' as reporting_line,
			'' as role_title_tl, '' as role_title_bl,
			srr.id as staff_id, 
			srr.c_topline as c_topline, 
			srr.c_bottomline AS c_bottomline,
			CONCAT('GT ' , srr.gt_id) AS gt_id, 

			srr.name_code as name_code, srr.name, 
			srr.abridged_name as abridged_name,

			'' as pm_report_to,
			'' as sc_report_to, '' as fundamentalRole, 'yes' as junkRole
					
			from atif_role_org.role_matrix_fr as fr
			left join atif.staff_registered as sr
				on sr.id = fr.staff_id
			left join atif.staff_registered as srr
				on srr.id = fr.fr_staff_id
				
			where sr.gt_id = '".$GTID."'";

		$row=$this->db->query($query);
		if($row->num_rows()==0){
			$query="select * from
			(select
			ro.id as role_id, ro.gp_id, IF(ro.is_transparent =2, 'TRP', 'OPQ') as report_ok, ro.roleCode,
			rc.position as reporting_line,
			IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
			yt.id as staff_id, 
			yt.c_topline, yt.c_bottomline,
			yt.gt_id, 
			
			yt.name_code, yt.name, yt.abridged_name,
			
			IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
			ro.sc_report_to, ro.fundamentalRole

			from atif_role_matrix.role_subject_teacher as st
			left join atif.staff_registered as sr
				on sr.id = st.staff_id
				
			left join atif_subject.programmesetup as prog
				on prog.id = st.program_id
			left join atif._grade as gg
				on gg.id = prog.gradeID
			left join atif._section as ss
				on ss.id = st.section_id
			left join atif._branch_wing_grade as ww
				on ww.grade_id = gg.id
				
			
			left join atif_role_matrix.role_subject_reporting as rsr
				on rsr.grade_id = prog.gradeID
				and rsr.subject_id = prog.subjects
				and rsr.academic_session_id >= 9
				and rsr.academic_session_id <= 10
			left join atif_role_org.role_position as ro
				on ro.id = rsr.role_position_id
			left join atif_role_org.role_category as rc
				on rc.id = ro.staff_role_category_id
			left join atif.staff_registered as yt
				on yt.id = ro.staff_id
			
			
			left join atif.school_strength_grade_section as st_gs
				on st_gs.grade_name = gg.name
				and st_gs.section_name = ss.name


			left join atif_subject.subject_selection_group as sbj_grp
				on sbj_grp.name = LEFT(RIGHT(st.gp_id,3),1)
			left join atif_subject.subjectblock as sbj_blk
				on sbj_blk.programID = st.program_id
				and sbj_blk.record_deleted = 0
				and substr(sbj_blk.`key`, 21, 1) = sbj_grp.id
				/*and sbj_blk.block = right(st.gp_id, 1)*/
			left join atif_subject.programmesetup_oblocks as oblock
				on oblock.blockID = sbj_blk.ID
				and oblock.subjectBlock = right(st.gp_id, 1)
			left join atif_subject.subject_selection_group_grade as ssgg
				on ssgg.grade_id = prog.gradeID
				and ssgg.subject_id = prog.subjects
				and ssgg.subject_selection_group_id = sbj_grp.id
				and ssgg.academic_session_id >= 9
				and ssgg.academic_session_id <= 10


			where sr.gt_id = '".$GTID."') as data

			order by abridged_name desc
			limit 1";

			$row=$this->db->query($query);

		}
		return $row->result_array();
	}












	
	public function get_StaffReporteeInfo($RoleID, $ReportingType=null, $NameCode=null)
	{
		$query = "";
		if(empty($ReportingType)){
			$query="select 
			ro.id as role_id, ro.gp_id, IF(ro.is_transparent =2, 'TRP', 'OPQ') as report_ok,
			rc.position as reporting_line, ro.total_reportee, ro.total_staff_members,
			IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
			sr.id as staff_id, sr.c_topline, sr.c_bottomline, CONCAT('GT ' , sr.gt_id) AS gt_id, sr.name_code, sr.name, sr.abridged_name, ro.roleCode,
			IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
			ro.sc_report_to, ro.fundamentalRole, IF(ro.id=ro.fundamentalRole, 'FP', 'P') as reporting_type


			from atif_role_org.role_position as ro
			left join atif.staff_registered as sr
				on sr.id = ro.staff_id
			left join atif_role_org.role_category as rc
				on rc.id = ro.staff_role_category_id
				

			where ro.pm_report_to = $RoleID

			order by rc.position";
		}else{
			$query="select 
			ro.id as role_id, ro.gp_id, IF(ro.is_transparent =2, 'TRP', 'OPQ') as report_ok,
			rc.position as reporting_line, ro.total_reportee, ro.total_staff_members,
			IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
			sr.id as staff_id, sr.c_topline, sr.c_bottomline, CONCAT('GT ' , sr.gt_id) AS gt_id, '".$NameCode."' as name_code, sr.name, sr.abridged_name, ro.roleCode,
			IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
			ro.sc_report_to, ro.fundamentalRole, '".$ReportingType."' as reporting_type


			from atif_role_org.role_position as ro
			left join atif.staff_registered as sr
				on sr.id = ro.staff_id
			left join atif_role_org.role_category as rc
				on rc.id = ro.staff_role_category_id
				

			where ro.pm_report_to = $RoleID

			order by rc.position";
		}


		$row=$this->db->query($query);
		return $row->result_array();
	}










	public function get_StaffReporteeSCInfo($RoleID)
	{
		$query="select 
		ro.id as role_id, ro.gp_id, IF(ro.is_transparent =2, 'TRP', 'OPQ') as report_ok,
		rc.position as reporting_line, ro.total_reportee, ro.total_staff_members,
		IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
		sr.id as staff_id, sr.c_topline, sr.c_bottomline, CONCAT('GT ' , sr.gt_id) AS gt_id, sr.name_code, sr.name, sr.abridged_name, ro.roleCode,
		IF(ro.id=ro.fundamentalRole, ro.pm_report_to, IF(ro.fundamentalRole=0, ro.pm_report_to, ro.fundamentalRole)) as pm_report_to,
		ro.sc_report_to, ro.fundamentalRole, 'SC' as reporting_type


		from atif_role_org.role_position as ro
		left join atif.staff_registered as sr
			on sr.id = ro.staff_id
		left join atif_role_org.role_category as rc
			on rc.id = ro.staff_role_category_id
			

		where ro.sc_report_to = $RoleID

		order by rc.position";


		$row=$this->db->query($query);
		return $row->result_array();
	}
















	/********** Matrix Role *********/
	public function get_StaffMatrixRole_CLT($GTID)
	{
		$query = "select

		clt.blocks_per_week,
		IF(clt.teacher_type_id = 1, 'CLT', 'COT') as clt_type,
		CONCAT(gg.name, '-', ss.name) as class, clt.gp_id, st_gs.students,
		IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
		lt.id as lt_staff_id,
		IFNULL(lt.abridged_name, '  ') as abridged_name, IFNULL(lt.name_code, '  ') as name_code

		from atif_role_matrix.role_class_teacher as clt
		left join atif.staff_registered as sr
			on sr.id = clt.staff_id
		left join atif._grade as gg
			on gg.id = clt.grade_id
		left join atif._section as ss
			on ss.id = clt.section_id
		left join atif_role_org.role_position as ro
			on  ro.grade_id = clt.grade_id
			and ro.role_title_tl like 'yt%'
		left join atif.staff_registered as lt
			on lt.id = ro.staff_id
		left join atif.school_strength_grade_section as st_gs
			on st_gs.grade_name = gg.name
			and st_gs.section_name = ss.name

		where sr.gt_id = '".$GTID."'";
		$row=$this->db->query($query);
		return $row->result_array();
	}



	public function get_StaffMatrixRole_CLT_Reportoo($GTID)
	{

		$query = "select
			0 as role_id, '' as gp_id, '' as report_ok, '' as roleCode, fr.fr_staff_id,
			'' as reporting_line,
			'' as role_title_tl, '' as role_title_bl,
			srr.id as staff_id, 
			srr.c_topline as c_topline, 
			srr.c_bottomline AS c_bottomline,
			CONCAT('GT ' , srr.gt_id) AS gt_id, 

			srr.name_code as name_code, srr.name, 
			srr.abridged_name as abridged_name,

			'' as pm_report_to,
			'' as sc_report_to, '' as fundamentalRole, 'yes' as junkRole
					
			from atif_role_org.role_matrix_fr as fr
			left join atif.staff_registered as sr
				on sr.id = fr.staff_id
			left join atif.staff_registered as srr
				on srr.id = fr.fr_staff_id
				
			where sr.gt_id = '".$GTID."'";

		$row=$this->db->query($query);
		if($row->num_rows()==0){
			$query = "select

			clt.blocks_per_week,
			IF(clt.teacher_type_id = 1, 'CLT', 'COT') as clt_type,
			CONCAT(gg.name, '-', ss.name) as class, clt.gp_id, st_gs.students,
			IFNULL(ro.role_title_tl, '  ') as c_topline, IFNULL(ro.role_title_bl, '  ') as c_bottomline,
			IFNULL(lt.abridged_name, '  ') as abridged_name, IFNULL(lt.name_code, '  ') as name_code,
			'' as report_ok, '' as reporting_line, lt.gt_id as gt_id

			from atif_role_matrix.role_class_teacher as clt
			left join atif.staff_registered as sr
				on sr.id = clt.staff_id
			left join atif._grade as gg
				on gg.id = clt.grade_id
			left join atif._section as ss
				on ss.id = clt.section_id
			left join atif_role_org.role_position as ro
				on  ro.grade_id = clt.grade_id
				and ro.role_title_tl like 'yt%'
			left join atif.staff_registered as lt
				on lt.id = ro.staff_id
			left join atif.school_strength_grade_section as st_gs
				on st_gs.grade_name = gg.name
				and st_gs.section_name = ss.name

			where sr.gt_id = '".$GTID."'";
			$row=$this->db->query($query);
		}
		return $row->result_array();
	}








	
	public function get_StaffMatrixRole_SBJ($GTID)
	{
		/*$query = "select
		st.gp_id, IF(sbj_blk.totalStudents is null, st_gs.students, sbj_blk.totalStudents) as students, sbj_blk.block,
		ro.role_title_tl, ro.role_title_bl, yt.abridged_name, yt.name_code, rc.position as reporting_line

		from atif_role_matrix.role_subject_teacher as st
		left join atif.staff_registered as sr
			on sr.id = st.staff_id
			
		left join atif_subject.programmesetup as prog
			on prog.id = st.program_id
		left join atif._grade as gg
			on gg.id = prog.gradeID
		left join atif._section as ss
			on ss.id = st.section_id
		left join atif._branch_wing_grade as ww
			on ww.grade_id = gg.id
			
		
		left join atif_role_matrix.role_subject_reporting as rsr
			on rsr.grade_id = prog.gradeID
			and rsr.subject_id = prog.subjects
			and rsr.academic_session_id >= 7
			and rsr.academic_session_id <= 8
		left join atif_role_org.role_position as ro
			on ro.id = rsr.role_position_id
		left join atif_role_org.role_category as rc
			on rc.id = ro.staff_role_category_id
		left join atif.staff_registered as yt
			on yt.id = ro.staff_id
		
		
		left join atif.school_strength_grade_section as st_gs
			on st_gs.grade_name = gg.name
			and st_gs.section_name = ss.name

		left join atif_subject.subjectblock as sbj_blk
			on sbj_blk.programID = st.program_id
			and substr(sbj_blk.`key`, 20, 1) = right(st.gp_id, 1)

		where sr.gt_id = '".$GTID."'

		order by st.gp_id asc";*/

		$query = "select * from
		(select
		st.gp_id, IF(sbj_blk.totalStudents is null, st_gs.students, oblock.num) as students,
		IF(prog.optional = 1, IFNULL(ssgg.blocks_per_week,0), IFNULL(prog.blocks_per_week,0)) as block, 
		ro.role_title_tl, ro.role_title_bl, yt.id as yt_staff_id, yt.abridged_name, yt.name_code, rc.position as reporting_line 
		/*sbj_blk.ID, substr(sbj_blk.`key`, 20, 1) as dkey, right(st.gp_id, 1) as gp*/

		from atif_role_matrix.role_subject_teacher as st
		left join atif.staff_registered as sr
			on sr.id = st.staff_id
			
		left join atif_subject.programmesetup as prog
			on prog.id = st.program_id
		left join atif._grade as gg
			on gg.id = prog.gradeID
		left join atif._section as ss
			on ss.id = st.section_id
		left join atif._branch_wing_grade as ww
			on ww.grade_id = gg.id
			
		
		left join atif_role_matrix.role_subject_reporting as rsr
			on rsr.grade_id = prog.gradeID
			and rsr.subject_id = prog.subjects
			and rsr.academic_session_id >= 9
			and rsr.academic_session_id <= 10
		left join atif_role_org.role_position as ro
			on ro.id = rsr.role_position_id
		left join atif_role_org.role_category as rc
			on rc.id = ro.staff_role_category_id
		left join atif.staff_registered as yt
			on yt.id = ro.staff_id
		
		
		left join atif.school_strength_grade_section as st_gs
			on st_gs.grade_name = gg.name
			and st_gs.section_name = ss.name


		left join atif_subject.subject_selection_group as sbj_grp
			on sbj_grp.name = LEFT(RIGHT(st.gp_id,3),1)
		left join atif_subject.subjectblock as sbj_blk
			on sbj_blk.programID = st.program_id
			and sbj_blk.record_deleted = 0
			and substr(sbj_blk.`key`, 21, 1) = sbj_grp.id
			/*and sbj_blk.block = right(st.gp_id, 1)*/
		left join atif_subject.programmesetup_oblocks as oblock
			on oblock.blockID = sbj_blk.ID
			and oblock.subjectBlock = right(st.gp_id, 1)
		left join atif_subject.subject_selection_group_grade as ssgg
			on ssgg.grade_id = prog.gradeID
			and ssgg.subject_id = prog.subjects
			and ssgg.subject_selection_group_id = sbj_grp.id
			and ssgg.academic_session_id >= 9
			and ssgg.academic_session_id <= 10


		where sr.gt_id = '".$GTID."') as data
		where students is not null

		order by gp_id asc";
		$row=$this->db->query($query);
		return $row->result_array();
	}














	public function getStaff_TTProfile($GTID){
		$query = "select
			tf.name as time_profile, tt.avg_week_hrs,
			tt.sat_hrs, tt.sat_working, tt.sat_off, IF(tt.ext_time='00:00:00', '-', tt.ext_time) as ext_time, tt.ext_frequency, ty.name as ty_name,
			DATE_FORMAT(tt.ext_july, '%d-%b-%Y') as ext_july,
			TIME_FORMAT(tt.mon_in, '%h:%i %p') as mon_in, 
			TIME_FORMAT(tt.tue_in, '%h:%i %p') as tue_in, 
			TIME_FORMAT(tt.wed_in, '%h:%i %p') as wed_in,  
			TIME_FORMAT(tt.thu_in, '%h:%i %p') as thu_in, 
			TIME_FORMAT(tt.fri_in, '%h:%i %p') as fri_in, 
			TIME_FORMAT(tt.sat_in, '%h:%i %p') as sat_in, 
			TIME_FORMAT(tt.sun_in, '%h:%i %p') as sun_in,
			TIME_FORMAT(tt.mon_out, '%h:%i %p') as mon_out, 
			TIME_FORMAT(tt.tue_out, '%h:%i %p') as tue_out, 
			TIME_FORMAT(tt.wed_out, '%h:%i %p') as wed_out, 
			TIME_FORMAT(tt.thu_out, '%h:%i %p') as thu_out, 
			TIME_FORMAT(tt.fri_out, '%h:%i %p') as fri_out, 
			TIME_FORMAT(tt.sat_out, '%h:%i %p') as sat_out, 
			TIME_FORMAT(tt.sun_out, '%h:%i %p') as sun_out, 
			TIME_FORMAT(IF(tt.mon_in is not null, tt.mon_in,
				IF(tt.tue_in is not null, tt.tue_in,
				IF(tt.wed_in is not null, tt.wed_in,
				IF(tt.thu_in is not null, tt.thu_in,
				IF(tt.fri_in is not null, tt.fri_in,
				IF(tt.sat_in is not null, tt.sat_in,
				IF(tt.sun_in is not null, tt.sun_in, ''
				))))))), '%h:%i %p') as std_in,
			TIME_FORMAT(IF(tt.mon_out is not null, tt.mon_out,
				IF(tt.tue_out is not null, tt.tue_out,
				IF(tt.wed_out is not null, tt.wed_out,
				IF(tt.thu_out is not null, tt.thu_out,
				IF(tt.fri_out is not null, tt.fri_out,
				IF(tt.sat_out is not null, tt.sat_out,
				IF(tt.sun_out is not null, tt.sun_out, ''
				))))))), '%h:%i %p') as std_out
			from atif_gs_events.tt_profile_time_staff as tt
			left join atif_gs_events.tt_profile as tf
				on tf.id = tt.profile_id
			left join atif_gs_events.tt_profile_type as ty
				on ty.id = tf.profile_type_id
			left join atif.staff_registered as sr
				on sr.id = tt.staff_id
			where tt.record_deleted = 0
			and sr.gt_id = '".$GTID."'

			order by tt.id desc
			limit 1";

		$row=$this->db->query($query);
		return $row->result_array();
	}




















	public function getUniqueStudents($GTID){
		$query = "select sum(students) as num from
			(select students from
			(select students, grade_name, section_name from
					(select
					clt.blocks_per_week,
					IF(clt.teacher_type_id = 1, 'CLT', 'COT') as clt_type,
					CONCAT(gg.name, '-', ss.name) as class, clt.gp_id, st_gs.students,
					IFNULL(ro.role_title_tl, '  ') as role_title_tl, IFNULL(ro.role_title_bl, '  ') as role_title_bl,
					IFNULL(lt.abridged_name, '  ') as abridged_name, IFNULL(lt.name_code, '  ') as name_code,
					gg.name as grade_name, ss.name as section_name
			
					from atif_role_matrix.role_class_teacher as clt
					left join atif.staff_registered as sr
						on sr.id = clt.staff_id
					left join atif._grade as gg
						on gg.id = clt.grade_id
					left join atif._section as ss
						on ss.id = clt.section_id
					left join atif_role_org.role_position as ro
						on  ro.grade_id = clt.grade_id
						and ro.role_title_tl like 'yt%'
					left join atif.staff_registered as lt
						on lt.id = ro.staff_id
					left join atif.school_strength_grade_section as st_gs
						on st_gs.grade_name = gg.name
						and st_gs.section_name = ss.name
			
					where sr.gt_id = '".$GTID."') as data
					
			UNION
			
			select students, grade_name, section_name from
					(select
					st.gp_id, IF(sbj_blk.totalStudents is null, st_gs.students, oblock.num) as students,
					IF(prog.optional = 1, IFNULL(ssgg.blocks_per_week,0), IFNULL(prog.blocks_per_week,0)) as block, 
					ro.role_title_tl, ro.role_title_bl, yt.abridged_name, yt.name_code, rc.position as reporting_line,
					gg.name as grade_name, ss.name as section_name
			
					from atif_role_matrix.role_subject_teacher as st
					left join atif.staff_registered as sr
						on sr.id = st.staff_id
						
					left join atif_subject.programmesetup as prog
						on prog.id = st.program_id
					left join atif._grade as gg
						on gg.id = prog.gradeID
					left join atif._section as ss
						on ss.id = st.section_id
					left join atif._branch_wing_grade as ww
						on ww.grade_id = gg.id
						
					
					left join atif_role_matrix.role_subject_reporting as rsr
						on rsr.grade_id = prog.gradeID
						and rsr.subject_id = prog.subjects
						and rsr.academic_session_id >= 9
						and rsr.academic_session_id <= 10
					left join atif_role_org.role_position as ro
						on ro.id = rsr.role_position_id
					left join atif_role_org.role_category as rc
						on rc.id = ro.staff_role_category_id
					left join atif.staff_registered as yt
						on yt.id = ro.staff_id
					
					
					left join atif.school_strength_grade_section as st_gs
						on st_gs.grade_name = gg.name
						and st_gs.section_name = ss.name
			
			
					left join atif_subject.subject_selection_group as sbj_grp
						on sbj_grp.name = LEFT(RIGHT(st.gp_id,3),1)
					left join atif_subject.subjectblock as sbj_blk
						on sbj_blk.programID = st.program_id
						and sbj_blk.record_deleted = 0
						and substr(sbj_blk.`key`, 21, 1) = sbj_grp.id
						/*and sbj_blk.block = right(st.gp_id, 1)*/
					left join atif_subject.programmesetup_oblocks as oblock
						on oblock.blockID = sbj_blk.ID
						and oblock.subjectBlock = right(st.gp_id, 1)
					left join atif_subject.subject_selection_group_grade as ssgg
						on ssgg.grade_id = prog.gradeID
						and ssgg.subject_id = prog.subjects
						and ssgg.subject_selection_group_id = sbj_grp.id
						and ssgg.academic_session_id >= 9
						and ssgg.academic_session_id <= 10
			
			
					where sr.gt_id = '".$GTID."'
					group by gg.name, ss.name) as data
					where students is not null
			) as data
			group by grade_name, section_name
		) as data";

		$row=$this->db->query($query);
		$row=$row->result_array();
		if(!empty($row)){
			return $row[0]['num'];
		}else{
			return 0;
		}
	}













	public function updateForced_FR($StaffID, $FR_StaffID){
		$query = "select staff_id from atif_role_org.role_matrix_fr as f where f.staff_id = " . $StaffID;
		$row=$this->db->query($query);
		$row=$row->result_array();
		if(!empty($row)){
			$query = "update atif_role_org.role_matrix_fr set fr_staff_id = " . $FR_StaffID . " where staff_id = " . $StaffID;
			$this->db->query($query);
		}else{
			$query = "insert into atif_role_org.role_matrix_fr (staff_id, fr_staff_id, created, register_by, modified, modified_by) values (".$StaffID.", ".$FR_StaffID.", 0, 1, 0, 1)";
			$this->db->query($query);
		}
	}
}