<div class="left-sidebar">
	<img src="<?php echo base_url('asset/uploads/domkin/householder/'.$userProfile['hh_photo']);?>" style="width:100%; height:auto" />
    
    <h2><?php echo $userProfile['hh_name'];?></h2>
    <div class="col-sm-12" style="margin:3px 0; padding:0;">
         <div class="boutuqueList">
                <ul>
                 <li><a href="<?php echo base_url('domkin/householder_profile/dashboard');?>">Dashboard<span class="fa fa-angle-double-right pull-right"></span></a></li>
                 <li><a href="<?php echo base_url('domkin/householder_profile/stafflist');?>">Staff List <span class="fa fa-angle-double-right pull-right"></span></a></li>
                 <li><a href="<?php echo base_url('domkin/householder_profile/item_requesition');?>">Requsition<span class="fa fa-angle-double-right pull-right"></span></a></li>
                 <li><a href="<?php echo base_url('domkin/householder_profile/policereport');?>">Police Station Report<span class="fa fa-angle-double-right pull-right"></span></a></li>
                 <li><a href="<?php echo base_url('domkin/householder_profile/governmentreport');?>">Government Report<span class="fa fa-angle-double-right pull-right"></span></a></li>
                 <li><a href="<?php echo base_url('domkin/householder_profile/updateprofile');?>">Update Profile<span class="fa fa-angle-double-right pull-right"></span></a></li>
                 <li><a href="<?php echo base_url('domkin/householder_profile/changepassword');?>">Change Password<span class="fa fa-angle-double-right pull-right"></span></a></li>
                </ul>	
            </div>
    </div>
</div>