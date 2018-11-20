<div class="col-md-2 bootstrap-grid sortable-grid ui-sortable" id="setup_1"> 
  <!-- New widget -->
</div>

<div class="col-md-8 bootstrap-grid sortable-grid ui-sortable" id="setup_2"> 
  <!-- New widget -->
  
  <div class="powerwidget" id="setup_process" data-widget-editbutton="false" role="widget" style="position: relative; top: 0px; left: 0px; opacity: 1; background: #ffffff">
    <header role="heading">
      <h2><a href="#" class="button button-border-royal button-pill" id="btn_add_new_process"> Add Process</a></h2>
      <div class="powerwidget-ctrls" role="menu">
      </div><span class="powerwidget-loader"></span>
    </header>


    <div class="inner-spacer" role="content">
      <div id="new_process_callout"></div>
      <table class="table table-hover margin-0px setup_process_table" id="setup_process_table">
        <thead>
          <tr>
            <th style="background: #000000;">ID</th>
            <th style="background: #000000;">Name</th>
            <th style="background: #000000;">Category</th>
            <th style="background: #000000;">Description</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->data['process'] as $process) { ?>
            <tr>
              <td class="process_id"><?php echo $process->id; ?></td>
              <td class="aneditable_process_name"><a href="#" data-type="text" data-name="name" data-pk="<?php echo $process->id; ?>" data-placement="top"><?php echo $process->name;?></a></td>
              <td class="process_edit_category"><?php echo $process->category; ?></td>
              <td class="process_edit_description"><?php echo $process->description; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
  <!-- End .powerwidget --> 
</div>



<div class="col-md-2 bootstrap-grid sortable-grid ui-sortable" id="setup_3">
  <!-- New widget -->
</div>


<div class="" id="setup_4">
  <!-- New widget -->
</div>