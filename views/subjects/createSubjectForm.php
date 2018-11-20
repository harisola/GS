<div class="col-md-6 bootstrap-grid sortable-grid ui-sortable">       
  <!-- Subject Setup -->    
    
  <div class="powerwidget dark-red" id="new_subject_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>School Level<small>Subjects Setup</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
	
<div class="inner-spacer" role="content">
<form id="subEditable" name="subEditable" class="orb-form">
<?php
if(!empty($results) ){
	$ID 	= (int)$results[0]["id"];
	$name 	= $results[0]["dname"];
	$dname 	= $results[0]["sname"];	
	$spriority 	= $results[0]["code"];	
}else{
	$ID 	= '';
	$name 	= '';
	$dname 	= '';
	$spriority 	= '';
}

?>
  <input type="hidden" value="<?php echo $ID?$ID:'';?>" name="scret_ID" id="scret_ID" />
	<fieldset>
	  <section>
		<label class="input"> <i class="icon-append fa fa-asterisk"></i>
		  <input type="text" name="sname" id="sname" value="<?php echo $name?$name:'';?>" autofocus="autofocus">
		  <b class="tooltip tooltip-bottom-right">Please mention the display Name</b> </label>
	  </section>

	  <section>
		<label class="input"> <i class="icon-append fa fa-asterisk"></i>
		  <input type="text" name="sdname" id="sdname" value="<?php echo $dname?$dname:'';?>" required="required">
		  <b class="tooltip tooltip-bottom-right">Please mention Subject  Code name</b> </label>
	  </section>
	</fieldset>      

 <section>
            <label class="input"> <i class="icon-append fa fa-asterisk"></i>
              <input type="text" name="spriority" id="spriority" value="<?php echo $spriority?$spriority:'';?>" placeholder="Subject Priority" required="required">
              <b class="tooltip tooltip-bottom-right">Please Set Subject Priority</b> </label>
          </section>
		  
  
	<footer>            
	  <button type="submit" name="new_subject_button" id="btn_editable" class="btn btn-orb-org">Update</button>
	  <!--button type="button" style="margin-left:165px;" name="new_subject_reset_button" class="btn btn-default">Reset</button -->
	</footer>

  </form>
</div>

    </div>
  </div>
  

