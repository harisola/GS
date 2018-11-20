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
.followUpApplicantsforEAOProcedureExtOverall a,
.followUpApplicantsforEAOPrepExtOverall a,
.totalApplicantsOnSubmission, 
.totalApplicantsOnSubmission a,
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
.totlaApplicantsPassedFromFAOProcedureToChecklist a,
.offerShowupToFollowup a,
.totlaApplicantsPassedFromFollowupToNIT a,
.totlaApplicantsPassedFromFollowupToEXT a,
.bankShowupToFollowup a,
.totlaApplicantsPassedFromBankToNIT a,
.totlaApplicantsPassedFromBankToEXT a,
.totalApplicantsPassedFromWTL_PO a,
.totalApplicantsOnALEVELRAO a,
.totalApplicantsOnALEVELEAO a {
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
.totlaApplicantsPassedFromFAOProcedureToChecklist a:hover,
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
    left: 250px;
    top: 280px;
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
    left: 360px;
    top: 155px;
    width: 360px;
    height: 510px;
}
.totalApplicantsOnSubmission {
    left: 120px;
    top: 125px; 
}
.totalApplicantsOnTBI {
        left: 178px;
    top: 16px;
}
.ApplicantsOnIssuanceToSubmission {
    left: -10px;
    top: 125px;
}
.ApplicantsOnTBILeft {
    left: 220px;
    top: -45px;
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
    left: 250px;
    top: 80px;
}
.submissionArea .followUpApplicants {
        left: 115px;
    top: 310px;
}
.EAOOfferArea .followUpApplicantsforEAOProcedure  {
        left: 605px;
    top: 415px;
}
.EAOOfferArea .followUpApplicantsforEAOProcedureExt  {
	left: 490px;
    top: 405px;
}
.EAOOfferArea .followUpApplicantsforEAOProcedureExtOverall  {
	left: 520px;
    top: 425px;
}
.EAOOfferArea .followUpApplicantsforEAOProcedureRGT  {
	    left: 598px;
    top: 456px;
}

.EAOOfferArea .followUpApplicantsCurrentEAOProcedure  {
     left: 375px;
    top: 412px;
}
.EAOOfferArea .followUpApplicantsCurrentEAOProcedureExtension  {
        left: 225px;
    top: 392px;
}
.EAOOfferArea .followUpApplicantsNIfromEAOFollowupProcedure {
        left: 365px;
    top: 455px;
}
.EAOOfferArea .followUpApplicantsExtEAOProcedure {
        left: 285px;
    top: 395px;
}

/* */


.EAOOfferArea .followUpApplicantsforEAOBankPayment  {
        left: 595px;
    top: 374px;
}
.EAOOfferArea .followUpApplicantsCurrentEAOBankPayment  {
     left: 615px;
    top: 412px;
}
.EAOOfferArea .followUpApplicantsCurrentEAOBankPaymentExtension  {
        left: 465px;
    top: 392px;
}
.EAOOfferArea .followUpApplicantsNIfromEAOFollowupBankPayment {
        left: 605px;
    top: 455px;
}
.EAOOfferArea .followUpApplicantsExtEAOBankPayment {
        left: 525px;
    top: 395px;
}


