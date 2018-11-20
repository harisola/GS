<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">
<!-- New widget -->
            
<!--- Scripting by HOL -->

<!-- -->            
  <!-- End .powerwidget --> 
  <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="power-forms-grid" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2>GS-ID or GF-ID<small>view and edit Family Information</small></h2>
        <div class="powerwidget-ctrls" role="menu">          
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
          <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">        
        <form action="<?php echo site_url()?>/sis/fif_form" id="visitor_guest_assignedcard_form" name="visitor_guest_assignedcard_form" class="orb-form" novalidate="novalidate" method="POST">
          <!-- <header>Enter GS-ID or GF-ID to view Family Information</header> -->
          <?php
            if(validation_errors() != false) {                            
              echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
            } 
          ?>
          <fieldset>
            <div class="row">
              <section class="col col-2">              
                <label class="label">GS ID</label>
                <label class="input">
                  <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" autofocus="autofocus">
                </label>
              </section>
              <section class="col col-2">
                <label class="label">GF ID</label>
                <label class="input">
                  <input type="text" name="gf_id" id="gf_id" placeholder="GF-ID">
                </label>
              </section>                            
            </div>
            <div class="row">
              <section class="col col-2">            
                <button type="submit" class="btn btn-orb-org">Search</button>
              </section>
            </div>
          </fieldset> 
        </form>        

        <form action="<?php echo site_url()?>/sis/fif_form/printForm" id="fif_print_form" name="fif_print_form" novalidate="novalidate" method="POST" align="right">
          <input type="hidden" name="fif_gfid" value="<?php echo $this->GFID; ?>">
          <button type="submit" name="fif_form_print_button" class="btn btn-orb-org">Print   F I F</button>
        </form>
        <form action="<?php echo site_url()?>/sis/fif_form/edit" id="fif_edit_form" name="fif_edit_form" class="orb-form" novalidate="novalidate" method="POST">
        <header><?php echo "GF-ID : " . $this->GFID; ?></header>
        
          <fieldset>
            <?php 
              $LeftSide = true;
              $num=0;
              foreach ($this->data['siblings'] as $sibling) { ?>
                <?php if($LeftSide) { ?>
                <br><br>
                <div class="row">
                  <section class="col col-2">
                    <img class="img-circle" src="
                          <?php 
                            if(file_exists($this->data['student_150_photo_path'] . $sibling['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $sibling['gr_no'] . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                          ?>" alt="User Picture">
                    <br><br><br>
                    <?php foreach ($this->data['sib'][$num] as $student) { ?>                      
                      <?php
                        if($student['data']=='Status'){
                          echo date("d-M-y", strtotime($student['wef'])) . ' : ' . $student['old'] . ' to ' . $student['new'];
                        }else{
                          echo date("d-M-y", strtotime($student['wef'])) . ' : ' . $student['data'];
                        }
                      ?>
                    <br><br>
                    <?php } ?>

                  </section>




                  <section class="col col-3">
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['gs_id']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['gr_no']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label student_official_name" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo $sibling['official_name']; ?>
                        <?php } else { ?>
                          <a href="#" id="student_official_name" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Official Name" class="editable editable-click editable-empty" data-original-title="" title="Student Official Name"><?php echo $sibling['official_name']; ?></a>
                        <?php } ?>                        
                      </label>                      
                    </div>
                    <div class="row">
                      <label class="label student_abridged_name" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo $sibling['abridged_name']; ?>
                        <?php } else { ?>
                          <a href="#" id="student_abridged_name" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Abridged Name" class="editable editable-click editable-empty" data-original-title="" title="Student Abridged Name"><?php echo $sibling['abridged_name']; ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label student_call_name" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo $sibling['call_name']; ?>
                        <?php } else { ?>
                          <a href="#" id="student_call_name" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Call Name" class="editable editable-click editable-empty" data-original-title="" title="Student Call Name"><?php echo $sibling['call_name']; ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label" style="margin-top: 10px; width:100%; text-align:center;"><strong><?php echo $sibling['grade_name'] . "-" . $sibling['section_name']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['house_name']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['generation_of']; ?></strong></label>
                    </div>
                    <!-- <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php //echo $sibling['year_of_admission']; ?></strong></label>
                    </div> -->
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['grade_of_admission']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label student_dob" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo  date("d-M-Y", strtotime($sibling['dob'])); ?>
                        <?php } else { ?>
                          <a href="#" id="student_dob" data-type="combodate" data-value="<?php echo $sibling['dob']; ?>" data-format="YYYY-MM-DD" data-viewformat="DD-MMM-YYYY" data-template="D / MMM / YYYY" data-pk="<?php echo $sibling['student_id']; ?>" data-title="Select Date of birth" class="editable editable-click" data-original-title="" title="Date of Birth"><?php echo  date("d-M-Y", strtotime($sibling['dob'])); ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['std_status_code']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label student_nationality" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php if(strlen($sibling['nationality_1']) > 0) { echo $sibling['nationality_1'];} else { /*echo "Empty";*/} ?>
                        <?php } else { ?>
                          <a href="#" id="student_nationality" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Nationality" class="editable editable-click editable-empty" data-original-title="" title="Student Nationality"><?php if(strlen($sibling['nationality_1']) > 0) { echo $sibling['nationality_1'];} else { /*echo "Empty";*/} ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label student_mobile_phone" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php if(strlen($sibling['mobile_phone']) > 0) { echo $sibling['mobile_phone'];} else { /*echo "Empty";*/ } ?>
                        <?php } else { ?>
                          <a href="#" id="student_mobile_phone" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Mobile Phone" class="editable editable-click editable-empty" data-original-title="" title="Student Mobile Phone"><?php if(strlen($sibling['mobile_phone']) > 0) { echo $sibling['mobile_phone'];} else { /*echo "Empty";*/ } ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label student_email" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php if(strlen($sibling['email']) > 0) { echo $sibling['email'];} else { /*echo "Empty";*/} ?>
                        <?php } else { ?>
                          <a href="#" id="student_email" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Email" class="editable editable-click editable-empty" data-original-title="" title="Student Email"><?php if(strlen($sibling['email']) > 0) { echo $sibling['email'];} else { /*echo "Empty";*/} ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    
          <div class="row text-center" id="Advance_tax_<?=$sibling['student_id'];?>">

                    <?php 

                      $fchecked='';
                      $mchecked='';
                      $gchecked='';
                      $showGardian = "none";
                      $tax_nic = "";

                      if( !empty( $sibling['tax_nic'] ) )
                      {
                        $tax_nic = $sibling['tax_nic']; 

                        if( !empty( $this->data['parentInfo'][0]['nic'] ) )
                        {
                          $pnic = $this->data['parentInfo'][0]['nic'];

                        }

                        if( !empty( $this->data['parentInfo'][1]['nic'] ) )
                        {
                          $mnic = $this->data['parentInfo'][1]['nic'];

                        }

                          

                       
                     if( $tax_nic == $pnic && $tax_nic != $mnic )
                     {
                      $fchecked ='checked';
                      $gchecked='';
                      $showGardian = "none";
                     }
                     else if( $tax_nic == $mnic && $tax_nic != $pnic )
                     { 
                      $mchecked ='checked';
                      $gchecked='';
                      $showGardian = "none";
                     }
                     else if( $tax_nic != $mnic && $tax_nic != $pnic )
                     { 

                      $showGardian = "block";
                      $gchecked='checked';
                     }

                  }

                    ?>





                    <label for="ATMF">

                    <?php if( $fchecked != '' ) : ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Father_<?=$sibling['student_id'];?> " onclick="show1(<?=$sibling['student_id'];?>');" checked="checked" /> Father</label> &nbsp;  &nbsp; 

                    <?php else: ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Father_<?=$sibling['student_id'];?>" onclick="show1(<?=$sibling['student_id'];?>);" /> Father</label> &nbsp;  &nbsp; 

                    <?php endif; ?>



                    <label for="ATMM">
                    <?php if( $mchecked != '' ) : ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Mother_<?=$sibling['student_id'];?>" onclick="show1(<?=$sibling['student_id'];?>);" checked="checked" /> Mother</label> &nbsp;  &nbsp; 
                    <?php else: ?>
                      <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Mother_<?=$sibling['student_id'];?>" onclick="show1(<?=$sibling['student_id'];?>);" /> Mother</label> &nbsp;  &nbsp; 
                    <?php endif; ?>

                    <label for="ATMG">

                    <?php if( $gchecked != '' ) : ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Guardian_<?=$sibling['student_id'];?>" onclick="show2(<?=$sibling['student_id'];?>);" checked="checked" /> Guardian
                  </label><br /><br />
                     <div id="guardianCNIC_<?=$sibling['student_id'];?>">
                    <?php else: ?> 
                      <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Guardian_<?=$sibling['student_id'];?>" onclick="show2(<?=$sibling['student_id'];?>);" /> Guardian</label><br /><br />
                       <div id="guardianCNIC_<?=$sibling['student_id'];?>" style="display: none;">
                      <?php endif; ?>

                   


                    <input type="text" 
                    id="guardianCNICIN_<?=$sibling['student_id'];?>" 
                    placeholder="Guardian CNIC" style="padding: 5px;margin: 0 auto;" value="<?=$tax_nic;?>" class="guardianCNICIN">

                      <span style="cursor: pointer; font-size: 16px;" 
                      class="guardianCNICINBtn" data-Save_id="<?=$sibling['student_id'];?>" > Save </span>
                    </div>

                      <label class="label " style="width:100%; text-align:center;">
                        
                      </label>
                      <label class="label " style="width:100%; text-align:center;">
                        
                      </label>
                      <label class="label " style="width:100%; text-align:center;">
                        
                      </label>
                    </div>

                  </section>



                  <section class="col col-2">
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">GS-ID</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">GR NO</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Official Name</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Abridged Name</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Call Name</label>
                    </div>
                    <div class="row">
                      <label class="label" style="margin-top: 10px; width:100%; text-align:center;">Grade-Section</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">House</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Generation Of</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Grade of Admission</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Date of Birth</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Status</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Naionality</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Mobile Phone</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Email</label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;">Advance Tax Mandate</label>
                    </div>
                  </section>
                <?php $LeftSide = false; } else { ?>



                  <section class="col col-3">
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['gs_id']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['gr_no']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label student_official_name" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo $sibling['official_name']; ?>
                        <?php } else { ?>
                          <a href="#" id="student_official_name" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Official Name" class="editable editable-click editable-empty" data-original-title="" title="Student Official Name"><?php echo $sibling['official_name']; ?></a>
                        <?php } ?>                        
                      </label>                      
                    </div>
                    <div class="row">
                      <label class="label student_abridged_name" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo $sibling['abridged_name']; ?>
                        <?php } else { ?>
                          <a href="#" id="student_abridged_name" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Abridged Name" class="editable editable-click editable-empty" data-original-title="" title="Student Abridged Name"><?php echo $sibling['abridged_name']; ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label student_call_name" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo $sibling['call_name']; ?>
                        <?php } else { ?>
                          <a href="#" id="student_call_name" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Call Name" class="editable editable-click editable-empty" data-original-title="" title="Student Call Name"><?php echo $sibling['call_name']; ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label" style="margin-top: 10px; width:100%; text-align:center;"><strong><?php echo $sibling['grade_name'] . "-" . $sibling['section_name']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['house_name']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['generation_of']; ?></strong></label>
                    </div>
                    <!-- <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php //echo $sibling['year_of_admission']; ?></strong></label>
                    </div> -->
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['grade_of_admission']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label student_dob" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php echo  date("d-M-Y", strtotime($sibling['dob'])); ?>
                        <?php } else { ?>
                          <a href="#" id="student_dob" data-type="combodate" data-value="<?php echo $sibling['dob']; ?>" data-format="YYYY-MM-DD" data-viewformat="DD-MMM-YYYY" data-template="D / MMM / YYYY" data-pk="<?php echo $sibling['student_id']; ?>" data-title="Select Date of birth" class="editable editable-click" data-original-title="" title="Date of Birth"><?php echo  date("d-M-Y", strtotime($sibling['dob'])); ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label" style="width:100%; text-align:center;"><strong><?php echo $sibling['std_status_code']; ?></strong></label>
                    </div>
                    <div class="row">
                      <label class="label student_nationality" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php if(strlen($sibling['nationality_1']) > 0) { echo $sibling['nationality_1'];} else { /*echo "Empty";*/} ?>
                        <?php } else { ?>
                          <a href="#" id="student_nationality" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Nationality" class="editable editable-click editable-empty" data-original-title="" title="Student Nationality"><?php if(strlen($sibling['nationality_1']) > 0) { echo $sibling['nationality_1'];} else { /*echo "Empty";*/} ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label student_mobile_phone" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php if(strlen($sibling['mobile_phone']) > 0) { echo $sibling['mobile_phone'];} else { /*echo "Empty";*/ } ?>
                        <?php } else { ?>
                          <a href="#" id="student_mobile_phone" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Mobile Phone" class="editable editable-click editable-empty" data-original-title="" title="Student Mobile Phone"><?php if(strlen($sibling['mobile_phone']) > 0) { echo $sibling['mobile_phone'];} else { /*echo "Empty";*/ } ?></a>
                        <?php } ?>                        
                      </label>
                    </div>
                    <div class="row">
                      <label class="label student_email" style="width:100%; text-align:center;">
                        <?php if($this->data['can_user_edit'] == 0) { ?>
                          <?php if(strlen($sibling['email']) > 0) { echo $sibling['email'];} else { /*echo "Empty";*/} ?>
                        <?php } else { ?>
                          <a href="#" id="student_email" data-type="text" data-pk="<?php echo $sibling['student_id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Student Email" class="editable editable-click editable-empty" data-original-title="" title="Student Email"><?php if(strlen($sibling['email']) > 0) { echo $sibling['email'];} else { /*echo "Empty";*/} ?></a>
                        <?php } ?>                        
                      </label>
                    </div>


<div class="row text-center" id="Advance_tax_<?=$sibling['student_id'];?>">

                    <?php 

                      $fchecked='';
                      $mchecked='';
                      $gchecked='';
                      $showGardian = "none";
                      $tax_nic = "";

                      if( !empty( $sibling['tax_nic'] ) )
                      {
                        $tax_nic = $sibling['tax_nic']; 

                        if( !empty( $this->data['parentInfo'][0]['nic'] ) )
                        {
                          $pnic = $this->data['parentInfo'][0]['nic'];

                        }

                        if( !empty( $this->data['parentInfo'][1]['nic'] ) )
                        {
                          $mnic = $this->data['parentInfo'][1]['nic'];

                        }

                          

                       
                     if( $tax_nic == $pnic && $tax_nic != $mnic )
                     {
                      $fchecked ='checked';
                      $gchecked='';
                      $showGardian = "none";
                     }
                     else if( $tax_nic == $mnic && $tax_nic != $pnic )
                     { 
                      $mchecked ='checked';
                      $gchecked='';
                      $showGardian = "none";
                     }
                     else if( $tax_nic != $mnic && $tax_nic != $pnic )
                     { 

                      $showGardian = "block";
                      $gchecked='checked';
                     }

                  }

                    ?>





                    <label for="ATMF">

                    <?php if( $fchecked != '' ) : ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Father_<?=$sibling['student_id'];?> " onclick="show1(<?=$sibling['student_id'];?>');" checked="checked" /> Father</label> &nbsp;  &nbsp; 

                    <?php else: ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Father_<?=$sibling['student_id'];?>" onclick="show1(<?=$sibling['student_id'];?>);" /> Father</label> &nbsp;  &nbsp; 

                    <?php endif; ?>



                    <label for="ATMM">
                    <?php if( $mchecked != '' ) : ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Mother_<?=$sibling['student_id'];?>" onclick="show1(<?=$sibling['student_id'];?>);" checked="checked" /> Mother</label> &nbsp;  &nbsp; 
                    <?php else: ?>
                      <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Mother_<?=$sibling['student_id'];?>" onclick="show1(<?=$sibling['student_id'];?>);" /> Mother</label> &nbsp;  &nbsp; 
                    <?php endif; ?>

                    <label for="ATMG">

                    <?php if( $gchecked != '' ) : ?>
                    <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Guardian_<?=$sibling['student_id'];?>" onclick="show2(<?=$sibling['student_id'];?>);" checked="checked" /> Guardian
                  </label><br /><br />
                     <div id="guardianCNIC_<?=$sibling['student_id'];?>">
                    <?php else: ?> 
                      <input class="Advance_tax" type="radio" name="<?=$sibling['student_id'];?>_ATM" value="Guardian_<?=$sibling['student_id'];?>" onclick="show2(<?=$sibling['student_id'];?>);" /> Guardian</label><br /><br />
                       <div id="guardianCNIC_<?=$sibling['student_id'];?>" style="display: none;">
                      <?php endif; ?>

                   


                    <input type="text" 
                    id="guardianCNICIN_<?=$sibling['student_id'];?>" 
                    placeholder="Guardian CNIC" style="padding: 5px;margin: 0 auto;" value="<?=$tax_nic;?>" class="guardianCNICIN">

                      <span style="cursor: pointer; font-size: 16px;" 
                      class="guardianCNICINBtn" data-Save_id="<?=$sibling['student_id'];?>" > Save </span>
                    </div>

                      <label class="label " style="width:100%; text-align:center;">
                        
                      </label>
                      <label class="label " style="width:100%; text-align:center;">
                        
                      </label>
                      <label class="label " style="width:100%; text-align:center;">
                        
                      </label>
                    </div>



                           
                  </section>



                  <section class="col col-2">
                    <img class="img-circle" src="
                          <?php 
                            if(file_exists($this->data['student_150_photo_path'] . $sibling['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $sibling['gr_no'] . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                          ?>" alt="User Picture">
                        <br><br><br>
                        <?php foreach ($this->data['sib'][$num] as $student) { ?>                      
                          <?php
                            if($student['data']=='Status'){
                              echo date("d-M-y", strtotime($student['wef'])) . ' : ' . $student['old'] . ' to ' . $student['new'];
                            }else{
                              echo date("d-M-y", strtotime($student['wef'])) . ' : ' . $student['data'];
                            }
                          ?>
                        <br><br>
                        <?php } ?>
                  </section>
                </div>
                <?php $num++; $LeftSide = true; } ?>              
            <?php } ?>
          </fieldset>
          
          <footer>
            <!-- <button type="submit" name="fif_form_edit_button" class="btn btn-orb-org">Update   F I F</button> -->
          </footer>
        </form>


        <form action="<?php echo site_url()?>/sis/fif_form/edit" id="fif_edit_form" name="fif_edit_form" class="orb-form" novalidate="novalidate" method="POST">
        <header>Home & Primary Contact</header>
          <fieldset>
            <div class="row">
              <section class="col col-2">              
                <label class="label">Apartment No.</label>                
              </section>
              <section class="col col-4">
                <label class="label family_home_apartmentno">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['apartment_no']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_apartmentno" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Apartment No" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['apartment_no']; ?></a>
                  <?php } ?>                  
                </label>                
              </section>
              <section class="col col-3">              
                <label class="label">Home Phone</label>                
              </section>
              <section class="col col-3">
                <label class="label family_home_phoneno">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['phone']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_phoneno" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Phone No" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['phone']; ?></a>
                  <?php } ?>                  
                </label>                
              </section>
            </div>

            <div class="row">
              <section class="col col-2">              
                <label class="label">Building Name</label>                
              </section>
              <section class="col col-4">
                <label class="label family_home_buildingname">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['building_name']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_buildingname" data-type="textarea" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Building Name" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['building_name']; ?></a>
                  <?php } ?>                  
                </label>                
              </section>
              <section class="col col-3">              
                <label class="label">Primary Mobile Contact</label>                
              </section>
              <section class="col col-3">
                <label class="label home_primary_mobile">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['primary_phone']; ?>
                  <?php } else { ?>
                    <a href="#" id="home_primary_mobile" data-type="select" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-value="<?php echo $this->data['homeInfo'][0]['primary_phone']; ?>" data-title="Select Primary Mobile Contact" class="editable editable-click"><?php echo $this->data['homeInfo'][0]['primary_phone']; ?></a>
                  <?php } ?>                  
                </label>                
              </section>
            </div>

            <div class="row">
              <section class="col col-2">              
                <label class="label">Plot No.</label>                
              </section>
              <section class="col col-4">
                <label class="label family_home_plotno">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['plot_no']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_plotno" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Plot No" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['plot_no']; ?></a>
                  <?php } ?>                  
                </label>                
              </section>
              <section class="col col-3">              
                <label class="label">Primary SMS Contact</label>                
              </section>
              <section class="col col-3">
                <label class="label home_primary_sms">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['primary_sms']; ?>
                  <?php } else { ?>
                    <a href="#" id="home_primary_sms" data-type="select" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-value="<?php echo $this->data['homeInfo'][0]['primary_sms']; ?>" data-title="Select Primary SMS" class="editable editable-click"><?php echo $this->data['homeInfo'][0]['primary_sms']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>

            <div class="row">
              <section class="col col-2">              
                <label class="label">Street Name</label>
              </section>
              <section class="col col-4">
                <label class="label family_home_streetname">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['street_name']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_streetname" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Street Name" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['street_name']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
              <section class="col col-3">              
                <label class="label">Primary Email Contact</label>
              </section>
              <section class="col col-3">
                <label class="label home_primary_email">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['primary_email']; ?>
                  <?php } else { ?>
                    <a href="#" id="home_primary_email" data-type="select" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-value="<?php echo $this->data['homeInfo'][0]['primary_email']; ?>" data-title="Select Primary Email Contact" class="editable editable-click"><?php echo $this->data['homeInfo'][0]['primary_email']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>

            <div class="row">
              <section class="col col-2">              
                <label class="label">Subregion</label>
              </section>
              <section class="col col-4">
                <label class="label family_home_subregion">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['sub_region']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_subregion" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Subregion Name" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['sub_region']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>

            <div class="row">
              <section class="col col-2">              
                <label class="label">Region</label>
              </section>
              <section class="col col-4">
                <label class="label family_home_region">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['region']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_region" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home Region Name" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['region']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>

            <div class="row">
              <section class="col col-2">              
                <label class="label">City</label>
              </section>
              <section class="col col-4">
                <label class="label family_home_city">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['homeInfo'][0]['city']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_home_city" data-type="text" data-pk="<?php echo $this->data['homeInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Home City Name" class="editable editable-click editable-empty"><?php echo $this->data['homeInfo'][0]['city']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>
          </fieldset>
         <footer>
          <!-- <button type="submit" name="fif_form_edit_button" class="btn btn-orb-org">Update   F I F</button> -->
         </footer>
        </form>




        <form action="<?php echo site_url()?>/sis/fif_form/edit" id="fif_edit_form" name="fif_edit_form" class="orb-form" novalidate="novalidate" method="POST">
        <header>Parents Information</header>
          <fieldset>
            <div class="row">
              <section class="col col-2">
                <img class="img-circle" src="<?php echo base_url() . $this->FatherPhoto; ?>" alt="User Picture">
              </section>



              <section class="col col-3">
                <div class="row">                  
                </div>
                <div class="row">
                  <label class="label parent_father_name" style="width:100%; text-align:center;">                  
                    


                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['is_late']; ?>
                    <?php } else { ?>
                      
<?php if( $this->data['parentInfo'][0]['is_late'] == 1 ) { ?>
<input type="checkbox" value="Father_late" name="Father_late"  id="Father_late" checked="checked" />
<?php } else { ?>
  <input type="checkbox" value="Father_late" name="Father_late"  id="Father_late" />
<?php } ?>


                    <?php } ?>   



                  </label>                      
                </div>
                <div class="row">
                  <label class="label parent_father_name" style="width:100%; text-align:center;">                  
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['name']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_name" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Name" class="editable editable-click editable-empty" data-original-title="" title="Father Name"><?php echo $this->data['parentInfo'][0]['name']; ?></a>
                    <?php } ?>                    
                  </label>                      
                </div>
                <div class="row">
                  <label class="label parent_father_nationality1" style="width:100%; text-align:center;">                  
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['nationality_1']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_nationality1" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Nationality" class="editable editable-click editable-empty" data-original-title="" title="Father Nationality"><?php echo $this->data['parentInfo'][0]['nationality_1']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_father_nationality2" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['nationality_2']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_nationality2" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Nationality" class="editable editable-click editable-empty" data-original-title="" title="Father Nationality"><?php echo $this->data['parentInfo'][0]['nationality_2']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_father_nic" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['nic']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_nic" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father CNIC" class="editable editable-click editable-empty" data-original-title="" title="Father CNIC"><?php echo $this->data['parentInfo'][0]['nic']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <br>
                <div class="row">
                  <label class="label parent_father_mobilephone" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['mobile_phone']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_mobilephone" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Mobile Phone" class="editable editable-click editable-empty" data-original-title="" title="Father Mobile Phone"><?php echo $this->data['parentInfo'][0]['mobile_phone']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_father_profession" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['profession']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_profession" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Profession" class="editable editable-click editable-empty" data-original-title="" title="Father Profession"><?php echo $this->data['parentInfo'][0]['profession']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_father_speciality" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['speciality']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_speciality" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Speciality" class="editable editable-click editable-empty" data-original-title="" title="Father Speciality"><?php echo $this->data['parentInfo'][0]['speciality']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_father_email" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['email']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_father_email" data-type="text" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Email" class="editable editable-click editable-empty" data-original-title="" title="Father Email"><?php echo $this->data['parentInfo'][0]['email']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_marital_status" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][0]['marital_status']; ?>
                    <?php } else { ?>

                      <a href="#" id="parent_marital_status" data-type="select" data-pk="<?php echo $this->data['parentInfo'][0]['id']; ?>" data-value="<?php echo $this->data['parentInfo'][0]['marital_status']; ?>" data-title="Marital Status" class="editable editable-click">
                        <?php echo $this->data['parentInfo'][0]['marital_status']; ?></a>

                    <?php } ?>                    
                  </label>
                </div>
              </section>


              <section class="col col-2">
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Late</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Name</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Nationality - 1</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Nationality - 2</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">CNIC</label>
                </div>
                <div class="row">
                  <label class="label" style="margin-top: 10px; width:100%; text-align:center;">Mobile Phone</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Profession</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Speciality</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Email</label>
                </div>
                <div class="row">
                  <label class="label" style="width:100%; text-align:center;">Marital Status</label>
                </div>                
              </section>


              <section class="col col-3">
                <div class="row">                  
                </div>
                <div class="row">
                  <label class="label parent_father_name" style="width:100%; text-align:center;">    

                   

                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['is_late']; ?>
                    <?php } else { ?>

                    <?php if( $this->data['parentInfo'][1]['is_late'] == 0) { ?>

                    <input type="checkbox" value="Mother_late" id="Mother_late" name="Mother_late" />

                    <?php } else { ?>  
<input type="checkbox" value="Mother_late" id="Mother_late" name="Mother_late" checked="checked" />
                    <?php } ?>

                    <?php } ?>   



                  </label>                      
                </div>
                <div class="row">
                  <label class="label parent_mother_name" style="width:100%; text-align:center;">

                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['name']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_name" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Name" class="editable editable-click editable-empty" data-original-title="" title="Mother Name"><?php echo $this->data['parentInfo'][1]['name']; ?></a>
                    <?php } ?>   

                  </label>                      
                </div>
                <div class="row">
                  <label class="label parent_mother_nationality1" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['nationality_1']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_nationality1" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Nationality" class="editable editable-click editable-empty" data-original-title="" title="Mother Nationality"><?php echo $this->data['parentInfo'][1]['nationality_1']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_mother_nationality2" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['nationality_2']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_nationality2" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Nationality" class="editable editable-click editable-empty" data-original-title="" title="Mother Nationality"><?php echo $this->data['parentInfo'][1]['nationality_2']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_mother_nic" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['nic']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_nic" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother CNIC" class="editable editable-click editable-empty" data-original-title="" title="Mother CNIC"><?php echo $this->data['parentInfo'][1]['nic']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <br>
                <div class="row">
                  <label class="label parent_mother_mobilephone" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['mobile_phone']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_mobilephone" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Mobile Phone" class="editable editable-click editable-empty" data-original-title="" title="Mother Mobile Phone"><?php echo $this->data['parentInfo'][1]['mobile_phone']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_mother_profession" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['profession']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_profession" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Profession" class="editable editable-click editable-empty" data-original-title="" title="Mother Profession"><?php echo $this->data['parentInfo'][1]['profession']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_mother_speciality" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['speciality']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_speciality" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Speciality" class="editable editable-click editable-empty" data-original-title="" title="Mother Speciality"><?php echo $this->data['parentInfo'][1]['speciality']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">
                  <label class="label parent_mother_email" style="width:100%; text-align:center;">
                    <?php if($this->data['can_user_edit'] == 0) { ?>
                      <?php echo $this->data['parentInfo'][1]['email']; ?>
                    <?php } else { ?>
                      <a href="#" id="parent_mother_email" data-type="text" data-pk="<?php echo $this->data['parentInfo'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Email" class="editable editable-click editable-empty" data-original-title="" title="Mother Email"><?php echo $this->data['parentInfo'][1]['email']; ?></a>
                    <?php } ?>                    
                  </label>
                </div>
                <div class="row">                  
                </div>                
              </section>
              <section class="col col-2">
                <img class="img-circle" src="<?php echo base_url() . $this->MotherPhoto; ?>" alt="User Picture">
              </section>
            </div>
          </fieldset>
          <footer>
          <!-- <button type="submit" name="fif_form_edit_button" class="btn btn-orb-org">Update   F I F</button> -->
          </footer>
        </form>




      
        <form action="<?php echo site_url()?>/sis/fif_form/edit" id="fif_edit_form" name="fif_edit_form" class="orb-form" novalidate="novalidate" method="POST">
        <header>Parents Qualification</header>
          <fieldset>
            <section class="col col-2">                
            </section>


            <section class="col col-3">
              <div class="row">
                <label class="label parent_q_level" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][0]['level']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_level" data-type="text" data-pk="<?php echo $this->data['Father_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][0]['level']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_title" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][0]['title']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_title" data-type="text" data-pk="<?php echo $this->data['Father_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][0]['title']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_institute" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][0]['institute']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_institute" data-type="text" data-pk="<?php echo $this->data['Father_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][0]['institute']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_yoc" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][0]['year_of_completion']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_yoc" data-type="text" data-pk="<?php echo $this->data['Father_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][0]['year_of_completion']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <br><br>
              <div class="row">
                <label class="label parent_q_level" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][1]['level']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_level" data-type="text" data-pk="<?php echo $this->data['Father_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][1]['level']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_title" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][1]['title']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_title" data-type="text" data-pk="<?php echo $this->data['Father_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][1]['title']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_institute" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][1]['institute']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_institute" data-type="text" data-pk="<?php echo $this->data['Father_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][1]['institute']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_yoc" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_Q'][1]['year_of_completion']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_yoc" data-type="text" data-pk="<?php echo $this->data['Father_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Father Highest Qualification"><?php echo $this->data['Father_Q'][1]['year_of_completion']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
            </section>
  

            <section class="col col-2">
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Highest Qualification Level</label>                
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Highest Qualification Title</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Institute / University</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Year of Completion</label>
              </div>
              <br><br>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Secondary Qualification Level</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Secondary Qualification Title</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Institute / University</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Year of Completion</label>
              </div>
            </section>

            <section class="col col-3">
              <div class="row">
                <label class="label parent_q_level" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][0]['level']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_level" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][0]['level']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_title" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][0]['title']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_title" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][0]['title']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_institute" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][0]['institute']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_institute" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][0]['institute']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_yoc" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][0]['year_of_completion']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_yoc" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][0]['year_of_completion']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <br><br>
              <div class="row">
                <label class="label parent_q_level" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][1]['level']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_level" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][1]['level']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_title" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][1]['title']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_title" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][1]['title']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_institute" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][1]['institute']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_institute" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][1]['institute']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_q_yoc" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_Q'][1]['year_of_completion']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_father_q_yoc" data-type="text" data-pk="<?php echo $this->data['Mother_Q'][1]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter MOther Highest Qualification" class="editable editable-click editable-empty" data-original-title="" title="Mother Highest Qualification"><?php echo $this->data['Mother_Q'][1]['year_of_completion']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
            </section>


            <section class="col col-2">                
            </section>
          </fieldset>
          <footer>
          <!-- <button type="submit" name="fif_form_edit_button" class="btn btn-orb-org">Update   F I F</button> -->
          </footer>
        </form>




