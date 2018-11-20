<div class="MaroonBorderBox">
	<h3> <?=$stage;?> - <?=$student_name;?><button id="hidr" style="pull-right">Hide</button>  </h3>
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
							//$reason = explode("on", $fh["reason"] );
						?>
							<strong> <?=$fh["reason"];?> </strong> 
							<?php /*for form submission on <strong><?=$reason[1];?></strong><?php */ ?>
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
	<?php
			$display="";
			$RequestForGrade;
			if( $type == 'confirm_admission' || $type == 'RequestForGrade' ){
				$display="none";
			}else{
				$display="block";
			}
			
			if( $type == 'RequestForGrade' ){
				
				$admission_in_grade_age=$admission_in_grade_age;
				$request_for_grade = $request_for_grade;
				$display1="block";
				$displaycom="block";
				
				$alter_msg = "Yes. Approve This Case";
				
			}else{
				$display1="none";
				$displaycom="none";
				$admission_in_grade_age=0;
				$request_for_grade=0;
				$alter_msg = "Wants To Revive Applicant Case";
			}
		?>
		
		
		<div class="TimelineAddForm">
					<form method="POST" action="<?=base_url();?>index.php/gs_admission/authorities_po2/getFormData" name="postComments" id="postComments">
			<input type="hidden" name="stageType" id="stageType" value="<?=$type;?>" />
			<input type="hidden" name="form_id" id="form_id" value="<?=$form_id;?>" />
			
			
			<input type="hidden" name="admission_in_grade_age" id="admission_in_grade_age" value="<?=$admission_in_grade_age;?>" />
			<input type="hidden" name="request_for_grade" id="request_for_grade" value="<?=$request_for_grade;?>" />
			
			<div class="row" style="display:<?=$display1;?>">
					<div class="col-md-4">
						<select id="decision_performed" name="decision_performed">
							<option value="">Decision </option>
							<option value="1">Approve </option>
							<option value="2">Disapprove</option>
						</select>
					</div><!-- col-md-4 -->
			</div><!-- col-md-4 -->		
					
				<div class="row" style="display:<?=$display;?>">
				
					<div class="col-md-4">
						<select id="reviveApplication" name="reviveApplication">
							<option value="">Status *</option>
							<option value="6">Revive Applicant case</option>
						</select>
					</div><!-- col-md-4 -->

					<div class="col-md-4 displayNone IfExt">
						<select id="FOStatus">
						  <option value="">Batch *</option>
						  <option value="a01">A-01</option>
						  <option value="a02">A-02</option>
						  <option value="a03">A-03</option>
						  <option value="a04">A-04</option>
						  <option value="a05">A-05</option>
						  <option value="a06">A-06</option>
						</select>
					</div><!-- col-md-4 -->
					<div class="col-md-4 displayNone IfExt">
						<select id="FOStatus">
						  <option value="">Time Slot *</option>
						  <option value="Ext">09:00</option>
						  <option value="NI">09:15</option>
						  <option value="NR">09:30</option>
						  <option value="NI">09:45</option>
						  <option value="NR">10:00</option>
						</select>
					</div><!-- col-md-4 -->
					
					<div class="col-md-12 paddingTop20">
						<textarea placeholder="Comments" rows="4" cols="50" name="revive_txt_comments" id="txt_comments">
						</textarea>
					</div><!-- col-md-12 -->
					<div class="col-md-3 paddingTop20">
						<input type="submit" class="greenBTN" id="formSubmit" name="formSubmit" value="Submit" />
					</div><!-- col-md-12 -->
					
					

					
					
				</div><!-- row -->
				
				
				
				<div class="row" style="display:<?=$displaycom;?>">
				
					<div class="col-md-12 paddingTop20">
						<textarea placeholder="Comments" rows="4" cols="50" name="txt_comments" id="txt_comments"></textarea>
					</div><!-- col-md-12 -->
					<div class="col-md-3 paddingTop20">
						<input type="submit" class="greenBTN" id="formSubmit" name="formSubmit" value="Submit" />
					</div><!-- col-md-12 -->
					
				
					
				</div><!-- row -->
				
				
			</form>
		</div><!-- TimelineAddForm -->
	</div><!-- inner -->
</div><!-- .MaroonBorderBox -->


<!-- set up the modal to start hidden and fade in and out -->
<div id="ReviveCase" class="" title="Are you sure?" style="display:none">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:4px 9px 0 0;"></span>Wants To Revive Applicant Case </p>
</div>

