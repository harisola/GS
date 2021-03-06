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
<title><?php echo $page_title; ?></title>
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

<style>
  /******* Organization Font *******/
  @font-face { font-family: 'Cooper Black'; src: url('<?php echo base_url()?>components/fonts/cooper_black.eot'); src: url('<?php echo base_url()?>components/fonts/cooper_black.eot?#iefix') format('embedded-opentype'), url('<?php echo base_url()?>components/fonts/cooper_black.svg#Cooper Black') format('svg'), url('<?php echo base_url()?>components/fonts/cooper_black.woff') format('woff'), url('<?php echo base_url()?>components/fonts/cooper_black.ttf') format('truetype'); font-weight: normal; font-style: normal;}

  .org_logo {
    color: <?php echo $org_font_color; ?>;    
    font-family: <?php echo $org_font; ?>;
    font-size: 36px;
    font-weight: bold;  
  }

  .org_logo_color {
    color: <?php echo $org_font_color;?>;
  } 
  /******* Organization Font *******/


  #interaction_forward_to .modal-content
  {
    height:600px;
    overflow:auto;
  }


  #interaction_recommended_from_centre .modal-content
  {
    height:600px;
    overflow:auto;
  }

  
  #career_history_modal .modal-content
  {
    height:600px;
    overflow:auto;
  }

  #interaction_recommended_from_centre_oa .modal-content
  {
    height:600px;
    overflow:auto;
  }
  .newNofitication {
    position: relative;
    width: 25px;
    height: 18px;
    right: -16px;
    border-radius: 50%;
    top: -25px;
    background-color: #64b979;
    color: #fff;
    animation: opacity-badge 0.6s infinite;
    -webkit-animation: opacity-badge 0.6s infinite;
    font-size: 11px;
    color: #ffffff;
}
</style>

</head>

<body>

<!--Smooth Scroll-->
<div class="smooth-overflow">
<!--Navigation-->

<nav class="navbar navbar-default orbmm" role="navigation">
  <div class="navbar-header">
    <button type="button" data-toggle="collapse" data-target="#defaultmenu" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
    <a class="navbar-brand" href="http://10.10.10.50/gsims/public<?php //echo site_url() . '/dashboard/dashboard';?>">
      <span class="org_logo"><?php echo $brand; ?>                
      </span>
    </a>    
      
    <!-- <img src="<?php //echo $ImageName; ?>"/><?php //echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?> --> 
    
    <!--Sidebar Toggler-->     
    
    <a href="#" class="btn btn-default left-toggler pull-left"><i class="fa fa-bars"></i></a> 
    <!--Right Userbar Toggler--> 
    <!-- <a href="#" class="btn btn-default right-toggler pull-left"><i class="fa fa-user"></i></a>  -->
    <!--Fullscreen Trigger-->
    <!--button type="button" class="btn btn-default hidden-xs pull-left" id="toggle-fullscreen"> <i class=" entypo-popup"></i> </button -->
<?php  echo $this->notify_header->group_menus_count(); ?>
    <!-- User Profile Image and Name and Grade-Section -->
    <div class="user-img pull-left navbar-text"><a href="" class="right-toggler">
      <img src="<?php echo $ImageName; ?>">
      <span class="navbar-username"><?php echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?></span>
      </a>
    </div>
  </div>
  <!-- end navbar-header -->  


  <div id="defaultmenu" class="navbar-collapse collapse">
    <ul class="nav navbar-nav">
      <!-- standard drop down -->
      <!-- All the menus from Database -->
      <?php echo $this->dynamic_menu->build_menu(); ?>
      <!-- User settings menu -->      
      <!-- end standard drop down -->
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
    
    <ul class="nav navbar-nav navbar-right">      
      <div class="site-search">
        <form action="#" id="inline-search">
          <i class="fa fa-search"></i>
          <input type="search" placeholder="Search">
        </form>
      </div>
    </ul>
    <!-- end nav navbar-nav navbar-right --> 
  </div>
  <!-- end navbar-collapse --> </nav>
<!-- end navbar orbmm --> 
<!--/Navigation--> 

