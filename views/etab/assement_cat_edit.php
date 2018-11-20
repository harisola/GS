		      
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
			<li><a href="<?php echo site_url( "etab/assessment");?>">Assessment</a></li>
            <li> <a href="<?php echo site_url("etab/assessment_category");?>"> Category </a> </li>
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
                <h2> Create <small> Category </small></h2>
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
									<input type="text" name="cat_name" value="Formative">
								  </label>
								</section>
							  </fieldset>
						</td>
						
					
						<td>
						 <fieldset>
							<section>
							  <label class="label"> Weightage </label>
							  <label class="input">
								<input type="text" name="cat_weightage" id="cat_weightage" value="40%">
							  </label>
							</section>
						  </fieldset>
							
						</td>
						
					</tr>
			
					
					
					
				</table>
                  
				  
				   
				  
				  
				   
            
                  
               
              
				  
				  
       
				  
				  
                  <footer>
                    <button type="submit" class="btn btn-default">Submit</button> 
					<a style="color:#fff;" class="btn btn-default" href="<?php echo site_url( "etab/assessment_category");?>">Cancel</a>
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
	  

