<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Setup_role_secondary_reporting_modal extends CI_Controller {
	public function __construct(){
		parent::__construct();    
	}

	public function index()
	{	
		$MainTitle = "";
		$SecondaryReportingInfo = "";
		$AddRoleTitle = "";
		$AddRoleForm = "";		

		$role_id = $this->input->get(NULL, TRUE);
		if($role_id == false)
		{
		}else{
			$RoleID = $role_id['role_id'];

			$this->load->model('staff_integration/role_reporting_secondary_model');
				$data['role_info'] = $this->role_reporting_secondary_model->getRoleInfo($RoleID);				
        		$data['secondary_reporting_info'] = $this->role_reporting_secondary_model->getSecondaryReportingOf($RoleID);
        		$RowNum = count($data['secondary_reporting_info']);
        		$data['secondary_reporting'] = $this->role_reporting_secondary_model->getSecondaryReportingID($RowNum);
        		$data['allReportingRoles'] = $this->role_reporting_secondary_model->getAllReportingRoles();


    		$MainTitle = '<h5>' . $data['role_info'][0]['gr_id'] . '  :  ' . $data['role_info'][0]['staff_name'] . '</h5>';




			$SecondaryReportingInfo = '
			<div class="col-md-12 bootstrap-grid sortable-grid ui-sortable">          
              <div class="inner-spacer" role="content">
                <table class="table table-striped table-hover margin-0px">
                  <thead>
                    <tr>
                      <th>Reporting Type</th>
                      <th>Report To</th>                      
                    </tr>
                  </thead>
                  <tbody>';

            foreach ($data['secondary_reporting_info'] as $ReportingInfo) {
	            $SecondaryReportingInfo .= '<tr>
	        			<td>'. $ReportingInfo['secondary_report_desc'] . '</td>
	                    <td>' . $ReportingInfo['secondary_report_staff_name'] . '</td>
	                    </tr>';
            }            

            $SecondaryReportingInfo .= '
                  </tbody>
                </table>
              </div>
          	</div>';




          	if(count($data['secondary_reporting']) > 0) {
				$AddRoleForm = '
				<div class="col-md-12 bootstrap-grid sortable-grid">             
	            <!-- New widget -->	          
		              <div class="inner-spacer" role="content">
		                <form action="' . site_url() . '/staff_integration/setup_role_new/add2" class="orb-form" method="POST">
		                  <fieldset>
		                  	<br><br>
		                    <section>	                      
		                      <input type="hidden" name="role_id" value="' . $RoleID . '">
		                    </section>
		                    <section>
		                      <label class="label">Add : ' . $data['secondary_reporting'][0]['description'] . '</label>
		                      <input type="hidden" name="report_id" value="' . $data['secondary_reporting'][0]['id'] . '">

		                      	<label class="select">
			                        <select name="report_to">
			                          <option value="0">Choose Reporting Role</option>';

			                          foreach ($data['allReportingRoles'] as $ReportingRole) {
			                          	$AddRoleForm .= '<option value="' . $ReportingRole['id'] . '">' . $ReportingRole['gr_id'] . '</option>';
			                          }

			                          
			    $AddRoleForm .=  	'</select>
			                        <i></i>
			                    </label>	                        
		                    </section>	                    
		                  </fieldset>
		                  <footer>
		                    <button type="submit" class="btn btn-info">Save</button>
		                  </footer>
		                </form>
		              </div>
		            </div>
	          	</div>';
	        }
		}

		echo
		$MainTitle .
		$SecondaryReportingInfo .
		$AddRoleForm;
	}
}