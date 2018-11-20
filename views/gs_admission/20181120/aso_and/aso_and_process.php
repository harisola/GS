<div class="container" id="AndASOProcess">
    <!-- Two column layout Start -->
	<div class="row">
    <div class="col-md-12 no-padding" style="width: 335px; text-align: center; position: absolute; top: 40%; left: 40%; background: rgb(241, 239, 239); border: 1px solid rgb(204, 204, 204); padding: 10px; z-index:99999;display:none" id="Generations_AjaxLoader">
   <img src="http://10.10.10.50/gs//components/image/gsLoader.gif" width="200"><br><hr style="margin: 7px 0;border-top: 1px solid #ccc;"> Please Wait...
   </div>
        <div class="col-md-12 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Applicant List</h3>
                <div class="inner" style="padding:20px !important;">
                	<div class="col-md-6">
                    	<select class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10" id="grade">
                          <option value="" disabled selected>Select Grade *</option>
                          <?php foreach($grade as $grade) { ?>
                          <option value="<?php echo $grade->id ?>"><?php echo $grade->name ?></option>
                          <?php } ?>
                        </select>
                    </div><!-- col-md-6 -->
                    <div class="col-md-6">
                    	<select required class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10" id="batch">
                          <option value="" disabled selected>Select Batch *</option>
                          <!-- <option value="A01">A01 (Tuesday, 17-January-2016)</option>
                          <option value="A02">A02 (Wednesday, 18-January-2016)</option>
                          <option value="A03">A03 (Thursday, 19-January-2016)</option>
                          <option value="A04">A04 (Friday, 20-January-2016)</option>
                          <option value="A05">A05 (Saturday, 21-January-2016)</option>
                          <option value="A06">A06 (Sunday, 22-January-2016)</option>
                          <option value="A07">A07 (Monday, 23-January-2016)</option>
                          <option value="A08">A08 (Tueday, 24-January-2016)</option>
                          <option value="A09">A09 (Wednesday, 25-January-2016)</option>
                          <option value="A10">A10 (Thursday, 26-January-2016)</option> -->

                        </select>
                    </div><!-- col-md-6 -->
                </div><!-- inner -->
                <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">
                	<ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab"  href="#BatchFilterApp">Batch <strong><span id="batch_name"></span></strong> applicants <span id="batch_count"></span></a></li>
                        <li class="BatchFilterHidden"><a data-toggle="tab" id="BatchFilter" href="#AllApplicantTab">All Applicants for grade <strong><span id='selected_grade'></span></strong> <span id="grade_count"></span></a></li>
					</ul><!-- nav-tabs -->
                    <div class="tab-content">
                        <div id="BatchFilterApp" class="tab-pane fade in active">
                         <?php /* ?>
                        	<div class="modal fade in TimeLineModal" id="myModal" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                 
                                  <div class="modal-content">
                                  
                                    <div class="modal-header">
                                      <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Applicant Details</h4>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="col-md-12" style="">
                                            <div class="MaroonBorderBox">
                                                <div class="inner" style="padding-bottom:0;padding-top:0;">
                                                    <div class="col-md-3" style="background: #e9f9fb;border-right: 2px solid #54bbc7;">
                                                        <div class="col-md-12">
                                                            <h4 class="text-center">Assessment</h4>
                                                            <h6>Result</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Select Grade *</option>
                                                                  <option value="">A+</option>
                                                                  <option value="">A</option>
                                                                  <option value="">A-</option>
                                                                  <option value="">B</option>
                                                                  <option value="">C</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <h6>Decision</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="ASTD">
                                                                  <option value="" disabled selected>Decision *</option>
                                                                  <option value="CFD">CFD</option>
                                                                  <option value="">RGT</option>
                                                                  <option value="WIL">WIL</option>
                                                                  <option value="">OHD</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfCFD displayNone">
                                                                <input type="date" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfCFD displayNone" >
                                                                <input type="time" />
                                                            </div><!-- col-md-6 --><!-- If CFD Show-->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfWIL displayNone">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Grade *</option>
                                                                  <option value="">1.0</option>
                                                                  <option value="">1.1</option>
                                                                  <option value="">1.2</option>
                                                                  <option value="">1.3</option>
                                                                </select>
                                                            </div><!-- col-md-6 If WIL Show -->
                                                            <div class="col-md-12" style="padding-bottom:20px;">
                                                                <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12 paddingBottom20">
                                                                <input type="submit" class="greenBTN" value="Submit" />
                                                            </div><!-- col-md-12 -->
                                                        </div><!-- col-md-12 -->
                                                        <hr />
                                                        <div class="col-md-12">
                                                            <h4 class="text-center">Discussion</h4>
                                                            <h6>Result</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Select Grade *</option>
                                                                  <option value="">A+</option>
                                                                  <option value="">A</option>
                                                                  <option value="">A-</option>
                                                                  <option value="">B</option>
                                                                  <option value="">C</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <h6>Decision</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="DECD">
                                                                  <option value="" disabled selected>Decision *</option>
                                                                  <option value="OFR">OFR</option>
                                                                  <option value="">RGT</option>
                                                                  <option value="WIL">WTL</option>
                                                                  <option value="">OHD</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfOFR displayNone">
                                                                <input type="date" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfOFR displayNone">
                                                                <input type="time" />
                                                            </div><!-- col-md-6 --><!-- If OFR Show-->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfWILD displayNone">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Grade *</option>
                                                                  <option value="">1.0</option>
                                                                  <option value="">1.1</option>
                                                                  <option value="">1.2</option>
                                                                  <option value="">1.3</option>
                                                                </select>
                                                            </div><!-- col-md-6 If WIL Show -->
                                                            <div class="col-md-12" style="padding-bottom:20px;">
                                                                <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12" style="padding-bottom:20px;">
                                                                <input type="submit" class="greenBTN" value="Submit" />
                                                            </div><!-- col-md-12 -->
                                                        </div><!-- col-md-12 -->
                                                        <?php */ ?>
                                                        <?php /* ?>
                                                        <hr />
                                                        <div class="col-md-12">
                                                            <h4>Decision</h4>
                                                            <div class="col-md-6 paddingBottom20">
                                                                <select required id="DECStatus">
                                                                  <option value="" disabled selected>Decision *</option>
                                                                  <option value="RGT">Regret</option>
                                                                  <option value="WIL">Wait List</option>
                                                                  <option value="OHD">On Hold</option>
                                                                  <option value="OFD">Offer</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 displayNone IfWIL">
                                                                <select required id="DECStatus">
                                                                  <option value="" disabled selected>Grade *</option>
                                                                  <option value="">A</option>
                                                                  <option value="">A+</option>
                                                                  <option value="">A-</option>
                                                                  <option value="">B</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                                <input type="date" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                                <input type="time" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-12 paddingBottom20">
                                                                <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12 paddingBottom20 text-left">
                                                                <input type="checkbox" id="c2" name="">
                                                                <label for="c2">Approved by Dr. Ghazala Siddiqui</label>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12 paddingBottom20">
                                                                <input type="submit" class="greenBTN" value="Submit" />
                                                            </div><!-- col-md-12 -->
                                                        </div><!-- col-md-12 -->
                                                        
                                                    </div><!-- col-md-3 -->

                                                    <div class="col-md-9">
                                                        <div class="TimelineReview">
                                                        <ul>
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                        </ul>
                                                    </div><!-- Timeline -->
                                                    </div><!-- col-md-9 -->
                                                </div><!-- inner -->
                                            </div><!-- .MaroonBorderBox -->
                                        </div><!-- col-md-12 -->
                                    </div><!-- modal-body -->

                                  
                                    <div class="modal-footer">
                                      <div class="TimelineAddForm">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h4>Assessment Result</h4>
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                              <option value="" disabled selected>Select Grade *</option>
                                                              <option value="">A+</option>
                                                              <option value="">A</option>
                                                              <option value="">A-</option>
                                                              <option value="">B</option>
                                                              <option value="">C</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                                      <option value="" disabled selected>By *</option>
                                                                      <option value="">Ms. Haya Nawab</option>
                                                                      <option value="">Ms. Anum Anwar</option>
                                                                      <option value="">Ms. Yusra Kaiser</option>
                                                                    </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <input type="submit" class="greenBTN" value="Submit" />
                                                        </div><!-- col-md-12 -->
                                                    </div><!-- col-md-4 -->
                                                    <div class="col-md-4">
                                                        <h4>Discussion Result</h4>
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                              <option value="" disabled selected>Select Grade *</option>
                                                              <option value="">A+</option>
                                                              <option value="">A</option>
                                                              <option value="">A-</option>
                                                              <option value="">B</option>
                                                              <option value="">C</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                                      <option value="" disabled selected>By *</option>
                                                                      <option value="">Ms. Haya Nawab</option>
                                                                      <option value="">Ms. Anum Anwar</option>
                                                                      <option value="">Ms. Yusra Kaiser</option>
                                                                    </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <input type="submit" class="greenBTN" value="Submit" />
                                                        </div><!-- col-md-12 -->
                                                    </div><!-- col-md-4 -->
                                                    <div class="col-md-4">
                                                        <h4>Decision</h4>
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="DECStatus">
                                                              <option value="" disabled selected>Decision *</option>
                                                              <option value="RGT">Regret</option>
                                                              <option value="WIL">Wait List</option>
                                                              <option value="OHD">On Hold</option>
                                                              <option value="OFD">Offer</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                                      <option value="" disabled selected>By *</option>
                                                                      <option value="">Ms. Haya Nawab</option>
                                                                      <option value="">Ms. Anum Anwar</option>
                                                                      <option value="">Ms. Yusra Kaiser</option>
                                                                    </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20 displayNone IfWIL">
                                                            <select required id="DECStatus">
                                                              <option value="" disabled selected>Grade *</option>
                                                              <option value="">A</option>
                                                              <option value="">A+</option>
                                                              <option value="">A-</option>
                                                              <option value="">B</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                            <input type="date" />
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                            <input type="time" />
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20 text-left">
                                                            <input type="checkbox" id="c2" name="">
                                                            <label for="c2">Approved by Dr. Ghazala Siddiqui</label>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <input type="submit" class="greenBTN" value="Submit" />
                                                        </div><!-- col-md-12 -->
                                                    </div><!-- col-md-4 -->
                                                    
                                                </div><!-- row -->
                                            </form>
                                        </div><!-- TimelineAddForm -->
                                    </div><!-- modal-footer -->
                                    
                                  </div><!-- modal-content -->
                                  
                                  
                                </div><!-- modal-dialog -->
                            </div><!-- modal -->
                            <?php */ ?>
                            <div class="modal fade in TimeLineModal" id="myModal4" role="dialog">
                                <div class="modal-dialog">
                                
                                  <!-- Modal content-->
                                  <div class="modal-content">
