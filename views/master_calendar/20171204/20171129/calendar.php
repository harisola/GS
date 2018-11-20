<!--link rel="stylesheet" media="screen" href="http://localhost/gs/components/gs_theme/css/bootstrap.css" />
<link rel="stylesheet" media="screen" href="http://localhost/gs/components/gs_theme/css/bootstrap-theme.css" />
<link rel="stylesheet" media="screen" href="http://localhost/gs/components/gs_theme/css/style.css" />
<link rel="stylesheet" media="screen" href="http://localhost/gs/components/gs_theme/css/mobile.css" />
<script src="http://localhost/gs/components/gs_theme/js/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/gs/components/gs_theme/js/bootstrap.js"></script>
<script src="http://localhost/gs/components/gs_theme/js/b2c23c8eb4.js"></script>
<link href="http://localhost/gs/components/gs_theme/css/dataTables.bootstrap.min.css" rel="stylesheet"/ -->

 <div class="content-wrapper main-content-toggle-left"> 
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
<style>
#HijriCalendarParameter .modal-dialog {
	width:460px;
}
select:disabled {
	background:#e8e8e8;
}
body {
	overflow:hidden !important;	
}
</style>
<link rel="stylesheet" href="/application/views/master_calendar/js/jquery.mCustomScrollbar.css">
<script>window.jQuery || document.write('<script src="/application/views/master_calendar/js/jquery-1.11.0.min.js"><\/script>')</script>
<script src="/application/views/master_calendar/js/jquery.mCustomScrollbar.concat.min.js"></script>
<link rel="stylesheet" href="/application/views/master_calendar/style/style2.css">
<div class="container">
<div class="row" style="position:relative;padding:0 10px;">
  <input type="hidden" name="ScheduleFollowupStartDate" id="ScheduleFollowupStartDate" value="" />
<div class="col-md-12" id="OlaCalendar">
<?php // echo $calendar; 

