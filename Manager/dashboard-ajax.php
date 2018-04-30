<?php
include_once '../common/config.php'; 
    $pa = isset($_GET['p1']) ? $_GET['p1']:'';
    $pa2 = isset($_GET['p2']) ? $_GET['p2']:'';
    $today=date("Y-m-d");
if($pa=="a"){
	$sql = " SELECT SUM(avialability) AS total_drug FROM  `medicine_stock_info`";
	$stmt = $conn->query($sql);
	$val = $stmt -> fetch_array();
	$tech_total = $val['total_drug'];
	echo $tech_total;
}
if($pa2=="b"){
	$sql = " SELECT SUM(quantity) AS total_drug FROM  `temp_prescription` WHERE DATE(date_time)='$today'";
	$stmt = $conn->query($sql);
	$val = $stmt -> fetch_array();
	$tech_total = $val['total_drug'];
	echo $tech_total;
}
if($pa2=="au"){
	$sql = "SELECT m_id,m_name,status FROM manager WHERE status=1";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
			<tr>
				<th>Id</th>
				<th class="thn">Name</th>
				<th class="ths">Status</th>
			</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					echo $row['m_id'];
				echo "</td><td class='tdn'>";
					echo $row['m_name'];
				echo "</td><td class='tds'>";
				if($row['status']==1){
					echo "&nbsp;&nbsp;&nbsp;<i class='fa fa-circle text-success'></i>";
				}else{
					echo "Inactive";
				}
				?>
				</td></tr>
	<?php
	}
	$sql = "SELECT p_id,name,status FROM pharmacist WHERE status=1";
	$stmt = $conn->query($sql);
	?>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					echo $row['p_id'];
				echo "</td><td class='tdn'>";
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['status']==1){
					echo "&nbsp;&nbsp;&nbsp;<i class='fa fa-circle text-success'></i>";
				}else{	
					echo "Inactive";
				}
				?>
				</td></tr>
	<?php
	}
	$sql = "SELECT c_id,name,status FROM cashier WHERE status=1";
	$stmt = $conn->query($sql);
	?>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					echo $row['c_id'];
				echo "</td><td class='tdn'>";				
					echo $row['name'];
				echo "</td><td class='tds'>";
				if($row['status']==1){
					echo "&nbsp;&nbsp;&nbsp;<i class='fa fa-circle text-success'></i>";
				}else{
					echo "&nbsp;&nbsp;&nbsp;<i class='fa fa-circle text-danger'></i>";
				}
				?>
				</td></tr>
	<?php
	}
	echo "
		</table>";	
}

if($pa2=="dts"){
	$sql = " SELECT SUM(net_amount) AS sold_drug FROM  `patient_info` WHERE DATE(created_on)='$today'";
	$stmt = $conn->query($sql);
	$val = $stmt -> fetch_array();
	$tech_total = $val['sold_drug'];
	printf("%.2f",$tech_total); 
}

if($pa2=="da"){
	$sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_stock_info.avialability,medicine_stock_info.add_drug_date
	FROM `medicine_info`
	INNER JOIN `medicine_stock_info`  ON medicine_info.id = medicine_stock_info.m_id WHERE medicine_stock_info.avialability<=30;";
	$stmt = $conn->query($sql);
	?>
	<table class="table">
				<tr>
					<th>Drug Name</th>
					<th>Drug Type</th>
					<th>Available Pkts</th>
					<th>Date Of Added</th>
				</tr>		
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
		echo "<tr><td>";
		echo $row['m_name']."</td><td>";
		echo $row['m_type']."</td><td>";
		echo $row['avialability']."</td><td>";
		echo $row['add_drug_date']."</td></tr>";
}
	echo "</table>";
}
?>