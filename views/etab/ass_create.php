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
                <h2> Assessment <small> Category Grade </small></h2>
              </header>
              <div class="inner-spacer">
			  <div class="callout callout-info" id="successMsg" style="display:none;">
			  Thank you! Category Created.
			  </div>
				
                <form action="" method="post" enctype="multipart/form-data" id="order-form-type" class="orb-form">
                  <fieldset>
					
					<section class="col col-6">
					<div class="row">
					
					<table class="table">
						<tr>
							<td><label class="label"> Grade </label></td>
							
							<td>
							
							<label class="select">
							  <select name="assCategoryGrade" id="assCategoryGrade">
								<option value=""> Choose Grade </option>
								<?php 
									if(!empty($grades) ):
										foreach($grades as $grade ): ?>
											<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
										<?php 
										endforeach;
									endif;
								?>
							  </select>
							  <i></i> </label>
						  
							</td>
							
							
						</tr>
					</table>
				
                      
                    </div>
					</section>
				  </fieldset>
				  <!-- getCategoris-->
        
			<fieldset>
					<section class="col col-6">
					<div class="row">
					
					<table class="table">
					<tr>
					<thead>
						<th> Category </th>
						<th> Weightage </th>
						
					</thead>
					
					</tr>
					 <tr>
						<td><label class="label"> Formative </label></td>
						<td><label class="input"><i class="icon-append fa fa-asterisk"></i>
                        <input type="text" placeholder="Weightage" name="weightage" value="55">
						</td>
							
					</tr>
					
					<tr>
						<td><label class="label"> Summative </label></td>
						<td><label class="input"><i class="icon-append fa fa-asterisk"></i>
                        <input type="text" placeholder="Weightage" name="weightage"value="40">
						</td>
							
					</tr>
					
					
					<tr>
						<td><label class="label"> ASP </label></td>
						<td><label class="input"><i class="icon-append fa fa-asterisk"></i>
                        <input type="text" placeholder="Weightage" name="weightage" value="5">
						</td>
							
					</tr>
					
					<tr>
						<td> Total Weightage </td>
						<td> 100 % For Grade II </td>
					
					</tr>
					</table>
					
				
					  
					  	
					
                     
                     
                    </div>
					
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
         



