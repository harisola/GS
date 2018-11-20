<div id = 'tableUpdate'>
<div class="col-md-7 bootstrap-grid sortable-grid ui-sortable main-table">
 <div class="powerwidget marine " id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
  <header role="heading">
    <h2>Assessment Grade<small>Detail</small></h2>
    <div class="powerwidget-ctrls" role="menu">
     <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
     <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
    </div>
    <span class="powerwidget-loader"></span>
  </header>
    <div class="inner-spacer" role="content">
    <!--Button of copy,CSV,excel,PDF,Print -->
     <table class="table table-striped table-hover dataTable" id="assessment_grade_table" >

<thead>
<tr role="row">
 <th class="centered-cell" style="width: 15px; text-align: center !important;">S.No</th>
 <th class="centered-cell" style="width: 20px;">Grade</th>
 <th class="centered-cell" style="width: 20px;">Category Name</th>
 <th class="centered-cell" style="width: 10px;">Weightage</th>
 <th class="centered-cell" style="width: 10px;">Is Fix</th>
 <th class="centered-cell" style="width: 10px;">Edit</th>
</tr>
</thead>

<tbody>
      <?php if(!empty($category_detail)) {?>
       <?php foreach($category_detail as $val) {?>
      <tr style="text-align: center;">
      <td class="centered-cell"><?php echo $val->id; ?></td>
      <td><?php echo $val->grade_id; ?></td>
      <td><?php echo $val->assessment_category_id; ?></td>
      <td><?php echo $val->weightage."%"; ?></td>
      <?php if($val->is_fix == '0')  {?>
        <?php $fix = 'No' ; ?>
      <?php } elseif($val->is_fix == '1') { ?>
        <?php $fix = 'Yes';  }?>
      <td><?php echo $fix; ?></td>
      <td><a href='JavaScript:void(0)' id="<?php echo $val->id ?>" class='edit-link'><button class='btn btn-primary btn-style'>Edit</button></a></td>
      </tr>
      <?php } ?>
     <?php } ?> 

</tbody>

<tfoot>
  <tr>
    <th rowspan="1" colspan="1" style="width: 57.997px;"><input type="text" name="filter_sno" placeholder="Filter SNo" class="search_init">
    </th>
     <th rowspan="1" colspan="1" style="width: 57.997px;"><input type="text" name="filter_sno" placeholder="Filter Grade" class="search_init">
    </th>
    <th rowspan="1" colspan="1" style="width: 39.997px;"><input type="text" name="filter_gsid" placeholder="Filter Category" class="search_init">
    </th>
    <th rowspan="1" colspan="1" style="width: 50.997px;"><input type="text" name="filter_formno" placeholder="Filter Weightage" class="search_init">
    </th>
    <th rowspan="1" colspan="1" style="width: 45.997px;"><input type="text" name="filter_grno" placeholder="Filter Is Fix" class="search_init">
    </th>

   
  </tr>
</tfoot>

</table>
</div>

</div>
</div>
</div>

<style type="text/css">
  .btn-style{
    padding: 5px 12px;
    background-color: #993838;
  }
</style>