<?php  
session_start();
if(! $_SESSION['current_user2']){
    header("location:index.php");
    exit();
}
if(isset($_SESSION['current_user2'])){

	$user_id = $_SESSION['current_user2'];
}
?>
<?php 
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';
$pa2 = isset($_GET['p2']) ? $_GET['p2']:'';
if($pa=="1"){
	$sql = "SELECT *FROM `user_requests`";
	$stmt = $conn->query($sql);
	?>
	 <table class="table">
            <th>ID</th>
            <th>Name</th>
            <th>User Type</th>
            <th>Types Of Permisson</th>
            <th>Request Date</th>
            <th>Approved By</th>
            <th>Accepted Date</th>
            <th>Status</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){

				echo "<tr><td>";
					echo $row['id'];
				echo "</td><td>";				
					echo $row['u_name'];
				echo "</td><td>";				
					echo $row['u_type'];
				echo "</td><td>";				
					echo $row['types_of_permission'];
				echo "</td><td>";				
					echo $row['d_of_request'];
				echo "</td><td>";				
					echo $row['approve_by'];
				echo "</td><td>";				
					echo $row['d_of_accept'];
				echo "</td><td>";
				if($row['status']=="Accept"){
					echo"<i class='fa fa-circle text-success'></i>";
				}else if($row['status']=="Reject"){
					echo"<i class='fa fa-circle text-danger'></i>";
				}else{
					echo"<i class='fa fa-circle text-warning'></i>";
				}
				?>
				</td></tr>
	<?php
	}
	echo "</table>";	
}
if($pa=="2"){
	$sql = "SELECT *FROM `user_requests`";
	$stmt = $conn->query($sql);
	?>
	 <table class="table">
            <th>Name</th>
            <th>User</th>
            <th>Message</th>
            <th>Permisson</th>
            <th>Request</th>
            <th>Status</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr>";
					// echo $row['id'];
				echo "<td>";				
					echo $row['u_name'];
				echo "</td><td>";				
					echo $row['u_type'];
				echo "</td><td>";				
					echo $row['msg'];
				echo "</td><td>";				
					echo $row['types_of_permission'];
				echo "</td><td>";				
					echo $row['d_of_request'];
				echo "</td><td>";
				if($row['status']=="Accept"){
					echo"<i class='fa fa-circle text-success'></i>";
				}else if($row['status']=="Reject"){
					echo"<i class='fa fa-circle text-danger'></i>";
				}else{
					echo"<i class='fa fa-circle text-warning'></i>";
				}
			?>
				
				</td><td>
				<a  id="<?php echo $row['id'] ?>" class="acp"> <button type="button" class="btn btn-success btn-fill">Accept</button></a>
				</td><td>

				<a  id="<?php echo $row['id'] ?>" class="rej"> <button type="button" class="btn btn-danger btn-fill">Reject</button></a>
				</td></tr>
	<?php
	}
	echo "</table>";	
}
if($pa2=="acp"){
	$id = $_POST['id'];
	$sql = "UPDATE `user_requests` SET `d_of_accept`=now(),`approve_by`='".$user."',`status`='Accept',`modified_date`=now() WHERE id=$id";
	$stmt=$conn->query($sql);
}
if($pa2=="rej"){
	$id = $_POST['id'];
	$sql = "UPDATE `user_requests` SET `d_of_accept`=now(),`approve_by`='".$user."',`status`='Reject',`modified_date`=now() WHERE id=$id";
	$stmt=$conn->query($sql);	
}
if($pa=="pac"){
$sql = "SELECT p_id,name,status FROM `pharmacist` WHERE status=1";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Operations</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					?> <a  id="<?php echo $row['p_id'] ?>" class="pbl"> <button type="button" class="btn btn-danger">Block</button></a>
				<?php
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['status']==1){
					echo "<i class='fa fa-circle text-success'></i>";
				}else{
					echo "Inactive";
				}
			} ?>
				</td></tr>
			</table>
