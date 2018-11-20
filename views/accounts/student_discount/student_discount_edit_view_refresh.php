<?php  //var_dump( $this->data['student_discount_info']);  ?>
<?php
	$Student_Id =  $this->data['student_discount_info'][0]['student_id'];
	$GS_ID =  $this->input->post('gs_id');
	
	$count=0;
?>	

<?php foreach( $this->data['student_discount_info'] as $info ){ ?>
<div class="col-md-3 bootstrap-grid sortable-grid">
  <div class="powerwidget cold-grey" id="sutdent_discount_form_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>Discount<small>Edit discount</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
    </header>
    <div class="inner-spacer" role="content">    

      <address>
        <strong><?php echo $this->data['student_discount_info'][0]['abridged_name'] . '</strong> (GS-ID: <strong>' . $this->input->post('gs_id') . ')'; ?></strong><br>
        <?php echo $this->data['student_discount_info'][0]['grade_name'] . '-' . $this->data['student_discount_info'][0]['section_name']; ?><br>
        <?php echo $this->data['student_discount_info'][$count]['concession_code'] . ', ' . $this->data['student_discount_info'][$count]['concession_name']. ', <strong>' . 
        $this->data['student_discount_info'][0]['percentage'] . '%</strong>'; ?><br>
		
		<?php if($count==0 ){ ?>
		<a class="popover-hovered" href="#" id="Create_New_Discount" data-gs_id="<?=$GS_ID;?>" data-studentid="<?=$Student_Id;?>"  data-toggle="tooltip" data-content="If You Wants To Add New Discount For This Student then, Click On." title="" data-original-title="New Discount !">creat new</a>
		<?php } ?>
		
		</address>
      

		
        <table class="table table-striped table-hover margin-0px">
        <thead>
          <tr>
            <th>Month</th>
            <th>Discount</th>            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Aug</td>
            <td>
              <a href="#" id="student_discount_aug" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Aug" class="editable editable-click editable-empty student_discount_aug" data-original-title="" title="Student Discount for Aug"><?php echo $this->data['student_discount_info'][$count]['aug']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Sep</td>
            <td>
              <a href="#" id="student_discount_sep" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Sep" class="editable editable-click editable-empty student_discount_sep" data-original-title="" title="Student Discount for Sep"><?php echo $this->data['student_discount_info'][$count]['sep']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Oct</td>
            <td>
              <a href="#" id="student_discount_oct" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Oct" class="editable editable-click editable-empty student_discount_oct" data-original-title="" title="Student Discount for Oct"><?php echo $this->data['student_discount_info'][$count]['oct']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Nov</td>
            <td>
              <a href="#" id="student_discount_nov" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Nov" class="editable editable-click editable-empty student_discount_nov" data-original-title="" title="Student Discount for Nov"><?php echo $this->data['student_discount_info'][$count]['nov']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Dec</td>
            <td>
              <a href="#" id="student_discount_dec" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Dec" class="editable editable-click editable-empty student_discount_dec" data-original-title="" title="Student Discount for Dec"><?php echo $this->data['student_discount_info'][$count]['dec']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Jan</td>
            <td>
              <a href="#" id="student_discount_jan" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Jan" class="editable editable-click editable-empty student_discount_jan" data-original-title="" title="Student Discount for Jan"><?php echo $this->data['student_discount_info'][$count]['jan']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Feb</td>
            <td>
              <a href="#" id="student_discount_feb" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Feb" class="editable editable-click editable-empty student_discount_feb" data-original-title="" title="Student Discount for Feb"><?php echo $this->data['student_discount_info'][$count]['feb']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Mar</td>
            <td>
              <a href="#" id="student_discount_mar" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Mar" class="editable editable-click editable-empty student_discount_mar" data-original-title="" title="Student Discount for Mar"><?php echo $this->data['student_discount_info'][$count]['mar']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Apr</td>
            <td>
              <a href="#" id="student_discount_apr" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Apr" class="editable editable-click editable-empty student_discount_apr" data-original-title="" title="Student Discount for Apr"><?php echo $this->data['student_discount_info'][$count]['apr']; ?></a>
            </td>
          </tr>
          <tr>
            <td>May</td>
            <td>
              <a href="#" id="student_discount_may" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for May" class="editable editable-click editable-empty student_discount_may" data-original-title="" title="Student Discount for May"><?php echo $this->data['student_discount_info'][$count]['may']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Jun</td>
            <td>
              <a href="#" id="student_discount_jun" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Jun" class="editable editable-click editable-empty student_discount_jun" data-original-title="" title="Student Discount for Jun"><?php echo $this->data['student_discount_info'][$count]['jun']; ?></a>
            </td>
          </tr>
          <tr>
            <td>Jul</td>
            <td>
              <a href="#" id="student_discount_jul" data-type="text" data-pk="<?php echo $this->data['student_discount_info'][$count]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Discount for Jul" class="editable editable-click editable-empty student_discount_jul" data-original-title="" title="Student Discount for Jul"><?php echo $this->data['student_discount_info'][$count]['jul']; ?></a>
            </td>
          </tr>
        </tbody>
      </table>
	
	
	
	
    </div>
  </div>
</div>

<?php $count++; } ?> 
<div class="col-md-3" id="addMoreDiscount" style="display:none">
<div class="inner-spacer" role="content" id="addMoreDiscount_Contents"></div>
  
</div>
<script>
$(document).ready(function () {


	
	$('.student_discount_aug').editable({
		type: 'text',
		name: 'aug',
		title: 'Student Discount for Aug',
		url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
		validate: function(value) {
		   if($.trim(value) == '') return 'This field is required';
		}
	});
	
	
	
	
	
	$('.student_discount_sep').editable({
            type: 'text',
            name: 'sep',
            title: 'Student Discount for Sep',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_oct').editable({
            type: 'text',
            name: 'oct',
            title: 'Student Discount for Oct',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_nov').editable({
            type: 'text',
            name: 'nov',
            title: 'Student Discount for Nov',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_dec').editable({
            type: 'text',
            name: 'dec',
            title: 'Student Discount for Dec',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_jan').editable({
            type: 'text',
            name: 'jan',
            title: 'Student Discount for Jan',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_feb').editable({
            type: 'text',
            name: 'feb',
            title: 'Student Discount for Feb',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_mar').editable({
            type: 'text',
            name: 'mar',
            title: 'Student Discount for Mar',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_apr').editable({
            type: 'text',
            name: 'apr',
            title: 'Student Discount for Apr',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_may').editable({
            type: 'text',
            name: 'may',
            title: 'Student Discount for May',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_jun').editable({
            type: 'text',
            name: 'jun',
            title: 'Student Discount for Jun',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_discount_jul').editable({
            type: 'text',
            name: 'jul',
            title: 'Student Discount for Jul',
            url: '<?php echo base_url()?>index.php/accounts/fee_bill_student_discount/edit',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_abridged_name a').editable({
            type: 'text',
            name: 'abridged_name',
            title: 'Student Abridged Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

        $('.student_call_name a').editable({
            type: 'text',
            name: 'call_name',
            title: 'Student Call Name',
            url: '<?php echo base_url()?>index.php/sis/fif_form/edit2',
            validate: function(value) {
               if($.trim(value) == '') return 'This field is required';
            }
        });

       
		
		
		
});	
		
</script>