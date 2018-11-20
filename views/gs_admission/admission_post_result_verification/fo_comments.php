<div class="MaroonBorderBox">
<h3>Followup <?php echo $student_name; ?><button id="hidr" style="pull-right">Hide</button> </h3>
<div class="inner" style="padding-bottom:0;">

<div class="TimelineReview">
<ul>
<?php 
$in_out = "in";

	if( !empty( $formHistory ) ){
		foreach( $formHistory as $fh ){
			
			if( $fh["type"] == 'Issuance' || $fh["type"] == 'Stage' || $fh["type"] == 'Status' ){ ?>
				<li class="adminResponse">
					<p><?=$fh["message"];?> <?php // $fh["change_date"];?></p>
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
	<form action="<?=base_url();?>index.php/gs_admission/admission_post_result_verification/add_comments" method="POST" name="form_followup" id="form_followup" class="issuance">

		<input type="hidden" name="form_stage" id="form_stage" value="followup" />
		<input type="hidden" name="form_id" id="form_id" value="<?=$form_id;?>" />
		<input type="hidden" name="form_no" id="form_no" value="<?=$form_no;?>" />

	<div class="row">
		<div class="col-md-4">
			<select id="FOStatus" name="FOStatus">
				<option value="">Status *</option>
				<option value="OFFR">Offer</option>
				<option value="RGT">Regert</option>
			</select>
		</div><!-- col-md-4 -->
		<div class="col-md-12 paddingTop20">
		<textarea placeholder="Comments" rows="4" cols="50" name="followupComments" id="followupComments"></textarea>
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
       
    