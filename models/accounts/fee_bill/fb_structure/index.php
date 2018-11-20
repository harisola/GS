<?php
class Index extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getSession(){		
		$query=$this->db->query("select * from atif._academic_session as s where s.is_lock=0 and s.is_active=1");
		$rows_array = $query->result_array();		
		return $rows_array;
	}


	public function CheckStartDate($Start_Date)
	{
		$query = "select * from atif._academic_session as s 
		where s.start_date >= ".$this->db->escape($Start_Date)." and s.is_lock=0 and s.is_active=1"; 
		$query = $this->db->query($query);	
		#echo $query->num_rows(); exit;
		if( $query->num_rows() >  0 )
		{
			echo(json_encode(false));
		}
		else
		{
			echo(json_encode(true));
		}
	}


	public function CheckEndDate($Start_Date)
	{
		$query = "select * from atif._academic_session as s 
		where s.end_date >= ".$this->db->escape($Start_Date)." and s.is_lock=0 and s.is_active=1"; 
		$query = $this->db->query($query);	
		#echo $query->num_rows(); exit;
		if( $query->num_rows() >  0 )
		{
			echo(json_encode(false));
		}
		else
		{
			echo(json_encode(true));
		}
	}

	public function Update_function ()
	{
		$query = "UPDATE `atif`.`_academic_session` SET `is_lock`='1', `is_active` = '0' ";
		$this->db->query($query);	
		return $this->db->affected_rows();
	}
	

	function form_insert($data)
	{
		$this->db->insert('`atif`.`_academic_session`', $data);
		return $this->db->insert_id();
	}



	function Custom_Query($Query)
	{

		$query=$this->db->query( $Query );
		$rows_array = $query->result_array();		
		return $rows_array;	
	}



	public function Update_Fee_Definition($data,$id)
	{
		$this->db->update('`atif_fee_student`.`fee_definition`', $data, array('id' => $id));
		return $this->db->affected_rows();
	}


}	