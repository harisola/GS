<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package     CodeIgniter
 * @author      Kashif Mustafa Solangi
 * @copyright   Copyright (c) 2017, Generations Software House Labs.
 * @license    
 * @link        http://www.generations.edu.pk
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Generations Software House Labs core CodeIgniter Class
 *
 * @package     Master Page Students List
 * @subpackage          Libraries
 * @category            Gen Software House Labs
 * @author      Kashif Mustafa Solangi
 * @link        http://www.generations.edu.pk
 */
 class MasterPagStudents_lib{
	private $ci;
	public $table_view;
	public $yellow_header;
	public $Ten_Days_Students,$Sixty_Days,$TodayTotal;
	
	function __construct(){
		$this->ci =& get_instance(); 
	}
	
	
	public function get_table_list($grade_id, $section_id){
		$this->ci->load->model('student_listing/student_info_model', 'SI');
		$grade_section_student = $this->ci->SI->getStudent($grade_id,$section_id,$GS_ID=NULL);  
		
		
		
		
		
		// Student TabIn
		
		// Teacher Verfication
		$p_verf = $this->ci->SI->present_verfication($grade_id,$section_id);
		
		$this->ci->load->database('default',TRUE);
		$Student10Days=0;
		$Student60Days=0;
		$count_student = 1;
		$this->table_view = '';
		if( !empty($grade_section_student) ){
			
			$TotalStudents = count( $grade_section_student );
			foreach( $grade_section_student as $student){
				$Student_Id = $student["Student_Id"];
				$GS_ID = $student["GS_ID"];
				
				$this->table_view .= '<tr class="" id="studentID_'.$Student_Id.'">';
				
	            $this->table_view .=  '<td class="text-center">';
				$this->table_view .= $count_student;
				$this->table_view .= '<input type="hidden" name="gs" value="'.$GS_ID.'" />';
				$this->table_view .= '</td>'; // Counter TD
				
				// Class Td
				$this->table_view .= '<td class="text-center">';
				$Grade_Name = $student["Grade_Name"];
				$Section_Name= $student["Section_Name"];
				$AnOther ="S"; // Status Code 1
				
				
		
			
				$AnOther2 = $student["Statud_Code"]; // Status Code 2
				
				//$roll_no = $student["GS_ID"];
				$roll_no = $student["Roll_no"];
				
				$Status_Color = $student["Status_Color"]; // Status Code 2
				
				$this->table_view .= $this->class_td($Grade_Name, $Section_Name, $AnOther,$AnOther2,$roll_no,$Status_Color);
	            $this->table_view .= '</td>';
				
				// Name TD
				$Call_name = $student["Abridged_Name"];
				$AnOtherName = "F_Name";
				
				$O_Name = $student["O_Name"];
				$A_Name = $student["Abridged_Name"];
				$C_Name = $student["C_Name"];
			
				$this->table_view .= '<td>';
				$this->table_view .=  $this->name_td($O_Name,$A_Name,$C_Name,$AnOtherName,$GS_ID,$Student_Id);
				$this->table_view .= '</td>';
				// Attendance TD
				$this->table_view .= '<td class="text-center">';
				$attendance_varification=12;
				//$Att10Days= $student["last10Days"];
				$Att10Days = $student["total_pf"];
				$Att60Days = $student["total_ps"];
				$Student10Days += $student["total_pf"];
				$Student60Days += $student["total_ps"];
				
				$T10Days = $student["total_wdf"];
				$T60Days = $student["total_wds"]; 
				
				if( $student["To_Time"] != NULL ){
					
					if( !empty( $p_verf ) ){
						
					if( $student["Case_ID"] == 'Unauthorized Absent' ){
						$attendance_varification=2;	
					}elseif( $student["Case_ID"] == 'Authorized Absent' ){
						$attendance_varification=3;	
					}elseif( $student["Case_ID"] == 'Uninformed' ){
						$attendance_varification=2;	
					}else{
						if( $student["Case_Solved"] == 'A' ){
							$attendance_varification=3;	
						}elseif( $student["Case_Solved"] == 'U' ){
							$attendance_varification=2;
						}else{
							$attendance_varification=1;	
						}
						
					}
						
						
					}else{ $attendance_varification=0; }
					
				}else{
					date_default_timezone_set("Asia/Karachi");
					if (time() >= strtotime("08:00:00")) {
						
						if( $student["Case_Solved"] == 'A' ){
							$attendance_varification=3;	
						}elseif( $student["Case_Solved"] == 'U' ){
							$attendance_varification=2;
						}else{
							$attendance_varification=2;
						}
						
						//$attendance_varification=2;
						
					}else{ 
					
						// Tap In Wait
						$attendance_varification=5;
						
					}
				}
				//echo $attendance_varification; exit;	
				
				$Ad = ($Att60Days/60);
				$Att60Days = round( $Ad*10 );
				
				$this->table_view .= $this->Attendance_td($attendance_varification,$Att10Days,$Att60Days );
				$this->table_view .= '</td>';
				
				//  Profile TD
				$P_Academic = $student["P_Academic"];
				$P_Social 	= $student["P_Social"];
				$P_Parental = $student["P_Parental"];
				$P_Accounts = $student["P_Accounts"];
				$P_Support  = $student["P_Support"];
				$P_Conduct  = $student["P_Conduct"];
				$this->table_view .= '<td class="text-center">';
					$this->table_view .= $this->profile_td($P_Academic,$P_Social,$P_Parental,$P_Accounts,$P_Support,$P_Conduct);
                $this->table_view .= '</td>';
				
				// Budges TD
				$this->table_view .= '<td class="text-center">';
				$budges_type=1;
					$acadmic_id = $student["Acadmic"];
					$this->table_view .= $this->budges_td($acadmic_id,$grade_id,$section_id,$Student_Id);
					//$this->table_view .= $this->budges_td($budges_type);
				$this->table_view .= '</td>';
				
				
				$Case_ID  = $student["Case_ID"];
				if( $Case_ID == '' ){
					$grayBell=0;
				}else{
					$grayBell=1;
				}
	            $this->table_view .= '<td class="text-center">';
					$this->table_view .= $this->ringBell($grayBell,$GS_ID);
				$this->table_view .= '</td>';
				
				$this->table_view .= '</tr>';
				
				$count_student++;
			} // end foreach
			
			
			$this->TodayTotal = $TotalStudents;
			// 10 Days Formula
			$this->Ten_Days_Students = 0;
			$TenDaysDividedBy = ($TotalStudents*$T10Days);
			$TenDaysDividedResult = ($Student10Days/$TenDaysDividedBy);
			$this->Ten_Days_Students = ($TenDaysDividedResult*10);
			
			// 60 Days Formula
			$SixtyDaysDividedBy = ($TotalStudents * $T60Days);
			$SixtyDaysDividedResult = ($Student60Days / $SixtyDaysDividedBy);
			$this->Sixty_Days =0;
			$this->Sixty_Days = ($SixtyDaysDividedResult*10);
			
			
			
			return $this->table_view;
			
		}else{
			return FALSE;
		}
		
	}
	
	// Class TD
	public function class_td($Grade_Name=NULL, $Section_Name=NULL, $AnOther=NULL, $AnOther2=NULL,$roll_no=NULL,$Status_Color=NULL){
		$td = '';
		$td .= '<span class="class_Name BoySta">';
		$td .= '<span data-toggle="tooltip" data-placement="top" data-original-title="Roll No: '.$roll_no.'" data-pin-nopin="true">';
		$td .= $Grade_Name.'-'.$Section_Name; // class name
		$td .= '</span>';
		//style="background:#'.$Status_Color.'" 
		$td .= '<span class="StuStatus" data-toggle="tooltip" data-placement="top" data-original-title="Roll No: '.$AnOther2.'" data-pin-nopin="true">';
		$td .= $AnOther;  // section name
		$td .= '</span>';
		$td .= '</span>';
		return $td;
	}
	
	
	// Name Td
	public function name_td($O_Name=NULL,$A_Name=NULL,$C_Name=NULL,$AnOtherName=NULL,$GS_ID=NULL,$Student_Id=NULL){
		
		$td = '';
		$td .= '<a href="#" id="std_'.$Student_Id.'_gsid_'.$GS_ID.'" data-toggle="tooltip" data-placement="top" data-original-title="GS-ID: '.$GS_ID.'" data-pin-nopin="true" class="anchorCol">';
		$td .= '<span style="display:none;">'.$GS_ID.'</span>';
		if( strpos($C_Name, "'") !== FALSE ){
			$td .= '<strong>'; 
				$td .= $C_Name;	
				$td .= ' </strong> ';
		}else{
			
		
		$EO_Name = explode(' ',$A_Name);
		foreach( $EO_Name as $on ){
		if( ( $on == $C_Name ) ){
			
				$td .= '<strong>'; 
				$td .= $on;	
				$td .= ' </strong> ';
				
			}else{
				$str = $on;
				$strpos = strpos( $str , $C_Name );
				$strlen = strlen($C_Name);
				$strlen2 = strlen($str);
				if( $strpos !== false ){
					$name = substr($str,$strpos,$strlen);
					$strong_name = "<strong>".$name."</strong>";
					$frist_part = substr( $str,0, $strpos );
					$name3 = substr( $str, $strpos );
					$second_part = str_replace($name, ' ', $name3);
					$final_Call_Name = $frist_part.$strong_name. $second_part;
					$td .= $final_Call_Name.' ';
				}else{
					$td .= ' '.$on.' ';
				}
		  }
		}// end foreach
		
		}// end else aphostrophe
		
		$td .= '</a>';
		return $td;
	}
	
	
	public function Attendance_td($attendance_varification=NULL,$Att10Days=NULL,$Att60Days=NULL ){
		$td = '';
	
			
			if( $attendance_varification == 1){ 
				//Presence Verified
				$AttBox = "PV";
				$data_original_title ="Presence Verified";
			}elseif( $attendance_varification ==2){
				
				//Absent Unauthorized	
				$AttBox = "AU";
				$data_original_title ="Absent Unauthorized";
			}elseif( $attendance_varification ==3){
				//Absent Authorized	
				$AttBox = "AA";
				$data_original_title ="Absent Authorized";
			}elseif( $attendance_varification ==4){
				//Absence Verification Pending
				$AttBox = "AP";
				$data_original_title ="Absence Verification Pending";
			}elseif( $attendance_varification ==5){
				//Tap in Awaited
				$AttBox = "TA";
				$data_original_title ="Tap in Awaited";
			}elseif( $attendance_varification ==6){
				//Not Expected Today
				$AttBox = "NE";
				$data_original_title ="Not Expected Today";
			}else{
				//Presence Pending Verification
				$AttBox = "PP";
				$data_original_title ="Presence Pending Verification";
			}
		$td .= '<span class="AttBox '.$AttBox.'" style="min-width:60px;">';
		$td .= '<span class="AttStatus" data-toggle="tooltip" data-placement="top" data-original-title="'.$data_original_title.'" data-pin-nopin="true">';
		$td .= $AttBox;
		$td .= '</span>';
		$td .= '<span class="Att10Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 10 Days" data-pin-nopin="true">';
		$td .= $Att10Days;
		$td .= '</span>';
		$td .= '<span class="Att60Days" data-toggle="tooltip" data-placement="top" data-original-title="Score for 60 Days" data-pin-nopin="true">';
		$td .= $Att60Days;
		$td .= '</span>';
		$td .= '</span>';
		
		return $td;
								
	} // end
	
	
		

                                
                                
                  
	public function profile_td($P_Academic,$P_Social,$P_Parental,$P_Accounts,$P_Support,$P_Conduct){
		$td = '';
		
		$Profile='';
		if( $P_Academic != NULL){
			if($P_Academic == 'A' || $P_Academic == 'A+' || $P_Academic == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Academic == 'B' || $P_Academic == 'B+' || $P_Academic == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Academic == 'C' || $P_Academic == 'C-' || $P_Academic == 'C+' ){
				$Profile='ProfileC';
			}elseif( $P_Academic == 'D' || $P_Academic == 'D-' || $P_Academic == 'D+'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Academic = '-'; }
		
		$td .= '<span class="'.$Profile.' Academic" data-toggle="tooltip" data-placement="top" data-original-title="Academic" data-pin-nopin="true">';
		$td .= $P_Academic;
		$td .= '</span>&nbsp;';
		
        
		$Profile='';
		if( $P_Parental != NULL ){
			if($P_Parental == 'A' || $P_Parental == 'A+' || $P_Parental == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Parental == 'B' || $P_Parental == 'B+' || $P_Parental == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Parental == 'C' || $P_Parental == 'C+' || $P_Parental == 'C-'){
				$Profile='ProfileC';
			}elseif( $P_Parental == 'D' || $P_Parental == 'D+' || $P_Parental == 'D-'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Parental = '-'; }
		
		$td .= '<span class="'.$Profile.' Parental" data-toggle="tooltip" data-placement="top" data-original-title="Parental" data-pin-nopin="true">';
		$td .= $P_Parental;
		$td .= '</span>&nbsp;';
		
		
		$Profile='';
		if( $P_Social != NULL ){
			if($P_Social == 'A' || $P_Social == 'A+' || $P_Social == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Social == 'B' || $P_Social == 'B+' || $P_Social == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Social == 'C' || $P_Social == 'C-' || $P_Social == 'C+' ){
				$Profile='ProfileC';
			}elseif( $P_Social == 'D' || $P_Social == 'D-' || $P_Social == 'D+'){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Social = '-'; }
		
		$td .= '<span class="'.$Profile.'  Social" data-toggle="tooltip" data-placement="top" data-original-title="Social" data-pin-nopin="true">';
		$td .= $P_Social;
		$td .= '</span>&nbsp;';
		
		
		
		$Profile='';
		if( $P_Accounts != NULL ){
			if($P_Accounts == 'A' || $P_Accounts == 'A+' || $P_Accounts == 'A-'){
				$Profile='ProfileA';
			}elseif( $P_Accounts == 'B' || $P_Accounts == 'B+' || $P_Accounts == 'B-' ){
				$Profile='ProfileB';
			}elseif( $P_Accounts == 'C' || $P_Accounts == 'C-' || $P_Accounts == 'C+' ){
				$Profile='ProfileC';
			}elseif( $P_Accounts == 'D' || $P_Accounts == 'D-' || $P_Accounts == 'D+' ){
				$Profile='ProfileD';
			}
		
		}else{ $Profile='ProfileGray'; $P_Accounts = '-'; }
		
		$td .= '<span class="'.$Profile.'  Account" data-toggle="tooltip" data-placement="top" data-original-title="Accounts" data-pin-nopin="true">';
		$td .= $P_Accounts; 
		$td .= '</span><br />';
		return $td;
	}
	
	
	public function budges_td( $acadmic_id,$grade_id,$section_id,$student_id ){
		
		$this->ci->load->model('student_listing/badge_managment_model', 'BMM');
		$Student_Badges = $this->ci->BMM->grd_sctn_std_bdg($acadmic_id,$grade_id,$section_id,$student_id);
		$td = '';
		/*bg.ID as Badge_id,
bg.bedge_title as  Badge_Title,
bg.bedge_code as Badge_Code,
bg.bedge_expiry as Badge_Expiry,
bg.bedge_color as Badge_Color,
bg.bedge_description as Badge_Des,
bg.bedge_priority as Badge_Priority*/
$counter = 1;
		if( !empty( $Student_Badges ) ){
			
			foreach( $Student_Badges as $SB ){
				if( $counter < 4 ){
		$td .= '<span class="Badge text-center" style="background:'.$SB["Badge_Color"].'" data-toggle="tooltip" data-placement="top" data-original-title="'.$SB["Badge_Title"].': ' .$SB["Badge_Des"].'" data-pin-nopin="true">'.$SB["Badge_Code"].'</span> &nbsp;';
				}else{ $td .= '<span class="ProfileGray text-center">.</span> &nbsp;'; break; }
				$counter++;
			}
			
		}
		$this->ci->load->database('default',TRUE);
		return $td;
	}
	
	
	public function ringBell($bell_type=NULL,$GS_ID=NULL){
		$bell_Image = '';
		if( $bell_type != NULL ){
			
			if($bell_type==1){
				$bell_Image .= '<a data-toggle="modal" class="items-image show_student_activecase" data-id='.$GS_ID.' href="#">';
				$bell_Image .= '<img src="'.base_url().'components/student_listing/images/redBell.jpg" width="15" />';	
			$bell_Image .= '</a>';	
			}else{
				$bell_Image .= '<img src="'.base_url().'components/student_listing/images/grayBell.jpg" width="15" />';	
			}	
			
		}else{
			//$bell_Image = '';
			$bell_Image .= '<img src="'.base_url().'components/student_listing/images/grayBell.jpg" width="15" />';	
		}
		
		return $bell_Image;
	}
	
	
 }
 