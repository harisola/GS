<style>
.page-header{ display:none; }
.fa-times-circle{ display:none;}
.fa-chevron-circle-up { display:none;}
</style>
<div class="content-wrapper" style="margin: 0 10px;min-height:auto;">
	<!-- Widget Row Start grid -->
     <div class="row" id="powerwidgets">
        <div class="col-md-12 bootstrap-grid">                        
			<!-- New widget -->
			<div class="col-md-6 bootstrap-grid"> 
			<!-- New Category Form Submission  -->
            <div class="powerwidget cold-grey" id="order-form-validation-widget" data-widget-editbutton="false">
              <header><h2> Assessment <small> Category </small></h2></header>
			  
			  <div id="editCategory">
			  
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

			
	
			

<?php if(!empty($categories) ){ ?>
				<form action="" method="POST" id="catType" class="orb-form" name="catType">
				 <fieldset>
					<div class="row">
					  <section class="col-12">
						 <section class="col col-6">
                       <div class="inline-group">
					    
						
						  <label class="select">
						    <select name="mainCategory" id="mainCategory">
							 <option value=""> Select Category </option>
							 <?php foreach($categories as $grade ): ?>
							 <option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
							 <?php endforeach; ?>
						  </select>
						<i></i> </label>
						
					
						  
                      </div>
					  
					  
						

					  </section>
					  
							<section class="col col-6" style="height:30px;">
							 <section class="col col-6"> </section>
						 <section class="col col-6">
							<button type="submit" class="btn btn-default btn-lg" id="sendCreat"> Create Category </button>
					
								<div class="progress"></div>
                  </section>
				  
							</section>
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
					<?php }else{ ?>
					 <div class="message2"> <i class="fa fa-check"></i>
                    <p>Created <br> Main Category First.</p>
                  </div>
					  <?php } ?>
				
              </div>
			  
			  
			  </div>
            </div>
            <!-- /End Widget --> 
			
          </div>
         



