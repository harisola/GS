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
     <table class="display table table-striped table-hover dataTable" id="assessment_term_view_table2" >
     
       
        
<thead >
<tr role="row">
 <th class="centered-cell"  style="width: 15px;">S.No</th>
 <th class="centered-cell"  style="width: 20px;">Name</th>
 <th class="centered-cell"  style="width: 20px;">Display Name</th>
 <th class="centered-cell"  style="width: 10px;">Short Name</th>
 <th class="centered-cell"  style="width: 10px;">Action</th>
 

</tr>
</thead>

<tbody>
  <?php if( !empty( $query) ) { ?> 
    <?php foreach ($query as $val) {?>
      <tr style="text-align: center;">
      <td><?php echo $val['id']; ?></td>
      <td><?php echo $val['name']; ?></a></td>
      <td><?php echo $val['dname']; ?></a></td>
      <td><?php echo $val['sname']; ?></a></td>
      <td><a href='JavaScript:void(0)' id="<?php echo $val['id']; ?>" class='edit-link'>Edit</a><!-- | <a href='JavaScript:void(0)' id="<?php echo $val['id']; ?>" class='delete-link'>Delete</a> --></td>
      
    
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
<script type="text/javascript">

///////////////////////////////////
//         Edit                 //
//////////////////////////////////
$('.delete-link').click(function(){
    var link = $(this).attr('id');
    var agree = confirm('Are you sure to delete this file');
    if(agree)
    {
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/term/getpost/getdelete/"+link,
        datatype:"html",
        success:function(resposeedit)
        {
            
                
            
           
            $('#tableUpdate').html(resposeedit);
           
            
        },
        error:function (){
            alert('Cannot be deleted use some other table also');
           }
        //$('#editTerm').html(resposeedit);
    });
    }
    else
    {
        return false;
    }
});

$('.edit-link').click(function(){
    var link = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "<?php echo base_url(); ?>index.php/term/getpost/getid/"+link,
        datatype:"html",
        success:function(resposeedit)
        {
            
            $('#editTerm').html(resposeedit);
            
            
        }
        //$('#editTerm').html(resposeedit);
    });
});

      if ($('#assessment_term_view_table2').length) {
                var oTable = $('#assessment_term_view_table2').dataTable({
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
                    "aaSorting" : [[0, 'desc']],



                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $('.aneditable_term_name a').editable({
                            type: 'text',
                            name: 'name',
                            title: 'Term Name',
                            url: '<?php echo base_url()?>index.php/assestment/term/edit',
                            
                            validate: function(value) {                               
                               if($.trim(value) == '') return 'This field is required';
                            }
                        });


                        $('.aneditable_term_dname a').editable({
                            type: 'text',
                            name: 'dname',
                            title: 'Term Display Name',
                            url: '<?php echo base_url()?>index.php/assestment/term/edit',
                            
                            validate: function(value) {                               
                               if($.trim(value) == '') return 'This field is required';
                            }
                        });


                        $('.aneditable_term_sname a').editable({
                            type: 'text',
                            name: 'sname',
                            title: 'Term Short Name',
                            url: '<?php echo base_url()?>index.php/assestment/term/edit',
                            
                            validate: function(value) {                               
                               if($.trim(value) == '') return 'This field is required';
                               if(value.length <3 || value.length > 3) return '3 characters code allowed';
                            }
                        });
                    }

                    
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
                    if (this.value === "") {
                        this.className = "search_init";
                        this.value = asInitVals[$("tfoot input").index(this)];
                    }
                });
                
            };


</script>