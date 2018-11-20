<link rel="stylesheet" href="<?php echo base_url();?>components/master_calenar/style.css">
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$(document).ready(function () {
$('.todayGO').click(function() {
$('.MonthDays').animate({
scrollTop: $("div.Today").offset().top
}, 1000)
})
});
$(document).ready(function() {
$('.MonthDays').animate({
scrollTop: $(".Today").offset().top
}, 1000)
});

</script>
<!-- Scroll bar CUSTOM -->

<link rel="stylesheet" href="/application/views/master_calendar/js/jquery.mCustomScrollbar.css">
<!-- Google CDN jQuery with fallback to local -->

<script>window.jQuery || document.write('<script src="/application/views/master_calendar/js/jquery-1.11.0.min.js"><\/script>')</script>

<!-- custom scrollbar plugin -->
<script src="/application/views/master_calendar/js/jquery.mCustomScrollbar.concat.min.js"></script>



<!-- -->
<link rel="stylesheet" href="/application/views/master_calendar/style/style2.css">
<div class="container">
<div class="row" style="position:relative;padding:0 10px;">

<div class="col-md-12" id="OlaCalendar">
<?php // echo $calendar; ?>
	<div class="col-md-12 headCal no-padding">
	<div id="current_month" style="float: left;width: 15%;"><?php echo $CurrentMonth =  'February 2017'; ?></div>
	<button type="button" class="todayGO">Today</button>

	</div><!-- headCal -->
	<div class="col-md-12 weekCal no-padding">

		<div class="weekHead dayHead">
		GWK
		</div><!-- weekHead -->
		<div class="weekHead dayHead">
		CWK
		</div><!-- weekHead -->
		<div class="MonHead dayHead">
		Mon
		</div><!-- MonHead -->
		<div class="TueHead dayHead">
		Tue
		</div><!-- TueHead -->
		<div class="WedHead dayHead">
		Wed
		</div><!-- WedHead -->
		<div class="ThuHead dayHead">
		Thu
		</div><!-- ThuHead -->
		<div class="FriHead dayHead">
		Fri
		</div><!-- FriHead -->
		<div class="SatHead dayHead">
		Sat
		</div><!-- SatHead -->
		<div class="SunHead dayHead">
		Sun
		</div><!-- SunHead -->
	</div><!-- weekCal -->

	<div class="MonthDays" id="MonthDays35">
	<?php if(!empty( $CalenderDates )): ?>
	<?php //for ($c=0;  $c<$monthWeek;$c++): 
	$counter=1;
	$outer=1;
	$with_outer_div=1;
	$without_outer_div=1;
	foreach($CalenderDates as $dates):?>
		<?php if($dates["genweek"] != '' ): 
			$outer=1;
			$with_outer_div=1;
			else: 
			$outer=0;
			$with_outer_div=0;
			endif; ?>
		<?php if($outer==1): ?>
		<div class="col-md-12 weekRow no-padding">
			<div class="weekBox dayHead"><?=$dates["genweek"];?></div>
			<div class="weekBox dayHead"><?php 
				$w =  $controller->week_start_end_by_date($dates["date"]); 
				echo date("W",strtotime($w["last_day_of_week"]));
				?>
				
			</div>
			<?php endif;?>
		<?php if( $with_outer_div==1 || $with_outer_div==0 ): ?>
				<div class="MonBox dayHead" id="MonBox_<?=$dates["id"];?>">
				<div class="col-md-3 no-padding DateArea">
					<div class="EnglishDate">
						<a class="tooltipp" href="#" data-toggle="modal" data-target="#AddEvent">
							<?php
							echo date("d",strtotime($dates["date"]));
							echo "<br />";
							echo date("M",strtotime($dates["date"]));
							?>
							<span class="tooltipptext">Add Event</span>
						</a>
					</div><!-- EnglishDate -->
					<div class="ArabicDate">
						<?php
							$i = explode("-",$dates["islami_date"]);
							echo $idate = $i[2];
							
						?><br /><?=$dates["islami_month"];?>
					</div>
				</div>
				<div class="col-md-9 no-padding">
					<div class="col-md-12 no-padding">
						<a class="HolidayParameter HolidayParOn tooltipp" href="#" data-id="<?=$dates["id"];?>">H<span class="tooltipptext" >Holiday Parameter</span></a>
						<a class="StaffParameter StaffParOn tooltipp" href="#" data-id="<?=$dates["id"];?>">TP<span class="tooltipptext">Staff Parameter</span></a>
						<a class="StudentParameter StudentParOn tooltipp" href="#" data-id="<?=$dates["id"];?>">SP<span class="tooltipptext">Student Parameter</span></a>
						<a class="ScheduleFollowup ScheduleFolOn tooltipp" href="#" data-id="<?=$dates["id"];?>">SF<span class="tooltipptext">Schedule Followup</span></a>
					</div>
					<div class="eventListingHere">
					<?php
					if($dates["eTitle"] != '' ):
						$events = $controller->get_date_events($dates["id"]);
						if(!empty($events)):
							foreach($events as $e):
							$ID = $e["ID"]; 
							$Title = $e["Title"]; 
					?>
							<a class="HolidayParameterSet" href="#" data-toggle="modal" data-target="#SetHolidayParameter"><?=$Title;?></a>
							<?php endforeach;
						endif;
					endif;	
					?>
					</div>
				</div>
				</div>
		<?php endif; ?>
		<?php if($counter % 7 == 0): ?>
		</div>
		<?php endif; ?>
		<?php //endfor; 
		$counter++;
		endforeach;
		?>
		<?php endif; ?>
	
