<?php include('header.php');?>
<style>

#exTab1 .tab-content {
  padding : 5px 15px;
}
#exTab1 .nav-pills > li > a {
  border-radius: 0;
}


</style>
    <div class="header_img">
        <div class="container">
       	   <div class="row">
           	<div class="wow fadeInDown">
           	<div class="col-md-8 col-md-offset-1">
            <div class="srch_bg_img col-md-12">
            <?php echo form_open('domkin/search');?>
           	  <div class="keyword_area">
              <select name="expertise" class="keyword_field">
              	<option value="">Expertise</option>
                  <?php 
				  foreach($getexpertise->result() as $expR){
				  	echo '<option value="'.$expR->par_id.'">'.$expR->expertise_name.'</option>';
				  }
				  ?>
                </select>
              <!--<input name="" type="text" placeholder="Search by Expertise..." class="keyword_field" >-->
              </div>
              <div class="category_area">
                <select name="designation" class="category_field">
                 <option value="">Designation</option>
				 <?php 
				  foreach($getdesignation->result() as $desgR){
				  	echo '<option value="'.$desgR->desig_id.'">'.$desgR->designation_name.'</option>';
				  }
				  ?>
                </select>
              </div>
              <div class="cv_btn_area"><button style="background:none; border:none; color:#fff; width:88%; height:70px; font-size:30px" type="submit"><span class="glyphicon glyphicon-search"></span></button></div>
            <?php echo form_close();?>
            </div>    
             <div class="col-md-12 jobs_counting hidden-sm hidden-xs">
             	<div class="col-md-4">
                	<div class="col-md-3"><img src="<?php echo base_url();?>asset/domkin/images/live_jobs_icon.png" width="56" height="53"></div>
                    <div class="col-md-9">
                    	<div class="title1">Staff</div>
                        <div class="title2"><?php echo $totalstaff;?></div>
                    </div>
               </div>
                <div class="col-md-4">
                	<div class="col-md-3"><img src="<?php echo base_url();?>asset/domkin/images/live_jobs_icon.png" width="56" height="53"></div>
                    <div class="col-md-9">
                    	<div class="title1">Agent</div>
                        <div class="title2"><?php echo $totalagent;?></div>
                    </div>
                </div>
                <div class="col-md-4">
                	<div class="col-md-3"><img src="<?php echo base_url();?>asset/domkin/images/live_jobs_icon.png" width="56" height="53"></div>
                    <div class="col-md-9">
                    	<div class="title1">Household</div>
                        <div class="title2"><?php echo $totalhouseholder;?></div>
                    </div>
                </div>
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
    </div>
    
    <!--.......................................-->
    <div class="clear"></div>
	<div class="hotJobs">
		<div class="container padd_reducer" style="background:#fff">
			<div class="premium_jobs">
				<div class="title5"><img src="<?php echo base_url();?>asset/domkin/images/premium_logo.jpg" class="premium_img" > Staff List</div>
                <div class="all-jobs">
    
    	<div id="hotjobsDiv">
                
                <div class="col-md-9 pre_jobs_bdr col-sm-12 mobile-padding">
                    
                    <div id="exTab1">	
                        <ul  class="nav nav-pills">
                            <li class="active"><a  href="#1a" data-toggle="tab">All Staff</a></li>
                            <li><a href="#2a" data-toggle="tab">By Designation</a></li>
                            <li><a href="#3a" data-toggle="tab">By Expertise</a></li>
                        </ul>
                        <div class="tab-content" style="padding:0; margin:0;">
                        	<div class="tab-pane active" id="1a" style="padding:0; margin:0;">
                            <?php
                            $count=0;
                            foreach($stafflist->result() as $staff){
                                $s_id=$staff->s_id;
                                $staffname=$staff->s_name;
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
									$emp_salary_range = '';
								}
            
            
                                if($count==2){
                                    print "</div>";
                                    $count=0;
                                }
                                if($count==0){
                                    print '<div class="row hj-row">';
                                }
                                
                                
                            ?>
                               <div class="col-md-6 col-sm-6 col-xs-12 c-card br">
                                    <div class="row">
                                        <div class="hotJobsCompany">
                                        <div class="col-md-4">
                                            <div class="companyLogo">
                                            <img src="<?php echo base_url('asset/uploads/domkin/staff/'.$s_photo);?>" alt="<?php echo $staffname;?>" title="<?php echo $staffname;?>">
                                            </div>
                                            <h4 style="text-align:center"><?php echo $staffname;?></h4>
                                        </div>
                                        <div class="col-md-8 pl">
                                            <div class="companyDetails">
                                                <ul>
                                                 <li><?php echo 'Prodessional Qul. :'.$emp_designation;?></li>
                                                 <li><?php echo 'Expertise : '.$emp_expertise;?></li>
                                                 <li><?php echo 'Age :'.$s_age;?></li>
                                                 <li><?php echo 'Origin :'.$s_origin;?></li>                                         
                                                 <li><?php echo 'Job Type :'.$emp_type;?></li>
                                                 <li><?php echo 'Salary Range :'.$emp_salary_range;?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="position:absolute; width:100%; float:left; bottom:0; text-align:left;">
                                            <div class="col-sm-8" style="text-align:left">
                                                <div style="padding:5px; margin:3px;">
                                                    <div id="fb-root"></div>
                                                    <script>(function(d, s, id) {
                                                      var js, fjs = d.getElementsByTagName(s)[0];
                                                      if (d.getElementById(id)) return;
                                                      js = d.createElement(s); js.id = id;
                                                      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=1860109910876505";
                                                      fjs.parentNode.insertBefore(js, fjs);
                                                    }(document, 'script', 'facebook-jssdk'));</script>
                                                    
                                                    <div class="fb-share-button" data-href="https://www.facebook.com/domkin.bips" data-layout="button_count" 
                                                    data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fdomkin.bips&amp;src=sdkpreparse">Share</a></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" style="text-align:right">
                                            <?php
                                            	if($this->session->userdata('userAccessMail')!="" && $this->session->userdata('userType')=="House Holder"){
											?>
                                            <input type="button" name="booking" value="Booking" class="btn btn-success" style="padding:5px; margin:3px;" />
                                            <?php
                                            }
											?>
                                            
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                           <?php
                           $count++;
                           }
                           if($count>0)
                           print "</div>";
                           ?>
                           </div>
                           <div class="tab-pane" id="2a">
          						
                                
                                <?php
                            $count=0;
                            foreach($getstaffinfo as $sinfo){
                                $s_id=$sinfo->s_id;
                                $sinfoname=$sinfo->s_name;
                                $s_age=$sinfo->s_age;
                                $s_origin=$sinfo->s_origin;	
                                $s_photo=$sinfo->s_photo;	
                                
                                $queryval = $this->db->query("select * from emp_info where s_id='".$s_id."'");
                                foreach($queryval->result() as $queemp);
                                $emp_designation= $queemp->emp_designation;
                                $emp_type = $queemp->emp_type;	
                                $emp_expertise = $queemp->emp_expertise;
                                $emp_salary_range = $queemp->emp_salary_range;
            
            
                                if($count==2){
                                    print "</div>";
                                    $count=0;
                                }
                                if($count==0){
                                    print '<div class="row hj-row">';
                                }
                                
                                
                            ?>
                               <div class="col-md-6 col-sm-6 col-xs-12 c-card br">
                                    <div class="row">
                                        <div class="hotJobsCompany">
                                        <div class="col-md-4">
                                            <div class="companyLogo">
                                            <img src="<?php echo base_url('asset/uploads/domkin/staff/'.$s_photo);?>" alt="<?php echo $sinfoname;?>" 
                                            title="<?php echo $sinfoname;?>">
                                            </div>
                                            <h4 style="text-align:center"><?php echo $sinfoname;?></h4>
                                        </div>
                                        <div class="col-md-8 pl">
                                            <div class="companyDetails">
                                                <ul>
                                                 <li><?php echo 'Prodessional Qul. :'.$emp_designation;?></li>
                                                 <li><?php echo 'Expertise : '.$emp_expertise;?></li>
                                                 <li><?php echo 'Age :'.$s_age;?></li>
                                                 <li><?php echo 'Origin :'.$s_origin;?></li>                                         
                                                 <li><?php echo 'Job Type :'.$emp_type;?></li>
                                                 <li><?php echo 'Salary Range :'.$emp_salary_range;?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="position:absolute; bottom:0; text-align:left; width:100%; float:left;">
                                            <div class="col-sm-8" style="text-align:left">
                                                <div style="padding:5px; margin:3px;">
                                                    <div id="fb-root"></div>
                                                    <script>(function(d, s, id) {
                                                      var js, fjs = d.getElementsByTagName(s)[0];
                                                      if (d.getElementById(id)) return;
                                                      js = d.createElement(s); js.id = id;
                                                      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=1860109910876505";
                                                      fjs.parentNode.insertBefore(js, fjs);
                                                    }(document, 'script', 'facebook-jssdk'));</script>
                                                    
                                                    <div class="fb-share-button" data-href="https://www.facebook.com/domkin.bips" data-layout="button_count" 
                                                    data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fdomkin.bips&amp;src=sdkpreparse">Share</a></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" style="text-align:right">
                                            <input type="button" name="booking" value="Booking" class="btn btn-success" style="padding:5px; margin:3px;" /></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                           <?php
                           $count++;
                           }
                           if($count>0)
                           print "</div>";
                           ?>
                               
                                
						  </div>
      					   <div class="tab-pane" id="3a">
                      			
                                <?php
                            $count=0;
                            foreach($getstaffinfoexp as $sinfoexp){
                                $s_id=$sinfoexp->s_id;
                                $sinfoexpname=$sinfoexp->s_name;
                                $s_age=$sinfoexp->s_age;
                                $s_origin=$sinfoexp->s_origin;	
                                $s_photo=$sinfoexp->s_photo;	
                                
                                $queryval = $this->db->query("select * from emp_info where s_id='".$s_id."'");
                                foreach($queryval->result() as $queemp);
                                $emp_designation= $queemp->emp_designation;
                                $emp_type = $queemp->emp_type;	
                                $emp_expertise = $queemp->emp_expertise;
                                $emp_salary_range = $queemp->emp_salary_range;
            
            
                                if($count==2){
                                    print "</div>";
                                    $count=0;
                                }
                                if($count==0){
                                    print '<div class="row hj-row">';
                                }
                                
                                
                            ?>
                               <div class="col-md-6 col-sm-6 col-xs-12 c-card br">
                                    <div class="row">
                                        <div class="hotJobsCompany">
                                        <div class="col-md-4">
                                            <div class="companyLogo">
                                            <img src="<?php echo base_url('asset/uploads/domkin/staff/'.$s_photo);?>" alt="<?php echo $sinfoexpname;?>" 
                                            title="<?php echo $sinfoexpname;?>">
                                            </div>
                                            <h4 style="text-align:center"><?php echo $sinfoexpname;?></h4>
                                        </div>
                                        <div class="col-md-8 pl">
                                            <div class="companyDetails">
                                                <ul>
                                                 <li><?php echo 'Prodessional Qul. :'.$emp_designation;?></li>
                                                 <li><?php echo 'Expertise : '.$emp_expertise;?></li>
                                                 <li><?php echo 'Age :'.$s_age;?></li>
                                                 <li><?php echo 'Origin :'.$s_origin;?></li>                                         
                                                 <li><?php echo 'Job Type :'.$emp_type;?></li>
                                                 <li><?php echo 'Salary Range :'.$emp_salary_range;?></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-12" style="position:absolute; bottom:0; text-align:left; width:100%; float:left;">
                                            <div class="col-sm-8" style="text-align:left">
                                                <div style="padding:5px; margin:3px;">
                                                    <div id="fb-root"></div>
                                                    <script>(function(d, s, id) {
                                                      var js, fjs = d.getElementsByTagName(s)[0];
                                                      if (d.getElementById(id)) return;
                                                      js = d.createElement(s); js.id = id;
                                                      js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.7&appId=1860109910876505";
                                                      fjs.parentNode.insertBefore(js, fjs);
                                                    }(document, 'script', 'facebook-jssdk'));</script>
                                                    
                                                    <div class="fb-share-button" data-href="https://www.facebook.com/domkin.bips" data-layout="button_count" 
                                                    data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2Fdomkin.bips&amp;src=sdkpreparse">Share</a></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4" style="text-align:right">
                                            <input type="button" name="booking" value="Booking" class="btn btn-success" style="padding:5px; margin:3px;" /></div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                           <?php
                           $count++;
                           }
                           if($count>0)
                           print "</div>";
                           ?>
                                
                            </div>
                       	</div>
                    </div>
                    </div>
                
               
                </div>
                
                </div>
                
                </div>
                
                
            <div class="col-md-3 col-sm-12 hidden-sm hidden-xs">
            	<div class="right_ad_sec"><img src="<?php echo base_url();?>asset/domkin/images/ri8_ad_1.jpg" class="ri8_ad_1" ></div>
                <div class="right_ad_sec2"><img src="<?php echo base_url();?>asset/domkin/images/ri8_ad_2.jpg" class="ri8_ad_1" ></div>
               	<div class="right_ad_sec2"><img src="<?php echo base_url();?>asset/domkin/images/ri8_ad_3.jpg" class="ri8_ad_1" ></div>
                <div class="right_ad_sec2"><img src="<?php echo base_url();?>asset/domkin/images/ri8_ad_2.jpg" class="ri8_ad_1" ></div>
            </div>
            
            <div class="clear"></div>
            </div>
            
            
            
		</div>
	</div>
	<!-- End hot jobs -->
<?php include('footer.php');?>