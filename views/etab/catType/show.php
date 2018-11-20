<div id="createdCategories2">
<div id="createdCategories">
		<!-- Display Category  -->
            <div class="col-md-6 bootstrap-grid">
            <div class="powerwidget" data-widget-editbutton="false">
              <header>
                <h2>Category<small>List</small></h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover diplayCategory2" id="diplayCategory2">
                  <thead>
                    <tr>
					<th> Category </th>
                      <th>Category Type </th>
                      <?php /* ?><th>Sub Category </th>
                      <th>Short Name</th>
                      <th>Weightage</th><?php */ ?>
                      <th> Action </th>
                    </tr>
                  </thead>
				  <tfoot>
            <tr>
                <th colspan="">Category</th>
                
              
            </tr>
        </tfoot>
                  <tbody>
                    <?php if(!empty($mainCatSub) ){ ?>
					<?php foreach($mainCatSub as $cat ): ?>
					<tr>
						<td> <?=$cat['cat_name'];?> </td>
						<td> <?=$cat['name'];?> </td>
						
					   <td> 
					   <a href="#" id="<?=$cat['ass_type_id'];?>" class="link_edit"> Edit </a> | 
					   <?php 
					   if( $cat['block'] == 1 ){?>
						   <a href="#" id=""> Assigned </a> 
					   <?php }else{?>
						   <a href="#" class="link_remove" id="<?=$cat['ass_type_id'];?>"> Remove </a> 
					   <?php } ?>
					   
					   
					   </td>
						</tr>
					<?php endforeach; ?>
					<?php }else{ ?>
					
					<tr>
					  <td>No Record Found!</td>
					  <td></td>
					  <td></td>
					  <td></td>
					 
					</tr>
					
					<?php } ?>
                   
                  </tbody>
                 
                </table>
              </div>
            </div>
            <!-- End .powerwidget --> 
            </div> 
          </div>
          <!-- /Inner Row Col-md-12 --> 
        </div>
        <!-- /Widgets Row End Grid--> 
      </div>
      <!-- / Content Wrapper --> 
	  

</div>