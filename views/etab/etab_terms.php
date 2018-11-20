    
      <div class="content-wrapper" style="margin: 0 10px;min-height:auto;">
    
        

        
        <div class="page-header">
          <h1>&nbsp; <a style="float:right;" href="<?php echo site_url( "etab/etab_terms/add");?>" class="btn btn-default"> Add New </a> </h1>
		 
        </div>
        
        <!-- Widget Row Start grid -->
        <div class="row" id="powerwidgets">
          <div class="col-md-12 bootstrap-grid">                        
            <!-- New widget -->
             <div class="powerwidget" id="datatable-filter-column" data-widget-editbutton="false">
			   <div class="inner-spacer">
                <table class="display table table-striped table-hover" id="table-1">
                  <thead>
                    <tr>
                      <th> Name</th>
                      <th> Start From </th>
                      <th> End </th>
                      <th> Action </th>
                      <th>  </th>
                    </tr>
                  </thead>
                  <tbody>
                
					<?php for($counter = 1; $counter<5; $counter++) { ?>
                    <tr>
                      <td>First Terms</td>
                      <td>August 201<?=$counter;?></td>
                      <td> May 201<?=$counter;?> </td>
					  <td> <a class="link" href="etab_terms/edit"> Edit </a> </td>
					  <td>  </td>
                    </tr>
					
					<?php } ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th><input type="text" name="filter_game_name" placeholder="Filter Game Name" class="search_init" /></th>
                      <th><input type="text" name="filter_publisher" placeholder="Filter Publisher" class="search_init" /></th>
                      <th><input type="text" name="filter_platform" placeholder="Filter Platform" class="search_init" /></th>
                      <th><input type="text" name="filter_genre" placeholder="Filter Genre" class="search_init" /></th>
                      <th><input type="text" name="filter_sales" placeholder="Filter Sales" class="search_init" /></th>
                    </tr>
                  </tfoot>
                </table>
				</div>
            </div>
            <!-- End .powerwidget -->             
          </div>
          <!-- /Inner Row Col-md-12 --> 
        </div>
        <!-- /Widgets Row End Grid--> 
    </div>
 <!-- / Content Wrapper --> 
	  
	  
<?php /* ?>	  
<!--Scripts--> 
<!--JQuery--> 
<script type="text/javascript" src="<?=base_url();?>Components/datatablesjs/vendors/jquery/jquery-ui.min.js"></script> 
<!--Datatables--> 
<script type="text/javascript" src="<?=base_url();?>Components/datatables/js/vendors/datatables/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="<?=base_url();?>Components/datatables/js/vendors/datatables/jquery.dataTables-bootstrap.js"></script> 
<script type="text/javascript" src="<?=base_url();?>Components/datatables/js/vendors/datatables/dataTables.colVis.js"></script> 
<script type="text/javascript" src="<?=base_url();?>Components/datatables/js/vendors/datatables/colvis.extras.js"></script> <?php */ ?>

