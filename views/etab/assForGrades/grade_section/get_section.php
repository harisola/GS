<label class="select">
  <select name="gradeSubject" id="gradeSubject">
	<option value=""> Choose </option>
	<?php 
		if(!empty($gradePrograms) ):
			foreach($gradePrograms as $grade ): ?>
				<option value="<?=$grade->subject_id;?>"> <?=$grade->subject_name;?> </option>
			<?php 
			endforeach;
		endif;
	?>
</select>
  <i></i> </label>
