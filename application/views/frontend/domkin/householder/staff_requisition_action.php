<?php $this->load->view('frontend/domkin/header');?>
<?php
if($staffReqUpdate->num_rows()>0){
	foreach($staffReqUpdate->result() as $staffReqUpdate);
	$sr_id=$reportData->sr_id;
	$s_id=$reportData->s_id;
	$status=$reportData->status;
}
else{
	$sr_id='';
	$s_id=set_value('s_id');
	$status=set_value('status');
	}
?>


<div class="header_img1">
        <div class="container">
       	   <div class="row" style="margin-top:20px;">
           <div class="col-sm-2">
					<?php include("leftSidebar.php");?>
				</div>
           	<div class="col-sm-12 col-md-7">
            	<div  style="margin:0 10px;" class="table">
                	<?php echo form_open('domkin/requisition_action','name="formelem"');?>
                    
                  	  <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0">
                      	<label class="control-label col-md-3">Staff Name :</label>
                      	<div class="col-sm-12 col-md-6">
                        	<select name="s_id" class="form-control" <?php echo $disaena;?>>
                                	<option value="">Staff List</option>
                                    
                                     <?php
										foreach($stafflist->result() as $staff){
											$s_id=$staff->s_id;
											$staffname=$staff->s_name;
									?>
                                    <option value="<?php echo $s_id;?>"><?php echo $staffname;?></option>
                                    <?php
                                    }
									?>
                                </select>
                        </div>
                      </div>
                      
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0">
                      	<label class="control-label col-md-3"></label>
                      	<div class="col-sm-12 col-md-6">
                        	<input type="hidden" name="sr_id" value="<?php echo $sr_id; ?>">
                            <input name="staffreq_action" type="submit" class="btn btn-success" value="Submit" style="width:20%; float:right"/>
                        </div>
                      </div>  
                      
                  <?php echo form_close();?>
                </div>
           </div>
          
           <div class="col-md-3 col-sm-12 hidden-sm hidden-xs">
            	<div class="title4">DIVISIONAL JOBS</div>
                <div class="map_bg">
                	<span class="rangpur">Rangpur<br>( 60 )</span>
                    <span class="mymensingh">Mymensingh<br>
                    ( 60 )</span>
                    <span class="sylhet">Sylhet	<br>( 60 )</span>
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