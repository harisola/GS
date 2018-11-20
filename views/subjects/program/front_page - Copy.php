<!-- http://jsfiddle.net/0m38jj5n/3/ /-->
<div class="panel-body">
<div class="page-header2"><h3> GRADE-LEVEL PROGRAMME SETUP </h3></div>
<div class="col-md-12 bootstrap-grid"> 
<!-- New widget -->
<div class="powerwidget green" data-widget-editbutton="false">
<header><h2>School level<small>Programme</small></h2></header>
<div class="inner-spacer orb-form">
<!--fieldset-->
<div class="row" id="subjectsList">
 <?php echo $this->SubjectList;?>
</div>
 
<?php /* for($counter = 0; $counter<10; $counter++){ static $con = 0; ?>
 <section class="col col-2">
<h5> Skill Development </h5>
	<ol class="list-group rp-draggable">
	<?php for($counte = 0; $counte<5; $counte++){?>
		<li  class="list-group-item" data-id="<?=$con;?>" id="<?=$con?>">  testing <?=$con;?> <i class="fa fa-plus"></i> </li>
	<?php $con++; } ?>
	</ol>
</section>

<?php } */ ?>
<!--/fieldset -->

					
</div>
</div>
<!-- /New widget --> 
</div>

<div class="col-md-12 bootstrap-grid"> 
<!-- New widget -->
<div class="col-md-6 powerwidget green" data-widget-editbutton="false">
<header><h2>Academic Session Grade <small> Academic Session Grade </small></h2></header>
<div class="inner-spacer orb-form">
<div class="ddd" id="nestabledd">
<section class="col-md-3">

<label class="select">
<select name="acsec" id="acsec">
<option value="">Academic Session</option>
	<?php 
	//echo $this->SubjectList;
	
	if( !empty($academicsList) ){ 
		foreach($academicsList as $ac ){  ?>
		<option value="<?=$ac["id"];?>"><?php echo $ac["name"]; //$ac["branch_id"]; ?></option>
		<?php }
	}
	?>
	</select>
<i></i> </label>

</section>

<section class="col col-3">
	<label class="select">
	
	 <select name="grade" id="grade" class="grade">
		<option value=''> Choose  Grade </option>
		<!--option value="0"> All  </option -->
		<?php
			$counter =1;
			if(!empty($grades) ):
				foreach($grades as $grade ): ?>
				<option value="<?=$grade->id;?>"> <?=$grade->dname;?> </option>
				<?php 
				//$counter++;
				endforeach;
			endif;
		?>
	  </select>
	  

	  
	  <i></i> </label>
</section>
</div>
</div>
</div>
<!-- /New widget --> 



<div class="col-md-6 bootstrap-grid"> 

<div class="powerwidget dark-blue" data-widget-editbutton="false">
<header><h2>Grade Programms</h2></header>

<div class="header-favorites inner-spacer">
<form id="frm" class="orb-form">
  <!--h2>Drop Below...</h2 -->
    <ol class="h-droped-list">
      <li class="placeholder">Placeholder (hides if it has items)</li>
    </ol>
	
<input type="hidden" name="sessionID" id="sessionID" value="" />
<input type="hidden" name="gradeID" value="" id="gradeID" />
<input type="hidden" name="subjects" value="" id="subjects" />
<br />

<footer>
	<button class="btn btn-default" type="submit" id="btn_sgp">Set Grade Programms</button>
</footer>

</form>

</div>

</div></div>
</div>




<style>
.page-header{
	display:none;
}

.page-header2 {
    border-bottom: 5px solid hsl(60, 3%, 86%);
    margin: 0px 0 10px;
    padding-bottom: 9px;
}

h5{
	 margin-bottom: 14px !important;
    margin-top: 12px !important;
}
.edit{
	color: hsl(0, 0%, 62%);
    font-size: 10px;
    line-height: 16px;
    position: absolute;
    right: 33px;
    text-align: center;
    top: 6px;
    white-space: nowrap;
}
ol,li{list-style:none;margin:0;padding:0;}

/*.mn-items,.header-favorites{display:block;clear:both;width:400px;} */

.mn-items,.header-favorites{display:block;}
.mn-items li{background:#eee;padding:5px;cursor:pointer;margin-bottom:5px;position:relative;}
.mn-items {margin-top:20px;}
.mn-items ol {margin:0;padding:0;clear:both;overflow:hidden;}
.mn-items ol li{position:relative;padding:10px;border-top:2px solid #fff;border-left:2px solid #000;cursor:pointer;}
.mn-items ol li:first-child{border-top:none;}
.header-favorites {margin-top:20px;}
.header-favorites ol {margin:0;padding:0;background:#B8FFB3;clear:both;overflow:hidden;}
.header-favorites ol li{position:relative;padding:10px;border-top:2px solid #fff;border-left:2px solid #000;cursor:pointer;}
.header-favorites ol li:first-child{border-top:none;}
.mn-items li i,.header-favorites ol li i{display:block;position:absolute;right:5px;top:5px;opacity:0.5;font-size:15px;font-weight:bold;font-style:normal;}
.placeholder{background:none;color:#888;cursor:default;margin-bottom:0 !important;text-align:center;border:1px solid #ccc !important;}
.ui-sortable-helper{background:#fff;}
.addedToFav{background:#B8FFB3 !important;}
/*.addedToFav i:before{content:"\f005";}*/
.addedToFav i:before{content:"\f00c";}
.header-favorites i:before{content:"\f00d";}



  
  

.ui-state-default { 
    margin: 0; 
    height: 35px;
    line-height: 30px;
    font-size: 1.4em; 
    color: #fff;
    outline: 0;
    padding: 0;
    margin: 0;
    text-indent: 15px;
    background: rgb(78,82,91);
    background: -moz-linear-gradient(top,  rgb(78,82,91) 0%, rgb(57,61,68) 100%);
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(78,82,91)), color-stop(100%,rgb(57,61,68)));
    background: -webkit-linear-gradient(top,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
    background: -o-linear-gradient(top,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
    background: -ms-linear-gradient(top,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
    background: linear-gradient(to bottom,  rgb(78,82,91) 0%,rgb(57,61,68) 100%);
    border-top: 1px solid rgba(255,255,255,.2);
    border-bottom: 1px solid rgba(0,0,0,.5);
    text-shadow: -1px -1px 0px rgba(0,0,0,.5);
    font-size: 1.1em;
    position: relative;
    cursor: pointer;
}
.ui-state-default:first-child {
    border-top: 0; 
}
.ui-state-default:last-child {
    border-bottom: 0;
}

.ui-state-default:after {
    content: "\f0c9";
    display: inline-block;
    font-family: "FontAwesome";
    position: absolute;
    
    top: 9px;
    text-align: center;
    
    color: rgba(255,255,255,.2);
    text-shadow: 0px 0px 0px rgba(0,0,0,0);
    cursor: move;
}
.fa.fa-plus{
	 cursor: pointer;
}
</style>

</div>
