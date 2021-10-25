<?php include('header.php');?>
<style>
.form-control{
	background:#f5f5f5;
	border-radius:0;
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
<div class="header_img1">
        <div class="container">
       	   <div class="row" style="margin-top:20px;">
           	<div class="col-sm-12 col-md-7 col-md-offset-1">

				<div style="margin:10px 0px; padding:0; width:100%; float:left">
                <div style="float:left; text-align:left; width:100%;">
                <h2 style="font-family:SolaimanLipi; text-align:center">Congratulation !</h2></div>
                <div style="float:left; text-align:left; width:100%">
                    <h5 style="padding:0; line-height:25px; font-weight:normal; font-size:18px; font-family:SolaimanLipi; text-align:center">
                    Your request has been sent to domikin admin. We will contact as soon as<br /><br />
                    Thank you for being us.
                    </h5>
                        
                    </div>
                    
            </div>
          </div>
          
          <div class="col-sm-1"></div>
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
<?php include('footer.php');?>