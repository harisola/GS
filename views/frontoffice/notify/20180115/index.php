 <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
 <style>
	.alert-blocks img {
    float: left;
    height: 40px;
    margin-right: 15px;
    width: 40px;
}
.rounded-x {
    border-radius: 50% !important;
}
</style>
 <div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="new_student_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>New<small>Student</small></h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
		<table class="table table-condensed table-bordered margin-0px">
			<thead>
				<tr>
				  <th>#</th>
				  <th>Register By</th>
				  <th>Type</th>
				  
				  <th>Show</th>
				</tr>
			</thead>
              <tbody>
				<?php $counter = 1; ?>
				<?php 
				
				if(!empty( $notify_list)){ ?> 
				<?php foreach( $notify_list AS $d ){ 
						$photo_url = base_url().$this->data['staff_150_photo_path'].$d["S_emp_id"].".png";
					?>
					  <?php if( (int)$d["N_seen"] == 0 ){ ?> 
					  <tr class="tableRow danger" id="row_id_<?=$d["N_log_id"];?>">
					  <?php }else{ ?> 
					  <tr id="row_id_<?=$d["N_log_id"];?>" class="tableRow">
						<?php } ?>
						
					
					<input type="hidden" name="" class="N_log_id" value="<?=$d["N_log_id"];?>" />
					<input type="hidden" name="" class="N_cat_id" value="<?=$d["N_cat_id"];?>" />
					<input type="hidden" name="" class="N_url" value="<?=$d["N_url"];?>" />
					<input type="hidden" name="" class="S_id" value="<?=$d["S_id"];?>" />
					<input type="hidden" name="" class="S_emp_id" value="<?=$d["S_emp_id"];?>" />
					<input type="hidden" name="" class="gs_id" value="<?=$d["gs_id"];?>" />
					<input type="hidden" name="" class="notify_to" value="<?=$d["notify_to"];?>" />
					<input type="hidden" name="" class="current_user" value="<?=$d["notify_to"];?>" />
					
					<td><?=$counter;?></td><?php $counter++; ?>
					 <td class="alert-blocks"> <img alt="" src="<?=$photo_url;?>" class="rounded-x mCS_img_loaded"> <strong><?=$d["S_name"];?></strong> <br /><?=$d["S_desgntn"];?>
					  <br /><?=$d["S_deprt"];?> </td>
                      <td class="alert-blocks "><?=$d["N_type"];?> | <?=$d["Case_Name"];?>
					  </td>
					 
                      <td>
					  <?php /*if( (int)$d["N_seen"] == 0 ){ ?> 
					  <span class="label label-danger open_show" data-id="<?=$d["N_log_id"];?>" style="cursor: pointer;">Display <small>New</small></span>
					  <?php }else{ ?> 
						<?php } */?>
						
					  <span class="label label-success open_show" data-id="<?=$d["N_log_id"];?>" style="cursor: pointer;">Display</span>
					  </td>
                    </tr>  
					<?php } ?>
					<?php }else{ ?>
						<tr>
							<td colspan="6"> Record not found! </td>
						</tr>
					<?php } ?>
                  </tbody>
                </table>
		</div>
    </div>
  </div>
  <div id="conversion">
  <?php /*?>
 <div class="col-md-6  bootstrap-grid sortable-grid ui-sortable">
	<div class="powerwidget <?php echo $title_background_color_add; ?> powerwidget-sortable" id="left_side_div" data-widget-editbutton="false" role="widget">
      <header role="heading">
        <h2>Student </h2>
        <div class="powerwidget-ctrls" role="menu">
          <a href="#" class="button-icon powerwidget-fullscreen-btn"><i class="fa fa-arrows-alt "></i></a>
          <a href="#" class="button-icon powerwidget-toggle-btn"><i class="fa fa-chevron-circle-up "></i></a>
        </div>
        <span class="powerwidget-loader"></span>
      </header>
      <div class="inner-spacer" role="content">
        <div class="chat-container">
			<div class="chat-pusher">
			  <div class="chat-content"><!-- this is the wrapper for the content -->
				<div class="nano2"><!-- this is the nanoscroller -->
				  <div class="nano-content">
					<div class="chat-content-inner"><!-- extra div for emulating position:fixed of the menu --> 
					  <div class="clearfix">
						<div class="chat-messages">
						  <ul id="chat-messages-list">
							<li class="left clearfix">
							  <div class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" /> </div>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Gluck Dorris</span><span class="name"></span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent porttitor nulla vitae interdum fermentum. Ut in vulputate neque. Praesent luctus lacus a dolor tempus pellentesque. Cras sit amet urna eu augue suscipit eleifend. Mauris mollis pharetra faucibus. Phasellus eu massa quam. Nunc id metus placerat neque feugiat commodo. </p>
							  </div>
							</li>
							<li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Anton Durant</span><span class=" badge"><i class="fa fa-clock-o"></i>13 mins ago</span> </div>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
								  dolor, quis ullamcorper ligula sodales. </p>
							  </div>
							</li>
							<li class="left clearfix"><span class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span> </div>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
								  dolor, quis ullamcorper ligula sodales. </p>
							  </div>
							</li>
							<li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"><span class="name">Muchu</span><small class="badge"><i class="fa fa-clock-o"></i>15 mins ago</small></div>
								<p>Nunc ipsum dui, tempus id sagittis eu, rutrum ac libero. Morbi non enim a tortor pulvinar feugiat at consectetur nunc. Curabitur pulvinar tincidunt nisi id bibendum. Nulla ut diam iaculis, venenatis velit hendrerit, fringilla arcu. Mauris accumsan pulvinar augue, non blandit justo vestibulum a. Proin non eros semper, accumsan nisl in, imperdiet justo. Pellentesque convallis commodo porttitor. Nam feugiat dignissim felis sed tempor. Sed pretium eros nec mi semper aliquam. Phasellus eget accumsan felis. Nulla varius risus quis dapibus porta. Donec vel magna viverra, semper velit eu, adipiscing arcu. Integer sollicitudin elementum est eget ullamcorper. Mauris eget sollicitudin erat. Nullam et lacinia nibh, a aliquam nunc. Curabitur ullamcorper metus ac purus commodo, sit amet mattis arcu mollis. </p>
							  </div>
							</li>
							<li class="left clearfix"><span class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Gluck Dorris</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
								  dolor, quis ullamcorper ligula sodales. </p>
							  </div>
							</li>
							<li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Anton Durant</span><span class=" badge"><i class="fa fa-clock-o"></i>13 mins ago</span> </div>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
								  dolor, quis ullamcorper ligula sodales. </p>
							  </div>
							</li>
							<li class="left clearfix"><span class="user-img pull-left"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span> </div>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
								  dolor, quis ullamcorper ligula sodales. </p>
							  </div>
							</li>
							<li class="right clearfix"><span class="user-img pull-right"> <img src="http://placehold.it/150x150" alt="User Avatar" class="img-circle" /> </span>
							  <div class="chat-body clearfix">
								<div class="header"> <span class="name">Spiderman</span> <span class="badge"><i class="fa fa-clock-o"></i>14 mins ago</span></div>
								<p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
								  dolor, quis ullamcorper ligula sodales. </p>
							  </div>
							</li>
							
						  </ul>
						</div>
					  </div>
					</div>
					
					<!-- /chat-content-inner --> 
				  </div>
				</div>
				
				<!-- /nano --> 
				
			  </div>
			  
			  <!-- /chat-content --> 
			</div>
			<!-- /chat-pusher --> 
		  </div>
					  
					    <!--Chat-form -->
                    <div class="chat-message-form">
                      <div class="row">
                        <div class="col-md-12">
                          <textarea placeholder="Write Your Message Here" class="form-control margin-bottom" rows="2"></textarea>
                        </div>
                        
                        <div class="col-md-12">
                          <button class="btn btn-info pull-right send-message" type="button">Chat!</button>
                        </div>
                      </div>
                    </div>
					
                
             
              
    
      
            
         
      </div>
    </div>
  </div>
  <?php */ ?>
  </div>