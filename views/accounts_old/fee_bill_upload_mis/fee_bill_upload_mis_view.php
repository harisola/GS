<div class="col-md-5 bootstrap-grid sortable-grid ui-sortable"> 
  <!-- New widget -->
  
  <div class="powerwidget cold-grey" id="upload_bank_mis_div" data-widget-editbutton="false" role="widget" style="position: relative; opacity: 1;">
    <header role="heading">      
      <div class="powerwidget-ctrls" role="menu">       
      </div><span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">


        <?php if($this->fileMSG==1) { ?>
          <div class="callout callout-info"> File uploaded successfully — <code>please check fee receiving report</code>.</div>
        <?php } else if($this->fileMSG==3) { ?>
          <div class="callout callout-warning"> Remember : <br>
           (1) There must <code>NOT</code> be a single <code>DOT (.)</code> in File Name <br>
           (2) Uploading records <code>MUST</code> be from <code> Row No. 11 </code><br>
           (3) File will be uploaded only if it does <code>NOT</code> contain any <code> error</code>.<br>
           (4) You may <a href="<?php echo base_url() . 'Assets/accounts/fee_bill_mis_sample/MBL-MIS-Format(Jan01,2016).xls'; ?>" target="_blank" download="MIS_Sample_<?php echo date('Y-M-d'); ?>">download sample file</a>.
          </div>
        <?php } else { ?>
          <div class="callout callout-danger"> File Errors — <code>please check fee receiving report errors</code>.</div>
        <?php } ?>

        <form action="<?php echo site_url()?>/accounts/fee_bill_upload_mis" method="post" enctype="multipart/form-data">

          <table width="100%">
            <tr>
              <th colspan="3">Select Excel file to upload:</th>
            </tr>
            <tr>
              <td colspan="2" width="100%"><input type="file" name="fileToUpload" id="fileToUpload"></td>
              <td align="right"><input type="submit" value="Upload File" name="submit"></td>
            </tr>            
          </table>          
        </form>
    </div>
  </div>
  <!-- End .powerwidget -->
</div>