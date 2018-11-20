<?php

class Subject_grade_model extends CI_Controller{

		public function __construct(){ 
			parent::__construct();
			$this->subject = $this->load->database('subject',TRuE);
		}

		public function get_by($tablename,$select='',$where=Null){
			
			if($select == ''){
				$this->subject->select();
			}
			else if($select != ''){
				$this->subject->select($select);
			}
			$this->subject->from($tablename);
			if($where == null){

			}
			else if($where != null){
				$this->subject->where($where);
			}
			$query=$this->subject->get();
			$row = $query->result();
			if($row == null)
			{
				return false;
			}
			else if($row != null)
			{
				return $row;
			}	

		}

		public function save($tablename,$data)
		{
			$this->subject->insert($tablename,$data);
			return  $this->subject->insert_id();
		}

		public function get_all()
		{
			$query = "SELECT asg.id,aas.name as academic_name ,gr.name as grade_name,sub.name as subject_name,ssg.name as 			  group_name,asg.position
					  FROM `subject_selection_grade` asg 
					  inner join atif._academic_session aas on asg.academic_session_id = aas.id inner join 
					  atif._grade gr on asg.grade_id =gr.id inner join 
					  subject sub on sub.id = asg.subject_id inner join 
					  subject_selection_group ssg on ssg.id = asg.subject_selection_group_id";
			$result = $this->subject->query($query);
			$row = $result->result();
			if ($row == null)
			{
				return false;
			}
			else if($row != null)
			{
				return $row;
			}

		}

		public function update($tablename,$where,$data)
		{
			$this->subject->where($where);
			$this->subject->update($tablename,$data);
			$affected_row =$this->subject->affected_rows();
			return $affected_row;
		}

		public function delete_data($tablename,$where){
			$this->subject->where($where);
			$this->subject->delete($tablename);
			$affected_row = $this->subject->affected_rows();
			return $affected_row;
		}




		
}