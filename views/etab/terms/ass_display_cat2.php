<div id="createdCategories">
		<!-- Display Category  -->
            <div class="col-md-6 bootstrap-grid">
            <div class="powerwidget" id="datatable-basic-init" data-widget-editbutton="false">
              <header>
                <h2>Datatable<small>Basic Init</small></h2>
              </header>
              <div class="inner-spacer">
                <table class="table table-striped table-hover" id="diplayCategory">
                  <thead>
                    <tr>
                       <th> Category Name </th>
                      <th> Display Name </th>
                      <th> Short Name </th>
                      <th> Weightage </th>
					 <th> Action </th>		
                    </tr>
                  </thead>
                  <tbody>
					<?php if(!empty($categories) ){ ?>
					<?php foreach($categories as $cat ): ?>
					<?php // for($a=1;$a<15;$a++){ ?>
					 <tr>
                      <td> <?=$cat->name;?> </td>
                      <td> <?=$cat->dname;?> </td>
					  <td> <?=$cat->sname;?> </td>
					  <td> <?=$cat->weightagename;?> </td>
                      <td> <a href="#" id="<?=$cat->id;?>" class="link_edit"> Edit </a> | <a href="#" class="link_remove" id="<?=$cat->id;?>"> Remove </a>

<!-- set up the modal to start hidden and fade in and out -->
<div id="btnDelete" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- dialog body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        Hello world!
      </div>
      <!-- dialog buttons -->
      <div class="modal-footer"><button type="button" class="btn btn-primary">OK</button></div>
    </div>
  </div>
</div>

				  </td>
                    </tr>
					<?php // } ?>
					<?php endforeach; ?>
					
					<?php }else{ ?>
						<tr>
							<td colspan="5">No Record Found! </td>
						</tr>
					<?php } ?>
                    
					
                 </tbody>
                </table>
              </div>
            </div>
            <!-- End .powerwidget --> 
            </div> 
          </div>
          <!-- /Inner Row Col-md-12 --> 
        </div>
        <!-- /Widgets Row End Grid--> 
      </div>
      <!-- / Content Wrapper --> 
	  
 <script>
   $(document).ready(function() {
     if ($('#diplayCategory').length) {
                var oTable = $('#diplayCategory').dataTable({
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
			
			
			$(".link_edit").click(function(){
	var linkID = $(this).attr('id');
	$.ajax({
		url : "<?php echo base_url(); ?>index.php/automcomplete/autocomplete/getSingleCat/"+linkID,
		dataType: "html",
		success: function(data){
			//alert(data)
			$('#editCategory').html(data);
			//$('#diplayCategory tbody').prepend(data);
		}

	});

});


$(".link_remove").click(function(){
		
	var linkID = $(this).attr('id');
	//alert(linkID);
	var agree= confirm("Are you sure you want to delete this file?");
	//alert(agree);
	if (agree){
			  $.ajax({
				url : "<?php echo base_url(); ?>index.php/automcomplete/autocomplete/removeCat/"+linkID,
				dataType: "html",
				success: function(data){
					  $.ajax({
						 type: "POST",
						 url : "<?php echo base_url(); ?>index.php/automcomplete/autocomplete/getCreatedCategories",
						 dataType: "html",
						 success: function(data){
							$('#createdCategories2').html(data);
						  }

					 });
				}//
				

			});
		}else{
			return false;
		} 
	

	
  }); 
  

		
   });
</script>