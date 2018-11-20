<div id="tableUpdate">

<div class="col-md-8 bootstrap-grid sortable-grid ui-sortable main-table">
 <div class="powerwidget dark-red powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
  <header role="heading">
    <h2>Assestment Year<small>Detail</small></h2>
    <div class="powerwidget-ctrls" role="menu">
     <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
     <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
    </div>
    <span class="powerwidget-loader"></span>
  </header>
    <div class="inner-spacer" role="content">
    <!--Button of copy,CSV,excel,PDF,Print -->
     <table class="table table-striped table-hover dataTable" id="assessment_term_view_table" >
     
      
      
<thead>
<tr role="row">
 <th class="centered-cell" style="width: 15px; text-align: center !important;">S.No</th>
 <th class="centered-cell" style="width: 20px;">Name</th>
 <th class="centered-cell" style="width: 20px;">Display Name</th>
 <th class="centered-cell" style="width: 10px;">Short Name</th>
 <th class="centered-cell" style="width: 10px;">Action</th>
 

</tr>
</thead>

<tbody>
  <?php if( !empty( $query ) ) { ?> 
    <?php foreach ($query as $val) { ?>
      <tr style="text-align: center;">
      <td class="centered-cell"><?php echo $val['id']; ?></td>
      <td><?php echo $val['name']; ?></td>
      <td><?php echo $val['dname']; ?></td>
      <td><?php echo $val['sname']; ?></td>
      <td><a href='JavaScript:void(0)' id="<?php echo $val['id']; ?>" class='edit-link'>Edit</a><!-- |<a href='JavaScript:void(0)' id="<?php echo $val['id']; ?>" class='delete-link'>Delete</a> --></td>
      </tr>
    <?php } ?>
  <?php } ?>
  
</tbody>

<tfoot>
  <tr>
    <th rowspan="1" colspan="1" style="width: 57.997px;"><input type="text" name="filter_sno" placeholder="Filter SNo" class="search_init">
    </th>
    <th rowspan="1" colspan="1" style="width: 39.997px;"><input type="text" name="filter_gsid" placeholder="Filter Assessment" class="search_init">
    </th>
    <th rowspan="1" colspan="1" style="width: 50.997px;"><input type="text" name="filter_formno" placeholder="Filter Display" class="search_init">
    </th>
    <th rowspan="1" colspan="1" style="width: 45.997px;"><input type="text" name="filter_grno" placeholder="Filter ShortName" class="search_init">
    </th>
   
  </tr>
</tfoot>

</table>
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

