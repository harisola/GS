<style>
.content-wrapper{
	min-height:0px;
}
.alert-blocks img {
    float: left;
    height: 40px;
    margin-right: 15px;
    width: 40px;
}
.alert-blocks{
    margin-bottom: 10px;
    overflow: hidden;
    padding: 15px 15px 0 0;
	 color: #555555;
}
.rounded-x {
    border-radius: 50% !important;
}
.panel > .panel-heading i {
    font-size: 18px;
    margin-left: 5px;
    margin-top: 3px;
}

.table-bordered {
    border: 1px solid #dddddd;
}

.tables > tbody > tr > td, .tables > tbody > tr > th, .tables > tfoot > tr > td, .tables > tfoot > tr > th, .tables > thead > tr > td, .tables > thead > tr > th {
    border-top: 1px solid #dddddd;
    line-height: 1.42857;
    padding: 8px;
    vertical-align: top;
}


.panel > .panel-body + .tables, .panel > .panel-body + .table-responsive, .panel > .tables + .panel-body, .panel > .table-responsive + .panel-body {
    border-top: 1px solid #dddddd;
}
.panel > .table-responsive:last-child > .tables:last-child, .panel > .tables:last-child {
    border-bottom-left-radius: 3px;
    border-bottom-right-radius: 3px;
}
.panel .tables {
    margin-bottom: 0;
	width:100%;
}

.tables {
    background-color: rgba(0, 0, 0, 0);
}
.tables {
    border-collapse: collapse;
    border-spacing: 0;
}
.close_setup_4{
cursor:pointer;
	
}

.fa-check {
cursor:pointer;
	
}
.fa-check {   font-size: 1.5em;  color: #ffffff; }


.callout {
    font-size: 1em;
    min-height: 26px;
    padding: 15px 8px 15px 60px;
    position: relative;
	margin:0px;
}
.callout-gen{
	background-color: #d9ead0;
    color: #82b964;
    font-weight: 700;
}

.label.label-success {
    color: #ffffff;
}

.label.bg-black {
    color: #ffffff;
}

.unlocked{ cursor:pointer; }

.bgdarkred2 {
    background-color: #993838;
}
.panel-default > .panel-heading {
    background-color: #993838;
    border: 0 none;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
    color: #ffffff;
    padding: 10px;
}

.badge {
	background: #fffbdb none repeat scroll 0 0;
    color: #33383d !important;
	border-radius: 10px !important;
    display: inline-block;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    min-width: 10px;
    padding: 3px 7px;
    text-align: center;
    vertical-align: baseline;
    white-space: nowrap;
}

.bgblue {
    background-color: #5bc0de;
}

.bgcoldgrey{
    background-color: #595f66;
}
</style>
<link rel="stylesheet" href="<?=base_url();?>components/unify_theme/css/app.css">
<div class="page-main">
<div id="response"></div>
<?php if( !empty($gradeProgramme) ){  ?>
<input type="hidden" id="user_id" value="<?=$user_id;?>" />
<input type="hidden" id="user_ip" value="<?=$user_ip;?>" />
<input type="hidden" id="user_agent" value="<?=$user_agent;?>" />
<?php } ?>
<div id="main_contents" class="container">
	<div id="content_1">
		<div class="panel-heading">
			<div class="panel-title pull-left"> <legend>Notifications</legend>  </div>
			<div class="clearfix"></div>
		</div>
			<?php
				if( !empty($gradeProgramme) ){  
					echo $gradeProgramme; 
				}
			?>
	</div>
	<div id="content_2" class="container content"></div>
</div>
</div>