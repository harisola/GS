<div id="powerwidgets">
  <div class="col-md-12 col-xs-12">
   <div class="powerwidget dark-red"  data-widget-deletebutton="false" data-widget-editbutton="false">
    <header>
     <h2>Assessment Category<small>Grade</small></h2>
    </header>
    <div class="inner-spacer">
    	<table class="table table-striped table-bordered table-hover tg">
    	 <thead>
    	  <tr>
    	  	<th class="centered-cell">Grade</th>
    	  	<th class="centered-cell">Formative</th>
    	  	<th class="centered-cell">Summative</th>
    	  	<th class="centered-cell">ASP(Attendance)</th>
          <th class="centered-cell">ASP(Stationary)</th>
          <th class="centered-cell">ASP(PTM)</th>
    	  	<th class="centered-cell">Total</th>
    	  </tr>	
    	 </thead>
    	 <tbody>
      
    	 	<?php foreach($grade as $value) { ?>

          <tr>

    	 		<td class="centered-cell"><b><?php echo $value->name ?></b></td>

          <?php $total = 0; ?>
          <?php $count = 0; ?>

          <?php foreach($category as $cat)  { ?>

            <?php $found = 0; ?>
             

            <?php foreach($category_grade as $cat_grade) { ?>

              <?php if($cat_grade->grade_id == $value->id && $cat_grade->assessment_category_id == $cat->id )  { ?>

                <td class="centered-cell aneditable_weightage"><a href="javascript:void(0)" data-type="select" data-pk="<?php echo $cat_grade->id ?>" data-name="weightage" data-grade="<?php echo $value->id ?>" data-category="<?php echo $cat_grade->assessment_category_id?>"><?php echo $cat_grade->weightage ?></a></td>
                
                <!-- If Data Found In a Database -->
                <?php $found = 1; ?>

                <!--  Total Formula for Weightage  -->
                <?php $total = (int)$cat_grade->weightage + $total;  ?>

                <!-- Increasing Count For Condition count == 3 -->
                <?php  $count++; ?>

                <?php if($count == 5)  { ?>
                  <?php if($total == 100) { ?>
                  <td class="centered-cell" data-gradeid="<?php echo $value->id ?>"  ><b style="color: green;"><?php echo $total; ?></b></td>
                  <?php } else {?>
                   <td class="centered-cell" data-gradeid="<?php echo $value->id ?>" ><b style="color: red;"><?php echo $total; ?></b></td> 
                  <?php }?>

                <?php } ?>
                
                <!-- End IF Condition -->
              <?php } ?>

              <!-- End For Loop of Category Grade -->
            <?php } ?>


            <!-- IF Data Not Found In Database -->
            <?php if($found == 0) { ?>
              
              <td class="centered-cell insertable_weightage"><a href="javascript:void(0)" data-type="select" data-pk='1' data-grade="<?php echo $value->id ?>" data-category="<?php echo $cat->id ?>" data-name="weightage">Empty</a></td>

              <!-- Total is 0 in Empty Column -->
              <?php $total = $total + 0; ?>
              
              <!-- Increasing Count for count==3 -->
              <?php $count++; ?>

              <?php if($count == 5) { ?>
                <?php if($total == 100) { ?>
                <td class="centered-cell" data-gradeidempty="<?php echo $value->id ?>"><b style="color: green"><?php echo $total; ?></b></td>
                <?php } else { ?>
                <td class="centered-cell" data-gradeidempty="<?php echo $value->id ?>"><b style="color: red"><?php echo $total; ?></b></td>
                <?php } ?>
              <?php } ?>

              <!-- End If Condition if found == 0  -->
            <?php } ?>

            <!-- End For each of  Category  -->
          <?php } ?>
          </tr>

          <!-- End Foreach OF Grade -->
    	 	<?php } ?>

    	 </tbody>
    	</table>
    </div>
   </div>
  </div>
</div>