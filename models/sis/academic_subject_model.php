<?php
class Academic_subject_model extends CI_Model{

	private $db_staff_integration;

	function __construct()
	{
		parent::__construct();
		$this->db_staff_integration = $this->load->database('role',TRUE);
	}


	protected $_table_name = 'academic_subject';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'parent_id asc';	
	protected $_timestamps = TRUE;


	public function getAllSubjects()
	{
		$query=$this->db->query("select id, name, dname, parent_id, if(parent_id = 0, id, parent_id) as subject_order
			from academic_subject order by subject_order asc, parent_id asc, dname asc");
		$rows_array = $query->result_array();		
				
        return $rows_array;        
	}
	

	public function getSubjectList()
	{
		$query=$this->db->query("select id, name, dname, parent_id, if(parent_id = 0, id, parent_id) as subject_order
			from academic_subject order by subject_order asc, parent_id asc, dname asc");
		$rows_array = $query->result_array();
		

		$subjectList = "";
		$previousParentID = 0;
 	

        $CloseParent = false;
		foreach ($rows_array as $data) {					
		
			if($data['parent_id'] == 0){
				if($CloseParent){
					$subjectList .= '</ol></li>';
					$CloseParent = false;            						
				}
				$subjectList .= $this->makeParentLI($data['id'], $data['dname']);
			}else if($data['parent_id'] == $previousParentID){
				
				$subjectList .= $this->makeChild($data['id'], $data['dname']);
				$CloseParent = true;
			}else{
				$subjectList = substr($subjectList, 0, -5);
				$subjectList .= $this->makeChildLI($data['id'], $data['dname']);
				$CloseParent = true;
			}

			$previousParentID = $data['parent_id'];
		}
				
        return $subjectList;        
	}


	private function makeParentLI($ID, $Name){
		$String = '
		<li class="dd-item" data-id="' . $ID . '">
          <div class="dd-handle">' . $Name . '</div>
        </li>';

		return $String;
	}


	private function makeChildLI($ID, $Name){
		$String = '
		<ol class="dd-list">
			<li class="dd-item" data-id="' . $ID . '">
	          <div class="dd-handle">' . $Name . '</div>
	        </li>';
	        		
        return $String;
	}


	private function makeChild($ID, $Name){
		$String = '		
			<li class="dd-item" data-id="' . $ID . '">
	          <div class="dd-handle">' . $Name . '</div>
	          </li>';

	    return $String;
   }


	

	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_integration->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_staff_integration->where('record_deleted', 0);
		if(!count($this->db_staff_integration->ar_orderby)){
			$this->db_staff_integration->order_by($this->_order_by);
		}
		return $this->db_staff_integration->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_staff_integration->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_staff_integration->set($data);
			$this->db_staff_integration->insert($this->_table_name);
			$id = $this->db_staff_integration->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_staff_integration->set($data);
			$this->db_staff_integration->where($this->_primary_key, $id);
			$this->db_staff_integration->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_staff_integration->where($this->_primary_key, $id);
		$this->db_staff_integration->limit(1);
		$this->db_staff_integration->delete($this->_table_name);
	}
}