<?php
}
if($pa=="pia"){

	$sql = "SELECT p_id,name,status FROM `pharmacist` WHERE status=0";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Operations</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					?> <a  id="<?php echo $row['p_id'] ?>" class="pbl1"> <button type="button" class="btn btn-danger">Block</button></a>
				<?php
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['status']==0){
					echo "<i class='fa fa-circle text-warning'></i>";
				}else{
					echo "Inactive";
				}
			} ?>
				</td></tr>
			</table>
<?php
	
}
if($pa=="pbl"){


	$sql = "SELECT p_id,name,block_unblock FROM `pharmacist` WHERE block_unblock=1";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Operations</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					?> <a  id="<?php echo $row['p_id'] ?>" class="pblu"> <button type="button" class="btn btn-success">Unblock</button></a>
				<?php
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['block_unblock']==1){
					echo "<i class='fa fa-circle text-danger'></i>";
				}else{
					echo "Inactive";
				}
			} ?>
				</td></tr>
			</table>
<?php
	
}
if($pa=="cac"){
$sql = "SELECT c_id,name,status FROM `cashier` WHERE status=1";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Operations</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					?> <a  id="<?php echo $row['c_id'] ?>" class="cbl"> <button type="button" class="btn btn-danger">Block</button></a>
				<?php
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['status']==1){
					echo "<i class='fa fa-circle text-success'></i>";
				}else{
					echo "Inactive";
				}
			} ?>
				</td></tr>
			</table>
<?php
}
if($pa=="cia"){

	$sql = "SELECT c_id,name,status FROM `cashier` WHERE status=0";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Operations</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					?> <a  id="<?php echo $row['c_id'] ?>" class="cbl1"> <button type="button" class="btn btn-danger">Block</button></a>
				<?php
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['status']==0){
					echo "<i class='fa fa-circle text-warning'></i>";
				}else{
					echo "Inactive";
				}
			} ?>
				</td></tr>
			</table>
<?php
	
}
if($pa=="cbl"){


	$sql = "SELECT c_id,name,block_unblock FROM `cashier` WHERE block_unblock=1";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Operations</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					?> <a  id="<?php echo $row['c_id'] ?>" class="cblu"> <button type="button" class="btn btn-success">Unblock</button></a>
				<?php
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['block_unblock']==1){
					echo "<i class='fa fa-circle text-danger'></i>";
				}else{
					echo "Inactive";
				}
			} ?>
				</td></tr>
			</table>
<?php
	
}
if($pa=="pblpbl"){

	$id = $_GET['id'];
	$sql = "UPDATE `pharmacist` SET `status`=0,`block_unblock`=1,`modified_date`=now() WHERE p_id='".$id."'";
	$stmt=$conn->query($sql);
}
if($pa=="pbl1"){
	$id = $_GET['id'];
	$sql = "UPDATE `pharmacist` SET `status`=0,`block_unblock`=1,`modified_date`=now() WHERE p_id='".$id."'";
	$stmt=$conn->query($sql);

}
if($pa=="pblu"){
	$id = $_GET['id'];
	$sql = "UPDATE `pharmacist` SET `status`=1,`block_unblock`=0,`modified_date`=now() WHERE p_id='".$id."'";
	$stmt=$conn->query($sql);

}
if($pa=="cblcbl"){
	$id = $_GET['id'];
	$sql = "UPDATE `cashier` SET `status`=0,`block_unblock`=1,`modified_date`=now() WHERE c_id='".$id."'";
	$stmt=$conn->query($sql);

}
if($pa=="cbl1"){
	$id = $_GET['id'];
	$sql = "UPDATE `cashier` SET `status`=0,`block_unblock`=1,`modified_date`=now() WHERE c_id='".$id."'";
	$stmt=$conn->query($sql);

}
if($pa=="cblu"){
	$id = $_GET['id'];
	$sql = "UPDATE `cashier` SET `status`=1,`block_unblock`=0,`modified_date`=now() WHERE c_id='".$id."'";
	$stmt=$conn->query($sql);
}
?>