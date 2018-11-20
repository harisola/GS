<link rel="stylesheet" media="screen" href="<?php echo base_url();?>/components/gs_theme/css/bootstrap.css" />
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>/components/gs_theme/css/bootstrap-theme.css" />
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>/components/gs_theme/css/style.css" />
<link rel="stylesheet" media="screen" href="<?php echo base_url();?>/components/gs_theme/css/mobile.css" />
<script src="<?php echo base_url();?>/components/gs_theme/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>/components/gs_theme/js/bootstrap.js"></script>

<script src="<?php echo base_url();?>/components/gs_theme/js/b2c23c8eb4.js"></script>
<link href="<?php echo base_url();?>/components/gs_theme/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<style type="text/css">
.content-wrapper {
	width:  100%;
}
.container {
	width: 990px;
	margin: 0 auto;
}
.MaroonBorderBox {
	margin-top: 20px;	
}
.TimelineReview .avatarLeft img {
    border: 1px solid #888;
    border-radius: 50%;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    width: 50px;
}
.hideonPrint {
	    background: #60c760;
    padding: 2px 12px;
    border: 0 none;
    color: #fff;
    border: 1px solid green;
    letter-spacing: 1.0;
    position: absolute;
    right: 14px;
    top: 25px;
    font-size: 16px;
}
@media print {
	* {
		font-family: tahoma;
	}
  	.MaroonBorderBox {
		width: 100%;
		border: 1px solid #000;	
		float: left;
	}
	.MaroonBorderBox h3 {
		color: #fff;
		background: #000;
		padding-left: 10px;
		padding-bottom: 10px;
		border-bottom: 1px solid;
		margin-top: -3px;
		padding-top: 10px;
		font-size: 2em;
		font-family: tahoma;
	}
	.TimelineReview li {
		float: left;
    	/*width: 100%;*/
	}
	.out .systemResponse {
	    border-right: 2px solid #e26a6a;
	    padding-bottom: 10px;
	    text-align: right;
	    border-left: 0;
	    width: 85%;
	    float: left;
	    margin-bottom: 20px;
	    background: #f2f2f2;
	    padding-right: 10px;
	}
	.out .commentDate {
	    font-size: 12px;
	    left: 10px;
	    bottom: 5px;
	    color: #888;
	}
	.out .avatarLeft {
	    text-align: left;
	    width: 12%;
	    float: right;
	}
	p {
		margin:0;
	}
	.in, .out {
		width: 100%;
	}
	.in .systemResponse {
	    border-left: 2px solid #1BBC9B;
	    padding-bottom: 10px;
	    width: 85%;
	    float: left;
	    margin-bottom: 20px;
	    border-right: 0;
	    text-align: left;
	    background: #f2f2f2;
	    padding-left: 10px;
	}
	.in .avatarLeft {
	    text-align: right;
	    width: 5%;
	    float: left;
	    margin-right: 3%;
	}
	.TimelineReview ul {
		list-style: none !important;
	}
	.headingDiv{
		text-align: center;
		border-bottom: 1px solid #ccc; 
		padding-bottom: 10px;
	}
	.adminResponse{
		width: 94.5%;
		margin-right: 50px;
		float: left;
		background: #f2f2f2;
		text-align: center;
		margin-bottom: 20px;
		padding: 10px 0;
	}
	.hideonPrint {
		display: none;
	}
	.info {
		padding-bottom: 5px;
	}
}
</style>

<div class="content-wrapper main-content-toggle-left"> 
	<div class="container">
		<div class="row">
			<div class="col-md-12" id="OlaCalendar">
			<h3 class="headingDiv">Timeline for Admission Process</h3>
			<div class="informationDivforPrint">
				<div class="info"><strong>Name:</strong> <?php echo $student_name; ?></div>
				<div class="info"><strong>Form No:</strong> 19/0002</div>
				<div class="info"><strong>Current Standing:</strong> Awaiting for Submission</div>

			</div>
			<button onclick="myFunction()" class="hideonPrint">Print</button>
			<div class="MaroonBorderBox">
				<!-- <h3> <?php echo $student_name; ?> </h3> -->
				<div class="inner" style="padding-bottom:0;">

					<div class="TimelineReview">
						<ul>

			<?php 

			$in_out = "out";
			if( !empty( $formHistory ) ){
				foreach( $formHistory as $fh ){ ?>
					<?php if( $fh["user_id"] == 1 ) : ?>

						<li class="adminResponse">
							<strong><?=$fh["reason"];?></strong><br />
							<p><?php echo $fh["message"]; ?> </p>
						</li>
						<?php elseif( $fh["user_id"] == $this->session->userdata("user_id")) : ?>	
							<li class="out">
								<div class="systemResponse col-md-11">
									<p>
										<strong><?=$fh["staff_name"];?></strong><br />
										<p><?php echo $fh["message"]; ?></p>
										<p><?php echo $fh["Additional_Comments"]; ?></p>

									</p>
									<span class="commentDate"><?=$fh["change_date"];?></span><!-- commentDate -->
									<span class="arrowHeadRight">&nbsp;</span>
								</div><!-- systemResponse -->
								<div class="avatarLeft col-md-1">		
									<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" />
								</div><!-- avatarLeft -->
							</li><!-- out -->
							<?php else : ?>
								<li class="in">
									<div class="avatarLeft col-md-1">		
										<img src="<?php echo base_url();?>assets/photos/hcm/150x150/staff/<?=$fh["photo_id"];?>.png" />
									</div><!-- avatarLeft -->
									<div class="systemResponse col-md-11">
										<span class="arrowHeadLeft">&nbsp;</span>
										<p>
											<strong><?=$fh["staff_name"];?></strong><br />
											<p><?php echo $fh["message"]; ?></p><br />
											<p><?php echo $fh["Additional_Comments"]; ?></p>
										</p>
										<span class="commentDate"><?=$fh["change_date"];?></span><!-- commentDate -->
									</div><!-- systemResponse -->
								</li><!-- in -->
							<?php endif; ?>	
						<?php } ?>
					<?php } ?>
				</ul>
			</div><!-- Timeline -->
		
		</div><!-- inner -->
	</div><!-- .MaroonBorderBox -->
       
    




			</div><!--- col-md-12 -->        
		</div><!-- row -->
	</div><!-- container -->
</div><!-- content-wrapper -->
<script>
function myFunction() {
    window.print();
}
</script>
