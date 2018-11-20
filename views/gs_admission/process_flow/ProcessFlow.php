<?php
        $html = '';
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

        $ad_applicantNotIntrested_status_id = 5;
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

            if($ad['form_status_id'] == $ad_applicantNotIntrested_status_id && ($ad['form_status_stage_id'] == $ad_applicantNotIntrested_stage_id )){
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
?>


<div class="container">
	<!-- One Column Layout START -->
    <div class="row">
    	<div class="col-md-12">
            <h3 class="withBorderBottom" style="">Admission Process Flowchart</h3>
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <div class="row">
    	<div class="col-md-12">
        	<div class="col-md-3">
            	<dl class="dropdown">
                            <dt>
                            	<a href="#"><span class="hida">Select</span> <p class="multiSel" style="display:;"></p></a>
                            </dt><!-- dt -->
                            <dd>
                                <div class="mutliSelect">
                                    <ul>
                                        <li><input type="checkbox" value="All" name="All" id="All"/><label for="All">All Grades</label></li>
                                        <li><input type="checkbox" value="PN" name="PN" id="PN" /><label for="PN">PN</label></li>
                                        <li><input type="checkbox" value="N" id="N" name="PN" /><label for="N">N</label></li>
                                        <li><input type="checkbox" value="KG" name="KG" id="KG" /><label for="KG">KG</label></li>
                                        <li><input type="checkbox" value="I" name="I" id="I" /><label for="I">I</label></li>
                                        <li><input type="checkbox" value="II" name="II" id="II" /><label for="II">II</label></li>
                                        <li><input type="checkbox" value="III" name="III" id="III" /><label for="III">III</label></li>
                                        <li><input type="checkbox" value="IV" name="IV" id="IV" /><label for="IV">IV</label></li>
                                        <li><input type="checkbox" value="V" name="V" id="V" /><label for="v">V</label></li>
                                        <li><input type="checkbox" value="VI" name="VI" id="VI" /><label for="VI">VI</label></li>
                                        <li><input type="checkbox" value="VII" name="VII" id="VII" /><label for="VII">VII</label></li>
                                        <li><input type="checkbox" value="VIII" name="VIII" id="VIII" /><label for="VIII">VIII</label></li>
                                        <li><input type="checkbox" value="IX" name="IX" id="IX" /><label for="IX">IX</label></li>
                                        <li><input type="checkbox" value="X" name="X" id="X" /><label for="X">X</label></li>
                                    </ul><!-- ul -->
                                </div><!-- multiselect -->
                            </dd><!-- dd -->                          
                        </dl><!-- dl -->
                
            </div><!-- col-md-3 -->
            <div class="col-md-3" id="BiGSelectBox">
            	<select required="" class="BiGSelectBox">
                  <option value="" disabled="" selected="">Select Batch</option>
                </select>
            </div><!-- col-md-3 -->
            <div class="col-md-3">
            	<dl class="dropdownG">
                    <dt>
                        <a href="#"><span class="hidaG">Select Gender</span> <p class="multiSelG" style="display:;"></p></a>
                    </dt><!-- dt -->
                    <dd>
                        <div class="mutliSelectG">
                            <ul>
                                <li><input type="checkbox" value="AllG" name="AllG" id="AllG"/><label for="AllG">All</label></li>
                                <li><input type="checkbox" value="BOY" name="BOY" id="BOY" /><label for="BOY">Boy</label></li>
                                <li><input type="checkbox" value="GIRL" id="GIRL" name="GIRL" /><label for="GIRL">Girl</label></li>
                            </ul><!-- ul -->
                        </div><!-- multiselect -->
                    </dd><!-- dd -->                          
                </dl><!-- dl -->
            </div><!-- col-md-3 -->
            <div class="col-md-3">
            	<input type="submit" id="btn_apply_filters" class="greenBTN" value="Apply Filters" style="padding:10px;">
            </div><!-- col-md-3 -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <div class="fixedWidthScroll">
        <img src="<?php echo base_url() ?>components/gs_theme/images/ProcessFlowchart_05.jpg" width="3000" />
        <div id="ProcessFlowChart">
            
            <?php echo $html; ?>
            
            
        </div><!-- fixedWidthScroll -->
    </div>





    <!-- One Column Layout END -->
    <div class="modal fade in TimeLineModal" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
          <div class="processflow"></div>
            
          </div><!-- modal-content -->
          
        </div><!-- modal-dialog -->
    </div><!-- modal -->
</div><!-- container -->




<script src="<?=base_url();?>components/gs_theme/js/custom.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script>
$('#All').click(function (e) {
    $(this).closest('.mutliSelect').find('li input:checkbox').prop('checked', this.checked);
});

$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdown")) $(".dropdown dd ul").hide();
});

