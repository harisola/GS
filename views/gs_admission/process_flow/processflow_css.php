<style>
@charset "utf-8";
/* CSS Document */

.fixedWidthScroll {
    overflow-x:scroll;  
    overflow-y:hide;
    position:relative;
    margin-top:60px;
}
.absolute {
    position:absolute;  
}
.totalApplicantsOnSubmission, .totalApplicantsOnSubmission a,
.totalApplicantsOnTBI, .totalApplicantsOnTBI a,
.totalApplicantsOnTBIAllocated a,
.followUpApplicants a,
.followUpApplicantsNI a,
.followUpApplicantsExt a,
.totalApplicantsOnWTLAssessment a,
.totalApplicantsPassedFromWTL a,
.followUpApplicantsExtAssessment a,
.totalApplicantsOnAssessmentOverAll a,
.totalApplicantsFromAssessmentToRGT a,
.totalApplicantsFromWTLToRGT a,
.totalApplicantsOnPOOverAll a,
.totalApplicantsOnWTLPO a,
.totalApplicantsFromWTLToRGT_PO a,
.totalApplicantsFromPOToRGT a,
.totlaApplicantsPassedFromOffer a,
.totlaApplicantsPassedFromOfferShow a,
.offerShowupToFollowup a,
.totlaApplicantsPassedFromFollowupToNIT a,
.totlaApplicantsPassedFromFollowupToEXT a,
.bankShowupToFollowup a,
.totlaApplicantsPassedFromBankToNIT a,
.totlaApplicantsPassedFromBankToEXT a,
.totalApplicantsPassedFromWTL_PO a {
    color:#888; 
    font-weight:bold;
    font-style:italic;
}
.totalApplicants a:hover,
.totalApplicantsOnTBI a:hover,
.totalApplicantsOnSubmission a:hover,
.totalApplicantsOnTBIAllocated a:hover,
.followUpApplicants a:hover,
.followUpApplicantsNI a:hover,
.followUpApplicantsExt a:hover
.totalApplicantsOnWTLAssessment a:hover,
.totalApplicantsPassedFromWTL a:hover,
.followUpApplicantsExtAssessment a:hover,
.totalApplicantsOnAssessmentOverAll a:hover,
.totalApplicantsFromAssessmentToRGT a:hover,
.totalApplicantsFromWTLToRGT a:hover,
.totalApplicantsOnPOOverAll a:hover,
.totalApplicantsOnWTLPO a:hover,
.totalApplicantsFromWTLToRGT_PO a:hover,
.totalApplicantsFromPOToRGT a:hover,
.totlaApplicantsPassedFromOffer a:hover
.totlaApplicantsPassedFromOfferShow a:hover,
.offerShowupToFollowup a:hover,
.totlaApplicantsPassedFromFollowupToNIT a:hover,
.totlaApplicantsPassedFromFollowupToEXT a:hover,
.bankShowupToFollowup a:hover,
.totlaApplicantsPassedFromBankToNIT a:hover,
.totlaApplicantsPassedFromBankToEXT a:hover,
.totalApplicantsPassedFromWTL_PO a:hover {
    text-decoration:none;
    border-bottom:1px solid #888;   
}

