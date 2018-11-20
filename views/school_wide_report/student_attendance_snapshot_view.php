<table class="tg">
 	<tr>
	    <th class="tg-031e">
			<form action="<?php echo site_url()?>/sis/school_attendance_snapshot/printForm" id="student_strength_report" name="student_strength_report" method="POST">
    			<button type="submit" class="btn btn-primary btn-lg active">Download Student Attendance Snapshot</button>
			</form>
		</th>
		<th class="tg-031e" style="width: 10px;"></th>
		<th class="tg-031e">
			<form action="<?php echo site_url()?>/sis/school_attendance_snapshot/printForm" id="student_strength_report" name="student_strength_report" method="POST">
			    <input id="e2" name="e2">
			    <button type="submit" class="btn btn-primary">Generate Report</button>
			</form>
		</th>
	</tr>
</table>
<img class="img-rounded img-responsive" src="<?php echo site_url()?>/sis/school_attendance_snapshot/printForm2" alt="generated image">