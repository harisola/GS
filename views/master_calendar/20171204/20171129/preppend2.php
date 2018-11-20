<?php 
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

if( !empty($CalenderDates) ){
	foreach( $CalenderDates as $d ){
		if($d["genweek"]!=''){
			$GenWe = $d["genweek"];
			//break;
		}
	}
	//$GenWe=($GenWe-1);
}else{
	$GenWe = '-';
}
	
$counter=1;

//var_dump($CalenderDates);
?>
	
<div class="col-md-12 weekRow no-padding" style="background-color: #dff0d8;"> 
<input type="hidden" name="First_Monday" id="First_Monday" value="<?=$first_day_of_week;?>" />
<?php $Week =  date("W", strtotime($first_day_of_week)); ?>
<div class="weekBox dayHead"><?=$GenWe;?></div><!-- weekHead --> <?php $GenWe++;?>
<div class="weekBox dayHead"><?=$Week;?></div><!-- weekHead -->
<?php
	$wks = $controller->week_start_end_by_date(date("Y-m-d", strtotime($first_day_of_week)), $format = 'Y-m-d');
	$first_day_of_week = $wks["first_day_of_week"];
	$last_day_of_week = $wks["last_day_of_week"];
	$CalenderDates = $controller->getMasterCalender($first_day_of_week, $last_day_of_week);	
?>
<?php $loop=1; ?>
<?php if( !empty($CalenderDates) ): ?>
<?php foreach($CalenderDates as $d ): ?>
<?php
	switch( $loop ){
		case 1: $MonBox = 'MonBox'; break; case 2: $MonBox = 'TueBox'; break; case 3: $MonBox = 'WedBox'; break;
		case 4: $MonBox = 'ThuBox'; break; case 5: $MonBox = 'FriBox'; break; case 6: $MonBox = 'SatBox'; break;
		case 7: $MonBox = 'SunBox'; break;
	}
	
$TodayDate = date("Y-m-d",time());
$Monday_Date = $d["date"];

if( $Monday_Date == $TodayDate ):
$Today='Today';
else:
$Today='';
endif;

	 ?>

<div class="<?=$MonBox;?> dayHead">
<div class="col-md-3 no-padding DateArea">
<div class="EnglishDate">
<?php 
$MonBox = $MonBox."_".$d["date"];
$jsonText= $controller->get_date_header($MonBox);
$decodedText = html_entity_decode($jsonText);
$myArray = json_decode($decodedText, true);
$AddEvent = (string)$myArray["RClass"]["AddEvent"];
$dd = explode("-",$d['islami_date']);
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
<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#" data-id="<?=$MonBox;?>" id="<?=$MonBox2;?>">
<?php echo date("d", strtotime($d['date'])); ?><br /><?php echo date("M", strtotime($d['date'])); ?>
<span class="tooltipptext">Add Event</span>
</a>
</div><!-- EnglishDate -->
<?php if( !empty( $myArray["HD"] ) ){
	//$HDtHilight="background: #fdc9c9 none repeat scroll 0 0; color: #000000;";
	$HDtHilight="background: #f2f3dc none repeat scroll 0 0;color: #000000;width: 100%;font-weight: bold;height: 58px;";
}else{
	$HDtHilight='';
} ?>
<div class="ArabicDate tooltipp" style="<?=$HDtHilight;?>">
<?php
if( $hijri["IslamicDay"] == 29 || $hijri["IslamicDay"] == 30 ) : 
$Symbol = $hijri['Symbol'];
else:
$Symbol = '';
endif;
?>
<?=$hijri["IslamicDay"];?><br /> <?php echo $hijri['month_code'];?> <br />  <?php echo $Symbol;?></span>
<span class="tooltipptext"><?=$hijri["IslamicDay"];?>-<?=$hijri["IslamicMonth"];?></span>
</div><!-- EnglishDate -->
</div><!-- col-md-3 -->
<div class="col-md-9 no-padding">
<div class="col-md-12 no-padding">
	<?php  echo $myArray["Ht"]; ?>
</div><!-- col-md-12 -->
<div class="eventListingHere">
	<?php echo $controller->get_date_events($d["date"],$MonBox); ?>
</div><!-- eventListingHere -->
</div><!-- col-md-9 -->
</div><!-- MonHead -->
<?php $loop++; endforeach; ?>
<?php endif; ?>
</div><!-- weekRow-->