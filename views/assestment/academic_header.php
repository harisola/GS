<div class="col-md-4  bootstrap-grid sortable-grid ui-sortable">
   <!-- <div class="col-md-6 bootstrap-grid"> --> 
   <!-- Applicant Form -->
   <div class="powerwidget powerwidget-sortable dark-blue" id="" data-widget-editbutton="false" role="widget">
      <header role="heading">
         <h2>Academic<small>Term</small></h2>
         <div class="powerwidget-ctrls" role="menu">
            <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
            <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
         </div>
         <span class="powerwidget-loader"></span>
      </header>
      

      <div id='editTerm'>
         <div class="inner-spacer" role="content">
            <div class="callout callout-info" style="display: none;"> Data Inserted Successfully </div>
            <form action="" id="order-form" class="orb-form" novalidate="novalidate" method="POST">
               <header>Academic Session Form</header>
               <fieldset>
                  <section>
                     <label class="label"><b>Select Academic</b></label>
                     <label class="select">
                        <select name="assessment_session_id" id="assessment_session_id">
                           <option   value="0" selected="" disabled="">Academic Session</option>
                           <?php if(!empty($academic1)) { ?>
                           <?php foreach($academic1 as $val1) {?>
                           <option value="<?php echo $val1->id; ?>"><?php echo $val1->name; ?></option>
                           <?php } ?>
                           <?php } ?>
                        </select>
                        <i></i> 
                     </label>
                  </section>
                  <section>
                     <label class="label"><b>Select Term</b></label>
                     <label class="select">
                        <select name="assessment_term_id" id='assessment_term_id'>
                           <option value="0" selected="" disabled="">Term Name</option>
                           <?php if(!empty($query1)) { ?>
                           <?php foreach ($query1 as $val) { ?>
                           <option value="<?php echo $val->id; ?>"><?php echo $val->dname; ?></option>
                           <?php }  ?>
                           <?php } ?>
                        </select>
                        <i></i> 
                     </label>
                  </section>
               </fieldset>
               <fieldset>
                  <section>
                     <label class="input"> <i class="icon-append fa fa-calendar"></i>
                     <input type="text" name="date_from" id="start" placeholder="Date From" class='date_from'/>
                     <b class="tooltip tooltip-bottom-right">Needed to enter the Date From</b>
                     </label>
                  </section>
                  <section>
                     <label class="input"> <i class="icon-append fa fa-calendar"></i>
                     <input type="text" name="date_to" id="finish" placeholder="Date To" class='date_to'/>
                     <b class="tooltip tooltip-bottom-right">Needed to enter the Date to</b>
                     </label>
                  </section>
               </fieldset>
               <fieldset>
                 <label class="toggle">
                     <input type="checkbox" name="is_active" id="box" checked value="1">
                     <i></i><label>Active</label>
                  </label>
               </fieldset>
               <footer>
                  <button type="submit" class="btn btn-orb-org">Submit</button>
                  <button type="reset" class="btn btn-orb-org" style="float: right;">Reset </button>
               </footer>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- End of Applicant form -->