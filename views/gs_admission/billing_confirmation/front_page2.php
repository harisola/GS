 <div class="absoluteDiv3">

                    	<!--<span class="filterTitle">Select Grade</span>-->
                     
                    	<dl class="dropdown">
                            <dt>
                            	<a href="#"><span class="hida">Select</span> <p class="multiSel" style="display:;"></p></a>
                            </dt><!-- dt -->
                            <dd>
                                <div class="mutliSelect">
                                    <ul>
                                        <li><input type="checkbox" value="All" name="All" id="All"/><label for="All">All Grades</label></li>
                                        <li><input type="checkbox" value="PN" name="PN" id="PN" /><label for="PN">PN</label></li>
                                        <li><input type="checkbox" value="N" id="N" name="PN" /><label for="N">N</label></li>
                                        <li><input type="checkbox" value="KG" name="KG" id="KG" /><label for="KG">KG</label></li>
                                        <li><input type="checkbox" value="I" name="I" id="I" /><label for="I">I</label></li>
                                        <li><input type="checkbox" value="II" name="II" id="II" /><label for="II">II</label></li>
                                        <li><input type="checkbox" value="III" name="III" id="III" /><label for="III">III</label></li>
                                        <li><input type="checkbox" value="IV" name="IV" id="IV" /><label for="IV">IV</label></li>
                                        <li><input type="checkbox" value="V" name="V" id="V" /><label for="v">V</label></li>
                                        <li><input type="checkbox" value="VI" name="VI" id="VI" /><label for="VI">VI</label></li>
                                        <li><input type="checkbox" value="VII" name="VII" id="VII" /><label for="VII">VII</label></li>
                                        <li><input type="checkbox" value="VIII" name="VIII" id="VIII" /><label for="VIII">VIII</label></li>
                                        <li><input type="checkbox" value="IX" name="IX" id="IX" /><label for="IX">IX</label></li>
                                        <li><input type="checkbox" value="X" name="X" id="X" /><label for="X">X</label></li>
										<li><input type="checkbox" value="XI" name="XI" id="XI" /><label for="XI">XI</label></li>
										<li><input type="checkbox" value="XII" name="XII" id="XII" /><label for="XII">A1</label></li>
                                    </ul><!-- ul -->
                                </div><!-- multiselect -->
                            </dd><!-- dd -->                          
                        </dl><!-- dl -->
					<form action="<?=base_url();?>index.php/gs_admission/billing_confirmation/Search_Query" method="POST" name="fliter_issuance" id="fliter_issuance">
						<input type="hidden" name="gradeNameValidate" id="gradeNameValidate" value="" />
                        <input type="submit" class="greenBTN" value="Filter" id="issuance_fliter" name="issuance_fliter">
												<div style="margin-bottom: 0;margin-top: 0;min-height: 0;padding-bottom: 0;padding-top: 10px;display:none;height:27px;" id="ajaxloader">
  <img src="<?php echo base_url();?>/components/image/ajax-loader.gif">
