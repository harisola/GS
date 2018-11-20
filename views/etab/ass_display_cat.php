<div id="createdCategories2">
<div id="createdCategories">

		<div class="col-md-6">
            <div class="powerwidget" data-widget-editbutton="false">
              <header>
                <h2> Category <small> List </small></h2>
              </header>
              <div class="inner-spacer">
			  
                <table class="table table-striped table-hover" id="diplayCategory">
                  <thead>
                    <tr>
                      <th> Category Name </th>
                      <th> Display Name </th>
                      <th> Short Name </th>
                      <th> Weightage </th>
					 <th> Action </th>		
                    </tr>
                  </thead>
                  <tbody>
                  <?php if(!empty($categories) ){ ?>
					<?php foreach($categories as $cat ): ?>
					<?php //for($a=1;$a<5;$a++){ ?>
					<tr>
                    <td> <?=$cat->name;?> </td>
                    <td> <?=$cat->dname;?> </td>
					<td> <?=$cat->sname;?> </td>
					<td> <?=$cat->weightagename;?> </td>
                   <td> <a href="#" id="<?=$cat->id;?>" class="link_edit"> Edit </a> | <a href="#" class="link_remove" id="<?=$cat->id;?>"> Remove </a> </td>
                    </tr>
					<?php // } ?>
					<?php endforeach; ?>
					<?php }else{ ?>
					<tr>
						<td colspan="5">No Record Found! </td>
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
        <!--/div-->
      </div>
</div>