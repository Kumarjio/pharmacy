<?php
session_start();
if(! $_SESSION['current_user3'] && ! $_SESSION['u_id2']){
    header("location:index.php");
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
	$sql = "SELECT * FROM `Notes` WHERE user_id='".$user_id."' ORDER BY i DESC";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
	?>
	<?php 
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
		$modt = strtotime($row['modified_date']);
		$date = date('Y-m-d', $modt);
		$time = date('G.i.s', $modt);

		?>
		<div class="col-lg-3 col-md-4">
                        <div class="card card-user" style="font-size:12px; margin-top:10px;">
                            <div style="font-size:12px;">
                                <div class="row">
                                    <div class="col-xs-10 text-center">
                                        Modified Date : <?php echo $date; ?>
                                        <br>
                                        Modified Time :  <?php echo $time; ?>
                                    </div>
                                    <div class="col-xs-offset-0 col-xs-1">
                                    	
                                        <button style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;"
                                                class="removeButton"><a  id="<?php echo $row['id'] ?>" class="removeButton"><i class="ti-close" style="color:red; background-color:black; font-size: 18px;"></i></a></button><br>

                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="content">
                                <p class="description" style="font-size:12px;">
                                   <?php echo $row['msg']; ?>
                                </p>
                            </div>
                            <hr>
                            <div class="text-center" style="font-size:12px;">
                                Created Date : <?php echo $row['created_on_date']; ?>
                                        <br>
                                Created Time :  <?php echo $row['created_on_time']; ?>
                            </div>
                        </div>
            </div>
	<?php
		}
	}else{
			echo "<b><h5 style='color:red;text-align:center;'> Sorry! you don't have any Notes at yet <b><h5>";
		}	
}
if($pa=="insert"){

	date_default_timezone_set('Asia/Calcutta'); 
	$time = date('H:i:s');
	$date = date('Y-m-d');
	$id = $_POST['id2'];
	$msg = $_POST['msg'];
	$sql = "INSERT INTO `Notes`(`id`, `user_id`, `msg`, `created_on_date`, `created_on_time`, `modified_date`) VALUES (".$id.",'".$user_id."','".$msg."','".$date."','".$time."',now())";
	$stmt=$conn->query($sql);
	if($stmt){
		echo "Record was added successfully.";
	}else{
		echo "Error, while adding record into the database.";
	}
}
if($pa=="del"){

	$id=$_POST['col_name3'];
	$sql = "DELETE FROM `Notes` WHERE id='".$id."'";
	$stmt=$conn->query($sql);
	if($stmt){
		echo "Record Deleted Sucessfully.";
	}else{
		echo "Error While delteing the reocrd.";
	}

}

?>