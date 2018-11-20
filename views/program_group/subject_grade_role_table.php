<?php /*
<div class='row'>
	<div class='col-md-12'>
		<div class='powerwidget dark-blue'>
			    <header>
    				<h6 style="color:#fff;margin-left:20px;font-size:18px;padding-top: 6px"> Class Level | Roles </h6>
   				</header>
   				<div class='inner-spacer'>
   				<div class="callout callout-info" id='sucess-role' style="display: none">
                  <h4>Data Update And Insert Successfully</h4>
                </div>

                	<!-- =================== -->
                	<!-- Class Teacher Start -->
                	<!-- =================== -->

   					<form action='' class='orb-form' method="POST" id='role-teacher'>
   						<div class='col-md-4'>
   						<table class="table table-condensed table-bordered table-striped table-hover" >
   						<thead>
                    	<tr>
	                      <th>Class Teacher</th>
	                      <th style="width:17%">Code</th>
	                      <th>Section</th>
	                      <th style="width:31%;">Block per Week</th>
                    	</tr>
                 		</thead>
                 		
                 		<tbody>
                 			<?php $counter = 0; ?>
                 			<?php if(!empty($class_teacher)) { ?>
                 				<?php foreach($class_teacher as $value) {?>
                 				<tr>
                 				<td><?php echo $value->staff_name; ?><input type='hidden' name ='class_teacher[]' value='<?php echo $value->type_name ?>' >
                 				<input type="hidden" name='class_teacher_staff_id[]' value="<?php echo $value->staff_id ?>" >
                 				<input type="hidden" name='academic_session_id[]' value="<?php echo $value->academic_session_id ?>" >
                 				</td>
                 				<td><?php echo $value->grade_name."-"."CLTR"; ?><input type='hidden' name='grade_id[]' value="<?php echo $value->grade_id; ?>"></td>
                 				<td><?php echo $value->section_name; ?><input type="hidden" name='section_id[]' value="<?php echo $value->section_id ?>"></td>
                 				<td>
                 					
                 					<?php if(!empty($block_select)) { ?>
                 						
                 					<select name='class_teacher_block[]'>
                 						<option value="<?php echo $block_select[$counter]->blocks_per_week ?>"><?php echo $block_select[$counter]->blocks_per_week; ?></option>
                  						<option value="1" >1</option>
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
                 						<option value="15">15</option>
                 					</select>
                 						
                 					<?php } else { ?>

                 					<select name='class_teacher_block[]'>
                 						<option value="1" >1</option>
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
                 						<option value="15">15</option>
                 					</select>	
                 					<?php } ?>	
                 					<?php $counter++; ?>
                 				</td>
                 				</tr>
                 			<?php } ?>
                 			<?php }?>
                 			
                 		</tbody>

   						</table>
   						</div>
   									<!-- =================== -->
   									<!--  Class Teacher End  -->
   									<!-- =================== -->

   									<!-- ======================= -->
   									<!--   CO Teacher Start      -->
   									<!-- ======================= -->
   						<div class='col-md-4'>
   							<table class='table table-condensed table-bordered table-striped table-hover' >
   								<thead>
   									<tr>
   										<th>Co Teacher</th>
	                     				<th>Code</th>
	                      				<th>Section</th>
	                      				<th style="width: 32%">Block per Week</th>
   									</tr>
   								</thead>
   								<tbody>
   									<?php $counter = 0; ?>
									<?php if(!empty($co_teacher)) {?>
										<?php foreach($co_teacher as $value) {?>
										<tr>
											<td><?php echo $value->staff_name; ?><input type="hidden" name='co_teacher[]' value=" <?php echo $value->type_name ?>"/>
											<input type="hidden" name='Co_teacher_staff_id[]' value="<?php echo $value->staff_id ?>" >
                 							<input type="hidden" name='co_academic_session_id[]' value="<?php echo $value->academic_session_id ?>" ></td>
                 							<td><?php echo $value->grade_name."-"."COTR"; ?></td>
                 							<td><?php echo $value->section_name; ?></td>

                 							<td>
                 								<?php if(!empty($block_select_co)) { ?>
                 							<select name='co_block[]' >
                 								<option value="<?php echo $block_select_co[$counter]->blocks_per_week ?>"><?php echo $block_select_co[$counter]->blocks_per_week; ?></option>

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
		                 						<option value="15">15</option>
                 							</select>
                 							<?php } else { ?>

                 							<select name='co_block[]' >
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
		                 						<option value="15">15</option>
                 							</select>

                 							<?php } ?>

                 							<?php $counter++; ?>

                 							</td>
										</tr>
									<?php } ?>
									<?php } else  {?>
									<tr>
										<td>No Record Found</td>
									</tr>
									<?php } ?>   									
   								</tbody>
   							</table>
   						</div>

   						<!-- ====================== -->
   						<!--    Co Teacher End      -->
   						<!-- ====================== -->


   						<!-- ======================== -->
   						<!-- Reading Teacher Start    -->
   						<!-- ======================== -->

   						<div class='col-md-3'>
   							<table class='table table-condensed table-bordered table-striped table-hover' >
   								<thead>
   									<tr>
   										<th>Reading Teacher</th>
	                     				<th>Code</th>
	                      				<th>Section</th>
	                      				<th>Block Per Week</th>
   									</tr>
   								</thead>
   								<tbody>
								<tr>
									<td>Shazia Ahmed</td>
									<?php if(!empty($value->grade_name)) { ?>
									<td><?php echo $value->grade_name."-"."RDTR"; ?></td>
									<?php } ?>
									<td>1</td>
									<td>
										<select>
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
                 						<option value="15">15</option>
										</select>
									</td>
								</tr>
   								</tbody>
   							</table>
   						</div>
   						<div class='col-md-12' style="margin-top: 20px">
   							<button class='btn btn-primary'>Save and Submit</button>
   						</div>
   					</form>

   				</div>
		</div>
	</div>
</div>
				<!-- =================== -->
				<!-- Reading Teacher End -->
				<!-- =================== -->

<?php */ ?>

				<!-- ***************************-->
				<!-- Start Compulsory Programme -->
				<!-- ************************** -->

