<!--div class="col-md-2 bootstrap-grid sortable-grid ui-sortable" id="setup_1"></div -->
<style>

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.error{
	display: none;
	margin-left: 10px;
}		


#setup_1{
	display:none;
}

/*
.html, body { background: #f0f0ed none repeat scroll 0 0; }
.responsive-admin-menu{     background-color: #33383d; }

*/
.content-wrapper{ min-height:0px; }
.fa-times-circle{ display:none; }
.setup_process_table tr { cursor: pointer; }
.cursor{ cursor: pointer; }

.panel > .panel-heading i {
    color: #ffffff;
    font-size: 20px;
    margin-left: 40px;
    margin-top: 0px;
}

.fa-edit, .fa-tasks { 
font-size: 13px !important; 
margin-left: 0 !important;
}
</style>
<style>


input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.error{
	display: none;
	margin-left: 10px;
}		


#setup_1{
	display:none;
}

/*
.html, body { background: #f0f0ed none repeat scroll 0 0; }
.responsive-admin-menu{     background-color: #33383d; }

*/
.content-wrapper{ min-height:0px; }
.fa-times-circle{ display:none; }
.setup_process_table tr { cursor: pointer; }
.cursor{ cursor: pointer; }



#cssload-container{
	display: none;
}
.cssload-container * {
	color: rgb(0,0,0);
	font-size: 33px;
	font-weight: 700;
	font-family: 'Open Sans', sans-serif;
}
.cssload-container {
	position: absolute;
	width: 117px;
	height: 49px;
	left: 50%;
	transform: translate(-50%, -50%);
		-o-transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		-webkit-transform: translate(-50%, -50%);
		-moz-transform: translate(-50%, -50%);
}
.cssload-container > div {
	position: absolute;
	transform-origin: center;
		-o-transform-origin: center;
		-ms-transform-origin: center;
		-webkit-transform-origin: center;
		-moz-transform-origin: center;
}
.cssload-l {
	left: 8px;
}
.cssload-i {
	left: 58px;
}
.cssload-n {
	left: 70px;
}
.cssload-g {
	left: 97px;
}
.cssload-square,
.cssload-circle,
.cssload-triangle {
	left: 29px;
}
.cssload-square {
	background: rgb(117,179,209);
	width: 23px;
	height: 23px;
	left: 31px;
	top: 12px;
	transform: scale(0);
		-o-transform: scale(0);
		-ms-transform: scale(0);
		-webkit-transform: scale(0);
		-moz-transform: scale(0);
	animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-o-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-ms-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-webkit-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-moz-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
	animation-delay: 2.3s;
		-o-animation-delay: 2.3s;
		-ms-animation-delay: 2.3s;
		-webkit-animation-delay: 2.3s;
		-moz-animation-delay: 2.3s;
}
.cssload-circle {
	background: rgb(129,212,125);
	width: 26px;
	height: 26px;
	top: 10px;
	left: 29px;
	border-radius: 50%;
	animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-o-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-ms-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-webkit-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-moz-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
	animation-delay: 0s;
		-o-animation-delay: 0s;
		-ms-animation-delay: 0s;
		-webkit-animation-delay: 0s;
		-moz-animation-delay: 0s;
}
.cssload-triangle {
	width: 0;
	height: 0;
	left: 29px;
	top: 11px;
	border-style: solid;
	border-width: 0 14.5px 24.1px 14.5px;
	border-color: transparent transparent rgb(210,121,140) transparent;
	transform: scale(0);
		-o-transform: scale(0);
		-ms-transform: scale(0);
		-webkit-transform: scale(0);
		-moz-transform: scale(0);
	animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-o-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-ms-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-webkit-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
		-moz-animation: cssload-shrinkgrow 3.45s ease-in-out infinite;
	animation-delay: 1.15s;
		-o-animation-delay: 1.15s;
		-ms-animation-delay: 1.15s;
		-webkit-animation-delay: 1.15s;
		-moz-animation-delay: 1.15s;
}


@keyframes cssload-shrinkgrow {
	0% {
		transform: scale(0);
	}
	12.5% {
		transform: scale(1);
	}
	25% {
		transform: scale(1);
	}
	33% {
		transform: scale(0);
	}
	100% {
		transform: scale(0);
	}
}

