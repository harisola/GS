<link href="<?php echo base_url()?>components/css/hint.min.css" rel="stylesheet"/>

<!-- Datatables View users -->
  <div class="col-md-12 bootstrap-grid sortable-grid">
  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_add; ?>" id="datatable-filter-column" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Error Report<small>Fee Bill Bank File</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>          
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="applicant_view_table_wrapper" class="dataTables_wrapper form-inline" role="grid">
              
          <table class="display table table-striped table-hover dataTable" id="fee_bill_mis_errors_table" aria-describedby="applicant_info">

            <thead>
              <tr role="row">
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 10px; text-align: center;">S.No.</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Row No.: activate to sort column ascending" style="width: 10px; text-align: center;">Row #</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Collection Date: activate to sort column ascending" style="width: 10px; text-align: center;">Date</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Student Name: activate to sort column ascending" style="width: 10px;">Student Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Class: activate to sort column ascending" style="width: 10px; text-align: center;">Class</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="GS ID: activate to sort column ascending" style="width: 10px; text-align: center;">GS ID</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Bill #: activate to sort column ascending" style="width: 10px; text-align: center;">Bill #</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Fee Amount: activate to sort column ascending" style="width: 10px; text-align: center;">Fee Amount</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Late Fee: activate to sort column ascending" style="width: 10px; text-align: center;">Late Fee</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Mode of Payment: activate to sort column ascending" style="width: 10px;">Mode of Payment</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Deposit Branch Name: activate to sort column ascending" style="width: 10px;">Deposit Branch Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Error: activate to sort column ascending" style="width: 10px; center;">Response</th>
              </tr>
            </thead>
            
            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_s_no" placeholder="Filter S.No." class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_row_num" placeholder="Filter Row Number" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_collection_date" placeholder="Filter Collection Date" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_student_name" placeholder="Filter Student Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_class" placeholder="Filter Class" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_gs_id" placeholder="Filter GS ID" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_bill_no" placeholder="Filter Bill #" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_fee_amount" placeholder="Filter Fee Amount" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_late_fee" placeholder="Filter Late Fee" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_mode_of_payment" placeholder="Filter Mode of Payment" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_deposit_branch_name" placeholder="Filter Deposit Branch Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_error" placeholder="Filter Error" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php 
            $errorLineBG = "#FFC0CB";
            $errorBG = "#B22222";
            $errorFG = "#FFFFFF";
          ?>
          
          <?php
            $class_odd_even = 'evenn';
            $sno = 1;
            foreach($this->fileError as $record) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>            
            <?php if(substr($record['date'],0,1) == "*" || substr($record['gs_id'],0,1) == "*" || substr($record['bill_no'],0,1) == "*" || substr($record['fee_amount'],0,1) == "*" || substr($record['late_fee'],0,1) == '*') { ?>
              <?php $errorLineBG = "#FFC0CB"; ?>
            <?php } else { ?>
              <?php $errorLineBG = ""; ?>
            <?php } ?>



              <tr class="<?php echo $class_odd_even; ?>">

                <td class=" sorting_1 centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $sno; ?></td>
                <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['row']; ?></td>


                <?php if(substr($record['date'],0,1) == '*') { ?>
                <td class=" centered-cell" style="background-color:<?php echo $errorBG; ?>"><span class="hint--top" data-hint="<?php echo $record['error_date']; ?>"><font color="<?php echo $errorFG; ?>"><?php echo ltrim($record['date'], '*'); ?></font></span></td>
                <?php } else { ?>                  
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['date']; ?></td>
                <?php } ?>


                <td class=" " style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['student_name']; ?></td>
                <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['grade_section']; ?></td>


                <?php if(substr($record['gs_id'],0,1) == '*') { ?>
                <td class=" centered-cell" style="background-color:<?php echo $errorBG; ?>"><span class="hint--top" data-hint="<?php echo $record['error_gsid']; ?>"><font color="<?php echo $errorFG; ?>"><?php if(strlen($record['gs_id']) != 1) { echo ltrim($record['gs_id'], '*'); } else { echo '?'; }?></font></span></td>
                <?php } else { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['gs_id']; ?></td>
                <?php } ?>                



                <?php if(substr($record['bill_no'],0,1) == '*') { ?>
                <td class=" centered-cell" style="background-color:<?php echo $errorBG; ?>"><span class="hint--top" data-hint="<?php echo $record['error_billno']; ?>"><font color="<?php echo $errorFG; ?>"><?php if(strlen(str_replace(" / ", "",$record['bill_no'])) != 1) { echo str_replace(" / ", "",ltrim($record['bill_no'], '*')); } else { echo '?'; }?></font></span></td>
                <?php } else { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo str_replace(" / ", "-",$record['bill_no']); ?></td>
                <?php } ?>
                


                <?php if(substr($record['fee_amount'],0,1) == '*') { ?>
                 <td class=" centered-cell" style="background-color:<?php echo $errorBG; ?>"><span class="hint--top" data-hint="<?php echo $record['error_billamount']; ?>"><font color="<?php echo $errorFG; ?>"><?php echo ltrim($record['fee_amount'], '*'); ?></font></span></td>
                <?php } else { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['fee_amount']; ?></td>
                <?php } ?>                



                <?php if(substr($record['late_fee'],0,1) == '*') { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorBG; ?>"><span class="hint--top" data-hint="<?php echo $record['error_latefee']; ?>"><font color="<?php echo $errorFG; ?>"><?php echo ltrim($record['late_fee'], '*'); ?></font></span></td>  
                <?php } else { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['late_fee']; ?></td>
                <?php } ?>


                <td class=" " style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['bank_mode']; ?></td>
                <td class=" " style="background-color:<?php echo $errorLineBG; ?>"><?php echo $record['bank_branch']; ?></td>


                <?php if(substr($record['date'],0,1) == "*" || substr($record['gs_id'],0,1) == "*" || substr($record['bill_no'],0,1) == "*") { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>">Error</td>
                <?php } else { ?>
                  <td class=" centered-cell" style="background-color:<?php echo $errorLineBG; ?>">Clean</td>
                <?php } ?>
              </tr>            
          <?php $sno++; } ?>
          </tbody>
        </table>          
      </div>
    </div>
  </div>
</div>
<!-- End of View users -->