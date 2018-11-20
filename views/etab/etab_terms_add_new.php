 
<script src="<?php echo base_url()?>components/onboard_form/js/jquery-1.10.2.js"></script>

<script>
$(function() {
	
	$('#terms_start_date').datepicker();
	$('#terms_end_date').datepicker();
	
});
</script>
		      
      <div class="content-wrapper" style="margin: 0 10px;min-height:auto;">
	  
        <!--Content Wrapper-->
		<!--Horisontal Dropdown-->
        <nav class="cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">
         
        </nav>
        
        <!--Breadcrumb-->
        <div class="breadcrumb clearfix">
          <ul>
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="<?php echo site_url( "etab/etab_terms");?>">Etab</a></li>
            <li> <a href="<?php echo site_url( "etab/etab_terms");?>">Terms</a> </li>
			<li class="active">New</li>
          </ul>
        </div>
        <!--/Breadcrumb-->
        
       
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">                        
	
          
          <!-- New widget -->
          <div class="col-md-6  bootstrap-grid">
            <div class="powerwidget" data-widget-editbutton="false">
              <header>
                <h2> Create <small> Terms </small></h2>
              </header>
              <div class="inner-spacer">
                <form action="" class="orb-form">
				<table class="table">
					<tr>
						<td colspan="2"> 
							<fieldset>
								<section>
								  <label class="label"> Name </label>
								  <label class="input">
									<input type="text" name="term_name">
								  </label>
								</section>
							  </fieldset>
						</td>
						
					</tr>
					<tr>
						<td>
						 <fieldset>
							<section>
							  <label class="label"> Start Date </label>
							  <label class="input">
								<input type="text" name="terms_start_date" id="terms_start_date">
							  </label>
							</section>
						  </fieldset>
							
						</td>
						<td>
						 <fieldset>
							<section>
							  <label class="label"> End Date </label>
							  <label class="input">
								<input type="text" name="terms_end_at" id="terms_end_date">
							  </label>
							</section>
						  </fieldset>
						
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<fieldset>
								<section>
								  <label class="label">Description</label>
								  <label class="textarea">
									<textarea rows="3" name="terms_description"></textarea>
								  </label>
								</section>
							</fieldset>
						</td>
						
					</tr>
					
					
					
				</table>
                  
				  
				   
				  
				  
				   
            
                  
               
              
				  
				  
       
				  
				  
                  <footer>
                    <button type="submit" class="btn btn-default">Submit</button> <a style="color:#fff;" class="btn btn-default" href="<?php echo site_url( "etab/etab_terms");?>">Cancel</a>
                  </footer>
                </form>
              </div>
            </div>
          </div>
          <!-- End .powerwidget --> 
            
            
          </div>
          <!-- /Inner Row Col-md-12 --> 
        </div>
        <!-- /Widgets Row End Grid--> 
      </div>
      <!-- / Content Wrapper --> 
	  