<!--                                     <div class="modal-header">
                                      <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                                      <h4 class="modal-title">Applicant Details</h4>
                                    </div> -->
                                    <div class="assessment_discussion"></div>
                                    <?php /* ?>
                                    <div class="modal-body">
                                        <div class="col-md-12" style="">
                                            <div class="MaroonBorderBox">
                                                <div class="inner" style="padding-bottom:0;padding-top:0;">
                                                    <div class="col-md-3" style="background: #e9f9fb;border-right: 2px solid #54bbc7;">
                                                        <div class="col-md-12">
                                                            <h4 class="text-center">Assessment</h4>
                                                            <h6>Result</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Select Grade *</option>
                                                                  <option value="">A+</option>
                                                                  <option value="">A</option>
                                                                  <option value="">A-</option>
                                                                  <option value="">B</option>
                                                                  <option value="">C</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-12" style="padding-bottom:20px;">
                                                                <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12 paddingBottom20">
                                                                <input type="submit" class="greenBTN" value="Submit" />
                                                            </div><!-- col-md-12 -->
                                                        </div><!-- col-md-12 -->
                                                        <hr />
                                                        <div class="col-md-12">
                                                            <h4 class="text-center">Discussion</h4>
                                                            <h6>Result</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Select Grade *</option>
                                                                  <option value="">A+</option>
                                                                  <option value="">A</option>
                                                                  <option value="">A-</option>
                                                                  <option value="">B</option>
                                                                  <option value="">C</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <h6>Decision</h6>
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="DECD">
                                                                  <option value="" disabled selected>Decision *</option>
                                                                  <option value="OFR">OFR</option>
                                                                  <option value="">RGT</option>
                                                                  <option value="WIL">WTL</option>
                                                                  <option value="">OHD</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfOFR displayNone">
                                                                <input type="date" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfOFR displayNone">
                                                                <input type="time" />
                                                            </div><!-- col-md-6 --><!-- If OFR Show-->
                                                            <div class="col-md-6 paddingBottom20 no-padding IfWILD displayNone">
                                                                <select required id="">
                                                                  <option value="" disabled selected>Grade *</option>
                                                                  <option value="">1.0</option>
                                                                  <option value="">1.1</option>
                                                                  <option value="">1.2</option>
                                                                  <option value="">1.3</option>
                                                                </select>
                                                            </div><!-- col-md-6 If WIL Show -->
                                                            <div class="col-md-12" style="padding-bottom:20px;">
                                                                <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12" style="padding-bottom:20px;">
                                                                <input type="submit" class="greenBTN" value="Submit" />
                                                            </div><!-- col-md-12 -->
                                                        </div><!-- col-md-12 -->
                                                        <?php /* ?>
                                                        <hr />
                                                        <div class="col-md-12">
                                                            <h4>Decision</h4>
                                                            <div class="col-md-6 paddingBottom20">
                                                                <select required id="DECStatus">
                                                                  <option value="" disabled selected>Decision *</option>
                                                                  <option value="RGT">Regret</option>
                                                                  <option value="WIL">Wait List</option>
                                                                  <option value="OHD">On Hold</option>
                                                                  <option value="OFD">Offer</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20">
                                                                <select required id="">
                                                                          <option value="" disabled selected>By *</option>
                                                                          <option value="">Ms. Haya Nawab</option>
                                                                          <option value="">Ms. Anum Anwar</option>
                                                                          <option value="">Ms. Yusra Kaiser</option>
                                                                        </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 displayNone IfWIL">
                                                                <select required id="DECStatus">
                                                                  <option value="" disabled selected>Grade *</option>
                                                                  <option value="">A</option>
                                                                  <option value="">A+</option>
                                                                  <option value="">A-</option>
                                                                  <option value="">B</option>
                                                                </select>
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                                <input type="date" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                                <input type="time" />
                                                            </div><!-- col-md-6 -->
                                                            <div class="col-md-12 paddingBottom20">
                                                                <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12 paddingBottom20 text-left">
                                                                <input type="checkbox" id="c2" name="">
                                                                <label for="c2">Approved by Dr. Ghazala Siddiqui</label>
                                                            </div><!-- col-md-12 -->
                                                            <div class="col-md-12 paddingBottom20">
                                                                <input type="submit" class="greenBTN" value="Submit" />
                                                            </div><!-- col-md-12 -->
                                                        </div><!-- col-md-12 -->
                                                       
                                                    </div><!-- col-md-3 -->
                                                    <div class="col-md-9">
                                                        <div class="TimelineReview">
                                                        <ul>
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                            <li class="adminResponse">
                                                                <p>Admission form issued on 25-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="adminResponse">
                                                                <p>Submission date has been expired on 30-November-2016</p>
                                                            </li><!-- adminResponse -->
                                                            <li class="in">
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadLeft">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                            </li><!-- in -->
                                                            <li class="out">
                                                                <div class="systemResponse col-md-10">
                                                                    <span class="arrowHeadRight">&nbsp;</span>
                                                                    <p><strong>Extension</strong> for form submission on <strong>02-Dec-2016</strong><br /><small>Lorem Ipsum dolor sit amet Lorem Ipsum dolor sit amet</small></p>
                                                                    <span class="commentDate">30-Nov-2016</span><!-- commentDate -->
                                                                </div><!-- systemResponse -->
                                                                <div class="avatarLeft col-md-2">
                                                                    <img src="<?php echo base_url() ?>components/gs_theme/images/991.jpg" />
                                                                </div><!-- avatarLeft -->
                                                            </li><!-- out -->
                                                        </ul>
                                                    </div><!-- Timeline -->
                                                    </div><!-- col-md-9 -->
                                                </div><!-- inner -->
                                            </div><!-- .MaroonBorderBox -->
                                        </div><!-- col-md-12 -->
                                    </div><!-- modal-body -->
                                    <?php */ ?>
                                    <?php /* ?>
                                    <div class="modal-footer">
                                      <div class="TimelineAddForm">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h4>Assessment Result</h4>
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                              <option value="" disabled selected>Select Grade *</option>
                                                              <option value="">A+</option>
                                                              <option value="">A</option>
                                                              <option value="">A-</option>
                                                              <option value="">B</option>
                                                              <option value="">C</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                                      <option value="" disabled selected>By *</option>
                                                                      <option value="">Ms. Haya Nawab</option>
                                                                      <option value="">Ms. Anum Anwar</option>
                                                                      <option value="">Ms. Yusra Kaiser</option>
                                                                    </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <input type="submit" class="greenBTN" value="Submit" />
                                                        </div><!-- col-md-12 -->
                                                    </div><!-- col-md-4 -->
                                                    <div class="col-md-4">
                                                        <h4>Discussion Result</h4>
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                              <option value="" disabled selected>Select Grade *</option>
                                                              <option value="">A+</option>
                                                              <option value="">A</option>
                                                              <option value="">A-</option>
                                                              <option value="">B</option>
                                                              <option value="">C</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                                      <option value="" disabled selected>By *</option>
                                                                      <option value="">Ms. Haya Nawab</option>
                                                                      <option value="">Ms. Anum Anwar</option>
                                                                      <option value="">Ms. Yusra Kaiser</option>
                                                                    </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <input type="submit" class="greenBTN" value="Submit" />
                                                        </div><!-- col-md-12 -->
                                                    </div><!-- col-md-4 -->
                                                    <div class="col-md-4">
                                                        <h4>Decision</h4>
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="DECStatus">
                                                              <option value="" disabled selected>Decision *</option>
                                                              <option value="RGT">Regret</option>
                                                              <option value="WIL">Wait List</option>
                                                              <option value="OHD">On Hold</option>
                                                              <option value="OFD">Offer</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20">
                                                            <select required id="">
                                                                      <option value="" disabled selected>By *</option>
                                                                      <option value="">Ms. Haya Nawab</option>
                                                                      <option value="">Ms. Anum Anwar</option>
                                                                      <option value="">Ms. Yusra Kaiser</option>
                                                                    </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20 displayNone IfWIL">
                                                            <select required id="DECStatus">
                                                              <option value="" disabled selected>Grade *</option>
                                                              <option value="">A</option>
                                                              <option value="">A+</option>
                                                              <option value="">A-</option>
                                                              <option value="">B</option>
                                                            </select>
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                            <input type="date" />
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-6 paddingBottom20 displayNone IfOFD">
                                                            <input type="time" />
                                                        </div><!-- col-md-6 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <textarea placeholder="Comments" rows="4" cols="50"></textarea>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20 text-left">
                                                            <input type="checkbox" id="c2" name="">
                                                            <label for="c2">Approved by Dr. Ghazala Siddiqui</label>
                                                        </div><!-- col-md-12 -->
                                                        <div class="col-md-12 paddingBottom20">
                                                            <input type="submit" class="greenBTN" value="Submit" />
                                                        </div><!-- col-md-12 -->
                                                    </div><!-- col-md-4 -->
                                                    
                                                </div><!-- row -->
                                            </form>
                                        </div><!-- TimelineAddForm -->
                                    </div><!-- modal-footer -->
                                    <?php */ ?>
                                  </div><!-- modal-content -->
                                  
                                </div><!-- modal-dialog -->
                            </div><!-- modal -->
                            <div id='aso_and_data'></div>
                            <?php /* ?>
                            <table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr>
                                      <th class="no-sort" width="2%"><input type="checkbox" id="selectAll" class="normal" /></th> 
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="" class="no-sort">Applicant Name<br /><small>Father Name</small></th> 
                                      <th width="" class="text-center no-sort">AST Appointment<br /><div class="col-md-6 no-padding"><small>AST Done on</small></div><div class="col-md-6 no-padding text-right"><small>AST by</small></div></th>
                                      <th width="" class="text-left no-sort">AST Result<br /><div class="col-md-12 no-padding text-right">AST Decision</div></th>
                                      <th width="" class="text-center no-sort">DIS Appointment<br /><div class="col-md-6 no-padding"><small>DIS Done on</small></div><div class="col-md-6 no-padding text-right"><small>DIS by</small></div></th>
                                      <th width="" class="text-left no-sort">DIS Result<br /><div class="col-md-12 no-padding text-right">DIS Decision</div></th>
                                      <!-- <th width="" class="text-center">Decision</th> -->
                                      <th width="" class="text-left no-sort">Offer Date<br /><small>Time</small></th>
                                      <th width="" class="text-center no-sort">Action</th>
                                  </tr>
                              </thead>
                              
                              
                              <tbody> 
                                  <tr>
                                      <td><input type="checkbox" id="" class="normal" /></td>
                                      <td class="text-center">5811</td>
                                      <td>Abdul Ahad Abdullah<br /><small>Abdullah Karwa</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <!-- 
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                        -->
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">-</div>
                                        <!-- 
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                         -->
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true" id="img_presence"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal4" id="view_and_edit">View & Edit</a><br /><br /><a href="javascript:void(0)" id="mark_present">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="2" class="normal" /></td>
                                      <td class="text-center">5812</td>
                                      <td>Ghanzanfar Shams<br /><small>Shams Mahmood</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="3" class="normal" /></td>
                                      <td class="text-center">5813</td>
                                      <td>Hasham Chandio<br /><small>Ali Chandio</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="4" class="normal" /></td>
                                      <td class="text-center">5814</td>
                                      <td>Hassam Ahmed<br /><small>Ahmed Qureshi</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="5" class="normal" /></td>
                                      <td class="text-center">5815</td>
                                      <td>Hassan Siddiqui<br /><small>Saleem Siddiqui</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
        
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="<?php echo base_url() ?>components/gs_theme/images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="6" class="normal" /></td>
                                      <td class="text-center">5816</td>
                                      <td>Bisma Ghouri<br /><small>Feroze Ghouri</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="7" class="normal" /></td>
                                      <td class="text-center">5817</td>
                                      <td>Janzil Junaid<br /><small>Junaid Amin</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="8" class="normal" /></td>
                                      <td class="text-center">5818</td>
                                      <td>Hashir Mahmood<br /><small>Mahmood Arshi</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  <tr>
                                      <td class="text-center"><input type="checkbox" id="9" class="normal" /></td>
                                      <td class="text-center">5819</td>
                                      <td>Yahya Omer<br /><small>Omer Bafatia</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      <td class="text-center"><small><a href="#" data-toggle="modal" data-target="#myModal">View & Edit</a><br /><br /><a href="#">Mark as Present</a></small></td>
                                  </tr>
                                  
                              </tbody> 
                              
                            </table><!-- StaffListing -->
                            
                            <div class="col-md-6 absoluteDiv">
                                <div class="col-md-6 no-padding">
                                    <select required class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10">
                                      <option value="" disabled selected>Select Action *</option>
                                      <option value="A01">Offer Approve</option>
                                      <option value="A02">Move to Regret</option>
                                      <option value="A03">Move to Wait List</option>
                                      <option value="A04">Move to Hold</option>
                                    </select>    	
                                </div><!-- col-md-6 -->
                                <div class="col-md-3">
                                    <input type="submit" class="greenBTN btn" value="Apply" />
                                </div><!-- col-md-6 -->
                            </div>
                            <?php  */ ?>
                        </div><!--BatchFilterApp -->
                        <div id="AllApplicantTab" class="tab-pane fade">
                        <div class ="grade_aso_and"></div>

                        	<?php /* ?><div class="col-md-4 absoluteDiv2">
                                <div class="col-md-8 no-padding">
                                    <select required class="paddingBottom10 paddingLeft10 paddingRight10 paddingTop10">
                                      <option value="" disabled selected>Select Filter *</option>
                                      <option value="">CFD</option>
                                      <option value="">OFR</option>
                                      <option value="">RGT</option>
                                      <option value="">WIL</option>
                                      <option value="">OHD</option>
                                    </select>    	
                                </div><!-- col-md-6 -->
                                <div class="col-md-4">
                                    <input type="submit" class="greenBTN btn" value="Apply" />
                                </div><!-- col-md-6 -->
                            </div><!-- absoluteDiv2 --> <?php  */?>
                        	<?php /* <table id="AdmissionFormListinggs" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                              <thead> 
                                  <tr>
                                      <th width="" class="text-center">Form #</th> 
                                      <th width="" class="no-sort">Applicant Name<br /><small>Father Name</small></th> 
                                      <th width="" class="text-center no-sort">AST Appointment<br /><div class="col-md-6 no-padding"><small>AST Done on</small></div><div class="col-md-6 no-padding text-right"><small>AST by</small></div></th>
                                      <th width="" class="text-left no-sort">AST Result<br /><div class="col-md-12 no-padding text-right">AST Decision</div></th>
                                      <th width="" class="text-center no-sort">DIS Appointment<br /><div class="col-md-6 no-padding"><small>DIS Done on</small></div><div class="col-md-6 no-padding text-right"><small>DIS by</small></div></th>
                                      <th width="" class="text-left no-sort">DIS Result<br /><div class="col-md-12 no-padding text-right">DIS Decision</div></th>
                                      <!-- <th width="" class="text-center">Decision</th> -->
                                      <th width="" class="text-left no-sort">Offer Date<br /><small>Time</small></th>
                                  </tr>
                              </thead>
                              <tbody> 
                                  <tr>
                                      <td class="text-center">5811</td>
                                      <td>Abdul Ahad Abdullah<br /><small>Abdullah Karwa</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <!-- 
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                        -->
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">-</div>
                                        <!-- 
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                         -->
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5812</td>
                                      <td>Ghanzanfar Shams<br /><small>Shams Mahmood</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5813</td>
                                      <td>Hasham Chandio<br /><small>Ali Chandio</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5814</td>
                                      <td>Hassam Ahmed<br /><small>Ahmed Qureshi</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5815</td>
                                      <td>Hassan Siddiqui<br /><small>Saleem Siddiqui</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
        
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5816</td>
                                      <td>Bisma Ghouri<br /><small>Feroze Ghouri</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5817</td>
                                      <td>Janzil Junaid<br /><small>Junaid Amin</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                        </div>
                                    </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5818</td>
                                      <td>Hashir Mahmood<br /><small>Mahmood Arshi</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  <tr>
                                      <td class="text-center">5819</td>
                                      <td>Yahya Omer<br /><small>Omer Bafatia</small></td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">CFD</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-center">
                                        <strong>Fri 12 Jan @ 09:30</strong><br />
                                        <div class="col-md-6 no-padding text-left"><small>Tue 18 Jan</small></div>
                                        <div class="col-md-6 no-padding text-right"><small>ERA</small></div>
                                        <div class="text-center">
                                            <hr class="lowMargin" />
                                            <img src="images/ReminderIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Reminder" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/PresenceIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Presence" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/FollowUpIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Followup" data-pin-nopin="true">
                                        </div>
                                      </td>
                                      <td class="text-left">
                                        <div class="col-md-12 text-left">A-</div>
                                        <div class="col-md-12 text-right">OFR</div>
                                        <div class="text-center no-padding">
                                            <hr class="lowMargin" />
                                            <img src="images/result_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Result" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/discussion_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Decision" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/AllocationIcon_active.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Allocation" data-pin-nopin="true"> &nbsp; 
                                            <img src="images/CommunicationIcon.png" title="" width="20" data-toggle="tooltip" data-placement="top" data-original-title="Communication" data-pin-nopin="true">
                                         </div>
                                      </td>
                                      <td class="text-left">Approval Pending</td>
                                      
                                  </tr>
                                  
                              </tbody> 
                            </table><!-- AdmissionFormListinggs -->
                            <?php */ ?>
                        </div><!-- AllApplicantTab -->
                	
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->

</div><!-- container -->

<script>
var ASTD = jQuery('#ASTD');
var select = this.value;
ASTD.change(function () {
    if ($(this).val() == 'CFD') {
        $('.IfCFD').show();
    }
    else $('.IfCFD').hide();
});
ASTD.change(function () {
    if ($(this).val() == 'WIL') {
        $('.IfWIL').show();
    }
    else $('.IfWIL').hide();
});

var DECD = jQuery('#DECD');
var select = this.value;
DECD.change(function () {
    if ($(this).val() == 'OFR') {
        $('.IfOFR').show();
    }
    else $('.IfOFR').hide();
});
DECD.change(function () {
    if ($(this).val() == 'WIL') {
        $('.IfWILD').show();
    }
    else $('.IfWILD').hide();
});

$('#selectAll').click(function (e) {
    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
});
</script>