</div>

                        </form>
                    </div><!-- absoluteDiv -->
                    <table id="billing_confirmation" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th class="text-center">Form #</th> 
                              <th class="text-center">Batch ID</th> 
                              <th >Applicant Name<br /><small>Concession Code</small></th>
                              <th class="text-left">Recievable</th>
                              <th class="no-sort">Payment Due Date<br /><small>Bill No.</small></th>
                              <th class="text-left no-sort">Amount Received<br /><small>Receiving Date</small></th>
                              <th class="text-center">GS-ID</th>
                              <th class="text-center">Admission Grade</th>
                              <th class="text-center no-sort">Status</th>
                          </tr>
                      </thead>
					  
					  <tfoot>
								<tr>
								<td colspan="8">Filter Grade</td>
								</tr>
								</tfoot>
								
                      <tbody> 
					  <?php 
					  if( !empty($billing_confirmation) ){
						  foreach($billing_confirmation as $bc ){ ?>
							<tr>
                              <td class="text-center"><?=$bc["form_no"];?></td>
                              <td class="text-center"><?=$bc["batch_id"];?></td>
                              <td><?=$bc["official_name"];?><br /><small><?=$bc["concession_code"];?></small></td>
                              <td class="text-left"><strong><?=$bc["receivable"];?></strong></td>
                              <td class="text-left"><?=$bc["bill_due_date"];?><br /><small><?=$bc["fee_bill_id"];?></small></td>
                              <td class="text-left"><strong><?=$bc["fee_received_amount"];?></strong><small><?=$bc["fee_received_date"];?></small></td>
                              <td class="text-center"><?=$bc["gs_id"];?></td>
                              <td class="text-center"><?=$bc["grade_name"];?></td>
                              <td class="text-center">
								<img src="<?=base_url();?>components/gs_theme/images/allocationIcon_active.png" title="Allocation" width="25" data-toggle="tooltip" data-placement="top" /> &nbsp; 
								<img src="<?=base_url();?>components/gs_theme/images/communicationIcon_active.png" title="Communication" width="23" data-toggle="tooltip" data-placement="top" /> &nbsp; 
								<img src="<?=base_url();?>components/gs_theme/images/FollowUpIcon.png" title="Follow Up" width="20" data-toggle="tooltip" data-placement="top" /></td>
                          </tr>
						  <?php }
					  }
						 ?>
                         
                      </tbody> 
                    </table><!-- StaffListing -->
               
<script>
$(document).ready(function(){
    


   $('#billing_confirmation').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select style="position: absolute;right: 348px;top: -41px;width: 250px;"><option value="">Filter Grade</option></select>')
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
	
	
	
	
	
$('#All').click(function (e) {
    $(this).closest('.mutliSelect').find('li input:checkbox').prop('checked', this.checked);
});
/*
	Dropdown with Multiple checkbox select with jQuery - May 27, 2013
	(c) 2013 @ElmahdiMahmoud
	license: http://www.opensource.org/licenses/mit-license.php
*/

$(".dropdown dt a").on('click', function() {
  $(".dropdown dd ul").slideToggle('fast');
});

$(".dropdown dd ul li a").on('click', function() {
  $(".dropdown dd ul").hide();
});

function getSelectedValue(id) {
 return $("#" + id).find("dt a span.value").html();
}



$('.mutliSelect input[type="checkbox"]').on('click', function() {

  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
    title = $(this).val() + ",";

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
   // $('.multiSel').append(html);
   // $(".hida").hide();
  } 
  else {	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hida");
	$(".hida").hide();
	$('.dropdown dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  $(".hida").html('');
		  $(".hida").show();
	  }
	  //else
	  //{
	//	  	$(".hida").show();
	//		$(".hida").html('Select');
	 // }
  } 
});


$('.mutliSelect input[type="checkbox"]').on('click', function() {
//  title = $(this).id + ",";
  var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
	  title = $(this).attr("id")+ ",";
	

var ID = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
	  ID = $(this).val();	
	  
	 


 
 

  if ($(this).is(':checked')) {
    var html = '<span title="' + title + '">' + title + '</span>';
    $('.multiSel').append(html);
	var appendHidden = '<input type="hidden" class="someElement" name="gradename[]" value="'+ID+'" id="grade_id_'+ID+'"  />';
	$('#fliter_issuance').append(appendHidden);
	
    $(".hida").hide();
	
  }else {
	  
	$('span[title="' + title + '"]').remove();
	var ret = $(".hida");
	$(".hida").hide();
	$('.dropdown dt a').append(ret);
	  if (!$(this).is(':checked')) {
		  
		  $(".hida").html('');
		  $(".hida").show();
	  }
	 
	  
	
	$("#grade_id_"+ID+"").remove();
  }
 
 
var count_hidden2 = $('.someElement:hidden').length;
var hiden_ele = parseInt(count_hidden2);
	
	if( hiden_ele == 0 ){
		$("#gradeNameValidate").val("");	
	}else{
		$("#gradeNameValidate").val("1");
	}
	
	
 /*if ($(this).is(':checked')) { 
	$('#fliter_issuance').append('<input type="hidden" name="gradename[]" value='+ID+' id='"grade_id_"+ID+'  />');
 }else{
	 $('#grade_id_'+ID)remove();
 } */ 
 
});



	});
</script>