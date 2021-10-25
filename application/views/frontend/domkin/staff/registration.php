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
           	<div class="col-sm-12 col-md-7 col-md-offset-1">
   <?php echo form_open_multipart('', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
               <div id="registration_form">
                 <div class="form-group" style="margin-bottom:30px;">
               	 <h1 style="color:#333; text-align:center"><?php echo $title;?></h1>
                </div>
                
                <div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Staff Name <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                      <input name="staffname" type="text"  class="form-control"  required="required" value="<?php echo set_value('memberName'); ?>" placeholder="Staff Name"/>
                    <?php echo form_error('staffname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                    </div>
                </div>
                <div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Father's Name</label>
                    <div class="col-sm-7">
                      <input name="fname" id="fname" type="text"  class="form-control" value="<?php echo set_value('fname'); ?>" placeholder="Father`s Name"/>
                    <?php echo form_error('fname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-4" style=" margin-right:20px">Mother's Name</label>
                    <div class="col-sm-7">
                      <input name="mname" id="mname" type="text"  class="form-control"  required="required" value="<?php echo set_value('mname');  ?>" placeholder="Mother`s Name"/>
                    <?php echo form_error('mname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
               </div>
                </div>
                <?php /*?><div class="form-group">       
                    <label class="control-label col-sm-4" style=" margin-right:20px">Spouse Name </label>
                    <div class="col-sm-7">
                      <input name="spousename" id="spousename" type="text"  class="form-control" value="<?php echo set_value('spousename'); ?>" placeholder="Spouse Name"/>
               </div>
                </div><?php */?>
                <div class="form-group">       
                    <label class="control-label col-sm-4" style=" margin-right:20px">Date of Birth</label>
                    <div class="col-sm-7">
                      <select name="day" class="form-control col-sm-7" style="width:28%; margin-right:10px; text-align:center;">
                      	<option value="">Day</option>
                        <?php 
						for($d=0; $d<=31; $d++){
						echo '<option value="'.$d.'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$d.'</option>';
						}
						?>
                      </select>
                      <select name="month" class="form-control col-sm-7" style="width:38%; margin-right:10px;text-align:center;">
                      	<option value="">Month</option>
                        <?php 
						$montharray=array('January','February','March','April','May','June','July','August','September','October','November','December');
						for($m=0; $m<=count($montharray); $m++){
						echo '<option value="'.$montharray[$m].'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$montharray[$m].'</option>';
						}
						?>
                      </select>
                      <select name="year" class="form-control col-sm-7" style="width:28%;text-align:center;">
                      	<option value="">Year</option>
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
                      <input type="radio" name="gender" value="Male" /> Male
                      <input type="radio" name="gender" value="Female" /> Female
                      
               </div>
                </div>
                <?php /*?><div class="form-group">       
                    <label class="control-label col-sm-4" style=" margin-right:20px">Natinality/Origin </label>
                    <div class="col-sm-7">
                      <input name="nationality" id="nationality" type="text"  class="form-control" value="<?php echo set_value('nationality'); ?>" placeholder="Natinality/Origin "/>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-4" style=" margin-right:20px">National ID/Passport <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                      <input name="nidpass" id="nidpass" type="text"  class="form-control"  required="required" value="<?php echo set_value('nidpass'); ?>" placeholder="National ID/Passport"/>
                    <?php echo form_error('nidpass', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                </div>
                </div><?php */?>
                <div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Mobile <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                       <input name="mobile" id="mobile" type="text"  class="form-control"  required="required"
                                         value="<?php echo set_value('mobile'); ?>" placeholder="Mobile No."/>
                     <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                
                </div>
                 
                 
                
                <?php /*?><div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Present Address</label>
                    <div class="col-sm-7">
                       <textarea name="pre_address" rows="6" cols="40"  class="form-control" placeholder="Present Address"></textarea>
                </div>
                </div>
               <div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Permanent Address</label>
                    <div class="col-sm-7">
                       <textarea name="per_address" rows="6" cols="40"  class="form-control" placeholder="Permanent Address"></textarea>
                </div>
               </div>
               
               <div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Photo</label>
                    <div class="col-sm-7">
                  <input name="staffimg" id="staffimg" type="file"  class="form-control" />
                </div>
                
                </div>
                <div class="form-group">        
                    <label class="control-label col-sm-4" style=" margin-right:20px">Email <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                  <input name="email" id="email" type="email"  class="form-control"  required="required" 
                                        value="<?php echo set_value('email'); ?>" placeholder="Email Address"/>
                    <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                
                </div><?php */?>
                
                
                <div class="col-md-5 col-md-offset-5" style="margin-bottom:20px">        
                     <input type="button" name="registerpayLater" class="btn btn-primary" value="Reset" onclick="resetbtn();"/>
                      <input type="submit" name="registerpayNow" class="btn btn-primary" style="background:#066" value="Submit"/>
                </div>
                
          
           </div>
            <?php echo form_close(); ?>
          </div>
          
          <div class="col-sm-1"></div>
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