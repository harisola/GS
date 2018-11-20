<?php
class Staff extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		
		$this->load->library('upload');
        $this->load->library('image_lib');
		
		$this->load->model('staff/staff_registered_tipb_module', 'tifb_module' );
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
	public function getEmpChildren($staffID ){
		return $this->tifb_module->getEmpChild( $staffID );
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
  
  

  
  
	
	
	// ==================================================================
	//                    Functions for Staff Basic info
	// ==================================================================
	
		public function staffBasicInfo(){
			// Basic infor variables
				

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
			//$guID = $this->input->post('guID');
			$emai1l = $this->input->post('email');
			$maritalStatus = $this->input->post('maritalStatus');
			$dateOfBith = $this->input->post('dateOfBith');
			$employmentStauts = $this->input->post('employmentStauts');
			
			$religion = $this->input->post('religion');
			$dateOfBith = date("Y-m-d", strtotime( $dateOfBith ) );


			
			/*$address = $this->input->post('address');
			$imageName = "sc_name";
			$return =  $this->imageUpload( $imageName );
			$fullImage =  $return['imageName'];
			$thumbnail = $return['imageThumb'];*/
			
			
			
			
			
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
			// $address = $this->input->post('basicAddress');
			$imageName = "sc_name";
			$return =  $this->imageUpload( $imageName );
			$fullImage =  $return['imageName'];
			$thumbnail = $return['imageThumb'];
			//$providentFund = $this->input->post('providentFund');
			//$ntnNumber = $this->input->post('ntnNumber');
						
			if( $fullImage != '' ){
				$supporting  = array(
				'staff_id' => $staffID,
				'religion' => $religion,
				'employment_status' => $maritalStatus,
				'fullImage' => $fullImage,
				'thumbnail' => $thumbnail,
				// 'address' => $address,
				'emailPersonal' => $emai1l,
				'nationality' => $nationality
				//'providentFund' => $providentFund,
				//'nationalTaxNumber' => $ntnNumber
				);
			}else{
				$supporting  = array(
				'staff_id' => $staffID,
				'religion' => $religion,
				'employment_status' => $maritalStatus,
				// 'address' => $address,
				'emailPersonal' => $emai1l,
				'nationality' => $nationality
				
				//'providentFund' => $providentFund,
				//'nationalTaxNumber' => $ntnNumber
				);
			}
			if($this->getEmpSupport($staffID) ){
			$this->updateSupporting( $staffID, $supporting );
			}else{
				$this->overWriteSupporting( $supporting );	
			}


			//======================== Address ============================//

			$this->load->model('staff/staff_registered_tipb_module','srtm');
			$appartment_no = $this->input->post('appartment_no');
			$street_name = $this->input->post('street_name');
			$building_name = $this->input->post('building_name');
			$plot_name = $this->input->post('plot_no');
			$region = $this->input->post('region');
			$sub_region = $this->input->post('sub_region');



			
			//======================== Other Button ====================//
			$other_region = $this->input->post('other_region');
			$other_sub_region = $this->input->post('other_sub_region');

			if(!empty($other_region) && !empty($other_sub_region)){
				$data_region = array(
					'name' => $other_region
				);

				$inserted_row = $this->srtm->insert_data('atif._region',$data_region);
				if($inserted_row != 0){

					$get_other_id = $this->srtm->get_by('atif._region',$data_region);
					$region = $get_other_id[0]->id;
					$region_name = $get_other_id[0]->name;

					if(!empty($other_sub_region)){

						$data_sub_region = array(
							'region_id' => $region,
							'name' => $other_sub_region,
						);

						$affected_sub = $this->srtm->insert_data('atif._region_sub',$data_sub_region);

						if($affected_sub != 0){
							
							$where_other_sub_region = array(
								'region_id' => $region,
								'name' => $other_sub_region
							);

							$get_other_sub_region = $this->srtm->get_by('atif._region_sub',$where_other_sub_region);

							$sub_region = $get_other_sub_region[0]->id;
							$region = $region;
						}
					}


				}
			}


			//===========Update Address ================================//

			$where = array(
				'staff_id' => $staffID
			);
			
			$get_address = $this->srtm->get_by('atif.staff_contact_info',$where);

			if(!empty($get_address)){
				$id = $get_address[0]->id;

				$where_update = array(
					'id' =>$id
				);

				$data_update = array(
				'apartment_no' => $appartment_no,
				'building_name' => $building_name,
				'plot_no' => $plot_name,
				'street_name' => $street_name,
				'sub_region' => $sub_region,
				'region' => $region,
				'city' => 'karachi',
				'country' => 'Pakistan',
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
				);

				$updated_row =  $this->srtm->save('atif.staff_contact_info',$data_update,$where_update);
				echo $updated_row;
				
			}else{



			//=================Address Insert =============================//

			$data = array(
				'staff_id' => $staffID,
				'apartment_no' => $appartment_no,
				'building_name' => $building_name,
				'plot_no' => $plot_name,
				'street_name' => $street_name,
				'sub_region' => $sub_region,
				'region' => $region,
				'city' => 'karachi',
				'country' => 'Pakistan',
				'created' => time(),
				'register_by' => $this->session->userdata('user_id'),
				'modified' => time(),
				'modified_by' => $this->session->userdata('user_id')
			);

			
			$affected_rows = $this->srtm->insert_data('staff_contact_info',$data);
			echo $affected_rows;
		}

			//========================= Address End =======================//
		}
	 // ============= End Staff Basic Info =====================================

	
	
	
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
	//   End image uploading and resizing process
	// ----------------------------------------
	
	
	
	
	// ------------------------------------------------------------------------------
	//             Function for Employee Education Record updataton
	// ------------------------------------------------------------------------------
		
		public function updateEducationRecord(){
			
		$staffID = $this->input->post('staffID');	
		$schoolName = $this->input->post('schoolName');
		$schoolSubject = $this->input->post('schoolSubject');
		
		$schoolQualification = $this->input->post('schoolQualification');
		$schoolResult = $this->input->post('schoolResult');
		
		$schoolYear = $this->input->post('schoolYear');
		$noOfSchools = $this->input->post('level');
		$levelID = 1;
		
		//print_r( $noOfSchools );
		
		$this->removeQualification($staffID,$levelID );
		
		for ($i=0; $i<sizeof($schoolName); $i++){
			
			if( $schoolName[$i] != '' ){
				$inSchool = array(
					'staff_id' => $staffID,
					'level' => 1,
					'title' => $schoolName[$i],
					'institute' => $schoolName[$i],
					'subjects' => $schoolSubject[$i],
					'qualification' =>$schoolQualification[$i],
					'result' => $schoolResult[$i],
					'year_of_completion' => $schoolYear[$i]
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
					'year_of_completion' => $othersYear[$i],
				);
				$this->insertQualification( $empOthers );	
			}
		}
		
		
		}
	// ----------------- End function for Education Record --------------------------
	
	
	
	
	// -------------------------------------------------------------------------------
	//            Controller method for updating Employer employment record
	// -------------------------------------------------------------------------------
		
		public function updateEmploymentRecord(){
			$staffID = $this->input->post('staffID');	
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
		
		}
		
	// ---------------- End method for employer employment record --------------------

	// -------------------------------------------------------------------------------
	//                   Controller function for editing Spouse Detail
	// -------------------------------------------------------------------------------
		public function updateSpouseDetail(){
			
			$staffID = $this->input->post('staffID');
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
				//'marital_status' => NULL,
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
		
		}
	// ------------------- End function for editing Spouse Detail --------------------
	
	
	// ------------------------------------------------------------------------------
	//                    Function for editing AlternativeContact
	// ------------------------------------------------------------------------------
		public function updateAlternativeContact(){
			
			$staffID = $this->input->post('staffID');
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
			
		}
	// ---------------------    End Alternative Contact ----------------------------
	
	
	// -----------------------------------------------------------------------------
	//                      Function for editing bank details
	// -----------------------------------------------------------------------------
		public function updateBankDetails(){
			$staffID = $this->input->post('staffID');
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
		}
	// -------------------- End bank details ---------------------------------------
	
	
	// -----------------------------------------------------------------------------
	//                      Function for editing Other details
	// -----------------------------------------------------------------------------
		public function updateOtherDetails(){
			
			$staffID = $this->input->post('staffID');
			$eobiNumber = $this->input->post('eobiNumber');
			$sessiNumber = $this->input->post('sessiNumber');
			
			$othersDetails = array(
				'eobi_no'	=> $eobiNumber,
				'sessi_no' => $sessiNumber
			);
		
			
			$this->updateStaffRegister($othersDetails, $staffID );
			
		}
	// -------------------- End Other details ---------------------------------------
	
	
	
	// -----------------------------------------------------------------------------
	//                      Function for editing 	Provident Fund
	// -----------------------------------------------------------------------------
		public function updateProvidentFund(){
			
			$staffID = $this->input->post('staffID');
			$providentFund = $this->input->post('providentFund');
			//$ntnNumber = $this->input->post('ntnNumber');
			if($this->getEmpSupport($staffID) ){
				$supporting  = array( 'providentFund' => $providentFund );
				$this->updateSupporting( $staffID, $supporting );
			}else{
				$supporting  = array( 'staff_id' => $staffID, 'providentFund' => $providentFund );
				$this->overWriteSupporting( $supporting );	
			}
			//$this->updateSupporting( $staffID , $data);
		}
	// -------------------- End Provident Fund ---------------------------------------
	
	
	
	// -----------------------------------------------------------------------------
	//                      Function for editing National Tax Number
	// -----------------------------------------------------------------------------
		public function updateNtn(){
			$staffID = $this->input->post('staffID');
			$ntnNumber = $this->input->post('ntnNumber');
			
			if($this->getEmpSupport($staffID) ){
				$supporting  = array(  'nationalTaxNumber' => $ntnNumber );	
				$this->updateSupporting( $staffID, $supporting );
			
			}else{
				$supporting  = array( 'staff_id' => $staffID, 'nationalTaxNumber' => $ntnNumber );	
				$this->overWriteSupporting( $supporting );	
			}
			
			//$this->updateSupporting( $staffID,$data );
		}
	// -------------------- End National Tax Number  ---------------------------------
	
	
	// -----------------------------------------------------------------------------
	//                      Function for editing Takaful
	// -----------------------------------------------------------------------------
		public function updateTakaful(){
			
			$staffID = $this->input->post('staffID');
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
			
		}
	// --------------------         End Takaful      --------------------------------
	
	
	
	//---------------------------------- Get Sub Region ------------------------------//
	//--------------------------------------------------------------------------------//

		public function get_sub_region(){
			$region_id = $this->input->post('region');
			$this->load->model('staff/staff_registered_tipb_module','srtm');
			$where = array(
				'region_id' => $region_id
			);
			$sub_region = $this->srtm->get_by('atif._region_sub',$where);
			$html = '';
			$html .= '<label class="select">';
			$html .= '<label class="input"> <i class="icon-append fa fa-asterisk"></i>';
			$html .= '<select name="sub_region" id="sub_region" class="form-control valid">';
			if(!empty($sub_region)){
				foreach($sub_region as $sub){
					//$html .= '<h2>Check</h2>';
					$html .= '<option value = "'.$sub->id.'">'.$sub->name.'</option>';

				}
			}
			$html .='</select>';
			$html .='</label>';
			$html .= '</label>';
			echo $html;
		}
	
}
?>