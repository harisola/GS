<?php  
  $ImageName = base_url() . $this->data['staff_150_photo_path'] . $this->data['staff_registered_data'][0]->employee_id . $this->data['photo_file'];
  $ImageMale = base_url() . $this->data['staff_150_photo_path'] . "male.png";
  $ImageFemale = base_url() . $this->data['staff_150_photo_path'] . "female.png";
  $ImageFound = "Yes";

  if (!file_exists($this->data['staff_150_photo_path'] . $this->data['staff_registered_data'][0]->employee_id . $this->data['photo_file'])) {
      if($this->data['staff_registered_data'][0]->gender == 'M'){
          $ImageName = $ImageMale;
      }else if($this->data['staff_registered_data'][0]->gender == 'F'){
          $ImageName = $ImageFemale;
      }

      $ImageFound = "No";

      /*http://placehold.it/150x150*/
  }
?>

<!DOCTYPE html>

<head>
<!-- <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<meta http-equiv="refresh" content="1500" > -->
<!--
<meta name="keywords" content="admin template, admin dashboard, inbox templte, calendar template, form validation">
<meta name="author" content="DazeinCreative">
<meta name="description" content="ORB - Powerfull and Massive Admin Dashboard Template with tonns of useful features">-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<title> <?php echo  $this->data['page_title']; ?></title>
<?php
    if($this->data['can_user_view'] == 1  || $this->data['can_user_add'] ==1 || $this->data['can_user_print'] == 1 || $this->data['can_user_export'] ==1 ||
    $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1 || $this->data['can_user_approve'] == 1)
{ ?>
<style type="text/css">
@import url("<?php echo base_url()?>components/orb/css/vendors/x-editable/address.css");
@import url("<?php echo base_url()?>components/orb/css/vendors/x-editable/select2.css");
@import url("<?php echo base_url()?>components/orb/css/vendors/x-editable/typeahead.js-bootstrap.css");
@import url("<?php echo base_url()?>components/orb/css/vendors/x-editable/demo-bs3.css");
@import url("<?php echo base_url()?>components/orb/css/vendors/x-editable/select2-bootstrap.css");
@import url("<?php echo base_url()?>components/orb/css/vendors/x-editable/bootstrap-editable.css");
@import url("<?php echo base_url()?>components/css/dataTables.tableTools.min.css");
</style>
<?php } ?>

<!-- Haris calling-->
<link id="main-style" href="<?php echo base_url()?>components/student_listing/style/style.css" rel="stylesheet" type="text/css">
<link id="main-style" href="<?php echo base_url()?>components/student_listing/style/StudentList.css" rel="stylesheet" type="text/css">
<!-- -->

<link id="main-style" href="<?php echo base_url()?>components/orb/css/styles.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>components/orb/css/orbmm.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url()?>components/css/anstyle.css" rel="stylesheet" type="text/css">
<!--<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />-->
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/modernizr/modernizr.custom.js"></script>

<!-- Select 2 -->
<link href="<?php echo base_url()?>components/select2/select2.css" rel="stylesheet"/>

<link href="<?php echo base_url()?>components/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">

<!-- Pace -->
<script src="<?php echo base_url()?>components/js/pace.min.js"></script>



</head>

<body>

<!--Smooth Scroll-->
<div class="smooth-overflow">
<!--Navigation-->

