<div id='tableUpdate' >
<!-- Datatables View users -->
  <div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget dark-red powerwidget-sortable" id="" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Academic<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="new_admission_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
       <!--  <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class=" table table-striped table-hover dataTable" id="academic-term" >

            <thead>
              <tr role="row">
                <th class='centered-cell' style="width: 15px;">S.No</th>
                <th class='centered-cell' style="width: 100px;">Term Name</th>
                <th class='centered-cell' style="width: 100px;">Academic Session</th>
                <th class='centered-cell' style="width: 100px;">Date From</th>
                <th class='centered-cell' style="width: 100px;">Date To</th>
                <th class='centered-cell'>Is Active</th>
                <th class='centered-cell' style="width: 100px;">Edit</th>
                
              </tr>
            </thead>
            <tbody>
            <?php foreach($view as $val2) {?>
              <tr>
                <td class='centered-cell'><?php echo $val2->id; ?></td>
                <td class='centered-cell'><?php echo $val2->dname; ?></td>
                <td class='centered-cell'><?php echo $val2->name; ?></td>
                <td class="centered-cell"><?php echo $val2->date_from; ?></td>
                <td class='centered-cell'><?php echo $val2->date_to; ?></td>
                <td class='centered-cell'><?php echo $val2->is_active ?></td>
                <td class='centered-cell'><a href='JavaScript:void(0)' id='<?php echo $val2->id; ?>' class='edit-link'>Edit</a><!-- | <a href='JavaScript:void(0)' id='<?php echo $val2->id; ?>' class='delete-link'>Delete</a> --></td>
              </tr>
            <?php } ?>
            </tbody>
            <tfoot>
             <tr>
               <th><input type="text" name="filter_game_name" placeholder="Filter S.No" class="search_init" /></th>
               <th><input type="text" name="filter_publisher" placeholder="Filter Term" class="search_init" /></th>
               <th><input type="text" name="filter_platform" placeholder="Filter Academic" class="search_init" /></th>
               <th><input type="text" name="filter_genre" placeholder="Filter Date From" class="search_init" /></th>
               <th><input type="text" name="filter_sales" placeholder="Filter Date To" class="search_init" /></th>
              </tr>
          </tfoot>
           
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<div class="modal" id="delete-widget">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <div class="modal-body text-center">
        <p>Are you sure to delete this record</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" id="trigger-deletewidget-reset">Cancel</button>
        <button type="button" class="btn btn-primary" id="trigger-deletewidget">Delete</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog --> 
</div>
</div>
<!-- End of View users -->
