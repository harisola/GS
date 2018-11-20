
<style>
.required {
    color: red;
    font-size: 14px;
}
</style>



<div class="container" id="BatchListing">
    <!-- Two column layout Start -->
    <div class="row">
        <div class="col-md-12 BatchListing">
            <div class="MaroonBorderBox">
                <h3>Offers</h3>
                <div class="col-md-12 no-padding" style="width: 335px; text-align: center; position: absolute; top: 40%; left: 40%; background: rgb(241, 239, 239); border: 1px solid rgb(204, 204, 204); padding: 10px; z-index: 99999; display: none;" id="Generations_AjaxLoader">
                   <img src="http://10.10.10.50/gs//components/image/gsLoader.gif" width="200"><br><hr style="margin: 7px 0;border-top: 1px solid #ccc;"> Loading. Please Wait...
                </div>
                <div class="inner" style="padding:20px !important;">
                    <select required class="col-md-6 paddingBottom10 paddingLeft10 paddingRight10 paddingTop10" id="grade">
                      <option value="" disabled selected>Select Grade *</option>

                      <?php foreach($grade as $grade_id) { ?>
                        <option value="<?php echo $grade_id->id ?>"><?php echo $grade_id->name ?></option>
                      <?php } ?>

                    </select>
                </div><!-- inner -->
                <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">

                <div class="modal fade in TimeLineModal" id="AddDetails" role="dialog">
                <div class="modal-dialog">
                <div class="modal-content">

                    <div class="add_detail"></div>
                </div>
                </div>
                </div>
                <?php /*?>
                    <div class="modal fade in TimeLineModal" id="AddDetails" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Applicant Details for - <strong>Muhammad Saleem Atif</strong></h4>
                            </div>
                            <div class="modal-body">
                                <div class="col-md-12" style="padding-bottom:0;">
                                    <div class="MaroonBorderBox">
                                        <div class="inner" style="">
                                            <div class="col-md-12 paddingBottom20">
                                                <div class="col-md-3 text-right">
                                                    Address *
                                                </div><!-- col-md-3 -->
                                                <div class="col-md-9">
                                                    <div class="col-md-6 paddingBottom10">
                                                        <input type="text" placeholder="Apartment No" />
                                                    </div><!-- col-md-6 -->
                                                    <div class="col-md-6 paddingBottom10">
                                                        <input type="text" placeholder="Street Name" />
                                                    </div><!-- col-md-6 -->
                                                    <div class="col-md-6 paddingBottom10">
                                                        <input type="text" placeholder="Building Name" />
                                                    </div><!-- col-md-6 -->
                                                    <div class="col-md-6 paddingBottom10">
                                                        <input type="text" placeholder="Plot No" />
                                                    </div><!-- col-md-6 -->
                                                    <div class="col-md-6 paddingBottom10">
                                                        <input type="text" placeholder="Region" />
                                                    </div><!-- col-md-6 -->
                                                    <div class="col-md-6 paddingBottom10">
                                                        <input type="text" placeholder="Sub region" />
                                                    </div><!-- col-md-6 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12">
                                                <div class="col-md-3 text-right paddingTop10">
                                                    Date of Payment *
                                                </div><!-- col-md-3 -->
                                                <div class="col-md-9">
                                                    <div class="col-md-12" style="padding:0 15px 0 15px;">
                                                        <input type="date" placeholder="dd/mm/yyyy" />
                                                    </div><!-- col-md-6 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12">
                                                <div class="col-md-3 text-right paddingTop10">
                                                    Concession Code *
                                                </div><!-- col-md-3 -->
                                                <div class="col-md-9">
                                                    <div class="col-md-12" style="padding:0 15px 0 15px;">
                                                        <select required>
                                                          <option value="" disabled selected>Concession Code</option>
                                                          <option value="North">North</option>
                                                          <option value="South">South</option>
                                                        </select>
                                                    </div><!-- col-md-6 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12">
                                                <div class="col-md-3 text-right paddingTop10">
                                                    Activation Date *
                                                </div><!-- col-md-3 -->
                                                <div class="col-md-9">
                                                    <div class="col-md-12" style="padding:0 15px 0 15px;">
                                                        <input type="date" placeholder="dd/mm/yyyy" />
                                                    </div><!-- col-md-6 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                            <hr />
                                            <div class="col-md-12" style="padding-bottom:0;">
                                                <div class="col-md-3">&nbsp;</div>
                                                <div class="col-md-9">
                                                    <div class="col-md-5">
                                                        <input type="submit" class="greenBTN" value="Submit" />
                                                    </div><!-- col-md-2 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                        </div><!-- inner -->
                                    </div><!-- .MaroonBorderBox -->
                                </div><!-- col-md-12 -->
                            </div><!-- modal-body -->
                          </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- AddDetails -->
                    <?php */ ?>
                    <div class="modal fade in TimeLineModal" id="OfferPreparation" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">

                            <div class="offer-preperation"></div>
                            <?php /* ?>
                            <div class="modal-body">
                                <div class="col-md-12" style="padding-bottom:0;">
                                    <div class="MaroonBorderBox">
                                        <div class="inner" style="">
                                            <div class="paddingLeft30 paddingRight30">
                                                <div class="alert alert-info">
                                                    Please tick all the boxes once you have the offer pack ready. 
                                                </div>  
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="1" name="" required="required" class="bigCheck"> <label class="bigLabel" for="1">Offer Letter <a href="#" class="smallLink"><em>Print</em></a></label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div>
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="2" name="" required="required" class="bigCheck"> <label class="bigLabel" for="2">FIF Form <a href="#" class="smallLink"><em>Print</em></a></label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div>
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="3" name="" required="required" class="bigCheck"> <label class="bigLabel" for="3">Photo Token <a href="#" class="smallLink"><em>Print</em></a></label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="4" name="" required="required" class="bigCheck"> <label class="bigLabel" for="4">Handbook <a href="#" class="smallLink"><em>Print</em></a></label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div><!-- col-md-12 -->
                                            <hr />
                                            <div class="col-md-12" style="padding-bottom:0;">
                                                <div class="col-md-9 paddingLeft20">
                                                    <div class="col-md-5">
                                                        <input type="submit" class="greenBTN" value="Submit" />
                                                    </div><!-- col-md-2 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                        </div><!-- inner -->
                                    </div><!-- .MaroonBorderBox -->
                                </div><!-- col-md-12 -->
                            </div><!-- modal-body -->
                            <?php */ ?>
                          </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- OfferPreparation -->
                    <div class="modal fade in TimeLineModal" id="OfferSubmission" role="dialog">
                        <div class="modal-dialog">
                        
                          <!-- Modal content-->
                          <div class="modal-content">
                          
                            <div class="offer_submission"></div>
                            <?php /*
                            <div class="modal-body">
                                <div class="col-md-12" style="padding-bottom:0;">
                                    <div class="MaroonBorderBox">
                                        <div class="inner" style="">
                                            <div class="paddingLeft30 paddingRight30">
                                                <div class="alert alert-info">
                                                    Please tick all the boxes once you have the offer pack ready. 
                                                </div>  
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="11" name="" required="required" class="bigCheck"> <label class="bigLabel" for="11">Signed Offer Letter</label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div>
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="22" name="" required="required" class="bigCheck"> <label class="bigLabel" for="22">Complete FIF Form</label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div>
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="33" name="" required="required" class="bigCheck"> <label class="bigLabel" for="33">Signed Handbook</label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div><!-- col-md-12 -->
                                            <div class="col-md-12 paddingBottom10">
                                                <div class="col-md-8 paddingBottom10 paddingLeft30">
                                                    <input type="checkbox" id="44" name="" required="required" class="bigCheck"> <label class="bigLabel" for="44">Printed Fee Bill <a href="#" class="smallLink"><em>Print</em></a></label>
                                                </div><!-- col-md-8 -->
                                                <div class="col-md-2">&nbsp;</div>
                                            </div><!-- col-md-12 -->
                                            <hr />
                                            <div class="col-md-12" style="padding-bottom:0;">
                                                <div class="col-md-9 paddingLeft20">
                                                    <div class="col-md-5">
                                                        <input type="submit" class="greenBTN" value="Submit" />
                                                    </div><!-- col-md-2 -->
                                                </div><!-- col-md-9 -->
                                            </div><!-- col-md-12 -->
                                        </div><!-- inner -->
                                    </div><!-- .MaroonBorderBox -->
                                </div><!-- col-md-12 -->
                            </div><!-- modal-body -->
                            <?php */ ?>
                          </div><!-- modal-content -->
                        </div><!-- modal-dialog -->
                    </div><!-- OfferSubmission -->
                    <!-- <table id="AdmissionFormListingg" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> --> 