<form action="<?php echo site_url()?>/sis/fif_form/edit" id="fif_edit_form" name="fif_edit_form" class="orb-form" novalidate="novalidate" method="POST">
        <header>Parents Work Detail</header>
          <fieldset>           


            <section class="col col-5">
              <div class="row">
                <label class="label parent_work_org" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_W'][0]['organization']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_org" data-type="text" data-pk="<?php echo $this->data['Father_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Organization" class="editable editable-click editable-empty" data-original-title="" title="Father Organization"><?php echo $this->data['Father_W'][0]['organization']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_dept" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_W'][0]['department']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_dept" data-type="text" data-pk="<?php echo $this->data['Father_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Department" class="editable editable-click editable-empty" data-original-title="" title="Father Department"><?php echo $this->data['Father_W'][0]['department']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_desg" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_W'][0]['designation']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_desg" data-type="text" data-pk="<?php echo $this->data['Father_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Designation" class="editable editable-click editable-empty" data-original-title="" title="Father Designation"><?php echo $this->data['Father_W'][0]['designation']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_phone" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_W'][0]['phone']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_phone" data-type="textarea" data-pk="<?php echo $this->data['Father_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Work Phone" class="editable editable-click editable-empty" data-original-title="" title="Father Work Phone"><?php echo $this->data['Father_W'][0]['phone']; ?></a>
                  <?php } ?>                  
                </label>
              </div>              
              <div class="row">
                <label class="label parent_work_address" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Father_W'][0]['address']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_address" data-type="textarea" data-pk="<?php echo $this->data['Father_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Work Address" class="editable editable-click editable-empty" data-original-title="" title="Father Work Address"><?php echo $this->data['Father_W'][0]['address']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_region" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $sibling['abridged_name']; ?>
                      <?php echo $this->data['Father_W'][0]['region']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_region" data-type="text" data-pk="<?php echo $this->data['Father_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Father Work Region" class="editable editable-click editable-empty" data-original-title="" title="Father Work Region"><?php echo $this->data['Father_W'][0]['region']; ?></a>
                  <?php } ?>                  
                </label>
              </div>              
            </section>
  

            <section class="col col-2">
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Organization</label>                
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Department</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Designation</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Work Phone</label>
              </div>              
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Work Address</label>
              </div>
              <div class="row">
                <label class="label" style="width:100%; text-align:center;">Work Region</label>
              </div>              
            </section>

            <section class="col col-5">
              <div class="row">
                <label class="label parent_work_org" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_W'][0]['organization']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_org" data-type="text" data-pk="<?php echo $this->data['Mother_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Organization" class="editable editable-click editable-empty" data-original-title="" title="Mother Organization"><?php echo $this->data['Mother_W'][0]['organization']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_dept" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_W'][0]['department']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_dept" data-type="text" data-pk="<?php echo $this->data['Mother_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Department" class="editable editable-click editable-empty" data-original-title="" title="Mother Department"><?php echo $this->data['Mother_W'][0]['department']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_desg" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_W'][0]['designation']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_desg" data-type="text" data-pk="<?php echo $this->data['Mother_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Designation" class="editable editable-click editable-empty" data-original-title="" title="Mother Designation"><?php echo $this->data['Mother_W'][0]['designation']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_phone" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_W'][0]['phone']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_phone" data-type="textarea" data-pk="<?php echo $this->data['Mother_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Work Phone" class="editable editable-click editable-empty" data-original-title="" title="Mother Work Phone"><?php echo $this->data['Mother_W'][0]['phone']; ?></a>
                  <?php } ?>                  
                </label>
              </div>              
              <div class="row">
                <label class="label parent_work_address" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_W'][0]['address']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_address" data-type="textarea" data-pk="<?php echo $this->data['Mother_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Work Address" class="editable editable-click editable-empty" data-original-title="" title="Mother Work Address"><?php echo $this->data['Mother_W'][0]['address']; ?></a>
                  <?php } ?>                  
                </label>
              </div>
              <div class="row">
                <label class="label parent_work_region" style="width:100%; text-align:center;">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['Mother_W'][0]['region']; ?>
                  <?php } else { ?>
                    <a href="#" id="parent_work_region" data-type="text" data-pk="<?php echo $this->data['Mother_W'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Enter Mother Work Region" class="editable editable-click editable-empty" data-original-title="" title="Mother Work Region"><?php echo $this->data['Mother_W'][0]['region']; ?></a>
                  <?php } ?>                  
                </label>
              </div>              
            </section>
            
          </fieldset>
          <footer>
          <!-- <button type="submit" name="fif_form_edit_button" class="btn btn-orb-org">Update   F I F</button> -->
          </footer>
        </form>






        <form action="<?php echo site_url()?>/sis/fif_form/edit" id="fif_edit_form" name="fif_edit_form" class="orb-form" novalidate="novalidate" method="POST">
        <header>Emergency Contact</header>
          <fieldset>
            <div class="row">
              <section class="col col-3">              
                <label class="label">Name</label>
              </section>
              <section class="col col-4">
                <label class="label family_ec_name">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['ECInfo'][0]['name']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_ec_name" data-type="text" data-pk="<?php echo $this->data['ECInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Emergency Contact Person Name" class="editable editable-click editable-empty" data-original-title="" title="Emergency Contact Person Name"><?php echo $this->data['ECInfo'][0]['name']; ?></a>
                  <?php } ?>
                </label>
              </section>
            </div>
            <div class="row">
              <section class="col col-3">              
                <label class="label">Email</label>
              </section>
              <section class="col col-4">
                <label class="label family_ec_email">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['ECInfo'][0]['email']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_ec_email" data-type="text" data-pk="<?php echo $this->data['ECInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Emergency Contact Person Email" class="editable editable-click editable-empty" data-original-title="" title="Emergency Contact Person Email"><?php echo $this->data['ECInfo'][0]['email']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>
            <div class="row">
              <section class="col col-3">              
                <label class="label">Phone</label>
              </section>
              <section class="col col-4">
                <label class="label family_ec_phone">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['ECInfo'][0]['phone']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_ec_phone" data-type="text" data-pk="<?php echo $this->data['ECInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Emergency Contact Person Phone" class="editable editable-click editable-empty" data-original-title="" title="Emergency Contact Person Phone"><?php echo $this->data['ECInfo'][0]['phone']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>
            <div class="row">
              <section class="col col-3">              
                <label class="label">Relationship (with student)</label>
              </section>
              <section class="col col-4">
                <label class="label family_ec_relationship">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['ECInfo'][0]['relationship']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_ec_relationship" data-type="text" data-pk="<?php echo $this->data['ECInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Emergency Contact Person Relationship" class="editable editable-click editable-empty" data-original-title="" title="Emergency Contact Person Relationship"><?php echo $this->data['ECInfo'][0]['relationship']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>
            <div class="row">
              <section class="col col-3">              
                <label class="label">Home Address</label>
              </section>
              <section class="col col-4">
                <label class="label family_ec_homeaddress">
                  <?php if($this->data['can_user_edit'] == 0) { ?>
                    <?php echo $this->data['ECInfo'][0]['home_address']; ?>
                  <?php } else { ?>
                    <a href="#" id="family_ec_homeaddress" data-type="text" data-pk="<?php echo $this->data['ECInfo'][0]['id']; ?>" data-placement="top" data-placeholder="Required" data-title="Emergency Contact Person Home Address" class="editable editable-click editable-empty" data-original-title="" title="Emergency Contact Person Home Address"><?php echo $this->data['ECInfo'][0]['home_address']; ?></a>
                  <?php } ?>                  
                </label>
              </section>
            </div>
          </fieldset>
        <footer>
          <!-- <button type="submit" name="fif_form_edit_button" class="btn btn-orb-org">Update   F I F</button> -->
         </footer>
        </form>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script>
function show1(ID){
  document.getElementById('guardianCNIC_'+ID).style.display ='none';
}
function show2(ID){
  document.getElementById('guardianCNIC_'+ID).style.display = 'block';
}


</script>