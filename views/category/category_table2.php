<div class="col-md-7 bootstrap-grid sortable-grid ui-sortable main-table">
<div class="callout callout-info" id = 'header-validation' style="display: none" > Data Inserted Successfully </div>
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
      <td><?php echo $val->weightage."%".""; ?></td>
      <?php if($val->is_fix == '0')  {?>
        <?php $fix = 'No' ; ?>
      <?php } elseif($val->is_fix == '1') { ?>
        <?php $fix = 'Yes';  }?>
      <td><?php echo $val->$fix; ?></td>
      <td><a href='JavaScript:void(0)' id="<?php echo $val->id ?>" class='update-link'><button class='btn btn-primary btn-style'>Edit</button></a></td>
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

<style type="text/css">
  .btn-style{
    padding: 5px 12px;
    background-color: #993838;
  }
</style>

<script type="text/javascript">
  if ($('#assessment_grade_table').length) {
        var oTable = $('#assessment_grade_table').dataTable({
            "oLanguage": {
                "sSearch": "Search all columns:"                        
            },
            
            //"sDom": '<"search"fTlp><"bottom"><"clear">lrtip',
            "sDom": 'T<"clear">lfrtip',
            tableTools: {
                "sSwfPath": "<?php echo base_url()?>components/js/swf/copy_csv_xls_pdf.swf"
            },
            "bProcessing": true,
            //"bServerSide": true,
            "sScrollX": "100%",
            "bScrollCollapse": true,
            "iDisplayLength": 35,
            "sResponsive": true,
            "jQueryUI": true,
             "aaSorting" : [[0, 'desc']]
 
        });                

        $("tfoot input").keyup(function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, $("tfoot input").index(this));
        });


        $("tfoot input").each(function (i) {
            var asInitVals = new Array();
            asInitVals[i] = this.value;
        });

        $("tfoot input").focus(function () {
            if (this.className == "search_init") {
                this.className = "";
                this.value = "";
            }
        });

        $("tfoot input").blur(function (i) {
           var asInitVals = new Array();
            if (this.value === "") {
                this.className = "search_init";
                this.value = asInitVals[$("tfoot input").index(this)];
            }
        });
                
           }

       $(document).on('click','.update-link',function(){
            var id = $(this).attr('id');
            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>index.php/category/category_ajax/edit/"+id,
                cache:false,
                datatype:"html",
                success:function(n)
                {
                    $('#edit-category').html(n);
                }

            });
        });

        $(document).ready(function(){
          $('#header-validation').css('display','');
          $('#header-validation').fadeOut(5000);
        });      
</script>