</div><!-- MonthDays-->

	<div class="col-md-12 no-padding" style="display:none;text-align:center" id="ajaxloader">
		<img src="<?php echo base_url();?>/components/image/ajax-loader22.gif">
	</div>
	
</div><!-- col-md-12 -->


<!-- // Modal -->
<div class="col-md-12" style="position:relative;">
<div class="modal fade TimeLineModal" id="SetHolidayParameter2" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Holiday Parameter</h4>
</div>
<div class="modal-body">
  <div class="row" id="HolidayParameters">
	<!--// Ajax Response will be drag here -->
	</div>
</div>
<div class="modal-footer">
  <input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Set Holiday Parameter" id="HPButton">
</div>
</div>

</div>
</div><!-- SetHolidayParameter -->


<div class="modal fade TimeLineModal" id="SetStaffParameters" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Staff Parameter</h4>
</div><!-- modal-header -->
<div class="modal-body">
<div class="row" id="StaffParameters">
<!--// Ajax Response will be drag here -->
</div>
</div><!-- modal-body -->
<div class="modal-footer">
<input type="submit" class="greenBTN widthSmall" data-dismiss="modal" id="SPButton" value="Set Staff Parameter">
</div><!-- Modal Footer-->
</div>
</div>
</div><!-- SetStaffParameter -->
	<div class="modal fade TimeLineModal" id="SetStudentParameter" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Student Parameter</h4>
</div>
<div class="modal-body">
	<div class="row" id="StdParameters">
		<!--// Ajax Response will be drag here -->
	</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div><!-- SetStudentParameter -->
	<div class="modal fade TimeLineModal" id="SetScheduleFollowup" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Schedule Followup for 17 April 2017</h4>
</div>
<div class="modal-body">
<div class="row" id="SchFParameters">
 <!--// Ajax Response will be drag here -->
</div>
</div>
	<div class="modal-footer">
	  <input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Set Followup">
	</div>
