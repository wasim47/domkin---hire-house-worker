<?php
Class Index_model extends CI_Model
{
	
	
	
	public function totalValue($table) {
        return $this->db->count_all($table);
    }
	
	function searchStaffCount($desig,$expert) 
	{
		$this->db->select('*');
		$this->db->from('kin_staff a'); 
		$this->db->join('emp_info b', 'b.s_id=a.s_id', 'right');
		if($desig!=""){
			$this->db->where('b.emp_designation', $desig);
		}
		if($expert!=""){
			$this->db->where('b.emp_expertise', $expert);
		}
		$this->db->order_by('b.emp_designation','asc');         
		$result = $this->db->get(); 
		
		return $result;
	}
	
	
	function searchStaff($desig,$expert,$start,$limit) 
	{
		$this->db->select('*');
		$this->db->from('kin_staff a'); 
		$this->db->join('emp_info b', 'b.s_id=a.s_id', 'right');
		if($desig!=""){
			$this->db->where('b.emp_designation', $desig);
		}
		if($expert!=""){
			$this->db->where('b.emp_expertise', $expert);
		}
		$this->db->order_by('b.emp_designation','asc');    
		$this->db->limit($start,$limit);   
		$result = $this->db->get(); 
		
		return $result;
	}
	
	
	
	 public function staffinfoByJoin()
        {
            $this->db->select('*');
            $this->db->from('kin_staff a'); 
            $this->db->join('emp_info b', 'b.s_id=a.s_id', 'right');
            //$this->db->join('Soundtrack c', 'c.album_id=a.album_id', 'left');
           // $this->db->where('c.album_id',$id);
            $this->db->order_by('b.emp_designation','asc');         
            $query = $this->db->get(); 
            if($query->num_rows() != 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
       }
		
	 public function staffinfoByJoinExp()
        {
            $this->db->select('*');
            $this->db->from('kin_staff a'); 
            $this->db->join('emp_info b', 'b.s_id=a.s_id', 'right');
            //$this->db->join('Soundtrack c', 'c.album_id=a.album_id', 'left');
           // $this->db->where('c.album_id',$id);
            $this->db->order_by('b.emp_expertise','desc');         
            $query = $this->db->get(); 
            if($query->num_rows() != 0)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
       }		
	
	function get_staffagentlogin($usr, $pwd)
     {
				$this->db->select('*');
				$this->db->where("(ag_email = '$usr' || ag_phone_no = '$usr') AND password = '".sha1($pwd)."' AND active=1");
				$agent = $this->db->get('agent');
		
				$this->db->select('*');
				$this->db->where("(s_email = '$usr' || s_phone_no = '$usr') AND password = '".sha1($pwd)."' AND active=1");
				$staff = $this->db->get('kin_staff');
				
				$this->db->select('*');
				$this->db->where("(hh_email = '$usr' || hh_phone_no = '$usr') AND password = '".sha1($pwd)."' AND active=1");
				$house = $this->db->get('householder');
		     	
				//$agent = $this->db->get_where('agent', array('ag_email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1 ));		
			    //$house = $this->db->get_where('householder', array('hh_email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
				//$staff = $this->db->get_where('kin_staff', array('s_email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
				if ($agent->num_rows() > 0)
				{
				 	 return array(
						'agentResult' => $agent->row_array(),
						'userType' => 'Agent'
						);
				}
				elseif ($house->num_rows() > 0)
				{
				 	 return array(
						'houseResult' => $house->row_array(),
						'userType' => 'House Holder'
						);
				}
				elseif ($staff->num_rows() > 0)
				{
				 	 return array(
						'staffResult' => $staff->row_array(),
						'userType' => 'Staff'
						);
				}
				
     }
	 
	 
	 
	 
	function get_userLogin($usr, $pwd)
     {
		 $reader =    $this->db->get_where('users', array('email'=> $usr, 'password'=>sha1($pwd), 'active'=> 1));
		 return $reader->row_array();
     }
	 
	function get_memberLogin($usr, $pwd)
     {
		 $reader =    $this->db->get_where('userinfo', array('email'=> $usr, 'password'=>sha1($pwd)));
		 return $reader->row_array();
     }
	 public function record_count($table) {
        return $this->db->count_all($table);
    }
	
	function update_squnce($seqence,$id)
		{
	
			$queryval=$this->db->query("select * from menu where sequence='".$seqence."'");
			
			if($queryval->num_rows() > 0){
				foreach($queryval->result() as $row);
					$sequenceVal=$row->sequence;
					$nid=$row->m_id;
			}
			else{
					$sequenceVal="";
					$nid="";
			}
				
			/*}
			else{
					$sequenceVal="";
					$nid="";
		`	}*/
								
			if($seqence!=$sequenceVal){
				$update=$this->db->query("update menu set sequence='".$seqence."' where m_id='".$id."'");
			}
			else{
				$query1=$this->db->query("select * from menu where m_id='".$id."'");
				$results1=$query1->result();
				foreach($results1 as $row1);
				$sequenceVal1=$row1->sequence;
				$nid1=$row1->m_id;
			
				$update=$this->db->query("update menu set sequence='".$sequenceVal1."' where m_id='".$nid."'");
				$update1=$this->db->query("update menu set sequence='".$seqence."' where m_id='".$id."'");
			}
	}
		
		
		function get_approve($approve_val,$table,$id,$status)
	{
	   $setval = array(
		   $status => 1,
		);
		$array=join(',',$approve_val);
		$this->db->where($id.' IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
	
	function get_deapprove($approve_val,$table,$id,$status)
	{
		 $setval = array(
		   $status => 0,
		);
		$array=join(',',$approve_val);
		$this->db->where($id.' IN ('.$array.')',NULL, FALSE);
		$this->db->update($table, $setval);
		return false;
	}
		
public function record_countParemeter($table,$colId,$id,$orderId,$order) {
        if($colId!=""){
			$this->db->where($colId, $id);
		}
		$this->db->order_by($orderId, $order);
		$result=$this->db->get($table);
		return $result;
    }


function getDataByIdWithPagination($table,$colId,$id,$orderId,$order,$start,$limit) 
	{
		if($colId!=""){
			$this->db->where($colId, $id);
		}
		$this->db->order_by($orderId, $order);
		$this->db->limit($start,$limit);
		$result=$this->db->get($table);
		return $result;
	}
			
		
function getProfessionalDirectory($start,$limit) 
	{
		$this->db->where('status',1);
		$this->db->group_by('profession');
		$this->db->order_by('id', 'desc');
		$this->db->limit($start,$limit);
		$result=$this->db->get('userinfo');
		return $result;
	}
		
				
// Menu 		
function getDataById($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($colId!=""){
				$this->db->where($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
		
function getSearch0Data($table,$colId,$id,$colId2,$id2,$colId3,$id3,$orderId,$order,$limit) 
	{
	  		 $this->db->where($colId, $id);
			 if($colId2!=""){
				$this->db->where($colId2, $id2);
				}
				 if($colId3!=""){
				$this->db->where($colId3, $id3);
				}
	   		 $this->db->order_by($orderId, $order);
	   		 $result=$this->db->get($table);
		    return $result;
	}
	
	
	function getArticleDataById($table,$colId,$id,$colId2,$id2,$orderId,$order,$limit) 
	{
				if($colId!=""){
				$this->db->where($colId, $id);
				}
			 if($colId2!=""){
				$this->db->where($colId2, $id2);
				}
	   		 $this->db->order_by($orderId, $order);
	   		 $result=$this->db->get($table);
		    return $result;
	}
	
	function getDataByIdArray($table,$colId,$id,$orderId,$order,$limit) 
	{
			if($id!=""){
				$this->db->where_in($colId, $id);
			}
	   		$this->db->order_by($orderId, $order);
			if($limit!=""){
				$this->db->limit($limit);
			}
	   		$result=$this->db->get($table);
		    return $result;
	}
	
	function getTable($table,$column,$order){
		$query =   $this->db
						->order_by($column, $order)
						->get($table);
		return $query;	
	}

function getOneItemTable($table,$tableColum,$userColum,$orderId,$order){
		$query =   $this->db
						->order_by($orderId, $order)
						->where($tableColum,$userColum)
						->get($table);
		return $query->row_array();	
	}
// Display All data with id
function getAllItemTable($table,$colum,$id,$statusColum,$status,$orderId,$order){
			  
			  if($colum!=""){
				  $this->db->where($colum,$id);
			  }
			  if($status!=""){
				  $this->db->where($statusColum,$status);
			  }
			
			  $this->db->order_by($orderId,$order);
			 $query = $this->db->get($table);
		return $query;
}

function getAllMember($keyword,$searchkey){
	  if($keyword!=""){
		  $this->db->like('company_name', $keyword);
		  $this->db->or_like('head_organization', $keyword);
		  $this->db->or_like('contact_person', $keyword);
		  $this->db->or_like('contact', $keyword);
		  $this->db->or_like('email', $keyword);
	  }
	  if($searchkey!=""){
		  $this->db->like('company_name', $searchkey, 'after');
	  }
	  $this->db->order_by('company_name','asc');
	  $query = $this->db->get('member');
	 return $query;
}

/////////////////////////////////////////All Insert, Update, Select, Delete and login Area/////////////////////////////////////////////////////////
	
/*----- Insert Table and Get ID -------- */
	
	function inertTable($table, $insertData){
		if($this->db->insert($table, $insertData)):
			return $this->db->insert_id();
		else:
			return false;
		endif;
	}

	 
	function update_table($table, $colid,$idval, $uvalue){
		$this->db->where($colid,$idval);
		$dbquery = $this->db->update($table, $uvalue); 
		return $idval;
		/*if($dbquery)
			return true;
		else
			return false;*/
	}
	
	function updateTable($tablename, $tableprimary_idname,$tableprimary_idvalue, $updated_array){
		$modified_date = time();
		$this->db->where($tableprimary_idname,$tableprimary_idvalue);
		$dbquery = $this->db->update($tablename, $updated_array); 
		
		return $tableprimary_idvalue;
		/*if($dbquery)
			return true;
		else
			return false;*/
	}
	 function checkOldPass($table,$old_password,$cid)
		{
			$this->db->where('email', $this->session->userdata('userAccessMail'));
			$this->db->where('id', $cid);
			$this->db->where('password', $old_password);
			$query = $this->db->get($table);
			return $query;
			/*if($query->num_rows() > 0)
				return 1;
			else
				return 0;*/
		}
	
	function checkOldPassDomkin($table,$email,$old_password,$cid,$idval)
		{
			//$this->db->where($email, $this->session->userdata('userAccessMail'));
			$this->db->where($cid, $idval);
			$this->db->where('password', $old_password);
			$query = $this->db->get($table);
			return $query;
			/*if($query->num_rows() > 0)
				return 1;
			else
				return 0;*/
		}	
		


/*----- Delete Table Row -------- */
	function deletetable_row($tablename, $tableidname, $tableidvalue){
		if($this->db->where($tableidname, $tableidvalue)->delete($tablename)) return true;
		return false;
	}
}

?>