<nav class="navbar navbar-default orbmm" role="navigation">
  <div class="navbar-header">
    <button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <a class="navbar-brand" href="<?php echo site_url() . '/dashboard/dashboard';?>">
      <span class="org_logo"><img src="<?php echo base_url()?>components/student_listing/images/logo.png" /><?php /* ?><?php echo $brand; ?><?php */ ?>                
      </span>
    </a>    
      
    <!-- <img src="<?php //echo $ImageName; ?>"/><?php //echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?> --> 
    
    <!--Sidebar Toggler-->     
    <span style="font-size:26px;cursor:pointer;color:#fff;" id="OpenNav" onclick="openNav()" >
	<img src="<?php echo base_url()?>components/student_listing/images/menuIcon.png" width="30" style="padding-top:8px;" />
	</span>
	
    <span style="font-size:26px;cursor:pointer;color:#fff;display:none;" id="CloseNav" onclick="closeNav()">
	<img src="<?php echo base_url()?>components/student_listing/images/menuIconClose.png" width="25" style="padding-top:10px;" />
	</span>
	
  


  <!-- end navbar-collapse --> </nav>

<!--- Menu Area START Haris Ola -->
<div id="myNav" class="overlay">
  <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> -->
  <div class="overlay-content">
    <div class="row">
      <div class="col-md-3">
          <div class="searchMenuArea">
            <form class="formSearchMenu">
                  <input type="search" class="menuSearch" placeholder="Search" />
                    <button class="iconSearchButton"><span aria-hidden="true" class="icon-magnifier" style="font-size:20px;"></span></button>
                </form><!-- formSearchMenu -->
            </div><!-- searchMenuArea -->
			 <?php //echo $this->dynamic_menu->build_menu(); ?>
			   <?php if($this->ClassTeacher) { ?>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Student <i class="fa fa-angle-down"></i></a>
          <ul class="dropdown-menu" role="menu">            
            <li class="dropdown-submenu"> <a href="#">Attendance</a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>index.php/student_attendance/atd_today">Today</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/student_attendance/atd_history">History</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/student_attendance/active_cases">Penalty</a></li>
              </ul>              
            </li>            
          </ul>          
        </li>
      <?php } ?>

      <?php if($this->CoTeacher) { ?>
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle">Student <i class="fa fa-angle-down"></i></a>
          <ul class="dropdown-menu" role="menu">            
            <li class="dropdown-submenu"> <a href="#">Attendance</a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo base_url(); ?>index.php/student_attendance/atd_today">Today</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/student_attendance/atd_history">History</a></li>
                <li><a href="<?php echo base_url(); ?>index.php/student_attendance/active_cases">Penalty</a></li>
              </ul>              
            </li>            
          </ul>          
        </li>
      <?php } ?>
    </ul>
    <!-- end nav navbar-nav -->
	   
        <ul class="main_menu">
                <li class="hasChild main">
                  <a href="#" class=""><span aria-hidden="true" class="icon-home"></span> Dashboard <i class="rightArrow fa fa-angle-down " aria-hidden="true"></i></a>
                  <ul class="subMenu" style="display:none;">
                     
						
                        <li class="">
                          <a href="#">My Processes </a>
                        </li>
                        <li class="">
                          <a href="#">My Team </a>
                        </li>
                        <li class="">
                          <a href="#">My Profile</a>
                        </li>
						<?php  echo $this->master_page->mp_menus(); ?>
                    </ul><!-- subMenu -->
                </li><!-- hasChild main -->
				
                <li class="hasChild main">
                  <a href="#"><span aria-hidden="true" class="icon-user-following"></span> Browse <i class="rightArrow fa fa-angle-down " aria-hidden="true"></i></a>
                  <ul class="subMenu" style="display:none;">
                      <li class="hasSubChild">
                          <a href="#">Students <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="#">By Grade</a>
                                </li>
                              <li>
                                  <a href="#">By Group</a>
                                </li>
                                <li>
                                  <a href="#">By Family</a>
                                </li>
                                <li>
                                  <a href="#">By List</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
                        <li class="hasSubChild">
                          <a href="#">Staff <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="#">By Team</a>
                                </li>
                              <li>
                                  <a href="#">By Campus</a>
                                </li>
                                <li>
                                  <a href="#">By List</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						
                        <li class="hasSubChild">
                          <a href="#">Processes <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="#">By Process</a>
                                </li>
                              <li>
                                  <a href="#">By Station</a>
                                </li>
                            </ul>
                        </li>
						
					</ul><!-- subMenu -->
                </li><!-- hasChild main -->
				
