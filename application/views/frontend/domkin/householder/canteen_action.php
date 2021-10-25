<?php $this->load->view('frontend/domkin/header');?>
<?php
if($canteenUpdate->num_rows()>0){
	foreach($canteenUpdate->result() as $reportData);
	$c_id=$reportData->c_id;
	$shop_type=$reportData->shop_type;
	$shop_price=$reportData->shop_price;
	$delivery_place=$reportData->delivery_place;
}
else{
	$c_id='';
	$shop_type=set_value('shop_type');
	$shop_price=set_value('shop_price');
	$delivery_place=set_value('delivery_place');
	}
?>

<?php 
date_default_timezone_set('Asia/Dhaka');
$currenttime 	= date('h a',strtotime("now"));
//$currenttime 	= "9 pm"; // Testing...

$bfast_start 	= "5 am";
$bfast_end 		= "10 am";
$lunch_end 		= "2 pm";
$snacks_start   = "4 pm";
$snacks_end 	= "6 pm";
$dinner_end 	= "8 pm";

$now_time		= DateTime::createFromFormat('h a', $currenttime);
$bStart 		= DateTime::createFromFormat('h a', $bfast_start);
$bEnd			= DateTime::createFromFormat('h a', $bfast_end);
$lEnd			= DateTime::createFromFormat('h a', $lunch_end);
$snStart		= DateTime::createFromFormat('h a', $snacks_start);
$snEnd			= DateTime::createFromFormat('h a', $snacks_end);
$dEnd			= DateTime::createFromFormat('h a', $dinner_end);

//echo gettype($now_time);
//echo gettype($now_time);
if ($now_time >= $bStart && $now_time <= $bEnd)
{
   $canteenType = 'Break First';
   $disaena = '';
}
elseif ($now_time >= $bEnd && $now_time <= $lEnd)
{
   $canteenType = 'Lunch';
   $disaena = '';
}
elseif ($now_time >= $snStart && $now_time <= $snEnd)
{
   $canteenType = 'Snacks';
   $disaena = '';
}
elseif ($now_time >= $snEnd && $now_time <= $dEnd)
{
   $canteenType = 'Dinner';
   $disaena = '';
}
else{
	//$canteenType =  'Canteen Time Closed';
	$canteenType = 'Rest Time';
	//$disaena = 'disabled="disabled" readonly="readonly"';
	 $disaena = '';
}
$queryPacages = $this->db->query("SELECT * FROM canteen_packages WHERE canteen_type='".$canteenType."'");
$queryItem = $this->db->query("SELECT * FROM canteen_item WHERE item_type='".$canteenType."'");
?>
<script type="text/javascript">
function canteenType(){
	var canteen_type = document.getElementById('canteen_type').value;
	if(canteen_type=='Packages'){
		document.getElementById('packarea').style.display='block';
		document.getElementById('custoarea').style.display='none';
		document.getElementById('pricety').style.display='block';
	}
	else if(canteen_type=='Customize'){
		document.getElementById('packarea').style.display='none';
		document.getElementById('custoarea').style.display='block';
		document.getElementById('pricety').style.display='block';
	}
}


