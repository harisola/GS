<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0; width:100%;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:0px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
</style>


<div class="col-md-3 bootstrap-grid sortable-grid ui-sortable">
<!-- New widget -->            
            
  <!-- End .powerwidget --> 
  <div class="powerwidget <?php echo $title_background_color_add; ?>" id="student_attendance_admin_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading">
      <h2>GS-ID</h2>
      <div class="powerwidget-ctrls" role="menu">          
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
        <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">      
      <form action="<?php echo site_url()?>/student_attendance_admin/atd_today" id="student_attendance_admin_form" name="student_attendance_admin_form" class="orb-form" novalidate="novalidate" method="POST">      

        <?php
          if(validation_errors() != false) {
            echo '<div class="callout callout-danger">' . validation_errors() . "</div>";              
          }          
        ?>

        <?php
          if(!isset($this->studentPicGRNO[0]) && count($_POST))
          {
            echo '<div class="callout callout-danger">' . 'GS-ID Not Found' . '</div>';            
          }
        ?>

        <fieldset>
          <div class="row">              
            <section class="col col-md-12">
              <label class="input">
                <?php if(count($_POST) && isset($this->studentPicGRNO[0])) { ?>
                  <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" autofocus="autofocus" value="<?php echo $this->input->post('gs_id'); ?>">
                  <table class="tg">
                    <tr>
                      <th class="tg-s6z2"></th>
                      <th class="tg-s6z2">
                        <img class="img-circle" src="
                          <?php 
                            if(file_exists($this->data['student_150_photo_path'] . $this->studentPicGRNO[0]['gr_no'] . ".png")){
                              echo base_url() . $this->data['student_150_photo_path'] . $this->studentPicGRNO[0]['gr_no'] . ".png";
                            }else{
                              echo base_url() . $this->data['student_150_photo_path'] . "NoPhoto.png";
                            }
                          ?>" alt="User Picture">
                      </th>
                      <th class="tg-s6z2"></th>
                    </tr>
                    <tr>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"><?php echo $this->studentPicGRNO[0]['abridged_name']; ?></td>
                      <td class="tg-s6z2"></td>
                    </tr>
                    <tr>
                      <td class="tg-s6z2"></td>
                      <td class="tg-s6z2"><?php echo $this->studentPicGRNO[0]['grade_name'] . "-" . $this->studentPicGRNO[0]['section_name']; ?></td>
                      <td class="tg-s6z2"></td>
                    </tr>
                  </table>
                <?php } else { ?>
                  <input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" autofocus="autofocus">
                <?php } ?>                
              </label>
            </section>            
          </div>
          <div class="ImageContainer">
        </fieldset>

        <?php if(count($_POST)) { ?>
        <footer>
          <button type="submit" class="btn btn-orb-org">Verify GS-ID</button>
          </form>
      
          <form action="<?php echo site_url()?>/student_attendance_admin/atd_today/add" method="POST" align="right">
            <input type="hidden" value="<?php echo $this->input->post('gs_id'); ?>" name="attendance_gsid">
            <button type="submit" class="btn btn-orb-org">Mark Attendance</button>
          </form>
        </footer>      
        <?php } else { ?>
        <footer>
          <button type="submit" class="btn btn-orb-org">Verify GS-ID</button>
        </footer>
      </form>
      <?php } ?>
    </div>
  </div>
</div>