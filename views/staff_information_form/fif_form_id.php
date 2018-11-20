<style>
.page-header{display:none;}
</style>
<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">

  <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="power-forms-grid" data-widget-editbutton="false" role="widget" style="">
  <h6 style="color:#fff;margin-left:20px;font-size:18px;"> TIF-B | Form </h6>
   
<div class="inner-spacer" role="content">

<form action="<?php echo site_url()?>/staff_information_form_basic/tifb" id="visitor_guest_assignedcard_form" name="visitor_guest_assignedcard_form" class="orb-form" novalidate="novalidate" method="POST">
          <!-- <header>Enter GS-ID or GF-ID to view Family Information</header> -->
          <?php
            if( !empty( $noRecordFound ) ) {
				echo '<div class="callout callout-danger">' .$noRecordFound . "</div>";              
            } 
          ?>
          <fieldset>
            <div class="row">
              <section class="col col-2">              
                <label class="label"> GT-ID </label>
                <label class="input">
                  <input type="text" name="gs_id" autofocus="autofocus" placeholder="GT-ID" id="searchGtIDFitB" />
				  <!--input type="text" name="gs_id" id="gs_id" placeholder="GS-ID" autofocus="autofocus" -->
                </label>
              </section>
              <!--section class="col col-2">
                <label class="label">GF ID</label>
                <label class="input">
                  <input type="text" name="gf_id" id="gf_id" placeholder="GF-ID">
                </label>
              </section -->              
            </div>
          </fieldset>
          <footer>
            <button type="submit" class="btn btn-orb-org">Search</button>            
          </footer>
        </form>
      </div>
    </div>
  </div>