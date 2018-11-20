<div class="container">
    <!-- Two column layout Start -->
	<div class="row">
    	<div class="col-md-12">
        	<h2 class="withBorderBottom">Batches & Slot details</h2>
        </div><!-- col-md-12 -->
        <div class="col-md-12 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Batch Details</h3>
                <div class="inner paddingLeft20 paddingRight20 paddingBottom30">
                	<div class="col-md-2">&nbsp;</div>
                	<div class="col-md-4">
                        <select required="" class="BiGSelectBox" id="grade_select">
                          <option value="" disabled="" selected="">Select Grade *</option>
                          <?php foreach($grade as $grade_select)  { ?>
                          <option value="<?php echo $grade_select->id ?>"><?php echo $grade_select->name ?></option>
                          <?php } ?>
                        </select>
                    </div><!-- col-md-4 -->
                    <div class="col-md-4">
                        <select required="" class="BiGSelectBox" id="batch_category">
                          <option value="" disabled="" selected="">Select Batch</option>
                        </select>
                        <!-- <a href="#" class="showBatches">Show All Batches</a> -->
                        <!-- <a class="batch_print_link">Print Batch</a> -->
                    </div><!-- col-md-4 -->
                    <div class="col-md-2">&nbsp;</div>
                </div>
                <hr />
                <div class="inner20 paddingLeft20 paddingRight20">
                	<table id="AdmissionFormListing" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" >
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
                      <!-- <div id="batch_detail"></div> -->
<!--                       <tr>
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
                      </tr> -->
                      </tbody>
                    </table><!-- AdmissionFormListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->

