<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Career</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>


<!-- BEGIN GLOBAL MANDATORY STYLES -->
<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/> -->
<link href="<?php echo base_url();?>components/assets_metronic362/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->



<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>components/assets_metronic362/global/plugins/select2/select2.css"/>
<!-- END PAGE LEVEL SCRIPTS -->


<!-- BEGIN THEME STYLES -->
<link href="<?php echo base_url();?>components/assets_metronic362/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo base_url();?>components/assets_metronic362/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>components/assets_metronic362/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->


<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
	<!-- BEGIN HEADER INNER -->
	<div class="page-header-inner">
		<!-- BEGIN LOGO -->
		<div class="page-logo">
			<a href="index.html">
				<!-- <img src="<?php echo base_url();?>components/assets_metronic362/admin/layout/img/logo.png" alt="logo" class="logo-default"/> -->
			</a>
			<div class="menu-toggler sidebar-toggler hide">
				<!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
			</div>
		</div>
		<!-- END LOGO -->		
	</div>
	<!-- END HEADER INNER -->
</div>
<!-- END HEADER -->





<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
			
		<!-- BEGIN PAGE HEADER-->				


		<!-- BEGIN PAGE CONTENT-->
		<div class="row">
			<div class="col-md-12">
				<div class="portlet box blue" id="form_wizard_1">

					<div class="portlet-body form">
						<form action="<?php echo site_url();?>/career/add" class="form-horizontal" id="submit_form" name="submit_form" method="POST">
							<div class="form-wizard">
								<div class="form-body">
									<ul class="nav nav-pills nav-justified steps">										
										<li>
											<a href="<?php echo site_url();?>/career#tab1" data-toggle="tab" class="step">
											<span class="number">
											1 </span>
											<span class="desc">
											<i class="fa fa-check"></i> Getting Started </span>
											</a>
										</li>
										<li>
											<a href="<?php echo site_url();?>/career#tab2" data-toggle="tab" class="step">
											<span class="number">
											2 </span>
											<span class="desc">
											<i class="fa fa-check"></i> Personal Details </span>
											</a>
										</li>
										<li>
											<a href="<?php echo site_url();?>/career#tab3" data-toggle="tab" class="step active">
											<span class="number">
											3 </span>
											<span class="desc">
											<i class="fa fa-check"></i> Schooling and University </span>
											</a>
										</li>
										<li>
											<a href="<?php echo site_url();?>/career#tab4" data-toggle="tab" class="step">
											<span class="number">
											4 </span>
											<span class="desc">
											<i class="fa fa-check"></i> Employment Practicalities </span>
											</a>
										</li>
										<li>
											<a href="<?php echo site_url();?>/career#tab5" data-toggle="tab" class="step">
											<span class="number">
											5 </span>
											<span class="desc">
											<i class="fa fa-check"></i> Training and Professional </span>
											</a>
										</li>										
									</ul>



									<div id="bar" class="progress progress-striped" role="progressbar">
										<div class="progress-bar progress-bar-success">
										</div>
									</div>



									<div class="tab-content">
										<div class="alert alert-danger display-none">
											<button class="close" data-dismiss="alert"></button>
											You have some form errors. Please check below.
											<?php
									            if(validation_errors() != false) {                            
									              echo validation_errors();
									            } 
								          	?> 
										</div>
										<div class="alert alert-success display-none">
											<button class="close" data-dismiss="alert"></button>
											Your form validation is successful!
										</div>

										
										<div class="tab-pane active" id="tab1">
											<h3 class="block">Getting started</h3>

											<div class="form-group">
												<label class="control-label col-md-3">Full Name <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="full_name"/>	
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Cell Number <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control cell_number" name="cell_number" placeholder="03xx-xXxXxXx"/>	
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">CNIC <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control cnic" name="cnic" placeholder="99999-9999999-9"/>	
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Gender <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<div class="radio-list">
														<label>
														<input type="radio" name="gender" value="M" data-title="Male"/>
														Male </label>
														<label>
														<input type="radio" name="gender" value="F" data-title="Female"/>
														Female </label>													
													</div>
													<div id="form_gender_error">
													</div>												
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Email <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="email"/>
													<span class="help-block">
													Provide your email address </span>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Position applied for <span class="required">
												* </label>
												<div class="col-md-4">
													<select name="position_applied" id="position_applied_list" class="form-control">
														<option value=""></option>
														<option value="Management">Management</option>
														<option value="Teaching">Teaching</option>
														<option value="Admin">Admin</option>
														<option value="Technical">Technical</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">What kind of position are you seeking at Generation's <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="seeking_position"/>	
												</div>												
											</div>											
											<div class="form-group">
												<label class="control-label col-md-3">Please tick the boxes of classes you wish to teach </label>
												<div class="col-md-1">
													<input name="early_years" type="checkbox" value="Early Years"> Early Years </label>
												</div>
												<div class="col-md-1">
													<input name="I" type="checkbox" value="I"> I </label>
												</div>
												<div class="col-md-1">
													<input name="II" type="checkbox" value="II"> II </label>
												</div>
												<div class="col-md-1">
													<input name="III" type="checkbox" value="III"> III </label>
												</div>																							
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>
												<div class="col-md-1">
													<input name="IV" type="checkbox" value="IV"> IV </label>
												</div>
												<div class="col-md-1">
													<input name="V" type="checkbox" value="V"> V </label>
												</div>
												<div class="col-md-1">
													<input name="VI" type="checkbox" value="VI"> VI </label>
												</div>
												<div class="col-md-1">
													<input name="VIII" type="checkbox" value="VII"> VII </label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>
												<div class="col-md-1">
													<input name="IV" type="checkbox" value="VIII"> VIII </label>
												</div>
												<div class="col-md-1">
													<input name="IX" type="checkbox" value="IX"> IX </label>
												</div>
												<div class="col-md-1">
													<input name="X" type="checkbox" value="X"> X </label>
												</div>
												<div class="col-md-1">
													<input name="XI" type="checkbox" value="XI"> XI </label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>												
												<div class="col-md-1">
													<input name="A_Level" type="checkbox" value="A-Level"> A Level </label>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Have you applied before? <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<div class="radio-list">
														<label>
														<input type="radio" name="applied_before" value="Y" data-title="Yes"/>
														Yes </label>
														<label>
														<input type="radio" name="applied_before" value="N" data-title="No"/>
														No </label>
													</div>
													<div id="form_applied_before">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">If selected when can you join? <span class="required">
												* </span>
												</label>												
												<div class="col-md-4">
													<input type="text" class="form-control" name="when_can_join"/>	
												</div>													
											</div>






											<div class="form-group">
												<label class="control-label col-md-3">Please list all subjects you are able and willing to teach
												</label>												
												<div class="col-md-2">
													<select  multiple id="select_grade_subject_1" name="select_grade_subject_1[]" style="width:100%" class="form-control">
														<option value="Library">Library</option>
														<option value="Sport">Sport</option>
														<option value="Arts & Crafts">Arts & Crafts</option>
														<option value="Design Tech">Design Tech</option>
														<option value="ICT/CS">ICT/CS</option>
														<option value="Laboratory">Laboratory</option>
														<option value="World Geography">World Geography</option>
														<option value="World History">World History</option>
														<option value="Pakistan Geography">Pakistan Geography</option>
														<option value="Pakistan History">Pakistan History</option>
														<option value="Social Studies">Social Studies</option>
														<option value="Psychology">Psychology</option>
														<option value="Sociology">Sociology</option>
														<option value="Islamiyat">Islamiyat</option>
														<option value="Mathematics">Mathematics</option>
														<option value="Add Math">Add Math</option>
														<option value="Gen Science">Gen Science</option>
														<option value="Physics">Physics</option>
														<option value="Chemistry">Chemistry</option>
														<option value="Biology">Biology</option>
														<option value="English Language">English Language</option>
														<option value="English Literature">English Literature</option>
														<option value="Urdu">Urdu</option>
														<option value="Arabic">Arabic</option>
														<option value="Nazra">Nazra</option>
														<option value="Voc/Reading">Voc/Reading</option>
														<option value="General Paper">General Paper</option>
														<option value="Economics">Economics</option>
														<option value="Business Studies">Business Studies</option>
														<option value="Accounts">Accounts</option>
													</select>
												</div>
												<div class="col-md-2">
													<select  multiple id="select_grade_1" name="select_grade_1[]" style="width:100%" class="form-control">
									                  <option value="PN">PN</option>
									                  <option value="N">N</option>
									                  <option value="KG">KG</option>                                  
									                  <option value="I">I</option>
									                  <option value="II">II</option>
									                  <option value="III">III</option>
									                  <option value="IV">IV</option>
									                  <option value="V">V</option>
									                  <option value="VI">VI</option>
									                  <option value="VII">VII</option>
									                  <option value="VIII">VIII</option>
									                  <option value="IX">IX</option>
									                  <option value="X">X</option>
									                  <option value="XI">XI</option>
									                  <option value="A1">A1</option>
									                  <option value="A2">A2</option>
									                </select>
												</div>													
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>												
												<div class="col-md-2">
													<select  multiple id="select_grade_subject_2" name="select_grade_subject_2[]" style="width:100%" class="form-control">
														<option value="Library">Library</option>
														<option value="Sport">Sport</option>
														<option value="Arts & Crafts">Arts & Crafts</option>
														<option value="Design Tech">Design Tech</option>
														<option value="ICT/CS">ICT/CS</option>
														<option value="Laboratory">Laboratory</option>
														<option value="World Geography">World Geography</option>
														<option value="World History">World History</option>
														<option value="Pakistan Geography">Pakistan Geography</option>
														<option value="Pakistan History">Pakistan History</option>
														<option value="Social Studies">Social Studies</option>
														<option value="Psychology">Psychology</option>
														<option value="Sociology">Sociology</option>
														<option value="Islamiyat">Islamiyat</option>
														<option value="Mathematics">Mathematics</option>
														<option value="Add Math">Add Math</option>
														<option value="Gen Science">Gen Science</option>
														<option value="Physics">Physics</option>
														<option value="Chemistry">Chemistry</option>
														<option value="Biology">Biology</option>
														<option value="English Language">English Language</option>
														<option value="English Literature">English Literature</option>
														<option value="Urdu">Urdu</option>
														<option value="Arabic">Arabic</option>
														<option value="Nazra">Nazra</option>
														<option value="Voc/Reading">Voc/Reading</option>
														<option value="General Paper">General Paper</option>
														<option value="Economics">Economics</option>
														<option value="Business Studies">Business Studies</option>
														<option value="Accounts">Accounts</option>
													</select>
												</div>
												<div class="col-md-2">
													<select  multiple id="select_grade_2" name="select_grade_2[]" style="width:100%" class="form-control">
									                  <option value="PN">PN</option>
									                  <option value="N">N</option>
									                  <option value="KG">KG</option>                                  
									                  <option value="I">I</option>
									                  <option value="II">II</option>
									                  <option value="III">III</option>
									                  <option value="IV">IV</option>
									                  <option value="V">V</option>
									                  <option value="VI">VI</option>
									                  <option value="VII">VII</option>
									                  <option value="VIII">VIII</option>
									                  <option value="IX">IX</option>
									                  <option value="X">X</option>
									                  <option value="XI">XI</option>
									                  <option value="A1">A1</option>
									                  <option value="A2">A2</option>
									                </select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>												
												<div class="col-md-2">
													<select  multiple id="select_grade_subject_3" name="select_grade_subject_3[]" style="width:100%" class="form-control">
														<option value="Library">Library</option>
														<option value="Sport">Sport</option>
														<option value="Arts & Crafts">Arts & Crafts</option>
														<option value="Design Tech">Design Tech</option>
														<option value="ICT/CS">ICT/CS</option>
														<option value="Laboratory">Laboratory</option>
														<option value="World Geography">World Geography</option>
														<option value="World History">World History</option>
														<option value="Pakistan Geography">Pakistan Geography</option>
														<option value="Pakistan History">Pakistan History</option>
														<option value="Social Studies">Social Studies</option>
														<option value="Psychology">Psychology</option>
														<option value="Sociology">Sociology</option>
														<option value="Islamiyat">Islamiyat</option>
														<option value="Mathematics">Mathematics</option>
														<option value="Add Math">Add Math</option>
														<option value="Gen Science">Gen Science</option>
														<option value="Physics">Physics</option>
														<option value="Chemistry">Chemistry</option>
														<option value="Biology">Biology</option>
														<option value="English Language">English Language</option>
														<option value="English Literature">English Literature</option>
														<option value="Urdu">Urdu</option>
														<option value="Arabic">Arabic</option>
														<option value="Nazra">Nazra</option>
														<option value="Voc/Reading">Voc/Reading</option>
														<option value="General Paper">General Paper</option>
														<option value="Economics">Economics</option>
														<option value="Business Studies">Business Studies</option>
														<option value="Accounts">Accounts</option>
													</select>
												</div>
												<div class="col-md-2">
													<select  multiple id="select_grade_3" name="select_grade_3[]" style="width:100%" class="form-control">
									                  <option value="PN">PN</option>
									                  <option value="N">N</option>
									                  <option value="KG">KG</option>                                  
									                  <option value="I">I</option>
									                  <option value="II">II</option>
									                  <option value="III">III</option>
									                  <option value="IV">IV</option>
									                  <option value="V">V</option>
									                  <option value="VI">VI</option>
									                  <option value="VII">VII</option>
									                  <option value="VIII">VIII</option>
									                  <option value="IX">IX</option>
									                  <option value="X">X</option>
									                  <option value="XI">XI</option>
									                  <option value="A1">A1</option>
									                  <option value="A2">A2</option>
									                </select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>												
												<div class="col-md-2">
													<select  multiple id="select_grade_subject_4" name="select_grade_subject_4[]" style="width:100%" class="form-control">
														<option value="Library">Library</option>
														<option value="Sport">Sport</option>
														<option value="Arts & Crafts">Arts & Crafts</option>
														<option value="Design Tech">Design Tech</option>
														<option value="ICT/CS">ICT/CS</option>
														<option value="Laboratory">Laboratory</option>
														<option value="World Geography">World Geography</option>
														<option value="World History">World History</option>
														<option value="Pakistan Geography">Pakistan Geography</option>
														<option value="Pakistan History">Pakistan History</option>
														<option value="Social Studies">Social Studies</option>
														<option value="Psychology">Psychology</option>
														<option value="Sociology">Sociology</option>
														<option value="Islamiyat">Islamiyat</option>
														<option value="Mathematics">Mathematics</option>
														<option value="Add Math">Add Math</option>
														<option value="Gen Science">Gen Science</option>
														<option value="Physics">Physics</option>
														<option value="Chemistry">Chemistry</option>
														<option value="Biology">Biology</option>
														<option value="English Language">English Language</option>
														<option value="English Literature">English Literature</option>
														<option value="Urdu">Urdu</option>
														<option value="Arabic">Arabic</option>
														<option value="Nazra">Nazra</option>
														<option value="Voc/Reading">Voc/Reading</option>
														<option value="General Paper">General Paper</option>
														<option value="Economics">Economics</option>
														<option value="Business Studies">Business Studies</option>
														<option value="Accounts">Accounts</option>
													</select>
												</div>
												<div class="col-md-2">
													<select  multiple id="select_grade_4" name="select_grade_4[]" style="width:100%" class="form-control">
									                  <option value="PN">PN</option>
									                  <option value="N">N</option>
									                  <option value="KG">KG</option>                                  
									                  <option value="I">I</option>
									                  <option value="II">II</option>
									                  <option value="III">III</option>
									                  <option value="IV">IV</option>
									                  <option value="V">V</option>
									                  <option value="VI">VI</option>
									                  <option value="VII">VII</option>
									                  <option value="VIII">VIII</option>
									                  <option value="IX">IX</option>
									                  <option value="X">X</option>
									                  <option value="XI">XI</option>
									                  <option value="A1">A1</option>
									                  <option value="A2">A2</option>
									                </select>
												</div>
											</div>
										</div>



										<div class="tab-pane" id="tab2">
											<h3 class="block">Provide your personal details</h3>
											
											<div class="form-group">
												<label class="control-label col-md-3">Date of Birth <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="dob" id="datepicker_dob" size="100" />
												</div>												
											</div>											
											<div class="form-group">
												<label class="control-label col-md-3">Nationality <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<select name="nationality" id="country_list" class="form-control">
														<option value=""></option>
															<option value="AF">Afghanistan</option>
															<option value="AL">Albania</option>
															<option value="DZ">Algeria</option>
															<option value="AS">American Samoa</option>
															<option value="AD">Andorra</option>
															<option value="AO">Angola</option>
															<option value="AI">Anguilla</option>
															<option value="AR">Argentina</option>
															<option value="AM">Armenia</option>
															<option value="AW">Aruba</option>
															<option value="AU">Australia</option>
															<option value="AT">Austria</option>
															<option value="AZ">Azerbaijan</option>
															<option value="BS">Bahamas</option>
															<option value="BH">Bahrain</option>
															<option value="BD">Bangladesh</option>
															<option value="BB">Barbados</option>
															<option value="BY">Belarus</option>
															<option value="BE">Belgium</option>
															<option value="BZ">Belize</option>
															<option value="BJ">Benin</option>
															<option value="BM">Bermuda</option>
															<option value="BT">Bhutan</option>
															<option value="BO">Bolivia</option>
															<option value="BA">Bosnia and Herzegowina</option>
															<option value="BW">Botswana</option>
															<option value="BV">Bouvet Island</option>
															<option value="BR">Brazil</option>
															<option value="IO">British Indian Ocean Territory</option>
															<option value="BN">Brunei Darussalam</option>
															<option value="BG">Bulgaria</option>
															<option value="BF">Burkina Faso</option>
															<option value="BI">Burundi</option>
															<option value="KH">Cambodia</option>
															<option value="CM">Cameroon</option>
															<option value="CA">Canada</option>
															<option value="CV">Cape Verde</option>
															<option value="KY">Cayman Islands</option>
															<option value="CF">Central African Republic</option>
															<option value="TD">Chad</option>
															<option value="CL">Chile</option>
															<option value="CN">China</option>
															<option value="CX">Christmas Island</option>
															<option value="CC">Cocos (Keeling) Islands</option>
															<option value="CO">Colombia</option>
															<option value="KM">Comoros</option>
															<option value="CG">Congo</option>
															<option value="CD">Congo, the Democratic Republic of the</option>
															<option value="CK">Cook Islands</option>
															<option value="CR">Costa Rica</option>
															<option value="CI">Cote d'Ivoire</option>
															<option value="HR">Croatia (Hrvatska)</option>
															<option value="CU">Cuba</option>
															<option value="CY">Cyprus</option>
															<option value="CZ">Czech Republic</option>
															<option value="DK">Denmark</option>
															<option value="DJ">Djibouti</option>
															<option value="DM">Dominica</option>
															<option value="DO">Dominican Republic</option>
															<option value="EC">Ecuador</option>
															<option value="EG">Egypt</option>
															<option value="SV">El Salvador</option>
															<option value="GQ">Equatorial Guinea</option>
															<option value="ER">Eritrea</option>
															<option value="EE">Estonia</option>
															<option value="ET">Ethiopia</option>
															<option value="FK">Falkland Islands (Malvinas)</option>
															<option value="FO">Faroe Islands</option>
															<option value="FJ">Fiji</option>
															<option value="FI">Finland</option>
															<option value="FR">France</option>
															<option value="GF">French Guiana</option>
															<option value="PF">French Polynesia</option>
															<option value="TF">French Southern Territories</option>
															<option value="GA">Gabon</option>
															<option value="GM">Gambia</option>
															<option value="GE">Georgia</option>
															<option value="DE">Germany</option>
															<option value="GH">Ghana</option>
															<option value="GI">Gibraltar</option>
															<option value="GR">Greece</option>
															<option value="GL">Greenland</option>
															<option value="GD">Grenada</option>
															<option value="GP">Guadeloupe</option>
															<option value="GU">Guam</option>
															<option value="GT">Guatemala</option>
															<option value="GN">Guinea</option>
															<option value="GW">Guinea-Bissau</option>
															<option value="GY">Guyana</option>
															<option value="HT">Haiti</option>
															<option value="HM">Heard and Mc Donald Islands</option>
															<option value="VA">Holy See (Vatican City State)</option>
															<option value="HN">Honduras</option>
															<option value="HK">Hong Kong</option>
															<option value="HU">Hungary</option>
															<option value="IS">Iceland</option>
															<option value="IN">India</option>
															<option value="ID">Indonesia</option>
															<option value="IR">Iran (Islamic Republic of)</option>
															<option value="IQ">Iraq</option>
															<option value="IE">Ireland</option>
															<option value="IL">Israel</option>
															<option value="IT">Italy</option>
															<option value="JM">Jamaica</option>
															<option value="JP">Japan</option>
															<option value="JO">Jordan</option>
															<option value="KZ">Kazakhstan</option>
															<option value="KE">Kenya</option>
															<option value="KI">Kiribati</option>
															<option value="KP">Korea, Democratic People's Republic of</option>
															<option value="KR">Korea, Republic of</option>
															<option value="KW">Kuwait</option>
															<option value="KG">Kyrgyzstan</option>
															<option value="LA">Lao People's Democratic Republic</option>
															<option value="LV">Latvia</option>
															<option value="LB">Lebanon</option>
															<option value="LS">Lesotho</option>
															<option value="LR">Liberia</option>
															<option value="LY">Libyan Arab Jamahiriya</option>
															<option value="LI">Liechtenstein</option>
															<option value="LT">Lithuania</option>
															<option value="LU">Luxembourg</option>
															<option value="MO">Macau</option>
															<option value="MK">Macedonia, The Former Yugoslav Republic of</option>
															<option value="MG">Madagascar</option>
															<option value="MW">Malawi</option>
															<option value="MY">Malaysia</option>
															<option value="MV">Maldives</option>
															<option value="ML">Mali</option>
															<option value="MT">Malta</option>
															<option value="MH">Marshall Islands</option>
															<option value="MQ">Martinique</option>
															<option value="MR">Mauritania</option>
															<option value="MU">Mauritius</option>
															<option value="YT">Mayotte</option>
															<option value="MX">Mexico</option>
															<option value="FM">Micronesia, Federated States of</option>
															<option value="MD">Moldova, Republic of</option>
															<option value="MC">Monaco</option>
															<option value="MN">Mongolia</option>
															<option value="MS">Montserrat</option>
															<option value="MA">Morocco</option>
															<option value="MZ">Mozambique</option>
															<option value="MM">Myanmar</option>
															<option value="NA">Namibia</option>
															<option value="NR">Nauru</option>
															<option value="NP">Nepal</option>
															<option value="NL">Netherlands</option>
															<option value="AN">Netherlands Antilles</option>
															<option value="NC">New Caledonia</option>
															<option value="NZ">New Zealand</option>
															<option value="NI">Nicaragua</option>
															<option value="NE">Niger</option>
															<option value="NG">Nigeria</option>
															<option value="NU">Niue</option>
															<option value="NF">Norfolk Island</option>
															<option value="MP">Northern Mariana Islands</option>
															<option value="NO">Norway</option>
															<option value="OM">Oman</option>
															<option value="PK" selected="selected">Pakistan</option>
															<option value="PW">Palau</option>
															<option value="PA">Panama</option>
															<option value="PG">Papua New Guinea</option>
															<option value="PY">Paraguay</option>
															<option value="PE">Peru</option>
															<option value="PH">Philippines</option>
															<option value="PN">Pitcairn</option>
															<option value="PL">Poland</option>
															<option value="PT">Portugal</option>
															<option value="PR">Puerto Rico</option>
															<option value="QA">Qatar</option>
															<option value="RE">Reunion</option>
															<option value="RO">Romania</option>
															<option value="RU">Russian Federation</option>
															<option value="RW">Rwanda</option>
															<option value="KN">Saint Kitts and Nevis</option>
															<option value="LC">Saint LUCIA</option>
															<option value="VC">Saint Vincent and the Grenadines</option>
															<option value="WS">Samoa</option>
															<option value="SM">San Marino</option>
															<option value="ST">Sao Tome and Principe</option>
															<option value="SA">Saudi Arabia</option>
															<option value="SN">Senegal</option>
															<option value="SC">Seychelles</option>
															<option value="SL">Sierra Leone</option>
															<option value="SG">Singapore</option>
															<option value="SK">Slovakia (Slovak Republic)</option>
															<option value="SI">Slovenia</option>
															<option value="SB">Solomon Islands</option>
															<option value="SO">Somalia</option>
															<option value="ZA">South Africa</option>
															<option value="GS">South Georgia and the South Sandwich Islands</option>
															<option value="ES">Spain</option>
															<option value="LK">Sri Lanka</option>
															<option value="SH">St. Helena</option>
															<option value="PM">St. Pierre and Miquelon</option>
															<option value="SD">Sudan</option>
															<option value="SR">Suriname</option>
															<option value="SJ">Svalbard and Jan Mayen Islands</option>
															<option value="SZ">Swaziland</option>
															<option value="SE">Sweden</option>
															<option value="CH">Switzerland</option>
															<option value="SY">Syrian Arab Republic</option>
															<option value="TW">Taiwan, Province of China</option>
															<option value="TJ">Tajikistan</option>
															<option value="TZ">Tanzania, United Republic of</option>
															<option value="TH">Thailand</option>
															<option value="TG">Togo</option>
															<option value="TK">Tokelau</option>
															<option value="TO">Tonga</option>
															<option value="TT">Trinidad and Tobago</option>
															<option value="TN">Tunisia</option>
															<option value="TR">Turkey</option>
															<option value="TM">Turkmenistan</option>
															<option value="TC">Turks and Caicos Islands</option>
															<option value="TV">Tuvalu</option>
															<option value="UG">Uganda</option>
															<option value="UA">Ukraine</option>
															<option value="AE">United Arab Emirates</option>
															<option value="GB">United Kingdom</option>
															<option value="US">United States</option>
															<option value="UM">United States Minor Outlying Islands</option>
															<option value="UY">Uruguay</option>
															<option value="UZ">Uzbekistan</option>
															<option value="VU">Vanuatu</option>
															<option value="VE">Venezuela</option>
															<option value="VN">Viet Nam</option>
															<option value="VG">Virgin Islands (British)</option>
															<option value="VI">Virgin Islands (U.S.)</option>
															<option value="WF">Wallis and Futuna Islands</option>
															<option value="EH">Western Sahara</option>
															<option value="YE">Yemen</option>
															<option value="ZM">Zambia</option>
															<option value="ZW">Zimbabwe</option>
													</select>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Religion <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<select name="religion" id="country_list" class="form-control">
														<option value=""></option>
														<option value="Islam" selected="selected">Islam</option>
														<option value="Christian">Christian</option>
														<option value="Hindu">Hindu</option>
														<option value="Other">Other</option>
													</select>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Marital Status <span class="required">
												* </label>																								
												<div class="col-md-4">
													<select name="marital_status" id="marital_status_list" class="form-control">
														<option value=""></option>
														<option value="Single">Single</option>
														<option value="Married">Married</option>
														<option value="Separated">Separated</option>
														<option value="Widowed">Widowed</option>
														<option value="Divorced">Divorced</option>
													</select>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Address <span class="required">
												* </label>																								
												<div class="col-md-4">
													<textarea id="maxlength_textarea" name="home_address" class="form-control" maxlength="200" rows="5" placeholder="Home Address Here"></textarea>
													
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Place of Birth
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="birthPlace"/>	
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Landline Number
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control landline" name="landline" placeholder="021-XxXxXxXx"/>	
												</div>												
											</div>											
										</div>





										<div class="tab-pane" id="tab3">											
											<h3 class="form-section">Matric / O Level</h3>
											<div class="form-group">
												<label class="control-label col-md-3">School Name <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_1_institute"/>	
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Matric / O-Level <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<div class="radio-list">
														<label>
														<input type="radio" name="school_level" value="Matric" data-title="Matric"/>
														Matric </label>
														<label>
														<input type="radio" name="school_level" value="O-Level" data-title="O-Level"/>
														O-Level </label>
														<label>
														<input type="radio" name="school_level" value="Other" data-title="Other"/>
														Other </label>
														<div id="form_school_level_error">
														</div>
													</div>													
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Matric / O Level Subjects <span class="required">
												* </span><br>(minimum 3) <span class="required">
												</label>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_1" placeholder="Subject 1"/>
													<input type="text" class="form-control" name="level_1_subject_grade_1" placeholder="Grade 1"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_2" placeholder="Subject 2"/>
													<input type="text" class="form-control" name="level_1_subject_grade_2" placeholder="Grade 2"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_3" placeholder="Subject 3"/>
													<input type="text" class="form-control" name="level_1_subject_grade_3" placeholder="Grade 3"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_4" placeholder="Subject 4"/>
													<input type="text" class="form-control" name="level_1_subject_grade_4" placeholder="Grade 4"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_5" placeholder="Subject 5"/>
													<input type="text" class="form-control" name="level_1_subject_grade_5" placeholder="Grade 5"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_6" placeholder="Subject 6"/>
													<input type="text" class="form-control" name="level_1_subject_grade_6" placeholder="Grade 6"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_7" placeholder="Subject 7"/>
													<input type="text" class="form-control" name="level_1_subject_grade_7" placeholder="Grade 7"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_8" placeholder="Subject 8"/>
													<input type="text" class="form-control" name="level_1_subject_grade_8" placeholder="Grade 8"/>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_9" placeholder="Subject 9"/>
													<input type="text" class="form-control" name="level_1_subject_grade_9" placeholder="Grade 9"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_10" placeholder="Subject 10"/>
													<input type="text" class="form-control" name="level_1_subject_grade_10" placeholder="Grade 10"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_11" placeholder="Subject 11"/>
													<input type="text" class="form-control" name="level_1_subject_grade_11" placeholder="Grade 11"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_1_subject_12" placeholder="Subject 12"/>
													<input type="text" class="form-control" name="level_1_subject_grade_12" placeholder="Grade 12"/>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Result <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_1_result"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Year Awarded <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control level1year" name="level_1_year"/>
												</div>												
											</div>




											<h3 class="form-section">Inter / A Level</h3>
											<div class="form-group">
												<label class="control-label col-md-3">School / College Name <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_2_institute"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Inter / A-Level <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<div class="radio-list">
														<label>
														<input type="radio" name="college_level" value="Inter" data-title="Inter"/>
														Inter </label>
														<label>
														<input type="radio" name="college_level" value="A-Level" data-title="A-Level"/>
														A-Level </label>
														<label>
														<input type="radio" name="college_level" value="Other" data-title="Other"/>
														Other </label>
														<div id="form_college_level_error">
														</div>
													</div>													
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Inter / A Level Subjects <span class="required">
												* </span><br>(minimum 3) <span class="required">
												</label>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_2_subject_1" placeholder="Subject 1"/>
													<input type="text" class="form-control" name="level_2_subject_grade_1" placeholder="Grade 1"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_2_subject_2" placeholder="Subject 2"/>
													<input type="text" class="form-control" name="level_2_subject_grade_2" placeholder="Grade 2"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_2_subject_3" placeholder="Subject 3"/>
													<input type="text" class="form-control" name="level_2_subject_grade_3" placeholder="Grade 3"/>
												</div>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_2_subject_4" placeholder="Subject 4"/>
													<input type="text" class="form-control" name="level_2_subject_grade_4" placeholder="Grade 4"/>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3"></label>
												<div class="col-md-1">
													<input type="text" class="form-control" name="level_2_subject_5" placeholder="Subject 5"/>
													<input type="text" class="form-control" name="level_2_subject_grade_5" placeholder="Grade 5"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Result <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_2_result"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Year Awarded <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control level2year" name="level_2_year"/>
												</div>												
											</div>




											<h3 class="form-section">University</h3>
											<div class="form-group">
												<label class="control-label col-md-3">University Name <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_3_institute_req"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Degree <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_3_degree_req"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Main Subjects <span class="required">
												* </span><br>(comma separated values) <span class="required">
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_3_subjects_req"/>
												</div>												
											</div>											
											<div class="form-group">
												<label class="control-label col-md-3">Grade / GPA <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="level_3_grade_req"/>
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">Year Awarded <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control level2year" name="level_3_year_req"/>
												</div>
											</div>




											<!-- More Degrees -->
											<div class="containerXYZ">											
												<div class="form-group">
													<br><br>
													<label class="control-label col-md-3">University Name
														<br>(comma separated values) <span class="required">
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="level_3_institute[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Main Subjects
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="level_3_subjects[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Degree
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="level_3_degree[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Grade / GPA
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="level_3_grade[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Year Awarded
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="level_3_year[]"/>
													</div>																									
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">
													<button id='add'>Add University Qualification</button>
													<button id='remove'>Remove</button>
												</label>
											</div>											
										</div>										



										


										<div class="tab-pane active" id="tab5">
											<h3 class="block">Training and Professional </h3>

											<!-- More Degrees -->
											<div class="containerPRO">											
												<div class="form-group">
													<br><br>
													<label class="control-label col-md-3">Name / Title of Qualification														
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="pro_name[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Awarding Body / Institute
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="pro_institute[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Year Awarded
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control proyear" name="pro_year[]"/>
													</div>																									
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Detail
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="pro_detail[]"/>
													</div>												
												</div>												
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">
													<button id='add_pro'>Add Professional Qualification</button>
													<button id='remove_pro'>Remove</button>
												</label>
											</div>	

											
											<div class="form-group">
												<label class="control-label col-md-3">Training qualification or courses attended
												<br>(teaching or otherwise) <span class="required">
												</label>												
												<div class="col-md-4">
													<textarea id="maxlength_textarea" name="teaching_or_otherwise" class="form-control" maxlength="900" rows="8" placeholder="Limit of 900 chars."></textarea>
													<span class="help-block">														
													</span>
												</div>												
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">Additional qualification / Membership of professional association
												<br>(full details) <span class="required">
												</label>												
												<div class="col-md-4">
													<textarea id="maxlength_textarea" name="additional_qualification" class="form-control" maxlength="900" rows="8" placeholder="Limit of 900 chars."></textarea>
													<span class="help-block">														
													</span>
												</div>												
											</div>	

											<div class="form-group">
												<label class="control-label col-md-3">Please rate your IT expertise
												</label>
												<div class="col-md-1">Word
													<select name="it_word" id="it_word" class="form-control">														
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>
												<div class="col-md-1">Excel													
													<select name="it_excel" id="it_excel" class="form-control">														
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>
												<div class="col-md-1">PowerPoint													
													<select name="it_powerpoint" id="it_powerpoint" class="form-control">														
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>
												<div class="col-md-1">ERP Software													
													<select name="it_erp" id="it_erp" class="form-control">
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">
												</label>												
												<div class="col-md-1">Graphics													
													<select name="it_graphics" id="it_graphics" class="form-control">
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>
												<div class="col-md-1">Email													
													<select name="it_email" id="it_email" class="form-control">
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>
												<div class="col-md-1">Internet & Usage													
													<select name="it_internet" id="it_internet" class="form-control">
														<option value="0">Not Familiar</option>
														<option value="1">Beginner</option>
														<option value="2">Average</option>
														<option value="3">Fairly Proficient</option>
														<option value="4">Expert</option>
													</select>
												</div>												
											</div>

											<div class="form-group">
												<label class="control-label col-md-3">
												</label>												
												<div class="col-md-4">
													<input type="text" class="form-control" name="it_other"/>  Any other specialized skills
												</div>												
											</div>
										</div>





										<div class="tab-pane active" id="tab4">
											<h3 class="block">Employment Practicalities</h3>

											<div class="form-group">
												<label class="control-label col-md-3">Currently Employed <span class="required">
												* </span>
												</label>
												<div class="col-md-4">
													<div class="radio-list">
														<label>
														<input type="radio" name="currently_employed" value="Y" data-title="Yes"/>
														Yes </label>
														<label>
														<input type="radio" name="currently_employed" value="N" data-title="No"/>
														No </label>													
													</div>
													<div id="form_currently_employed_error">
													</div>												
												</div>
											</div>
											<div class="form-group">
												<br><br>
												<label class="control-label col-md-3">Notice period required to leave present job													
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="currently_employed_notice_period"/>
												</div>												
											</div>
											<div class="form-group">
												<br><br>
												<label class="control-label col-md-3">Current salary (gross)
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control currently_employed_salary" name="currently_employed_salary"/>
												</div>												
											</div>
											<div class="form-group">
												<br><br>
												<label class="control-label col-md-3">Expected salary at Generation's (gross)
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control expected_salary" name="expected_salary"/>
												</div>												
											</div>
											<div class="form-group">
												<br><br>
												<label class="control-label col-md-3">Current timings
												</label>
												<div class="col-md-4">
													<input type="text" class="form-control" name="currently_employed_timings"/>	
												</div>												
											</div>



											<h3 class="form-section">Your employment record (teaching and otherwise)</h3>
											<div class="containerABC">												
												<div class="form-group">
													<br><br>
													<label class="control-label col-md-3">Institution														
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="emp_institute[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Designation
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="emp_designation[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Class(s) taught (comma seperated)
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="emp_classes[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Subject(s) taught (comma seperated)
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="emp_subject[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Salary
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control expected_salary" name="emp_salary[]"/>
													</div>												
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">From (year)
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control level2year" name="emp_year_from[]"/>
													</div>																									
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">To (year)
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control level2year" name="emp_year_to[]"/>
													</div>																									
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">Reason for leaving
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="emp_leaving_reason[]"/>
													</div>																									
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3">
													<button id='add_emp_record'>Add</button>
													<button id='remove_emp_record'>Remove</button>
												</label>
											</div>										
										</div>										
									</div>					
								</div>


								<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<a href="javascript:;" class="btn default button-previous"> <i class="m-icon-swapleft"></i> Back </a>
											<a href="javascript:;" class="btn blue button-next">Continue <i class="m-icon-swapright m-icon-white"></i></a>											
											<a href="javascript: submitform();" class="btn green button-submit">Submit <i class="m-icon-swapright m-icon-white"></i></a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->		
	</div>
	<!-- END CONTENT -->	
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
	<!-- 2015 &copy; --> <a href="http://generations.gs/">Generation's School</a>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>components/assets_metronic362/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>components/assets_metronic362/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo base_url();?>components/assets_metronic362/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo base_url();?>components/assets_metronic362/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>components/assets_metronic362/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url();?>components/assets_metronic362/admin/pages/scripts/form-wizard.js"></script> -->
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
   FormWizard.init();
});


