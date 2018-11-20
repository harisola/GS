<?php  
	$boo=true;
	$checkGenW=1;
	if( !empty($CalenderDates) ){
		foreach( $CalenderDates as $d ){
			if($d["genweek"]!=''){
				//$GenWe = $d["genweek"];
				$checkGenW=1;
				break;
			}else{
				//$GenWe = 2;
			}
		}
		//$GenWe=($GenWe-1);
	}else{ 
		$checkGenW=0;
		$GenWe = '-'; 
	}
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
	
	$Lw = $controller->getIsoWeeksInYear($YEAR);
	
	
	
?>
	
	
	<?php for ($CalenderDate=1;  $CalenderDate < $three_month_week_number; $CalenderDate++): ?>
	
		<?php $weekDay = $controller->getStartAndEndDate($WEEK_NMUBER, $YEAR);?>
		
		
		
		<?php $hidden_month2 = (int)date("m",strtotime('+ '.$WEEK_NMUBER.' weeks', mktime(0,0,0,1,1,$YEAR,-1))); ?>
		<?php $hidden_month = date("F, Y",strtotime('+ '.$WEEK_NMUBER.' weeks', mktime(0,0,0,1,1,$YEAR,-1))); ?>
		
		<?php $Monday_Date = date("z", strtotime( $weekDay["Monday"] )); ?>
		<?php $Tuesday_Date = date("z", strtotime($weekDay["Tuesday"])); ?>
		<?php $Wednesday_Date = date("z", strtotime($weekDay["Wednesday"])); ?>
		<?php $Thursday_Date = date("z", strtotime($weekDay["Thursday"])); ?>
		<?php $Friday_Date = date("z", strtotime($weekDay["Friday"])); ?>
		<?php $Saturday_Date = date("z", strtotime($weekDay["Saturday"])); ?>
		<?php $Sunday_Date = date("z", strtotime($weekDay["Sunday"])); ?>
		
	
		<?php 
		//$arr = array( "Monday_Date"=> $Monday_Date,$Tuesday_Date,$Wednesday_Date,$Thursday_Date,$Friday_Date,$Saturday_Date,$Sunday_Date);
			if ( $Monday_Date == 0   	|| 
				 $Tuesday_Date == 0  	|| 
				 $Wednesday_Date == 0 	|| 
				 $Thursday_Date == 0 	|| 
				 $Friday_Date == 0 	|| 
				 $Saturday_Date == 0  	|| 
				 $Sunday_Date == 0  
				){	$WEEK_NMUBER=1; }
		?>
		
		<?php if($First_Row==1): ?>
		<?php $First_Row=0;?>
		<div class="col-md-12 weekRow no-padding First_Row">
		<?php else: ?>
		<div class="col-md-12 weekRow no-padding">
		<?php endif;?>
	
		
		<div class="weekBox dayHead"><?=sprintf('%02d', $GenWe);?></div><!-- weekHead -->
		<div class="weekBox dayHead"><?=sprintf('%02d', $WEEK_NMUBER);?></div><!-- weekHead -->
			
		<?php $Monday_Date = date("Y-m-d", strtotime($weekDay["Monday"])); ?>
		<input type="hidden" name="First_Monday" id="First_Monday" value="<?=$Monday_Date;?>" />
		<?php 
			$TodayDate = date("Y-m-d",time());
			if( $Monday_Date < $TodayDate){ 
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = "AddEventLinkNo";*/
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
				
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
			$hjri = $controller->Get_Hijri_Date( $Monday_Date );	
			if( !empty( $hjri["islami_date"] ) ){
				
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
		
			<div class="col-md-12 no-padding">
				<?php  echo $myArray["Ht"]; ?>
			</div><!-- col-md-12 -->
			
			<div class="eventListingHere">
				<?php echo $controller->get_date_events($Monday_Date,$MonBox); ?>
		</div><!-- eventListingHere -->
			
			
		</div><!-- col-md-9 -->
		</div><!-- MonHead -->
		
		
		
		
		<?php $Tuesday = date("Y-m-d", strtotime($weekDay["Tuesday"])); ?>
		<?php 
			$TodayDate = date("Y-m-d",time());
			if( $Tuesday < $TodayDate){ 
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = "#AddEventNo";*/
				
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
				
				
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
			$hjri = $controller->Get_Hijri_Date( $Tuesday );
			if( !empty( $hjri["islami_date"] ) ){
				
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
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = '#AddEventN';*/
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
				
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
				
			$hjri = $controller->Get_Hijri_Date( $Wednesday );
			if( !empty( $hjri["islami_date"] ) ){	
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
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent = '#AddEventN';*/
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
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
				
			$hjri = $controller->Get_Hijri_Date( $Thursday );
			if( !empty( $hjri["islami_date"] ) ){
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
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent='#AddEventN';*/
				
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
				
				
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
				
			$hjri = $controller->Get_Hijri_Date( $Friday );
			if( !empty( $hjri["islami_date"] ) ){
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
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent='#AddEventn';*/
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
				
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
			$hjri = $controller->Get_Hijri_Date( $Saturday );
			if( !empty( $hjri["islami_date"] ) ){	
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
				/*$class1='HolidayParameter3';
				$class2='StaffParameter3';
				$class3='StudentParameter3';
				$class4='ScheduleFollowup3';
				$AddEvent='#AddEventN';*/
				
				$class1='HolidayParameter';
				$class2='StaffParameter';
				$class3='StudentParameter';
				$class4='ScheduleFollowup';
				$AddEvent = 'AddEventLink';
				
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
				
			$hjri = $controller->Get_Hijri_Date( $Sunday );
			if( !empty( $hjri["islami_date"] ) ){	
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
		<?php if( $WEEK_NMUBER == $Lw ){  $WEEK_NMUBER=0; $YEAR++; } ?>
		<?php $WEEK_NMUBER++;?>
		
		<?php 
			if( $checkGenW > 0 ){
			$GenWe++;	
			}else{
				
			}
			
		?>
		<?php endfor; ?>
		<?php $EndDate = date("Y-m-d", strtotime($weekDay["Sunday"]. ' +1 day')); ?>
		<input type="hidden" name="endDate[]" id="endDate" class="endDate" value="<?=$EndDate?>" />
		<input type="hidden" name="endGenWe" id="endGenWe" class="endGenWe" value="<?=$GenWe;?>" />
		<input type="hidden" name="WEEK_NMUBER" id="WEEK_NMUBER" class="WEEK_NMUBER" value="<?=$WEEK_NMUBER;?>" />
		
	