<div class="col-md-3 bootstrap-grid sortable-grid ui-sortable"> 
	<div class="powerwidget black" id="" data-widget-editbutton="false" role="widget" style="">
		<header role="heading">
			<h2>Students of  <?php echo $GradeSec;?> </h2>
			<div class="powerwidget-ctrls" role="menu"></div>
			<span class="powerwidget-loader"></span>
		</header>
		<div class="inner-spacer" role="content" style="overflow-y: scroll; height: 75vh;">
			<div id="student_log_std_callout"></div>
			<table class="table table-hover margin-0px student_log_grade_section_std" id="student_log_grade_section_std">
				<thead></thead>
				<tbody>
					<?php if ( !empty( $students ) ): ?>
					<input type="hidden" name="grade_id" id="grade_id" value="<?=$students[0]["grade_id"];?>" />
					<input type="hidden" name="section_id" id="section_id" value="<?=$students[0]["section_id"];?>" />
					<?php foreach( $students as $gs): ?>
					<tr>
						<td class="studentID"><?=$gs['gs_id'];?></td>
						<td><?=$gs['abridged_name'];?></td>
						<td><?=$gs['std_status_code'];?></td>
					</tr>
					<?php endforeach;
					endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="col-md-7 bootstrap-grid sortable-grid ui-sortable">
	<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader2">
			<p> Please Wait Loading Report.. <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">  </p>
			</div>
	<div id="student_log_div3"></div>
</div>