<?php
if( $this->class_list_allowed && ( $this->data['allowed_classes'][0]["staff_id"]==15 || $this->data['allowed_classes'][0]["staff_id"]==1 )){ ?>
	<style>
	ul.subMenu > li::before {
		content:none;
		position: absolute;
		text-indent: 35px;
		top: 17%;
	}
	</style>
			<li class="hasChild main">
				<a href="#"><span aria-hidden="true" class="icon-user-following"></span> Grade <i class="rightArrow fa fa-angle-down " aria-hidden="true"></i></a>
					<ul class="subMenu" style="display:none;">
						<li class="hasSubChild">
                          <a href="#">PN <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=11&Grade=PN&secName=1">PN-1</a>
								   </li>
                              <li>
                                 <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=12&Grade=PN&secName=2">PN-2</a>
                                </li>
                                <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=13&Grade=PN&secName=3">PN-3</a>
                                </li>
                                <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=14&Grade=PN&secName=4">PN-4</a>
                                </li>
								<li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=15&Grade=PN&secName=5">PN-5</a>
                                </li>
								<li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=16&Grade=PN&secName=6">PN-6</a>
                                </li>
								<?php /* ?>
								<!--li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=17&Grade=PN&secName=7">PN-7</a>
                                </li>
								<li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=18&Grade=PN&secName=8">PN-8</a>
                                </li>
								<li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=19&Grade=PN&secName=9">PN-9</a>
                                </li>
								<li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=1&section_id=20&Grade=PN&secName=10">PN-10</a>
                                </li -->
								<?php */ ?>

                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">N <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=11&Grade=N&secName=1">N&ndash;1</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=12&Grade=N&secName=2">N&ndash;2</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=13&Grade=N&secName=3">N&ndash;3</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=14&Grade=N&secName=4">N&ndash;4</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=15&Grade=N&secName=5">N&ndash;5</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=16&Grade=N&secName=6">N&ndash;6</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=17&Grade=N&secName=7">N&ndash;7</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=18&Grade=N&secName=8">N&ndash;8</a>
                                </li>
								<?php /* ?>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=2&section_id=19&Grade=N&secName=9">N&ndash;9</a>
                                </li>
								<?php */ ?>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">KG <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=11&Grade=KG&secName=1">KG&ndash;1</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=12&Grade=KG&secName=2">KG&ndash;2</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=13&Grade=KG&secName=3">KG-3</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=14&Grade=KG&secName=4">KG&ndash;4</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=15&Grade=KG&secName=5">KG&ndash;5</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=16&Grade=KG&secName=6">KG&ndash;6</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=17&Grade=KG&secName=7">KG&ndash;7</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=18&Grade=KG&secName=8">KG&ndash;8</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=19&Grade=KG&secName=9">KG&ndash;9</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=3&section_id=20&Grade=KG&secName=10">KG&ndash;10</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">I <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=1&Grade=I&secName=G">I&ndash;G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=2&Grade=I&secName=S">I&ndash;S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=3&Grade=I&secName=C">I&ndash;C</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=4&Grade=I&secName=P">I&ndash;P</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=5&Grade=I&secName=R">I&ndash;R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=6&Grade=I&secName=W">I&ndash;W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=7&Grade=I&secName=E">I&ndash;E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=8&Grade=I&secName=L">I&ndash;L</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=9&Grade=I&secName=K">I&ndash;K</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=4&section_id=10&Grade=I&secName=M">I&ndash;M</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">II <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=1&Grade=II&secName=G">II-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=2&Grade=II&secName=S">II&ndash;S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=3&Grade=II&secName=C">II&ndash;C</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=4&Grade=II&secName=P">II&ndash;P</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=5&Grade=II&secName=R">II&ndash;R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=6&Grade=II&secName=W">II&ndash;W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=7&Grade=II&secName=E">II&ndash;E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=8&Grade=II&secName=L">II&ndash;L</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=9&Grade=II&secName=K">II&ndash;K</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=5&section_id=10&Grade=II&secName=M">II&ndash;M</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">III<i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=1&Grade=III&secName=G"> III&ndash;G </a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=2&Grade=III&secName=S">III&ndash;S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=3&Grade=III&secName=C">III&ndash;C</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=4&Grade=III&secName=P">III&ndash;P</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=5&Grade=III&secName=R">III&ndash;R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=6&Grade=III&secName=W">III&ndash;W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=7&Grade=III&secName=E">III&ndash;E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=8&Grade=III&secName=L">III&ndash;L</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=9&Grade=III&secName=K">III&ndash;K</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=6&section_id=10&Grade=III&secName=M">III&ndash;M</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">IV <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=1&Grade=IV&secName=G">IV-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=2&Grade=IV&secName=S">IV-S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=3&Grade=IV&secName=C">IV-C</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=4&Grade=IV&secName=P">IV-P</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=5&Grade=IV&secName=R">IV-R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=6&Grade=IV&secName=W">IV-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=7&Grade=IV&secName=E">IV-E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=8&Grade=IV&secName=L">IV-L</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=9&Grade=IV&secName=K">IV-K</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=7&section_id=10&Grade=IV&secName=M">IV-M</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">V <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=1&Grade=V&secName=G">V-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=2&Grade=V&secName=S">V-S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=3&Grade=V&secName=C">V-C</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=4&Grade=V&secName=P">V-P</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=5&Grade=V&secName=R">V-R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=6&Grade=V&secName=W">V-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=7&Grade=V&secName=E">V-E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=8&Grade=V&secName=L">V-L</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=9&Grade=V&secName=K">V-K</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=8&section_id=10&Grade=V&secName=M">V-M</a>
                                </li>
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">VI <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=2&Grade=VI&secName=S">VI-S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=3&Grade=VI&secName=C">VI-C</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=4&Grade=VI&secName=P">VI-P</a>
                                </li>
								 
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=6&Grade=VI&secName=W">VI-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=7&Grade=VI&secName=E">VI-E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=8&Grade=VI&secName=L">VI-L</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=9&section_id=9&Grade=VI&secName=K">VI-K</a>
                                </li>
								 
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">VII <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=1&Grade=VII&secName=G">VII-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=2&Grade=VII&secName=S">VII-S</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=3&Grade=VII&secName=C">VII-C</a>
                                </li>
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=5&Grade=VII&secName=R">VII-R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=6&Grade=VII&secName=W">VII-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=7&Grade=VII&secName=E">VII-E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=10&section_id=8&Grade=VII&secName=L">VII-L</a>
                                </li>
								 
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">VIII <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=11&section_id=1&Grade=VIII&secName=G">VIII-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=11&section_id=2&Grade=VIII&secName=S">VIII-S</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=11&section_id=5&Grade=VIII&secName=R">VIII-R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=11&section_id=6&Grade=VIII&secName=W">VIII-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=11&section_id=7&Grade=VIII&secName=E">VIII-E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=11&section_id=8&Grade=VIII&secName=L">VIII-L</a>
                                </li>
								 
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">IX <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=12&section_id=1&Grade=IX&secName=G">IX-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=12&section_id=2&Grade=IX&secName=S">IX-S</a>
                                </li>
								
								<li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=12&section_id=5&Grade=IX&secName=R">IX-R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=12&section_id=6&Grade=IX&secName=W">IX-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=12&section_id=7&Grade=IX&secName=E">IX-E</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=12&section_id=8&Grade=IX&secName=L">IX-L</a>
                                </li>
								
							
								
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">X <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=13&section_id=1&Grade=X&secName=G">X-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=13&section_id=2&Grade=X&secName=S">X-S</a>
                                </li>
								
							
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=13&section_id=5&Grade=X&secName=R">X-R</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=13&section_id=6&Grade=X&secName=W">X-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=13&section_id=7&Grade=X&secName=E">X-E</a>
                                </li>
								
							
								
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">XI <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=14&section_id=1&Grade=XI&secName=G">XI-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=14&section_id=2&Grade=XI&secName=S">XI-S</a>
                                </li>
								
							
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=14&section_id=6&Grade=XI&secName=W">XI-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=14&section_id=7&Grade=XI&secName=E">XI-E</a>
                                </li>
								
							</ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">A1 <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=15&section_id=1&Grade=A1&secName=G">A1-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=15&section_id=2&Grade=A1&secName=S">A1-S</a>
                                </li>
								
								 
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=15&section_id=6&Grade=A1&secName=W">A1-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=15&section_id=7&Grade=A1&secName=E">A1-E</a>
                                </li>
								
							
                            </ul><!-- sub-subMenu -->
                        </li>
						<li class="hasSubChild">
                          <a href="#">A2 <i class="rightArrow fa fa-angle-right " aria-hidden="true"></i></a>
                            <ul class="sub-subMenu">
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=16&section_id=1&Grade=A2&secName=G">A2-G</a>
                                </li>
                              <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=16&section_id=2&Grade=A2&secName=S">A2-S</a>
                                </li>
								
								 
								
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=16&section_id=6&Grade=A2&secName=W">A2-W</a>
                                </li>
								 <li>
                                  <a href="<?=site_url();?>/student_listing/grade_student_info?grade_id=16&section_id=7&Grade=A2&secName=E">A2-E</a>
                                </li>
								
							
                            </ul><!-- sub-subMenu -->
                        </li>
					</ul><!-- subMenu -->
					</li><!-- hasChild main -->
				<?php } ?>
			

				
        
				
				
            </ul><!-- main_menu -->
        </div><!-- col-md-2 -->
        <div class="col-md-9">
          
        </div><!-- col-md-8 -->
    </div><!-- row -->
  </div><!-- overlay-content -->
