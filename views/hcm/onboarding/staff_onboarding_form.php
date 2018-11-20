<style type="text/css" media="screen">
.modal-dialog {
  width: 50%;
  height: 50%;
  padding: 0;

  overflow-y: initial !important;
}

.modal-body{
    height: 640px;
    overflow-y: auto;
}


#table_onboarding th {
  height: 50px;
  font-weight: bold;
  text-align: center !important;  
}

</style>



<div class="col-md-7 bootstrap-grid">
  <div class="powerwidget dark-red powerwidget-sortable" id="new_student_div" data-widget-editbutton="false" role="widget" style="">
      <header role="heading" class="ui-sortable-handle">
        <h2>Staff<small>Registration and Onboarding Form</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>          
        </div>
        <span class="powerwidget-loader"></span>
      </header>
    <div id="myTabContent" class="tab-content">
      <div class="tab-pane in active myform" id="staff_onboarding_form_tab">
        
        <?php
        if(validation_errors() != false) {
            echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
          }else{
            if(count($_POST)){
              echo '<div class="callout callout-info"> Record saved <br>NIC: '. $this->input->post('nic') . '<br>Staff: ' . $this->input->post('official_name') . '</div>';              
            }
          }
        ?>
        
        <form id="onboarding_print_form" action="<?php echo site_url()?>/hcm/staff_onboarding/printForm" method="POST" target="_blank">
          <input type="hidden" name="nic_val" id="nic_val">
          <button type="submit" class="btn btn-warning" style="float: right;">&nbsp;&nbsp;Print Form&nbsp;&nbsp;</button>
        </form>
        <form class="" action="<?php echo site_url()?>/hcm/staff_onboarding" method="POST">
          


          <ul class="nav nav-tabs">
            <li class="active"><a href="#staff_info" data-toggle="tab"><i class="fa fa-user"></i> Staff</a></li>
            <li class=""><a href="#staff_allocation" data-toggle="tab"><i class="fa fa-thumbs-up"></i> Allocation</a></li>
            <li class=""><a href="#staff_needs" data-toggle="tab"><i class="fa fa-laptop"></i> Needs</a></li>
            <li class=""><a href="#staff_joining" data-toggle="tab"><i class="fa fa-calendar"></i>&nbsp;&nbsp;Joining</a></li>
            <li class=""><a href="#staff_onboarding" data-toggle="tab"><i class="glyphicon glyphicon-check"></i> Onboarding</a></li>
            <!--<li class=""><a href="#staff_signoff" data-toggle="tab"><i class="glyphicon glyphicon-ok-sign"></i> Signoffs</a></li>
            <li class=""><a href="#staff_hr_comments" data-toggle="tab"><i class="glyphicon glyphicon-pencil"></i> HR</a></li>-->
          </ul>
          <div class="tab-content" style="padding-bottom:50px;">
            <div class="tab-pane active" id="staff_info">
              <table class="table table-hover margin-0px">
                <tbody>
                  <tr>
                    <td><strong>GT-ID</strong></td>
                    <td>
                      <div id="gt_id">Auto Generated</div>
                      <input type="hidden" id="gt_id" value="">
                    </td>
                    <td></td>

                    
                    <td><strong>Official name</strong></td>
                    <td><input type="text" name="official_name" id="official_name" value="" tabindex="101"></td>
                    <td></td>
                  </tr>




                  <tr>
                    <td><strong>Applicant Form #</strong></td>
                    <td>
                      <div id="career_id">Auto Generated</div>
                      <input type="hidden" id="gc_id" value="">
                    </td>
                    <td></td>                


                    <td><strong>Abridged Name</strong></td>
                    <td><input type="text" name="abridged_name" id="abridged_name" value="" tabindex="102"></td>
                    <div id="abridged_name_error"></div>
                    <td></td>
                  </tr>


                  <tr>
                    <td><strong>Gender</strong></td>
                    <td>
                      <input type="checkbox" name="staff_gender" id="staff_gender" checked data-toggle="toggle" data-on="Male" data-off="Female" data-onstyle="info" data-offstyle="warning">
                    </td>
                    <td>
                    </td>
                    

                    <td><strong>Call Name</strong></td> 
                    <td><input type="text" name="call_name" id="call_name" value="" tabindex="103"></td>
                    <div id="call_name_error"></div>
                    <td></td>
                  </tr>


                  <tr>
                    <td><strong>C N I C</strong></td>
                    <td><input type="text" name="nic" id="nic" tabindex="2" autoFocus placeholder="XXXXX-XXXXXXX-X" value="<?php if(validation_errors() != false) { echo $this->input->post('nic'); } ?>"></td>
                    <td></td>                

                          
                    <td><strong>Name Code</strong></td>
                    <td>
                      <input type="text" name="name_code" id="name_code" value="" tabindex="104">
                      <div id="name_code_error"><font size="2" color="red">Already taken</font></div>
                    </td>
                    <td></td>
                  </tr>


                  <tr>
                    <td><strong>Father Name</strong></td>
                    <td><input type="text" name="father_name" id="father_name" value="" tabindex="3"></td>
                    <td></td>
                    

                    <td><strong>Date of Birth</strong></td>
                    <td><input type="text" name="staff_dob" id="staff_dob" value="" tabindex="105"></td>
                    <td></td>
                  </tr>


                  <tr>
                    <td><strong>Spouse Name</strong></td>
                    <td><input type="text" name="spouse_name" id="spouse_name" value="" tabindex="4"></td>
                    <td></td>
                    

                    <td><strong>Date of Joining</strong></td>
                    <td><input type="text" name="staff_doj" id="staff_doj" value="" tabindex="106"></td>
                    <td></td>
                  </tr>


                  <tr>
                    <td><strong>Cell No.</strong></td>
                    <td><input type="text" name="mobile_phone" id="mobile_phone" value="" tabindex="5" placeholder="XXXX-XXXXXXX"></td>
                    <td></td>
                    

                    <td><strong>GF-ID</strong></td>
                    <td>
                      <input type="text" name="gfid" id="gfid" value="" tabindex="107" placeholder="XX-XXX">
                      <a class="btn-info btn btn-default btn-xs show_student_list" data-toggle="modal" name="parent_gfid" id="parent_gfid"><i class="fa fa-search"></i></a>
                    </td>
                    <td></td>
                  </tr>


                  <tr>
                    <td><strong>Appartment No</strong></td>
                    <td><input type="text" name="appartment_no" id="appartment_no" value="" tabindex="6" disabled></td>
                    <td></td>
                    

                    <td><strong>Plot No.</strong></td>
                    <td><input type="text" name="plot_no" id="plot_no" value="" tabindex="7" disabled></td>
                    <td></td>             
                  </tr>

                  <tr>
                    <td><strong>Building Name</strong></td>
                    <td><input type="text" name="building_name" id="building_name" value="" tabindex="7" disabled></td>
                    <td></td>
            
                    <td><strong>Street Name</strong></td>
                    <td><input type="text" name="street_name" id="street_name" value="" tabindex="7" disabled></td>
                    <td></td>            
                  </tr>


                  <tr>
                    <td><strong>Sub Region</strong></td>
                    <td><input type="text" name="sub_region" id="sub_region" value="" tabindex="7" disabled></td>
                    <td></td>
            
                    <td><strong>Region</strong></td>
                    <td><input type="text" name="region" id="region" value="" tabindex="7" disabled></td>
                    <td></td>             
                  </tr>

                  <tr>
                    <td><strong>Phone No.</strong></td>
                    <td><input type="text" name="landline" id="landline" value="" tabindex="8" placeholder="XXX-XXXXXXX"></td>
                    <td></td>
                    

                    <td><strong>GU ID</strong></td>
                    <td><input type="text" name="gu_id" id="gu_id" value="" tabindex="9" disabled="true"><br><font size="2">@generationsschool.org</font></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td><strong>Comments</strong></td>
                    <td><textarea></textarea></td>
                    <td></td>
                    

                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td></td>
                  </tr>


                </tbody>
              </table>  
            </div>


            <div class="tab-pane" id="staff_allocation">

            <table class="table table-hover margin-0px">
              <tbody>
              <tr>
                    <td><strong>Designation</strong></td>
                    <td><input type="text" name="designation" id="designation" value="" tabindex="9" disabled></td>
                    <td></td>

                    <td><strong>Primary Reporting</strong></td>
                    <td><input type="text" name="primary_reporting" id="primary_reporting" value="" tabindex="9" disabled></td>
                    <td></td>
              </tr>

              <tr>
                    <td><strong>Role</strong></td>
                    <td><input type="text" name="role" id="role" value="" tabindex="9" disabled></td>
                    <td></td>

                    <td><strong>Secondary Reporting</strong></td>
                    <td><input type="text" name="secondary_reporting" id="secondary_reporting" value="" tabindex="9" disabled></td>
                    <td></td>
              </tr>

              <tr>
                    <td><strong>Team/Dept</strong></td>
                    <td><input type="text" name="team_dept" id="team_dept" value="" tabindex="9" disabled/></td>
                    <td></td>

                    <td><strong>Timing</strong></td>
                    <td><input type="time" name="profile_time_in" id="profile_time_in" value="" disabled /></td>
                    <td><input type="time" name="profile_time_out" id="profile_time_out" value="" disabled /></td>
              </tr>

              </tbody>
            </table>

              
            </div>


            <div class="tab-pane" id="staff_needs">

                <table>
                  <tbody>
                    <tr>
                      <td width="35%">
                        <table class="table table-hover margin-0px">
                          <tbody>              
                            <tr>
                              <td></td>
                              <td>New Need</td>
                              <td>Re-allocation</td>
                              <td>No Need</td>                  
                            </tr>

                            <tr>                            
                              <td>Desktop</td>                            
                              <td>
                                <input type="radio" id="di_need_desktop1" name="di_need_desktop" class="switch" value="New Need"/>
                                <label for="di_need_desktop1">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="di_need_desktop2" name="di_need_desktop" class="switch" value="Re-allocation" />
                                <label for="di_need_desktop2">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="di_need_desktop3" name="di_need_desktop" class="switch" checked="checked" value="No Need" />
                                <label for="di_need_desktop3">&nbsp; </label>
                              </td>                           
                            </tr>





                            <tr>
                              <td>Printer</td>
                              <td>
                                <input type="radio" id="di_need_printer1" name="di_need_printer" class="switch" value="New Need" />
                                <label for="di_need_printer1">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="di_need_printer2" name="di_need_printer" class="switch" value="Re-allocation" />
                                <label for="di_need_printer2">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="di_need_printer3" name="di_need_printer" class="switch" checked="checked" value="No Need" />
                                <label for="di_need_printer3">&nbsp; </label>
                              </td>
                            </tr>



                            <tr>
                              <td>Other</td>
                              <td>
                                <input type="radio" id="di_need_other1" name="di_need_other" class="switch" value="New Need" />
                                <label for="di_need_other1">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="di_need_other2" name="di_need_other" class="switch" value="Re-allocation" />
                                <label for="di_need_other2">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="di_need_other3" name="di_need_other" class="switch" checked="checked" value="No Need" />
                                <label for="di_need_other3">&nbsp; </label>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>

                      <td width="5%">
                      </td>


                      <td width="35%">
                        <table class="table table-hover margin-0px">
                          <tbody>              
                            <tr>
                              <td></td>
                              <td>New Need</td>
                              <td>Re-allocation</td>
                              <td>No Need</td>                  
                            </tr>

                            <tr>
                              <td>Table</td>
                              <td>
                                <input type="radio" id="snf_need_table1" name="snf_need_table" class="switch" value="New Need" />
                                <label for="snf_need_table1">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="snf_need_table2" name="snf_need_table" class="switch" value="Re-allocation" />
                                <label for="snf_need_table2">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="snf_need_table3" name="snf_need_table" class="switch" checked="checked" value="No Need" />
                                <label for="snf_need_table3">&nbsp; </label>
                              </td>
                            </tr>



                            <tr>
                              <td>Chair</td>
                              <td>
                                <input type="radio" id="snf_need_chair1" name="snf_need_chair" class="switch" value="New Need" />
                                <label for="snf_need_chair1">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="snf_need_chair2" name="snf_need_chair" class="switch" value="Re-allocation" />
                                <label for="snf_need_chair2">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="snf_need_chair3" name="snf_need_chair" class="switch" checked="checked" value="No Need" />
                                <label for="snf_need_chair3">&nbsp; </label>
                              </td>
                            </tr>

                            <tr>
                              <td>Shelf</td>
                              <td>
                                <input type="radio" id="snf_need_shelf1" name="snf_need_shelf" class="switch" value="New Need" />
                                <label for="snf_need_shelf1">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="snf_need_shelf2" name="snf_need_shelf" class="switch" value="Re-allocation" />
                                <label for="snf_need_shelf2">&nbsp; </label>
                              </td>

                              <td>
                                <input type="radio" id="snf_need_shelf3" name="snf_need_shelf" class="switch" checked="checked" value="No Need" />
                                <label for="snf_need_shelf3">&nbsp; </label>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>


                      <td width="8%">
                      </td>


                      <td width="100%">
                        <table class="table table-hover margin-0px">
                          <tbody>              
                            <tr>
                              <td></td>
                              <td colspan="2">Transport</td>                            
                            </tr>

                            <tr>
                              <td>Shuttle</td>
                              <td>
                                <input type="checkbox" id="transport_shuttle" name="transport_shuttle" class="switch" />
                                <label for="transport_shuttle">&nbsp;</label>
                              </td>

                              <td></td>
                            </tr>

                            <tr>
                              <td>Door to Door</td>
                              <td>
                                <input type="checkbox" id="transport_door" name="transport_door" class="switch" />
                                <label for="transport_door">&nbsp;</label>
                              </td>

                              <td>                              
                              </td>   
                            </tr>                        
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>










            <div class="tab-pane" id="staff_joining">
              <table class="table table-hover margin-0px">
                <tbody>
                  <tr>
                    <td><strong>Formal Date of Joining</strong></td>
                    <td><input type="text" name="formal_doj" id="formal_doj" value="" tabindex="401"></td>
                    <td></td>


                    <td>Smart Card</td>
                    <td>
                      <input type="radio" id="smart_card1" name="smart_card" class="switch" value="N/A" checked="checked" />
                      <label for="smart_card1"> N / A </label>
                    </td>
                    <td>
                      <input type="radio" id="smart_card2" name="smart_card" class="switch" value="Printed" />
                      <label for="smart_card2"> Printed </label>
                    </td>

                    <td>
                      <input type="radio" id="smart_card3" name="smart_card" class="switch" value="H/O" />
                      <label for="smart_card3"> H / O </label>
                    </td>

                    <td></td>
                  </tr>




                  <tr>
                    <td><strong>Date of Joining Procedure</strong></td>
                    <td><textarea name="joining_procedure" id="joining_procedure" value="" tabindex="402" width="100%" height="400"></textarea></td>
                    <td></td>

                    <td>Visiting Card</td>                  
                    <td>
                      <input type="radio" id="visiting_card1" name="visiting_card" class="switch" value="N/A" checked="checked" />
                      <label for="visiting_card1"> N / A </label>
                    </td>

                    <td>
                      <input type="radio" id="visiting_card2" name="visiting_card" class="switch" value="Printed" />
                      <label for="visiting_card2"> Printed </label>
                    </td>

                    <td>
                      <input type="radio" id="visiting_card3" name="visiting_card" class="switch" value="H/O" />
                      <label for="visiting_card3"> H / O </label>
                    </td>
                  </tr>




                  <tr>
                    <td><strong>Photo</strong></td>
                    <td>
                      <input type="checkbox" id="photo" name="photo" class="switch" />
                      <label for="photo">&nbsp;</label>
                    </td>
                    <td></td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>



                  <tr>
                    <td><strong>Joining Policy Induction</strong></td>
                    <td>
                      <input type="checkbox" id="joining_policy" name="joining_policy" class="switch" />
                      <label for="joining_policy">&nbsp;</label>
                    </td>
                    <td></td>

                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>









            <div class="tab-pane" id="staff_onboarding">
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane in active myform" id="staff_onboarding_checklist_tab">
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#staff_welfare" data-toggle="tab"><i></i> Staff Welfare and Benefit</a></li>
                    <li class=""><a href="#hr_policies" data-toggle="tab"><i></i> HR Policies</a></li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane active" id="staff_welfare">
                      <table class="table table-hover margin-0px table-fixed" id="table_onboarding_staff_welfare">
                        <tbody>
                          <thead>
                            <tr>
                              <th></th>
                              <th align="center">Offer</th>
                              <th>Appointment</th>
                              <th>Joining</th>
                              <th>Comments / Notes</th>
                            </tr>
                          </thead>

                          <tr>
                            <td><h4>Staff Welfare and Benefit</h4></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                  
                          </tr>

                          <tr>
                            <td>Provident Fund</td>
                            <td style="text-align: center !important;">                              
                              <input name="provident_fund-offer" id="provident_fund-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="provident_fund-appointment" id="provident_fund-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="provident_fund-joining" id="provident_fund-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="provident_fund_comments" id="provident_fund_comments" value="" tabindex="601" width="100%" height="400"></textarea></td>
                          </tr>





                          <tr>
                            <td>EOBI / SESSI</td>
                            <td style="text-align: center !important;">
                              <input name="eobi_sessi-offer" id="eobi_sessi-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                
                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="eobi_sessi-appointment" id="eobi_sessi-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="eobi_sessi-joining" id="eobi_sessi-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="eobi_sessi_comments" id="eobi_sessi_comments" value="" tabindex="602" width="100%" height="400"></textarea></td>                            
                          </tr>






                          <tr>
                            <td>Health Takaful</td>
                            <td style="text-align: center !important;">                              
                              <input name="health_takaful-offer" id="health_takaful-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="health_takaful-appointment" id="health_takaful-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="health_takaful-joining" id="health_takaful-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="health_takaful_comments" id="health_takaful_comments" value="" tabindex="603" width="100%" height="400"></textarea></td>                            
                          </tr>






                          <tr>
                            <td>Bank Account</td>
                            <td style="text-align: center !important;">                              
                              <input name="bank_account-offer" id="bank_account-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="bank_account-appointment" id="bank_account-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="bank_account-joining" id="bank_account-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="bank_account_comments" id="bank_account_comments" value="" tabindex="604" width="100%" height="400"></textarea></td>                            
                          </tr>



                          <tr>
                            <td>Loan Policy</td>
                            <td style="text-align: center !important;">                              
                              <input name="loan_policy-offer" id="loan_policy-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="loan_policy-appointment" id="loan_policy-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="loan_policy-joining" id="loan_policy-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="loan_policy_comments" id="loan_policy_comments" value="" tabindex="605" width="100%" height="400"></textarea></td>                            
                          </tr>


                      
                          <tr>
                            <td>Child Fee Concession</td>
                            <td style="text-align: center !important;">                              
                                <input name="child_fee_concession-offer" id="child_fee_concession-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="child_fee_concession-appointment" id="child_fee_concession-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="child_fee_concession-joining" id="child_fee_concession-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="child_fee_concession_comments" id="child_fee_concession_comments" value="" tabindex="606" width="100%" height="400"></textarea></td>                            
                          </tr>


              
                          <tr>
                            <td><h4>Joining</h4></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>



                          <tr>
                            <td>Timing / Punctuality</td>
                            <td style="text-align: center !important;">                              
                              <input name="timing_punctuality-offer" id="timing_punctuality-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="timing_punctuality-appointment" id="timing_punctuality-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="timing_punctuality-joining" id="timing_punctuality-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="timing_punctuality_comments" id="timing_punctuality_comments" value="" tabindex="607" width="100%" height="400"></textarea></td>                            
                          </tr>


                
                          <tr>
                            <td>Probation & Confirmation</td>
                            <td style="text-align: center !important;">                              
                              <input name="probation_confimation-offer" id="probation_confimation-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;" >                              
                              <input name="probation_confimation-appointment" id="probation_confimation-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="probation_confimation-joining" id="probation_confimation-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="probation_confirmation_comments" id="probation_confirmation_comments" value="" tabindex="608" width="100%" height="400"></textarea></td>                            
                          </tr>


                          <tr>
                            <td>Notice Period & Resignation</td>
                            <td style="text-align: center !important;">                              
                              <input name="notice_period_resignation-offer" id="notice_period_resignation-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="notice_period_resignation-appointment" id="notice_period_resignation-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="notice_period_resignation-joining" id="notice_period_resignation-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="notice_period_registration_comments" id="notice_period_registration_comments" value="" tabindex="609" width="100%" height="400"></textarea></td>                            
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="tab-pane" id="hr_policies">
                      <table class="table table-hover margin-0px table-fixed" id="table_onboarding_hr_policies">
                        <tbody>
                          <thead>
                            <tr>
                              <th></th>
                              <th align="center">Offer</th>
                              <th>Appointment</th>
                              <th>Joining</th>
                              <th>Comments / Notes</th>
                            </tr>
                          </thead>
                          <tr>
                            <td><h4>HR Policies</h4></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>                  
                          </tr>                


                          <tr>
                            <td>Dress Code</td>
                            <td style="text-align: center !important;">                              
                              <input name="dress_code-offer" id="dress_code-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="dress_code-appointment" id="dress_code-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="dress_code-joining" id="dress_code-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="dress_code_comments" id="dress_code_comments" value="" tabindex="610" width="100%" height="400"></textarea></td>                            
                          </tr>





                          <tr>
                            <td>Tuition Policy</td>
                            <td style="text-align: center !important;">
                              <input name="tuition_policy-offer" id="tuition_policy-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="tuition_policy-appointment" id="tuition_policy-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="tuition_policy-joining" id="tuition_policy-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="tuition_policy_comments" id="tuition_policy_comments" value="" tabindex="611" width="100%" height="400"></textarea></td>                            
                          </tr>






                          <tr>
                            <td>Annual Leave</td>
                            <td style="text-align: center !important;">                              
                                <input name="annual_leave-offer" id="annual_leave-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="annual_leave-appointment" id="annual_leave-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="annual_leave-joining" id="annual_leave-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="annual_leave_comments" id="annual_leave_comments" value="" tabindex="612" width="100%" height="400"></textarea></td>                            
                          </tr>






                          <tr>
                            <td>Emergency Policy</td>
                            <td style="text-align: center !important;">                              
                              <input name="emergency_policy-offer" id="emergency_policy-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="emergency_policy-appointment" id="emergency_policy-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="emergency_policy-joining" id="emergency_policy-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="emergency_policy_comments" id="emergency_policy_comments" value="" tabindex="613" width="100%" height="400"></textarea></td>                            
                          </tr>



                          <!-- <tr>
                            <td>Other-1</td>
                            <td style="text-align: center !important;">
                                <input name="other_1-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="other_1-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="other_1-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td></td>
                          </tr> -->


                      
                          <!-- <tr>
                            <td>Other-2</td>
                            <td style="text-align: center !important;">                              
                              <input name="other_2-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="other_2-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="other_2-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td></td>
                          </tr> -->


              
                          <tr>
                            <td><h4>CPD / Induction</h4></td>                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>



                          <tr>
                            <td>Primary Induction</td>
                            <td style="text-align: center !important;">                              
                              <input name="primary_induction-offer" id="primary_induction-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="primary_induction-appointment" id="primary_induction-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="primary_induction-joining" id="primary_induction-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="primary_induction_comments" id="primary_induction_comments" value="" tabindex="614" width="100%" height="400"></textarea></td>                            
                          </tr>


                
                          <tr>
                            <td>CPD</td>
                            <td style="text-align: center !important;">                              
                                <input name="cpd-offer" id="cpd-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="cpd-appointment" id="cpd-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                                <input name="cpd-joining" id="cpd-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td><textarea name="cpd_comments" id="cpd_comments" value="" tabindex="615" width="100%" height="400"></textarea></td>                            
                          </tr>


                          <!-- <tr>
                            <td>Other</td>
                            <td style="text-align: center !important;">                              
                              <input name="other-offer" id="other-offer" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="other-appointment" id="other-appointment" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td style="text-align: center !important;">                              
                              <input name="other-joining" id="other-joining" type="checkbox" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="danger">                              
                            </td>
                            <td></td>
                          </tr> -->
                          
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>    
            <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success" style="float: ;    margin-top: 15px;">&nbsp;&nbsp;Save Form & Continue&nbsp;&nbsp;</button>       
            </div>
          </div>      
          <!-- /tabs -->

        </form>
      </div>  
    </div>
  </div>
</div>



<!-- Datatables View users -->
  <div class="col-md-5 bootstrap-grid sortable-grid ui-sortable">

  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="staff_modified_today" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Staff<small>Today</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>          
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="staff_modified_today_table_div" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="staff_modified_today_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 5px;">S.No.</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff ID: activate to sort column ascending" style="width: 5px;">Staff ID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff Name: activate to sort column ascending" style="width: 25px;">Staff Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Staff NIC: activate to sort column ascending" style="width: 25px;">Staff NIC</th>                
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gt_id" placeholder="Filter Staff ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gt_id" placeholder="Filter Staff Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_employee_id" placeholder="Filter Staff NIC" class="search_init"></th>              
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php            
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->staff['modifed_today'] as $staff_record) {              
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1"><?php echo $SNo; ?></td>
              <td class=" "><?php echo $staff_record['id']; ?></td>
              <td class=" "><?php echo $staff_record['name']; ?></td>
              <td class=" "><input class="staff_modified_today_nic" type="button" value="<?php echo $staff_record['nic'];?>"></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->