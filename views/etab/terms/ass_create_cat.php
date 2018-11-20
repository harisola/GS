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
			<header> <h2> Terms </h2> </header>
			
			<div id="editCategory">
		
			
			 
			  
              <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">
			  Thank you! Category Created.
			  </div>
				
                <form method="post" enctype="multipart/form-data" id="order-form" class="orb-form">
                  
                  <fieldset>
                    <div class="row">
						<section class="col col-6">
                       
					    <label class="select">
						    <select id="academicSession" name="academicSession">
							 <option value=""> Academic Sessions  </option>
							 <?php if(!empty( $acLists )) :?>
							 <?php foreach($acLists as $option ) : ?>
								<option value="<?=$option["id"];?>"> <?=$option["name"];?> </option>
							 <?php endforeach; ?>
							 <?php endif; ?>
						  </select>
						<i></i> </label>
						
					  </section>
					  
						
					
					  
					<section class="col col-6">
                       
					    <label class="select">
						    <select id="term" name="term">
							 <option value=""> Terms  </option>
							 <option value="1"> 1st Term </option>
							 <option value="2"> 2nd Term </option>
							 <!--option value="3"> Third Term </option>
							 <option value="4"> Fourth Term </option>
							 <option value="5"> Fifth Term </option -->
							</select>
						<i></i> </label>
						
					  </section>
					  
					  
					  
                    </div>
                 </fieldset>
				  
				  
                  <fieldset>
                 
           
					

                    <section>
                      <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                        <textarea rows="5" name="ass_cat_comment" id="ass_cat_comment" placeholder="Tell some information about category"></textarea>
                      </label>
                    </section>
                  </fieldset>
                  <footer>
                    <button type="submit" class="btn btn-default" id="send"> Create Category </button>
                    <div class="progress"></div>
                  </footer>
				  
                  <div class="message"> <i class="fa fa-check"></i>
                    <p>Thank you<br>
                      Category Created.</p>
                  </div>
				  
                </form>
              </div>
			  
			  
			  
		
             
			  
			  
			  </div>
            </div>
            <!-- /End Widget --> 
			
          </div>