</div>
</div>
</div><!-- SetScheduleFollowup -->
<div class="modal fade TimeLineModal" id="AddEvent" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Add New Event - Monday, 17 April 2017</h4>
</div>
<div class="modal-body">
<div class="row">
  <form>
	<div class="col-md-12 no-padding paddinTop20">
		<div class="col-md-6 border-right">
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:0px;">
					Event Category
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select>
					  <option value="">Select</option>
					  <option value="VH">Voluntary Holiday</option>
					  <option value="DH">Directorate Holiday</option>
					  <option value="PH">Provincial Holiday</option>
					  <option value="NH">National/Public Holiday</option>
					</select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Title
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<input type="text" placeholder="Event Title" />
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Level
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select>
					  <option value="">Select</option>
					  <option value="VH">Master</option>
					  <option value="DH">Major</option>
					  <option value="PH">Minor</option>                                          
					</select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:0px;">
					Event Visibilty
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<select>
					  <option value="">Select</option>
					  <option value="P">Public</option>
					  <option value="S">Staff</option>
					  <option value="MA">Management/Admin</option>
					  <option value="OM">Only Me</option>
					</select>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Time
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<div class="col-md-5 no-padding">
						<input type="time" />
					</div><!-- col-md-5 -->
					<div class="col-md-2 text-center" style="padding-top: 8px;">
						to
					</div><!-- col-md-2 -->
					<div class="col-md-5 no-padding">
						<input type="time" />
					</div><!-- col-md-5 -->
					<div class="col-md-12" style="padding-top: 12px;">
						<input type="checkbox" name="fullday" value="fullday" style="display:;" id="fullday" > <label for="fullday"> Full day event</label>
					</div><!-- col-md-12 -->
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
			<div class="col-md-12" style="padding:10px 0;">
				<div class="col-md-3" style="padding-top:5px;">
					Event Description
				</div><!-- col-md-3 -->
				<div class="col-md-9">
					<textarea></textarea>
				</div><!-- col-md-9 -->
			</div><!-- col-md-12 no-padding -->
		</div><!-- col-md-6 -->
		<div class="col-md-6" id="OlaAccordion">
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
							<input type="checkbox" name="Starter" value="Starter" style="display:;" id="Starter"> <label for="Starter" class="customCheck"></label>
							<a class="titleColl" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Starter</div>
							</a>
						</h4><!-- panel-title -->
					</div><!-- panel-heading -->
					<div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="PG" value="PG" style="display:;" id="PG"> <label for="PG" class="">PG</label></li>
								<li><input type="checkbox" name="PN" value="PN" style="display:;" id="PNN"> <label for="PNN" class="">PN</label></li></li>
								<li><input type="checkbox" name="N" value="N" style="display:;" id="NN"> <label for="NN" class="">N</label></li>
								<li><input type="checkbox" name="KG" value="KG" style="display:;" id="KGG"> <label for="KGG" class="">KG</label></li>
								<li><input type="checkbox" name="I" value="I" style="display:;" id="I1"> <label for="I1" class="">I</label></li>
								<li><input type="checkbox" name="II" value="II" style="display:;" id="II2"> <label for="II2" class="">II</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseOne -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingTwo">
						<h4 class="panel-title">
							<input type="checkbox" name="Junior" value="Junior" style="display:;" id="Junior"> <label for="Junior" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Junior</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="III3" value="III3" style="display:;" id="III3"> <label for="III3" class="">III</label></li>
								<li><input type="checkbox" name="IV4" value="IV4" style="display:;" id="IV4"> <label for="IV4" class="">IV</label></li></li>
								<li><input type="checkbox" name="V5" value="V5" style="display:;" id="V5"> <label for="V5" class="">V</label></li>
								<li><input type="checkbox" name="VI6" value="VI6" style="display:;" id="VI6"> <label for="VI6" class="">VI</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseTwo -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingThree">
						<h4 class="panel-title">
							<input type="checkbox" name="Middle" value="Middle" style="display:;" id="Junior"> <label for="Middle" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Middle</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="VII7" value="VII7" style="display:;" id="VII7"> <label for="VII7" class="">VII</label></li>
								<li><input type="checkbox" name="VIII8" value="VIII8" style="display:;" id="VIII8"> <label for="VIII8" class="">VIII</label></li></li>
								<li><input type="checkbox" name="IX9" value="IX9" style="display:;" id="IX9"> <label for="IX9" class="">IX</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseThree -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFour">
						<h4 class="panel-title">
							<input type="checkbox" name="Starter" value="Starter" style="display:;" id="Starter"> <label for="Starter" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Senior</div>
							</a>
						</h4><!-- panel-title -->
					</div><!-- panel-heading -->
					<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="PG" value="PG" style="display:;" id="PG"> <label for="PG" class="">PG</label></li>
								<li><input type="checkbox" name="PN" value="PN" style="display:;" id="PNN"> <label for="PNN" class="">PN</label></li></li>
								<li><input type="checkbox" name="N" value="N" style="display:;" id="NN"> <label for="NN" class="">N</label></li>
								<li><input type="checkbox" name="KG" value="KG" style="display:;" id="KGG"> <label for="KGG" class="">KG</label></li>
								<li><input type="checkbox" name="I" value="I" style="display:;" id="I1"> <label for="I1" class="">I</label></li>
								<li><input type="checkbox" name="II" value="II" style="display:;" id="II2"> <label for="II2" class="">II</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseOne -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingFive">
						<h4 class="panel-title">
							<input type="checkbox" name="Generosity" value="Generosity" style="display:;" id="Generosity"> <label for="Generosity" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Generosity</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="VII7" value="VII7" style="display:;" id="VII7"> <label for="VII7" class="">Gen U</label></li>
								<li><input type="checkbox" name="VIII8" value="VIII8" style="display:;" id="VIII8"> <label for="VIII8" class="">Coordination</label></li></li>
								<li><input type="checkbox" name="IX9" value="IX9" style="display:;" id="IX9"> <label for="IX9" class="">Software</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseTwo -->
				</div><!-- panel -->
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingSix">
						<h4 class="panel-title">
							<input type="checkbox" name="Admin" value="Admin" style="display:;" id="Admin"> <label for="Admin" class="customCheck"></label>
							<a class="titleColl collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
								<i class="more-less glyphicon glyphicon-plus"></i>
								<i class="more-less glyphicon glyphicon-minus"></i>
								<div class="col-md-10 no-padding">Admin</div>
							</a>
						</h4>
					</div><!-- panel-heading -->
					<div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
						<div class="panel-body">
							<ul class="noBullets">
								<li><input type="checkbox" name="DI" value="DI" style="display:;" id="DI"> <label for="DI" class="">DI</label></li>
								<li><input type="checkbox" name="SIS" value="SIS" style="display:;" id="SIS"> <label for="SIS" class="">SIS</label></li></li>
								<li><input type="checkbox" name="Finance" value="Finance" style="display:;" id="Finance"> <label for="Finance" class="">Finance</label></li>
								<li><input type="checkbox" name="Operations" value="Operations" style="display:;" id="Operations"> <label for="Operations" class="">Operations</label></li>
							</ul>
						</div><!-- panel-body -->
					</div><!-- collapseThree -->
				</div><!-- panel -->
			</div><!-- panel-group -->
		</div><!-- col-md-6 -->
	</div><!-- col-md-12 -->
  </form>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Add Event">
</div>
</div><!-- modal-content -->

</div>
</div><!-- AddEvent -->
</div><!--- col-md-12 -->        

</div><!-- row -->
</div><!-- container -->
