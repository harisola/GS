<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Batch_sheet extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
		public function index(){
		
		if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{
			$this->load->model('gs_admission/billing_confirmation_model', 'AB');
			
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');
		
			$data['batchBilling'] = $this->AB->batch_bill($where=NULL);
			// var_dump($data['batchBilling']  ); exit;
			$this->load->view('gs_admission/batch_sheet/batch_sheet',$data);
	        $this->load->view('gs_admission/batch_sheet/footer');
	    }		
	}
	
	public function fliter(){
		$this->load->model('gs_admission/billing_confirmation_model', 'AB');
		$grade_id = $this->input->post("gradename");
		
		if( $this->input->post("batch_cat_name") != NULL ){
			$batch_name = $this->input->post("batch_cat_name");
		}else{
			$batch_name = "";
		}
		
			
		$query = $this->grade_query( $grade_id,$batch_name  ); 
		//exit;
		
		$data["batchBilling"] = $this->AB->batch_bill2($query);
		
		//var_dump( $data["batchBilling"] );
		
		$data["batch_name"]=$batch_name;
		$data["grade_id"]=$grade_id;
		
		
$data["gender"]=NULL; 
$data["siblings"]=NULL; 
$data["Assmnt_dt"]=NULL; 
$data["ass_name_code"]=NULL; 
$data["ass_d_result"]=NULL; 
$data["a_d_n_c"]=NULL; 
$data["discussion_date"]=NULL; 
$data["dis_n_c"]=NULL; 
$data["dis_result"]=NULL; 
$data["dis_dec"]=NULL; 
$data["OutCome"]=NULL; 
$data["batch_cat"]=NULL; 




		$this->load->view('gs_admission/batch_sheet/fliter_result',$data);
	}
	
	
	public function grade_query( $grade_id, $batch_name ){
		$query = $this->query_first_part();
		$boolean = true;
		if( empty( $batch_name ) ){
			foreach( $grade_id as $g_id ){
				if( $boolean ){
					$query .= " and af.grade_id = ".$g_id." ";
					$boolean=false;
				}else{
					$query .= " OR af.grade_id = ".$g_id." ";
				}
			}
		}else{
			
			foreach( $batch_name as $g_id ){
				if( $boolean ){
					$query .= " and af.form_batch_id = ".$g_id." ";
					$boolean=false;
				}else{
					$query .= " OR af.form_batch_id = ".$g_id." ";
				}
			}
			
			
			//$query .= "and af.batch_category = '".$batch_name."' ";
		}
		$query .= " order by af.batch_time_submission) as data group by form_no order by batch_time_submission, form_no";
		return $query;
	}
	
	public function edit2(){
        $html = '';
		$this->load->model('gs_admission/process_flow_model');        
        $gradeID = $this->input->post('gradeID');
        $gradeIDs = explode(",", $gradeID);
        $data['batch'] = $this->process_flow_model->getBatch($gradeIDs);
		if($gradeIDs[0] == 'All' || $gradeID ==''){ }else{
			if($gradeID == ''){
            $html = '';
            }else{
				$html .= '<ul><li><input type="checkbox" value="All Batches" name="AllG" id="AllG"/><label for="AllG">All Batches</label></li>';
                foreach ($data['batch'] as $batch) {
                    //$html .= '<option value="'.$batch['batch_category'].'">'.$batch['batch_category'].'</option>';
					$html .= '  <li><input class="mutliSelectG2" type="checkbox" value="'.$batch['id'].'" name="'.$batch['id'].'" id="'.$batch['id'].'" /><label for="'.$batch['id'].'">'.$batch['batch_category'].'</label></li>';
                }

                $html .= ' </ul>';
            }
        }
        


        echo $html;
    }
	
	
