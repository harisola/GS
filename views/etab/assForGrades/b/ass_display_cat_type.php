<div id="createdCategories2">
<div id="createdCategories">
		<!-- Display Category  -->
            <div class="col-md-6 bootstrap-grid">
            <div class="powerwidget dark-red" data-widget-editbutton="false">
              <header>
                <h2>Assessment For Grade</h2>
              </header>
              <div class="inner-spacer">
			  <?php //var_dump($sessionAssessments); ?>
                <table class="table table-striped table-hover" id="diplayCategory">
                  <thead>
                    <tr>
                      <th>Session</th>
                      <th>Term</th>
                      <th>Grade</th>
                      <th>Program</th>
                      <th>Category</th>
					  <th>Category Type </th>
					  <!--th>Weighate</th>
					  <th>Action</th -->
                    </tr>
                  </thead>
                  <tbody>
				  <?php if(  !empty($sessionAssessments) ){?> 
					<?php foreach( $sessionAssessments as $ass ): ?>
					 <tr>
                      <td> <?=$ass->AcademicSession;?> </td>
					   <td> <?=$ass->Term;?> </td>
					   <td> <?=$ass->Grade;?> </td>
					    <td> <?=$ass->Subject;?> </td>
					   <td> <?=$ass->Category;?> </td>
					   <td> <?=$ass->CategoryType;?> </td>
					  
					   <td> <?=$ass->AssWeightage;?> </td>
                      
						
							<input type="hidden" value="<?=$ass->gradeID;?>" id="grade_<?=$ass->catID;?>" />
							<input type="hidden" value="<?=$ass->subjectID;?>" id="sub_<?=$ass->catID;?>" />
							<input type="hidden" value="<?=$ass->asID;?>" id="session_<?=$ass->catID;?>" />
							<input type="hidden" value="<?=$ass->trmID;?>" id="term_<?=$ass->catID;?>" />
							<input type="hidden" value="<?=$ass->catID;?>" id="cat_<?=$ass->catID;?>" />
						
						
					  <td> <a href="#" id="<?=$ass->catID;?>" class="link_edit"> Edit </a> | <a href="#" class="link_remove" id="<?=$ass->assID;?>"> Remove </a> </td>
                    </tr>
					<?php endforeach; ?>
				  <?php }else{ ?>
					 <tr>
                       <td> No Record  </td>
					   <td></td>
					   <td></td>
					   <td></td>
					   <td></td>
					   <td></td>
					   <td></td>
					   <!--td></td>
					  <td></td -->
                     </tr>
				  <?php }?>
                   
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