<?php 
/*
$boolean = true;
if(!empty($mainCatSub) ){ 
?>
<?php foreach( $mainCatSub as $cat ): ?>
<section class="col col-5">
<?php if( $boolean ){ ?>
<label class="label">Category Type  </label>
<?php } ?>
<strong> <?=ucwords( strtolower( $cat->name ) );?></strong>
<input type="hidden" name="subCategory[]" value="<?=$cat->id;?>" />
</section>
<section class="col col-3">
<?php if( $boolean ){ ?>
<label class="label">Weighate  </label>	
<?php } ?>
<input type="hidden" value="" class="catWeighateHide" name="1" />
<input type="hidden" name="assessmentID[]" value='no_data' />
<label class="select">
<select name="weightage[]" class="weighateges">
<option value="0">  Choose Weighate  </option>
<?php for($counter = 1; $counter <= 100; $counter+= 0.5){ ?>
<option value="<?=$counter;?>" <?php //if($counter == 30) echo "selected"; ?>> <?=$counter;?> </option>
<?php } ?>
</select>
<i></i> </label>
</section>
<?php 
	$boolean = false; 
endforeach; ?>
<?php } */
//var_dump ($getProgramID);

?>

<?php if(!empty($getProgramID) ){ ?>
<input type="hidden" value="<?php echo $getProgramID[0]["id"]; ?>" name="programSetupID" />
<?php } ?>
<table class="table table-striped table-hover margin-0px">
<thead>
<tr>
  <th style="text-align:center">Ignore</th>
  <th style="text-align:center">Sub Category</th>
  <th style="text-align:center">Weightage </th>
</tr>
</thead>
<tbody>
<?php if(!empty($mainCatSub) ){ ?>
<?php foreach( $mainCatSub as $cat ): ?>

<tr class="subCatRow">
<td style="text-align:center"> 
  <label for="checkboxes-2" class="checkbox-inline">
  <input class="checkBoxIngore" type="checkbox" value="<?=$cat->id;?>" id="checkboxes-<?=$cat->id;?>" name="ignore[]" checked>
  </label>
  </td>
  <td style="text-align:center">
	<?=ucwords( strtolower( $cat->name ) );?> 
	<input type="hidden" name="subCategory[]" value="<?=$cat->id;?>" />
  </td>
  <td>
<input type="hidden" value="" class="catWeighateHide" name="1" />
<input type="hidden" name="assessmentID[]" value='no_data' />
<label class="select">
<select name="weightage[]" class="weighateges">
<option value="0"> Number </option>
<?php for($counter = 1; $counter <= 100; $counter+= 0.5){ ?>
<option value="<?=$counter;?>" <?php //if($counter == 30) echo "selected"; ?>> <?=$counter;?> </option>
<?php } ?>
</select>
<i></i> </label>
</td>
</tr>

<?php endforeach; ?>
<?php }else{ ?>
<tr>
  <td colspan="3"> No Record Found!</td>
</tr>
<?php } ?>
</tbody>
</table>
              
			 