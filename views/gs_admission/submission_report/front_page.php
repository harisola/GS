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
                                        <li><input type="checkbox" value="2" id="N" name="PN" /><label for="N">N</label></li>
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
										<li><input type="checkbox" value="14" name="X" id="XI" /><label for="XI">XI</label></li>
										<li><input type="checkbox" value="15" name="A1" id="A1" /><label for="A1">A1</label></li>
                                    </ul><!-- ul -->
                                </div><!-- multiselect -->
                            </dd><!-- dd -->                          
                        </dl><!-- dl -->
                    </div><!-- col-md-2 -->
					<form action="<?=base_url();?>index.php/gs_admission/submission_report/fliter" method="POST" name="fliter_issuance" id="fliter_issuance">
						<input type="hidden" name="gradeNameValidate" id="gradeNameValidate" value="" />
						
                    <div class="col-md-2">
                    	<span class="filterTitle">From</span>
                    	<input type="text" placeholder="From" id="from_date" name="from_date" />
                    </div><!-- col-md-2 -->
                    <div class="col-md-2">
                    	<span class="filterTitle">To</span>
                    	<input type="text" placeholder="To"  id="to_date" name="to_date" />
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

     <div class="col-md-2" style="width:15%;">
                    	<input type="submit" id="issuance_fliter" name="issuance_fliter" class="greenBTN" value="Apply Filters" style="padding:14px;" />
                    </div><!-- col-md-2 -->
                </div><!-- inner -->
              	</form>
				
<?php

function tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ){
	

	
$html = '<td class="text-center">';
$html .= '<div class="col-md-12 tooltipp">';
$html .= '<strong>';
 
if( ( $SUB_PN_G > 0 ) || ( $SUB_PN_B > 0 ) ){
	$total_sub_pn = ( $SUB_PN_G + $SUB_PN_B ); 
	$grand_total_sub_pn = $total_sub_pn;
}else{
	$total_sub_pn=0;
	$grand_total_sub_pn=0;
}


$html .= $total_sub_pn;
//$html .= $grand_total_sub_pn;

$html .= '</strong> / ';

if( ( $PN_G > 0 ) || ( $PN_B > 0 ) ){
	$total_pn = ( $PN_G + $PN_B ); 
	$grand_total_pn = $total_pn;
}else{  $total_pn=0; $grand_total_pn=0;}
$html .= $total_pn;
//$html .= $grand_total_pn;
$html .= '</div>';
$html .= '<div class="col-md-6 tooltipp girls">';
$html .= '<span class="">G</span><br />';
$html .= '<strong>';
	
		if( $SUB_PN_G > 0 ){
			$total_sub_pn_g =  $SUB_PN_G;
			$grand_total_sub_pn_g = $total_sub_pn_g;
		}else{
			$total_sub_pn_g = 0;
			$grand_total_sub_pn_g=0;
		}
$html .= $total_sub_pn_g;
//$html .= $grand_total_sub_pn_g;

$html .= '</strong> / ';

if( $PN_G > 0 ){
	$total_pn_g =  $PN_G;
	$grand_total_pn_g = $total_pn_g;
}else{
	$total_pn_g=0;
	$grand_total_pn_g=0;
	
}

$html .= $total_pn_g;
//$html .= $grand_total_pn_g;

$html .= '</div>';
$html .= '<div class="col-md-6 boys tooltipp">';
$html .= '<span class="">B</span><br />';
$html .= '<strong>';
	
	
		if( $SUB_PN_B > 0 ){
			$total_sub_pn_b = $SUB_PN_B;
			$grand_total_sub_pn_b = $total_sub_pn_b;
		}else{
			$total_sub_pn_b=0;
			$grand_total_sub_pn_b=0;
		}
	
$html .= $total_sub_pn_b;
//$html .= $grand_total_sub_pn_b;

	
$html .= '</strong> / ';
	
	if( $PN_B > 0 ){
		$total_pn_b = $PN_B; 
		$grand_total_pn_b = $total_pn_b;
	}else{ $total_pn_b=0; $grand_total_pn_b=0;}	
		
$html .= $total_pn_b;
//$html .= $grand_total_pn_b;
		
$html .= '</div>';
$html .= '</td>';



	
$return = array(  
	"html"=>$html,
	"grand_total_sub_pn"=>$grand_total_sub_pn,
	"grand_total_pn"=>$grand_total_pn,
	"grand_total_pn_g" =>$grand_total_pn_g,
	"grand_total_sub_pn_b"=>$grand_total_sub_pn_b,
	"grand_total_pn_b"=>$grand_total_pn_b,
	"grand_total_sub_pn_g" =>$grand_total_sub_pn_g 
	);

return $return;
                           
 } // end function 

