<?php
session_start();
if(! $_SESSION['current_user3'] && ! $_SESSION['u_id2']){
    header("location:../index.php");
    exit();
}
if(isset($_SESSION['current_user3']) && isset($_SESSION['u_id2'])){
    $user = $_SESSION['current_user3'];
    $user_id = $_SESSION['u_id2'];
}
?>
<?php
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';

if($pa=="1"){
	$sql = "SELECT *FROM `complain_box` WHERE comp_by='".$user."'";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
	?>
	 <table class="table">
            <th>ID</th>
            <th>Message by</th>
            <th>To</th>
            <th>Content</th>
            <th>Date</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					echo $row['comp_id'];
				echo "</td><td>";				
					echo "Me";//$row['comp_by'];
				echo "</td><td>";				
					echo $row['to_recipient'];
				echo "</td><td>";				
					echo $row['comp_content'];
				echo "</td><td>";				
					echo $row['comp_date'];
				?>
				</td><td>
				<a  id="<?php echo $row['id'] ?>" class="ddel"> <button type="button" name="ddelete" class="btn btn-danger btn-fill">Remove</button></a>
				</td></tr>
	<?php
		}
	}else{
			echo "<b><h5 style='color:red;text-align:center;'> Sorry! you don't have any complain at yet <b><h5>";
		}
	
	echo "</table>";	

}
if($pa=="cname"){

	$cname=$_POST['drug'];
	$sql = "SELECT *FROM `complain_box` WHERE comp_by='$user' AND comp_content LIKE '%".$cname."%' ";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
	?>
	 <table class="table">
            <th>ID</th>
            <th>Message by</th>
            <th>To</th>
            <th>Content</th>
            <th>Date</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					echo $row['comp_id'];
				echo "</td><td>";				
					echo "Me";//$row['comp_by'];
				echo "</td><td>";				
					echo $row['to_recipient'];
				echo "</td><td>";				
					echo $row['comp_content'];
				echo "</td><td>";				
					echo $row['comp_date'];
				?>
				</td><td>
				<a  id="<?php echo $row['id'] ?>" class="ddel"> <button type="button" name="ddelete" class="btn btn-danger btn-fill">Remove</button></a>
				</td></tr>
	<?php
		}
	}else{
			echo "<b><h5 style='color:red;text-align:center;'> Sorry! No Information Available.<b><h5>";
		}
	
	echo "</table>";	

}
if($pa=="insert1"){

	$id=$_POST['id2'];
	$by=$_POST['fn'];
	$to=$_POST['to'];
	$content=$_POST['msg'];
	$da=$_POST['rd'];
	$res = array_map('trim',explode(",",$to));
	$res2 = array_filter($res);
	//$size = sizeof($res2);
	foreach ($res2 as $key => $value) {
			$sql  = "INSERT INTO `complain_box`(`comp_id`, `comp_by`, `to_recipient`, `comp_content`, `comp_date`) 
						VALUES(".$id.",'".$by."','".$value."','".$content."','".$da."');";
			$stmt=$conn->query($sql); 
	}
	echo "Message Send Sucessfully.";
}


if(isset($_POST['get_option'])){
$userr = $_POST['get_option'];
}
if($pa=="retriverecord"&&$userr=="ad"){
	 
	 $sql = "SELECT u_name FROM `login`";
	 $stmt=$conn->query($sql);
	 while($row = $stmt->fetch_array(MYSQLI_ASSOC))
	 {
	  echo "<option>".$row['u_name']."</option>";
	 }
	 exit;
	
}
if($pa=="retriverecord"&&$userr=="ma"){
	 
	 $sql = "SELECT m_name FROM `manager`";
	 $stmt=$conn->query($sql);
	 while($row = $stmt->fetch_array(MYSQLI_ASSOC))
	 {
	  echo "<option>".$row['m_name']."</option>";
	 }
	 exit;
	
}
if($pa=="retriverecord"&&$userr=="ph"){
	 
	 $sql = "SELECT name FROM `pharmacist`";
	 $stmt=$conn->query($sql);
	 while($row = $stmt->fetch_array(MYSQLI_ASSOC))
	 {
	  echo "<option>".$row['name']."</option>";
	 }
	 exit;
	
}
if($pa=="retriverecord"&&$userr=="ca"){
	 
	 $sql = "SELECT name FROM `cashier`";
	 $stmt=$conn->query($sql);
	 while($row = $stmt->fetch_array(MYSQLI_ASSOC))
	 {
	  echo "<option>".$row['name']."</option>";
	 }
	 exit;
	
}
if($pa=="ddel"){

	$id=$_POST['col_name3'];
	$sql = "DELETE FROM `complain_box` WHERE id='".$id."'";
	$stmt=$conn->query($sql);
	if($stmt){
		echo "Record Deleted Sucessfully.";
	}else{
		echo "Error While delteing the reocrd.";
	}
}
?>