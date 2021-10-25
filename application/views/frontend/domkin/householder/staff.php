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
           	<div class="col-sm-12 col-md-7"><a href="<?php echo base_url('domkin/requisition/staff_requisition_action');?>" class="btn btn-success btn-sm" style="float:right; margin:0 10px 10px 0;" title="Add New Report"> <span class="glyphicon glyphicon-plus-sign"></span> </a></div>
            <div class="col-sm-12 col-md-7">
            	<div  style="margin:0 10px;">
                    <table class="table table-striped" width="100%">
                                        <thead>
                                          <tr>
                                            <th width="2%">SI</th>
                                            <th width="37%">Staff Name</th>
                                            <th width="32%">Requisition Time</th>
                                            <th width="32%">Requisition Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                    <?php
                    $i=0;
                    foreach($staffdata->result() as $staffdata){
                        $sr_id=$staffdata->sr_id;
						$s_id=$staffdata->s_id;
						$datetime=$staffdata->datetime;
						$status=$staffdata->status;
                        $queryStaff = $this->db->query("SELECT * FROM kin_staff WHERE s_id='".$s_id."'"); 
						foreach($queryStaff->result() as $staffre); 
						
                        $i++;
                    ?>
                     <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $staffre->s_name; ?></td>
                        <td><?php echo $datetime; ?></td>
                        <td><?php echo $status; ?></td>
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