<div class='row'>
	<div class='col-md-6'>
		<div class='powerwidget cold-grey'>
			<header>
				<h2>Compulsory Programme</h2>
			</header>
			<div class='inner-spacer'>
		          <div class="callout callout-info " id='callout-update' style="display: none;">
                  <p>Data Updated Successfully</p>
                </div>
			<form action='' id='comp-prog' method="POST">

				<!-- =========================================== -->
				<!-- Start Compulsory Academic Session And Grade -->
				<!-- =========================================== -->

				<input type="hidden" value="<?php echo $academic_id ?>" name='academic_id'/>
				<input type="hidden" value="<?php echo $grade_id ?>" name='grade_id' />

				<!-- ========================================= -->
				<!-- End Compulsory Academic Session And Grade -->
				<!-- ========================================= -->



				<!-- ============================= -->
				<!-- Start Compulsory Subject Name -->
				<!-- ============================= -->
				<div class='col-md-4'>
					<div class='dd-drag' >
				     	<ol class='dd-list'>
							<li style="text-decoration: underline;color:black;font-weight: 700;">Subject Name</li>
								<?php foreach ($compulsory as $value) { ?>
								<li class='' data-id="<?php echo $value->subjects ?>" >
								<div class="dd-handle"><?php echo $value->name; ?></div>
							</li>
							<input type="hidden" value="<?php echo $value->subjects ?>" name='subject_id[]'>
							<hr></hr>
								<?php } ?>
						</ol>
					</div> 
				</div>
				<!-- ================ -->
				<!-- End Subject Name -->
				<!-- ================ -->

				<!-- ============================== -->
				<!-- Start Compulsory Subject Code  -->
				<!-- ============================== -->
				<?php if($grade_id == 1) { ?>
				<?php $grade = 'PN' ?>
				<?php } ?>
				<?php if($grade_id == 2) { ?>
				<?php $grade = 'N' ?>
				<?php } ?>
				<?php if($grade_id == 3) { ?>
				<?php $grade = 'KG' ?>
				<?php } ?>
				<?php if($grade_id == 4) { ?>
				<?php $grade = 'I' ?>
				<?php } ?>
				<?php if($grade_id == 5) { ?>
				<?php $grade = 'II' ?>
				<?php } ?>
				<?php if($grade_id == 6) { ?>
				<?php $grade = 'III' ?>
				<?php } ?>
				<?php if($grade_id == 7) { ?>
				<?php $grade = 'IV' ?>
				<?php } ?>
				<?php if($grade_id == 8) { ?>
				<?php $grade = 'V' ?>
				<?php } ?>
				<?php if($grade_id == 9) { ?>
				<?php $grade = 'VI' ?>
				<?php } ?>
				<?php if($grade_id == 10) { ?>
				<?php $grade = 'VII' ?>
				<?php } ?>
				<?php if($grade_id == 11) { ?>
				<?php $grade = 'VIII' ?>
				<?php } ?>
				<?php if($grade_id == 12) { ?>
				<?php $grade = 'IX' ?>
				<?php } ?>


				<?php if($grade_id == 13) { ?>
				<?php $grade = 'X' ?>
				<?php } ?>
				<?php if($grade_id == 14) { ?>
				<?php $grade = 'XI' ?>
				<?php } ?>
				<?php if($grade_id == 15) { ?>
				<?php $grade = 'A1' ?>
				<?php } ?>
				<?php if($grade_id == 16) { ?>
				<?php $grade = 'A2' ?>
				<?php } ?>
				<div class='col-md-3'>
					<div class='dd-drag'>
				 		<ol class='dd-list'>
				 			<li style="text-decoration: underline;color:black;font-weight: 700;">Programme Code</li>
								<?php foreach ($compulsory as $value) { ?>
								<li class='' data-id=<?php echo $value->id ?>>
								 <div class="dd-handle"><?php echo $grade.'-'.$value->code ?></div>
							</li>
							<hr></hr>
								<?php } ?>
				 		</ol>
					</div>
				</div>

				<!-- ================= -->
				<!-- End Subject Code  -->
				<!-- ================= -->


				<!-- =============================== -->
				<!-- Start Compulsory Block Per Week -->
				<!-- =============================== -->
				<div class='col-md-4'>
					<div class='dd-drag'>
				 		<ol class='dd-list'>
				 			<li style="text-decoration: underline;color:black;font-weight: 700;">Blocks Per Weeks</li>
								<?php foreach ($compulsory as $value) { ?>
		<!-- 					<li class='' data-id='<?php echo $value->id?>'> 
								 <div class='dd-handle'><?php echo $value->blocks_per_week ?></div>
							</li>-->
	 					<section class='orb-form'>
						<label class='select' id='select-style' style="margin-bottom: 10px">
							<select name='bpw_comp[]' style="margin-top:3px">
								<?php if(!empty($value->blocks_per_week)) { ?>
								<option value="<?php echo $value->blocks_per_week ?>"><?php echo $value->blocks_per_week ?></option>
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
								<option value="15">15</option>


								<?php }  else { ?>
								<option selected disabled>Choose Blocks</option>
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
								<option value="15">15</option>

								<?php } ?>

							</select><i></i>
						</label>
						</section>

						<!-- ============================== -->
						<!-- End Blocks Per Week Compulsory -->
						<!-- ============================== -->

					<?php } ?>
				 </ol>
				</div>
				</div>
					<div class='row'>
						<div class='col-md-12'>
							<footer>
								<button class='btn btn-primary btn-style' style="margin-top: 20px;margin-left: 15px">Save and Submit</button>
							</footer>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
		<!-- *********************** 	-->
		<!-- End Compulsory Program  	-->
		<!-- *********************** 	-->

		<!-- ===========================  -->
		<!-- 	Start Optional Programme  -->
		<!-- ===========================  -->

	<div class='col-md-6'>
		<div class='powerwidget cold-grey'>
			<header>
				<h2>Optional Programme</h2>
			</header>
			<div class='inner-spacer'>

				<form action="" method="POST" id='option-programm'>

					<!-- ============================== -->
					<!-- Academic Session And Grade ID  -->
					<!-- ============================== -->

					<input type="hidden" value="<?php echo $academic_id ?>" name='academic_id'/>
					<input type="hidden" value="<?php echo $grade_id ?>" name='grade_id' />

					<!-- ================================= -->
					<!-- End Academic Session And Grade ID -->
					<!-- ================================= -->

					<!-- =================== -->
					<!--  START Subject Name -->
					<!-- =================== -->
					

					<div class='col-md-5'>
				 		<div class='dd-drag'>
				 			<ol class='dd-list'>
				 				<li style="text-decoration: underline;color:black;font-weight: 700;"><thead>Subject Name</thead></li>
				 				<?php foreach ($optional as $value) {?>
				 				<li class='dd-item' data-id="<?php echo $value->subjects ?>">
				 				<div class='dd-handle'><?php echo $value->name; ?></div>
				 				</li>
				 				<input type="hidden" value="<?php echo $value->subjects ?>" name='subject_id[]'>
				 				<hr></hr>
				 		<?php } ?>
				 			</ol>
				 		</div>		
					</div>


					<!-- =================== -->
					<!--  End  Subject Name  -->
					<!-- =================== -->
					
					<!-- =================== -->
					<!-- Start Subject Code  -->
					<!-- =================== -->

					<div class='col-md-3'>
						<div class='dd-drag'>
							<ol class='dd-list'>
								<li style="text-decoration: underline;color:black;font-weight: 700;">Programme Code</li>
								<?php foreach ($optional as  $value) { ?>
								<li class='' data-id="<?php echo $value->id ?>">
								<div class='dd-handle'><?php echo $grade."-".$value->code; ?></div>
								</li>
								<hr></hr>
								<?php } ?>
							</ol>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

					<!-- ================ -->
					<!-- End Subject Code -->
					<!-- ================ -->

		<!-- =======================  -->
		<!--  End Optional Programme  -->
		<!-- ======================== -->

	<!-- =========================== -->
	<!-- 		No OF Group 		 -->
	<!-- =========================== -->

