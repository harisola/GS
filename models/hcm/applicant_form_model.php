<?php
class Applicant_form_model extends MY_Model{	
	protected $_table_name = 'hcm_staffing_applicantform';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'id desc';
	public $rules = array();
	protected $_timestamps = TRUE;	

	public function __construct()
	{
		parent::__construct();
		$this->db_career = $this->load->database('default',TRUE);
	}

	public $validation = array(
		array('field' => 'applicant_name', 'label' => '', 'rules' => 'trim|sanitize|required'),
		array('field' => 'gender', 'label' => '', 'rules' => 'trim|sanitize|required'),
		array('field' => 'cnic', 'label' => '', 'rules' => 'trim|sanitize|required|min_length[15]|max_length[15]|is_unique[hcm_staffing_applicantform.nic]'),
		array('field' => 'mobilephonereq', 'label' => '', 'rules' => 'trim|sanitize|required'),
		array('field' => 'landline', 'label' => '', 'rules' => 'trim|sanitize'),		
		array('field' => 'user_id', 'label' => '', 'rules' => 'intval')
	);



	public function getAllApplicantForms(){
		$query =
		"select
			c.gc_id, h.*
			from atif.hcm_staffing_applicantform as h
			left join (SELECT * from
				(select career.* from
				atif_career.career as career
				inner join
					(select
					max(c.id) as id
					from atif_career.career as c
					group by c.nic) as c
					on c.id = career.id) as career)
				as c
				on c.nic = h.nic
			order by id desc";

		$sql = $this->db_career->query($query);
		return $sql->result();
	}


	public function getAllApplicantForms_From($Created){
		$query =
		"select
			c.gc_id, h.*
			from atif.hcm_staffing_applicantform as h
			left join (SELECT * from
				(select career.* from
				atif_career.career as career
				inner join
					(select
					max(c.id) as id
					from atif_career.career as c
					where c.created >= '$Created'
					group by c.nic) as c
					on c.id = career.id) as career)
				as c
				on c.nic = h.nic
			where h.created >= '$Created'
			order by id desc";

		$sql = $this->db_career->query($query);
		return $sql->result();
	}
}