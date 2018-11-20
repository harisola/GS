<!-- <div class="breadcrumb clearfix">
	<ul>
	  <li><a href="<?php //echo site_url() . "/" . $this->data['current_url']; ?>"><i class="fa fa-home"></i></a></li>
	  <li><a href="#">Dashboard</a></li>
	  <li class="active">Data</li>
	</ul>
</div> -->

<div class="row" id="powerwidgets">
	<div class="col-md-2 bootstrap-grid sortable-grid ui-sortable">
		<!-- <div class="jumbotron jumbotron0">
			<h1>Welcome <strong><?php //echo ucwords($this->session->userdata['username']); ?></strong></h1>
			<p class="lead"></p>
			<small></small>
			<p></p>
		</div> -->

		<?php if($this->CoTeacher || $this->ClassTeacher) { ?>
		<div class="powerwidget powerwidget-as-portlet powerwidget-as-portlet-cold-grey" id="info_tpa" data-widget-editbutton="false" role="widget" style="">
          <header role="heading">
          	<?php echo date('d-M-Y'); ?>
          	<div class="powerwidget-ctrls" role="menu">
  			</div><span class="powerwidget-loader"></span>
		  </header>
	  		<div class="inner-spacer nopadding" role="content">
	  		<div class="portlet-big-icon animated bounceIn text-white"><a href="<?php echo site_url() . '/student_attendance/atd_today';?>" style="color: #FFFFFF"><i class="fa"><?php echo $this->ClassTeacherGrade . '-' . $this->ClassTeacherSection; ?></i></a></div>
	            <ul class="portlet-bottom-block">
	              <li class="col-md-4 col-sm-4 col-xs-4"><strong><?php if(isset($this->data['studentTPA'][0]['total'])){echo $this->data['studentTPA'][0]['total'];}else{echo 'OFF';} ?></strong>T</li>
	              <li class="col-md-4 col-sm-4 col-xs-4"><strong><?php if(isset($this->data['studentTPA'][0]['present'])){echo $this->data['studentTPA'][0]['present'];}else{echo 'OFF';} ?></strong>P</li>
	              <li class="col-md-4 col-sm-4 col-xs-4"><strong><?php if(isset($this->data['studentTPA'][0]['present'])){echo ($this->data['studentTPA'][0]['total'] - $this->data['studentTPA'][0]['present']);}else{echo 'OFF';} ?></strong>A</li>
	            </ul>
          </div>
        </div>
		
		<?php } ?>
	</div>