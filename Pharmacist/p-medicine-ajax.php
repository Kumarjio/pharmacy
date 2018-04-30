<?php
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';

if($pa=="drgd"){
	$sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
			medicine_stock_info.m_id,medicine_stock_info.avialability,medicine_stock_info.sold_qnty
			FROM `medicine_info`
			INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id WHERE 1=1";
	$stmt = $conn->query($sql);
	?>

	 <table class="table ">
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available</th>
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
				?>
				</td><td>
				<a  id="<?php echo $row['m_id'] ?>" class="dup" data-toggle="modal" data-target="#updateModal"> <button type="button" name="dupdate" class="btn btn-success btn-fill">Update</button></a>
				</td><td>
				<a  id="<?php echo $row['m_id'] ?>" class="mview" data-toggle="modal" data-target="#viewModal"> <button type="button" name="mview" class="btn btn-fill btn-primary">View</button></a>
				</td><td>
				<a  id="<?php echo $row['m_id'] ?>" class="ddel"> <button type="button" name="ddelete" class="btn btn-danger btn-fill">Delete</button></a>
				</td></tr>
	<?php
	}
	echo "</table>";
	echo '<div class="text-center">pagination</div>';
}
if($pa=="dinsert"){

    //$dt=$_POST['dt'];
    $id=$_POST['id2'];
    $name=$_POST['mn'];
    $mt=$_POST['mtype'];
    $ctg=$_POST['ctg'];
    $price=$_POST['pc'];
    $trn=$_POST['trn'];
    $adby=$_POST['ad'];
    $cmp=$_POST['cmp'];
    $mf=$_POST['mf'];
    $exp=$_POST['exp'];
    $avl=$_POST['avl'];
    $adp=$_POST['pkts'];

    $sql4 = "SET FOREIGN_KEY_CHECKS=0;";
    $sql1 = "INSERT INTO `medicine_info`(m_id,m_name,m_type,m_category,m_price,add_by) VALUES ('".$id."','".$name."','".$mt."','".$ctg."','".$price."','".$adby."');";
    $sql2 = "INSERT INTO `medicine_compositions`(m_id,compositions,mfg_date,exp_date)VALUES('".$id."','".$cmp."','".$mf."','".$exp."');";
    $sql3 = "INSERT INTO `medicine_stock_info`(m_id,avialability,tray_no,add_drug_pkts_no)VALUES('".$id."',".$avl.",'".$trn."','".$adp."');";
    $sql5 = "SET FOREIGN_KEY_CHECKS=1;";
    
    $res1 = $conn->query($sql4);

    $result = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);

    $res2 = $conn->query($sql5);

    if($result&&$result2&&$result3){
        echo "Record Added Successfully";
    }else{
        echo "Error ! while adding data into the database";
    }
}
if($pa=="dinsert2"){

    //$dt=$_POST['dt'];
    $id=$_POST['id2'];
    $name=$_POST['mn'];
    $mt=$_POST['mtype'];
    $ctg=$_POST['ctg'];
    $price=$_POST['pc'];
    $trn=$_POST['trn'];
    $adby=$_POST['ad'];
    $cmp=$_POST['cmp'];
    $mf=$_POST['mf'];
    $exp=$_POST['exp'];
    $avl=$_POST['avl'];
    $adp=$_POST['pkts'];
    $sql4 = "SET FOREIGN_KEY_CHECKS=0;";

    $sql1 = "UPDATE `medicine_info` SET `m_name`='$name',`m_type`='$mt',`m_category`='$ctg',`m_price`='$price' WHERE m_id='".$id."';";
    $sql2 = "UPDATE `medicine_compositions` SET `compositions`='$cmp',`mfg_date`='$mf',`exp_date`='$exp' WHERE m_id='".$id."';";
    $sql3 = "UPDATE `medicine_stock_info` SET `avialability`='$avl',`tray_no`='$trn',`add_drug_pkts_no`='$adp' WHERE m_id='".$id."';";

	$sql5 = "SET FOREIGN_KEY_CHECKS=1;";
	$result1 = $conn->query($sql4);
    $result = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);
    $result4 = $conn->query($sql5);
    if($result&&$result2&&$result3){
        echo "Record Was Updated Successfully";
    }else{
        echo "Error:".$sql1,$sql2,$sql3.$conn->error;
    }
}
 if($pa=="dup"){
 	$id = $_POST['col_name2'];
 	$sql = "SELECT
            *FROM `medicine_info`
            INNER JOIN `medicine_compositions`  ON medicine_info.m_id = medicine_compositions.m_id
            INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id
            WHERE medicine_info.m_id='".$id."'; ";
    $stmt = $conn->query($sql);
    while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
    ?>

    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="dform2" name="dform2">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="id2">Drug Id:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="id2"  name="id2" value="<?php echo $row['m_id']; ?>"  
                        style="color:black;font-weight:bold;" readonly="readonly">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="mn">Name:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="mn"  name="mn" value="<?php echo $row['m_name']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="mtype">Drug Type:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="mtype" name="mtype" value="<?php echo $row['m_type']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="ctg">Category:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="ctg" name="ctg" value="<?php echo $row['m_category']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pc">Price:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="pc" name="pc" value="<?php echo $row['m_price']; ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="trn">Tray No:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="trn" name="trn" value="<?php echo $row['tray_no']; ?>">
                      </div>
                    </div> 
                    
                </div>
                <div class="col-md-6">
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="avl">Availability:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="avl" name="avl" value="<?php echo $row['avialability']; ?>">
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="ad">Add by:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="ad" name="ad" value="<?php echo $row['add_by']; ?>"  style="color:black;font-weight:bold;" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="mf">Mfd:</label>
                      <div class="col-sm-9">          
                        <input type="date" class="form-control" id="mf" name="mf" value="<?php echo $row['mfg_date']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="exp">Exp:</label>
                      <div class="col-sm-9">          
                        <input type="date" class="form-control" id="exp" name="exp" value="<?php echo $row['exp_date']; ?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pkts">No. Of Packets:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="pkts" name="pkts" value="<?php echo $row['add_drug_pkts_no']; ?>">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="cmp">Composition:</label>
                      <div class="col-sm-9">          
                        <textarea class="form-control border-input" rows="2" cols="2" name="cmp" id="cmp" value="<?php echo $row['compositions']; ?>"></textarea>
                      </div>
                </div>
                </div>
                <div class="col-md-12">
                
                <div class="form-group">        
                      <div class="col-sm-offset-4 col-sm-8">
                        <button type="button" class="btn btn-danger btn-fill btn-wd" 
                         data-dismiss="modal"> Close </button>
                        <input type="submit" class="btn btn-success btn-fill btn-wd" value="Update" id="up" name="up" onclick="updateData()">
                      </div>
                </div>
            </div>
            </div>
         </form>   
<?php 
	}
 }
 if($pa=="mview"){
 	$id = $_POST['col_name2'];
 	$sql = "SELECT 
            *FROM `medicine_info`
            INNER JOIN `medicine_compositions`  ON medicine_info.m_id = medicine_compositions.m_id
            INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id
            WHERE medicine_info.m_id='".$id."';";
    $stmt = $conn->query($sql);
    while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
    ?>
    	<div class="row">
    		<div class="col-sm-4">
    			<table  class="table table table-bordered table-responsive">
    				<tr>
    					<td><b>M_id</b></td>
    					<td><?php echo $row['m_id']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Name</b></td>
    					<td><?php echo $row['m_name']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Type</b></td>
    					<td><?php echo $row['m_type']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Category</b></td>
    					<td><?php echo $row['m_category']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Price</b></td>
    					<td><?php echo $row['m_price']; ?></td>
    				</tr>
    			</table>

    		</div>
    		<div class="col-sm-4">
    			<table  class="table table table-bordered table-responsive">
    				<tr>
    					<td><b>M_id</b></td>
    					<td><?php echo $row['m_id']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Add by</b></td>
    					<td><?php echo $row['add_by']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Compositions</b></td>
    					<td><?php echo $row['compositions']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Mfg Date</b></td>
    					<td><?php echo $row['mfg_date']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Exp Date</b></td>
    					<td><?php echo $row['exp_date']; ?></td>
    				</tr>
    			</table>
    		</div>
    		<div class="col-sm-4">

    			<table  class="table table table-bordered table-responsive">
    				<tr>
    					<td><b>M_id</b></td>
    					<td><?php echo $row['m_id']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Availability</b></td>
    					<td><?php echo $row['avialability']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Tray No</b></td>
    					<td><?php echo $row['tray_no']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Pkt No</b></td>
    					<td><?php echo $row['add_drug_pkts_no']; ?></td>
    				</tr>
    				<tr>
    					<td><b>Drug Date</b></td>
    					<td><?php echo $row['add_drug_date']; ?></td>
    				</tr>
    			</table>

    		</div>
    	</div>

    <?php
	}
 }
 if($pa=="ddel"){
  $id = $_POST['col_name3'];
    $sql =" DELETE FROM medicine_info,medicine_compositions,medicine_stock_info
            USING medicine_info INNER JOIN medicine_compositions INNER JOIN medicine_stock_info 
            WHERE medicine_info.m_id = '".$id."'
            AND medicine_info.m_id = medicine_compositions.m_id
            AND medicine_info.m_id = medicine_stock_info.m_id; ";
    $stmt = $conn->query($sql);
    if($stmt){
        echo "Record was deleted successfully.";
    }else{
        echo "Error, while deleting the rocord.";
    }

 }
 if($pa=="dname"){
    $dn=$_POST['drug'];
        $sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
            medicine_stock_info.m_id,medicine_stock_info.avialability,medicine_stock_info.sold_qnty
            FROM `medicine_info`
            INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id WHERE m_name LIKE '%".$dn."%' ";
    $stmt = $conn->query($sql);
    if($stmt->num_rows > 0){
    ?>
     <table class="table ">
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available</th>
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
                ?>
                </td><td>
                <a  id="<?php echo $row['m_id'] ?>" class="dup" data-toggle="modal" data-target="#updateModal"> <button type="button" name="dupdate" class="btn btn-success btn-fill">Update</button></a>
                </td><td>
                <a  id="<?php echo $row['m_id'] ?>" class="mview" data-toggle="modal" data-target="#viewModal"> <button type="button" name="mview" class="btn btn-fill btn-primary">View</button></a>
                </td><td>
                <a  id="<?php echo $row['m_id'] ?>" class="ddel"> <button type="button" name="ddelete" class="btn btn-danger btn-fill">Delete</button></a>
                </td></tr>
    <?php
        }
    echo "</table>";
    }else{
        echo '<b style="color:red"><center>No Drug Informations is Available.</center></b>';
    }
}
?>