<!--                       <thead> 
                          <tr> 
                              <th width="7%" class="text-center">Form #</th> 
                              <th width="7%" class="text-center">Batch ID</th> 
                              <th width="14%">Applicant Name<br /><small>Father Name</small></th> 
                              <th width="16%" class=" no-sort">Offer Date<br />Payment Due Date</th>
                              <th width="10%" class="text-left no-sort">Offer Details</th>
                              <th width="12%" class="text-left no-sort">Offer Preparation</th>
                              <th width="12%" class="text-left no-sort">Offer Submission</th>
                              <th width="15%" class="text-center no-sort">Status</th>
                              <th width="7%" class="text-center no-sort">Action</th>
                          </tr>
                      </thead> -->
                      <div class="offer_table"></div>

<!--                       <tbody> 

                          <tr>
                              <td class="text-center">5811</td>
                              <td class="text-center">A05-09</td>
                              <td>Abdul Ahad Abdullah<br /><small>Abdullah Karwa</small></td>
                              <td class="text-left">Friday, 12-January-2016<br />Saturday, 20-January-2016</td>
                              <td class="text-left">
                                <ul class="liActions">
                                    <li class="tick">Address</li>
                                    <li class="tick">Date of Payment</li>
                                    <li class="tick">Concession Code</li>
                                    <li class="tick">Activation Date</li>
                                </ul>
                              </td>
                              <td class="text-left">
                                <ul class="liActions">
                                    <li class="tick">Printed Offer Letter</li>
                                    <li class="tick">Printed FIF</li>
                                    <li class="tick">Printed Photo Token</li>
                                    <li class="tick">Handbook</li>
                                </ul>
                              </td>
                              <td class="text-left">
                                <ul class="liActions">
                                    <li class="tick">Signed Offer Letter</li>
                                    <li class="tick">Complete FIF form</li>
                                    <li class="tick">Signed Hand Book</li>
                                    <li class="tick">Printed Fee Bill</li>
                                </ul>
                              </td>
                              <td class="text-center"><img src="images/allocationIcon_active.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="images/communicationIcon_active.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="images/ReminderIcon.png" title="Reminder" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="images/PresenceIcon_active.png" title="Presence" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="images/FollowUpIcon.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" /></td>
                              
                              <td class="actionArea">
                                <a href="javascript:void(0)" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="actionItems">
                                    <ul>
                                        <li><a href="#" data-toggle="modal" data-target="#AddDetails">Add Details</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#OfferPreparation">Offer Preparation</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#OfferSubmission">Offer Submission</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#PrintFeeBill">Print Fee Bill</a></li>
                                    </ul>
                                </div>
                              </td>
                          </tr>
                      </tbody> --> 
                    <!-- </table> --><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->

<script>
var DECStatus = jQuery('#DECStatus');
var select = this.value;
DECStatus.change(function () {
    if ($(this).val() == 'WIL') {
        $('.IfWIL').show();
    }
    else $('.IfWIL').hide();
});

DECStatus.change(function () {
    if ($(this).val() == 'OFD') {
        $('.IfOFD').show();
    }
    else $('.IfOFD').hide();
});
</script>
<!-- <script src="js/custom.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="https://vitalets.github.io/x-editable/assets/demo-mock.js"></script>  -->

