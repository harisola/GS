<?php //var_dump( $queryResult );

  
					  $grandTotalGirls=0;
					  $grandTotalBoye=0;
					  
					  $grandTotalGirlsPN=0;
					  $grandTotalBoysPN=0;
					  
					  $grandTotalGirlsN=0;
					  $grandTotalBoysN=0;
					  
					  
					  $grandTotalGirlskg=0;
					  $grandTotalBoyskg=0;
					  
					  
					  $grandTotalGirlsi=0;
					  $grandTotalBoysi=0;
					  
					  
					  $grandTotalGirlsii=0;
					  $grandTotalBoysii=0;
					  
					  
					  $grandTotalGirlsiii=0;
					  $grandTotalBoysiii=0;
					  
					  
					  $grandTotalGirlsiv=0;
					  $grandTotalBoysiv=0;
					  
					  $grandTotalGirlsv=0;
					  $grandTotalBoysv=0;
					  
					  
					  $grandTotalGirlsvi=0;
					  $grandTotalBoysvi=0;
					  
					  
					  $grandTotalGirlsvii=0;
					  $grandTotalBoysvii=0;
					  
					  
					  $grandTotalGirlsviii=0;
					  $grandTotalBoysviii=0;
					  
					  
					  $grandTotalGirlsix=0;
					  $grandTotalBoysix=0;
					  
					  
					  $grandTotalGirlsx=0;
					  $grandTotalBoysx=0;
					  
					  
					  $grandTotalGirlsxi=0;
					  $grandTotalBoysxi=0;
					  
					  
					  $grandTotalGirlsxii=0;
					  $grandTotalBoysxii=0;
					  
					  $TotalGirls = 0;
					  $TotalBoye = 0;

 ?>
<a href="<?php echo base_url(); ?>index.php/gs_admission/issuance_report">Back</a>
<table id="data_table2" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%"> 
<thead> 
  <tr> 
	  <th class="text-center"></th> 
			<?php 
			$check = false;
			$check2 = true;
			$active_pn=0;
			$active_n=0;
			$active_kg=0;
			$active_i=0;
			$active_ii=0;
			$active_iii=0;
			$active_iv=0;
			$active_v=0;
			$active_vi=0; 
			$active_vii=0; 
			$active_viii=0; 
			$active_ix=0; 
			$active_x=0;
			$active_xi=0;
			$active_xii=0;

			foreach( $queryResult['fields'] as $field ){
			if( $check ){
			
$th = explode("_", $field );
$co = $th[0];
if( $co == "PN"){ $active_pn=1; } //else{ $active_pn=0; }
if( $co == "N"){ $active_n=1; } //else{ $active_n=0; }
if( $co == "KG"){ $active_kg=1; } //else{ $active_kg=0; }
if( $co == "I"){ $active_i=1; } //else{ $active_i=0; }
if( $co == "II"){ $active_ii=1; } //else{ $active_ii=0; }
if( $co == "III"){ $active_iii=1; }//else{ $active_iii=0; }
if( $co == "IV"){ $active_iv=1; }//else{ $active_iv=0; }
if( $co == "V"){ $active_v=1; }//else{ $active_v=0; }
if( $co == "VI"){ $active_vi=1; }//else{ $active_vi=0; }
if( $co == "VII"){ $active_vii=1; }//else{ $active_vii=0; }
if( $co == "VIII"){ $active_viii=1; }//else{ $active_viii=0; }
if( $co == "IX"){ $active_ix=1; }//else{ $active_ix=0; }
if( $co == "X"){ $active_x=1; }//else{ $active_x=0; }
if( $co == "XI"){ $active_xi=1; }//else{ $active_xi=0; }
if( $co == "A1"){ $active_xii=1; }//else{ $active_xii=0; }
			
			if( $check2  ){
				
			?>
			<th class="text-center"><?=$co;?></th> 
            <?php
			$check2 = false;
			
		
			
			}else{
			$check2 = true;
			}
			}else{
			$check= true;
			}

			} ?>
	  <th class="text-center" style="border-left:2px solid #888;">Total</th>
  </tr>
</thead>
<tbody> 

