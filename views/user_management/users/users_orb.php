
  <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
    
    <div class="powerwidget dark-red powerwidget-sortable" id="user_form" data-widget-editbutton="true" role="widget">
      <header role="heading">
        <h2>New User<small>Registration</small></h2>
        <div class="powerwidget-ctrls" role="menu"> 
          <!--<a href="#" class="button-icon powerwidget-delete-btn"> <i class="fa fa-times-circle"></i></a>-->
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>

        <span class="powerwidget-loader"></span>
      </header>

      <div class="inner-spacer" role="content">          
        <!-- New user form opening -->
        <form id="new_user_form" action="<?php echo site_url()?>/admin/users/add" method="post" enctype="multipart/form-data" class="orb-form" novalidate="novalidate">
        <!-- New user form opening -->          
          <fieldset>
            <div class="row">
              <section class="col col-6">
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" id="first_name" name="first_name" placeholder="First Name">
                </label>
              </section>

              <section class="col col-6">
                <label class="input"> <i class="icon-append fa fa-user"></i>
                  <input type="text" id="last_name" name="last_name" placeholder="Last Name">
                </label>
              </section>
            </div>

            <div class="row">
              <section class="col col-6">
                <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                  <input type="email" id="email" name="email" placeholder="E-mail">
                </label>
              </section>

              <section class="col col-6">
                <label class="input"> <i class="icon-append fa fa-phone"></i>
                  <input type="tel" id="phone" name="phone" id="phone" placeholder="xxxx-xxxxxxx">
                </label>
              </section>
            </div>
          </fieldset>
        
          <fieldset>
            <div class="row">
              <section class="col col-6">
                <label class="input"> <i class="icon-append fa fa-asterisk"></i>
                  <input type="text" id="password" name="password" placeholder="Password">
                  <b class="tooltip tooltip-bottom-left">Password must contain atleast 8 characters</b>
                </label>
              </section>

              <section class="col col-6">
                <label class="input"> <i class="icon-append fa fa-asterisk"></i>
                  <input type="text" id="password_confirm" name="password_confirm" placeholder="Password">
                  <b class="tooltip tooltip-bottom-left">Re-type password</b>
                </label>
              </section>
            </div>
          </fieldset>          

          <fieldset>
            <section>
              <label class="label">Choose Role</label>
              <label class="select">
                <select name="user_role">
                  <?php foreach ($groups as $group){ 
                    if ($group->name != 'admin') {
                  ?>
                    <option value="<?php echo $group->id; ?>"><?php echo $group->dname; ?></option>;
                  <?php }} ?>
                </select>
                <i></i> </label>
            </section>
          </fieldset>                      

          <footer>
            <button type="submit" class="btn btn-orb-org">Submit</button>
          </footer>       
        </form>
      </div>
    </div>
  </div>