$(document).ready(function () {		
	jQuery.validator.addMethod("checked_employment_true", function(value, element){
		var ce_notice_period = $("input[name=currently_employed_notice_period]").val().length;
		var ce_employed_salary = $("input[name=currently_employed_salary]").val().length;
		var ce_expected = $("input[name=expected_salary]").val().length;
		var ce_timing = $("input[name=currently_employed_timings]").val().length;

		if($("input[type='radio'][name=currently_employed]:checked").val() == 'Y') {
			if(ce_notice_period>=1 && ce_employed_salary>=3 && ce_expected>=3 && ce_timing>=3){
				return true;
			}else{
				return false;
			}
		} else {
		    return true;
		};
	}, "required ! ");
}); 
</script>


<script type="text/javascript">

var FormWizard = function () {

    return {
        //main function to initiate the module
        init: function () {
            if (!jQuery().bootstrapWizard) {
                return;
            }

            function format(state) {
                if (!state.id) return state.text; // optgroup
                return "<img class='flag' src='<?php echo base_url();?>components/assets_metronic362/global/img/flags/" + state.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + state.text;
            }

            $("#country_list").select2({
                placeholder: "Select",
                allowClear: true,
                formatResult: format,
                formatSelection: format,
                escapeMarkup: function (m) {
                    return m;
                }
            });

            var form = $('#submit_form');
            var error = $('.alert-danger', form);
            var success = $('.alert-success', form);

            form.validate({
                doNotHideMessage: true, //this option enables to show the error/success messages on tab switch.
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input                   

                rules: {                	
                    //Position Applied For                    
                    position_applied: {                    	
                        required: true
                    },
                    //Seeking Position
                    seeking_position: {
            			minlength: 5,
            			maxlength: 140,
                        required: true
                    },
                    //Applied Before
                    applied_before: {                        
                        required: true
                    },
                    //Full Name
                    full_name: {
                    	minlength: 7, 
                    	maxlength: 50,                 
                        required: true
                    },
                    //Date of Birth
                    dob: {
                    	minlength: 9,
                        required: true
                    },
                    home_address: {
                    	required:true
                    },
                    //Gender
                    person_gender: {                    	
                        required: true
                    },
                    // School Level
                    school_level: {
                    	required: true
                    },
                    // College Level
                    college_level: {
                    	required: true
                    },
                    //Nationality
                    nationality: {                    	
                        required: true
                    },
                    //Religion
                    religion: {                    	
                    	required: true
                    },
                    //Marital Status
                    marital_status: {
                    	required: true
                    },
                    //Cell Number
                    cell_number: {
                    	minlength: 12,
                		required: true
                    },
                    //CNIC
                    cnic: {
                    	minlength: 15,
                		required: true
                    },




                    //Level 1
                    level_1_institute: {
                    	minlength: 9,
                		required: true
                    },                    
                    level_1_subjects: {
                		minlength: 4,
                		required: true
                    },
                    level_1_subject_1: {
                    	required: true
                    },
                    level_1_subject_2: {
                    	required: true
                    },
                    level_1_subject_3: {
                    	required: true
                    },
                    level_1_result: {
                    	minlength: 1,
                    	required: true
                    },
                    level_1_year: {                    	
                    	minlength: 4,
                    	required: true
                    },
                    //Level 2
                    level_2_institute: {
                    	minlength: 9,
                		required: true
                    },                    
                    level_2_subjects: {
                		minlength: 4,
                		required: true
                    },
                    level_2_result: {
                    	minlength: 1,
                    	required: true
                    },
                    level_2_year: {                    	
                    	minlength: 4,
                    	required: true
                    },


                    //Level 3
                    level_3_institute_req: {
                		minlength: 4,
                		required: true
                    },
                    level_3_subjects_req: {
                		minlength: 4,
                		required: true
                    },
                    level_2_subject_1: {
                    	required: true
                    },
                    level_2_subject_2: {
                    	required: true
                    },
                    level_2_subject_3: {
                    	required: true
                    },
                    level_3_degree_req: {
                    	minlength: 2,
                    	required: true
                    },
                    level_3_grade_req: {
                    	minlength: 1,
                    	required: true
                    },
                    level_3_year_req: {                    	
                    	minlength: 4,
                    	required: true
                    },



                    currently_employed: {
                    	required: true
                    },
                    currently_employed_salary: {
                    	maxlength: 7
                    },
                    when_can_join: {
                    	required: true,
                    	maxlength: 20
                    },
					birthPlace: {
						maxlength: 22
					}



                    currently_employed_notice_period : {
						checked_employment_true: true
					},
					currently_employed_salary : {
						checked_employment_true: true
					},
					expected_salary : {
						checked_employment_true: true
					},
					currently_employed_timings : {
						checked_employment_true: true
					},					

                    



                    //account
                    username: {
                        minlength: 5,
                        required: true
                    },
                    password: {
                        minlength: 5,
                        required: true
                    },
                    rpassword: {
                        minlength: 5,
                        required: true,
                        equalTo: "#submit_form_password"
                    },
                    //profile
                    fullname: {
                        required: true
                    },
                    email: {
                        required: true,
                        minlength: 5,
                        maxlength: 50,
                        email: true
                    },
                    phone: {
                        required: true
                    },
                    gender: {
                        required: true
                    },
                    address: {
                        required: true,
                        minlength: 5,
                        maxlength: 180
                    },
                    city: {
                        required: true
                    },
                    country: {
                        required: true
                    },
                    //payment
                    card_name: {
                        required: true
                    },
                    card_number: {
                        minlength: 16,
                        maxlength: 16,
                        required: true
                    },
                    card_cvc: {
                        digits: true,
                        required: true,
                        minlength: 3,
                        maxlength: 4
                    },
                    card_expiry_date: {
                        required: true
                    },
                    'payment[]': {
                        required: true,
                        minlength: 1
                    }
                },

                messages: { // custom messages for radio buttons and checkboxes
                    'payment[]': {
                        required: "Please select at least one option",
                        minlength: jQuery.validator.format("Please select at least one option")
                    }
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    if (element.attr("name") == "applied_before") { // for uniform radio buttons, insert the after the given container
                        error.insertAfter("#form_applied_before");
                    } else if (element.attr("name") == "gender") { 
                        error.insertAfter("#form_gender_error");
                    }else if (element.attr("name") == "school_level") {
                        error.insertAfter("#form_school_level_error");
                    }else if (element.attr("name") == "college_level") {
                        error.insertAfter("#form_college_level_error");
                    } else if (element.attr("name") == "currently_employed"){
                		error.insertAfter('#form_currently_employed_error');
                    } else if (element.attr("name") == "payment[]") { // for uniform checkboxes, insert the after the given container
                        error.insertAfter("#form_payment_error");
                    } else {
                        error.insertAfter(element); // for other inputs, just perform default behavior
                    }
                },

                invalidHandler: function (event, validator) { //display error alert on form submit   
                    success.hide();
                    error.show();
                    Metronic.scrollTo(error, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    if (label.attr("for") == "gender" || label.attr("for") == "payment[]") { // for checkboxes and radio buttons, no need to show OK icon
                        label
                            .closest('.form-group').removeClass('has-error').addClass('has-success');
                        label.remove(); // remove error label here
                    } else { // display success icon for other inputs
                        label
                            .addClass('valid') // mark the current input as valid and display OK icon
                        .closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    }
                },

                submitHandler: function (form) {
                    /*success.show();*/
                    error.hide();
                    
                    //add here some ajax code to submit your form or just call form.submit() if you want to submit the form without ajax
                }

            });			

            var displayConfirm = function() {
                $('#tab4 .form-control-static', form).each(function(){
                    var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                    if (input.is(":radio")) {
                        input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                    }
                    if (input.is(":text") || input.is("textarea")) {
                        $(this).html(input.val());
                    } else if (input.is("select")) {
                        $(this).html(input.find('option:selected').text());
                    } else if (input.is(":radio") && input.is(":checked")) {
                        $(this).html(input.attr("data-title"));
                    } else if ($(this).attr("data-display") == 'payment[]') {
                        var payment = [];
                        $('[name="payment[]"]:checked', form).each(function(){ 
                            payment.push($(this).attr('data-title'));
                        });
                        $(this).html(payment.join("<br>"));
                    }
                });
            }

            var handleTitle = function(tab, navigation, index) {
                var total = navigation.find('li').length;
                var current = index + 1;
                // set wizard title
                $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                // set done steps
                jQuery('li', $('#form_wizard_1')).removeClass("done");
                var li_list = navigation.find('li');
                for (var i = 0; i < index; i++) {
                    jQuery(li_list[i]).addClass("done");
                }

                if (current == 1) {
                    $('#form_wizard_1').find('.button-previous').hide();
                } else {
                    $('#form_wizard_1').find('.button-previous').show();
                }

                if (current >= total) {
                    $('#form_wizard_1').find('.button-next').hide();
                    $('#form_wizard_1').find('.button-submit').show();
                    displayConfirm();
                } else {
                    $('#form_wizard_1').find('.button-next').show();
                    $('#form_wizard_1').find('.button-submit').hide();
                }
                Metronic.scrollTo($('.page-title'));
            }

            // default form wizard
            $('#form_wizard_1').bootstrapWizard({
                'nextSelector': '.button-next',
                'previousSelector': '.button-previous',
                onTabClick: function (tab, navigation, index, clickedIndex) {
                    return false;
                    /*
                    success.hide();
                    error.hide();
                    if (form.valid() == false) {
                        return false;
                    }
                    handleTitle(tab, navigation, clickedIndex);
                    */
                },
                onNext: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    if (form.valid() == false) {
                        return false;
                    }

                    handleTitle(tab, navigation, index);
                },
                onPrevious: function (tab, navigation, index) {
                    success.hide();
                    error.hide();

                    handleTitle(tab, navigation, index);
                },
                onTabShow: function (tab, navigation, index) {
                    var total = navigation.find('li').length;
                    var current = index + 1;
                    var $percent = (current / total) * 100;
                    $('#form_wizard_1').find('.progress-bar').css({
                        width: $percent + '%'
                    });
                }
            });

            $('#form_wizard_1').find('.button-previous').hide();
            $('#form_wizard_1 .button-submit').click(function () {
                /*alert('Finished! Hope you like it :)');*/
            }).hide();



            //apply validation on select2 dropdown value change, this only needed for chosen dropdown integration.
            $('#country_list', form).change(function () {
                form.validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
            });
        }

    };

}();
</script>

