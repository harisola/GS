<div class='row'>
   <div class='col-md-12'>
      <div class='powerwidget dark-red'>
     <h6 style="color:#fff;margin-left:20px;font-size:18px;"> Select Academic And Grade | Form </h6>
     <div class='inner-spacer'>
      <form action='' class='orb-form' method='post'  id='academic-subject'>
         <div class='col-md-2'>
              <section>
             <!-- <label class="label">Academic Session</label> -->
             <label class='select'>
              <select name = 'academic' id = 'academic-change'>
               <option value ='0'selected disabled>Academic Session</option>
                <?php foreach ($academic_session as $value) { ?>
                 <option value="<?php echo $value->id; ?>"><?php echo $value->name ?></option>
                <?php }  ?>
              </select>
              <i></i>
             </label>
            </section>
         </div>
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

         <div class='col-md-1'>
            <button class='btn btn-primary btn-search'>Submit</button>
         </div>
      </form>
     </div>
   </div>
</div>
</div>

<div id='table-update'>
</div>

