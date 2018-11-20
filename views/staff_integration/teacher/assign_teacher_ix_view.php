<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width:100%;position:inherit !important;clear:both;}
.tg td{font-family:Arial, sans-serif;font-size:13px;padding:13px 13px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
.tg th{font-family:Arial, sans-serif;font-size:13px;font-weight:normal;padding:13px 13px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
.tg .tg-0ord{text-align:right;font-weight:bold;}
.tg .tg-s6z2{text-align:center;font-weight:bold;}
.tg .tg-031e{text-align:center;}
</style>
<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
    
  <div class="powerwidget cold-grey" id="assign_teachers_ix_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>Class IX</h2>
    <div class="powerwidget-ctrls" role="menu">
      <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
    </div><span class="powerwidget-loader"></span></header>
    <div class="inner-spacer" role="content" style="overflow-x:scroll ; overflow-y: hidden;">
      <div class="assign_teacher_ix_image">
        <!-- <img class="img-rounded img-responsive" src="<?php echo site_url()?>/staff_integration/setup_role_teacher_pn/printForm" alt="generated image" style="float: left; width: 100%"> -->
      </div>
      <table class="table table-striped table-hover tg">
      <?php $Limit = count($this->data['ClassTeacher']); ?>
        <tr>
          <th class="tg-s6z2">Year Tutor</th>
          <th class="tg-s6z2">Grade</th>
          <th class="tg-s6z2">Section</th>
          <th class="tg-s6z2">Class Teacher</th>
          <th class="tg-s6z2">Co Teacher</th>        
          <?php foreach ($this->data['subjects'] as $subject) { ?>
            <th class="tg-s6z2"><?php echo $subject['subject_name']; ?></th>
          <?php } ?>          
        </tr>
        <tr>
          <td class="tg-0ord" colspan="5">Lead Teacher &gt;&gt;</td>
          <?php foreach ($this->data['subjects'] as $subject) { ?>
            <?php foreach ($this->data['LeadTeacher'] as $LeadTeacher) { ?>            
              <?php if($subject['subject_id'] == $LeadTeacher['subject_id']) { ?>
                <td class="tg-031e aneditable_lead_teacher"><a href="#" title="<?php echo  $LeadTeacher['staff_name']; ?>" data-type="select2" data-name="staff_id" data-pk="<?php echo  $LeadTeacher['id']; ?>" data-placement="left" data-title="Assign Lead Teacher of KG"><?php echo  $LeadTeacher['staff_name_code']; ?></a></td>
              <?php } ?>
            <?php } ?>
          <?php } ?>          
        </tr>        
        <tr>
          <td class="tg-031e aneditable_year_tutor" rowspan="<?php echo $Limit+1; ?>"><a href="#" title="<?php echo $this->data['YearTutor'][0]['staff_name']; ?>" data-type="select2" data-name="staff_id" data-pk="<?php echo $this->data['YearTutor'][0]['id']; ?>" data-placement="right" data-title="Assign Year Tutor of IX"><?php echo $this->data['YearTutor'][0]['staff_name_code']; ?></a></td>
          <td class="tg-031e" rowspan="<?php echo $Limit+1; ?>">IX</td>
          <td class="tg-0ord" colspan="3">Blocks / wk &gt;&gt;</td>          
          <?php foreach ($this->data['subjects'] as $subject) { ?>
            <td class="tg-031e"></td>
          <?php } ?>          
        </tr>
        <?php 
          $i = 0;
          foreach ($this->data['ClassTeacher'] as $ClassTeacher) { ?>
        <tr>
          <td class="tg-s6z2"><?php echo $ClassTeacher['section_name']; ?></td>
          <td class="tg-031e aneditable_class_teacher"><a href="#" title="<?php echo $ClassTeacher['staff_name']; ?>" data-type="select2" data-name="staff_id" data-pk="<?php echo $ClassTeacher['id']; ?>" data-placement="top" data-title="Assign Class Teacher"><?php echo $ClassTeacher['staff_name_code']; ?></a></td>
          <td class="tg-031e aneditable_co_teacher"><a href="#" title="<?php if(count($this->data['CoTeacher']) > 0) {echo $this->data['CoTeacher'][$i]['staff_name'];} ?>" data-type="select2" data-name="staff_id" data-pk="<?php echo $this->data['CoTeacher'][$i]['id']; ?>" data-placement="top" data-title="Assign Co Teacher"><?php if(count($this->data['CoTeacher']) > 0) {echo $this->data['CoTeacher'][$i]['staff_name_code'];} ?></a></td>
          <?php $j = 0; ?>
          <?php foreach ($this->data['subjects'] as $subject) { ?>
          <td class="tg-031e aneditable_subject_teacher"><a href="#" title="<?php echo $this->data['SubjectTeachers'][$j][$i]['staff_name']; ?>" data-type="select2" data-name="staff_id" data-pk="<?php echo $this->data['SubjectTeachers'][$j][$i]['id']; ?>" data-placement="left" data-title="Assign Subject Teacher"><?php echo $this->data['SubjectTeachers'][$j][$i]['staff_name_code']; ?></a></td>
          <?php $j++; }?>
        </tr>
        <?php $i++; } ?>
      </table>
    </div>
  </div>
</div>