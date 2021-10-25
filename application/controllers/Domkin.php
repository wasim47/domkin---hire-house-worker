<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Domkin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Index_model');
		date_default_timezone_set('Asia/Dhaka');
     	$this->load->library('email');
		$this->load->library('cart');
		$this->load->helper('form');
		$this->load->library('pagination');
		$this->load->helper('url');
	}
	function index()
	{
		$data['title']="BIPS | Bangladesh Institute of Professional Studies ";
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		
		$data['getexpertise'] = $this->Index_model->getAllItemTable('expertise','','','','','par_id','desc');
		$data['getdesignation'] = $this->Index_model->getAllItemTable('designation','','','','','desig_id','desc');
		
		$data['totalstaff'] = $this->Index_model->totalValue('kin_staff');
		$data['totalagent'] = $this->Index_model->totalValue('agent');
		$data['totalhouseholder'] = $this->Index_model->totalValue('householder');
		
		$data['stafflist'] = $this->Index_model->getAllItemTable('kin_staff','','','','','s_id','desc');
		$data['getstaffinfo'] = $this->Index_model->staffinfoByJoin();
		$data['getstaffinfoexp'] = $this->Index_model->staffinfoByJoinExp();
		$this->load->view('frontend/domkin/index',$data);
	}
	
	
	function search()
	{
		$data['title']="BIPS | Bangladesh Institute of Professional Studies ";
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		
		$data['getexpertise'] = $this->Index_model->getAllItemTable('expertise','','','','','par_id','desc');
		$data['getdesignation'] = $this->Index_model->getAllItemTable('designation','','','','','desig_id','desc');
		
		$desig = $this->input->post('designation');
		$expertise = $this->input->post('expertise');
		
		$totaldata=$this->Index_model->searchStaffCount($desig,$expertise);
		
		$config = array();
        $config['base_url'] = base_url('domkin/search');
        $config["per_page"] = 10;
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config["total_rows"] = $totaldata->num_rows();
        $config['num_links'] = $totaldata->num_rows();
        $config['cur_tag_open'] = '&nbsp;<a class="current">';
        $config['cur_tag_close'] = '</a>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
		$config["uri_segment"] = 3;
        $this->pagination->initialize($config);
		$data['pagination']= $this->pagination->create_links();
		$data['pageSl'] = $page;
		
		$data['getsearchdata'] = $this->Index_model->searchStaff($desig,$expertise,$config["per_page"],$page);
		$this->load->view('frontend/domkin/searchStaff',$data);
	}
	
	 
	 
	 function content()
	{
		$cat=$this->uri->segment(2);
		$scat=$this->uri->segment(3);
		$lcat=$this->uri->segment(4);
		if(isset($lcat)){
			$slug=$lcat;
		}
		elseif(isset($scat)){
			$slug=$scat;
		}
		elseif(isset($cat)){
			$slug=$cat;
		}
		$url=urldecode($slug);
		$exp=explode('-',$slug);
		$imp=implode(' ',$exp);
		$data['title']=ucfirst($imp);
		$data['slug']=$slug;
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		$data['getexpertise'] = $this->Index_model->getAllItemTable('expertise','','','','','par_id','desc');
		$data['getdesignation'] = $this->Index_model->getAllItemTable('designation','','','','','desig_id','desc');
		$data['articledetails']	= $this->Index_model->getOneItemTable('domkin_content','domkin_menu_title',$url,'a_id','desc',1);
		
		if($slug=='contact-us'){
			$this->load->view('frontend/domkin/contact_view',$data);
		}
		else{
			$this->load->view('frontend/domkin/content',$data);
		}
	}
	
	
	function registration()
	{
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		$regtype = $this->uri->segment(3);
		if($regtype!="" && $regtype=='staff'){
				$data['title'] = 'Staff Registration';
				if($this->input->post('registerpayNow')){
					$this->form_validation->set_rules('staffname', 'Staff Name', 'trim|required');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[kin_staff.s_email]|is_unique[agent.ag_email]|is_unique[householder.hh_email]');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[kin_staff.s_phone_no]|is_unique[agent.ag_phone_no]|is_unique[householder.hh_phone_no]');
				$this->form_validation->set_rules('nidpass', 'National ID / Passport', 'trim|required|is_unique[kin_staff.s_nidPassport]|is_unique[agent.ag_nidPassport]|is_unique[householder.hh_nidPassport]');
					
					if($this->form_validation->run() != false){
					 $dob =$this->input->post('day').'/'.$this->input->post('monthd').'/'.$this->input->post('year');
					 $date = date('Y-m-d',strtotime($dob));
					 $dyear = date_diff(date_create($date), date_create('today'))->y;
					 $age = $dyear;
			
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000';
						$config['upload_path'] = './asset/uploads/domkin/staff/';
						$config['charset'] = "UTF-8";
						$new_name = "Staff_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['staffimg']['name']))
							{
								if($this->upload->do_upload('staffimg')){
									$upload_data	= $this->upload->data();
									$save['s_photo']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= '';
									$save['s_photo']	= $upload_data;	
								}
							}	
							
			
						$save['s_name']	    = $this->input->post('staffname');
						$save['s_fathers_name']	    = $this->input->post('fname');
						$save['s_mothers_name']	    = $this->input->post('mname');
						$save['s_spouse_name']	    = $this->input->post('spousename');
						$save['s_gender']	    = $this->input->post('gender');
						$save['s_pre_address']	    = $this->input->post('pre_address');
						$save['s_per_address']	    = $this->input->post('per_address');
						$save['s_origin']	    = $this->input->post('nationality');
						$save['s_nidPassport']	    = $this->input->post('nidpass');
						$save['s_email']	    = $this->input->post('email');
						$save['s_phone_no']	    = $this->input->post('mobile');
						$save['s_date_of_birth']	    = $this->input->post('day').' '.$this->input->post('month').' '.$this->input->post('year');
						$save['s_age']	    = $age;
						$save['date']	    = date('Y-m-d');
						$save['active']	    = 1;
						
						$query = $this->Index_model->inertTable('kin_staff', $save);
						if($query){
							$email=$this->input->post('email');
									$tomaila=$email;
									$frommaila="info@bips.org.bd";
									$subjecta="Thank ".$this->input->post('staffname')." for registration our domkin Service";
									$config = array (
												  'mailtype' => 'html',
												  'charset'  => 'utf-8',
												  'priority' => '1'
												   );
									$this->email->initialize($config);
									$this->email->set_newline('\r\n');
									$email_bodya ="
									<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
									border:2px solid #f00; border-radius:13px; padding-left:20px;'>
									<tr style='background-color:#fff'>
									<th width='26%' height='79' align='center'> 
									<img src='".base_url('asset//domkin/images/logo.png')."' />
									<th colspan='2' align='left'></th>
									</tr>
									<tr>
									<th height='37' colspan='3' align='left' 
										style='font-size:22px; color:#333; text-decoration:none;'>Thank you for Registration</th>
									</tr>
									<tr>
									  <td colspan='3'>&nbsp;</td>
									  </tr>
									</table></td>
									</tr>
									</table>";
								
									//$this->email->initialize($config);
									$this->email->from($frommaila, 'bips.org.bd');
									$this->email->to($tomaila);
									//$this->email->bcc();
									$this->email->subject($subjecta);
									$this->email->message($email_bodya);
									$this->email->send();
									$this->session->set_userdata('newmemberId',$query);
									redirect('domkin/registrationSuccess', '');
						}
					}
				}
				else{
					$this->load->view('frontend/domkin/staff/registration',$data);
				}
		  }
		   elseif($regtype!="" && $regtype=='agent'){
		  
		  			$data['title'] = 'Agent Registration';
		  			if($this->input->post('registerpayNow')){
					$this->form_validation->set_rules('staffname', 'Staff Name', 'trim|required');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[kin_staff.s_email]|is_unique[agent.ag_email]|is_unique[householder.hh_email]');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[kin_staff.s_phone_no]|is_unique[agent.ag_phone_no]|is_unique[householder.hh_phone_no]');
				$this->form_validation->set_rules('nidpass', 'National ID / Passport', 'trim|required|is_unique[kin_staff.s_nidPassport]|is_unique[agent.ag_nidPassport]|is_unique[householder.hh_nidPassport]');
					
					if($this->form_validation->run() != false){
					 $dob =$this->input->post('day').'/'.$this->input->post('monthd').'/'.$this->input->post('year');
					 $date = date('Y-m-d',strtotime($dob));
					 $dyear = date_diff(date_create($date), date_create('today'))->y;
					 $age = $dyear;
			
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000';
						$config['upload_path'] = './asset/uploads/domkin/householder/';
						$config['charset'] = "UTF-8";
						$new_name = "Householder_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['staffimg']['name']))
							{
								if($this->upload->do_upload('staffimg')){
									$upload_data	= $this->upload->data();
									$save['ag_photo']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= '';
									$save['ag_photo']	= $upload_data;	
								}
							}	
							
			
						$save['ag_name']	    = $this->input->post('staffname');
						$save['ag_fathers_name']	    = $this->input->post('fname');
						$save['ag_mothers_name']	    = $this->input->post('mname');
						$save['ag_spouse_name']	    = $this->input->post('spousename');
						$save['ag_gender']	    = $this->input->post('gender');
						$save['ag_pre_address']	    = $this->input->post('pre_address');
						$save['ag_per_address']	    = $this->input->post('per_address');
						$save['ag_origin']	    = $this->input->post('nationality');
						$save['ag_nidPassport']	    = $this->input->post('nidpass');
						$save['ag_email']	    = $this->input->post('email');
						$save['ag_phone_no']	    = $this->input->post('mobile');
						$save['ag_date_of_birth']	    = $this->input->post('day').' '.$this->input->post('month').' '.$this->input->post('year');
						$save['ag_age']	    = $age;
						$save['date']	    = date('Y-m-d');
						$save['active']	    = 1;
						
						$query = $this->Index_model->inertTable('agent', $save);
						if($query){
							/*$email=$this->input->post('email');
									$tomaila=$email;
									$frommaila="info@bips.org.bd";
									$subjecta="Thank ".$this->input->post('staffname')." for registration our domkin Service";
									$config = array (
												  'mailtype' => 'html',
												  'charset'  => 'utf-8',
												  'priority' => '1'
												   );
									$this->email->initialize($config);
									$this->email->set_newline('\r\n');
									$email_bodya ="
									<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
									border:2px solid #f00; border-radius:13px; padding-left:20px;'>
									<tr style='background-color:#fff'>
									<th width='26%' height='79' align='center'> 
									<img src='".base_url('asset//domkin/images/logo.png')."' />
									<th colspan='2' align='left'></th>
									</tr>
									<tr>
									<th height='37' colspan='3' align='left' 
										style='font-size:22px; color:#333; text-decoration:none;'>Thank you for Registration</th>
									</tr>
									<tr>
									  <td colspan='3'>&nbsp;</td>
									  </tr>
									</table></td>
									</tr>
									</table>";
								
									//$this->email->initialize($config);
									$this->email->from($frommaila, 'bips.org.bd');
									$this->email->to($tomaila);
									//$this->email->bcc();
									$this->email->subject($subjecta);
									$this->email->message($email_bodya);
									$this->email->send();
									$this->session->set_userdata('newmemberId',$query);*/
									redirect('domkin/registrationSuccess', '');
						}
					}
				}
				else{
					$this->load->view('frontend/domkin/agent/registration',$data);
				}
		  }
		  elseif($regtype!="" && $regtype=='householder'){
		  
		  			$data['title'] = 'House Holder Registration';
		  			if($this->input->post('registerpayNow')){
					$this->form_validation->set_rules('staffname', 'Staff Name', 'trim|required');
					$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[kin_staff.s_email]|is_unique[agent.ag_email]|is_unique[householder.hh_email]');
				$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required|is_unique[kin_staff.s_phone_no]|is_unique[agent.ag_phone_no]|is_unique[householder.hh_phone_no]');
				$this->form_validation->set_rules('nidpass', 'National ID / Passport', 'trim|required|is_unique[kin_staff.s_nidPassport]|is_unique[agent.ag_nidPassport]|is_unique[householder.hh_nidPassport]');
					
					if($this->form_validation->run() != false){
					 $dob =$this->input->post('day').'/'.$this->input->post('monthd').'/'.$this->input->post('year');
					 $date = date('Y-m-d',strtotime($dob));
					 $dyear = date_diff(date_create($date), date_create('today'))->y;
					 $age = $dyear;
			
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000';
						$config['upload_path'] = './asset/uploads/domkin/householder/';
						$config['charset'] = "UTF-8";
						$new_name = "Householder_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['staffimg']['name']))
							{
								if($this->upload->do_upload('staffimg')){
									$upload_data	= $this->upload->data();
									$save['hh_photo']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= '';
									$save['hh_photo']	= $upload_data;	
								}
							}	
							
			
						$save['hh_name']	    = $this->input->post('staffname');
						$save['hh_fathers_name']	    = $this->input->post('fname');
						$save['hh_mothers_name']	    = $this->input->post('mname');
						$save['hh_spouse_name']	    = $this->input->post('spousename');
						$save['hh_gender']	    = $this->input->post('gender');
						$save['hh_pre_address']	    = $this->input->post('pre_address');
						$save['hh_per_address']	    = $this->input->post('per_address');
						$save['hh_origin']	    = $this->input->post('nationality');
						$save['hh_nidPassport']	    = $this->input->post('nidpass');
						$save['hh_email']	    = $this->input->post('email');
						$save['hh_phone_no']	    = $this->input->post('mobile');
						$save['hh_date_of_birth']	    = $this->input->post('day').' '.$this->input->post('month').' '.$this->input->post('year');
						$save['hh_age']	    = $age;
						$save['date']	    = date('Y-m-d');
						$save['active']	    = 1;
						
						$query = $this->Index_model->inertTable('householder', $save);
						if($query){
							$email=$this->input->post('email');
									$tomaila=$email;
									$frommaila="info@bips.org.bd";
									$subjecta="Thank ".$this->input->post('staffname')." for registration our domkin Service";
									$config = array (
												  'mailtype' => 'html',
												  'charset'  => 'utf-8',
												  'priority' => '1'
												   );
									$this->email->initialize($config);
									$this->email->set_newline('\r\n');
									$email_bodya ="
									<table width='95%' border='0' cellpadding='0' align='center' cellspacing='0' style=' 
									border:2px solid #f00; border-radius:13px; padding-left:20px;'>
									<tr style='background-color:#fff'>
									<th width='26%' height='79' align='center'> 
									<img src='".base_url('asset//domkin/images/logo.png')."' />
									<th colspan='2' align='left'></th>
									</tr>
									<tr>
									<th height='37' colspan='3' align='left' 
										style='font-size:22px; color:#333; text-decoration:none;'>Thank you for Registration</th>
									</tr>
									<tr>
									  <td colspan='3'>&nbsp;</td>
									  </tr>
									</table></td>
									</tr>
									</table>";
								
									//$this->email->initialize($config);
									$this->email->from($frommaila, 'bips.org.bd');
									$this->email->to($tomaila);
									//$this->email->bcc();
									$this->email->subject($subjecta);
									$this->email->message($email_bodya);
									$this->email->send();
									$this->session->set_userdata('newmemberId',$query);
									redirect('domkin/registrationSuccess', '');
						}
					}
				}
				else{
					$this->load->view('frontend/domkin/householder/registration',$data);
				}
		  }
	}
	
	
	public function registrationSuccess(){
		$data['title'] = 'Successfully Registration | bips.org.bd';
		$mid=$this->session->userdata('newmemberId');
		$data['menu']	= $this->Index_model->getDataById('menu','root_id',0,'m_id','asc','');
		$this->load->view('frontend/domkin/registrationSuccess',$data);
	}
	

