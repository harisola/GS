<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable"> 
    
  <!-- New widget -->
  
  <div class="powerwidget <?php echo $class_list_color_view; ?> powerwidget-sortable" id="user-directory" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>Class<small>List</small></h2>
  	<div class="powerwidget-ctrls" role="menu">        
    	<a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
    	<a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
  	</div><span class="powerwidget-loader"></span></header>
    <div class="inner-spacer" role="content">
    
	  <!-- Actual Holder -->
      <div id="items" class="items-switcher items-view-grid">
        <div class="row">
          <div class="col-md-6">
            <div class="input-group">
              <!-- <input type="text" data-provide="typeahead" class="form-control search" id="users" placeholder="Search">
              <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
              </span> -->
             </div>
          </div>
          <div class="col-md-6 items-options">
          	<!-- <a href="#" class="items-icon items-grid items-selected" data-view="items-view-grid">Grid View</a> -->
          	<!-- <a href="#" class="items-icon items-list" data-view="items-view-list">List View</a> -->
          </div>
        </div>

        
        <ul>
        <?php foreach($this->data['class_list_data'] as $class_list)
        { ?>
          <li>
            <div class="items-inner clearfix" style="height: 265px;">
              <?php
              if(file_exists($this->data['student_150_photo_path'] . $class_list['gr_no'] . ".png")){
                $female_photo = $this->data['student_150_photo_path'] . $class_list['gr_no'] . ".png";
                $male_photo = $this->data['student_150_photo_path'] . $class_list['gr_no'] . ".png";
              }else{
                $male_photo = 'assets/photos/sis/150x150/male.png';
                $female_photo = 'assets/photos/sis/150x150/female.png';                
              }

              if($class_list['gender'] == 'G') 
              {?>
              <a data-toggle="modal" class="items-image show_student_information" data-id="<?php echo $class_list['gr_no'];?>" href="#"><img class="img-circle" src="<?php echo base_url() . $female_photo;?>"></a>
              <?php }else{?>
              <a data-toggle="modal" class="items-image show_student_information" data-id="<?php echo $class_list['gr_no'];?>" href="#"><img class="img-circle" src="<?php echo base_url() . $male_photo;?>"></a>
              <?php }?>
                <?php
                  $name_has_abdul = strpos($class_list['call_name'], "'");
                  $abname_has_abdul = strpos($class_list['abridged_name'], "'");
                  if( $name_has_abdul > 0 && $abname_has_abdul < 1){
                    $call_name_pos = strpos($class_list['abridged_name'], substr($class_list['call_name'], 2, strlen($class_list['call_name'])));
                    $class_list['call_name'] = substr($class_list['abridged_name'], $call_name_pos - 6, $call_name_pos+strlen($class_list['call_name'])-2);
                    $call_name_pos = strpos($class_list['abridged_name'], $class_list['call_name']);
                    $abname_first_part = substr($class_list['abridged_name'], 0, $call_name_pos);
                    $abname_last_part = substr($class_list['abridged_name'], $call_name_pos + strlen($class_list['call_name']), strlen($class_list['abridged_name']));
                    echo '<p style="font-size:15px; padding-top: 10px;">' . $abname_first_part . " <strong>" . $class_list['call_name'] . "</strong> " . $abname_last_part . '</p>';                    
                  }else{
                    $call_name_pos = strpos($class_list['abridged_name'], $class_list['call_name']);
                    $abname_first_part = substr($class_list['abridged_name'], 0, $call_name_pos);
                    $abname_last_part = substr($class_list['abridged_name'], $call_name_pos + strlen($class_list['call_name']), strlen($class_list['abridged_name']));
                    echo '<p style="font-size:15px; padding-top: 10px;">' . $abname_first_part . " <strong>" . $class_list['call_name'] . "</strong> " . $abname_last_part . '</p>';
                  }?>                                    
              <center>
                <?php if($class_list['house_dname'] != 'Jinnah') {?>                    
                  <span style="background-color:#<?php echo $class_list['house_color_hex'];?>; width: 50%; display:block;"><span style="color:white"><?php echo $class_list['house_dname']; ?></span></span>
                <?php } else{?>
                  <span style="background-color:#<?php echo $class_list['house_color_hex'];?>; width: 50%; display:block;"><?php echo $class_list['house_dname']; ?></span>
                <?php } ?>                  
              </center>
              <div class="items-details">
                <strong><?php echo "GS " . $class_list['gs_id'];?></strong> <?php echo "  | " . $class_list['gr_no'];?><strong><?php echo "<br>" . $class_list['grade_dname'] . "-" . $class_list['section_dname'] . "<br>";?></strong>
                <strong><?php echo $class_list['gender']. " ";?></strong> | <?php echo "'" . substr($class_list['year_of_admission'],2) . " (" . $class_list['grade_of_admission'] . ") | ";
                    if(strlen($class_list['previous_class'])< 1) { echo "New"; } else { echo $class_list['previous_class'];}?><br>
                <strong>
                  <?php $GF_ID_Last = substr($class_list['gf_id'], -3);
                    $GF_ID_First = substr($class_list['gf_id'], 0, strlen($class_list['gf_id'])-strlen($GF_ID_Last));
                    if(strlen($GF_ID_First) == 1)
                    {
                      $GF_ID_First = '0' . $GF_ID_First;
                    }
                    $GF_ID = $GF_ID_First . "-" . $GF_ID_Last;
                    echo "GF ". $GF_ID;
                  ?>
                </strong>  | <?php if($class_list['siblings_position'] == 1) { 
                  echo "<strong>" . $class_list['siblings_position'] . "</strong>/" . $class_list['siblings_total']?>
                  <?php } else{
                  echo $class_list['siblings_position'] . "/" . $class_list['siblings_total']; }?>                
              </div>
              <!-- <div class="control-buttons"> <a href="#" title="Ban"><i class="fa fa-ban"></i></a> <a href="#" title="Delete"><i class="fa fa-times-circle"></i></a> <a href="#" title="Modify"><i class="fa fa-cog"></i></a> </div> -->
            </div>
          </li>                
        <?php } ?>
        </ul>
      </div><!-- Actual Holder -->
      <ul class="pagination"></ul>
        <!-- <li><a href="#">«</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">»</a></li>
      </ul> -->
    </div>
  </div>
</div>
<!-- End Widget -->