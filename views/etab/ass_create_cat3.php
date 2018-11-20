	
                <form id="order-form" class="orb-form">
                  
                  <fieldset>
                    <div class="row">
                      <section class="col col-6">
					 
                        <label class="input"> <i class="icon-append fa fa-asterisk"></i>
                          <input type="text" name="ass_cat_title" placeholder="Category Title" id="catTitle">
                        </label>
                      </section>
					   <section class="col col-6">
                        <label class="input"> <i class="icon-append fa fa-asterisk"></i>
                          <input type="text" name="catDisplayName" placeholder="Display Name" id="catDisplayName">
                        </label>
                      </section>
                    </div>
                 </fieldset>
				  
				  
                  <fieldset>
                 
                    <div class="row">
                      
                      <section class="col col-6">
                        <label class="input"> <i class="icon-append fa fa-asterisk"></i>
                          <input type="text" name="catShortName" placeholder="Short Name" id="catShortName">
                        </label>
                      </section>
					  <section class="col col-6">
                        <label class="input">  <i class="icon-append fa fa-asterisk"></i>
                          <input type="text" name="ass_cat_weightage" placeholder="Weightage" id="ass_cat_weightage">
                        </label>
                      </section>
                    </div>
					

                    <section>
                      <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                        <textarea rows="5" name="ass_cat_comment" id="ass_cat_comment" placeholder="Category Description"></textarea>
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
								<button type="submit" class="btn btn-default" disabled > Create Category </button>
								<input type="hidden" name="totalWeightage" id="totalWeightage" value="<?=$totalWeightage;?>" />
							<?php }else{ ?>
								<button type="submit" class="btn btn-default" id="createAssMain"> Create Category </button>
								<div class="progress"></div>
								<input type="hidden" name="totalWeightage" id="totalWeightage" value="<?=$totalWeightage;?>" />
							<?php }
						}else{   $totalWeightage = 0; ?>
							<button type="submit" class="btn btn-default" id="createAssMain"> Create Category </button>
								<div class="progress"></div>
								
								<input type="hidden" name="totalWeightage" id="totalWeightage" value="<?=$totalWeightage;?>" />
						<?php }
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
					
                      <p>Reamining Weightage</p>
                     <input type="hidden" name="aviableWeightage" id="aviableWeightage" value="<?=$totalR;?>" />
                    </div>
					
					  </section>
							<?php }else{ ?> 
							
							  <section class="col col-8">
					
					 
						
					 <div class="callout callout-info">
					
						
					  <h4 id="totalR">
					  <?php
							
							 echo $totalR;
						?>
					</h4>
					
                      <p>Reamining Weightage</p>
                     <input type="hidden" name="aviableWeightage" id="aviableWeightage" value="<?=$totalR;?>" />
                    </div>
					
					  </section>
							
							<?php } ?>
					  </div>
					  
                  </footer>
				  
				  
                  <div class="message"> <i class="fa fa-check"></i>
                    <p>Thank you<br>
                      Category Created.</p>
                  </div>
				  
                </form>
           