@-o-keyframes cssload-shrinkgrow {
	0% {
		-o-transform: scale(0);
	}
	12.5% {
		-o-transform: scale(1);
	}
	25% {
		-o-transform: scale(1);
	}
	33% {
		-o-transform: scale(0);
	}
	100% {
		-o-transform: scale(0);
	}
}

@-ms-keyframes cssload-shrinkgrow {
	0% {
		-ms-transform: scale(0);
	}
	12.5% {
		-ms-transform: scale(1);
	}
	25% {
		-ms-transform: scale(1);
	}
	33% {
		-ms-transform: scale(0);
	}
	100% {
		-ms-transform: scale(0);
	}
}

@-webkit-keyframes cssload-shrinkgrow {
	0% {
		-webkit-transform: scale(0);
	}
	12.5% {
		-webkit-transform: scale(1);
	}
	25% {
		-webkit-transform: scale(1);
	}
	33% {
		-webkit-transform: scale(0);
	}
	100% {
		-webkit-transform: scale(0);
	}
}

@-moz-keyframes cssload-shrinkgrow {
	0% {
		-moz-transform: scale(0);
	}
	12.5% {
		-moz-transform: scale(1);
	}
	25% {
		-moz-transform: scale(1);
	}
	33% {
		-moz-transform: scale(0);
	}
	100% {
		-moz-transform: scale(0);
	}
}
</style>
<div class="col-md-12 assessment"> 


	<div class="cssload-container" id="cssload-container">
		<div class="cssload-l">L</div>
		<div class="cssload-circle"></div>
		<div class="cssload-square"></div>
		<div class="cssload-triangle"></div>
		<div class="cssload-i">I</div>
		<div class="cssload-n">N</div>
		<div class="cssload-g">G</div>
	</div> 
	
<div id="setup_1"></div> <!-- /#setup_1 -->

<div style="display:none;"><!-- /#Don't Remove it-->
<div class="panel panel-grey">
<div class="panel-heading">
<h3 class="panel-title"><i class="fa fa-tasks"></i> Formative : PRATICAL2 <span class="glyphicon glyphicon-remove close_setup_4 pull-right cursor"></span></h3>
</div>
<div class="panel-body orb-form"></div>
</div>

</div>

<div id="setup_5"></div>
<div id="userAgent">
<?php
if( !empty( $user_agent ) ){ ?>
	
	<input type="hidden" name="user_ip" id="user_ip" value="<?php echo $user_agent["ip"]; ?>" />
	<input type="hidden" name="user_agent" id="user_agent" value="<?php echo $user_agent["user_agent"]; ?>" />
	<input type="hidden" name="user_id2" id="user_id2" value="<?php echo $user_agent["user_id"]; ?>" />
	
<?php }
?>
</div>
<div id="setup_2">
<style>

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}

.error{
	display: none;
	margin-left: 10px;
}		


#setup_1{
	display:none;
}

/*
.html, body { background: #f0f0ed none repeat scroll 0 0; }
.responsive-admin-menu{     background-color: #33383d; }

*/
.content-wrapper{ min-height:0px; }
.fa-times-circle{ display:none; }
.setup_process_table tr { cursor: pointer; }
.cursor{ cursor: pointer; }
</style>

 <div class="panel panel-success" id="most-form-elements">
 

<div class="panel-body">

<?php
$program = '';  
//var_dump($variables);
if( !empty( $variables ) ){
	
	$program = $variables['Grade'];
	$subjectCode = $variables['subjectCode'];
	$optional = (int)$variables['optional'];
	$secName = $variables['secName'];
	$GPID = $variables['GPID'];
	$sectionID = $variables['sectionID'];
	$gradeID = $variables['grdID'];
	$prgmID = $variables['programmeID'];
	$gpp_id = $variables['gpp_id'];
	$Subject = $variables['Subject'];
	$subjectID = $variables['subjectID'];
	$academic = $variables['academic'];
	$term = $variables['term'];
	
	
}
?>