<script>
$(function() {
	$( "#datepicker_dob" ).datepicker({		  
	  numberOfMonths: 1,		  
	  showButtonPanel: true,
	  changeMonth: true,
      changeYear: true,
      yearRange: "1940:2000"
	});
	$( "#datepicker_dob" ).datepicker( "option", "showAnim", "blind");
	$( "#datepicker_dob" ).datepicker( "option", "dateFormat", "dd-mm-yy");
});
</script>
<script src="<?php echo base_url();?>components/js/jquery.mask.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('.cell_number').mask('0399-9999999',{placeholder: "03xx-xXxXxXx"});
		$('.cnic').mask('99999-9999999-9');
		$('.landline').mask('021-99999999');
		$('.level1year').mask('9999');
		$('.level2year').mask('9999');
		$('.proyear').mask('9999');
		$('.currently_employed_salary').mask("#,##0,000", {reverse: true});	
		$('.expected_salary').mask("#,##0,000", {reverse: true});		
  	});	
</script>


<script>
function checkRemove() {
    if ($('div.containerXYZ').length == 1) {
        $('#remove').hide();
    } else {
        $('#remove').show();
    }
};
function checkRemove_EmpRecord() {
    if ($('div.containerABC').length == 1) {
        $('#remove_emp_record').hide();
    } else {
        $('#remove_emp_record').show();
    }
};
function checkRemove_ProRecord() {
    if ($('div.containerPRO').length == 1) {
        $('#remove_pro').hide();
    } else {
        $('#remove_pro').show();
    }
};
$(document).ready(function() {
    checkRemove()
    checkRemove_EmpRecord()
    $('#add').click(function() {
        $('div.containerXYZ:last').after($('div.containerXYZ:first').clone());
        checkRemove();
    });
    $('#remove').click(function() {
        $('div.containerXYZ:last').remove();
        checkRemove();
    });


    $('#add_emp_record').click(function() {
        $('div.containerABC:last').after($('div.containerABC:first').clone());
        checkRemove_EmpRecord();
    });
    $('#remove_emp_record').click(function() {
        $('div.containerABC:last').remove();
        checkRemove_EmpRecord();
    });


    $('#add_pro').click(function() {
        $('div.containerPRO:last').after($('div.containerPRO:first').clone());
        checkRemove_ProRecord();
    });
    $('#remove_pro').click(function() {
        $('div.containerPRO:last').remove();
        checkRemove_ProRecord();
    });
});
</script>


