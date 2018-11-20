<?php
class Staff_registered_tipb_module extends CI_Model{
	
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	// -----------------------------------------
	//   Get Staff information by employee id
	// -----------------------------------------
	
		public function getEmployeeInformation( $employee_id ){
			$this->db->select('*');
			$this->db->from('staff_registered');
			//$this->db->where('employee_id', $employee_id);
			$this->db->where('gt_id', $employee_id); 
			$query = $this->db->get();
			$singleRow = $query->row();
			return $singleRow;
				
		}
		
		// update function 
		
		public function updateEmployeeInformation( $data,$where ){
			
			$this->db->where('id',$where);
			$tableName = 'staff_registered';
			$this->db->update($tableName,$data);
			$this->db->affected_rows();
		}
			
		
	// -------- End Get Staff Information ------
	
	
	
	
	// ---------------------------------------------------
	//  Get Staff Contact Information 
	// ---------------------------------------------------
	
		public function getEmployeeContactInfo( $employee_id ){
			$this->db->select('*');
			$this->db->from('staff_contact_info');
			$this->db->where('staff_id', $employee_id); 
			$query = $this->db->get();
			$singleRow = $query->row();	
			return $singleRow;
		}
		
		// insertation
		
		public function insertStaffContactInfo( $data  ){
			$tableName = 'staff_contact_info';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function updateStaffContactInfo( $data,$staffID ){
			
			$this->db->where('staff_id',$staffID);
			$tableName = 'staff_contact_info';
			$this->db->update($tableName,$data);
			$this->db->affected_rows();
		}
	
	// -------- End Staff Contact Information ------
	
	
	
	
	// ---------------------------------------------------
	//  Get Staff Qualification School
	// ---------------------------------------------------
	
		public function getEmpQuaificaton( $employee_id ,$level ){
			$this->db->select('*');
			$this->db->from('staff_registered_qualification');
			$this->db->where('staff_id', $employee_id); 
			$this->db->where('level', $level ); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}	
		}
		
		
		// insertation
		
