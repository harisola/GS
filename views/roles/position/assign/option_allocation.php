<style>
.content-wrapper{
	min-height: 0px;
}
</style>
<div class="col-md-12"> 

<div class="col-md-6"> 
<div class="dark-red powerwidget">
<header><h2> Position <small> Org Position </small></h2></header>

<div class="tab-content">
<!-- Success Forms -->
<div id="home-1" class="tab-pane fade in active">

<form class="orb-form" id="positiontForm">
<header> Assign Position To Employee </header>
<div class="row">
<fieldset>

<div class="alert alert-success alert-dismissable" id="assigned_success" style="display:none">
<button aria-hidden="true" data-dismiss="alert" class="close" type="button"><i class="fa fa-times-circle"></i></button>
<strong> Success! </strong> Position assign to employee.
 </div>

<?php  if(!empty( $staff )){ ?>
<section class="col col-6">
	<label class="label">Staff</label>
	  <label class="select">
		<select name="staffID" id="staffID" style="width: 100%;height:100%;">
		  <option value="0">Choose name</option>
		<?php foreach( $staff as $stfId ){ ?>
			<option value="<?=$stfId["StaffID"];?>"> <?=$stfId["nCode"];?> - <?=ucfirst( $stfId["aname"] );?> </option>
			<?php } ?>
		</select>
		<i></i>
	</label>
</section>
<?php } ?>
	
<?php if(!empty( $positions )){ ?>
<section class="col col-6">
	<label class="label">Position Name</label>
	<label class="select">
		<select name="position" id="position" style="width: 100%;height:100%;">
			<option value="">Choose name</option>
			<?php foreach( $positions as $cat ){ ?>
				<option value="<?=$cat["id"];?>"><?=ucfirst($cat["title"]);?> </option>
			<?php } ?>
		</select>
		<i></i>
	</label>
</section>
<?php } ?>
</fieldset>	
<fieldset>
<?php if(!empty( $positions )){ ?>
<section class="col col-6">
	<label class="label">Primary Reporting</label>
	<label class="select">
		<select name="primary" id="primary" style="width: 100%;height:100%;">
			<option value="">Choose</option>
			<?php foreach( $positions as $cat ){ ?>
				<option value="<?=$cat["id"];?>"><?=ucfirst($cat["title"]);?> </option>
			<?php } ?>
		</select>
		<i></i>
	</label>
</section>
<?php } ?>	
	
<?php if(!empty( $positions )){ ?>
<section class="col col-6">
	<label class="label">Secondary Reporting</label>
	<label class="select">
		<select name="secondary" id="secondary" style="width: 100%;height:100%;">
			<option value="">Choose</option>
			<?php foreach( $positions as $cat ){ ?>
			<option value="<?=$cat["id"];?>"><?=ucfirst($cat["title"]);?> </option>
			<?php } ?>
		</select>
	<i></i>
	</label>
</section>


<?php } ?>	
</fieldset>
<fieldset>
<section class="col col-12">
<!-- Multiple Radios (inline) -->
<div class="form-group">
 
  <label class="label">Secondary Reporting Type: </label>
 
	<label class="radio-inline" for="radios-inline-0">
	  <input name="reportingType" id="radios-inline-0" value="0" checked="checked" type="radio">
	  Opaque </label>
	<label class="radio-inline" for="radios-inline-1">
	  <input name="reportingType" id="radios-inline-1" value="1" type="radio">
	  Transparent </label>
   
</div>
</section>
</fieldset>
<style>
.select2-container .select2-choice{
	height: 36px;
	line-height: 39px;
}
.select2-container .select2-choice .select2-arrow {
	background: #cccccc none repeat scroll 0 0;
    border-left: 1px solid #aaaaaa;
    border-radius: 0 4px 4px 0;
    display: inline-block;
    height: 100%;
    position: relative;
    right: none;
    top: none;
    width: 100%;
}

#ajaxloader
{
	position: absolute;
	width: 30px;
	height: 30px;
	border: 8px solid #fff;
	border-right-color: transparent;
	border-radius: 50%;
	box-shadow: 0 0 25px 2px #eee;
}

@keyframes spin
{
	from { transform: rotate(0deg);   opacity: 0.2; }
	50%  { transform: rotate(180deg); opacity: 1.0; }
	to   { transform: rotate(360deg); opacity: 0.2; }
}
</style>
</div>
<footer>
	<button class="btn-u btn-u-default" type="submit">Submit</button>
</footer>
</form>
<!--/ Success states for elements -->
</div>
<!-- End Success Forms -->
</div>
</div>
</div>
<!-- // joiningResults End left side form //   -->
<!-- // start right side list // -->
<div class="col-md-6">
<div id="reload_positions">
	<div class="dark-red powerwidget" id="datatable-basic-init" data-widget-editbutton="false">
	  <header><h2> Position <small> List of position </small></h2></header>
		<div class="inner-spacer">
		<div id="loadingAjax" style="display:none;">
			<section>
                <!--img src="<?php base_url()?>components/image/loading-small.gif" / -->
				<img src="<?php echo base_url()?>components/image/facebook.gif" />
				</section>
			</div>
			
			<table class="table table-striped table-hover" id="positions">
			 <thead>
				<tr>
					<th>Staff  </th>
					<th>Postion Title</th>
					<th>Primary Reporing to</th>
					<th>Secondary Reporting to</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach( $results as $res ):  ?>
				<tr>
					<td>
					<?php if( $res["staffCode"] == '' ){ ?>
					Not Assigned!
					<?php }else{ ?>
					<?=$res["staffCode"];?>-<?=$res["staffName"];?>	
					<?php } ?>
					
					</td>
					<td><?=$res["title"];?></td>
					<td><?=$res["PrimaryR"];?></td>
					<td><?=$res["SecondaryR"];?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		   </table>
			
		
	</div>
	</div>

	</div>
</div>

<!--
<div class="col-md-12" id="firstDiv">
<div class="dark-red powerwidget">
<header><h2> Position <small> Org Position </small></h2></header>
 <div class="inner-spacer">
                <table class="table table-striped table-hover margin-0px" id="stdList">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Nickname</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    <tr id="std_1">
                      <td>Lady</td>
                      <td>Gaga</td>
                      <td>@LadyGaga</td>
                      <td><span class="label label-default">Suspended</span></td>
                    </tr>
                    <tr id="std_2">
                      <td>Fat</td>
                      <td>Cat</td>
                      <td>@FatCat</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr id="std_3">
                      <td>Stacey</td>
                      <td>Malibu</td>
                      <td>@StaceyMalibu</td>
                      <td><span class="label label-danger">Banned</span></td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
           
		 
		 
		 

</div>
</div>
<div class="col-md-6" id="secondDiv">
<div class="dark-red powerwidget">
<header><h2> Position <small> Org Position </small></h2></header>



	  
              <div class="inner-spacer">
                <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Nickname</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Calvin</td>
                      <td>Klein</td>
                      <td>@CalvinKlein</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                    <tr>
                      <td>Victor</td>
                      <td>Durant</td>
                      <td>@VictorDurant</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                   
                    <tr>
                      <td>Adam</td>
                      <td>Sandler</td>
                      <td>@AdamSandler</td>
                      <td><span class="label label-success">Active</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
           
		 
		 
		 

</div>
</div>
-->
</div>