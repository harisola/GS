<!--<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Generation's School</title>
</head>

<body>
	<form action="<?php /*echo site_url();*/ ?>/career/add" method="post">
	<h1>Generation's School</h1>

	
		<?php /*echo form_input(array(
			'name' => 'name',
			'type' => 'text',
			'placeholder' => 'Name',
			'class' => 'form-control',
			'required' => 'required',
			'autofocus' => 'autofocus',
		));*/ ?>

		<br> <br>
		<?php /*echo form_input(array(
			'name' => 'father_name',
			'type' => 'text',
			'placeholder' => 'Father Name',
			'class' => 'form-control',
			'required' => 'required',	        	
		));*/ ?>


		<br> <br>
		<?php /*echo form_submit(array(
			'type' => 'submit',
			'value' => 'Proceed',						
		));*/ ?>
	
	</form>
</body>

</html>-->

<!DOCTYPE html>

<html lang="en">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>Career</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->		
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/animate.css/animate.min.css">
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR SUBVIEW CONTENTS -->
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/owl-carousel/owl-carousel/owl.carousel.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/owl-carousel/owl-carousel/owl.theme.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/owl-carousel/owl-carousel/owl.transitions.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/summernote/dist/summernote.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/fullcalendar/fullcalendar/fullcalendar.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/toastr/toastr.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/bootstrap-select/bootstrap-select.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/DataTables/media/css/DT_bootstrap.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
		<!-- end: CSS REQUIRED FOR THIS SUBVIEW CONTENTS-->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/css/styles.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/css/styles-responsive.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/css/plugins.css">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/css/themes/theme-default.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo base_url()?>components/assets_career/css/print.css" type="text/css" media="print"/>
		<!-- end: CORE CSS -->
		<link rel="shortcut icon" href="favicon.ico" />
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body>
		
		<div class="main-wrapper">
			
			<div class="row">
				<div class="col-sm-12">
					<!-- start: FORM WIZARD PANEL -->
					<div class="panel panel-white">						
						<div class="panel-body">
							<form action="<?php echo site_url();?>/career/add" method="post" role="form" class="smart-wizard form-horizontal" id="form">
								<div id="wizard" class="swMain">
									<ul class="anchor">
										<li>
											<a href="#step-1" class="selected" isdone="1" rel="1">
												<div class="stepNumber">
													1
												</div>
												<span class="stepDesc"> Step 1
													<br>
													<small>Personal Details</small> </span>
											</a>
										</li>
										<li>
											<a href="#step-2" class="disabled" isdone="0" rel="2">
												<div class="stepNumber">
													2
												</div>
												<span class="stepDesc"> Step 2
													<br>
													<small>Educational Record</small> </span>
											</a>
										</li>
										<li>
											<a href="#step-3" class="disabled" isdone="0" rel="3">
												<div class="stepNumber">
													3
												</div>
												<span class="stepDesc"> Step 3
													<br>
													<small>Training, Skills and Experience</small> </span>
											</a>
										</li>
										<li>
											<a href="#step-4" class="disabled" isdone="0" rel="4">
												<div class="stepNumber">
													4
												</div>
												<span class="stepDesc"> Step 4
													<br>
													<small>Employment Practicalities</small> </span>
											</a>
										</li>
										<li>
											<a href="#step-5" class="disabled" isdone="0" rel="5">
												<div class="stepNumber">
													5
												</div>
												<span class="stepDesc"> Step 5
													<br>
													<small>Family Information</small> </span>
											</a>
										</li>
										<li>
											<a href="#step-6" class="disabled" isdone="0" rel="6">
												<div class="stepNumber">
													6
												</div>
												<span class="stepDesc"> Step 6
													<br>
													<small>Referees</small> </span>
											</a>
										</li>
										<li>
											<a href="#step-7" class="disabled" isdone="0" rel="7">
												<div class="stepNumber">
													7
												</div>
												<span class="stepDesc"> Step 7
													<br>
													<small>What can you offer us?</small> </span>
											</a>
										</li>
									</ul>
									
									
									
									
									
								<div class="stepContainer" style="height: 353px;"><div class="progress progress-xs transparent-black no-radius active content">
										<div aria-valuemax="100" aria-valuemin="0" role="progressbar" class="progress-bar partition-green step-bar" style="width: 25%;">
											<span class="sr-only"> 0% Complete (success)</span>
										</div>
									</div><div id="step-1" class="content" style="display: block;">
										<h2 class="StepTitle">Step 1 : Personal Details</h2>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Full Name <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Father's / Spouse Name <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="fs_name" name="fs_name" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Email <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="email" class="form-control" id="email" name="email" placeholder="Text Field">
											</div>
										</div>										
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-8">
												<button class="btn btn-blue next-step btn-block">
													Next <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>



									</div><div id="step-2" class="content" style="display: none;">
										<h2 class="StepTitle">Step 2 Content</h2>
										<!-- <div class="form-group">
											<label class="col-sm-3 control-label">
												full_name <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="full_name" name="full_name" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Phone Number <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="phone" name="phone" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Gender <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<label class="radio-inline">
													<div class="iradio_minimal-grey" style="position: relative;"><input type="radio" class="grey" value="f" name="gender" id="gender_female" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
													Female
												</label>
												<label class="radio-inline">
													<div class="iradio_minimal-grey" style="position: relative;"><input type="radio" class="grey" value="m" name="gender" id="gender_male" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
													Male
												</label>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Address <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="address" name="address" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Country <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<select class="form-control" id="country" name="country">
													<option value="">&nbsp;</option>
													<option value="Country 1">Country 1</option>
													<option value="Country 2">Country 2</option>
													<option value="Country 3">Country 3</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												City <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="city" name="city" placeholder="Text Field">
											</div>
										</div> -->
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-light-grey back-step btn-block">
													<i class="fa fa-circle-arrow-left"></i> Back
												</button>
											</div>
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-blue next-step btn-block">
													Next <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>
									</div><div id="step-3" class="content" style="display: none;">
										<h2 class="StepTitle">Step 3 Title</h2>
										<!-- <div class="form-group">
											<label class="col-sm-3 control-label">
												Card Holder Name <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="card_name" name="card_name" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Card Number <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<input type="text" class="form-control" id="card_number" name="card_number" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												CVC <span class="symbol required"></span>
											</label>
											<div class="col-sm-4">
												<input type="text" class="form-control" id="card_cvc" name="card_cvc" placeholder="Text Field">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Expiration(MM/YYYY) <span class="symbol required"></span>
											</label>
											<div class="col-sm-4">
												<div class="row">
													<div class="col-sm-4">
														<select class="form-control" id="card_expiry_mm" name="card_expiry_mm">
															<option value="">MM</option>
															<option value="01">1</option>
															<option value="02">2</option>
															<option value="03">3</option>
															<option value="04">4</option>
															<option value="05">5</option>
															<option value="06">6</option>
															<option value="07">7</option>
															<option value="08">8</option>
															<option value="09">9</option>
															<option value="10">10</option>
															<option value="11">11</option>
															<option value="12">12</option>
														</select>
													</div>
													<div class="col-sm-4">
														<input type="text" class="form-control" name="card_expiry_yyyy" id="card_expiry_yyyy" placeholder="YYYY">
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Payment Options <span class="symbol required"></span>
											</label>
											<div class="col-sm-7">
												<div class="checkbox">
													<label>
														<div class="icheckbox_minimal-grey" style="position: relative;"><input type="checkbox" class="grey" value="" name="payment" id="payment1" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
														Auto-Pay with this Credit Card
													</label>
												</div>
												<div class="checkbox">
													<label>
														<div class="icheckbox_minimal-grey" style="position: relative;"><input type="checkbox" class="grey" value="" name="payment" id="payment2" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"><ins class="iCheck-helper" style="position: absolute; top: -10%; left: -10%; display: block; width: 120%; height: 120%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins></div>
														Email me monthly billing
													</label>
												</div>
											</div>
										</div> -->
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-light-grey back-step btn-block">
													<i class="fa fa-circle-arrow-left"></i> Back
												</button>
											</div>
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-blue next-step btn-block">
													Next <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>
									</div><div id="step-4" class="content" style="display: none;">
										<h2 class="StepTitle">Step 4 Title</h2>
										<!-- <h3>Account</h3>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Username:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="username"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Email:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="email"></p>
											</div>
										</div>
										<h3>Profile</h3>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Fullname:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="full_name"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Gender:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="gender"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Phone:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="phone"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Address:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="address"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												City:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="city"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Country:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="country"></p>
											</div>
										</div>
										<h3>Billing</h3>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Card Name:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="card_name"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Card Number:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="card_number"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												CVC:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="card_cvc"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Expiration:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="card_expiry"></p>
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-3 control-label">
												Payment Options:
											</label>
											<div class="col-sm-7">
												<p class="form-control-static display-value" data-display="payment"></p>
											</div>
										</div> -->										
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-light-grey back-step btn-block">
													<i class="fa fa-circle-arrow-left"></i> Back
												</button>
											</div>
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-blue next-step btn-block">
													Next <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>

										</div><div id="step-5" class="content" style="display: none;">
										<h2 class="StepTitle">Step 5 Title</h2>
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-light-grey back-step btn-block">
													<i class="fa fa-circle-arrow-left"></i> Back
												</button>
											</div>
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-blue next-step btn-block">
													Next <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>

										</div><div id="step-6" class="content" style="display: none;">
										<h2 class="StepTitle">Step 6 Title</h2>
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-light-grey back-step btn-block">
													<i class="fa fa-circle-arrow-left"></i> Back
												</button>
											</div>
											<div class="col-sm-2 col-sm-offset-3">
												<button class="btn btn-blue next-step btn-block">
													Next <i class="fa fa-arrow-circle-right"></i>
												</button>
											</div>
										</div>


										</div><div id="step-7" class="content" style="display: none;">
										<h2 class="StepTitle">Step 7 Title</h2>
										<div class="form-group">
											<div class="col-sm-2 col-sm-offset-8">
												<!-- <button type="submit" class="btn btn-success finish-step btn-block">
													Finish <i class="fa fa-arrow-circle-right"></i>
												</button> -->
												<?php echo form_submit(array(
													'type' => 'submit',
													'value' => 'Proceed',
													'class' => 'btn btn-success btn-block',													
												)); ?>
											</div>
										</div>

									</div></div><div class="actionBar"><div class="msgBox"><div class="content"></div><a href="#" class="close">X</a></div><div class="loader">Loading</div><a href="#" class="buttonFinish buttonDisabled">Finish</a><a href="#" class="buttonNext">Next</a><a href="#" class="buttonPrevious buttonDisabled">Previous</a></div></div>
							</form>
						</div>
					</div>
					<!-- end: FORM WIZARD PANEL -->
				</div>
			</div>
			
			<!-- start: FOOTER -->
			<footer class="inner">
				<div class="footer-inner">
					<div class="pull-left">
						2015 &copy; Generation's School
					</div>
					<div class="pull-right">
						<span class="go-top"><i class="fa fa-chevron-up"></i></span>
					</div>
				</div>
			</footer>
			<!-- end: FOOTER -->
			<!-- start: SUBVIEW SAMPLE CONTENTS -->
			<!-- *** NEW NOTE *** -->
			<div id="newNote">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new note</h3>
					<form class="form-note">
						<div class="form-group">
							<input class="note-title form-control" name="noteTitle" type="text" placeholder="Note Title...">
						</div>
						<div class="form-group">
							<textarea id="noteEditor" name="noteEditor" class="hide"></textarea>
							<textarea class="summernote" placeholder="Write note here..."></textarea>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info save-note" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** READ NOTE *** -->
			<div id="readNote">
				<div class="barTopSubview">
					<a href="#newNote" class="new-note button-sv"><i class="fa fa-plus"></i> Add new note</a>
				</div>
				<div class="noteWrap col-md-8 col-md-offset-2">
					<div class="panel panel-note">
						<div class="e-slider owl-carousel owl-theme">
							<div class="item">
								<div class="panel-heading">
									<h3>This is a Note</h3>
								</div>
								<div class="panel-body">
									<div class="note-short-content">
										Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...
									</div>
									<div class="note-content">
										Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.
										Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquid ex ea commodi consequat.
										Quis aute iure reprehenderit in <strong>voluptate velit</strong> esse cillum dolore eu fugiat nulla pariatur.
										<br>
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										<br>
										Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
										<br>
										Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
										<br>
										Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
										<br>
										At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
										<br>
										Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
										<br>
										Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
									</div>
									<div class="note-options pull-right">
										<a href="#readNote" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
									</div>
								</div>
								<div class="panel-footer">
									<div class="avatar-note"><img src="<?php echo base_url()?>components/assets_career/images/avatar-2-small.jpg" alt="">
									</div>
									<span class="author-note">Nicole Bell</span>
									<time class="timestamp" title="2014-02-18T00:00:00-05:00">
										2014-02-18T00:00:00-05:00
									</time>
								</div>
							</div>
							<div class="item">
								<div class="panel-heading">
									<h3>This is the second Note</h3>
								</div>
								<div class="panel-body">
									<div class="note-short-content">
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Nemo enim ipsam voluptatem, quia voluptas sit...
									</div>
									<div class="note-content">
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										<br>
										Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
										<br>
										Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
										<br>
										Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur?
										<br>
										Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae.
										<br>
										Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.
									</div>
									<div class="note-options pull-right">
										<a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
									</div>
								</div>
								<div class="panel-footer">
									<div class="avatar-note"><img src="<?php echo base_url()?>components/assets_career/images/avatar-3-small.jpg" alt="">
									</div>
									<span class="author-note">Steven Thompson</span>
									<time class="timestamp" title="2014-02-18T00:00:00-05:00">
										2014-02-18T00:00:00-05:00
									</time>
								</div>
							</div>
							<div class="item">
								<div class="panel-heading">
									<h3>This is yet another Note</h3>
								</div>
								<div class="panel-body">
									<div class="note-short-content">
										At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores...
									</div>
									<div class="note-content">
										At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
										<br>
										Excepteur sint obcaecat cupiditat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
										<br>
										Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci v'elit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem.
										<br>
										Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut <strong>aliquid ex ea commodi consequatur?</strong>
									</div>
									<div class="note-options pull-right">
										<a href="#" class="read-note"><i class="fa fa-chevron-circle-right"></i> Read</a><a href="#" class="delete-note"><i class="fa fa-times"></i> Delete</a>
									</div>
								</div>
								<div class="panel-footer">
									<div class="avatar-note"><img src="<?php echo base_url()?>components/assets_career/images/avatar-4-small.jpg" alt="">
									</div>
									<span class="author-note">Ella Patterson</span>
									<time class="timestamp" title="2014-02-18T00:00:00-05:00">
										2014-02-18T00:00:00-05:00
									</time>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- *** SHOW CALENDAR *** -->
			<div id="showCalendar" class="col-md-10 col-md-offset-1">
				<div class="barTopSubview">
					<a href="#newEvent" class="new-event button-sv" data-subviews-options='{"onShow": "editEvent()"}'><i class="fa fa-plus"></i> Add new event</a>
				</div>
				<div id="calendar"></div>
			</div>
			<!-- *** NEW EVENT *** -->
			<div id="newEvent">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new event</h3>
					<form class="form-event">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input class="event-id hide" type="text">
									<input class="event-name form-control" name="eventName" type="text" placeholder="Event Name...">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="checkbox" class="all-day" data-label-text="All-Day" data-on-text="True" data-off-text="False">
								</div>
							</div>
							<div class="no-all-day-range">
								<div class="col-md-8">
									<div class="form-group">
										<div class="form-group">
											<span class="input-icon">
												<input type="text" class="event-range-date form-control" name="eventRangeDate" placeholder="Range date"/>
												<i class="fa fa-clock-o"></i> </span>
										</div>
									</div>
								</div>
							</div>
							<div class="all-day-range">
								<div class="col-md-8">
									<div class="form-group">
										<div class="form-group">
											<span class="input-icon">
												<input type="text" class="event-range-date form-control" name="ad_eventRangeDate" placeholder="Range date"/>
												<i class="fa fa-calendar"></i> </span>
										</div>
									</div>
								</div>
							</div>
							<div class="hide">
								<input type="text" class="event-start-date" name="eventStartDate"/>
								<input type="text" class="event-end-date" name="eventEndDate"/>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<select class="form-control selectpicker event-categories">
										<option data-content="<span class='event-category event-cancelled'>Cancelled</span>" value="event-cancelled">Cancelled</option>
										<option data-content="<span class='event-category event-home'>Home</span>" value="event-home">Home</option>
										<option data-content="<span class='event-category event-overtime'>Overtime</span>" value="event-overtime">Overtime</option>
										<option data-content="<span class='event-category event-generic'>Generic</span>" value="event-generic" selected="selected">Generic</option>
										<option data-content="<span class='event-category event-job'>Job</span>" value="event-job">Job</option>
										<option data-content="<span class='event-category event-offsite'>Off-site work</span>" value="event-offsite">Off-site work</option>
										<option data-content="<span class='event-category event-todo'>To Do</span>" value="event-todo">To Do</option>
									</select>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="summernote" placeholder="Write note here..."></textarea>
								</div>
							</div>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info save-new-event" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** READ EVENT *** -->
			<div id="readEvent">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<div class="row">
						<div class="col-md-12">
							<h2 class="event-title">Event Title</h2>
							<div class="btn-group options-toggle pull-right">
								<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
									<i class="fa fa-cog"></i>
									<span class="caret"></span>
								</button>
								<ul role="menu" class="dropdown-menu dropdown-light pull-right">
									<li>
										<a href="#newEvent" class="edit-event">
											<i class="fa fa-pencil"></i> Edit
										</a>
									</li>
									<li>
										<a href="#" class="delete-event">
											<i class="fa fa-times"></i> Delete
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="col-md-6">
							<span class="event-category event-cancelled">Cancelled</span>
							<span class="event-allday"><i class='fa fa-check'></i> All-Day</span>
						</div>
						<div class="col-md-12">
							<div class="event-start">
								<div class="event-day"></div>
								<div class="event-date"></div>
								<div class="event-time"></div>
							</div>
							<div class="event-end"></div>
						</div>
						<div class="col-md-12">
							<div class="event-content"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- *** NEW CONTRIBUTOR *** -->
			<div id="newContributor">
				<div class="noteWrap col-md-8 col-md-offset-2">
					<h3>Add new contributor</h3>
					<form class="form-contributor">
						<div class="row">
							<div class="col-md-12">
								<div class="errorHandler alert alert-danger no-display">
									<i class="fa fa-times-sign"></i> You have some form errors. Please check below.
								</div>
								<div class="successHandler alert alert-success no-display">
									<i class="fa fa-ok"></i> Your form validation is successful!
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="contributor-id hide" type="text">
									<label class="control-label">
										First Name <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Insert your First Name" class="form-control contributor-firstname" name="firstname">
								</div>
								<div class="form-group">
									<label class="control-label">
										Last Name <span class="symbol required"></span>
									</label>
									<input type="text" placeholder="Insert your Last Name" class="form-control contributor-lastname" name="lastname">
								</div>
								<div class="form-group">
									<label class="control-label">
										Email Address <span class="symbol required"></span>
									</label>
									<input type="email" placeholder="Text Field" class="form-control contributor-email" name="email">
								</div>
								<div class="form-group">
									<label class="control-label">
										Password <span class="symbol required"></span>
									</label>
									<input type="password" class="form-control contributor-password" name="password">
								</div>
								<div class="form-group">
									<label class="control-label">
										Confirm Password <span class="symbol required"></span>
									</label>
									<input type="password" class="form-control contributor-password-again" name="password_again">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label">
										Gender <span class="symbol required"></span>
									</label>
									<div>
										<label class="radio-inline">
											<input type="radio" class="grey contributor-gender" value="F" name="gender">
											Female
										</label>
										<label class="radio-inline">
											<input type="radio" class="grey contributor-gender" value="M" name="gender">
											Male
										</label>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										Permits <span class="symbol required"></span>
									</label>
									<select name="permits" class="form-control contributor-permits" >
										<option value="View and Edit">View and Edit</option>
										<option value="View Only">View Only</option>
									</select>
								</div>
								<div class="form-group">
									<div class="fileupload fileupload-new contributor-avatar" data-provides="fileupload">
										<div class="fileupload-new thumbnail"><img src="<?php echo base_url()?>components/assets_career/images/anonymous.jpg" alt="" width="50" height="50"/>
										</div>
										<div class="fileupload-preview fileupload-exists thumbnail"></div>
										<div class="contributor-avatar-options">
											<span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select image</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
												<input type="file">
											</span>
											<a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload">
												<i class="fa fa-times"></i> Remove
											</a>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label">
										SEND MESSAGE (Optional)
									</label>
									<textarea class="form-control contributor-message"></textarea>
								</div>
							</div>
						</div>
						<div class="pull-right">
							<div class="btn-group">
								<a href="#" class="btn btn-info close-subview-button">
									Close
								</a>
							</div>
							<div class="btn-group">
								<button class="btn btn-info save-contributor" type="submit">
									Save
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<!-- *** SHOW CONTRIBUTORS *** -->
			<div id="showContributors">
				<div class="barTopSubview">
					<a href="#newContributor" class="new-contributor button-sv"><i class="fa fa-plus"></i> Add new contributor</a>
				</div>
				<div class="noteWrap col-md-10 col-md-offset-1">
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="contributors">
								<div class="options-contributors hide">
									<div class="btn-group">
										<button class="btn dropdown-toggle btn-transparent-grey" data-toggle="dropdown">
											<i class="fa fa-cog"></i>
											<span class="caret"></span>
										</button>
										<ul role="menu" class="dropdown-menu dropdown-light pull-right">
											<li>
												<a href="#newContributor" class="show-subviews edit-contributor">
													<i class="fa fa-pencil"></i> Edit
												</a>
											</li>
											<li>
												<a href="#" class="delete-contributor">
													<i class="fa fa-times"></i> Delete
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end: SUBVIEW SAMPLE CONTENTS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?php echo base_url()?>components/assets_career/plugins/respond.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>components/assets_career/plugins/jQuery/jquery-1.11.1.min.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?php echo base_url()?>components/assets_career/plugins/jQuery/jquery-2.1.1.min.js"></script>
		<!--<![endif]-->
		<script src="<?php echo base_url()?>components/assets_career/plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/moment/min/moment.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootbox/bootbox.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/jquery.scrollTo/jquery.scrollTo.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/ScrollToFixed/jquery-scrolltofixed-min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/jquery.appear/jquery.appear.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/velocity/jquery.velocity.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/TouchSwipe/jquery.touchSwipe.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<script src="<?php echo base_url()?>components/assets_career/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/jquery-mockjax/jquery.mockjax.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/toastr/toastr.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap-switch/dist/js/bootstrap-switch.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap-select/bootstrap-select.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/DataTables/media/js/DT_bootstrap.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/truncate/jquery.truncate.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/summernote/dist/summernote.min.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/js/subview.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/js/subview-examples.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR SUBVIEW CONTENTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo base_url()?>components/assets_career/plugins/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
		<script src="<?php echo base_url()?>components/assets_career/js/form-wizard.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CORE JAVASCRIPTS  -->
		<script src="<?php echo base_url()?>components/assets_career/js/main.js"></script>
		<!-- end: CORE JAVASCRIPTS  -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				SVExamples.init();
				FormWizard.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>