public function userLogin()
     {
		 $data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
          $username = $this->input->post("username");
  		  $password = $this->input->post("password");
          $this->form_validation->set_rules("username", "Email", "trim|required");
          $this->form_validation->set_rules("password", "Password", "trim|required");

          if ($this->form_validation->run() == FALSE)
          {
              redirect('domkin');
          }
          else
          {
                    $usr_result = $this->Index_model->get_staffagentlogin($username, $password);
                    if ($usr_result > 0) //active user record is present
                    {
					
						$userType = $usr_result['userType'];
						if(isset($usr_result['agentResult'])){
							$agentQuery = $usr_result['agentResult'];
							if ($agentQuery > 0)
							  {
								  $sessiondata = array(
									'userAccessMail'=>$username,
									'userType'=>$userType,
									'userAccessName'=> $agentQuery['ag_name'],
									'userAccessId' => $agentQuery['ag_id'],
									'password' => TRUE
								   );
								   $this->session->set_userdata($sessiondata);
								   redirect("domkin/agent_profile/dashboard/");
							  }
						}
						elseif(isset($usr_result['houseResult'])){
							$houseQuery = $usr_result['houseResult'];
							if ($houseQuery > 0)
							  {
								  $sessiondata = array(
									'userAccessMail'=>$username,
									'userType'=>$userType,
									'userAccessName'=> $houseQuery['hh_name'],
									'userAccessId' => $houseQuery['hh_id'],
									'password' => TRUE
								   );
								   $this->session->set_userdata($sessiondata);
								   redirect("domkin/householder_profile/dashboard/");
							  }
							
						}
						elseif(isset($usr_result['staffResult'])){
							$staffQuery = $usr_result['staffResult'];
							if ($staffQuery > 0)
							  {
								  $sessiondata = array(
									'userAccessMail'=>$username,
									'userType'=>$userType,
									'userAccessName'=> $staffQuery['s_name'],
									'userAccessId' => $staffQuery['s_id'],
									'password' => TRUE
								   );
								   $this->session->set_userdata($sessiondata);
								   redirect("domkin/staff_profile/dashboard/");
							  }
						}
                    }
                    else
                    {
                     $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center" style="padding:7px; margin-bottom:5px">Invalid Email and password!</div>');
                     redirect('domkin');
                    }
          }
     }
	 
	
 function logout()
  	{
	  $sessiondata = array(
				'userAccessMail'=>'',
				'userAccessType'=>'',
				'userAccessName'=> '',
				'userAccessId' => '',
				'password' => FALSE
		 );
	$this->session->unset_userdata($sessiondata);
	$this->session->sess_destroy();
    redirect('domkin', 'refresh');
  }	

