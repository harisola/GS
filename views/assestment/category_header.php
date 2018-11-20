  <div class="col-md-4  bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-6 bootstrap-grid"> --> 
      
    <!-- Applicant Form -->
    
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Assessment<small>Category</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <form action="<?php echo site_url()?>/assestment/category_grade" id="category" class="orb-form" novalidate="novalidate" method="POST">
          <header>Assessment Category Form</header>
            <fieldset>
            <section>
              <label class="select">
                <select name="grade_id">
                  <option value="0" selected="" disabled="">Grade Name</option>
                  <?php foreach ($grade as $val) { ?>
                    <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                 <?php }  ?>
                  
                  
                </select>
                <i></i> </label>
            </section>
            <section>
              <label class="select">
                <select name="assessment_category_id">
                  <option value="0" selected="" disabled="">Category Name</option>
                  <?php foreach($category as $val1) {?>
                  <option value="<?php echo $val1['id']; ?>"><?php echo $val1['name']; ?></option>
                  <?php } ?>
                </select>
                <i></i> </label>
            </section>
           <section>
             <section>
               <label class="input"> <i style='color:#757575;' class="icon-append fa fa-question"></i>
                <input type="text" placeholder="Enter Weightage" name='weightage' />
                <b class="tooltip tooltip-bottom-right">Enter Weightage</b></label>
             </section>
            
            </fieldset>            
          <footer>
            <button type="submit" name="fo_new_admission_form_button" class="btn btn-orb-org">Submit</button>
          </footer>
        </form>
      </div>
    </div>
  </div>
  <!-- End of Applicant form -->