function canteenCalculate(){
	var canteen_type = document.getElementById('canteen_type').value;
	if(canteen_type=='Packages'){
		 var titletxt =	document.getElementById('packval').selectedOptions[0].text;
   		 var titleval =	document.getElementById('packval').selectedOptions[0].value;
	}
	else if(canteen_type=='Customize'){
		var titletxt =	document.getElementById('custval').selectedOptions[0].text;
  		var titleval =	document.getElementById('custval').selectedOptions[0].value;
	}
	
   
   var qty = document.getElementById('qty').value;
   document.getElementById('unitprice').value=titleval;
   document.getElementById('totalprice').value=titleval*qty;
   
   
   document.getElementById('uprice').value=titleval;
   document.getElementById('tprice').value=titleval*qty;
   document.getElementById('menuitem').value=titletxt;
   document.getElementById('quantity').value=qty;
}
</script>
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
                        	<select name="s_id" class="form-control">
                                	<option value="">Staff List</option>
                                    
                                     <?php
										foreach($staffdata->result() as $staff){
											$s_id=$staff->s_id;
											
											 $queryStaff = $this->db->query("SELECT * FROM kin_staff WHERE s_id='".$s_id."'"); 
											 foreach($queryStaff->result() as $staffre);
											 $staffname = $staffre->s_name;
									?>
                                    <option value="<?php echo $s_id;?>"><?php echo $staffname;?></option>
                                    <?php
                                    }
									?>
                                </select>
                        </div>
                      </div>
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0">
                      	<label class="control-label col-md-3">Canteen Type :</label>
                      	<div class="col-sm-12 col-md-6">
                        	<input type="text" name="cant_type" class="form-control" value="<?php echo $canteenType;?>" readonly="readonly" />
                        </div>
                      </div>
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0">
                      	<label class="control-label col-md-3">Item Menu :</label>
                      	<div class="col-sm-12 col-md-6">
                        	 <select name="item_type" id="canteen_type" class="form-control" onchange="canteenType();" <?php echo $disaena;?>>
                                		<option value="">Select Canteen Type</option>
                                        <option value="Packages">Packages Item</option>
                                        <option value="Customize">Customize Item</option>
                                    </select>
                        </div>
                      </div>
                      
                      
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0; display:none" id="packarea">
                      	<label class="control-label col-md-3">Packages :</label>
                      	<div class="col-sm-12 col-md-6">
                        	<select name="packval" id="packval" class="form-control" onchange="canteenCalculate();" <?php echo $disaena;?>>
                                <option value="">Packages List</option>
                                 <?php
                                    foreach($queryPacages->result() as $pack){
                                        $package_item=$pack->package_item;
                                        $price=$pack->price;
                                ?>
                               
                                <option value="<?php echo $price;?>"><?php echo $package_item;?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                      </div>
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0; display:none" id="custoarea">
                      	<label class="control-label col-md-3">Customize Item :</label>
                      	<div class="col-sm-12 col-md-6">
                        	<select name="custval" id="custval" class="form-control" onchange="canteenCalculate();" <?php echo $disaena;?>>
                                                    <option value="">Item List</option>
                                                    
                                                     <?php
                                                        foreach($queryItem->result() as $pack){
                                                            $item_id=$pack->item_id;
                                                            $item_name=$pack->item_name;
                                                            $item_price=$pack->item_price;
                                                    ?>
                                                   
                                                    <option value="<?php echo $item_price;?>"><?php echo $item_name;?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                        </div>
                      </div>
                      
                      
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0; display:none" id="pricety">
                      	<label class="control-label col-md-3">Price/Qty :</label>
                      	<div class="col-sm-12 col-md-6">
                        	<input type="text" class="form-control" style="width:20%; float:left;" id="qty" placeholder="Qty" value="1" onkeyup="canteenCalculate();" onchange="canteenCalculate();" <?php echo $disaena;?>><span style="float:left; width:1%; margin:5px;">X</span>
                            <input type="text" class="form-control" style="width:30%; float:left; margin-left:5px;" id="unitprice" disabled="disabled">
                            <span style="float:left; width:1%; margin:5px;">=</span>
                            <input type="text" class="form-control" style="width:38%; float:left; margin-left:5px;" id="totalprice" <?php echo $disaena;?> disabled="disabled">
                            
                        </div>
                      </div>
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0">
                      	<label class="control-label col-md-3">Delivery Place :</label>
                      	<div class="col-sm-12 col-md-6">
                        	<textarea class="form-control" name="delivery_place" rows="5" <?php echo $disaena;?>><?php echo $delivery_place;?></textarea>
                        </div>
                      </div>
                      <div class="col-md-12" style="border-bottom:1px solid #ccc; padding:10px 0">
                      	<label class="control-label col-md-3"></label>
                      	<div class="col-sm-12 col-md-6">
                        	<input type="hidden" name="c_id" value="<?php echo $c_id; ?>">
                            <input type="hidden" name="qty" id="quantity">
                            <input type="hidden" name="unitprice" id="uprice">
                            <input type="hidden" name="totalprice" id="tprice">
                            <input type="hidden" name="menuitem" id="menuitem">
                            <input name="canteen_action" type="submit" class="btn btn-success" value="Submit" style="width:20%; float:right" <?php echo $disaena;?>/>
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