</div><!-- overlay -->     
<!--- Menu Area END Haris Ola -->
<!--MainWrapper-->
<div class="main-wrap"> 
  

  

  
  <!--Content Wrapper-->
  <div class="content-wrapper main-content-toggle-left"> <!-- content-wrapper -->
  <!--<div class="content-wrapper main-content-toggle-left">-->
    <nav class="cbp-hsmenu-wrapper" id="cbp-hsmenu-wrapper">         
    </nav>

    <?php
    if (!in_array(uri_string(), $this->skip_breadcrumb)){
      if($this->data['can_user_view'] == 1  || $this->data['can_user_add'] ==1 || $this->data['can_user_print'] == 1 || $this->data['can_user_export'] ==1 ||
         $this->data['can_user_edit'] == 1 || $this->data['can_user_delete'] == 1 || $this->data['can_user_approve'] == 1)
      { if(uri_string() != 'dashboard/dashboard') {?>
      <div class="breadcrumb clearfix">
        <ul>
          <li><a href="<?php echo site_url() . $this->data['current_url']; ?>"><i class="fa fa-refresh"></i></a></li>
          <?php for($i=1; $i <= sizeof($this->data['breadcrumb']); $i++) { ?>
            <li><a href="#"><?php echo $this->data['breadcrumb'][$i]; ?></a></li>
          <?php } ?>          
          <li class="active"><?php echo $this->data['breadcrumb_last']; ?></li>
        </ul>
      </div>


      <!-- <div class="page-header"> -->
        <!-- <h1><?php //echo $this->data['page_header_big_words'];?><small><?php //echo $this->data['page_header_small_words'];?></small></h1> -->
      <!-- </div> -->


      <div class="row" id="powerwidgets">        
      <?php 
    }  } } ?>
	
	