<style type="text/css">
.asesmntRprt{
	margin-left: 5px;
}
.asesmntRprt_pdf{
	margin-left: 5px;
}
</style>
<div class="page-header">  <h3> <?=$gpp_id; ?>
  <small> ( <?=$Subject; ?> ) 
  	<a href="#" class="label label-warning asesmntRprt_pdf"> F o r m a t i v e - R e p o r t p d f </a>
  	<a href="#" class="label label-warning asesmntRprt"> F o r m a t i v e </a>&nbsp;
	<a href="#" class="label label-warning summativetRprt"> S u m m a t i v e </a>&nbsp;
	<a href="#" class="label label-warning summativeRprtPDF"> S U M M A T I V E - R e p o r t  P D F</a>
	<a href="#" class="label label-warning SubjectRPTPDF"> S U B J E C T - R e p o r t</a>
  </small> </h3>
</div>


 <style>
.panel-title{
	font-size: 1.5em;
}
.panel-grey > .panel-heading {
    background: #95a5a6 none repeat scroll 0 0;
	padding: 12px;
}
.panel-heading {
    color: #ffffff;
    padding: 5px 15px;
}
.panel, .panel-heading, .panel-group .panel {
    border-radius: 0;
}
.panel-heading {
    border-bottom: 1px solid rgba(0, 0, 0, 0);
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    padding: 10px 15px;
}
h1 i, h2 i, h3 i, h4 i, h5 i, h6 i {
    margin-right: 5px;
}


.tables > thead > tr > th {
    background: none;
    border-color: none;
    border-image: none;
    border-style: none;
    border-width: 0px 0px 0px;
    letter-spacing: 0px;
    padding: 0px 0px;
    text-transform: uppercase;
	color:#333333;
	border-top: 1px solid #dddddd !important;
    padding: 6px 8px;
    vertical-align: middle;
}
.tables > thead > tr > th{
	border: 1px solid #dddddd;
	padding: 8px;
	 line-height: 1.42857;
	 vertical-align: top;
}

.tables > tbody > tr > td{
	border: 1px solid #dddddd;
	padding: 8px;
	 line-height: 1.42857;
	 vertical-align: top;
}
 </style>
 
<?php

if( isset( $_GET["user_id"] ) ){
$user_id = (int)$_GET["user_id"];	
}else{
	$user_id = 0;
}

if(isset( $_GET["matrixRoleSbjTchrID"] )){
$role_id = (int)$_GET["matrixRoleSbjTchrID"];
}else{
	$role_id = 0;
}
?>

<input type="hidden" value="<?=$user_id;?>" id="user_id" />
<input type="hidden" value="<?=$role_id;?>" id="role_id" />
<input type="hidden" value="<?=$sectionID;?>" id="sectionID" />
<input type="hidden" value="<?=$gradeID;?>" id="gradeID" />
<input type="hidden" value="<?=$optional;?>" id="optional" />	
<input type="hidden" value="<?=$GPID;?>" id="GPID" />
<input type="hidden" value="<?=$prgmID;?>" id="prgmID" />
<input type="hidden" value="<?=$gpp_id;?>" id="gpp_id" />
<input type="hidden" value="<?=$academic;?>" id="academic" />
<input type="hidden" value="<?=$term;?>" id="term" />
<input type="hidden" value="<?=$subjectID;?>" id="subjectID" />


<?php if( $optional === 1){
//$str = $GPID;
//$ex = explode("-",$str);
//$lastEl = array_pop((array_slice($ex, -1)));
//$blockID= (int)$lastEl;

$str = $gpp_id;
//$str = 'XI-BIOL-B-3';
$ex = explode("-",$str);
$group_ID = $ex[2];
$blockID = (int)$ex[3];


?>
<input type="hidden" value="<?=$group_ID;?>" id="groupID" />
<input type="hidden" value="<?=$blockID;?>" id="blockID" />

<?php }else{ ?>
<input type="hidden" value="0" id="groupID" />
<input type="hidden" value="0" id="blockID" />
<?php }?>





<?php
if(!empty( $gSbjCat ) ){ ?>
<p class="lead"> Following is the list of assessment for this role: <?=$gpp_id; ?>  <small> ( <?=$Subject; ?> ) </small>  </p>	
<?php
	echo $gSbjCat;
}else{ ?>
	
<div class="callout callout-info">
<h4>No Assessment Available</h4>
<p>Assessment not created for this session programme</p>
</div>
<?php }
?>




  </div> <!-- //panel-body -->
  </div>
  
  
  </div> 
 </div> <!-- // Assessment -->
