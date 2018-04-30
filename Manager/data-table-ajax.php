<?php 
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';
if($pa=="1"){
	$sql = "SELECT pharmacist.p_id,pharmacist.name,pharmacist.contact,pharmacist.emp_type,pharmacist.d_o_j,pharmacist.status,pharmacist.block_unblock,
                   pharmacist.dp,emp_address.d_o_b,emp_address.blood_group
            FROM `pharmacist`
            INNER JOIN `emp_address`  ON pharmacist.p_id = emp_address.p_id WHERE 1=1";
    $stmt = $conn->query($sql);
	?>
    <div class="container-fluid" style="margin-top:-10px;">
			<div class="row">
				<!-- <div class="col-md-offset-8 col-md-3 text-right">
					<input type="text" class="form-control border-input input-sm txt" id="uname" name="uname" placeholder="Enter search data"/>
                </div> -->
                <div class="col-md-offset-10 col-md-2 text-right">
					<button type="button" name="padd" class="btn btn-info btn-fill"  data-toggle="modal" data-target="#myModal" onclick="uniqueId();">Add</button>
                </div>
            </div>	
    </div>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
	?>
		<div class="col-lg-4 col-md-5">
                        <div class="card card-user" style="font-size:12px; margin-top:10px;">
                            <div class="image">
                                <img src="../assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="../assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title" style="font-size:13px;"><?php echo $row['name']; ?><br />
                                     <a href="#"><small>@medio_pharmacy</small></a>
                                  </h4>
                                </div>
                                <p class="description">
                                   <div class="text-left"> 
                                   	<div class="row">
                                    	<div class="col-md-6 text-right">
                                        	<b>Employee Type :</b>
                                    	</div>
                                    	<div class="col-md-6 text-left">
                                        	<?php echo $row['emp_type']; ?>
                                    	</div>
                                    	<div class="col-md-6 text-right">
                                        	<b>Contact No :</b>
                                    	</div>
                                    	<div class="col-md-6 text-left">
                                        	<?php echo $row['contact']; ?>
                                    	</div>
                                    	<div class="col-md-6 text-right">
                                        	<b>Date Of Joining :</b>
                                    	</div>
                                    	<div class="col-md-6 text-left">
                                        	 <?php echo $row['d_o_j']; ?>
                                    	</div>
                                    </div>
                                  </div>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center" style="font-size:12px;">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-2">
                                        <h5 style="font-size:13px;"><?php echo $row['blood_group']; ?><br /><small>B.G</small></h5>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <h5 style="font-size:13px"><?php echo $row['d_o_b']; ?><br /><small>D.O.B</small></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 style="font-size:13px;">
                                        	<?php if($row['status']=="1"){
												echo"<i class='fa fa-circle text-success'></i>";
											}else if($row['block_unblock']=="1"){
												echo"<i class='fa fa-circle text-danger'></i>";
											}else{
												echo"<i class='fa fa-circle text-warning'></i>";
											} ?><br /><small>Status</small></h5>
                                    </div>
                                    <div class="col-md-1">
                                        
                                        <button title="Edit User" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['p_id'] ?>" class="pup" data-toggle="modal" data-target="#updateModal" ><i class="ti-pencil" style="color:white; background-color: black;  font-size: 14px;"></i></a></button><br>
                                        <button title="View More" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['p_id'] ?>" class="pview" data-toggle="modal" data-target="#viewModal"><i class="ti-info" style="color:white;background-color:black; font-size: 14px;"></i></a></button><br>
                                        <button title="Delete User" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['p_id'] ?>" class="pdel"><i class="ti-close" style="color:red;background-color:black; font-size: 14px;"></i></a></button>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="text-center" style="font-size:12px;">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-3">
                                        <a  id="<?php  //echo $row['p_id'] ?>" class="pup" data-toggle="modal" data-target="#updateModal"> <button type="button" name="pupdate" class="btn btn-success">Edit&nbsp;</button></a>
                                    </div>
                                    <div class="col-md-3">
                                    	<a  id="<?php  //echo $row['p_id'] ?>" class="pview" data-toggle="modal" data-target="#viewModal"> <button type="button" name="pview" class="btn  btn-primary">More</button></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a  id="<?php  //echo $row['p_id'] ?>" class="pdel"> <button type="button" name="pdelete" class="btn btn-danger ">Delete</button></a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
             </div>
	<?php
	}
	echo '<div class="text-center">pagination</div>';
}
if($pa=="2"){
	$sql = "SELECT cashier.c_id,cashier.name,cashier.contact,cashier.emp_type,
                   cashier.d_o_j,cashier.status,cashier.block_unblock,
                   cashier.dp,emp_address.d_o_b,emp_address.blood_group
            FROM `cashier`
            INNER JOIN `emp_address`  ON cashier.c_id = emp_address.c_id WHERE 1=1";
	$stmt = $conn->query($sql);
	?>
	<div class="container-fluid" style="margin-top:-10px;">
			<div class="row">
				<!-- <div class="col-md-offset-8 col-md-3 text-right">
					<input type="text" class="form-control border-input input-sm txt" id="uname" name="uname" placeholder="Enter search data"/>
                </div> -->
                <div class="col-md-offset-10 col-md-2 text-right">
					<button type="button" name="padd" class="btn btn-info btn-fill"  data-toggle="modal" data-target="#myModal2" onclick="uniqueId();">Add</button>
                </div>
            </div>	
    </div>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
		?>
				<div class="col-lg-4 col-md-5">
                        <div class="card card-user" style="font-size:12px; margin-top:10px;">
                            <div class="image">
                                <img src="../assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="../assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title" style="font-size:13px;"><?php echo $row['name']; ?><br />
                                     <a href="#"><small>@medio_pharmacy</small></a>
                                  </h4>
                                </div>
                                <p class="description">
                                   <div class="text-left"> 
                                   	<div class="row">
                                    	<div class="col-md-6 text-right">
                                        	<b>Employee Type :</b>
                                    	</div>
                                    	<div class="col-md-6 text-left">
                                        	<?php echo $row['emp_type']; ?>
                                    	</div>
                                    	<div class="col-md-6 text-right">
                                        	<b>Contact No :</b>
                                    	</div>
                                    	<div class="col-md-6 text-left">
                                        	<?php echo $row['contact']; ?>
                                    	</div>
                                    	<div class="col-md-6 text-right">
                                        	<b>Date Of Joining :</b>
                                    	</div>
                                    	<div class="col-md-6 text-left">
                                        	 <?php echo $row['d_o_j']; ?>
                                    	</div>
                                    </div>
                                  </div>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center" style="font-size:12px;">
                                <div class="row">
                                     <div class="col-md-offset-1 col-md-2">
                                        <h5 style="font-size:13px;"><?php echo $row['blood_group']; ?><br /><small>B.G</small></h5>
                                    </div>
                                    <div class="col-md-5 text-center">
                                        <h5 style="font-size:13px"><?php echo $row['d_o_b']; ?><br /><small>D.O.B</small></h5>
                                    </div>
                                    <div class="col-md-2">
                                        <h5 style="font-size:13px;">
                                            <?php if($row['status']=="1"){
                                                echo"<i class='fa fa-circle text-success'></i>";
                                            }else if($row['block_unblock']=="1"){
                                                echo"<i class='fa fa-circle text-danger'></i>";
                                            }else{
                                                echo"<i class='fa fa-circle text-warning'></i>";
                                            } ?><br /><small>Status</small></h5>
                                    </div>
                                    <div class="col-md-1">
                                        <button title="Edit User" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['c_id'] ?>" class="cup" data-toggle="modal" data-target="#updateModal" ><i class="ti-pencil" style="color:white; background-color: black;  font-size: 14px;"></i></a></button><br>
                                        <button title="View More" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['c_id'] ?>" class="cview" data-toggle="modal" data-target="#viewModal"><i class="ti-info" style="color:white;background-color:black; font-size: 14px;"></i></a></button><br>
                                        <button title="Delete User" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['c_id'] ?>" class="cdel"><i class="ti-close" style="color:red;background-color:black; font-size: 14px;"></i></a></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
			
	<?php
	}
    echo '<div class="text-center">pagination</div>';
	
}
if($pa=="3"){
	$sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
			medicine_stock_info.m_id,medicine_stock_info.avialability,medicine_stock_info.sold_qnty
			FROM `medicine_info`
			INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id WHERE 1=1";
	$stmt = $conn->query($sql);
	?>
	<div class="col-md-offset-1 col-md-10 col-md-offset-1 card content table-responsive" style="margin-top:-10px;">
			<!-- <div class="row">
				<div class="col-md-offset-9 col-md-3 text-right">
					<input type="text" class="form-control border-input input-sm txt" id="uname" name="uname" placeholder="Enter search data"/>
                </div>
                <div class="col-md-offset-10 col-md-2 text-right">
					<button type="button" name="padd" class="btn btn-info btn-fill"  data-toggle="modal" data-target="#myModal3" onclick="uniqueId();">Add</button>
                </div>
            </div>	 -->
    
	 <table class="table">
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available</th>
            <th>Drug Sales</th>
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
					echo $row['sold_qnty'];
				?>
				</td><td>
				<!-- <a  id="<?php //echo $row['m_id'] ?>" class="dup" data-toggle="modal" data-target="#updateModal"> <button type="button" name="dupdate" class="btn btn-success btn-fill">Update</button></a> -->
				</td><td>
				<!-- <a  id="<?php //echo $row['m_id'] ?>" class="mview" data-toggle="modal" data-target="#viewModal"> <button type="button" name="mview" class="btn btn-fill btn-primary">View</button></a> -->
				</td><td>
				<!-- <a  id="<?php //echo $row['m_id'] ?>" class="ddel"> <button type="button" name="ddelete" class="btn btn-danger btn-fill">Delete</button></a> -->
				</td></tr>
	<?php
	}
	echo "</table>";
	echo '<div class="text-center">pagination</div>';
}
 if($pa=="pupdate"){

    $id = $_POST['id'];
    $name = $_POST['fn'];
    $contact = $_POST['fq'];
    $email= $_POST['ts'];
    $emp_type=$_POST['dot'];
    $salary=$_POST['sal'];
    $doj=$_POST['doj'];
    $status=$_POST['st'];
    $bl=$_POST['bl'];
    $sql = "UPDATE `pharmacist` SET `name`='$name',`contact`='$contact',`email`='$email',`emp_type`='$emp_type',`salary`=$salary,`d_o_j`='$doj' WHERE p_id='".$id."'";
    $res = $conn->query($sql);
    if($res){
        echo "Record Updated Successfully.";
    }else{
        echo "Error, While deleting the record.";
    }
 }
 if($pa=="cupdate"){

    $id = $_POST['id'];
    $name = $_POST['fn'];
    $contact = $_POST['fq'];
    $email= $_POST['ts'];
    $emp_type=$_POST['dot'];
    $salary=$_POST['sal'];
    $doj=$_POST['doj'];
    $status=$_POST['st'];
    $bl=$_POST['bl'];
    $sql = "UPDATE `cashier` SET `name`='$name',`contact`='$contact',`email`='$email',`emp_type`='$emp_type',`salary`=$salary,`d_o_j`='$doj' WHERE c_id='".$id."'";
    $res = $conn->query($sql);
    if($res){
        echo "Record Updated Successfully.";
    }else{
        echo "Error, While deleting the record.";
    }
 }
?>