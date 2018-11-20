
	<!---  Grade Section -->
<div class="col-md-2">
	<div class="powerwidget black" data-widget-editbutton="false" data-widget-deletebutton="false" >
		<header><h2>Grade-Section</h2></header>
	 	<div class="inner-spacer" style="overflow-y: scroll; height: 35vh;">
	 		<table class="table table-hover">
	 			<thead></thead>
	 			<tbody>
					<?php foreach($this->data['gradeSection'] as $gs) { ?>
		              <tr>
		                <td class="grade_section" data-academic="<?php echo $gs['academic_session_id']; ?>" data-grade="<?php echo $gs['grade_id']; ?>" data-section="<?php echo $gs['section_id']; ?>"><?php echo $gs['grade_name']  ?></td>
		              </tr>
		            <?php } ?>
	 			</tbody>
	 		</table>
	 	</div>			
	</div>
</div>

	<!-- Subject Name  -->

<div class="col-md-2">
	<div class="powerwidget black" data-widget-editbutton="false" data-widget-deletebutton="false">
		<header><h2>Subjects</h2></header>
		<div class="inner-spacer" style="overflow-y:scroll; height: 35vh ">
			<table class="table table-hover" id="subject">
				<thead>
					<tbody>	
						<?php foreach($subject as $sub)  { ?>
							<tr>
								<td><?php echo $sub->name ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</thead>
			</table>
		</div>
	</div>
</div>

                
<div id="gradingForm">
</div>

<div class="row">
</div>

<div class="row">
	<div class="col-md-6">
		<div id="gradeASP">
		</div>
	</div>
	<div class="col-md-6">
		<div id="overallpercentage">

		</div>
	</div>
</div>
