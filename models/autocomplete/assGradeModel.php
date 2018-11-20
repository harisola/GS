<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class AssGradeModel extends CI_Model{
	private $ADB;
	function __construct(){
		parent::__construct();
	}
  
  
  public function insert($table,$data){
	 $this->ADB = $this->load->database('assessment',true);
	  $sucess = $this->ADB->insert( $table, $data );
		$ID = $this->ADB->insert_id();
		if($sucess)
				return $ID;
			else
				return FALSE;
  }

  	public function updateTable($tablename, $data, $where ){
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->where($where);
		$this->ADB->update($tablename, $data ); 
		$afftectedRows = $this->ADB->affected_rows();
		return $afftectedRows;
	}
	public function delete_row( $table,$where )	{
		$this->ADB = $this->load->database('assessment',true);
		$this->ADB->where( $where );
		$this->ADB->delete($table);
		  if($this->ADB->affected_rows()>0)
		   return true;
		  else
		   return false;
	}
  
  	public function getAll($table,$columns ,$where = NULL ){
		$this->ADB = $this->load->database('assessment',true);
		
		$this->ADB->select($columns);
		$this->ADB->from($table);
		if( $where != NULL ){
			$this->ADB->where( $where );
		}
		$query = $this->ADB->get();
		return $query->result();
		
	}
	
	
  /*
		=============================================================
			Function for count weightage according to main category
			weightage wise if there is wieghtage space/
			For insertation
		=============================================================
	*/
/*	public function countWeightageCat($categoryID, $currentWeightage,$where ){
		$this->ADB = $this->load->database('assessment');
		$this->ADB->select_sum('weightage', 'Total');
		$this->ADB->from('gradesubjectass');
		//$this->ADB->where( 'assessment_type_id' , $categoryID );
		$this->ADB->where( $where );
		$query = $this->ADB->get();
		$result = $query->row();
		
		 if( $result->Total != NULL ){
			 
			$totalSum   = ( $result->Total + $currentWeightage );
			$totalSum2  = ( $totalSum - 100 );
			$adjustTotal = ( $currentWeightage - $totalSum2 );
			
				if( $result->Total >= 100 ){
					$return =  array("success" => 3, "adjustTotal" => 0 );
					
				}else{
					if( $totalSum <= 100 ){
						$return =  array("success" => 1, "adjustTotal" => 0 );
						
					}else{
						$return =  array("success" => 2, "adjustTotal" =>  $adjustTotal );
						
					}
				}
			}else{
				$return =  array("success" => 0, "adjustTotal" => 0 );
				
			}
		 
			
			return $return;
		
	}
	/*
		============================ End ============================
	*/
	


  
  
}
    