public function get_data_filter_wise(){
$this->load->model('gs_admission/billing_confirmation_model', 'AB');
$fd = $this->input->post('filteredData');
$gender = trim($fd["Gender"]);
$siblings = trim($fd["siblings"]);
$Assmnt_dt = trim($fd["Assmnt_dt"]);
$ass_name_code = trim($fd["ass_name_code"]);
$ass_d_result = trim($fd["ass_d_result"]);
$a_d_n_c = trim($fd["ass_decission_name_code"]);
$discussion_date = trim($fd["discussion_date"]);
$dis_n_c = trim($fd["discussion_name_code"]);
$dis_result = trim($fd["discussion_result"]);
$dis_dec = trim($fd["discussion_decission"]);
$OutCome = trim($fd["out_comeFinalResult"]);
$batch_cat = trim($fd["batch_category"]);
$grade_id = trim($fd["grade_id"]);


$query = $this->query_first_part();
$query .= $this->buildQuery2($grade_id, $gender,$siblings, $Assmnt_dt, $ass_name_code, $ass_d_result,$a_d_n_c,$discussion_date,$dis_n_c,$dis_result,$dis_dec,$batch_cat,$OutCome );
//echo $query; exit;
$data["batchBilling"] = $this->AB->batch_bill2($query);
//var_dump( $data["batchBilling"] );

$data["batch_name"]=$batch_cat;
$data["grade_id"]=$grade_id;

if( $gender != '' ){
	if($gender == 'Boy'){
		$gndr = 'B';
	}else{
		$gndr = 'G';
	}
	$data["gender"]=$gndr;
}else{ $data["gender"]=NULL; }
	
if( $siblings != NULL ){ $data["siblings"]=$siblings; } else{ $data["siblings"]=NULL; }
if( $Assmnt_dt != NULL ){ $data["Assmnt_dt"]=$Assmnt_dt; } else{ $data["Assmnt_dt"]=NULL; }
if( $ass_name_code != NULL ){ $data["ass_name_code"]=$ass_name_code; } else{ $data["ass_name_code"]=NULL; }
if( $ass_d_result != NULL ){ $data["ass_d_result"]=$ass_d_result; } else{ $data["ass_d_result"]=NULL; }
if( $a_d_n_c != NULL ){ $data["a_d_n_c"]=$a_d_n_c; } else{ $data["a_d_n_c"]=NULL; }
if( $discussion_date != NULL ){ $data["discussion_date"]=$discussion_date; } else{ $data["discussion_date"]=NULL; }
if( $dis_n_c != NULL ){ $data["dis_n_c"]=$dis_n_c; } else{ $data["dis_n_c"]=NULL; }
if( $dis_result != NULL ){ $data["dis_result"]=$dis_result; } else{ $data["dis_result"]=NULL; }
if( $dis_dec != NULL ){ $data["dis_dec"]=$dis_dec; } else{ $data["dis_dec"]=NULL; }
if( $OutCome != NULL ){ $data["OutCome"]=$OutCome; } else{ $data["OutCome"]=NULL; }
if( $batch_cat != NULL ){ $data["batch_cat"]=$batch_cat; } else{ $data["batch_cat"]=NULL; }

$this->load->view('gs_admission/batch_sheet/fliter_result',$data);

}
	
	
function buildQuery2($grade_id, $gender, $siblings, $Assmnt_dt, $ass_name_code, $ass_d_result,$a_d_n_c,$discussion_date,$dis_n_c,$dis_result,$dis_dec,$batch_cat,$OutCome ){
	$query ="";
	if( $batch_cat != ''  && $grade_id != '' )
	if( $batch_cat == '' ){
		
		$boolean = true;
		$arr_grade_id = explode(",",$grade_id);
		$sizeof = sizeof( $arr_grade_id );
		
		if( $sizeof > 1 ){
		
			foreach( $arr_grade_id as $g_id ){
				if( $boolean ){
					$query .= " and (af.grade_id = ".$g_id." ";
					$boolean=false;
				}else{
					$query .= " OR af.grade_id = ".$g_id.") ";
				}
			}
		
		}else{
			foreach( $arr_grade_id as $g_id ){
				$query .= " and (af.grade_id = ".$g_id.") ";
				$boolean=false;
			}
		}
		
		
	}else{
		if( $batch_cat != '' ){
			$boolean=true;
			$arr_batch_cat = explode(",",$batch_cat);
			$sizeofBC = sizeof( $arr_batch_cat );
			
			if( $sizeofBC > 1 ){
				foreach( $arr_batch_cat as $g_id ){
					if( $boolean ){
						$query .= " and (af.form_batch_id = ".$g_id." ";
						$boolean=false;
					}else{
						$query .= " OR af.form_batch_id = ".$g_id.") ";
					}
				}
			}else{
				foreach( $arr_batch_cat as $g_id ){
					$query .= " and (af.form_batch_id = ".$g_id.") ";
					$boolean=false;
				}
			}
		}// if not empty
	}
		
		
	if( $gender != '' ){
		if($gender == 'Boy'){
		$gndr = 'B';
		}else{
		$gndr = 'G';
		}
		$query .= " and af.gender='".$gndr."'";
	}
	
	if( $siblings != '' ){ $query .= " and af.sibling='".$siblings."'"; }
	if( $Assmnt_dt != '' ){ $query .= " and DATE_FORMAT(af.form_assessment_date, '%d %b')= '".$Assmnt_dt."'"; }
	if( $ass_name_code != '' ){ $query .= " and af.ast_name_code = '".$ass_name_code."'"; }
	if( $ass_d_result != '' ){ $query .= " and af.form_assessment_result = '".$ass_d_result."'"; }
	if( $a_d_n_c != '' ){ $query .= " and af.form_assessment_decision = '".$a_d_n_c."'"; }
	if( $discussion_date != '' ){ $query .= " and DATE_FORMAT(Dis_Presence.date, '%a %d %b') = '".$discussion_date."'"; }
	if( $dis_n_c != '' ){ $query .= " and af.dis_name_code = '".$dis_n_c."'"; }
	if( $dis_result != '' ){ $query .= " and af.form_discussion_result = '".$dis_result."'"; }
	if( $dis_dec != '' ){ $query .= " and af.form_discussion_decision = '".$dis_dec."'"; }
	
	if( $OutCome != '' ){  // $query .= " and DATE_FORMAT(outcome.outcome_date, '%a %d %b') = '".$OutCome."'"; 
		$query .= " and af.form_discussion_decision = '".$OutCome."'";
	}
	
	$query .= " order by af.batch_time_submission) as data group by form_no order by batch_time_submission, form_no";
	return $query;
	
	/*	'and af.grade_id=1' #and DATE_FORMAT(AST_Presence.date, '%a %d %b') = 'Sat 21 Jan' #and DATE_FORMAT(Dis_Presence.date, '%a %d %b') = 'Sat 21 Jan'*/
	
}

