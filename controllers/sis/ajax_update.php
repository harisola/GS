<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_update extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function replace_index()
	{
		$this->load->model('sis/ajax_post_changes_model','FSIM');
		$NIC_Num = $this->input->post('NIC_Num');
		$fif_gfid = $this->input->post('fif_gfid');
		
		/*
		$fif_gfid = (int)str_replace('-','', $fif_gfid);
		$now = date('Y-m-d H:i:s');

		$data = array(
			"tax_nic" =>  $NIC_Num,
			"modified"=>  human_to_unix($now),
			"modified_by"=> (int)$this->session->userdata['user_id']
		);$where = array ("gf_id" => $fif_gfid );*/


		$data = array( "tax_nic" =>  $NIC_Num );
		$where = array ("id" => $fif_gfid );

		$affected_rows =  $this->FSIM->save($data,$where);
		echo json_encode( array('affected_rows' => $affected_rows) );
	}

	public function Method_update_family_record()
	{
		$this->load->model('sis/ajax_post_changes_model','FSIM');
		$Type = $this->input->post('Type');
		$operation = $this->input->post('operation');

		$fif_gfid = $this->input->post('fif_gfid');
		$fif_gfid = (int)str_replace('-','', $fif_gfid);

		$parent_type = 0;
		if($Type == 'Mother_late')
		{
			$parent_type = 2;
		}else
		{
			$parent_type = 1;
		}

		$now = date('Y-m-d H:i:s');

		// $data = array(
		// 	"is_late" =>  0,
		// 	"modified"=>  human_to_unix($now),
		// 	"modified_by"=> (int)$this->session->userdata['user_id']
		// );
		// $where = array ("gf_id" => $fif_gfid);
		// $this->FSIM->update_family_record($data, $where);

		$data = array(
			"is_late" =>  $operation,
			"modified"=>  human_to_unix($now),
			"modified_by"=> (int)$this->session->userdata['user_id']
		);
		$where = array ("gf_id" => $fif_gfid, "parent_type" => $parent_type );
		$affected_rows =  $this->FSIM->update_family_record($data, $where);




		echo json_encode( array('affected_rows' => $affected_rows) );
	}
}