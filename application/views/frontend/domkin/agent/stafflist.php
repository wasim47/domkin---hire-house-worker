<?php $this->load->view('frontend/domkin/header');?>

<style>
.form-control{
	background:#f5f5f5;
	border-radius:0;
}
</style>
<script>
function resetbtn(){
 var conf = window.confirm("Are you sure. Do you want to reset this form ?");
 if(conf==true){
 	document.getElementById("form1").reset();
 }
 else{
 	return false;
 }
}
</script>
<div class="header_img1">
        <div class="container">
       	   <div class="row" style="margin-top:20px;">
           <div class="col-sm-2">
					<?php include("leftSidebar.php");?>
				</div>
           	<div class="col-sm-12 col-md-7">
            	<div  style="margin:0 10px;">
                    <table class="table table-striped" width="100%">
                                        <thead>
                                          <tr>
                                            <th width="2%">SI</th>
                                            <th width="26%">Staff Name</th>
                                            <th width="17%">Contact</th>
                                            <th width="26%">Designation</th>
                                            <th width="11%">Photo</th>
                                            <th width="18%">Details</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    <?php
                    $i=0;
                    foreach($stafflist->result() as $staff){
                        $s_id=$staff->s_id;
                        $staffname=$staff->s_name;
						$s_phone_no=$staff->s_phone_no;
                        $s_age=$staff->s_age;
                        $s_origin=$staff->s_origin;	
                        $s_photo=$staff->s_photo;	
                        
                        $queryval = $this->db->query("select * from emp_info where s_id='".$s_id."'");
						if($queryval->num_rows() > 0){
							foreach($queryval->result() as $queemp);
							$emp_designation= $queemp->emp_designation;
							$emp_type = $queemp->emp_type;	
							$emp_expertise = $queemp->emp_expertise;
							$emp_salary_range = $queemp->emp_salary_range;
						}
						else{
							$emp_designation= '';
							$emp_type = '';
							$emp_expertise = '';
							$emp_salary_range ='';
						}
                        $i++;
                    ?>
                     <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $staffname; ?></td>
                        <td><?php echo $s_phone_no; ?></td>
                        <td><?php echo $emp_designation; ?></td>
                        <td><img src="<?php echo base_url('asset/uploads/domkin/staff/'.$s_photo);?>" alt="<?php echo $staffname;?>" title="<?php echo $staffname;?>" style="width:100%; height:auto"></td>
                         <td><a href="<?php echo base_url("domkin/agent_profile/staff_details/".$s_id);?>" class="btn btn-info" style="padding:5px">View Details</a></td>
                      </tr>
                    <?php
                    }
                    ?>
                     </tbody>
                                      </table>
                </div>
           </div>
          
           <div class="col-md-3 col-sm-12 hidden-sm hidden-xs">
            	<div class="title4">DIVISIONAL JOBS</div>
                <div class="map_bg">
                	<span class="rangpur">Rangpur<br>( 60 )</span>
                    <span class="mymensingh">Mymensingh<br>( 60 )</span>
                    <span class="sylhet">Sylhet<br>( 60 )</span>
                    <span class="rajshahi">Rajshahi<br>( 60 )</span>
                    <span class="dhaka">Dhaka<br>( 60 )</span>
                    <span class="chittagong">Chittagong<br>( 60 )</span>
                    <span class="khulna">Khulna<br>( 60 )</span>
                    <span class="barishal">Barishal<br>( 60 )</span>
                    
                    
                </div>
                
            </div>
           
     </div>
     </div>
     </div>
<?php $this->load->view('frontend/domkin/footer');?>