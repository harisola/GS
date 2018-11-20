<div class="col-md-8 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget dark-red powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">

        <h2>Academic<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div  class="dataTables_wrapper form-inline" role="grid">
       <!--  <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="academic-term2" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class='centered-cell' style="width: 15px;">S.No</th>
                <th class='centered-cell' style="width: 100px;">Term Name</th>
                <th class='centered-cell' style="width: 100px;">Academic Session</th>
                <th class='centered-cell' style="width: 100px;">Date From</th>
                <th class='centered-cell' style="width: 100px;">Date To</th>
                <th class='centered-cell'>Active</th>
                <th class='centered-cell' style="width: 10px;">Action</th>                
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
                <td class='centered-cell'><a href='JavaScript:void(0)' id="<?php echo $val2->id; ?>" class='edit-link'>Edit</a><!-- |<a href='JavaScript:void(0)' id="<?php echo $val2->id; ?>" class='delete-link'>Delete</a> --></td>
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
<!-- End of View users -->

<script type="text/javascript">

$('.edit-link').click(function(){
            var link = $(this).attr('id');
            $.ajax({
                type:"POST",
                url:"<?php echo base_url(); ?>index.php/term/getpost/edit_academic/"+link,
                cache:false,
                datatype:'html',
                success:function(responseedit)
                {
                    $('#editTerm').html(responseedit);
                }
            });
        });

$('.delete-link').click(function(){
  var link = $(this).attr('id');
  // var agree = confirm('Are you sure to delete this file');
  
 
    $('#delete-widget').modal('show');
        $('#trigger-deletewidget').on('click',function(e){
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>index.php/term/getpost/get_academic_delete/"+link,
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

        })

  
});

  if ($('#academic-term2').length) {
                var oTable = $('#academic-term2').dataTable({
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