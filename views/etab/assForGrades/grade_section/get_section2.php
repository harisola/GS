<?php /* ?>
<input type="hidden" value="<?php echo $grade_id; ?>" />
<section class="col col-3">
<label class="label">Grade Sections </label>

<label class="select">

 <select name="gradeSections" id="gradeSections">
	<option value=""> Choose Section </option>
	<option value="0"> ALL  </option>
	<?php 
		if(!empty($sections) ):
			foreach($sections as $grade ): ?>
				<option value="<?=$grade->id;?>"> <?=$grade->name;?> </option>
			<?php 
			endforeach;
		endif;
	?>
  </select>
  
  <i></i> </label>
  
</section>
<section class="col col-6">
<label class="label"> Grade Subjects </label>
<?php */ ?>
	<label class="select">
  <select name="gradeSubject" id="gradeSubject">
	<option value=""> Choose </option>
	<option value="0"> All </option>
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
  <?php /* ?>
</section>
<?php */ ?>