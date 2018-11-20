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
<header> Org Chart </header>
<div class="row">
<fieldset>

	<section class="col col-6">
		<label class="label"> Postion Title </label>
		<label class="input">
			<input type="text" name="positionTitle" id="positionTitle" />
			
		</label>
	</section>
	
<?php if(!empty( $domains )){ ?>
<section class="col col-3">
	<label class="label">Domain</label>
	<label class="select">
	<select name="domain" id="domain">
		<option value="">Choose name</option>
		<?php foreach( $domains as $domain ){ ?>
			<option value="<?=$domain["id"];?>_<?=$domain["code"];?>"><?=ucfirst($domain["dname"]);?> </option>
		<?php } ?>
		
	</select>
	<i></i>
	</label>
</section>
<?php } ?>
<?php if(!empty( $roleTypes )){ ?>
	<section class="col col-3">
		<label class="label">Type</label>
		<label class="select">
			<select name="roletype" id="roletype">
				<option value="">Choose name</option>
				<?php foreach( $roleTypes as $typ ){ ?>
					<option value="<?=$typ["id"];?>_<?=$typ["code"];?>"><?=ucfirst($typ["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
<?php } ?>	


	
</fieldset>
<fieldset>
<?php if(!empty( $categories )){ ?>
	<section class="col col-6">
		<label class="label">Category</label>
		<label class="select">
			<select name="category" id="category">
				<option value="">Choose name</option>
				<?php foreach( $categories as $cat ){ ?>
					<option value="<?=$cat["id"];?>_<?=$cat["code"];?>"><?=ucfirst($cat["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } ?>	
	<?php if(!empty( $wings )){ ?>
	<section class="col col-6">
		<label class="label">Wing</label>
		<label class="select">
			<select name="wing" id="wing">
				<option value="">Choose name</option>
				<option value="1000">All</option>
				<?php foreach( $wings as $wng ){ ?>
					<option value="<?=$wng["id"];?>"> <?=ucfirst($wng["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } ?>
	</fieldset>
	<fieldset>
	<?php if(!empty( $grades )){ ?>
	<section class="col col-6">
		<label class="label">Grade</label>
		<label class="select">
			<select name="grade" id="grade">
				<option value="">Choose name</option>
				<option value="1000">All</option>
				<?php foreach( $grades as $grd ){ ?>
					<option value="<?=$grd["id"];?>"> <?=ucfirst($grd["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } ?>
	<?php if(!empty( $sections )){ ?>
	<section class="col col-6">
		<label class="label">Section</label>
		<label class="select">
			<select name="section" id="section">
				<option value="">Choose name</option>
				<option value="1000">All</option>
				<?php foreach( $sections as $sec ){ ?>
					<option value="<?=$sec["id"];?>"> <?=ucfirst($sec["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } ?>
	</fieldset>
	<fieldset>
	<?php if(!empty( $subjects )){ ?>
	<section class="col col-6">
		<label class="label">Subject</label>
		<label class="select">
			<select name="subject" id="subject">
				<option value="">Choose name</option>
				<option value="1000">All</option>
			<?php foreach( $subjects as $s ){ ?>
					<option value="<?=$s["id"];?>"> <?=ucfirst($s["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } ?>

<?php if(!empty( $academic )){ ?>
	<section class="col col-6">
		<label class="label">Academic</label>
		<label class="select">
			<select name="academic" id="academic">
				<option value="">Choose</option>
			<?php foreach( $academic as $ac ){ ?>
					<option value="<?=$ac["acID"];?>"> <?=ucfirst($ac["dname"]);?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } ?>
	
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
	</style>
	<?php  /*if(!empty( $staff )){ ?>
	<section class="col col-2">
		<label class="label">Staff</label>
		<label class="select">
			<select name="staffID" id="staffID" style="width: 100%;height:100%;">
				<option value="0">Choose name</option>
			<?php foreach( $staff as $stfId ){ ?>
					<option value="<?=$stfId["StaffID"];?>"> <?=ucfirst( $stfId["aname"] );?> </option>
				<?php } ?>
			</select>
			<i></i>
		</label>
	</section>
	<?php } */ ?>
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
	<div class="dark-red powerwidget" id="datatable-basic-init" data-widget-editbutton="false">
	
		<header><h2> Position <small> List of position </small></h2></header>
		<div class="inner-spacer">
			
			
			<table class="table table-striped table-hover" id="positions">
			 <thead>
				<tr>
					
					<th>Postion Title</th>
					<th>Domain</th>
					<th>Type</th>
					<th>Category</th>
					<th>Wing </th>
					<th>Grade</th>
					<th>Section</th>
					<th>Subject</th>
				</tr>
				 </thead>
				    <tbody>
				<?php foreach( $joiningResults as $res ):  ?>
				<?php //for($acounter =1; $acounter < 20; $acounter++  ) { ?>
				<tr>
					<input type="hidden" name="positionID[]" value="<?=$res["pID"];?>" />
					<td><?=$res["title"];?></td>
					<td><?=$res["domainName"];?></td>
					<td><?=$res["typeName"];?></td>
					<td><?=$res["catName"];?></td>
					<td><?=$res["wingName"];?></td>
					<td><?=$res["grdName"];?></td>
					<td><?=$res["secName"];?></td>
					<td><?=$res["subName"];?></td>
				</tr>
				<?php // } ?>
				<?php endforeach; ?>
				   </tbody>
			</table>
			
		
	</div>
	</div>
</div>
</div>