<?php if (empty($subject_grade)) { ?>
<div class='row'>
	<div class='col-md-12'>
		<div class='powerwidget dark-red'>
			<header><h2>Groups</h2></header>
			<div class='inner-spacer'>
			<form action='' method="post" id='get-group' >
			
			<!-- ============================  -->
			<!-- Academic Session And Grade ID -->
			<!-- ============================= -->

				<input type="hidden" value="<?php echo $academic_id ?>" name='academic_id'/>
				<input type="hidden" value="<?php echo $grade_id ?>" name='grade_id' />

			<!-- ================================  -->
			<!-- End Academic Session And Grade ID -->
			<!-- ================================= -->
			 <div class='col-md-2'>
				<input type="text" class='form-control' placeholder="Enter Group" name='number-group'>
			</div>

			<div class='col-md-1'>
				<button class='btn btn-primary' id='btn-group'>Submit</button>

			</div>
			</form>

			</div>
		</div>
	</div>

</div>

<?php } else  { ?>

<div class='row'>
	<div class='col-md-12'>
		<div class='powerwidget dark-red'>
			<header><h2>Select Group</h2></header>
			<div class='row'>
				<div class='inner-spacer bg'>
				<!-- Success Message -->
				<div class="callout callout-info" id='callout-insert' style="display: none">
                  <h4>Data Insert Successfully</h4>
                </div>
				  <form action='' id='view_insert' method='POST'>
				  		<input type="hidden" value="<?php echo $academic_id ?>" name='academic_id'/>
						<input type="hidden" value="<?php echo $grade_id ?>" name='grade_id' />
						
					<?php foreach ($no_of_group as  $value) { ?>
						<div class='col-md-3'>
							<div class='drop'>

								<!-- ========================= -->
								<!-- Group Name And Group ID 1 -->
								<!-- ========================= -->

								<?php if($value->subject_selection_group_id == 1) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>' name='group_id_1'><?php echo 'A'; ?></h4>

										<!--===========================  -->
										<!-- End Group Name And Group ID -->
										<!--============================ -->

										<!-- =============== -->
										<!-- Blocks Per Week -->
										<!-- =============== -->

										<?php foreach ($blocks_per_week_one as $blocks) { ?>
										<select name="bpw_1" id="option-click">
											<option value='<?php echo $blocks->blocks_per_week ?>' selected disabled><?php echo $blocks->blocks_per_week ?></option>
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
											<option value = "6">6</option>
											<option value = "7">7</option>
											<option value = "8">8</option>
											<option value = "9">9</option>
											<option value = "10">10</option>
											<option value = "11">11</option>
											<option value = "12">12</option>
											<option value = "13">13</option>
											<option value = "14">14</option>
											<option value = "15">15</option>
										</select>
										<?php } ?>

										<!-- =================== -->
										<!-- End Blocks Per Week -->
										<!-- =================== -->

										<!-- =============  -->
										<!-- Subject Name   -->
										<!-- ============== -->

										<ol id='drop-list' data-id="<?php echo $value->subject_selection_group_id; ?>">
										<?php foreach($no_of_subject_one as $subject) { ?>
												<li subject-id="<?php echo $subject->subject_id; ?>"><?php echo $subject->name;  ?>
													<i class='fa fa-plus pull-right'></i>
													<input type="hidden" value='<?php echo $subject->subject_id; ?>' name='subject_1[]' >
												</li>
										<?php } ?>
										</ol>
								<?php  } ?>

								<!-- ========================= -->
								<!-- Group Name And Group ID 2 -->
								<!-- ========================= -->

								<?php if($value->subject_selection_group_id == 2) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>' name='group_id_2'><?php echo 'B' ?></h4>

										<!-- =====================  -->
										<!-- Blocks Per Week Start  -->
										<!-- ====================== -->

										<?php foreach ($blocks_per_week_two as $blocks) { ?>
										<select name="bpw_2">
											<option value='<?php echo $blocks->blocks_per_week ?>' selected  disabled><?php echo $blocks->blocks_per_week ?></option>
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
											<option value = "6">6</option>
											<option value = "7">7</option>
											<option value = "8">8</option>
											<option value = "9">9</option>
											<option value = "10">10</option>
											<option value = "11">11</option>
											<option value = "12">12</option>
											<option value = "13">13</option>
											<option value = "14">14</option>
											<option value = "15">15</option>
										</select>
										<?php } ?>

										<!-- ==================== -->
										<!-- Blocks Per Weeks End -->
										<!-- ==================== -->

										<!-- ===============  -->
										<!-- Subject Name 	  -->
										<!-- ================ -->

										<ol id='drop-list' data-id="<?php echo $value->subject_selection_group_id; ?>">
										<?php  foreach($no_of_subject_two as $subject) {?>
											

												<li subject-id="<?php echo $subject->subject_id; ?>"><?php echo $subject->name;?>
													<i class='fa fa-plus pull-right'></i>
													<input type='hidden' value="<?php echo $subject->subject_id ?>" name='subject_2[]'>
												</li>
										<?php } ?>
										</ol>
								<?php } ?>

										<!-- =================  -->
										<!-- End Subject Name   -->
										<!-- ================== -->

										<!-- ========================= -->
										<!-- Group Name And Group ID 3 -->
										<!-- ========================= -->

								<?php if($value->subject_selection_group_id == 3) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>' name='group_id_3'><?php echo 'C' ?></h4>

										<!-- =========================== -->
										<!-- End Group Name And Group ID -->
										<!-- =========================== -->

										<!-- ================ -->
										<!-- Blocks Per Week  -->
										<!-- ================ -->

										<?php foreach ($blocks_per_week_three as $blocks) { ?>
										<select name="bpw_3">
											<option value="<?php echo $blocks->blocks_per_week  ?>" selected disabled><?php echo $blocks->blocks_per_week ?></option>
											<option value = "1" >1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
											<option value = "6">6</option>
											<option value = "7">7</option>
											<option value = "8">8</option>
											<option value = "9">9</option>
											<option value = "10">10</option>
											<option value = "11">11</option>
											<option value = "12">12</option>
											<option value = "13">13</option>
											<option value = "14">14</option>
											<option value = "15">15</option>
										</select>
										<?php } ?>

										<!-- ================== -->
										<!-- End Block Per Week -->
										<!-- ================== -->

										<!-- ============ -->
										<!-- Subject Name -->
										<!-- ============ -->
										<ol id='drop-list' data-id="<?php echo $value->subject_selection_group_id; ?>">
										<?php  foreach($no_of_subject_three as $subject) {?>
											
												<li subject-id="<?php echo $subject->subject_id; ?>"><?php echo $subject->name; ?>
													<i class='fa fa-plus pull-right'></i>
													<input type='hidden' value="<?php echo $subject->subject_id ?>" name='subject_3[]'>
												</li>
											
										<?php } ?>
										</ol>	

								<?php } ?>
										<!-- ================ -->
										<!-- End Subject Name -->
										<!-- ================ -->

										<!-- ========================= -->
										<!-- Group Name and Group ID 4 -->
										<!-- ========================== -->

								<?php if($value->subject_selection_group_id == 4) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>' name='group_id_4'><?php echo 'D' ?></h4>

										<!--========================= -->
										<!-- End Group Name And Grade -->
										<!--========================= -->

										<!-- ================ -->
										<!-- Blocks Per Week  -->
										<!-- ================ -->
									<?php foreach ($blocks_per_week_four as $blocks) { ?>
										<select name="bpw_4">
											<option value="<?php echo $blocks->blocks_per_week ?>" selected disabled><?php echo $blocks->blocks_per_week ?></option>
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
											<option value = "6">6</option>
											<option value = "7">7</option>
											<option value = "8">8</option>
											<option value = "9">9</option>
											<option value = "10">10</option>
											<option value = "11">11</option>
											<option value = "12">12</option>
											<option value = "13">13</option>
											<option value = "14">14</option>
											<option value = "15">15</option>
										</select>
									<?php } ?>

										<!-- =================== -->
										<!-- End Blocks Per Week -->
										<!-- ====================-->

										<!-- ============ -->
										<!-- Subject Name -->
										<!-- ============ -->

										<ol id='drop-list' data-id="<?php echo $value->subject_selection_group_id; ?>">
										<?php  foreach($no_of_subject_four as $subject) {?>
												<li subject-id="<?php echo $subject->subject_id; ?>"><?php echo $subject->name; ?>
													<i class='fa fa-plus pull-right'></i>
													<input type='hidden' value="<?php echo $subject->subject_id ?>" name='subject_4[]'>
												</li>
										<?php } ?>
										</ol>	
								<?php } ?>

									<!-- ================  -->
									<!-- End Subject Name  -->
									<!-- ================= -->

									<!-- ========================= -->
									<!-- Group Name and Group ID 5 -->
									<!-- ========================== -->
										
								<?php if($value->subject_selection_group_id == 5) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>' name='group_id_5'><?php echo 'E' ?></h4>

										<!--========================= -->
										<!-- End Group Name And Grade -->
										<!--========================= -->

										<!-- ================ -->
										<!-- Blocks Per Week  -->
										<!-- ================ -->
									<?php foreach ($blocks_per_week_five as $blocks) { ?>
										<select name="bpw_5">
											<option value="<?php echo $blocks->blocks_per_week ?>" selected disabled><?php echo $blocks->blocks_per_week ?></option>
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
											<option value = "6">6</option>
											<option value = "7">7</option>
											<option value = "8">8</option>
											<option value = "9">9</option>
											<option value = "10">10</option>
											<option value = "11">11</option>
											<option value = "12">12</option>
											<option value = "13">13</option>
											<option value = "14">14</option>
											<option value = "15">15</option>
										</select>
									<?php } ?>

										<!-- =================== -->
										<!-- End Blocks Per Week -->
										<!-- ====================-->

										<!-- ============ -->
										<!-- Subject Name -->
										<!-- ============ -->

										<ol id='drop-list' data-id="<?php echo $value->subject_selection_group_id; ?>">
										<?php  foreach($no_of_subject_five as $subject) {?>
												<li subject-id="<?php echo $subject->subject_id; ?>"><?php echo $subject->name; ?>
													<i class='fa fa-plus pull-right'></i>
													<input type='hidden' value="<?php echo $subject->subject_id ?>" name='subject_5[]'>
												</li>
										<?php } ?>
										</ol>	
								<?php } ?>

									<!-- ================  -->
									<!-- End Subject Name  -->
									<!-- ================= -->

									<!-- ========================= -->
									<!-- Group Name and Group ID 6 -->
									<!-- ========================== -->
										
								<?php if($value->subject_selection_group_id == 6) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>' name='group_id_6'><?php echo 'F' ?></h4>

										<!--========================= -->
										<!-- End Group Name And Grade -->
										<!--========================= -->

										<!-- ================ -->
										<!-- Blocks Per Week  -->
										<!-- ================ -->
									<?php foreach ($blocks_per_week_six as $blocks) { ?>
										<select name="bpw_6">
											<option value="<?php echo $blocks->blocks_per_week ?>" selected disabled><?php echo $blocks->blocks_per_week ?></option>
											<option value = "1">1</option>
											<option value = "2">2</option>
											<option value = "3">3</option>
											<option value = "4">4</option>
											<option value = "5">5</option>
											<option value = "6">6</option>
											<option value = "7">7</option>
											<option value = "8">8</option>
											<option value = "9">9</option>
											<option value = "10">10</option>
											<option value = "11">11</option>
											<option value = "12">12</option>
											<option value = "13">13</option>
											<option value = "14">14</option>
											<option value = "15">15</option>
										</select>
									<?php } ?>

										<!-- =================== -->
										<!-- End Blocks Per Week -->
										<!-- ====================-->

										<!-- ============ -->
										<!-- Subject Name -->
										<!-- ============ -->

										<ol id='drop-list' data-id="<?php echo $value->subject_selection_group_id; ?>">
										<?php  foreach($no_of_subject_six as $subject) {?>
												<li subject-id="<?php echo $subject->subject_id; ?>"><?php echo $subject->name; ?>
													<i class='fa fa-plus pull-right'></i>
													<input type='hidden' value="<?php echo $subject->subject_id ?>" name='subject_6[]'>
												</li>
										<?php } ?>
										</ol>	
								<?php } ?>

									<!-- ================  -->
									<!-- End Subject Name  -->
									<!-- ================= -->


							</div>
						</div>
					<?php } ?>
						<footer>
							<div class='col-md-12'>
								<button class='btn btn-primary btn-insert'>Save and Submit</button>
							</div>
						</footer>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

		<!-- =================== -->
		<!-- End Number of Group -->
		<!-- =================== -->

