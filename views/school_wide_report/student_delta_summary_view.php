<table class="tg">
 	<tr>
	    <th class="tg-031e">
			<form action="<?php echo site_url()?>/sis/school_student_delta_summary/printForm" id="student_strength_report" name="student_strength_report" method="POST">
			    <button type="submit" class="btn btn-primary btn-lg active">Download Student Δ Summary</button>
			</form>
		</th>
		<th class="tg-031e" style="width: 10px;"></th>
		<th class="tg-031e">
			<form action="<?php echo site_url()?>/sis/school_student_delta_summary/printForm" id="student_strength_report" name="student_strength_report" method="POST">
			    <input id="e1" name="e1">
			    <button type="submit" class="btn btn-primary">Generate Δ Summary</button>
			</form>
		</th>
	</tr>
</table>
<img class="img-rounded img-responsive" src="<?php echo site_url()?>/sis/school_student_delta_summary/printForm2" alt="generated image">