/* */
.assessmentArea .followUpApplicants {
        left: 35px;
    top: 310px;
}
.discussionArea .followUpApplicants {
        left: 35px;
    top: 310px;
}
.followUpApplicants {
        left: 85px;
    top: 310px;
}
.assessmentArea .followUpApplicantsCurrent {
    left: 50px;
    top: 412px;
}
.followUpApplicantsCurrent {
    left: 100px;
    top: 423px;
}
.EXTUpApplicantsCurrent {
    left: -100px;
    top: 356px;
}
.AssEXTApplicantsCurrent {
    left: -170px;
    top: 356px;
}
.discussionArea .followUpApplicantsNI {
    left: 40px;
    top: 670px;
}
.discussionArea .ApplicantsOnWTLLeftAssessment {
    left: 268px;
    top: -10px;
}
.DISCEXTApplicantsCurrent {
    left: -180px;
    top: 356px;
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
    left: 115px;
    top: 670px; 
}
.assessmentArea .followUpApplicantsNI {
    left: 40px;
    top: 670px;
}
.followUpApplicantsExt {
    left: -20px;
    top: 400px; 
}
.submissionArea .followUpApplicantsCurrent {
    left: 120px;
    top: 412px;
}
.discussionArea .followUpApplicantsCurrent {
    left: 55px;
    top: 410px;
}
.assessmentArea {
    left: 720px;
    top: 155px;
    width: 313px;
    height: 510px;
}
.totalApplicantsOnAssessment {
    left: -60px;
    top: 125px;
    font-weight: bold;
    font-size: 16px;    
}
.totalApplicantsOnAssessmentOverAll {
    left: 13px;
    top: 128px;
}
.totalApplicantsOnAssessmentPresent {
    left: 70px;
    top: 126px;
    font-weight: bold;
    font-size: 16px;
}
.totalApplicantsOnWTLAssessment {
    left: 115px;
    top: 15px;
}
.ApplicantsOnWTLLeftAssessment {
        left: 248px;
    top: -10px;
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
.totalApplicantsInOffered a,
.totalApplicantsInOfferedCompleteCheck a { 
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
    left: 195px;
    top: 70px;
}
.followUpApplicantsExtAssessment {
    left: -110px;
    top: 400px; 
}
.totalApplicantsFromAssessmentToRGT {
    left: 115px;
    top: -50px;
}
.totalApplicantsFromWTLToRGT {
    left: 195px;
    top: -50px;
}
.OHDApplicantsAssessment {
    left: 120px;
    top: 240px;
}
.discussionArea {
    left: 1033px;
    top: 155px;
    width: 225px;
    height: 510px;
}
/* EAO CSS */
.EAOOfferArea {
    left: 1257px;
    top: 155px;
    width: 855px;
    height: 510px;
}
.EAOOfferArea .totalApplicantsOnPEJMORAO {
    top: 130px;
    right: 30px;
    font-weight: bold;
    font-size: 14px;
}
.EAOOfferArea .totalApplicantsOnALEVELRAO {
    top: 220px;
    left: 100px;
    font-weight: bold;
    font-size: 14px;
}
.EAOOfferArea .totalApplicantsOnALEVELEAO {
    top: 310px;
    left: 100px;
    font-weight: bold;
    font-size: 14px;
}
.EAOOfferArea .totalApplicantsOnALEVELRAOAwaiting {
        top: 260px;
    left: 633px;
    font-weight: bold;
    font-size: 14px;
}
.EAOOfferArea .totalApplicantsOnALEVELEAOAwaiting {
    top: 310px;
    left: 633px;
    font-weight: bold;
    font-size: 14px;
}
.EAOOfferArea .totalApplicantsOnALEVELEAOProc {
    top: 290px;
    left: 410px;
    font-weight: bold;
    font-size: 14px;
}
.followUpApplicantsforEAOPrep {
	left: 370px;
    top: 415px;
}
.followUpApplicantsforEAOPrepExt {
	left: 250px;
    top: 385px;
}
.followUpApplicantsforEAOPrepExtOverall {
	left: 280px;
    top: 425px;
}
.followUpApplicantsforEAOPrepRGT {
	    left: 360px;
    top: 450px;
}
.totalApplicantsOnALEVELEAOPrep {
	top: 290px;
    left: 200px;
    font-weight: bold;
    font-size: 14px;	
}
.totalApplicantsOnALEVELEAOmovedFromPrepToProc {
	top: 304px;
    left: 360px;
    font-size: 14px;
}
.totalApplicantsOnALEVELRAOPRV {
        top: 320px;
    left: 780px;
    font-weight: bold;
    font-size: 14px;	
}
.totalApplicantsOnALEVELRAOPRVOverallToOffer {
	top: 270px;
    left: 920px;
}
.totalApplicantsOnALEVELRAOPRV-Regret {
	    top: -40px;
    left: 800px;
}
.totalApplicantsOnALEVELRAOPRV-Regret a,
.totalApplicantsOnALEVELRAOPRVOverallToOffer a,
.totalApplicantsOnALEVELRAOAwaiting a,
.totalApplicantsOnALEVELEAOAwaiting a,
.followUpApplicantsforEAOProcedureRGT a,
.followUpApplicantsforEAOPrepRGT a,
.EAOOfferArea .overallApplicantsOnPEJMORAO a,
.EAOOfferArea .overallApplicantsOnALEVELRAO a,
.EAOOfferArea .overallApplicantsOnALEVELEAO a,
.EAOOfferArea .overallApplicantsOnALEVELEAOProcedure a,
.EAOOfferArea .overallApplicantsOnALEVELWAOAwaitingResults a,
.EAOOfferArea .followUpApplicantsNIfromEAOFollowupProcedure  a,
.EAOOfferArea .followUpApplicantsforEAOBankPayment a,
.EAOOfferArea .followUpApplicantsNIfromEAOFollowupBankPayment  a,
.EAOOfferArea .followUpApplicantsExtEAOBankPayment  a,
.totalApplicantsOnALEVELEAOmovedFromPrepToProc a {
    color: #888;
    font-weight: bold;
    font-style: italic;
}
.EAOOfferArea .totalApplicantsOnALEVELEAOMovedToProcedure {
    top: 290px;
    left: 286px;
    font-weight: bold;
    font-size: 14px;
}
.EAOOfferArea .overallApplicantsOnPEJMORAO {
        top: 130px;
    left: 900px;
}
.EAOOfferArea .overallApplicantsOnALEVELRAO {
    top: 265px;
    left: 630px;
}
.EAOOfferArea .overallApplicantsOnALEVELWAOAwaitingResults {
    top: 310px;
    left: 630px;
}
.EAOOfferArea .overallApplicantsOnALEVELEAO {
    top: 290px;
    left: 200px;
}
.EAOOfferArea .overallApplicantsOnALEVELEAOProcedure {
         top: 290px;
    left: 410px;

}

/* EAO CSS END */
.finalArea {
    left: 2820px;
    top: 0px;
    width: 150px;
    height: 700px;
}
.finalNITPAApproval {
    left: 55px;
    top: 610px;
    font-size: 20px;
    font-weight: bold;
}
.finalRGTPAApproval {
    left: -165px;
    font-size: 20px;
    font-weight: bold;
    top: 80px;
}
.offerArea {
     left: 2112px;
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
        left: 30px;
    top: 120px;
}
.totlaApplicantsPassedFromOffer {
        left: -40px;
    top: 125px;
}
.totlaApplicantsPassedFromOfferShow {
        left: 220px;
    top: 125px;
}
.totlaApplicantsPassedFromFAOProcedureToChecklist {
        left: 400px;
    top: 125px;
}
.totalApplicantsInOffered {
        left: 312px;
    top: 120px; 
}
.totalApplicantsInOfferedCompleteCheck {
        left: 480px;
    top: 120px; 
}
.offerShowupToFollowup {
        left: 210px;
    top: 309px;
}
.totalApplicantsOnOfferFollowUp {
    left: 230px;
    top: 412px;
}
.totlaApplicantsPassedFromFollowupToNIT {
    left: 220px;
    top: 670px;
}
.totlaApplicantsPassedFromFollowupToEXT {
        left: 138px;
    top: 395px;
}


.bankShowupToFollowup {
    left: 510px;
    top: 303px;
}
.totalApplicantsOnBankFollowUp {
    left: 520px;
    top: 410px;
}
.totlaApplicantsPassedFromBankToNIT {
    left: 510px;
    top: 669px;
}
.totlaApplicantsPassedFromBankToEXT {
    left: 415px;
    top: 398px;
}
.finalRGT {
    left: 60px;
    font-size: 20px;
    font-weight: bold;
    top: 10px;
}   
.finalADMCOM {
        left: 60px;
    top: 270px;
    font-size: 20px;
    font-weight: bold;
}
.finalNIT {
    left: 60px;
    top:780px;
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