<?php } ?>


<div id='group-update'></div>



<style type="text/css">

	.btn-insert
	{
		margin-top:20px;
	}
</style>

<script type="text/javascript">

	// ================
	// Role Teacher   =
	//=================

	if($('#role-teacher').length){
		$('#role-teacher').validate({
			
			rules:{
				'block[]':{
					required:true
				}

			},
			// Ajax form submition
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: "POST",
                url:"<?php echo base_url() ?>index.php/program_group/subject_grade_ajax/save_role",
                cache:false,
               //data:$('#order-form').serialize(),
                datatype: "html",
                success: function (data) {
                	$('#sucess-role').css('display','');
                	$('#sucess-role').fadeOut(5000);
                }
            });
        }
		});
	}

		// =====================
		//  End Role Teacher   =
		// =====================

		//--------------------------------------------------------------

		// =============
		//	Get Group  =	
		// =============

		if($('#get-group').length){
		$('#get-group').validate({
			
			rules:{
				
				'number-group':{
					required: true
				}
				},
				 messages: {
                    'number-group': {
                        required: 'Please enter Group'
                    }
				},
			
			// Ajax form submition

        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: "POST",
                url:"<?php echo base_url() ?>index.php/program_group/subject_grade_ajax/save_group",
                cache:false,
               //data:$('#order-form').serialize(),
                datatype: "html",
                success: function (data) {
                    //$('#table-update').html(data);
                    $('#group-update').html(data);
                }
            });
        }
		});
	}

	// ================
	// End Get Group  =
	// ================

	// ----------------------------------------------------

	//=======================
	// Compulsory Subject 	=
	//=======================

	if($('#comp-prog').length){
		$('#comp-prog').validate({
			
			rules:{
				'ignore':'[]',
				'bpw_comp[]':{
					required:true
				}

			},

	// Ajax form submition

        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: "POST",
                url:"<?php echo base_url() ?>index.php/program_group/subject_grade_ajax/save_comp",
                cache:false,
               //data:$('#order-form').serialize(),
                datatype: "html",
                success: function (data) {
                    //$('#table-update').html(data);
                    $('#callout-update').css('display','');
                    $('#callout-update').fadeOut(5000);
                }
            });
        }
		});
	}

	//============================
	// End Compulsory Subject  	 =
	//============================
 
 	//--------------------------------------------------------------

	// ==================
	// Optional Subject =
	// ==================

		if($('#option-programm').length){
		$('#option-programm').validate({
			
			rules:{
				'ignore':'[]',
				'bpw_comp[]':{
					required:true
				}

			},

	// Ajax form submition
        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: "POST",
                url:"<?php echo base_url() ?>index.php/program_group/subject_grade_ajax/save_option",
                cache:false,
               //data:$('#order-form').serialize(),
                datatype: "html",
                success: function (data) {
                    //$('#table-update').html(data);
                    console.log(data);
                }
            });
        }
		});
	}

	// ========================
	//   End Optional Subejct =
	//=========================

	//----------------------------------------------------------------
	//================================
	//Drag And Drop
	//================================

