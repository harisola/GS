<!-- <div class="col-md-3 col-sm-6 bootstrap-grid sortable-grid ui-sortable">            
  <div class="powerwidget powerwidget-as-portlet powerwidget-as-portlet-cold-grey" id="widget2" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <div class="powerwidget-ctrls" role="menu">            
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer nopadding" role="content">
        <div><h1>North Campus</h1></div>
        <ul class="portlet-bottom-block">
          <li class="col-md-4 col-sm-4 col-xs-4"><strong>19</strong><small>Friends</small></li>
          <li class="col-md-4 col-sm-4 col-xs-4"><strong>232</strong><small>Posts</small></li>
          <li class="col-md-4 col-sm-4 col-xs-4"><strong>507</strong><small>Requests</small></li>          
        </ul>
        <ul class="portlet-bottom-block">
          <li class="col-md-6 col-sm-6 col-xs-6"><strong>$2791</strong><small>Income</small></li>
          <li class="col-md-6 col-sm-6 col-xs-6"><strong>$2322</strong><small>Outcome</small></li>
        </ul>
      </div>
    </div>
</div> -->
<form action="<?php echo site_url()?>/sis/school_strength_report/printForm" id="student_strength_report" name="student_strength_report" target="_blank" class="orb-form" novalidate="novalidate" method="POST">

    <div class="row" style="margin-left: 5px;margin-top: 30px;">
      <div class="col-md-2">
        <label class="label" style="font-size: 16px"><strong><?php echo $student[0]->category ?></strong></label>
          <?php foreach($student as $status_student) {?>
          <?php if($status_student->id != 1) { ?>
          <label class="checkbox">
          <input class="btn-display" type="checkbox" name="student[]" value="<?php echo $status_student->id ?>" >
          <i></i><?php echo $status_student->code ?></label>
          <?php } ?>
          <?php } ?>
      </div>

      <div class="col-md-2">
        <label class="label" style="font-size: 16px"><strong><?php echo $fence[0]->category ?></strong></label>
          <?php foreach($fence as $status_fence) {?>
          <label class="checkbox">
          <input class="btn-display" type="checkbox" name="fence[]" value="<?php echo $status_fence->id; ?>" >
          <i></i><?php echo $status_fence->code ?></label>
          <?php } ?>
      </div>

      <div class="col-md-2">
        <label class="label" style="font-size: 16px"><strong><?php echo $Out[0]->category ?></strong></label>
          <?php foreach($Out as $status_Out) {?>
          <label class="checkbox">
          <input class="btn-display" type="checkbox" name="Out[]" value="<?php echo $status_Out->id ?>" >
          <i></i><?php echo $status_Out->code ?></label>
          <?php } ?>
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-lg active" style="display:none">Download Student Strength Report</button>
</form>
<!-- <img class="img-rounded img-responsive" src="<?php //echo site_url()?>/sis/school_strength_report/printForm2" alt="generated image"> -->