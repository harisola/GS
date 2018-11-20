<div class="col-md-5  bootstrap-grid sortable-grid ui-sortable">
   <div class="powerwidget  dark-red" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
         <h2>Category<small>Grades</small></h2>
         <div class="powerwidget-ctrls" role="menu">
            <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
            <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
         </div>
         <span class="powerwidget-loader"></span>
      </header>
        <div id='edit-category'>
         <div class="inner-spacer" role="content">
            <form action="" id="order-form" class="orb-form" novalidate="novalidate" method="POST">
               <header>Assessment Category Grade</header>
               <fieldset style="padding-bottom: 0px;">
                  <section>
                     <label class="label"><b>Select Grade</b></label>
                     <label class="select">
                        <select name="grade_id" id="grade-id" >
                           <option value="0" selected="" disabled="">Grades</option>
                           <?php if(!empty($grade))  {?>
                            <?php foreach($grade as $value) {?>
                           <option value="<?php echo $value->id ?>"><?php echo $value->dname ?></option>
                           <?php } ?>
                           <?php } ?>
                        </select>
                        <i></i> 
                     </label>
                  </section>
                  </fieldset>
               <fieldset style="padding-bottom: 0px">
                  <section>
                     <div class='row'>
                      <div class='col-md-3'>
                        <label class='input' style="font-size: 20px;">Formative</label>
                        <input type="hidden" value='<?php echo $category[0]->id ?>' name='formative'/>
                      </div>  
                      <div class='col-md-4 col-xs-8'>
                         <i class="icon-append fa fa-asterisk" style="height: 38px;color: #757575"></i>
                         <!-- change in value in input  -->
                        <input type="text" name='form_weight' id='form-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[0]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
                      </div>
                        <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                        <input style="font-size:10px" type="checkbox"  name="is_fix_formative" value id='get-value-formative'  />
                        <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
                     </div>
                  </section>
               </fieldset>
               <fieldset style="padding-bottom: 0px;">
                  <section>
                     <div class='row'>
                      <div class='col-md-3'>
                        <label class='input' style="font-size: 20px;">Summative</label>
                        <input type="hidden" value='<?php echo $category[1]->id ?>' name='summative'>
                      </div>  
                      <div class='col-md-4 col-xs-8'>
                         <i class="icon-append fa fa-asterisk" style="height: 38px;color:#757575;"></i>
                         <!-- Change In value in input -->
                        <input type="text" name='summ_weight' id='summ-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[1]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
                      </div>
                         <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                        <input style="font-size:10px" type="checkbox"  name="is_fix_summative" value id='get-value-summative'  />
                        <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
                     </div>
                  </section>
               </fieldset>
               <fieldset style="padding-bottom: 0px;">
                  <section>
                     <div class='row'>
                      <div class='col-md-3'>
                        <label class='input' style="font-size: 20px;">Attendance</label>
                        <input type="hidden" value='<?php echo $category[2]->id ?>' name='attendance'>
                      </div>  
                      <div class='col-md-4 col-xs-8'>
                         <i class="icon-append fa fa-asterisk" style="height:38px;color:#757575;"></i>
                         <!-- Change In Value -->
                        <input type="text" name='att_weight' id='att-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[2]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
                      </div>

                      <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                        <input style="font-size:10px" type="checkbox"  name="is_fix_attendance" value id='get-value-attendance'  />
                        <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
                     </div>
                  </section>
               </fieldset>
               <fieldset style="padding-bottom: 0px;">
                  <section>
                     <div class='row'>
                      <div class='col-md-3'>
                        <label class='input' style="font-size: 20px;">Stationary</label>
                        <input type="hidden" value='<?php echo $category[3]->id ?>' name='stationary'>
                      </div>  
                      <div class='col-md-4 col-xs-8'>
                         <i class="icon-append fa fa-asterisk" style="height:38px;color:#757575"></i>
                         <!-- Change In Value -->
                        <input type="text" name='stat_weight' id='stat-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[3]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">
                      </div>

                      <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                        <input style="font-size:10px" type="checkbox"  name="is_fix_stationary" value id='get-value-stationary'  />
                        <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
                     </div>
                  </section>
               </fieldset>
               <fieldset style="padding-bottom: 0px">
                  <section>
                     <div class='row'>
                      <div class='col-md-3'>
                        <label class='input' style="font-size: 20px;">PTM</label>
                        <input type="hidden" name='ptm' value='<?php echo $category[4]->id ?>'>
                      </div>
                  <div class='col-md-4 col-xs-8'>
                   <i class="icon-append fa fa-asterisk" style="height: 38px;color:#757575"></i>
                    <!-- Change In Value -->
                   <input type="text" name='parent_weight' id='parent-weight' class='form-control' placeholder="Enter Weightage" value="<?php echo $category[4]->weightage; ?>" style="padding-top: 0px;padding-bottom: 0px;padding-left: 5px;">  
                  </div>
                  <label class="toggle" style="font-size:15px;text-align: center;right: 18px">
                        <input style="font-size:10px" type="checkbox"  name="is_fix_ptm" value id='get-value-ptm'  />
                        <i style="color:black;height: 19px;width: 56px; "></i><b style="float: right"></b></label>
                  </section>
               </fieldset>
                       <fieldset>
                          <div id = 'total'></div>
                       </fieldset>
                  <footer>
                     <button type="submit" class="btn btn-orb-org" id='btn-post'>Submit</button>
                     <button type="reset" class="btn btn-orb-org" style="float: right;">Reset </button>
                  </footer>
            </form>
         </div>
        </div>
   </div>
</div>
<style type="text/css">
  /* individual elements: webkit */
#form-weight::-webkit-input-placeholder { color:#555555; }
#summ-weight::-webkit-input-placeholder { color:#555555; }
#att-weight::-webkit-input-placeholder { color:#555555; }
#stat-weight::-webkit-input-placeholder { color:#555555; }
#parent-weight::-webkit-input-placeholder { color:#555555; }



/* individual elements: mozilla */
#form-weight::-moz-placeholder { color:#555555; }
#summ-weight::-moz-placeholder { color:#555555; }
#att-weight::-moz-placeholder { color:#555555; }
#stat-weight::-moz-placeholder { color:#555555; }
#parent-weight::-moz-placeholder { color:#555555; }

/*Fix CheckBoxes*/
.orb-form .toggle input:checked + i:after {
    content: 'FIX';
    text-align: right;
    font-size: 10px;
    color: #00A9AE;
    
    
}
.orb-form .toggle i:after {
  content: 'NOFIX';
  font-size: 10px;
  color: #993838;
 

}

.orb-form .toggle input:checked + i:before{
  background-color: #00A9AE;
  border-color: #00A9AE;
}

.orb-form .toggle i:before{
  background-color: #993838;
   border-color: #993838;
}



</style>