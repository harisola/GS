<div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
	<div class="powerwidget dark-red powerwidget-sortable" id="applicant_form_div" data-widget-editbutton="false" role="widget" style="">
      <header role="heading" class="ui-sortable-handle">
        <h2>Class List Freeze</h2>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">

        <?php
        $Submit = 0; 
          if(!empty($results) )
          { 
            if( $results[0]["Freeze_date"] == 0 )
            {
              $Submit = 0; 
            }else
            {
             $Submit = 1;
            } 
          } 
         ?>   

         <?php if($Submit == 0){ ?>

        <form action="<?=base_url();?>index.php/student_listing/class_list_setup_ajax/view_tab" method="POST" name="issuance" id="issuance" class="orb-form">

          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="date" name="freeze_date" id="freeze_date" required="required">
                <b class="tooltip tooltip-bottom-right">Date to freeze the current session class list</b> </label>
            </section>          
          </fieldset>


          
          <footer>            
            <input type="submit" name="btn_freeze_date" id="btn_freeze_date" class="
            btn btn-orb-org" value="Submit" />

          </footer>
        </form>
        <?php } else { ?>


           <form action="#" class="orb-form">

          <fieldset>
            <section>
              <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="date" name="" id="" />
                <b class="tooltip tooltip-bottom-right">Date to freeze the current session class list</b> </label>
            </section>          
          </fieldset>


          
          <footer>            
            

          </footer>
        </form>

        <?php } ?>
      </div>
    </div>
</div>