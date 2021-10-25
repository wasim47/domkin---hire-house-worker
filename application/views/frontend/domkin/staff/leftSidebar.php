<div class="left-sidebar">
    <h2 style="margin-bottom:20px;"><?php echo $userProfile['s_name'];?></h2>
    <div class="col-sm-12" style="margin:3px 0; padding:0;">
         <div class="boutuqueList">
                <ul>
                 <li><a href="<?php echo base_url('domkin/staff_profile/dashboard');?>" class="selected">Dashboard<span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('domkin/staff_profile/updateprofile');?>">Update Profile<span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('domkin/staff_profile/changepassword');?>">Change Password<span class="fa fa-angle-double-right pull-right"></span></a></li>
                </ul>	
            </div>
    </div>
</div>