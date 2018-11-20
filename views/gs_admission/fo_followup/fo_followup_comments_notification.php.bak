
    <!-- New widget -->
          <div class="col-md-4  bootstrap-grid">
            <div class="powerwidget dark-red" id="error-state" data-widget-editbutton="false">
              <header>
                <h2><?php echo $student_name; ?><small>Admission History </small></h2>
              </header>
              <div class="inner-spacer">



<div class="inner-spacer" role="content">
	<div class="chat-container">
		<div class="chat-pusher">
			<div class="chat-content">
				<div class="nano2">
					<div class="nano-content">
						<div class="chat-content-inner">
							<div class="clearfix">
								<div class="chat-messages">
									<ul class="list-group chat-messages-list">


<?php 
$in_out = "in";



	if( !empty( $formHistory ) ){
		foreach( $formHistory as $fh ){
			
			if( $fh["type"] == 'Issuance' || $fh["type"] == 'Stage' || $fh["type"] == 'Status' ){ ?>
				<li class="list-group-item text-center">
					<p><?=$fh["message"];?> <?php // $fh["change_date"];?></p>
				</li><!-- adminResponse -->
			<?php }
			
			 else{
				 
				 $photo_id_type = gettype( $fh["photo_id"] ); // return string or numeric
				 $right =  'left';
				 
				 //if( is_numeric($photo_id_type) )
				 //{
					if( $Emp_id==$fh["photo_id"] )
					{
						$right =  'right';
					} 
				 //}
				 
				 
					if( $in_out == 'in' ){ $in_out = "out"; }else{ $in_out = "in"; }  ?>


					
					
					<li class="list-group-item <?=$right;?> clearfix highlight">
						<span class="user-img pull-<?=$right;?>"> 
							<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" width="50" height="50" />
						</span>
						<div class="chat-body clearfix">
                      		<div class="header"> <span class="name"><?=$fh["reason"];?></span>
						  	<span class=" badge"><!--<i class="fa fa-clock-o"></i>--><?=$fh["change_date"];?></span> </div>
	                      	<p> <?php echo $fh["message"]; ?> </p>
	                    </div>
<?php /* ?>
<div class="avatarLeft col-md-2">

 <img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" width="50" height="50" /> 
</div><!-- avatarLeft -->




	<p>
	
	<?php if( $fh["reason"] != '' ){
		$reason = explode("on", $fh["reason"] );
	?>
		<strong> <?=$fh["reason"];?> </strong>
	<?php }?>
	
	
	<br /><small> <?php echo $fh["message"]; ?></small>
	</p>
<span class="commentDate"><?=$fh["change_date"];?></span><!-- commentDate -->
<?php */ ?>
					</li><!-- in -->
					
			<?php }// end type
			
		}// End Foreach
	}
	
	?>


							            </ul>
							        </div>
							    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>
            </div>
          </div>

       
    