<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tifb extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->library('upload');
        $this->load->library('image_lib');
		$this->load->model('staff/staff_registered_tipb_module', 'tifb_module' );
	}
	
	public $validation_visitor_admission = array(		
		array('field' => 'gs_id', 'label' => 'GS-ID or GF-ID', 'rules' => 'trim|sanitize|callback_verifyFIFID')		
	);
	


	function verifyFIFID($str)
	{
	   $field_value = $str;	   
	   
	   if($this->input->post('gs_id') == "" && $this->input->post('gf_id') == "")
	   {
	     return FALSE;
	   }
	   else
	   {
	     return TRUE;
	   }
	   
	}  
	public function index(){
		
		
		
		if($this->input->post('solangigtID') != ''){
			
			$solangigtID= $this->input->post('solangigtID');
			$this->makePDFFile($solangigtID);
		}
		
		$this->form_validation->set_rules($this->validation_visitor_admission);
		$this->form_validation->set_message('verifyFIFID','GS-ID or GF-ID is required');	
		
		if($this->form_validation->run() == FALSE){
			
			if(count($_POST)){
				$GSID = $this->input->post('gs_id');
				$GFID = $this->input->post('gf_id');				
			}
				
			$this->load->view('staff_information_form/fif_form_id');
			$this->load->view('staff_information_form/footer.php');
			
			
		}else{
			
		$employee_id = $this->input->post('gs_id');
		
		if( $this->tifb_module->getEmployeeInformation( $employee_id ) ){
			
		$data['employer'] = $this->tifb_module->getEmployeeInformation( $employee_id );
		$staff_id  =  $data['employer']->id;
		
		if( $this->getContactInfo($staff_id ) ){
			$data['empContactInfo'] =  $this->getContactInfo($staff_id );
		}else{ $data['empContactInfo'] = NULL; 	}
		$getSchool = 1;	
		if( $this->getQualification($staff_id, $getSchool ) ){
			$data['empQSchool'] = $this->getQualification($staff_id, $getSchool);	
		}else{ $data['empQSchool'] = NULL;	 }
		
		$getCollege = 2;
		if( $this->getQualification($staff_id, $getCollege ) ){ 
			$data['empQCollege'] = $this->getQualification($staff_id, $getCollege ); 
		}else{ $data['empQCollege'] = NULL;	 }
		
		$getUniversity = 3;
		if( $this->getQualification($staff_id, $getUniversity ) ){ 
			$data['empQUniversity'] = $this->getQualification($staff_id, $getUniversity ); 
		}else{ $data['empQUniversity'] = NULL;	 }
		
		$getProfessional = 4;
		if( $this->getQualification($staff_id, $getProfessional ) ){ 
			$data['empQProfessional'] = $this->getQualification($staff_id, $getProfessional ); 
		}else{ $data['empQProfessional'] = NULL;	 }
		
		$getOthers = 5;
		if( $this->getQualification($staff_id, $getOthers ) ){ 
			$data['empQOthers'] = $this->getQualification($staff_id, $getOthers ); 
		}else{ $data['empQOthers'] = NULL;	 }
		
		// get employment history
		if( $this->getEmploymentHistroy($staff_id) ){ 
			$data['empEHistory'] = $this->getEmploymentHistroy( $staff_id );
		}else{ $data['empEHistory'] = NULL;	 }
		
		
		// Get reteive employee spuose
		if( $this->getEmpSouse($staff_id) ){ 
			$data['empSpouses'] = $this->getEmpSouse( $staff_id );
		}else{ $data['empSpouses'] = NULL;	 }
		
		
		//$staff_id = 11;
		// Get reteive employee spuose
		/*
		if( $this->getEmpChildren($staff_id) ){ 
			$data['empChildren'] = $this->getEmpChildren( $staff_id );
		}else{ $data['empChildren'] = NULL;	 }
		*/
		
		
		
		if( $this->getEmpGFID($staff_id) ){ 
			$gfid  =  $this->getEmpGFID( $staff_id );
			$gfID  =  $gfid->gf_id;
			
			
		}else{ 
			 $gfID  = NULL;	 
		} 
		
		if( $gfID != NULL ){ 
		 $data['empChildren'] = $this->getEmpChildren( $gfID );
		 //$data['empChildren'] = $this->getClassList( $gfID );
		}else{ $data['empChildren'] = NULL;	 } 
		
		//$staff_id = 1;
		
		// Get reteive employee spuose
		$type = 1;
		if( $this->getEmpAlterCont($staff_id,$type) ){ 
			$data['getEmpAlterContKIN'] = $this->getEmpAlterCont( $staff_id,$type );
		}else{ $data['getEmpAlterContKIN'] = NULL;	 }
		
		$type = 2;
		if( $this->getEmpAlterCont($staff_id,$type) ){ 
			$data['getEmpAlterContEmergn'] = $this->getEmpAlterCont( $staff_id,$type );
		}else{ $data['getEmpAlterContEmergn'] = NULL;	 }
		
		if( $this->getEmpBank($staff_id ) ){ 
			$data['employeBank'] = $this->getEmpBank( $staff_id );
		}else{ $data['employeBank'] = NULL;	 }
		
		
		if( $this->getEmpSupport($staff_id ) ){ 
			$data['employeSupporting'] = $this->getEmpSupport( $staff_id );
		}else{ $data['employeSupporting'] = NULL; }
		
		//print_r($data['employeSupporting']);
		//exit;
		
		if( $this->getEmployeTakaful($staff_id ) ){ 
			$data['employeTakaful'] = $this->getEmployeTakaful( $staff_id );
		}else{ $data['employeTakaful'] = NULL; }

		$where_staff = array(
			'staff_id'=> $staff_id
		);
		if($this->tifb_module->get_by('atif.staff_contact_info',$where_staff)){
			$data['get_adress'] = $this->tifb_module->get_by('atif.staff_contact_info',$where_staff);
			// var_dump($data['get_adress']);
		}
		else{
			$data['get_adress'] = null;
		}

		if($this->tifb_module->get_region($staff_id)){
			$data['get_region'] = $this->tifb_module->get_region($staff_id);
			$region_id = $data['get_region'][0]->id;
		}
		else{
			$data['get_region'] = null;
		}

		if($this->tifb_module->get_sub_region($staff_id)){
			$data['get_sub_region'] = $this->tifb_module->get_sub_region($staff_id);
		}
		else{
			$data['get_sub_region'] = null;
		}



		if($this->tifb_module->get_by('atif._region')){
			$data['region'] = $this->tifb_module->get_by('atif._region');
		}
		else{
			$data['region'] = null;
		}


		if($this->tifb_module->get_by('atif._region_sub')){
			$data['sub_region_all'] = $this->tifb_module->get_by('atif._region_sub');
		}
		else{
			$data['sub_region_all'] = null;
		}


		
		
		$this->load->view('staff_information_form/tip_basic.php', $data );
		$this->load->view('staff_information_form/footer.php');
		
		
			
		}else{
			
			
			$data["noRecordFound"] = "Sorry No Record Found!";
			$this->load->view('staff_information_form/fif_form_id', $data );
			$this->load->view('staff_information_form/footer.php');
		}
		
		
		
		
		//$this->load->view('class_list/face_view/face_view_orb_footer.php');
		
		
		}// end main else
		
	}
	
	// ================================================
	//  Staff Register Table
	// ================================================
	
		public function updateStaffRegister( $data,$where ){
			return $this->tifb_module->updateEmployeeInformation( $data,$where );
		}
	
	//============End Staff Register Table =============
	
	
	
	// =================================================
	// Function for reteive contact information 
	// =================================================
		public function getContactInfo( $staffID ){
			
		if( $this->tifb_module->getEmployeeContactInfo( $staffID ) ){
			return $this->tifb_module->getEmployeeContactInfo( $staffID );
		}else{
			return FALSE;
		}
		}
	// ===========================================
	
	
	// ===========================================
	// Function for retieve employee education 
	// records level wise like school level, college level etc..
	// ===========================================
		public function getQualification($staffID, $levelID ){
			return $this->tifb_module->getEmpQuaificaton( $staffID, $levelID );	
		}
		
		public function removeQualification($staffID, $levelID ){
			
			return $this->tifb_module->removeStaffQualification( $staffID, $levelID );
		}
		// insert 
		public function insertQualification( $data ){
			return $this->tifb_module->insertStaffQualification( $data );	
			
		}
		
		
		// update
		public function updateQualification($data, $staffID, $levelID ){
			if( $this->tifb_module->getEmpQuaificaton( $staffID,$levelID ) ){
				return $this->tifb_module->getEmpQuaificaton( $staffID, $levelID );	
			}else{
				return FALSE;	
			}
		}
		
		
	// ================ End =================
	
	
	
	
	// ======================================================
	//  Function for retieve employee employment experience
	// ======================================================
		public function getEmploymentHistroy($staffID ){
			if( $this->tifb_module->getEmpEmploymentHistory( $staffID ) ){
				return $this->tifb_module->getEmpEmploymentHistory( $staffID );
			}else{
				return FALSE;	
			}
		}
	
		public function removeEmploymentHistroy($staffID ){
			return $this->tifb_module->RemoveStaffEmploymentHistory( $staffID  );
		}
		// insert 
		public function insertEmploymentHistroy( $data ){
			return $this->tifb_module->insertStaffEmploymentHistory( $data );	
			
		}
	
	// ========================== End ========================
	
	
	
	// =======================================================
	//  Function for retieve employee employment experience
	// =======================================================
	public function getEmpSouse($staffID ){
		if( $this->tifb_module->getEmpSpouse( $staffID ) ){
			return $this->tifb_module->getEmpSpouse( $staffID );
		}else{
			return FALSE;	
		}
	}
	
	
	
	public function removeEmpSouse($staffID,$type ){
			return $this->tifb_module->removeEmpSpouse( $staffID,$type  );
		}
		// insert 
		public function insertEmpSouse( $data ){
			return $this->tifb_module->insertEmpSpouse( $data );	
			
		}
		
		
	// ========================== End ===========================
	
	
	
	
	// =======================================================
	//  Function for retieve employee children
	// =======================================================
		public function getEmpChildren( $gfID ){
			//return $this->tifb_module->getEmpChild( $staffID );
			return $this->tifb_module->getEChildrenDetail( $gfID );
		}
		
		public function getEmpGFID($staffID){
			return $this->tifb_module->getEmployeeGFID( $staffID );
		}
		
		
		// get Class list view data
		public function getClassList($GFID){
			return $this->tifb_module->getEmployeeChildDetail( $GFID );
		}
		
		
	// ========================== End ===========================
	
	
	// =======================================================
	//  Function for retieve employee children
	// =======================================================
		public function getEmpAlterCont($staffID,$type ){
			if( $this->tifb_module->getEmpAlternativeContact( $staffID ,$type ) ){
				return $this->tifb_module->getEmpAlternativeContact( $staffID,$type );
			}else{
				return FALSE;	
			}
		}
		
		public function removeEmpAlterCont($staffID,$type ){
			return $this->tifb_module->removeEmpAlternativeContact( $staffID,$type  );
		}
		// insert 
		public function insertEmpAlterCont( $data ){
			return $this->tifb_module->insertEmpAlternativeContact( $data );	
			
		}
		
		
		
	// ========================== End ===========================
	
	
	// =======================================================
	//  Function for retieve employee children
	// =======================================================
		public function getEmpBank($staffID ){
			if( $this->tifb_module->getEmpBankAccount( $staffID ) ){
				return $this->tifb_module->getEmpBankAccount( $staffID  );
			}else{
				return FALSE;	
			}
		}
		
		public function removeEmpBank($staffID  ){
			return $this->tifb_module->removeEmpBankAccount( $staffID  );
		}
		// insert 
		public function insertEmpBank( $data ){
			return $this->tifb_module->insertEmpBankAccount( $data );	
			
		}
		
	// ========================== End =========================
	
	
	
	// =======================================================
	//  Function for retieve employee Supporting
	// =======================================================
		public function getEmpSupport($staffID ){
			if( $this->tifb_module->getEmpSupporting( $staffID ) ){
				return $this->tifb_module->getEmpSupporting( $staffID  );
			}else{
			return FALSE;	
			}
		}
		
		public function overWriteSupporting( $data ){
			
			//return $this->tifb_module->replaceSupporting( $data );
			return $this->tifb_module->insertEmpSupporting( $data );
		}
		
		public function updateSupporting( $staffID, $data ){
			
			return $this->tifb_module->updateEmpSupporting( $staffID, $data );
		}
		
	// ========================== End =========================
	
	
	
	// =======================================================
	//  Function for retieve employee takaful
	// =======================================================
	
		public function getEmployeTakaful($staffID ){
			if( $this->tifb_module->getEmptakaful( $staffID ) ){
				return $this->tifb_module->getEmptakaful( $staffID  );
			}else{
				return FALSE;	
			}
		}
		
		public function removeEmployeTakaful($staffID  ){
			return $this->tifb_module->removeEmptakaful( $staffID  );
		}
		// insert 
		public function insertEmployeTakaful( $data ){
			return $this->tifb_module->insertEmptakaful( $data );	
			
		}
		
	
	// ========================== End =========================
	
	
	
	
	
	public function add(){
		// Basic infor variables
		exit;
		$staffID = $this->input->post('staffID');
		$campus = $this->input->post('campus');
		$empImage = $this->input->post('empImage');
		$fullName = $this->input->post('fullName');
		$gender = $this->input->post('gender');
		$nameCode = $this->input->post('nameCode');
		$nationality = $this->input->post('nationality');
		$cnic = $this->input->post('cnic');
		$gtID = $this->input->post('gtID');
		
		$mobileNumber = $this->input->post('mobileNumber');
		$landLineNumber = $this->input->post('landLineNumber');
		$guID = $this->input->post('guID');
		
		$emai1l = $this->input->post('email');
		
		
		$maritalStatus = $this->input->post('maritalStatus');
		$dateOfBith = $this->input->post('dateOfBith');
		$employmentStauts = $this->input->post('employmentStauts');
		
		/*$religion = $this->input->post('religion');
		
		$address = $this->input->post('address');
		$imageName = "sc_name";
		$return =  $this->imageUpload( $imageName );
		$fullImage =  $return['imageName'];
		$thumbnail = $return['imageThumb'];*/
		
		$eobiNumber = $this->input->post('eobiNumber');
		$sessiNumber = $this->input->post('sessiNumber');
		
		
		
		if($gender == 'male'){
			$title_person_id = 1;
			$gender = 'M';
		}else{
			$title_person_id = 2;
			$gender = 'F';
		}
			
		$funame = explode(" ", $fullName);
		$lastName = end($funame); 
		
		$basicInfo = array(
			//'employee_id' => rand(),
			//'gt_id'	=> $gtID,
			//'title_person_id' => $title_person_id,
			//'name'	=> $fullName,
			//'name_code'	=> $nameCode,
			//'abridged_name'	=> $fullName,
			//'first_name'	=> $funame[0],
			//'last_name'	=> $lastName,
			//'nic'	=> $cnic,
			'gender'	=> $gender,
			'dob'	=> $dateOfBith,
			'category'	=> $employmentStauts,
			//'eobi_no'	=> $eobiNumber,
			//'sessi_no' => $sessiNumber,
			//'gg_id'	=> $guID,
			'branch_id'	=> $campus,
			'mobile_phone'	=> $mobileNumber,
			'land_line'	=> $landLineNumber,
			'modified' => time()
			
		);
		
		$this->updateStaffRegister( $basicInfo, $staffID );
		
		// POST Supporting
		$religion = $this->input->post('religion');
		$maritalStatus = $this->input->post('maritalStatus');
		$employmentStauts = $this->input->post('employmentStauts');
		$address = $this->input->post('basicAddress');
		$imageName = "sc_name";
		$return =  $this->imageUpload( $imageName );
		$fullImage =  $return['imageName'];
		$thumbnail = $return['imageThumb'];
		$providentFund = $this->input->post('providentFund');
		$ntnNumber = $this->input->post('ntnNumber');
					
		if( $fullImage != '' ){
			
			$supporting  = array(
			'staff_id' => $staffID,
			'religion' => $religion,
			'employment_status' => $maritalStatus,
			'fullImage' => $fullImage,
			'thumbnail' => $thumbnail,
			'address' => $address,
			'providentFund' => $providentFund,
			'nationalTaxNumber' => $ntnNumber,
			'emailPersonal' => $emai1l
			);
		}else{
			$supporting  = array(
			'staff_id' => $staffID,
			'religion' => $religion,
			'employment_status' => $maritalStatus,
			'address' => $address,
			'providentFund' => $providentFund,
			'nationalTaxNumber' => $ntnNumber,
			'emailPersonal' => $emai1l
			);
		}
		if($this->getEmpSupport($staffID) ){
			$this->updateSupporting( $staffID, $supporting );
		}else{
			$this->overWriteSupporting( $supporting );	
		}
		
		
		// Educational Record Tabs

		$schoolName = $this->input->post('schoolName');
		$schoolSubject = $this->input->post('schoolSubject');
		
		$schoolQualification = $this->input->post('schoolQualification');
		$schoolResult = $this->input->post('schoolResult');
		
		$schoolYear = $this->input->post('schoolYear');
		$noOfSchools = $this->input->post('level');
		$levelID = 1;
		$this->removeQualification($staffID,$levelID );
		for ($i=0; $i<sizeof($noOfSchools); $i++){
			if( $schoolName[$i] != '' ){
				$inSchool = array(
					'staff_id' => $staffID,
					'level' => 1,
					'title' => $schoolName[$i],
					'institute' => $schoolName[$i],
					'subjects' => $schoolSubject[$i],
					'qualification' =>$schoolQualification[$i],
					'result' => $schoolResult[$i],
					'year_of_completion' => $schoolYear[$i],
				);
				$this->insertQualification( $inSchool );	
			}
		}
		$collegeName = $this->input->post('collegeName');
		$collegeSubject = $this->input->post('collegeSubject');
		
		$collegeQualification = $this->input->post('collegeQualification');
		$collegeResult = $this->input->post('collegeResult');
		
		
		$collegeYear = $this->input->post('collegeYear');
		$collegeLevel = $this->input->post('collegeLevel');
		$levelID = 2;
		$this->removeQualification($staffID,$levelID );
		for ($i=0; $i<sizeof($collegeName); $i++){
			if( $collegeName[$i] != '' ){
				$empCollege = array(
				'staff_id' => $staffID,
				'level' => 2,
				'title' => $collegeName[$i],
				'institute' => $collegeName[$i],
				'subjects' => $collegeSubject[$i],
				'qualification' =>$collegeQualification[$i],
				'result' => $collegeResult[$i],
				'year_of_completion' => $collegeYear[$i],
			);
				$this->insertQualification( $empCollege );	
			}
		}
		
		$universityName = $this->input->post('universityName');
		$universitySubject = $this->input->post('universitySubject');
		
		
		$universityQualification = $this->input->post('universityQualification');
		$universityResult = $this->input->post('universityResult');
		
		
		$universityYear = $this->input->post('universityYear');
		$universityLevel = $this->input->post('universityLevel');
		
		$levelID = 3;
		$this->removeQualification($staffID,$levelID );
		for ($i=0; $i<sizeof($universityName); $i++){
			if( $universityName[$i] != '' ){
				$empUniversity = array(
					'staff_id' => $staffID,
					'level' => 3,
					'title' => $universityName[$i],
					'institute' => $universityName[$i],
					'subjects' => $universitySubject[$i],
					'qualification' =>$universityQualification[$i],
					'result' => $universityResult[$i],
					'year_of_completion' => $universityYear[$i],
				);
				$this->insertQualification( $empUniversity );	
			}
		}
		
		$professionalName = $this->input->post('professionalName');
		$professionalSubject = $this->input->post('professionalSubject');
		
		$professionalQualification = $this->input->post('professionalQualification');
		$professionalResult = $this->input->post('professionalResult');
		
		
		$professionalYear = $this->input->post('professionalYear');
		$professionalLevel = $this->input->post('professionalLevel');
		
		$levelID = 4;
		$this->removeQualification($staffID,$levelID );
		for ($i=0; $i<sizeof($professionalName); $i++){
			if( $professionalName[$i] != '' ){
				$empProfessional = array(
					'staff_id' => $staffID,
					'level' => 4,
					'title' => $professionalName[$i],
					'institute' => $professionalName[$i],
					'subjects' => $professionalSubject[$i],
					'qualification' => $professionalQualification[$i],
					'result' => $professionalResult[$i],
					'year_of_completion' => $professionalYear[$i],
				);
				$this->insertQualification( $empProfessional );	
			}
		}
		
		$othersName = $this->input->post('othersName');
		$othersSubject = $this->input->post('othersSubject');
		
		$othersQualification = $this->input->post('othersQualification');
		$othersResult = $this->input->post('othersResult');
		
		$othersYear = $this->input->post('othersYear');
		$othersLevel = $this->input->post('othersLevel');
		
		$levelID = 5;
		$this->removeQualification($staffID,$levelID );
		for ($i=0; $i<sizeof($othersName); $i++){
			if( $othersName[$i] != '' ){
				$empOthers = array(
					'staff_id' => $staffID,
					'level' => 5,
					'title' => $othersName[$i],
					'institute' => $othersName[$i],
					'subjects' => $othersSubject[$i],
					'qualification' => $othersQualification[$i],
					'result' => $othersResult[$i],
					'year_of_completion' => $othersLevel[$i],
				);
				$this->insertQualification( $empOthers );	
			}
		}
		
		
		
		// POST employment Record
		
		$institutionName = $this->input->post('institutionName');
		$institutionDesignation = $this->input->post('institutionDesignation');
		$institutionClass = $this->input->post('institutionClass');
		$institutionSubject = $this->input->post('institutionSubject');
		$institutionSalary = $this->input->post('institutionSalary');
		$institutionFrom = $this->input->post('institutionFrom');
		$institutionTo = $this->input->post('institutionTo');
		$institutionLeavingReason = $this->input->post('institutionLeavingReason');
		$this->removeEmploymentHistroy($staffID );
		for ($i=0; $i<sizeof($institutionName); $i++){
			if( $institutionName[$i] != '' ){
				$employmentHistory = array(
					'staff_id' => $staffID,
					'organization' => $institutionName[$i],
					'designation' => $institutionDesignation[$i],
					'department' => $institutionDesignation[$i],
					'classes_taught' => $institutionClass[$i],
					'subject_taught' => $institutionSubject[$i],
					'salary' => $institutionSalary[$i],
					'from_year' => $institutionFrom[$i],
					'to_year' => $institutionTo[$i],
					'reason_for_leaving' => $institutionLeavingReason[$i],
					'description' => $institutionLeavingReason[$i],
					'created' => time(),
					'modified' => time(),
				);
				$this->insertEmploymentHistroy( $employmentHistory );	
			}
		}
		
		
		// POST Spouse's detail variables
		$spouseFatherName = $this->input->post('spouseFatherName');
		$spouseFatherprofession = $this->input->post('spouseFatherprofession');
		$spouseFatherQualification = $this->input->post('spouseFatherQualification');
		$spouseFatherDesignation = $this->input->post('spouseFatherDesignation');
		$spouseFatherCompany = $this->input->post('spouseFatherCompany');
		$spouseFatherDepartment = $this->input->post('spouseFatherDepartment');
		$spouseFatherCNIC = $this->input->post('spouseFatherCNIC');
		$spouseFatherMobile = $this->input->post('spouseFatherMobile');
		$spouseFatherAddress = $this->input->post('spouseFatherAddress');
		$father_maritalStatus = $this->input->post('father_maritalStatus');
		
		$spouseName = $this->input->post('spouseName');
		$spouseprofession = $this->input->post('spouseprofession');
		$spouseQualification = $this->input->post('spouseQualification');
		$spouseDesignation = $this->input->post('spouseDesignation');
		$spouseCompany = $this->input->post('spouseCompany');
		$spouseDepartment = $this->input->post('spouseDepartment');
		$spouseCNIC = $this->input->post('spouseCNIC');
		$spouseMobile = $this->input->post('spouseMobile');
		$spouseAddress = $this->input->post('spouseAddress');
		$spouse_maritalStatus = $this->input->post('spouse_maritalStatus');

		$spuseDetailsFather = array(
			'staff_id' => $staffID,
			'name' => $spouseFatherName,
			'profession' => $spouseFatherprofession,
			'qualification' => $spouseFatherQualification,
			'designation' => $spouseFatherDesignation,
			'company' => $spouseFatherCompany,
			'department' => $spouseFatherDepartment,
			'nic' => $spouseFatherCNIC,
			'mobile_phone' => $spouseFatherMobile,
			'address' => $spouseFatherAddress,
			//'marital_status' => $father_maritalStatus,
			'spouseType' => 1
		);
		$type = 1;
		$this->removeEmpSouse( $staffID,$type );
		$this->insertEmpSouse( $spuseDetailsFather );
		
		
		$spuseDetails = array(
			'staff_id' => $staffID,
			'name' => $spouseName,
			'profession' => $spouseprofession,
			'qualification' => $spouseQualification,
			'designation' => $spouseDepartment,
			'company' => $spouseCompany,
			'department' => $spouseDepartment,
			'nic' => $spouseCNIC,
			'mobile_phone' => $spouseMobile,
			'address' => $spouseAddress,
			//'marital_status' => $spouse_maritalStatus,
			'spouseType' => 2,
		);
		
		$type = 2;
		$this->removeEmpSouse( $staffID,$type );
		$this->insertEmpSouse( $spuseDetails );
		
		
		// POST Alternative Contact
		
		$kinName = $this->input->post('kinName');
		$kinAddress = $this->input->post('kinAddress');
		$kinEmail = $this->input->post('kinEmail');
		$kinPhone = $this->input->post('kinPhone');
		$kinRelationship = $this->input->post('kinRelationship');
		$eckinName = $this->input->post('emergencyContactName');
		$eckinAddress = $this->input->post('emergencyContactAddress');
		$eckinEmail = $this->input->post('emergencyContactEmail');
		$eckinPhone = $this->input->post('emergencyContactPhone');
		$eckinRelationship = $this->input->post('emergencyContactRelationship');
		
		
		$NextofKIN = array(
			'staff_id' => $staffID,
			'name' => $kinName,
			'address' => $kinAddress,
			'email' => $kinEmail,
			'phone' => $kinPhone,
			'relationships' => $kinRelationship,
			'type' => 1
		);
		
		$type = 1;
		$this->removeEmpAlterCont( $staffID,$type );
		$this->insertEmpAlterCont( $NextofKIN );
		
		
		
		$EmergencyContact  = array(
			'staff_id' => $staffID,
			'name' => $eckinName,
			'address' => $eckinAddress,
			'email' => $eckinEmail,
			'phone' => $eckinPhone,
			'relationships' => $eckinRelationship,
			'type' => 2
		);
		
		$type = 2;
		$this->removeEmpAlterCont( $staffID,$type );
		$this->insertEmpAlterCont($EmergencyContact);
		
		
		
		// Bank Datail
		$bankName = $this->input->post('bankName');
		$branchName = $this->input->post('branchName');
		$branchCode = $this->input->post('branchCode');
		$accountNumber = $this->input->post('accountNumber');
		
		
		$bankDetails  = array(
			'staff_id' => $staffID,
			'bank_name' => $bankName,
			'branch' => $branchName,
			'branch_code' => $branchCode,
			'account_number' => $accountNumber,
			'created' => time(),
			'modified' => time()
		);
		
		
		$this->removeEmpBank($staffID);
		$this->insertEmpBank($bankDetails);
		
		
		// POST TAKAFull
		
		$takafulSelf = $this->input->post('takafulSelf');
		$takafulSpouse = $this->input->post('takafulSpouse');
		$takafulChildern = $this->input->post('takafulChildern');
		$certificateNumber = $this->input->post('certificateNumber');
		$takafulReasonForNo = $this->input->post('takafulReasonForNo');
		
		$takaful = array( 
			'staff_id' => $staffID,
			'self' => $takafulSelf,
			'spouse' => $takafulSpouse,
			'children' => $takafulChildern,
			'certificate_no' => $certificateNumber,
			'reasons' => $takafulReasonForNo
		);
		
		$this->removeEmployeTakaful($staffID);
		$this->insertEmployeTakaful($takaful);
		
		
		
		redirect('staff_information_form_basic/tifb/', 'refresh');
		
	// end Basic info			
	}
	
	
	
	// ---------------------------------------------------------------------------------------------
	// Start image uploading and resizing process	
	// https://midpart.wordpress.com/2012/11/09/453/
	// ---------------------------------------------------------------------------------------------
	public function resize_image($sourcePath, $desPath, $width = '500', $height = '500'){
		$this->image_lib->clear();
		$config['image_library'] = 'gd2';
		$config['source_image'] = $sourcePath;
		$config['new_image'] = $desPath;
		$config['quality'] = '100%';
		$config['create_thumb'] = TRUE;
		$config['maintain_ratio'] = true;
		$config['thumb_marker'] = '';
		$config['width'] = $width;
		$config['height'] = $height;
		$this->image_lib->initialize($config);

		if ($this->image_lib->resize())
			return true;
		return false;
	}
		
		
		function do_upload($htmlFieldName, $path){
			
			$config['file_name'] = time();
			$config['upload_path'] = $path;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = '2000';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			unset($config);
			if (!$this->upload->do_upload($htmlFieldName))
			{
				return array('error' => $this->upload->display_errors(), 'status' => 0);
			} else
			{
				return array('status' => 1, 'upload_data' => $this->upload->data());
			}
		}
		
		
		public function imageUpload( $imageName ){
			$data = array();
			// $pathMain = './upload_image/source';
			$pathMain =  realpath('Assets/photos/hcm/staff/500x500');
			if (!is_dir($pathMain))
				mkdir($pathMain, 0755);

			//$pathThumb = './upload_image/100X100';
			$pathThumb =  realpath('Assets/photos/hcm/staff/150x150');
			if (!is_dir($pathThumb))
				mkdir($pathThumb, 0755);

		   $result = $this->do_upload($imageName, $pathMain);

			if (!$result['status'])
				$data['error_msg'] ="Can not upload Image for " . $result['error'] . " ";
			else
			{
				$pathThumb =  realpath('Assets/photos/hcm/staff/150x150');
				if (!is_dir($pathThumb))
				mkdir($pathThumb, 0755);

				$imageThumbName = time().'150X150.gif';
				//in other folder
				if($this->resize_image($pathMain . '/' . $result['upload_data']['file_name'], $pathThumb . '/'.$imageThumbName,'150','150')){
					$return = array(
						'imageName' => $result['upload_data']['file_name'],
						'imageThumb' => $imageThumbName
					);
					return $return;// 'Image 150X150 resize done';
				}else{
					return FALSE;
				}
					
			}
					
		}
	// ----------------------------------------
	// End image uploading and resizing process
	// ----------------------------------------
	
	
	
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

	public function makePDFFile($solangigtID){
		
	// 			ini_set('display_errors', 'on');
	// error_reporting(E_ALL | E_STRICT);

		//ob_clean();
		ob_start();
		
		$this->load->model('tif_model/tif_form_model');


		
		
		
		$data['basic_info']=$this->tif_form_model->getStaffInfo($solangigtID);

		
		
		$data['GG_ID'] = $this->tif_form_model->getEmail($solangigtID);
		$staff_id_array=$this->tif_form_model->getStaffID($solangigtID);
		//Staff ID Required
		$staffid=$staff_id_array[0]['id'];


		// ====================== Address ====================//
		//====================================================// 

		$where_address = array(
			'staff_id' => $staffid
		);
		$data['address_info'] = $this->tif_form_model->get_by_tif('atif.staff_contact_info',$where_address);

		
		$data['address'] = $this->tif_form_model->getStaffAdd($staffid);
		
		$data['qualification']=$this->tif_form_model->getQualification($staffid);
		$data['emp_history']=$this->tif_form_model->getEmployeHistory($staffid);
		$data['father_spouse']=$this->tif_form_model->getFatherSpouse($staffid);
		$data['staff_emergency']=$this->tif_form_model->getEmergencyContact($staffid);
		$data['bank_detail']=$this->tif_form_model->getBankdetail($staffid);
		$data['eobi_sessi']=$this->tif_form_model->geteobi($solangigtID);
		$gfid=$this->tif_form_model->getGfId($staffid);
		
		
		// Start
		$employee_id = $solangigtID;
		
		$employer  = $this->tifb_module->getEmployeeInformation( $employee_id );
		$staff_id  =  $employer->id;
		
		if( $this->getContactInfo($staff_id ) ){
			$data['empContactInfo'] =  $this->getContactInfo($staff_id );
		}else{ $data['empContactInfo'] = NULL; 	}
		$getSchool = 1;	
		if( $this->getQualification($staff_id, $getSchool ) ){
			$empQSchool = $this->getQualification($staff_id, $getSchool);	
		}else{ $empQSchool = NULL;	 }
		
		$getCollege = 2;
		if( $this->getQualification($staff_id, $getCollege ) ){ 
			$empQCollege = $this->getQualification($staff_id, $getCollege ); 
		}else{ $empQCollege = NULL;	 }
		
		$getUniversity = 3;
		if( $this->getQualification($staff_id, $getUniversity ) ){ 
			$empQUniversity = $this->getQualification($staff_id, $getUniversity ); 
		}else{ $empQUniversity = NULL;	 }
		
		$getProfessional = 4;
		if( $this->getQualification($staff_id, $getProfessional ) ){ 
			$empQProfessional = $this->getQualification($staff_id, $getProfessional ); 
		}else{ $empQProfessional = NULL;	 }
		
		$getOthers = 5;
		if( $this->getQualification($staff_id, $getOthers ) ){ 
			$empQOthers = $this->getQualification($staff_id, $getOthers ); 
		}else{ $empQOthers = NULL;	 }
		
		// get employment history
		if( $this->getEmploymentHistroy($staff_id) ){ 
			$empEHistory = $this->getEmploymentHistroy( $staff_id );
		}else{ $empEHistory = NULL;	 }
		
		
		// Get reteive employee spuose
		if( $this->getEmpSouse($staff_id) ){ 
			$empSpouses = $this->getEmpSouse( $staff_id );
		}else{ $empSpouses = NULL;	 }
		
		
		//$staff_id = 11;
		// Get reteive employee spuose
		
		if( $this->getEmpChildren($staff_id) ){ 
			$empChildren = $this->getEmpChildren( $staff_id );
		}else{ $empChildren = NULL;	 }
		

		//$staff_id = 1;
		
		// Get reteive employee spuose
		$type = 1;
		if( $this->getEmpAlterCont($staff_id,$type) ){ 
			$getEmpAlterContKIN = $this->getEmpAlterCont( $staff_id,$type );
		}else{ $getEmpAlterContKIN = NULL;	 }
		
		$type = 2;
		if( $this->getEmpAlterCont($staff_id,$type) ){ 
			$getEmpAlterContEmergn = $this->getEmpAlterCont( $staff_id,$type );
		}else{ $getEmpAlterContEmergn = NULL;	 }
		
		if( $this->getEmpBank($staff_id ) ){ 
			$employeBank = $this->getEmpBank( $staff_id );
		}else{ $employeBank = NULL;	 }
		
		
		//if( $this->getEmpSupport($staff_id ) ){ 
			$employeSupporting = $this->getEmpSupport( $staff_id );
		//}else{ $employeSupporting = NULL; }
		
		//print_r($data['employeSupporting']);
		//exit;
		
		if( $this->getEmployeTakaful($staff_id ) ){ 
			$employeTakaful = $this->getEmployeTakaful( $staff_id );
		}else{ $employeTakaful  = NULL; }
		
		// End
		
		
		
		
		
		
		
		
		
		
		//var_dump($gfid);
		if(empty($gfid))
		{
			$GF_ID ='';
			$data['child_detail']='';
			$data['child_age']='';
			$GFID="";
		}
		else
		{
		$GF_ID=$gfid[0]['gf_id'];
		
		$GFID=$GF_ID;
		
		//var_dump($GF_ID);

		//String GFID FROM INTEGER GF_ID
		//$GFID = $this->makeGFID($GF_ID);
		//var_dump($GFID);
		
		$data['child_detail']=$this->getEmpChildren($GF_ID);
		
		$data['child_classList'] = $this->getClassList( $GF_ID );
		$data['child_age']=$this->tif_form_model->getAge($GF_ID);
		//var_dump($data['child_detail']);
		//var_dump($data['child_age']);
		
		
		}

		//Basic Information.

		$Branch = $data['basic_info'][0]['branch_id'];
		$FullName=$data['basic_info'][0]['name'];
		$Nationality="Pakistani";
		//$Religion='Islam';
		$Gt_Id=$data['basic_info'][0]['gt_id'];
		$Gg_Id=$data['GG_ID'][0]['gg_id'];
		
		
		$Name_Code=$data['basic_info'][0]['name_code'];
		$Gender=$data['basic_info'][0]['gender'];
		$Cnic=$data['basic_info'][0]['nic'];
		$Mobile_Number=$data['basic_info'][0]['mobile_phone'];
		$Land_Line=$data['basic_info'][0]['land_line'];
		$Relation='Yes';
		$Date_Birth=date_create($data['basic_info'][0]['dob']);
		$Date_Birth=date_format($Date_Birth,'d-M-Y');
		$Employe_ID=$data['basic_info'][0]['employee_id'];
		$Status=$data['basic_info'][0]['category'];
		
		// $employeSupporting[0]->emailPersonal = 'assda';
		// $employeSupporting[0]->employment_status = 1; 
		// $employeSupporting[0]->nationality = 'Pakista';
		if( !empty( $employeSupporting[0]->emailPersonal) )
			$Email= $employeSupporting[0]->emailPersonal;
			else
				$Email = "";
	
		
		if( !empty( $employeSupporting[0]->employment_status ) ){
				
			if($employeSupporting[0]->employment_status == 1){
				$Marital="Married";
			}elseif($employeSupporting[0]->employment_status == 2) {
				$Marital="Single";
			}elseif($employeSupporting[0]->employment_status == 3){
				$Marital="Divorce";
			}	
			elseif($employeSupporting[0]->employment_status == 4){
				$Marital = "Widow";
			}
		}
		
	

	if( !empty( $employeSupporting[0]->nationality) ){
		$Nationality= $employeSupporting[0]->nationality;	
	}else{
		$Nationality = "Pakistani";	
	}
		
		
		
			
			
			
			if( !empty( $employeSupporting  ) ){
				
				if( $employeSupporting[0]->religion == 1){
					
					$Religion = "Muslim";
				}else{
					$Religion = "Non Muslim";
				}
					
				
				
			}else{
				$Religion='Islam';
			}
				
		
		


		//Address 

		if(!empty($employeSupporting))
		{
		//$Address_one=$data['address'][0]['address_1'];
		$Address_one= $employeSupporting[0]->address;
		
		
		
		$Address_two='';
		$Appartment_no='';
		$Building_name='';
		$Plot_no='';
		$Street_name='';
		$Sub_region='';
		$Region='';
		$City='';
		
		$Country='';
		
		}

		//Educational Record
		$schoolCounter = 1;
		if(!empty($empQSchool)){
			
			foreach($empQSchool as $school ){
				
				if($schoolCounter == 1){
					$School_one =  $school->institute;
					$School_subject_one = $school->subjects;
					$School_degree_one = $school->qualification;
					$School_result_one = $school->result;
					$School_year_one= $school->year_of_completion;
				}
					
				if($schoolCounter == 2){
					$School_two =  $school->institute;
					$School_subject_two= $school->subjects;
					$School_degree_two= $school->qualification;
					$School_result_two = $school->result;
					$School_year_two= $school->year_of_completion;
				}
					
				$schoolCounter++;
			}
		}
		
		$collegeCounter = 1;
		if(!empty($empQCollege)){
			
			foreach($empQCollege as $school ){
				
				if($collegeCounter == 1){
					$College_one =  $school->institute;
					$College_subject_one = $school->subjects;
					$College_degree_one = $school->qualification;
					$College_result_one = $school->result;
					$College_year_one= $school->year_of_completion;
				}
					
				if($collegeCounter == 2){
					$College_two =  $school->institute;
					$College_subject_two= $school->subjects;
					$College_degree_two= $school->qualification;
					$College_result_two = $school->result;
					$College_year_two= $school->year_of_completion;
				}
					
				$collegeCounter++;
			}
		}
		
		
		
		$universityCounter = 1;
		if(!empty($empQUniversity)){
			
			foreach($empQUniversity as $school ){
				
				if($universityCounter == 1){
					$University_one =  $school->institute;
					$University_subject_one = $school->subjects;
					$University_degree_one = $school->qualification;
					$University_result_one = $school->result;
					$University_year_one= $school->year_of_completion;
				}
					
				if($universityCounter == 2){
					$University_two =  $school->institute;
					$University_subject_two= $school->subjects;
					$University_degree_two= $school->qualification;
					$University_result_two = $school->result;
					$University_year_two= $school->year_of_completion;
				}
					
				$universityCounter++;
			}
		}
		
		
		$profCounter = 1;
		if(!empty($empQProfessional)){
			
			foreach($empQProfessional as $school ){
				
				if($profCounter == 1){
					$Professional_one =  $school->institute;
					$Professional_subject_one = $school->subjects;
					$Professional_degree_one = $school->qualification;
					$Profession_result_one = $school->result;
					$Professional_year_one= $school->year_of_completion;
				}
					
				if($profCounter == 2){
					$Professional_two =  $school->institute;
					$Professional_subject_two= $school->subjects;
					$Professional_degree_two= $school->qualification;
					$Profession_result_two = $school->result;
					$Professional_year_two= $school->year_of_completion;
				}
					
				$profCounter++;
			}
		}
		
		$otherCounter = 1;
		// var_dump($empQOthers);
		if(!empty($empQOthers)){
			
			foreach($empQOthers as $school ){
				
				if($otherCounter == 1){
					$Other_one =  $school->institute;
					$Other_subject_one = $school->subjects;
					$Other_degree_one = $school->qualification;
					$Other_result_one = $school->result;
					$Other_year_one= $school->year_of_completion;
				}
					
				if($otherCounter == 2){
					$Other_two =  $school->institute;
					$Other_subject_two= $school->subjects;
					$Other_degree_two= $school->qualification;
					$Other_result_two = $school->result;
					$Other_year_two = $school->year_of_completion;
				}
					
				$otherCounter++;
			}
		}
		
		

	

		//Employement History
		

		for($i=0; $i<sizeof($empEHistory); $i++)
		{
			
			$Employe_organization[$i] = $empEHistory[$i]->organization;
			
			$Employe_designation[$i] =  $empEHistory[$i]->designation;
			
			$Employe_classes[$i] =  $empEHistory[$i]->classes_taught;
			
			$Employe_subject[$i] =  $empEHistory[$i]->subject_taught;
			
			$Employe_salary[$i] = $empEHistory[$i]->salary;
			$Employe_from_year[$i] = $empEHistory[$i]->from_year;
			$Employe_to_year[$i] = $empEHistory[$i]->to_year?$empEHistory[$i]->to_year:"Present";
			$Employe_reason[$i] =  $empEHistory[$i]->reason_for_leaving;
		}

		//Father AND SPOUSE
		$fatherIntegration=0;
		$spouseIntegration=0;

		//var_dump($empSpouses);
		for($i=0 ;$i<sizeof( $empSpouses ) ;$i++)
		{
			if( $empSpouses[$i]->spouseType == 1 )
			{
				$fatherIntegration=1;
				
				$father_detail[$i] = $empSpouses[$i];
				
			}
			elseif (  $empSpouses[$i]->spouseType == 2  ) 
			{
				$spouseIntegration=1;
				
				$spouse_detail[$i] = $empSpouses[$i];
				

			} 
			
		
		}
		
			//var_dump($data["child_detail"]);
			//exit;

		

		//Child Detail
		if(!empty($gfid))
		{
			for($i=0;$i<sizeof($data['child_detail']);$i++)
			{
				$child_name[$i] = $data['child_detail'][$i]->official_name;
				//$child_dob[$i] = $data['child_detail'][$i]['dob'];
				$child_gs[$i]=$data['child_detail'][$i]->gs_id;	
				//$child_aged[$i]=$data['child_detail'][$i]->DOB;
				
				$dob = $data['child_detail'][$i]->DOB;
				$age = (date('Y') - date('Y',strtotime($dob)));
				$child_aged[$i]=$age;
				
				if(  $data["child_detail"][$i]->section_name != NULL ){
					$child_school[$i] = $data["child_detail"][$i]->grade_name . " - ". $data["child_detail"][$i]->section_name ;	
				}else{
					$child_school[$i] = 'Alumni';
				}
				
				
					
				
				
				/*if(!empty($empChildren)){
					$child_school[$i] = $data["child_classList"][$i]->grade_dname . " - ". $data["child_classList"][$i]->section_name ;
				}else 
					$child_school[$i] = NULL; */
					
			}
			

	

		
		//var_dump($data['child_age']);

		//Child Age

			
		}

			//var_dump($child_name);
		//exit;

		//Staff Emergency

		for($i=0; $i<sizeof($data['staff_emergency']);$i++)
		{
			$staff_emergency=$data['staff_emergency'][$i]['name'];
			$staff_address=$data['staff_emergency'][$i]['address'];
			$staff_email=$data['staff_emergency'][$i]['email'];
			$staff_phone=$data['staff_emergency'][$i]['phone'];
			$staff_relation=$data['staff_emergency'][$i]['relationship'];
		}

		
		//Staff Next Of Kin
		 if( !empty( $getEmpAlterContKIN ) ){ 
		 
		 $kin_name = $getEmpAlterContKIN[0]->name;
		$kin_address=$getEmpAlterContKIN[0]->address;
		$kin_email=$getEmpAlterContKIN[0]->email;
		$kin_phone=$getEmpAlterContKIN[0]->phone;
		$kin_relation=$getEmpAlterContKIN[0]->relationships;
		 
		 
		 }else{
			 
			$kin_name = "";
			$kin_address="";
			$kin_email="";
			$kin_phone="";
			$kin_relation="";
			 
		 }
		 
		 
		 //Staff Emergency Contact 
		 if( !empty( $getEmpAlterContEmergn ) ){ 
		 
			$ekin_name = $getEmpAlterContEmergn[0]->name;
			$ekin_address=$getEmpAlterContEmergn[0]->address;
			$ekin_email=$getEmpAlterContEmergn[0]->email;
			$ekin_phone=$getEmpAlterContEmergn[0]->phone;
			$ekin_relation=$getEmpAlterContEmergn[0]->relationships;
		 
		 
		 }else{
			 
			$ekin_name = "";
			$ekin_address="";
			$ekin_email="";
			$ekin_phone="";
			$ekin_relation="";
			 
		 }
		 
		

		//Bank Detail
		if(!empty( $employeBank )) {
			$Bank_name= $employeBank[0]->bank_name;
			$Bank_branch= $employeBank[0]->branch;
			$Bank_branch_code=  $employeBank[0]->branch_code;
			$Bank_account=  $employeBank[0]->account_number ;
		}else{
			$Bank_name= "";
			$Bank_branch= "";
			$Bank_branch_code =  "";
			$Bank_account=  "";
			
		}
		//EOBI AND SESSI NO

		
		if(!empty( $employer  ) ){
			$Eobi = $employer->eobi_no;
			$Sessi = $employer->sessi_no;	
		}else{
			$Eobi = "";
			$Sessi = "";
		}
		

		if(!empty( $employeSupporting  ) ){
			$NTN = $employeSupporting[0]->nationalTaxNumber;
			$Providented = $employeSupporting[0]->providentFund;
			
			if( $Providented == 1 )
				$Provident = "Yes";	
			else
				$Provident = 'No';
			
			
		}else{
			$NTN="";
			$Provident = '';
		}	

		

		//Provident Fund

		

		//National Text NumZber
		

		//TakafulF

		if( !empty($employeTakaful) ){
			
			
			if ( $employeTakaful[0]->self == 1 )
				$Self = 'Yes';
				else
					$Self = '';
				
				
				
			if ( $employeTakaful[0]->spouse == 1 )
				$Spouse = 'Yes';
				else
					$Spouse = '';
				
			
			if ( $employeTakaful[0]->children == 1 )
				$Children = 'Yes';
				else
					$Children = '';
				
				
			
			if ($employeTakaful[0]->certificate_no != '' )
				$Certificate_no = $employeTakaful[0]->certificate_no;
			else
				$Certificate_no = "";
		
		
		if( $employeTakaful[0]->reasons )
			$Reason_no = $employeTakaful[0]->reasons;
		else
			$Reason_no = "";
		
		
		
			
		}else{
			
			$Self = '';
			$Spouse = '';
			$Children = '';
			$Reason_no = "";
			$Certificate_no = "";
		}

		if(!empty($data['address_info'])){
			$appartment = $data['address_info'][0]->apartment_no;
			$building = $data['address_info'][0]->building_name;
			$plot = $data['address_info'][0]->plot_no;
			$street = $data['address_info'][0]->street_name;
			$region_id = $data['address_info'][0]->region;
			$sub_region_id = $data['address_info'][0]->sub_region;


			// Get Region Name From Region ID
			$where_region_id = array(
				'id' => $region_id
			);
			$get_region = $this->tif_form_model->get_by_tif('atif._region',$where_region_id);			
			//$region_name = $get_region[0]->name;

			if(empty($get_region[0]->name)){
				$region_name = '';
			}
			else{
				$region_name = $get_region[0]->name;
			}
			//====== Get Sub Region Name From Sub Region ID =====//

			$where_sub_region_id = array(
				'id' => $sub_region_id
			);

			$get_sub_region = $this->tif_form_model->get_by_tif('atif._region_sub',$where_sub_region_id);
			if(empty($get_sub_region[0]->name)){
				$sub_region_name = '';
			}else{
				$sub_region_name = $get_sub_region[0]->name;				
			}


		}
		else{
			$appartment ='';
			$building = '';
			$plot = '';
			$street = '';
			$region_name = '';
			$sub_region_name = '';
		}

		
		require_once('components/pdf/fpdf/fpdf.php');	
		require_once('components/pdf/fpdi/fpdi.php');


		$borderOn = 0;

		$font_size = 10;
		$font_name = 'Helvetica';
		$gender_mark_size = 18;

			
			// initiate FPDIFC
		$pdf = new FPDI('P','mm','A4');
		$title = $FullName;
		$pdf->SetTitle($title);
		
		$pageCount = $pdf->setSourceFile('components\pdf\hcm\tif\StaffApplicationForm02.pdf');
			// iterate through all pages
		for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
			    // import a page
			$templateId = $pdf->importPage($pageNo);
			    // get the size of the imported page
			$size = $pdf->getTemplateSize($templateId);

			    // create a page (landscape or portrait depending on the imported page size)
			if ($size['w'] > $size['h']) 
				{
			        $pdf->AddPage('L', array($size['w'], $size['h']));
			    } 
			else 
				{
			        $pdf->AddPage('P', array($size['w'], 295));
			    }

			    // use the imported page
		    	$pdf->useTemplate($templateId);

		    	if($templateId == 1)
		    	{
		    		// Campus Check
		    		if ($Branch == 1){		    			
		    			$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(183, 20.5);
					    $pdf->Write(5, 'P');
		    		}else if ($Branch == 2) {
		    			$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(183, 27.5);
					    $pdf->Write(5, 'P');
		    		}

		    		//Picture

		    		if(file_exists($this->data['staff_150_photo_path'] . $Employe_ID . ".png")){
							$StaffPicPath = base_url() . $this->data['staff_150_photo_path'] . $Employe_ID . ".png";
						}else{
							$StaffPicPath = base_url() . $this->data['staff_150_photo_path'] . "NoPhoto.png";
						}

					$pdf->Image($StaffPicPath,160,38,35,30,'PNG');	
					

		    		// Full Name
		    		$pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(13,76.5);
				    $pdf->Cell(104.5, 6.5, $FullName, $borderOn, 0, 'L', 0);


				    //Religion
				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(156.8,76.5);
				    $pdf->Cell(35, 6.5, $Religion , $borderOn, 0, 'L', 0);

				    //National Identity Card
					$pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(13.2,90.5);
				    $pdf->Cell(76, 6.5, $Cnic , $borderOn, 0, 'L', 0);

				    // Appartment No

				    if(!empty($appartment)){
				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(13.2,104);
		    		$this_font_size = 0;
		    		$decrement_step = 0.1;
		    		$font_size = 10;
		    		$line_width = 34;
		    		$this_font_size = $font_size;
					while($pdf->GetStringWidth($appartment) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
				    $pdf->Cell($line_width, 6.5, $appartment , $borderOn, 0, 'L', 0);
				}
				    // Street Name

				    if(!empty($street)){
				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(48,104);
		    		$this_font_size = 0;
		    		$decrement_step = 0.1;
		    		$font_size = 10;
		    		$line_width = 34;
		    		$this_font_size = $font_size;
					while($pdf->GetStringWidth($street) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
				    $pdf->Cell($line_width, 6.5, $street , $borderOn, 0, 'L', 0);
					}

				    // Building Name
				    if(!empty($building)){
				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(13.2,110);
		    		$this_font_size = 0;
		    		$decrement_step = 0.1;
		    		$font_size = 10;
		    		$line_width = 34;
		    		$this_font_size = $font_size;
					while($pdf->GetStringWidth($building) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
				    $pdf->Cell($line_width, 6.5, $building,$borderOn, 0, 'L', 0);
				}


				    // Sub Region

				    if(!empty($sub_region_name)){
					    $pdf->SetDrawColor(0,80,180);
			    		$pdf->SetFont('Arial','',10);
			    		$pdf->SetFillColor(0,80,180);
			    		$pdf->SetXY(48,110);
			    		$this_font_size = 0;
			    		$decrement_step = 0.1;
			    		$font_size = 10;
			    		$line_width = 34;
			    		$this_font_size = $font_size;
						while($pdf->GetStringWidth($sub_region_name) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}

					    $pdf->Cell($line_width, 6.5, $sub_region_name,$borderOn, 0, 'L', 0);
					}

				    //PLOT Name
					if(!empty($plot)){
					    $pdf->SetDrawColor(0,80,180);
			    		$pdf->SetFont('Arial','',10);
			    		$pdf->SetFillColor(0,80,180);
			    		$pdf->SetXY(13.2,116);
			    		$this_font_size = 0;
			    		$decrement_step = 0.1;
			    		$font_size = 10;
			    		$line_width = 34;
			    		$this_font_size = $font_size;
						while($pdf->GetStringWidth($plot) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
					    $pdf->Cell(35, 6.5, $plot,$borderOn, 0, 'L', 0);
					}

				    // Region
					if(!empty($region_name)){
					    $pdf->SetDrawColor(0,80,180);
			    		$pdf->SetFont('Arial','',10);
			    		$pdf->SetFillColor(0,80,180);
			    		$pdf->SetXY(48,116);
			    		$decrement_step = 0.1;
			    		$font_size = 10;
			    		$line_width = 34;
			    		$this_font_size = $font_size;
						while($pdf->GetStringWidth($region_name) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
					    $pdf->Cell($line_width, 6.5,$region_name,$borderOn, 0, 'L', 0);
					}


				    //Gender
				    $gender_mark_size = 16;
				    if($Gender == 'M' || $Gender == 'm')
				 	{
		    		$pdf->AddFont('wingdng2','','wingdng2.php');
					$pdf->SetFont('wingdng2','',$gender_mark_size);
					$pdf->SetXY(91,92);
					$pdf->Write(5, 'P');
		    		
					}
					elseif($Gender == 'F' || $Gender == 'f')
					{
					$pdf->AddFont('wingdng2','','wingdng2.php');
					$pdf->SetFont('wingdng2','',$gender_mark_size);
					$pdf->SetXY(102,92);
					$pdf->Write(5, 'P');
					}

					//GTID
					$pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(113,90.5);
				    $pdf->Cell(32, 6.5, $Gt_Id , $borderOn, 0, 'L', 0);


				    //NameCode
					$pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(144.5,90.5);
				    $pdf->Cell(32, 6.5, $Name_Code , $borderOn, 0, 'L', 0);


				    //Nationality
				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(161,90.5);
				    $pdf->Cell(37, 6.5, $Nationality , $borderOn, 0, 'L', 0);



// 				    //Address
// 				    if(!empty($Address_one)){
						

					
					
					
// 					////////////////////////////////////////////
// 					//Updated Address One
// $addressbreak_one = '';
//     $addressbreak_two = '';
//     $addressbreak_three='';
//   $length = strlen($Address_one);
//   $exp = explode(" ",$Address_one);
 
//   for($i=0; $i<sizeof($exp); $i++)
//   {
//   if($i <= 4)
//   {
//   $addressbreak_one = $addressbreak_one.$exp[$i].' ';
//   }
//   else if($i > 4 && $i <= 8)
//   {
//   $addressbreak_two = $addressbreak_two.$exp[$i].' ';
//   }
//   else if ($i > 8 && $i <= sizeof($exp)) {
//   $addressbreak_three = $addressbreak_three.$exp[$i].' ';
//   }
//   }

 

// // //addressbreak_one
//    if(!empty($addressbreak_one))
//    {
//    $pdf->SetDrawColor(0,80,180);
//     $pdf->SetFont('Arial','',10);
//     $pdf->SetFillColor(0,80,180);
//     $pdf->SetXY(13,103.9);
//    $decrement_step = 0.1;
//    $line_width = 70;
//    $pdf->SetFont($font_name);    
//    $this_font_size = $font_size;
//    while($pdf->GetStringWidth($addressbreak_one) > $line_width) {
// $this_font_size -= $decrement_step;
// $pdf->SetFont($font_name,'',$this_font_size);
// }
// $pdf->Cell(70, 6.5, $addressbreak_one , $borderOn, 0, 'L', 0);
// }

//    //addressbreak_two
//    if(!empty($addressbreak_two))
//    {
//    $pdf->SetDrawColor(0,80,180);
//     $pdf->SetFont('Arial','',10);
//     $pdf->SetFillColor(0,80,180);
//     $pdf->SetXY(13,110.2);
//    $decrement_step = 0.1;
//    $line_width = 70;
//    $pdf->SetFont($font_name);    
//    $this_font_size = $font_size;
//    while($pdf->GetStringWidth($addressbreak_two) > $line_width) {
// $this_font_size -= $decrement_step;
// $pdf->SetFont($font_name,'',$this_font_size);
// }
// $pdf->Cell(70, 6.5, $addressbreak_two , $borderOn, 0, 'L', 0);

// }

//    //addressbreak_three
// if(!empty($addressbreak_three))
// {
//    $pdf->SetDrawColor(0,80,180);
//     $pdf->SetFont('Arial','',10);
//     $pdf->SetFillColor(0,80,180);
//     $pdf->SetXY(13,116.5);
//    $decrement_step = 0.1;
//    $line_width = 70;
//    $pdf->SetFont($font_name);    
//    $this_font_size = $font_size;
//    while($pdf->GetStringWidth($addressbreak_three) > $line_width) {
// $this_font_size -= $decrement_step;
// $pdf->SetFont($font_name,'',$this_font_size);
// }
// $pdf->Cell(70, 6.5, $addressbreak_three , $borderOn, 0, 'L', 0);
// }
					
					
// 					} 




				    //MOBILE Number

				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(84.5,103.9);
				    $pdf->Cell(53, 6.5, $Mobile_Number , $borderOn, 0, 'L', 0);


				    //DOB

				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(147,103.9);
				    $pdf->Cell(53, 6.5, $Date_Birth , $borderOn, 0, 'L', 0);




				    //Land Line Number

				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(85,116.1);
				    $pdf->Cell(53, 6.5, $Land_Line, $borderOn, 0, 'L', 0);

				    //Email

				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(146.7,116.1);
				    //$pdf->Cell(51, 6.5, $Email,1, 0, 'L', 0);
				    $decrement_step = 0.1;
						$line_width = 50;  
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($Email) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						$pdf->Cell($line_width, 6.4, $Email, $borderOn, 0, 'L', 0);

				    //Martial Statue


				    if(!empty($Marital)){

				    	if($Marital == 'Single'){
					    	$pdf->AddFont('wingdng2','','wingdng2.php');
							$pdf->SetFont('wingdng2','',$gender_mark_size);
							$pdf->SetXY(13.5,130);
							$pdf->Write(5, 'P');
				    	}
				    	else if($Marital == 'Married'){
				    		$pdf->AddFont('wingdng2','','wingdng2.php');
							$pdf->SetFont('wingdng2','',$gender_mark_size);
							$pdf->SetXY(29.5,130);
							$pdf->Write(5, 'P');

				    	}
				    	else if($Marital == 'Widow'){
				    		$pdf->AddFont('wingdng2','','wingdng2.php');
							$pdf->SetFont('wingdng2','',$gender_mark_size);
							$pdf->SetXY(46,130);
							$pdf->Write(5, 'P');

				    	}
				    	else if($Marital == 'Divorce'){
				    		$pdf->AddFont('wingdng2','','wingdng2.php');
							$pdf->SetFont('wingdng2','',$gender_mark_size);
							$pdf->SetXY(64,130);
							$pdf->Write(5, 'P');

				    	}
				    }



				    //Gg_ID

				    $pdf->SetDrawColor(0,80,180);
		    		$pdf->SetFont('Arial','',10);
		    		$pdf->SetFillColor(0,80,180);
		    		$pdf->SetXY(85,129);
				    $pdf->Cell(53, 6.5, $Gg_Id , $borderOn, 0, 'L', 0);



				    //Status

				    if($Status == 'Contractual' || $Status == 'contractual' )
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(147, 130.3);
					    $pdf->Write(5, 'P');
				    }
				    elseif($Status == 'Permenant' || $Status == 'permenant')
				    {
				    	$pdf->AddFont('wingdng2','','wingdng2.php');
					    $pdf->SetFont('wingdng2','',$gender_mark_size);
					    $pdf->SetXY(173.5, 130.3);
					    $pdf->Write(5, 'P');
				    }

				    //	**********************
				    //
				    //  * Educational Record *
				    //
				    //  **********************

				  
					$decrement_step = 0.1;
					
				   	if(!empty($School_one))
				   	{
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,147.8);
						
						
						$line_width = 84;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($School_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
						
				    	$pdf->Cell(84, 6.4, str_replace("_"," ",$School_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($School_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,153.3);
						
						
						$line_width = 84;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($School_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell(84, 6.4,  str_replace("_"," ",$School_two), $borderOn, 0, 'L', 0);

				    }
				    if(!empty($College_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,159.8);
						$decrement_step = 0.1;
						$line_width = 77;  
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($College_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						$pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_one), $borderOn, 0, 'L', 0);
					}
				    if(!empty($College_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,166.2);
						
						$line_width = 77;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($College_two) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_two), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,172.6);
						
						$line_width = 77;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($University_one) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
				    	$pdf->Cell(84, 6.4, str_replace("_", " ",$University_one ), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,178.9);
						
						$line_width = 77;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($University_two) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell(84, 6.4, str_replace("_", " ",$University_two ), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Professional_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,184.8);
						
						$line_width = 70;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($Professional_one) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell($line_width, 6.4, str_replace("_", " ", $Professional_one ), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Professional_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,191.4);
						
						$line_width = 70;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($Professional_two) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell($line_width, 6.4, str_replace("_", " ",$Professional_two), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,197.6);
						
						$line_width = 70;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($Other_one) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell($line_width, 6.4, str_replace("_", " ",$Other_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(20.9,204.3);
						
						$line_width = 70;
						$pdf->SetFont($font_name);    
						$this_font_size = $font_size;
						while($pdf->GetStringWidth($Other_two) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						
				    	$pdf->Cell($line_width, 6.4, str_replace("_", " ",$Other_two ), $borderOn, 0, 'L', 0);
				    }


				    // Subject Records

				    if(!empty($School_subject_one))
				   	{
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(104.8,147.8);
				    	// $pdf->Cell(41, 6.4, $School_subject_one, $borderOn, 0, 'L', 0);

				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name,'',10);			    
				    	$pdf->SetXY(95, 147.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($School_subject_one) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ", $School_subject_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($School_subject_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(95,153.3);
				    	//$pdf->Cell(41, 6.4, $School_subject_two, $borderOn, 0, 'L', 0);

				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 153.3);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($School_subject_two) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
						}
						
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$School_subject_two), $borderOn, 0, 'L', 0);


				    }
				    if(!empty($College_subject_one))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(104.9,159.8);
				    	//$pdf->Cell(41, 6.4, $College_subject_one, $borderOn, 0, 'L', 0);

				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 159.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($College_subject_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
							}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_subject_one), $borderOn, 0, 'L', 0);



				    }
				    if(!empty($College_subject_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(104.9,166.2);
				    	//$pdf->Cell(41, 6.4, $College_subject_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 166.2);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($College_subject_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						 }
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_subject_two), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_subject_one))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(95,172.6);
				    	//$pdf->Cell(41, 6.4, $University_subject_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 172.6);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($University_subject_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
							}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$University_subject_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_subject_two))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(104.9,178.9);
				    	//$pdf->Cell(41, 6.4, $University_subject_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 178.9);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($University_subject_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$University_subject_two), $borderOn, 0, 'L', 0);
				    }
					
					
				    if(!empty($Professional_subject_one))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(104.9,184.8);
				    	//$pdf->Cell(41, 6.4, $Professional_subject_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 36;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 184.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Professional_subject_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Professional_subject_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Professional_subject_two))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(104.9,191.4);
				    	//$pdf->Cell(41, 6.4, $Professional_subject_two, $borderOn, 0, 'L', 0);
		    			$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 191.4);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Professional_subject_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Professional_subject_two), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_subject_one))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(104.9,197.6);
				    	//$pdf->Cell(41, 6.4, $Other_subject_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 41;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 197.6);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Other_subject_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Other_subject_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_subject_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(95,204.3);
				    	//$pdf->Cell(41, 6.4, $Other_subject_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 36;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(95, 204.3);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Other_subject_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Other_subject_two ), $borderOn, 0, 'L', 0);
				    }


				    //Degree/Grade

				    if(!empty($School_degree_one))
				   	{
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(133,147.8);
				    	//$pdf->Cell(26, 6.4, $School_degree_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 147.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($School_degree_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$School_degree_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($School_degree_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(133,153.3);
				    	//$pdf->Cell(26, 6.4, $School_degree_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 153.3);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($School_degree_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$School_degree_two), $borderOn, 0, 'L', 0);

				    }



				    if(!empty($School_result_one)){

				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 147.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($School_result_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$School_result_one), $borderOn, 0, 'L', 0);

				    }

				    if(!empty($School_result_two)){

				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 153.3);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($School_result_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$School_result_two), $borderOn, 0, 'L', 0);

				    }

				    // var_dump($College_result_one);

				    if(!empty($College_result_one)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 159.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($College_result_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_result_one), $borderOn, 0, 'L', 0);
				    }

				    if(!empty($College_result_two)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 166.2);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($College_result_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_result_two), $borderOn, 0, 'L', 0);
				    }


				    if(!empty($University_result_one)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 172.6);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($University_result_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$University_result_one), $borderOn, 0, 'L', 0);
				    }

				    if(!empty($University_result_two)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 178.9);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($University_result_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$University_result_two), $borderOn, 0, 'L', 0);
				    }


				    if(!empty($Profession_result_one)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 184.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Profession_result_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Profession_result_one), $borderOn, 0, 'L', 0);
				    }

				    if(!empty($Profession_result_two)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 191.4);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Profession_result_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Profession_result_two), $borderOn, 0, 'L', 0);
				    }

				    if(!empty($Other_result_one)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 197.6);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Other_result_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Other_result_one), $borderOn, 0, 'L', 0);
				    }

				    if(!empty($Other_result_two)){
				    	$pdf->SetFont('Arial','',10);
				    	$decrement_step = 0.1;
				    	$line_width = 18;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(158.5, 204.3);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Other_result_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$Other_result_two), $borderOn, 0, 'L', 0);
				    }

				    if(!empty($College_degree_one))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(158.5,159.8);
				    	//$pdf->Cell(26, 6.4, $College_degree_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 159.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($College_degree_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
						}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_degree_one), $borderOn, 0, 'L', 0);

				    }
				    if(!empty($College_degree_two))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(146.2,166.2);
				    	//$pdf->Cell(26, 6.4, $College_degree_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 166.2);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($College_degree_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$College_degree_two), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_degree_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(146.2,172.6);
				    	// $pdf->Cell(26, 6.4, $University_degree_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 172.6);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($University_degree_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$University_degree_one), $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_degree_two))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(146.2,178.9);
				    	//$pdf->Cell(26, 6.4, $University_degree_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 178.9);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($University_degree_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, str_replace("_", " ",$University_degree_two), $borderOn, 0, 'L', 0);
				    }
					
					
					
					
					
				    if(!empty($Professional_degree_one))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(146.2,184.8);
				    	//$pdf->Cell(26, 6.4, $Professional_degree_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 184.8);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Professional_degree_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, $Professional_degree_one, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Professional_degree_two))
				    {
				    	// $pdf->SetDrawColor(0,80,180);
		    			// $pdf->SetFont('Arial','',10);
		    			// $pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(146.2,191.4);
				    	//$pdf->Cell(26, 6.4, $Professional_degree_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 191.4);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Professional_degree_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, $Professional_degree_two, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_degree_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(146.2,197.6);
				    	//$pdf->Cell(26, 6.4, $Other_degree_one, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 197.6);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Other_degree_one) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, $Other_degree_one, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_degree_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			// $pdf->SetXY(133,204.3);
				    	//$pdf->Cell(26, 6.4, $Other_degree_two, $borderOn, 0, 'L', 0);
				    	$decrement_step = 0.1;
				    	$line_width = 26;
				    	$pdf->SetFont($font_name);			    
				    	$pdf->SetXY(133, 204.3);
				    	$this_font_size = $font_size;
				    	while($pdf->GetStringWidth($Other_degree_two) > $line_width) {
						$this_font_size -= $decrement_step;
						$pdf->SetFont($font_name,'',$this_font_size);
					}
						 $pdf->Cell($line_width, 6.4, $Other_degree_two, $borderOn, 0, 'L', 0);
				    }

				    //Complete Year.

				    if(!empty($School_year_one))
				   	{
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',9);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,147.8);
				    	$pdf->Cell(26, 6.4, $School_year_one, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($School_year_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',9);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,153.3);
				    	$pdf->Cell(26, 6.4, $School_year_two, $borderOn, 0, 'L', 0);

				    }
				    if(!empty($College_year_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',9);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,159.8);
				    	$pdf->Cell(26, 6.4, $College_year_one, $borderOn, 0, 'L', 0);

				    }
				    if(!empty($College_year_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',9);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,166.2);
				    	$pdf->Cell(26, 6.4, $College_year_two, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_year_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,172.6);
				    	$pdf->Cell(26, 6.4, $University_year_one, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($University_year_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,178.9);
				    	$pdf->Cell(26, 6.4, $University_year_two, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Professional_year_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,184.8);
				    	$pdf->Cell(26, 6.4, $Professional_year_one, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Professional_year_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,191.4);
				    	$pdf->Cell(26, 6.4, $Professional_year_two, $borderOn, 0, 'L', 0);
				    }
				    // var_dump($Other_year_one);
				    if(!empty($Other_year_one))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,197.6);
				    	$pdf->Cell(26, 6.4, $Other_year_one, $borderOn, 0, 'L', 0);
				    }
				    if(!empty($Other_year_two))
				    {
				    	$pdf->SetDrawColor(0,80,180);
		    			$pdf->SetFont('Arial','',10);
		    			$pdf->SetFillColor(0,80,180);
		    			$pdf->SetXY(177,204.3);
				    	$pdf->Cell(26, 6.4, $Other_year_two, $borderOn, 0, 'L', 0);
				    }

				    //	**********************
				    //
				    //  * Employment History *
				    //
				    //  **********************

				    	// Employee Organization

				    	if(!empty($Employe_organization))
				    	{
				    	$height = 0;

				    	for($i=0;$i<sizeof($Employe_organization);$i++)
				    	{
				    		
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(13.2,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(13.2,$height+242.1);	
				    		}

				    		$decrement_step = 0.1;
				    		$line_width = 48;
				    		$pdf->SetFont($font_name);			    
				    		//$pdf->SetXY(104.9, 147.8);
				    		$this_font_size = $font_size;
				    		while($pdf->GetStringWidth($Employe_organization[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}
				    		
				    		$pdf->Cell(51, 6.4, $Employe_organization[$i], $borderOn, 0, 'L', 0);
				    		$height = $height + 6.3;
				    	}

				    	//Designation
				    	$height = 0;
				    	for($i=0;$i<sizeof($Employe_designation);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(64.5,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(64.5,$height+242.1);	
				    		}
				    		
				    		$decrement_step = 0.1;
				    		$line_width = 25;
				    		$pdf->SetFont($font_name);			    
				    		//$pdf->SetXY(104.9, 147.8);
				    		$this_font_size = $font_size;
				    		while($pdf->GetStringWidth($Employe_designation[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}

				    		$pdf->Cell($line_width, 6.4, $Employe_designation[$i], $borderOn, 0, 'L', 0);
				    		$height = $height + 6.3;
				    	}
				    	//Classes Taught
				    	$height = 0;
				    	for($i=0;$i<sizeof($Employe_classes);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(89.4,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(89.4,$height+242.1);	
				    		}
				    		
				    		//$pdf->Cell(12.5, 6.4, $Employe_classes[$i], $borderOn, 0, 'L', 0);

				    		$decrement_step = 0.1;
				    		$line_width = 12.5;
				    		$pdf->SetFont($font_name);			    
				    		//$pdf->SetXY(104.9, 147.8);
				    		$this_font_size = $font_size;
				    		while($pdf->GetStringWidth($Employe_classes[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}
						 	$pdf->Cell($line_width, 6.4, $Employe_classes[$i], $borderOn, 0, 'L', 0);
						 	$height = $height + 6.3;
				    	}

				    	//Subject Taught
				    	// This Column was Hard Core..//
				    	$height = 0;
				    	for($i=0;$i<sizeof($Employe_subject);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(102.1,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(102.1,$height+242.1);	
				    		}
				    		
				    		$decrement_step = 0.1;
				    		$line_width = 13.2;
				    		$pdf->SetFont($font_name);			    
				    		//$pdf->SetXY(104.9, 147.8);
				    		$this_font_size = $font_size;
				    		while($pdf->GetStringWidth($Employe_subject[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}
						 	$pdf->Cell($line_width, 6.4, $Employe_subject[$i], $borderOn, 0, 'L', 0);
						 	$height = $height + 6.3;

				    		
				    	}

				    	//Employe Salary
				    	$height = 0;
				    	for($i=0;$i<sizeof($Employe_salary);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(115.5,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(115.5,$height+242.1);	
				    		}
				    		
				    		$pdf->Cell(11.5, 6.4, $Employe_salary[$i], $borderOn, 0, 'L', 0);
				    		$height = $height + 6.3;
				    	 }

				    	 //FROM YEAR
				    	 
				    	 $height = 0;
				    	for($i=0;$i<sizeof($Employe_from_year);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(127.5,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(127.5,$height+242.1);	
				    		}
				    		

							$decrement_step = 0.1;
							$line_width = 12.3;
							$pdf->SetFont($font_name);    
							$this_font_size = $font_size;
							while($pdf->GetStringWidth($Employe_from_year[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}

				    		$pdf->Cell(12.3, 6.4, $Employe_from_year[$i], $borderOn, 0, 'L', 0);
				    		$height = $height + 6.3;
				    	}

				    	//TOO Year


				    	 $height = 0;
				    	for($i=0;$i<sizeof($Employe_to_year);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(140.1,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(140.1,$height+242.1);	
				    		}
				    		$decrement_step = 0.1;
							$line_width = 12.3;
							$pdf->SetFont($font_name);    
							$this_font_size = $font_size;
							while($pdf->GetStringWidth($Employe_to_year[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}

				    		$pdf->Cell(12.3, 6.4, $Employe_to_year[$i], $borderOn, 0, 'L', 0);
				    		$height = $height + 6.3;
				    	}

				    	//Reason For Leaving


				    	$height = 0;
				    	for($i=0;$i<sizeof($Employe_reason);$i++)
				    	{
				    		$pdf->SetDrawColor(0,80,180);
				    		$pdf->SetFont('Arial','',10);
				    		$pdf->SetFillColor(0,80,180);
				    		if($i == 0)
				    		{
				    			$pdf->SetXY(153.5,242.1);	
				    		}
				    		else
				    		{
				    			$pdf->SetXY(153.5,$height+242.1);	
				    		}
				    		$decrement_step = 0.1;
				    		$line_width = 44;
				    		$pdf->SetFont($font_name);			    
				    		//$pdf->SetXY(104.9, 147.8);
				    		$this_font_size = $font_size;
				    		while($pdf->GetStringWidth($Employe_reason[$i]) > $line_width) {
							$this_font_size -= $decrement_step;
							$pdf->SetFont($font_name,'',$this_font_size);
							}
				    		
				    		$pdf->Cell(44, 6.4, $Employe_reason[$i], $borderOn, 0, 'L', 0);
				    		$height = $height + 6.3;
				    	}
				    }

				    	//*************************************
				    	//*			Father spouse             *
				    	//* 								  *
				    	//*************************************

				    	//Father Details


				}   	

						if($templateId == 2)
						{
							if(!empty($father_detail))
							{
						 
				    		for($i=0; $i<sizeof($father_detail); $i++)
				    	 	{
				    	 		$pdf->SetDrawColor(0,80,180);
				    			$pdf->SetFont('Arial','',8);
				    			$pdf->SetFillColor(0,80,180);

				    			//Father Name
				    			if($father_detail[$i]->name != '')
				    	 		{
				    	 			$pdf->SetXY(13,25);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->name, 0, 0, 'C', 0);
				    	 		}
				    	 		//Father Profession
				    	 		if($father_detail[$i]->profession != 'null')
				    	 		{
				    	 			$pdf->SetXY(13,31.5);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->profession, 0, 0, 'C', 0);

				    	 		}
				    	 		//Father Qualification
				    	 		if($father_detail[$i]->qualification != 'null')
				    	 		{
				    	 			$pdf->SetXY(13,38.5);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->qualification, 0, 0, 'C', 0);

				    	 		}
				    	 		//Father Designation
				    	 		if($father_detail[$i]->designation != 'null')
				    	 		{
				    	 			$pdf->SetXY(13,44.5);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->designation, 0, 0, 'C', 0);

				    	 		}
				    	 		//Father Company
				    	 		if($father_detail[$i]->company != 'null')
				    	 		{
				    	 			
				    	 			$pdf->SetXY(13,57.5);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->company, 0, 0, 'C', 0);
				    	 		}
				    	 		//Father Department
				    	 		if($father_detail[$i]->department != 'null')
				    	 		{
				    	 			$pdf->SetXY(13,51);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->department, 0, 0, 'C', 0);
				    	 		}
				    	 		//Father Nic
				    	 		if($father_detail[$i]->nic != 'null')
				    	 		{
				    	 			$pdf->SetXY(13,64.5);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->nic, 0, 0, 'C', 0);
				    	 		}
				    	 		//Father Mobile Phone
				    	 		if($father_detail[$i]->mobile_phone != 'null')
				    	 		{
				    	 			$pdf->SetXY(13,71);
				    	 			$pdf->Cell(72, 4, $father_detail[$i]->mobile_phone, 0, 0, 'C', 0);
				    	 		}
				    	 		//Adress Field is Required There
				    	 		$fatherAdress = $father_detail[$i]->address;
				    	 		$pdf->SetXY(13,77.5);
				    	 		$pdf->Cell(72, 4, $fatherAdress, 0, 0, 'C', 0);

				    	 		//Father Marital
				    	 		if( $father_detail[$i]->marital_status != 0 )
				    	 		{
				    	 			$pdf->SetXY(13,84.5);
									if( $father_detail[$i]->marital_status == 1 ){
									$pdf->Cell(72, 4, 'Married', 0, 0, 'C', 0);	
									}elseif( $father_detail[$i]->marital_status == 2 ){
										$pdf->Cell(72, 4, 'Never Married', 0, 0, 'C', 0);
									}else{
										$pdf->Cell(72, 4, 'Single', 0, 0, 'C', 0);
									}
				    	 			
				    	 		}

				    	 
				    	 	}
				    	 }

				    	 	if($spouseIntegration == 1)
				    	 	{
				    	 		if(!empty($spouse_detail))
				    	 		{
				    	 		for($i=0; $i<sizeof($spouse_detail); $i++)
				    	 		{
				    	 			//var_dump($spouse_detail);

				    	 			$pdf->SetDrawColor(0,80,180);
				    				$pdf->SetFont('Arial','',8);
				    				$pdf->SetFillColor(0,80,180);

				    				//Spouse Name
				    				if($spouse_detail[$i+1]->name != '')
				    				{
				    					$pdf->SetXY(125.2,25);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->name, 0, 0, 'C', 0);
				    				}

				    				//Spouse Profession
				    				if($spouse_detail[$i+1]->profession != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,31.5);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->profession, 0, 0, 'C', 0);

				    	 			}
				    	 			//Spouse Qualification
				    	 			if($spouse_detail[$i+1]->qualification != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,38.5);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->qualification, 0, 0, 'C', 0);

				    	 			}
				    	 			//Spouse Designation
				    	 			if($spouse_detail[$i+1]->designation != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,44.5);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->designation, 0, 0, 'C', 0);

				    	 			}
				    	 			//Spouse Company
				    	 			if($spouse_detail[$i+1]->company != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,51);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->company, 0, 0, 'C', 0);
				    	 			}
				    	 			//Spouse Department
				    	 			if($spouse_detail[$i+1]->department != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,57.5);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->department, 0, 0, 'C', 0);
				    	 			}
				    	 			//Spouse Nic
				    	 			if($spouse_detail[$i+1]->nic != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,64.5);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->nic, 0, 0, 'C', 0);
				    	 			}
				    	 		//Spouse Mobile Phone
				    	 			if($spouse_detail[$i+1]->mobile_phone != 'null')
				    	 			{
				    	 				$pdf->SetXY(125.2,71);
				    	 				$pdf->Cell(72, 4, $spouse_detail[$i+1]->mobile_phone, 0, 0, 'C', 0);
				    	 			}
				    	 		//Adress Field is Required There
				    	 			$spouseAddress = $spouse_detail[$i+1]->address;
				    	 			$pdf->SetXY(125.2,77.5);
				    	 			$pdf->Cell(72, 4, $spouseAddress, 0, 0, 'C', 0);

				    	 		//Spouse Marital
				    	 			
									
									//Father Marital
				    	 		if( $spouse_detail[$i+1]->marital_status != '' )
				    	 		{
				    	 			$pdf->SetXY(125.2,84.5);
									
									if( $spouse_detail[$i+1]->marital_status == 1 ){
									
									$pdf->Cell(72, 4, 'Married', 0, 0, 'C', 0);
									}elseif( $spouse_detail[$i+1]->marital_status == 2 ){
										
										$pdf->Cell(72, 4, 'Never Married', 0, 0, 'C', 0);
									}else{
										
										$pdf->Cell(72, 4, 'Single', 0, 0, 'C', 0);
									}
				    	 			
				    	 		}
								


				    	 		}
				    	 	  }
				    	 	}

				    	

				    	 	// Children Detail
				    	 	
								
				    	 	if($GFID != '' )
				    	 	{
								$GFID = $this->makeGFID($GFID);
								
				    	 		$pdf->SetDrawColor(0,80,180);
		    					$pdf->SetFont('Arial','',10);
		    					$pdf->SetFillColor(0,80,180);
		    					$pdf->SetXY(66.5,87.5);
				    			$pdf->Cell(32, 6.4, $GFID, $borderOn, 0, 'L', 0);

				    			//Child Name
				    			$height=0;
				    			for($i=0;$i<sizeof($child_name);$i++)
				    			{
						    		$pdf->SetDrawColor(0,80,180);
						    		$pdf->SetFont('Arial','',10);
						    		$pdf->SetFillColor(0,80,180);
						    		if($i == 0)
						    		{
						    			$pdf->SetXY(22.9,102.5);

						    		}
						    		else
						    		{
						    			$pdf->SetXY(22.9,$height+102.5);	
						    		}
						    		
						    		$pdf->Cell(43, 6.4, $child_name[$i], $borderOn, 0, 'L', 0);
						    		$height = $height + 6.3;
				    			}

								//Child School
				    			// $height=0;
				    			// for($i=0;$i<sizeof($child_school);$i++)
				    			// {
						    	// 	$pdf->SetDrawColor(0,80,180);
						    	// 	$pdf->SetFont('Arial','',10);
						    	// 	$pdf->SetFillColor(0,80,180);
									
						    	// 	if($i == 0)
						    	// 	{
						    	// 		$pdf->SetXY(76.2,102.5);

						    	// 	}
						    	// 	else
						    	// 	{
						    	// 		$pdf->SetXY(76.2,$height+102.5);	
						    	// 	}
						    		
						    	// 	$pdf->Cell(30, 6.4, $child_school[$i], $borderOn, 0, 'L', 0);
						    	// 	$height = $height + 6.3;
				    			// }
								
				    			//Age
				    			$height=0;
				    			for($i=0;$i<sizeof($child_aged);$i++)
				    			{
						    		$pdf->SetDrawColor(0,80,180);
						    		$pdf->SetFont('Arial','',10);
						    		$pdf->SetFillColor(0,80,180);
						    		if($i == 0)
						    		{
						    			$pdf->SetXY(66,102.5);	
						    		}
						    		else
						    		{
						    			$pdf->SetXY(66,$height+102.5);	
						    		}
						    		
						    		$pdf->Cell(10, 6.4, $child_aged[$i], $borderOn, 0, 'L', 0);
						    		$height = $height + 6.3;
				    			}

				    			//GS_ID
				    			// $height=0;
				    			// for($i=0;$i<sizeof($child_gs);$i++)
				    			// {
						    	// 	$pdf->SetDrawColor(0,80,180);
						    	// 	$pdf->SetFont('Arial','',10);
						    	// 	$pdf->SetFillColor(0,80,180);
						    	// 	if($i == 0)
						    	// 	{
						    	// 		$pdf->SetXY(106.7,109);	
						    	// 	}
						    	// 	else
						    	// 	{
						    	// 		$pdf->SetXY(106.7,$height+109);	
						    	// 	}
						    		
						    	// 	$pdf->Cell(25, 6.4, $child_gs[$i], $borderOn, 0, 'L', 0);
						    	// 	$height = $height + 6.3;
				    			// }
				    			//SNO
				    			$height=0;
				    			$count=1;
				    			for($i=0;$i<sizeof($child_name);$i++)
				    			{
						    		$pdf->SetDrawColor(0,80,180);
						    		$pdf->SetFont('Arial','',10);
						    		$pdf->SetFillColor(0,80,180);
						    		if($i == 0)
						    		{
						    			$pdf->SetXY(12.7,102.5);

						    				
						    		}
						    		else
						    		{
						    			$pdf->SetXY(12.7,$height+102.5);	
						    		}
						    		
						    		$pdf->Cell(10, 6.4, $count, $borderOn, 0, 'L', 0);
						    		$height = $height + 6.3;
						    		$count = $count+1;
				    			}
				    			


				    	 	}
				    	 	//********************
				    	 	//					 *
				    	 	//	  KIN OF NEXT    *
				    	 	//					 *		
				    	 	//********************

				    	 	
				    	 	//Kin Name
				    	 	
				    	 	if($kin_name != '')
				    	 	{
				    	 	 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(14,142.2);
							 $pdf->Cell(71, 4, $kin_name, $borderOn, 0, 'C', 0);
				    	 	}
				    	 	
				    	 	//Kin Address

				    	 	if($kin_address != '')
				    	 	{

				    	 	 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(14,148.8);
							 $pdf->Cell(71, 4, $kin_address, $borderOn, 0, 'C', 0);
				    	 	}
				    	 	
				    	 	//Kin Email

				    	 	if($kin_email != '')
							{

							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(14,155.2);
							 $pdf->Cell(71, 4, $kin_email, $borderOn, 0, 'C', 0);

							}
							
							//Kin phone

							if($kin_phone != '')
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(14,162);
							 $pdf->Cell(71, 4,$kin_phone, $borderOn, 0, 'C', 0);
							}

							//Kin Relation

							if($kin_relation != '')
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(14,168.5);
							 $pdf->Cell(71, 4, $kin_relation, $borderOn, 0, 'C', 0);
							}

						

				    	 	//*********************
				    	 	// 					  *		
				    	 	// Alternate Contact  *
				    	 	//					  *	
				    	 	//*********************

				    	 	
				    	 	//Emergency Number

				    	 	if(!empty($ekin_name))
				    	 	{
				    	 	 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(126.1,142.2);
							 $pdf->Cell(71, 4, $ekin_name, $borderOn, 0, 'C', 0);
							}
							
							//Emergency Address

							if(!empty($ekin_address ))
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(126.1,148.8);
							 $pdf->Cell(71, 4, $ekin_address, $borderOn, 0, 'C', 0);
							}

							//Emergency Email

							if(!empty($ekin_email ))
							{

							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(126.1,155.2);
							 $pdf->Cell(71, 4, $ekin_email, $borderOn, 0, 'C', 0);

							}

							//Emergency Phone

							if(!empty($ekin_phone))
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(126.1,162);
							 $pdf->Cell(71, 4, $ekin_phone, $borderOn, 0, 'C', 0);
							}

							//Emergency Relation

							if(!empty($ekin_relation))
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',8);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(126.1,168.5);
							 $pdf->Cell(71, 4, $ekin_relation, $borderOn, 0, 'C', 0);
							}

							//****************
							//	Bank Detail	 *	
				    	 	//				 *
							//****************

							//Bank Name

							// if(!empty($Bank_name))
							// {
							//  $pdf->SetDrawColor(0,80,180);
						 //     $pdf->SetFont('Arial','',10);
						 //     $pdf->SetFillColor(0,80,180);
							//  $pdf->SetXY(13,195.7);
							//  $pdf->Cell(90, 6.5, $Bank_name, $borderOn, 0, 'L', 0);
							// }

							//Bank Branch

							if(!empty($Bank_branch))
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',10);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(53.5,189);
							 $pdf->Cell(90.6, 6.5, $Bank_branch, $borderOn, 0, 'L', 0);	
							}

							//Branch code

							// if(!empty($Bank_branch_code))
							// {
							//  $pdf->SetDrawColor(0,80,180);
						 //     $pdf->SetFont('Arial','',10);
						 //     $pdf->SetFillColor(0,80,180);
							//  $pdf->SetXY(53.,208.2);
							//  $pdf->Cell(90, 6.5, $Bank_branch_code, $borderOn, 0, 'L', 0);
							// }

							//Bank Account

							if(!empty($Bank_account))
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',10);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(123,189);
							 $pdf->Cell(90.6, 6.5, $Bank_account, $borderOn, 0, 'L', 0);	
							}

							//*******************
							//					*
							//Eobi AND SESSI NO *
							//					*
							//*******************


							//EOBI NO

							$pdf->SetDrawColor(0,80,180);
						    $pdf->SetFont('Arial','',10);
						    $pdf->SetFillColor(0,80,180);
							$pdf->SetXY(96.5,210);
							$pdf->Cell(90.6, 6.5, $Eobi, $borderOn, 0, 'L', 0);

							//SESSI NO
				    		
				    		$pdf->SetDrawColor(0,80,180);
						    $pdf->SetFont('Arial','',10);
						    $pdf->SetFillColor(0,80,180);
							$pdf->SetXY(96.5,210);
							$pdf->Cell(90.6, 6.5, $Sessi, $borderOn, 0, 'L', 0);

							//*****************
							//				  *
							//Provident Fund  *
							//  			  *
							//*****************
							
							if($Provident == 'Yes')
				    		{
				    		 $pdf->AddFont('wingdng2','','wingdng2.php');
					    	 $pdf->SetFont('wingdng2','',$gender_mark_size);
					    	 $pdf->SetXY(13, 211);
					    	 $pdf->Write(5, 'P');

				    		}
				    		elseif($Provident == 'No')
				    		{
				    		 $pdf->AddFont('wingdng2','','wingdng2.php');
					   		 $pdf->SetFont('wingdng2','',$gender_mark_size);
					    	 $pdf->SetXY(32, 211);
					    	 $pdf->Write(5, 'P');
				    		}

				    		//*************
				    		//    NTN     *
				    		//*************

				    		$pdf->SetDrawColor(0,80,180);
						    $pdf->SetFont('Arial','',10);
						    $pdf->SetFillColor(0,80,180);
							$pdf->SetXY(49.5,210);
							$pdf->Cell(39, 6.5, $NTN, $borderOn, 0, 'L', 0);

							//*************
							//			  *  
							//	Takaful   *
							//			  *
							//*************

							//SELF

							if($Self == "Yes")
							{
							 $pdf->AddFont('wingdng2','','wingdng2.php');
					    	 $pdf->SetFont('wingdng2','',15);
					    	 $pdf->SetXY(24, 228.5);
					    	 $pdf->Write(5, 'P');
							}

							//SPOUSE

							if($Spouse == "Yes")
							{
							 $pdf->AddFont('wingdng2','','wingdng2.php');
					    	 $pdf->SetFont('wingdng2','',15);
					    	 $pdf->SetXY(56.5, 228.5);
					    	 $pdf->Write(5, 'P');
							}

							//Children

							if($Children == "Yes")
							{
							 $pdf->AddFont('wingdng2','','wingdng2.php');
					    	 $pdf->SetFont('wingdng2','',15);
					    	 $pdf->SetXY(88, 228.5);
					    	 $pdf->Write(5, 'P');
							}
							//Reason for not taking Takaful
							if($Reason_no)
							{
							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',7);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(16,236.5);
							 $decrement_step = 0.1;
				    		 $line_width = 157;
				    		 $pdf->SetFont($font_name);			    
				    		 //$pdf->SetXY(40.3, 267.8);
				    		 $this_font_size = $font_size;
				    		while($pdf->GetStringWidth($Reason_no) > $line_width) {
								$this_font_size -= $decrement_step;
								$pdf->SetFont($font_name,'',$this_font_size);
								}
							 $pdf->Cell($line_width, 5, $Reason_no, $borderOn, 0, 'L', 0) ;

 							}
 							if($Certificate_no)
 							{
 							 $pdf->SetDrawColor(0,80,180);
						     $pdf->SetFont('Arial','',9);
						     $pdf->SetFillColor(0,80,180);
							 $pdf->SetXY(153,226.5);
							 $pdf->Cell(43, 8, $Certificate_no, $borderOn, 0, 'L', 0) ;
 							}

 							if($FullName){
 								$pdf->SetFont('Arial','',10);
 								$pdf->SetXY(17.5,264.5);
 								$pdf->Cell(60, 6.5, $FullName, $borderOn, 0, 'L', 0);
 							}



						}
					}
					
		$pdf->Output($solangigtID . '.pdf', 'I');
		ob_end_flush();
		
	}// end makePDFFile
	
	
}