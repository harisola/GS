<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Submission_report extends CI_Controller{
	
    public function __construct(){
        parent::__construct();
		$this->load->library('session');
    }
	
	
	public function index(){
		
		/*if($this->ion_auth->logged_in() == FALSE){
			redirect('welcome');
		}else{*/
			
			
			$this->load->model('gs_admission/issuance_report_model', 'IRM');
			
			$this->load->view('gs_files/header');
	        $this->load->view('gs_files/main-nav');
	        $this->load->view('gs_files/breadcrumb');
			
			$user_id = (int)$this->session->userdata("user_id");
			$data["submissions"] = $this->IRM->submission();
			
			
			
			
			$this->load->view('gs_admission/submission_report/front_page',$data);
	        $this->load->view('gs_admission/submission_report/footer');
	  //  }		
	}
	
	
	public function fliter(){
		$this->load->model('gs_admission/issuance_report_model', 'IRM');
		
		$grade_id = $this->input->post("gradename");
		$from_date = $this->input->post("from_date");
		$to_date = $this->input->post("to_date");
		
		//$query = $this->grade_query( $grade_id,$from_date,$to_date );
		//$size = sizeof( $grade_id );
		//$res=count($grade_id); 
		
		
		
		$data["submissions"] = $this->IRM->submission();
		
		//$data['queryResult'] = $this->IRM->buildQuery( $query );
		
		//$data = array("grd"=>$grade_id,"Frm"=>$from_date, "to"=>$to_date, "Query" =>$query, "size"=>$size, "QueryResult"=>$queryResult );
		$this->load->view('gs_admission/submission_report/fliter_result',$data);
		
		//echo json_encode($data);
	}
	
	
	public function grade_query( $grade_id,$from_date,$to_date ){
		
		$query = "";
		$query .= "SELECT * FROM (select af.issuance_date,";
		//$size = sizeof( $grade_id );
		$size= end($grade_id);
		$res=count($grade_id); 
		
		foreach( $grade_id as $g_id ){
			
		if( $g_id == 1 ){
			if( $size == 1  ){
			$query .= " IFNULL(pn_g.num,'') as PN_G, IFNULL(pn_b.num,'') as PN_B, IFNULL(sub_pn_g.num,'') as SUB_PN_G, IFNULL(sub_pn_b.num,'') as SUB_PN_B ";	
			}else{
			$query .= " IFNULL(pn_g.num,'') as PN_G, IFNULL(pn_b.num,'') as PN_B, IFNULL(sub_pn_g.num,'') as SUB_PN_G, IFNULL(sub_pn_b.num,'') as SUB_PN_B, ";	
			}
		}
				
				
	if( $g_id == 2 ){
		if( $size == 2 ){
		$query .= " IFNULL(n_g.num,'') as N_G, IFNULL(n_b.num,'') as N_B, IFNULL(sub_n_g.num,'') as SUB_N_G, IFNULL(sub_n_b.num,'') as SUB_N_B ";	
		}else{
		$query .= " IFNULL(n_g.num,'') as N_G, IFNULL(n_b.num,'') as N_B, IFNULL(sub_n_g.num,'') as SUB_N_G, IFNULL(sub_n_b.num,'') as SUB_N_B, ";	
		}
	}
				
				
		if( $g_id == 3 ){
			if( $size ==3 ){
			$query .= " IFNULL(kg_g.num,'') as KG_G, IFNULL(kg_b.num,'') as KG_B, IFNULL(sub_kg_g.num,'') as SUB_KG_G, IFNULL(sub_kg_b.num,'') as SUB_KG_B ";	
			}else{
			$query .= " IFNULL(kg_g.num,'') as KG_G, IFNULL(kg_b.num,'') as KG_B, IFNULL(sub_kg_g.num,'') as SUB_KG_G, IFNULL(sub_kg_b.num,'') as SUB_KG_B, ";
			}
		}
		
				
		if( $g_id == 4 ){
			if( $size == 4 ){
			$query .= " IFNULL(i_g.num,'') as I_G, IFNULL(i_b.num,'') as I_B, IFNULL(sub_i_g.num,'') as SUB_I_G, IFNULL(sub_i_b.num,'') as SUB_I_B ";	
			}else{
			$query .= " IFNULL(i_g.num,'') as I_G, IFNULL(i_b.num,'') as I_B, IFNULL(sub_i_g.num,'') as SUB_I_G, IFNULL(sub_i_b.num,'') as SUB_I_B, ";
			}
		}
				
	if( $g_id == 5 ){
		if( $size == 5  ){
		$query .= " IFNULL(ii_g.num,'') as II_G, IFNULL(ii_b.num,'') as II_B, IFNULL(sub_ii_g.num,'') as SUB_II_G, IFNULL(sub_ii_b.num,'') as SUB_II_B ";
		}else{
		$query .= " IFNULL(ii_g.num,'') as II_G, IFNULL(ii_b.num,'') as II_B, IFNULL(sub_ii_g.num,'') as SUB_II_G, IFNULL(sub_ii_b.num,'') as SUB_II_B, ";
		}
	}
	if( $g_id == 6 ){
			if( $size == 6 ){
			$query .= " IFNULL(iii_g.num,'') as III_G, IFNULL(iii_b.num,'') as III_B, IFNULL(sub_iii_g.num,'') as SUB_III_G, IFNULL(sub_iii_b.num,'') as SUB_III_B ";	
			}else{
			$query .= " IFNULL(iii_g.num,'') as III_G, IFNULL(iii_b.num,'') as III_B, IFNULL(sub_iii_g.num,'') as SUB_III_G, IFNULL(sub_iii_b.num,'') as SUB_III_B, ";	
			}
		}
				
				
	if( $g_id == 7 ){
		if( $size == 7  ){
		$query .= " IFNULL(iv_g.num,'') as IV_G, IFNULL(iv_b.num,'') as IV_B, IFNULL(sub_iv_g.num,'') as SUB_IV_G, IFNULL(sub_iv_b.num,'') as SUB_IV_B ";
		}else{
		$query .= " IFNULL(iv_g.num,'') as IV_G, IFNULL(iv_b.num,'') as IV_B, IFNULL(sub_iv_g.num,'') as SUB_IV_G, IFNULL(sub_iv_b.num,'') as SUB_IV_B, ";
		}
	}
				
				
	if( $g_id == 8 ){
		if( $size == 8 ){
		$query .= " IFNULL(v_g.num,'') as V_G, IFNULL(v_b.num,'') as V_B, IFNULL(sub_v_g.num,'') as SUB_V_G, IFNULL(sub_v_b.num,'') as SUB_V_B ";
		}else{
		$query .= " IFNULL(v_g.num,'') as V_G, IFNULL(v_b.num,'') as V_B, IFNULL(sub_v_g.num,'') as SUB_V_G, IFNULL(sub_v_b.num,'') as SUB_V_B, ";
		}
	}
				
				
	if( $g_id == 9 ){
		if( $size ==9  ){
		$query .= " IFNULL(vi_g.num,'') as VI_G, IFNULL(vi_b.num,'') as VI_B, IFNULL(sub_vi_g.num,'') as SUB_VI_G, IFNULL(sub_vi_b.num,'') as SUB_VI_B ";
		}else{
		$query .= " IFNULL(vi_g.num,'') as VI_G, IFNULL(vi_b.num,'') as VI_B, IFNULL(sub_vi_g.num,'') as SUB_VI_G, IFNULL(sub_vi_b.num,'') as SUB_VI_B, ";
		}
	}
				
				
	if( $g_id == 10 ){
		if( $size == 10  ){
		$query .= " IFNULL(vii_g.num,'') as VII_G, IFNULL(vii_b.num,'') as VII_B, IFNULL(sub_vii_g.num,'') as SUB_VII_G, IFNULL(sub_vii_b.num,'') as SUB_VII_B ";
		}else{
		$query .= " IFNULL(vii_g.num,'') as VII_G, IFNULL(vii_b.num,'') as VII_B, IFNULL(sub_vii_g.num,'') as SUB_VII_G, IFNULL(sub_vii_b.num,'') as SUB_VII_B, ";
		}
	}
				
				
	if( $g_id == 11 ){
		if( $size == 11  ){
		$query .= " IFNULL(viii_g.num,'') as VIII_G, IFNULL(viii_b.num,'') as VIII_B ";
		}else{
		$query .= " IFNULL(viii_g.num,'') as VIII_G, IFNULL(viii_b.num,'') as VIII_B, ";
		}
	}
				
				
				if( $g_id == 12 ){
					if( $size == 12 ){
					$query .= " IFNULL(ix_g.num,'') as IX_G, IFNULL(ix_b.num,'') as IX_B ";
					}else{
					$query .= " IFNULL(ix_g.num,'') as IX_G, IFNULL(ix_b.num,'') as IX_B, ";	
					}
				}
				
				
				if( $g_id == 13 ){
					if( $size == 13  ){
					$query .= " IFNULL(x_g.num,'') as X_G, IFNULL(x_b.num,'') as X_B ";
					}else{
					$query .= " IFNULL(x_g.num,'') as X_G, IFNULL(x_b.num,'') as X_B, ";	
					}
				}
				
				
				
				if( $g_id == 14 ){
					if( $size == 14 ){
					$query .= " IFNULL(xi_g.num,'') as XI_G, IFNULL(xi_b.num,'') as XI_B ";
					}else{
					$query .= " IFNULL(xi_g.num,'') as XI_G, IFNULL(xi_b.num,'') as XI_B, ";	
					}
				}
				
				
				if( $g_id == 15 ){
					$query .= " IFNULL(a1_g.num,'') as A1_G, IFNULL(a1_b.num,'') as A1_B ";	
				}
				
				
		} // end foreach
		
		$query .= "from atif_gs_admission.view_admission_form as af ";
		
		foreach ( $grade_id as $g_id ){
			
			if( $g_id == 1 ){
				$query .= $this->pn();
				}
				
				if( $g_id == 2 ){
				$query .= $this->n();
				}
				
				
				if( $g_id == 3 ){
				$query .= $this->kg();
				}
				
				
				if( $g_id == 4 ){
				$query .= $this->I();
				}
				
				if( $g_id == 5 ){
				$query .= $this->II();
				}
				
				if( $g_id == 6 ){
				$query .= $this->III();
				}
				
				if( $g_id == 7 ){
				$query .= $this->IV();
				}
				
				
				if( $g_id == 8 ){
				$query .= $this->V();
				}
				
				if( $g_id == 9 ){
				$query .= $this->VI();
				}
				
				if( $g_id == 10 ){
				$query .= $this->VII();
				}
				
				if( $g_id == 11 ){
				$query .= $this->VIII();
				}
				
				if( $g_id == 12 ){
				$query .= $this->IX();
				}
				
				if( $g_id == 13 ){
				$query .= $this->X();
				}
				
				if( $g_id == 14 ){
				$query .= $this->XI();
				}
				if( $g_id == 15 ){
				$query .= $this->XII();
				}
		}
		
		
		$query .= ") AS DATA where issuance_date >= '".$from_date."' and issuance_date <= '".$to_date."' group by issuance_date";
		return $query;
	}
	
	public function pn(){
		$query =  " left join (select af.grade_id, 
				af.issuance_date,	af.gender, COUNT(af.gender) as num
				from atif_gs_admission.view_admission_form as af
				where af.grade_id=1 and af.gender='G'
				group by af.issuance_date, af.grade_id) as pn_g
				on pn_g.grade_id=1 and pn_g.issuance_date = af.issuance_date
				left join (select af.grade_id, 
				af.issuance_date,	af.gender, COUNT(af.gender) as num
				from atif_gs_admission.view_admission_form as af
				where af.grade_id=1 and af.gender='B'
				group by af.issuance_date, af.grade_id) as pn_b
				on pn_b.grade_id=1 and pn_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	
	public function n(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=2 and af.gender='G'
	group by af.issuance_date, af.grade_id) as n_g
	on n_g.grade_id=2 and n_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=2 and af.gender='B'
	group by af.issuance_date, af.grade_id) as n_b
	on n_b.grade_id=2 and n_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	
	public function kg(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=3 and af.gender='G'
	group by af.issuance_date, af.grade_id) as kg_g
	on kg_g.grade_id=3 and kg_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=3 and af.gender='B'
	group by af.issuance_date, af.grade_id) as kg_b
	on kg_b.grade_id=3 and kg_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	
	public function I(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=4 and af.gender='G'
	group by af.issuance_date, af.grade_id) as i_g
	on i_g.grade_id=4 and i_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=4 and af.gender='B'
	group by af.issuance_date, af.grade_id) as i_b
	on i_b.grade_id=4 and i_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	public function II(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=5 and af.gender='G'
	group by af.issuance_date, af.grade_id) as ii_g
	on ii_g.grade_id=5 and ii_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=5 and af.gender='B'
	group by af.issuance_date, af.grade_id) as ii_b
	on ii_b.grade_id=5 and ii_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	public function III(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=6 and af.gender='G'
	group by af.issuance_date, af.grade_id) as iii_g
	on iii_g.grade_id=6 and iii_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=6 and af.gender='B'
	group by af.issuance_date, af.grade_id) as iii_b
	on iii_b.grade_id=6 and iii_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	public function IV(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=7 and af.gender='G'
	group by af.issuance_date, af.grade_id) as iv_g
	on iv_g.grade_id=7 and iv_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=7 and af.gender='B'
	group by af.issuance_date, af.grade_id) as iv_b
	on iv_b.grade_id=7 and iv_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	public function V(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=8 and af.gender='G'
	group by af.issuance_date, af.grade_id) as v_g
	on v_g.grade_id=8 and v_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=8 and af.gender='B'
	group by af.issuance_date, af.grade_id) as v_b
	on v_b.grade_id=8 and v_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	public function VI(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=9 and af.gender='G'
	group by af.issuance_date, af.grade_id) as vi_g
	on vi_g.grade_id=9 and vi_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=9 and af.gender='B'
	group by af.issuance_date, af.grade_id) as vi_b
	on vi_b.grade_id=9 and vi_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	public function VII(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=10 and af.gender='G'
	group by af.issuance_date, af.grade_id) as vii_g
	on vii_g.grade_id=10 and vii_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=10 and af.gender='B'
	group by af.issuance_date, af.grade_id) as vii_b
	on vii_b.grade_id=10 and vii_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	public function VIII(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=11 and af.gender='G'
	group by af.issuance_date, af.grade_id) as viii_g
	on viii_g.grade_id=11 and viii_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=11 and af.gender='B'
	group by af.issuance_date, af.grade_id) as viii_b
	on viii_b.grade_id=11 and viii_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	public function IX(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=12 and af.gender='G'
	group by af.issuance_date, af.grade_id) as ix_g
	on ix_g.grade_id=12 and ix_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=12 and af.gender='B'
	group by af.issuance_date, af.grade_id) as ix_b
	on ix_b.grade_id=12 and ix_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	public function X(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=13 and af.gender='G'
	group by af.issuance_date, af.grade_id) as x_g
	on x_g.grade_id=13 and x_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=13 and af.gender='B'
	group by af.issuance_date, af.grade_id) as x_b
	on x_b.grade_id=13 and x_b.issuance_date = af.issuance_date";
				return $query;
	}
	
	
	public function XI(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=14 and af.gender='G'
	group by af.issuance_date, af.grade_id) as xi_g
	on xi_g.grade_id=14 and xi_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=14 and af.gender='B'
	group by af.issuance_date, af.grade_id) as xi_b
	on xi_b.grade_id=14 and xi_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	public function XII(){
		$query =  " left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=15 and af.gender='G'
	group by af.issuance_date, af.grade_id) as a1_g
	on a1_g.grade_id=15 and a1_g.issuance_date = af.issuance_date
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=15 and af.gender='B'
	group by af.issuance_date, af.grade_id) as a1_b
	on a1_b.grade_id=15 and a1_b.issuance_date = af.issuance_date ";
				return $query;
	}
	
	
	
	
	
}// Authorities_level_one