<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title;?></title>
	
	<!-- core CSS -->
    <link href="<?php echo base_url();?>asset/domkin/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/domkin/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/domkin/css/animate.min.css" rel="stylesheet">
    <!--<link href="css/prettyPhoto.css" rel="stylesheet">-->
    <link href="<?php echo base_url();?>asset/domkin/css/main.css" rel="stylesheet">
    <!--<link href="css/responsive.css" rel="stylesheet">-->
    <link href="<?php echo base_url();?>asset/domkin/css/style_home_ver1.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/domkin/css/common.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/domkin/css/responsive2.css" rel="stylesheet">
    
    
    

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="<?php echo base_url();?>asset/domkin/images/ico/fevicon.png">
   <style>
.deshboard{
		width:100%;
		margin:auto;
	}
.deshboard ul{
	width:100%; 
	padding:0;
	margin:auto;
	margin-left:4%;
}
.deshboard ul li{
	display:inline;
}
.deshboard ul li a{
	width:29%;
	float:left;
	padding:40px 10px;
	background:#fff;
	margin:10px 5px;
	text-decoration:none;
	color:#333;
	text-shadow:#fff 1px 1px;
	border-radius:5px;
	border:1px solid #999;
	text-align:center;
	overflow:hidden;
	font-size:18px;
}
.deshboard ul li a:hover{
	display:inline;
	color:#000;
	background:#ccc;
	transition: all 1s ease-in-out;
}
</style>
</head><!--/head-->

<body class="homepage">

    <header id="header">
        <div class="top-bar">
            <div class="container">
            	<div class="row">
                	<div class="col-md-12">
                    <div class="col-md-8">
                        <div class="top-number"><p><i class="fa fa-mobile-phone"></i> +880 1727664462  |  info@bips.org.bd</p></div>
                    </div>
                    <div class="col-md-4">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li> 
                                <li><a href="#"><i class="fa fa-location-arrow"></i></a></li>
                            </ul>
                            
                       </div>
                    </div>
                </div>
                </div>
            </div><!--/.container-->
        </div><!--/.top-bar-->

        <div style="padding-top:10px; padding-bottom:10px;" class="container">
        	<div class="row">
            	<div class="logo_area"><a href="<?php echo base_url('domkin');?>"><img src="<?php echo base_url();?>asset/domkin/images/logo.jpg" alt="logo" style="width:25%; height:auto"></a></div>
                <div class="tp_btn_area">
                
                	<div class="tp_btn_pstn col-md-12">
                    <?php 
                    if($this->session->userdata('userAccessMail')){
                    ?>
                    <a href="<?php echo base_url('domkin/logout');?>" class="signin_btn">Sign Out</a>
                        
                       <?php
                    }
                    else{
                  ?>
                 	<a href="#" class="signin_btn" data-toggle="modal" data-target="#loginmodal">Sign in</a>
                        <a href="#" class="create_btn" data-toggle="modal" data-target="#registration">ceate account</a>
                   <?php
                    }
                    ?>
                    </div>
                    
                    <div class="col-md-12 tp_menu_text">
                    <?php foreach($domkin_menu->result() as $fmenu){
						$menu_name=$fmenu->domkin_menu_name;
						$slug=$fmenu->slug;
						$strMenu=$fmenu->page_structure;
						$url=base_url('domkin/'.$strMenu.'/'.$slug);
						?>
                    <a href="<?php echo $url;?>"><?php echo $menu_name;?></a> |
                    <?php
						}
					?>
                    </div>
                    
                </div>
             </div>
        </div>
		
    </header><!--/header-->
    
    <div id="registration" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background:#D44739; color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#fff;">Registration</h4>
      </div>
      <div class="modal-body" style="padding:0; margin:0;">
        <div class="deshboard">
       <ul>
           <li><a href="<?php echo base_url();?>domkin/registration/staff">Staff</a></li>
           <li><a href="<?php echo base_url();?>domkin/registration/agent">Agent</a></li>
           <li><a href="<?php echo base_url();?>domkin/registration/householder" id="mylink">House Holder</a></li>
       </ul>
      </div>
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>

</div>

<div id="loginmodal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" style="background:#f08d1e; color:#fff;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#fff;">All Login</h4>
      </div>
      <div class="modal-body" style="padding:0; margin:0;">
        <?php echo form_open('domkin/userLogin', array('class'=>'form-horizontal', 'style'=>'margin-bottom: 0px !important;')); ?>

	
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Log in to get started</h4>
			<?php echo $this->session->flashdata('msg');?>
    
            <div class="form-group">
                <div class="col-md-8 col-sm-8 col-md-offset-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" id="username" placeholder="User ID" 
                        required style="border:1px solid #d0d0d0">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-sm-8  col-md-offset-2">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required style="border:1px solid #d0d0d0">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4 col-sm-4 pull-right" style="margin-right:-33px">
                       <?php echo form_submit('submit', 'Log In',"class='btn btn-success'"); ?>
                    </div>
            </div>				
					
		</div>
		
		
		<?php echo form_close();?>
		
      <div class="modal-footer">
      </div>
    </div>

  </div>
</div>

</div>