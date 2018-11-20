
			  <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">Thank you! Category Created.</div>
			  
			  
			  <div id="successMsgExceed" class="modal">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
				  <div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
					<!--i class="fa fa-lock"></i --> 
					<h4 class="modal-title"> WARNING!  </h4>
					</div>
					<div class="modal-body text-center">
						<p>  <strong> WARNING! </strong>  Total Weightage Exceed For This Category, BUT ADJUSTED. </p>
					</div>
					
				</div>
				<!-- /.modal-content --> 
			  </div>
			  <!-- /.modal-dialog --> 
			</div>

			
			  <div id="successMsgExceeded2" class="modal">
			  <div class="modal-dialog modal-sm">
				<div class="modal-content">
				  <div class="modal-header">
					<button aria-hidden="true" data-dismiss="modal" class="close" type="button">X</button>
					<!--i class="fa fa-lock"></i --> 
					<h4 class="modal-title"> ERROR!  </h4>
					</div>
					<div class="modal-body text-center">
						
					</div>
					
				</div>
				<!-- /.modal-content --> 
			  </div>
			  <!-- /.modal-dialog --> 
			</div>
			


				<form action="" method="POST" id="catType" class="orb-form" name="catType">
				 <fieldset>
					<div class="row">
					  <section class="col-12">
						 <section class="col col-6">
                       <div class="inline-group">
					    <?php if(!empty($categories) ){ ?>
						
						  <label class="select">
						    <select name="mainCategory" id="mainCategory">
							 <option value=""> Select Category </option>
							 <?php foreach($categories as $grade ): ?>
							 <option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
							 <?php endforeach; ?>
						  </select>
						<i></i> </label>
						
						<?php }else{ ?>
						<label class="radio">
                        <input type="radio" checked="" name="mainCategory" value="1">
                        <i></i>Formative</label>
                        <label class="radio">
                        <input type="radio" name="mainCategory" value="2">
                        <i></i>Summative</label>
                        <label class="radio">
                        <input type="radio" name="mainCategory" value="3">
                        <i></i>A</label>
						<label class="radio">
                        <input type="radio" name="mainCategory" value="4">
                        <i></i>S</label>
						<label class="radio">
                        <input type="radio" name="mainCategory" value="5">
                        <i></i>P</label>
						  
					  <?php } ?>
						  
                      </div>
					  
					  
						

					  </section>
					  
					  <section class="col col-6" style="height:30px;">
							 <section class="col col-6"> </section>
						 <section class="col col-6">
							<button type="submit" class="btn btn-default btn-lg" id="sendCreat"> Create Category </button>
					
								<div class="progress"></div>
                  </section>
				  
							</section>
							
							<!--section class="col col-6">
								<label class="input"><i class="icon-append fa fa-asterisk"></i>
                          <input type="text" placeholder="Type name" name="subCatTitle" id="subCatTitle" />
                        </label>
							</section -->
						</section>
					</div>
				  </fieldset>
		
			<?php for($counter=1;$counter<=5;$counter++): ?>
        <fieldset>
			<div class="row">
				<section class="col-12">
					<section class="col col-6">
						<label class="input"><i class="icon-append fa fa-asterisk"></i>
							<input type="text" placeholder="Type name" name="subCatTitle<?=$counter;?>" />
						</label>
					</section>
					<section class="col col-6">
						<label class="textarea"> <i class="icon-append fa fa-comment"></i>
							<textarea rows="5" name="comments<?=$counter;?>" placeholder="Tell some information about category type"></textarea>
						</label>
					</section>
				</section>
			</div>
		</fieldset>
		<?php endfor; ?>
			
					
		   
		  
      
				
				  
                 <!--fieldset>
                 <section>
                      <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                        <textarea rows="5" name="comments" placeholder="Tell some information about category"></textarea>
                      </label>
                    </section>
                  </fieldset -->
				  
                  <footer>
                    <button type="submit" class="btn btn-default" id="sendCreat"> Create Category </button>
                    <div class="progress"></div>
                  </footer>
				  
                  <div class="message"> <i class="fa fa-check"></i>
                    <p>Thank you<br>
                      Category Created.</p>
                  </div>
				  
                </form>
              </div>
			  
			  
			
            