/***************************** Staff Profile ********************************/
	function staff_profile()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="Staff"){ 
			redirect("domkin");
		}

		$data['title']="Staff Profile | Domkin";
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$pagename= $this->uri->segment(3);
		$staffid= $this->uri->segment(4);
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$user_id,'s_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('kin_staff','s_id',$user_id,'','','s_id','desc');
		$data['staffdetails']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$staffid,'s_id','desc');
		$data['educationInfo'] = $this->Index_model->getAllItemTable('education_info','userid',$user_id,'','','eid','desc');
		$data['familyinfo'] = $this->Index_model->getAllItemTable('staff_family','s_id',$user_id,'','','sf_id','desc');
		
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		$this->load->view('frontend/domkin/staff/'.$pagename,$data);
	}
	
	
	
	function staff_action()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="Staff"){ 
			redirect("domkin");
		}

		$user_id = $this->session->userdata('userAccessId');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$pagename= $this->uri->segment(3);
		$staffid= $this->uri->segment(4);
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$user_id,'s_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('kin_staff','s_id',$user_id,'','','s_id','desc');
		$data['staffdetails']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$staffid,'s_id','desc');
		$data['educationInfo'] = $this->Index_model->getAllItemTable('education_info','userid',$user_id,'','','eid','desc');
		$data['familyinfo'] = $this->Index_model->getAllItemTable('staff_family','s_id',$user_id,'','','sf_id','desc');
		
		
		if($this->input->post('editProfile') && $this->input->post('editProfile')!=""){
			$this->form_validation->set_rules('staffname', 'Staff Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
			$this->form_validation->set_rules('nidpass', 'National ID / Passport', 'trim|required');
			if($this->form_validation->run() != false){
			
				///////////// Staff Information ////////////////////////////////////////////////////
            			$dateofbirth = $this->input->post('days').'/'.$this->input->post('monthds').'/'.$this->input->post('years');
						$birthDate = date('Y-m-d',strtotime($dateofbirth));
						$age = (date("dm", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], 
						$birthDate[2]))) > date("dm") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
			
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000';
						$config['upload_path'] = './asset/uploads/domkin/staff/';
						$config['charset'] = "UTF-8";
						$new_name = "Staff_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['staffimg']['name']))
							{
								if($this->upload->do_upload('staffimg')){
									$upload_data	= $this->upload->data();
									$save['s_photo']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= $this->input->post('stillimg');
									$save['s_photo']	= $upload_data;	
								}
							}	
							
			
						$save['s_name']	    = $this->input->post('staffname');
						$save['s_fathers_name']	    = $this->input->post('fname');
						$save['s_mothers_name']	    = $this->input->post('mname');
						$save['s_spouse_name']	    = $this->input->post('spousename');
						$save['s_gender']	    = $this->input->post('s_gender');
						$save['division']	    = $this->input->post('div_id');
						$save['district']	    = $this->input->post('district_id');
						$save['s_pre_address']	    = $this->input->post('pre_address');
						$save['s_per_address']	    = $this->input->post('per_address');
						$save['s_origin']	    = $this->input->post('nationality');
						$save['s_nidPassport']	    = $this->input->post('nidpass');
						$save['s_email']	    = $this->input->post('email');
						$save['s_phone_no']	    = $this->input->post('mobile');
						$save['s_date_of_birth']	    = $this->input->post('days').' '.$this->input->post('months').' '.$this->input->post('years');
						$save['s_age']	    = $age;
						$save['date']	    = date('Y-m-d');
						$save['active']	    = 1;
						
						if($this->input->post('s_id')!=""){
							$s_id=$this->input->post('s_id');
							$query = $this->Index_model->update_table('kin_staff','s_id',$s_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('kin_staff', $save);
							$s='Inserted';
						}
						
						
						$totalDegId = $this->input->post('totalDegId');
						$degreeEdu = $this->input->post('degree');
						$group = $this->input->post('group');
						$passingyear = $this->input->post('passingyear');
						$cgpa = $this->input->post('cgpa');
						
						for($i=0; $i <= count($totalDegId); $i++) {
								if(isset($degreeEdu[$i])) {
								  $dataDegre = array(
										  'userid'		 => $query,
										  'degree'		 => $degreeEdu[$i],
										  'edu_group'		=> $group[$i],
										  'passingyear'	=> $passingyear[$i],
										  'cgpa'	=> $cgpa[$i]
									  );
									 
							     if($totalDegId[$i]!="" || $totalDegId[$i]!=0){
							  	 	$this->Index_model->updateTable('education_info','eid',$totalDegId[$i],$dataDegre);
								  }
								 else{
									$this->Index_model->inertTable('education_info',$dataDegre);
								  }
								}
							}
				
				
			///////////// Staff Family ////////////////////////////////////////////////////		
						$sf_id = $this->input->post('sf_id');	
						$member_name	    = $this->input->post('membername');
						$relationship	    = $this->input->post('relationship');
						$m_age	    = $this->input->post('m_age');
						$mobile	    = $this->input->post('fmobile');
						$profession	    = $this->input->post('profession');
						$email	    = $this->input->post('email');
						$gender	    = $this->input->post('gender');
						$date	    = date('Y-m-d');
						
						for($i=0; $i <= count($sf_id); $i++) {
								if(isset($member_name[$i])) {
								  $dataFamily = array(
										  's_id'		 => $query,
										  'member_name'		 => $member_name[$i],
										  'relationship'		=> $relationship[$i],
										  'mobile'	=> $mobile[$i],
										  'gender'	=> $gender[$i],
										  'email'	=> $email[$i],
										  'm_age'	=> $m_age[$i],
										  'profession'	=> $profession[$i],
										  'date'	=> date('Y-m-d')
									  );
									 
							     if($sf_id[$i]!="" || $sf_id[$i]!=0){
							  	 	$this->Index_model->updateTable('staff_family','sf_id',$sf_id[$i],$dataFamily);
								  }
								 else{
									$this->Index_model->inertTable('staff_family',$dataFamily);
								  }
								}
							}
						
			
			///////////// Legal Gurdian ////////////////////////////////////////////////////				
						$dateofbirth = $this->input->post('lday').'/'.$this->input->post('lmonthd').'/'.$this->input->post('lyear');
						$birthDate = date('Y-m-d',strtotime($dateofbirth));
						$age = (date("dm", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], 
						$birthDate[2]))) > date("dm") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
						
						$savel['s_id']	    = $query;
						$savel['lg_name']	    = $this->input->post('lg_name');
						$savel['lg_fathers_name']	    = $this->input->post('lg_fathers_name');
						$savel['lg_mothers_name']	    = $this->input->post('lg_mothers_name');
						$savel['lg_spouse_name']	    = $this->input->post('lg_spouse_name');
						$savel['lg_age']	    = $age;
						$save['lg_date_of_birth']	    = $this->input->post('dayl').' '.$this->input->post('monthl').' '.$this->input->post('yearl');
						$savel['lg_origin']	    = $this->input->post('lg_origin');
						$savel['lg_pre_address']	    = $this->input->post('lg_pre_address');
						$savel['lg_per_address']	    = $this->input->post('lg_per_address');
						$savel['lg_email']	    = $this->input->post('lg_email');
						$savel['lg_phone_no']	    = $this->input->post('lg_phone_no');
						$savel['lg_nidPassport']	    = $this->input->post('lg_nidPassport');
						$savel['lg_gender']	    = $this->input->post('gender');
						$savel['date']	    = date('Y-m-d');
						
						if($this->input->post('lg_id')!=""){
							$lg_id=$this->input->post('lg_id');
							$this->Index_model->update_table('leagel_guardian','lg_id',$lg_id,$savel);
							$s='Updated';
						}
						else{
							$this->Index_model->inertTable('leagel_guardian', $savel);
							$s='Inserted';
						}
						
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/staff_profile/updateprofile', 'refresh');
			}
			else{
        		$this->load->view('frontend/domkin/staff/updateprofile', $data);
				}
		}
		elseif($this->input->post('changepassword')){
			$data['title'] = 'Error! Password Change';

			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			$old_password = sha1($this->input->post('oldpassword'));
			
			$queryCheck = $this->Index_model->checkOldPassDomkin('kin_staff','s_email',$old_password,'s_id',$user_id);
			
			if($queryCheck->num_rows() > 0 ){
				if($this->form_validation->run() != false){
					$password =sha1($this->input->post('newPass'));
					$passwordHints =$this->input->post('newPass');
					$dataUpdate = array(
						'password'		=> $password,
						'passwordHints'	=> $passwordHints,
						'date'	=> date('Y-m-d')
					);
					
					$query = $this->Index_model->updateTable('kin_staff','s_id',$user_id,$dataUpdate);
					$this->session->set_flashdata('globalMsg', '<h3 class="alert alert-success">Password Change Successfully </h3>');
					redirect('domkin/staff_profile/changepassword', 'refresh');
				}
				else{
        			$this->load->view('frontend/domkin/staff/changepassword', $data);
				}
			}
			else{
				$this->session->set_flashdata('globalMsg', '<div class="alert alert-danger" style="margin:0 10px; padding:5px; font-weight:bold">Old Password not match </div>');
				redirect('domkin/staff_profile/changepassword', 'refresh');
			}
		}
	}
	
	
