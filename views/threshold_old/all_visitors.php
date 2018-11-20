<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Visitors <small>today</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="class_list_view_table_wrapper" class="dataTables_wrapper form-inline" role="gs_id">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="threshold_all_visitors" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="No: activate to sort column descending" style="width: 15px;">No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Time In: activate to sort column ascending" style="width: 100px;">Time In</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Time Out: activate to sort column ascending" style="width: 100px;">Time Out</th>
                <!-- <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Duration: activate to sort column ascending" style="width: 100px;">Duration</th> -->
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="In School: activate to sort column ascending" style="width: 100px;">In School</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Visitor Type: activate to sort column ascending" style="width: 100px;">Visitor Type</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Card No: activate to sort column ascending" style="width: 100px;">Card No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Visitor: activate to sort column ascending" style="width: 100px;">Visitor</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Name: activate to sort column ascending" style="width: 100px;">Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mobile Phone: activate to sort column ascending" style="width: 100px;">Mobile Phone</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending" style="width: 100px;">Department</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="NIC: activate to sort column ascending" style="width: 100px;">NIC</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GF-ID: activate to sort column ascending" style="width: 100px;">GF-ID / Desc</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_no" placeholder="Filter No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_time_in" placeholder="Filter Time In" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_time_out" placeholder="Filter Time Out" class="search_init"></th>
                <!-- <th rowspan="1" colspan="1"><input type="text" name="filter_time_duration" placeholder="Filter Duration" class="search_init"></th> -->
                <th rowspan="1" colspan="1"><input type="text" name="filter_in_school" placeholder="Filter In School" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_visitor_type" placeholder="Filter Visitor Type" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_card_no" placeholder="Filter Card No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_visitor" placeholder="Filter Visitor" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mobile_phone" placeholder="Filter Mobile Phone" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_department" placeholder="Filter Department" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_nic" placeholder="Filter NIC" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_GFID" placeholder="Filter GF-ID / Desc" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';           
            $counter = 1;
            foreach($this->data['visitors'] as $visitor) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>            
            <tr class="<?php echo $class_odd_even; ?>">
              <?php 
                    $time_out_1 = "";
                    $time_out_2 = "";
                    $time_diff = "";

                    $datetime = explode(" ", unix_to_human($visitor->time_in));
                    $date = $datetime[0];
                    $time_in_1 = $datetime[1];
                    $time_in_2 = $datetime[2];

                    $datetime = explode(" ", unix_to_human($visitor->time_out));
                    if(strlen($visitor->time_out) > 5) {
                      $date = $datetime[0];
                      $time_out_1 = $datetime[1];
                      $time_out_2 = $datetime[2];                      
                      $time_diff = abs(strtotime($time_out_1) - strtotime($time_in_1));
                    }

                    $Description = '';
                    if(strlen($visitor->description) > 0 && strlen($visitor->description) <= 5){
                      $Description = str_pad($visitor->description, 6, '0', STR_PAD_LEFT);
                      $Description = substr($Description, 1, 2) . '-' . substr($Description, 3, 3);
                    }else{
                      $Description = $visitor->description;
                    }
              ?>
              <td class=" centered-cell sorting_1"><?php echo $counter; ?></td>
              <td class=" centered-cell"><?php echo $time_in_1 . " " . $time_in_2; ?></td>
              <td class=" centered-cell"><?php echo $time_out_1 . " " . $time_out_2; ?></td>              
              <td class=" centered-cell"><?php if(strlen($visitor->time_out) > 5){ echo "No";}else{ echo "Yes";} ?></td>
              <td class=" centered-cell"><?php echo $visitor->type_name; ?></td>
              <td class=" centered-cell"><?php echo $visitor->card_no; ?></td>
              <td class=" centered-cell"><?php echo $visitor->no_of_persons; ?></td>
              <td class=" centered-cell"><?php echo $visitor->name; ?></td>
              <td class=" centered-cell"><?php echo $visitor->mobile_phone; ?></td>
              <td class=" centered-cell"><?php echo $visitor->contact_department; ?></td>
              <td class=" centered-cell"><?php echo $visitor->nic; ?></td>
              <td class=" centered-cell"><?php echo $Description; ?></td>
            </tr>
          <?php $counter++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->
<!-- <td class=" centered-cell" style="background-color:#<?php echo $class_list['house_color_hex'];?>"><span style="background-color:#<?php echo $class_list['house_color_hex'];?>"><?php echo $class_list['house_dname']; ?></span></td>
-->