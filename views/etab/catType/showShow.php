<div id="createdCategories">
<!-- Display Category  -->
<div class="col-md-6 bootstrap-grid">
<div class="powerwidget" data-widget-editbutton="false">
  <header>
	<h2>Category<small>List</small></h2>
  </header>
  <div class="inner-spacer">
	<table class="table table-striped table-hover diplayCategory2" id="diplayCategory2">
	  <thead>
		<tr>
		<th> Category </th>
                      <th>Category Type </th>
                        <?php /* ?>  <th>Sub Category </th>
                   <th>Short Name</th>
                     <th>Weightage</th><?php */ ?>
                      <th> Action </th>
		</tr>
	  </thead>
	  <tfoot>
            <tr>
                <th colspan="">Category</th>
                
              
            </tr>
        </tfoot>
	  <tbody>
		<?php if(!empty($mainCatSub) ){ ?>
		<?php foreach($mainCatSub as $cat ): ?>
		<?php //for($a=1;$a<5;$a++){ ?>
				<tr>
						<td> <?=$cat['cat_name'];?> </td>
						<td> <?=$cat['name'];?> </td>
						
					   <td> 
					   <a href="#" id="<?=$cat['ass_type_id'];?>" class="link_edit"> Edit </a> | 
					   <?php 
					   if( $cat['block'] == 1 ){?>
						   <a href="#" id=""> Assigned </a> 
					   <?php }else{?>
						   <a href="#" class="link_remove" id="<?=$cat['ass_type_id'];?>"> Remove </a> 
					   <?php } ?>
					   
					   
					   </td>
						</tr>
		<?php // } ?>
		<?php endforeach; ?>
		<?php }else{ ?>
		
		<tr>
		  <td>No Record Found!</td>
		  <td></td>
		  <td></td>
		  
		</tr>
		
		<?php } ?>
	   
	  </tbody>
	 
	</table>
  </div>
</div>
<!-- End .powerwidget --> 
</div> 
</div>



<script>

  /* $(document).ready(function() {
  if ($('#diplayCategory2').length) {
	var oTable = $('#diplayCategory2').dataTable({
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
		"iDisplayLength": 10,
		"sResponsive": true
	});                

   
}

		

		
   });
   */
  
$(document).ready(function() {
    $('.diplayCategory2').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value="">Category</option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} ); 
</script>
