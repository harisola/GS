<style>
.published {
  display:block;
  text-align: center;
  float:left; 
  font-family: Arial, Helvetica, sans-serif;
  border-bottom:none;
  border:1px outset #bbb;
}
.pub-month {
  display:block; 
  font-size: .9em;
  margin:0; 
  padding:0 2px;
  padding-bottom:4px;
  background:#fed url(cal-triangle.png) 
    center bottom repeat-x;
}
.pub-date { 
  display:block; 
  font-size:1.4em;
  margin:0; 
  padding:0 2px;
  background:#f6ffff;  
}
</style>


<?php  
  $ImageName = base_url() . $this->data['staff_150_photo_path'] . $this->data['staff_registered_data'][0]->employee_id . $this->data['photo_file'];
  $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
  $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
  $ImageFound = "Yes";

  if (!file_exists($this->data['staff_150_photo_path'] . $this->data['staff_registered_data'][0]->employee_id . $this->data['photo_file'])) {
      if($this->data['staff_registered_data'][0]->gender == 'M'){
          $ImageName = $ImageMale;
      }else if($this->data['staff_registered_data'][0]->gender == 'F'){
          $ImageName = $ImageFemale;
      }

      $ImageFound = "No";

  }
?>


<acronym class="published" title="<?php echo date("F j, Y"); ?>">
  <span class="pub-month"> <?php echo date("F, Y"); ?> </span>
  <span class="pub-date"> <?php echo date("d"); ?> </span>
</acronym>

<h3>
  <span>&nbsp;</span>
  <span class="label" style="color: black;"><?php echo $this->ClassTeacherGrade . '-' . $this->ClassTeacherSection;?></span>
  <span class="label bg-dark-cold-grey">T : <?php if(!empty($this->data['studentTPA'][0]['total'])) {echo $this->data['studentTPA'][0]['total'];}?></span>
  <span class="label bg-dark-cold-grey">P : <?php if(!empty($this->data['studentTPA'][0]['present'])) {echo $this->data['studentTPA'][0]['present'];} ?></span>
  <span class="label bg-dark-cold-grey">A : <?php if(!empty($this->data['studentTPA'][0]['present'])) {echo ($this->data['studentTPA'][0]['total'] - $this->data['studentTPA'][0]['present']);} ?></span>  
</h3>


<!-- Attendance Menu -->
<br>
<div class="buttons-margin-bottom">
  <a href="<?php echo site_url()?>/student_attendance/atd_today" role="button" class="btn btn-primary" data-toggle="modal">Today</a>      
  <a href="<?php echo site_url()?>/student_attendance/atd_history" role="button" class="btn btn-default" data-toggle="modal">History</a>      
  <a href="<?php echo site_url()?>/student_attendance/active_cases" role="button" class="btn btn-default" data-toggle="modal">Active cases</a>
</div>
<br>

<div>
  <form name="confirm_tpa_form" action="<?php echo site_url()?>/student_attendance/atd_today/add3" method="post">
     <?php
     $HourMin = 8;
     $HourMax = 10;
     $enableButton = false;
     $msgBox = '<br><font size="3" style="color:#bd1919;">TPA button will be avaialble only after <strong>8 AM</strong> till <strong>11 AM</strong></font><br><small style="color:##bd1919;">(Refresh this page after 8 A.M)</small>';
     /*
      $time_limit = '09:30:00'; 
      // replace semicolon with empty '' 
      $comp = str_replace(':', '', $time_limit); 

      $t = time(); 
      // will make like: '151720' 
      $now = date('His', $t); 
      $longnow = date('H:i:s', $t);
      */

      // compare strings 
      if (date('H') >= $HourMin && date('H') <= $HourMax) {
        echo '<button type="submit" class="btn btn-orb-org">Confirm TPA</button>';
        $enableButton = true;
      }else{
        echo $msgBox;
      }

    ?>
  </form>
</div>
<br>






