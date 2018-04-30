<?php 
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';
if($pa=="dname"){
	$dn=$_POST['drug'];
	$sql = "SELECT 
			*FROM `medicine_info`
			INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id
			INNER JOIN `medicine_compositions`  ON medicine_info.m_id = medicine_compositions.m_id
			WHERE m_name LIKE '%".$dn."%'";
	$stmt = $conn->query($sql);
	?>
	 <table class="table">
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available</th>
            <th>Tray No</th>
            <th>Batch No</th>
            <th>Expiry</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";				
					echo $row['m_name'];
				echo "</td><td>";				
					echo $row['m_type'];
				echo "</td><td>";				
					echo $row['m_category'];
				echo "</td><td>";				
					echo $row['m_price'];
				echo "</td><td>";				
					echo $row['avialability'];
				echo "</td><td>";				
					echo $row['tray_no'];
				echo "</td><td>";				
					echo $row['batch_no'];
				echo "</td><td>";				
					echo $row['exp_date'];
				?>
				</td></tr>
	<?php
	}
	echo "</table></div>";

}
if($pa=="info"){

	$sql = "SELECT 
			*FROM `medicine_info`
			INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id
			INNER JOIN `medicine_compositions`  ON medicine_info.m_id = medicine_compositions.m_id
			WHERE 1=1";
	$stmt = $conn->query($sql);
	?>
	 <table class="table">
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available</th>
            <th>Tray No</th>
            <th>Batch No</th>
            <th>Expiry</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";				
					echo $row['m_name'];
				echo "</td><td>";				
					echo $row['m_type'];
				echo "</td><td>";				
					echo $row['m_category'];
				echo "</td><td>";				
					echo $row['m_price'];
				echo "</td><td>";				
					echo $row['avialability'];
				echo "</td><td>";				
					echo $row['tray_no'];
				echo "</td><td>";				
					echo $row['batch_no'];
				echo "</td><td>";				
					echo $row['exp_date'];
				?>
				</td></tr>
	<?php
	}
	echo "</table>";
	
	echo '<div class="text-center">pagination</div>';

}