		public function insertStaffQualification( $data  ){
			$tableName = 'staff_registered_qualification';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function removeStaffQualification( $staffID, $levelID ){
			
			$this->db->where('level', $levelID);
			$this->db->where('staff_id',$staffID);
			$this->db->delete('staff_registered_qualification');
		}
		
		
	
	// -------- End Staff Qualification School ------
	
	
	
	
	
	
	// ---------------------------------------------------
	//  Get Staff Employment History
	// ---------------------------------------------------
	
		public function getEmpEmploymentHistory( $employee_id  ){
			$this->db->select('*');
			$this->db->from('staff_registered_employement');
			$this->db->where('staff_id', $employee_id); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		
		// insertation
		
		public function insertStaffEmploymentHistory( $data  ){
			$tableName = 'staff_registered_employement';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function RemoveStaffEmploymentHistory( $staffID ){
			
			$this->db->where('staff_id',$staffID);
			$this->db->delete('staff_registered_employement');
		}
		
	
	// -------- End Staff Employeement History ------
	
	
	
	// ---------------------------------------------------
	//  Get Staff Spouse
	// ---------------------------------------------------
	
		public function getEmpSpouse( $employee_id  ){
			$this->db->select('*');
			$this->db->from('staff_registered_father_spouse');
			$this->db->where('staff_id', $employee_id); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		
		
		// insertation
		
		public function insertEmpSpouse( $data ){
			$tableName = 'staff_registered_father_spouse';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function removeEmpSpouse( $staffID, $type ){
			
			$this->db->where('staff_id',$staffID);
			$this->db->where('spouseType',$type);
			$this->db->delete('staff_registered_father_spouse');
			
			
		}
		
	
	// -------- End Staff Spouse ----------------------------
	
	
	
	// ---------------------------------------------------
	//  Get Staff Spouse
	// ---------------------------------------------------
	
		public function getEmpChild( $employee_id  ){
			$this->db->select('student_registered.*');
			$this->db->from('staff_child');
			$this->db->join('student_registered', 'staff_child.gf_id = student_registered.gf_id');
			$this->db->where('staff_child.staff_id', $employee_id); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		
		// insertation
		
		public function insertEmpChild( $data ){
			$tableName = 'staff_child';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function updateEmpChild( $data, $staffID ){
			
			$this->db->where('staff_id',$staffID);
			$tableName = 'staff_child';
			$this->db->update($tableName,$data);
			$this->db->affected_rows();
		}
		
	
	// -------- End Staff Spouse ----------------------------
	
	
	
	// ---------------------------------------------------
	//  Get Staff Spouse
	// ---------------------------------------------------
	
		public function getEmpAlternativeContact( $employee_id, $type  ){
			$this->db->select('*');
			$this->db->from('staff_registered_alternativeContact');
			$this->db->where('staff_id', $employee_id); 
			$this->db->where('type', $type); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		
		
		// insertation
		
		public function insertEmpAlternativeContact( $data ){
			$tableName = 'staff_registered_alternativeContact';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function removeEmpAlternativeContact( $staffID ,$type ){
			
			
			$this->db->where('staff_id',$staffID);
			$this->db->where('type',$type);
			$this->db->delete('staff_registered_alternativeContact');
			
			
		}
	
	// -------- End Staff Spouse ----------------------------
	
	
	
	
	// ---------------------------------------------------
	//  Get Staff Bank Account Information
	// ---------------------------------------------------
	
		// Get or Reteive
		public function getEmpBankAccount( $employee_id  ){
			$this->db->select('*');
			$this->db->from('staff_registered_bank_account');
			$this->db->where('staff_id', $employee_id); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		
		// insertation
		
		public function insertEmpBankAccount( $data ){
			$tableName = 'staff_registered_bank_account';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
	
		
		// updatation
		public function removeEmpBankAccount( $staffID  ){
			
			
			$this->db->where('staff_id',$staffID);
			$this->db->delete('staff_registered_bank_account');
			
			
		}
		
		
	
	// -------- End Bank Account Information ----------------------------
	
	
	
	// ---------------------------------------------------
	//  Get Staff Supporting
	// ---------------------------------------------------
	public function getEmpSupporting( $employee_id ){
			$this->db->select('*');
			$this->db->from('staff_registered_supporting');
			$this->db->where('staff_id', $employee_id); 
			$query = $this->db->get();
			
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		// Replace 
		public function replaceSupporting($data){
			$tableName = 'staff_registered_supporting';
			return $this->db->replace($tableName, $data);
		}
		// insertation
		public function insertEmpSupporting( $data ){
			$tableName = 'staff_registered_supporting';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function updateEmpSupporting( $staffID, $data ){
			
			$this->db->where('staff_id',$staffID);
			$tableName = 'staff_registered_supporting';
			$this->db->update($tableName,$data);
			$this->db->affected_rows();
		}
		
	// -------- End Staff Supporting ----------------------------
	
	
	
	
	
	// ---------------------------------------------------
	//  Get Staff Takaful
	// ---------------------------------------------------
	public function getEmptakaful( $employee_id ){
		$this->db->select('*');
		$this->db->from('staff_registered_takaful');
		$this->db->where('staff_id', $employee_id); 
		$query = $this->db->get();
		if( $query->num_rows() > 0 ){
			$results = $query->result();
			return $results;
		}else{
			return false;
		}
	}
	
	
	
	// insertation
		
		public function insertEmptakaful( $data ){
			$tableName = 'staff_registered_takaful';
			$this->db->insert($tableName,$data);
			return $this->db->insert_id();
		}
		
		// updatation
		public function removeEmptakaful( $staffID ){
			$this->db->where('staff_id',$staffID);
			$this->db->delete('staff_registered_takaful');
		}
		
		
	// -------- End Staff Spouse ----------------------------
	
	
	
	
	
	// ----------------------------------------
	// --- Insert Basic Information Tab Data --
	// ----------------------------------------
		public function saveBasicInfo($data){
			
			 $this->db->insert('staff_registered', $data); 
			 $ID = $this->db->insert_id();
			return $ID;
		}
	// ----------------------------------------
	// --- End Basic Information Tab Data --
	// ----------------------------------------
	
	
	
	// ----------------------------------------
	// --------- Insert Supporting Data -------
	// ----------------------------------------
		public function saveSupporting($data){
			
			$ID = $this->db->insert('staff_registered_supporting', $data); 
			return $ID;
		}
	// ----------------------------------------
	// --------- End Supporting  Data ---------
	// ----------------------------------------
	
	
	// -------------------------------------------
	//  Retrieve data from clas list view
	// -------------------------------------------
		public function getEmployeeChildDetail($GFID){
			
			$this->db->select('*');
			$this->db->from('class_list');
			$this->db->where('gf_id', $GFID); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->result();
				return $results;
			}else{
				return false;
			}
		}
		
		
		public function getEmployeeGFID($staff_id){
			$this->db->select('gf_id');
			$this->db->from('staff_child');
			$this->db->where('staff_id', $staff_id); 
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				$results = $query->row();
				return $results;
			}else{
				return false;
			}
		}
		public function getEChildrenDetail( $GFID ){
			$this->db->select('s.official_name, s.DOB, s.gs_id, cl.section_name, cl.grade_name');
			$this->db->from('student_registered as s');
			$this->db->join('class_list as cl', 'cl.gs_id = s.gs_id ','left');
			$this->db->where('s.gf_id',$GFID);
			$query = $this->db->get();
			if( $query->num_rows() > 0 ){
				return $query->result();
				
			}else{
				return false;
			}
			
		}

		
	// -------------- End class list view


		// ========== Address ==================//

	public function get_by($tablename,$where=null,$select_col=''){

		if($select_col == ''){
			$this->db->select();
		}
		else if ($select_col != ''){
			$this->db->select($select_col);
		}

		$this->db->from($tablename);

		if($where == null){

		}
		else if($where != null){
			$this->db->where($where);
		}

		$query = $this->db->get();
		$row = $query->result();

		if($row != null){
			return $row;
		}
		else if($row == null){
			return false;
		}

	}

	public function insert_data($tablename,$data){

		$this->db->insert($tablename,$data);
		$affected = $this->db->affected_rows();
		return $affected;
	}

	public function save($tablename,$data,$where){

		$this->db->where($where);
		$this->db->update($tablename,$data);
		$affected = $this->db->affected_rows();
		
	}

	public function get_region($staff_id){
		$query = "SELECT r.id,r.name FROM `staff_contact_info` sci 
				  inner join atif._region r on r.id = sci.region
				  where sci.staff_id = ".$staff_id;
		$row = $this->db->query($query);
		return $row->result();
	}

	public function get_sub_region($staff_id){

		$query = "SELECT rs.id,rs.name,rs.region_id FROM `staff_contact_info` sci 
				  inner join _region_sub  rs on rs.id = sci.sub_region
				  where sci.staff_id = ".$staff_id ;
		$row = $this->db->query($query);
		return $row->result();
	}
	
}