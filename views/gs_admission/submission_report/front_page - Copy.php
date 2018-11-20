<?php //var_dump( $submissions ); ?>
<div class="container" id="BatchListing">
    <!-- Two column layout Start -->
	<div class="row">
        <div class="col-md-12 BatchListing">
        	<div class="MaroonBorderBox">
        		<h3>Submission Report</h3>
                <div class="inner" style="padding:20px !important;">
                	<div class="col-md-2">
                    	<span class="filterTitle">Select Grade</span>
                    	<dl class="dropdown">
                            <dt>
                            	<a href="#"><span class="hida">Select</span> <p class="multiSel" style="display:;"></p></a>
                            </dt><!-- dt -->
                            <dd>
                                <div class="mutliSelect">
                                    <ul>
                                        <li><input type="checkbox" value="All" name="All" id="All"/><label for="All">All Grades</label></li>
                                        <li><input type="checkbox" value="1" name="PN" id="PN" /><label for="PN">PN</label></li>
                                        <li><input type="checkbox" value="2" id="N" name="N" /><label for="N">N</label></li>
                                        <li><input type="checkbox" value="3" name="KG" id="KG" /><label for="KG">KG</label></li>
                                        <li><input type="checkbox" value="4" name="I" id="I" /><label for="I">I</label></li>
                                        <li><input type="checkbox" value="5" name="II" id="II" /><label for="II">II</label></li>
                                        <li><input type="checkbox" value="6" name="III" id="III" /><label for="III">III</label></li>
                                        <li><input type="checkbox" value="7" name="IV" id="IV" /><label for="IV">IV</label></li>
                                        <li><input type="checkbox" value="8" name="V" id="V" /><label for="v">V</label></li>
                                        <li><input type="checkbox" value="9" name="VI" id="VI" /><label for="VI">VI</label></li>
                                        <li><input type="checkbox" value="10" name="VII" id="VII" /><label for="VII">VII</label></li>
                                        <li><input type="checkbox" value="11" name="VIII" id="VIII" /><label for="VIII">VIII</label></li>
                                        <li><input type="checkbox" value="12" name="IX" id="IX" /><label for="IX">IX</label></li>
                                        <li><input type="checkbox" value="13" name="X" id="X" /><label for="X">X</label></li>
										<li><input type="checkbox" value="14" name="XI" id="XI" /><label for="X">XI</label></li>
										<li><input type="checkbox" value="15" name="A1" id="A1" /><label for="A1">A1</label></li>
                                    </ul><!-- ul -->
                                </div><!-- multiselect -->
                            </dd><!-- dd -->                          
                        </dl><!-- dl -->
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">From</span>
                    	<input type="date" placeholder="From" />
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">To</span>
                    	<input type="date" placeholder="To" />
                    </div><!-- col-md-2 -->
<style>
.tooltipp {
    position: relative;
    display: inline-block;
}

.tooltipp .tooltiptext {
    visibility: hidden;
    width: 170px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 1s;
}

.tooltipp .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltipp:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
.footerTR td {
	border-top:2px solid #888 !important;
	border-bottom:2px solid #888 !important;	
}
#AdmissionFormListingg thead tr th {
	border-top:2px solid #888;
	border-bottom:2px solid #888;	
}
#AdmissionFormListingg tr td:first-child,
#AdmissionFormListingg tr th:first-child {
	border-right:2px solid #888;	
}
</style>    

<?php
global $grand_total_sub_pn;
global $grand_total_pn;
global $grand_total_pn_g;
global $grand_total_sub_pn_b;
global $grand_total_pn_b;
global $grand_total_sub_pn_g;

function tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ){
	
global $grand_total_sub_pn;
global $grand_total_pn;
global $grand_total_pn_g;
global $grand_total_sub_pn_b;
global $grand_total_pn_b;
global $grand_total_sub_pn_g;
	
$html ='<td class="text-center">';
$html .= '<div class="col-md-12 tooltipp">';
$html .= '<strong>';
 
if( ( $SUB_PN_G > 0 ) || ( $SUB_PN_B > 0 ) ){
	echo $total_sub_pn = ( $SUB_PN_G + $SUB_PN_B ); 
	$grand_total_sub_pn += $total_sub_pn;
}else{
	
}
	

</strong> / 
<?php 
if( ( $PN_G > 0 ) || ( $PN_B > 0 ) ){
	echo $total_pn = ( $PN_G + $PN_B ); 
	$grand_total_pn += $total_pn;
}else{  }
?>
</div><!-- col-md-12 -->
<div class="col-md-6 tooltipp girls">
<span class="">G</span><br />
<strong>
	<?php 
		if( $SUB_PN_G > 0 ){
			$total_sub_pn_g =  $SUB_PN_G;
			$grand_total_sub_pn_g += $total_sub_pn_g;
		}else{
			echo 0;
		}
	?>
</strong> / 
<?php 
if( $PN_G > 0 ){
	echo $total_pn_g =  $PN_G;
	$grand_total_pn_g += $total_pn_g;
}else{
	echo 0;
	
}
?>
</div>
<div class="col-md-6 boys tooltipp">
<span class="">B</span><br />
<strong>
	
	<?php 
		if( $SUB_PN_B > 0 ){
			echo $total_sub_pn_b = $SUB_PN_B;
			$grand_total_sub_pn_b += $total_sub_pn_b;
		}else{
			echo 0;
			
		}
	?>
</strong> / 
	<?php 
	if( $PN_B > 0 ){
		echo $total_pn_b = $PN_B; 
		$grand_total_pn_b += $total_pn_b;
	}else{ echo 0; }	
		?>
</div>
</td>
							  
                           
<?php } ?>                
					
                    <div class="col-md-2" style="width:15%;">
                    	<input type="submit" class="greenBTN" value="Apply Filters" style="padding:14px;" />
                    </div><!-- col-md-2 -->
                </div><!-- inner -->
                <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;">
                    <table id="AdmissionFormListingg" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
                      <thead> 
                          <tr> 
                              <th width="" class="text-center"></th> 
                              <th width="" class="text-center">PN</th> 
                              <th width="" class="text-center">N</th> 
                              <th width="" class="text-center">KG</th>
                              <th width="" class="text-center">I</th>
                              <th width="" class="text-center">II</th>
                              <th width="" class="text-center">III</th>
                              <th width="" class="text-center">IV</th>
                              <th width="" class="text-center">V</th>
                              <th width="" class="text-center">VI</th>
                              <th width="" class="text-center">VII</th>
                              <th width="" class="text-center">VIII</th>
                              <th width="" class="text-center">IX</th>
                              <th width="" class="text-center">X</th>
                              <th width="" class="text-center" style="border-left:2px solid #888;">Total</th>
                          </tr>
                      </thead>
                      <tbody>
					 
							
							<?php if( !empty( $submissions ) ){ ?>
							<?php foreach( $submissions as $sb ){ ?>
								
							
							 <tr>
                              <td class="text-center"><strong><?=$sb["issuance_date"];?></strong></td>
							  <?php 
							  $SUB_PN_G = $sb["SUB_PN_G"];
							  $SUB_PN_B = $sb["SUB_PN_B"];
							  $PN_G = $sb["PN_G"];
							  $PN_B = $sb["PN_B"];
							  echo tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  ?>
							  
							    <?php 
							  $SUB_PN_G = $sb["SUB_N_G"];
							  $SUB_PN_B = $sb["SUB_N_B"];
							  $PN_G = $sb["N_G"];
							  $PN_B = $sb["N_B"];
							  echo tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  ?>
                          
							  
                          </tr>
							
					
							<?php } //end foreach	?>
					  <?php } ?>
                     </tbody> 
					  





                      <tfoot>
                      	<tr class="footerTR">
                              <td class="text-center"><strong>Sat 7 Jan</strong> to <strong>Mon 9 Jan</strong></td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong><?=$grand_total_sub_pn;?></strong>/<?=$grand_total_pn;?>
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$grand_total_sub_pn_g;?></strong>/ <?=$grand_total_pn_g;?>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong><?=$grand_total_sub_pn_b;?></strong>/<?=$grand_total_pn_b;?>
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                              <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-12 tooltipp">
                                	<strong>50</strong>/96
                                    <span class="tooltiptext">Forms Submitted: <strong>54% (50)</strong><br />North Campus: <strong>20% (40)</strong></span> 
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>25</strong>/35
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong>25</strong>/61
                                	<span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                              </td>
                          </tr>
                      </tfoot>
                    
					</table><!-- StaffListing -->
                </div><!-- inner -->
            </div><!-- MaroonBorderBox -->
        </div><!-- col-md-12 -->
    </div><!-- row -->
    <!-- Two column layout END -->
</div><!-- container -->
<style>
.dropdown dd,
.dropdown dt {
  margin: 0px;
  padding: 0px;
}
#BatchListing td .boys {
	background:#c9f0f9;
	padding:5px 0;
}
#BatchListing td .girls {
	background:#ffe1ec	;
	padding:5px 0;
}
#BatchListing td {
    vertical-align: middle !important;
    padding: 0;
}
.dropdown ul {
  margin: -1px 0 0 0;
}

.dropdown dd {
  position: relative;
}

.dropdown a,
.dropdown a:visited {
  color: #888;
  text-decoration: none;
  outline: none;
  font-size: 14px;
}

.dropdown dt a {
      background-color: #ffffff;
    display: block;
    padding: 12px 20px 12px 10px;
    min-height: 18px;
    line-height: 9px;
    overflow: hidden;
    border: 1px solid #a9a9a9;
    font-weight: normal;
}

.dropdown dt a span,
.multiSel span {
  cursor: pointer;
  display: inline-block;
  padding: 0 3px 2px 0;
}

.dropdown dd ul {
    background-color: #fff;
    border: 1px solid #a9a9a9;
    color: #000;
    display: none;
    left: 0px;
    padding: 2px 15px 2px 5px;
    position: absolute;
    top: 0px;
    width: 100%;
    list-style: none;
    height: 120px;
    overflow: auto;
	z-index:9999;
}

.dropdown span.value {
  display: none;
}

.dropdown dd ul li a {
  padding: 5px;
  display: block;
}

.dropdown dd ul li a:hover {
  background-color: #fff;
}
.multiSel {
	margin:0 !important;	
}
</style>

