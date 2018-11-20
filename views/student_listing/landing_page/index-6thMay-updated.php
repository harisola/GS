<style>
.container {
	width: 100% !important;
}
.BrowsingList {
    border-right: 2px dashed #888;
	padding-left:25px;
    width: 40%;
}
.content-wrapper {
    min-height: 860px !important;
	max-width: 1700px !important;
    margin: 0 auto;
}
div.dataTables_filter input {
	max-width:140px;	
}
.table > thead > tr > th, 
.table > tbody > tr > th, 
.table > tfoot > tr > th, 
.table > thead > tr > td, 
.table > tbody > tr > td, 
.table > tfoot > tr > td {
    padding: 4px 4px;
}
.xedit span.grayish {
    color: #888;
    float: left;
    width: 140px;
}

</style>

<div class="container">
	<div class="row">
    	<div class="col-md-5 BrowsingList " style="">
	    	<div class="LeftListing" style="">
			
			<?php 
			/*
			array (size=9)
  'Total' => string '30' (length=2)
  'Total_Boys' => string '30' (length=2)
  'Total_Boys_Fence' => string '0' (length=1)
  'Total_Girls' => string '0' (length=1)
  'Total_Girls_Fence' => string '0' (length=1)
  'Total_Fence' => string '0' (length=1)
  'Today_Boys' => string '4' (length=1)
  'Today_Girls' => string '0' (length=1)
  'Today_Fence' => string '0' (length=1)
			*/
			
			//var_dump( $TodayTotal );
			
			
			$GS_Total = ( $header_count['Total'] );
			$Today_Absents = $header_count["Today_Absents"];
			
			$Total_Boys = $header_count['Total_Boys'];
			$Total_Girls = $header_count['Total_Girls'];
			
			$Total_Boys_Fence  = $header_count['Total_Boys_Fence'];
			$Total_Girls_Fence = $header_count['Total_Girls_Fence'];
			$Total_Fence = ( $Total_Boys_Fence + $Total_Girls_Fence );
			$GS_Total = ( $GS_Total - $Total_Fence );
			
			$Today_Boys = $header_count["Today_Boys"];
			$Today_Girls = $header_count["Today_Girls"];
			$Today_Total = ( $Today_Boys + $Today_Girls );
			
			$Today_Boys_Fence = $header_count["Today_Boys_Fence"];
			$Today_Girls_Fence = $header_count["Today_Girls_Fence"];
			$Today_Fence = $header_count["Today_Fence"];
			
			
			
			
			
			
			$Grade_Section_Total_Today = $Today_Total;
			$Grade_Section_Total = $GS_Total;
			$Grade_Section_Fence = $Total_Fence;
			
			
			
			
			
			
			
			
			
			if( !empty( $header_count ) ){ 
			
				$num = ( $Today_Total / $GS_Total );
				$Today_T = round( ( $num * 10 ) ,1 );
			
			
			
			?>
			<?php
			
				 
						
					
						?>
			<div class="yellowBGHead showOnScroll b" style="display:none;">
			
                	<div class="col-md-2 no-padding" style="border-right:1px solid #c34a4a;">
                    	<h4 class="text-center totalAtt">
                        	<span data-toggle="tooltip" data-placement="top" data-original-title="Att. Total" data-pin-nopin="true">
							<?php echo $GS_Total;?></span>
							<?php if( $Grade_Section_Fence > 0 ){ ?>
                            <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+<?=$Grade_Section_Fence;?></span>
							<?php } ?>
                        </h4>
                    </div><!-- col-md-2 -->
                    <div class="col-md-8 text-center no-padding">
					<h3 class="className"><?=$Grade_name;?>-<?=$Sectoion_name;?> &nbsp; <a href="#"><img src="<?php echo base_url()?>components/student_listing/images/stats-.png" width="20px" data-toggle="tooltip" data-placement="top" data-original-title="Class details" data-pin-nopin="true" /></a></h3>
                    </div><!-- -->
                    <div class="col-md-2 no-padding" style="border-left:1px solid #c34a4a;">
                    	<h4 class="text-center todayAttScore" data-toggle="tooltip" data-placement="top" data-original-title="Today's score" data-pin-nopin="true">
                        	<?=$Today_T;?>
                        </h4>
                    </div><!-- col-md-2 -->
                </div><!-- yellowBGHead This will appear on scroll -->
				
				
            <div class="yellowBGHead a LeftListing_headerSection paddingBottom0">
            
                <div class="col-md-2 no-padding" style="border-right:1px solid #c34a4a;">
                    <h4 class="text-center totalAtt">
                    
                        <span data-toggle="tooltip" data-placement="top" data-original-title="Att. Total" data-pin-nopin="true">
                        <?php echo $GS_Total;?></span>
                        <?php if( $Grade_Section_Fence > 0 ){ ?>
                        <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+<?=$Grade_Section_Fence;?></span>
                        <?php } ?>	
                    </h4>
                    <h4 class="text-center girlAtt" data-toggle="tooltip" data-placement="top" data-original-title="Att.Today Girls" data-pin-nopin="true">
                        <?php
                        echo $header_count["Today_Girls"];
                        ?>
                        <?php if( $Total_Girls_Fence > 0 ){ ?>
                        <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+<?=$Total_Girls_Fence;?></span>
                        <?php } ?>
                    </h4>
                    <h4 class="text-center boyAtt">
                        <span  data-toggle="tooltip" data-placement="top" data-original-title="Att.Today Boys" data-pin-nopin="true"><?php
                        echo $header_count["Today_Boys"];
                        ?></span>
                        <?php if( $Total_Boys_Fence > 0 ){ ?>
                        <span class="grayish" data-toggle="tooltip" data-placement="top" data-original-title="Fence" data-pin-nopin="true">+<?=$Total_Boys_Fence;?></span>
                        <?php } ?>
                    </h4>
                </div><!-- col-md-2 -->
                
                <div class="col-md-8 text-center no-padding">
                    <h3 class="className"><?=$Grade_name;?>-<?=$Sectoion_name;?> &nbsp; <a href="#"><img src="<?php echo base_url()?>components/student_listing/images/stats-.png" width="20px" data-toggle="tooltip" data-placement="top" data-original-title="Class details" data-pin-nopin="true" /></a></h3>
                    <div class="col-md-6 no-padding text-center">
                        <img src="<?php echo base_url()?>assets/photos/hcm/150x150/staff/<?=$grade_teacher[0]["Image_ID"];?>.png" width="45" class="marginRight10 maringBottom0 " style="border:1px solid #888;" /><br />
                        <h6><?=$grade_teacher[0]["Teacher_Name"];?></h6>
                    </div>
                    <?php if( !empty($grade_teacher[1]["Teacher_Name"] ) ) { ?>
                    <div class="col-md-6 no-padding text-center">
                        <img src="<?php echo base_url()?>assets/photos/hcm/150x150/staff/<?=$grade_teacher[1]["Image_ID"];?>.png" width="45" class="marginRight10 maringBottom0 " style="border:1px solid #888;" /><br />
                       <h6><?=$grade_teacher[1]["Teacher_Name"];?></h6>
                    </div>
                    <?php } ?>
                </div><!-- -->
                
                <div class="col-md-2 no-padding" style="border-left:1px solid #c34a4a;">
                    <h4 class="text-center todayAttScore" data-toggle="tooltip" data-placement="top" data-original-title="Today's score" data-pin-nopin="true">
                        <?=$Today_T;?>
                    </h4>
                    <h4 class="text-center TendayAttScore a" data-toggle="tooltip" data-placement="top" data-original-title="10 day score" data-pin-nopin="true">
                        <?=$Ten_Days_Students;?>
                    </h4>
                    <h4 class="text-center SixtydayAttScore a" data-toggle="tooltip" data-placement="top" data-original-title="60 day score" data-pin-nopin="true">
                        <?=$Sixty_Days;?>
                    </h4>
                </div><!-- col-md-2 -->
                
                
            </div><!-- LeftListing_headerSection -->
				
			<?php } ?>
				
				
				<input type="hidden" name="hidden_updation_Badge" id="hidden_updation_Badge" value="0" />
				
                <div class="LeftListing_ContentSection">
				
				
				
				<input type="hidden" name="hidden_grade_id" id="hidden_grade_id" value="<?=$Grade_id;?>" />
				<input type="hidden" name="hidden_section_id" id="hidden_section_id" value="<?=$Section_id;?>" />
				<input type="hidden" name="hidden_Current_Academic" id="hidden_Current_Academic" value="<?=$Current_Academic;?>" />
				<input type="hidden" name="hidden_Current_Term" id="hidden_Current_Term" value="<?=$Current_Term;?>" />
				
				 <div id="grade_section_list_table">
	            	<table width="100%" border="1" id="EntitityListing" class="table table-striped table-bordered table-hover">
	                  <thead>
	                      <tr>
	                        <th class="text-center no-sort" width="">SR</th>
	                        <th class="text-center no-sort" width="">Class</th>
	                        <th class="" width="">Name</th>
                            <th class="text-center no-sort" width="">Att.</th>
	                        <th class="no-sort text-center" width="">Profiles</th>
                            <th class="no-sort text-center" width="">Badges <a style="" href="#" id="BadgeAlloc">+</a> </th>
	                        <th class="no-sort text-center" width="">
								<img src="<?php echo base_url()?>components/student_listing/images/redBell.jpg" width="15" />
							</th>
	                      </tr>
                      </thead><!-- thead -->
					  <tbody><?=$table_view;?></tbody>
	                </table><!-- ListingTable -->
					
					</div><!-- grade_section_list_table -->
	            
				</div><!-- LeftListing_ContentSection -->
				
				
	        </div><!-- .StudentListing -->
	    </div><!-- col-md-3 -->
		
		
		
	    <div class="col-md-7 paddingRight0">
		<div style="display:none;" id="ajaxloader2">  <p> <br /> <br /> <br /> <br /> Please Wait .. </p></div>
		<div id="sectionRight">
		</div><!-- col-md-9 -->
		</div><!-- col-md-9 -->
		
		
	</div><!-- row -->
</div><!-- container -->

	<div class="ajaxloader" id="ajaxloader" style="display:none;">  <br /> <br /><br /> Loading... </div>
	<style>
	.ajaxloader{ background-color: silver }
	.ajaxloader{
		position: absolute;
		border:none;
		left:900px;
		top: 250px;
		background-color: transparent;
		text-align: center;
		background-image: url(<?php echo base_url();?>/components/image/ajax-loader2.gif);
		background-position: center center;
		background-repeat: no-repeat;
	}
</style>
<input type="hidden" value="profile" id="active_tab" name="active_tab" />
 

<style>

#ajaxloader2{background-color: silver}
#ajaxloader2{
position: absolute;
border:none;
top: 28%;
left:47%;
z-index:999;
background-color: transparent;
text-align: center;
background-image: url(<?=base_url();?>/components/image/ajax-loader2.gif);
background-position: center center;
background-repeat: no-repeat;
}

</style>