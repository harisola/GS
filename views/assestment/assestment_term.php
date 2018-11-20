<div class="col-md-4 bootstrap-grid" > 
  <!-- New widget -->
<div class="powerwidget dark-blue sortable-grid ui-sortable" id="masking-rulez bootstrap-forms-grid " data-widget-editbutton="false" role='widget'>
  <header role="heading">
   <h2>New<small>Term</small></h2>
    <div class="powerwidget-ctrls" role="menu">
      <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
      <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
    </div>
    <span class="powerwidget-loader"></span>
  </header>
  <div id = 'editTerm'>
    <div class="inner-spacer" role='content'>
      <div id='alert_validation' class='callout callout-danger' style="display: none;"></div>
        <div id='alert_insert' class="callout callout-info" style="display: none;"> Data Inserted Successfully </div>
          <form action="" class="form-horizontal orb-form" role='form' method='post' id ='order-form' >
            <header>Term Registration Form</header>
            <fieldset>
      	     <section>
              <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Term Name" name='assest_name' autofocus="autofocus" id = 'assest_name'/>
                <b class="tooltip tooltip-bottom-right">Enter the Name</b></label>
            </section>
            <section>
              <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
                <input type="text" placeholder="Enter Display name" name='display' id='display' />
                <b class="tooltip tooltip-bottom-right">Enter the Display Name</b></label>
            </section>
            <section>
              <label class="input"> <i style='color:#757575;' class="icon-append fa fa-asterisk"></i>
              <input type="text" placeholder="Enter Short Name" name='assest_ncode' id='assest_ncode'/>
              <b class="tooltip tooltip-bottom-right">Enter the Short Name</b>
              </label>
            </section>                      
            <fieldset>
          <footer>
            <button type="submit" class="btn btn-orb-org" id='send'>Submit</button>
            <button type="reset" class="btn btn-orb-org" style='float:right'>Reset</button>
         </footer>
        </form>
    </div>
  </div> 
</div>
</div>


