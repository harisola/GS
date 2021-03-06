<!-- Datatables View users -->
  <div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?>" id="datatable-filter-column-alumni" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Students<small>Generation's School</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="alumni_students_visit_today" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="GS ID: activate to sort column descending" style="width: 15px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GR No: activate to sort column ascending" style="width: 100px;">Gr No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 100px;">Photo</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Abridged Name: activate to sort column ascending" style="width: 100px;">Abridged Name</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grno" placeholder="Filter GRNo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter Photo" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>                
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';           
            foreach($this->attendance['students'] as $student) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?> mainRow">
              <td class=" sorting_1"><input type="button" value="<?php echo $student->gs_id; ?>" class="btn btn-default student_gsid"></td>
              <td class=" "><?php echo $student->gr_no; ?></td>
              <?php
              if(file_exists($this->data['student_150_photo_path'] . $student->gr_no . ".png")){
                $female_photo = $this->data['student_150_photo_path'] . $student->gr_no . ".png";
                $male_photo = $this->data['student_150_photo_path'] . $student->gr_no . ".png";
              }else{
                $male_photo = 'assets/photos/sis/150x150/male.png';
                $female_photo = 'assets/photos/sis/150x150/female.png';                
              }

              if($student->gender == 'G') 
              {?>
                <td class=" centered-cell"><img src="<?php echo base_url() . $female_photo; ?>" alt="" border=3 height=50 width=50></td>
              <?php }else{?>
                <td class=" centered-cell"><img src="<?php echo base_url() . $male_photo; ?>" alt="" border=3 height=50 width=50></td>
              <?php }?>
              
              <td class="abridged_name"><?php echo $student->abridged_name; ?></td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->
<!-- <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><span style="background-color:#<?php echo $class_list['house_color_hex'];?>"><?php echo $class_list['house_dname']; ?></span></td>
-->