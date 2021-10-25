<?php include('header.php');?>
    <div class="container" style="background:#f5f5f5">
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
              <button style="background:none; border:none; color:#333; height:70px; font-size:30px" type="submit">
                  <span class="glyphicon glyphicon-search"></span></button>
            <?php echo form_close();?>
                </div>
	<div class="hotJobs">
    	
		<div class="container padd_reducer" style="background:#fff">
        	
			<div class="premium_jobs">
				<!--<div class="title5">
                	Search for: 
                </div>-->
                <div class="all-jobs">
    
    	<div id="hotjobsDiv">
                
                <div class="col-md-9 pre_jobs_bdr col-sm-12 mobile-padding">
                    
                    	<?php
						if($getsearchdata->num_rows() > 0){
							$count=0;
							foreach($getsearchdata->result() as $staff){
								$s_id=$staff->s_id;
								$staffname=$staff->s_name;
								$s_age=$staff->s_age;
								$s_origin=$staff->s_origin;	
								$s_photo=$staff->s_photo;
								
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
					   }
					   else{
					  	 echo '<div class="row hj-row">
						 <div class="col-md-12 col-sm-12 col-xs-12 c-card br">
										<div class="row" style="text-align:center; border:none; margin-top:10%; color:red; height:500px;">
						 <h2 style="color:red;">No Data Found</h2></div></div></div>';
					   }
					   
					   
					   ?>
                       
                       
                       
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