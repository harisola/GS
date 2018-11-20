<div id="mainDiv">
<div id="content_id">
<div class="col-md-6 bootstrap-grid sortable-grid ui-sortable">       
  <!-- Subject Setup -->    
    
  <div class="powerwidget dark-red" id="new_subject_div" data-widget-editbutton="false" role="widget" style="">
    <header role="heading" class="ui-sortable-handle">
      <h2>School Level<small>Subjects Setup.</small></h2>
      <div class="powerwidget-ctrls" role="menu">
        <!-- <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a> -->
        <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
      </div>
      <span class="powerwidget-loader"></span>
    </header>
    <div class="inner-spacer" role="content">
	
      <form id="subjectSubjectForm" name="subjectSubjectForm" class="orb-form" novalidate="novalidate" method="POST">
      
                             
        <fieldset>
          <section>
            <label class="input"> <i class="icon-append fa fa-asterisk"></i>
              <input type="text" name="sname" id="sname" value="" placeholder="Display Name" autofocus="autofocus">
              <b class="tooltip tooltip-bottom-right">Please mention the display Name</b> </label>
          </section>

          <section>
            <label class="input"> <i class="icon-append fa fa-asterisk"></i>
              <input type="text" name="sdname" id="sdname" value="" placeholder="Code" required="required">
              <b class="tooltip tooltip-bottom-right">Please mention Subject Code name</b> </label>
          </section>
		  
		  
		  <section>
            <label class="input"> <i class="icon-append fa fa-asterisk"></i>
              <input type="text" name="spriority" id="spriority" placeholder="Subject Priority" required="required">
              <b class="tooltip tooltip-bottom-right">Please Subject Priority From 0 to 100</b> </label>
          </section>
		  
		  
        </fieldset>        
      
        <footer>            
          <button type="submit" name="new_subject_button" class="btn btn-orb-org">Create</button>
          <!--button type="button" style="margin-left:165px;" name="new_subject_reset_button" class="btn btn-default">Reset</button -->
        </footer>

      </form>
	  
	  </div>
    </div>
  </div>
  
</div>

<div id="showList">


<div class="col-md-6 bootstrap-grid">

	<div class="powerwidget cold-grey" id="nestable-1" data-widget-editbutton="false">
		<header> <h2>Subjects<small>Lists</small></h2> </header>
		<div class="inner-spacer">
			<menu id="nestable-menu">
				<button data-action="expand-all" class="btn btn-primary" type="button">Expand All</button>
				<button data-action="collapse-all" class="btn btn-primary" type="button">Collapse All</button>
			</menu>
		<div class="dd" id="nestable">
			<?php echo $this->SubjectList; ?>            
		</div>
	
	
	
	
		</div>
	</div>
	
	

		
</div>	
	
</div>

		
		
</div> <!-- // End main div // -->



		

<style>
.edit {
    background-color: hsl(343, 33%, 96%);
    border-radius: 4px;
    color: hsl(345, 69%, 46%);
    font-size: 0.95em;
    padding: 1px 3px;
    white-space: nowrap;
}

</style>