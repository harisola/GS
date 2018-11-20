<div id="createdCategories">
	
<style>
.anel-grey {
    border-color: #95a5a6;
}
.panel, .panel-heading, .panel-group .panel {
    border-radius: 0;
}
.panel-default{
	border:1px solid;
	border-color: #c4c5c5;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    
    
}
</style>

		<!-- Display Category  -->
            <div class="col-md-6 bootstrap-grid">
            <div class="powerwidget dark-red" data-widget-editbutton="false">
              <header>
                <h2>Assessment For Grade :  <?php echo $grade[0]->name;?> </h2>
              </header>
              <div class="inner-spacer">
			  
			  <div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-globe"></i> 
							<?php 
							if( !empty($subject)){
							echo $subject["dname"];
							}
							?></h3>
						</div>
						<div class="panel-body">
						<div class="row">
						<!--Striped Rows-->
						<div class="col-md-6">
							<div class="panel-default">
								<div class="panel-heading" style="background-color:#3b8dbd;">
									<h3 class="panel-title"><i class="fa fa-gear"></i>  <?php echo $categories[0]->name;?></h3>
								</div>
								<br />
								<table class="table table-bordered">
									
										<tr>
											<th>#</th>
											<th>Type</th>
											<th>Weightage </th>
										</tr>
									<tbody>
									<?php if( !empty($formmative) ){ ?>
										
										<?php $counter =1 ; 
										foreach( $formmative AS $a ){ ?>
										<tr>
											<td><?=$counter;?></td>
											<td><?=$a->name;?></td>
											<td><span class="badge"><?=$a->weightage;?></span></td>
										</tr>
										<?php $counter++; ?>
									<?php } ?>
									
									<?php }else{ ?>
										
										<tr>
											<td colspan="3"> No Assessment Created!</td>
											
										</tr>
									
									
									<?php } ?>
									
										
										
									</tbody>
								</table>
							</div>
						</div>
						<!--End Striped Rows-->

						<!--Hover Rows-->
						<div class="col-md-6">
							<div class="panel-default">
								<div class="panel-heading" style="background-color:#3b8dbd;">
									<h3 class="panel-title"><i class="fa fa-gear"></i> <?php echo $categories[1]->name;?></h3>
								</div>
								<br />
								<table class="table table-bordered">
									
										<tr>
											<th>#</th>
											<th>Type</th>
											<th>Weightage</th>
										</tr>
									
									<tbody>
									<?php if( !empty($summative) ){ ?>
										
										<?php $counter =1 ; 
										foreach( $summative AS $a ){ ?>
										<tr>
											<td><?=$counter;?></td>
											<td><?=$a->name;?></td>
											<td><span class="badge"><?=$a->weightage;?></span></td>
										</tr>
										<?php $counter++; ?>
									<?php } ?>
									
									<?php }else{ ?>
										
										<tr>
											<td colspan="3"> No Assessment Created!</td>
											
										</tr>
									
									
									<?php } ?>
										
									</tbody>
								</table>
							</div>
						</div>
						<!--End Hover Rows-->
					</div>
						
						</div>
					</div>
					
					
					
			  </div>
            </div>
            <!-- End .powerwidget --> 
            </div> 

		
		
        <!-- /Widgets Row End Grid--> 
      </div>
      <!-- / Content Wrapper --> 
	  

</div>


	
</div>

	  

