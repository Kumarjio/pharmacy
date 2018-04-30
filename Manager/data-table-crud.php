<?php
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';
if($pa=="pinsert"){
	  $dt=$_POST['dt'];
	  $id=$_POST['id'];
	  $name=$_POST['pn'];
    $emt=$_POST['emt'];
    $pwd=$_POST['pwd'];
    $sal=$_POST['sal'];
    $sql1="INSERT INTO `pharmacist`(p_id,name,password,emp_type,salary,d_o_j)
            VALUES ('".$id."','".$name."','".$pwd."','".$emt."',".$sal.",'".$dt."')";
    $sql2="INSERT INTO `emp_address` (p_id)
            VALUES ('".$id."')";
     $res1 = $conn->query($sql1);
     $res2 = $conn->query($sql2);
    if( ($res1)&&($res2) === TRUE ){
        $last_id=$conn->insert_id;
        echo "New record created successfully.";
    } else {
        echo "Error:".$sql1,$sql2."<br>".$conn->error;
    }
}
if($pa=="cinsert"){

	$dt=$_POST['dt'];
    $id=$_POST['id1'];
    $name=$_POST['pn'];
    $emt=$_POST['emt'];
    $pwd=$_POST['pwd'];
    $sal=$_POST['sal'];
    $sql1="INSERT INTO `cashier`(c_id,name,password,emp_type,salary,d_o_j)
            VALUES ('".$id."','".$name."','".$pwd."','".$emt."',".$sal.",'".$dt."')";
    $sql2="INSERT INTO `emp_address` (c_id)
            VALUES ('".$id."')";
     $res1 = $conn->query($sql1);
     $res2 = $conn->query($sql2);
    if( ($res1)&&($res2) === TRUE ){
        $last_id=$conn->insert_id;
        echo "New record created successfully.";
    } else {
        echo "Error:".$sql1,$sql2."<br>".$conn->error;
    }

}
if($pa=="dinsert"){

    $dt=$_POST['dt'];
    $id=$_POST['id2'];
    $name=$_POST['mn'];
    $mt=$_POST['mtype'];
    $ctg=$_POST['ctg'];
    $price=$_POST['pc'];
    $trn=$_POST['trn'];
    $adp=$_POST['pkts'];

    $sql1 = "INSERT INTO `medicine_info`(m_id,m_name,m_type,m_category,m_price) VALUES ('".$id."','".$name."','".$mt."','".$ctg."','".$price."')";
    $sql2 = "INSERT INTO `medicine_compositions`(m_id)VALUES('".$id."')";
    $sql3 = "INSERT INTO `medicine_stock_info`(m_id,tray_no,add_drug_pkts_no,add_drug_date)VALUES('".$id."','".$trn."','".$adp."','".$dt."')";
    $result = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);
    if($result&&$result2&&$result3){
        echo "Record Added Successfully";
    }else{
        echo "Error ! while adding data into the database";
    }
}
if($pa=='pup'){
 	$id = $_POST['col_name2'];
 	$sql ="SELECT  * FROM `pharmacist` WHERE p_id='".$id."'";
	$stmt = $conn->query($sql);
	?>
	<?php while($row = $stmt->fetch_array(MYSQLI_ASSOC)) : ?>
				 	<form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="pfrm">
	 					<div class="form-group">
					      <label class="control-label col-sm-3" for="id">Id:</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="id"  name="id" value="<?php echo $row['p_id']; ?>" style="background-color:Black; color:Lime;" readonly>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="fn">Name:</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="fn"  name="fn" value="<?php echo $row['name']; ?>">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="fq">Contact:</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="fq"  name="fq" value="<?php echo $row['contact']; ?>" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="ts">E-Mail:</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="ts" name="ts" value="<?php echo $row['email']; ?>" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="dot">Emp_Type</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="dot" name="dot" value="<?php echo $row['emp_type']; ?>" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="sal">Salary</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="dot" name="sal" value="<?php echo $row['salary']; ?>" >
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="doj">Date_Of_Join</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="doj" name="doj" value="<?php echo $row['d_o_j']; ?>" style="background-color:Black; color:Lime;" readonly>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-3" for="st">Status</label>
					      <div class="col-sm-9">          
					        <input type="text" class="form-control border-input" id="st" name="st" value="<?php echo $row['status']; ?>" style="background-color:Black; color:Lime;" readonly>
					      </div>
					    </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="bl">Block/Unblock</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="dot" name="bl" value="<?php echo $row['block_unblock']; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
					    <div class="form-group">        
					      <div class="col-sm-offset-3 col-sm-9">
					      	<button type="button" class="btn  btn-fill  btn-danger" 
					      	 data-dismiss="modal"> Close </button>
					        <input type="submit" onclick="updateData();" class="btn btn-fill  btn-success" value="Update" id="pupd" name="pupd">
					      </div>
					    </div>
					</form>		
		<?php endwhile; ?>

		<?php
 }
 if($pa=="cup"){
 	$id = $_POST['col_name2'];
    $sql ="SELECT  * FROM `cashier` WHERE c_id='".$id."'";
    $stmt = $conn->query($sql);
    ?>
    <?php while($row = $stmt->fetch_array(MYSQLI_ASSOC)) : ?>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="cfrm">
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="id">Id:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="id"  name="id" value="<?php echo $row['c_id']; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fn">Name:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="fn"  name="fn" value="<?php echo $row['name']; ?>">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fq">Contact:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="fq"  name="fq" value="<?php echo $row['contact']; ?>" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="ts">E-Mail:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="ts" name="ts" value="<?php echo $row['email']; ?>" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="dot">Emp_Type</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="dot" name="dot" value="<?php echo $row['emp_type']; ?>" >
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="control-label col-sm-3" for="sal">Salary</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="dot" name="sal" value="<?php echo $row['salary']; ?>" >
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="doj">Date_Of_Join</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="doj" name="doj" value="<?php echo $row['d_o_j']; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="st">Status</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="st" name="st" value="<?php echo $row['status']; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="bl">Block/Unblock</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="dot" name="bl" value="<?php echo $row['block_unblock']; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-9">
                            <button type="button" class="btn  btn-fill  btn-danger" 
                             data-dismiss="modal"> Close </button>
                            <input type="submit" onclick="updateData();" class="btn btn-fill  btn-success" value="Update" id="cupd" name="cupd">
                          </div>
                        </div>
                    </form>     
        <?php endwhile; ?>

        <?php
 	
 }
 if($pa=="dup"){
 	$id = $_POST['col_name2'];
 	echo $id;
 }
 if($pa=="pview"){
 	$id = $_POST['col_name2'];
    $sql = "SELECT pharmacist.name,pharmacist.contact,pharmacist.email,pharmacist.emp_type,
                   pharmacist.salary,pharmacist.d_o_j,pharmacist.status,pharmacist.block_unblock,
                   pharmacist.dp,emp_address.co,emp_address.material_status,emp_address.address,emp_address.d_o_b,emp_address.blood_group,emp_address.Pin,emp_address.Dist,emp_address.State
            FROM `pharmacist`
            INNER JOIN `emp_address`  ON pharmacist.p_id = emp_address.p_id WHERE pharmacist.p_id='".$id."'";
    $stmt = $conn->query($sql);
 	?>
    <?php while($row = $stmt->fetch_array(MYSQLI_ASSOC)) : ?>
 		<div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5" >
                    	<center><b>ID Card</b></center>
                        <div class="card card-user" style="font-size:12px;">
                            <div class="image">
                                <img src="../assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="../assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title" style="font-size:13px;"><?php echo $row['name']; ?><br />
                                     <a href="#"><small>@chemio_pharmacy</small></a>
                                  </h4>
                                </div>
                                <p class="description">
                                   <div class="text-left">
                                   
                                   	<div class="row">
                                    	<div class="col-md-6">
                                        	Employee Type
                                    	</div>
                                    	<div class="col-md-6">
                                        	[ <?php echo $row['emp_type']; ?> ]
                                    	</div>
                                    	<div class="col-md-6">
                                        	Contact No
                                    	</div>
                                    	<div class="col-md-6">
                                        	[ <?php echo $row['contact']; ?> ] 
                                    	</div>
                                    	<div class="col-md-6">
                                        	Date Of Joining
                                    	</div>
                                    	<div class="col-md-6">
                                        	 [ <?php echo $row['d_o_j']; ?> ]
                                    	</div>
                                    </div>
                                  </div>
                            </div>
                            <hr>
                            <div class="text-center" style="font-size:12px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5><?php echo $row['blood_group']; ?><br /><small> Blood Group</small></h5>
                                    </div>
                                    <div class="col-md-7">
                                        <h5><?php echo $row['d_o_b']; ?><br /><small>Date Of Birth</small></h5>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-offset-2 col-lg-6 col-md-6">
                    	<center><b>Personal Information</b></center>
                        <div class="card card-user">
                            <div class="content Emp">
                            	<table>
                                    <tr>
                                        <td>Name -</td>
                                        <td><?php echo $row['name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>C/o -</td>
                                        <td><?php echo $row['co'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Email -</td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact -</td>
                                        <td><?php echo $row['contact']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>D.O.B -</td>
                                        <td><?php echo $row['d_o_b']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Material Status-</td>
                                        <td><?php echo $row['material_status']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address -</td>
                                        <td><?php echo $row['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pin -</td>
                                        <td><?php echo $row['Pin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dist -</td>
                                        <td><?php echo $row['Dist']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>State -</td>
                                        <td><?php echo $row['State']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Blood Group -</td>
                                        <td><?php echo $row['blood_group']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <center><b>Company Information</b></center>
                        <div class="card card-user">
                            <div class="content Emp">
                                <table>
                                    <tr>
                                        <td>Employee Name -</td>
                                        <td><?php echo $row['name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Employee Type -</td>
                                        <td><?php echo $row['emp_type'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Employee Code -</td>
                                        <td><?php echo $id;?></td>
                                    </tr>
                                    <tr>
                                        <td>D.O.J -</td>
                                        <td><?php echo $row['d_o_j'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Status -</td>
                                        <td><?php if($row['status']=="1"){
                                                echo"<i class='fa fa-circle text-success'></i>";
                                            }
                                            else{
                                                echo"<i class='fa fa-circle text-warning'></i>";
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Block/Unblock -</td>
                                        <td><?php  if($row['block_unblock']=="1"){
                                                echo"<i class='fa fa-circle text-danger'></i>"; 
                                                }else{
                                                 echo"<i class='fa fa-circle text-success'></i>";
                                                }?>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
 	<?php
 }
 if($pa=="cview"){
 	$id = $_POST['col_name2'];
 	$sql = "SELECT cashier.name,cashier.contact,cashier.email,cashier.emp_type,
                   cashier.salary,cashier.d_o_j,cashier.status,cashier.block_unblock,
                   cashier.dp,emp_address.co,emp_address.material_status,emp_address.address,emp_address.d_o_b,emp_address.blood_group,emp_address.Pin,emp_address.Dist,emp_address.State
            FROM `cashier`
            INNER JOIN `emp_address`  ON cashier.c_id = emp_address.c_id WHERE cashier.c_id='".$id."'";
    $stmt = $conn->query($sql);
    ?>
    <?php while($row = $stmt->fetch_array(MYSQLI_ASSOC)) : ?>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-5" >
                        <center><b>ID Card</b></center>
                        <div class="card card-user" style="font-size:12px;">
                            <div class="image">
                                <img src="../assets/img/background.jpg" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="../assets/img/faces/face-2.jpg" alt="..."/>
                                  <h4 class="title" style="font-size:13px;"><?php echo $row['name']; ?><br />
                                     <a href="#"><small>@chemio_pharmacy</small></a>
                                  </h4>
                                </div>
                                <p class="description">
                                   <div class="text-left">
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            Employee Type
                                        </div>
                                        <div class="col-md-6">
                                            [ <?php echo $row['emp_type']; ?> ]
                                        </div>
                                        <div class="col-md-6">
                                            Contact No
                                        </div>
                                        <div class="col-md-6">
                                            [ <?php echo $row['contact']; ?> ] 
                                        </div>
                                        <div class="col-md-6">
                                            Date Of Joining
                                        </div>
                                        <div class="col-md-6">
                                             [ <?php echo $row['d_o_j']; ?> ]
                                        </div>
                                    </div>
                                  </div>
                            </div>
                            <hr>
                            <div class="text-center" style="font-size:12px;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <h5><?php echo $row['blood_group']; ?><br /><small> Blood Group</small></h5>
                                    </div>
                                    <div class="col-md-7">
                                        <h5><?php echo $row['d_o_b']; ?><br /><small>Date Of Birth</small></h5>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-offset-2 col-lg-6 col-md-6">
                        <center><b>Personal Information</b></center>
                        <div class="card card-user">
                            <div class="content Emp">
                                <table>
                                    <tr>
                                        <td>Name -</td>
                                        <td><?php echo $row['name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>C/o -</td>
                                        <td><?php echo $row['co'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Email -</td>
                                        <td><?php echo $row['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Contact -</td>
                                        <td><?php echo $row['contact']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>D.O.B -</td>
                                        <td><?php echo $row['d_o_b']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Material Status-</td>
                                        <td><?php echo $row['material_status']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address -</td>
                                        <td><?php echo $row['address']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pin -</td>
                                        <td><?php echo $row['Pin']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dist -</td>
                                        <td><?php echo $row['Dist']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>State -</td>
                                        <td><?php echo $row['State']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Blood Group -</td>
                                        <td><?php echo $row['blood_group']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <center><b>Company Information</b></center>
                        <div class="card card-user">
                            <div class="content Emp">
                                <table>
                                    <tr>
                                        <td>Employee Name -</td>
                                        <td><?php echo $row['name'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Employee Type -</td>
                                        <td><?php echo $row['emp_type'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Employee Code -</td>
                                        <td><?php echo $id;?></td>
                                    </tr>
                                    <tr>
                                        <td>D.O.J -</td>
                                        <td><?php echo $row['d_o_j'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Status -</td>
                                        <td><?php if($row['status']=="1"){
                                                echo"<i class='fa fa-circle text-success'></i>";
                                            }
                                            else{
                                                echo"<i class='fa fa-circle text-warning'></i>";
                                            } ?></td>
                                    </tr>
                                    <tr>
                                        <td>Block/Unblock -</td>
                                        <td><?php  if($row['block_unblock']=="1"){
                                                echo"<i class='fa fa-circle text-danger'></i>"; 
                                                }else{
                                                 echo"<i class='fa fa-circle text-success'></i>";
                                                }?>
                                            
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
<?php
 }
 
  if($pa=="pdel"){
    $id = $_POST['col_name3'];
    $sql =" DELETE FROM pharmacist,emp_address
            USING pharmacist INNER JOIN emp_address 
            WHERE pharmacist.p_id = '".$id."'
            AND pharmacist.p_id = emp_address.p_id; ";
    $stmt = $conn->query($sql);
    if($stmt){
        echo "Record was deleted successfully.";
    }else{
        echo "Error, while deleting the rocord.";
    }
 }
 if($pa=="cdel"){
    $id = $_POST['col_name3'];
    $sql =" DELETE FROM cashier,emp_address
            USING cashier INNER JOIN emp_address 
            WHERE cashier.c_id = '".$id."'
            AND cashier.c_id = emp_address.c_id; ";
    $stmt = $conn->query($sql);
    if($stmt){
        echo "Record was deleted successfully.";
    }else{
        echo "Error, while deleting the rocord.";
    }
 }


?>