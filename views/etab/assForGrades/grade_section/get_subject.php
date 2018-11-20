<section>
<input type ='hidden' value="<?php echo $section_id ?>" />
<input type='hidden' value="<?php echo $grade_id ?>" />
 <label class="label"><b>Select Subject</b></label>
 <label class="select">
    <select name="" onchange="fetch_subject_id(this.value)">
       <option value="0" selected="" disabled="">Subject Name</option>
       <?php if(!empty($subject)) { ?>
       	<?php foreach ($subject as $value) { ?>
       		<option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
       <?php	} ?>
       <?php }?>
    </select>
    <i></i> 
 </label>
</section>
<!-- Get the value of subject id,section id and grade id so it can be used in getting the teacher  -->
<script type="text/javascript">
	function fetch_subject_id(val)
	{
		$.ajax({
		 type:"POST",
		 cache:false,
		 url:"<?php echo base_url(); ?>index.php/grade_section/sg_ajax/teacher",
		 data:{subject_id:[val,<?php echo $section_id ?>,<?php echo $grade_id ?>]},
		 success:function(e)
		 {
		 	$('#teacher').html(e);
		 }

		});
	}
</script>