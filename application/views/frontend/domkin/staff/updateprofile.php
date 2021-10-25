<?php $this->load->view('frontend/domkin/header');?>

<?php
$id = $this->session->userdata('userAccessId');
$queryvalF = $this->db->query("select * from staff_family where s_id='".$id."'");
	if($queryvalF->num_rows() > 0){
	foreach($queryvalF->result() as $queF);
		$sf_id = $queF->sf_id;
		$member_name = $queF->member_name;
		$relationship = $queF->relationship;
		$m_age = $queF->m_age;
		$mobile = $queF->mobile;
		$profession = $queF->profession;
		$email = $queF->email;	
		$gender = $queF->gender;
	}
	else{
		$sf_id='';
		$member_name = "";
		$relationship = "";
		$m_age = "";
		$mobile = "";
		$profession = "";
		$email = "";
		$gender = "";
	}
	$queryvalLg = $this->db->query("select * from leagel_guardian where s_id='".$id."'");
	if($queryvalLg->num_rows() > 0){
		foreach($queryvalLg->result() as $queLg);
		$lg_id = $queLg->lg_id;
		$lg_name = $queLg->lg_name;
		$lg_fathers_name= $queLg->lg_fathers_name;
		$lg_mothers_name = $queLg->lg_mothers_name;	
		$lg_spouse_name = $queLg->lg_spouse_name;
		$lg_age = $queLg->lg_age;
		$lg_dob = $queLg->lg_date_of_birth;
		
		if($lg_dob=""){
			list($dayl, $monthl, $yearl) = explode(' ',$lg_dob);
		}
		$lg_origin = $queLg->lg_origin;	
		$lg_pre_address = $queLg->lg_pre_address;
		$lg_per_address = $queLg->lg_per_address;	
		$lg_email = $queLg->lg_email;	 
		$lg_phone_no = $queLg->lg_phone_no;	 
		$lg_nidPassport = $queLg->lg_nidPassport;	
		$lg_gender = $queLg->lg_gender;	  
	}
	else{
		$lg_id = '';
		$lg_name = '';
		$lg_fathers_name= '';
		$lg_mothers_name = '';
		$lg_spouse_name = '';
		$lg_age = '';
		$dayl='';
		$monthl='';
		$yearl='';
		$lg_origin = '';
		$lg_pre_address = '';
		$lg_per_address = '';
		$lg_email = '';
		$lg_phone_no ='';
		$lg_nidPassport = '';
		$lg_gender = '';
	}					
	
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