$(init);
function init(){
	$('.dd-item').draggable({
		 cursor: 'move',
         helper: 'clone',
         appendTo: "body"
        
	});

	

}


$('.drop').droppable({
        activeClass	: "ui-state-default",
        hoverClass	: "ui-state-hover",
        accept		: ":not(.ui-sortable-helper)",
		drop:handleDropEvent,
	});
	function handleDropEvent(event,ui){

		var value='';
		var input='';
		var group='';
		var test='';

		


		var draggable = ui.draggable;

			// Adding Class Active to get the Group ID
		if($('#drop-list').find('.ui-state-hover')){
			$(this).addClass('active');
			var c = $('.active').find('#drop-list').attr('data-id');


			
			
			
			//GettIng Subject ID uiIndex
			var uiIndex = ui.draggable.attr('data-id');



			//Duplicate Entry of the subject on same Group can be Restricted
			var item =  $(this).find('[subject-id=' + uiIndex + ']');			
			var group = $('.drop').find('[subject-id=' + uiIndex + ']');

			//alert(group.length);

			// Adding the Element and the input box to get the value 
			if($('.drop').hasClass('active')){

				value += '<li subject-id ='+uiIndex+ '>' +draggable.text()+ '<i class="fa fa-plus pull-right"></i><input type=hidden   name="subject_'+c+'[]" value="'+uiIndex+'" id="i'+uiIndex+'" /></li>';
				//input += '<input type=hidden   name="subject_'+c+'[]" value="'+uiIndex+'" id="i'+uiIndex+'" />';
				//group += '<input type=hidden   name=group[] value="'+c+'" id="g'+c+'" />';
				

				
				$('.active #drop-list').append(value);
				$('.active #drop-list').append(input);
				

				//$('.active #drop-list').append(group);
				

				//Restricted the Duplicate Entry
				if (item.length > 0) {
		  			item.last().remove();
		  			// $('#i'+uiIndex).remove();
		  			// $('#g'+c).remove();
		 			$('#subject-modal').modal('show');
		 			}


		 		//Restriction the Duplicate Group

		 		if(group.length > 0){
		 			//group.last().remove();
		 			//$('#i'+uiIndex).remove();
		 		}
				

			}
				// Remove The class Active
			$(this).removeClass('active');

			

		}
	}


	//======================
	// End Drag And Drop   =
	//======================
	//----------------------------------------------------------

	//====================
	// Save View Insert  =
	//====================

		if($('#view_insert').length){
		$('#view_insert').validate({
			
			rules:{
				'block[]':{
					required:true
				}

			},

		// Ajax form submition

        submitHandler: function (form) {
            $(form).ajaxSubmit({
                type: "POST",
                url:"<?php echo base_url() ?>index.php/program_group/subject_grade_ajax/save_view_insert",
                cache:false,
               //data:$('#order-form').serialize(),
                datatype: "html",
                success: function (data) {
                    //$('#table-update').html(data);
                    
                    $('#callout-insert').css('display','');
                    $('#callout-insert').fadeOut(5000);
                }
            });
        }
		});
	}

	//======================
	//End Save View Insert =
	//======================
	

	//=====================
	// Remove
	//=====================

	$(document).on("click", "#drop-list li", function(){
	var r = confirm("Do you want to remove " + $.trim($(this).closest('li').text()) + " ?");
	if (r == true) {
	    $(this).closest('li').remove();
	}
	//$(this).closest('li').remove();
});


