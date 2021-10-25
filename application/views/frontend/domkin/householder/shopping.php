<?php $this->load->view('frontend/domkin/header');?>

<style>
.form-control{
	background:#f5f5f5;
	border-radius:0;
}
</style>
<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>domkin/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>
<div class="header_img1">
        <div class="container">
       	   <div class="row" style="margin-top:20px;">
           <div class="col-sm-2">
					<?php include("leftSidebar.php");?>
				</div>
           	<div class="col-sm-12 col-md-7"><a href="<?php echo base_url('domkin/requisition/shopping_action');?>" class="btn btn-success btn-sm" style="float:right; margin:0 10px 10px 0;" title="Add New Report"> <span class="glyphicon glyphicon-plus-sign"></span> </a></div>
            <div class="col-sm-12 col-md-7">
            	<div  style="margin:0 10px;">
                    <table class="table table-striped" width="100%">
                                        <thead>
                                          <tr>
                                            <th width="3%">SI</th>
                                            <th width="59%">Shopping Type</th>
                                            <th width="17%">Total Price</th>
                                            <th width="21%">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    <?php
                    $i=0;
                    foreach($shoppingdata->result() as $shop){
                        $sh_id=$shop->sh_id;
						$shop_type=$shop->shop_type;
						$shop_price=$shop->shop_price;
                        
                        $i++;
                    ?>
                     <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $shop_type; ?></td>
                        <td><?php echo $shop_price; ?></td>
                       
                         <td>
                         <a href="<?php echo base_url("domkin/requisition/shopping_details/".$sh_id);?>" class="btn btn-warning btn-sm">
                         <span class="glyphicon glyphicon-folder-open"></span></a>
                         <a href="<?php echo base_url('domkin/requisition/shopping_action/'.$sh_id);?>" class="btn btn-info btn-sm">
                         <span class="glyphicon glyphicon-edit"></span></a> 
                         <a href="javascript:void();" onclick="openPage1('<?php echo $sh_id;?>','shopping','sh_id');" class="btn btn-danger btn-sm">
          				 <span class="glyphicon glyphicon-trash"></span></a>
                         </td>
                      </tr>
                    <?php
                    }
                    ?>
                     </tbody>
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