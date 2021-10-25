<?php $this->load->view('frontend/domkin/header');?>
<?php
if($reportsUpdate->num_rows()>0){
	foreach($reportsUpdate->result() as $reportData);
	$ps_id=$reportData->ps_id;
	$ps_title=$reportData->ps_title;
	$ps_report=$reportData->ps_report;
}
else{
	$ps_id='';
	$ps_title=set_value('ps_title');
	$ps_report=set_value('ps_report');
	}
?>
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
           <div class="col-sm-2">
					<?php include("leftSidebar.php");?>
				</div>
           	<div class="col-sm-12 col-md-7">
            	<div  style="margin:0 10px;">
                	<?php echo form_open('domkin/report_action');?>
                  	  <table class="table" width="100%">
                          <tr>
                                <th width="29%">Report Title</th>
                                <th width="4%">:</th>
                                <th width="67%">
                                    <input type="text" name="ps_title" class="form-control" value="<?php echo $ps_title;?>" />
                                </th>
                          </tr>
                          <tr>
                                <th width="29%">Report Details</th>
                                <th width="4%">:</th>
                                <th width="67%">
                                    <textarea class="form-control" name="ps_report" rows="5"><?php echo $ps_report;?></textarea>                                </th>
                          </tr>
                          <tr>
                                <th colspan="3" align="center">
                                	<input type="hidden" name="ps_id" value="<?php echo $ps_id; ?>">
                                    <input name="police_report" type="submit" class="btn btn-success" value="Submit" style="width:20%; float:right"/>                                </th>
                          </tr>
                 </table>
                  <?php echo form_close();?>
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
<?php $this->load->view('frontend/domkin/footer');?>