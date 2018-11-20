<div class='row'>
	<div class='col-md-12'>
		<div class='powerwidget green'>
			<header><h2>Select Group</h2></header>
			<div class='row'>
				<div class='inner-spacer'>
					<?php foreach ($no_of_group as  $value) { ?>
						<div class='col-md-2'>
							<div class='drop'>
								<?php if($value->subject_selection_group_id == 1) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>'><?php echo 'A'; ?></h4>
										<?php foreach($no_of_subject_one as $subject) { ?>
											<input type="hidden" value='<?php echo $subject->subject_id ?>' >
											<ol>
												<li><?php echo $subject->name;  ?></li>
											</ol>
										<?php } ?>
								<?php  } ?>
								<?php if($value->subject_selection_group_id == 2) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>'><?php echo 'B' ?></h4>
										<?php  foreach($no_of_subject_two as $subject) {?>
											<input type='hidden' value="<?php echo $subject->subject_id ?>">
											<ol>
												<li><?php echo $subject->name;?></li>
											</ol>
										<?php } ?>
								<?php } ?>

								<?php if($value->subject_selection_group_id == 3) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>'><?php echo 'C' ?></h4>
										<?php  foreach($no_of_subject_three as $subject) {?>
											<input type='hidden' value="<?php echo $subject->subject_id ?>">
											<ol>
												<li><?php echo $subject->name; ?></li>
											</ol>
										<?php } ?>	

								<?php } ?>

								<?php if($value->subject_selection_group_id == 4) {?>
									<h4><input type="hidden" value='<?php echo $value->subject_selection_group_id; ?>'><?php echo 'D' ?></h4>
										<?php  foreach($no_of_subject_four as $subject) {?>
											<input type='hidden' value="<?php echo $subject->subject_id ?>">
											<ol>
												<li><?php echo $subject->name; ?></li>
											</ol>
										<?php } ?>	

								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>