/***************************** Agent Profile ********************************/
	function agent_profile()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="Agent"){ 
			redirect("domkin");
		}
		$data['title']="Agent Profile | Domkin";
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$pagename= $this->uri->segment(3);
		$staffid= $this->uri->segment(4);
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('agent','ag_id',$user_id,'ag_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('agent','ag_id',$user_id,'','','ag_id','desc');
		
		$data['stafflist'] = $this->Index_model->getAllItemTable('kin_staff','','','','','s_id','desc');
		$data['staffdetails']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$staffid,'s_id','desc');
		
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		$this->load->view('frontend/domkin/agent/'.$pagename,$data);
	}
	
	
	function agent_action()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="Agent"){ 
			redirect("domkin");
		}
		$data['title']="Agent Profile Update | Domkin";
		$user_id = $this->session->userdata('userAccessId');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$pagename= $this->uri->segment(3);
		$agentid= $this->uri->segment(4);
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('agent','ag_id',$user_id,'ag_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('agent','ag_id',$user_id,'','','ag_id','desc');
		$data['agentdetails']	= $this->Index_model->getOneItemTable('agent','ag_id',$agentid,'ag_id','desc');
		
		
		if($this->input->post('editProfile') && $this->input->post('editProfile')!=""){
			$this->form_validation->set_rules('agentname', 'Agent Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
			$this->form_validation->set_rules('nidpass', 'National ID / Passport', 'trim|required');
			if($this->form_validation->run() != false){
			
				///////////// Agent Information ////////////////////////////////////////////////////
            			$dateofbirth = $this->input->post('days').'/'.$this->input->post('monthds').'/'.$this->input->post('years');
						$birthDate = date('Y-m-d',strtotime($dateofbirth));
						$age = (date("dm", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], 
						$birthDate[2]))) > date("dm") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
			
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000';
						$config['upload_path'] = './asset/uploads/domkin/agent/';
						$config['charset'] = "UTF-8";
						$new_name = "Agent_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['agentimg']['name']))
							{
								if($this->upload->do_upload('agentimg')){
									$upload_data	= $this->upload->data();
									$save['ag_photo']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= $this->input->post('stillimg');
									$save['ag_photo']	= $upload_data;	
								}
							}	
							
			
						$save['ag_name']	    = $this->input->post('agentname');
						$save['ag_fathers_name']	    = $this->input->post('fname');
						$save['ag_mothers_name']	    = $this->input->post('mname');
						$save['ag_spouse_name']	    = $this->input->post('spousename');
						$save['ag_gender']	    = $this->input->post('ag_gender');
						$save['ag_pre_address']	    = $this->input->post('pre_address');
						$save['ag_per_address']	    = $this->input->post('per_address');
						$save['ag_origin']	    = $this->input->post('nationality');
						$save['ag_nidPassport']	    = $this->input->post('nidpass');
						$save['ag_email']	    = $this->input->post('email');
						$save['ag_phone_no']	    = $this->input->post('mobile');
						$save['ag_date_of_birth']	    = $this->input->post('days').' '.$this->input->post('months').' '.$this->input->post('years');
						$save['ag_age']	    = $age;
						$save['date']	    = date('Y-m-d');
						$save['active']	    = 1;
						
						if($this->input->post('ag_id')!=""){
							$ag_id=$this->input->post('ag_id');
							$query = $this->Index_model->update_table('agent','ag_id',$ag_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('agent', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/agent_profile/updateprofile', 'refresh');
			}
			else{
        		$this->load->view('frontend/domkin/agent/updateprofile', $data);
				}
		}
		elseif($this->input->post('changepassword')){
			$data['title'] = 'Error! Password Change';

			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			$old_password = sha1($this->input->post('oldpassword'));			
			$queryCheck = $this->Index_model->checkOldPassDomkin('agent','ag_email',$old_password,'ag_id',$user_id);
			
			if($queryCheck->num_rows() > 0 ){
				if($this->form_validation->run() != false){
					$password =sha1($this->input->post('newPass'));
					$passwordHints =$this->input->post('newPass');
					$dataUpdate = array(
						'password'		=> $password,
						'passwordHints'	=> $passwordHints,
						'date'	=> date('Y-m-d')
					);
					
					$query = $this->Index_model->updateTable('agent','ag_id',$user_id,$dataUpdate);
					$this->session->set_flashdata('globalMsg', '<h3 class="alert alert-success">Password Change Successfully </h3>');
					redirect('domkin/agent_profile/changepassword', 'refresh');
				}
				else{
        			$this->load->view('frontend/domkin/agent/changepassword', $data);
				}
			}
			else{
				$this->session->set_flashdata('globalMsg', '<div class="alert alert-danger" style="margin:0 10px; padding:5px; font-weight:bold">Old Password not match </div>');
				redirect('domkin/agent_profile/changepassword', 'refresh');
			}
		}
	}
	
/***************************** House Holder Profile ********************************/
	function householder_profile()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="House Holder"){ 
			redirect("domkin");
		}
		$data['title']="House Holder Profile | Domkin";
		$pagename= $this->uri->segment(3);
		$staffid= $this->uri->segment(4);
		
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('householder','hh_id',$user_id,'hh_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('householder','hh_id',$user_id,'','','hh_id','desc');
		$data['stafflist'] = $this->Index_model->getAllItemTable('kin_staff','','','','','s_id','desc');
		$data['staffdetails']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$staffid,'s_id','desc');
		
		$data['policerep'] = $this->Index_model->getAllItemTable('police_report','','','','','ps_id','desc');
		$data['reportsUpdate'] = $this->Index_model->getAllItemTable('police_report','ps_id',$staffid,'','','ps_id','desc');
		
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		$this->load->view('frontend/domkin/householder/'.$pagename,$data);
	}	
	
	function householder_action()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="House Holder"){ 
			redirect("domkin");
		}
		$data['title']="Agent Profile Update | Domkin";
		$user_id = $this->session->userdata('userAccessId');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$pagename= $this->uri->segment(3);
		$householderid= $this->uri->segment(4);
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('householder','hh_id',$user_id,'hh_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('householder','hh_id',$user_id,'','','hh_id','desc');
		$data['householderdetails']	= $this->Index_model->getOneItemTable('householder','hh_id',$householderid,'hh_id','desc');
		
		
		if($this->input->post('editProfile') && $this->input->post('editProfile')!=""){
			$this->form_validation->set_rules('householdername', 'Agent Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile', 'Mobile No', 'trim|required');
			$this->form_validation->set_rules('nidpass', 'National ID / Passport', 'trim|required');
			if($this->form_validation->run() != false){
			
				///////////// Agent Information ////////////////////////////////////////////////////
            			$dateofbirth = $this->input->post('days').'/'.$this->input->post('monthds').'/'.$this->input->post('years');
						$birthDate = date('Y-m-d',strtotime($dateofbirth));
						$age = (date("dm", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], 
						$birthDate[2]))) > date("dm") ? ((date("Y") - $birthDate[2]) - 1) : (date("Y") - $birthDate[2]));
			
						$config['allowed_types'] = '*';
						$config['remove_spaces'] = true;
						$config['max_size'] = '1000';
						$config['upload_path'] = './asset/uploads/domkin/householder/';
						$config['charset'] = "UTF-8";
						$new_name = "Agent_".time();
						$config['file_name'] = $new_name;
						$this->load->library('upload', $config);
						$this->upload->initialize($config);
							if (isset($_FILES['householderimg']['name']))
							{
								if($this->upload->do_upload('householderimg')){
									$upload_data	= $this->upload->data();
									$save['hh_photo']	= $upload_data['file_name'];
								}
								else{
									$upload_data	= $this->input->post('stillimg');
									$save['hh_photo']	= $upload_data;	
								}
							}	
							
			
						$save['hh_name']	    = $this->input->post('householdername');
						$save['hh_fathers_name']	    = $this->input->post('fname');
						$save['hh_mothers_name']	    = $this->input->post('mname');
						$save['hh_spouse_name']	    = $this->input->post('spousename');
						$save['hh_gender']	    = $this->input->post('hh_gender');
						$save['hh_pre_address']	    = $this->input->post('pre_address');
						$save['hh_per_address']	    = $this->input->post('per_address');
						$save['hh_origin']	    = $this->input->post('nationality');
						$save['hh_nidPassport']	    = $this->input->post('nidpass');
						$save['hh_email']	    = $this->input->post('email');
						$save['hh_phone_no']	    = $this->input->post('mobile');
						$save['hh_date_of_birth']	    = $this->input->post('days').' '.$this->input->post('months').' '.$this->input->post('years');
						$save['hh_age']	    = $age;
						$save['date']	    = date('Y-m-d');
						$save['active']	    = 1;
						
						if($this->input->post('hh_id')!=""){
							$hh_id=$this->input->post('hh_id');
							$query = $this->Index_model->update_table('householder','hh_id',$hh_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('householder', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/householder_profile/updateprofile', 'refresh');
			}
			else{
        		$this->load->view('frontend/domkin/householder/updateprofile', $data);
				}
		}
		elseif($this->input->post('changepassword')){
			$data['title'] = 'Error! Password Change';

			$this->form_validation->set_rules('oldpassword', 'Old Password', 'trim|required');
			$this->form_validation->set_rules('newPass', 'New Password', 'trim|required|matches[confirmpassword]');
			$this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required');
			$old_password = sha1($this->input->post('oldpassword'));			
			$queryCheck = $this->Index_model->checkOldPassDomkin('householder','hh_email',$old_password,'hh_id',$user_id);
			
			if($queryCheck->num_rows() > 0 ){
				if($this->form_validation->run() != false){
					$password =sha1($this->input->post('newPass'));
					$passwordHints =$this->input->post('newPass');
					$dataUpdate = array(
						'password'		=> $password,
						'passwordHints'	=> $passwordHints,
						'date'	=> date('Y-m-d')
					);
					
					$query = $this->Index_model->updateTable('householder','hh_id',$user_id,$dataUpdate);
					$this->session->set_flashdata('globalMsg', '<h3 class="alert alert-success">Password Change Successfully </h3>');
					redirect('domkin/householder_profile/changepassword', 'refresh');
				}
				else{
        			$this->load->view('frontend/domkin/householder/changepassword', $data);
				}
			}
			else{
				$this->session->set_flashdata('globalMsg', '<div class="alert alert-danger" style="margin:0 10px; padding:5px; font-weight:bold">Old Password not match </div>');
				redirect('domkin/householder_profile/changepassword', 'refresh');
			}
		}
	}
	
	
	
	function report_action()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="House Holder"){ 
			redirect("domkin");
		}
		$data['title']="Agent Profile Update | Domkin";
		$user_id = $this->session->userdata('userAccessId');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$userType = $this->session->userdata('userType');
		$pagename= $this->uri->segment(3);
		$householderid= $this->uri->segment(4);
		
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('householder','hh_id',$user_id,'hh_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('householder','hh_id',$user_id,'','','hh_id','desc');
		$data['householderdetails']	= $this->Index_model->getOneItemTable('householder','hh_id',$householderid,'hh_id','desc');
		$data['policerep'] = $this->Index_model->getAllItemTable('police_report','','','','','ps_id','desc');
		
		if($this->input->post('police_report') && $this->input->post('police_report')!=""){
			$data['reportsUpdate'] = $this->Index_model->getAllItemTable('police_report','ps_id',$householderid,'','','ps_id','desc');
			$this->form_validation->set_rules('ps_title', 'Report Title', 'trim|required');
			if($this->form_validation->run() != false){
			
				///////////// Agent Information ////////////////////////////////////////////////////
            			
						$save['userType']	    = $userType;
						$save['userid']	    = $user_id;
						$save['ps_title']	    = $this->input->post('ps_title');
						$save['ps_report']	    = $this->input->post('ps_report');
						$save['ps_status']	    = 1;
						
						if($this->input->post('ps_id')!=""){
							$ps_id=$this->input->post('ps_id');
							$query = $this->Index_model->update_table('police_report','ps_id',$ps_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('police_report', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/householder_profile/policereport', 'refresh');
			}
			else{
        		$this->load->view('frontend/domkin/householder/police_report_action', $data);
				}
		}
		elseif($this->input->post('government_report') && $this->input->post('government_report')!=""){
			$this->form_validation->set_rules('ps_title', 'Report Title', 'trim|required');
			if($this->form_validation->run() != false){
			
				///////////// Agent Information ////////////////////////////////////////////////////
            			
						$save['userType']	    = $userType;
						$save['userid']	    = $user_id;
						$save['lgca_title']	    = $this->input->post('lgca_title');
						$save['lgca_report']	    = $this->input->post('lgca_report');
						$save['lgca_status']	    = 1;
						
						if($this->input->post('lgca_id')!=""){
							$lgca_id=$this->input->post('lgca_id');
							$query = $this->Index_model->update_table('gov_report','lgca_id',$lgca_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('gov_report', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/householder_profile/governmentreport', 'refresh');
			}
			else{
        		$this->load->view('frontend/domkin/householder/government_report_action', $data);
				}
		}
	}
	
	
	
	
	function requisition()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="House Holder"){ 
			redirect("domkin");
		}
		$data['title']="House Holder Profile | Domkin";
		$pagename= $this->uri->segment(3);
		$staffid= $this->uri->segment(4);
		
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$user_id = $this->session->userdata('userAccessId');
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('householder','hh_id',$user_id,'hh_id','desc');
		$data['userinfoUpdate'] = $this->Index_model->getAllItemTable('householder','hh_id',$user_id,'','','hh_id','desc');
		$data['stafflist'] = $this->Index_model->getAllItemTable('kin_staff','','','','','s_id','desc');
		$data['staffdetails']	= $this->Index_model->getOneItemTable('kin_staff','s_id',$staffid,'s_id','desc');
		
		$data['shoppingdata'] = $this->Index_model->getAllItemTable('shopping','','','','','sh_id','desc');
		$data['shoppingUpdate'] = $this->Index_model->getAllItemTable('shopping','sh_id',$staffid,'','','sh_id','desc');
		
		$data['canteendata'] = $this->Index_model->getAllItemTable('canteen','','','','','c_id','desc');
		$data['canteenUpdate'] = $this->Index_model->getAllItemTable('canteen','c_id',$staffid,'','','c_id','desc');
		
		$data['staffdata'] = $this->Index_model->getAllItemTable('staff_requisition','','','','','sr_id','desc');
		$data['staffReqUpdate'] = $this->Index_model->getAllItemTable('staff_requisition','sr_id',$staffid,'','','sr_id','desc');
		
		$menuid=array('2','3','5');
		$data['footermenu']	= $this->Index_model->getDataByIdArray('menu','m_id',$menuid,'m_id','desc','3');
		$this->load->view('frontend/domkin/householder/'.$pagename,$data);
	}	
	
	
	function requisition_action()
	{
		if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')!="House Holder"){ 
			redirect("domkin");
		}
		$data['title']="Agent Profile Update | Domkin";
		$user_id = $this->session->userdata('userAccessId');
		$userMail = $this->session->userdata('userAccessMail');
		$userName = $this->session->userdata('userAccessName');
		$userType = $this->session->userdata('userType');
		$pagename= $this->uri->segment(3);
		$requid= $this->uri->segment(4);
		$data['stafflist'] = $this->Index_model->getAllItemTable('kin_staff','','','','','s_id','desc');
		$data['domkin_menu'] = $this->Index_model->getAllItemTable('domkin_menu','root_id',0,'status',1,'m_id','desc');
		$data['userProfile']	= $this->Index_model->getOneItemTable('householder','hh_id',$user_id,'hh_id','desc');
		
		if($this->input->post('shopping_action') && $this->input->post('shopping_action')!=""){
			$data['shoppingUpdate'] = $this->Index_model->getAllItemTable('shopping','sh_id',$requid,'','','sh_id','desc');
			$this->form_validation->set_rules('shop_type', 'Shopping Type', 'trim|required');
			if($this->form_validation->run() != false){
            			
						$save['s_id']	    = $this->input->post('s_id');
						$save['hh_id']	    = $user_id;
						$save['shop_type']	    = $this->input->post('shop_type');
						$save['shop_price']	    = $this->input->post('shop_price');
						$save['shop_details']	    = $this->input->post('shop_details');
						
						if($this->input->post('sh_id')!=""){
							$sh_id=$this->input->post('sh_id');
							$query = $this->Index_model->update_table('shopping','sh_id',$sh_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('shopping', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/requisition/shopping', 'refresh');
			}
			else{
        		$this->load->view('frontend/domkin/householder/shopping_action', $data);
				}
		}
		elseif($this->input->post('canteen_action') && $this->input->post('canteen_action')!=""){
			$data['canteenUpdate'] = $this->Index_model->getAllItemTable('canteen','c_id',$requid,'','','c_id','desc');
			//echo $this->input->post('canteen_action');
			/*$this->form_validation->set_rules('cant_type', 'Canteen Type', 'trim|required');
			if($this->form_validation->run() != false){*/
			
				///////////// Agent Information ////////////////////////////////////////////////////
						$canttype = $this->input->post('cant_type');
						if($canttype=="Break First"){
							$canttime = "5 AM - 10 AM";
						}
						elseif($canttype=="Lunch"){
							$canttime = "11 AM - 2 PM";
						}
						elseif($canttype=="Snacks"){
							$canttime = "4 PM - 6 PM";
						}
						elseif($canttype=="Dinner"){
							$canttime = "6 PM - 8 PM";
						}
						
				
						$save['s_id']	    	= $this->input->post('s_id');
						$save['hh_id']	    	= $user_id;
						$save['cant_type']	    = $this->input->post('cant_type');
						$save['cant_time']	    = $canttime	;
						$save['item_type']	    = $this->input->post('item_type');
						$save['menuitem']	    = $this->input->post('menuitem');
						$save['mealperson']	    = $this->input->post('qty');
						$save['unitprice']	    = $this->input->post('unitprice');
						$save['totalprice']	    = $this->input->post('totalprice');
						$save['delivery_place']	    = $this->input->post('delivery_place');
						
						if($this->input->post('c_id')!=""){
							$c_id=$this->input->post('c_id');
							$query = $this->Index_model->update_table('canteen','c_id',$c_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('canteen', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/requisition/canteen', 'refresh');
			/*}
			else{
        		$this->load->view('frontend/domkin/householder/canteen_action', $data);
				}*/
		}
		elseif($this->input->post('staffreq_action') && $this->input->post('staffreq_action')!=""){
						$save['s_id']	    = $this->input->post('s_id');
						$save['hh_id']	    = $user_id;
						$save['status']	    = "Pending";
						
						if($this->input->post('sr_id')!=""){
							$sr_id=$this->input->post('sr_id');
							$query = $this->Index_model->update_table('staff_requisition','sr_id',$sr_id,$save);
							$s='Updated';
						}
						else{
							$query = $this->Index_model->inertTable('staff_requisition', $save);
							$s='Inserted';
						}
						
				$this->session->set_flashdata('successMsg', '<h2 class="alert alert-success">Successfully '.$s.'</h2>');
				redirect('domkin/requisition/staff', 'refresh');
		}
	}
	
	///////////  All  Delete///////////////////////
public function deleteData($tableName,$colId){

	if(!$this->session->userdata('userAccessMail')) redirect("domkin");
		$cID = $this->input->get('deleteId');
		$this->Index_model->deletetable_row($tableName, $colId, $cID);
	}
	
	
	
}

?>