.issuanceArea {
    left: 260px;
    top: 340px;
}
.totalApplicants, .totalApplicants a {
    color:#888; 
    font-weight:bold;
    font-style:italic;
}
.totalApplicants a:hover {
    text-decoration:none;
    border-bottom:1px solid #888;   
}
.submissionArea {
    left: 500px;
    top: 155px;
    width: 360px;
    height: 510px;
}
.totalApplicantsOnSubmission {
    left: 90px;
    top: 185px; 
}
.totalApplicantsOnTBI {
        left: 158px;
    top: 26px;
}
.ApplicantsOnIssuanceToSubmission {
    left: -40px;
    top: 185px;
}
.ApplicantsOnTBILeft {
    left: 280px;
    top: -25px;
}
.ApplicantsOnTBILeft a, 
.ApplicantsOnIssuanceToSubmission a {
    font-size:16px;
    font-weight:bold;
}
.ApplicantsOnTBILeft .overdueApplicantsOnTBI,
.ApplicantsOnIssuanceToSubmission .overdueApplicantsOnTBI {
    color:red;
}
.totalApplicantsOnTBIAllocated {
    left: 240px;
    top: 120px;
}
.followUpApplicants {
        left: 85px;
    top: 310px;
}
.followUpApplicantsCurrent {
    left: 100px;
    top: 423px;
}
.EXTUpApplicantsCurrent {
        left: -160px;
    top: 396px;
}
.AssEXTApplicantsCurrent {
    left: -180px;
    top: 396px;
}
.DISCEXTApplicantsCurrent {
    left: -180px;
    top: 396px;
}
.followUpApplicantsCurrent a,
.EXTUpApplicantsCurrent a,
.AssEXTApplicantsCurrent a,
.DISCEXTApplicantsCurrent a {
    font-size:18px; 
}
.followUpApplicantsCurrent .overdueApplicantsOnFollowUp
.EXTUpApplicantsCurrent .overdueApplicantsOnFollowUp {
    color:red;
}
.followUpApplicantsNI {
    left: 85px;
    top: 480px; 
}
.followUpApplicantsExt {
    left: -80px;
    top: 400px; 
}

.assessmentArea {
    left: 850px;
    top: 155px;
    width: 360px;
    height: 510px;
}
.totalApplicantsOnAssessment {
        left: 0;
    top: 190px;
    font-weight: bold;
    font-size: 16px;    
}
.totalApplicantsOnAssessmentOverAll {
        left: 73px;
    top: 191px;
}
.totalApplicantsOnAssessmentPresent {
        left: 120px;
    top: 170px;
    font-weight: bold;
    font-size: 16px;
}
.totalApplicantsOnWTLAssessment {
    left: 180px;
    top: 25px;
}
.ApplicantsOnWTLLeftAssessment {
    left: 318px;
    top: -25px;
}
.ApplicantsOnWTLLeftAssessment a,
.OHDApplicantsAssessment a,
.totalApplicantsOnPO a,
.ApplicantsOnWTLLeftPO a,
.OHDApplicantsPO a,
.totalApplicantsPassedFromWTL_PO a,
.totalApplicantsOnOffer a,
.totalApplicantsOnOfferFollowUp a,
.totalApplicantsOnBankFollowUp a,
.totalApplicantsInOffered a { 
    font-size: 16px;
    font-weight:bold;
}
.ApplicantsOnWTLLeftAssessment .overdueApplicantsOnWTLAssessment,
.OHDApplicantsAssessment .overdueApplicantsOnAssessmentOHD,
.ApplicantsOnWTLLeftPO .overdueApplicantsOnWTL_PO,
.OHDApplicantsPO .overdueApplicantsOnPOOHD,
.totalApplicantsOnOffer .overdueApplicantsOnOffer,
.totalApplicantsOnOfferFollowUp .overdueApplicantsOnOfferShow,
.totalApplicantsOnBankFollowUp .overdueApplicantsOnOfferShow {
    color:red;  
}
.totalApplicantsPassedFromWTL {
    left: 280px;
    top: 120px;
}
.followUpApplicantsExtAssessment {
    left: -101px;
    top: 400px; 
}
.totalApplicantsFromAssessmentToRGT {
    left: 180px;
    top: -50px;
}
.totalApplicantsFromWTLToRGT {
    left: 280px;
    top: -50px;
}
.OHDApplicantsAssessment {
    left: 185px;
    top: 320px;
}
.discussionArea {
    left: 1239px;
    top: 155px;
    width: 360px;
    height: 510px;
}
.finalArea {
    left: 2599px;
    top: 0px;
    width: 300px;
    height: 700px;
}
.finalNITPAApproval {
    left: 55px;
    top: 610px;
    font-size: 20px;
    font-weight: bold;
}
.finalRGTPAApproval {
        left: 75px;
    font-size: 20px;
    font-weight: bold;
    top: 80px;
}
.offerArea {
     left: 1859px;
    top: 155px;
    width: 730px;
    height: 510px;
}
.pricipalArea {
    left: 1539px;
    top: 155px;
    width: 360px;
    height: 510px;
    
}
.totalApplicantsOnPO {
    left: 30px;
    top: 200px;
}
.totalApplicantsOnPOOverAll {
    left: 80px;
    top: 180px;
}
.totalApplicantsOnWTLPO {
    left: 127px;
    top: 30px;
}
.ApplicantsOnWTLLeftPO {
    left: 270px;
    top: -30px;
}
.totalApplicantsFromWTLToRGT_PO {
    left: 255px;
    top: -86px;
}
.totalApplicantsFromPOToRGT {
    top: -86px;
    left: 130px;
}
.OHDApplicantsPO {
    left: 160px;
    top: 300px;
}
.totalApplicantsPassedFromWTL_PO {
    left: 260px;
    top: 103px;
}
.totalApplicantsOnOffer {
    left: 80px;
    top: 180px;
}
.totlaApplicantsPassedFromOffer {
    left: 10px;
    top: 184px;
}
.totlaApplicantsPassedFromOfferShow {
    left: 330px;
    top: 184px;
}
.totalApplicantsInOffered {
        left: 452px;
    top: 180px; 
}
.offerShowupToFollowup {
    left: 330px;
    top: 320px;
}
.totalApplicantsOnOfferFollowUp {
    left: 340px;
    top: 425px;
}
.totlaApplicantsPassedFromFollowupToNIT {
    left: 330px;
    top: 490px;
}
.totlaApplicantsPassedFromFollowupToEXT {
    left: 240px;
    top: 400px;
}


