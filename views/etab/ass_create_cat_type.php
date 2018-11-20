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
              <header>
                <h2> Assessment <small> Category </small></h2>
              </header>
              <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">
			  Thank you! Category Created.
			  </div>
				
                <form action="" method="post" enctype="multipart/form-data" id="catType" class="orb-form">
				
                  <fieldset>
					<div class="row">
						<section class="col col-12">
							 <section>
                      <div class="inline-group">
					  <?php if(!empty($categories) ){ ?>
						<label class="select">
						  <select name="mainCategory" id="mainCategory">
								<option value=""> Main Category </option>
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
							
						</section>
					</div>
				  </fieldset>
				  
        
			<fieldset>
					<section>
					<label class="label col col-1"> Type </label>
					<div class="row">
                      <section class="col col-5">
                        <label class="input"><i class="icon-append fa fa-asterisk"></i>
                          <input type="text" placeholder="Type name" name="subCatTitle" id="subCatTitle" />
                        </label>
                      </section>
					  
					  	<label class="label col col-2"> Weightage</label>
					
                      <section class="col col-3">
                        <label class="input"><i class="icon-append fa fa-asterisk"></i>
                          <input type="text" placeholder="Weightage" name="subCatweightage" id="subCatweightage" />
                        </label>
                      </section>
                     
                    </div>
					
					</section>
				  </fieldset>
				  
				  		<fieldset>
					<section>
					<label class="label col col-3"> Display Name</label>
					<div class="row">
                      <section class="col col-4">
                        <label class="input"><i class="icon-append fa fa-asterisk"></i>
                          <input type="text" placeholder="Display Name" name="subDName" id="subDName" />
                        </label>
                      </section>
					
					  	<label class="label col col-2"> Short Name </label>
					
                      <section class="col col-2">
                        <label class="input"><i class="icon-append fa fa-asterisk"></i>
                          <input type="text" placeholder="Short Name" name="subSName" id="subSName" />
                        </label>
                      </section>
                     
                    </div>
					
					</section>
				  </fieldset>
				  
					
		   
		  
      
				
				  
                  <fieldset>
                 
                  
					

                    <section>
                      <label class="textarea"> <i class="icon-append fa fa-comment"></i>
                        <textarea rows="5" name="comments" placeholder="Tell some information about category"></textarea>
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
            <!-- /End Widget --> 
			
          </div>
         



