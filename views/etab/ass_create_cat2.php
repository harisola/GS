<?php if(!empty( $singleCat) ) { ?>
<div class="inner-spacer">
<div class="callout callout-info" id="successMsg" style="display:none;">
Thank you! Category Created.
</div>
<div id="afterUpdate">

<form action="" method="post" enctype="multipart/form-data" id="updateCategory"  class="orb-form">
<input type="hidden" name="screteID" value="<?=$singleCat->id;?>" />
<fieldset>
<div class="row">
  <section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="ass_cat_title" value="<?=$singleCat->name;?>" id="catTitle">
	</label>
  </section>
   <section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="catDisplayName" value="<?=$singleCat->dname;?>"  id="catDisplayName">
	</label>
  </section>
</div>
</fieldset>


<fieldset>

<div class="row">
  
  <section class="col col-6">
	<label class="input"> <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="catShortName" value="<?=$singleCat->sname;?>"  id="catShortName">
	</label>
  </section>
  <section class="col col-6">
	<label class="input">  <i class="icon-append fa fa-asterisk"></i>
	  <input type="text" name="ass_cat_weightage" value="<?=$singleCat->weightage;?>" id="ass_cat_weightage">
	  <input type="hidden" name="current_weightage" value="<?=$singleCat->weightage;?>" id="current_weightage">
	</label>
  </section>
</div>


<section>
  <label class="textarea"> <i class="icon-append fa fa-comment"></i>
	<textarea rows="5" name="ass_cat_comment" id="ass_cat_comment"><?=$singleCat->comments;?></textarea>
  </label>
</section>
</fieldset>


 <footer>
				  
				  <div class="row">
                      
                      <section class="col col-3">
				   <?php
				 // $totalWeightage = 100;
						if(!empty($totalWeightage)){
							if( $totalWeightage >= 100 ){ ?>
								<div class="callout callout-warning">
								 Weightage Reached To 100% 
								</div>
								<button type="submit" class="btn btn-default" id="updateAssMain"> Update Category </button>
								<input type="hidden" name="totalWeightage" id="totalWeightage" value="<?=$totalWeightage;?>" />
							<?php }else{ ?>
								<button type="submit" class="btn btn-default" id="updateAssMain"> Update Category </button>
								<div class="progress"></div>
								<input type="hidden" name="totalWeightage" id="totalWeightage" value="<?=$totalWeightage;?>" />
							<?php }
						}
					  ?>
					  </section>
					   <?php
							 $totalR = ( 100 - $totalWeightage );
							
							if( $totalR < 100 ){
						?>
						
                    <section class="col col-8">
					
					 
						
					 <div class="callout callout-info">
					
						
					  <h4 id="totalR">
					  <?php
							
							 echo $totalR;
						?>
					</h4>
					<input type="hidden" name="aviableWeightage" id="aviableWeightage" value="<?=$totalR;?>" />
                      <p>Reamining Weightage</p>
                     
                    </div>
					
					  </section>
							<?php } ?>
					  </div>
                  </footer>
				  
				  
				  
<!--footer>
<button type="submit" class="btn btn-default" id="send"> Update Category </button>
<div class="progress"></div>
</footer -->

<div class="message"> <i class="fa fa-check"></i>
<p>Thank you<br>
  Category Created.</p>
</div>

</form>
</div><!-- // End afterUpdate-->

</div>



<?php }?>



