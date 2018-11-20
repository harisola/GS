<div class='col-md-12'>
<div class="powerwidget dark-red"  data-widget-editbutton="false" data-widget-deletebutton="false" >
      <header>
        <h2>Subject Group<small>Detail</small></h2>  	
      </header>
      <div class="inner-spacer">
        <table class="table table-striped table-bordered table-hover" id='subject-group-table'>
        	<div class="row">
        		<div class='col-md-12'>
        			<div class='btn btn-primary btn-insert' data-toggle="modal" style="float: right; margin: 0px 0px 10px 0px;">Insert Record</div>
        		</div>
        	</div>
          <thead>
            <tr>
              <!-- <th width="55%" colspan="2">Game Name</th> -->
              <th class="centered-cell" >S.No</th>
              <th class="centered-cell">Name</th>
              <th class="centered-cell">Display Name</th>
              <th class="centered-cell">Short Name</th>
              <th class="centered-cell">Code</th>
              <th class="centered-cell">Position</th>
              <th class="centered-cell">Action</th> 
            </tr>
          </thead>
          <tbody>
            <?php if($table_data != Null) {?>
            	<?php foreach ($table_data as $value) { ?>
            <tr>
              <td class="centered-cell"><span class="num"><?php echo $value->id; ?></span></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->name;   	?></strong></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->dname; 	  ?></strong></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->sname;  	?></strong></td>
              <td class="centered-cell cell-style"><strong><?php echo $value->code;     ?></strong></td>
              <td class="centered-cell cell-style"><span class='num '><?php echo $value->position;?></span></td>
              <td class="centered-cell btn-edit" id="<?php echo $value->id ?>"><a href='javascript:void(0)'><button class='btn btn-primary'>Edit</button></a></td>
            </tr>
            	<?php } ?>
            <?php } ?>
          </tbody>
          <tfoot>
          </tfoot>
        </table>
      </div>
    </div>
</div>
<style type="text/css">
 code{
    font-size: 15px;
  }

  .table .num{
  background-color: #7F7C7C;
  color:#ffffff;
}
.cell-style{
color: #357ebd;
}

</style>
<script type="text/javascript">

            if ($('#subject-group-table').length) {
                var oTable = $('#subject-group-table').dataTable({
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
                
            }

            $('.btn-insert').on('click',function(){
            $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>index.php/program_group/subject_group_ajax/load_form",
            cache:false,
            datatype:"html",
            success:function(e)
            {
                $('#modal-body').html(e);
            }
        });

        $('#subject-group').modal('show');
    });
    $('.btn-edit').on('click',function(){
        $id = $(this).attr('id');
        $.ajax({
            type:"POST",
            url:"<?php echo base_url(); ?>index.php/program_group/subject_group_ajax/load_form_edit/"+$id,
            cache:false,
            datatype:"html",
            success:function(f)
            {
               $('#modal-body').html(f);
            }
        });

         $('#subject-group').modal('show');
    });

   

</script>