<script>
var ComponentsFormTools = function () {

    var handleTwitterTypeahead = function() {

        // Example #1
        // instantiate the bloodhound suggestion engine
        var numbers = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: [
            { num: 'metronic' },
            { num: 'keenthemes' },
            { num: 'metronic theme' },
            { num: 'metronic template' },
            { num: 'keenthemes team' }
          ]
        });
         
        // initialize the bloodhound suggestion engine
        numbers.initialize();
         
        // instantiate the typeahead UI
        if (Metronic.isRTL()) {
          $('#typeahead_example_1').attr("dir", "rtl");  
        }
        $('#typeahead_example_1').typeahead(null, {
          displayKey: 'num',
          hint: (Metronic.isRTL() ? false : true),
          source: numbers.ttAdapter()
        });

        // Example #2
        var countries = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          limit: 10,
          prefetch: {
            url: 'demo/typeahead_countries.json',
            filter: function(list) {
              return $.map(list, function(country) { return { name: country }; });
            }
          }
        });
 
        countries.initialize();
         
        if (Metronic.isRTL()) {
          $('#typeahead_example_2').attr("dir", "rtl");  
        } 
        $('#typeahead_example_2').typeahead(null, {
          name: 'typeahead_example_2',
          displayKey: 'name',
          hint: (Metronic.isRTL() ? false : true),
          source: countries.ttAdapter()
        });

        // Example #3
        var custom = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: 'demo/typeahead_custom.php?query=%QUERY'
        });
         
        custom.initialize();
         
        if (Metronic.isRTL()) {
          $('#typeahead_example_3').attr("dir", "rtl");  
        }  
        $('#typeahead_example_3').typeahead(null, {
          name: 'datypeahead_example_3',
          displayKey: 'value',
          source: custom.ttAdapter(),
          hint: (Metronic.isRTL() ? false : true),
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="{{img}}" width="50" height="50"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{value}}</h4>',
                        '<p>{{desc}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });

        // Example #4

        var nba = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.team); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: 'demo/typeahead_nba.json'
        });
         
        var nhl = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.team); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          prefetch: 'demo/typeahead_nhl.json'
        });
         
        nba.initialize();
        nhl.initialize();
         
        if (Metronic.isRTL()) {
          $('#typeahead_example_4').attr("dir", "rtl");  
        }
        $('#typeahead_example_4').typeahead({
          hint: (Metronic.isRTL() ? false : true),
          highlight: true
        },
        {
          name: 'nba',
          displayKey: 'team',
          source: nba.ttAdapter(),
          templates: {
                header: '<h3>NBA Teams</h3>'
          }
        },
        {
          name: 'nhl',
          displayKey: 'team',
          source: nhl.ttAdapter(),
          templates: {
                header: '<h3>NHL Teams</h3>'
          }
        });

    }

    var handleTwitterTypeaheadModal = function() {

        // Example #1
        // instantiate the bloodhound suggestion engine
        var numbers = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.num); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          local: [
            { num: 'metronic' },
            { num: 'keenthemes' },
            { num: 'metronic theme' },
            { num: 'metronic template' },
            { num: 'keenthemes team' }
          ]
        });
         
        // initialize the bloodhound suggestion engine
        numbers.initialize();
         
        // instantiate the typeahead UI
        if (Metronic.isRTL()) {
          $('#typeahead_example_modal_1').attr("dir", "rtl");  
        }
        $('#typeahead_example_modal_1').typeahead(null, {
          displayKey: 'num',
          hint: (Metronic.isRTL() ? false : true),
          source: numbers.ttAdapter()
        });

        // Example #2
        var countries = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.name); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          limit: 10,
          prefetch: {
            url: 'demo/typeahead_countries.json',
            filter: function(list) {
              return $.map(list, function(country) { return { name: country }; });
            }
          }
        });
 
        countries.initialize();
         
        if (Metronic.isRTL()) {
          $('#typeahead_example_modal_2').attr("dir", "rtl");  
        }
        $('#typeahead_example_modal_2').typeahead(null, {
          name: 'typeahead_example_modal_2',
          displayKey: 'name',
          hint: (Metronic.isRTL() ? false : true),
          source: countries.ttAdapter()
        });

        // Example #3
        var custom = new Bloodhound({
          datumTokenizer: function(d) { return d.tokens; },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          remote: 'demo/typeahead_custom.php?query=%QUERY'
        });
         
        custom.initialize();
         
        if (Metronic.isRTL()) {
          $('#typeahead_example_modal_3').attr("dir", "rtl");  
        }
        $('#typeahead_example_modal_3').typeahead(null, {
          name: 'datypeahead_example_modal_3',
          displayKey: 'value',
          hint: (Metronic.isRTL() ? false : true),
          source: custom.ttAdapter(),
          templates: {
            suggestion: Handlebars.compile([
              '<div class="media">',
                    '<div class="pull-left">',
                        '<div class="media-object">',
                            '<img src="{{img}}" width="50" height="50"/>',
                        '</div>',
                    '</div>',
                    '<div class="media-body">',
                        '<h4 class="media-heading">{{value}}</h4>',
                        '<p>{{desc}}</p>',
                    '</div>',
              '</div>',
            ].join(''))
          }
        });

        // Example #4

        var nba = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.team); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          limit: 3,
          prefetch: 'demo/typeahead_nba.json'
        });
         
        var nhl = new Bloodhound({
          datumTokenizer: function(d) { return Bloodhound.tokenizers.whitespace(d.team); },
          queryTokenizer: Bloodhound.tokenizers.whitespace,
          limit: 3,
          prefetch: 'demo/typeahead_nhl.json'
        });
         
        nba.initialize();
        nhl.initialize();
         
        $('#typeahead_example_modal_4').typeahead({
            hint: (Metronic.isRTL() ? false : true),
            highlight: true
        },
        {
          name: 'nba',
          displayKey: 'team',
          source: nba.ttAdapter(),
          templates: {
                header: '<h3>NBA Teams</h3>'
          }
        },
        {
          name: 'nhl',
          displayKey: 'team',
          source: nhl.ttAdapter(),
          templates: {
                header: '<h3>NHL Teams</h3>'
          }
        });

    }

    var handleBootstrapSwitch = function() {

        $('.switch-radio1').on('switch-change', function () {
            $('.switch-radio1').bootstrapSwitch('toggleRadioState');
        });

        // or
        $('.switch-radio1').on('switch-change', function () {
            $('.switch-radio1').bootstrapSwitch('toggleRadioStateAllowUncheck');
        });

        // or
        $('.switch-radio1').on('switch-change', function () {
            $('.switch-radio1').bootstrapSwitch('toggleRadioStateAllowUncheck', false);
        });

    }

    var handleBootstrapTouchSpin = function() {

        $("#touchspin_demo1").TouchSpin({          
            buttondown_class: 'btn green',
            buttonup_class: 'btn green',
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        }); 
        
        $("#touchspin_demo2").TouchSpin({
            buttondown_class: 'btn blue',
            buttonup_class: 'btn blue',
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });         

        $("#touchspin_demo3").TouchSpin({          
            buttondown_class: 'btn green',
            buttonup_class: 'btn green',
            prefix: "$",
            postfix: "%"
        });
    }

    var handleBootstrapMaxlength = function() {
        $('#maxlength_defaultconfig').maxlength({
            limitReachedClass: "label label-danger",
        })
    
        $('#maxlength_thresholdconfig').maxlength({
            limitReachedClass: "label label-danger",
            threshold: 20
        });

        $('#maxlength_alloptions').maxlength({
            alwaysShow: true,
            warningClass: "label label-success",
            limitReachedClass: "label label-danger",
            separator: ' out of ',
            preText: 'You typed ',
            postText: ' chars available.',
            validate: true
        });

        $('#maxlength_textarea').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true
        });

        $('#maxlength_placement').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true,
            placement: Metronic.isRTL() ? 'top-right' : 'top-left'
        });
    }

    var handleSpinners = function () {
        $('#spinner1').spinner();
        $('#spinner2').spinner({disabled: true});
        $('#spinner3').spinner({value:0, min: 0, max: 10});
        $('#spinner4').spinner({value:0, step: 5, min: 0, max: 200});
    }
    
    var handleTagsInput = function () {
        if (!jQuery().tagsInput) {
            return;
        }
        $('#tags_1').tagsInput({
            width: 'auto',
            'onAddTag': function () {
                //alert(1);
            },
        });
        $('#tags_2').tagsInput({
            width: 300
        });
    }
    
    var handleInputMasks = function () {
        $.extend($.inputmask.defaults, {
            'autounmask': true
        });

        $("#mask_date").inputmask("d/m/y", {
            autoUnmask: true
        }); //direct mask        
        $("#mask_date1").inputmask("d/m/y", {
            "placeholder": "*"
        }); //change the placeholder
        $("#mask_date2").inputmask("d/m/y", {
            "placeholder": "dd/mm/yyyy"
        }); //multi-char placeholder
        $("#mask_phone").inputmask("mask", {
            "mask": "(999) 999-9999"
        }); //specifying fn & options
        $("#mask_tin").inputmask({
            "mask": "99-9999999",
            placeholder: "" // remove underscores from the input mask
        }); //specifying options only
        $("#mask_number").inputmask({
            "mask": "9",
            "repeat": 10,
            "greedy": false
        }); // ~ mask "9" or mask "99" or ... mask "9999999999"
        $("#mask_decimal").inputmask('decimal', {
            rightAlignNumerics: false
        }); //disables the right alignment of the decimal input
        $("#mask_currency").inputmask('€ 999.999.999,99', {
            numericInput: true
        }); //123456  =>  € ___.__1.234,56

        $("#mask_currency2").inputmask('€ 999,999,999.99', {
            numericInput: true,
            rightAlignNumerics: false,
            greedy: false
        }); //123456  =>  € ___.__1.234,56
        $("#mask_ssn").inputmask("999-99-9999", {
            placeholder: " ",
            clearMaskOnLostFocus: true
        }); //default
    }

    var handleIPAddressInput = function () {
        $('#input_ipv4').ipAddress();
        $('#input_ipv6').ipAddress({
            v: 6
        });
    }

    var handlePasswordStrengthChecker = function () {
        var initialized = false;
        var input = $("#password_strength");

        input.keydown(function () {
            if (initialized === false) {
                // set base options
                input.pwstrength({
                    raisePower: 1.4,
                    minChar: 8,
                    verdicts: ["Weak", "Normal", "Medium", "Strong", "Very Strong"],
                    scores: [17, 26, 40, 50, 60]
                });

                // add your own rule to calculate the password strength
                input.pwstrength("addRule", "demoRule", function (options, word, score) {
                    return word.match(/[a-z].[0-9]/) && score;
                }, 10, true);

                // set as initialized 
                initialized = true;
            }
        });
    }

    var handleUsernameAvailabilityChecker1 = function () {
        var input = $("#username1_input");

        $("#username1_checker").click(function (e) {
            var pop = $(this);

            if (input.val() === "") {
                input.closest('.form-group').removeClass('has-success').addClass('has-error');

                pop.popover('destroy');
                pop.popover({
                    'placement': (Metronic.isRTL() ? 'left' : 'right'),
                    'html': true,
                    'container': 'body',
                    'content': 'Please enter a username to check its availability.',
                });
                // add error class to the popover
                pop.data('bs.popover').tip().addClass('error');
                // set last poped popover to be closed on click(see Metronic.js => handlePopovers function)     
                Metronic.setLastPopedPopover(pop);
                pop.popover('show');
                e.stopPropagation(); // prevent closing the popover

                return;
            }

            var btn = $(this);

            btn.attr('disabled', true);

            input.attr("readonly", true).
            attr("disabled", true).
            addClass("spinner");

            $.post('demo/username_checker.php', {
                username: input.val()
            }, function (res) {
                btn.attr('disabled', false);

                input.attr("readonly", false).
                attr("disabled", false).
                removeClass("spinner");

                if (res.status == 'OK') {
                    input.closest('.form-group').removeClass('has-error').addClass('has-success');

                    pop.popover('destroy');
                    pop.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message,
                    });
                    pop.popover('show');
                    pop.data('bs.popover').tip().removeClass('error').addClass('success');
                } else {
                    input.closest('.form-group').removeClass('has-success').addClass('has-error');

                    pop.popover('destroy');
                    pop.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message,
                    });
                    pop.popover('show');
                    pop.data('bs.popover').tip().removeClass('success').addClass('error');
                    Metronic.setLastPopedPopover(pop);
                }

            }, 'json');

        });
    }

    var handleUsernameAvailabilityChecker2 = function () {
        $("#username2_input").change(function () {
            var input = $(this);

            if (input.val() === "") {
                input.closest('.form-group').removeClass('has-error').removeClass('has-success');
                $('.fa-check, fa-warning', input.closest('.form-group')).remove();

                return;
            }

            input.attr("readonly", true).
            attr("disabled", true).
            addClass("spinner");

            $.post('demo/username_checker.php', {
                username: input.val()
            }, function (res) {
                input.attr("readonly", false).
                attr("disabled", false).
                removeClass("spinner");

                // change popover font color based on the result
                if (res.status == 'OK') {
                    input.closest('.form-group').removeClass('has-error').addClass('has-success');
                    $('.fa-warning', input.closest('.form-group')).remove();
                    input.before('<i class="fa fa-check"></i>');
                    input.data('bs.popover').tip().removeClass('error').addClass('success');
                } else {
                    input.closest('.form-group').removeClass('has-success').addClass('has-error');
                    $('.fa-check', input.closest('.form-group')).remove();
                    input.before('<i class="fa fa-warning"></i>');

                    input.popover('destroy');
                    input.popover({
                        'html': true,
                        'placement': (Metronic.isRTL() ? 'left' : 'right'),
                        'container': 'body',
                        'content': res.message,
                    });
                    input.popover('show');
                    input.data('bs.popover').tip().removeClass('success').addClass('error');

                    Metronic.setLastPopedPopover(input);
                }

            }, 'json');

        });
    }

    return {
        //main function to initiate the module
        init: function () {
            handleTwitterTypeahead();
            handleTwitterTypeaheadModal();

            handleBootstrapSwitch();
            handleBootstrapTouchSpin();
            handleBootstrapMaxlength();
            handleSpinners();
            handleTagsInput();
            handleInputMasks();
            handleIPAddressInput();
            handlePasswordStrengthChecker();
            handleUsernameAvailabilityChecker1();
            handleUsernameAvailabilityChecker2();
        }
    };

}();
</script>
<!-- END JAVASCRIPTS -->


<script type="text/javascript">
function submitform()
{
  document.submit_form.submit();
}
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#select_grade_1").select2();
  });

  $(document).ready(function() {
    $("#select_grade_2").select2();
  });

  $(document).ready(function() {
    $("#select_grade_3").select2();
  });

  $(document).ready(function() {
    $("#select_grade_4").select2();
  });




  $(document).ready(function() {
    $("#select_grade_subject_1").select2();
  });

  $(document).ready(function() {
    $("#select_grade_subject_2").select2();
  });

  $(document).ready(function() {
    $("#select_grade_subject_3").select2();
  });

  $(document).ready(function() {
    $("#select_grade_subject_4").select2();
  });
</script>

</body>
<!-- END BODY -->
</html>