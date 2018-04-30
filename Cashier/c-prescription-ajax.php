<?php
session_start();
if(! $_SESSION['current_user4'] && ! $_SESSION['u_id3']){
    header("location:../index.php");
    exit();
}
if(isset($_SESSION['current_user4']) && isset($_SESSION['u_id3'])){

    $user = $_SESSION['current_user4'];
    $user_id = $_SESSION['u_id3'];
}
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';
$ui=1;
if($pa=="mname1"){
	$name = $_POST['mname'];
	if($name===""){
	}else{
		$sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
				medicine_stock_info.m_id,medicine_stock_info.avialability,medicine_compositions.exp_date
				FROM `medicine_info`
				INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id 
				INNER JOIN `medicine_compositions` ON medicine_compositions.m_id = medicine_stock_info.m_id
				WHERE medicine_info.m_name LIKE '%".$name."%' LIMIT 1";
		$stmt = $conn->query($sql);
		if($stmt->num_rows>0){
		?>
					 <table class="table table-responsive">
				            <th>Name</th>
				            <th>Type</th>
				            <th>Category</th>
				            <th>Expiry</th>
				            <th>Price</th>
				            <th>Available</th>
				            <th>Action</th>
					<?php
					while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
								echo "<tr><td>";?>				
									<input type="text" value="<?php echo $row['m_name'];?>" id="nm"  readonly>
								</td><td>
									<input type="text" value="<?php echo $row['m_type'];?>" id="mt"  readonly>
								</td><td>				
									<input type="text" value="<?php echo $row['m_category'];?>" id="mct"  readonly>
								</td><td>				
									<input type="text" value="<?php echo $row['exp_date'];?>" id="exp" size="8px;"  readonly>
								</td><td>			
									<input type="text" value="<?php echo $row['m_price'];?>" id="mp" size="6px;" readonly>
								</td><td>				
									<input type="text" value="<?php echo $row['avialability'];?>" id="av" size="6px;" readonly>
								</td><td>
								<a  id="<?php echo $row['m_id']; ?>" class="dadd"> <button type="button" name="add" class="btn btn-success btn-fill">Add</button></a>
								</td></tr>
					<?php
					}
					echo "</table>";
		}else{

			echo "<h6 style='font-size:16px;color:red;text-align:center;'>No Medicine's Found !</h6>";
		}
	}
}
if($pa=="tempo_insert"){

	
	$id=$_POST['drug_id'];
	$p_name=$_POST['pa_name'];
	$p_id=$_POST['pa_id'];
	$m_na=$_POST['m_n'];
	$m_t=$_POST['m_t'];
	$m_c=$_POST['m_ct'];
	$exp=$_POST['exp'];
	$m_p=$_POST['m_p'];
	$m_av=$_POST['m_av'];

	$sql="INSERT INTO `temp_prescription`(`m_id`, `m_name`, `m_type`, `m_category`,`exp`, `m_price`, `add_by`, `date_time`, `pa_id`) VALUES ('$id','$m_na','$m_t','$m_c','$exp',$m_p,'$user',now(),'$p_id')";
	$stmt=$conn->query($sql);

}
if($pa=="temp_update"){
	
	$id=$_POST['prodid'];
	$qunt=$_POST['qunt'];
	$amt=$_POST['amt'];

	$sql ="UPDATE `temp_prescription` SET `date_time`=now(),`quantity`=$qunt,`total`=$amt WHERE xx='".$id."';";
	$stmt=$conn->query($sql);
}
if($pa=="disp"){
	$count=1;
	$p_id=$_GET['pa_id'];
	$sql = " SELECT * FROM `temp_prescription`  WHERE `pa_id`='".$p_id."' ";
	$stmt=$conn->query($sql);
	if($stmt->num_rows>0){
			echo '<table class="table tab">
				<tr style="margin-bottom:2px;">
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>Sl NO</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>ITEM NAME</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>TYPE</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>EXPIRY</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>MRP</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>QTY.</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>CGST%</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>SGST%</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>TAXABLE</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>TOTAL AMOUNT</u></center></th></tr>';
				$totamt=1;
				$no=0;
				$itm='';
		while($row=$stmt->fetch_array(MYSQLI_ASSOC)){
			$id=$row['xx'];
			$tot=$row['m_price'];
			?>			    
		    	<tr style="margin-bottom:2px;">
		    		<td style="border:0px;border-right: 4px dotted blue;">
		    			<span style="margin-right:20px; font-size:10px;color:red;cursor: pointer;" pid="<?php echo $id; ?>" class="remove"><i class="ti-close"></i></span><?php echo $count++; ?>
		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><?php echo $row['m_name']; ?></td>
		    		<!-- <td style="border:0px;border-right: 4px dotted blue;"><?php //echo $row['batch_no']; ?></td> -->
		    		<td style="border:0px;border-right: 4px dotted blue;"><?php echo $row['m_type']; ?></td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><?php echo $row['exp']; ?></td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><center>

		    			<input type="text"  name="qnty" class="qntyf" pid="<?php echo $id; ?>" id="<?php echo "qntyf-".$id; ?>" size="6px;" value="<?php echo $row['m_price']; ?>"  style="background-color:Black; color:Lime;text-align:center;" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;

		    			<input type="text"  name="qnty" class="qnty" pid="<?php echo $id; ?>" id="<?php echo "qnty-".$id; ?>" size="6px;" style="background-color:Black; color:Lime;text-align:center;" value="1" /></center>

		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;">
						<center><input type="text"   class="cgst" pid="<?php echo $id; ?>" id="<?php echo "cgst-".$id; ?>" size="3px;" value="<?php echo $row['cgst']; ?>" style="text-align:center;" readonly/></center>		    			
		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;">
		    			<center><input type="text"   class="sgst" pid="<?php echo $id; ?>" id="<?php echo "sgst-".$id; ?>" size="3px;" value="<?php echo $row['sgst']; ?>" style="text-align:center;" readonly/></center>
		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;">
		    			<center><input type="text"   class="tax" pid="<?php echo $id; ?>" id="<?php echo "tax-".$id; ?>" size="6px;" value="<?php echo $row['taxable']; ?>" style="text-align:center; background-color:Black; color:Lime;" readonly/></center>
		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><center>

		    			<input type="text"  name="m_price" class="price" pid="<?php echo $id; ?>" id="<?php echo "amt-".$id; ?>" size="8px;" value="<?php echo $row['m_price']; ?>" style="background-color:Black; color:Lime;text-align:center;" readonly/></center>

		    		</td>
		    	</tr>
				    
			<?php
		}	
		?>
		<tr>
			<td  colspan="7" style="border:0px;padding-top:100px;"></td>
			<td style="border:0px;"></td>
		</tr>
		<tr>
			<td  colspan="7"><i>Chemio Pharamcy (Amrutasandhanam),Bhubaneswar, Odisha,Tel No-</i></td>
			<td style="border:0px;border-right: 4px dotted blue;border-left: 4px dotted blue;text-align:center;">Total</td>
			<td style="border:0px;border-right: 4px dotted blue;border-left: 4px dotted blue;text-align:center;">

				<input type="text" class="gtotal12" name="gtotal1" id="gtotal" style="background-color:Black; color:Lime;text-align:center;" size="8px;">

			</td>
		</tr>
		<tr>
			<td  colspan="7"><i>Supported By - <a href="www.ferventis.com">Ferventis Knowledge Solutions Pvt.Ltd</a></i></td>
			<td style="border:0px;border-right: 4px dotted blue;border-left: 4px dotted blue;text-align:center;">Discount</td>
			<td style="border:0px;border-right: 4px dotted blue;border-left: 4px dotted blue;text-align:center;">

				<input type="text" class="discount1" name="dis" id="discount" style="background-color:Black; color:Lime;text-align:center;" size="8px;"
				 value="0.00">

			</td>
		</tr>
		<tr>
			<td  colspan="7"></td>
			<td><center><b>Net Total</b><center></td>
			<td>
					<center><input type="text" class="net" name="net" id="nettotal" style="background-color:Black; color:Lime;font-weight:bold;text-align:center" size="8px;"></center>
			</td>
		</tr>
		</table>
			<?php
	}	
}
if($pa=="del"){
	$id = $_POST['id'];
	$sql =" DELETE FROM `temp_prescription`
            WHERE  xx='".$id."';";
    $stmt = $conn->query($sql);
    if($stmt){
        echo "Record was deleted successfully.";
    }else{
        echo "Error, while deleting the rocord.";
    }
}
if($pa=="pa_insert"){

	$pid=$_POST['pa_id'];
	$pname=$_POST['pa_nm'];
	$pag=$_POST['pa_ag'];
	$pr=$_POST['pa_refer'];
	$pgn=$_POST['pa_gn'];
	$pds=$_POST['pa_ds'];
	$ptot=$_POST['gtotal1'];
	$net=$_POST['net'];
	$dis=$_POST['dis'];
	

	$sql = " INSERT INTO `patient_info`(`pa_id`, `pa_name`, `pa_age`, `pa_gender`, `refered_by`, `disease`,`created_by`, `discount`,`total_amount`,`net_amount`) VALUES ('$pid','$pname',$pag,'$pgn','$pr','$pds','$user',$dis,$ptot,$net) ";
	$stmt=$conn->query($sql);

	$sql2 = "UPDATE `medicine_stock_info`,`temp_prescription`
			SET avialability=avialability-quantity
			WHERE medicine_stock_info.m_id = temp_prescription.m_id AND temp_prescription.pa_id='".$pid."'";
	$stmt2=$conn->query($sql2);

}
?>