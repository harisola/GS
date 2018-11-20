<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fee_bill_fee_structure extends MY_Controller {

	public function __construct()
	{
		parent::__construct();		
	}


	public function index(){
		$this->load->model('accounts/fee_bill/fb_structure/index', 'FBS');
		$data["Session_List"]   = $this->FBS->getSession();
		$data["fee_definition"] = $this->Get_Academic_Session();

		$this->load->view('accounts/fee_structure/fee_structure_view', $data);
		$this->load->view('accounts/fee_structure/fee_structure_footer');
	}


// 	function Get_Fee_Definition()
// 	{
// 		$this->load->model('accounts/fee_bill/fb_structure/index', 'FBS');
// 		$Query = "sselect s.id as Session_id, s.branch_id, s.name, s.dname, s.start_date, s.end_date,
// fn.id as Definition_id, fn.academic_session_id, s.dname, fn.grade_id, g.dname, fn.tuition_fee, fn.resource_fee, fn.musakhar, fn.lab_avc, fn.yearly
// from atif._academic_session as s
// left join atif_fee_student.fee_definition as fn on fn.academic_session_id = s.id
// left join atif._grade as g on g.id=fn.grade_id
// order by s.id desc";
// 		return $this->FBS->Custom_Query($Query);
// 	}



	public function Get_Academic_Session()
	{
		$Query = "select s.id as Session_id, s.branch_id, s.name, s.dname, s.start_date, s.end_date, s.is_lock, s.is_active
from atif._academic_session as s where s.branch_id=2
order by s.id desc";
		$Results = $this->FBS->Custom_Query($Query);	

		$Html = '';
		$collapse_in = true;

		if( !empty($Results))
		{
			foreach ($Results as $value) 
			{

				$collapse = 'collapse_'.$value["Session_id"];

				$Ex = explode("_", $value["name"] );
				$Display_name = $Ex[1] ? $Ex[1] : '2018 2019';
				$Start_date = date('jS M Y', strtotime( $value["start_date"] ));
				$End_date = date('jS M Y', strtotime( $value["end_date"] ));

				$Html .= '<div class="panel panel-default">';
				$Html .= '<div class="panel-heading panel-title">';
				$Html .= '<div class="col-md-3">';
				$Html .= '<h4 class="panel-title" style="margin-top: -13px;">';
				$Html .= '<small class="SpecialSmall">Name</small><br />';
				$Html .= '<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#'.$collapse.'"> Session '.$Display_name.' </a>';
				$Html .= '</h4>';
				$Html .= '</div>';
				$Html .= '<div class="col-md-3">';
				$Html .= '<h4 class="panel-title" style="margin-top: -13px;">';
				$Html .= '<small class="SpecialSmall">Display Name</small><br />';
				$Html .= '<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#'.$collapse.'">'.$value["dname"].'</a>';
				$Html .= '</h4>';
				$Html .= '</div>';
				$Html .= '<div class="col-md-3">';
				$Html .= '<h4 class="panel-title" style="margin-top: -13px;">';
				$Html .= '<small class="SpecialSmall">Start Date</small><br />';
				$Html .= '<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#'.$collapse.'"> '.$Start_date.' </a>';
				$Html .= '</h4>';
				$Html .= '</div>';
				$Html .= '<div class="col-md-3">';
				$Html .= '<h4 class="panel-title" style="margin-top: -13px;">';
				$Html .= '<small class="SpecialSmall">End Date</small><br />';
				$Html .= '<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#'.$collapse.'"> '.$End_date.' </a>';
				$Html .= '</h4>';
				$Html .= '</div>';
				$Html .= '</div>';

	
				if( $value["is_lock"] == 0 && $value["is_active"] == 1 )
				{
					$collapse_in	= false;
					$collapse_in_d  = 'in';
				}else 
				{
					$collapse_in_d  = 'collapse';
				}

				$Html .= '<div id="'.$collapse.'" class="panel-collapse '.$collapse_in_d.'">';
				$Html .= '<div class="panel-body">';
        $Html .= '<h3>Fee Structure</h3>';

        $collapse10 = $value["Session_id"];
				$collapse9 = ( $collapse10 - 1 );

				$Sub_Query = "select 
				fn.id as Definition_id, fn.academic_session_id, fn.grade_id, 
				g.dname as Grade_name, fn.tuition_fee, fn.resource_fee, fn.musakhar, fn.lab_avc, 
				( fn.tuition_fee + fn.resource_fee + fn.musakhar + fn.lab_avc ) as Total, 
				fn.yearly, if( s.is_active=1, 'O', 'L' ) as Session_Status
				from atif_fee_student.fee_definition as fn 
				left join atif._grade as g on g.id=fn.grade_id
				left join atif._academic_session as s on s.id = fn.academic_session_id
				where ( fn.academic_session_id= ".$collapse10." or fn.academic_session_id= ".$collapse9." )
				order by g.complete_in_years desc";

        $Html .= $this->Get_Fee_Definition($Sub_Query);

        $Html .= '</div><!-- panel-body -->';
        $Html .= '</div>';
				$Html .= '</div>';


			}
		}

		return $Html;
	}


	public function Get_Fee_Definition($Query)
	{
		$Results = $this->FBS->Custom_Query($Query);

		$Html = '';
		$Session_Status1 = '';

		$Html .= '<table class="table">';
		$Html .= '<thead>';
		$Html .= '<tr>';
		$Html .= '<th class="text-center"><h5>2015 - 2016</h5></th>';
		$Html .= '<th class="text-center">Tution Fee</th>';
		$Html .= '<th class="text-center">Resource Fee</th>';
		$Html .= '<th>Musakhar</th>';
		$Html .= '<th>Lab/AVC/Spt/Lib</th>';
		$Html .= '<th>Total</th>';
		$Html .= '<th>Yearly Charges</th>';
		$Html .= '</tr>';
		$Html .= '</thead>';
		$Html .= '<tbody>';
		
		$Html .= '<form action="'.base_url().'index.php/accounts/structure_ajax/Get_Post_Data" method="post" name="fee_definition_active" id="fee_definition_active">';

		if( !empty($Results))
		{
				foreach ($Results as $value) 
				{

						$Session_Status = $value["Session_Status"] == 'L' ? 'disabled' : '';
						$Session_Status1 = $value["Session_Status"];

						$Html .= '<tr>';


					if( $value["Session_Status"] == 'O' )
						{
							$Html .= '<input type="hidden" class="Hidden_Definition_id" name="Hidden_Definition_id[]" value="'.$value["Definition_id"].'" />';

							$Html .= $this->TR_Unable( 
							$value["Definition_id"],
							$value["Grade_name"],
							$value["tuition_fee"],
							$value["resource_fee"],
							$value["musakhar"],
							$value["lab_avc"],
							$value["Total"],
							$value["yearly"]
							 );

						}else
						{
							$Html .= '<input type="hidden" class="Hidden_Definition_id" name="Hidden_Definition_id[]" value="0" />';

							$Html .= $this->TR_Disabled( 
							$value["Grade_name"],
							$value["tuition_fee"],
							$value["resource_fee"],
							$value["musakhar"],
							$value["lab_avc"],
							$value["Total"],
							$value["yearly"]
							 );
							
						} 

						$Html .= '</tr>';
				} // end foreach

			
		

		

		}// not empty


		if( $Session_Status1 == 'O' )
		{
				$Html .= '<tr>';
				$Html .= '<td colspan="7" class="text-center">';
				$Html .= '<input type="submit" value="Submit" class="btn green" id="Active_Data">';
				$Html .= '</td>';
				$Html .= '</tr>';

			}else
			{
				
				$Html .= '<tr>';
					$Html .= '<td colspan="7" class="text-center">';

					$Html .= '<p>';
					$Html .= '<a class="btn blue" href="ui_tabs_accordions_navs.html#collapse_3_2" target="_blank"> Activate this section via URL </a>';
				  $Html .= '</p>';

				  $Html .= '</td>';
				  $Html .= '</tr>';

				

			}

		$Html .= '</form>';

		$Html .= '</tbody>';
		$Html .= '</table>';

		return $Html;

	}


public function TR_Unable( $Definition_id, $Grade_name,$tuition_fee, $resource_fee,$musakhar, $lab_avc, $Total,$yearly)
{

		$Html = '';
		

				$Html .= '<td class="text-center" style="background: #ccc;">
				<h5>'.$Grade_name.'</h5></td>';

				$Html .= '<td class="text-center">';
$Html .= '<input type="number" class="form-control specialInput" 
value="'.$tuition_fee.'" name="'.$Definition_id.'_tuition_fee" />';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<input type="number" class="form-control specialInput" 
					value="'.$resource_fee.'" name="'.$Definition_id.'_resource_fee" />';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<input type="number" class="form-control specialInput" 
					value="'.$musakhar.'" name="'.$Definition_id.'_musakhar" />';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<input type="number" class="form-control specialInput" 
					value="'.$lab_avc.'" name="'.$Definition_id.'_lab_avc" />';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<input type="number" class="form-control specialInput" 
					value="'.$Total.'" name="'.$Definition_id.'_Total" />';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<input type="number" class="form-control specialInput" 
					value="'.$yearly.'" name="'.$Definition_id.'_yearly" />';
				$Html .= '</td>';
				

				return $Html;

}



public function TR_Disabled( $Grade_name,$tuition_fee, $resource_fee,$musakhar, $lab_avc, $Total,$yearly)
{

		$Html = '';
	

				$Html .= '<td class="text-center" style="background: #ccc;">
				<h5>'.$Grade_name.'</h5></td>';

				$Html .= '<td class="text-center">';
					$Html .= '<label> '.$tuition_fee.'  </label>';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<label> '.$resource_fee.'  </label>';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<label> '.$musakhar.'  </label>';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<label> '.$lab_avc.'  </label>';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<label> '.$Total.'  </label>';
				$Html .= '</td>';

				$Html .= '<td>';
					$Html .= '<label> '.$yearly.'  </label>';
				$Html .= '</td>';

			

return $Html;

}





}