function addRowTraining(varIDClass) {
    var elements, templateRow, rowCount, row, className, newRow, element, s, t;

    var BsIE = false;
    if (!document.getElementsByTagName)
      return false; // DOM not supported 
    elements = document.getElementsByName(varIDClass);
    templateRow = null;
    rowCount = 0;
    for (i = 0; i < elements.length; i++) {
      row = elements.item(i);
      className = null;
      if (row.getAttribute)
        className = row.getAttribute('class');
      if (className == null && row.attributes) {
        className = row.attributes['class'];
		BsIE=true;
      }
      if (!BsIE && (className != varIDClass))
        continue;
	  else if (BsIE && (className.value != varIDClass))
        continue;
      templateRow = row;
      rowCount++;
	  
		var totalfile=parseInt(rowCount) + 1;
		//alert(totalfile);
		 //document.getElementById('countTotalFam').innerHTML = totalfile;
		 if(totalfile>=5){
			document.getElementById('addmore').style.display='none';
		 }
    }
	
	 //alert(rowCount);
	 
    if (templateRow == null)

      return false; // Couldn't find a template row. 

    newRow = templateRow.cloneNode(true);

    elements = newRow.getElementsByTagName("input");
    for (i = 0; i < elements.length; i++) {
      element = elements.item(i);
      s = null;
      s = element.getAttribute("name");
      if (s == null)
        continue;
      t = s.split("[");

      if (t.length < 2)
        continue;
      s = t[0] + "[" + rowCount.toString() + "]";
      element.setAttribute("name", s);
	  element.setAttribute("value", "");
    }
	elements = newRow.getElementsByTagName("select");
    for (i =0; i < elements.length; i++) {
      element = elements.item(i);
	  s = null;
      s = element.getAttribute("name");
      if (s == null)
        continue;
      t = s.split("[");
      if (t.length < 2)
        continue;
      s = t[0] + "[" + rowCount.toString() + "]";
	  element.setAttribute("name", s);
	  element.setAttribute("value", "");
    }
    templateRow.parentNode.appendChild(newRow);
    return true;
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
              
               <div id="registration_form" style="margin:0 10px;">
               	<div><?php echo $this->session->flashdata('successMsg');?></div>
             	  <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                       <div class="panel-heading"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><h4 class="panel-title">General Information </h4></a></div>
                        <div id="collapseOne" class="panel-collapse collapse">
                          <div class="panel-body">
                             <div>
                     <div class="form-group" style="margin-bottom:30px;">
                     <h1 style="color:#333; text-align:center"><?php echo 'Update Profile';?></h1>
                    </div>
                    
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Staff Name <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                          <input name="staffname" type="text"  class="form-control" style="border:1px solid #ccc;"  required="required" value="<?php echo $userProfile['s_name'];?>" placeholder="Staff Name"/>
                        <?php echo form_error('staffname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                        </div>
                    </div>
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Father's Name</label>
                        <div class="col-sm-7">
                          <input name="fname" id="fname" type="text"  style="border:1px solid #ccc;" class="form-control" value="<?php echo $userProfile['s_fathers_name'];?>" placeholder="Father`s Name"/>
                        <?php echo form_error('fname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Mother's Name</label>
                        <div class="col-sm-7">
                          <input name="mname" id="mname" type="text"  style="border:1px solid #ccc;" class="form-control" required="required" value="<?php echo $userProfile['s_mothers_name'];?>" placeholder="Mother`s Name"/>
                        <?php echo form_error('mname', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Spouse Name </label>
                        <div class="col-sm-7">
                          <input name="spousename" id="spousename" type="text"  style="border:1px solid #ccc;" class="form-control" value="<?php echo $userProfile['s_spouse_name'];?>" placeholder="Spouse Name"/>
                   </div>
                    </div>
                    
                    <?php $dob = $userProfile['s_date_of_birth'];
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
                        <?php $gender = $userProfile['s_gender'];?>
                          <input type="radio" name="gender" value="Male" <?php if($gender=='Male'){?> checked="checked" <?php } ?> /> Male
                          <input type="radio" name="gender" value="Female"  <?php if($gender=='Female'){?> checked="checked" <?php } ?> /> Female
                          
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">Natinality/Origin </label>
                        <div class="col-sm-7">
                          <input name="nationality" id="nationality" type="text"  style="border:1px solid #ccc;" class="form-control" value="<?php echo $userProfile['s_origin'];?>" placeholder="Natinality/Origin "/>
                   </div>
                    </div>
                    <div class="form-group">       
                        <label class="control-label col-sm-4" style=" margin-right:20px">National ID/Passport <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                          <input name="nidpass" id="nidpass" type="text"  style="border:1px solid #ccc;" class="form-control"  required="required" value="<?php echo $userProfile['s_nidPassport'];?>" placeholder="National ID/Passport"/>
                        <?php echo form_error('nidpass', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                    </div>
                    </div>
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Mobile <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                           <input name="mobile" id="mobile" type="text" style="border:1px solid #ccc;" class="form-control" required="required" value="<?php echo $userProfile['s_phone_no'];?>" placeholder="Mobile No."/>
                         <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                    </div>
                    
                    </div>
                     
                     
                    
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Present Address</label>
                        <div class="col-sm-7">
                           <textarea name="pre_address" rows="6" cols="40"  style="border:1px solid #ccc;" class="form-control" placeholder="Present Address"><?php echo $userProfile['s_pre_address'];?></textarea>
                    </div>
                    </div>
                   <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Permanent Address</label>
                        <div class="col-sm-7">
                           <textarea name="per_address" rows="6" cols="40"  style="border:1px solid #ccc;" class="form-control" placeholder="Permanent Address"><?php echo $userProfile['s_per_address'];?></textarea>
                    </div>
                   </div>
                   
                   <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Photo</label>
                        <div class="col-sm-7">
                      <input name="staffimg" id="staffimg" type="file"  class="form-control"  style="border:1px solid #ccc;"/>
                      <img src="<?php echo base_url('asset/uploads/domkin/staff/'.$userProfile['s_photo']);?>" style="width:150px; height:auto;border:1px solid #ccc; margin:5px" />
                    </div>
                    
                    </div>
                    <div class="form-group">        
                        <label class="control-label col-sm-4" style=" margin-right:20px">Email <span style="color:#ff0000">*</span></label>
                        <div class="col-sm-7">
                      <input name="email" id="email" type="email"  class="form-control"  required="required"  style="border:1px solid #ccc;"
                                            value="<?php echo $userProfile['s_email'];?>" placeholder="Email Address"/>
                        <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                    </div>
                    
                    </div>
                    
                    
                    </div>
                         </div>
                        </div>
                    </div>
                    <div class="panel panel-default" style="margin:5px 0">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><h4 class="panel-title">
                                                   Family Information </h4></a>
                                            </div>
                                            
                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                
                                                
                                              <div class="panel-body">
                					 <a href="javascript:void()" id="addmore" onclick="addRowTraining('familyInfo')" class="btn btn-primary" style="float:right">Add More</a>
                
												 <?php 
                                                   if($familyinfo->num_rows() > 0){
                                                    foreach($familyinfo->result() as $finfo){
                                                  ?>
                                                 
                                                  <div class="familyInfo" id="familyInfo" name="familyInfo">
                                                  <input name="sf_id[]" type="hidden" value="<?php echo $finfo->sf_id;?>" />
                                                  <fieldset>
                                                  <legend>Family Member </legend><!--<div id="countTotalFam">1</div>-->
                                               <div class="form-group">        
                                       <label class="control-label col-sm-3" style=" margin-right:20px">Member Name <span style="color:#ff0000">*</span></label>
                                        <div class="col-sm-7">
                                          <input name="membername[]" type="text"  class="form-control"  value="<?php echo $finfo->member_name;?>" placeholder="Member Name"/>
                                        </div>
                                    </div>  	
                                                     
                                                    
                                                    <div class="form-group">        
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Relaionship</label>
                                                        <div class="col-sm-7">
                                                          <input name="relationship[]" id="fname" type="text"  class="form-control" value="<?php echo  $finfo->relationship; ?>" 
                                                          placeholder="Relaionship"/>
                                                   </div>
                                                    </div>
                                                    <div class="form-group">       
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Age</label>
                                                        <div class="col-sm-7">
                                                          <input name="age[]" id="age" type="text"  class="form-control"  value="<?php echo $finfo->m_age; ?>" placeholder="Age"/>
                                                   </div>
                                                    </div>
                                                    <div class="form-group">       
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Profession</label>
                                                        <div class="col-sm-7">
                                                          <input name="profession[]" id="profession" type="text"  class="form-control" value="<?php echo $finfo->profession; ?>" placeholder="Profession"/>

                                                   </div>
                                                    </div>
                                                    <div class="form-group">       
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Gender</label>
                                                        <div class="col-sm-7">
                                                          <input type="radio" name="fgender[]" value="Male" <?php if($finfo->gender=='Male'){?>  checked="checked" <?php } ?>/> Male
                                                          <input type="radio" name="fgender[]" value="Female" <?php if($finfo->gender=='Male'){?>  checked="checked" <?php } ?>/> Female
                                                          
                                                   </div>
                                                    </div>
                                                    <div class="form-group">        
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Mobile <span style="color:#ff0000">*</span></label>
                                                        <div class="col-sm-7">
                                                           <input name="fmobile[]" id="fmobile" type="text"  class="form-control" 
                                                                             value="<?php echo $finfo->mobile; ?>" placeholder="Mobile No."/>
                                                    </div>
                                                    
                                                    </div>
                                                    <div class="form-group">        
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Email <span style="color:#ff0000">*</span></label>
                                                        <div class="col-sm-7">
                                                      <input name="femail[]" id="femail" type="email"  class="form-control" value="<?php echo $finfo->email; ?>" placeholder="Email Address"/>
                                                    </div>
                                                    
                                                    </div>
                                    </fieldset>
                                                  </div>
                                                 <?php 
                                                        }
                                                   }
                                                  else{
                                                      ?>
                                                  <div class="familyInfo" id="familyInfo" name="familyInfo">
                                                   <input name="sf_id[]" type="hidden" value="" />
                                                    <fieldset>
                                                  <legend>Family Member</legend>
                                               <div class="form-group">        
                                       <label class="control-label col-sm-3" style=" margin-right:20px">Member Name <span style="color:#ff0000">*</span></label>
                                        <div class="col-sm-7">
                                          <input name="membername[]" type="text"  class="form-control"  placeholder="Member Name"/>
                                        </div>
                                    </div>  	
                                                     
                                                    
                                                    <div class="form-group">        
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Relaionship</label>
                                                        <div class="col-sm-7">
                                                          <input name="relationship[]" id="fname" type="text"  class="form-control"  placeholder="Relaionship"/>
                                                   </div>
                                                    </div>
                                                    <div class="form-group">       
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Age</label>
                                                        <div class="col-sm-7">
                                                          <input name="age[]" id="age" type="text"  class="form-control" placeholder="Age"/>
                                                   </div>
                                                    </div>
                                                    <div class="form-group">       
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Profession</label>
                                                        <div class="col-sm-7">
                                                          <input name="profession[]" id="profession" type="text"  class="form-control" placeholder="Profession"/>
                                                   </div>
                                                    </div>
                                                    <div class="form-group">       
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Gender</label>
                                                        <div class="col-sm-7">
                                                          <input type="radio" name="fgender[]" value="Male" /> Male
                                                          <input type="radio" name="fgender[]" value="Female" /> Female
                                                          
                                                   </div>
                                                    </div>
                                                    <div class="form-group">        
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Mobile <span style="color:#ff0000">*</span></label>
                                                        <div class="col-sm-7">
                                                           <input name="fmobile[]" id="fmobile" type="text"  class="form-control" placeholder="Mobile No."/>
                                                    </div>
                                                    
                                                    </div>
                                                    <div class="form-group">        
                                                        <label class="control-label col-sm-3" style=" margin-right:20px">Email <span style="color:#ff0000">*</span></label>
                                                        <div class="col-sm-7">
                                                      <input name="femail[]" id="femail" type="email"  class="form-control" placeholder="Email Address"/>
                                                    </div>
                                                    
                                                    </div>
                                    </fieldset>
                                                  </div>
                                                 <?php 
                                                      } 
                                                  ?>
          									 </div>
                                            </div>
                                        </div> 
                    <div class="panel panel-default" style="margin:5px 0">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><h4 class="panel-title">
                                                    Legal Guardian Information </h4></a>
                                            </div>
                                            
                                            <div id="collapseThree" class="panel-collapse collapse">
                                                
                                                
                                              <div class="panel-body">
                 
                
                <div class="form-group">        
                   <label class="control-label col-sm-3" style=" margin-right:20px">Guardian Name <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                      <input name="lg_name" type="text"  class="form-control" value="<?php echo $lg_name; ?>" placeholder="Guardian Name"/>
                    <?php //echo form_error('lg_name', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                    </div>
                </div>
                <div class="form-group">        
                    <label class="control-label col-sm-3" style=" margin-right:20px">Father's Name</label>
                    <div class="col-sm-7">
                      <input name="lg_fathers_name" id="lg_fathers_name" type="text"  class="form-control" value="<?php echo $lg_fathers_name; ?>" placeholder="Father`s Name"/>
                    <?php //echo form_error('lg_fathers_name', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-3" style=" margin-right:20px">Mother's Name</label>
                    <div class="col-sm-7">
                      <input name="lg_mothers_name" id="lg_mothers_name" type="text"  class="form-control" value="<?php echo $lg_mothers_name; ?>" placeholder="Mother`s Name"/>
                    <?php //echo form_error('lg_mothers_name', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-3" style=" margin-right:20px">Spouse Name </label>
                    <div class="col-sm-7">
                      <input name="lg_spouse_name" id="	lg_spouse_name" type="text" class="form-control" value="<?php echo $lg_spouse_name; ?>" placeholder="Spouse Name"/>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-3" style=" margin-right:20px">Date of Birth</label>
                    <div class="col-sm-7">
                      <select name="day" class="form-control col-sm-7" style="width:28%; margin-right:10px; text-align:center;">
                      	<option value="<?php echo $dayl;?>"><?php echo $dayl;?></option>
                        <?php 
						for($d=0; $d<=31; $d++){
						echo '<option value="'.$d.'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$d.'</option>';
						}
						?>
                      </select>
                      <select name="month" class="form-control col-sm-7" style="width:38%; margin-right:10px;text-align:center;">
                      	<option value="<?php echo $monthl;?>"><?php echo $monthl;?></option>
                        <?php 
						$montharray=array('January','February','March','April','May','June','July','August','September','October','November','December');
						for($m=0; $m<=count($montharray); $m++){
						echo '<option value="'.$montharray[$m].'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$montharray[$m].'</option>';
						}
						?>
                      </select>
                      <select name="year" class="form-control col-sm-7" style="width:28%;text-align:center;">
                      	<option value="<?php echo $yearl;?>"><?php echo $yearl;?></option>
                        <?php 
						for($y=1950; $y<=date('Y'); $y++){
						echo '<option value="'.$y.'" style="border-bottom:1px solid #ccc; font-weight:bold; cursor:pointer">'.$y.'</option>';
						}
						?>
                      </select>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-3" style=" margin-right:20px">Gender</label>
                    <div class="col-sm-7">
                      <input type="radio" name="gender" value="Male" <?php if($lg_gender=='Male'){?>  checked="checked" <?php } ?>/> Male
                      <input type="radio" name="gender" value="Female"  <?php if($lg_gender=='Female'){?>  checked="checked" <?php } ?>/> Female
                      
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-3" style=" margin-right:20px">Natinality/Origin </label>
                    <div class="col-sm-7">
                      <input name="lg_origin" id="lg_origin" type="text"  class="form-control" value="<?php echo $lg_origin; ?>" placeholder="Natinality/Origin "/>
               </div>
                </div>
                <div class="form-group">       
                    <label class="control-label col-sm-3" style=" margin-right:20px">National ID/Passport <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                      <input name="lg_nidPassport" id="lg_nidPassport" type="text"  class="form-control" value="<?php echo $lg_nidPassport; ?>" placeholder="National ID/Passport"/>
                    <?php echo form_error('lg_nidPassport', '<p style="color:#ff0000;margin:0;">','</p>'); ?>
                </div>
                </div>
                <div class="form-group">        
                    <label class="control-label col-sm-3" style=" margin-right:20px">Mobile <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                       <input name="lg_phone_no" id="lg_phone_no" type="text"  class="form-control" value="<?php echo $lg_phone_no; ?>" placeholder="Mobile No."/>
                     <?php //echo form_error('lg_phone_no', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                
                </div>
                 
                 
                
                <div class="form-group">        
                    <label class="control-label col-sm-3" style=" margin-right:20px">Present Address</label>
                    <div class="col-sm-7">
                       <textarea name="lg_pre_address" rows="6" cols="40"  class="form-control" placeholder="Present Address"><?php echo $lg_pre_address;?></textarea>
                </div>
                </div>
               <div class="form-group">        
                    <label class="control-label col-sm-3" style=" margin-right:20px">Permanent Address</label>
                    <div class="col-sm-7">
                       <textarea name="lg_per_address" rows="6" cols="40"  class="form-control" placeholder="Permanent Address"><?php echo $lg_per_address;?></textarea>
                </div>
               </div>
               
               <div class="form-group">        
                    <label class="control-label col-sm-3" style=" margin-right:20px">Photo</label>
                    <div class="col-sm-7">
                  <input name="lgimg" id="lgimg" type="file"  class="form-control" />
                </div>
                
                </div>
                <div class="form-group">        
                    <label class="control-label col-sm-3" style=" margin-right:20px">Email <span style="color:#ff0000">*</span></label>
                    <div class="col-sm-7">
                  <input name="lg_email" id="lg_email" type="email"  class="form-control"
                                        value="<?php echo $lg_email; ?>" placeholder="Email Address"/>
                    <?php //echo form_error('lg_email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                </div>
                
                </div>
                
                
               
          
           </div>
                                            </div>
                                        </div>  
                    <div class="panel panel-default" style="margin:5px 0">
                    <div class="panel-heading">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><h4 class="panel-title">Educational Information </h4></a></div>
                    <div id="collapseFour" class="panel-collapse collapse">
                      <div class="panel-body">                  
                 
                 <div class="form-group">        
                    <label class="control-label col-sm-8" style="text-align:right; float:right">
                    	<a href="javascript:void()" id="addmore" onclick="addRowTraining('educational_qual')">+ Add More Education</a>
                    </label>
                </div>
                 <div class="form-group">        
                              <div class="col-sm-12" style="border:1px solid #ccc">
                              	<div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center; padding:8px; margin:0; font-weight:bold">Degree Name</div>
                                <div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center; padding:8px; margin:0; font-weight:bold">Group</div>
                                <div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center; padding:8px; margin:0; font-weight:bold">Passing year</div>
                                <div class="col-sm-3" style="text-align:center; padding:8px; margin:0; font-weight:bold">CGPA/Division</div>
                              </div>
                             
                              
                              <?php 
							   if($educationInfo->num_rows() > 0){
								foreach($educationInfo->result() as $eduin){
							  ?>
							  <div class="educational_qual" id="educational_qual" name="educational_qual">
                             	 <input name="totalDegId[]" type="hidden" value="<?php echo $eduin->eid;?>" />
                             	 <div class="col-sm-12" style="border:1px solid #ccc">
                              	<div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center;">
                                	<select name="degree[]" class="form-control" style="margin:5px;">
                                    	<option value="<?php echo $eduin->degree;?>"><?php echo $eduin->degree;?></option>
                                        <option value="SSC/Equ.">SSC/Equ.</option>
                                        <option value="HSC/Equ.">HSC/Equ.</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Honors/Bachelor">Honor's/Bachelor</option>
                                        <option value="Masters/Equ.">Masters/Equ.</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center;">
                                	<input type="text" name="group[]" class="form-control"  style="margin:5px;" value="<?php echo $eduin->edu_group;?>"/>
                                </div>
                                <div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center;">
                                	<input type="text" name="passingyear[]" class="form-control"  style="margin:5px;" value="<?php echo $eduin->passingyear;?>"/>
                                </div>
                                <div class="col-sm-3">
                                	<input type="text" name="cgpa[]" class="form-control"  style="margin:5px;" value="<?php echo $eduin->cgpa;?>"/>
                                </div>
                              </div>
                              </div>
							 <?php 
									}
							   }
							  else{
								  ?>
							  <div class="educational_qual" id="educational_qual" name="educational_qual">
                             	 <input name="totalDegId[]" type="hidden" />
                             	 <div class="col-sm-12" style="border:1px solid #ccc">
                              	<div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center;">
                                	<select name="degree[]" class="form-control" style="margin:5px;">
                                    	<option value="SSC/Equ.">SSC/Equ.</option>
                                        <option value="HSC/Equ.">HSC/Equ.</option>
                                        <option value="Degree">Degree</option>
                                        <option value="Honors/Bachelor">Honor's/Bachelor</option>
                                        <option value="Masters/Equ.">Masters/Equ.</option>
                                    </select>
                                </div>
                                <div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center;">
                                	<input type="text" name="group[]" class="form-control"  style="margin:5px;"/>
                                </div>
                                <div class="col-sm-3" style="border-right:1px solid #ccc;text-align:center;">
                                	<input type="text" name="passingyear[]" class="form-control"  style="margin:5px;"/>
                                </div>
                                <div class="col-sm-3">
                                	<input type="text" name="cgpa[]" class="form-control"  style="margin:5px;"/>
                                </div>
                              </div>
                              </div>
							 <?php 
								  } 
							  ?>
                </div>
                 	</div>
                    </div>
                    </div>
                 
                 
                  </div>
               
                <div class="col-md-5 col-md-offset-5" style="margin-bottom:20px">        
               		 <input type="hidden" name="s_id" value="<?php echo $id;?>">
                    <input type="hidden" name="lg_id" value="<?php echo $lg_id;?>">
                    <input type="hidden" name="stillimg" value="<?php echo $userProfile['s_photo'];?>">
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