<!--MainWrapper-->
<div class="main-wrap"> 
  
  <!-- /Offcanvas user menu-->
  <aside class="user-menu"> 
    
    <!-- Tabs -->
    <div class="tabs-offcanvas">
      <ul class="nav nav-tabs nav-justified">
        <li class="active"><a href="#userbar-one" data-toggle="tab">Main</a></li>
        <!--<li><a href="#userbar-two" data-toggle="tab">Users</a></li>-->
        <li><a href="#userbar-three" data-toggle="tab">ToDo</a></li>
      </ul>
      <div class="tab-content"> 
        
        <!--User Primary Panel-->
        <div class="tab-pane active" id="userbar-one">
          <div class="main-info">
            <div class="user-img"><img src="<?php echo $ImageName; ?>" alt="User Picture" /></div>
            <h1><?php echo ucwords($this->data['staff_registered_data'][0]->abridged_name); ?> <small><?php echo $this->data['staff_registered_data'][0]->c_topline; ?></small></h1>
          </div>
          <div class="list-group">
            <a href="<?php echo site_url()?>/profile/profile_view" class="list-group-item"><i class="fa fa-user"></i>Profile</a>
            <a href="<?php echo site_url()?>/profile/settings" class="list-group-item"><i class="fa fa-cog"></i>Settings</a>

            <div class="empthy"></div>
            <a href="#" data-toggle="modal" class="list-group-item lockme"><i class="fa fa-lock"></i> Lock</a>
            <a data-toggle="modal" href="#" class="list-group-item goaway"><i class="fa fa-power-off"></i> Log Out</a>
          </div>
        </div>
        
        <!--User Chat Panel-->
        <div class="tab-pane" id="userbar-two">
          <div class="chat-users-menu"> 
            <!--Adding Some Scroll-->
            <div class="nano">
              <div class="nano-content">
                <div class="buttons">
                  <div class="btn-group btn-group-xs">
                    <button type="button" class="btn btn-default">Friends</button>
                    <button type="button" class="btn btn-default">Work</button>
                    <button type="button" class="btn btn-default">Girls</button>
                  </div>
                </div>                
              </div>
            </div>
          </div>
        </div>
        
        <!--User Tasks Panel-->
        <div class="tab-pane" id="userbar-three">
          <div class="nano"> 
            <!--Adding Some Scroll-->
            <div class="nano-content">
              <div class="small-todos">
                <div class="input-group input-group-sm">
                  <input id="new-todo" placeholder="Add ToDo" type="text" class="form-control">
                  <span class="input-group-btn">
                  <button id="add-todo" class="btn btn-default" type="button"><i class="fa fa-plus-circle"></i></button>
                  </span> </div>
                <section id="task-list">
                  <ul id="todo-list">
                  </ul>
                </section>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- /tabs --> 
    
  </aside>
  <!-- /Offcanvas user menu--> 
  
  <!--Main Menu-->
  <div class="responsive-admin-menu sidebar-toggle"> <!-- responsive-admin-menu -->
  <!--<div class="responsive-admin-menu sidebar-toggle">-->
    <div class="responsive-menu"><?php echo $brand; ?>
      <div class="menuicon"><i class="fa fa-angle-down"></i></div>
    </div>
    <ul id="menu">
      <li><a <?php if(uri_string() == 'dashboard/dashboard') { ?> class="active" <?php } ?> href="<?php echo site_url();?>/dashboard" title="Dashboard"><i class="entypo-briefcase"></i><span> Dashboard</span></a></li>
  

    <?php if($this->class_list_allowed) {?>
      <!-- Class List -->
      <?php if(uri_string() == 'class_list/name_view' || uri_string() == 'class_list/face_view') { ?>
        <li> <a class="submenu active downarrow" href="#" data-id="class_list" title="Class List"><i class="fa fa-users"></i><span> Class</span></a>

      <?php } else{ ?>
        <li> <a class="submenu" href="#" data-id="class_list" title="Class List"><i class="fa fa-users"></i><span> Class</span></a>
      <?php } ?>

        <!-- Class Sub-Menu -->
        <ul id="class_list" class="accordion">

          <!-- ********** Calling Grade and Grade-Section ********** -->
          <?php
          $i = 0;
          $gname[$i] = '0';
          foreach ($this->data['allowed_classes'] as $classes) {
            if(in_array($classes['grade_dname'], $gname)){
            }else{
              $gname[$i] = $classes['grade_dname'];
              $i += 1;
            }                        
          }          
          foreach ($gname as $GradeName) {
          $menu_made = false;
          $all_sections_found = false;                    
            foreach ($this->data['allowed_classes'] as $classes) {
              if($GradeName == $classes['grade_dname'] && $all_sections_found == false){
                if($classes['all_sections_allowed'] == 1){
                  $this->load->model('class_list/class_list_access_model');
                  $all_sections[0] = $this->class_list_access_model->get_all_sections($classes['grade_name'], $classes['academic_session_id']);
                  $all_sections_found = true;
                }
                if(!$menu_made){
                  $menu_made = true; ?>
                  <!-- Heading -->                  
                  <li><a href="#" data-id="<?php echo $GradeName;?>" title="Icon Fonts" class="submenu"><i class="fa fa-child"></i><span> <?php echo $GradeName;?></span></a>
                    <ul id="<?php echo $GradeName;?>">
                <?php } ?>                    
                    <!-- Class List Link -->
                    <?php if($all_sections_found == false) { ?>
                    <li><a href="<?php echo site_url() . '/class_list/name_view/?class=' . $GradeName . '-' . $classes['section_dname'];?>" title="<?php echo $GradeName . " - " . $classes['section_dname'];?>"><i class="fa fa-child"></i><span> <?php echo $GradeName . " - " . $classes['section_dname'];?></span></a></li>
                    <?php } else { foreach($all_sections[0] as $sections) {?>
                      <li><a href="<?php echo site_url() . '/class_list/name_view/?class=' . $GradeName . '-' . $sections['section_dname'];?>" title="<?php echo $GradeName . " - " . $sections['section_dname'];?>"><i class="fa fa-child"></i><span> <?php echo $GradeName . " - " . $sections['section_dname'];?></span></a></li>
                    <?php } } ?>
            <?php } } ?>
                    </ul>
                 </li>
          <?php } ?>          
        </ul>
      </li>
    <?php } ?> 


    <?php echo $this->group_menu->group_menus(); ?>
    
      <!-- Other Contents Menu -->
      <li><a href="#" title="More"><i class="entypo-cog"></i><span> More <span class="badge">Soon</span></span></a></li>
    </ul>
  </div>
  <!--/MainMenu--> 
  
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
	
	
	
	<?php 

	
	//echo "Generationschool ".$this->data['StaffID'];
	if( !empty( $this->data['StaffID'])){
		
		if( (int)$this->data['StaffID'] != 0 ){ ?>
<!--JQuery--> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url()?>components/orb/js/vendors/jquery/jquery-ui.min.js"></script> 
<input type="hidden" value="<?=$this->data['staff_registered_data'][0]->id;?>" id="nuser_id" name="nuser_id" />
<script>
var frontOfficerid = "<?=(int)$this->data['frontOfficerid'];?>";
$(document).ready(function() {
	if( parseInt( frontOfficerid ) == 0 ){
		var i = setInterval(function(){ getnotice(); }, 1000 * 60 * 60 );
		
	}else{
		var i = setInterval(function(){ getnotice(); }, 9000);	
	}
	
});

function getnotice(){
	
var nuum1 = $("#newNofitication");
var nuum = nuum1.html();
var num = parseInt(nuum);	
var user_id = $("#nuser_id").val();
	$.ajax({
		type: "POST",
		url: "<?=site_url().'/fo/notify_log_ajax/get_notification/';?>",
		data: { num: num,user_id:user_id },
		dataType : "JSON",
		beforeSend : function (){ },
		success: function( res ){
			var tn = parseInt(res.r);
			nuum1.html(tn);
			if( tn > 0 ){
				nuum1.show();	
			}else{
				nuum1.hide();
			}
			
		},
		complete:function(){ },
		error: function() { }
	});
	return 1;
}
</script>
<?php }
} ?>