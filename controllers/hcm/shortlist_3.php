<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Shortlist_3 extends MY_Controller {

	public function __construct(){
		parent::__construct();

		$this->load->model('hcm/career_form_model');
		$this->load->model('hcm/career_form_uni_model');
		$this->load->model('hcm/career_form_emp_model');
		$this->load->model('hcm/career_form_interaction_flow');
	    $this->load->model('hcm/career_form_interaction_send_received');
	    $this->load->model('hcm/school_career_tags_model');
	}

	public function index()
	{
		// if user has rights to edit the applicant data
		if($this->data['can_user_view'] == 1 && $this->data['can_user_edit'] == 1 && $this->data['can_user_delete'] == 0){

			$this->online['applicant_data'] = array($this->career_form_model->getShortList3Data());
			$this->load->view('hcm/career/shortlist_3_view');


			// Tags ----> Academic Subjects
			$this->tags_academic_subject = array($this->school_career_tags_model->get_by(array('tag_category_id' => 1)));
			$this->tags_academic_subject_source = "";
			foreach ($this->tags_academic_subject[0] as $tag) {
				$this->tags_academic_subject_source .= "{value: '" . $tag->name . "', text: '" .  $tag->name . "'},";
			}
			$this->tags_academic_subject_source = substr($this->tags_academic_subject_source, 0, -1);


			// Tags ----> Academic Section
			$this->tags_academic_section = array($this->school_career_tags_model->get_by(array('tag_category_id' => 2)));
			$this->tags_academic_section_source = "";
			foreach ($this->tags_academic_section[0] as $tag) {
				$this->tags_academic_section_source .= "{value: '" . $tag->group . "', text: '" .  $tag->group . "'},";
			}
			$this->tags_academic_section_source = substr($this->tags_academic_section_source, 0, -1);


			
			// Tags ----> Academic Management
			$this->tags_academic_management = array($this->school_career_tags_model->get_by(array('tag_category_id' => 3)));
			$this->tags_academic_management_source = "";
			foreach ($this->tags_academic_management[0] as $tag) {
				$this->tags_academic_management_source .= "{value: '" . $tag->name . "', text: '" .  $tag->name . "'},";
			}
			$this->tags_academic_management_source = substr($this->tags_academic_management_source, 0, -1);



			// Tags ----> Admin Area
			$this->tags_admin_area = array($this->school_career_tags_model->get_by(array('tag_category_id' => 4)));
			$this->tags_academic_adminarea_source = "";
			foreach ($this->tags_admin_area[0] as $tag) {
				$this->tags_academic_adminarea_source .= "{value: '" . $tag->name . "', text: '" .  $tag->name . "'},";
			}
			$this->tags_academic_adminarea_source = substr($this->tags_academic_adminarea_source, 0, -1);




			// Tags ----> Admin Area
			$this->tags_admin_position = array($this->school_career_tags_model->get_by(array('tag_category_id' => 5)));
			$this->tags_academic_adminposition_source = "";
			foreach ($this->tags_admin_position[0] as $tag) {
				$this->tags_academic_adminposition_source .= "{value: '" . $tag->name . "', text: '" .  $tag->name . "'},";
			}
			$this->tags_academic_adminposition_source = substr($this->tags_academic_adminposition_source, 0, -1);

		}

		// Loading footer in the end		
		$this->load->view('hcm/career/career_view_forms_footer');
	}



	public function edit()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $value = $_POST['value'];

	    
		$table_data = array(
			$name => $value
		);

		//var_dump($table_data);
		/*
		Check submitted value
		*/
	    if(!empty($value)) {	        
	        $id = $this->career_form_model->save($table_data, $pk);	        

	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}




	public function edit2()
	{
		$pk = $_POST['pk'];
	    $name = $_POST['name'];
	    $values = $_POST['value'];

	    $result = "";
	    foreach ($values as $value) {
	    	$result .= $value . ",";
	    }

	    
		$table_data = array(
			$name => $result
		);

		//var_dump($table_data);
		/*
		Check submitted value
		*/
	    if(!empty($value)) {	        
	        $id = $this->career_form_model->save($table_data, $pk);	        

	    } else {
	        header('HTTP 400 Bad Request', true, 400);
	        echo "This field is required!";
	    }
	}
}