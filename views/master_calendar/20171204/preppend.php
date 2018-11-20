<?php 
	//var_dump( $CalenderDates  );
	$boo=true;
	if( !empty($CalenderDates) ){
		foreach( $CalenderDates as $d ){
			if($d["genweek"]!=''){
				$GenWe = $d["genweek"];
				break;
			}else{
				
				$GenWe = 2; 
				//break;
			}
		}
		//$GenWe=($GenWe-1);
	}else{
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
	
	
?>
	
	
	<?php for ($CalenderDate=1;  $CalenderDate <= $three_month_week_number; $CalenderDate++): ?>
	
		<?php $weekDay = $controller->getStartAndEndDate($WEEK_NMUBER, $YEAR);?>
		<?php $hidden_month = date("F, Y",strtotime('+ '.$WEEK_NMUBER.' weeks', mktime(0,0,0,1,1,$YEAR,-1))); ?>
		<?php $hidden_month2 = (int)date("m",strtotime('+ '.$WEEK_NMUBER.' weeks', mktime(0,0,0,1,1,$YEAR,-1))); ?>
		
		
		<div class="col-md-12 weekRow no-padding"  >
		
			<div class="weekBox dayHead"><?php echo $GenWe;?></div><!-- weekHead -->
			
			<div class="weekBox dayHead"><?=$WEEK_NMUBER;?></div><!-- weekHead -->
			
		<?php $Monday_Date = date("Y-m-d", strtotime($weekDay["Monday"])); ?>
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
			<div class="EnglishDate">
			<?php if( $Monday_Date == $TodayDate ):
			$Today='Today';
			else:
			$Today='';
			endif; 
			
			$MonBox = "MonBox_".$Monday_Date;
			
			
			$jsonText= $controller->get_date_header($MonBox);
			$decodedText = html_entity_decode($jsonText);
			$myArray = json_decode($decodedText, true);
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];
			
			?>
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="<?=$MonBox;?>">
					<?=$d[2];?><br /><?=$d[1];?>
					<span class="tooltipptext">Add Event</span>
				</a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
			<?php
			
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $Monday_Date ));
				$IsD = (int)$d[2];
				
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
			
				<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,4); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
				
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
		
		<div class="col-md-9 no-padding">
		
			<div class="col-md-12 no-padding">
				<?php  echo $myArray["Ht"]; ?>
			</div><!-- col-md-12 -->
			
			<div class="eventListingHere">
				<?php echo $controller->get_date_events($Monday_Date); ?>
		</div><!-- eventListingHere -->
			
			
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
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];	
				
			?>
			
		<div class="TueBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$TueBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="TueBox_<?=$Tuesday;?>">
				
				<?=$d[2];?><br /><?=$d[1];?>
				<span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
				<?php
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $Tuesday));
				$IsD = (int)$d[2];
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
				<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,4); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($TueBox); 
				
				echo $myArray["Ht"];
				
			
			?>
			</div><!-- col-md-12 -->
			<div class="eventListingHere"><?=$controller->get_date_events($Tuesday);?></div>
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
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];	
		?>
		
		<div class="WedBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="WedBox_<?=date("Y-m-d", strtotime($weekDay["Wednesday"]));?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="<?=$WedBox;?>">
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
				<?php
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Wednesday"]));
				$IsD = (int)$d[2];
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
				<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,4); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
		<?php //echo $controller->get_date_header($WedBox); 
		echo $myArray["Ht"];
		?>
			</div><!-- col-md-12 -->
			<div class="eventListingHere"><?=$controller->get_date_events($Wednesday);?></div>
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
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];	
		?>
		
		<div class="ThuBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$ThuBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="ThuBox_<?=$Thursday;?>">
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
				<?php
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Thursday"]));
				$IsD = (int)$d[2];
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
		<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,4); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
			</div>
		</div>
		

		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($ThuBox); 
			echo $myArray["Ht"];
			?>
			</div><!-- col-md-12 -->
		<div class="eventListingHere"><?=$controller->get_date_events($Thursday);?></div>
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
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];
		?>	
		<div class="FriBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$FriBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="<?=$FriBox;?>">
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
				<?php
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Friday"]));
				$IsD = (int)$d[2];
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
	<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,4); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
			</div><!-- EnglishDate -->
		</div><!-- col-md-3 -->
	
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($FriBox); 
			echo $myArray["Ht"];
			?>
			</div><!-- col-md-12 -->
			<div class="eventListingHere"><?=$controller->get_date_events($Friday); ?></div>
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
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];
		?>
		
		<div class="SatBox dayHead <?=$Today;?> <?=$MonthStart;?>" id="<?=$SatBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate">
			
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#"   data-id="SatBox_<?=$Saturday;?>">
				
				<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
				<?php
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Saturday"]));
				$IsD = (int)$d[2];
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
		<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,4); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
			</div>
		</div>
		
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($SatBox); 
				echo $myArray["Ht"];
			?>
			
			</div>
			<div class="eventListingHere"><?=$controller->get_date_events($Saturday);?></div>
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
			//$AddEvent = (string)$myArray["RClass"]["AddEvent"];
		?>	
			
		<div class="SunBox dayHead <?=$Today;?>" id="<?=$SunBox;?>">
		<div class="col-md-3 no-padding DateArea">
			<div class="EnglishDate">
			<a class="tooltipp <?=$AddEvent;?> <?=$Today;?>" href="#" data-id="SunBox_<?=$Sunday;?>">
			<?=$d[2];?><br /><?=$d[1];?><span class="tooltipptext">Add Event</span></a>
			</div><!-- EnglishDate -->
			<div class="ArabicDate tooltipp">
				<?php
				$IY  = (int)$d[0];
				$IM  = (int)date("m",strtotime( $weekDay["Sunday"]));
				$IsD = (int)$d[2];	
				$hijri = $controller->Greg2Hijri($IsD, $IM, $IY, $string = false);
				//var_dump($hijri);
			?>
			<?=$hijri["IslamicDay"];?><br /><?=substr( $hijri["IslamicMonth"],0,3); ?>..<span class="tooltipptext" ><?=$hijri["IslamicMonth"];?></span>
			</div>
		</div>
		<div class="col-md-9 no-padding">
			<div class="col-md-12 no-padding">
			<?php //echo $controller->get_date_header($SunBox); 
			echo $myArray["Ht"];
			?>
			</div>
		<div class="eventListingHere"><?=$controller->get_date_events($Sunday);?></div>
		</div>
		</div>
		</div>
		
	
		<?php $WEEK_NMUBER++;?>
		<?php $GenWe++;?>
		
		<?php endfor; ?>
		
		
	