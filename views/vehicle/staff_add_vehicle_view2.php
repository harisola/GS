 <div class="col-md-7 bootstrap-grid sortable-grid ui-sortable">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget marine powerwidget-sortable" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>New Vehile Registration<small>Detail</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="new_admission_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
        <!-- <div class="ColVis"><button class="ColVis_Button ColVis_MasterButton"><span>Show / hide columns</span></button></div> -->

          <table class="display table table-striped table-hover dataTable" id="vehicle_change_form_table2" aria-describedby="class_list_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="ID: activate to sort column descending" style="width: 15px;">ID</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GV ID: activate to sort column ascending" style="width: 100px;">Gv id</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Van Number: activate to sort column ascending" style="width: 120px;">Van Number</th>
                 <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Register Type: activate to sort column ascending" style="width: 120px;">Register type</th>
                 <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Name Code: activate to sort column ascending" style="width: 85px;">Name code</th>
                 <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Registration No: activate to sort column ascending" style="width: 120px;">Registration No</th>
                <th class="sorting centered-cell" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Is Active: activate to sort column ascending" style="width: 85px;">Is Active</th>
               
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_call_name" placeholder="Filter ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_photo" placeholder="Filter GV ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_abridged_name" placeholder="Filter Van Number" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Register Type" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_official_name" placeholder="Filter Name Code" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dob" placeholder="Filter Registration No" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_grade_section" placeholder="Filter Is Active" class="search_init"></th>
               
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          
          <?php
     foreach($this->vehicle_registration_model->gettablevehicle() as $row) 
    {
      ?>
      <tr>
      
   <td class="centered-cell"><a href="#" data-id="<?=$row->id; ?>" class="vehicalID"><?=$row->id; ?></a></td>
   <td class="centered-cell"><?=$row->gv_id; ?></td>
   <td class="centered-cell aneditable_van_number"><a href="#" data-type="text" data-name="van_number" data-pk="<?php echo $row->id; ?>" data-placement="top"><?php echo $row->van_number; ?></a></td>
    <td class="centered-cell"><?php echo$row->register_type; ?></td>
     <td class="centered-cell"><?php echo $row->name_code; ?></td>
      <td class="centered-cell"><?php echo $row->registration_no; ?></td>
      <td class="centered-cell"><?php echo $row->is_active; ?></td>
      </tr>
          <?php
      }
       ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


      <script>


            var oTable = $('.dataTable').dataTable({
				
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


                    "fnRowCallback": function (nRow, aData, iDisplayIndex, iDisplayIndexFull) {
                        $('.aneditable_van_number a').editable({
                            type: 'text',
                            name: 'van_number',
                            title: 'Van Number',
                            url: '<?php echo base_url()?>index.php/vehicle/new_vehicle/printForm',
                            
                            validate: function(value) {                               
                               if($.trim(value) == '') return 'This field is required';
                               if(value.length > 6) return 'Maximum length 6 characters allowed';
                            }
                        });                      
                    }
                });                

                $("tfoot input").keyup(function () {
                    oTable.fnFilter(this.value, $("tfoot input").index(this));
                });


                $("tfoot input").each(function (i) {
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
           

</script>
      
      
    