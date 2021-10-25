<?php $this->load->view('frontend/domkin/header');?>

<?php
$id = $this->session->userdata('userAccessId');
				
	
?>
<style>
.form-control{
	width:100%;
	background:#eaeaea;
	float:left;
}
.control-label{
	text-transform:uppercase;
	font-family:Arial, Helvetica, sans-serif;
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
<script>
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
	
	function getCity(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	


	function getDistrict(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}


		
</script>
<div class="header_img1">
        <div class="container">
       	   <div class="row" style="margin-top:20px;">
           <div class="col-sm-12 col-md-2">
					<?php include("leftSidebar.php");?>
				</div>
           	<div class="col-sm-12 col-md-7">
   <?php echo form_open_multipart('domkin/agent_action', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
              
               <div id="registration_form" style="margin:0 10px;">
               	<div><?php echo $this->session->flashdata('successMsg');?></div>
                       
                          <div class="panel-body">
                             <div>
                     <div class="form-group" style="margin-bottom:30px;">
                     <h1 style="color:#333; text-align:center"><?php echo 'Update Profile';?></h1>
                    </div>
                    
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Agent Name <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                          <input name="agentname" type="text"  class="form-control" style="border:1px solid #ccc;"  required="required" value="<?php echo $userProfile['ag_name'];?>" placeholder="Staff Name"/>
                        <?php echo form_error('agentname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                        </div>
                    </div>
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Father's Name</label>
                        <div class="col-sm-7">
                          <input name="fname" id="fname" type="text"  style="border:1px solid #ccc;" class="form-control" value="<?php echo $userProfile['ag_fathers_name'];?>" placeholder="Father`s Name"/>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Mother's Name</label>
                        <div class="col-sm-7">
                          <input name="mname" id="mname" type="text"  style="border:1px solid #ccc;" class="form-control" required="required" value="<?php echo $userProfile['ag_mothers_name'];?>" placeholder="Mother`s Name"/>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Spouse Name </label>
                        <div class="col-sm-7">
                          <input name="spousename" id="spousename" type="text"  style="border:1px solid #ccc;" class="form-control" value="<?php echo $userProfile['ag_spouse_name'];?>" placeholder="Spouse Name"/>
                   </div>
                    </div>
                    
                    <?php $dob = $userProfile['ag_date_of_birth'];
                    list($day,$month,$year)=explode(' ',$dob);
                    ?>
                    
                    
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Date of Birth</label>
                        <div class="col-sm-7">
                          <select name="day" class="form-control col-sm-7" style="width:28%; margin-right:10px;border:1px solid #ccc; text-align:center;">
                            <option value="<?php echo $day;?>"><?php echo $day;?></option>
                            <?php 
                            for($d=0; $d<=31; $d++){
                            echo '<option value="'.$d.'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$d.'</option>';
                            }
                            ?>
                          </select>
                          <select name="month" class="form-control col-sm-7" style="width:38%; border:1px solid #ccc; margin-right:10px;text-align:center;">
                            <option value="<?php echo $month;?>"><?php echo $month;?></option>
                            <?php 
                            $montharray=array('January','February','March','April','May','June','July','August','September','October','November','December');
                            for($m=0; $m<=count($montharray); $m++){
                            echo '<option value="'.$montharray[$m].'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$montharray[$m].'</option>';
                            }
                            ?>
                          </select>
                          <select name="year" class="form-control col-sm-7" style="width:28%;border:1px solid #ccc; text-align:center;">
                            <option value="<?php echo $year;?>"><?php echo $year;?></option>
                            <?php 
                            for($y=1950; $y<=date('Y'); $y++){
                            echo '<option value="'.$y.'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$y.'</option>';
                            }
                            ?>
                          </select>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Gender</label>
                        <div class="col-sm-7">
                        <?php $gender = $userProfile['ag_gender'];?>
                          <input type="radio" name="gender" value="Male" <?php if($gender=='Male'){?> checked="checked" <?php } ?> /> Male
                          <input type="radio" name="gender" value="Female"  <?php if($gender=='Female'){?> checked="checked" <?php } ?> /> Female
                          
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Natinality/Origin </label>
                        <div class="col-sm-7">
                          <input name="nationality" id="nationality" type="text"  style="border:1px solid #ccc;" class="form-control" value="<?php echo $userProfile['ag_origin'];?>" placeholder="Natinality/Origin "/>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">National ID/Passport <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                          <input name="nidpass" id="nidpass" type="text"  style="border:1px solid #ccc;" class="form-control"  required="required" value="<?php echo $userProfile['ag_nidPassport'];?>" placeholder="National ID/Passport"/>
                        <?php echo form_error('nidpass', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                    </div>
                    </div>
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Mobile <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                           <input name="mobile" id="mobile" type="text" style="border:1px solid #ccc;" class="form-control" required="required" value="<?php echo $userProfile['ag_phone_no'];?>" placeholder="Mobile No."/>
                         <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                    </div>
                    
                    </div>
                     
                     
                    
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Present Address</label>
                        <div class="col-sm-7">
                           <textarea name="pre_address" rows="6" cols="40"  style="border:1px solid #ccc;" class="form-control" placeholder="Present Address"><?php echo $userProfile['ag_pre_address'];?></textarea>
                    </div>
                    </div>
                   <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Permanent Address</label>
                        <div class="col-sm-7">
                           <textarea name="per_address" rows="6" cols="40"  style="border:1px solid #ccc;" class="form-control" placeholder="Permanent Address"><?php echo $userProfile['ag_per_address'];?></textarea>
                    </div>
                   </div>
                   
                   <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Photo</label>
                        <div class="col-sm-7">
                      <input name="agentimg" id="agentimg" type="file"  class="form-control"  style="border:1px solid #ccc;"/>
                      <img src="<?php echo base_url('asset/uploads/domkin/agent/'.$userProfile['ag_photo']);?>" style="width:150px; height:auto;border:1px solid #ccc; margin:5px" />
                    </div>
                    
                    </div>
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Email <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                      <input name="email" id="email" type="email"  class="form-control"  required="required"  style="border:1px solid #ccc;"
                                            value="<?php echo $userProfile['ag_email'];?>" placeholder="Email Address"/>
                        <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                    </div>
                    
                    </div>
                    
                    
                    </div>
                         </div>
               
                <div class="col-md-5 col-md-offset-5" style="margin-bottom:20px">        
               		 <input type="hidden" name="ag_id" value="<?php echo $id;?>">
                    <input type="hidden" name="stillimg" value="<?php echo $userProfile['ag_photo'];?>">
                    <input type="button" class="btn btn-primary" value="Reset" onclick="resetbtn();"/>
                    <input type="submit" name="editProfile" class="btn btn-primary" style="background:#066" value="Submit"/>
                </div>
                
          
           </div>
            <?php echo form_close(); ?>
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