?>
<?php $start_date_hidden =  date("Y-m-d", strtotime($StartDate)); ?>
	<div class="col-md-12 headCal no-padding">
	<input type="hidden" id="start_date_hidden" name="start_date_hidden" value="<?=$start_date_hidden; ?>" />
	<input type="hidden" id="START_WEEK_NMUBER" name="START_WEEK_NMUBER" value="<?=$WEEK_NMUBER; ?>" />
	
	<input type="hidden" id="AjaxReturnedID" name="AjaxReturnedID" value="0" />
	
	<div id="current_month" style="float: left;width: 15%;"><?php echo date("F, Y", strtotime($StartDate)); ?></div>
	<button type="button" class="todayGO"> Current Week </button>

	</div><!-- headCal -->
	<div class="col-md-12 weekCal no-padding">
	<?php /*$header = array("GWK","CWK","Mon","Tue","Wed","Thu","Fri","Sat","Sun"); ?>
	<?php 
		$counter=1;
		foreach( $header as $hd ): 
	?>
	<?php if($counter>2): ?>
		<div class="MonHead dayHead"><?php echo $hd;?></div><!-- weekHead -->
	<?php else: ?>
		<div class="weekHead dayHead"><?php echo $hd;?></div><!-- weekHead -->
	<?php endif; $counter++;?>
	<?php endforeach; */?>
	
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
	<?php //var_dump( $CalenderDates ); ?>
	
	<?php 
		$GenWe=0;
		$boo=true;
		if(!empty( $CalenderDates )):
		foreach($CalenderDates as $d ){
			if($d["genweek"]!=''){
				$GenWe = $d["genweek"];
				break;
			}
		}
		//$GenWe=($GenWe-1);
		else:
		$GenWe=0;
		endif;
		
		$Monday2='';
		$Monday3='';
		$MBoolean=true;
		
		$Tuesday2='';
		$Tuesday3='';
		$TuesBoolean=true;
		
		$Wednesday2='';
		$Wednesday3='';
		$WBoolean=true;
		
		$Thursday2='';
		$Thursday3='';
		$TBoolean=true;
		
		
		$Friday2='';
		$Friday3='';
		$FBoolean=true;
		
		
		$Saturday2='';
		$Saturday3='';
		$SBoolean=true;
		
		
		
		$Sunday2='';
		$Sunday3='';
		$SuBoolean=true;
		
		$First_Row=1;
	?>
	
	<?php if( $three_month_week_number > 0 ): ?>
	<?php for ($CalenderDate=1;  $CalenderDate < $three_month_week_number; $CalenderDate++): ?>
	
		<?php $weekDay = $controller->getStartAndEndDate($WEEK_NMUBER,$YEAR);?>
		
		<?php $hidden_month = date("F, Y",strtotime('+ '.$WEEK_NMUBER.' weeks', mktime(0,0,0,1,1,$YEAR,-1))); ?>
		<?php $hidden_month2 = (int)date("m",strtotime('+ '.$WEEK_NMUBER.' weeks', mktime(0,0,0,1,1,$YEAR,-1))); ?>
		
		
		<?php if($First_Row==1): ?>
		<?php $First_Row=0;?>
		<div class="col-md-12 weekRow no-padding First_Row">
		<?php else: ?>
		<div class="col-md-12 weekRow no-padding">
		<?php endif;?>
	
		
		<div class="weekBox dayHead"><?php echo $GenWe;?></div><!-- weekHead -->
		<div class="weekBox dayHead"><?=$WEEK_NMUBER;?></div><!-- weekHead -->
			
		<?php $Monday_Date = date("Y-m-d", strtotime($weekDay["Monday"])); ?>
		<input type="hidden" name="First_Monday" id="First_Monday" value="<?=$Monday_Date;?>" />
		<?php 
			$TodayDate = date("Y-m-d",time());
			if( $Monday_Date < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = "AddEventLinkNo";
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = "AddEventLink";
			}
		?>
		
			<?php 
			$ID=$WEEK_NMUBER;
			$d = explode("-",$weekDay['Monday']);
			
			
			if( $Monday_Date == $TodayDate ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			
			$Monday = strtotime($weekDay["Monday"]);
			if(date('j', $Monday) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
			?>
		<span class="hidden_month" style="position:absolute;" ><?=$hidden_month;?></span>
		
		<div class="MonBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="MonBox_<?=$Monday_Date;?>">
		
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			<?php if( $Monday_Date == $TodayDate ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			
			$MonBox = "MonBox_".$Monday_Date;
			
			$jsonText= $controller->get_date_header($MonBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];
			
			
			$IY  = (int)$d[0];
			$IM  = (int)date("m",strtotime( $Monday_Date ));
			$IsD = (int)$d[2];
				
			if( $hjri = $controller->Get_Hijri_Date( $Monday_Date ) ){
				 $e = explode("-",$hjri["islami_date"]);
				 $IslamicDay = $e[2];
				 $month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				 $MonBox2 = $hjri["islami_date"];
				}else{
					$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
					$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
				}
				
			
			?>
			<a class="<?=$AddEvent;?> <?=$Today;?>" href="#" data-id="<?=$MonBox;?>" id="<?=$MonBox2;?>">
					<?=$d[2];?><br /><?=$d[1];?>
			</a><span class="tooltipptext">Add Event</span>
			</div><!-- EnglishDate -->
			
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">

            <!----------------------------------------------------------------------->
           
			
			<?php 
				if( $hijri["IslamicDay"] == 29 ) : 
					//$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Monday_Date.'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Monday_Date."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
					//$HijriCalendarParameter3='';
					//$HijriCalendarParameter4='';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
					
					//$HijriCalendarParameter3='<a class="AddEventLinkHijri '.$Today.'" href="#" id="'.$Monday_Date.'" data-id="'.$MonBox2.'" >';
					//$HijriCalendarParameter4='</a>';
					
				endif;
				
				
			if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;
			?>
			
			<?php //echo $HijriCalendarParameter1?$HijriCalendarParameter1:$HijriCalendarParameter3; ?> 
			<?php echo $HijriCalendarParameter1; ?> 
				<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext"><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
				
			<?php //echo $HijriCalendarParameter2?$HijriCalendarParameter2:$HijriCalendarParameter4; ?> 
			<?php echo $HijriCalendarParameter2; ?> 
			
            <!----------------------------------------------------------------------->
			
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding"> <?php echo $myArray["Ht"]; ?> </div>
			<div class="eventListingHere"><?php echo $controller->get_date_events($Monday_Date,$MonBox); ?></div>
		</div><!-- col-md-9 -->
		</div><!-- MonHead -->
		
		
		
		
		<?php $Tuesday = date("Y-m-d", strtotime($weekDay["Tuesday"])); ?>
		<?php 
			$TodayDate = date("Y-m-d",time());
			if( $Tuesday < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = "#AddEventNo";
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = "AddEventLink";
			}
		?>
		
		<?php $d = explode("-",$weekDay['Tuesday'] );?>
		<?php if( $Tuesday == $TodayDate ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			
			
			$Tuesdayj = strtotime($Tuesday);
			if(date('j', $Tuesdayj) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
			
			$TueBox = "TueBox_".$Tuesday;
			
			
			$jsonText= $controller->get_date_header($TueBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];	
			
			
			$IY  = (int)$d[0];
			$IM  = (int)date("m",strtotime( $Tuesday));
			$IsD = (int)$d[2];
				
			if( $hjri = $controller->Get_Hijri_Date( $Tuesday ) ){
				 $e = explode("-",$hjri["islami_date"]);
				$IslamicDay = $e[2];
				 $month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				 $MonBox2 = $hjri["islami_date"];
			}else{
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
				$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
			}
				
			
			?>
			
		<div class="TueBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="TueBox_<?=$Tuesday;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#" data-id="<?=$TueBox;?>" id="<?=$MonBox2;?>">
				
				<?=$d[2];?><br /><?=$d[1];?>
				<span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
			
			<?php
			if( $hijri["IslamicDay"] == 29 ) : 
				//$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$Tuesday.'" data-toggle="modal" data-target="#HijriCalendarParameter">';
				$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Tuesday."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
				endif;
		
			if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;	
					
			?>
			
			<?php echo $HijriCalendarParameter1; ?> 
				<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext" ><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?>
				
				</span>
				
			<?php echo $HijriCalendarParameter2; ?> 
			
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php echo $myArray["Ht"]; ?>
			</div><!-- col-md-12 -->
			<div class="eventListingHere"><?=$controller->get_date_events($Tuesday,$TueBox);?></div>
		</div><!-- col-md-9 -->
		</div><!-- TueHead -->
		
		<?php $d = explode("-",$weekDay["Wednesday"] ); ?>
		<?php if( date("Y-m-d", strtotime($weekDay["Wednesday"])) == date("Y-m-d") ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			
			
			
			$Wednesday = date("Y-m-d", strtotime($weekDay["Wednesday"]));
			$Wednesday2=$controller->firstDay($Wednesday);
			
			if( ( $Wednesday2 == $Wednesday3 ) ){
				$Wednesday3=$controller->firstDay($Wednesday);
				$MonthStart='';
			}else{
				$Wednesday3=$controller->firstDay($Wednesday);
				if($WBoolean){
					$WBoolean=false;
					$MonthStart='';	
				}else{
					$MonthStart='MonthStart';	
				}
			}
			
			$Wednesday = strtotime($weekDay["Wednesday"]);
			if(date('j', $Wednesday) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
			
			?>
			<?php 
			$Wednesday = date("Y-m-d", strtotime($weekDay["Wednesday"])); 
			$TodayDate = date("Y-m-d",time());
			if( $Wednesday < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = '#AddEventN';
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
			}
			
			$WedBox = "WedBox_".$Wednesday;
			
			
			
			$jsonText= $controller->get_date_header($WedBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];	
			
			
			
			$IY  = (int)$d[0];
			$IM  = (int)date("m",strtotime( $weekDay["Wednesday"]));
			$IsD = (int)$d[2];
				
			if( $hjri = $controller->Get_Hijri_Date( $Wednesday ) ){
				$e = explode("-",$hjri["islami_date"]);
				$IslamicDay = $e[2];
				$month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				 $MonBox2 = $hjri["islami_date"];
			}else{
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
				$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
			}
		?>
		
		<div class="WedBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="WedBox_<?=date("Y-m-d", strtotime($weekDay["Wednesday"]));?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="<?=$WedBox;?>" id="<?=$MonBox2;?>">
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
				<?php
				if( $hijri["IslamicDay"] == 29) :
					//$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$Wednesday.'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Wednesday."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
				endif;
				
				
				if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;
			
			?>
			
			<?php echo $HijriCalendarParameter1; ?> 
				<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext" ><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
			<?php echo $HijriCalendarParameter2; ?> 
			
			
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
				<?php //echo $controller->get_date_header($WedBox); 
				echo $myArray["Ht"];
				?>
			</div><!-- col-md-12 -->
			<div class="eventListingHere"><?=$controller->get_date_events($Wednesday,$WedBox);?></div>
		</div><!-- col-md-9 -->
		</div><!-- WedHead -->
		
		<?php $d = explode("-",$weekDay["Thursday"] ); ?>
		<?php if( date("Y-m-d", strtotime($weekDay["Thursday"])) == date("Y-m-d") ):
			$Today='Today';
			else:
			$Today='';
			endif;
			
			
			
			$Thursday = strtotime($weekDay["Thursday"]);
			if(date('j', $Thursday) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
			
			
			$Thursday = date("Y-m-d", strtotime($weekDay["Thursday"])); 
			$TodayDate = date("Y-m-d",time());
			if( $Thursday < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = '#AddEventN';
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
			}
			$ThuBox = "ThuBox_".$Thursday;
			
			
			$jsonText= $controller->get_date_header($ThuBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];	
			
			$IY  = (int)$d[0];
			$IM  = (int)date("m",strtotime( $weekDay["Thursday"]));
			$IsD = (int)$d[2];
				
			if( $hjri = $controller->Get_Hijri_Date( $Thursday ) ){
			 $e = explode("-",$hjri["islami_date"]);
			 $IslamicDay = $e[2];
			 $month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				 $MonBox2 = $hjri["islami_date"];
			}else{
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
				$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
			}
		?>
		
		<div class="ThuBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$ThuBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="ThuBox_<?=$Thursday;?>" id="<?=$MonBox2;?>">
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
				<?php
				if( $hijri["IslamicDay"] == 29 ) : 
					//$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$Thursday.'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Thursday."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
				endif;
				
				
				if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;
			?>
			
			<?php echo $HijriCalendarParameter1; ?> 
			<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext" ><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
			<?php echo $HijriCalendarParameter2; ?> 
			
			
			
			</div>
		</div>
		

		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php echo $myArray["Ht"]; ?>
			</div><!-- col-md-12 -->
		<div class="eventListingHere"><?=$controller->get_date_events($Thursday,$ThuBox);?></div>
		</div><!-- col-md-9 -->
		</div><!-- ThuHead -->
		
		<?php $d = explode("-",$weekDay["Friday"] );?>
		<?php if( date("Y-m-d", strtotime($weekDay["Friday"])) == date("Y-m-d") ):
			$Today='Today';
			else:
			$Today='';
			endif;
			
			$Friday = strtotime($weekDay["Friday"]);
			
			if(date('j', $Friday) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
			
		$Friday = date("Y-m-d", strtotime($weekDay["Friday"])); 
		$TodayDate = date("Y-m-d",time());
			if( $Friday < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent='#AddEventN';
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent='AddEventLink';
			}
			$FriBox = "FriBox_".$Friday;
			
			
			$jsonText= $controller->get_date_header($FriBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];
			
			
			$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Friday"]));
				$IsD = (int)$d[2];
				
			if( $hjri = $controller->Get_Hijri_Date( $Friday ) ){
			 $e = explode("-",$hjri["islami_date"]);
			 $IslamicDay = $e[2];
			 $month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				 $MonBox2 = $hjri["islami_date"];
			}else{
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
				$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
			}
		?>	
		
		<div class="FriBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$FriBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#" data-id="<?=$FriBox;?>" id="<?=$MonBox2;?>">
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
			
		
			<?php 
				//if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
				if( $hijri["IslamicDay"] == 29 ) :
					//$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$Friday.'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Friday."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
				endif;
				
				if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;
			?>
			
			<?php echo $HijriCalendarParameter1; ?> 
			<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext" ><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
			<?php echo $HijriCalendarParameter2; ?> 
				
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
	
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($FriBox); 
			echo $myArray["Ht"];
			?>
			</div><!-- col-md-12 -->
			<div class="eventListingHere"><?=$controller->get_date_events($Friday,$FriBox); ?></div>
		</div><!-- col-md-9 -->
		</div><!-- FriHead -->
		
		<?php $d = explode("-",$weekDay["Saturday"] );?>
		<?php if( date("Y-m-d", strtotime($weekDay["Saturday"])) == date("Y-m-d") ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			
			
		
			$Saturday = strtotime($weekDay["Saturday"]);
			if(date('j', $Saturday) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
			
			$Saturday = date("Y-m-d", strtotime($weekDay["Saturday"])); 
			$TodayDate = date("Y-m-d",time());
			if( $Saturday < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent='#AddEventn';
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent='AddEventLink';
			}
			
			$SatBox = "SatBox_".$Saturday;
			
			
			$jsonText= $controller->get_date_header($SatBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];
			$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Saturday"]));
				$IsD = (int)$d[2];
			if( $hjri = $controller->Get_Hijri_Date( $Saturday ) ){
			 $e = explode("-",$hjri["islami_date"]);
			 $IslamicDay = $e[2];
			 $month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				 $MonBox2 = $hjri["islami_date"];
			}else{
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
				$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
			}
			
		?>
		
		<div class="SatBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$SatBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#" data-id="SatBox_<?=$Saturday;?>" id="<?=$MonBox2;?>">
				
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			
			
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
			
		
			<?php 
				//if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
				if( $hijri["IslamicDay"] == 29 ) :
					//$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$Saturday.'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Saturday."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
				endif;
				
				if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;
			?>
			
			<?php echo $HijriCalendarParameter1; ?> 
			<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext" ><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
			<?php echo $HijriCalendarParameter2; ?> 
				
				
			
			</div>
		</div>
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($SatBox); 
				echo $myArray["Ht"];
			?>
			
			</div>
			<div class="eventListingHere"><?=$controller->get_date_events($Saturday,$SatBox);?></div>
		</div>
		</div>
		
		<?php $d = explode("-",$weekDay["Sunday"] );?>
		<?php if( date("Y-m-d", strtotime($weekDay["Sunday"])) == date("Y-m-d") ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			

			
			$Sunday = strtotime($weekDay["Sunday"]);
			if(date('j', $Sunday) == '1') { $MonthStart='MonthStart'; }else{ $MonthStart=''; }
		$Sunday = date("Y-m-d", strtotime($weekDay["Sunday"])); 
			$TodayDate = date("Y-m-d",time());
			if( $Sunday < $TodayDate){ 
				$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent='#AddEventN';
			}else{ 
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent='AddEventLink';
			}
			
			$SunBox = "SunBox_".$Sunday;
			
			
			$jsonText= $controller->get_date_header($SunBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			$AddEvent = (string)$myArray["RClass"]["AddEvent"];
			
			$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Sunday"]));
				$IsD = (int)$d[2];	
				
			if( $hjri = $controller->Get_Hijri_Date( $Sunday ) ){
			 $e = explode("-",$hjri["islami_date"]);
			 $IslamicDay = $e[2];
			$month_code = $hjri["month_code"];
				 $Symbol = $hjri["Symbol"];
				 $hijri = array( "IslamicMonth"=>$hjri["IslamicMonth"], "IslamicDay"=>$IslamicDay,"month_code"=>$month_code,"Symbol"=>$Symbol);
				
			 $MonBox2 = $hjri["islami_date"];
			}else{
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);	
				$MonBox2 = $hijri['IslamicYear']."-".$hijri["IslamicMonth"]."-".$hijri["IslamicDay"];
			}
		?>	
			
		<div class="SunBox dayHead <?=$Today;?>" id="<?=$SunBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate tooltipp">
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#" data-id="SunBox_<?=$Sunday;?>" id="<?=$MonBox2;?>">
			<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			
			
			<?php if( !empty( $myArray["HD"] ) ){
				$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
			}else{
				$HDtHilight='';
			} ?>
			<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
			<?php 
				//if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
				if( $hijri["IslamicDay"] == 29 ) : 
					$HijriCalendarParameter1='<a class="hijriForm" href="#" id="'.$hijri["IslamicMonth"]."_".$Sunday."_".$hjri["islami_date"].'" data-toggle="modal" data-target="#HijriCalendarParameter">';
					$HijriCalendarParameter2='</a>';
				else:
					$HijriCalendarParameter1='';
					$HijriCalendarParameter2='';
				endif;
				
				
				if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
			$Symbol = $hijri['Symbol'];
			else:
			$Symbol = '';
			endif;
			?>
			
			<?php echo $HijriCalendarParameter1; ?> 
			<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
				<span class="tooltipptext" ><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
			<?php echo $HijriCalendarParameter2; ?> 
				
			
			
			</div>
		</div>
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($SunBox); 
			echo $myArray["Ht"];
			?>
			</div>
		<div class="eventListingHere"><?=$controller->get_date_events($Sunday,$SunBox);?></div>
		</div>
		</div>
		</div>
		
		<?php $WEEK_NMUBER++;?>
		
		<?php $GenWe++;?>
		
		<?php endfor; ?>
		
		<?php endif;?>
</div><!-- MonthDays-->
<?php $EndDate = date("Y-m-d", strtotime($weekDay["Sunday"]. ' +1 day')); ?>
<input type="hidden" name="endDate[]" id="endDate" class="endDate" value="<?=$EndDate?>" />

<input type="hidden" name="endGenWe" id="endGenWe" class="endGenWe" value="<?=$GenWe;?>" />
<input type="hidden" name="WEEK_NMUBER" id="WEEK_NMUBER" class="WEEK_NMUBER" value="<?=$WEEK_NMUBER;?>" />

<div class="col-md-12 no-padding" style="display:none;text-align:center" id="ajaxloader">
<img src="<?php echo base_url();?>/components/image/ajax-loader22.gif">
</div>
</div><!-- col-md-12 -->


<!-- // Modal -->
<div class="col-md-12" style="position:relative;">
    <div class="modal fade TimeLineModal" id="HijriCalendarParameter" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Hijri Calendar Parameter - <strong>30th Shaban</strong></h4>
                </div>
                <div class="modal-body">
                  <div class="row" id="HolidayParameters45">
                    	<div class="row" id="StaffParameters45">
                            <div class="col-md-12" style="padding:10px 0;">
                                <div class="col-md-3" style="padding-top:5px;">
                                    Hijri Month
                                </div>
								<input type="hidden" name="Hijri_Date3" value="" id="Hijri_Date3" />
								<input type="hidden" name="Hijri_Date4" value="" id="Hijri_Date4" />
								
                                <div class="col-md-9">
                                    <select name="SuperProfile1" id="SuperProfile1" disabled="disabled">
                                      <option value="16"> Shaban </option>
                                      <option value="17"> Ramadan </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12" style="padding:10px 0;">
                            <div class="col-md-3" style="padding-top:5px;">
                                No of Days
                            </div>
                            <div class="col-md-9">
                                <select name="SuperProfile2" id="SuperProfile2">
                                  <option value="29"> 29 </option>
                                  <option value="30"> 30 </option>
                                </select>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="greenBTN widthSmall" data-dismiss="modal" value="Set Hijri Month Parameter" id="HijriButton" style="width: 46%;">
                </div>
            </div>
        
        </div>
    </div><!-- Hijri Calendar Parameter -->
    
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
<input type="submit" class="greenBTN widthSmall" data-dismiss="modal" id="SPButton" value="Set Staff Parameter" />
  <div id="PleaseWait" style="display:none;">
					<img src="<?php echo base_url();?>/components/image/ajax-loader22.gif" /> Please wait..
					</div>
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
<div class="modal-content" id="SchFParameters">
 <!--// Ajax Response will be drag here -->
</div>
</div>
</div><!-- SetScheduleFollowup -->



<div class="modal fade TimeLineModal" id="AddEventModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" id="AddEventModalContent">
			<!-- modal Ajax Response HTML content -->
		</div><!-- modal-content -->
	</div>
</div><!-- AddEvent -->


<div class="modal fade TimeLineModal" id="AddEventModalHijri" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" id="AddEventModalContentHijri">
			<!-- modal Ajax Response HTML content -->
		</div><!-- modal-content -->
	</div>
</div><!-- AddEvent -->



<div class="modal fade TimeLineModal" id="ViewMoreHere" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close floatClose" data-dismiss="modal">&times;</button>
<h4 class="modal-title">View More Event/Parameter</h4>
</div>
<div class="modal-body">
	<div class="row" id="ViewMoreHereContent">
		<!--// Ajax Response will be drag here -->
	</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div><!-- SetStudentParameter -->





</div><!--- col-md-12 -->        

</div><!-- row -->
</div><!-- container -->

</div><!-- content-wrapper -->