<?php 
$grandTotalGirls=0;
$grandTotalBoye=0;
if( !empty( $queryResult["row"] ) ){ ?>
  <?php foreach( $queryResult["row"] as $ir ){  
	$countGirls=0;
	$countBoy= 0; 
	
	
	?>
    <tr>
							   
		<td class="text-center"> <strong> <?=$ir["issuance_date"];?></strong></td>
	     <?php if( isset( $ir["PN_G"] ) ){ ?>
	<td class="text-center">
		<div class="col-md-6 tooltipp girls">
			<span class="">G</span><br /><strong>
			<?php if( (int)$ir["PN_G"] > 0 ){
				echo $ir["PN_G"];
				$countGirls += (int)$ir["PN_G"];
				 $grandTotalGirlsPN += (int)$ir["PN_G"];
			}else{
				echo 0;
			} ?>
			</strong>
		
		</div>
		<div class="col-md-6 boys tooltipp">
			<span class="">B</span><br />
			<strong><?php
			if( (int)$ir["PN_B"] > 0 ){
				echo $ir["PN_B"];
				$countBoy += $ir["PN_B"];
				 $grandTotalBoysPN += (int)$ir["PN_B"];
			}else{
				echo 0;
			} ?></strong>
		</div>
	  </td>
	  
	  <?php } ?>
	    <?php if( isset( $ir["N_G"] ) ){ ?>
			   <td class="text-center">
				<div class="col-md-6 tooltipp girls">
					<span class="">G</span><br /><strong><?php 
					if( (int)$ir["N_G"] > 0){
						echo $ir["N_G"];
						$countGirls += (int)$ir["N_G"];
						$grandTotalGirlsN += (int)$ir["N_G"];
					}else{
						echo 0;
					} ?></strong>
					
				</div>
				<div class="col-md-6 boys tooltipp">
					<span class="">B</span><br />
					<strong><?php if( (int)$ir["N_B"] > 0){ echo $ir["N_B"];
					$countBoy += $ir["N_B"];
					$grandTotalBoysN += $ir["N_B"];
					}else{ echo 0; } ?></strong>
				
				</div>
			  </td>
		<?php } ?>
	  
	  <?php if( isset( $ir["KG_G"] ) ){ ?>
		  
	  
	    <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?php if( (int)$ir["KG_G"] > 0){ echo $ir["KG_G"]; 
									$countGirls += (int)$ir["KG_G"];
									$grandTotalGirlskg += (int)$ir["KG_G"];
									}else{ echo 0; } ?></strong>
                                    <span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
									<strong><?php if( (int)$ir["KG_B"] > 0){
									echo $ir["KG_B"]; $countBoy += $ir["KG_B"];
									$grandTotalBoyskg += $ir["KG_B"]; 
									}else{ echo 0; } ?></strong>
                                	
                                </div>
                              </td>
							  
	  <?php } ?>	

<?php if( isset( $ir["I_G"] ) ){ ?>

 <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<strong><?php if( (int)$ir["I_G"] > 0){ echo $ir["I_G"]; 
									$countGirls += (int)$ir["I_G"];
									$grandTotalGirlsi += (int)$ir["I_G"];
									 }else{ echo 0; } ?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                	<strong><?php if( (int)$ir["I_B"] > 0){
									echo $ir["I_B"]; $countBoy += $ir["I_B"];
									$grandTotalBoysi += $ir["I_B"]; 
									}
									else{ echo 0; } ?></strong>
                                	
                                </div>
                              </td>
							   <?php } ?>	
							  
							  <?php if( isset( $ir["II_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?php if( (int)$ir["II_G"] > 0){ echo $ir["II_G"];
									$countGirls += (int)$ir["II_G"];
									$grandTotalGirlsii += (int)$ir["II_G"];
									}else{ echo 0; } ?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["II_B"] > 0){
									echo $ir["II_B"]; $countBoy += $ir["II_B"];
									$grandTotalBoysii += $ir["II_B"]; 									
									}
									else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["III_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong>
									<?php if( (int)$ir["III_G"] > 0){ echo $ir["III_G"]; 
										  $countGirls += (int)$ir["III_G"];
										  $grandTotalGirlsiii += (int)$ir["III_G"];
									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["III_B"] > 0){
										echo $ir["III_B"]; $countBoy += $ir["III_B"];
										$grandTotalBoysiii += $ir["III_B"];
										}
										else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["IV_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["IV_G"] > 0){ echo $ir["IV_G"]; 
									$countGirls += (int)$ir["IV_G"];
									$grandTotalGirlsiv += (int)$ir["IV_G"];
									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["IV_B"] > 0){
									echo $ir["IV_B"]; $countBoy += $ir["IV_B"]; 
									$grandTotalBoysiv += $ir["IV_B"];
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["V_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["V_G"] > 0){ echo $ir["V_G"]; 
									$countGirls += (int)$ir["V_G"];
									$grandTotalGirlsv += (int)$ir["V_G"];
									 }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["V_B"] > 0){
										echo $ir["V_B"]; $countBoy += $ir["V_B"];
										$grandTotalBoysv += $ir["V_B"]; 										
										}else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["VI_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                  <strong><?php if( (int)$ir["VI_G"] > 0){ echo $ir["VI_G"];
								  $countGirls += (int)$ir["VI_G"];
								  $grandTotalGirlsvi += (int)$ir["VI_G"];
								   }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["VI_B"] > 0){
										echo $ir["VI_B"]; $countBoy += $ir["VI_B"];
										$grandTotalBoysvi += $ir["VI_B"];	
										}else{ echo 0; } ?></strong>
                                </div>
                              </td>
							  
							   <?php } ?>	
							  <?php if( isset( $ir["VII_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["VII_G"] > 0){ echo $ir["VII_G"];
											$countGirls += (int)$ir["VII_G"];
											$grandTotalGirlsvii += (int)$ir["VII_G"];
									 }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
									<strong><?php if( (int)$ir["VII_B"] > 0){ 
									echo $ir["VII_B"]; $countBoy += $ir["VII_B"];
									$grandTotalBoysvii += $ir["VII_B"];									
									}
									else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["VIII_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["VIII_G"] > 0){ 
									echo $ir["VIII_G"]; $countGirls += (int)$ir["VIII_G"];
									$grandTotalGirlsviii += (int)$ir["VIII_G"];	
									}else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["VIII_B"] > 0){ 
									echo $ir["VIII_B"];  $countBoy += $ir["VIII_B"];
									$grandTotalBoysviii += $ir["VIII_B"];	
									}else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["IX_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?php if( (int)$ir["IX_G"] > 0){ echo $ir["IX_G"]; $countGirls += (int)$ir["IX_G"]; $grandTotalGirlsix += (int)$ir["IX_G"];  }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
                                	<strong><?php if( (int)$ir["IX_B"] > 0){ echo $ir["IX_B"]; $countBoy += $ir["IX_B"]; $grandTotalBoysix += $ir["IX_B"];  }else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["X_G"] ) ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?php if( (int)$ir["X_G"] > 0){ echo $ir["X_G"]; $countGirls += (int)$ir["X_G"];  $grandTotalGirlsx += (int)$ir["X_G"];  }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["X_B"] > 0){ echo $ir["X_B"]; $countBoy += $ir["X_B"]; $grandTotalBoysx += $ir["X_B"]; }else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["XI_G"] ) ){ ?>
                              <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?php if( (int)$ir["XI_G"] > 0){ echo $ir["XI_G"]; $countGirls += (int)$ir["XI_G"];  $grandTotalGirlsxi += (int)$ir["XI_G"]; }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["XI_B"] > 0){ echo $ir["XI_B"]; $countBoy += $ir["XI_B"];  $grandTotalBoysxi += $ir["XI_B"]; }else{ echo 0; } ?></strong>
                                </div>
                              </td>
							   <?php } ?>	
							  <?php if( isset( $ir["A1_G"] ) ){ ?>
							      <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?php if( (int)$ir["A1_G"] > 0){ echo $ir["A1_G"]; $countGirls += (int)$ir["A1_G"];  $grandTotalGirlsxii += (int)$ir["A1_G"];  }else{ echo 0; } ?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?php if( (int)$ir["A1_B"] > 0){ echo $ir["A1_B"]; $countBoy += $ir["A1_B"];  $grandTotalBoysxii += $ir["A1_B"]; }else{ echo 0; } ?></strong>
                                </div>
                              </td>	  
							  
							   <?php } ?>	
							
	     <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$countGirls;?></strong>
                                  
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$countBoy;?></strong>
                                	
									<?php
									$TotalGirls += $countGirls;
									$TotalBoye += $countBoy;
									?>
                                </div>
                              </td>
	  </tr>

  <?php  } ?>