public function query_first_part(){
	
	$query = "select * from
					(select
					af.form_id, LPAD(af.form_no, 4, '0') AS form_no,
					if(af.gf_id >= 17000 and af.gf_id <= 18000, '', concat(left(lpad(af.gf_id, 5, 0),2),'-',right(lpad(af.gf_id, 5, 0),3))) as gf_id,
					af.official_name as applicant_name, af.father_name, af.mother_name,
					
					if(af.gender = 'B', 'Boy', 'Girl') as gender, af.sibling, af.pet_code, 
					
					DATE_FORMAT(af.form_issuance_date, '%a %d %b') as form_issuance_date,
					DATE_FORMAT(af.form_submission_date, '%a %d %b') as form_submission_date,
					af.batch_time_submission, DATE_FORMAT(af.dob, '%d-%b-%Y') as dob,
					CONCAT(
						YEAR(FROM_DAYS(DATEDIFF(NOW(),af.dob))),'y, ',
						MONTH(FROM_DAYS(DATEDIFF(NOW(),af.dob))),'m', '') as age,

					/***** Assessment *****/
					CONCAT(DATE_FORMAT(af.form_assessment_date, '%a %d %b'), '@ ', TIME_FORMAT(af.batch_time_submission, '%h:%i')) as form_assessment_date,
					DATE_FORMAT(af.form_assessment_date, '%d %b') as simple_form_assessment_date,
					IFNULL(DATE_FORMAT(AST_Presence.date, '%a %d %b'),'') AS ast_done_on, af.ast_name_code, 
					IF(IFNULL(AST_Reminder.admission_form_id,0)=0,0,1) as flag_ast_reminder, IF(IFNULL(AST_Presence.date,0)=0,0,1) as flag_ast_presence, 
					IF(IFNULL(AST_Followup.admission_form_id,0)=0,0,1) as flag_ast_followup,
					af.form_assessment_result, af.form_assessment_decision,
					IF(af.form_assessment_result='',0,1) as flag_ast_result,
					IF(af.form_assessment_decision='',0,1) as flag_ast_decision, IF(af.form_assessment_decision='',0,1) as flag_ast_allocation,
					IF(IFNULL(DIS_Communication.admission_form_id,0)=0,0,1) as flag_comm_ast_result,
					/***** Assessment - END *****/

					IF(IFNULL(OFFER.admission_form_id, 'A')='A', '', DATE_FORMAT(OFFER.date, '%a %d %b')) as OFFER,

					/***** Assessment *****/
					IFNULL(CONCAT(DATE_FORMAT(af.form_discussion_date, '%a %d %b'), ' @ ', TIME_FORMAT(af.form_discussion_time, '%h:%i')), '') as form_discussion_date,
					IFNULL(DATE_FORMAT(Dis_Presence.date, '%a %d %b'),'') AS dis_done_on, af.dis_name_code,
					IF(IFNULL(DIS_Reminder.admission_form_id,0)=0,0,1) as flag_dis_reminder, IF(IFNULL(DIS_Presence.date,0)=0,0,1) as flag_dis_presence, 
					IF(IFNULL(DIS_Followup.admission_form_id,0)=0,0,1) as flag_dis_followup,
					af.form_discussion_result, af.form_discussion_decision,
					IF(af.form_discussion_result='',0,1) as flag_dis_result,
					IF(af.form_discussion_decision='',0,1) as flag_dis_decision, IF(af.form_discussion_decision='',0,1) as flag_dis_allocation,
					IF(IFNULL(OFR_Communication.admission_form_id,0)=0,0,1) as flag_comm_dis_result,
					/***** Assessment - END *****/


					/***** Other References Fields *****/
					af.form_batch_id, af.grade_id, af.and_id, af.and_batch,
					af.batch_category, af.batch_slot_no, af.grade_name, af.form_status_stage_id,
					af.form_status_id, 
					ifnull(outcome.outcome_date,'') as outcome_date
					/***** Other References Fields - END *****/


					from atif_gs_admission.view_admission_form as af

					/***** Assessment *****/
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 4
						/*and type = 'G'*/
						group by admission_form_id) as AST_Presence
							on AST_Presence.admission_form_id = af.form_id

					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 3
						/*and type = 'G'*/
						group by admission_form_id) as AST_Reminder
							on AST_Reminder.admission_form_id = af.form_id
						
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 5
						/*and type = 'G'*/
						group by admission_form_id) as AST_Followup
							on AST_Followup.admission_form_id = af.form_id
						
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 3
						and new_form_stage = 2
						/*and type = 'G'*/
						group by admission_form_id) as DIS_Communication
							on DIS_Communication.admission_form_id = af.form_id
					/***** Assessment - END *****/

							

					/***** Discussion *****/
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 4
						/*and type = 'G'*/
						group by admission_form_id) as Dis_Presence
							on Dis_Presence.admission_form_id = af.form_id
							
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 3
						/*and type = 'G'*/
						group by admission_form_id) as DIS_Reminder
							on DIS_Reminder.admission_form_id = af.form_id
						
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 5
						/*and type = 'G'*/
						group by admission_form_id) as DIS_Followup
							on DIS_Followup.admission_form_id = af.form_id

					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 4
						and new_form_stage = 2
						/*and type = 'G'*/
						group by admission_form_id) as OFR_Communication
							on OFR_Communication.admission_form_id = af.form_id
					/***** Discussion - END *****/


					/***** Offer *****/
					left join (select
						admission_form_id, from_unixtime(modified) as date
						from atif_gs_admission.log_form_status
						where new_form_status = 5
						and type = 'S'
						group by admission_form_id) as OFFER
							on OFFER.admission_form_id = af.form_id
					/***** Offer - END *****/
					
					/***** Outcome date *****/
					left join (Select admission_form_id, 
						from_unixtime(max(modified), '%a %d %b') as outcome_date 
						From atif_gs_admission.log_form_status 
						where new_form_stage = 15 or new_form_stage = 7
						group by admission_form_id
						union
						select lgs.admission_form_id, 
						from_unixtime(min(lgs.modified), '%a %d %b') as outcome_date
						from atif_gs_admission.log_form_status as lgs
						where lgs.new_form_status >= 6
						group by lgs.admission_form_id) as outcome
						on outcome.admission_form_id = af.form_id
					/***** Outcome date - End *****/

					where af.form_assessment_date != '0000-00-00'
					and af.form_assessment_date != '2001-01-01' ";
					return $query;
}

}