<style>
.FormNo {
	padding-top:5px;	
}
</style>
<div class="container">
    <!-- Two column layout Start -->
	<div class="row">
    	<div class="col-md-12">
        	<h2 class="withBorderBottom">Admission Form Submission</h2>
        </div><!-- col-md-12 -->
    	<div class="col-md-4" style="">
        	<div class="MaroonBorderBox">
        		<h3>Applicant Details</h3>
                <div class="inner">
                	<div class="col-md-12">
                        <div class="FormNoShow">
                            <div class="col-md-3 text-right"><label class="FormNo">Form No.</label> </div>
                            <div class="col-md-9"><input type="text" placeholder="XXXX" /></div>
                        </div><!-- FormNoShow -->
                    </div><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-6">
                            <input type="text" class="" placeholder="Previous School *" required />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                            <input type="text" placeholder="Previous Grade *" />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-6">
                            <input type="text" class="" placeholder="Official Name *" required />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                            <input type="text" placeholder="Call Name" />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom0">
                        <div class="col-md-6">
                            <input placeholder="Date of Birth *" required class="textbox-n" type="text" onfocus="(this.type='date')"  id="" onblur="(this.type='text')">
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                            <select required>
                              <option value="" disabled selected>Gender *</option>
                              <option value="Boy">Boy</option>
                              <option value="Girl">Girl</option>
                            </select>
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12 paddingBottom20">
                    	<div class="col-md-6">
                        	<input type="text" class="" placeholder="Father Name *" required />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                        	<input type="text" class="" placeholder="Father Mobile *" required />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                    	<div class="col-md-6">
                        	<input type="text" class="" placeholder="Father NIC *" required />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                        	<input type="text" class="" placeholder="Father Email" required />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                    	<div class="col-md-6">
                        	<input type="text" class="" placeholder="Mother Name *" required />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                        	<input type="text" class="" placeholder="Mother Mobile *" required />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 ">
                    	<div class="col-md-6">
                        	<input type="text" class="" placeholder="Mother NIC *" required />
                        </div><!-- col-md-6 -->
                        <div class="col-md-6">
                        	<input type="text" class="" placeholder="Mother Email" required />
                        </div><!-- col-md-6 -->
                    </div><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12">
                    	<div class="col-md-12">
                    		<textarea placeholder="Comments" rows="4" cols="50"></textarea>
                        </div><!-- col-md-12 -->
                    </div><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12">
                        <div class="col-md-12 paddingBottom10">
                            <input type="checkbox" id="ps" name=""> <label for="ps">Photos Submitted</label>
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom10">
                            <input type="checkbox" id="bco" name=""> <label for="bco">Birth Certificate (O)</label>
                        </div><!-- col-md-12 -->
                        <div class="col-md-12 paddingBottom10">
                            <input type="checkbox" id="bcc" name=""> <label for="bcc">Birth Certificate (C)</label>
                        </div><!-- col-md-12 -->    
                    </div><!-- .col-md-12 -->
                    <hr />
                    <div class="col-md-12">
                    	<input type="button" class="greenBTN" value="Print & Issue" />
                    </div><!-- col-md-12 -->
                </div><!-- inner -->
            </div><!-- .MaroonBorderBox -->
        </div><!-- col-md-4 -->
        <div class="col-md-8">
        	<div class="MaroonBorderBox">
        		<h3>Admission Forms Issued</h3>
                <div class="inner20 paddingLeft20 paddingRight20">
                	<table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th width="" class="text-center">Form #</th> 
                              <th width="">Applicant Name</th> 
                              <th width="">Father Name</th>
                              <th width="">Submission Date</th> 
                              <th width="" class="text-center no-sort">Status</th>
                              <th width="" class="text-center">Grade</th>
                              <th width="" class="no-sort">Action</th>
                          </tr>
                      </thead>
                      <tbody> 
                          <tr>
                              <td class="text-center">5824</td>
                              <td>Muhammad Saleem Atif</td>
                              <td>Atif Mushtaq</td>
                              <td>03-December-2016</td>
                              <td class="text-center"><img src="<?php echo base_url()?>components/gs_theme/images/ReminderIcon.png" title="Reminder" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="<?php echo base_url()?>components/gs_theme/images/PresenceIcon_active.png" title="Presence" width="20" data-toggle="tooltip" data-placement="top" /> &nbsp; <img src="<?php echo base_url()?>components/gs_theme/images/FollowUpIcon.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" /></td>
                              <td class="text-center"><p>PM</p></td>
                              <td class="actionArea">
                              	<a href="#" class="hoverAction">Action <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="actionItems">
                                    <ul>
                                        <li><a href="#">Print Form</a></li>
                                        <li><a href="#">View and Edit Details</a></li>
                                    </ul><!-- actionIteamsUL-->
                                </div><!-- actionItems -->
                              </td>
                          </tr>
                      </tbody> 
                  </table><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->

<script src="<?php echo base_url()?>components/gs_theme/js/custom.js"></script>
<script src="<?php echo base_url()?>components/gs_theme/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>components/gs_theme/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>components/gs_theme/js/demo-mock.js"></script>