function footerTd($grand_total_sub_pn,$grand_total_pn,$grand_total_sub_pn_g,$grand_total_pn_g,$grand_total_sub_pn_b,$grand_total_pn_b){
$html = '<td class="text-center">';
$html .= '<div class="col-md-12 tooltipp">';
$html .= '<strong>'.$grand_total_sub_pn. '</strong> / '.$grand_total_pn;
$html .= '</div>';
$html .= '<div class="col-md-6 tooltipp girls">';

$html .= '<span class="">G</span><br /><strong>'.$grand_total_sub_pn_g.'</strong> / '.$grand_total_pn_g;
$html .= '</div>';
$html .= '<div class="col-md-6 boys tooltipp">';
$html .= '<span class="">B</span><br /><strong>'.$grand_total_sub_pn_b.'</strong> / '.$grand_total_pn_b;
$html .= '</div>';
$html .= '</td>';
$return = array("ht" => $html );
return $return;
}
 
$grand_total_sub_pn =0;
$grand_total_pn =0;
$grand_total_pn_g=0;
$grand_total_sub_pn_b=0;
$grand_total_pn_b=0;
$grand_total_sub_pn_g=0;

$grand_total_sub_n=0;
$grand_total_n=0;
$grand_total_n_g=0;
$grand_total_sub_n_b=0;
$grand_total_n_b=0;
$grand_total_sub_n_g=0;

$grand_total_sub_kg=0;
$grand_total_kg=0;
$grand_total_kg_g=0;
$grand_total_sub_kg_b=0;
$grand_total_kg_b=0;
$grand_total_sub_kg_g=0;


$grand_total_sub_i=0;
$grand_total_i=0;
$grand_total_i_g=0;
$grand_total_sub_i_b=0;
$grand_total_i_b=0;
$grand_total_sub_i_g=0;

$grand_total_sub_ii=0;
$grand_total_ii=0;
$grand_total_ii_g=0;
$grand_total_sub_ii_b=0;
$grand_total_ii_b=0;
$grand_total_sub_ii_g=0;

$grand_total_sub_iii=0;
$grand_total_iii=0;
$grand_total_iii_g=0;
$grand_total_sub_iii_b=0;
$grand_total_iii_b=0;
$grand_total_sub_iii_g=0;

$grand_total_sub_iv=0;
$grand_total_iv=0;
$grand_total_iv_g=0;
$grand_total_sub_iv_b=0;
$grand_total_iv_b=0;
$grand_total_sub_iv_g=0;


$grand_total_sub_v=0;
$grand_total_v=0;
$grand_total_v_g=0;
$grand_total_sub_v_b=0;
$grand_total_v_b=0;
$grand_total_sub_v_g=0;

$grand_total_sub_vi=0;
$grand_total_vi=0;
$grand_total_vi_g=0;
$grand_total_sub_vi_b=0;
$grand_total_vi_b=0;
$grand_total_sub_vi_g=0;


$grand_total_sub_vii=0;
$grand_total_vii=0;
$grand_total_vii_g=0;
$grand_total_sub_vii_b=0;
$grand_total_vii_b=0;
$grand_total_sub_vii_g=0;


$grand_total_sub_viii=0;
$grand_total_viii=0;
$grand_total_viii_g=0;
$grand_total_sub_viii_b=0;
$grand_total_viii_b=0;
$grand_total_sub_viii_g=0;

$grand_total_sub_ix=0;
$grand_total_ix=0;
$grand_total_ix_g=0;
$grand_total_sub_ix_b=0;
$grand_total_ix_b=0;
$grand_total_sub_ix_g=0;


$grand_total_sub_x=0;
$grand_total_x=0;
$grand_total_x_g=0;
$grand_total_sub_x_b=0;
$grand_total_x_b=0;
$grand_total_sub_x_g=0;


$grand_total_sub_xi=0;
$grand_total_xi=0;
$grand_total_xi_g=0;
$grand_total_sub_xi_b=0;
$grand_total_xi_b=0;
$grand_total_sub_xi_g=0;


