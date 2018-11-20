    
      <div class="content-wrapper" style="margin: 0 10px;min-height:auto;">
    
        

        
        
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">                        
            
            <!-- New widget -->
            <div class="powerwidget" id="datatable-filter-column" data-widget-editbutton="false">
			
             
              <div class="inner-spacer">
              <div class="page-header">
                  <h3>Assessment</h3>
                </div>
				<div class="row">
                  <div class="col-md-12">
                    
                    
                    
                    <ul class="nav nav-tabs">
                      <li class="active"><a data-toggle="tab" href="#one-normal"> Assessment </a></li>
                      <!--li class=""><a data-toggle="tab" href="#two-normal">   Category </a></li>
                      <li class=""><a data-toggle="tab" href="#three-normal"> Type </a></li -->
                    </ul>
                    <div class="tab-content">
					
                      <div id="one-normal" class="tab-pane active">
					  <a style="float:right;" href="<?php echo site_url( "etab/assessment/add");?>" class="btn btn-default"> Add New </a> 
					  <hr />
						<table class="display table table-striped table-hover" id="table-1">
						  <thead>
							<tr>
							  <th> Name </th>
							  <th> Category </th>
							  <th> Weightage </th>
							  <th> Term </th>
							  <th> Action </th>
							 
							</tr>
						  </thead>
						  <tbody>
						
							
							<tr>
							<td> Practical </td>
							  <td>Formative</td>
							  <td>10%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							
							<tr>
							<td> Practical </td>
							  <td>Formative</td>
							  <td>10%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							
							<tr>
							<td> Name </td>
							  <td>Formative</td>
							  <td>10%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							<tr>
							<td> Name </td>
							  <td>Formative</td>
							  <td>15%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							
							<tr>
							<td> Name </td>
							  <td>Summative</td>
							  <td>20%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							
							<tr>
							<td> Name </td>
							  <td>Summative</td>
							  <td>20%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							
							<tr>
							<td> Name </td>
							  <td>ASP</td>
							  <td>5%</td>
							  <td> First Terms August/1/2015 to May/31/2016 </td>
							  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							  
							</tr>
							
							
						  </tbody>
						 
						</table>
					  </div> <!-- /end one-normal tab -->
					  
                      <div id="two-normal" class="tab-pane">
					   <div class="page-header">
						<h4> <small> Category</small> 	<a style="float:right;" href="<?php echo site_url( "etab/assessment_category");?>" class="btn btn-default"> Add New </a> </h4>
						</div>
						
						<table class="display table table-striped table-hover" id="table-2">
							<thead>
								<tr>
									<th> Name </th>
									<th> Final Weightage </th>
									<th> Action </th>
								</tr>
						     </thead>
						  <tbody>
						  
							<tr>
								<td>Summative</td>
								<td> 40% </td>
								 <td> <a class="link" href="assessment_category/edit"> Edit </a> </td>
							</tr>
							
							<tr>
								<td> Formative </td>
								<td> 55% </td>
								 <td> <a class="link" href="assessment_category/edit"> Edit </a> </td>
							</tr>
							
							<tr>
								<td> ASP </td>
								<td> 5% </td>
								 <td> <a class="link" href="assessment_category/edit"> Edit </a> </td>
							</tr>
							
						  </tbody>
						</table>
						
						
						
						
					  </div> <!-- /end category tab -->
					  
					  
                      <div id="three-normal" class="tab-pane">
					  
					  
						<h4> <small> Type </small> 	<a style="float:right;" href="<?php echo site_url( "etab/category/add");?>" class="btn btn-default"> Add New </a> </h4>
						<br />
						<table class="display table table-striped table-hover" id="table-2">
							<thead>
								<tr>
									<th> Name </th>
									<th> Weightage </th>
									<th> Parant Category </th>
									<th> Action </th>
								</tr>
						     </thead>
						  <tbody>
						  
							<tr>
								<td>Practical </td>
								<td> 20% </td>
								<td> Formative </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							
							
							<tr>
								<td>Assignment  </td>
								<td> 40% </td>
								<td> Formative </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							
							
							<tr>
								<td>Quiz </td>
								<td> 10% </td>
								<td> Formative </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							<tr>
								<td>Class Work </td>
								<td> 25% </td>
								<td> Formative </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							
							<tr>
								<td>Class Work II </td>
								<td> 70% </td>
								<td> Summative </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							<tr>
								<td>Class Work II </td>
								<td> 30% </td>
								<td> Summative </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							
							<tr>
								<td>Attendance </td>
								<td> 40% </td>
								<td> ASP </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							<tr>
								<td> PTM </td>
								<td> 30% </td>
								<td> ASP </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
							
							<tr>
								<td> Stationary </td>
								<td> 30% </td>
								<td> ASP </td>
								 <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
							</tr>
							
						  </tbody>
						</table>
					  </div> <!-- /end TYPE tab -->
                    </div>
                    
                    <!-- /tabs --> 
                    
                  </div>
                 
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