<!-- Current Attendance -->
<div class="row" id="powerwidgets">
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable"> 
    
    <!-- New widget -->
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="animatedelements" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Absent</h2>
        <span class="powerwidget-loader"></span></header>
        <div class="inner-spacer" role="content">
          <div class="buttons-margin-bottom">
            <div id="items" class="items-switcher items-view-grid">             
              <ul id="available" class="box ui-sortable" style="height: 100%;">
                <form name="frmUserpresent" action="checkbox.php" method="post">
                  
                  <!-- Absent Students -->
                  <?php
                    foreach ($this->Student['absent'] as $student) {
                  ?>
                  <li id="<?php echo $student['gs_id'] ; ?>">
                    <div class="items-inner clearfix">
                      <input name="userspresent[]" value="<?php echo $student['gs_id'] ; ?>" type="checkbox" style="float: right;">
					  <input name="userspresentID[]" value="<?php echo $student['student_id'] ; ?>" type="hidden" style="float: right;">
                      <a data-toggle="modal" class="items-image show_student_activecase" data-id="<?php echo $student['gs_id']; ?>" href="#">
                        <!-- <a class="items-image" href="#"> -->
                      <img class="img-circle" src="<?php 
                            if(file_exists($this->data['student_150_photo_path'] . $student['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $student['gr_no']  . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                            ?>"></a>                      
                      <?php if($student['location_id'] == 9) { ?>                        
                        <h3 class="items-title"><?php echo $student['call_name']; ?></h3>
                        <span class="label label-danger">Absent</span>
                      <?php } else { ?>
                        <h3 class="items-title"><?php echo $student['call_name'] ; ?></h3>
                        <br><?php echo $student['std_status_code']; ?>
                      <?php } ?>
                    </div>
                  </li>
                  <?php } ?>
                </form>
              </ul>
            </div>
            <?php if($enableButton) { ?>
                <input type="button" name="update" value="Move to Present" onclick="setUpdatepresent();" class="btn btn-danger" style="background-image:url(images/down.png);" />            
            <?php } else { echo $msgBox; } ?>
          </div>
        <!-- end of modExample --> 
        </div>            
        <!-- The popover examples -->
    </div>
    <!-- /New widget --> 
        
  </div>
  <!-- /Inner Row Col-md-12 --> 
</div>
<!-- /Inner Row Col-md-12 --> 
    
    
 



	<!-- <a href="#" data-toggle="modal" class="btn btn-default hidden-xs pull-right lockme">
     <img src="images/moveupbtn.png" width="64" height="50" style="padding-bottom: 15px;"></a>-->
    <br>
    
    <div class="row" id="powerwidgets">
      <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
        <!-- New widget -->
        <div class="powerwidget marine powerwidget-sortable" id="animatedelements" data-widget-editbutton="false" role="widget">
          <header role="heading">
            <h2>Present</h2>
          <span class="powerwidget-loader"></span></header>
        <div class="inner-spacer" role="content">
			<div class="buttons-margin-bottom">
				<div id="items" class="items-switcher items-view-grid">            
					<form name="frmUserabsent" action="checkbox.php" method="post">
                  <?php if($enableButton) { ?>
                      <input type="button" name="update" value="Move to Absent" onclick="setUpdateabsent();" class="btn btn-danger">
                  <?php } else { echo $msgBox; } ?>
                  <ul id="out-of-stock" style="height: 100%;" class="ui-sortable">
					<?php foreach ($this->Student['present'] as $student) { ?>
                    <li id="<?php echo $student->id; ?>">
                      <div class="items-inner clearfix">
                        <input name="usersabsent[]" value="<?php echo $student->id; ?>" type="checkbox" style="float: right;">
						<input name="userspresentID[]" value="<?php echo $student->student_id; ?>" type="hidden" style="float: right;">
						
                        <a data-toggle="modal" class="items-image show_student_activecase" data-id="<?php echo $student->gs_id; ?>" href="#">
                        <!-- <a class="items-image" href="#"> -->
                        <img class="img-circle" src="<?php 
                            if(file_exists($this->data['student_150_photo_path'] . $student->gr_no . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $student->gr_no . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                            ?>"></a><br>
                        <h3 class="items-title"><?php echo $student->call_name; ?></h3>
                        <br><?php echo $student->std_status_code; ?>
                        <?php if($student->time >= '07:41:00') { ?>
                          <span class="label label-danger"><?php echo date('g:i', strtotime($student->time)); ?></span>
                        <?php } else { ?>
                            <?php if($student->location_id == 9){ ?>
                              <span class="label label-warning"><?php echo date('g:i', strtotime($student->time)); ?></span>
                            <?php } else { ?>
                              <span class="label label-success"><?php echo date('g:i', strtotime($student->time)); ?></span>
                            <?php } ?>
                        <?php } ?>
                      </div>
                    </li>
                    <?php } ?>


                 </ul>
                </form>
              </div>              
            </div>           
          </div>
        </div>
        <!-- /New widget -->         
      </div>
      <!-- /Inner Row Col-md-12 --> 
    </div>
	
	
	
	
	    
    <!-- Current Attendance -->
<div class="row" id="vectormap-index">
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable"> 
    
    <!-- New widget -->
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="animatedelements" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Absent Fence  Student</h2>
        <span class="powerwidget-loader"></span></header>
        <div class="inner-spacer" role="content">
          <div class="buttons-margin-bottom">
            <div id="items" class="items-switcher items-view-grid">             
              <ul id="available" class="box ui-sortable" style="height: 100%;">
                <form name="frmUserpresentfence" action="checkbox.php" method="post">
                  
                  <!-- Absent Students -->
                  <?php
                    foreach ($this->Student['absent_fence'] as $student) {
                  ?>
                  <li id="<?php echo $student['gs_id'] ; ?>">
                    <div class="items-inner clearfix">
                      <input name="userspresent[]" value="<?php echo $student['gs_id'] ; ?>" type="checkbox" style="float: right;">
					  <input name="userspresentID[]" value="<?php echo $student['student_id'] ; ?>" type="hidden" style="float: right;">
                      <a data-toggle="modal" class="items-image show_student_activecase" data-id="<?php echo $student['gs_id']; ?>" href="#">
                        <!-- <a class="items-image" href="#"> -->
                      <img class="img-circle" src="<?php 
                            if(file_exists($this->data['student_150_photo_path'] . $student['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $student['gr_no']  . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                            ?>"></a>                      
                      <?php if($student['location_id'] == 9) { ?>                        
                        <h3 class="items-title"><?php echo $student['call_name']; ?></h3>
                        <span class="label label-danger">Absent</span>
                      <?php } else { ?>
                        <h3 class="items-title"><?php echo $student['call_name'] ; ?></h3>
                        <br><?php echo $student['std_status_code']; ?>
                      <?php } ?>
                    </div>
                  </li>
                  <?php } ?>
                </form>
              </ul>
            </div>
            <?php if($enableButton) { ?>
                <input type="button" name="update" value="Move to Present" onclick="setUpdatepresentfence();" class="btn btn-danger" style="background-image:url(images/down.png);" /> 
            <?php } else { echo $msgBox; } ?>
          </div>
        <!-- end of modExample --> 
        </div>            
        <!-- The popover examples -->
    </div>
    <!-- /New widget --> 
        
  </div>
  <!-- /Inner Row Col-md-12 --> 
</div>
<!-- /Inner Row Col-md-12 --> 
    
    
   
<!-- /Inner Row Col-md-12 --> 

</div>
  <!-- /Widgets Row End Grid--> 
</div>