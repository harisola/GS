<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
.tg .tg-nrw8{font-size:14px}
.tg .tg-9dqs{font-weight:bold;font-size:15px;text-align:center}
.tg .tg-huh2{font-size:14px;text-align:center}
.tg .tg-qnmb{font-weight:bold;font-size:16px;text-align:center}
.tg .tg-0klj{font-size:13px;text-align:center}
</style>
<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">


  <?php 
    $LoopCounter = 0;
    $previousSection = "";
    $class_teacher_login = "";
    $class_teacher_confirmtpa = "";
    $class_teacher_atdchanges = "";
  ?>
  <?php foreach ($this->ConfirmTPA_Grades as $Grade) { ?>    
    <div class="powerwidget cold-grey" id="report_confirm_tpa_<?php echo $Grade['grade_name']; ?>" data-widget-editbutton="false" role="widget" style="">
      <header role="heading">
        <h2><?php echo  $Grade['grade_name']; ?></h2>
      <div class="powerwidget-ctrls" role="menu">
        <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
      </div><span class="powerwidget-loader"></span></header>
      <div class="inner-spacer" role="content" style="overflow-x:scroll ; overflow-y: hidden;">
        <div class="assign_teacher_a1_image">
          <!-- <img class="img-rounded img-responsive" src="<?php echo site_url()?>/staff_integration/setup_role_teacher_pn/printForm" alt="generated image" style="float: left; width: 100%"> -->
        </div>        
        <table class="table table-striped table-hover tg">          
          <tr>
            <?php for($i=0; $i<$this->totalDays; $i++) { ?>
              <?php if($i==0) { ?>
                <th class="tg-9dqs" colspan="4"><?php echo $this->Day[$i]; ?></th>
              <?php } else { ?>            
                <th class="tg-9dqs" colspan="3"><?php echo $this->Day[$i]; ?></th>
              <?php } ?>
            <?php } ?>
          </tr>          
          <tr>
            <td class="tg-huh2">Section</td>

            <?php for($i=0; $i<$this->totalDays; $i++) { ?>
              <td class="tg-huh2">Login</td>
              <td class="tg-huh2">Confirm</td>
              <td class="tg-huh2">Changes</td>
            <?php } ?>
          </tr>
          
            <?php foreach ($this->ConfirmTPA_Day[$LoopCounter] as $DayData) { ?>                
                <?php if($DayData['grade_name'] == $Grade['grade_name'] && $DayData['section_name'] != $previousSection) { ?>
                    <tr>
                        <td class="tg-qnmb"><?php echo $DayData['section_name']; ?></td>
                        
                        <?php if($DayData['type_name'] == 'Co Teacher' && ($DayData['login_time'] != "" || $DayData['confirm_tpa'] != "" || $DayData['atd_changes'] !="")) { ?>
                            <td class="tg-0klj"><span class="badge">c</span><?php echo $DayData['login_time']; ?></td>
                            <td class="tg-0klj"><span class="badge">c</span><?php echo $DayData['confirm_tpa']; ?></td>
                            <td class="tg-0klj"><span class="badge">c</span><?php echo $DayData['atd_changes']; ?></td>
                        <?php } else { ?>
                            <td class="tg-0klj"><?php echo $DayData['login_time']; ?></td>
                            <td class="tg-0klj"><?php echo $DayData['confirm_tpa']; ?></td>
                            <td class="tg-0klj"><?php echo $DayData['atd_changes']; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            <?php $previousSection = $DayData['section_name']; $class_teacher_login =  $DayData['login_time']; 
                  $class_teacher_confirmtpa = $DayData['confirm_tpa']; $class_teacher_atdchanges =  $DayData['atd_changes'] ?>
            <?php } ?>
        </table>
      </div>
    </div>
  <? $LoopCounter++; ?>
  <?php } ?>


</div>