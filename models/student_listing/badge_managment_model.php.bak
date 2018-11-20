<?php
class Badge_managment_model extends CI_Model{
	private $gdb,$ddb;
	
	function __construct(){ parent::__construct(); }
	
	public function Get_Bedges($grade_id,$section_id){
		$this->gdb = $this->load->database('default',TRUE);
		$query = "select * from gs_badges.badges as bg where bg.grade_id=".$grade_id." and bg.section_id=".$section_id." and bg.record_deleted=0 and ( bg.bedge_expiry >= curdate() OR bg.bedge_expiry ='0000-00-00') ";
		$result = $this->gdb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	
	
	public function badge_assigned_student($Grade_id, $Section_id, $Badge_id=NULL){
		$this->gdb = $this->load->database('default',TRUE);
		$query = "select * from gs_badges.badges as bg where bg.grade_id=".$grade_id." and bg.section_id=".$section_id." and bg.record_deleted=0 and ( bg.bedge_expiry >= curdate() OR bg.bedge_expiry ='0000-00-00' ) ";
		$result = $this->gdb->query( $query ); 
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }
	}
	
		// Insert database
	public function set($table,$data){
		$this->ddb = $this->load->database('gs_badges',TRUE);
		$this->ddb->insert($table, $data);
		return $this->ddb->insert_id();	
	}
	// end set
	

	public function Get_Bedge($Badge_id){
		$this->gdb = $this->load->database('default',TRUE);
		$query = "select * from gs_badges.badges as bg where bg.id=".$Badge_id."";
		$result = $this->gdb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->row_array();
		return $results;
		}else{ return FALSE; }	
	}
	
	public function Badge_Students($Grade_id,$Section_id,$Badge_id){
		
		
		$this->gdb = $this->load->database('default',TRUE);

$query="select 
cl.id as Student_Id, cl.official_name as Abridged_Name, cl.gs_id as GS_ID, 
			b_data.Badge_Code as Badge_Code,b_data.Badge_Color as Badge_Color

from  atif.class_list  as cl
left join ( 
	select bs.student_id as Student_id, bd.ID AS Badge_id,bd.bedge_code as Badge_Code,bd.bedge_color as Badge_Color  from gs_badges.badges as bd
		left join gs_badges.bedge_student as bs on(bs.bedge_id=bd.ID)
			where
				bs.record_deleted=0 and bd.ID=".$Badge_id." and ( bd.bedge_expiry >= curdate() OR bd.bedge_expiry = '0000-00-00' ) ) as b_data

on(b_data.Student_id = cl.id )
where 
cl.grade_id=".$Grade_id." and cl.section_id=".$Section_id."

group by cl.gs_id
order by cl.call_name";
		$result = $this->gdb->query( $query );
		//echo $this->ddb->last_query();
		if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
		$results = $result->result_array();
		return $results;
		}else{ return FALSE; }	
		
		
	}
	
	public function UPDating($table, $data,$where){
		
		$this->ddb = $this->load->database('gs_badges',TRUE);
			$this->ddb->where( $where );
			$this->ddb->update($table, $data );
			return $this->ddb->affected_rows();
		
	}
		
	public function grd_sctn_std_bdg($acadmic_id,$grade_id,$section_id,$student_id){
		$this->gdb = $this->load->database('default',TRUE);
		$query="select 
			bg.ID as Badge_id,
			bg.bedge_title as  Badge_Title,
			bg.bedge_code as Badge_Code,
			bg.bedge_expiry as Badge_Expiry,
			bg.bedge_color as Badge_Color,
			bg.bedge_description as Badge_Des,
			bg.bedge_priority as Badge_Priority
			from gs_badges.bedge_student as bs
			left join gs_badges.badges as bg on( bg.ID=bs.bedge_id 	)
			where 
			bs.student_id=".$student_id." and bs.record_deleted=0
			and bg.academic_session_id=".$acadmic_id." 
			and bg.grade_id=".$grade_id."
			and bg.section_id=".$section_id."
			and bg.record_deleted=0 and ( bg.bedge_expiry >= curdate() OR bg.bedge_expiry='0000-00-00' )
			order by bg.bedge_priority,bg.created desc";

			$result = $this->gdb->query( $query );
			//echo $this->ddb->last_query();
			if( ( $result != FALSE ) && ( $result->num_rows() > 0 ) ){
			$results = $result->result_array();
			return $results;
			}else{ return FALSE; }	
	}
		
	/*
	
	
select cg.official_name, 
#group_concat() as badge_code,
bgs.badge_code,
 
 bgs.bedge_title  from atif.class_list as cg 
left join ( 
select bss.student_id as std_id, bd.bedge_title, bd.bedge_code as badge_code 
			from gs_badges.bedge_student as bss
			left join ( select * From gs_badges.badges where record_deleted = 0) as bd
			on(bd.ID=bss.bedge_id)
			where bss.record_deleted = 0  ) as bgs
			on(bgs.std_id = cg.id)
			where cg.grade_id=10 and cg.section_id=6
#group by cg.id
*/	
} // End main Class
	

