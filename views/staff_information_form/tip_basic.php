<!--div clas="container" -->

<style>
.page-header{
	display:none;
}
.table > thead > tr > th{
	/*background:#3b8dbd;*/

	background:#00a9ae;
	color:#fff;
	border:0 none;
	text-align:center;
}
.tabs-right .tab-content .tab-pane, .tabs-left .tab-content .tab-pane{
	 padding-left: 0;
	 padding-top:0;
	 padding-right:0;
}
.orb-form header{
	border-bottom:0 none;
}
.callout{
	padding:17px 0 0 58px;
	font-size:14px;
}
.btn.btn-primary.btn-sm{ float:right;margin-right:15px;background:#00a9ae;color:#fff;}

.tabbable .tab-content .tab-pane {
    border-left: 7px solid #ddd;
}
.table > thead > tr > th, .table > thead > th{
border-right: 1px solid #e2eee9 !important;
}


</style>
<!--script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script -->

<div id="powerwidgets" class="row" ng-app="">
<div class="col-md-12">

<div class="col-md-6">
<h1 style="color:#949fb2; font-size:20px;">TIF-B<small>Form</small> <small> <span ng-bind="fullName"  ng-init="fullName='<?=$employer->name;?>'" > <?=$employer->name;?> </span> </small></h1>
</div>
<div class="col-md-6">
<!--a href="<=base_url();?>index.php/staff_information_form_basic/tifb" class="btn btn-primary btn-sm" style="float:left;"> Back </a -->
<?php /* ?>
<form action="<?=base_url();?>index.php/staff_information_form_basic/tifb" method="post" target="_blank">
	<input type="hidden" name="staffgtID" value="<?php echo $employer->gt_id;?>" />
	<input type="hidden" name="printform" value="yes">
	<button type="submit" value="Print Form"  class="btn btn-primary btn-sm"> Print Form </button>
</form>
<?php */ ?>

</div>

</div>



 <div class="col-md-12 bootstrap-grid">


 <div class="powerwidget cold-grey" id="power-forms-grid" data-widget-editbutton="false">

 <div class="col-md-12">

  <div class="col-md-6" style="padding-left:0px;margin-top:10px;">
	<form action="<?php echo site_url()?>/staff_information_form_basic/tifb" id="visitor_guest_assignedcard_form" name="visitor_guest_assignedcard_form" class="orb-form navbar-left" novalidate="novalidate" method="POST">
<table class="table table-borderless">
  <!--thead><th colspan="2">Search new </th></thead -->
<tbody>
<tr>
	<td style="padding-left:0px;">
		<label class="input" style="padding-left:0px;">
		<input type="text" name="gs_id" autofocus="autofocus" placeholder="Search GT-ID" id="searchGtIDFitB" style="height:30px;fontStyle='italic'" />
		</label>
	</td>
	<td>
		<button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i> Search </button>
	</td>
</tr>
</tbody>
</table>

 </form>
 </div>

  <div class="col-md-6" style="margin-top:10px;margin-bottom:5px;padding-right:0">

<form action="<?=base_url();?>index.php/staff_information_form_basic/tifb" method="post" target="_blank">
	<input type="hidden" name="solangigtID" value="<?php echo $employer->gt_id;?>" />
	<input type="hidden" name="kashifPrintForm" value="1" />
	<button type="submit" value="Print Form"  class="btn btn-primary btn-sm" style="margin-right:0">
<!--	<img src="http://wwwimages.adobe.com/content/dam/acom/en/legal/images/badges/Adobe_PDF_file_icon_32x32.png" > -->
	<!--i class="fa fa-file-pdf-o"></i -->
	Generate Report <?=$employer->name;?>  </button>
</form>

  </div>


</div>

 <div class="inner-spacer" role="content" style="padding-top:0px;">





<?php

if(validation_errors() != false) {
  echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
}else{
  if(count($_POST)){
	//echo '<div class="callout callout-info"> saved success. </div>';
  }
}
?>
<style>
.nav-tabs > li.active > a,  .nav-tabs > li.active > a:hover,  .nav-tabs > li.active > a:focus {
    /*background-color: #858689;*/
	background-color: #993838;
	border-color: #858689;
    color: #fff;
    cursor: default;
}
.nav-tabs { text-transform: uppercase; }


.powerwidget.dark-red > header {
  font-size: 16px;
    font-weight: bold;
    height: 38px;
    line-height: 40px;
    margin-left: 10px;
    padding: 0 0 0 10px;
}
.fa.fa-times-circle { display: none; }
.fa.fa-chevron-circle-up{ display:none; }
.fa.fa-arrows-alt{ display:none; }
.button-icon.powerwidget-fullscreen-btn{display:none;}

.powerwidget-ctrls {
    float: right;
    margin: 0;
    padding: 7px 20px 0 0;
    width: auto;
}
.table-borderless tbody tr td, .table-borderless tbody tr th, .table-borderless thead tr th {
    border: none;
}

</style>
  <!-- /tabbable tabs-left -->
  <!--div class="col-md-12">
  <div class="col-md-11"></div>
	<div class="col-md-1">
	 <a href="<base_url();?>index.php/staff_information_form_basic/tifb" class="btn btn-default btn-sm"> Back </a>
	</div>
</div -->

<div id="delete-widget" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee Basic Information updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-deletewidget" class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div id="eduRecordSucess" class="callout callout-info" style="display:none;"> Thank you for updating employee education record!  </div>
<div id="EmploymentHistorySucess" class="callout callout-info" style="display:none;"> Thank you for updating employer employment history! </div>
<div id="spouseDetailSucess" class="callout callout-info" style="display:none;"> Thank you for editing Parents / Spouse Details ! </div>
<div id="alternativeContactSucess" class="callout callout-info" style="display:none;"> Thank you for updating Alternative Contact! </div>
<div id="bankDetailSucess" class="callout callout-info" style="display:none;"> Thank you for editing Banks Details! </div>
<div id="otherDetailSucess" class="callout callout-info" style="display:none;"> Thank you for updating employee other information! </div>
<div id="providentFundSucess" class="callout callout-info" style="display:none;"> Thank you for updating Provident Fund information! </div>
<div id="ntnSucess" class="callout callout-info" style="display:none;"> Thank you for updating National Tax Number information! </div>
<div id="takafulSucess" class="callout callout-info" style="display:none;"> Thank you for updating employee basic information! </div>
<div id="basicInfoSucess" class="callout callout-info" style="display:none;"> Thank you for updating employee basic information! </div>
<?php /* ?>
<div id="modalEdcRecord" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee  Educational Record updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->

		<button id="trigger-deletewidget" class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




<div id="modalEemploymentHistory" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee Employment History updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalEemploymentHistory" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<?php */ ?>



  <div class="tabbable tabs-left">






	<ul class="nav nav-tabs">
	<li class="active"><a href="#personalinfo" data-toggle="tab"><i class="fa fa-pencil"></i> Personal Information </a></li>
	<li><a href="#educationalRecord" data-toggle="tab"><i class="fa fa-pencil"></i> Educational Record </a></li>
	<li><a href="#employmentHistory" data-toggle="tab"><i class="fa fa-pencil"></i> Employment History </a></li>
	<li><a href="#spouseDetail" data-toggle="tab"><i class="fa fa-pencil"></i> Spouse Detail </a></li>
	<li><a href="#childrenDetail" data-toggle="tab"><i class="fa fa-pencil"></i> Children Detail </a></li>
	<li><a href="#alternativeContact" data-toggle="tab"><i class="fa fa-pencil"></i> Alternate Contact </a></li>
	<li><a href="#bankDetail" data-toggle="tab"><i class="fa fa-pencil"></i> Bank Detail </a></li>
	<li><a href="#otherDetail" data-toggle="tab"><i class="fa fa-pencil"></i> Other Detail </a></li>
	<li><a href="#providentFund" data-toggle="tab"><i class="fa fa-pencil"></i> Provident Fund </a></li>
	<li><a href="#ntn" data-toggle="tab"><i class="fa fa-pencil"></i> National Tax Number </a></li>
	<li><a href="#takaful" data-toggle="tab"><i class="fa fa-pencil"></i> Takaful </a></li>
	</ul>
<div class="tab-content" id="tab-content">
<div class="tab-pane active" id="personalinfo">





<form id="staffInformationForm" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />
<div class="powerwidget dark-red" data-widget-editbutton="false">

              <header role="heading">Basic Information</header>


              <div class="inner-spacer">



                  <fieldset>



					  <table class="table">

					  <tr>
						<td width="48%">
						<label class="control-label" style="font-size:16px;">Campus </label>
						<div class="inline-group">
                        <label class="radio">
                         <input type="radio" name="campus" value="1"  <?php if ($employer->branch_id == 1) : ?>checked="checked"<?php endif; ?> />
                          <i></i>North Campus</label>
                        <label class="radio">
                          <input type="radio" name="campus" value="2" <?php if ($employer->branch_id == 2) : ?>checked="checked"<?php endif; ?> />
                          <i></i> South Camps </label>

                      </div>

					  </td>
						<td>
						<table class="table table-borderless">
							<tr>
								<!--td> <label class="control-label"> Upload Staff Photo </label> </td -->
								<td></td>
								<td>
								<table class="table table-borderless">
									<tr>

										<td>
										<?php /* ?>
										<div style="margin-top: 49px;" class="col col-6">
										<label class="input input-file" for="file">
										<div class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" multiple="" name="sc_name">Browse</div><input type="text" readonly="" placeholder="Upload" name="sc_name1" id="sc_name1">
										</label>

										</div>
									<?php */ ?>
									<img border="0" src="<?php echo base_url(); ?>/Assets/photos/hcm/150x150/staff/<?=$employer->employee_id;?>.png" width="161" height="133" style="float:right;" />
									<?php
									//echo $employeSupporting[0]->thumbnail;
									 /* if ($employeSupporting[0]->thumbnail == '' ){ ?>

									 <?php }else{ ?>
										 <img border="0" src="<?php echo base_url(); ?>/Assets/photos/hcm/staff/150x150/<?=$employeSupporting[0]->thumbnail;?>" width="161" height="133" style="float:right;" />
										 <?php }	*/ ?>





									 </td>
									</tr>
								</table>


								</td>
							</tr>
						</table>

						</td>

					  </tr>

					</table>

					<table class="table ">
						<tr>

							<td width="50%">
								<table class="table">
									<tr>
									<td style=" border: none;">
										<label for="input" class="control-label"> Full Name </label>
									</td>
									<td style=" border: none;">
										<label class="input"> <i class="icon-append fa fa-asterisk"></i>


									<input type="text" name="fullName" ng-model="fullName" id="fullName" class="form-control" value="<?=$employer->name;?>" disabled />

										</label>
									</td>
									</tr>

									<tr>
									<td>
										<label for="input" class="control-label"> Gender </label>
									</td>
									<td>

										<div class="inline-group">
										<label class="radio control-label">
										<input type="radio" name="gender" value="male" id="gmale"  <?php if ($employer->gender == 'M') : ?>checked="checked"<?php endif; ?> />
										  <i></i>Male </label>
										<label class="radio">
										  <input type="radio" name="gender" value="female" id="gfemale" <?php if ($employer->gender == 'F') : ?>checked="checked"<?php endif; ?> />
										<i></i> Female </label>
										</div>
									</td>
									</tr>


									<tr>
									<td>
										<label for="input" class="control-label"> Name Code </label>
									</td>
									<td>
										<label class="input"> <i class="icon-append fa fa-asterisk"></i>
										<input type="text" name="nameCode" id="nameCode" class="form-control" value="<?=$employer->name_code;?>" disabled />
										</label>
									</td>
									</tr>

								<tr>
									<td>

										<label class="input">Nationality </label>
									</td>
									<td>
									<label class="input"> <i class="icon-append fa fa-asterisk"></i>
									<?php
									if( !empty ( $employeSupporting[0] ) ){ ?>

									<label class="select">
										<select name="nationality" id="nationality" class="form-control">
										<option value="AFG" <?php if( $employeSupporting[0]->nationality=="AFG"){ echo "selected"; } ?>>Afghanistan</option>
										<option value="AUS" <?php if( $employeSupporting[0]->nationality=="AUS"){ echo "selected"; } ?>>Australia</option>
										<option value="CAN" <?php if( $employeSupporting[0]->nationality=="CAN"){ echo "selected"; } ?>>Canada</option>
										<option value="PAK" <?php if( $employeSupporting[0]->nationality=="PAK"){ echo "selected"; } ?>> Pakistan</option>
										<option value="SAU" <?php if( $employeSupporting[0]->nationality=="SAU"){ echo "selected"; } ?>>Saudi Arabia</option>
										<option value="UAE" <?php if( $employeSupporting[0]->nationality=="UAE"){ echo "selected"; } ?>>United Arab Emirates</option>
										<option value="GBR" <?php if( $employeSupporting[0]->nationality=="GBR"){ echo "selected"; } ?>>United Kingdom</option>
										<option value="USA" <?php if( $employeSupporting[0]->nationality=="USA"){ echo "selected"; } ?>>United States</option>
										<option value="OTHER" <?php if( $employeSupporting[0]->nationality=="OTHER"){ echo "selected"; } ?>> Other </option>
									</select>
									 <i></i> </label>


									<?php }else{ ?>
										<!--input type="text" name="nationality" id="nationality" class="form-control" / -->

										<label class="select">
										<select name="nationality" id="nationality" class="form-control">
										<option value="AFG">Afghanistan</option>
										<option value="AUS">Australia</option>
										<option value="CAN">Canada</option>
										<option value="PAK" selected> Pakistan</option>
										<option value="SAU">Saudi Arabia</option>
										<option value="UAE">United Arab Emirates</option>
										<option value="GBR">United Kingdom</option>
										<option value="USA">United States</option>
										<option value="OTHER"> Other </option>
									</select>
									 <i></i> </label>

									<?php } ?>

									</label>
									</td>
									</tr>

									<tr>
									<td>
										<label for="input" class="control-label"> CNIC </label>
									</td>
									<td>
										<label class="input"> <i class="icon-append fa fa-asterisk"></i>
										 <input type="text" name="cnic" id="cnic" class="form-control" value="<?=$employer->nic;?>" disabled />
										 </label>
									</td>
									</tr>


									<tr>
										<td>
											<label for="input" class="control-label"> GT-ID </label>
										</td>
										<td>
											<label class="input"> <i class="icon-append fa fa-asterisk"></i>
											<input type="text" name="gtID" id="gtID" class="form-control" value="<?=$employer->gt_id;?>" disabled />
											</label>
										</td>
									</tr>


									<tr>
										<td>
											<label for="input" class="control-label"> Religion </label>
										</td>
										<td>

											<!--label class="input"> <i class="icon-append fa fa-asterisk"></i>
											<input type="text" name="religion" id="religion" placeholder="Religion" class="form-control">
											</label -->
											<?php if( !empty( $employeSupporting[0] ) ){ ?>

											<div class="inline-group">
											<label class="radio control-label">
											  <input type="radio" name="religion" value="1" id="Muslim" <?php  if ($employeSupporting[0]->religion == 1 ) : ?>checked="checked"<?php endif; ?> />
											  <i></i> Muslim </label>
											<label class="radio">
											 <input type="radio" name="religion" value="0" id="Non_Muslim" <?php if ($employeSupporting[0]->religion == 0 ) : ?>checked="checked"<?php endif; ?> />
											  <i></i> Non-Muslim </label>
											<?php }else{ ?>
													<div class="inline-group">
											<label class="radio control-label">
											  <input type="radio" name="religion" value="1" id="Muslim"  checked="" />
											  <i></i> Muslim </label>
											<label class="radio">
											  <input type="radio" name="religion" value="0" id="Non_Muslim" />
											  <i></i> Non-Muslim </label>
											<?php } ?>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<label for="input" class="control-label"> Mobile Number </label>
										</td>
										<td>
											<label class="input"> <i class="icon-append fa fa-asterisk"></i>
										<input type="text" name="mobileNumber" id="mobileNumber" class="form-control" value="<?=$employer->mobile_phone;?>" />
										<b class="tooltip tooltip-top-right">Please enter mobile number</b>
											</label>
										</td>
									</tr>
										<tr>
										<td>
											<label for="input" class="control-label"> Land Line Number </label>
										</td>
										<td>
									<label class="input"> <i class="icon-append fa fa-asterisk"></i>
									<input type="text" name="landLineNumber" id="landLineNumber" class="form-control" value="<?=STR_PAD(STR_REPLACE('-','',$employer->land_line), 11, '0', STR_PAD_LEFT);?>" />
									<b class="tooltip tooltip-top-right">Please enter land line number</b>
											</label>
										</td>
									</tr>




								</table>
							</td>

							<td width="50%">
								<table class="table">


									<tr>
										<td style=" border: none;"> <label for="input" class="control-label"> GU-ID </label> </td>
										<td style=" border: none;">
											<label class="input" style="width:50%;float:left;margin-right:10px;"> <i class="icon-append fa fa-asterisk"></i>
												<?php
													$guEx = explode("@", $employer->gg_id );
													//print_r( $guEx );
												?>
											<input type="text" name="guIDEmail" id="guIDEmail" class="form-control" value="<?=$guEx[0];?>" disabled />

											</label>
											<!--div class="note">  @generationsschool.org </div -->
										</td>
									</tr>
									<tr>
										<td> <label for="input" class="control-label"> Email (Personal) </label> </td>
										<td>
											<label class="input"> <i class="icon-append fa fa-asterisk"></i>
											<?php if( !empty( $employeSupporting[0]->emailPersonal ) ){ ?>
											<input type="text" name="email" id="email" class="form-control" value="<?=$employeSupporting[0]->emailPersonal;?>" />
											<b class="tooltip tooltip-top-right">Please enter personal email.</b>
											<?php }else{ ?>
												<input type="text" name="email" id="email" class="form-control" value="" />
												<b class="tooltip tooltip-top-right">Please enter personal email.</b>
											<?php } ?>

											</label>
										</td>
									</tr>
									<tr>
										<td> <label for="input" class="control-label"> Marital Status </label> </td>
										<td>
										<?php if( !empty( $employeSupporting[0] ) ){ ?>

									<div class="inline-group">
											 <style>
												.rightereh{
													margin-right:13px;
													padding-left:21px;
												}
												.orb-form .inline-group .radio, .orb-form .inline-group .checkbox {
    float: left;
    margin-right: 10px;
}
											 </style>
											<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="1" id="married" <?php if ($employeSupporting[0]->employment_status == 1 ) : ?>checked="checked"<?php endif; ?> />
											<i></i>Married </label>

											<label class="rightereh radio">
									<input type="radio" name="maritalStatus" value="2" id="single" <?php if ($employeSupporting[0]->employment_status == 2 ) : ?>checked="checked"<?php endif; ?> />
											<i></i> Single </label>
									<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="3" id="Divorce" <?php if ($employeSupporting[0]->employment_status == 3 ) : ?>checked="checked"<?php endif; ?> />
								<i></i> Divorce </label>
								<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="4" id="Widow" <?php if ($employeSupporting[0]->employment_status == 4) : ?>checked="checked"<?php endif; ?> />
								<i></i> Widow </label>
								<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="5" id="separation" <?php if ($employeSupporting[0]->employment_status == 5 ) : ?>checked="checked"<?php endif; ?> />
								<i></i> Separation </label>
								</div>

										<?php }else{ ?>



										<div class="inline-group">
											 <style>
												.rightereh{
													margin-right:13px;
													padding-left:21px;
												}
												.orb-form .inline-group .radio, .orb-form .inline-group .checkbox {
    float: left;
    margin-right: 10px;
}
											 </style>
											<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="1" id="married"  />
											<i></i>Married </label>

											<label class="rightereh radio">
									<input type="radio" name="maritalStatus" value="2" id="single" checked />
											<i></i> Single </label>
									<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="3" id="Divorce"  />
								<i></i> Divorce </label>
								<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="4" id="Widow" />
								<i></i> Widow </label>
								<label class="rightereh radio">
								<input type="radio" name="maritalStatus" value="5" id="separation"  />
								<i></i> Separation </label>
								</div>

										<?php } ?>
										</td>
									</tr>

									<tr>
									<td>
										<label for="input" class="control-label"> Date Of Birth </label>
									</td>
										<?php $empDOB = date("d-m-Y", strtotime( $employer->dob ) ); ?>
									<td>
										<label class="input"> <i class="icon-append fa fa-asterisk"></i>
										 <input type="text" name="dateOfBith" id="dtOfBith" class="form-control" value="<?=$empDOB;?>" />
										 </label>
									</td>
									</tr>

									<tr>
									<td>
										<label for="input" class="control-label"> Employment Status </label>
									</td>
									<td>
									<div class="inline-group">
										<label class="radio control-label">
										<input type="radio" name="employmentStauts" value="Contractual" id="Contractual"  <?php if ($employer->category == 'Contractual') : ?>checked="checked"<?php endif; ?> />
										<i></i>Contractual </label>
										<label class="radio">
										<input type="radio" name="employmentStauts" value="Permenant" id="Permenant" <?php if ($employer->category == 'Permenant') : ?>checked="checked"<?php endif; ?> />
										<i></i> Permenant </label>

										<label class="radio">
										<input type="radio" name="employmentStauts" value="Probation" id="Probation" <?php if ($employer->category == 'Probation') : ?>checked="checked"<?php endif; ?> />
										<i></i> Probation </label>

									</div>
									</td>
									</tr>

										<tr>
										<td>
											<label for="input" class="control-label">Aprtment No. </label>
										</td>
										<td>
										<!-- New Address Area -->

											<label class="input">
												<i class="icon-append fa fa-asterisk"></i>
												<?php if(empty($get_adress[0]->apartment_no)) { ?>
												<input type="text" name="appartment_no" id="" class="form-control"  placeholder="Aprtment No." />
												<?php }else {  ?>
													<input type="text" name="appartment_no" id="" class="form-control" placeholder="Aprtment No." value="<?php echo $get_adress[0]->apartment_no ?>" />
												<?php } ?>
									<b class="tooltip tooltip-top-right">Please enter Apartment No.</b>
											</label>
										</td>
										</tr>
										<tr>
										<td>
											<label for="input" class="control-label">Street Name </label>
										</td>
										<td>
											<label class="input">
												<i class="icon-append fa fa-asterisk"></i>
												<?php if(empty($get_adress[0]->street_name)) { ?>
												<input type="text" name="street_name" id="" class="form-control"  placeholder="Street Name">
												<?php } else { ?>
												<input type="text" name="street_name" id="" class="form-control"  placeholder="Street Name" value="<?php echo $get_adress[0]->street_name ?>">
												<?php } ?>
									<b class="tooltip tooltip-top-right">Please enter Street Name</b>
											</label>
										</td>
										</tr>
										<tr>
										<td>
											<label for="input" class="control-label">Building Name </label>
										</td>
										<td>
											<label class="input">
												<i class="icon-append fa fa-asterisk"></i>
												<?php if(empty($get_adress[0]->building_name)) { ?>
												<input type="text" name="building_name" id="" class="form-control" placeholder="Building Name">
												<?php }  else {?>
												<input type="text" name="building_name" id="" class="form-control" placeholder="Building Name" value="<?php echo $get_adress[0]->building_name ?>">
												<?php } ?>
									<b class="tooltip tooltip-top-right">Please enter Building Name</b>
											</label>
										</td>
										</tr>
										<tr>
										<td>
											<label for="input" class="control-label">Plot No. </label>
										</td>
										<td>
										<label class="input">
												<i class="icon-append fa fa-asterisk"></i>
												<?php if(empty($get_adress[0]->plot_no)) { ?>
												<input type="text" name="plot_no" id="" class="form-control"  placeholder="Plot No.">
												<?php } else {  ?>
												<input type="text" name="plot_no"  class="form-control"  placeholder="Plot No." value="<?php echo $get_adress[0]->plot_no ?>">
												<?php } ?>
									<b class="tooltip tooltip-top-right">Please enter Plot No.</b>
											</label>
										</td>
										</tr>
										<tr>
										<td>
											<label for="input" class="control-label">Region </label>
										</td>
										<td>
											<div class="replace">
											<label class="input" id='reg'> <i class="icon-append fa fa-asterisk"></i>
											<label class="select">
											<?php if(empty($get_region))  { ?>
											<select name="region" id="region" class="form-control valid">
											 <option disabled selected value> -- Select Region -- </option>
												<?php foreach($region as $region_name) { ?>
												<option value="<?php echo $region_name->id ?>"><?php echo $region_name->name ?></option>
												<?php } ?>
											</select>
											<?php } elseif(!empty($get_region)) { ?>
											<select name="region" id="region" class="form-control valid">
												<option value="<?php echo $get_region[0]->id ?>" selected>
												<?php echo $get_region[0]->name; ?> </option>
												<?php foreach($region as $region_name)  { ?>
												 <option value="<?php echo $region_name->id ?>"><?php echo $region_name->name; ?></option>
												<?php } ?>
											</select>
											<?php } ?>
											 <i></i> </label>
											</label>
											</div>
											<a href="javascript:void(0)" id="other_region">Other</a>
										</td>
										</tr>
										<tr>
										<td>
											<label for="input" class="control-label">Sub Region </label>
										</td>
										<td>
										<div class="filter_sub_region">
										<label class="select">
										 <label class="input"> <i class="icon-append fa fa-asterisk"></i>
										  <select name="sub_region"  class="form-control valid">
										  <?php var_dump($get_sub_region); ?>
										  <?php if(empty($get_sub_region)) { ?>
										   <option>--Select Sub Region--</option>
											<?php foreach($sub_region_all as $sub_region) { ?>
											<option value="<?php echo $sub_region->id ?>"><?php echo $sub_region->name ?></option>
											<?php } ?>
										  <?php }else { ?>
										  	<option value="<?php echo $get_sub_region[0]->id ?>" selected><?php echo $get_sub_region[0]->name ?></option>
										  <?php } ?>
										  </select>
										 </label>
										</label>
										</div>

<!-- 											<div class="subRegionlist"></div>
											<?php if(!empty($get_sub_region)) {  ?>
											<div id = "sub">
											<label class="select">
											<label class="input"> <i class="icon-append fa fa-asterisk"></i>
											<select name="sub_region"  class="form-control valid">
											<option value="<?php echo $get_sub_region[0]->id ?>"><?php echo $get_sub_region[0]->name ?></option>


											</select>
											</label>
											</label>
											</div>
											<?php } ?> -->





										<!-- New Address Area End-->
										<?php /* ?>
										<?php if( !empty( $employeSupporting[0] ) ){ ?>

											<label class="textarea">
											<textarea rows="3" name="basicAddress" id="address1"><?=$employeSupporting[0]->address;?></textarea>
											<b class="tooltip tooltip-top-right">Some helpful information</b>
										  </label>
										<?php }else{ ?>
											<label class="textarea">
											<textarea rows="3" name="basicAddress" id="address1"></textarea>
											<b class="tooltip tooltip-top-right">Please enter address for this emplyoo like address, city, country</b>
										  </label>
										<?php } ?>
										<?php */ ?>
										</td>
									</tr>

									<tr  class="table-borderless">
										<td style=" border: none;">
											 &nbsp;
										</td>
										<td style=" border: none;">
											 &nbsp;
										</td>
									</tr>

								<tr  class="table-borderless">
										<td style=" border: none;">
										  &nbsp;
										</td>
										<td style=" border: none;">
											 &nbsp;
										</td>
									</tr>
								<tr  class="table-borderless" style=" border: none;">
										<td style=" border: none;">
										 &nbsp;
										</td>
										<td style=" border: none;">
											 &nbsp;
										</td>
									</tr>


								</table>
							</td>
						</tr>
					</table>



</fieldset>
</div>


	</div>

	<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
		</form>
</div> <!-- /end tab1 -->




<!--form action="tifb/add" id="staffInformationForm" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<$employer->id;?>" />
	<input type="submit" name="submit" value="Save" id="submit" class="btn btn-primary btn-sm" />
                     </form -->

<style>
.input_input{
    display: block;
    position: relative;
}
.orb-form *, .orb-form *::after, .orb-form *::before{
	box-sizing:padding-box;
}
</style>

<div class="tab-pane" id="educationalRecord">

<form id="staffEducationalRecord" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />


            <div class="powerwidget dark-red" data-widget-editbutton="false">
              <header>
                Educational Record
              </header>
              <div class="inner-spacer">

                  <fieldset>

<div id="eduRecordSucess" class="callout callout-info" style="display:none;"> Thank you for updating employee education record!  </div>

<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
	<header> School </header>
	<br />
<table class="table" id="empSchool" style="width:98%;">
	<thead>
	<th> School Name </th>

	<th> Qualification </th>
	<th> Subject </th>
	<th> Result </th>
	<th> Year </th>
	</thead>

	<tbody>
	<script>
		function ConfirmDelete()
		{
		  var x = confirm("Are you sure you want to delete?");
		  if (x){
			  alert(1);
			 (function ($) {
				$("#empSchool").on('click','.remCF',function(){   $(this).parent().parent().remove();  });
			  });

			  return true;
		  }else{
			  alert(0);
			return false;
		  }



		}

	</script>


<?php
$schoolsNames = array("ACE_School","Aga_Khan_Education","Aga_Khan_Higher_Secondary_School","Aga_Khan_School","Agha_Khan_School","Ahsan_Public_Secondary_School","Aisha_Bawany_Academy_Boys_Campus","Al_Saqib_Public_School","Almurtaza_School","Army_Public_School","ASF_Public_School","B_V_S_Parsi_High_School_Saddar","Bay_View_Academy","Bay_View_High_School","Beaconhouse_School","DHA_Model_High_School","Education_Bay","Falcon_House_Grammar_School","Falconhouse_Grammar_School","Fatimiyah_School","Foundation_Public_School","Generations_School","Government_Delhi_Boys_Secondary_School","Government_Delhi_Girls_Secondary_School","Government_Pilot_High_School_Dadu", "Habib_Public_School","Habib_Public_School_HPS","Hamdard_Public_School","Hamdard_Public_School,_Madinat_ul_Hikmah","Happy_Palace_Grammar_School","Hyderi_Public_School_Saddar","Indus_Academy","Karachi_Grammar_School","Ladybird_Grammar_School","Little_Folks_School","Meritorious_School","Metropolis_Academy","Metropolitan_Academy","NAKHLAH_Educational_House","Nasra_School","Nixor_College","Progressive_Childrens_Academy","Progressive_Public_School","Reflections","Sadequain_Academy","Saqib_Public_School","Shaheen_Cambridge","Shaheen_Cambridge_School","Shaheen_Public_School","Shaheen_Public_School_Campus","Shahwilayat_Public_School","Sindh_Madrasa_tul_Islam","Sir_Syed_Childrens_Academy","St_Josephs_School","St_Patricks_High_School","St_Peters_High_School","St_Johns_High_School","St_Judes_High_School","St_Lawrences","St_Michaels_Convent_School","St_Patricks_High_School","St_Pauls_High_School","Sultan_Mohammed_Shah_Aga_Khan_School","The_Academy","The_British_International_School","The_City_School","The_City_School_Paf_Chapter","The_Educators","The_Intellect_School","The_Knowledge_Academy","The_Mama_Parsi","The_Metropolis_Academy","The_Metropolitan_Academy","The_Suffah_Academy","Trinity_Private_School","Trinity_Private_School_Karachi","Yaqeen_Education_Foundation");

	$schoolNameCounter = 0;
	if( !empty( $empQSchool ) ) {
	//echo count( $empQSchool );
	foreach($empQSchool as $school ): ?>
	<tr class="testing">
		<td>

		<?php if (in_array($school->title, $schoolsNames)) { ?>
		<div class="sn">
			<label class="select">
		   <select name="schoolName[]" class="txt_schName">
			  <option value="">Choose name</option>

			 <?php foreach($schoolsNames as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if( $school->title==$uQ ){ echo "selected"; }?> > <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			  </select>
			<i></i> </label>
			</div>
			<div class="input_input" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolNames[]" class="schoolName_0 form-control" value="<?=$school->title;?>" />
			<a href="#" class="btn_less1">close</a>
			</label>
			</div>

			<?php }else{ ?>


			<div class="sn" style="display:none;">
			<label class="select">
		   <select name="schoolNames[]" class="txt_schName">
			  <option value="">Choose name</option>

			 <?php foreach($schoolsNames as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if( $school->title==$uQ ){ echo "selected"; }?> > <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			  </select>
			<i></i> </label>
			</div>
			<div class="input_input">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolName[]" class="schoolName_0 form-control" value="<?=$school->title;?>" />
			<a href="#" class="btn_less1">close</a>
			</label>
			</div>

			<?php } ?>


		</td>

		<td>
		<?php $schoolQua = array( "A_Level", "O_Level", "Matric" ); ?>
		<?php if (in_array($school->qualification, $schoolQua)){ ?>
			<div class="schoolQQ">
			<label class="select">
		   <select name="schoolQualification[]" class="schoolQ">

					<option value="">Choose name</option>
					<option value="A_Level" <?php if( $school->qualification=="A_Level" ){ echo "selected"; }?>> A Level </option>
					<option value="O_Level" <?php if( $school->qualification=="O_Level" ){ echo "selected"; }?>> O Level </option>
					<option value="Matric" <?php if( $school->qualification=="Matric" ){ echo "selected"; }?>> Matric  </option>
					<option value="Other" <?php if( $school->qualification=="Other" ){ echo "selected"; }?>> Other </option>
				</select>
				<i></i>
			</label>
			</div>

			<div class="inputinput" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="schoolQualifications[]" class="schoolName_1 form-control" value="<?=$school->qualification;?>" />
				</label>
				<a href="#" class="btn_less2">close</a>
			</div>
		<?php }else{ ?>

						<div class="schoolQQ" style="display:none;">
			<label class="select">
		   <select name="schoolNameKashif1[]" class="schoolQ">

					<option value="">Choose name</option>
					<option value="A_Level" <?php if( $school->qualification=="A_Level" ){ echo "selected"; }?>> A Level </option>
					<option value="O_Level" <?php if( $school->qualification=="O_Level" ){ echo "selected"; }?>> O Level </option>
					<option value="Matric" <?php if( $school->qualification=="Matric" ){ echo "selected"; }?>> Matric  </option>
					<option value="Other" <?php if( $school->qualification=="Other" ){ echo "selected"; }?>> Other </option>
				</select>
				<i></i>
			</label>
			</div>

			<div class="inputinput">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolQualification[]" class="schoolName_1 form-control" value="<?=$school->qualification;?>" />
			</label>
			<a href="#" class="btn_less2">close</a>
			</div>


		<?php } ?>
		</td>
		<td>
		<?php $schoolSu = array( "Science", "Arts" ); ?>
			<?php if (in_array($school->subjects, $schoolSu)) { ?>

			<div class="schoolSub">
				<label class="select">
			   <select name="schoolSubject[]" class="schoolSubjct">

			  <option value="">Choose name</option>
			  <option value="Science" <?php if( $school->subjects=="Science" ){ echo "selected"; }?>> Science </option>
			  <option value="Arts" <?php if( $school->subjects=="Arts" ){ echo "selected"; }?>> Arts </option>
			  <option value="Other" <?php if( $school->subjects=="Other" ){ echo "selected"; }?>> Other </option>
			</select>

			<i></i> </label>
			</div>



			<div class="inputssub" style="display:none;">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="schoolSubjects[]" class="schoolName_2 form-control" value="<?=$school->subjects;?>" />

				</label>
				<a href="#" class="btn_less3">close</a>
			</div>


		<?php }else{ ?>

		<div class="schoolSub" style="display:none;">
				<label class="select">
			   <select name="schoolSubjctKashif[]" class="schoolSubjct">

			  <option value="">Choose name</option>
			  <option value="Science" <?php if( $school->subjects=="Science" ){ echo "selected"; }?>> Science </option>
			  <option value="Arts" <?php if( $school->subjects=="Arts" ){ echo "selected"; }?>> Arts </option>
			  <option value="Other" <?php if( $school->subjects=="Other" ){ echo "selected"; }?>> Other </option>
			</select>

			<i></i> </label>
			</div>

			<div class="inputssub">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolSubject[]" class="schoolName_2 form-control" value="<?=$school->subjects;?>" />

			</label>
			<a href="#" class="btn_less3">close</a>
		</div>


		<?php } ?>
		</td>





		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolResult[]" class="form-control" value="<?=$school->result;?>" />
			</label>
		</td>


		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolYear[]" class="schYrDtPckr form-control" value="<?=$school->year_of_completion;?>" id="schoolYear_0" />
			</label>
			<a href="javascript:void(0);" class="remCF" style="display:none; float: right;position: relative;top: -31px;"> <i class="fa fa-trash-o"></i> </a>
			<input type="hidden" name="level[]" value="1" class="form-control" />

		</td>

		</tr>
	<?php $schoolNameCounter++; ?>
	<?php endforeach; ?>

	<?php }else{ ?>
		<tr class="testing">

		<td>
			<div class="sn">
			<label class="select">
		   <select name="schoolName[]" class="txt_schName">
			  <option value="">Choose name</option>

			 <?php foreach($schoolsNames as $uQ ){ ?>
				<option value="<?=$uQ;?>"><?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			  </select>
			<i></i> </label>
			</div>
			<div class="input_input" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolName[]" class="schoolName_0 form-control" />
			<a href="#" class="btn_less1">close</a>
			</label>
			</div>
		</td>


		<td>
			<div class="schoolQQ">
			<label class="select">
		   <select name="schoolQualification[]" class="schoolQ">
			  <option value="">Choose Qualification</option>
			  <option value="A_Level"> A Level </option>
			  <option value="O_Level"> O Level </option>
			  <option value="Matric"> Matric  </option>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>
			<div class="inputinput" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolQualification[]" class="schoolName_1 form-control" />
			</label>
			<a href="#" class="btn_less2">close</a>
			</div>

		</td>

		<td>
			<div class="schoolSub">
				<label class="select">
			   <select name="schoolSubject[]" class="schoolSubjct">
				  <option value="">Choose Subject</option>
				  <option value="Science"> Science </option>
				  <option value="Art"> Art </option>
				  <option value="Other"> Other </option>
				</select>
				<i></i> </label>
			</div>

			<div class="inputssub" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolSubject[]" class="schoolName_2 form-control" value="" />
			<a href="#" class="btn_less3">close</a>
			</label>
			</div>
		</td>

		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolResult[]" class="form-control" />
			</label>
		</td>

		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="schoolYear[]" class="schYrDtPckr form-control" id="schoolYear_0" />
			</label>
			 <a href="javascript:void(0);" class="remCF" style="float: right;position: relative;top: -31px;"> <i class="fa fa-trash-o"></i> </a>

			<input type="hidden" name="level[]" value="1" class="form-control" />
		</td>
		</tr>
	<?php }  ?>




	</tbody>
</table>
<table class="table">
	<tr>
		<td>
			 <input type="button" id="btnAdd" onclick="AddRow()" value="+ Add Another School"  class="btn btn-primary btn-sm" name="addAnotherSchool" />
		</td>
	</tr>
</table>

<script type="text/javascript">

function AddRow(){

	$('.schYrDtPckr').datepicker('destroy');
	var $tableBody = $('#empSchool').find("tbody"),
	$trLast = $tableBody.find("tr:last"),
	$trNew = $trLast.clone();
	$trLast.show();
	$trNew.find('input,select').val('');
	$trLast.after($trNew);
	//$tableBody.find("tr:last").hide();
	$(".remCF").show();
	$("#empSchool").on('click','.remCF',function(){
		var rowCount = $('#empSchool tr').length;
		if( rowCount > 2 ){
			$(this).parent().parent().remove();
		}else{
			$(".remCF").hide();
		}
	});

	$('input[name^="schoolYear[]"').each(function(i){
		var newID = 'schoolYear_'+i;
		$(this).attr( 'id',newID );
		$( "#" + newID + "" ).datepicker();
	});


}
</script>

	<br />
	<br />


	 <header>College</header>

<br />


<?php


	$collegesNames = array("Pakistan_Swedish_Institute_of_Technology","Govt._Polytechnic_Institute_Liyari","Govt._Monotechnic_Institute,_New_Karachi","Govt._Monotechnic_Institute_Orangi_Town","Pakistan_Shipowners'_College,_North_Nazimabad","Adamjee_Government_Science_College,_Jamshed_Town_English_Medium","Dayaram_Jethamal_Sindh_Government_Science_College_Saddar_Town_English_Medium","Government_Aisha_Bawani_College_Saddar_Town","Government_Allama_Iqbal_College_for_Boys_Shah_Faisal_Town","Government_Boys_College_Konkar_Gadap_Town","Government_Boys_College_Korangi_Town","Government_Boys_College_Landhi4_Landhi_Town","Government_Boys_College_Surjani_Town,_Gadap_Town","Government_City_College_Musa_Colony,_Gulberg_Town","Government_College_for_Boys_Asifabad_S.I.T.E._Town","Government_College_for_Boys_Baldia_Town_Baldia_Town","Government_College_for_Men_Nazimabad_Liaquatabad_Town_English_Medium","Government_College_of_Commerce_&_Economics_Saddar_Town","Government_Degree_Commerce_College_Malir_Malir_Town","Government_Degree_Arts_&_Commerce_College_Landhi_Landhi_Town","Government_Degree_Boys_College_Gulzar-E-Hijri_Gulshan_Town","Government_Degree_Boys_College_Jungle_Shah_Kemari_Town","Government_Degree_Boys_College_New_Karachi_New_Karachi_Town","Government_Degree_Boys_College_Razzaqabad_Bin_Qasim_Town","Government_Degree_Boys_College_Shams_Pir_Kemari_Town","Government_Degree_College_for_Boys_North_Karachi_New_Karachi_Town","Government_Degree_College_Gulistan-e-_Johar_Gulshan_Town","Government_Degree_College_Gulshan-e-Iqbal_Gulshan_Town","Government_Degree_College_Malir_CanttMalir_Cantt_English_Medium","Government_Degree_College_Mango_Pir_Karachi_Gadap_Town","Government_Degree_College_Murrad_Memon_Goth_Gadap_Town","Government_Degree_College_Quaidabad_Bin_Qasim_Town","Government_Degree_College_SRE_Majeed_Stadium_Road_Gulshan_Town_English_Medium","Government_Degree_Science_&_Commerce_College_Landhi_Landhi_Town","Government_Degree_Science_&_Commerce_College_Lyari_Town","Government_Degree_Science_&_Commerce_College_Orangi_Town","Government_Degree_Science_College_Buffer_Zone_North_Nazimabad_Town","Government_Degree_Science_College_Liaquatabad_Liaquatabad_Town","Government_Degree_Science_College_Malir_Malir_Town","Government_Delhi_College_Karimabad","Government_Islamia_Arts_&_Commerce_College_Jamshed_Town","Government_Islamia_Science_College_Jamshed_Town","Government_Jamia_Millia_Degree_College_Shah_Faisal_Town","Government_Jinnah_College_North_Nazimabad_Town","Government_Nabi_Bagh_College_Saddar_Town","Government_National_College_No1(Morning)_Gulshan_Town","Government_National_College_No2(Evening)_Gulshan_Town","Government_P.E.C.H.SEducation_Foundation_Science_College_Jamshed_Town","Government_Sirajudallah_College_Liaquatabad_Town","Government_Superior_Science_College_Shah_Faisal_Town","Haji_Abdullah_Haroon_Government_College_Lyari_Town","Liaquat_Government_College_Malir_Malir_Town","Premier_Government_College_North_Nazimabad_Town","Quaid-e-Millat_Government_College_Liaquatabad_Town","S.MGovernment_Arts_&_Commerce_College_Saddar_Town","S.MGovernment_Science_College_Saddar_Town","ZAM_ZAMA_GARAMER_SCHOOL_&_COLLEGE_GIZZRI_TOWN_ZAMZAMA","Abdullah_Government_College_for_Women_North_Nazimabad_Town","Allama_Iqbal_Government_Girls_College_Shah_Faisal_Town","A.P.W.AGovernment_College_for_Women_Gulberg_Town","Government_College_for_Women_F.BArea_Gulberg_Town","Government_College_for_Women_Korangi4_Korangi_Town","Government_College_for_Women_Korangi–6_Korangi_Town","Government_College_for_Women_Nazimabad_Liaquatabad_Town","Government_College_for_Women_New_Karachi_New_Karachi_Town","Government_College_for_Women_North_Karachi_New_Karachi_Town","Government_College_for_Women_Saudabad_Malir_Town","Government_College_for_Women_Shahrah-e-Liaquat_Saddar_Town","Government_College_of_Commerce_&_Economics_Saddar_Town","Government_Degree_Girls_College_Ibrahim_Hydri_Korangi_Town","Government_Degree_Girls_College_Sector_11½_Orangi_Town","Government_Degree_College_Gulshan-e-Iqbal_Gulshan_Town","Government_Degree_College_Malir_CanttMalir_Cantt","Government_Degree_College_Stadium_Road_Gulshan_Town","Government_Degree_Girls_College_Lines_Area_Jamshed_Town","Government_Degree_Girls_College_Metrovile_S.I.T.ETown","Government_Girls_College_North_Nazimabad_North_Nazimabad_Town","Government_Girls_College_Al-Noor_Gulberg_Town","Government_Girls_College_Baldia_Town_Baldia_Town","Government_Girls_College_Gizri_Saddar_Town","Government_Girls_College_Gulistan-e-Johar_Gulshan_Town","Government_Girls_College_Industrial_Area_Landhi_Landhi_Town","Government_Girls_College_Landhi_3½_Landhi_Town","Government_Girls_College_Liaquatabad_Liaquatabad_Town","Government_Girls_College_Lyari_Lyari_Town","Government_Girls_College_Mahmudabad_Jamshed_Town","Government_Girls_College_North_Karachi_New_Karachi_Town","Government_Girls_College_Orangi_Town_Orangi_Town","Government_Girls_College_Orangi_Town_Orangi_Town","Government_Girls_College_P.I.BColony_Gulshan_Town","Government_Girls_College_Gulshan-e-Iqbal_Gulshan_Town","Government_Girls_College_Korangi_Korangi_Town","Government_Girls_Commerce_&_Arts_College_Malir_Malir_Town","Government_Girls_Science_&_Commerce_College_North_Nazimabad_Town","Government_Girls_Science_College_Shah_Faisal_Town","Government_Islamia_College_for_Women_Jamshed_Town","Government_Karachi_College_for_Women_Saddar_Town","Government_P.E.C.H.SCollege_for_Women_Jamshed_Town","Government_SMB_Fatima_Jinnah_Girls_College_Saddar_Town","H.IOsmania_Government_College_for_Women_Liaquatabad_Town","HRH_Agha_Khan_Government_Girls_College_Gulshan_Town","Khatoon-e-Pakistan_Government_College_for_Women_Gulshan_Town","Khurshid_Government_College_for_Women_Shah_Faisal_Town","Liaquat_Government_College_for_Girls_Malir_Malir_Town","Nishter_Government_Girls_College_New_Karachi_Town","Premier_Government_College_for_Girls_North_Nazimabad_Town","Rana_Liaquat_Ali_Khan_Government_College_of_Home_Economics_Stadium_Road_Gulshan_Town","Raunaq-e-Islam_Government_College_for_Women_Lyari_Town","Riaz_Government_Girls_College_Liaquatabad_Town","Shaheed-e-Millat_Government_Degree_Girls_Gulshan_Town","Sir_Syed_Government_Girls_College_Liaquatabad_Town","StLawrence_Government_Girls_College_Jamshed_Town","PAKTURK_International_Schools_&_Colleges","Aga_Khan_Higher_Secondary_School","Sir_Syed_College_of_Medical_Sciences_for_Girls","Sir_Adamjee_Institute_Hussainabad_near_Karimabad_F.BArea","Metallurgical_Training_Center_Pakistan_Steel","Jinnah_Polytechnic_Institute","Fatimiyah_college_for_boys_and_girls_Brito_Road_Numaish","Zubaida_Polytechnic_Institute","Hassani_Institute_of_Technology","Y.M.C.APolytechnic_Institute","StPatrick's_Technical_School_&_Institute_of_Technology","Muhammad_Shafi_Polytechnic_Institute","Institute_of_Textile_Technology","Dehli_Science_&_Commerce_College(PVT)_Karimabad_Karachi","Ideal_Institute_of_Business_&_Technology","Pakistan_Polytechnic_Center","Arabic_Girls_College_for_Islamic_Studies_New_Karachi_Town","DA_Degree_College_For_Women_DHA","College_of_Accounting_and_Management_Sciences_[1]_Clifton","DHA_Degree_College_for_Men_Khayaban-e-Rahat_DHA_Phase_VI_D.H.A","StJoseph's_College_Saddar_Town","StPatrick's_Science_College_Saddar_Town","New_Century_College_Gulshan-e-Iqbal_Gulshan_Town","City_College_for_Women_Clifton_Saddar_Town","MERITORIOUS_SCIENCE_COLLEGE_P.E.C.H.S_BL_2 www.meritorious.net","Defence_Authority_Sheikh_Khalifa_Bin_Zayed_College_Khayaban-e-Rahat_Phase_VI_D.H.A.","Hamdard_College_Of_Science_And_CommerceMadinat_al_HikmahKarachi","Institute_OF_business_Education_PECHS","Bahria_College_Karsaz_Habib_Ibrahim_Rahmatullah_Road_Karsaz","Baqai_Medical_University","Dawood_College_of_Engineering_and_Technology","Dow_Medical_College[2]","Karachi_Medical_and_Dental_College","Liaquat_College_of_Medicine_&_Dentistry","Pakistan_Navy_Engineering_College_PNEC","Pakistan_Steel_Cadet_College_Steel_Town_Bin_Qasim_Town","Sindh_Medical_College","Sindh_Muslim_Law_College_DrZiauddin_Ahmed_Road","Aga_Khan_Higher_Secondary_School[Karimabad]","Guards_Public_College_Adjacent_to_Pakistan_Coast_Guards_Headquarters_Kiyani_Shaheed_Road_Saddar_Karachi","metropolis_college_for_girls_near_waterpump_gulberg_town","Federal_Government_College_Daud_Pota_RoadKarachi_Cantt","Federal_Government_Inter_Girls_College_Askari_Road_Karachi_Cantt","Army_Public_College_Malir_Cantt","Army_Public_College_Saddar_Karachi_Cantt","Army_Public_College_Faisal_Cantt","Guards_Public_College","Fazaia_Inter_College_Korangi_Creek_Korangi_Cantt","Fazaia_Inter_College_Malir_Cantt","Fazaia_Degree_College_Faisal_Cantt","Bahria_College_Karsaz_Habib_Rahmathullah_Road_F7","Bahria_College_NORE_I","Bahria_Foundation_College_DrSulaiman_Ali_Shah_Road_North_Nazimabad","Bahria_Foundation_College_Abul_Hasan_Ispahani_Road_Gulshan-e-Iqbal" );
?>

<table class="table" id="empCollege" style="width:98%">
	<thead>
		<th> College Name </th>

		<th> Qualification </th>
		<th> Subject </th>
		<th> Result </th>
		<th> Year </th>
	</thead>
	<tbody>
	<?php
	if( !empty( $empQCollege ) ) {
		foreach($empQCollege as $college ): ?>

		<tr class="tr_clone">
		<td>
		<?php if (in_array($college->title, $collegesNames)) { ?>
			<div class="college_name2">
			<label class="select">
			<select name="collegeName[]" class="college_name">
				<option value="">College name</option>
				<?php foreach($collegesNames as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($college->title == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
				<?php } ?>
				<option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="input_college" style="display:none;">
			<label class="input"><i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeNames[]" class="cn_0 form-control" />
			</label>
			<a href="#" class="btn_cn"> close </a>
			</div>

		<?php  }else{ ?>

		<div class="college_name2"  style="display:none;">
			<label class="select">
			<select name="collegeNames[]" class="college_name">
				<option value="">College name</option>
				<?php foreach($collegesNames as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($college->title == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
				<?php } ?>
				<option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="input_college"><label class="input"><i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeName[]" class="cn_0 form-control" value="<?=$college->title;?>"  />
			</label>
			<a href="#" class="btn_cn"> close </a>
			</div>
		<?php } ?>

		</td>
	<?php $con = array("Intermediate","Diploma");?>
		<td>
		<?php  if (in_array($college->qualification, $con)) { ?>

		<div class="collegeQQ">
		<label class="select">
		<select name="collegeQualification[]" class="collegeQ">
		  <option value="">Choose Qualification</option>
		  <option value="Intermediate" <?php if( $college->qualification== "Intermediate" ) { echo "selected"; }?>> Intermediate </option>
		  <option value="Diploma" <?php if( $college->qualification== "Diploma" ) { echo "selected"; }?>> Diploma </option>
		  <option value="Other" <?php if( $college->qualification== "Other" ) { echo "selected"; }?>> Other </option>
		</select>
		<i></i>
		</label>
		</div>

		<div class="inputCQ" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeQualifications[]" class="cq_1 form-control" />
			</label>
			<a href="#" class="btn_cq">close</a>
		</div>

		<?php }else{ ?>
		<div class="collegeQQ" style="display:none;">
			<label class="select">
			<select name="collegeQualifications[]" class="collegeQ">
			  <option value="">Choose Qualification</option>
			  <option value="Intermediate" <?php if( $college->qualification== "Intermediate" ) { echo "selected"; }?>> Intermediate </option>
			  <option value="Diploma" <?php if( $college->qualification== "Diploma" ) { echo "selected"; }?>> Diploma </option>
			  <option value="Other" <?php if( $college->qualification== "Other" ) { echo "selected"; }?>> Other </option>
			</select>
			<i></i>
			</label>
		</div>
		<div class="inputCQ">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeQualification[]" class="cq_1 form-control" value="<?=$college->qualification;?>" />
			</label>
			<a href="#" class="btn_cq">close</a>
		</div>
		<?php } ?>

		</td>

		<td>
		<?php $coSub = array("Pre_Engineering","Pre_Medical","Computer","Commerce","Arts"); ?>
		<?php if (in_array($college->subjects, $coSub)) { ?>

			<div class="coSub1">
			<label class="select">
		   <select name="collegeSubject[]" class="slct_clgSub">
			  <option value="">Choose Subjects</option>
			  <option value="Pre_Engineering" <?php if( $college->subjects== "Pre_Engineering" ) { echo "selected"; }?>> Pre Engineering </option>
			  <option value="Pre_Medical" <?php if( $college->subjects== "Pre_Medical" ) { echo "selected"; }?>> Pre Medical </option>
			  <option value="Computer" <?php if( $college->subjects== "Computer" ) { echo "selected"; }?>> Computer </option>
			  <option value="Commerce" <?php if( $college->subjects== "Commerce" ) { echo "selected"; }?>> Commerce </option>
			  <option value="Arts" <?php if( $college->subjects== "Arts" ) { echo "selected"; }?>> Arts </option>
			  <option value="Other" <?php if( $college->subjects== "Other" ) { echo "selected"; }?>> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="coSub2" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeSubjects[]" class="txt_coSub form-control" value="" />
			</label>
			<a href="#" class="coSub4">close</a>
			</div>

			<?php }else{ ?>

			<div class="coSub1" style="display:none;">
			<label class="select">
		   <select name="collegeSubjects[]" class="slct_clgSub">
			  <option value="">Choose Subjects</option>
			  <option value="Pre_Engineering" <?php if( $college->subjects== "Pre_Engineering" ) { echo "selected"; }?>> Pre Engineering </option>
			  <option value="Pre_Medical" <?php if( $college->subjects== "Pre_Medical" ) { echo "selected"; }?>> Pre Medical </option>
			  <option value="Computer" <?php if( $college->subjects== "Computer" ) { echo "selected"; }?>> Computer </option>
			  <option value="Commerce" <?php if( $college->subjects== "Commerce" ) { echo "selected"; }?>> Commerce </option>
			  <option value="Arts" <?php if( $college->subjects== "Arts" ) { echo "selected"; }?>> Arts </option>
			  <option value="Other" <?php if( $college->subjects== "Other" ) { echo "selected"; }?>> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="coSub2">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeSubject[]" class="txt_coSub form-control" value="<?=$college->subjects;?>" />
			</label>
			<a href="#" class="coSub4">close</a>
			</div>



			<?php } ?>

		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeResult[]" class="form-control" value="<?=$college->result;?>" />
			</label>
		</td>

		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeYear[]" class="clgYrDtPckr form-control"  value="<?=$college->year_of_completion;?>" id="collegeYear_0" />
			</label>
			<a href="javascript:void(0);" class="remCollege" style="float:right;position: relative;top: -31px; display:none;"> <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="collegeLevel[]" value="2" class="form-control" />

		</td>

		</tr>
	<?php endforeach; ?>

	<?php }else{ ?>
	<tr class="tr_clone">
		<td>

		<div class="college_name2">
			<label class="select">
			<select name="collegeName[]" class="college_name">
				<option value="">College name</option>
				<?php foreach($collegesNames as $uQ ){ ?>
				<option value="<?=$uQ;?>"> <?=str_replace("_", " ",$uQ);?> </option>
				<?php } ?>
				<option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="input_college" style="display:none;">
			<label class="input"><i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeNames[]" class="cn_0 form-control" />
			</label>
			<a href="#" class="btn_cn"> close </a>
			</div>


		</td>

		<td>


		<div class="collegeQQ">
		<label class="select">
		<select name="collegeQualification[]" class="collegeQ">
		  <option value="">Choose Qualification</option>
		  <option value="Intermediate"> Intermediate </option>
		  <option value="Diploma"> Diploma </option>
		  <option value="Other"> Other </option>
		</select>
		<i></i>
		</label>
		</div>

		<div class="inputCQ" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeQualifications[]" class="cq_1 form-control" />
			</label>
			<a href="#" class="btn_cq">close</a>
		</div>

		</td>
			<td>


			<div class="coSub1">
			<label class="select">
		   <select name="collegeSubject[]" class="slct_clgSub">
			  <option value="">Choose Subjects</option>
			  <option value="Pre_Engineering"> Pre Engineering </option>
			  <option value="Pre_Medical"> Pre Medical </option>
			  <option value="Computer"> Computer </option>
			  <option value="Commerce"> Commerce </option>
			  <option value="Arts"> Arts </option>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="coSub2" style="display:none;">
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeSubjects[]" class="txt_coSub form-control" value="" />
			</label>
			<a href="#" class="coSub4">close</a>
			</div>

		</td>


		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeResult[]" class="form-control"  />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="collegeYear[]" class="clgYrDtPckr form-control" id="collegeYear_0" />
			</label>
			<a href="javascript:void(0);" class="remCollege" style="float: right;position: relative;top: -31px; display:none;"> <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="collegeLevel[]" value="2" class="form-control" />
		</td>



		</tr>

	<?php }  ?>
	</tbody>
</table>
<table class="table">
	<tr>
		<td>
			<input type="button" id="btnAdd" onclick="AddCollege()" value="+ Add Another College"  class="btn btn-primary btn-sm" name="addAnotherCollege" />
		</td>
	</tr>
</table>
<script type="text/javascript">
	function AddCollege(){
		$('.clgYrDtPckr').datepicker('destroy');
		var $tableBody = $('#empCollege').find("tbody"),$trLast = $tableBody.find("tr:last"), $trNew = $trLast.clone();
		$trLast.show();
		$trNew.find('input,select').val('');
		$trLast.after( $trNew );
		$(".remCollege").show();
		$("#empCollege").on('click','.remCollege',function(){
			var rowCount = $('#empCollege tr').length;
			if( rowCount > 2 ){ $(this).parent().parent().remove();	 }else{ $(".remCollege").hide(); }
		});
		$('input[name^="collegeYear[]"').each(function(i){
			var newID = 'collegeYear_'+i;
			$(this).attr( 'id',newID );
			$( "#" + newID + "" ).datepicker();
		});
	}
</script>
<br />
<br />
<?php
	$uniNames = array( "Air_University_AU_Islamabad", "Allama_Iqbal_Open_University_AIOU_Islamabad", "Bahria_University_BU_Islamabad", "COMSATS_Institute_of_Information_Technology_Islamabad", "Federal_Urdu_University_of_Arts_Sciences_and_Technology_Islamabad", "Foundation_University_Islamabad", "Institute_of_Space_Technology__IST__Islamabad", "International_Islamic_University__IIU__Islamabad", "National_University_of_Computer_and_Emerging_Sciences_Islamabad", "National_University_of_Modern_Languages_Islamabad", "Pakistan_Institute_of_Engineering_&_Applied_Sciences_Islamabad", "Quaid_i_Azam_University_Islamabad", "Riphah_International_University__Islamabad", "Bahauddin_Zakariya_University__Multan", "Beaconhouse_National_University__BNU__Lahore", "College_of_Buisness_Administration&_Economics__NCBA&E__Lahore", "Fatima_Jinnah_Women_University__FJWU__Rawalpindi", "Forman_Christian_College__FCC__Lahore", "GIFT_University_Gujranwala", "Government_College_University__GCU__Faisalabad", "Government_College_University__GCU__Lahore", "Hajvery_University__HU__Lahore", "Imperial_College_of_Business_Studies_Lahore", "Institute_of_Management_Sciences__IMS__Lahore", "Islamia_University_Bahawalpur", "Kinnaird_College_for_Women_Lahore", "Lahore_College_for_Women_University__LCWU__Lahore", "Lahore_School_of_Economics__LSE__Lahore", "Lahore_University_of_Management_Sciences__LUMS__Lahore", "Minhaj_University_Lahore", "National_College_of_Arts__NCA__Lahore", "National_Textile_University__NTU__Faisalabad__Federal_Chartered", "National_University_of_Sciences_&_Technology__NUST__Rawalpindi", "The_Superior_College_Lahore", "The_University_of_Management_&_Technology__UMT__Lahore", "University_of_Agriculture_Faisalabad", "University_of_Arid_Agriculture_Murree_Road_Rawalpindi", "University_of_Central_Punjab__UCP__Lahore", "University_of_Education_Lahore", "University_of_Engineering_&_Technology__UET__Lahore", "University_of_Engineering_&_Technology__UET__Taxila", "University_of_Faisalabad_Faisalabad", "University_of_Gujrat__Gujrat", "University_of_Health_Sciences__UHS__Lahore", "University_of_Lahore_Lahore", "University_of_Sargodha_Sargodha", "University_of_South_Asia__USA__Lahore", "University_of_Veterinary_and_Animal_Sciences__UVAS__Lahore", "Virtual_University_of_Pakistan__VU__Lahore","Agha_Khan_University__AKU__Karachi","Baqai_Medical_University_Karachi","Dadabhoy_Institute_of_Higher_Education_Karachi","Dow_University_of_Health_Sciences_Karachi","Greenwich_University_Karachi","Hamdard_University_Karachi","Indus_Institute_of_Higher_Education Karachi","Indus_Valley_School_of_Art_and_Architecture_Karachi","Institute_of_Business_&_Technology_BIZTEK_Karachi","Institute_of_Business_Administration__IBA__Karachi","Institute_of_Business_Management__IoBM__Karachi","Iqra_University_Karachi","Isra_University_Hyderabad","Jinnah_University_for_Women_Karachi","Karachi_Institute_of_Economics_&_Technology__KIET__Karachi","KASB__Khadim_Ali_Shah_Bukhari__Institute_of_Technology_Karachi","Liaquat_University_of_Medical_and_Health_Sciences__LUMHS__Jamshoro_Sindh","Mehran_University_of_Eng_&_Technology_Jamshoro","Mohammad_Ali_Jinnah_University__MAJU__Karachi","NED_University_of_Engineering_&_Technology_Karachi", "Newports_Institute_of_Communications_and_Economics_Karachi","Pakistan_Naval_Academy_Karachi","Preston_Institute_of_Management_Sciences_and_Technology__PIMSAT__Karachi","Preston_University_Karachi","Quaid_e_Awam_University_of_Engineering_Science_&_Technology_Nawabshah","Shah_Abdul_Latif_University_Khairpur","Shaheed_Zulfikar_Ali_Bhutto_Institute_of_Science_&_Technology__SZABIST__Karachi","Sindh_Agriculture_University_Tandojam","Sir_Syed_University_of_Engg_&_Technology__SSUET__Karachi","Sukkur_Institute_of_Business_Administration_Sukkur","Textile_Institute_of_Pakistan__TIP__Karachi","University_of_East_Hyderabad","University_of_Karachi__UoK__Karachi","University_of_Sindh_Jamshoro","Zia_ud_Din_Medical_University_Karachi","Balochistan_University_of_Engineering_and_Technology_Khuzdar","Balochistan_University_of_Information_Technology_and_Management_Sciences_Quetta","Iqra_University_Quetta","Sardar_Bahadur_Khan_Women_University_Quetta","University_of_Balochistan_Quetta","Khyber_Pakhtunkhwa _formerly_NWFP","Frontier_Women_University_Peshawar","CECOS_University_of_Information_Technology_and_Emerging_Sciences_Peshawar","City_University_of_Science_&_Information_Technology_Peshawar","Gandhara_University_Peshawar","Ghulam_Ishaq_Khan_Institute_of_Engineering_Sciences_&_Technology_Swabi","Gomal_University_DI_Khan","Hazara_University_Dodhial_Mansehra","Institute_of_Management_Sciences__IMSciences__Peshawar","Karakuram_International_University_Gilgit","Kohat_University_of_Science_&_Technology__KUST__Kohat","Lasbelaa_University_of_Agriculture_Water_&_Marine_Science_Othal","Northern_University_Nowshera_Cantonment","NWFP_Agriculture_University_Peshawar","NWFP_University_of_Engineering_&_Technology_Peshawar","Pakistan_Military_Academy_Abbottabad","Preston_University_Kohat","Qurtaba_University_of_Science_&_Information_Technology_D_I_Khan","Sarhad_University_of_Science_&_Information_Technology_Peshawar__Approved_Distance_Education_Centers_of__SUIT__Peshawar","University_of_Malakand_Chakdara_Dir_Malakand","University_of_Peshawar_Peshawar","University_of_Science_&_Technology_Bannu");

	$uniQtions = array("Bachelor_in_Business_Administration","Bachelor_ in_Commerce_Honours","Bachelor_in_Engineering","Bachelor_in_Science_Engineering","Bachelor_ in_Science_Honours","Bachelor_in_Education","Bachelor_in_Fine_Arts","Bachelor_in_Pharmacy","Bachelor_in_Science","Doctor_in_Pharmacy","Bachelor_in_Dental_Surgery","Doctor_in_Veterinary_Medicine","Bachelor_in_Law","Masters_in_Accounting","Master_in_Advertising","Masters_in_Agriculture","Masters_in_Art and Design","Masters_in_Biochemistry","Masters_in_Civil Engineering","Masters_in_Botany","Masters_in_Journalism","Masters_in_Business_Administration_Management","Masters_in_Chemical_Engineering","Masters_in_Chemistry","Masters_in_Commerce","Masters_in_Communication","Masters_in_Computer Science","Masters_in_Consulting","Masters_in_Mechanical_Engineering","Masters_in_Economics","Masters_in_Education","Masters_in_Electrical_and_Electronics_Engineering","Masters_in_English_Literature","Masters_in_English_Linguistics",
	"Masters_in_Environmental_Health","Masters_in_Library_Science","Masters_in_Fashion_Merchandising","Masters_in_Finance_Accounting","Masters_in_Finance_&_Banking","Masters_in_Finance","Masters_in_Food_Science","Masters_in_Materials_Science","Masters_in_Geography","Masters_in_Geology","Masters_in_Health_Science","Masters_in_History","Masters_in_Human_Resources","Masters_in_Humanities","Masters_in_Information_Technology","Masters_in_Logistics","Masters_in_International_Business","Masters_in_Islamic_Studies","Masters_in_Law","Masters_in_Management","Masters_in_Marketing","Masters_in_Mathematics","Masters_in_Nursing","Masters_in_Paramedical","Masters_in_Pharmacy","Masters_in_Philosophy","Masters_in_Physics","Masters_in_Psychology","Masters_in_Public_Health_Education","Masters_in_Risk_Management","Masters_in_Science","Masters_in_Social_Studies","Masters_in_Sociology","Masters_in_Software_Engineering","Masters_in_Sports","Masters_in_Statistics","Masters_in_Strategic_Management","Masters_in_Zoology" );

	$uniSubjects = array("Accounting","Additional_Mathematics","Advertising","Agriculture","Art_and_Design","Biochemistry","Biology","Botany","Business_Studies","Chemical","Chemistry","Commerce","Communication","Computer_Science","Economics","Education","Electrical_and_Electronics","English","English_Language","English_Literature","Environmental_Management","Environmental_Health","Finance","Food_&_Nutrition","Food_Science","Geography","Geology","Health_Science","History","Human_&_Social_Biology","Human_Resources","Humanities","Information_Technology","International_Business","Islamic_Studies","Islamiyat","Journalism","Law","Library_Science","Logistics","Management","Marketing","Mathematics","Nursing","Pakistan_Studies","Paramedical","Pharmacy","Philosophy","Physics","Psychology","Public_Health","Risk_Management","Science","Sindhi","Social_Studies","Sociology","Sports","Statistics","Strategic_Management","Urdu","Urdu_First_Language","Urdu_Second_Language","World_history","Zoology");

?>

	 <header>University</header>

<br />
<table class="table" id="empUniversity" style="width:98%">
	<thead>
		<th> University Name </th>

		<th> Qualification </th>
		<th> Subject </th>
		<th> Result </th>
		<th> Year </th>
	</thead>
	<tbody>
	<?php
	if( !empty( $empQUniversity ) ) {
		foreach($empQUniversity as $uni ): ?>

<tr class="uniRowClone">
		<td>
		<?php if (in_array($uni->title, $uniNames)) { ?>
			<div class="uniContainer1">
			<label class="select">
		   <select name="universityName[]" class="slct_uniname">
			  <option value="">University name</option>

			 <?php foreach($uniNames as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($uni->title == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			  </select>
			<i></i> </label>
			</div>

			<div class="uniContainer2" style="display:none;">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universityNames[]" class="txt_uniname form-control" />
				</label>
				<a href="#" class="btn_un">close</a>
			</div>
		<?php }else{ ?>

			<div class="uniContainer1" style="display:none;">
			<label class="select">
		   <select name="universityNames[]" class="slct_uniname">
			  <option value="">University name</option>

			 <?php foreach($uniNames as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($uni->title == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			  </select>
			<i></i> </label>
			</div>

			<div class="uniContainer2">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universityName[]" class="txt_uniname form-control" value="<?=$uni->title;?>" />
				</label>
				<a href="#" class="btn_un">close</a>
			</div>

		<?php } ?>
		</td>


		<td>

			<?php if (in_array($uni->qualification, $uniQtions)) { ?>
			<div class="qtContainer1">
			<label class="select">
		   <select name="universityQualification[]" class="slct_uniqual">
			  <option value="">Choose Qualification</option>
			  <?php foreach($uniQtions as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($uni->qualification == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="qtContainer2" style="display:none;">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universityQualification2[]" class="txt_uniqual form-control" />
				</label>
				<a href="#" class="btn_uq">close</a>
			</div>
			<?php }else{ ?>

			<div class="qtContainer1" style="display:none;">
			<label class="select">
		   <select name="universityQualifications[]" class="slct_uniqual">
			  <option value="">Choose Qualification</option>
			  <?php foreach($uniQtions as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($uni->qualification == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="qtContainer2">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universityQualification[]" class="txt_uniqual form-control" value="<?=$uni->qualification;?>" />
				</label>
				<a href="#" class="btn_uq">close</a>
			</div>


			<?php } ?>
		</td>

		<td>
			<?php if (in_array($uni->subjects, $uniSubjects)) { ?>
			<div class="unisubContainer1">
			<label class="select">
		   <select name="universitySubject[]" class="slct_unisubjct">
			  <option value="">Choose Subject</option>
			  <?php foreach($uniSubjects as $uQ ){ ?>
				<option value="<?=$uQ;?>" <?php if($uni->subjects == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="unisubContainer2" style="display:none;">

				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universitySubjects[]" class="txt_unisubjct form-control" value="<?=$uni->subjects;?>" />
				</label>
				<a href="#" class="btn_usb">close</a>

			</div>
				<?php }else{ ?>

				<div class="unisubContainer1" style="display:none;">
				<label class="select">
			   <select name="universitySubjects[]" class="slct_unisubjct">
				  <option value="">Choose Subject</option>
				  <?php foreach($uniSubjects as $uQ ){ ?>
					<option value="<?=$uQ;?>" <?php if($uni->subjects == $uQ){ echo "selected"; } ?>> <?=str_replace("_", " ",$uQ);?> </option>
				  <?php } ?>
				  <option value="Other"> Other </option>
				</select>
				<i></i> </label>
				</div>

				<div class="unisubContainer2">

					<label class="input"> <i class="icon-append fa fa-asterisk"></i>
					<input type="text" name="universitySubject[]" class="txt_unisubjct form-control" value="<?=$uni->subjects;?>" />
					</label>
					<a href="#" class="btn_usb">close</a>

				</div>



				<?php } ?>

		</td>

		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="universityResult[]" class="form-control" value="<?=$uni->result;?>" />
			</label>
		</td>

		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="universityYear[]" class="uniYrDtPckr form-control" value="<?=$uni->year_of_completion;?>" id="universityYear_0" />
			</label>
			<a href="javascript:void(0);" class="remempUniversity" style="float: right;position: relative;top: -31px; display:none;">  <i class="fa fa-trash-o"></i>  </a>


			<input type="hidden" name="universityLevel[]" value="3" />
		</td>
		</tr>

	<?php endforeach; ?>
	<?php }else{ ?>
		<tr class="uniRowClone">
		<td>
			<div class="uniContainer1">
			<label class="select">
		   <select name="universityName[]" class="slct_uniname">
			  <option value="">University name</option>

			 <?php foreach($uniNames as $uQ ){ ?>
				<option value="<?=$uQ;?>"> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			  </select>
			<i></i> </label>
			</div>

			<div class="uniContainer2" style="display:none;">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universityNames[]" class="txt_uniname form-control" />
				</label>
				<a href="#" class="btn_un">close</a>
			</div>

		</td>

		<td>



			<div class="qtContainer1">
			<label class="select">
		   <select name="universityQualification[]" class="slct_uniqual">
			  <option value="">Choose Qualification</option>
			  <?php foreach($uniQtions as $uQ ){ ?>
				<option value="<?=$uQ;?>"> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="qtContainer2" style="display:none;">
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universityQualification2[]" class="txt_uniqual form-control" />
				</label>
				<a href="#" class="btn_uq">close</a>
			</div>


		</td>

		<td>
			<div class="unisubContainer1">
			<label class="select">
		   <select name="universitySubject[]" class="slct_unisubjct">
			  <option value="">Choose Subject</option>
			  <?php foreach($uniSubjects as $uQ ){ ?>
				<option value="<?=$uQ;?>"> <?=str_replace("_", " ",$uQ);?> </option>
			  <?php } ?>
			  <option value="Other"> Other </option>
			</select>
			<i></i> </label>
			</div>

			<div class="unisubContainer2" style="display:none;">

				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="universitySubjects[]" class="txt_unisubjct form-control" />
				</label>
				<a href="#" class="btn_usb">close</a>

			</div>


		</td>

		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="universityResult[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="universityYear[]" class="uniYrDtPckr form-control" id="universityYear_0" />


			</label>

				<a href="javascript:void(0);" class="remempUniversity" style="float: right;position: relative;top: -31px; display:none;">  <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="universityLevel[]" value="3" class="form-control" />
		</td>
		</tr>
	<?php }  ?>

	</tbody>
</table>

<table class="table">
	<tr>
		<td>
			<input type="button" id="btnAdd" onclick="Adduniversity()" value="+ Add Another University"  class="btn btn-primary btn-sm" name="addAnotherUniversity" />
		</td>
	</tr>
</table>


<script type="text/javascript">
function Adduniversity(){

	$('.uniYrDtPckr').datepicker('destroy');
	var $tableBody = $('#empUniversity').find("tbody"),
	$trLast = $tableBody.find("tr:last"),
	$trNew = $trLast.clone();
	$trNew.find('input,select').val('');
	$trLast.after($trNew);

$(".remempUniversity").show();

	$("#empUniversity").on('click','.remempUniversity',function(){
		var rowCount = $('#empUniversity tr').length;
		if( rowCount > 2 ){ $(this).parent().parent().remove();	 }else{ $(".remempUniversity").hide(); }
	});

	$('input[name^="universityYear[]"').each(function(i){
		var newID = 'universityYear_'+i;
		$(this).attr( 'id',newID );
		$( "#" + newID + "" ).datepicker();
	});



}
</script>




    	<br />
	<br />


	 <header>Professional</header>

<br />
<table class="table" id="empProfessional" style="width:98%">
	<thead>
		<th> Professional Name </th>
		<th> Qualification </th>
		<th> Subject </th>

		<th> Result </th>
		<th> Year </th>
	</thead>
	<tbody>
	<?php
	if( !empty( $empQProfessional ) ) {
		foreach($empQProfessional as $pro ): ?>

		<tr>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalName[]" class="form-control" value="<?=$pro->title;?>"  />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalQualification[]" class="form-control" value="<?=$pro->qualification;?>" />
			</label>

		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalSubject[]" class="form-control" value="<?=$pro->subjects;?>"  />
			</label>
		</td>



		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalResult[]" class="form-control" value="<?=$pro->result;?>" />
			</label>
		</td>


		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalYear[]" class="proYrDtPckr form-control" value="<?=$pro->year_of_completion;?>" id="proYear_0" />
			</label>
			<a href="javascript:void(0);" class="remprofessional" style="float: right;position: relative;top: -31px; display:none;">  <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="professionalLevel[]" value="4" class="form-control" />
		</td>
		</tr>
	<?php endforeach; ?>
	<?php }else{ ?>
			<tr>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalName[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalQualification[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalSubject[]" class="form-control" />
			</label>
		</td>


		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalResult[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="professionalYear[]" class="proYrDtPckr form-control" id="proYear_0" />
			</label>
			<a href="javascript:void(0);" class="remprofessional" style="float: right;position: relative;top: -31px; display:none;">  <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="professionalLevel[]" value="4" class="form-control" />
		</td>
		</tr>

		<?php }  ?>
	</tbody>
</table>
<table class="table">
	<tr>
		<td>
		<input type="button" id="btnAdd" onclick="Addprofessional()" value="+ Add Another Professional"  class="btn btn-primary btn-sm" name="addAnotherProfessional" />
		</td>
	</tr>
</table>

<script type="text/javascript">
function Addprofessional(){

$('.proYrDtPckr').datepicker('destroy');
	var $tableBody = $('#empProfessional').find("tbody"),
	$trLast = $tableBody.find("tr:last"),
	$trNew = $trLast.clone();
	$trNew.find('input,select').val('');
	$trLast.after($trNew);

$(".remprofessional").show();

	$("#empProfessional").on('click','.remprofessional',function(){
		var rowCount = $('#empProfessional tr').length;
		if( rowCount > 2 ){ $(this).parent().parent().remove();	 }else{ $(".remprofessional").hide(); }
	});

	$('input[name^="professionalYear[]"').each(function(i){
		var newID = 'proYear_'+i;
		$(this).attr( 'id',newID );
		$( "#" + newID + "" ).datepicker();
	});

}
</script>





    	<br />
	<br />


	 <header>Others</header>

<br />
<table class="table" id="empothers" style="width:98%">
	<thead>
		<th> Others Name </th>
		<th> Qualification </th>
		<th> Subject </th>

		<th> Result </th>
		<th> Year </th>
	</thead>
	<tbody>
	<?php
	if( !empty( $empQOthers ) ) {
		foreach($empQOthers as $other ): ?>
		<tr>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersName[]" class="form-control" value="<?=$other->title;?>"  />
			</label>
		</td>
			<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersQualification[]" class="form-control" value="<?=$other->qualification;?>" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersSubject[]" class="form-control" value="<?=$other->subjects;?>"  />
			</label>
		</td>



		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersResult[]" class="form-control" value="<?=$other->result;?>" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersYear[]" class="othrYrDtPckr form-control" value="<?=$other->year_of_completion;?>" id="othrYear_0" />
			</label>

			<a href="javascript:void(0);" class="remothers" style="float: right;position: relative;top: -31px; display:none;">  <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="othersLevel[]" value="5" class="form-control" />
		</td>
		</tr>
	<?php endforeach; ?>
	<?php }else{ ?>

		<tr>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersName[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersQualification[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersSubject[]" class="form-control" />
			</label>
		</td>


		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersResult[]" class="form-control" />
			</label>
		</td>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>
			<input type="text" name="othersYear[]" class="othrYrDtPckr form-control" id="othrYear_0" />
			</label>
			<a href="javascript:void(0);" class="remothers" style="float: right;position: relative;top: -31px; display:none;">  <i class="fa fa-trash-o"></i>  </a>
			<input type="hidden" name="othersLevel[]" value="5" class="form-control" />
		</td>
		</tr>
	<?php }  ?>
	</tbody>
</table>
<table class="table">
	<tr>
		<td>
		<input type="button" id="btnAdd" onclick="AddOthers()" value="+ Add Another Others"  class="btn btn-primary btn-sm" name="addAnotherOthers" />
		</td>
	</tr>
</table>


<script type="text/javascript">
function AddOthers(){

/*$('#empothers').append('<tr><td><label class="input"> <i class="icon-append fa fa-asterisk"></i><input type="text" name="othersName[]" class="form-control" /></label></td><td><label class="input"> <i class="icon-append fa fa-asterisk"></i><input type="text" name="othersSubject[]" class="form-control" /></label></td><td><label class="input"> <i class="icon-append fa fa-asterisk"></i><input type="text" name="othersQualification[]" class="form-control" /></label></td><td><label class="input"> <i class="icon-append fa fa-asterisk"></i><input type="text" name="othersResult[]" class="form-control" /></label></td><td><label class="input"> <i class="icon-append fa fa-asterisk"></i><input type="text" name="othersYear[]" class="form-control" style="width:95%;" /> </label> <input type="hidden" name="othersLevel[]" value="5" class="form-control" /> <a href="javascript:void(0);" class="remothers" style="float: right;position: relative;top: -31px;"> <i class="fa fa-trash-o"></i> </a></td></tr>');
$("#empothers").on('click','.remothers',function(){    $(this).parent().parent().remove();  });*/

$('.othrYrDtPckr').datepicker('destroy');
var $tableBody = $('#empothers').find("tbody"),
$trLast = $tableBody.find("tr:last"),
$trNew = $trLast.clone();
$trNew.find('input,select').val('');
$trLast.after($trNew);
$(".remothers").show();
$("#empothers").on('click','.remothers',function(){
	var rowCount = $('#empothers tr').length;
	if( rowCount > 2 ){ $(this).parent().parent().remove();	 }else{ $(".remothers").hide(); }
});

$('input[name^="othersYear[]"').each(function(i){
	var newID = 'othrYear_'+i;
	$(this).attr( 'id',newID );
	$( "#" + newID + "" ).datepicker();
});

}
</script>
 <fieldset>
</div>
</div>
<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>
</div><!-- /end educationalRecord -->







<style>
.icon-append.fa.fa-calendar {
    width: 20%;

}

</style>

<div class="tab-pane" id="employmentHistory">

<form id="staffEmploymentHistory" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />


 <div class="powerwidget dark-red" data-widget-editbutton="false">
              <header>
                Employment History  <small> Your employment history ( Teaching and otherwise )</small>
              </header>
              <div class="inner-spacer">

<fieldset>

<table class="table table-striped table-hover" id="empHistory" style="width:100%">
	<!--thead>
		<th> Institution  </th>
		<th> Designation </th>
		<th> Class(s) taught </th>
		<th> Subject(s) taught </th>
		<th> Salary  </th>
		<th> From (year)</th>
		<th> To (year) </th>
		<th> Reason for leaving </th>
	</thead -->
	<tbody>
	<?php
	$counter = 0;
	if( !empty( $empEHistory ) ) {
		foreach($empEHistory as $exp ): ?>
		<?php /* ?>

		<tr>
		<td width="27%">
			<label class="input">
			<input type="text" name="institutionName[]" class="form-control" value="<?=$exp->organization;?>" />
			</label>
		</td>
		<td width="15%">
			<label class="input">
			<input type="text" name="institutionDesignation[]" class="form-control" value="<?=$exp->department;?>" />
			</label>
		</td>
		<td width="3%">
			<label class="input">
			<input type="text" name="institutionClass[]" class="form-control" value="<?=$exp->classes_taught;?>" />
			</label>

				<label class="select">
				<select name="institutionClass[]">
				<option value=""> Choose Grade </option>
				<option value="PN" <?php if($exp->classes_taught == "PN"){ echo "selected"; }?>> PN </option>
				<option value="N"  <?php if($exp->classes_taught == "N"){ echo "selected"; }?>> N </option>
				<option value="KG" <?php if($exp->classes_taught == "KG"){ echo "selected"; }?>> KG </option>
				<option value="I"  <?php if($exp->classes_taught == "I"){ echo "selected"; }?>> I </option>
				<option value="II"  <?php if($exp->classes_taught == "II"){ echo "selected"; }?>> II </option>
				<option value="III" <?php if($exp->classes_taught == "III"){ echo "selected"; }?>> III </option>
				<option value="IV" <?php if($exp->classes_taught == "IV"){ echo "selected"; }?>> IV </option>
				<option value="V" <?php if($exp->classes_taught == "V"){ echo "selected"; }?>> V </option>
				<option value="VI" <?php if($exp->classes_taught == "VI"){ echo "selected"; }?>> VI </option>
				<option value="VII" <?php if($exp->classes_taught == "VII"){ echo "selected"; }?>> VII </option>
				<option value="VIII" <?php if($exp->classes_taught == "VIII"){ echo "selected"; }?>> VIII </option>
				<option value="IX" <?php if($exp->classes_taught == "IX"){ echo "selected"; }?>> IX </option>
				<option value="X" <?php if($exp->classes_taught == "X"){ echo "selected"; }?>> X </option>
				<option value="XI" <?php if($exp->classes_taught == "PN"){ echo "selected"; }?>> XI </option>
				<option value="A1" <?php if($exp->classes_taught == "A1"){ echo "selected"; }?>> A1 </option>
				<option value="A2" <?php if($exp->classes_taught == "A2"){ echo "selected"; }?>> A2 </option>
				</select>
				<i></i> </label>


		</td>
		<td width="10%">

		<label class="textarea">
			<textarea name="institutionSubject[]"><?=$exp->classes_taught;?></textarea>
			</label>
		</td>

			<td width="7%">
			<label class="input">
			<input type="text" name="institutionSalary[]" class="form-control" value="<?=$exp->salary;?>" />
			</label>
		</td>

		<td width="7%">
			<label class="input">
			<input type="text" name="institutionFrom[]" class="experienceFromYear form-control" value="<?=$exp->from_year;?>" id="efYear_0" />
			</label>
		</td>
		<td width="7%">
			<label class="input">
			<input type="text" name="institutionTo[]" class="experienceToYear form-control" value="<?=$exp->to_year;?>"  id="etYear_0"  />
			</label>
		</td>
		<td>
		<label class="textarea">
		<textarea name="institutionLeavingReason[]"><?=$exp->reason_for_leaving;?></textarea>
		</label>
		<a href="javascript:void(0);" class="remHistory" style="float: right;position: relative;top: 1px;"> <i class="fa fa-trash-o"></i>  </a>
		</td>

		</tr>
			<?php */ ?>

		<tr>
		<td>

		<section class="col col-6">
			<section>
				<label class="label">Institution</label>
				<label class="input">
				<input type="text" name="institutionName[]" class="form-control" value="<?=$exp->organization;?>" />
				 <b class="tooltip tooltip-top-right">Institute name where you were employee.</b>
				</label>
				</section>
				<!--div class="row" -->
				<section class="col-12">
				<section class="col col-3" style="padding-left: 0;padding-right: 24px;">
				<label class="label"> Designation  </label>
				<label class="input">
				<input type="text" name="institutionDesignation[]" class="form-control" value="<?=$exp->department;?>" />
				 <b class="tooltip tooltip-top-right">Designation hold.</b>
				</label>
				</section>

				<section class="col col-2" style="padding-left: 0;padding-right: 24px;">
					<label class="label">Salary</label>
					<label class="input">
					<input type="text" name="institutionSalary[]" class="form-control" value="<?=$exp->salary;?>" />
					</label>
					</section>

					   <section class="col col-3" style="padding-left: 0;padding-right: 24px;">
					   <label class="label">From (Date)</label>
					    <label class="input"> <i class="icon-append fa fa-calendar" style="width:20%"></i>
                          <input type="text" name="institutionFrom[]" class="experienceFromYear form-control" value="<?=$exp->from_year;?>" id="efYear_0" style="padding-right:0px;" />
                        </label>
                      </section>
					  <?php if($exp->to_year != "" ) {
						$display = "block";
					  }else{
						$display = "none";
					  } ?>
					  <section class="presentSection col col-3"  style="padding-left:0;display:<?=$display;?>;" id="toDateH_<?=$counter;?>">
						  <label class="label">To (Date)</label>
							<label class="input"> <i class="icon-append fa fa-calendar" style="width:20%"></i>
							  <input type="text" name="institutionTo[]" class="experienceToYear form-control" value="<?=$exp->to_year;?>"  id="etYear_0" style="padding-right:0px;" />

							</label>
							</section>

						<section class="col col-1"  style="margin-bottom: 0;margin-left: 0;margin-top: 43px; padding: 0;">
					<!--div class="inline-group" style="padding:0;" -->

                        <label class="checkbox" style="font-size:12px;font-weight:bold;">
                          <input type="checkbox" <?php if($display == "none" ){ echo 'checked="checked"'; }?> name="present[]" class="presentCheckBox">
                          <i></i>Present</label>
						  <!--/div -->

						</section>
				</section>
                     <!--/div -->


					 <section style="float:left;width:100%;">
                      <label class="label">Class(s) taught</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionClass[]" rows="3"><?=$exp->classes_taught;?></textarea>
                       <b class="tooltip tooltip-top-right">Please tell us Class(s) you have taught</b> </label>
                    </section>

			</section>


			<section class="col col-6">

						<section>
                      <label class="label">Subject(s) taught</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionSubject[]" rows="3" cols="5"><?=$exp->subject_taught;?></textarea>
                        <b class="tooltip tooltip-top-right">Please tell us Subject(s) you have taught</b> </label>
                    </section>
					<br />
					<section style="">
                      <label class="label">Reason For Leaving</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionLeavingReason[]" rows="3"><?=$exp->reason_for_leaving;?></textarea>
                        <b class="tooltip tooltip-top-right">Reason for leaving you current job</b> </label>
                    </section>
					</section>
					<a href="javascript:void(0);" class="remHistory" style="float: right;position: relative;top: 1px; display:none;"> <i class="fa fa-trash-o"></i>  </a>
		</td>

		</tr>


		<?php $counter++; ?>
		<?php endforeach; ?>
	<?php }else{ ?>
		<?php /* ?>
		<tr>
		<td width="27%">
			<label class="input">
			<input type="text" name="institutionName[]" class="form-control" placeholder="Institution Name" />
			</label>
		</td>
		<td width="15%">
			<label class="input">
			<input type="text" name="institutionDesignation[]" class="form-control" placeholder="Designation"  />
			</label>
		</td>
		<td width="3%">
			<label class="input">
			<input type="text" name="institutionClass[]" class="form-control" />
			</label>


			<label class="select">
				<select name="institutionClass[]">
				<option value=""> Choose Grade </option>
				<option value="PN"> PN </option>
				<option value="N"> N </option>
				<option value="KG"> KG </option>
				<option value="I"> I </option>
				<option value="II"> II </option>
				<option value="III"> III </option>
				<option value="IV"> IV </option>
				<option value="V"> V </option>
				<option value="VI"> VI </option>
				<option value="VII"> VII </option>
				<option value="VIII"> VIII </option>
				<option value="IX"> IX </option>
				<option value="X"> X </option>
				<option value="XI"> XI </option>
				<option value="A1"> A1 </option>
				<option value="A2"> A2 </option>
				</select>
				</select>
				<i></i> </label>

		</td>
		<td width="10%">


			<textarea name="institutionSubject[]"></textarea>

		</td>

			<td width="7%">
			<label class="input">
			<input type="text" name="institutionSalary[]" class="form-control" placeholder="Salary" />
			</label>
		</td>

		<td width="7%">
			<label class="input">
			<input type="text" name="institutionFrom[]" class="experienceFromYear form-control" placeholder="Year" id="efYear_0" />
			</label>
		</td>
		<td width="7%">
			<label class="input">
			<input type="text" name="institutionTo[]" class="experienceToYear form-control" placeholder="Year" id="etYear_0"  />
			</label>
		</td>
		<td><textarea name="institutionLeavingReason[]"></textarea>
		<a href="javascript:void(0);" class="remHistory" style="float: right;position: relative;top: 1px;"> <i class="fa fa-trash-o"></i>  </a>
		</td>

		</tr>
		<?php */ ?>

	<tr>
		<td>

		<section class="col col-6">
			<section>
				<label class="label">Institution</label>
				<label class="input">
				<input type="text" name="institutionName[]" class="form-control" value="" />
				 <b class="tooltip tooltip-top-right">Institute name where you were employee</b>
				</label>
				</section>
				<div class="row">
				<section class="col-12">
				<section class="col col-3">
				<label class="label"> Designation  </label>
				<label class="input">
				<input type="text" name="institutionDesignation[]" class="form-control" value="" />
				<b class="tooltip tooltip-top-right">Designation hold.</b>
				</label>
				</section>

			<section class="col col-2">
				<label class="label">Salary</label>
				<label class="input">
				<input type="text" name="institutionSalary[]" class="form-control" value="" />
				</label>
				</section>

					   <section class="col col-3">
					   <label class="label">From (Date)</label>
					    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                          <input type="text" name="institutionFrom[]" class="experienceFromYear form-control" value="" id="efYear_0" />
                        </label>
                      </section>

				<section class="presentSection col col-3"  style="padding-left:0;display:none;" id="toDateH_0">
						  <label class="label">To (Date)</label>
							<label class="input"> <i class="icon-append fa fa-calendar" style="width:20%"></i>
							  <input type="text" name="institutionTo[]" class="experienceToYear form-control" value=""  id="etYear_0" style="padding-right:0px;" />

							</label>
							</section>

						<section class="col col-1"  style="margin-bottom: 0;margin-left: 0;margin-top: 43px; padding: 0;">
					<div class="inline-group" style="padding:0;">

                        <label class="checkbox" style="font-size:12px;font-weight:bold;">
                          <input type="checkbox" checked="checked" name="present[]" class="presentCheckBox">
                          <i></i>Present</label>
						  </div>
						</section>



					   </section>
                     </div>


					 <section>
                      <label class="label">Class(s) taught</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionClass[]" rows="3"></textarea>
                       <b class="tooltip tooltip-top-right">Please tell us Class(s) you have taught</b> </label>
                    </section>

			</section>


			<section class="col col-6">

				<section>
				<label class="label">Subject(s) taught</label>
				<label class="textarea"> <i class="icon-append fa fa-question"></i>
				<textarea name="institutionSubject[]" rows="3"></textarea>
				<b class="tooltip tooltip-top-right">Please tell us Subject(s) you have taught</b> </label>
				</section>

				<section>
				<label class="label">Reason For Leaving</label>
				<label class="textarea"> <i class="icon-append fa fa-question"></i>
				<textarea name="institutionLeavingReason[]" rows="3"></textarea>
				<b class="tooltip tooltip-top-right">Reason for leaving you current job</b> </label>
				</section>
			</section>
					<a href="javascript:void(0);" class="remHistory" style="float: right;position: relative;top: 1px;"> <i class="fa fa-trash-o"></i>  </a>
		</td>

		</tr>


		<?php } ?>


	</tbody>
</table>



 <!--table id="empHistoryNew" class="table">
 <tbody>
	<tr>
		<td>

		<section class="col col-6">
			<section>
				<label class="label">Text input</label>
				<label class="input">
				<input type="text" name="institutionName[]" class="form-control" placeholder="Institution Name" />
				</label>
				</section>
				<div class="row">
				<section class="col-12">
				<section class="col col-4">
				<label class="label">Text input</label>
				<label class="input">
				<input type="text" name="institutionDesignation[]" class="form-control" placeholder="Designation"  />
				</label>
				</section>

			<section class="col col-2">
				<label class="label">Salary</label>
				<label class="input">
				<input type="text" name="institutionSalary[]" class="form-control" placeholder="Salary" />
				</label>
				</section>

					   <section class="col col-3">
					   <label class="label">Text input</label>
					    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                          <input type="text" name="institutionFrom[]" class="experienceFromYear form-control" placeholder="Year"/>
                        </label>
                      </section>

					  <section class="col col-3">
					  <label class="label">Text input</label>
					    <label class="input"> <i class="icon-append fa fa-calendar"></i>
                          <input type="text" name="institutionFrom[]" class="experienceFromYear form-control" placeholder="Year asdfg "/>
                        </label>
                      </section>
					   </section>
                     </div>


					 <section>
                      <label class="label">Textarea with top-right tooltip</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionClass[]" placeholder="Focus to view the tooltip" rows="3"></textarea>
                        <b class="tooltip tooltip-top-right">Some helpful information</b> </label>
                    </section>

			</section>


			<section class="col col-6">

						<section>
                      <label class="label">Textarea with top-right tooltip</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionSubject[]" placeholder="Focus to view the tooltip" rows="3"></textarea>
                        <b class="tooltip tooltip-top-right">Some helpful information</b> </label>
                    </section>

					<section>
                      <label class="label">Textarea with top-right tooltip</label>
                      <label class="textarea"> <i class="icon-append fa fa-question"></i>
                        <textarea name="institutionLeavingReason[]" placeholder="Focus to view the tooltip" rows="3"></textarea>
                        <b class="tooltip tooltip-top-right">Some helpful information</b> </label>
                    </section>
					</section>
		</td>
		</tr>
		</tbody></table -->



<table class="table">
	<tr>
		<td>
<input type="button" id="btnAdd" onclick="AddHistory()" value="+ Add Another Institution"  class="btn btn-primary btn-sm" name="addAnotherInstitution" /> 		</td>
	</tr>
</table>

<script type="text/javascript">
function AddHistory(){

/*var addRowHistory;
addRowHistory = '<tr><td width="27%"><label class="input"> <input type="text" name="institutionName[]" class="form-control" placeholder="Institution Name"  /></td><td width="15%"><label class="input"> <input type="text" name="institutionDesignation[]" class="form-control" placeholder="Designation" /></label></td><td width="3%"><label class="input"> <input type="text" name="institutionClass[]" class="form-control" placeholder="Class" /></label></td><td width="10%"><textarea name="institutionSubject[]"></textarea></td><td width="7%"><label class="input"> <input type="text" name="institutionSalary[]" class="form-control" placeholder="Salary" /></label></td> <td width="7%"> <label class="input"> <input type="text" name="institutionFrom[]" class="form-control" placeholder="Year" /></label></td><td width="7%"><label class="input"><input type="text" name="institutionTo[]" class="form-control" placeholder="Year" /></label></td><td><textarea name="institutionLeavingReason[]"></textarea> <a href="javascript:void(0);" class="remHistory" style="float: right;position: relative;top: 1px;"> <i class="fa fa-trash-o"></i>  </a></td></tr>';
$('#empHistory').append( addRowHistory );
$("#empHistory").on('click','.remHistory',function(){    $(this).parent().parent().remove();  });
*/

$('.experienceFromYear').datepicker('destroy');
$('.experienceToYear').datepicker('destroy');

var $tableBody = $('#empHistory').find("tbody"),
$trLast = $tableBody.find("tr:last"),
$trNew = $trLast.clone();
$trNew.find('input,select,textarea').val('');
$trLast.after($trNew);

/*
var $tableBodies = $('#empHistoryNew').find("tbody"),
$trLast2 = $tableBodies.find("tr:last"),
$trNew2 = $trLast2.clone();
$trNew2.find('input,textarea').val('');
$trLast2.after($trNew2); */


//$('.smallBox').clone().insertAfter(".smallBox");


$(".remHistory").show();
$("#empHistory").on('click','.remHistory',function(){
	var rowCount = $('#empHistory tr').length;
	//alert(rowCount);
	if( rowCount > 1 ){ $(this).parent().parent().remove();	 }else{ $(".remHistory").hide(); }
});


//$(".experienceFromYear").datepicker('distory');
if ( $('input[name^="institutionFrom[]"').length) {
	$('input[name^="institutionFrom[]"').each(function(i){
	var newID = 'efYear_'+i;
	$(this).attr( 'id',newID );
	$( "#" + newID + "" ).datepicker();
	});


}
//var presentSection = ;

$(".presentSection").each(function(i){
	var newID = 'toDateH_'+i;
	$(this).attr( 'id',newID );
});

$('.experienceToYear').datepicker('destroy');

if ( $('input[name^="institutionTo[]"').length) {
	$('input[name^="institutionTo[]"').each(function(i){
		var newIDs = 'etYear_'+i;
		//alert( newIDs )
		$(this).attr( 'id',newIDs );
		$( "#" + newIDs + "" ).datepicker();


	});
}

}
</script>


</fieldset>
</div>
</div>

<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>

</div> <!-- /end employmentHistory -->



<div class="tab-pane" id="spouseDetail">

<form id="staffspouseDetail" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />

<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header>	Parents / Spouse Details   </header>
  <div class="inner-spacer">
	<fieldset>


<table class="table" style="width:98%">
	<thead>
	<tr>
		<th style="text-align:center"> Father </th>
		<th style="text-align:center"> Spouse </th>
	</tr>
	</thead>
	<tr>
		<td width="50%">
			<table class="table">
			<?php if( !empty( $empSpouses ) ){ ?>
					<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherName" id="spouseFatherName" class="form-control" value="<?=$empSpouses[0]->name;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Profession </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherprofession" id="spouseFatherprofession" class="form-control" value="<?=$empSpouses[0]->profession;?>" />
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Qualification </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherQualification" id="spouseFatherQualification" class="form-control" value="<?=$empSpouses[0]->qualification;?>" />
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Designation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherDesignation" id="spouseFatherDesignation" class="form-control" value="<?=$empSpouses[0]->designation;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Organisation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherCompany" id="spouseFatherCompany" class="form-control" value="<?=$empSpouses[0]->company;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Department </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherDepartment" id="spouseFatherDepartment" class="form-control" value="<?=$empSpouses[0]->department;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> CNIC </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherCNIC" id="spouseFatherCNIC" class="form-control" value="<?=$empSpouses[0]->nic;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Mobile </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherMobile" id="spouseFatherMobile" class="form-control" value="<?=$empSpouses[0]->mobile_phone;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="spouseFatherAddress" class="form-control"  rows="2"><?=$empSpouses[0]->address;?></textarea>
							</label>
						</td>
					</tr>
					<?php /* ?>
					<tr> <td><label for="input" class="control-label"> Marital Status </label></td>
						<td>


						<div class="inline-group">

						<label class="radio control-label">
						<input type="radio" name="father_maritalStatus" value="1" id="spouse_maritalStatus" <?php if ($empSpouses[0]->marital_status == 1 ) : ?>checked="checked"<?php endif; ?> />
						<i></i>Married </label>

						<label class="radio">
						<input type="radio" name="father_maritalStatus" value="3" id="Divorce" <?php if ($empSpouses[0]->marital_status == 3 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Divorce </label>

						<label class="radio">
						<input type="radio" name="father_maritalStatus" value="4" id="Widow" <?php if ($empSpouses[0]->marital_status == 4 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Widow </label>

						<label class="radio">
						<input type="radio" name="father_maritalStatus" value="5" id="Separated" <?php if ($empSpouses[0]->marital_status == 5 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Separated </label>



						</div>


						</td>
					</tr>
					<?php */ ?>
				<?php }else{ ?>
					<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherName" id="spouseFatherName" class="form-control" placeholder="Father Name">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Profession </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherprofession" id="spouseFatherprofession" class="form-control" placeholder="Father Profession">
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Qualification </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherQualification" id="spouseFatherQualification" class="form-control" placeholder="Father Qualification">
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Designation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherDesignation" id="spouseFatherDesignation" class="form-control" placeholder="Father Designation">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Organisation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherCompany" id="spouseFatherCompany" class="form-control" placeholder="Company">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Department </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherDepartment" id="spouseFatherDepartment" class="form-control" placeholder="Department">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> CNIC </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherCNIC" id="spouseFatherCNIC" class="form-control" placeholder="CNIC">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Mobile </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseFatherMobile" id="spouseFatherMobile" class="form-control" placeholder="Mobile">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="spouseFatherAddress" class="form-control"  rows="2"></textarea>
						</label>

						</td>
					</tr>
					<?php /* ?>
					<tr> <td><label for="input" class="control-label"> Marital Status </label></td>
						<td>


						<div class="inline-group">
						<label class="radio control-label">
						<input type="radio" name="father_maritalStatus" value="1" id="Married" checked="checked" />
						<i></i>Married </label>

						<label class="radio control-label">
						<input type="radio" name="father_maritalStatus" value="3" id="Divorce"  />
						<i></i>Divorce </label>

						<label class="radio">
						<input type="radio" name="father_maritalStatus" value="4" id="Widow"  />
						<i></i> Widow </label>


						<label class="radio">
						<input type="radio" name="father_maritalStatus" value="5" id="separation"  />
						<i></i> Separation </label>



						</div>


						</td>
					</tr>
					<?php */ ?>
				<?php } ?>



			</table>
		</td>
		<td width="50%">
		<table class="table">
			<?php if( !empty( $empSpouses ) ){ ?>

			<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseName" id="spouseName" class="form-control" value="<?=$empSpouses[1]->name;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Profession </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseprofession" id="spouseprofession" class="form-control" value="<?=$empSpouses[1]->profession;?>" />
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Qualification </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseQualification" id="spouseQualification" class="form-control" value="<?=$empSpouses[1]->qualification;?>" />
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Designation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseDesignation" id="spouseDesignation" class="form-control" value="<?=$empSpouses[1]->designation;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Organisation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseCompany" id="spouseCompany" class="form-control" value="<?=$empSpouses[1]->company;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Department </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseDepartment" id="spouseDepartment" class="form-control" value="<?=$empSpouses[1]->department;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> CNIC </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseCNIC" id="spouseCNIC" class="form-control" value="<?=$empSpouses[1]->nic;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Mobile </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseMobile" id="spouseMobile" class="form-control" value="<?=$empSpouses[1]->mobile_phone;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="spouseAddress" class="form-control" rows="2"><?=$empSpouses[1]->address;?></textarea>
						</label>

						</td>
					</tr>
					<?php /* ?>
					<tr> <td><label for="input" class="control-label"> Marital Status </label></td>
						<td>




						<div class="inline-group">


						<label class="radio control-label">
						<input type="radio" name="spouse_maritalStatus" value="1" id="spouse_maritalStatus" <?php if ($empSpouses[1]->marital_status == 1 ) : ?>checked="checked"<?php endif; ?> />
						<i></i>Married </label>

						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="3" id="Divorce" <?php if ($empSpouses[1]->marital_status == 3 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Divorce </label>

						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="4" id="Widow" <?php if ($empSpouses[1]->marital_status == 4 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Widow </label>

						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="5" id="Separated" <?php if ($empSpouses[1]->marital_status == 5 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Separated </label>

							<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="2" id="Single" <?php if ($empSpouses[1]->marital_status == 2 ) : ?>checked="checked"<?php endif; ?> />
						<i></i> Single </label>

						</div>



						</td>
					</tr>
					<?php */ ?>

			<?php }else{ ?>
			<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseName" id="spouseName" class="form-control" placeholder=" Name">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Profession </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseprofession" id="spouseprofession" class="form-control" placeholder=" Profession">
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Qualification </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseQualification" id="spouseQualification" class="form-control" placeholder="Qualification">
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Designation </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseDesignation" id="spouseDesignation" class="form-control" placeholder="Designation">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Company </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseCompany" id="spouseCompany" class="form-control" placeholder="Company">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Department </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseDepartment" id="spouseDepartment" class="form-control" placeholder="Department">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> CNIC </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseCNIC" id="spouseCNIC" class="form-control" placeholder="CNIC">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Mobile </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="spouseMobile" id="spouseMobile" class="form-control" placeholder="Mobile">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="spouseAddress" class="form-control" rows="2"></textarea>
						</label>
						</td>
					</tr>
					<?php /* ?>
					<tr> <td><label for="input" class="control-label"> Marital Status </label></td>
						<td>


						<div class="inline-group">
						<label class="radio control-label">
						<input type="radio" name="spouse_maritalStatus" value="1" id="married" checked="checked"  />
						<i></i>Married </label>

						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="2" id="single"  />
						<i></i> Single </label>
						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="3" id="Divorce" />
						<i></i> Divorce </label>

						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="4" id="Widow" />
						<i></i> Widow </label>

						<label class="radio">
						<input type="radio" name="spouse_maritalStatus" value="5" id="Separated" />
						<i></i> Separated </label>



						</div>


						</td>
					</tr>
					<?php */ ?>
			<?php } ?>




			</table>

		</td>
	</tr>
</table>


</fieldset>
</div>
</div>
<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>
</div> <!-- /end tab3 -->
<div class="tab-pane" id="childrenDetail">




<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header>	Children Details    </header>
  <div class="inner-spacer">
	<fieldset>



<!--fieldset>
	<div class="row">
	  <section class="col col-2">
	  <label class="label">GF-ID</label>
		<label class="input">
		  <input type="text" placeholder="GF-ID" name="gfID">
		</label>
    </section>
  </div>
</fieldset -->

	<div style="display:none;">

		<?php
		//echo "<pre>";
		//var_dump( $empChildren );
		//echo "</pre>";

			/*foreach( $empChildren  as $chld){
				echo $chld->official_name;
				echo "<br />";
			}*/
		?>
	</div>
<table class="table" id="childDetail">
	<thead>
		<th> Name </th>
		<th> Age </th>
		<th> School </th>
		<th> GS-ID </th>
		<th> University  </th>
		<th> Employer </th>
	</thead>
	<tbody>
	<?php



	if( !empty( $empChildren ) ) {

		foreach($empChildren as $child ): ?>

		<tr>
		<td width="25%">
			<label class="input">
			<input type="text" name="childrenDetailName[]" class="form-control" value="<?=$child->official_name;?>"   disabled />
			</label>
		</td>
		<td width="8%">
			<?php
			 $dob = $child->DOB;
			 $age = (date('Y') - date('Y',strtotime($dob)));

			 //$age = 8;
			?>

			<label class="input">
			<input type="text" name="childrenDetailAge[]" class="form-control" value="<?=$age;?>"   disabled />
			</label>
		</td>
		<td>
			<label class="input">
			<?php if($child->section_name != NULL ){ ?>
				<input type="text" name="childrenDetailSchool[]" class="form-control" value="<?=$child->grade_name;?>-<?=$child->section_name;?>"   disabled />
			<?php }else{ ?>
				<input type="text" name="childrenDetailSchool[]" class="form-control" value="Alumni"   disabled />
			<?php } ?>


			</label>
		</td>
		<td width="8%">
			<label class="input">
			<input type="text" name="childrenDetailGsID[]" class="form-control" value="<?=$child->gs_id;?>"   disabled />
			</label>
		</td>
		<td>
			<label class="input">
			<input type="text" name="childrenDetailUniversity[]" class="form-control" value=""   disabled />
			</label>
		</td>
		<td>
			<label class="input">
			<input type="text" name="childrenDetailEmployer[]" class="form-control" value=""  disabled />
			</label>
		</td>
		</tr>
			<?php endforeach; ?>
	<?php }else{ ?>

			<tr>
		<td colspan="5">No Record Found!



		</td>
		<!--td width="8%">

			<input type="text" name="childrenDetailAge[]" class="form-control" placeholder="Age" />

		</td>
		<td>

			<input type="text" name="childrenDetailSchool[]" class="form-control" placeholder="School" />

		</td>
		<td width="8%">

			<input type="text" name="childrenDetailGsID[]" class="form-control" placeholder="GS-ID" />

		</td>
		<td>

			<input type="text" name="childrenDetailUniversity[]" class="form-control" placeholder="University" />

		</td>
		<td>

			<input type="text" name="childrenDetailEmployer[]" class="form-control" placeholder="Employer" />

		</td -->
	</tr>
	<?php } ?>
	</tbody>
</table>

<!--table class="table">
	<tr>
		<td>
			<input type="button" id="btnAdd" onclick="AddChildDetail()" value="+ Add Another Detail"  class="btn btn-primary btn-sm" name="addAnotherDetail" />
		</td>
	</tr>
</table -->

<script type="text/javascript">
function AddChildDetail(){
	var rowChildDetails;
	rowChildDetails = '<tr><td width="25%">	<label class="input"> 			<input type="text" name="childrenDetailName[]" class="form-control" placeholder="Name" /> 			</label> 		</td> 		<td width="8%"> 			<label class="input"> 			<input type="text" name="childrenDetailAge[]" class="form-control" placeholder="Age" /> 			</label> 		</td> 		<td> 			<label class="input"> <input type="text" name="childrenDetailSchool[]" class="form-control" placeholder="School" /> </label> 		</td> 		<td width="8%"> 	<label class="input"> 			<input type="text" name="childrenDetailGsID[]" class="form-control" placeholder="GS-ID" /> 			</label> 		</td> 		<td> 			<label class="input"> 			<input type="text" name="childrenDetailUniversity[]" class="form-control" placeholder="University" /> </label> 		</td> 		<td> 			<label class="input"> 			<input type="text" name="childrenDetailEmployer[]" class="form-control" placeholder="Employer" /> 			</label> 	<a href="javascript:void(0);" class="remChildDetail" style="float: right;position: relative;top: -31px;">X</a> 	</td></tr>';

$('#childDetail').append( rowChildDetails );

$("#childDetail").on('click','.remChildDetail',function(){    $(this).parent().parent().remove();  });

}
</script>

</fieldset>
</div>
</div>
</div> <!-- /end tab3 -->



<div id="modalalternativeContact" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Alternative Contact updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalalternativeContact" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="tab-pane" id="alternativeContact">

<form id="staffalternativeContact" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />

<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header>	Alternative Contact     </header>
  <div class="inner-spacer">
	<fieldset>



<table class="table" style="width:98%">
	<thead>
	<tr>
		<th style="text-align:center"> Next of KIN </th>
		<th style="text-align:center"> Emergency Contact </th>
	</tr>
	</thead>

	<tr>
		<td width="50%">
		<?php if( !empty( $getEmpAlterContKIN ) ){ ?>

				<table class="table">
					<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinName" id="kinName" class="form-control" value="<?=$getEmpAlterContKIN[0]->name;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="kinAddress" class="form-control"  rows="2"><?=$getEmpAlterContKIN[0]->address;?></textarea>
							</label>

						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Email </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinEmail" id="kinEmail" class="form-control" value="<?=$getEmpAlterContKIN[0]->email;?>" />
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Phone </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinPhone" id="kinPhone" class="form-control" value="<?=$getEmpAlterContKIN[0]->phone;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Relationship </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinRelationship" id="kinRelationship" class="form-control" value="<?=$getEmpAlterContKIN[0]->relationships;?>" />
							</label>
						</td>
					</tr>

			</table>
		<?php }else{ ?>


				<table class="table">

					<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinName" id="kinName" class="form-control" placeholder="Name">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="kinAddress" class="form-control"  rows="2"></textarea>
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Email </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinEmail" id="kinEmail" class="form-control" placeholder="Email">
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Phone </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinPhone" id="kinPhone" class="form-control" placeholder="Phone">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Relationship </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="kinRelationship" id="kinRelationship" class="form-control" placeholder="Relationship">
							</label>
						</td>
					</tr>

			</table>
		<?php } 	?>

		</td>
		<td width="50%">
			<?php if( !empty( $getEmpAlterContEmergn ) ){ ?>
				<table class="table">
					<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactName" id="emergencyContactName" class="form-control" value="<?=$getEmpAlterContEmergn[0]->name;?>" />
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="emergencyContactAddress" class="form-control" rows="2"><?=$getEmpAlterContEmergn[0]->address;?></textarea>
							</label>

						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Email </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactEmail" id="emergencyContactEmail" class="form-control" value="<?=$getEmpAlterContEmergn[0]->email;?>" />
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Phone </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactPhone" id="emergencyContactPhone" class="form-control" value="<?=$getEmpAlterContEmergn[0]->phone;?>" />
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Relationship </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactRelationship" id="emergencyContactRelationship" class="form-control" value="<?=$getEmpAlterContEmergn[0]->relationships;?>" />
							</label>
						</td>
					</tr>

			</table>
			<?php }else{ ?>
				<table class="table">
					<tr> <td><label for="input" class="control-label"> Name </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactName" id="emergencyContactName" class="form-control" placeholder="Name">
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Address </label></td>
						<td>
						<label class="textarea">
							<textarea name="emergencyContactAddress" class="form-control"  rows="2"></textarea>
							</label>
						</td>
					</tr>

					<tr> <td><label for="input" class="control-label"> Email </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactEmail" id="emergencyContactEmail" class="form-control" placeholder="Email">
							</label>
						</td>
					</tr>


					<tr> <td><label for="input" class="control-label"> Phone </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactPhone" id="emergencyContactPhone" class="form-control" placeholder="Phone">
							</label>
						</td>
					</tr>
					<tr> <td><label for="input" class="control-label"> Relationship </label></td>
						<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
							<input type="text" name="emergencyContactRelationship" id="emergencyContactRelationship" class="form-control" placeholder="Relationship">
							</label>
						</td>
					</tr>

			</table>
			<?php } ?>
		</td>
	</tr>
</table>
</fieldset>
</div>
</div>

<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>

</div> <!-- /end tab3 -->



<div id="modalbankDetail" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Bank Details Edited Sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalbankDetail" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="tab-pane" id="bankDetail">

<form id="staffbankDetail" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />


<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header> Bank Details </header>
  <div class="inner-spacer">
	<fieldset>




<fieldset>
	<table class="table" style="width:40%">
	<?php if( !empty( $employeBank ) ) { ?>
		<tr> <td><label for="input" class="control-label"> Bank Name </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="bankName" id="bankName" class="form-control"  value="Meezan Bank Ltd." disabled="" />
<?php /* ?>
				<input type="text" name="bankName" id="bankName" class="form-control"  value="<?=$employeBank[0]->bank_name;?>" />
<?php */ ?>
				</label>
			</td>
		</tr>

		<tr>
		<td><label for="input" class="control-label"> Branch Name </label></td>
			<td>
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="branchName" id="branchName" class="form-control"  value="<?=$employeBank[0]->branch;?>" />
				</label>
			</td>
		</tr>
		<!-- Branch Code -->
		<?php /* ?>
		<tr> <td><label for="input" class="control-label"> Branch Code  </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="branchCode" id="branchCode" class="form-control" value="<?=$employeBank[0]->branch_code;?>" />
				</label>
			</td>
		</tr>
		<?php */ ?>
		<!-- Branch Code End -->

		<tr> <td><label for="input" class="control-label"> Account Number  </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="accountNumber" id="accountNumber" class="form-control" value="<?=$employeBank[0]->account_number;?>" />
				</label>
			</td>
		</tr>

	<?php }else{ ?>
		<tr> <td><label for="input" class="control-label"> Bank Name </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<?php /* ?>
				<input type="text" name="bankName" id="bankName" class="form-control" placeholder="Bank Name">
				<?php */ ?>
				<input type="text" name="bankName" id="bankName" class="form-control" placeholder="Bank Name" value="Meezan Bank Ltd." disabled="">
				</label>
			</td>
		</tr>

		<tr>
		<td><label for="input" class="control-label"> Branch Name </label></td>
			<td>
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="branchName" id="branchName" class="form-control"  value="" placeholder="Branch Name" />
				</label>
			</td>
		</tr>
		<!-- Branch Code -->
		<?php /* ?>
		<tr>
		<td>
		<label for="input" class="control-label"> Branch Code  </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="branchCode" id="branchCode" class="form-control" placeholder="Branch Code">
				</label>
			</td>
		</tr>
		<?php */ ?>
		<!-- Branch Code End -->

		<tr> <td><label for="input" class="control-label"> Account Number  </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="accountNumber" id="accountNumber" class="form-control" placeholder="Account Number">
				</label>
			</td>
		</tr>
	<?php } ?>


			</table>


	</fieldset>
</fieldset>
</div>
</div>
<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>
</div> <!-- /end tab3 -->




<div id="modalotherDetail" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee Other information updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalotherDetail" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="tab-pane" id="otherDetail">

<form id="staffotherDetail" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />

<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header>Other Details</header>
  <div class="inner-spacer">
	<fieldset>



	<table class="table" style="width:40%">
		<tr> <td><label for="input" class="control-label"> EOBI Number </label></td>
			<td><label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="eobiNumber" id="eobiNumber" placeholder="EOBI Number" class="form-control" value="<?=$employer->eobi_no;?>" />
				</label>
			</td>
		</tr>

		<tr>
		<td><label for="input" class="control-label"> SESSI Number </label></td>
			<td>
				<label class="input"> <i class="icon-append fa fa-asterisk"></i>
				<input type="text" name="sessiNumber" id="sessiNumber" class="form-control" placeholder="SESSI Number" value="<?=$employer->sessi_no;?>" />
				</label>
			</td>
		</tr>
	</table>


	</fieldset>
	</div>
</div>

<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>

</div> <!-- /end otherDetails -->


<div id="modalprovidentFund" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee Provident Fund updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalprovidentFund" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="tab-pane" id="providentFund">

<form id="staffProvidentFund" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />


<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header>	Provident Fund   </header>
  <div class="inner-spacer">
	<fieldset>



<table class="table" style="width:30%">
	<thead>
		<th colspan="2"> Provident Fund  </th>
	</thead>
	<tr>
	<?php if( !empty( $employeSupporting ) ){ ?>

			<td>
		<label for="radios-inline-0" class="radio-inline">
	  <input type="radio" value="1" id="radios-inline-0" name="providentFund" <?php if ($employeSupporting[0]->providentFund == 1 ) : ?>checked="checked"<?php endif; ?> />
	  YES </label></td>
		<td>
		<label for="radios-inline-1" class="radio-inline">
	  <input type="radio" value="0" id="radios-inline-1" name="providentFund" <?php if ($employeSupporting[0]->providentFund == 0 ) : ?>checked="checked"<?php endif; ?> />
	  NO </label> </td>

	<?php }else{ ?>
			<td>
		<label for="radios-inline-0" class="radio-inline">
	  <input type="radio" value="1" id="radios-inline-0" name="providentFund" checked="checked" />
	  YES </label></td>
		<td>
		<label for="radios-inline-1" class="radio-inline">
	  <input type="radio" value="0" id="radios-inline-1" name="providentFund"  />
	  NO </label> </td>

	<?php } ?>

	</tr>
</table>
</fieldset>
 </div>
</div>
	<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>
</div> <!-- /end providentFund -->




<div id="modalntn" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee National Tax Number updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalntn" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<div class="tab-pane" id="ntn">

<form id="staffntn" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />

<div class="powerwidget dark-red" data-widget-editbutton="false">
 <header>	 National Tax Number    </header>
  <div class="inner-spacer">
	<fieldset>



<table class="table table-borderless" style="width:30%">
	<tr>
		<td>
			<label class="input"> <i class="icon-append fa fa-asterisk"></i>

			<?php if( !empty( $employeSupporting[0]->nationalTaxNumber ) ) { ?>

			<input type="text" name="ntnNumber" id="ntnNumber" class="form-control" value="<?=$employeSupporting[0]->nationalTaxNumber;?>" />
			<?php }else{ ?>
			<input type="text" name="ntnNumber" id="ntnNumber" class="form-control" placeholder="Enter your National Tax Number"  />
			<?php } ?>


			</label>

	  </td>

	</tr>
</table>

</fieldset>
			</div>
			</div>
	<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>
</div> <!-- /end tab3 -->




<div id="modalTakaful" class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
        <!--i class="fa fa-lock"></i -->
		</div>
		  <div class="modal-body text-center">
			<p>  <strong> Thank you! </strong> Employee Basic Information updated sucessfully. </p>
		  </div>
      <div class="modal-footer">
        <!--button id="trigger-deletewidget-reset" data-dismiss="modal" class="btn btn-default" type="button">Cancel</button -->
        <button id="trigger-modalTakaful" data-dismiss="modal"  class="btn btn-primary" type="button"> Close </button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<div class="tab-pane" id="takaful">

<form id="stafftakaful" class="orb-form" method="POST" enctype="multipart/form-data">
<input type="hidden" name="staffID" value="<?=$employer->id;?>" />

<div class="powerwidget dark-red" data-widget-editbutton="false">

 <header>Takaful</header>
  <div class="inner-spacer">
	<fieldset>

<?php

if( !empty ( $employeTakaful ) ){ ?>
<div class="col-sm-8">
<fieldset>
	<label class="checkbox">
	<input type="checkbox" id="takafulSelf" name="takafulSelf" value="1" <?php if ($employeTakaful[0]->self == 1 ) : ?>checked="checked"<?php endif; ?> />
	<i></i> Self </label>

	<label class="checkbox">
	<input type="checkbox" id="takafulSpouse" name="takafulSpouse" value="1" <?php if ($employeTakaful[0]->spouse == 1 ) : ?>checked="checked"<?php endif; ?> />
	<i></i> Spouse </label>

	<label class="checkbox">
	<input type="checkbox" id="takafulChildern" name="takafulChildern" value="1" <?php if ($employeTakaful[0]->children == 1 ) : ?>checked="checked"<?php endif; ?> />
	<i></i> Children  </label>
	</section>
</fieldset>
<table class="table">
<tr>
<td><label for="input" class="control-label"> Certificate No. </label></td>
<td>
	<label class="input">
	<input type="text" name="certificateNumber" id="certificateNumber" class="form-control" value="<?=$employeTakaful[0]->certificate_no;?>" />
	</label>
</td>
</tr>
<tr>
<td colspan="2"><label for="input" class="control-label">  If no, please mention the reasons (mandatory) </label></td>
</tr>
<tr>
<td colspan="2"> <textarea name="takafulReasonForNo" class="form-control" rows="3"><?=$employeTakaful[0]->reasons;?></textarea> </td>
</tr>
</table>
</div>

<?php }else{ ?>

<div class="col-sm-8">
<fieldset>
	<label class="checkbox">
	<input type="checkbox" id="takafulSelf" name="takafulSelf" value="1" />
	<i></i> Self </label>

	<label class="checkbox">
	<input type="checkbox" id="takafulSpouse" name="takafulSpouse" value="1" />
	<i></i> Spouse </label>

	<label class="checkbox">
	<input type="checkbox" id="takafulChildern" name="takafulChildern" value="1" />
	<i></i> Children  </label>
	</section>
</fieldset>
<table class="table">
<tr>
<td><label for="input" class="control-label"> Certificate No. </label></td>
<td>
	<label class="input">
	<input type="text" name="certificateNumber" id="certificateNumber" class="form-control" placeholder="Certificate Number">
	</label>
</td>
</tr>
<tr>
<td colspan="2"><label for="input" class="control-label">  If no, please mention the reasons (mendatory) </label></td>
</tr>
<tr>
<td colspan="2"> <textarea name="takafulReasonForNo" class="form-control" rows="3"></textarea> </td>
</tr>
</table>
</div>

<?php } ?>





</fieldset>
	</div>
 </div>
<input type="submit" name="submit" value="Save and continue" id="submit" class="btn btn-primary btn-sm" />
</form>



</div> <!-- /end tab3 -->

















 </div>


 </div>
 </div>

  </div>

  <!--/div -->
