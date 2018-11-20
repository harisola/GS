<div class="col-md-2 bootstrap-grid sortable-grid ui-sortable" id="student_log_div1"> 


  <!-- Grade Selection -->
  <div class="powerwidget black" id="student_log_grade_section" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>Grade Section</h2>
      <div class="powerwidget-ctrls" role="menu">
      </div>
      <span class="powerwidget-loader"></span>
    </header>


    <div id="student_log_grades" class="inner-spacer" role="content" style="overflow-y: scroll; height: 75vh;">
      <div id="student_log_grade_callout"></div>
      <table class="table table-hover margin-0px student_log_grade_section_table" id="student_log_grade_section_table">
        <thead>
          <!-- <tr>
            <th style="background: #000000;">Grade-Section</th>
          </tr> -->
        </thead>
        <tbody>

            
            <?php foreach($this->data['gradeSection'] as $gs) { ?>
              <?php if($this->GradeName == $gs['grade_name'] and $this->SectionName == $gs['section_name']) { ?>
              <tr class="highlight1">
              <?php } else { ?>
              <tr>
              <?php } ?>
                <td class="grade_section" data-grade="<?php echo $gs['grade_id'] ?>" data-section="<?php echo $gs['section_id'] ?>"><?php echo $gs['grade_name'] . '-' . $gs['section_name']; ?></td>            
              </tr>
            <?php } ?>


        </tbody>
      </table>
    </div>
  </div>
</div>




<div class="col-md-3 bootstrap-grid sortable-grid ui-sortable" id="student_log_div2"> 
  <!-- New widget -->

  <?php $html = ''; 
  foreach($this->data['gradeSection'] as $gs) {
  if($this->GradeName == $gs['grade_name'] and $this->SectionName == $gs['section_name']) {
  

  $html .= '

  <div class="powerwidget black" id="student_log_std_name" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>Students of ' . $this->GradeName . '-' . $this->SectionName .'</h2>
      <div class="powerwidget-ctrls" role="menu">
      </div>
      <span class="powerwidget-loader"></span>
    </header>


    <div class="inner-spacer" role="content" style="overflow-y: scroll; height: 75vh;">
      <div id="student_log_std_callout"></div>
      <table class="table table-hover margin-0px student_log_grade_section_std" id="student_log_grade_section_std">
        <thead>
        </thead>
        <tbody>';
            

          foreach($this->data['class_list_data'] as $gs) {
            $html .= '<tr>
              <td class="studentID">' . $gs['gs_id'] . '</td>
              <td>' . $gs['abridged_name'] . '</td>
              <td>' . $gs['std_status_code'] . '</td>
            </tr>';
          }


        $html .= '
        </tbody>
      </table>
    </div>
  </div>
  ';


  } } echo $html; ?>
  
  
  <!-- End .powerwidget --> 
</div>





<div class="col-md-7 bootstrap-grid sortable-grid ui-sortable">
<!-- New widget -->

  <div id="student_log_div3">
  
  </div>

</div>

