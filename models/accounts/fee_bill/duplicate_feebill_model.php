<?php
class Duplicate_feebill_model extends CI_Model{

	private $db_atif_fee;

	function __construct()
	{
		parent::__construct();
		$this->db_atif_fee = $this->load->database('fee_bill_db', TRUE);
	}


	protected $_table_name = 'fee_bill';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';	
	protected $_order_by = 'created desc';	
	protected $_timestamps = TRUE;
	
		
	public function getFeeBillOfGSID($GSID, $ASFrom, $ASTo){
		$query = "
		select
		student_id, gs_id, grade_id, section_id, abridged_name, call_name, gender, grade_name, section_name, wing_name, student_status_name, gf_id, father_name,
		`aug`, `sep`, `oct`, `nov`, `dec`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `bc_yearly`, `adv_tax`, `cie`,
		bill_cycle_no, billmonths, tax_payable,
		`fee_bf`, `fee_sfs`, `fee_rc`, `fee_mc`, `fee_yr`, `yearly`, `per_month_gross`, `per_month`, `bill_cycle_fee`,
		adjustment_amount, adjustment_id,
		total_ctc, total_cnb, total_cff, total_csp, total_crr, total_cot, total_discount,
		total_sac, total_sna, total_scholarship,
		total_south,
		`oc_smartcard_ids`, `oc_smartcard_charges`, `oc_magazine`, `title`, `issue_date`, `due_date`, `bank_validity_date`, `gb_id`,
		`feebill_months`, `feebill_paid_1`, `feebill_paid_2`, `feebill_paid_3`, `feebill_paid_4`, `feebill_paid_5`,
		gross_tuition_fee, feebill_discount, feebill_scholarship, min_resource_fee, additional_charges, 
		`total_current_billing`, `accumulated_current_billing`, `adv_tax_payable`,
		if(bill_cycle_no=1, adjustment_amount, (@previous_feebill-@previous_paid_feebill)) as billing_adjustment,
		@previous_feebill:=if(bill_cycle_no=1, total_current_billing+adjustment_amount+adv_tax_payable, (total_current_billing+(@previous_feebill-@previous_paid_feebill)+adv_tax_payable)) as feebill_payable,
		@previous_paid_feebill:=feebill_paid as feebill_paid, feebill_late_fee

		from
			(select
			student_id, gs_id, grade_id, section_id, abridged_name, call_name, gender, grade_name, section_name, wing_name, student_status_name, gf_id, father_name,
			`aug`, `sep`, `oct`, `nov`, `dec`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `bc_yearly`, `adv_tax`, `cie`,
			bill_cycle_no, billmonths, tax_payable,
			`fee_bf`, `fee_sfs`, `fee_rc`, `fee_mc`, `fee_yr`, `yearly`, `per_month_gross`, `per_month`, `bill_cycle_fee`,
			adjustment_amount, adjustment_id,
			total_ctc, total_cnb, total_cff, total_csp, total_crr, total_cot, total_discount,
			total_sac, total_sna, total_scholarship,
			total_south,
			`oc_smartcard_ids`, `oc_smartcard_charges`, `oc_magazine`, `title`, `issue_date`, `due_date`, `bank_validity_date`, `gb_id`,
			`feebill_months`, `feebill_paid_1`, `feebill_paid_2`, `feebill_paid_3`, `feebill_paid_4`, `feebill_paid_5`,
			gross_tuition_fee, feebill_discount, feebill_scholarship, min_resource_fee, additional_charges, 
			(gross_tuition_fee-feebill_discount-feebill_scholarship+min_resource_fee+additional_charges+oc_smartcard_charges+oc_magazine) as total_current_billing,
			if(bill_cycle_no=1, @accumulated_current_billing:=(gross_tuition_fee-feebill_discount-feebill_scholarship+min_resource_fee+additional_charges+oc_smartcard_charges+oc_magazine), @accumulated_current_billing:=ROUND(@accumulated_current_billing+(gross_tuition_fee-feebill_discount-feebill_scholarship+min_resource_fee+additional_charges+oc_smartcard_charges+oc_magazine),0)) as accumulated_current_billing,
			if(bill_cycle_no=5, if(@accumulated_current_billing>=200000, ROUND(@accumulated_current_billing*.05,0) ,0), 0) as adv_tax_payable, feebill_paid, feebill_late_fee

			from
				(select
				student_id, gs_id, grade_id, section_id, abridged_name, call_name, gender, grade_name, section_name, wing_name, student_status_name, gf_id, father_name,
				`aug`, `sep`, `oct`, `nov`, `dec`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `bc_yearly`, `adv_tax`, `cie`,
				bill_cycle_no, billmonths, tax_payable,
				`fee_bf`, `fee_sfs`, `fee_rc`, `fee_mc`, `fee_yr`, `yearly`, `per_month_gross`, `per_month`, `bill_cycle_fee`,
				adjustment_amount, adjustment_id,
				total_ctc, total_cnb, total_cff, total_csp, total_crr, total_cot, total_discount,
				total_sac, total_sna, total_scholarship,
				total_south,
				`oc_smartcard_ids`, `oc_smartcard_charges`, `oc_magazine`, `title`, `issue_date`, `due_date`, `bank_validity_date`, `gb_id`,
				`feebill_months`, `feebill_paid_1`, `feebill_paid_2`, `feebill_paid_3`, `feebill_paid_4`, `feebill_paid_5`,
				gross_tuition_fee, if(grade_id<15,ROUND((gross_tuition_fee*total_discount/100),0),ROUND(((fee_bf*billmonths)*total_discount/100),0)) as feebill_discount, ROUND(((fee_bf*billmonths)*total_scholarship/100),0) as feebill_scholarship, min_resource_fee, 
				(((fee_rc+fee_mc)*feebill_months)+fee_yr) as additional_charges, feebill_paid, feebill_late_fee

				from
					(select
					student_id, gs_id, grade_id, section_id, abridged_name, call_name, gender, grade_name, section_name, wing_name, student_status_name, gf_id, father_name,
					`aug`, `sep`, `oct`, `nov`, `dec`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `bc_yearly`, `adv_tax`, `cie`,
					bill_cycle_no, billmonths, tax_payable,
					`fee_bf`, `fee_sfs`, `fee_rc`, `fee_mc`, `fee_yr`, `yearly`, (`per_month_gross`-`total_south`) as `per_month_gross`, `per_month`, `bill_cycle_fee`,
					adjustment_amount, adjustment_id,
					total_ctc, total_cnb, total_cff, total_csp, total_crr, total_cot, (total_ctc+total_cnb+total_cff+total_csp+total_crr+total_cot) as total_discount, if((total_ctc+total_cnb+total_cff+total_csp+total_crr+total_cot)>=100, 500*feebill_months, 0) as min_resource_fee,
					total_sac, total_sna, (total_sac+total_sna) as total_scholarship,
					total_south,
					`oc_smartcard_ids`, `oc_smartcard_charges`, `oc_magazine`, `title`, `issue_date`, `due_date`, `bank_validity_date`, `gb_id`,
					`feebill_months`, `feebill_paid_1`, `feebill_paid_2`, `feebill_paid_3`, `feebill_paid_4`, `feebill_paid_5`,
					if(feebill_months<=billmonths, (`per_month_gross`-`total_south`)*feebill_months, (`per_month_gross`-`total_south`)*billmonths) as gross_tuition_fee, feebill_paid, feebill_late_fee


					from
						(select
							student_id, gs_id, grade_id, section_id, abridged_name, call_name, gender, grade_name, section_name, wing_name, student_status_name, gf_id, father_name,
							`aug`, `sep`, `oct`, `nov`, `dec`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `bc_yearly`, `adv_tax`, `cie`,
							bill_cycle_no, billmonths, tax_payable,
							`fee_bf`, `fee_sfs`, `fee_rc`, `fee_mc`, `fee_yr`, `yearly`, `per_month_gross`, `per_month`, `bill_cycle_fee`,
							adjustment_amount, adjustment_id,
							ROUND(((`ctc_aug`+`ctc_sep`+`ctc_oct`+`ctc_nov`+`ctc_dec`+`ctc_jan`+`ctc_feb`+`ctc_mar`+`ctc_apr`+`ctc_may`+`ctc_jun`+`ctc_jul`)/billmonths),0) as total_ctc,
							ROUND(((`cnb_aug`+`cnb_sep`+`cnb_oct`+`cnb_nov`+`cnb_dec`+`cnb_jan`+`cnb_feb`+`cnb_mar`+`cnb_apr`+`cnb_may`+`cnb_jun`+`cnb_jul`)/billmonths),0) as total_cnb,
							ROUND(((`cff_aug`+`cff_sep`+`cff_oct`+`cff_nov`+`cff_dec`+`cff_jan`+`cff_feb`+`cff_mar`+`cff_apr`+`cff_may`+`cff_jun`+`cff_jul`)/billmonths),0) as total_cff,
							ROUND(((`csp_aug`+`csp_sep`+`csp_oct`+`csp_nov`+`csp_dec`+`csp_jan`+`csp_feb`+`csp_mar`+`csp_apr`+`csp_may`+`csp_jun`+`csp_jul`)/billmonths),0) as total_csp,
							ROUND(((`crr_aug`+`crr_sep`+`crr_oct`+`crr_nov`+`crr_dec`+`crr_jan`+`crr_feb`+`crr_mar`+`crr_apr`+`crr_may`+`crr_jun`+`crr_jul`)/billmonths),0) as total_crr,
							ROUND(((`cot_aug`+`cot_sep`+`cot_oct`+`cot_nov`+`cot_dec`+`cot_jan`+`cot_feb`+`cot_mar`+`cot_apr`+`cot_may`+`cot_jun`+`cot_jul`)/billmonths),0) as total_cot,
							ROUND(((sac_aug+sac_sep+sac_oct+sac_nov+sac_dec+sac_jan+sac_feb+sac_mar+sac_apr+sac_may+sac_jun+sac_jul)/billmonths),0) as total_sac,
							ROUND(((sna_aug+sna_sep+sna_oct+sna_nov+sna_dec+sna_jan+sna_feb+sna_mar+sna_apr+sna_may+sna_jun+sna_jul)/billmonths),0) as total_sna,
							ROUND(((south_aug+south_sep+south_oct+south_nov+south_dec+south_jan+south_feb+south_mar+south_apr+south_may+south_jun+south_jul)/billmonths),0) as total_south,
							`oc_smartcard_ids`, `oc_smartcard_charges`, `oc_magazine`, `title`, `issue_date`, `due_date`, `bank_validity_date`, `gb_id`,
							if(`feebill_months`=0, `billmonths`, `feebill_months`) as `feebill_months`, `feebill_paid_1`, `feebill_paid_2`, `feebill_paid_3`, `feebill_paid_4`, `feebill_paid_5`, IFNULL(`feebill_paid`,0) as `feebill_paid`, `feebill_late_fee`
						from
						(select
						/************************************************************************************************************
						** All fields
						*************************************************************************************************************/
						/* student, father information */
						cl.id as student_id, cl.gs_id, cl.grade_id, cl.section_id, cl.abridged_name, cl.call_name, cl.gender, cl.grade_name, cl.section_name, cl.wing_name, cl.student_status_name, 
						CONCAT(LEFT(LPAD(cl.gf_id,5,0), 2), '-', RIGHT(LPAD(cl.gf_id,5,0), 3)) as gf_id, father.name as father_name,


						/* bill cycle parameter */
						bm.`aug`, bm.`sep`, bm.`oct`, bm.`nov`, bm.`dec`, bm.`jan`, bm.`feb`, bm.`mar`, bm.`apr`, bm.`may`, bm.`jun`, bm.`jul`, bm.`yearly` as bc_yearly, bm.`adv_tax`, bm.`cie`,


						/* bill cycle difinition */
						bcd.bill_cycle_no,
						(if(bm.aug=bcd.bill_cycle_no,1,0) + if(bm.sep=bcd.bill_cycle_no,1,0) + if(bm.oct=bcd.bill_cycle_no,1,0) + if(bm.nov=bcd.bill_cycle_no,1,0) +
						 if(bm.`dec`=bcd.bill_cycle_no,1,0) + if(bm.jan=bcd.bill_cycle_no,1,0) + if(bm.feb=bcd.bill_cycle_no,1,0) + if(bm.mar=bcd.bill_cycle_no,1,0) +
						 if(bm.apr=bcd.bill_cycle_no,1,0) + if(bm.may=bcd.bill_cycle_no,1,0) + if(bm.jun=bcd.bill_cycle_no,1,0) + if(bm.jul=bcd.bill_cycle_no,1,0)
						) as billmonths,
						if(bm.adv_tax=bcd.bill_cycle_no, 'yes', NULL) as tax_payable,


						/*********************************************/
						/* fee structure *****************************/
						IFNULL(fldv_base.amount,0) as 'fee_bf', IFNULL(fldv_sfs.amount,0) as 'fee_sfs', IFNULL(fldv_resource.amount,0) as 'fee_rc', IFNULL(fldv_musakhar.amount,0) as 'fee_mc',
						if(bm.yearly=bcd.bill_cycle_no, fldv_yearly.amount, 0) as 'fee_yr', fldv_yearly.amount as yearly,
						/* fee structure --> per month fee */
						(IFNULL(fldv_base.amount,0)+IFNULL(fldv_sfs.amount,0)+IFNULL(fldv_resource.amount,0)+IFNULL(fldv_musakhar.amount,0)) as per_month,
						(IFNULL(fldv_base.amount,0)+IFNULL(fldv_sfs.amount,0)) as per_month_gross,		
						/* fee structure --> bill cycle fee */
						((IFNULL(fldv_base.amount,0)+IFNULL(fldv_sfs.amount,0)+IFNULL(fldv_resource.amount,0)+IFNULL(fldv_musakhar.amount,0))*		
						(if(bm.aug=bcd.bill_cycle_no,1,0) + if(bm.sep=bcd.bill_cycle_no,1,0) + if(bm.oct=bcd.bill_cycle_no,1,0) + if(bm.nov=bcd.bill_cycle_no,1,0) +
						 if(bm.`dec`=bcd.bill_cycle_no,1,0) + if(bm.jan=bcd.bill_cycle_no,1,0) + if(bm.feb=bcd.bill_cycle_no,1,0) + if(bm.mar=bcd.bill_cycle_no,1,0) +
						 if(bm.apr=bcd.bill_cycle_no,1,0) + if(bm.may=bcd.bill_cycle_no,1,0) + if(bm.jun=bcd.bill_cycle_no,1,0) + if(bm.jul=bcd.bill_cycle_no,1,0)
						))+	if(bm.yearly=bcd.bill_cycle_no, fldv_yearly.amount, 0) as bill_cycle_fee,


						/* arrears and advance */
						IF(bcd.bill_cycle_no = 1, IFNULL(aa.amount,0), 0) as adjustment_amount,
						IF(bcd.bill_cycle_no = 1, aa.id, NULL) as adjustment_id,


						/*********************************************/
						/* concession types **************************/
						/* 1- Teacher Child */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(con_teacher_child.ctc_aug,0), 0) as ctc_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(con_teacher_child.ctc_sep,0), 0) as ctc_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(con_teacher_child.ctc_oct,0), 0) as ctc_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(con_teacher_child.ctc_nov,0), 0) as ctc_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(con_teacher_child.ctc_dec,0), 0) as ctc_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(con_teacher_child.ctc_jan,0), 0) as ctc_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(con_teacher_child.ctc_feb,0), 0) as ctc_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(con_teacher_child.ctc_mar,0), 0) as ctc_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(con_teacher_child.ctc_apr,0), 0) as ctc_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(con_teacher_child.ctc_may,0), 0) as ctc_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(con_teacher_child.ctc_jun,0), 0) as ctc_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(con_teacher_child.ctc_jul,0), 0) as ctc_jul,
						/* 2- Need Basis */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(con_need_basis.cnb_aug,0), 0) as cnb_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(con_need_basis.cnb_sep,0), 0) as cnb_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(con_need_basis.cnb_oct,0), 0) as cnb_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(con_need_basis.cnb_nov,0), 0) as cnb_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(con_need_basis.cnb_dec,0), 0) as cnb_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(con_need_basis.cnb_jan,0), 0) as cnb_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(con_need_basis.cnb_feb,0), 0) as cnb_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(con_need_basis.cnb_mar,0), 0) as cnb_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(con_need_basis.cnb_apr,0), 0) as cnb_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(con_need_basis.cnb_may,0), 0) as cnb_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(con_need_basis.cnb_jun,0), 0) as cnb_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(con_need_basis.cnb_jul,0), 0) as cnb_jul,
						/* 3- Friends n Family */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(con_fnf.cff_aug,0), 0) as cff_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(con_fnf.cff_sep,0), 0) as cff_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(con_fnf.cff_oct,0), 0) as cff_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(con_fnf.cff_nov,0), 0) as cff_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(con_fnf.cff_dec,0), 0) as cff_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(con_fnf.cff_jan,0), 0) as cff_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(con_fnf.cff_feb,0), 0) as cff_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(con_fnf.cff_mar,0), 0) as cff_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(con_fnf.cff_apr,0), 0) as cff_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(con_fnf.cff_may,0), 0) as cff_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(con_fnf.cff_jun,0), 0) as cff_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(con_fnf.cff_jul,0), 0) as cff_jul,
						/* 4- Single Parent */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(con_single_parent.csp_aug,0), 0) as csp_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(con_single_parent.csp_sep,0), 0) as csp_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(con_single_parent.csp_oct,0), 0) as csp_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(con_single_parent.csp_nov,0), 0) as csp_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(con_single_parent.csp_dec,0), 0) as csp_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(con_single_parent.csp_jan,0), 0) as csp_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(con_single_parent.csp_feb,0), 0) as csp_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(con_single_parent.csp_mar,0), 0) as csp_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(con_single_parent.csp_apr,0), 0) as csp_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(con_single_parent.csp_may,0), 0) as csp_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(con_single_parent.csp_jun,0), 0) as csp_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(con_single_parent.csp_jul,0), 0) as csp_jul,
						/* 5- Resourceful Person */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(con_resourceful.crr_aug,0), 0) as crr_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(con_resourceful.crr_sep,0), 0) as crr_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(con_resourceful.crr_oct,0), 0) as crr_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(con_resourceful.crr_nov,0), 0) as crr_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(con_resourceful.crr_dec,0), 0) as crr_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(con_resourceful.crr_jan,0), 0) as crr_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(con_resourceful.crr_feb,0), 0) as crr_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(con_resourceful.crr_mar,0), 0) as crr_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(con_resourceful.crr_apr,0), 0) as crr_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(con_resourceful.crr_may,0), 0) as crr_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(con_resourceful.crr_jun,0), 0) as crr_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(con_resourceful.crr_jul,0), 0) as crr_jul,
						/* 6- Other */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(con_other.cot_aug,0), 0) as cot_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(con_other.cot_sep,0), 0) as cot_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(con_other.cot_oct,0), 0) as cot_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(con_other.cot_nov,0), 0) as cot_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(con_other.cot_dec,0), 0) as cot_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(con_other.cot_jan,0), 0) as cot_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(con_other.cot_feb,0), 0) as cot_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(con_other.cot_mar,0), 0) as cot_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(con_other.cot_apr,0), 0) as cot_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(con_other.cot_may,0), 0) as cot_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(con_other.cot_jun,0), 0) as cot_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(con_other.cot_jul,0), 0) as cot_jul,
						/* 7- Scholarship - Academic */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(sch_academic.sac_aug,0), 0) as sac_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(sch_academic.sac_sep,0), 0) as sac_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(sch_academic.sac_oct,0), 0) as sac_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(sch_academic.sac_nov,0), 0) as sac_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(sch_academic.sac_dec,0), 0) as sac_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(sch_academic.sac_jan,0), 0) as sac_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(sch_academic.sac_feb,0), 0) as sac_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(sch_academic.sac_mar,0), 0) as sac_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(sch_academic.sac_apr,0), 0) as sac_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(sch_academic.sac_may,0), 0) as sac_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(sch_academic.sac_jun,0), 0) as sac_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(sch_academic.sac_jul,0), 0) as sac_jul,
						/* 8- Scholarship - NON Academic */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(sch_non_academic.sna_aug,0), 0) as sna_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(sch_non_academic.sna_sep,0), 0) as sna_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(sch_non_academic.sna_oct,0), 0) as sna_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(sch_non_academic.sna_nov,0), 0) as sna_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(sch_non_academic.sna_dec,0), 0) as sna_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(sch_non_academic.sna_jan,0), 0) as sna_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(sch_non_academic.sna_feb,0), 0) as sna_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(sch_non_academic.sna_mar,0), 0) as sna_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(sch_non_academic.sna_apr,0), 0) as sna_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(sch_non_academic.sna_may,0), 0) as sna_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(sch_non_academic.sna_jun,0), 0) as sna_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(sch_non_academic.sna_jul,0), 0) as sna_jul,
						/* 9- South Campus Discount */
						IF(bcd.bill_cycle_no=bm.aug, ifnull(south_ebd.south_aug,0), 0) as south_aug,
						IF(bcd.bill_cycle_no=bm.sep, ifnull(south_ebd.south_sep,0), 0) as south_sep,
						IF(bcd.bill_cycle_no=bm.oct, ifnull(south_ebd.south_oct,0), 0) as south_oct,
						IF(bcd.bill_cycle_no=bm.nov, ifnull(south_ebd.south_nov,0), 0) as south_nov,
						IF(bcd.bill_cycle_no=bm.dec, ifnull(south_ebd.south_dec,0), 0) as south_dec,
						IF(bcd.bill_cycle_no=bm.jan, ifnull(south_ebd.south_jan,0), 0) as south_jan,
						IF(bcd.bill_cycle_no=bm.feb, ifnull(south_ebd.south_feb,0), 0) as south_feb,
						IF(bcd.bill_cycle_no=bm.mar, ifnull(south_ebd.south_mar,0), 0) as south_mar,
						IF(bcd.bill_cycle_no=bm.apr, ifnull(south_ebd.south_apr,0), 0) as south_apr,
						IF(bcd.bill_cycle_no=bm.may, ifnull(south_ebd.south_may,0), 0) as south_may,
						IF(bcd.bill_cycle_no=bm.jun, ifnull(south_ebd.south_jun,0), 0) as south_jun,
						IF(bcd.bill_cycle_no=bm.jul, ifnull(south_ebd.south_jul,0), 0) as south_jul,


						/* bill cycle difinition --> Title, IssueDate, DueDate, BankValidityDate */
						if(bcd.bill_cycle_no=1, IFNULL(feebill_1.oc_smartcard_ids,0),
						if(bcd.bill_cycle_no=2, IFNULL(feebill_2.oc_smartcard_ids,0),
						if(bcd.bill_cycle_no=3, IFNULL(feebill_3.oc_smartcard_ids,0),
						if(bcd.bill_cycle_no=4, IFNULL(feebill_4.oc_smartcard_ids,0),
						if(bcd.bill_cycle_no=5, IFNULL(feebill_5.oc_smartcard_ids,0), 0 ))))) as oc_smartcard_ids,
						
						if(bcd.bill_cycle_no=1, IFNULL(feebill_1.oc_smartcard_charges,0),
						if(bcd.bill_cycle_no=2, IFNULL(feebill_2.oc_smartcard_charges,0),
						if(bcd.bill_cycle_no=3, IFNULL(feebill_3.oc_smartcard_charges,0),
						if(bcd.bill_cycle_no=4, IFNULL(feebill_4.oc_smartcard_charges,0),
						if(bcd.bill_cycle_no=5, IFNULL(feebill_5.oc_smartcard_charges,0), 0 ))))) as oc_smartcard_charges,

						if(bcd.bill_cycle_no=1, IFNULL(feebill_1.oc_magazine,0),
						if(bcd.bill_cycle_no=2, IFNULL(feebill_2.oc_magazine,0),
						if(bcd.bill_cycle_no=3, IFNULL(feebill_3.oc_magazine,0),
						if(bcd.bill_cycle_no=4, IFNULL(feebill_4.oc_magazine,0),
						if(bcd.bill_cycle_no=5, IFNULL(feebill_5.oc_magazine,0), 0 ))))) as oc_magazine,				

						if(bcd.bill_cycle_no=1, if(feebill_1.bill_title != bcd.title, feebill_1.bill_title, bcd.title),
						if(bcd.bill_cycle_no=2, if(feebill_2.bill_title != bcd.title, feebill_2.bill_title, bcd.title),
						if(bcd.bill_cycle_no=3, if(feebill_3.bill_title != bcd.title, feebill_3.bill_title, bcd.title),
						if(bcd.bill_cycle_no=4, if(feebill_4.bill_title != bcd.title, feebill_4.bill_title, bcd.title),
						if(bcd.bill_cycle_no=5, if(feebill_5.bill_title != bcd.title, feebill_5.bill_title, bcd.title),
						bcd.title))))) as title,

						if(bcd.bill_cycle_no=1, if(feebill_1.bill_issue_date != bcd.issue_date, feebill_1.bill_issue_date, bcd.issue_date),
						if(bcd.bill_cycle_no=2, if(feebill_2.bill_issue_date != bcd.issue_date, feebill_2.bill_issue_date, bcd.issue_date),
						if(bcd.bill_cycle_no=3, if(feebill_3.bill_issue_date != bcd.issue_date, feebill_3.bill_issue_date, bcd.issue_date),
						if(bcd.bill_cycle_no=4, if(feebill_4.bill_issue_date != bcd.issue_date, feebill_4.bill_issue_date, bcd.issue_date),
						if(bcd.bill_cycle_no=5, if(feebill_5.bill_issue_date != bcd.issue_date, feebill_5.bill_issue_date, bcd.issue_date),
						bcd.issue_date))))) as issue_date,

						if(bcd.bill_cycle_no=1, if(feebill_1.bill_due_date != bcd.due_date, feebill_1.bill_due_date, bcd.due_date),
						if(bcd.bill_cycle_no=2, if(feebill_2.bill_due_date != bcd.due_date, feebill_2.bill_due_date, bcd.due_date),
						if(bcd.bill_cycle_no=3, if(feebill_3.bill_due_date != bcd.due_date, feebill_3.bill_due_date, bcd.due_date),
						if(bcd.bill_cycle_no=4, if(feebill_4.bill_due_date != bcd.due_date, feebill_4.bill_due_date, bcd.due_date),
						if(bcd.bill_cycle_no=5, if(feebill_5.bill_due_date != bcd.due_date, feebill_5.bill_due_date, bcd.due_date),
						bcd.due_date))))) as due_date,

						if(bcd.bill_cycle_no=1, if(feebill_1.bill_bank_valid_date != bcd.bank_validity_date, feebill_1.bill_bank_valid_date, bcd.bank_validity_date),
						if(bcd.bill_cycle_no=2, if(feebill_2.bill_bank_valid_date != bcd.bank_validity_date, feebill_2.bill_bank_valid_date, bcd.bank_validity_date),
						if(bcd.bill_cycle_no=3, if(feebill_3.bill_bank_valid_date != bcd.bank_validity_date, feebill_3.bill_bank_valid_date, bcd.bank_validity_date),
						if(bcd.bill_cycle_no=4, if(feebill_4.bill_bank_valid_date != bcd.bank_validity_date, feebill_4.bill_bank_valid_date, bcd.bank_validity_date),
						if(bcd.bill_cycle_no=5, if(feebill_5.bill_bank_valid_date != bcd.bank_validity_date, feebill_5.bill_bank_valid_date, bcd.bank_validity_date),
						bcd.bank_validity_date))))) as bank_validity_date,

						if(bcd.bill_cycle_no=1, feebill_1.gb_id,
						if(bcd.bill_cycle_no=2, feebill_2.gb_id,
						if(bcd.bill_cycle_no=3, feebill_3.gb_id,
						if(bcd.bill_cycle_no=4, feebill_4.gb_id,
						if(bcd.bill_cycle_no=5, feebill_5.gb_id, ''))))) as gb_id,

						if(bcd.bill_cycle_no=1, IFNULL(feebill_1.bill_months,0),
							if(bcd.bill_cycle_no=1, IFNULL(feebill_2.bill_months,0),
								if(bcd.bill_cycle_no=1, IFNULL(feebill_3.bill_months,0),
									if(bcd.bill_cycle_no=1, IFNULL(feebill_4.bill_months,0),
										if(bcd.bill_cycle_no=1, IFNULL(feebill_5.bill_months,0), 0))))) as feebill_months,

						IFNULL(feebill_1.bill_received_amount,0) as feebill_paid_1,
						IFNULL(feebill_2.bill_received_amount,0) as feebill_paid_2,
						IFNULL(feebill_3.bill_received_amount,0) as feebill_paid_3,
						IFNULL(feebill_4.bill_received_amount,0) as feebill_paid_4,
						IFNULL(feebill_5.bill_received_amount,0) as feebill_paid_5,										

						if(bcd.bill_cycle_no=1, if(IFNULL(feebill_1.bill_received_amount,0)>0, if((IFNULL(feebill_1.bill_received_amount,0)-IFNULL(feebill_1.bill_payable,0))=0, IFNULL(feebill_1.bill_received_amount,0), IFNULL(feebill_1.bill_payable,0)), 0),
						if(bcd.bill_cycle_no=2, if(IFNULL(feebill_2.bill_received_amount,0)>0, if((IFNULL(feebill_2.bill_received_amount,0)-IFNULL(feebill_2.bill_payable,0))=0, IFNULL(feebill_2.bill_received_amount,0), IFNULL(feebill_2.bill_payable,0)), 0),
						if(bcd.bill_cycle_no=3, if(IFNULL(feebill_3.bill_received_amount,0)>0, if((IFNULL(feebill_3.bill_received_amount,0)-IFNULL(feebill_3.bill_payable,0))=0, IFNULL(feebill_3.bill_received_amount,0), IFNULL(feebill_3.bill_payable,0)), 0),
						if(bcd.bill_cycle_no=4, if(IFNULL(feebill_4.bill_received_amount,0)>0, if((IFNULL(feebill_4.bill_received_amount,0)-IFNULL(feebill_4.bill_payable,0))=0, IFNULL(feebill_4.bill_received_amount,0), IFNULL(feebill_4.bill_payable,0)), 0),
						if(bcd.bill_cycle_no=5, if(IFNULL(feebill_5.bill_received_amount,0)>0, if((IFNULL(feebill_5.bill_received_amount,0)-IFNULL(feebill_5.bill_payable,0))=0, IFNULL(feebill_5.bill_received_amount,0), IFNULL(feebill_5.bill_payable,0)), 0), 0))))) as feebill_paid,

						if(bcd.bill_cycle_no=1, if(IFNULL(feebill_1.bill_received_late_fee,0)>0, IFNULL(feebill_1.bill_received_late_fee,0), IF(IFNULL(feebill_1.bill_received_amount,0)>0, (IFNULL(feebill_1.bill_received_amount,0)-IFNULL(feebill_1.bill_payable,0)), 0)),
						if(bcd.bill_cycle_no=2, if(IFNULL(feebill_2.bill_received_late_fee,0)>0, IFNULL(feebill_2.bill_received_late_fee,0), IF(IFNULL(feebill_2.bill_received_amount,0)>0, (IFNULL(feebill_2.bill_received_amount,0)-IFNULL(feebill_2.bill_payable,0)), 0)),
						if(bcd.bill_cycle_no=3, if(IFNULL(feebill_3.bill_received_late_fee,0)>0, IFNULL(feebill_3.bill_received_late_fee,0), IF(IFNULL(feebill_3.bill_received_amount,0)>0, (IFNULL(feebill_3.bill_received_amount,0)-IFNULL(feebill_3.bill_payable,0)), 0)),
						if(bcd.bill_cycle_no=4, if(IFNULL(feebill_4.bill_received_late_fee,0)>0, IFNULL(feebill_4.bill_received_late_fee,0), IF(IFNULL(feebill_4.bill_received_amount,0)>0, (IFNULL(feebill_4.bill_received_amount,0)-IFNULL(feebill_4.bill_payable,0)), 0)),
						if(bcd.bill_cycle_no=5, if(IFNULL(feebill_5.bill_received_late_fee,0)>0, IFNULL(feebill_5.bill_received_late_fee,0), IF(IFNULL(feebill_5.bill_received_amount,0)>0, (IFNULL(feebill_5.bill_received_amount,0)-IFNULL(feebill_5.bill_payable,0)), 0)), 0))))) as feebill_late_fee



						/************************************************************************************************************
						** All fields from required tables
						*************************************************************************************************************/
						/* student, father information */
						from atif.class_list cl
						left join (select gf_id, name from atif.student_family_record where parent_type = 1) as father on father.gf_id = cl.gf_id

						/* bill cycle parameter */
						left join (SELECT grade_id, aug, sep, oct, nov, `dec`, jan, feb, mar, apr, may, jun, jul, yearly, adv_tax, cie
							FROM atif_fee.billing_cycle_parameter_view		
							WHERE record_deleted = 0 and academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo')
							as bm on bm.grade_id = cl.grade_id

						/* bill cycle difinition */
						left join (SELECT
							grade_id, grade_name, bill_cycle_no, title, issue_date, due_date, bank_validity_date
							FROM atif_fee.`billing_cycle_definition_view`
							where record_deleted = 0
							and academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo'
							order by grade_id asc, bill_cycle_no asc) as bcd on bcd.grade_id = cl.grade_id

						/* fee received in Bank */
						left join (SELECT id as fee_bill_id, gb_id,
									bill_cycle_id, bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id,
									total_payable as bill_payable, received_date as bill_received_date, received_amount as bill_received_amount,
									received_late_fee as bill_received_late_fee, received_payment_mode as bill_received_payment_mode,
									received_branch as bill_received_branch, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
									created as bill_recorded, modified as bill_reived_recorded
									FROM atif_fee.fee_bill
									where is_void=0 and record_deleted=0 and
										  bill_cycle_id = 1 and
										  academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo') as feebill_1 on feebill_1.student_id = cl.id

						left join (SELECT id as fee_bill_id, gb_id,
									bill_cycle_id, bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id,
									total_payable as bill_payable, received_date as bill_received_date, received_amount as bill_received_amount,
									received_late_fee as bill_received_late_fee, received_payment_mode as bill_received_payment_mode,
									received_branch as bill_received_branch, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
									created as bill_recorded, modified as bill_reived_recorded
									FROM atif_fee.fee_bill
									where is_void=0 and record_deleted=0 and
										  bill_cycle_id = 2 and
										  academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo') as feebill_2 on feebill_2.student_id = cl.id

						left join (SELECT id as fee_bill_id, gb_id,
									bill_cycle_id, bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id,
									total_payable as bill_payable, received_date as bill_received_date, received_amount as bill_received_amount,
									received_late_fee as bill_received_late_fee, received_payment_mode as bill_received_payment_mode,
									received_branch as bill_received_branch, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
									created as bill_recorded, modified as bill_reived_recorded
									FROM atif_fee.fee_bill
									where is_void=0 and record_deleted=0 and
										  bill_cycle_id = 3 and
										  academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo') as feebill_3 on feebill_3.student_id = cl.id

						left join (SELECT id as fee_bill_id, gb_id,
									bill_cycle_id, bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id,
									total_payable as bill_payable, received_date as bill_received_date, received_amount as bill_received_amount,
									received_late_fee as bill_received_late_fee, received_payment_mode as bill_received_payment_mode,
									received_branch as bill_received_branch, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
									created as bill_recorded, modified as bill_reived_recorded
									FROM atif_fee.fee_bill
									where is_void=0 and record_deleted=0 and
										  bill_cycle_id = 4 and
										  academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo') as feebill_4 on feebill_4.student_id = cl.id

						left join (SELECT id as fee_bill_id, gb_id,
									bill_cycle_id, bill_title, bill_issue_date, bill_due_date, bill_bank_valid_date, bill_months, student_id,
									total_payable as bill_payable, received_date as bill_received_date, received_amount as bill_received_amount,
									received_late_fee as bill_received_late_fee, received_payment_mode as bill_received_payment_mode,
									received_branch as bill_received_branch, oc_smartcard_charges, oc_smartcard_ids, oc_magazine,
									created as bill_recorded, modified as bill_reived_recorded
									FROM atif_fee.fee_bill
									where is_void=0 and record_deleted=0 and
										  bill_cycle_id = 5 and
										  academic_session_id >= '$ASFrom' and academic_session_id <= '$ASTo') as feebill_5 on feebill_5.student_id = cl.id

						/* arrears and advance */
						left join (select id, student_id, amount, description
									FROM atif_fee.arrears_and_advance where amount != 0 and record_deleted = 0) as aa on aa.student_id = cl.id


						/* fee structure */
						left join (select id, grade_id, fee_type_id, amount, fee_type_name, fee_type_category, fee_type_name_code, fee_type_order
								   from atif_fee.fee_level_definition_view where fee_type_id = 1) as fldv_base on fldv_base.grade_id = cl.grade_id
						left join (select id, grade_id, fee_type_id, amount, fee_type_name, fee_type_category, fee_type_name_code, fee_type_order
								   from atif_fee.fee_level_definition_view where fee_type_id = 2) as fldv_sfs on fldv_sfs.grade_id = cl.grade_id
						left join (select id, grade_id, fee_type_id, amount, fee_type_name, fee_type_category, fee_type_name_code, fee_type_order
								   from atif_fee.fee_level_definition_view where fee_type_id = 3) as fldv_resource on fldv_resource.grade_id = cl.grade_id
						left join (select id, grade_id, fee_type_id, amount, fee_type_name, fee_type_category, fee_type_name_code, fee_type_order
								   from atif_fee.fee_level_definition_view where fee_type_id = 4) as fldv_musakhar on fldv_musakhar.grade_id = cl.grade_id
						left join (select id, grade_id, fee_type_id, amount, fee_type_name, fee_type_category, fee_type_name_code, fee_type_order
								   from atif_fee.fee_level_definition_view where fee_type_id = 5) as fldv_yearly on fldv_yearly.grade_id = cl.grade_id


						/* concession types */
						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as ctc_aug, sep as ctc_sep, oct as ctc_oct, nov as ctc_nov, `dec` as ctc_dec, 
									jan as ctc_jan, feb as ctc_feb, mar as ctc_mar, apr as ctc_apr, may as ctc_may, jun as ctc_jun, jul as ctc_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 1 group by student_id order by id desc) as con_teacher_child on con_teacher_child.student_id = cl.id

						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as cnb_aug, sep as cnb_sep, oct as cnb_oct, nov as cnb_nov, `dec` as cnb_dec, 
									jan as cnb_jan, feb as cnb_feb, mar as cnb_mar, apr as cnb_apr, may as cnb_may, jun as cnb_jun, jul as cnb_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 2 group by student_id order by id desc) as con_need_basis on con_need_basis.student_id = cl.id

						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as cff_aug, sep as cff_sep, oct as cff_oct, nov as cff_nov, `dec` as cff_dec,
									jan as cff_jan, feb as cff_feb, mar as cff_mar, apr as cff_apr, may as cff_may, jun as cff_jun, jul as cff_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 3 group by student_id order by id desc) as con_fnf on con_fnf.student_id = cl.id

						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as csp_aug, sep as csp_sep, oct as csp_oct, nov as csp_nov, `dec` as csp_dec, 
									jan as csp_jan, feb as csp_feb, mar as csp_mar, apr as csp_apr, may as csp_may, jun as csp_jun, jul as csp_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 4 group by student_id order by id desc) as con_single_parent on con_single_parent.student_id = cl.id

						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as crr_aug, sep as crr_sep, oct as crr_oct, nov as crr_nov, `dec` as crr_dec, 
									jan as crr_jan, feb as crr_feb, mar as crr_mar, apr as crr_apr, may as crr_may, jun as crr_jun, jul as crr_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 5 group by student_id order by id desc) as con_resourceful on con_resourceful.student_id = cl.id

						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as cot_aug, sep as cot_sep, oct as cot_oct, nov as cot_nov, `dec` as cot_dec, 
									jan as cot_jan, feb as cot_feb, mar as cot_mar, apr as cot_apr, may as cot_may, jun as cot_jun, jul as cot_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 6 group by student_id order by id desc) as con_other on con_other.student_id = cl.id


						/* scholarship types */
						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as sac_aug, sep as sac_sep, oct as sac_oct, nov as sac_nov, `dec` as sac_dec, 
									jan as sac_jan, feb as sac_feb, mar as sac_mar, apr as sac_apr, may as sac_may, jun as sac_jun, jul as sac_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 7 group by student_id order by id desc) as sch_academic on sch_academic.student_id = cl.id

						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as sna_aug, sep as sna_sep, oct as sna_oct, nov as sna_nov, `dec` as sna_dec, 
									jan as sna_jan, feb as sna_feb, mar as sna_mar, apr as sna_apr, may as sna_may, jun as sna_jun, jul as sna_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 8 group by student_id order by id desc) as sch_non_academic on sch_non_academic.student_id = cl.id

						/* south campus earlybird discount */
						left join (select student_id, concession_dname, concession_name_code, percentage as c_percentage, amount as c_amount,
									aug as south_aug, sep as south_sep, oct as south_oct, nov as south_nov, `dec` as south_dec, 
									jan as south_jan, feb as south_feb, mar as south_mar, apr as south_apr, may as south_may, jun as south_jun, jul as south_jul
									FROM atif_fee.`concession_level_definition_view` where concession_type_id = 9 group by student_id order by id desc) as south_ebd on south_ebd.student_id = cl.id




						/************************************************************************************************************
						** Applying fields conditions
						*************************************************************************************************************/
						where
							cl.gs_id = '$GSID' and
							cl.student_status_name != 'withdrawal'

						order by cl.grade_id,
								 cl.section_id,
								 cl.call_name,
								 bcd.bill_cycle_no
						)as fee_bill_pixels
					)as fee_bill_data
				)as fee_bill_file
			)as fee_bill
			 /* supporting variables */
			 JOIN (SELECT @accumulated_current_billing := 0) current_billing
		)as fee_bill_booked
		 /* supporting variables */
		 JOIN (SELECT @previous_feebill := 0) pfbill
		 JOIN (SELECT @previous_paid_feebill :=0) ppfbill;
		";

		$sql = $this->db_atif_fee->query($query);		
		return $sql->result();
	}


	public function get($id = NULL, $single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_fee->where($this->_primary_key, $id);			
			$method = 'row';
		}
		elseif($single == TRUE) {
			$method = 'row';
		}
		else{
			$method = 'result';
		}

		$this->db_atif_fee->where('record_deleted', 0);
		if(!count($this->db_atif_fee->ar_orderby)){
			$this->db_atif_fee->order_by($this->_order_by);
		}
		return $this->db_atif_fee->get($this->_table_name)->$method();
	}

	public function get_by($where, $single = FALSE){
		$this->db_atif_fee->where($where);
		return $this->get(NULL, $single);
	}

	public function save($data, $id = NULL){

		// Set timestamps
		if($this->_timestamps == TRUE){
			$now = date('Y-m-d H:i:s');
			$id || $data['created'] = human_to_unix($now);
			$id || $data['register_by'] = (int)$this->session->userdata['user_id'];
			$data['modified'] = human_to_unix($now);
			$data['modified_by'] = (int)$this->session->userdata['user_id'];
		}

		// Insert a new record
		if ($id === NULL){
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db_atif_fee->set($data);
			$this->db_atif_fee->insert($this->_table_name);
			$id = $this->db_atif_fee->insert_id();
		}
		// Update a record
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db_atif_fee->set($data);
			$this->db_atif_fee->where($this->_primary_key, $id);
			$this->db_atif_fee->update($this->_table_name);
		}

		return $id;
	}

	public function delete(){
		$filter = $this->_primary_filter;
		$id = $fileter($id);

		if(!$id){
			return FALSE;
		}

		$this->db_atif_fee->where($this->_primary_key, $id);
		$this->db_atif_fee->limit(1);
		$this->db_atif_fee->delete($this->_table_name);
	}
}