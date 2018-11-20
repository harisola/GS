<!-- Datatables View users -->
  <div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Term<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="new_admission_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="category-grade" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="descending" aria-label="SNo: activate to sort column descending" style="width: 15px;">S.No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 100px;">Grade Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Form No: activate to sort column ascending" style="width: 100px;">Category Name</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GR No: activate to sort column ascending" style="width: 100px;">Weightage</th>  
              </tr>
            </thead>
            <tbody>
            <?php foreach($value as $val2) {?>
              <tr>
                <td class='centered-cell'><?php echo $val2['id']; ?></td>
                <td class='centered-cell'><?php echo $val2['grade']; ?></td>
                <td class='centered-cell'><?php echo $val2['category']; ?></td>
                <!-- <td class=" aneditable_df centered-cell"><a href="#" id="dob" data-type="combodate" data-name="date_from" data-pk="<?php $val2['date_from']; ?>" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D / MMM / YYYY" data-pk="<?php $val2['id']; ?>" data-title="Select Date From" class="editable editable-click" data-original-title="" title=""><?php echo $val2['date_from']; ?></a></td> -->
                <!-- <td class='centered-cell'><?php echo $val2['date_from']; ?></td> -->
               <!--  <td class='centered-cell'><?php echo $val2['weightage']; ?></td> -->
                 <td class="aneditable-weightage centered-cell"><a href="#" data-type="text" data-name="weightage" data-pk="<?php echo $val2['id']; ?>" data-placement="top"><?php echo $val2['weightage']; ?></a></td>
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