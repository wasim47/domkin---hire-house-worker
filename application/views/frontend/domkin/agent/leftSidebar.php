<div class="left-sidebar">
    <h2><?php echo $userProfile['ag_name'];?></h2>
    <div class="col-sm-12" style="margin:3px 0; padding:0;">
         <div class="boutuqueList">
                <ul>
                    <li><a href="<?php echo base_url('domkin/agent_profile/dashboard');?>">Dashboard<span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('domkin/agent_profile/stafflist');?>">Staff List <span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('domkin/agent_profile/updateprofile');?>">Update Profile<span class="fa fa-angle-double-right pull-right"></span></a></li>
                    <li><a href="<?php echo base_url('domkin/agent_profile/changepassword');?>">Change Password<span class="fa fa-angle-double-right pull-right"></span></a></li>
                </ul>	
            </div>
    </div>
</div>