<?php } ?>



<!-- Grand Total -->
						 
						 
						    <tr>
							   
								<td class="text-center"> <strong> Grand Total </strong></td>
							    <?php if( $active_pn == 1 ){ ?>
							<td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<?=$grandTotalGirlsPN;?>
									</strong>
                                    <!--span class="tooltiptext">Siblings: <strong>32% (64)</strong><br />Petitions: <strong>10% (10)</strong><br />North Campus: <strong>20% (40)</strong></span -->
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysPN;?></strong>
                                </div>
                              </td>
							    <?php } ?>
							  
							  
							  <?php if( $active_n == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$grandTotalGirlsN;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysN;?></strong>
                                
                                </div>
                              </td>
							    <?php } ?>
								
								  <?php if( $active_kg == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?=$grandTotalGirlskg;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
									<strong><?=$grandTotalBoyskg;?></strong>
                                	
                                </div>
                              </td>
							   <?php } ?>
							   
							    <?php if( $active_i == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong>
									<strong><?=$grandTotalGirlsi;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                	<strong><?=$grandTotalBoysi;?></strong>
                                	
                                </div>
                              </td>
							  
							   <?php } ?>
							    <?php if( $active_ii == 1){ ?>
								
								
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
									<strong><?=$grandTotalGirlsii;?></strong>
                                    
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysii;?></strong>
                                </div>
                              </td>
							  
							   <?php } ?>
							   
							    <?php if( $active_iii == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong>
									<?=$grandTotalGirlsiii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysiii;?></strong>
                                </div>
                              </td>
							   <?php } ?>
							   
							     <?php if( $active_iv == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsiv;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysiv;?></strong>
                                </div>
                              </td>
							    <?php } ?>
								
								
								  <?php if( $active_v == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsv;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysv;?></strong>
                                </div>
                              </td>
							     <?php } ?>
								 
								  <?php if( $active_vi == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                  <strong><?=$grandTotalGirlsvi;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysvi;?></strong>
                                </div>
                              </td>
							    <?php } ?>
								<?php if( $active_vii == 1 ){ ?>
								
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsvii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
									<strong><?=$grandTotalBoysvii;?></strong>
                                </div>
                              </td>
							  <?php } ?>
								<?php if( $active_viii == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsviii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysviii;?></strong>
                                </div>
                              </td><?php } ?>
								<?php if( $active_ix == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                    <strong><?=$grandTotalGirlsix;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                   
                                	<strong><?=$grandTotalBoysix;?></strong>
                                </div>
                              </td>
							  <?php } ?>
								<?php if( $active_x == 1 ){ ?>
                              <td class="text-center">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?=$grandTotalGirlsx;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysx;?></strong>
                                </div>
                              </td>
							  <?php } ?>
								<?php if( $active_xi == 1 ){ ?>
                              <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?=$grandTotalGirlsxi;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysxi;?></strong>
                                </div>
                              </td>
							  <?php } ?>
								<?php if( $active_xii ==1 ){ ?>
							      <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br />
                                   <strong><?=$grandTotalGirlsxii;?></strong>
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$grandTotalBoysxii;?></strong>
                                </div>
                              </td>
                             <?php } ?>
							   <td class="text-center" style="border-left:2px solid #888;">
                              	<div class="col-md-6 tooltipp girls">
                                	<span class="">G</span><br /><strong><?=$TotalGirls;?>
									</strong>
                                  
                                </div>
                                <div class="col-md-6 boys tooltipp">
                                	<span class="">B</span><br />
                                    <strong><?=$TotalBoye;?>
									
									
									</strong>
                                	
									
									
									
                                </div>
                              </td>
                           
							  
                             
                          </tr>
						
 
</tbody> 
</table><!-- StaffListing -->


</div><!-- inner -->



<script>
$(document).ready(function() {
    $('#data_table2').DataTable();
} );
</script>
