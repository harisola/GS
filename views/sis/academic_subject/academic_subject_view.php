<div class="col-md-3 bootstrap-grid sortable-grid ui-sortable">       
  <!-- Subject Setup -->    
    
  <div class="powerwidget dark-red" id="new_subject_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>School Subjects<small>Create new Subject</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
      <form action="<?php echo site_url()?>/sis/academic_subject" id="new_subject_form" name="new_subject_form" class="orb-form" novalidate="novalidate" method="POST">
      <?php
          if(validation_errors() != false) {
            echo '<div class="callout callout-danger">' . validation_errors() . "</div>";
          }else{
            if(count($_POST)){
              echo '<div class="callout callout-info"> saved success. </div>';              
            }
          }
        ?>
                             
        <fieldset>
          <section>
            <label class="input"> <i class="icon-append fa fa-camera-retro"></i>
              <input type="text" name="subject_name" id="subject_name" value="<?php if(validation_errors() != false) { echo $this->input->post('subject_name'); } ?>" placeholder="Subject Name" autofocus="autofocus">
              <b class="tooltip tooltip-bottom-right">Please mention the Subject Name</b> </label>
          </section>

          <section>
            <label class="input"> <i class="icon-append fa fa-eye"></i>
              <input type="text" name="subject_dname" id="subject_dname" value="<?php if(validation_errors() != false) { echo $this->input->post('subject_dname'); } ?>" placeholder="Subject Display Name" required="required">
              <b class="tooltip tooltip-bottom-right">Please mention Subject display name</b> </label>
          </section>
        </fieldset>        
      
        <footer>            
          <button type="submit" name="new_subject_button" class="btn btn-orb-org">Save</button>
          <button type="button" style="margin-left:165px;" name="new_subject_reset_button" class="btn btn-default">Reset</button>
        </footer>

      </form>
    </div>
  </div>
</div>




<div class="col-md-3 bootstrap-grid sortable-grid ui-sortable">

  <div class="powerwidget cold-grey" id="academic_subject_nestable" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>All Subjects<small>Drag & Drop</small></h2>
      <div class="powerwidget-ctrls" role="menu">         
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> 
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div><span class="powerwidget-loader"></span>
    </header>    
    <div class="inner-spacer" role="content">
      <menu id="nestable-menu">
        <button type="button" class="btn btn-primary" data-action="expand-all">Expand All</button>
        <button type="button" class="btn btn-primary" data-action="collapse-all">Collapse All</button>
      </menu>
      
      <form action="<?php echo site_url()?>/sis/academic_subject/edit2" method="POST">
        <textarea name="academic_subjects" style="display:none;" id="nestable-output"></textarea>
        <div class="dd" id="nestable">
          <ol class="dd-list">
            <?php echo $this->SubjectList; ?>            
          </ol>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Save Changes</button>
      </form>
    </div>
  </div>
</div>





<!-- Datatables Subject Edit -->
  <div class="col-md-6 bootstrap-grid sortable-grid ui-sortable">

  <!-- <div class="col-md-12 bootstrap-grid"> -->
    <div class="powerwidget <?php echo $title_background_color_view; ?>" id="subject_table_filter" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>School Subjects<small>Edit</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">
        <div id="subject_div" class="dataTables_wrapper form-inline" role="grid">

          <table class="display table table-striped table-hover dataTable" id="subject_edit_table" aria-describedby="staff_info">

            <thead>
              <tr role="row">
              <!-- New Setting -->
                <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S.No.: activate to sort column descending" style="width: 150px;">S.No.</th>                
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Subject Name: activate to sort column ascending" style="width: 25px;">Name</th>
                <th class="sorting" role="columnheader" tabindex="0" aria-controls="table-2" rowspan="1" colspan="1" aria-label="Subject Display name: activate to sort column ascending" style="width: 25px;">Display Name</th>
              </tr>
            </thead>

            <tfoot>
              <tr>
                <th rowspan="1" colspan="1"><input type="text" name="filter_sno" placeholder="Filter S.No." class="search_init"></th>                
                <th rowspan="1" colspan="1"><input type="text" name="filter_name" placeholder="Filter Name" class="search_init"></th>
                <th rowspan="1" colspan="1"><input type="text" name="filter_dname" placeholder="Filter Display Name" class="search_init"></th>
              </tr>
            </tfoot>

          <tbody role="alert" aria-live="polite" aria-relevant="all">
          <?php
            $class_odd_even = 'even';
            $SNo = 1;
            foreach($this->data['subject'] as $role) {
              if($class_odd_even == 'odd'){
                $class_odd_even = 'even';
              }else{
                $class_odd_even = 'odd';
              }
          ?>
            <tr class="<?php echo $class_odd_even; ?>">
              <td class=" sorting_1"><?php echo $SNo; ?></td>              
              <td class="aneditable_subject_name "><a href="#" data-type="text" data-name="name" data-pk="<?php echo $role->id; ?>" data-placement="top" data-title="Subject Name"><?php echo $role->name; ?></a></td>
              <td class="aneditable_subject_dname "><a href="#" data-type="text" data-name="dname" data-pk="<?php echo $role->id; ?>" data-placement="top" data-title="Subject Display Name"><?php echo $role->dname; ?></a></td>
            </tr>
          <?php $SNo++; } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- End of Subject Edit Form -->