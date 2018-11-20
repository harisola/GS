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
      }else if($staff_record->gender == 'F'){
          $ImageName = $ImageFemale;
      }

      $ImageFound = "No";

      /*http://placehold.it/150x150*/
  }
?>

<!--Profile-->
<!-- <div class="user-profile">
  <div class="main-info">
    <div class="user-img"><img src="<?php //echo $ImageName; ?>" alt="User Picture"></div>
    <h1><?php //echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?></h1>
    ABC: 451 | XYZ: 45 | 123: 22
  </div>

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
      <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
      <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
    </ol>
    <div class="carousel-inner">
      <div class="item item1"> </div>
      <div class="item item2"></div>
      <div class="item item3 active"></div>
    </div>
  </div>
</div> -->



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
  <a href="<?php echo site_url()?>/student_attendance/atd_today" role="button" class="btn btn-default" data-toggle="modal">Today</a>      
  <a href="<?php echo site_url()?>/student_attendance/atd_history" role="button" class="btn btn-primary" data-toggle="modal">History</a>      
  <a href="<?php echo site_url()?>/student_attendance/active_cases" role="button" class="btn btn-default" data-toggle="modal">Active cases</a>
</div>
<br>






<?php if(strtotime($this->dateFrom) >= strtotime($this->data['attendance_session_date'])){ ?>

<!-- Absent and Penalty Students -->
<div class="row" id="powerwidgets">
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable"> 
    
    <!-- New widget -->
    <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="animatedelements" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Absent (Pending cases)</h2>
        <span class="powerwidget-loader"></span></header>
        <div class="inner-spacer" role="content">
          <div class="buttons-margin-bottom">
            <div id="items" class="items-switcher items-view-grid">             
              <ul id="available" class="box ui-sortable" style="height: 100%;">
                <form name="frm" action="checkbox.php" method="post">




                  <!-- Outstanding Cases -->
                  <?php
                    foreach ($this->Student['attendance_data_absent'] as $student) {
                      $OutstandingCases = 0;
                      foreach ($this->Student['attendance_dates'] as $date) {                        
                        if($student[$date['date']] == NULL || $student[$date['date']] == '00:00:00'){
                          $OutstandingCases++;                          
                  ?>
                      <?php } ?>                      
                    <?php } ?>
                      <?php if($OutstandingCases > 0) {?>
                        <li id="<?php echo $student['gs_id']; ?>">
                          <div class="items-inner clearfix">
                            <!-- <input name="userspresent[]" value="3116" type="checkbox" style="float: right;"> -->
                            <a data-toggle="modal" class="items-image show_student_pending_absent" data-id="<?php echo $student['gs_id']; ?>" href="#">
                            <img class="img-circle" src="<?php
                                  if(file_exists($this->data['student_150_photo_path'] . $student['gr_no'] . ".png")){
                                    echo base_url() . $this->data['student_150_photo_path'] . $student['gr_no'] . ".png";
                                  }else{
                                    echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                                  }
                                  ?>"></a>
                            <h3 class="items-title"><?php echo $student['call_name']; ?></h3>
                            <?php echo $student['std_status_code']; ?>
                            <span class="label label-danger"><?php echo $OutstandingCases; ?> A</span>
                          </div>
                        </li>
                    <?php } ?>
                  <?php } ?>




                  <!-- Absent Students -->
                  <?php
                    //foreach ($this->Student['attendance_data'] as $student) {
                    //  $totalAbsent = ($this->AttendanceTotalDays - intval($student['total_p']));                      
                    //  if($totalAbsent > 0) {
                  ?>
                  <!-- <li id="<?php //echo $student['gs_id']; ?>">
                    <div class="items-inner clearfix">
                      <input name="userspresent[]" value="3116" type="checkbox" style="float: right;">                      
                      <a data-toggle="modal" class="items-image show_student_activecase" data-id="<?php //echo $student['gs_id']; ?>" href="#">
                      <img class="img-circle" src="<?php /*
                            if(file_exists($this->data['student_150_photo_path'] . $student['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $student['gr_no'] . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }*/
                            ?>"></a>
                      <h3 class="items-title"><?php //echo $student['call_name']; ?></h3>
                      <span class="label label-danger"><?php //echo $totalAbsent; ?> A</span>
                    </div>
                  </li> -->
                  <?php //} } ?>
                </form>
              </ul>
            </div>
            <!-- <input type="button" name="update" value="Mark Active Case" onclick="setUpdatepresent();" class="btn btn-danger" style="background-image:url(images/down.png);"> -->
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
    
    
    
    
    

<div class="row" id="powerwidgets">
  <div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
    <!-- New widget -->
    <div class="powerwidget marine powerwidget-sortable" id="animatedelements" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Penalty History (Last 10 working days)</h2>
      <span class="powerwidget-loader"></span></header>
      <div class="inner-spacer" role="content">
        <div class="buttons-margin-bottom">
         

          <div id="items" class="items-switcher items-view-grid">             
            <form name="frm" action="checkbox.php" method="post">
              <!-- <input type="button" name="update" value="Mark Active Case" onclick="setUpdateabsent();" class="btn btn-danger"> -->
              <ul id="out-of-stock" style="height: 100%;" class="ui-sortable">


                <!-- Present Students -->
                <?php                  
                  foreach ($this->Student['attendance_data_penalty'] as $student) {
                    $Tags = 0;
                ?>                
                  <?php if($student['total_l'] >= 1  || $student['daypass_used_ten'] >= 1 || $student['total_a'] >= 1) { ?>
                    <li id="<?php echo $student['gs_id']; ?>">
                      <div class="items-inner clearfix">
                        <!-- <input name="usersabsent[]" value="3165" type="checkbox" style="float: right;"> -->
                        <a data-toggle="modal" class="items-image show_student_penalty_history" data-id="<?php echo $student['gs_id']; ?>" href="#">
                        <img class="img-circle" src="<?php 
                            if(file_exists($this->data['student_150_photo_path'] . $student['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $student['gr_no'] . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                            ?>"></a><br>
                        <h3 class="items-title"><?php echo $student['call_name']; ?></h3>
                        <?php echo $student['std_status_code']; ?>
                          <?php if($student['total_a'] >= 1 ) { ?>
                            <span class="label label-danger"><?php echo $student['total_a']; ?> A</span>
                            <?php $Tags++; ?>
                          <?php } ?>

                          <?php if($student['total_l'] >= 1) { ?>
                            <span class="label label-warning"><?php echo $student['total_l']; ?> L</span>
                            <?php $Tags++; ?>
                          <?php } ?>

                          <?php if($student['daypass_used_ten'] >= 1) { ?>
                            <span class="label bg-yellow"><?php echo $student['daypass_used_ten']; ?> D</span>
                            <?php $Tags++; ?>
                          <?php } ?>                          
                          

                          <?php if($Tags == 1){ ?>
                            <br><br>
                          <?php } ?>
                          <?php if($Tags == 2){ ?>
                            <br><br>
                          <?php } ?>
                      </div>
                    </li>
                  <?php } ?>
                <?php } ?>


             </ul>
            </form>
          </div>              
        </div>           
      </div>
    </div>
  </div>
</div>
<?php } ?>