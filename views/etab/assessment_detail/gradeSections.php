<div class="orb-form">
<fieldset>
<div class="row">
<section class="col col-10">
<h4>Sections</h4>
<ul class="nav nav-tabs">
<?php 
$active = true;
foreach($sections AS $key => $value ){ ?>
<?php if($active){ ?> 
<li class="active"><a href="#<?=$value;?>-normal" data-toggle="tab"> <?=$value;?> </a></li>
<?php }else{ ?>
<li><a href="#<?=$value;?>-normal" data-toggle="tab"> <?=$value;?> </a></li>	
<?php } $active=false; ?>
<?php } ?>
</ul>

<div class="tab-content">

<?php 
$active = true;
$loopCounter = 0;
foreach($sections AS $key => $value ){ ?>

<?php if($active){ ?> 
  <div class="tab-pane active" id="<?=$value;?>-normal">
  <h6>Section <?=$value;?></h6>
<form action="" class="orb-form">
<input type="hidden" name="section[]" value="<?=$value;?>" />
<input type="hidden" name="subject_teacher[]" value="<?=$subject_teacher[$loopCounter];?>" />
<fieldset>
  <section class="col col-6">
  <label class="label"> Assessment Title</label>
  <label class="input"> <i class="icon-append fa fa-asterisk"></i>
	<input type="text" name="title[]">
  </label>
</section>

<section class="col col-3">
  <label class="label">Start date</label>
  <label class="input"> <i class="icon-append fa fa-calendar"></i>
	<input type="text" name="date[]" class="date" >
  </label>
</section>

  <section class="col col-3">
  <label class="label"> Marks</label>
  <label class="input"> <i class="icon-append fa fa-asterisk"></i>
	<input type="text" name="mixMarks[]">
  </label>
</section>
</fieldset>

<!--fieldset>
<section class="col col-6">
  <label class="label">Min Marks</label>
  <label class="input"> <i class="icon-append fa fa-asterisk"></i>
	<input type="text" name="minMarks[]">
  </label>
</section>
</fieldset -->

<fieldset>
<section>
  <label class="textarea"> <i class="icon-append fa fa-question"></i>
	<textarea placeholder="Comments" rows="3" name="description[]"></textarea>
	<b class="tooltip tooltip-top-right"> Description </b> </label>
</section>
</fieldset>
<footer>
<div class="pull-right">
<button type="submit" class="btn btn-default" name="singleSave[]">Save</button>
<button type="submit" class="btn btn-default" name="allSave[]">Save For All Sections</button>
</div>
</footer>
</form>

  </div>				  

<?php }else{ ?>

  <div class="tab-pane" id="<?=$value;?>-normal">
  <h6>Section <?=$value;?></h6>
<form action="" class="orb-form">
<input type="hidden" name="section[]" value="<?=$value;?>" />
<input type="hidden" name="subject_teacher[]" value="<?=$subject_teacher[$loopCounter];?>" />
<fieldset>
  <section class="col col-6">
  <label class="label"> Assessment Title</label>
  <label class="input"> <i class="icon-append fa fa-asterisk"></i>
	<input type="text" name="title[]">
  </label>
</section>

<section class="col col-3">
  <label class="label">Start date</label>
  <label class="input"> <i class="icon-append fa fa-calendar"></i>
	<input type="text" name="date[]" class="date">
  </label>
</section>

  <section class="col col-3">
  <label class="label"> Marks</label>
  <label class="input"> <i class="icon-append fa fa-asterisk"></i>
	<input type="text" name="mixMarks[]">
  </label>
</section>
</fieldset>

<!--fieldset>
<section class="col col-6">
  <label class="label">Min Marks</label>
  <label class="input"> <i class="icon-append fa fa-asterisk"></i>
	<input type="text" name="minMarks[]">
  </label>
</section>
</fieldset -->

<fieldset>
<section>
  <label class="textarea"> <i class="icon-append fa fa-question"></i>
	<textarea placeholder="Comments" rows="3" name="description[]"></textarea>
	<b class="tooltip tooltip-top-right"> Description </b> </label>
</section>
</fieldset>
<footer>
<div class="pull-right">
<button type="submit" class="btn btn-default" name="singleSave[]" value="singleSave">Save</button>
<button type="submit" class="btn btn-default" name="allSave[]" value="allSave" > Save For All Sections</button>
</div>
</footer>
</form>

  </div>				  
<?php } $active=false; ?>
<?php $loopCounter++; } ?>


  </div>
                    
<!-- /tabs --> 
	
</section>

</div>
</fieldset>
<!--fieldset>
<div class="row">
<section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-calendar"></i>
		<input type="text" placeholder="Start date" id="start" name="start" class="hasDatepicker">
	</label>
</section>
<section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-calendar"></i>
	<input type="text" placeholder="Expected finish date" id="finish" name="finish" class="hasDatepicker">
	</label>
</section>
</div>
</fieldset -->
</div>
<script>
	
       if ($('.date').length) {
			$('.date').datepicker({
                dateFormat: 'dd.mm.yy',
                prevText: '<i class="fa fa-chevron-left"></i>',
                nextText: '<i class="fa fa-chevron-right"></i>'
			});
		}
</script>

