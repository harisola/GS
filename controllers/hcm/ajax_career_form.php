<?php 

class Ajax_career_form extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->data['applicant_form_path2'] = 'assets/hcm/online_applicant_form/latest/';
	}

	public function getShortList_2(){
		$this->load->model('hcm/career_form_model');
		$this->online['applicant_data'] = array($this->career_form_model->getShortList2Data());

		$html = '';
		foreach($this->online['applicant_data'][0] as $applicant_data) {
			$html .= '<tr>';


			$html .= '
			<td>'.$applicant_data->gc_id.'</td>
			<td>'.$applicant_data->name.'</td>

			<!-- Tags -->              
			<td>'.$applicant_data->sl_tags_acd_subject.'</td>
			<td>'.$applicant_data->sl_tags_acd_primary.'</td>
			<td>'.$applicant_data->sl_tags_acd_section.'</td>
			<td>'.$applicant_data->sl_tags_acdm.'</td>
			<td>'.$applicant_data->sl_tags_acdm_primary.'</td>
			<td>'.$applicant_data->sl_tags_admin_area.'</td>
			<td>'.$applicant_data->sl_tags_admin_position.'</td>
			<td>'.$applicant_data->sl_tags_admin_primary.'</td>
			<!-- Tags End -->';


			$html .= '
			<!-- Grade -->';
			if ($applicant_data->sl2_grade == "") {
				$html .= '<td>.....</td>';
			} else {
				$html .= '<td>'.$applicant_data->sl2_grade.'</td>';
			}
			$html .= '<!-- Grade End -->';




			$html .= '
			<!-- Action Step -->';
			if ($applicant_data->sl2 == 1) {
				$html .= '<td>SL3</td>';
			} else if ($applicant_data->sl2 == 0) {
				$html .= '<td>.....</td>';
			} else if ($applicant_data->sl2 == 2) {
				$html .= '<td>Archive</td>';
			}else {
				$html .= '<td>Formal Interview</td>';
			}
			$html .= '<!-- Action Step End -->';




			$html .= '
			<!-- Comments -->';
			if ($applicant_data->sl2_comments == "") {
				$html .= '<td>.....</td>';
			} else {
				$html .= '<td>'.$applicant_data->sl2_comments.'</td>';
			}
			$html .= '<!-- Comments End -->';



			$html .= '<td>View</td>';










			$html .= '<!-- View Complete Form Scan View -->';
            
			$GCID = $applicant_data->gc_id;
			$converted_GCID = str_replace("-", "", $GCID);
			$converted_GCID = str_replace("/", "_", $converted_GCID);
            
            $html .= '<td>';
            if(file_exists($this->data['applicant_form_path2'] . $converted_GCID . "_1.jpg")){
				$html .= 'Full Form';
            }
            $html .= '</td>';
            $html .= '<!-- End Complete Form Scan View -->';


           
			$html .= '<td>'.$applicant_data->gender.'</td>';
			if($applicant_data->handedover_datetime == 0) {
				$html .= '<td></td>';
			} else {
				$html .= '<td>'.unix_to_human($applicant_data->handedover_datetime).'</td>';
			}







			$html .= '</tr>';
		}


		echo $html;
	}



















	public function getShortList_3(){
		$this->load->model('hcm/career_form_model');
		$this->online['applicant_data'] = array($this->career_form_model->getShortList3Data());

		$html = '';
		foreach($this->online['applicant_data'][0] as $applicant_data) {
			$html .= '<tr>';




			$html .= '
			<td>'.$applicant_data->gc_id.'</td>
			<td>'.$applicant_data->name.'</td>

			<!-- Tags -->              
			<td>'.$applicant_data->sl_tags_acd_subject.'</td>
			<td>'.$applicant_data->sl_tags_acd_primary.'</td>
			<td>'.$applicant_data->sl_tags_acd_section.'</td>
			<td>'.$applicant_data->sl_tags_acdm.'</td>
			<td>'.$applicant_data->sl_tags_acdm_primary.'</td>
			<td>'.$applicant_data->sl_tags_admin_area.'</td>
			<td>'.$applicant_data->sl_tags_admin_position.'</td>
			<td>'.$applicant_data->sl_tags_admin_primary.'</td>
			<!-- Tags End -->';


			$html .= '
			<!-- Grade -->';
			if ($applicant_data->sl3_grade == "") {
				$html .= '<td>.....</td>';
			} else {
				$html .= '<td>'.$applicant_data->sl3_grade.'</td>';
			}
			$html .= '<!-- Grade End -->';




			$html .= '
			<!-- Action Step -->';
			if ($applicant_data->sl3 == 1) {
				$html .= '<td>Formal Interview</td>';
			} else if ($applicant_data->sl3 == 0) {
				$html .= '<td>.....</td>';
			} else {
				$html .= '<td>Archive</td>';
			}
			$html .= '<!-- Action Step End -->';




			$html .= '
			<!-- Comments -->';
			if ($applicant_data->sl3_comments == "") {
				$html .= '<td>.....</td>';
			} else {
				$html .= '<td>'.$applicant_data->sl3_comments.'</td>';
			}
			$html .= '<!-- Comments End -->';



			$html .= '<td>View</td>';










			$html .= '<!-- View Complete Form Scan View -->';
            
			$GCID = $applicant_data->gc_id;
			$converted_GCID = str_replace("-", "", $GCID);
			$converted_GCID = str_replace("/", "_", $converted_GCID);
            
            $html .= '<td>';
            if(file_exists($this->data['applicant_form_path2'] . $converted_GCID . "_1.jpg")){
				$html .= 'Full Form';
            }
            $html .= '</td>';
            $html .= '<!-- End Complete Form Scan View -->';


           
			$html .= '<td>'.$applicant_data->gender.'</td>';
			if($applicant_data->handedover_datetime == 0) {
				$html .= '<td></td>';
			} else {
				$html .= '<td>'.unix_to_human($applicant_data->handedover_datetime).'</td>';
			}







			$html .= '</tr>';
		}


		echo $html;
	}
}