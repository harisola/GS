<?php
class Issuance_report_model extends CI_Model{
	private $ddb;
	function __construct(){ parent::__construct(); }
	
	
	
	public function getList(){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		
$query1 = "SELECT *
FROM
(select
af.issuance_date,
IFNULL(pn_g.num,'') as PN_G, IFNULL(pn_b.num,'') as PN_B,
IFNULL(n_g.num,'') as N_G, IFNULL(n_b.num,'') as N_B,
IFNULL(kg_g.num,'') as KG_G, IFNULL(kg_b.num,'') as KG_B,
IFNULL(i_g.num,'') as I_G, IFNULL(i_b.num,'') as I_B,
IFNULL(ii_g.num,'') as II_G, IFNULL(ii_b.num,'') as II_B,
IFNULL(iii_g.num,'') as III_G, IFNULL(iii_b.num,'') as III_B,
IFNULL(iv_g.num,'') as IV_G, IFNULL(iv_b.num,'') as IV_B,
IFNULL(v_g.num,'') as V_G, IFNULL(v_b.num,'') as V_B,
IFNULL(vi_g.num,'') as VI_G, IFNULL(vi_b.num,'') as VI_B,
IFNULL(vii_g.num,'') as VII_G, IFNULL(vii_b.num,'') as VII_B,
IFNULL(viii_g.num,'') as VIII_G, IFNULL(viii_b.num,'') as VIII_B,
IFNULL(ix_g.num,'') as IX_G, IFNULL(ix_b.num,'') as IX_B,
IFNULL(x_g.num,'') as X_G, IFNULL(x_b.num,'') as X_B,
IFNULL(xi_g.num,'') as XI_G, IFNULL(xi_b.num,'') as XI_B,
IFNULL(a1_g.num,'') as A1_G, IFNULL(a1_b.num,'') as A1_B
from atif_gs_admission.view_admission_form as af

/********** PN-1 **********/
left join ( select af.grade_id, 
	af.issuance_date, af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=1 and af.gender='G'
	group by af.issuance_date, af.grade_id ) as pn_g
	on pn_g.grade_id=1 and pn_g.issuance_date = af.issuance_date
	
left join (select af.grade_id, 
	af.issuance_date,	af.gender, COUNT(af.gender) as num
	from atif_gs_admission.view_admission_form as af
	where af.grade_id=1 and af.gender='B'
	group by af.issuance_date, af.grade_id) as pn_b
	on pn_b.grade_id=1 and pn_b.issuance_date = af.issuance_date

/********** N-2 **********/
left join (select af.grade_id, 
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
	on n_b.grade_id=2 and n_b.issuance_date = af.issuance_date

/********** KG-3 **********/
left join (select af.grade_id, 
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
	on kg_b.grade_id=3 and kg_b.issuance_date = af.issuance_date
	
/********** I-4 **********/
left join (select af.grade_id, 
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
	on i_b.grade_id=4 and i_b.issuance_date = af.issuance_date
	
/********** II-5 **********/
left join (select af.grade_id, 
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
	on ii_b.grade_id=5 and ii_b.issuance_date = af.issuance_date
	
/********** III-6 **********/
left join (select af.grade_id, 
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
	on iii_b.grade_id=6 and iii_b.issuance_date = af.issuance_date
	
/********** IV-7 **********/
left join (select af.grade_id, 
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
	on iv_b.grade_id=7 and iv_b.issuance_date = af.issuance_date
	
/********** V-8 **********/
left join (select af.grade_id, 
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
	on v_b.grade_id=8 and v_b.issuance_date = af.issuance_date

/********** VI-9 **********/
left join (select af.grade_id, 
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
	on vi_b.grade_id=9 and vi_b.issuance_date = af.issuance_date
	
/********** VII-10 **********/
left join (select af.grade_id, 
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
	on vii_b.grade_id=10 and vii_b.issuance_date = af.issuance_date

/********** VIII-11 **********/
left join (select af.grade_id, 
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
	on viii_b.grade_id=11 and viii_b.issuance_date = af.issuance_date

/********** IX-12 **********/
left join (select af.grade_id, 
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
	on ix_b.grade_id=12 and ix_b.issuance_date = af.issuance_date

/********** X-13 **********/
left join (select af.grade_id, 
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
	on x_b.grade_id=13 and x_b.issuance_date = af.issuance_date
	
/********** XI-14 **********/
left join (select af.grade_id, 
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
	on xi_b.grade_id=14 and xi_b.issuance_date = af.issuance_date
/********** A1-15 **********/
left join (select af.grade_id, 
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
	on a1_b.grade_id=15 and a1_b.issuance_date = af.issuance_date
) AS DATA

/*where issuance_date >= '2017-01-05' and issuance_date <= '2017-01-06'*/ group by issuance_date";


$query = "select
af.*,
sum(if(af.grade_id=17 and af.gender = 'G', 1, 0)) as PG_G, sum(if(af.grade_id=17 and af.gender = 'B', 1, 0)) as PG_B,
sum(if(af.grade_id=1 and af.gender = 'G', 1, 0)) as PN_G, sum(if(af.grade_id=1 and af.gender = 'B', 1, 0)) as PN_B,
sum(if(af.grade_id=2 and af.gender = 'G', 1, 0)) as N_G, sum(if(af.grade_id=2 and af.gender = 'B', 1, 0)) as N_B,
sum(if(af.grade_id=3 and af.gender = 'G', 1, 0)) as KG_G, sum(if(af.grade_id=3 and af.gender = 'B', 1, 0)) as KG_B,

sum(if(af.grade_id=4 and af.gender = 'G', 1, 0)) as I_G, sum(if(af.grade_id=4 and af.gender = 'B', 1, 0)) as I_B,
sum(if(af.grade_id=5 and af.gender = 'G', 1, 0)) as II_G, sum(if(af.grade_id=5 and af.gender = 'B', 1, 0)) as II_B,

sum(if(af.grade_id=6 and af.gender = 'G', 1, 0)) as III_G, sum(if(af.grade_id=6 and af.gender = 'B', 1, 0)) as III_B,
sum(if(af.grade_id=7 and af.gender = 'G', 1, 0)) as IV_G, sum(if(af.grade_id=7 and af.gender = 'B', 1, 0)) as IV_B,
sum(if(af.grade_id=8 and af.gender = 'G', 1, 0)) as V_G, sum(if(af.grade_id=8 and af.gender = 'B', 1, 0)) as V_B,
sum(if(af.grade_id=9 and af.gender = 'G', 1, 0)) as VI_G, sum(if(af.grade_id=9 and af.gender = 'B', 1, 0)) as VI_B,

sum(if(af.grade_id=10 and af.gender = 'G', 1, 0)) as VII_G, sum(if(af.grade_id=10 and af.gender = 'B', 1, 0)) as VII_B,
sum(if(af.grade_id=11 and af.gender = 'G', 1, 0)) as VIII_G, sum(if(af.grade_id=11 and af.gender = 'B', 1, 0)) as VIII_B,
sum(if(af.grade_id=12 and af.gender = 'G', 1, 0)) as IX_G, sum(if(af.grade_id=12 and af.gender = 'B', 1, 0)) as IX_B,

sum(if(af.grade_id=13 and af.gender = 'G', 1, 0)) as X_G, sum(if(af.grade_id=13 and af.gender = 'B', 1, 0)) as X_B,
sum(if(af.grade_id=14 and af.gender = 'G', 1, 0)) as XI_G, sum(if(af.grade_id=14 and af.gender = 'B', 1, 0)) as XI_B,

sum(if(af.grade_id=15 and af.gender = 'G', 1, 0)) as A1_G, sum(if(af.grade_id=15 and af.gender = 'B', 1, 0)) as A1_B,
sum(if(af.grade_id=16 and af.gender = 'G', 1, 0)) as A2_G, sum(if(af.grade_id=16 and af.gender = 'B', 1, 0)) as A2_B




from
(select
	DATE_FORMAT(FROM_UNIXTIME(`af`.`created`),'%Y-%m-%d') as issuance_date,
	af.grade_id, af.gender
	
	from atif_gs_admission.admission_form as af
	left join atif._grade as gg
	on gg.id = af.grade_id
) as af

group by af.issuance_date";

		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			return $results;
		}else{ return FALSE; }
	}
	
	
	public function buildQuery( $query ){
		$this->ddb = $this->load->database('gs_admission',TRUE);
		$result = $this->ddb->query( $query );
		if( $result->num_rows() > 0 ){
			$results = $result->result_array();
			$field_array = $result->list_fields();
			$re = array("row"=>$results, "fields" => $field_array);
			return $re;
		}else{ return FALSE; }
	}
	
	
	
	public function submission(){
			$this->ddb = $this->load->database('gs_admission',TRUE);
			
			$query = "SELECT *
FROM
(select
af.issuance_date,
IFNULL(pn_g.num,'') as PN_G, IFNULL(pn_b.num,'') as PN_B, IFNULL(sub_pn_g.num,'') as SUB_PN_G, IFNULL(sub_pn_b.num,'') as SUB_PN_B,
IFNULL(n_g.num,'') as N_G, IFNULL(n_b.num,'') as N_B, IFNULL(sub_n_g.num,'') as SUB_N_G, IFNULL(sub_n_b.num,'') as SUB_N_B,
IFNULL(kg_g.num,'') as KG_G, IFNULL(kg_b.num,'') as KG_B, IFNULL(sub_kg_g.num,'') as SUB_KG_G, IFNULL(sub_kg_b.num,'') as SUB_KG_B,
IFNULL(i_g.num,'') as I_G, IFNULL(i_b.num,'') as I_B, IFNULL(sub_i_g.num,'') as SUB_I_G, IFNULL(sub_i_b.num,'') as SUB_I_B,
IFNULL(ii_g.num,'') as II_G, IFNULL(ii_b.num,'') as II_B, IFNULL(sub_ii_g.num,'') as SUB_II_G, IFNULL(sub_ii_b.num,'') as SUB_II_B,
IFNULL(iii_g.num,'') as III_G, IFNULL(iii_b.num,'') as III_B, IFNULL(sub_iii_g.num,'') as SUB_III_G, IFNULL(sub_iii_b.num,'') as SUB_III_B,
IFNULL(iv_g.num,'') as IV_G, IFNULL(iv_b.num,'') as IV_B, IFNULL(sub_iv_g.num,'') as SUB_IV_G, IFNULL(sub_iv_b.num,'') as SUB_IV_B,
IFNULL(v_g.num,'') as V_G, IFNULL(v_b.num,'') as V_B, IFNULL(sub_v_g.num,'') as SUB_V_G, IFNULL(sub_v_b.num,'') as SUB_V_B,
IFNULL(vi_g.num,'') as VI_G, IFNULL(vi_b.num,'') as VI_B, IFNULL(sub_vi_g.num,'') as SUB_VI_G, IFNULL(sub_vi_b.num,'') as SUB_VI_B,
IFNULL(vii_g.num,'') as VII_G, IFNULL(vii_b.num,'') as VII_B, IFNULL(sub_vii_g.num,'') as SUB_VII_G, IFNULL(sub_vii_b.num,'') as SUB_VII_B,
IFNULL(viii_g.num,'') as VIII_G, IFNULL(viii_b.num,'') as VIII_B,
IFNULL(ix_g.num,'') as IX_G, IFNULL(ix_b.num,'') as IX_B,
IFNULL(x_g.num,'') as X_G, IFNULL(x_b.num,'') as X_B,
IFNULL(xi_g.num,'') as XI_G, IFNULL(xi_b.num,'') as XI_B,
IFNULL(a1_g.num,'') as A1_G, IFNULL(a1_b.num,'') as A1_B

from atif_gs_admission.view_admission_form as af
/********** PN-1 **********/
left join (select af.grade_id, 
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
	on pn_b.grade_id=1 and pn_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=1 and af.gender='G'
	group by af.issuance_date) as sub_pn_g
	on sub_pn_g.grade_id=1 and sub_pn_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=1 and af.gender='B'
	group by af.issuance_date) as sub_pn_b
	on sub_pn_b.grade_id=1 and sub_pn_b.issuance_date = af.issuance_date

/********** N-2 **********/
left join (select af.grade_id, 
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
	on n_b.grade_id=2 and n_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=2 and af.gender='G'
	group by af.issuance_date) as sub_n_g
	on sub_n_g.grade_id=2 and sub_n_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=2 and af.gender='B'
	group by af.issuance_date) as sub_n_b
	on sub_n_b.grade_id=2 and sub_n_b.issuance_date = af.issuance_date

/********** KG-3 **********/
left join (select af.grade_id, 
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
	on kg_b.grade_id=3 and kg_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=3 and af.gender='G'
	group by af.issuance_date) as sub_kg_g
	on sub_kg_g.grade_id=3 and sub_kg_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=3 and af.gender='B'
	group by af.issuance_date) as sub_kg_b
	on sub_kg_b.grade_id=3 and sub_kg_b.issuance_date = af.issuance_date
	
/********** I-4 **********/
left join (select af.grade_id, 
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
	on i_b.grade_id=4 and i_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=4 and af.gender='G'
	group by af.issuance_date) as sub_i_g
	on sub_i_g.grade_id=4 and sub_i_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=4 and af.gender='B'
	group by af.issuance_date) as sub_i_b
	on sub_i_b.grade_id=4 and sub_i_b.issuance_date = af.issuance_date
	
/********** II-5 **********/
left join (select af.grade_id, 
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
	on ii_b.grade_id=5 and ii_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=5 and af.gender='G'
	group by af.issuance_date) as sub_ii_g
	on sub_ii_g.grade_id=5 and sub_ii_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=5 and af.gender='B'
	group by af.issuance_date) as sub_ii_b
	on sub_ii_b.grade_id=5 and sub_ii_b.issuance_date = af.issuance_date
	
/********** III-6 **********/
left join (select af.grade_id, 
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
	on iii_b.grade_id=6 and iii_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=6 and af.gender='G'
	group by af.issuance_date) as sub_iii_g
	on sub_iii_g.grade_id=6 and sub_iii_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=6 and af.gender='B'
	group by af.issuance_date) as sub_iii_b
	on sub_iii_b.grade_id=6 and sub_iii_b.issuance_date = af.issuance_date
	
/********** IV-7 **********/
left join (select af.grade_id, 
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
	on iv_b.grade_id=7 and iv_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=7 and af.gender='G'
	group by af.issuance_date) as sub_iv_g
	on sub_iv_g.grade_id=7 and sub_iv_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=7 and af.gender='B'
	group by af.issuance_date) as sub_iv_b
	on sub_iv_b.grade_id=7 and sub_iv_b.issuance_date = af.issuance_date
	
/********** V-8 **********/
left join (select af.grade_id, 
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
	on v_b.grade_id=8 and v_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=8 and af.gender='G'
	group by af.issuance_date) as sub_v_g
	on sub_v_g.grade_id=8 and sub_v_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=8 and af.gender='B'
	group by af.issuance_date) as sub_v_b
	on sub_v_b.grade_id=8 and sub_v_b.issuance_date = af.issuance_date

/********** VI-9 **********/
left join (select af.grade_id, 
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
	on vi_b.grade_id=9 and vi_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=9 and af.gender='G'
	group by af.issuance_date) as sub_vi_g
	on sub_vi_g.grade_id=9 and sub_vi_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=9 and af.gender='B'
	group by af.issuance_date) as sub_vi_b
	on sub_vi_b.grade_id=9 and sub_vi_b.issuance_date = af.issuance_date
	
/********** VII-10 **********/
left join (select af.grade_id, 
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
	on vii_b.grade_id=10 and vii_b.issuance_date = af.issuance_date
/* Submission */
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=10 and af.gender='G'
	group by af.issuance_date) as sub_vii_g
	on sub_vii_g.grade_id=10 and sub_vii_g.issuance_date = af.issuance_date
left join (select af.grade_id, af.issuance_date, count(*) as num
	from atif_gs_admission.view_admission_form as af
	where af.form_assessment_date > '2017-01-09' and af.grade_id=10 and af.gender='B'
	group by af.issuance_date) as sub_vii_b
	on sub_vii_b.grade_id=10 and sub_vii_b.issuance_date = af.issuance_date

/********** VIII-11 **********/
left join (select af.grade_id, 
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
	on viii_b.grade_id=11 and viii_b.issuance_date = af.issuance_date

/********** IX-12 **********/
left join (select af.grade_id, 
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
	on ix_b.grade_id=12 and ix_b.issuance_date = af.issuance_date

/********** X-13 **********/
left join (select af.grade_id, 
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
	on x_b.grade_id=13 and x_b.issuance_date = af.issuance_date
	
/********** XI-14 **********/
left join (select af.grade_id, 
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
	on xi_b.grade_id=14 and xi_b.issuance_date = af.issuance_date

/********** A1-15 **********/
left join (select af.grade_id, 
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
	on a1_b.grade_id=15 and a1_b.issuance_date = af.issuance_date
) AS DATA


group by issuance_date";
			
			
			$result = $this->ddb->query( $query );
			if( $result->num_rows() > 0 ){
				$results = $result->result_array();
				return $results;
			}else{ return FALSE; }
			
		}
		
}	