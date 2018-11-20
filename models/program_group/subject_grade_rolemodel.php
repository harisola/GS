<?php
class Subject_grade_rolemodel extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->role=$this->load->database('role',TRUE);
	}

	public function get_by($tablename,$where=null,$select='',$group ='')
	{
		if($select == ''){
			$this->role->select();
		}
		else if($select != ''){
			$this->role->select($select);
		}

		$this->role->from($tablename);

		if($where == null){

		}
		else if ($where != null)
		{
			$this->role->where($where);
		}

		if($group == '')
		{

		}
		else if($group != '')
		{
			$this->role->group_by($group); 
		}

		$row = $this->role->get();
		if($row == null){
			return false;
		}
		else if($row != null){
		return $row->result();
		}

	}
//
//
	public function get_join($where,$grade,$academic)
	{
		//$query="Select p.id,s.name,s.code,p.blocks_per_week,p.subject_id  From atif_subject.program p inner join atif_subject.subject s on s.id  = p.subject_id where optional  = ".$where." and grade_id =".$grade." and academic_session_id = ".$academic ." order by p.position asc";
		
		$sqlQuery = "Select p.id,s.name,s.code,p.blocks_per_week,p.subjects From atif_subject.programmesetup p inner join atif_subject.subject s on s.id = p.subjects where optional = ".$where." and gradeID = ".$grade." and `sessionID` = ".$academic ." order by p.id asc";
		
		$row = $this->db->query($sqlQuery);
		return $row->result();
	}

	public function get_distinct($tablename,$grade,$academic)
	{

			$query = 'SELECT distinct subject_selection_group_id FROM '.$tablename . ' Where grade_id =  '.$grade. ' And academic_session_id =  '. $academic;
			$row = $this->db->query($query);
			return $row->result();

	}

	public function get_subject($group_id,$grade_id,$academic)
	{
		$query = 'SELECT ssgg.subject_id,sub.name FROM atif_subject.`subject_selection_group_grade` ssgg join atif_subject.subject sub on ssgg.subject_id = sub.id where ssgg.subject_selection_group_id = '.$group_id.' '.' and ssgg.grade_id = '.$grade_id. ' '.'and academic_session_id = '.$academic.' and ssgg.record_deleted = 0 ';
		$row = $this->db->query($query);
		return $row->result();
	}


	public function get_blocks($group_id,$grade,$academic){

		$query = "SELECT ssgg.blocks_per_week FROM atif_subject.subject_selection_group_grade ssgg where ssgg.grade_id = ". $grade . " and ssgg.subject_selection_group_id = " .$group_id. " and ssgg.record_deleted = 0 group by ssgg.blocks_per_week;";
		$row = $this->db->query($query);
		return $row->result();
	}

	public function update($tablename,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($tablename,$data);
		$row = $this->db->affected_rows();
		return $row;
	}

	public function insert_data($tablename,$data){

		$this->db->insert($tablename,$data);
		$affected = $this->db->affected_rows();
		return $affected;
	}


	


}

