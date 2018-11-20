<div class="col-md-12">
	<div class="powerwidget dark-red" data-widget-editbutton="false" data-widget-deletebutton="false">
		<header>
			<h2>Roles<small>Assign Teacher View</small></h2>
		</header>
		<div class="inner-spacer">
			<form action="" method="post" class="orb-form" id='roles-teacher'>
				<div class="col-md-2">
              		<section>
             			<label class='select'>
              			<select name = 'academic' id = 'academic-change'>
               				<option value ='0'selected disabled>Academic Session</option>
               				<?php foreach($academic as $value)  { ?>
               					<option value='<?php echo $value->id; ?>'><?php echo $value->name; ?></option>
               				<?php } ?>
              			</select>
              			<i></i>
            	 		</label>
            		</section>
         		</div>
<!--          		<div class="col-md-2">
         			<section>
         				<label class="select">
         				<select name="grade" id="">
         					<option value="0" selected disabled>Grade</option>
         					<?php foreach($grade as $value) { ?>
         						<option value='<?php echo $value->id; ?>'><?php echo $value->name; ?></option>
         					<?php } ?>
         				</select>
         				<i></i>	
         				</label>
         			</section>
         		</div> -->

            <div class='col-md-2'>
               <section>
                <!-- <label class="label">Grades</label> -->
                <label class='select'>
                 <select name='grade' id = 'grade'>
                  <option value="0" selected disabled>Grade Name</option>
                 </select>
                  <i></i>
                </label>
               </section>
            </div>

         		<div class="col-md-1">
         		<button class='btn btn-primary'>Submit</button>
         		</div>
         		
			</form>
		</div>
	</div>
</div>

<div id='table-update'>
</div>