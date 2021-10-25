<?php $this->load->view('frontend/domkin/header');?>

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
                	<?php echo form_open('domkin/requsition_action');?>
                  	  <table class="table" width="100%">
                          <tr>
                            <th width="26%">Staff Name</th>
                            <th width="1%">:</th>
                            <th width="73%">
								<select name="staff_id" class="form-control" style="width:70%">
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
                            </th>
                   	  </tr>
                          <tr>
                                <th width="26%">Itrm Type</th>
                                <th width="1%">:</th>
                                <th width="73%">
                                    <select name="item_type" class="form-control" style="width:70%">
                                        <option value="">Itrm Type</option>
                                        <option value="Break First">Break First</option>
                                        <option value="Lunch">Lunch</option>
                                        <option value="Snacks">Snacks</option>
                                        <option value="Dinner">Dinner</option>
                                    </select>
                                </th>
                          </tr>
                          <tr>
                                <th width="26%">Item Menu</th>
                                <th width="1%">:</th>
                                <th width="73%">
                                    <textarea class="form-control" name="item_details" style="width:70%"></textarea>
                                </th>
                          </tr>
                          <tr>
                                <th width="26%">Price</th>
                                <th width="1%">:</th>
                                <th width="73%">
                                  <input name="item_price" class="form-control"  style="width:70%"/>
                                </th>
                          </tr>
                              <tr>
                                    <th width="26%">Meal in Person</th>
                                    <th width="1%">:</th>
                                    <th width="73%">
                                        <input name="meal_in_person" class="form-control"  style="width:70%"/>
                                    </th>
                              </tr>
                          <tr>
                                <th width="26%">Time</th>
                                <th width="1%">:</th>
                                <th width="73%">
                                    <input name="time_rang" class="form-control" placeholder="00:00 AM - 00:00 PM"  style="width:70%"/>
                                </th>
                          </tr>
                          <tr>
                                <th width="73%" colspan="3" align="center">
                                    <input name="submit" type="submit" class="btn btn-success" value="Submit" style="width:20%;"/>
                                </th>
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