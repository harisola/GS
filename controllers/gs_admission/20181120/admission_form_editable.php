<?php

class Admission_form_editable extends CI_Controller
{
    
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $user_id       = (int) $this->session->userdata('user_id');
        $this->user_id = $user_id;
    }
    
    public function index()
    {
        
        if ($this->ion_auth->logged_in() == FALSE) {
            redirect('welcome');
        } else {
            $this->load->view('gs_files/header');
            $this->load->view('gs_files/main-nav');
            $this->load->view('gs_files/breadcrumb');
            
            $this->load->model('gs_admission/edit_admission_form', 'eaf');
            $data['admission_form'] = $this->eaf->getAllAdmissionForm();
            
            $this->load->view('gs_admission/admission_form_edit/admission_form_edit_view', $data);
            $this->load->view('gs_admission/admission_form_edit/admission_form_edit_footer');
        }
        
        
        
    }

    /*
    *--------------------------------------------
    *  Appicant Detail
    *---------------------------------------------
    */

    
    public function getApplicantDetail()
    {
        $this->load->model('gs_admission/edit_admission_form', 'eaf');
        $admission_form_id = $this->input->post('admission_form_id');
        if ($admission_form_id != 0) {
            $staffAdmissionData = $this->eaf->getAdmissionFormByID($admission_form_id);
            echo json_encode($staffAdmissionData);
        }
        
    }
    
    /*
     * -------------------------------------------------------------------------------
     *  Function used to Update Information From Applicant
     * -------------------------------------------------------------------------------
     */
    
    public function editApplicationDetail()
    {

        $this->load->model('gs_admission/edit_admission_form', 'eaf');
        $admission_form_id = $this->input->post('admission_form_id');
        $official_name     = $this->input->post('official_name');
        $call_name         = $this->input->post('call_name');
        $gender            = $this->input->post('gender');
        $father_name       = $this->input->post('father_name');
        $mother_name       = $this->input->post('mother_name');
        $father_nic        = $this->input->post('father_nic');
        $mother_nic        = $this->input->post('mother_nic');
        $father_email      = $this->input->post('father_email');
        $mother_email      = $this->input->post('mother_email');
        $student_nic       = $this->input->post('student_nic');
        $student_email     = $this->input->post('student_email');
        $gf_id             = $this->input->post('gf_id');
        $grade_id          = $this->input->post('grade_id');
        $grade_name        = $this->input->post('grade_name');
  
        
        
        $fatherNumberData  = $this->findLocalNumber($this->input->post("father_code"), $this->input->post("f_no"));
        $motherNumberData  = $this->findLocalNumber($this->input->post("mother_code"), $this->input->post("m_no"));
        $studentNumberData = $this->mergeStudentMobile($this->input->post("student_code"), $this->input->post("s_no"));



        
        // Father local Number
        if (!empty($fatherNumberData['local_number'])) {
            $father_mobile = substr($fatherNumberData['local_number'],0,4)."-".substr($fatherNumberData['local_number'],4,strlen($fatherNumberData['local_number']));
        } else {
            $father_mobile = '';
        }
        
        
        // Mother Local Number
        if (!empty($motherNumberData['local_number'])) {
            $mother_mobile = substr($motherNumberData['local_number'],0,4)."-".substr($motherNumberData['local_number'],4,strlen($motherNumberData['local_number']));
        } else {
            $mother_mobile = '';
        }
        

        
        $student_mobile = $studentNumberData['phone_numbers'];
        $mother_mobile_other = $motherNumberData['phone_numbers'];
        $father_mobile_other = $fatherNumberData['phone_numbers'];
        
        $where = array(
            'id' => $admission_form_id
        );
        
        $data = array(
            'official_name' => $official_name,
            'call_name' => $call_name,
            'gender' => $gender,
            'father_name' => $father_name,
            'mother_name' => $mother_name,
            'father_email' => $father_email,
            'mother_email' => $mother_email,
            'father_nic' => $father_nic,
            'mother_nic' => $mother_nic,
            'father_mobile' => $father_mobile,
            'father_mobile_other' => $father_mobile_other,
            'mother_mobile' => $mother_mobile,
            'mother_mobile_other' => $mother_mobile_other,
            'student_nic' => $student_nic,
            'student_email' => $student_email,
            'student_mobile' => $student_mobile,
            'grade_id' => $grade_id,
            'grade_name' => $grade_name,
            'request_grade' => $this->input->post('request_grade'),
            'request_for_grade' => $this->input->post('request_for_grade')

        );
        
        $a = $this->eaf->updateAdmission($where, $data);
        
        
        
    }
    
    
    /*
     * -------------------------------------------------------------------------------
     *  Function used to find local number from all numbers using country code and number and return string
     * -------------------------------------------------------------------------------
     */
    public function findLocalNumber($phone_code, $phone_number)
    {
        
        $phone_numbers     = array();
        $user_phone_number = '';
        $flag              = 0;

        
        for ($i = 0; $i < count($phone_code); $i++) {
            
            if (strpos($phone_code[$i], '92') !== false && $flag != 1) {
                $flag              = 1;
                $user_phone_number = '0' . $phone_number[$i];
            } else {
           
                array_push($phone_numbers, $phone_code[$i] . '-' . $phone_number[$i]);
            }
            
        }

        
        
        $data['phone_numbers'] = implode(",", $phone_numbers);
        $data['local_number']  = $user_phone_number;
        
        return $data;
        
    }
    
    /*
     * -----------------------------------------------------------------------------------
     *  Function used to merge all numbers using country code and number and return string
     * -----------------------------------------------------------------------------------
     */
    public function mergeStudentMobile($phone_code, $phone_number)
    {
        
        $phone_numbers = array();
        for ($i = 0; $i < count($phone_code); $i++) {
            
            array_push($phone_numbers, $phone_code[$i] . '-' . $phone_number[$i]);
        }
        
        $data['phone_numbers'] = implode(",", $phone_numbers);
        return $data;
    }
    
    public function insertAtPosition($string, $insert, $position)
    {
        return substr_replace($string, $insert, $position, 0);
        
    }
}