</script>


<style type="text/css">
.drop{
	padding-top: 10px;
    margin-top: 13px; 
    padding-bottom: 20px;
    text-align: center;
    width: 200px;
    background-color:#E4F1EE;
    height: 250px;
    border-radius:20px;
    border:1px solid #333333;
    -webkit-box-shadow: 10px 10px 5px 0px rgb(163, 161, 161);
    -moz-box-shadow: 10px 10px 5px 0px rgb(163, 161, 161);
	box-shadow: 10px 10px 5px 0px rgb(163, 161, 161);

}   
li{
	/*list-style: none;*/
	
}

.dd-item{
	line-height: 19px;
}

#drop-list{
	padding: 0px;
	margin-top: 10px;
	background: #fafafa none repeat scroll 0 0;
    border: 2px solid #ddd;
    border-radius: 3px;
    box-sizing: border-box;
    color: #333;
    display: block;
    font-weight: 700;
    margin: 5px 0;
    padding: 0px 10px;
    text-decoration: none;
}

#drop-list li{
	font-size:13px;
	border-bottom: 1px dashed #0088cc;
	color: #333;
	text-align: left;
	margin-left: 8px;
}

.ui-state-hover{
	background-color: #babbbc;
}
.btn-group-insert{
	margin-top:20px;
}
.dd-handle:hover{
	cursor:pointer;
}
.dd-handle{
	border: 1px solid #CACBC9;
}
hr{
	margin-top:8px;
	margin-bottom: 8px;
	border-top:1px solid #ffffff;

}
th{
	font-size: 10px;
}

</style>


