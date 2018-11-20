<div class="absoluteDiv3">
					<form action="<?=base_url();?>index.php/gs_admission/admission_bill_mis/search_date_range" method="POST" name="issuance" id="issuance" class="issuance">
                        <input type="text" name="from_date" value="<?=$from_date;?>" class="rangeinput" /> to 
						<input class="rangeinput" name="to_date" id="to_date" type="text" value="<?=$to_date;?>" /> &nbsp; 
						<input type="submit" value="Filter" class="" id="btn_submit" name="btn_submit" style="   background-color: #e7e7e7;border: none;color: black;padding: 1px 25px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;" />
                    </form>
				</div><!-- absoluteDiv3 -->


<h3>Admission Bill <span class="pull-right" style="font-size:20px;">
<?php if( !empty( $MIS_list ) ){ ?>
<?php  echo count($MIS_list); ?>
<?php }else{ echo "0"; } ?>
</span></h3>
<div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">
<!--div class="absoluteDiv3">
<input type="submit" class="grayBTN" value="Copy">
<input type="submit" class="grayBTN" value="Download Excel">

<form action="<?=base_url();?>index.php/gs_admission/admission_bill_mis/search_date_range" method="POST" name="issuance" id="issuance" class="issuance">

<input type="text" name="from_date" placeholder="from" class="rangeinput" /> to 
<input class="rangeinput" name="to_date" id="to_date" type="text" placeholder="to" /> &nbsp; 
<input type="submit" value="Filter" class="greenBTN" id="btn_submit" name="btn_submit" />

</form>
</div --> <!-- absoluteDiv -->

<table id="billingMIS" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
<thead> 
  <tr> 
	  <th class="text-center">Bill no</th> 
	  <th class="text-center">GS ID</th> 
	  <th >Official name</th>
	  <th class="text-center">Class</th>
	  <th class="text-center no-sort">Additional late fee</th>
	  <th class="text-center">Current billing amount</th>
	  <th class="text-center">Arrears</th>
	  <th class="text-center">Amount before</th>
	  <th class="text-center">Amount after</th>
	  <th class="text-center">Bill due date</th>
  </tr>
</thead>
<tbody> 
<?php if( !empty( $MIS_list ) ){ ?>
  <?php foreach( $MIS_list as $mis ){ ?>
		<tr>
			<td class="text-center"><?=$mis["bill_no"];?></td>
			<td class="text-center"><?=$mis["gs_id"];?></td>
			<td><?=$mis["official_name"];?><br /></td>
			<td class="text-center"><?=$mis["class"];?></td>
			<td class="text-center"><?=$mis["additional_late_fee"];?></td>
			<td class="text-center"><?=$mis["current_billing_amount"];?></td>
			<td class="text-center"><?=$mis["arrears"];?></td>
			<td class="text-center"><?=$mis["amount_before"];?></td>
			<td class="text-center"><?=$mis["amount_after"];?></td>
			<td class="text-center"><?=$mis["bill_due_date"];?></td>
	  </tr>
  <?php } ?>
<?php } ?>
</tbody>
</table><!-- StaffListing -->
</div><!-- inner -->


<script>
$(document).ready(function(){
		 $('#billingMIS').DataTable( {
        dom: 'Bfrtip',
		 buttons: ['copy','excel']
	
    } );
	$('.rangeinput').datepicker({
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
	});
});
</script>	


