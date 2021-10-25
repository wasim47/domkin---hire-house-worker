<?php $this->load->view('frontend/domkin/header');?>
<?php
if($shoppingUpdate->num_rows()>0){
	foreach($shoppingUpdate->result() as $reportData);
	$sh_id=$reportData->sh_id;
	$s_id=$reportData->s_id;
	$shop_type=$reportData->shop_type;
	$shop_price=$reportData->shop_price;
	$shop_details=$reportData->shop_details;
}
else{
	$sh_id='';
	$s_id='';
	$shop_type=set_value('shop_type');
	$shop_price=set_value('shop_price');
	$shop_details=set_value('shop_details');
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
                  	  <table class="table" width="100%">
                          <tr>
                            <th width="26%">Staff Name</th>
                            <th width="1%">:</th>
                            <th width="73%">
								<?php
									$querystaff = $this->db->query("select * from kin_staff where s_id='".$s_id."'");
                                    foreach($querystaff->result() as $staff){
                                        $s_id=$staff->s_id;
                                        echo  $staffname=$staff->s_name;
									
                                    }
									?>
                            </th>
                   	  </tr>
                          <tr>
                                <th width="29%">Shopping Type</th>
                                <th width="4%">:</th>
                                <th width="67%"><?php echo $shop_type;?></th>
                          </tr>
                          <tr>
                                <th width="29%">Price</th>
                                <th width="4%">:</th>
                                <th width="67%"><?php echo $shop_price;?></th>
                          </tr>
                          <tr>
                                <th width="29%">Shopping Details</th>
                                <th width="4%">:</th>
                                <th width="67%"><?php echo $shop_details;?></th>
                          </tr>
                         
                 </table>
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