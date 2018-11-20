<label class="label">Category Type  </label>
<?php if(!empty($mainCatSub) ){ ?>
<label class="select">
<select name="subCategory" id="subCategory">
<option value=""> Category Type </option>
<?php foreach( $mainCatSub as $cat ): ?>
<option value="<?=$cat->id;?>"> <?=ucwords( strtolower( $cat->name ) );?> </option>	
<?php endforeach; ?>
</select>
<i></i> </label>
<?php }else{ ?>
<style>
.callout-danger::before{ top:5px; }
.inner-spacer .callout{	margin:0; }
.callout { margin:0; min-height: 15px; }
</style>
<div class="callout callout-danger"><p>Please Category / <strong> No! Sub Category <strong> </p> </div>
<?php } ?>