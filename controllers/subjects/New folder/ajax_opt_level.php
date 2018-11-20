<?php
class Ajax_opt_level extends CI_Controller{
	
	function __construct() {
		parent::__construct();
	}
	
	public function index(){
		
		$block		= (int)$this->input->post('block');
		$gradesID	= (int)$this->input->post('gradesID');
		$groupID	= (int)$this->input->post('groupID');
		$subjectID	= (int)$this->input->post('subjectID');
		$sessionID	= (int)$this->input->post('sessionID');
		$term		= (int)$this->input->post('term');
		$totalStudents		= (int)$this->input->post('totalStudents');
		
		
		
		$blockHtml = $this->createBlock( $block );
		$subStudentsList = $this->subjectStudents( $sessionID, $term, $gradesID, $groupID, $subjectID, $totalStudents, $block );
		$response = array( 'blockHtml' => $blockHtml , 'subStudentsList' => $subStudentsList );
		echo json_encode($response);
	}
	
	public function createBlock( $block  ){
		$blockblock = 0;
		$html = '';
		for( $row = 1; $row <= $block; $row++ ){
			$html .= '<tr>';
			$html .= '<td>'.$row.'</td>';
			$html .= '<td><span  id="boy_'.$row.'">'.$blockblock.'</span></td>';
			$html .= '<td id="girl_'.$row.'">'.$blockblock.'</td>';
			$html .= '<td id="total_'.$row.'">'.$blockblock.'</td>';
			$html .= '</tr>';
		}
		return $html;
	}
	
	public function createDropDown( $block, $ID ){
		$html = '';
		$html .= '<label class="select">';
        $html .= '<select class="blockDropdown" id="'.$ID.'">';
		$html .= '<option value=""> Choose </option>';
		for( $row = 1; $row <= $block; $row++ ){
			$html .= '<option value="'.$row.'">'.$row.'</option>';
		}
		$html .= '</select><i></i></label>';
		
		return $html;
	}
	
	
	public function subjectStudents( $sessionID, $term, $gradesID, $groupID, $subjectID, $totalStudents, $block  ){
		$this->load->model('subjects/subject_model','SM');
		//$unique = "a_".$sessionID."_t_".$term."_g_".$gradesID."_s_".$subjectID."";
		$unique = "a_".$sessionID."_t_".$term."_grd_".$gradesID."_grp_".$groupID."_s_".$subjectID."";
		$key = $this->getSbtBl( $unique );
		if(!empty($key)){
			$rmBlck = $key->ID;
			$where2 = array("blockID" => $rmBlck );
			$tablename2 = "studentselectedblock";
			$this->SM->removePSetup( $tablename2, $where2 );	
		}
		
		$ablename2 = 'programmesetup';
		$select2 = 'id AS programID';
		$where2 = array("sessionID" =>$sessionID,"gradeID" =>$gradesID,"subjects" =>$subjectID  );
		$prgrmID = $this->SM->getSingleRow($ablename2, $select2, $where2  );
		//var_dump($prgrmID);
		$programID = $prgrmID->programID;
		$tablename = "subjectblock";
		$data1 = array(
			"key"=>$unique,
			"programID" =>$programID,
			"acadmic"=>$sessionID,
			"term"=>$term,
			"grade"=>$gradesID,
			"subject"=>$subjectID,
			"block"=>$block,
			"totalStudents"=>$totalStudents,
			"created"=>time()
		);
		
		$blockID = $this->SM->setupReplace2($tablename,$data1 );
		$results = $this->SM->getStd( $gradesID, $groupID, $subjectID );
		
		$html = '';
		$counter = 1;
		foreach( $results as $r ):
			$html .= '<tr>';
			//$html .= '<input type="hidden" name="studentID[]" value='.$r["id"].' />';
			$html .= '<td>';
			$html .= '<span class="num">';
			$html .= $counter;
			$html .= '</span>';
			$html .= '</td>';
			$html .= '<td>'.$r["GS-ID"].'</td>';
			$html .= '<td>';
			$html .= '<h5>'.$r["Full Name"].'</h5>';
			$html .= '<input type="hidden" value='.$r["Gender"].' id="gndr_'.$r["id"].'" />';
			$html .= '<input type="hidden" value='.$blockID.' name="blockID" />';
			$html .= '</td>';
			
			$html .= '<td>'.$r["Gender"].'</td>';
			$html .= '<td>'.$r["section"].'</td>';
			$html .= '<td>'.$r["status"].'</td>';
			
			$html .= ' <td>';
			$html .= $this->createDropDown( $block, $r["key"] );
			//$html .= $block . "++". $r["key"];
			$html .= '</td>';
			$counter++;
			$html .= '</tr>';
		endforeach;
		return $html;
	}
	
	
	public function stdSltdblck(){
		
		$this->load->model('subjects/subject_model','SM');
		
		
		$bID		= (int)$this->input->post('bID');
		$stdID		= (int)$this->input->post('stdID');
		$blockID	= (int)$this->input->post('blockID');
		
		$tablename = "studentselectedblock";
		$unique = "std_".$stdID."_".$bID."";
		
		$data = array( 
			"key" => $unique,
			"blockID" => $bID,
			"studentID" => $stdID,
			"subjectBlock" => $blockID 
		);
		
		$blockID = $this->SM->setupReplace($tablename,$data );
		echo $blockID;
	}
	
	public function getSbtBl( $unique ){
		$this->load->model('subjects/subject_model','SM');
		$tablename = "subjectblock";
		$where = array( "key" => $unique );
		$select = "ID,block";
		$key = $this->SM->getSingleRow( $tablename, $select, $where );
		return $key;
	}
}
?>