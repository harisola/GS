<div class="MaroonBorderBox">
<h3>Communication <?php echo $student_name; ?> <button id="hidr" style="pull-right">Hide</button> </h3>
<div class="inner" style="padding-bottom:0;">

<div class="TimelineReview">

<ul>
<?php 
$in_out = "in";

	if( !empty( $formHistory ) ){
		foreach( $formHistory as $fh ){
			
			if( $fh["type"] == 'Issuance' || $fh["type"] == 'Stage' || $fh["type"] == 'Status' ){ ?>
				<li class="adminResponse">
					<p><?=$fh["message"];?> <?php //$fh["change_date"];?></p>
				</li><!-- adminResponse -->
			<?php }
			
			 else{
					if( $in_out == 'in' ){ $in_out = "out"; }else{ $in_out = "in"; }  ?>
					<li class="<?=$in_out;?>">
					<div class="avatarLeft col-md-2">
					
					<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" />
					</div><!-- avatarLeft -->
					
					<div class="systemResponse col-md-10">
					<span class="arrowHeadLeft">&nbsp;</span>
					
						<p>
						
						<?php if( $fh["reason"] != '' ){
							$reason = explode("on", $fh["reason"] );
						?>
							<strong> <?=$fh["reason"];?> </strong>
						<?php }?>
						
						
						<br /><small> <?php echo $fh["message"]; ?></small>
						</p>
					<span class="commentDate"><?=$fh["change_date"];?></span><!-- commentDate -->
					</div><!-- systemResponse -->
					</li><!-- in -->
					
			<?php }// end type
			
		}// End Foreach
	}
	?>



</ul>
</div><!-- Timeline -->


<div class="TimelineAddForm">
<form action="<?=base_url();?>index.php/gs_admission/frontoffice_communication/add_comments" method="POST" name="form_followup" id="form_followup" class="issuance">

<input type="hidden" name="form_stage" id="form_stage" value="communication" />
<input type="hidden" name="form_id" id="form_id" value="<?=$form_id;?>" />
<input type="hidden" name="given_slot_id" id="given_slot_id" value="<?=$give_slot_id;?>" />
<input type="hidden" name="form_batch_id" id="form_batch_id" value="<?=$form_batch_id;?>" />
<?php $currentStage='Communication';?>
<input type="hidden" name="currentStage" id="currentStage" value="<?=$currentStage;?>" />



<div class="row">
<div class="col-md-4">
<select id="FOStatus" name="FOStatus">
<option value="">Status *</option>
<!--option value="Ext">Extension</option-->
<option value="NI">Not Interested</option>
<option value="CMM">Communicated</option>
<option value="NR">No Response</option>
</select>
</div><!-- col-md-4 -->
<?php //var_dump($batch); ?>
<div class="col-md-4 displayNone IfExt">

<select id="batch_id" name="batch_id">
<option value="">Batch *</option>
<?php if(!empty($batch)){
	foreach( $batch as $b ){
	$id = $b["formBatchID"];
		$cat_name = $b["batchCategory"];
		$BDate = $b["BDate"];
	?>
	<option value="<?=$id;?>" <?php if( $id == $form_batch_id){ echo "selected"; } ?>> <?=$cat_name;?> (<?=$BDate;?>)</option>	
	<?php } 
	} ?>


</select>
</div><!-- col-md-4 -->
<div class="col-md-4 displayNone IfExt">
<select id="time_slot" name="time_slot">
<option value="">Time Slot *</option>
</select>
</div><!-- col-md-4 -->

<div class="col-md-12 paddingTop20">
<textarea placeholder="Comments" rows="4" cols="50" name="comments" id="comments"></textarea>
</div><!-- col-md-12 -->
<div class="col-md-3 paddingTop20">
<input type="submit" class="greenBTN" value="Submit" id="addFollowUp" />

<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
</div>
</div><!-- col-md-12 -->
</div><!-- row -->
</form>
</div><!-- TimelineAddForm -->
</div><!-- inner -->
</div><!-- .MaroonBorderBox -->
       
    