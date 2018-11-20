<style>
.textCenter {
text-align:center;  
}
.imageCenterDefault {
background: #f3f3f3;
width: 360px;
border-radius: 50%;
padding: 50px;
margin: 0 auto;
border: 1px solid #000;
}
.IN img {
border-radius:50%;
border:8px solid #008e00;
}
.OUT img {
border-radius:50%;
border:8px solid #a93b3b;
}
.IN .timeIn {
	width: 400px;
margin: 0 auto;
background: #286033;
color: #fff;
font-size: 26px;
border: 2px solid #015801;
padding: 5px 10px;
height: 50px;
display:inline-block;
}
.OUT .timeOut {
	width: 400px;
margin: 0 auto;
background: #c13232;
color: #fff;
font-size: 26px;
border: 2px solid #a93b3b;
padding: 5px 10px;
height: 50px;
display:inline-block;
}
.leftFloat {
float:left;
}
.rightFloat {
float:right;    
}
.inner-spacer {
padding-bottom:40px;    
}
hr {
float:left;
width:100%; 
}
.SiblingsHere img {
border:2px solid #888;  
}
.SiblingsHere .col-md-2 {
display:inline-block;   
float:none;
}
.SiblingsHere .col-md-2 h5 {
font-weight:normal; 
}
.overlayOnTop {
position: absolute;
background: #f0f0ed;
width: 100%;
height: 100px;
top: 0px;
}
.grayBorder img {
border-color:#888;  
}
.Error  {
background: #d84444;
color: #fff;
font-weight: normal !important;
padding: 10px;
margin-top: 50px;
}
.Error h2 {
font-weight:normal; 
}
.main_location_code{
	width:100%;
	text-align:center;
}
.navbar.orbmm {
	display:none !important;		
}
.breadcrumb {
	display:none !important;	
}
.main-wrap {
	top:0 !important;	
}
.content-wrapper {
    box-shadow: none;
	    margin: 0;
	min-height:0 !important;
	overflow:hidden !important;
}
.powerwidget .inner-spacer {
	margin-top:20px;	
}
.powerwidget > header h2 {
    height: 100%;
    letter-spacing: normal;
    width: 62%;
    float: left;
    font-size: 28px;
    position: relative;
    margin: 0;
    text-align: right;
    font-weight: normal;
    padding: 10px 0;
}
.powerwidget > header {
    padding: 0px 0 3px 0 !important;
    float: left !important;
    width: 100% !important;
	height:auto !important;
}
</style>
<div class="content-wrapper main-content-toggle-left row" style="margin-bottom:30;">

<div class="col-md-3">
	

<!-- End .powerwidget --> 
<form id="tapin_form" action="" method="">
	<input type="text" name="rfid_dec" id="rfid_dec" autofocus value="" autocomplete="off" maxlength="10"/>
	<input type="button" value="get content" id="btn_tapin" />
</form>
<div class="overlayOnTop"></div><!-- .overlayOnTop -->
<div class="main_location_code" style="margin-top:-23px;display:none; ">
<div class="powerwidget dark-red">
	<header role="heading" class="ui-sortable-handle">
	<h2>Station</h2>
		<div class="powerwidget-ctrls" role="menu" id="setFocus_div">
		<a href="#" class="button-icon"><i class="fa fa-refresh "></i></a>
	</div>
	<span class="powerwidget-loader"></span>
	</header>
	<div id="location_code1"></div>
</div>
		
</div>



</div><!-- col-md-3 -->






<div class="col-md-6">
	<div class="powerwidget dark-red powerwidget-sortable" id="gen_attendance_po" data-widget-editbutton="false" role="widget" style="">
	
		  <header role="heading" class="ui-sortable-handle">
				<h2 class="">Attendance Tap In<!-- <small></small> --></h2>
				<div class="powerwidget-ctrls" role="menu" id="setFocus_div">
					<a href="#" class="button-icon"><i class="fa fa-refresh "></i></a>
				</div>
				<span class="powerwidget-loader"></span>
		  </header><!-- header -->
		  
		  

		  <div id="inner_content">
			  <div class="inner-spacer" role="content" style="height: 75vh;">
					<div class="requestTapIn textCenter">
						<div class="imageCenterDefault">
							<img src="<?php echo base_url() ?>components/gs_theme/images/nfc_updated.png" width="160" />
						</div><!-- imageCenter -->
					</div><!-- requestTapIn -->
			  </div><!-- inner-spacer -->
		  </div>

	</div><!-- powerwidget -->
</div><!-- col-md-6 -->

<div class="col-md-3">

<div class="main_location_code" style="display:none;">
<div class="powerwidget dark-red">
	<header role="heading" class="ui-sortable-handle">
	<h2>Station</h2>
		<div class="powerwidget-ctrls" role="menu" id="setFocus_div">
		<a href="#" class="button-icon"><i class="fa fa-refresh "></i></a>
	</div>
	<span class="powerwidget-loader"></span>
	</header>
	<div id="location_code2"></div>
</div>
		
</div>


	
</div>
	<!-- End .powerwidget --> 
</div><!-- col-md-3 -->
