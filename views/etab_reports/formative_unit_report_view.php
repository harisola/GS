<!---  Grade Section -->
<div class="col-md-2 bootstrap-grid">
	<div class="powerwidget black" data-widget-editbutton="false" data-widget-deletebutton="false" >
		<header><h2>Available Reports</h2></header>
	 	<div class="inner-spacer" style="overflow-y: scroll; height: 35vh;">
	 		<table class="table table-hover" id="report_selection">
	 			<thead></thead>
	 			<tbody>
	 				  <tr><td style="color:#000000; !important" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Overall Report</td></tr>
	 				  <tr><td style="color:#000000; !important" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Overall Report - Split</td></tr>
	 				  <tr><td style="color:#000000; !important" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Overall Report - Science</td></tr>
		 			  <tr><td style="color:#000000; !important" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Term-2 Unit Report</td></tr>
		 			  <tr><td style="color:#000000;" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Term-2 Junior Unit Report</td></tr>
		 			  <tr><td style="color:#000000;" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Term-2 Formative Report</td></tr>
		 			  <!-- Reading Assessment Report -->
		 			  <tr><td style="color:#000000;" class="report_selection" data-report="report_term2"><strong>(2017-18)</strong> Term-1 Reading Assessment Report</td></tr>
		 			  <tr><td style="color:#000000;" class="report_selection highlighted2" data-report="report_term2"><strong>(2017-18)</strong> Term-2 Report</td></tr>



		 			  <tr><td style="color:#404040; !important" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Term-1 Unit Report</td></tr>
		 			  <tr><td style="color:#404040;" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Term-1 Junior Unit Report</td></tr>
		 			  <tr><td style="color:#404040;" class="report_selection" data-report="report_unit_term1"><strong>(2017-18)</strong> Term-1 Formative Report</td></tr>
		 			  <tr><td style="color:#404040;" class="report_selection" data-report="report_term2"><strong>(2017-18)</strong> Term-1 Report</td></tr>



	 			  <font color="#606060">
		              <tr><td style="color:#202020; !important" class="report_selection" data-report="report_unit_term2"><strong>(2016-17)</strong> Term-2 Unit Report</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="report_term2_formative"><strong>(2016-17)</strong> Term-2 Formative Report</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="report_term2"><strong>(2016-17)</strong> Term-2 Report</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="overall_term_report"><strong>(2016-17)</strong> Overall Report</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="overall_term_report_split"><strong>(2016-17)</strong> Overall Report - Split</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="overall_term_report_split"><strong>(2016-17)</strong> Overall Report - Science</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="report_unit"><strong>(2016-17)</strong> Term-1 Unit Report</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="report_term1_formative"><strong>(2016-17)</strong> Term-1 Formative Report</td></tr>
		              <tr><td style="color:#202020;" class="report_selection" data-report="report_term1"><strong>(2016-17)</strong> Term-1 Report</td></tr>
	              </font>            
	 			</tbody>
	 		</table>
	 	</div>			
	</div>
</div>




<div class="col-md-2 bootstrap-grid">
	<div class="powerwidget black" data-widget-editbutton="false" data-widget-deletebutton="false" >
		<header><h2>Grade-Section</h2></header>
	 	<div class="inner-spacer" style="overflow-y: scroll; height: 35vh;">
	 		<table class="table table-hover" id="#grade_section">
	 			<thead></thead>
	 			<tbody>
	 				<?php foreach($this->data['gradeSection'] as $gs) { ?>
		              <tr>
		                <td class="grade_section" data-academic="<?php echo $gs['academic_session_id']; ?>" data-grade="<?php echo $gs['grade_id']; ?>" data-section="<?php echo $gs['section_id']; ?>" data-gradename="<?php echo $gs['grade_name']; ?>" data-sectionname="<?php echo $gs['section_name']; ?>"><?php echo $gs['grade_name'] . '-' . $gs['section_name']; ?></td>
		              </tr>
		            <?php } ?>
	 			</tbody>
	 		</table>
	 	</div>			
	</div>
</div>


<div class="col-md-8 bootstrap-grid">
	<div id="option_definition">
	</div>
</div>

<div class="col-md-8 bootstrap-grid">
	<div id="unit_report_term2">
	</div>
</div>

<div class="col-md-8 bootstrap-grid">
	<div id="get_formative_report_term2">
	</div>
</div>

<div class="col-md-8 bootstrap-grid">
	<div id="programme_report">
	</div>
</div>


<div class="col-md-8 bootstrap-grid">
	<div id="setup_2">
	</div>
</div>


<div class="col-md-12 bootstrap-grid">
	<div id="setup_3">
	</div>
</div>