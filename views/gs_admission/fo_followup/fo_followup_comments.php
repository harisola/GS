<style type="text/css">
.TimelineReview li {
    display: block;
    float: left;
    width: 100%;
}
</style>
<div class="MaroonBorderBox">
<h3> <?php echo $student_name; ?> <button id="hidr" style="pull-right">Hide</button> </h3>
<div class="inner" style="padding-bottom:0;">

<div class="TimelineReview">
<ul>

<?php 
$in_out = "out";
	if( !empty( $formHistory ) ){
		foreach( $formHistory as $fh ){ ?>
		<?php if( $fh["user_id"] == 1 ) : ?>

			<li class="adminResponse">
				<strong><?=$fh["reason"];?></strong><br />
				<p><?php echo $fh["message"]; ?> </p>
			</li>
		<?php elseif( $fh["user_id"] == $this->session->userdata("user_id")) : ?>	
			<li class="out">
				<div class="systemResponse col-md-10">
					<p>
						<strong><?=$fh["staff_name"];?></strong><br />
						<p><?php echo $fh["message"]; ?></p>
						<p><?php echo $fh["Additional_Comments"]; ?></p>

					</p>
					<span class="commentDate"><?=$fh["change_date"];?></span><!-- commentDate -->
					<span class="arrowHeadRight">&nbsp;</span>
				</div><!-- systemResponse -->
				<div class="avatarLeft col-md-2">		
					<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" />
				</div><!-- avatarLeft -->
			</li><!-- out -->
		<?php else : ?>
			<li class="in">
				<div class="avatarLeft col-md-2">		
					<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" />
				</div><!-- avatarLeft -->
				<div class="systemResponse col-md-10">
					<span class="arrowHeadLeft">&nbsp;</span>
					<p>
						<strong><?=$fh["staff_name"];?></strong><br />
						<p><?php echo $fh["message"]; ?></p><br />
						<p><?php echo $fh["Additional_Comments"]; ?></p>
					</p>
					<span class="commentDate"><?=$fh["change_date"];?></span><!-- commentDate -->
				</div><!-- systemResponse -->
			</li><!-- in -->
			<?php endif; ?>	
		<?php } ?>
	<?php } ?>
</ul>
</div><!-- Timeline -->

<div class="TimelineAddForm">
<form action="<?=base_url();?>index.php/gs_admission/frontoffice_communication/add_comments" method="POST" name="form_followup" id="form_followup" class="issuance">
<input type="hidden" name="form_stage" id="form_stage" value="communication" />
<input type="hidden" name="form_id" id="form_id" value="<?=$form_id;?>" />
<input type="hidden" name="given_slot_id" id="given_slot_id" value="<?=$give_slot_id;?>" />
<input type="hidden" name="form_batch_id" id="form_batch_id" value="<?=$form_batch_id;?>" />
<?php $currentStaging='All_applicantion';?>
<input type="hidden" name="currentStage" id="currentStage" value="<?=$currentStaging;?>" />
<!-- Current Staging  -->
<input type="hidden" name="currentStaged" id="currentStaged" value="<?=$currentStage;?>" />

<div class="row statusDisplay">
	<div class="col-md-4">
		<select id="FOStatus" name="FOStatus">
			<option value="">Status *</option>
			<!--option value="Ext">Extension</option -->
			<option value="NI">Not Interested</option>
			<option value="NR">No Response</option>
			<option value="EXTENSION">Extension</option>
			<option value="FHD">Followup Hold</option>
		</select>
	</div><!-- col-md-4 -->

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

<div class="col-md-4 displayNone2 IfExt" style="display:none">
<input type="text" name="submission_ext" id="submission_ext" />
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
       
    
