<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admission_process_flows extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
    }


    public function index(){
        //if($this->ion_auth->logged_in() == FALSE){
        //    redirect('welcome');
      //  }else{
            $this->load->model('gs_admission/process_flows/process_flow_model');
            $this->pd['issuance'] = $this->process_flow_model->getCount_IssuanceOfAll();
            
            $this->load->view('gs_files/header');
            $this->load->view('gs_files/main-nav');
            $this->load->view('gs_files/breadcrumb');
            
            $user_id = (int)$this->session->userdata("user_id");
            
            $this->load->view('gs_admission/process_flows/process_flow/processflow_css');
            $this->load->view('gs_admission/process_flows/process_flow/ProcessFlow');
       // }
    }









    public function edit(){
        $html = '';



        $this->load->model('gs_admission/process_flows/process_flow_model');
        
        $gradeID = $this->input->post('gradeID');
        $gradeIDs = explode(",", $gradeID);
        $gender = $this->input->post('gender');
        $genders = explode(",", $gender);
        $gender = $genders[0];
        $batchID = $this->input->post('batch');



        if($gradeID == '' && $gender=='' && $batchID==''){
            $this->pd['issuance'] = $this->process_flow_model->getCount_IssuanceOfAll();
        }else{
            if(count($gradeIDs)==2 && $gradeIDs[0] == 'All' && count($gender)<1){
                $this->pd['issuance'] = $this->process_flow_model->getCount_IssuanceOfAll();
            }else{
                $this->pd['issuance'] = $this->process_flow_model->getCount_Issuance($gradeIDs, $batchID, $genders);
            }
        }



        $ad_issuance='-';
        $ad_submitted='-';
        $ad_submission_extension='-';
        $ad_toBeAllocated_assessment='-';
        $ad_submissionFollowup='-';
        $ad_submissionNotInterested='-';
        $ad_assessmentAllocated='-';
        $ad_assessmentExtension='-';
        $ad_assessmentPresence='-';
        $ad_discussionPresence='-';
        $ad_assessmentFollowup='-';
        $ad_assessmentCurrentlyFollowup='-';
        $ad_assessmentShowedup='-';
        $ad_assessmentOnHold='-';
        $ad_assessmentWaitList ='-';
        $ad_assessmentRegert='-';
        $ad_assessmentWaitList_Regert='-';
        $ad_assessmentCurrentlyWaitlist='-';
        $ad_assessmentAllocatedWaitlist='-';
        $ad_assessmentExtension='-';
        $ad_discussionCFD='-';
        $ad_discussionShowedup='-';
        $ad_discussionFollowup='-';
        $ad_discussionCurrentlyFollowup='-';
        $ad_discussionNotIntrested='-';
        $ad_principleOffer='-';
        $ad_principleOfferApprove='-';
        $ad_principleOfferWaitlist='-';
        $ad_principleOfferRegert='-';
        $ad_principleOfferOnHold='-';
        $ad_offerPreperation='-';
        $ad_confirmOfferPreperation='-';
        $ad_offerLetterRecieved='-';
        $ad_offerLetterFollowup='-';
        $ad_offerLetterExtension='-';
        $ad_offerLetterCurrentlyFollowUp='-';
        $ad_offerLetterNotIntrested='-';
        $ad_offerLetterDueDate='-';
        $ad_offerLetterDueDateExtension='-';
        $ad_offerLetterFollowup='-';
        $ad_offerLetterNotIntrested='-';
        $ad_applicantRegert='-';
        $ad_applicantAdmissionCompelete='-';
        $ad_applicantNotIntrested='-';

        //==================== Status And Stage =================//
        //=======================================================//

        $ad_issuance_status_id = 9999;
        $ad_issuance_stage_id = 9999;

        $ad_submitted_status_id = 2;

        /* Submission Folowup */
        $ad_submissionFollowup_status_id = 2;
        $ad_submissionFollowup_stage_id = 5;

        $ad_assessmentFollowup_status_id = 3;
        $ad_assessmentFollowup_stage_id = 5;

        $ad_offerFollowup_status_id = 5;
        $ad_offerFollowup_stage_id = 5;

        $ad_submissionNotInterested_status_id = 2;
        $ad_submissionNotInterested_stage_id = 7;

        $ad_assessmentAllocated_status_id = 3;
        $ad_assessmentAllocated_stage_id_one =1;
        $ad_assessmentAllocated_stage_id_two = 2;

        $ad_assessmentPresence_status_id = 3;
        $ad_assessmentPresence_stage_id = 4;

        $ad_discussionPresence_status_id = 4;
        $ad_discussionPresence_stage_id = 4;

        $ad_assessmentShowedup_status_id = 3;
        $ad_assessmentShowedup_stage_id_one = 8 ;
        $ad_assessmentShowedup_stage_id_two = 9;
        $ad_assessmentShowedup_stage_id_three = 14;

        $ad_assessmentOnHold_status_id = 3;
        $ad_assessmentOnHold_stage_id_one = 8;
        $ad_assessmentOnHold_stage_id_two = 16;

        $ad_assessmentWaitList_status_id = 3;
        $ad_assessmentWaitList_stage_id = 9;

        $ad_assessmentRegert_status_id = 3;
        $ad_assessmentRegert_stage_id = 6;

        $ad_assessmentWaitList_Regert_status_id = 3;
        $ad_assessmentWaitList_Regert_stage_id = 17;

        $ad_assessmentCurrentlyWaitlist_status_id = 3;
        $ad_assessmentCurrentlyWaitlist_stage_id = 9;


        $ad_assessmentAllocatedWaitlist_status_id = 3;
        $ad_assessmentAllocatedWaitlist_stage_id = 1;

        $ad_assessmentExtension_status_id = 3;
        $ad_assessmentExtension_stage_id = 10;

        $ad_discussionCFD_status_id = 4;
        $ad_discussionCFD_stage_id = 13;

        $ad_discussionShowedup_status_id = 4;
        $ad_discussionShowedup_stage_id = 4;

        $ad_discussionFollowup_status_id = 4;
        $ad_discussionFollowup_stage_id = 5;

        $ad_discussionCurrentlyFollowup_status_id = 4;
        $ad_discussionCurrentlyFollowup_stage_id_one = 5;
        $ad_discussionCurrentlyFollowup_stage_id_two = 9;
        $ad_discussionCurrentlyFollowup_stage_id_three = 14; 

        $ad_discussionNotIntrested_status_id = 4;
        $ad_discussionNotIntrested_stage_id = 7;

        $ad_principleOffer_status_id = 5;
        $ad_principleOffer_stage_id = 12;

        $ad_principleOfferApprove_status_id = 5;
        $ad_principleOfferApprove_stage_id = 1;

        $ad_principleOfferWaitlist_status_id = 5;
        $ad_principleOfferWaitlist_stage_id = 17;

        $ad_principleOfferRegert_status_id = '';
        $ad_principleOfferRegert_stage_id = 15;

        $ad_principleOfferOnHold_status_id = 4;
        $ad_principleOfferOnHold_stage_id = 16;

        $ad_offerPreperation_status_id = 5;
        $ad_offerPreperation_stage_id = 2;

        $ad_confirmOfferPreperation_status_id = 5;
        $ad_confirmOfferPreperation_stage_id = 3;

        $ad_applicantRegert_status_id = '';
        $ad_applicantRegert_stage_id = 15;

        $ad_applicantAdmissionCompelete_status_id = 6;
        $ad_applicantAdmissionCompelete_stage_id = 1;

        $ad_applicantNotIntrested_status_id = '';
        $ad_applicantNotIntrested_stage_id = 7;

        foreach ($this->pd['issuance'] as $ad) {

            if($ad['form_status_id']==$ad_issuance_status_id && $ad['form_status_stage_id']==$ad_issuance_stage_id){
                $ad_issuance = $ad['num'];
            }


            if($ad['form_status_id']==$ad_submitted_status_id){
                $ad_submitted += $ad['num'];
            }

            if($ad['form_status_id']==$ad_submissionFollowup_status_id && $ad['form_status_stage_id']==$ad_submissionFollowup_stage_id){
                $ad_submissionFollowup += $ad['num'];
            }

            if($ad['form_status_id']==$ad_offerFollowup_status_id && $ad['form_status_stage_id']==$ad_offerFollowup_stage_id){
                $ad_offerLetterFollowup += $ad['num'];
            }


            if($ad['form_status_id']==$ad_assessmentFollowup_status_id && $ad['form_status_stage_id']==$ad_assessmentFollowup_stage_id){
                $ad_assessmentFollowup += $ad['num'];
            }

            if($ad['form_status_id']==$ad_submissionNotInterested_status_id && $ad['form_status_stage_id']==$ad_submissionNotInterested_stage_id){
                $ad_submissionNotInterested += $ad['num'];
            }

            if($ad['form_status_id']==$ad_assessmentAllocated_status_id && ($ad['form_status_stage_id']== $ad_assessmentAllocated_stage_id_one || $ad['form_status_stage_id']==$ad_assessmentAllocated_stage_id_two)){
                    $ad_assessmentAllocated += $ad['num'];
            }

            if($ad['form_status_id']==$ad_assessmentPresence_status_id && $ad['form_status_stage_id']== $ad_assessmentPresence_stage_id){
                $ad_assessmentPresence += $ad['num'];
            }

            if($ad['form_status_id']==$ad_discussionPresence_status_id && $ad['form_status_stage_id']==$ad_discussionPresence_stage_id){
                $ad_discussionPresence += $ad['num'];
            }

            if($ad['form_status_id']==$ad_assessmentShowedup_status_id && ($ad['form_status_stage_id']== $ad_assessmentShowedup_stage_id_one || $ad['form_status_stage_id']== $ad_assessmentShowedup_stage_id_two || $ad['form_status_stage_id']>= $ad_assessmentShowedup_stage_id_three)){

                $ad_assessmentShowedup += $ad['num'];
            }

            if($ad['form_status_id']==$ad_assessmentOnHold_status_id && ($ad['form_status_stage_id']==$ad_assessmentOnHold_stage_id_one || $ad['form_status_stage_id']==$ad_assessmentOnHold_stage_id_two)){
                $ad_assessmentOnHold += $ad['num'];
            }

            if($ad['form_status_id']== $ad_assessmentWaitList_status_id && ($ad['form_status_stage_id'] == $ad_assessmentWaitList_stage_id )){
                $ad_assessmentWaitList += $ad['num'];
            }

            if($ad['form_status_id']== $ad_assessmentRegert_status_id && ($ad['form_status_stage_id'] == $ad_assessmentRegert_stage_id )){
                $ad_assessmentRegert += $ad['num'];
            }
            if($ad['form_status_id']==$ad_assessmentWaitList_Regert_status_id && ($ad['form_status_stage_id'] == $ad_assessmentWaitList_Regert_stage_id )){
                 $ad_assessmentWaitList_Regert += $ad['num'];
            }

            if($ad['form_status_id']== $ad_assessmentCurrentlyWaitlist_status_id && ($ad['form_status_stage_id'] == $ad_assessmentCurrentlyWaitlist_stage_id )){
                $ad_assessmentCurrentlyWaitlist += $ad['num'];
            }
            if($ad['form_status_id']== $ad_assessmentAllocatedWaitlist_status_id && ($ad['form_status_stage_id'] == $ad_assessmentAllocatedWaitlist_stage_id )){
                $ad_assessmentAllocatedWaitlist += $ad['num'];
            }
            if($ad['form_status_id']==$ad_assessmentExtension_status_id && ($ad['form_status_stage_id'] == $ad_assessmentExtension_stage_id )){
                $ad_assessmentExtension += $ad['num'];
            }

            if($ad['form_status_id']== $ad_discussionCFD_status_id  && ($ad['form_status_stage_id'] == $ad_discussionCFD_stage_id )){
                $ad_discussionCFD += $ad['num'];
            }

            if($ad['form_status_id']== $ad_discussionShowedup_status_id && ($ad['form_status_stage_id'] == $ad_discussionShowedup_stage_id )){
                $ad_discussionShowedup += $ad['num'];
            }

            if($ad['form_status_id']== $ad_discussionFollowup_status_id && ($ad['form_status_stage_id'] == $ad_discussionFollowup_stage_id)){
                $ad_discussionFollowup += $ad['num'];
            }

            if($ad['form_status_id']== $ad_discussionCurrentlyFollowup_status_id && ($ad['form_status_stage_id'] == $ad_discussionCurrentlyFollowup_stage_id_one)){
                $ad_discussionCurrentlyFollowup += $ad['num'];
            }

            if($ad['form_status_id']== $ad_discussionNotIntrested_status_id && ($ad['form_status_stage_id'] == $ad_discussionNotIntrested_stage_id)){
                $ad_discussionNotIntrested += $ad['num'];
            }

            if($ad['form_status_id']== $ad_principleOffer_status_id && ($ad['form_status_stage_id'] == $ad_principleOffer_stage_id )){
                $ad_principleOffer += $ad['num'];
            }

            if($ad['form_status_id']== $ad_principleOfferApprove_status_id && ($ad['form_status_stage_id'] == $ad_principleOfferApprove_stage_id )){
                $ad_principleOfferApprove += $ad['num'];
            }

            if($ad['form_status_id']== $ad_principleOfferWaitlist_status_id && ($ad['form_status_stage_id'] == $ad_principleOfferWaitlist_stage_id )){
                $ad_principleOfferWaitlist += $ad['num'];
            }

            if($ad['form_status_stage_id'] == $ad_principleOfferRegert_stage_id){
                $ad_principleOfferRegert += $ad['num'];
            }

            if($ad['form_status_id']== $ad_principleOfferOnHold_status_id && ($ad['form_status_stage_id'] == $ad_principleOfferOnHold_stage_id )){
                $ad_principleOfferOnHold += $ad['num'];
            }

            if($ad['form_status_id']== $ad_offerPreperation_status_id && ($ad['form_status_stage_id'] == $ad_offerPreperation_stage_id )){
                $ad_offerPreperation += $ad['num'];
            }

            if($ad['form_status_id']== $ad_confirmOfferPreperation_status_id && ($ad['form_status_stage_id'] == $ad_confirmOfferPreperation_stage_id )){
                $ad_confirmOfferPreperation += $ad['num'];
            }

            if($ad['form_status_stage_id'] == $ad_applicantRegert_stage_id){
                $ad_applicantRegert += $ad['num'];
            }

            if($ad['form_status_id']== $ad_applicantAdmissionCompelete_status_id && ($ad['form_status_stage_id'] == $ad_applicantAdmissionCompelete_stage_id )){
                $ad_applicantAdmissionCompelete += $ad['num'];
            }

            if(($ad['form_status_stage_id'] == $ad_applicantNotIntrested_stage_id )){
                $ad_applicantNotIntrested += $ad['num'];
            }


        }



        $html .= 
            '<div class="issuanceArea absolute">
                <span class="totalApplicants tooltipp"><a href="#" id="status_stage" data-toggle="modal" data-target="#myModal" data-status="'.$ad_issuance_status_id.'" data-stage="'.$ad_issuance_stage_id.'">'.$ad_issuance.'</a><span class="tooltiptext">Form Issuance</span></span>
            </div><!-- issuanceArea -->
            
            <div class="submissionArea absolute">
                <span class="totalApplicantsOnSubmission absolute">
                    <span class="tooltipp"><a href="#" id="status_stage" data-toggle="modal" data-target="#myModal" data-status="'.$ad_submitted_status_id.'">'.$ad_submitted.'</a><span class="tooltiptext">Admission forms submitted</span></span>
                </span>
                <span class="totalApplicantsOnTBI absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_toBeAllocated_assessment.'</a><span class="tooltiptext">Applicants in To Be Allocated</span></span>
                </span>
                <span class="ApplicantsOnTBILeft absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_toBeAllocated_assessment.'</a> <span class="overdueApplicantsOnTBI"></span><span class="tooltiptext">Applicants in To Be Allocated</span></span>
                </span>
                <span class="totalApplicantsOnTBIAllocated absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentAllocated_status_id.'" data-stage="'.$ad_assessmentAllocated_stage_id_one.','.$ad_assessmentAllocated_stage_id_two.'">'.$ad_assessmentAllocated.'</a><span class="tooltiptext">Applicants Allocated</span></span>
                </span>
                <span class="followUpApplicants absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_submissionFollowup_status_id.'" data-stage="'.$ad_submissionFollowup_stage_id.'">'.$ad_submissionFollowup.'</a><span class="tooltiptext">Applicants to be Followed up</span></span>
                </span>
                <span class="followUpApplicantsCurrent absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_submissionFollowup_status_id.'" data-stage="'.$ad_submissionFollowup_stage_id.'">'.$ad_submissionFollowup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp"></span></span>
                </span>
                <span class="followUpApplicantsNI absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_submissionNotInterested_status_id.'" data-stage="'.$ad_submissionNotInterested_stage_id.'">'.$ad_submissionNotInterested.'</a><span class="tooltiptext">Applicants Not Interested</span></span>
                </span>
                <span class="followUpApplicantsExt absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal">'.$ad_submission_extension.'</a><span class="tooltiptext">Applicants for Submission Extension</span></span>
                </span>
            </div><!-- submissionArea -->
            
            <div class="assessmentArea absolute">
                <span class="totalApplicantsOnAssessment absolute">
                    <span class="tooltipp"><a href="#" id="status_stage" data-toggle="modal" data-target="#myModal" data-status="'.$ad_submitted_status_id.'">'.$ad_submitted.'</a><span class="tooltiptext">Applicants currently in Assessment</span></span>
                </span>
                <span class="totalApplicantsOnAssessmentOverAll absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_assessmentPresence_status_id.'" data-stage="'.$ad_assessmentPresence_stage_id.'">'.$ad_assessmentPresence.'</a><span class="tooltiptext">Overall applicants moved to Assessment Process</span></span>
                </span>
                <span class="totalApplicantsOnAssessmentPresent absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentShowedup_status_id.'" data-stage="'.$ad_assessmentShowedup_stage_id_one.','.$ad_assessmentShowedup_stage_id_two.','.$ad_assessmentShowedup_stage_id_three.'">'.$ad_assessmentShowedup.'</a><span class="tooltiptext">Applicants showed up for Assessment</span></span>
                </span>
                <span class="totalApplicantsOnWTLAssessment absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentWaitList_status_id.'" data-stage="'.$ad_assessmentWaitList_stage_id.'">'.$ad_assessmentWaitList.'</a><span class="tooltiptext">Overall applicants moved to Waitlist</span></span>
                </span>
                <span class="ApplicantsOnWTLLeftAssessment absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentCurrentlyWaitlist_status_id.'" data-stage="'.$ad_assessmentCurrentlyWaitlist_stage_id.'">'.$ad_assessmentCurrentlyWaitlist.'</a><span class="tooltiptext">Applicants currently in Waitlist</span> <span class="overdueApplicantsOnWTLAssessment"></span></span>
                </span>
                <span class="totalApplicantsFromWTLToRGT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentWaitList_Regert_status_id.'" data-stage="'.$ad_assessmentWaitList_Regert_stage_id.'">'.$ad_assessmentWaitList_Regert.'</a><span class="tooltiptext">Overall applicants moved to Regret</span></span>
                </span>
                <span class="totalApplicantsFromAssessmentToRGT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentRegert_status_id.'" data-stage="'.$ad_assessmentRegert_stage_id.'">'.$ad_assessmentRegert.'</a><span class="tooltiptext">Overall applicants moved to Regret</span></span>
                </span>
                <span class="totalApplicantsPassedFromWTL absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-stage="'.$ad_assessmentAllocatedWaitlist_stage_id.'" data-status="'.$ad_assessmentAllocatedWaitlist_status_id.'">'.$ad_assessmentAllocatedWaitlist.'</a><span class="tooltiptext">Overall applicants allocated from Waitlist</span></span>
                </span>
                <span class="followUpApplicants absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentFollowup_status_id.'" data-stage="'.$ad_assessmentFollowup_stage_id.'">'.$ad_assessmentFollowup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span>
                </span>
                <span class="followUpApplicantsCurrent absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal"></a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp"></span></span>
                </span>
                <span class="followUpApplicantsNI absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_submissionNotInterested_status_id.'" data-stage="'.$ad_submissionNotInterested_stage_id.'">'.$ad_submissionNotInterested.'</a><span class="tooltiptext">Applicants moved to Not Interested from Followup</span></span>
                </span>
                <span class="followUpApplicantsExtAssessment absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentExtension_status_id.'" data-stage="'.$ad_assessmentExtension_stage_id.'">'.$ad_assessmentExtension.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
                </span>
                <span class="OHDApplicantsAssessment absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentOnHold_status_id.'" data-stage="'.$ad_assessmentOnHold_stage_id_one.','.$ad_assessmentOnHold_stage_id_two.'">'.$ad_assessmentOnHold.'</a><span class="tooltiptext">Applicants currently On Hold</span> <span class="overdueApplicantsOnAssessmentOHD"></span></span>
                </span>
            </div><!-- assessmentArea -->
            
            <div class="discussionArea absolute">
                <span class="totalApplicantsOnAssessment absolute">
                    <span class="tooltipp"><a href="#" id="status_stage" data-toggle="modal" data-target="#myModal" data-status="'.$ad_discussionCFD_status_id.'" data-stage="'.$ad_discussionCFD_stage_id.'">'.$ad_discussionCFD.'</a><span class="tooltiptext">Applicants currently in Discussion</span></span>
                </span>
                <span class="totalApplicantsOnAssessmentOverAll absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_discussionPresence_status_id.'" data-stage="'.$ad_discussionPresence_stage_id.'">'.$ad_discussionPresence.'</a><span class="tooltiptext">Overall applicants moved to Discussion</span></span>
                </span>
                <span class="totalApplicantsOnAssessmentPresent absolute">
                    <span class="tooltipp"><a href="#" id="status_stage" data-toggle="modal" data-target="#myModal" data-status="'.$ad_discussionShowedup_status_id.'" data-stage="'.$ad_discussionShowedup_stage_id.'">'.$ad_discussionShowedup.'</a><span class="tooltiptext">Applicants showed up for Discussion</span></span>
                </span>
                <span class="followUpApplicants absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_discussionFollowup_status_id.'" data-stage="'.$ad_discussionFollowup_stage_id.'">'.$ad_discussionFollowup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span>
                </span>
                <span class="followUpApplicantsCurrent absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_discussionCurrentlyFollowup_status_id.'" data-stage="'.$ad_discussionCurrentlyFollowup_stage_id_one.'" >'.$ad_discussionCurrentlyFollowup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnFollowUp"></span></span>
                </span>
                <span class="followUpApplicantsNI absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_discussionNotIntrested.'</a><span class="tooltiptext">Applicants moved to Not Interested from Followup</span></span>
                </span>
                <span class="followUpApplicantsExtAssessment absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_assessmentExtension_status_id.'" data-stage="'.$ad_assessmentExtension_stage_id.'">'.$ad_assessmentExtension.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
                </span>
            </div><!-- discussionArea -->
            
            <div class="pricipalArea absolute">
                <span class="totalApplicantsOnPO absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOffer_status_id.'" data-stage="'.$ad_principleOffer_stage_id.'">'.$ad_principleOffer.'</a><span class="tooltiptext">Applicants currently in Principal Office Approval</span></span>
                </span>
                <span class="totalApplicantsOnPOOverAll absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOfferApprove_status_id.'" data-stage="'.$ad_principleOfferApprove_stage_id.'">'.$ad_principleOfferApprove.'</a><span class="tooltiptext">Overall applicants moved to Prinipal Office approval</span></span>
                </span>
                <span class="totalApplicantsOnWTLPO absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOfferWaitlist_status_id.'" data-stage="'.$ad_principleOfferWaitlist_stage_id.'">'.$ad_principleOfferWaitlist.'</a><span class="tooltiptext">Overall applicants moved to Waitlist</span></span>
                </span>
                <span class="ApplicantsOnWTLLeftPO absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOfferWaitlist_status_id.'" data-stage="'.$ad_principleOfferWaitlist_stage_id.'">'.$ad_principleOfferWaitlist.'</a><span class="tooltiptext">Applicants currently in Waitlist</span> <span class="overdueApplicantsOnWTL_PO"></span></span>
                </span>
                <span class="totalApplicantsFromWTLToRGT_PO absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOfferRegert_status_id.'" data-stage="'.$ad_principleOfferRegert_stage_id.'">'.$ad_principleOfferRegert.'</a><span class="tooltiptext">Overall applicants moved to Regret from Waitlist</span></span>
                </span>
                <span class="totalApplicantsFromPOToRGT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOfferRegert_status_id.'" data-stage="'.$ad_principleOfferRegert_stage_id.'">'.$ad_principleOfferRegert.'</a><span class="tooltiptext">Overall applicants moved to Regret from Pricipal Office approval</span></span>
                </span>
                <span class="totalApplicantsPassedFromWTL_PO absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal"></a><span class="tooltiptext">Overall applicants allocated from Waitlist</span></span>
                </span>
                <span class="OHDApplicantsPO absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_principleOfferOnHold_status_id.'" data-stage ="'.$ad_principleOfferOnHold_stage_id.'">'.$ad_principleOfferOnHold.'</a><span class="tooltiptext">Applicants currently On Hold</span> <span class="overdueApplicantsOnPOOHD"></span></span>
                </span>    
            </div><!-- pricipalArea -->
            
            <div class="offerArea absolute">
                <span class="totlaApplicantsPassedFromOffer absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage"  data-target="#myModal" data-status="'.$ad_offerPreperation_status_id.'" data-stage ="'.$ad_offerPreperation_stage_id.'">'.$ad_offerPreperation.'</a><span class="tooltiptext">Overall applicants moved to Offer Preparation</span></span>
                </span>
                <span class="totalApplicantsOnOffer absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_confirmOfferPreperation_status_id.'" data-stage="'.$ad_confirmOfferPreperation_stage_id.'">'.$ad_confirmOfferPreperation.'</a><span class="tooltiptext">Applicants currently in Offer Preparation</span> <span class="overdueApplicantsOnOffer"></span></span>
                </span>
                <span class="totlaApplicantsPassedFromOfferShow absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" data-status="'.$ad_offerLetterRecieved.'" data-stage ="'.$ad_offerLetterRecieved.'">'.$ad_offerLetterRecieved.'</a><span class="tooltiptext">Overall applicants showed up to Receive the Offer Letter</span></span>
                </span>
                <span class="offerShowupToFollowup absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_offerFollowup_status_id.'" data-stage ="'.$ad_offerFollowup_stage_id.'">'.$ad_offerLetterFollowup.'</a><span class="tooltiptext">Overall applicants moved to Followup</span></span> 
                </span>
                <span class="totalApplicantsOnOfferFollowUp absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal" id="status_stage" data-status="'.$ad_offerFollowup_status_id.'" data-stage ="'.$ad_offerFollowup_stage_id.'">'.$ad_offerLetterFollowup.'</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnOfferShow"></span></span>
                </span>
                <span class="totlaApplicantsPassedFromFollowupToNIT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_offerLetterNotIntrested.'</a><span class="tooltiptext">Overall applicants moved to Not Interedted from Followup</span></span>
                </span>
                <span class="totlaApplicantsPassedFromFollowupToEXT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_offerLetterExtension.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
                </span>
                <span class="bankShowupToFollowup absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_offerLetterDueDate.'</a><span class="tooltiptext">Overall applicants moved to Followup from Fee bill due date</span></span> 
                </span>
                <span class="totalApplicantsOnBankFollowUp absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">-</a><span class="tooltiptext">Applicants currently in Followup</span> <span class="overdueApplicantsOnOfferShow"></span></span>
                </span>
                <span class="totlaApplicantsPassedFromBankToNIT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_offerLetterNotIntrested.'</a><span class="tooltiptext">Overall applicants moved to Not Intersted from Followup</span></span>
                </span>
                <span class="totlaApplicantsPassedFromBankToEXT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" data-target="#myModal">'.$ad_offerLetterDueDateExtension.'</a><span class="tooltiptext">Overall applicants requested for Extension</span></span>
                </span>
            </div><!-- offerArea -->
         
            <div class="finalArea absolute">
                <span class="finalRGT absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-stage="'.$ad_applicantRegert_stage_id.'">'.$ad_applicantRegert.'</a><span class="tooltiptext">List of Applicants in Regret</span></span>
                </span>
                <span class="finalADMCOM absolute">
                    <span class="tooltipp"><a href="#" data-toggle="modal" id="status_stage" data-target="#myModal" data-status="'.$ad_applicantAdmissionCompelete_status_id.'" data-stage = "'.$ad_applicantAdmissionCompelete_stage_id.'">'.$ad_applicantAdmissionCompelete.'</a><span class="tooltiptext">List of Applicants with Confirm Admissions</span></span>
                </span>
                <span class="finalNIT absolute">
                    <span class="tooltipp"><a href="#" id="status_stage" data-toggle="modal" data-target="#myModal" data-status="'.$ad_applicantNotIntrested_status_id.'" data-stage="'.$ad_applicantNotIntrested_stage_id.'">'.$ad_applicantNotIntrested.'</a><span class="tooltiptext">List of Applicants Not Interested</span></span>
                </span>
            </div><!-- finalArea -->';

        echo $html;
    }   




























    public function edit2(){
        $html = '';


        $this->load->model('gs_admission/process_flows/process_flow_model');        
        $gradeID = $this->input->post('gradeID');
        $gradeIDs = explode(",", $gradeID);
        $data['batch'] = $this->process_flow_model->getBatch($gradeIDs);



        if($gradeIDs[0] == 'All' || $gradeID ==''){

        }else{
            if($gradeID == ''){
                $html = '';
            }else{
                $html .= '
                <select required="" class="BiGSelectBox">
                  <option value="" disabled="" selected="">Select Batch</option>';
                foreach ($data['batch'] as $batch) {
                    $html .= '<option value="'.$batch['id'].'">'.$batch['batch_category'].'</option>';
                }

                $html .= '</select>';
            }
        }
        


        echo $html;
    }

    public function modal_load(){
        $StatusID = $this->input->post('status_id');
        $StageID = $this->input->post('stage_id');
        $GradeID = $this->input->post('gradeID');
        
        
        $this->load->model('gs_admission/process_flows/process_flow_model');
        $data['admission'] = $this->process_flow_model->getAdmissionList($StatusID, $StageID, $GradeID);


        $html = '';
        $html .='<div class="modal-header">';
        $html .='<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>';
        $html .='<h4 class="modal-title">Applicant Details - <strong>Admission Initiation</strong> <span class="pull-right"></span></h4>';
        $html .='</div>';
        $html .= ' <div class="modal-body">';
        $html .='<p>';
        $html .= '<div class="col-md-8" id="change" >';
        $html .= '<table id="AllApplicantListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" style="margin: 1% 1%;width: 98%;" >';
        $html .='<thead>';
        $html .='<tr>';
        $html .='<th class="valignMiddle">Form #<br /><small>Batch ID</small></th>';
        $html .='<th class="valignMiddle">Applicants Name<br /><small>Father Name - Mobile No.</small></th>';
        $html .='<th class="valignMiddle">Grade</th>';
        //$html .='<th class="valignMiddle">Next Process date</th>';
        $html .='<th class="text-center" >Action</th>';
        $html .='</tr>';
        $html .='</thead>';
        $html .='<tbody>';


        if(!empty($data['admission'])){
            foreach ($data['admission'] as $adm) {
                $html .='<tr>';
                $html .='<td><strong>'.$adm['form_no'].'</strong><br /><small>'.$adm['batch_id'].'</small></td>';
                $html .='<td>'.$adm['official_name'].'<br /><small>'.$adm['father_name'].' - '.$adm['father_mobile'].'</small></td>';
                $html .='<td class="valignMiddle"><strong>'.$adm['grade_name'].'</strong></td>';
                //$html .='<td class="valignMiddle">02-December-2016 </td>';
                $html .='<td class="text-center"><a href="#" class="timeline" id="timeline" data-formid="'.$adm['form_id'].'">View timeline</a></td>';
                $html .='</tr>';            
            }
        }
        
        $html .= '</tbody>';
        $html .= '</table>';
        $html .= '</div>';
        $html .= '<div class="modalTimeline"></div>';
        $html .= '</p>';
        $html .='</div>';

        $html .= '<script>
            $("#AllApplicantListing").dataTable();
        </script>';

        echo $html;


        }











        public function modal_timeline(){
        $FormID = $this->input->post('FormID');

        $this->load->model('admission/admission_batch_model');
        $comments_log = $this->admission_batch_model->sp_form_complete_log($FormID);

        $html = '';
        $html .= '<div class="col-md-4" class="timeline" style="display:">';
        $html .='<div class="MaroonBorderBox">';
        $html .='<h3>Applicant Details</h3>';
        $html .='<div class="inner" style="padding-bottom:0;">';
        $html .= '<div class="col-md-12">';
        $html .= '<div class="TimelineReview">';
        $html .= '<ul>';

        foreach($comments_log as $log){
            if($log->type == 'Issuance' || $log->type == 'Stage' || $log->type == 'Status'){
                $html .= '<li class="adminResponse">';
                $html .= '<p>'.$log->message.'</p>';
                $html .= '</li>';
            }
            else{


                $html .= '<li class="in">';
                $html .= '<div class="avatarLeft col-md-2">';
                $html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
                $html .= '</div>'; //<!-- avatarLeft -->
                $html .= '<div class="systemResponse col-md-10">';
                $html .= '<span class="arrowHeadLeft">&nbsp;</span>';
                $html .= '<p><strong>'.$log->reason.'</strong><br /><small>'.$log->message.'</small></p>';
                $html .= '<span class="commentDate">'.$log->dt.'</span>'; // <!-- commentDate -->

                $html .= '</div>'; //<!-- systemResponse -->
                //$html .= '<img src="'.base_url('assets/photos/hcm/150x150/staff/'.$log->photo_id.'.png') .'"/>';
                $html .= '</li>'; //<!-- in -->
            }
        }
        
        $html .= '</ul>';
        $html .= '</div><!-- Timeline -->';
        $html .= '</div><!-- col-md-9 -->';
        $html .= '</div><!-- inner -->';
        $html .= '</div><!-- .MaroonBorderBox -->';
        $html .= '</div><!-- col-md-12 -->';
        $html .= '</div><!-- modal-body -->';



        /*
        $html = '';
        $html .= '<div class="col-md-4" class="timeline" style="display:">';
        $html .='<div class="MaroonBorderBox">';
        $html .='<h3>Applicant Details</h3>';
        $html .='<div class="inner" style="padding-bottom:0;">';
        $html .='<div class="TimelineReview" style="height:650px;">';
        $html .= '<ul>';
        $html .='<li class="adminResponse">';
        $html .='<p>Admission form issued on 25-November-2016</p>';
        $html .='</li><!-- adminResponse -->';
        $html .='<li class="adminResponse">';
        $html .='<p>Submission date has been expired on 30-November-2016</p>';
        $html .='</li><!-- adminResponse -->';
        $html .='<li class="in">';
        $html .='<div class="avatarLeft col-md-2">';
        $html .='<img src="'.base_url().'components/gs_theme/images/991.jpg" />';
        $html .='</div><!-- avatarLeft -->';
        $html .='<div class="systemResponse col-md-10">';
        $html .='<span class="arrowHeadLeft">&nbsp;</span>';
        $html .='<p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>';
        $html .='<span class="commentDate">30-Nov-2016</span><!-- commentDate -->';
        $html .='</div><!-- systemResponse -->';
        $html .='</li><!-- in -->';
        $html .= '</ul>';
        $html .= '</div><!-- Timeline -->';
        $html .= '</div><!-- inner -->';
        $html .='</div><!-- .MaroonBorderBox -->';
        $html .='</div><!-- col-md-4 -->';
        */
       




        echo $html;

    }
}