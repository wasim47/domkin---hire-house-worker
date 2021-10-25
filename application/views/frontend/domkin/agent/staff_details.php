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
                    <table class="table" width="100%">
                        <tr>
                            <th width="26%">Staff Name</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_name']; ?></th>
                   	  </tr>
                        
                        <tr>
                            <th width="26%">Father's Name</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_fathers_name']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Mother's Name</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_mothers_name']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Spose Name</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_spouse_name']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Contact No.</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_phone_no']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Email</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_email']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Password</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['password']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Date of Birth</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_date_of_birth']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Age</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_age']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Gender</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_gender']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Origin</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_origin']; ?></th>
                   	  </tr>
                        <tr>
                            <th width="26%">Photo</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_photo']; ?></th>
                   	  </tr>   
                        <tr>
                            <th width="26%">NID/Passport</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_nidPassport']; ?></th>
                   	  </tr> 
                        <tr>
                            <th width="26%">Present Address</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_pre_address']; ?></th>
                   	  </tr>   
                        <tr>
                            <th width="26%">Permanent Address</th>
                            <th width="1%">:</th>
                            <th width="73%"><?php echo $staffdetails['s_per_address']; ?></th>
                   	  </tr>                   
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