$grand_total_sub_xii=0;
$grand_total_xii=0;
$grand_total_xii_g=0;
$grand_total_sub_xii_b=0;
$grand_total_xii_b=0;
$grand_total_sub_xii_g=0;


 ?>                
					
               

			  <hr class="RedHR" />
                <div class="inner paddingLeft20 paddingRight20" style="padding:20px !important;" id="paddingRight20">
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
							  <th width="" class="text-center">XI</th>
							  <th width="" class="text-center">A</th>
                              <th width="" class="text-center" style="border-left:2px solid #888;">Total</th>
                          </tr>
                      </thead>
                      <tbody>
						<?php 
							$girls_total =0;
							$boys_total =0;
							$issuanceTotal=0;
							$submissionTotal=0;
							$submissionGirls=0;
							$submissionBoys=0;
							
							$issuanceGirls=0;
						?>
							<?php if( !empty( $submissions ) ){ ?>
							<?php foreach( $submissions as $sb ){ 
							
								$girls_total =0;
						$boys_total =0;
						$issuanceTotal=0;
						$submissionTotal=0;
						$submissionGirls =0;
						$submissionBoys = 0;
							?>
								
							
							 <tr>
                              <td class="text-center"><strong><?=$sb["issuance_date"];?></strong></td>
							  <?php 
							  // PN Grade
							  $SUB_PN_G = $sb["SUB_PN_G"];
							  $SUB_PN_B = $sb["SUB_PN_B"];
							  $PN_G = $sb["PN_G"];
							  $PN_B = $sb["PN_B"];
							  
							  $r =  tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_pn += $r["grand_total_sub_pn"]; // total form submitted
							  $grand_total_pn += $r["grand_total_pn"];  // total form issuance 
							  $grand_total_pn_g += $r["grand_total_pn_g"]; // pn girls total 
							  $grand_total_sub_pn_b += $r["grand_total_sub_pn_b"]; // total pn boys submitted form 
							  $grand_total_pn_b += $r["grand_total_pn_b"]; // total pn boys form issuance
							  $grand_total_sub_pn_g += $r["grand_total_sub_pn_g"]; // total girls submitted form
							  
							  
							  $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  

							 // N grade
							  $SUB_PN_G = $sb["SUB_N_G"];
							  $SUB_PN_B = $sb["SUB_N_B"];
							  $PN_G = $sb["N_G"];
							  $PN_B = $sb["N_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_n += $r["grand_total_sub_pn"];
							  $grand_total_n += $r["grand_total_pn"];
							  $grand_total_n_g += $r["grand_total_pn_g"];
							  $grand_total_sub_n_b += $r["grand_total_sub_pn_b"];
							  $grand_total_n_b += $r["grand_total_pn_b"];
							  $grand_total_sub_n_g += $r["grand_total_sub_pn_g"];
							  
							  $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							   
							   // Grade KG 
							  $SUB_PN_G = $sb["SUB_KG_G"];
							  $SUB_PN_B = $sb["SUB_KG_B"];
							  $PN_G = $sb["KG_G"];
							  $PN_B = $sb["KG_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_kg += $r["grand_total_sub_pn"];
							  $grand_total_kg += $r["grand_total_pn"];
							  $grand_total_kg_g += $r["grand_total_pn_g"];
							  $grand_total_sub_kg_b += $r["grand_total_sub_pn_b"];
							  $grand_total_kg_b += $r["grand_total_pn_b"];
							  $grand_total_sub_kg_g += $r["grand_total_sub_pn_g"];
							  
							  $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  
							  // Grade I 
							  $SUB_PN_G = $sb["SUB_I_G"];
							  $SUB_PN_B = $sb["SUB_I_B"];
							  $PN_G = $sb["I_G"];
							  $PN_B = $sb["I_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_i += $r["grand_total_sub_pn"];
							  $grand_total_i += $r["grand_total_pn"];
							  $grand_total_i_g += $r["grand_total_pn_g"];
							  $grand_total_sub_i_b += $r["grand_total_sub_pn_b"];
							  $grand_total_i_b += $r["grand_total_pn_b"];
							  $grand_total_sub_i_g += $r["grand_total_sub_pn_g"];
							  
							  
							 $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  
							  
							  
							   // Grade II 
							  $SUB_PN_G = $sb["SUB_II_G"];
							  $SUB_PN_B = $sb["SUB_II_B"];
							  $PN_G = $sb["II_G"];
							  $PN_B = $sb["II_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_ii += $r["grand_total_sub_pn"];
							  $grand_total_ii += $r["grand_total_pn"];
							  $grand_total_ii_g += $r["grand_total_pn_g"];
							  $grand_total_sub_ii_b += $r["grand_total_sub_pn_b"];
							  $grand_total_ii_b += $r["grand_total_pn_b"];
							  $grand_total_sub_ii_g += $r["grand_total_sub_pn_g"];
							  
							  
							  
							  $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  
							  
							   // Grade III 
							  $SUB_PN_G = $sb["SUB_III_G"];
							  $SUB_PN_B = $sb["SUB_III_B"];
							  $PN_G = $sb["III_G"];
							  $PN_B = $sb["III_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_iii += $r["grand_total_sub_pn"];
							  $grand_total_iii += $r["grand_total_pn"];
							  $grand_total_iii_g += $r["grand_total_pn_g"];
							  $grand_total_sub_iii_b += $r["grand_total_sub_pn_b"];
							  $grand_total_iii_b += $r["grand_total_pn_b"];
							  $grand_total_sub_iii_g += $r["grand_total_sub_pn_g"];
							  
							  $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							    // Grade Iv
							  $SUB_PN_G = $sb["SUB_IV_G"];
							  $SUB_PN_B = $sb["SUB_IV_B"];
							  $PN_G = $sb["IV_G"];
							  $PN_B = $sb["IV_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_iv += $r["grand_total_sub_pn"];
							  $grand_total_iv += $r["grand_total_pn"];
							  $grand_total_iv_g += $r["grand_total_pn_g"];
							  $grand_total_sub_iv_b += $r["grand_total_sub_pn_b"];
							  $grand_total_iv_b += $r["grand_total_pn_b"];
							  $grand_total_sub_iv_g += $r["grand_total_sub_pn_g"];
							  
							 $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  
							      // Grade V
							  $SUB_PN_G = $sb["SUB_V_G"];
							  $SUB_PN_B = $sb["SUB_V_B"];
							  $PN_G = $sb["V_G"];
							  $PN_B = $sb["V_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_v += $r["grand_total_sub_pn"];
							  $grand_total_v += $r["grand_total_pn"];
							  $grand_total_v_g += $r["grand_total_pn_g"];
							  $grand_total_sub_v_b += $r["grand_total_sub_pn_b"];
							  $grand_total_v_b += $r["grand_total_pn_b"];
							  $grand_total_sub_v_g += $r["grand_total_sub_pn_g"];
							  
							 $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  
							       // Grade VI
							  $SUB_PN_G = $sb["SUB_VI_G"];
							  $SUB_PN_B = $sb["SUB_VI_B"];
							  $PN_G = $sb["VI_G"];
							  $PN_B = $sb["VI_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_vi += $r["grand_total_sub_pn"];
							  $grand_total_vi += $r["grand_total_pn"];
							  $grand_total_vi_g += $r["grand_total_pn_g"];
							  $grand_total_sub_vi_b += $r["grand_total_sub_pn_b"];
							  $grand_total_vi_b += $r["grand_total_pn_b"];
							  $grand_total_sub_vi_g += $r["grand_total_sub_pn_g"];
							  
							  $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  
							  
							  // Grade VII
							  for( $a = 1; $a < 7; $a++ ){
							  $SUB_PN_G = $sb["SUB_VII_G"];
							  $SUB_PN_B = $sb["SUB_VII_B"];
							  $PN_G = $sb["VII_G"];
							  $PN_B = $sb["VII_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_vii += $r["grand_total_sub_pn"];
							  $grand_total_vii += $r["grand_total_pn"];
							  $grand_total_vii_g += $r["grand_total_pn_g"];
							  $grand_total_sub_vii_b += $r["grand_total_sub_pn_b"];
							  $grand_total_vii_b += $r["grand_total_pn_b"];
							  $grand_total_sub_vii_g += $r["grand_total_sub_pn_g"];
							 
							  
							 $girls_total += $r["grand_total_pn_g"];
							  $boys_total  += $r["grand_total_pn_b"];
							  $issuanceTotal += $r["grand_total_pn"];
							  $submissionTotal += $r["grand_total_sub_pn"];
							  $submissionGirls += $r["grand_total_sub_pn_g"];
							  $submissionBoys += $r["grand_total_sub_pn_b"];
							  }
							  
							  /*
							       // Grade VIII
							  $SUB_PN_G = $sb["SUB_VIII_G"];
							  $SUB_PN_B = $sb["SUB_VIII_B"];
							  $PN_G = $sb["VIII_G"];
							  $PN_B = $sb["VIII_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_viii += $r["grand_total_sub_pn"];
							  $grand_total_viii += $r["grand_total_pn"];
							  $grand_total_viii_g += $r["grand_total_pn_g"];
							  $grand_total_sub_viii_b += $r["grand_total_sub_pn_b"];
							  $grand_total_viii_b += $r["grand_total_pn_b"];
							  $grand_total_sub_viii_g += $r["grand_total_sub_pn_g"];
							  $girls_total += $grand_total_viii_g;
							  $boys_total  += $grand_total_viii_b;
							  
							  
							  
							  
							  // Grade IX
							  $SUB_PN_G = $sb["SUB_IX_G"];
							  $SUB_PN_B = $sb["SUB_IX_B"];
							  $PN_G = $sb["IX_G"];
							  $PN_B = $sb["IX_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_ix += $r["grand_total_sub_pn"];
							  $grand_total_ix += $r["grand_total_pn"];
							  $grand_total_ix_g += $r["grand_total_pn_g"];
							  $grand_total_sub_ix_b += $r["grand_total_sub_pn_b"];
							  $grand_total_ix_b += $r["grand_total_pn_b"];
							  $grand_total_sub_ix_g += $r["grand_total_sub_pn_g"];
							  $girls_total += $grand_total_ix_g;
							  $boys_total  += $grand_total_ix_b;
							  
							  
							  
							  
							   // Grade X
							  $SUB_PN_G = $sb["SUB_X_G"];
							  $SUB_PN_B = $sb["SUB_X_B"];
							  $PN_G = $sb["X_G"];
							  $PN_B = $sb["X_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_x += $r["grand_total_sub_pn"];
							  $grand_total_x += $r["grand_total_pn"];
							  $grand_total_x_g += $r["grand_total_pn_g"];
							  $grand_total_sub_x_b += $r["grand_total_sub_pn_b"];
							  $grand_total_x_b += $r["grand_total_pn_b"];
							  $grand_total_sub_x_g += $r["grand_total_sub_pn_g"];
							  $girls_total += $grand_total_x_g;
							  $boys_total  += $grand_total_x_b;
							   
							   
							   
							   
							  // Grade XI
							  $SUB_PN_G = $sb["SUB_XI_G"];
							  $SUB_PN_B = $sb["SUB_XI_B"];
							  $PN_G = $sb["XI_G"];
							  $PN_B = $sb["XI_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_xi += $r["grand_total_sub_pn"];
							  $grand_total_xi += $r["grand_total_pn"];
							  $grand_total_xi_g += $r["grand_total_pn_g"];
							  $grand_total_sub_xi_b += $r["grand_total_sub_pn_b"];
							  $grand_total_xi_b += $r["grand_total_pn_b"];
							  $grand_total_sub_xi_g += $r["grand_total_sub_pn_g"];
							  $girls_total += $grand_total_xi_g;
							  $boys_total  += $grand_total_xi_b;
							  
							  
							  
							  // Grade XII
							  $SUB_PN_G = $sb["SUB_XII_G"];
							  $SUB_PN_B = $sb["SUB_XII_B"];
							  $PN_G = $sb["XII_G"];
							  $PN_B = $sb["XII_B"];
							  $r = tdRow( $SUB_PN_G,$SUB_PN_B,$PN_G,$PN_B ); 
							  echo $r["html"];
							  $grand_total_sub_xii += $r["grand_total_sub_pn"];
							  $grand_total_xii += $r["grand_total_pn"];
							  $grand_total_xii_g += $r["grand_total_pn_g"];
							  $grand_total_sub_xii_b += $r["grand_total_sub_pn_b"];
							  $grand_total_xii_b += $r["grand_total_pn_b"];
							  $grand_total_sub_xii_g += $r["grand_total_sub_pn_g"];
							  $girls_total += $grand_total_xii_g;
							  $boys_total  += $grand_total_xii_b;*/
							  ?>
							      <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-12 tooltipp">
                                	<strong><?=$submissionTotal;?></strong>/<?=$issuanceTotal;?>
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$submissionGirls;?></strong>/<?=$girls_total;?>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong><?=$submissionBoys;?></strong>/<?=$boys_total;?>
                                </div>
                              </td>
                          </tr>
							
					<?php 
					
                          
					?>
							<?php } //end foreach	?>
					  <?php } ?>
					  
					  
                     </tbody> 
					  



<?php

$grandtotal_sub_pn=0;
$grandtotal_pn=0;
$grandtotal_sub_pn_g=0;
$grandtotal_pn_g=0;
$grandtotal_sub_pn_b=0;
$grandtotal_pn_b=0;
?>

                      <tfoot>
                      	<tr class="footerTR">
					  <td class="text-center"><strong>Grand Total</td>
					  <?php 
$grandtotal_sub_pn += $grand_total_sub_pn;
$grandtotal_pn += $grand_total_pn;
$grandtotal_sub_pn_g += $grand_total_sub_pn_g;
$grandtotal_pn_g += $grand_total_pn_g;
$grandtotal_sub_pn_b +=$grand_total_sub_pn_b;
$grandtotal_pn_b += $grand_total_pn_b;

					 $ht= footerTd($grand_total_sub_pn,$grand_total_pn,$grand_total_sub_pn_g,$grand_total_pn_g,$grand_total_sub_pn_b,$grand_total_pn_b);
					 echo $ht["ht"];
					  ?>
		  
				  <?php 
				  
				  $grandtotal_sub_pn += $grand_total_sub_n;
$grandtotal_pn += $grand_total_n;
$grandtotal_sub_pn_g += $grand_total_sub_n_g;
$grandtotal_pn_g += $grand_total_n_g;
$grandtotal_sub_pn_b +=$grand_total_sub_n_b;
$grandtotal_pn_b += $grand_total_n_b;


					  $ht= footerTd($grand_total_sub_n,$grand_total_n,$grand_total_sub_n_g,$grand_total_n_g,$grand_total_sub_n_b,$grand_total_n_b);
					   echo $ht["ht"];
					  ?>	
					  
					  <?php 
					  
					  $grandtotal_sub_pn += $grand_total_sub_kg;
$grandtotal_pn += $grand_total_kg;
$grandtotal_sub_pn_g += $grand_total_sub_kg_g;
$grandtotal_pn_g += $grand_total_kg_g;
$grandtotal_sub_pn_b +=$grand_total_sub_kg_b;
$grandtotal_pn_b += $grand_total_kg_b;
					  $ht= footerTd($grand_total_sub_kg,$grand_total_kg,$grand_total_sub_kg_g,$grand_total_kg_g,$grand_total_sub_kg_b,$grand_total_kg_b);
					   echo $ht["ht"];
					  ?>

<?php 

$grandtotal_sub_pn += $grand_total_sub_i;
$grandtotal_pn += $grand_total_i;
$grandtotal_sub_pn_g += $grand_total_sub_i_g;
$grandtotal_pn_g += $grand_total_i_g;
$grandtotal_sub_pn_b +=$grand_total_sub_i_b;
$grandtotal_pn_b += $grand_total_i_b;

					 $ht= footerTd($grand_total_sub_i,$grand_total_i,$grand_total_sub_i_g,$grand_total_i_g,$grand_total_sub_i_b,$grand_total_i_b);
					  echo $ht["ht"];
					  
					  
					  $grandtotal_sub_pn += $grand_total_sub_ii;
$grandtotal_pn += $grand_total_ii;
$grandtotal_sub_pn_g += $grand_total_sub_ii_g;
$grandtotal_pn_g += $grand_total_ii_g;
$grandtotal_sub_pn_b +=$grand_total_sub_ii_b;
$grandtotal_pn_b += $grand_total_ii_b;

					$ht= footerTd($grand_total_sub_ii,$grand_total_ii,$grand_total_sub_ii_g,$grand_total_ii_g,$grand_total_sub_ii_b,$grand_total_ii_b);
					  echo $ht["ht"];
					  
					  
					  $grandtotal_sub_pn += $grand_total_sub_iii;
$grandtotal_pn += $grand_total_iii;
$grandtotal_sub_pn_g += $grand_total_sub_iii_g;
$grandtotal_pn_g += $grand_total_iii_g;
$grandtotal_sub_pn_b +=$grand_total_sub_iii_b;
$grandtotal_pn_b += $grand_total_iii_b;

					$ht= footerTd($grand_total_sub_iii,$grand_total_iii,$grand_total_sub_iii_g,$grand_total_iii_g,$grand_total_sub_iii_b,$grand_total_iii_b);
					echo $ht["ht"];
					
					
					
					$grandtotal_sub_pn += $grand_total_sub_iv;
$grandtotal_pn += $grand_total_iv;
$grandtotal_sub_pn_g += $grand_total_sub_iv_g;
$grandtotal_pn_g += $grand_total_iv_g;
$grandtotal_sub_pn_b +=$grand_total_sub_iv_b;
$grandtotal_pn_b += $grand_total_iv_b;

					$ht= footerTd($grand_total_sub_iv,$grand_total_iv,$grand_total_sub_iv_g,$grand_total_iv_g,$grand_total_sub_iv_b,$grand_total_iv_b);
					echo $ht["ht"];
					
					
					
					$grandtotal_sub_pn += $grand_total_sub_v;
$grandtotal_pn += $grand_total_v;
$grandtotal_sub_pn_g += $grand_total_sub_v_g;
$grandtotal_pn_g += $grand_total_v_g;
$grandtotal_sub_pn_b +=$grand_total_sub_v_b;
$grandtotal_pn_b += $grand_total_v_b;

					$ht= footerTd($grand_total_sub_v,$grand_total_v,$grand_total_sub_v_g,$grand_total_v_g,$grand_total_sub_v_b,$grand_total_v_b);
					echo $ht["ht"];
					
					
					
					$grandtotal_sub_pn += $grand_total_sub_vi;
$grandtotal_pn += $grand_total_vi;
$grandtotal_sub_pn_g += $grand_total_sub_vi_g;
$grandtotal_pn_g += $grand_total_vi_g;
$grandtotal_sub_pn_b +=$grand_total_sub_vi_b;
$grandtotal_pn_b += $grand_total_vi_b;

					$ht= footerTd($grand_total_sub_vi,$grand_total_vi,$grand_total_sub_vi_g,$grand_total_vi_g,$grand_total_sub_vi_b,$grand_total_vi_b);
					echo $ht["ht"];
					
					
					for( $a=1; $a<7; $a++ ){
						$grandtotal_sub_pn += $grand_total_sub_vii;
$grandtotal_pn += $grand_total_vii;
$grandtotal_sub_pn_g += $grand_total_sub_vii_g;
$grandtotal_pn_g += $grand_total_vii_g;
$grandtotal_sub_pn_b +=$grand_total_sub_vii_b;
$grandtotal_pn_b += $grand_total_vii_b;

					$ht= footerTd($grand_total_sub_vii,$grand_total_vii,$grand_total_sub_vii_g,$grand_total_vii_g,$grand_total_sub_vii_b,$grand_total_vii_b);
					echo $ht["ht"];
					}
					
					
					
					/*$ht= footerTd($grand_total_sub_viii,$grand_total_viii,$grand_total_sub_viii_g,$grand_total_viii_g,$grand_total_sub_viii_b,$grand_total_viii_b);
					echo $ht["ht"];
					
					
					
					$ht= footerTd($grand_total_sub_ix,$grand_total_ix,$grand_total_sub_ix_g,$grand_total_ix_g,$grand_total_sub_ix_b,$grand_total_ix_b);
					echo $ht["ht"];
					
					
					
					$ht= footerTd($grand_total_sub_x,$grand_total_x,$grand_total_sub_x_g,$grand_total_x_g,$grand_total_sub_x_b,$grand_total_x_b);
					echo $ht["ht"];
					
					
					
					$ht= footerTd($grand_total_sub_xi,$grand_total_xi,$grand_total_sub_xi_g,$grand_total_xi_g,$grand_total_sub_xi_b,$grand_total_xi_b);
					echo $ht["ht"];
					
					
					
					$ht= footerTd($grand_total_sub_xii,$grand_total_xii,$grand_total_sub_xii_g,$grand_total_xii_g,$grand_total_sub_xii_b,$grand_total_xii_b);
					echo $ht["ht"]; */
					  ?>
					  
							



							
                             <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-12 tooltipp">
                                	<strong><?=$grandtotal_sub_pn;?></strong>/<?=$grandtotal_pn;?>
                                </div><!-- col-md-12 -->
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$grandtotal_sub_pn_g;?></strong>/<?=$grandtotal_pn_g;?>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br /><strong><?=$grandtotal_sub_pn_b;?></strong>/<?=$grandtotal_pn_b;?>
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

