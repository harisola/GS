<div class="col-md-4  bootstrap-grid sortable-grid ui-sortable">
   <!-- <div class="col-md-6 bootstrap-grid"> --> 
   <!-- Applicant Form -->
   <div class="powerwidget powerwidget-sortable dark-blue" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
         <h2>Grade<small>Program</small></h2>
         <div class="powerwidget-ctrls" role="menu">
            <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
            <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
         </div>
         <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
            <form action="" id="grade-form" class="orb-form" novalidate="novalidate" method="POST">
               <header>Grade|Section|Subject</header>
               <fieldset>
                  <section>
                     <label class="label"><b>Select Grade</b></label>
                     <label class="select">
                        <select name="grade" onchange="fetch_select(this.value)">
                           <option  id="" value="">Grades Name</option>
                           <?php if($grade != null) { ?>
                           			<?php	foreach ($grade as  $value) { ?>
                           					<option value="<?php echo $value->id ?>" ><?php echo $value->name; ?> </option>
                           			<?php	} ?>
                           		<?php	} ?>
                         
                         </select>
                        <i></i> 
                     </label>
                  </section>
                  <div id='section'>
                  </div>
                  <div id='subject'>
                  </div>
                  <div id='teacher'>
                  </div>
                  <div id='term'>
                  </div>
               </fieldset>
               <footer>
                  <button type="submit" class="btn btn-orb-org">Submit</button>
                  <button type="reset" class="btn btn-orb-org" style="float: right;">Reset </button>
               </footer>
            </form>
         </div>

   </div>
</div>
<!-- End of Applicant form -->

<!-- Get the grade_id and upload the response of section -->

<script type="text/javascript">
	function fetch_select(val)
	{
      var grade = val;
		$.ajax({
			type:"POST",
			url:"<?php echo base_url(); ?>index.php/grade_section/sg_ajax/section",
			cache:false,
			data:{grade_id:val},
         dataType:'html',
			success:function(response)
			{
				$('#section').html(response);
            
			}
		});

      

	}
</script>