<?php

class Staff_Offboarding extends CI_Controller{

    public function __construct(){
        parent::__construct();


    }
    public function index(){
        $this->load->view('gs_files/header');
        $this->load->view('gs_files/main-nav');
        $this->load->view('gs_files/breadcrumb_staffOffBoarding');



        $this->load->model('tif_model/tif_a_form_model');
        $this->staffData = $this->tif_a_form_model->get_StaffList();



        $this->load->view('staffOffBoarding/Staff_Offboarding');
        $this->load->view('staffOffBoarding/footer_new');
    }











    public function getStaff_OffBoarding(){
        $html = '';

        if(count($_POST)){
            $GTID = $this->input->post('GTID');

            $this->load->model('tif_model/staff_offboarding_model');
            $staffData = $this->staff_offboarding_model->getStaff_BasicInformation($GTID);
            $staffLastWD = $this->staff_offboarding_model->getStaff_LastWD($staffData[0]['staff_id']);
            $staffSD = $this->staff_offboarding_model->getStaff_SectionDepartment($staffData[0]['staff_id']);
            $staffLB = $this->staff_offboarding_model->getStaff_Library($staffData[0]['staff_id']);
            $staffFN = $this->staff_offboarding_model->getStaff_Finance($staffData[0]['staff_id']);
            $staffHR = $this->staff_offboarding_model->getStaff_HR($staffData[0]['staff_id']);



            /* Local Variables */
              $this->data['photo_file'] = '.png';
              $this->data['staff_150_photo_path'] ='assets/photos/hcm/150x150/staff/';
              $ImageName = base_url() . $this->data['staff_150_photo_path'] . $staffData[0]['photo_id'] . $this->data['photo_file'];
              $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
              $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
              $ImageFound = "Yes";

              if (!file_exists($this->data['staff_150_photo_path'] . $staffData[0]['photo_id'] . $this->data['photo_file'])) {
                if($staffData[0]['gender'] == 'M'){
                    $ImageName = $ImageMale;
                }else if($staffData[0]['gender'] == 'F'){
                    $ImageName = $ImageFemale;
                }

                $ImageFound = "No";
              }


            /***** Basic Profile *****/
            $BP_LastWD = '';
            $BP_NoticePeriod = '';
            $BP_DateOfResignation = '';
            $BP_PreparedBy = '';
            $BP_PreparedDate = '';
            if(!empty($staffLastWD)){
                $BP_LastWD = $staffLastWD[0]['last_wd'];
                $BP_NoticePeriod = $staffLastWD[0]['notice_period'];
                $BP_DateOfResignation = $staffLastWD[0]['do_resignation'];
                $BP_PreparedBy = $staffLastWD[0]['prepared_by'];
                $BP_PreparedDate = $staffLastWD[0]['prepared_date'];
            }
            /***** Basic Profile - END *****/





            /***** Section / Department *****/
            $SD_PlannersReturned = '';
            $SD_InductionManualReturned = '';
            $SD_RecordKeepingRegReturned = '';
            $SD_AtdRegReturned = '';
            $SD_QBankReturned = '';
            $SD_AllKeysReturned = '';
            $SD_AllFilesHandedOver = '';
            $SD_AnyOtherMatReturned = '';
            $SD_Comments = '';
            $SD_SectionHeadName = '';
            $SD_SectionDate = '';
            $SD_DiscussedWithPO = '';
            $SD_DiscussedPODate = '';
            $SD_isPosted = '';
            $SD_PostedDate = '';
            if(!empty($staffSD)){
                if($staffSD[0]['planners_returned']==1){
                    $SD_PlannersReturned = 'checked="checked"';
                }
                if($staffSD[0]['induction_manual_returned']==1){
                    $SD_InductionManualReturned = 'checked="checked"';
                }
                if($staffSD[0]['record_keeping_reg_returned']==1){
                    $SD_RecordKeepingRegReturned = 'checked="checked"';
                }
                if($staffSD[0]['atd_reg_returned']==1){
                    $SD_AtdRegReturned = 'checked="checked"';
                }
                if($staffSD[0]['q_bank_returned']==1){
                    $SD_QBankReturned = 'checked="checked"';
                }
                if($staffSD[0]['all_keys_returned']==1){
                    $SD_AllKeysReturned = 'checked="checked"';
                }
                if($staffSD[0]['all_files_handedover']==1){
                    $SD_AllFilesHandedOver = 'checked="checked"';
                }
                if($staffSD[0]['any_other_mat_returned']==1){
                    $SD_AnyOtherMatReturned = 'checked="checked"';
                }
                if($staffSD[0]['discussed_with_po']==1){
                    $SD_DiscussedWithPO = 'checked="checked"';
                }
                if($staffSD[0]['is_posted']==1){
                    $SD_isPosted = 'checked="checked"';
                }


                $SD_Comments = $staffSD[0]['comments'];
                $SD_SectionHeadName = $staffSD[0]['chk_and_apr_name'];
                $SD_SectionDate = $staffSD[0]['chk_and_apr_date'];;
                $SD_DiscussedPODate = '';
                $SD_PostedDate = '';
                
            }
            /***** Section / Department - END *****/








            /***** Library *****/
            $LB_Section = '';
            $LB_Returned = '';
            $LB_Amount = '';
            $LB_TitleOfBooks = '';
            $LB_ChkAprBy = '';
            $LB_ChkAprDate = '';
            if(!empty($staffLB)){
                $LB_Section = '<option value="'.$staffLB[0]['section'].'">'.$staffLB[0]['section'].'</option>';
                if($staffLB[0]['books_returned']==1){
                    $LB_Returned = 'checked="checked"';
                }                
                $LB_Amount = $staffLB[0]['amount_due'];
                $LB_TitleOfBooks = $staffLB[0]['title_of_books'];
                $LB_ChkAprBy = $staffLB[0]['chk_and_apr_name'];
                $LB_ChkAprDate = $staffLB[0]['chk_and_apr_date'];
            }
            /***** Library - END *****/







            /***** Finance *****/
            $FN_LoanBalance = '';
            $FN_AdvAmount = '';
            $FN_PFContribution = '';
            $FN_CPDOutstanding = '';
            $FN_ChildFee = '';
            $FN_ChildSDReceivable = '';
            $FN_Comments = '';
            $FN_ChkAprBy = '';
            $FN_ChkAprDate = '';
            if(!empty($staffFN)){
                if($staffFN[0]['loan_balance']==1){
                    $FN_LoanBalance = 'checked="checked"';
                } 
                if($staffFN[0]['advance_amount']==1){
                    $FN_AdvAmount = 'checked="checked"';
                } 
                if($staffFN[0]['pf_contribution']==1){
                    $FN_PFContribution = 'checked="checked"';
                } 
                if($staffFN[0]['cpd_balance']==1){
                    $FN_CPDOutstanding = 'checked="checked"';
                } 
                if($staffFN[0]['child_disc_inactive']==1){
                    $FN_ChildFee = 'checked="checked"';
                } 
                if($staffFN[0]['child_sec_deposit_receivable']==1){
                    $FN_ChildSDReceivable = 'checked="checked"';
                } 
                $FN_Comments = $staffFN[0]['comments'];
                $FN_ChkAprBy = $staffFN[0]['chk_finance_name'];
                $FN_ChkAprDate = $staffFN[0]['chk_finance_date'];
            }
            /***** Finance - END *****/









            /***** HR *****/
            $HR_TakafulOpted = '';
            $HR_Amount = '';
            $HR_FamilySize = '';
            $HR_GSEmail = '';
            $HR_PortalID = '';
            $HR_PrimaryInductionBooklet = '';
            $HR_SmartCard = '';
            $HR_VehicleSticker = '';
            $HR_SuspendImmediately = '';
            $HR_SuspendAfter = '';
            if(!empty($staffHR)){
                if($staffHR[0]['takaful_opted']==1){
                    $HR_TakafulOpted = 'checked="checked"';
                } 
                if($staffHR[0]['induction_booklet']==1){
                    $HR_PrimaryInductionBooklet = 'checked="checked"';
                } 
                if($staffHR[0]['smart_card']==1){
                    $HR_SmartCard = 'checked="checked"';
                } 
                if($staffHR[0]['vehicle_sticker']==1){
                    $HR_VehicleSticker = 'checked="checked"';
                }
                if($staffHR[0]['suspended_immediately']==1){
                    $HR_SuspendImmediately = 'checked="checked"';
                }
                $HR_Amount = $staffHR[0]['amount'];
                $HR_FamilySize = $staffHR[0]['family_size'];
                $HR_GSEmail = $staffHR[0]['gs_email'];
                $HR_PortalID = $staffHR[0]['portal_id'];
                $HR_SuspendAfter = $staffHR[0]['suspended_after'];
            }
            /***** HR *****/





            $html .= '
            <div class="offboardingForm no-padding">
                <div class="" id="alert_div">
                </div>
				<div class="col-md-12 RightInformation_headerSection">
              		<div class="col-md-4 borderRightRed paddingLeft0">
                		<div class="col-md-4 paddingLeft0 paddingRight0" style="max-width:105px;">
                 		 	<img width="100%" src="'.$ImageName.'" title="Hadi" data-pin-nopin="true" class="borderRedImage" style="max-width: 105px;padding-bottom:20px;"><span class="nameCode">ALP</span>
                		</div><!-- col-md-4 -->
                		<div class="col-md-8 paddingRight0">
						  <h2 class="headHeading">'.$staffData[0]['abridged_name'].'</h2>
						  <h6 class="normalFont"><span class="leftLab2">GT-ID:</span> <strong>'.$staffData[0]['gt_id'].'</strong></h6>
						  <h6 class="normalFont"><span class="leftLab2">GU-ID:</span> <strong>'.$staffData[0]['gg_id'].'</strong></h6>
						  <h6 class="normalFont"><span class="leftLab2">Date of Joining:</span> <strong>'.date_format(date_create($staffData[0]['doj']), "d-M-y").'</strong></h6> 
						  <h6 class="normalFont"><span class="leftLab2">Status:</span> <strong>'.$staffData[0]['staff_status_code'].'</strong></h6>       
        				</div><!-- col-md-8 -->
              		</div><!-- col-md-4 -->
				  	<div class="col-md-4 borderRightRed" style="height:126px;">
				  
				  	</div><!-- col-md-4 -->
				  	<div class="col-md-3" style="height:126px;">
			  
				  	</div><!-- col-md-3 -->
					<span class="PrintButtonTop">
						<a href="'.base_url('index.php/staff_information_form_basic/staff_offboarding/printStaff_OffBoarding?gtid='.$staffData[0]['gt_id']).'" target="_blank"></a>
					</span>
          		</div>
				<div class="harisola">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#basicProfile">Basic Profile</a></li>
						<li><a data-toggle="tab" href="#SectionDepartment">Section/Department</a></li>
						<li><a data-toggle="tab" href="#Library">Library</a></li>
						<li><a data-toggle="tab" href="#Finance">Finance</a></li>
						<li><a data-toggle="tab" href="#HR">HR</a></li>
					  </ul>
                
                  <div class="tab-content">
                    <div id="basicProfile" class="tab-pane fade in active">
                       <div class="basicInfo col-md-12 no-padding boxOpening">
                            <div class="col-md-12">
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">GT-ID</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['gt_id'].'" disabled id="GTID"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right">Applicant Form #</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['gc_id'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Gender</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['gender'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">CNIC</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['nic'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->                            
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 no-padding">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Date of Joining</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="date" class="" value="'.$staffData[0]['doj'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Last Working Day</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="date" class="" value="'.$BP_LastWD.'" id="BP_LastWD"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Notice Period</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="number" class="" value="'.$BP_NoticePeriod.'" id="BP_NoticePeriod"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right">Date of Resignation</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="date" class="" value="'.$BP_DateOfResignation.'" id="BP_DateOfResignation"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <hr />
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Official Name</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" style="" value="'.$staffData[0]['name'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right">Abridged Name</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" style="" value="'.$staffData[0]['abridged_name'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">GU-ID</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" style="" value="'.$staffData[0]['gg_id'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Name Code</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" style="" value="'.$staffData[0]['name_code'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <hr />
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right ">Appartment No.</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['apartment_no'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right ">Building Name</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['building_name'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Sub Region</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['sub_region'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Cell No.</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['mobile'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->                            
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 no-padding">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Plot No.</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['plot_no'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Street Name</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['street_name'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Region</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['region'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Land Line</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['land_line'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                            <hr />
                            <div class="col-md-12">
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">GF-ID</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['gfid'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Fathers Name</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['father_name'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">&nbsp;</div><!-- col-md-3 --> 
                                        <div class="col-md-9">&nbsp;</div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding  text-right">Spouses Name</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" value="'.$staffData[0]['spouse_name'].'" disabled/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <hr />
                                <table width="100%" border="0" class="">
                                  <tr>
                                    <th>GS-ID</th>
                                    <th>Name</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                  </tr>';



                                  foreach ($staffData as $data) {
                                    $html .= '
                                    <tr>
                                        <td>'.$data['gs_id'].'</td>
                                        <td>'.$data['abridged_name'].'</td>
                                        <td>'.$data['class'].'</td>
                                        <td>'.$data['std_status_code'].'</td>
                                      </tr>';
                                  }
                                  

                                  
                                $html .= '</table>
                            </div><!-- col-md-6 -->
                        </div><!-- basicInfo -->
                    </div><!-- #basicProfile -->
                    <div id="SectionDepartment" class="tab-pane fade">
                        <div class="basicInfo col-md-12 no-padding boxOpening">
                            <div class="col-md-12">
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Planners returned</div>
                                    <div class="col-md-5"><input id="SD_PlannersReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_PlannersReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Induction manual returned</div>
                                    <div class="col-md-5"><input id="SD_InductionManualReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_InductionManualReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Record keeping register returned</div>
                                    <div class="col-md-5"><input id="SD_RecordKeepingRegReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_RecordKeepingRegReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Attendance register returned</div>
                                    <div class="col-md-5"><input id="SD_AtdRegReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_AtdRegReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Question bank returned</div>
                                    <div class="col-md-5"><input id="SD_QBankReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_QBankReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">All keys returned</div>
                                    <div class="col-md-5"><input id="SD_AllKeysReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_AllKeysReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">All related files handed over</div>
                                    <div class="col-md-5"><input id="SD_AllFilesHandedOver" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_AllFilesHandedOver.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Any other resource material returened (USB, CD, apparatus)</div>
                                    <div class="col-md-5"><input id="SD_AnyOtherMatReturned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$SD_AnyOtherMatReturned.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <textarea placeholder="Comments:" id="SD_Comments" rows="6">'.$SD_Comments.'</textarea>
                                </div><!-- -->
                            </div><!-- col-md-12 -->
                        </div><!-- basicInfo -->
                    </div><!-- #Section/Department -->
                    <div id="Library" class="tab-pane fade">
                        <div class="basicInfo col-md-12 no-padding boxOpening">
                            <div class="col-md-6 paddingLeft0 ">
                                <div class="fieldArea">
                                    <div class="col-md-3 no-padding paddingTop5 text-right">&nbsp;</div><!-- col-md-3 --> 
                                    <div class="col-md-9 paddingTop5"><strong><h4>Library books</h4></strong></div><!-- col-md-9 -->
                                </div><!-- fieldArea -->
                                <div class="fieldArea">
                                    <div class="col-md-3 no-padding paddingTop5 text-right">Section</div><!-- col-md-3 --> 
                                    <div class="col-md-9">
                                        <select id="LB_Section">
                                          '.$LB_Section.'
                                          <option value="Junior">Junior</option>
                                          <option value="Middle">Middle</option>
                                          <option value="Senior">Senior</option>
                                        </select>
                                    </div><!-- col-md-9 -->
                                </div><!-- fieldArea -->
                                <div class="fieldArea">
                                    <div class="col-md-3 no-padding text-right">Library books returned</div><!-- col-md-3 --> 
                                    <div class="col-md-9"><input id="LB_Returned" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$LB_Returned.'></div><!-- col-md-9 -->
                                </div><!-- fieldArea -->
                                <div class="fieldArea">
                                    <div class="col-md-3 no-padding paddingTop5  text-right">Amount Due</div><!-- col-md-3 --> 
                                    <div class="col-md-9"><input type="text" class="" id="LB_Amount" value="'.$LB_Amount.'"/></div><!-- col-md-9 -->
                                </div><!-- fieldArea -->
                                
                            </div><!-- col-md-6 -->
                            <div class="col-md-6 paddingLeft0 " id="bookTitleArea">
                                <div class="fieldArea">
                                    <div class="col-md-12 paddingTop5"><strong><h4>Title of books</h4></strong></div><!-- col-md-9 -->
                                </div><!-- fieldArea -->
                                <div class="fieldArea">
                                    <div class="col-md-12"><textarea placeholder="Please write books title Comma Seperated e.g. Hello World, Prince of Persia, etc.:" id="LB_TitleOfBooks" rows="6">'.$LB_TitleOfBooks.'</textarea></div><!-- col-md-12 -->
                                </div><!-- fieldArea -->
                            </div><!-- col-md-6 -->
                        </div><!-- basicInfo -->
                    </div><!-- #Library-->
                    <div id="Finance" class="tab-pane fade">
                        <div class="basicInfo col-md-12 no-padding boxOpening">
                            <div class="col-md-12">
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Loan balance</div>
                                    <div class="col-md-5"><input id="FN_LoanBalance" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$FN_LoanBalance.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Advance amount</div>
                                    <div class="col-md-5"><input id="FN_AdvAmount" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$FN_AdvAmount.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">P.F contribution</div>
                                    <div class="col-md-5"><input id="FN_PFContribution" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$FN_PFContribution.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">CPD outstanding balance</div>
                                    <div class="col-md-5"><input id="FN_CPDOutstanding" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$FN_CPDOutstanding.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Childs fee discount if Yes, Fee concession inactive</div>
                                    <div class="col-md-5"><input id="FN_ChildFee" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$FN_ChildFee.'></div>
                                </div><!-- -->
                                <div class="fieldArea2">
                                    <div class="col-md-7 paddingTop5">Childs security deposit receivable</div>
                                    <div class="col-md-5"><input id="FN_ChildSDReceivable" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$FN_ChildSDReceivable.'></div>
                                </div><!-- -->
                                
                                <div class="fieldArea2">
                                    <textarea placeholder="Comments:" rows="6" id="FN_Comments" >'.$FN_Comments.'</textarea>
                                </div><!-- -->
                            </div><!-- col-md-12 -->
                        </div><!-- basicInfo -->
                    </div><!-- $Finance -->
                    <div id="HR" class="tab-pane fade">
                        <div class="basicInfo col-md-12 no-padding boxOpening">
                            <div class="col-md-12">
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">&nbsp;</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><strong><h4>Health Takaful</h4></strong></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right">&nbsp;</div><!-- col-md-3 --> 
                                        <div class="col-md-9">
                                            <input id="HR_TakafulOpted" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Opted" data-off="Not Opted" data-onstyle="success" data-offstyle="danger" data-width="100" '.$HR_TakafulOpted.'>
                                            <small>*If opted then returned</small>
                                        </div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Amount</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" id="HR_Amount" value="'.$HR_Amount.'"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Family Size</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" id="HR_FamilySize" value="'.$HR_FamilySize.'"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->                            
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 no-padding">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">&nbsp;</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><strong><h4>HR stuff returned</h4></strong></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right">Primary induction booklet</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input id="HR_PrimaryInductionBooklet" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$HR_PrimaryInductionBooklet.'></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Smart card</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input id="HR_SmartCard" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$HR_SmartCard.'></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding text-right paddingTop5">Vehicle sticker</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input id="HR_VehicleSticker" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$HR_VehicleSticker.'></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <hr />
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">GS Email ID</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" style="" id="HR_GSEmail" value="'.$HR_GSEmail.'"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Portal ID</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input type="text" class="" style="" id="HR_PortalID" value="'.$HR_PortalID.'"/></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                                <div class="col-md-6 paddingLeft0">
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Suspend?</div><!-- col-md-3 --> 
                                        <div class="col-md-9"><input id="HR_SuspendImmediately" class="pull-right" type="checkbox" data-toggle="toggle" data-style="ios" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger" data-width="40" '.$HR_SuspendImmediately.'></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                    <div class="fieldArea">
                                        <div class="col-md-3 no-padding paddingTop5 text-right">Suspended After</div><!-- col-md-3 -->
                                        <div class="col-md-9"><input type="date" class=""  id="HR_SuspendAfter" value="'.$HR_SuspendAfter.'" /></div><!-- col-md-9 -->
                                    </div><!-- fieldArea -->
                                </div><!-- col-md-6 -->
                            </div><!-- col-md-12 -->
                        </div><!-- basicInfo -->
                    </div>
                  </div>
                
            </div><!-- offboardingForm -->
				<div class="col-md-12">
					<div class="col-md-4 col-md-offset-4">
						<div class="fieldArea">
							<div class="col-md-12 paddingTop5"><input type="submit" name="submit" class="greenBTN widthSmall" id="greenBTN" value="Submit"></div><!-- col-md-9 -->
						</div><!-- fieldArea -->
					</div>
				</div>
				</div>
            ';

        }


        echo $html;
    }













    public function saveOffBoardingForm(){
        $html = '';




        if(count($_POST)){

            $GTID = $this->input->post('GTID');
            $BP_LastWD = $this->input->post('BP_LastWD');
            $BP_NoticePeriod = $this->input->post('BP_NoticePeriod');
            $BP_DateOfResignation = $this->input->post('BP_DateOfResignation');

            $SD_PlannersReturned = $this->input->post('SD_PlannersReturned');
            $SD_InductionManualReturned = $this->input->post('SD_InductionManualReturned');
            $SD_RecordKeepingRegReturned = $this->input->post('SD_RecordKeepingRegReturned');
            $SD_AtdRegReturned = $this->input->post('SD_AtdRegReturned');
            $SD_QBankReturned = $this->input->post('SD_QBankReturned');
            $SD_AllKeysReturned = $this->input->post('SD_AllKeysReturned');
            $SD_AllFilesHandedOver = $this->input->post('SD_AllFilesHandedOver');
            $SD_AnyOtherMatReturned = $this->input->post('SD_AnyOtherMatReturned');
            $SD_Comments = $this->input->post('SD_Comments');

            $LB_Section = $this->input->post('LB_Section');
            $LB_Returned = $this->input->post('LB_Returned');
            $LB_Amount = $this->input->post('LB_Amount');
            $LB_TitleOfBooks = $this->input->post('LB_TitleOfBooks');


            $FN_LoanBalance = $this->input->post('FN_LoanBalance');
            $FN_AdvAmount = $this->input->post('FN_AdvAmount');
            $FN_PFContribution = $this->input->post('FN_PFContribution');
            $FN_CPDOutstanding = $this->input->post('FN_CPDOutstanding');
            $FN_ChildFee = $this->input->post('FN_ChildFee');
            $FN_ChildSDReceivable = $this->input->post('FN_ChildSDReceivable');
            $FN_Comments = $this->input->post('FN_Comments');


            $HR_TakafulOpted = $this->input->post('HR_TakafulOpted');
            $HR_PrimaryInductionBooklet = $this->input->post('HR_PrimaryInductionBooklet');
            $HR_SmartCard = $this->input->post('HR_SmartCard');
            $HR_VehicleSticker = $this->input->post('HR_VehicleSticker');
            $HR_SuspendImmediately = $this->input->post('HR_SuspendImmediately');
            $HR_Amount = $this->input->post('HR_Amount');
            $HR_FamilySize = $this->input->post('HR_FamilySize');
            $HR_GSEmail = $this->input->post('HR_GSEmail');
            $HR_PortalID = $this->input->post('HR_PortalID');
            $HR_SuspendAfter = $this->input->post('HR_SuspendAfter');

            //var_dump($LB_Returned);



            $this->load->model('tif_model/staff_offboarding_model');


            /***** Basic Profile *****/
            $RecordID = $this->staff_offboarding_model->offBoard_exists_BasicProfile($GTID);
            if($RecordID > 0){
                $this->staff_offboarding_model->updateRecord_BasicProfile($RecordID, $BP_LastWD, $BP_NoticePeriod, $BP_DateOfResignation);
            }else{
                $this->staff_offboarding_model->insertRecord_BasicProfile($GTID, $BP_LastWD, $BP_NoticePeriod, $BP_DateOfResignation);
            }
            $RecordID = 0;





            /***** Section / Department *****/
            $RecordID = $this->staff_offboarding_model->offBoard_exists_SectionDepartment($GTID);
            if($RecordID > 0){
                $this->staff_offboarding_model->updateRecord_SectionDepartment($RecordID, $SD_PlannersReturned, $SD_InductionManualReturned, $SD_RecordKeepingRegReturned, $SD_AtdRegReturned, $SD_QBankReturned, $SD_AllKeysReturned, $SD_AllFilesHandedOver, $SD_AnyOtherMatReturned, $SD_Comments);
            }else{
                $this->staff_offboarding_model->insertRecord_SectionDepartment($GTID, $SD_PlannersReturned, $SD_InductionManualReturned, $SD_RecordKeepingRegReturned, $SD_AtdRegReturned, $SD_QBankReturned, $SD_AllKeysReturned, $SD_AllFilesHandedOver, $SD_AnyOtherMatReturned, $SD_Comments);
            }
            $RecordID = 0;





            /***** Library *****/
            $RecordID = $this->staff_offboarding_model->offBoard_exists_Library($GTID);
            if($RecordID > 0){
                $this->staff_offboarding_model->updateRecord_Library($RecordID, $LB_Section, $LB_Returned, $LB_Amount, $LB_TitleOfBooks);
            }else{
                $this->staff_offboarding_model->insertRecord_Library($GTID, $LB_Section, $LB_Returned, $LB_Amount, $LB_TitleOfBooks);
            }
            $RecordID = 0;





            /***** Finance *****/
            $RecordID = $this->staff_offboarding_model->offBoard_exists_Finance($GTID);
            if($RecordID > 0){
                $this->staff_offboarding_model->updateRecord_Finance($RecordID, $FN_LoanBalance, $FN_AdvAmount, $FN_PFContribution, $FN_CPDOutstanding, $FN_ChildFee, $FN_ChildSDReceivable, $FN_Comments);
            }else{
                $this->staff_offboarding_model->insertRecord_Finance($GTID, $FN_LoanBalance, $FN_AdvAmount, $FN_PFContribution, $FN_CPDOutstanding, $FN_ChildFee, $FN_ChildSDReceivable, $FN_Comments);
            }
            $RecordID = 0;





            /***** HR *****/
            $RecordID = $this->staff_offboarding_model->offBoard_exists_HR($GTID);
            if($RecordID > 0){
                $this->staff_offboarding_model->updateRecord_HR($RecordID, $HR_TakafulOpted, $HR_PrimaryInductionBooklet, $HR_SmartCard, $HR_VehicleSticker, $HR_SuspendImmediately, $HR_Amount, $HR_FamilySize, $HR_GSEmail, $HR_PortalID, $HR_SuspendAfter);
            }else{
                $this->staff_offboarding_model->insertRecord_HR($GTID, $HR_TakafulOpted, $HR_PrimaryInductionBooklet, $HR_SmartCard, $HR_VehicleSticker, $HR_SuspendImmediately, $HR_Amount, $HR_FamilySize, $HR_GSEmail, $HR_PortalID, $HR_SuspendAfter);
            }
            $RecordID = 0;






            $html .= 'GT-ID: <strong>'.$GTID.'</strong>, Record <strong> saved </strong> successfully!';
        }





        echo $html;
    }


















    public function printStaff_OffBoarding(){
        $GTID = $this->input->get('gtid');



        $this->load->model('tif_model/staff_offboarding_model');
        $staffData = $this->staff_offboarding_model->getStaff_BasicInformation($GTID);
        $staffLastWD = $this->staff_offboarding_model->getStaff_LastWD($staffData[0]['staff_id']);
        $staffSD = $this->staff_offboarding_model->getStaff_SectionDepartment($staffData[0]['staff_id']);
        $staffLB = $this->staff_offboarding_model->getStaff_Library($staffData[0]['staff_id']);
        $staffFN = $this->staff_offboarding_model->getStaff_Finance($staffData[0]['staff_id']);
        $staffHR = $this->staff_offboarding_model->getStaff_HR($staffData[0]['staff_id']);



        /***** Basic Profile *****/
        $FormNo = '';
        $BP_LastWD = '';
        $BP_NoticePeriod = '';
        $BP_DateOfResignation = '';
        $BP_PreparedBy = '';
        $BP_PreparedDate = '';
        if(!empty($staffLastWD)){
            $BP_LastWD = date_format(date_create($staffLastWD[0]['last_wd']), "d-M-Y");
            $BP_NoticePeriod = $staffLastWD[0]['notice_period'];
            $BP_DateOfResignation = $staffLastWD[0]['do_resignation'];
            $BP_PreparedBy = $staffLastWD[0]['prepared_by'];
            $BP_PreparedDate = date_format(date_create($staffLastWD[0]['prepared_date']), "d-M-Y");
            $FormNo = str_pad($staffLastWD[0]['id'],3,"0",STR_PAD_LEFT);
        }
        /***** Basic Profile - END *****/





        /***** Section / Department *****/
        $SD_PlannersReturned = '';
        $SD_InductionManualReturned = '';
        $SD_RecordKeepingRegReturned = '';
        $SD_AtdRegReturned = '';
        $SD_QBankReturned = '';
        $SD_AllKeysReturned = '';
        $SD_AllFilesHandedOver = '';
        $SD_AnyOtherMatReturned = '';
        $SD_Comments = '';
        $SD_SectionHeadName = '';
        $SD_SectionDate = '';
        $SD_DiscussedWithPO = '';
        $SD_DiscussedPODate = '';
        $SD_isPosted = '';
        $SD_PostedDate = '';

        
        if(!empty($staffSD)){
            if($staffSD[0]['planners_returned']==1){
                $SD_PlannersReturned = 'checked';
            }
            if($staffSD[0]['induction_manual_returned']==1){
                $SD_InductionManualReturned = 'checked';
            }
            if($staffSD[0]['record_keeping_reg_returned']==1){
                $SD_RecordKeepingRegReturned = 'checked';
            }
            if($staffSD[0]['atd_reg_returned']==1){
                $SD_AtdRegReturned = 'checked';
            }
            if($staffSD[0]['q_bank_returned']==1){
                $SD_QBankReturned = 'checked';
            }
            if($staffSD[0]['all_keys_returned']==1){
                $SD_AllKeysReturned = 'checked';
            }
            if($staffSD[0]['all_files_handedover']==1){
                $SD_AllFilesHandedOver = 'checked';
            }
            if($staffSD[0]['any_other_mat_returned']==1){
                $SD_AnyOtherMatReturned = 'checked';
            }
            if($staffSD[0]['discussed_with_po']==1){
                $SD_DiscussedWithPO = 'checked';
            }
            if($staffSD[0]['is_posted']==1){
                $SD_isPosted = 'checked';
            }


            $SD_Comments = $staffSD[0]['comments'];
            $SD_SectionHeadName = $staffSD[0]['chk_and_apr_name'];
            $SD_SectionDate = $staffSD[0]['chk_and_apr_date'];;
            $SD_DiscussedPODate = '';
            $SD_PostedDate = '';
            
        }
        /***** Section / Department - END *****/








        /***** Library *****/
        $LB_Section = '';
        $LB_Returned = '';
        $LB_Amount = '';
        $LB_TitleOfBooks = '';
        $LB_ChkAprBy = '';
        $LB_ChkAprDate = '';
        if(!empty($staffLB)){
            $LB_Section = $staffLB[0]['section'];
            if($staffLB[0]['books_returned']==1){
                $LB_Returned = 'checked';
            }                
            $LB_Amount = $staffLB[0]['amount_due'];
            $LB_TitleOfBooks = $staffLB[0]['title_of_books'];
            $LB_ChkAprBy = $staffLB[0]['chk_and_apr_name'];
            $LB_ChkAprDate = $staffLB[0]['chk_and_apr_date'];
        }
        /***** Library - END *****/







        /***** Finance *****/
        $FN_LoanBalance = '';
        $FN_AdvAmount = '';
        $FN_PFContribution = '';
        $FN_CPDOutstanding = '';
        $FN_ChildFee = '';
        $FN_ChildSDReceivable = '';
        $FN_Comments = '';
        $FN_ChkAprBy = '';
        $FN_ChkAprDate = '';
        if(!empty($staffFN)){
            if($staffFN[0]['loan_balance']==1){
                $FN_LoanBalance = 'checked';
            } 
            if($staffFN[0]['advance_amount']==1){
                $FN_AdvAmount = 'checked';
            } 
            if($staffFN[0]['pf_contribution']==1){
                $FN_PFContribution = 'checked';
            } 
            if($staffFN[0]['cpd_balance']==1){
                $FN_CPDOutstanding = 'checked';
            } 
            if($staffFN[0]['child_disc_inactive']==1){
                $FN_ChildFee = 'checked';
            } 
            if($staffFN[0]['child_sec_deposit_receivable']==1){
                $FN_ChildSDReceivable = 'checked';
            } 
            $FN_Comments = $staffFN[0]['comments'];
            $FN_ChkAprBy = $staffFN[0]['chk_finance_name'];
            $FN_ChkAprDate = $staffFN[0]['chk_finance_date'];
        }
        /***** Finance - END *****/









        /***** HR *****/
        $HR_TakafulOpted = '';
        $HR_Amount = '';
        $HR_FamilySize = '';
        $HR_GSEmail = '';
        $HR_PortalID = '';
        $HR_PrimaryInductionBooklet = '';
        $HR_SmartCard = '';
        $HR_VehicleSticker = '';
        $HR_SuspendImmediately = '';
        $HR_SuspendAfter = '';
        if(!empty($staffHR)){
            if($staffHR[0]['takaful_opted']==1){
                $HR_TakafulOpted = 'checked';
            } 
            if($staffHR[0]['induction_booklet']==1){
                $HR_PrimaryInductionBooklet = 'checked';
            } 
            if($staffHR[0]['smart_card']==1){
                $HR_SmartCard = 'checked';
            } 
            if($staffHR[0]['vehicle_sticker']==1){
                $HR_VehicleSticker = 'checked';
            }
            if($staffHR[0]['suspended_immediately']==1){
                $HR_SuspendImmediately = 'checked';
            }
            $HR_Amount = $staffHR[0]['amount'];
            $HR_FamilySize = $staffHR[0]['family_size'];
            $HR_GSEmail = $staffHR[0]['gs_email'];
            $HR_PortalID = $staffHR[0]['portal_id'];
            $HR_SuspendAfter = $staffHR[0]['suspended_after'];
        }
        /***** HR *****/


        /***** Initiate PDF *****/
        require_once('components/pdf/fpdf/fpdf.php');
        require_once('components/pdf/fpdi/fpdi.php');

        // Overall Font Size
        $font_size = 9;
        $font_name = 'helvetica';
        $now_date = date('d-M-Y');
        $marked_size = 15;
        $tick = 'P';
        $cross = 'O';
        $i = 1;

        $pdf = new FPDI();

        // get the page count
        
        $pageCount = $pdf->setSourceFile('components/pdf/hcm/OffboardingForm.pdf');
       
        // Border On
        $bo = 0;
        // iterate through all pages
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            // import a page
            $templateId = $pdf->importPage($pageNo);
            // get the size of the imported page
            $size = $pdf->getTemplateSize($templateId);

            // create a page (landscape or portrait depending on the imported page size)
            if ($size['w'] > $size['h']) {
                $pdf->AddPage('L', array($size['w'], $size['h']));
            } else {
                $pdf->AddPage('P', array($size['w'], $size['h']));
            }           

            // use the imported page
            $pdf->useTemplate($templateId);

            

            


            if ($templateId == 1){

                // Request Date                
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(132.3, 9.5);
                $pdf->Cell(27, 5.5, $BP_PreparedDate, $bo, 2, 'C', 0);

                // Request No.
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(185.5, 9.5);
                $pdf->Cell(13.5, 5.5, $FormNo, $bo, 2, 'C', 0);

            /***** Basic Profile *****/
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(24.5, 27);
                //GT-ID
                $pdf->Cell(26.5, 5.7, $GTID, $bo, 2, 'L', 0);
                // Applicant Form
                $pdf->Cell(26.5, 5.7, $staffData[0]['gc_id'], $bo, 2, 'L', 0);
                //Gender
                $pdf->Cell(26.5, 5.7, $staffData[0]['gender'], $bo, 2, 'L', 0);
                // CNIC
                $pdf->Cell(26.5, 5.7, $staffData[0]['nic'], $bo, 2, 'L', 0);

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(78, 27);
                //Date of Joining
                $pdf->Cell(26.5, 5.7, date_format(date_create($staffData[0]['doj']), "d-M-Y"), $bo, 2, 'L', 0);
                //Last Working Day
                $pdf->Cell(26.5, 5.7, $BP_LastWD, $bo, 2, 'L', 0);
                //Notice Period
                $pdf->Cell(26.5, 5.7, $BP_NoticePeriod, $bo, 2, 'L', 0);
                //Date of Registration
                $pdf->Cell(26.5, 5.7, date_format(date_create($BP_DateOfResignation), "d-M-Y"), $bo, 2, 'L', 0);

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(132.3, 27);
                //GF-ID
                $pdf->Cell(26.5, 5.7, $staffData[0]['gfid'], $bo, 2, 'L', 0);
                //Father's Name
                $pdf->Cell(66.5, 5.7, $staffData[0]['father_name'], $bo, 2, 'L', 0);
                //Spouse's Name
                $pdf->Cell(66.5, 5.7, $staffData[0]['spouse_name'], $bo, 2, 'L', 0);
                //Empty Line
                $pdf->Cell(66.5, 5.7, '', $bo, 2, 'L', 0);

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(37.7, 53.3);
                //Official Name
                $pdf->Cell(66.5, 5.8, $staffData[0]['name'], $bo, 2, 'L', 0);
                //Abridged Name
                $pdf->Cell(66.5, 5.8, $staffData[0]['staff_abridged_name'], $bo, 2, 'L', 0);
                //GU-ID
                $pdf->Cell(66.5, 5.8, $staffData[0]['gg_id'], $bo, 2, 'L', 0);
                //Name Code
                $pdf->Cell(66.5, 5.8, $staffData[0]['name_code'], $bo, 2, 'L', 0);

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                foreach ($staffData as $data) {
                    $pdf->SetXY(119, 53.3 + (5.8*$i));
                    //GS-ID
                    $pdf->Cell(13.5, 5.8, $data['gs_id'], $bo, 0, 'L', 0);
                    //Official Name
                    $pdf->Cell(39.7, 5.8, $data['abridged_name'], $bo, 0, 'L', 0);
                    //Class
                    $pdf->Cell(13.5, 5.8, $data['class'], $bo, 0, 'L', 0);
                    //Hosue
                    $pdf->Cell(13.5, 5.8, $data['std_status_code'], $bo, 2, 'L', 0);

                    $i++;
                }

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(37.7, 81.8);
                //Appartment No.
                $pdf->Cell(26.5, 5.8, $staffData[0]['apartment_no'], $bo, 2, 'L', 0);
                //Building Name
                $pdf->Cell(26.5, 5.8, $staffData[0]['building_name'], $bo, 2, 'L', 0);
                //Sub Region
                $pdf->Cell(26.5, 5.8, $staffData[0]['sub_region'], $bo, 2, 'L', 0);
                //Cell No
                $pdf->Cell(26.5, 5.8, $staffData[0]['mobile'], $bo, 2, 'L', 0);

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(78, 81.8);
                //Plot No.
                $pdf->Cell(26.5, 5.8, $staffData[0]['plot_no'], $bo, 2, 'L', 0);
                //Street Name
                $pdf->Cell(26.5, 5.8, $staffData[0]['street_name'], $bo, 2, 'L', 0);
                //Region
                $pdf->Cell(26.5, 5.8, $staffData[0]['region'], $bo, 2, 'L', 0);
                //Land Line
                $pdf->Cell(26.5, 5.8, $staffData[0]['land_line'], $bo, 2, 'L', 0);

                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',8);
                $pdf->SetXY(132.3, 87.6);
                //Perpared by Name.
                $pdf->Cell(66.5, 5.8, $BP_PreparedBy, $bo, 2, 'L', 0);
                //Perpared by Signature.
                $pdf->Cell(66.5, 5.8, '', $bo, 2, 'L', 0);
                //Perpared by date.
                $pdf->Cell(26.5, 5.8, $now_date, $bo, 2, 'L', 0);
            /***** End Basic Profile *****/

            $pdf->SetFont($font_name,'',$font_size);
            /***** Clearance for Section/Department *****/
                $pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                // Planners Returned
                if ($SD_PlannersReturned == '') {
                    $pdf->SetXY(80, 121);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 121);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // Induction Manual returned
                if ($SD_InductionManualReturned == '') {
                    $pdf->SetXY(80, 125);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 125);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // Record Keeping Register returned
                if ($SD_RecordKeepingRegReturned == '') {
                    $pdf->SetXY(80, 129);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 129);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // Attendance Register returned
                if ($SD_AtdRegReturned == '') {
                    $pdf->SetXY(80, 133);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 133);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // Question Bank returned
                if ($SD_QBankReturned == '') {
                    $pdf->SetXY(80, 137);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 137);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // All Keys returned
                if ($SD_AllKeysReturned == '') {
                    $pdf->SetXY(80, 141);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 141);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // All related files handed over
                if ($SD_AllFilesHandedOver == '') {
                    $pdf->SetXY(80, 145);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 145);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // Any other resource material returned (USB, CD, apparatus)
                if ($SD_AnyOtherMatReturned == '') {
                    $pdf->SetXY(80, 149);
                    $pdf->Cell(12, 4, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(68, 149);
                    $pdf->Cell(12, 4, $tick, $bo, 2, 'C', 0);
                }
                // Comments
                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                $pdf->SetXY(21, 152.3);
                $pdf->Cell(83, 5.8, $SD_Comments, $bo, 2, 'L', 0);
                
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(119, 116.8);
                //Checked and Approved by Section Head
                $pdf->Cell(80, 5.8, $SD_SectionHeadName, $bo, 2, 'L', 0);
                //EmptyLine
                $pdf->Cell(80, 5.8, '', $bo, 2, 'L', 0);
                //Secton Date
                $pdf->Cell(26.5, 5.8, $SD_SectionDate, $bo, 2, 'L', 0);

                /*$pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                // Discussed with Principal
                if ($SD_DiscussedWithPO == '') {
                    $pdf->SetXY(132, 141);
                    $pdf->Cell(13, 6, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(119, 141);
                    $pdf->Cell(13, 6, $tick, $bo, 2, 'C', 0);
                }
                // Discussed Date
                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                $pdf->SetXY(119, 152.3);
                $pdf->Cell(26.5, 5.8, $SD_DiscussedPODate, $bo, 2, 'L', 0);

                $pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                // Discussed with Principal
                if ($SD_isPosted == '') {
                    $pdf->SetXY(185.5, 141);
                    $pdf->Cell(13, 6, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(172.5, 141);
                    $pdf->Cell(13, 6, $tick, $bo, 2, 'C', 0);
                }
                // Discussed Date
                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                $pdf->SetXY(172.5, 152.3);
                $pdf->Cell(26.5, 5.8, $SD_PostedDate, $bo, 2, 'L', 0);*/
            /***** End Clearance for Section/Department *****/

            /***** Library Clearance *****/
                $pdf->SetFont($font_name);
                $pdf->SetFont($font_name,'',$font_size);
                $pdf->SetXY(24.5, 170.5);
                //Library Books
                $pdf->Cell(53, 5.8, $LB_Section, $bo, 2, 'C', 0);
                // Library Books Returned
                $pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                    if ($LB_Returned == '') {
                        $pdf->SetXY(51, 176.5);
                        $pdf->Cell(26.5, 6, $cross, $bo, 2, 'C', 0);
                    }else{
                        $pdf->SetXY(24.5, 176.5);
                        $pdf->Cell(26.5, 6, $tick, $bo, 2, 'C', 0);
                    }
                // Amount Due
                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                $pdf->SetXY(24.5, 182);
                $pdf->Cell(53, 5.8, $LB_Amount, $bo, 2, 'C', 0);

                // Library Books
                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',7.5);
                $pdf->SetXY(80.7, 170.5);
                $pdf->MultiCell(23.5, 3.35, $LB_TitleOfBooks, $bo, 'C', 0);

                // Checked and Approve by
                $pdf->SetXY(119, 170.5);
                $pdf->Cell(80, 6, $LB_ChkAprBy, $bo, 2, 'L', 0);
                // Empty Line
                $pdf->Cell(80, 6, '', $bo, 2, 'L', 0);
                // Library Date
                $pdf->Cell(26.5, 6, $LB_ChkAprDate, $bo, 2, 'L', 0);
            /***** End Library Clearance *****/

            /***** Finance Clearance *****/
                $pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                // Loan Balance
                if ($FN_LoanBalance == '') {
                    $pdf->SetXY(77.7, 206);
                    $pdf->Cell(13.2, 5.9, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(64.5, 206);
                    $pdf->Cell(13.2, 5.9, $tick, $bo, 2, 'C', 0);
                }
                // Advance amount
                if ($FN_AdvAmount == '') {
                    $pdf->SetXY(77.7, 211.7);
                    $pdf->Cell(13.2, 5.9, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(64.5, 211.7);
                    $pdf->Cell(13.2, 5.9, $tick, $bo, 2, 'C', 0);
                }
                // P.F Contribution
                if ($FN_PFContribution == '') {
                    $pdf->SetXY(77.7, 217.6);
                    $pdf->Cell(13.2, 5.9, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(64.5, 217.6);
                    $pdf->Cell(13.2, 5.9, $tick, $bo, 2, 'C', 0);
                }
                // CPD outstanding balance
                if ($FN_CPDOutstanding == '') {
                    $pdf->SetXY(77.7, 223.5);
                    $pdf->Cell(13.2, 5.9, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(64.5, 223.5);
                    $pdf->Cell(13.2, 5.9, $tick, $bo, 2, 'C', 0);
                }
                // Child's fee discount if yes, Fee concession inactive
                if ($FN_ChildFee == '') {
                    $pdf->SetXY(77.7, 229.4);
                    $pdf->Cell(13.2, 5.9, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(64.5, 229.4);
                    $pdf->Cell(13.2, 5.9, $tick, $bo, 2, 'C', 0);
                }
                // Child's security deposit Receivable 
                if ($FN_ChildSDReceivable == '') {
                    $pdf->SetXY(77.7, 235.3);
                    $pdf->Cell(13.2, 5.9, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(64.5, 235.3);
                    $pdf->Cell(13.2, 5.9, $tick, $bo, 2, 'C', 0);
                }

                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                // Checked and Approve by
                $pdf->SetXY(119, 222.5);
                $pdf->Cell(80, 6, $FN_ChkAprBy, $bo, 2, 'L', 0);
                // Empty Line
                $pdf->Cell(80, 6, '', $bo, 2, 'L', 0);
                // Library Date
                $pdf->Cell(26.5, 6, $FN_ChkAprDate, $bo, 2, 'L', 0);
            /***** End Finance Clearance *****/

            /***** HR Clearance *****/
                $pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                // Health Takaful Opted
                if ($HR_TakafulOpted == '') {
                    $pdf->SetXY(37.1, 256);
                    $pdf->Cell(3, 2.5, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(25, 256);
                    $pdf->Cell(3, 2.5, $tick, $bo, 2, 'C', 0);
                }

                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                // Amount
                $pdf->SetXY(24.5, 261.5);
                $pdf->Cell(26.5, 6, $HR_Amount, $bo, 2, 'L', 0);
                // Family Size
                $pdf->Cell(26.5, 6, $HR_FamilySize, $bo, 2, 'L', 0);

                $pdf->SetXY(105.5, 255.5);
                // GS Email ID
                $pdf->Cell(54, 6, $HR_GSEmail, $bo, 2, 'L', 0);

                $pdf->SetXY(105.5, 267);
                // GS Portal ID
                $pdf->Cell(54, 6, $HR_PortalID, $bo, 2, 'L', 0);

                $pdf->AddFont('wingdng2','','wingdng2.php');
                $pdf->SetFont('wingdng2','',$marked_size);
                // Primary Induction Booklet
                if ($HR_PrimaryInductionBooklet == '') {
                    $pdf->SetXY(91, 256);
                    $pdf->Cell(13.5, 5.5, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(77.5, 256);
                    $pdf->Cell(13.5, 5.5, $tick, $bo, 2, 'C', 0);
                }
                 // SmartCard
                if ($HR_SmartCard == '') {
                    $pdf->SetXY(91, 261.5);
                    $pdf->Cell(13.5, 5.5, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(77.5, 261.5);
                    $pdf->Cell(13.5, 5.5, $tick, $bo, 2, 'C', 0);
                }
                 // Vehicle Sticker
                if ($HR_VehicleSticker == '') {
                    $pdf->SetXY(91, 267);
                    $pdf->Cell((13.5/2), 5.5, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(77.5, 267);
                    $pdf->Cell(13.5, 5.5, $tick, $bo, 2, 'C', 0);
                }

                // Suspended
                if ($HR_SuspendImmediately == '') {
                    $pdf->SetXY(161.3, 256);
                    $pdf->Cell(3, 2.5, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(161.3, 256);
                    $pdf->Cell(3, 2.5, $tick, $bo, 2, 'C', 0);
                }
                // Suspended Date Check
                if ($HR_SuspendAfter == '') {
                    $pdf->SetXY(161.3, 259);
                    $pdf->Cell(3, 2.5, $cross, $bo, 2, 'C', 0);
                }else{
                    $pdf->SetXY(161.3, 259);
                    $pdf->Cell(3, 2.5, $tick, $bo, 2, 'C', 0);
                }

                $pdf->SetFont('helvetica', '', 'helvetica');
                $pdf->SetFont('helvetica','',$font_size);
                // Suspended Date
                $pdf->SetXY(178.5, 258);
                $pdf->Cell(20, 3, '', $bo, 2, 'L', 0);

            }
        }
        // Output the new PDF
        $pdf->Output($GTID . ' ' . $staffData[0]['name_code'] . '.pdf', 'I');
    }

}