$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
    $(".hida").hide();

    /***************************************************/
    // Ajax here for refreshing Batch of selected Grade
    /***************************************************/
    var selectedGrades = $('.multiSel').text();
    $.ajax({
        type:"POST",
        cache:false,
        data:{gradeID:selectedGrades},
        url:"<?php echo base_url(); ?>index.php/gs_admission/admission_process_flow/edit2",
        success:function(e){
            $('#BiGSelectBox').html(e);
        }
    });
    /***************************************************/

  } 
  else {	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hida");
	$(".hida").hide();
	$('.dropdown dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  $(".hida").html('');
          $('#BiGSelectBox').html('');
		  $(".hida").show();
	  }
  } 
});
/* FOr Gender Filter */
$('#AllG').click(function (e) {
    $(this).closest('.mutliSelectG').find('li input:checkbox').prop('checked', this.checked);
});

$(".dropdownG dt a").on('click', function() {
  $(".dropdownG dd ul").slideToggle('fast');
});

$(".dropdownG dd ul li a").on('click', function() {
  $(".dropdownG dd ul").hide();
});

function getSelectedValue(id) {
  return $("#" + id).find("dt a span.value").html();
}

$(document).bind('click', function(e) {
  var $clicked = $(e.target);
  if (!$clicked.parents().hasClass("dropdownG")) $(".dropdownG dd ul").hide();
});

$('.mutliSelectG input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelectG').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSelG').append(html);
    $(".hidaG").hide();
  } 
  else {	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hidaG");
	$(".hidaG").hide();
	$('.dropdownG dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  $(".hidaG").html('');
		  $(".hidaG").show();
	  }
  } 
});

</script>













<script>
$(document).on("click", "#btn_apply_filters", function(){
    var selectedGrades = $('.multiSel').text();
    var selectedGender = $('.multiSelG').text();
    var selectedBatch = $('.BiGSelectBox option:selected').val();
    $('#ProcessFlowChart').html('');
    $.ajax({
        type:"POST",
        cache:false,
        data:{gradeID:selectedGrades, batch:selectedBatch, gender:selectedGender},
        url:"<?php echo base_url(); ?>index.php/gs_admission/admission_process_flow/edit",
        success:function(e){
            $('#ProcessFlowChart').html(e);
        }
    });
});

$(document).on('click','#status_stage',function(){
    var selectedGrades = $('.multiSel').text();
    var status ;
    var stage ;
    status =  $(this).attr('data-status');
    stage = $(this).attr('data-stage');
    $('.processflow').html('');
    $.ajax({
        type:"POST",
        cache:false,
        data:{status_id:status,stage_id:stage,gradeID:selectedGrades},
        url:"<?php echo base_url() ?>index.php/gs_admission/admission_process_flow/modal_load",
        success:function(e){
            $('.processflow').html(e);
        }
    });
});

$(document).on('click','.timeline',function(){
    var selectedGrades = $('.multiSel').text();
    var FormID = $(this).attr("data-formid");
    //$('#change').toggleClass('col-md-12 col-md-8');
     $('.modalTimeline').html('');
    $.ajax({
        type:"POST",
        cache:false,
        data:{FormID:FormID, gradeID:selectedGrades},
        url:"<?php echo base_url() ?>index.php/gs_admission/admission_process_flow/modal_timeline",
        success:function(e){
            $('.modalTimeline').html(e);
        }
    });
});
</script>