.bankShowupToFollowup {
    left: 670px;
    top: 320px;
}
.totalApplicantsOnBankFollowUp {
    left: 680px;
    top: 425px;
}
.totlaApplicantsPassedFromBankToNIT {
    left: 670px;
    top: 490px;
}
.totlaApplicantsPassedFromBankToEXT {
    left: 580px;
    top: 400px;
}
.finalRGT {
    left: 240px;
    font-size: 20px;
    font-weight: bold;
}   
.finalADMCOM {
    left: 240px;
    top:320px;
    font-size: 20px;
    font-weight: bold;
}
.finalNIT {
    left: 240px;
    top:610px;
    font-size: 20px;
    font-weight: bold;
}
.tooltipp .tooltiptext {
    margin-left:-83px !important;   
}
.tooltipp {
    position: relative;
    display: inline-block;
}
.tooltipp .tooltiptext {
    visibility: hidden;
    width: 170px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 1s;
    font-style:normal;
    font-size:14px;
}
.tooltipp .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}
.tooltipp:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
/* */
.dropdown dd,
.dropdown dt {
  margin: 0px;
  padding: 0px;
}
#BatchListing td .boys {
    background:#c9f0f9;
    padding:5px 0;
}
#BatchListing td .girls {
    background:#ffe1ec  ;
    padding:5px 0;
}
#BatchListing td {
    vertical-align: middle !important;
    padding: 0;
}
.dropdown ul,
.dropdownG ul {
  margin: -1px 0 0 0;
}

.dropdown dd,
.dropdownG dd {
  position: relative;
}

.dropdown a,
.dropdown a:visited,
.dropdownG a,
.dropdownG a:visited {
  color: #888;
  text-decoration: none;
  outline: none;
  font-size: 18px;
}

.dropdown dt a,
.dropdownG dt a {
      background-color: #ffffff;
    display: block;
    padding:18px 20px 18px 10px !important;
    min-height: 18px;
    line-height: 9px;
    overflow: hidden;
    border: 1px solid #a9a9a9;
    font-weight: normal;
}

.dropdown dt a span,
.multiSel span,
.dropdownG dt a span,
.multiSelG span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.dropdown dd ul,
.dropdownG dd ul {
    background-color: #fff;
    border: 1px solid #a9a9a9;
    color: #000;
    display: none;
    left: 0px;
    padding: 2px 15px 2px 5px;
    position: absolute;
    top: 0px;
    width: 100%;
    list-style: none;
    height: 120px;
    overflow: auto;
    z-index:9999;
}

.dropdown span.value,
.dropdownG span.value {
  display: none;
}

.dropdown dd ul li a,
.dropdownG dd ul li a {
  padding: 5px;
  display: block;
}

.dropdown dd ul li a:hover,
.dropdownG dd ul li a:hover {
  background-color: #fff;
}
.multiSel,
.multiSelG {
    margin:0 !important;    
}
</style>