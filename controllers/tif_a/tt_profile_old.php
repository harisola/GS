<?php


//****************CONSTRUCTOR***************//
class Tt_profile extends MY_Controller{


	public function index(){

		$select = '';
		$where = '';
		$this->load->model('tif_a/tif_a_model','tif');
		$data['profile'] = $this->tif->profile_staff_allocation();
		
		//$data['profile'] =  $this->tif->get_by('atif_staff.profile_setup',$select,$where);
		$this->load->view('tif_a/tt_profile_view',$data);
		$this->load->view('tif_a/tt_profile_footer');

	}
}