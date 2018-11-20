<section>
 <label class="label"><b>Select teacher</b></label>
 <label class="select">
    <select name="" >
       <option value="0">Teacher Name</option>
      fe
       <?php if(!empty($teacher)) { ?>
       	<?php foreach ($teacher as $value) { ?>
       		<option value="<?php echo $value->id ?>"><?php echo $value->staff_name; ?></option>
       <?php	} ?>
       <?php }?>
    </select>
    <i></i> 
 </label>
</section>

