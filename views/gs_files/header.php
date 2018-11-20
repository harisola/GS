<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tamkeen</title>
<!-- Bootstrap CSS Start -->
<link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/bootstrap.css" />
<!-- <link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/bootstrap.min.css" /> -->
<link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/bootstrap-theme.css" />
<!-- <link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/bootstrap-theme.min.css" /> -->
<!-- <link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/dataTables.bootstrap4.min.css" /> -->
<!-- Bootstrap CSS end -->
<link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/style.css" />
<link rel="stylesheet" media="screen" href="<?php echo base_url()?>components/gs_theme/css/mobile.css" />
<script src="<?php echo base_url()?>components/gs_theme/js/jquery.min.js"></script>
<!-- Bootstrap JS Start -->
<script type="text/javascript" src="<?php echo base_url()?>components/gs_theme/js/bootstrap.js"></script>
<!-- <script type="text/javascript" src="<?php echo base_url()?>components/gs_theme/js/bootstrap.min.js"></script> -->
<script src="<?php echo base_url()?>components/gs_theme/js/b2c23c8eb4.js"></script>
<!-- Bootstrap JS END -->
<!-- Data Table -->
<link href="<?php echo base_url()?>components/gs_theme/css/dataTables.bootstrap.min.css" rel="stylesheet"/>
<!-- 
<script type="text/javascript" src="js/custom.js"></script>-->
</head>

<body>
	<!-- Header START -->
    <header>
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 logoArea">
                    <a href="<?php echo base_url()?>index.php/dashboard/dashboard"><img src="<?php echo base_url()?>components/gs_theme/images/logo.png" title="Generations School" /></a> &nbsp; &nbsp; 
                    <span style="font-size:26px;cursor:pointer;color:#fff;" id="OpenNav" onclick="openNav()" ><img src="<?php echo base_url()?>components/gs_theme/images/menuIcon.png" width="30" style="padding-top:8px;" /></span>
                    <span style="font-size:26px;cursor:pointer;color:#fff;display:none;" id="CloseNav" onclick="closeNav()"><img src="<?php echo base_url()?>components/gs_theme/images/menuIconClose.png" width="25" style="padding-top:10px;" /></span>
                </div><!-- col-md-3 -->
                <div class="col-md-4 text-center">
                	<span class="whiteContent"><?php echo date("D, d M Y"); ?></span>
                </div><!-- col-md-4 CenterDate-->
                <div class="col-md-4 NotificationArea">
                	
                </div><!-- .col-md-3 NotificationArea-->
            </div><!-- row -->
        </div><!-- contianer -->
    </header><!-- Header -->
    <!-- Header END -->