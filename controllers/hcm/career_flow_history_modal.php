<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Career_flow_history_modal extends CI_Controller {
	public function __construct(){
		parent::__construct();
    $this->load->model('hcm/career_form_model');
    $this->load->model('hcm/career_form_uni_model');
    $this->load->model('hcm/career_form_emp_model');
    $this->load->model('hcm/career_form_interactions');
    $this->load->model('hcm/career_form_interaction_flow_detail');    
    $this->load->model('hcm/career_form_interaction_centre');
    $this->load->model('hcm/career_form_interaction_grade');
    $this->load->model('hcm/career_form_interaction_tags');
    $this->load->model('hcm/career_form_interaction_send_received');    
	}

	public function index()
	{	
		$this_career_id = $this->input->get(NULL, TRUE);
		if($this_career_id == false)
		{
		}else{
      $form_career_id = $this_career_id['career_id'];
      

      $form_start = "";
      $form_table_rows = "";
      $form_end = "";

      // **********************************************
      // Getting all the information from DB
      $applicant_data = array($this->career_form_model->get_by(array('id' => $form_career_id)));
      $current_flow = array($this->career_form_model->getStage2HRFormData_GCID($form_career_id));
      $interaction_flow = array($this->career_form_interaction_flow_detail->get_by(array('career_id' => $form_career_id)));      
      // **********************************************
      // **********************************************
      


      $form_start .= '<h3>' . $applicant_data[0][0]->name . '<!--<small></small>--></h3>                      
                      <address>                      
                      Recommended for<br><strong>'
                      . $current_flow[0][0]->forward_interaction_centre_name .
                      '</strong><br>                      
                      </address>';


      $form_table_rows .= '<div class="inner-spacer" role="content">
                <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
                      <th>Recommended to</th>
                      <th>Recommended by</th>
                      <th>Recommended for</th>
                      <th>Grade</th>
                      <th>Comments</th>
                    </tr>
                  </thead>
                  <tbody>';
      foreach ($interaction_flow[0] as $flow) {
        $form_table_rows .= '<tr><td>' . $flow->forward_interaction_name . '</td>';       
        $form_table_rows .= '<td>' . $flow->recommended_by . '</td>';        
        $form_table_rows .= '<td>' . $flow->forward_interaction_centre_name . '</td>';
        $form_table_rows .= '<td>' . $flow->forward_grade_name . '</td>';
        $form_table_rows .= '<td>' . $flow->forward_comments . '</td></tr>';
      }

      $form_table_rows .= '
                  </tbody>
                </table>
              </div>';

      


      echo $form_start
      . $form_table_rows
      . $form_end;

    }
  }
}