<div class="container">
    <!-- Two column layout Start -->
	<div class="row">
    	<div class="col-md-12">
        	<h2 class="withBorderBottom">Batch Setup</h2>
        </div><!-- col-md-12 -->
    	<div class="col-md-4" style="">
        	<div class="MaroonBorderBox">
        		<h3>Setup a Batch</h3>
                <div class="inner">
                <form action="" method="POST" id="batchDetail">
                	<div class="col-md-12">
                        <div class="col-md-4 text-right"><label class="FormNo">Select Grade</label> </div>
                        <div class="col-md-8">
                            <select  name='grade' id='grade'>
                              <option value="" disabled selected>Grade *</option>
                              <option value="1">PN</option>
                              <option value="2">N</option>
                              <option value="3">KG</option>
                              <option value="4">I</option>
                              <option value="5">II</option>
                              <option value="6">III</option>
                              <option value="7">IV</option>
                              <option value="8">V</option>
                              <option value="9">VI</option>
                              <option value="10">VII</option>
                              <option value="11">VIII</option>
                              <option value="12">IX</option>
                              <option value="13">X</option>
                              <option value="14">XI</option>
<!--                               <option value="15">A1</option>
                              <option value="16">A2</option> -->
                              <option value="17">PG</option>
                            </select>
                        </div>
                    </div><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-4 text-right"><label class="FormNo">Batch ID *</label> </div>
                        <div class="col-md-8">
                            <input type="text" id="batch_name" placeholder="Batch name *"  disabled="disabled"   />
                            <input type="hidden" id="batch_name_hidden" name="batch_name" /> 
                        </div>
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-4 text-right"><label class="FormNo">Date *</label> </div>
                        <div class="col-md-8">
                            <input type="date" name="date" id="date"/>
                        </div>
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-4 text-right"><label class="FormNo">Start Time *</label> </div>
                        <div class="col-md-8">
                            <input type="time" name="start_time" id="start_time" />
                        </div>
                    </div><!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-4 text-right"><label class="FormNo">End Time *</label> </div>
                        <div class="col-md-8">
                            <input type="time"  name="end_time" id="end_time"/>
                        </div>
                    </div>
                    <!-- col-md-12 -->
                    <div class="col-md-12 paddingBottom20">
                        <div class="col-md-4 text-right"><label class="FormNo">No of Slots *</label> </div>
                        <div class="col-md-8">
                            <select  name='no_of_slots' id='no_of_slots'>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10">10</option>
                              <option value="11">11</option>
                              <option value="12">12</option>
                              <option value="13">13</option>
                              <option value="14">14</option>
                              <option value="15" selected="selected">15</option>                              
                            </select>
                        </div>
                     </div> <!-- col-md-12 -->
                    <!-- <div class="col-md-12 paddingBottom20"> -->
                       <!--  <div class="col-md-4 text-right"><label class="">Duration<br />per Slot *</label> </div> -->
                        <!-- <div class="col-md-8"> -->
                            <input type="hidden" id="duration_per_slot" placeholder="Numbers only"  name="duration_per_slot" value="15"/>
                        <!-- </div>
 -->                    <!-- </div> --><!-- col-md-12 -->
                    <hr />
                    <div class="col-md-12">
                    	<input type="submit" class="greenBTN" value="Add a Batch" />
                    </div><!-- col-md-12 -->
                    </form>
                </div><!-- inner -->
            </div><!-- .MaroonBorderBox -->
        </div><!-- col-md-4 -->
        <div class="col-md-8 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Batches Laucnhed</h3>
                <div class="inner20 paddingLeft20 paddingRight20">
                	<div class="modal fade in" id="myModal" role="dialog">
                        <div class="modal-dialog">
                          <div class='get'></div>
                          <!-- Modal content-->
                          <?php /*
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Batch Details - <strong>A01</strong> <span class="pull-right">05/15</span></h4>
                            </div>
                            <div class="modal-body">
                            <div class='get'></div>
                               <p>
                                <table id="BatchListingList" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" >
                                  <thead>
                                  <tr>
                                    <th class="valignMiddle">Slot</th>
                                    <th class="valignMiddle">Default Appointment</th>
                                    <th class="valignMiddle text-center">Form #</th>
                                    <th class="">Applicant Name</th>
                                    <th class="text-center">Revised Batch</th>
                                    <th class="text-center">Revised Appointment</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td>A01-01</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>9:00</strong></td>
                                    <td class="text-center">1212</td>
                                    <td class="">Noman Sohail</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-02</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>9:15</strong></td>
                                    <td class="text-center">1213</td>
                                    <td class="">Saleem Qureshi</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-03</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>9:30</strong></td>
                                    <td class="text-center">1214</td>
                                    <td class="">Aisha Aqeel</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-04</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>9:45</strong></td>
                                    <td class="text-center">1215</td>
                                    <td class="">Anum Anwar</td>
                                    <td class="text-center">A08-15</td>
                                    <td class="text-center">Fri, 21-Jan-2016 @ <strong>12:15</strong></td>
                                  </tr>
                                  <tr>
                                    <td>A01-05</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>10:00</strong></td>
                                    <td class="text-center">1216</td>
                                    <td class="">Yusra Kaiser</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-06</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>10:15</strong></td>
                                    <td class="text-center">1217</td>
                                    <td class="">Ahmed Bilal</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-07</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>10:30</strong></td>
                                    <td class="text-center">1218</td>
                                    <td class="">Abid Ansari</td>
                                    <td class="text-center">A10-06</td>
                                    <td class="text-center">Thursday, 02-Feb-2016 @ <strong>10:15</strong></td>
                                  </tr>
                                  <tr>
                                    <td>A01-08</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>10:45</strong></td>
                                    <td class="text-center">1219</td>
                                    <td class="">Kamran Sualeh</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-09</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>11:00</strong></td>
                                    <td class="text-center">1220</td>
                                    <td class="">Aijaz Ahmed</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-10</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>11:15</strong></td>
                                    <td class="text-center">1221</td>
                                    <td class="">Jafar Khan</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-11</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>11:30</strong></td>
                                    <td class="text-center">-</td>
                                    <td class="">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-12</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>11:45</strong></td>
                                    <td class="text-center">-</td>
                                    <td class="">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-13</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>12:00</strong></td>
                                    <td class="text-center">-</td>
                                    <td class="">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-14</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>12:15</strong></td>
                                    <td class="text-center">-</td>
                                    <td class="">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  <tr>
                                    <td>A01-15</td>
                                    <td>Saturday, 13-Jan-2016 @ <strong>12:30</strong></td>
                                    <td class="text-center">-</td>
                                    <td class="">-</td>
                                    <td class="text-center">-</td>
                                    <td class="text-center">-</td>
                                  </tr>
                                  </tbody>
                                </table>
    
                              </p>
                              
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                           </div><!-- modal-content -->
                           <?php */ ?>
                          
                        </div><!-- modal-dialog -->
                    </div><!-- modal -->

                	<table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th width="" class="text-center"><strong>Grade</strong></th> 
                              <th width=""><strong>Batch ID</strong></th> 
                              <th width=""><strong>Batch Date</strong></th>
                              <th width="" class="text-center"><strong>Start Time</strong></th> 
                              <th width="" class="text-center"><strong>End Time</strong></th>
                              <th width="" class="text-center"><strong>No Of slots</strong></th>
                              <th width="" class="text-center"><strong>Duration<br />per slot</strong></th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach($batch_available as $form_batch) { ?>
                          <?php if($form_batch->grade_id != 15 and $form_batch->grade_id != 16 ) { ?>
                          <tr>
                              <td class="text-center"><?php echo $form_batch->grade_name ?></td>
                              <td><a href="#" data-toggle="modal" data-target="#myModal" class="batch_category_detail" data-id="<?php echo $form_batch->batch_category?>"><?php echo $form_batch->batch_category ?></a></td>
                              <td><?php echo $form_batch->batch_date ?></td>
                              <td class="text-center"><?php echo $form_batch->time_start ?></td>
                              <td class="text-center"><?php echo $form_batch->time_end ?></td>
                              <td class="text-center" id="slots"><?php echo $form_batch->no_of_slots ?></td>
                              <td class="actionArea text-center">
                              	<?php echo $form_batch->duration_per_slot ?>
                              </td>
                          </tr>
                          <?php } ?>
                        <?php } ?>
                      </tbody> 
                  </table><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-8 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->