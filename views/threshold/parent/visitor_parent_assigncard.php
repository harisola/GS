<!-- Datatables View users -->
  <div class="col-md-6 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Students <small>Information</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="gs_id">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="threshold_assigncard_parent_student_table" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Abridged Name: activate to sort column descending" style="width: 15px;">Abridged Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Grade Section: activate to sort column ascending" style="width: 100px;">Grade Section</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 100px;">GS ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 100px;">Type</th>
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Photo: activate to sort column ascending" style="width: 100px;">Photo</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Visit: activate to sort column ascending" style="width: 100px;">Parent Visit</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="VisitOK: activate to sort column ascending" style="width: 100px;">Visit</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Abridged Name" class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Grade Section" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gsid" placeholder="Filter Type" class="search_init"></th>
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter Photo" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_visit" placeholder="Filter Visit" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_visit" placeholder="Filter VisitOK" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
		  
          <?php
		  if( !empty( $this->data['class_list_data'] ) ) :
		  
            $class_odd_even = 'even';           
            foreach( $this->data['class_list_data'] as $student) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1 "><?php echo $student['abridged_name']; ?></td>
              <td class=" centered-cell"><?php echo $student['grade_name'] . "-" . $student['section_name']; ?></td>
              <td class=" centered-cell"><?php echo $student['gs_id']; ?></td>
              <td class=" centered-cell"><?php echo $student['petitioner_type']; ?></td>


              <?php $GF_ID_Last = substr($student['gf_id'], -3);
                $GF_ID_First = substr($student['gf_id'], 0, strlen($student['gf_id'])-strlen($GF_ID_Last));
                if(strlen($GF_ID_First) == 1)
                {
                  $GF_ID_First = '0' . $GF_ID_First;
                }
                $GF_ID = str_pad($GF_ID_First, 2, '0', STR_PAD_LEFT) . "-" . str_pad($GF_ID_Last, 3, '0', STR_PAD_LEFT);
              ?>              

              
              <?php
              /*if(file_exists($this->data['student_150_photo_path'] . $student->gr_no . ".png")){
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
              <?php }*/?>



             <td class=" centered-cell">
               <div class="btn-group">                  
                    <button class="btn btn-danger show_student_information" data-toggle="modal" data-id="<?php echo $student['gr_no'];?>" name="parent_gfid" id="parent_gfid" value="<?php echo $GF_ID;?>"><?php echo $GF_ID;?></button>                  
               </div>
             </td>
             
             <?php if(strlen($student['alp_date'])>6) { ?>
                <td class=" centered-cell" style="background-color:#<?php echo $student['color_hex']; ?>"><?php echo $student['alp_date']; ?></td>
             <?php } else { ?>
                <td class=" " style="background-color:#FFBF00"></td>
             <?php } ?>
            </tr>
          <?php } ?>
		  <?php endif; ?>
		  
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->
<!-- <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><span style="background-color:#<?php echo $class_list['house_color_hex'];?>"><?php echo $class_list['house_dname']; ?></span></td>
-->