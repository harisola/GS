<!-- Term -->
<div class="row1" style="float:right">
	<div class="col-md-6">
		<label class="label" style="color:black;font-size:13px">Select Term</label>
		<label class="select" id="term">
			<select>
				<option value="1" >First Term</option>
				<option value="2" selected>Second Term</option>
			</select>
		</label>
	</div>
</div>

<hr></hr>

	<!---  Grade Section -->
<div class="col-md-2">
	<div class="powerwidget black" data-widget-editbutton="false" data-widget-deletebutton="false" >
		<header><h2>Grade-Section</h2></header>
	 	<div class="inner-spacer" style="overflow-y: scroll; height: 35vh;">
	 		<table class="table table-hover">
	 			<thead></thead>
	 			<tbody>
	 				<?php //foreach($class_list as $grade_section) { ?>
	 				<!--
	 					<tr>
							<td class="grade_section" data-academic="<?php echo $grade_section->academic_session_id?>" data-grade="<?php echo $grade_section->grade_id ?>" data-section="<?php echo $grade_section->section_id ?>"><?php echo $grade_section->grade_name."-".$grade_section->section_name; ?></td>
	 					</tr>
	 				-->
	 				<?php //} ?>

	 				<?php foreach($this->data['gradeSection'] as $gs) { ?>
		              <tr>
		                <td class="grade_section" data-academic="<?php echo $gs['academic_session_id']; ?>" data-grade="<?php echo $gs['grade_id']; ?>" data-section="<?php echo $gs['section_id']; ?>"><?php echo $gs['grade_name'] . '-' . $gs['section_name']; ?></td>
		              </tr>
		            <?php } ?>
	 			</tbody>
	 		</table>
	 	</div>			
	</div>
</div>

	<!-- Subject Name  -->

<div class="col-md-2">
	<div class="powerwidget black" data-widget-editbutton="false" data-widget-deletebutton="false" id="subject_display">
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

<div id="optional">
</div>

<div class="row">
	<div class="col-md-12">
		<div class="inner-spacer">
			<h2><div id="LabelHeading"></div></h2>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="setup_2">
		</div>
	</div>
</div>







<div class="row">
	<div class="col-md-12">
		<div id="setup_3">
			
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div id="setup_4">
			
		</div>
	</div>
</div>

<!-- <div class="row">
	<div class="col-md-12">
		<div id="setup_5">
		</div>
	</div>	
</div> -->

<div class="row">
	<div class="col-md-12">
		<div id="subject_report">
		</div>
	</div>
</div>

<!-- <div class="row">
	<div class="col-md-12">
		<div id="formative_framework_report">
		</div>
	</div>
</div>
 -->
<div class="row">
	<div class="col-md-12">
		<div id="updated_framework_report">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="summative_framework_report">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="subject_marksheet_report">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="subject_marksheet_formative_report">
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div id="subject_marksheet_term_report">		
		</div>
	</div>
</div>