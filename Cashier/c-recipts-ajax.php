<?php 
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';

if($pa=="disp"){

	$sql="SELECT *FROM `patient_info` ORDER BY created_on DESC";
	$stmt=$conn->query($sql);
	if($stmt){
	?>
		<table class="table table-responsive">
				            <th>P_Id</th>
				            <th>Name</th>
				            <th>Age</th>
				            <th>Gender</th>
				            <th>Refered By</th>
				            <th>Disease</th>
				            <th>Amount</th>
				            <th>Date</th>
				            <th>Cashier</th>
					<?php
					while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
								echo "<tr><td>";				
									echo $row['pa_id'];
								echo "</td><td>";				
									echo $row['pa_name'];
								echo "</td><td>";				
									echo $row['pa_age'];
								echo "</td><td>";				
									echo $row['pa_gender'];
								echo "</td><td>";				
									echo $row['refered_by'];
								echo "</td><td>";				
									echo $row['disease'];
								echo "</td><td>";				
									echo $row['total_amount'];
								echo "</td><td>";				
									echo $row['created_on'];
								echo "</td><td>";				
									echo $row['created_by'];
								?>
								</td><td>
								<span style="margin-right:20px; font-size:15px;color:blue;cursor: pointer;" pid="<?php echo $row['pa_id']; ?>" class="print"> <i class="ti-printer"></i></span>
								</td><td>
								<span style="margin-right:20px; font-size:15px;color:red;cursor: pointer;" pid="<?php echo $row['pa_id']; ?>" class="remove"><i class="ti-close"></i></span>
								<!-- </td><td>
								<a  id="<?php //echo $row['m_id'] ?>" class="mview" data-toggle="modal" data-target="#viewModal"> <button type="button" name="mview" class="btn btn-fill btn-primary">View</button></a>
								</td><td>
								<a  id="<?php //echo $row['m_id'] ?>" class="ddel"> <button type="button" name="ddelete" class="btn btn-danger btn-fill">Delete</button></a> -->
								</td></tr>
					<?php
					}
					echo "</table>";
		}
	
		$stmt->free();
}
if($pa=="del"){
	$id = $_POST['id'];
	echo $id;
	exit();
	$sql =" DELETE FROM `patient_info`
            WHERE  pa_id='".$id."';";
    $stmt = $conn->query($sql);
    if($stmt){
        echo "Record was deleted successfully.";
    }else{
        echo "Error, while deleting the rocord.";
    }
}
if($pa=="print"){
	$count=1;
	$p_id=$_POST['id'];
	$sqlp = "SELECT 
            * FROM `patient_info` WHERE `pa_id`='".$p_id."';";
	$stmt2=$conn->query($sqlp);
	while($row1=$stmt2->fetch_array(MYSQLI_ASSOC)){
		$modt = strtotime($row1['created_on']);
		$date = date('d-m-Y', $modt);
		$time = date('G.i.s', $modt);
	?>
		<div class="col-sm-6 text-right">
                                <table>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Patient ID :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_id" id="pa_id" value="<?php echo $row1['pa_id']; ?>" size="40px;" readonly><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Patient Name :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_nm" id="pa_nm" value="<?php echo $row1['pa_name']; ?>" size="40px;" readonly><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Age :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_ag" value="<?php echo $row1['pa_age']; ?>" size="40px;" readonly><br>
                                        </td>
                                    </tr>
                                </table><br><hr>
				</div>
                <div class="col-sm-6 text-right">
                                <table>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Gender :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_gn" size="40px;" value="<?php echo $row1['pa_gender']; ?>" readonly><br> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Refered By :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_refer" size="40px;" value="<?php echo $row1['refered_by']; ?>" readonly><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Disease Name :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_ds" size="40px;" value="<?php echo $row1['disease']; ?>" readonly><br>
                                        </td>
                                    </tr>
                </table><br><hr></div><br><br>

	<?php
	}

	$sql = "SELECT 
            * FROM `temp_prescription`
            INNER JOIN `patient_info`  ON temp_prescription.pa_id = patient_info.pa_id WHERE temp_prescription.pa_id='".$p_id."';";
	$stmt=$conn->query($sql);
	if($stmt->num_rows>0){
			echo '<table class="table">
				<tr style="margin-bottom:2px;">
				<th style="border:0px;border-right: 4px dotted blue;border-left: 4px dotted blue;"><center><u>Sl No.</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>Medicine Name</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>Type</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>Price</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Quantity</u></center></th>
				<th style="border:0px;border-right: 4px dotted blue;"><center><u>&#x20B9; Amount</u></center></th></tr>';
				$totamt=1;
				$no=0;
				$itm='';
		while($row=$stmt->fetch_array(MYSQLI_ASSOC)){
			$id=$row['xx'];
			$tot=$row['m_price'];
			$total = $row['total_amount'];
			$cas=$row['created_by'];
			$net=$row['net_amount'];
			$dis=$row['discount'];
			?>			    
		    	<tr style="margin-bottom:2px;">
		    		<td style="border:0px;border-right: 4px dotted blue;border-left: 4px dotted blue;text-align:center;">
		    			<?php echo $count++; ?>
		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><?php echo $row['m_name']; ?></td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><?php echo $row['m_type']; ?></td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><center>

		    			<input type="text"  name="qnty" class="qntyf" pid="<?php echo $id; ?>" id="<?php echo "qntyf-".$id; ?>" size="10px;" value="<?php echo $row['m_price']; ?>"  style="background-color:Black; color:Lime;text-align: center;" readonly/>&nbsp;&nbsp;&nbsp;&nbsp;

		    			<input type="text"  name="qnty" class="qnty" pid="<?php echo $id; ?>" id="<?php echo "qnty-".$id; ?>" size="10px;" style="background-color:Black; color:Lime; text-align: center;" value=<?php echo $row['quantity']; ?> readonly /></center>

		    		</td>
		    		<td style="border:0px;border-right: 4px dotted blue;"><center>

		    			<input type="text"  name="m_price" class="price" pid="<?php echo $id; ?>" id="<?php echo "amt-".$id; ?>" size="10px;" value="<?php echo $row['total']; ?>" style="background-color:Black; color:Lime; text-align: center;" readonly/></center>

		    		</td>
		    	</tr>
				    
			<?php
		}	echo "</table><hr>";
			echo '<div class="col-sm-offset-1 col-sm-5 text-left" style="font-size: 12px;">';
				echo "<table><tr><td>Cashier Name :</td><td>"."<b>".$cas."</b></td></tr>";
				echo "<tr><td>Payment Date :</td><td>".$date."</td></tr>";
				echo "<tr><td>Payment Time :</td><td>".$time."</td></tr>";
			echo '</table></div>';
			echo '<div class="col-sm-offset-3 col-sm-3 text-right" style="font-size: 12px;">';
			?>
			<table>
				<tr>
				<td>Total Amount :</td> <td>&#x20B9;</td><td><?php echo '<span style="color:red;font-weight:bold;">'.$total; ?></span></td>
				</tr>
				<tr>
					<td>Discount :</td>  <td>&#x20B9; </td> <td><?php echo '<span style="color:green;">'." - ".$dis; ?></span></td>
				</tr>
				<tr>
					<td>Net Total :</td> <td>&#x20B9;</td><td><?php echo '<span style="color:red;font-weight:bold;">'.$net; ?></span></td>
				</tr>
			</table>
			<br><br>
			</div>
			
				<span style="font-size:25px;color:blue;cursor: pointer;text-align:center;" onclick="window.print();"><i class="ti-printer"></i></span>
				<span style="font-size:25px;color:green;cursor: pointer; margin-left:10px;text-align:center;" onclick="window.location.reload();"><i class="ti-back-left"></i></span>
			</div>
			<br><br><br><br>
			<?php
	}else{
		echo "<h6 style='font-size:16px;color:red;text-align:center;'>No Drug Information Available  !</h6>";
	}	
	 $stmt2->free();
	 $stmt->free();
}
if($pa=="disp2"){

	$sql="SELECT *FROM `patient_info` ORDER BY created_on DESC";
	$stmt=$conn->query($sql);
	if($stmt){
	?>
		<table class="table table-responsive">
				            <th>P_Id</th>
				            <th>Name</th>
				            <!-- <th>Product</th> -->
				            <th>Refered By</th>
				            <th>Payment Date</th>
				            <th>Payment Time</th>
				            <th>Payment Amount</th>
				            <th>Cashier</th>
					<?php
					while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
						$modt = strtotime($row['created_on']);
						$date = date('Y-m-d', $modt);
						$time = date('G.i.s', $modt);
								echo "<tr><td>";				
									echo $row['pa_id'];
								echo "</td><td>";				
									echo $row['pa_name'];
								echo "</td><td>";				
									echo $row['refered_by'];
								echo "</td><td>";				
									echo $date;
								echo "</td><td>";				
									echo $time;;
								echo "</td><td>";				
									echo $row['total_amount'];
								echo "</td><td>";				
									echo $row['created_by'];
								?>
								</td><td>
								<!-- <span style="margin-right:20px; font-size:15px;color:blue;cursor: pointer;" pid="<?php //echo $row['pa_id']; ?>" class="print"> <i class="ti-printer"></i></span>
								</td><td>
								<span style="margin-right:20px; font-size:15px;color:red;cursor: pointer;" pid="<?php //echo $row['pa_id']; ?>" class="remove"><i class="ti-close"></i></span> -->
								
								</td></tr>
					<?php
					}
					echo "</table>";
		}
	
		$stmt->free();
}
?>