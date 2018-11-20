<?php 

class Formative_report_model extends CI_Controller{
	public function __Construct(){
		parent::__construct();
		$this->load->database('atif_assessment',TRUE);
	}

	public function get_by($tablename,$select='',$where=null,$group=''){

		// Table Name

		

		// Selection

		$this->db->from($tablename);
		if($select == ''){
			$this->db->select();
		}
		else if($select != ''){
			$this->db->select($select);
		}

		// Where Condition

		if($where == null){

		}
		else if($where != null){
			$this->db->where($where);
		}



		//Group By

		if($group == ''){
		}
		else if($group != ''){
			$this->db->group_by($group);
		}

		// Get Query Result

		$query = $this->db->get();
		$row = $query->result();

		if($row == null){
			return false;
		}
		else if($row != null){
			return $row;
		}



	}

	public function getProgramme($gradeID,$academic_id){
		$sql = "SELECT ps.id,ps.subjects,ps.sessionID,s.name,ps.optional 
				  FROM atif_subject.programmesetup ps 
				  inner join atif_subject.subject s on s.id = ps.subjects
				  where ps.gradeID = ".$gradeID." and ps.sessionID = ".$academic_id;
		$query = $this->db->query($sql);

		return $query->result();
		if(empty($query->result())){
			return false;
		}
		else if (!empty($query->sresult())){
			return $query->result();
		}
	}
	
	public function get_subjectblocks($key,$program_id,$subject_id){
		$query="SELECT * From atif_subject.subjectblock where `key` ='".$key."' and programID =".$program_id." and subject =".$subject_id;
		$row = $this->db->query($query);
		$result = $row->result();
		return $result;
	}

	public function studentselectedblock($blockID,$block){

		$query = "SELECT acl.gs_id,acl.abridged_name,acl.std_status_code FROM atif_subject.studentselectedblock ssb inner join atif.class_list acl on acl.id = ssb.studentID  where blockID = ".$blockID." and subjectBlock = ".$block." and acl.std_status_category = 'Student' order by acl.call_name";
		$row = $this->db->query($query);
		$result=$row->result_array();
		return $result;

	}		
}	