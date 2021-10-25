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
           <div class="col-sm-12 col-md-2">
					<?php include("leftSidebar.php");?>
				</div>
           	<div class="col-sm-12 col-md-7">
   <?php echo form_open_multipart('domkin/staff_action', array('class'=>'form-horizontal','name'=>'form1','id'=>'form1')); ?>
   				<?php echo $this->session->flashdata('globalMsg');?>
               <div id="registration_form">
                 <div class="form-group" style="margin-bottom:30px;">
               	 <h1 style="color:#333; text-align:center"><?php echo 'Change Password';?></h1>
                </div>
                
                
                  <div class="form-group">
                    <label class="control-label col-sm-4" style=" margin-right:20px">Old Password</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" name="oldpassword" required value="<?php echo set_value('oldpassword'); ?>" id="disabledinput" placeholder="Old Password"  style="width:100%; padding:6px"/>
                      <?php echo form_error('oldpassword','<p class="label label-danger">','</p>'); ?>
                    </div>
          		  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-4" style=" margin-right:20px">Password</label>
                    <div class="col-sm-7">
                      <input type="password" class="form-control" name="newPass" required value="<?php echo set_value('password'); ?>" id="disabledinput" placeholder="Password"  style="width:100%; padding:6px"/>
                      <?php echo form_error('newPass','<p class="label label-danger">','</p>'); ?>
                    </div>
          		  </div>
          	      <div class="form-group">
                <label class="control-label col-sm-4" style=" margin-right:20px">Confirm Password</label>
                <div class="col-sm-7">
                  <input type="password" class="form-control" required style="margin:0px 0 10px 0;width:100%; padding:6px"  name="confirmpassword" value="<?php echo set_value('confirmpassword'); ?>" placeholder="xxxxx"><?php echo form_error('confirmpassword','<p class="label label-danger">','</p>'); ?>
                </div>
            </div>
                
                <div class="col-md-5 col-md-offset-5" style="margin-bottom:20px">        
                     <input type="button" class="btn btn-primary" value="Reset" onclick="resetbtn();"/>
                      <input type="submit" name="changepassword" class="btn btn-primary" style="background:#066" value="Submit"/>
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