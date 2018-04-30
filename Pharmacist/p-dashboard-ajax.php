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
	$sql = "SELECT *FROM `user_requests` WHERE u_name='".$user."'";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
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
				
					echo $row['user_id'];
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
	}else{
			echo "<b><h5 style='color:red;text-align:center;'> Sorry! you don't have any request at yet <b><h5>";
		}
	
	echo "</table>";	
}
if($pa=="2"){
	
	$sql = "SELECT *FROM `text_msg` WHERE from_id='".$user_id."'";
	$stmt = $conn->query($sql);
	if($stmt->num_rows > 0){
	?>
	 <table class="table">
            
            <th>From</th>
            <th>To</th>
            <th>Message</th>
            <th>Important Point</th>
            <th>Date_Of_Dispatch</th>
            <th>Valid Till</th>
            
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
		
				echo "<tr><td>";				
					echo "Me";
				echo "</td><td>";
					echo $row['to_name'];
				echo "</td><td>";				
					echo $row['msg_content'];
				echo "</td><td>";				
					echo $row['important_point'];
				echo "</td><td>";				
					echo $row['d_of_dispatch'];
				echo "</td><td>";				
					echo $row['valid_till'];
				
				?>
				</td></tr>
	<?php
		}
	}else{
			echo "<b><h5 style='color:red;text-align:center;'> Sorry! you don't have any request at yet <b><h5>";
		}
	
	echo "</table>";	

}
if($pa=="insert1"){

	  	$dt=$_POST['rd'];
	  	$id=$_POST['id'];
	  	$name=$_POST['fn'];
	    $ptype=$_POST['p_type'];
	    $utype=$_POST['user'];
	    $msg=$_POST['msg'];
	    $status=$_POST['st'];
	    $sql1 = "SET FOREIGN_KEY_CHECKS=0;";
	    $sql2 ="INSERT INTO `user_requests`(user_id,u_name,u_type,msg,types_of_permission,d_of_request,status)
	            	VALUES ('".$id."','".$name."','".$utype."','".$msg."','".$ptype."','".$dt."','".$status."');";
	    $sql3 = "SET FOREIGN_KEY_CHECKS=1;";
	    $res2 = $conn->query($sql1);
	    $res1 = $conn->query($sql2);
	    $res3 = $conn->query($sql3);
    	if( ($res1) === TRUE ){
        	$last_id=$conn->insert_id;
       	 	echo "New record created successfully.";
    	} else {
        	echo "Error:".$sql1."<br>".$conn->error;
    	}

}
if($pa=="insert2"){
		$from_id=$user_id;
		$from_name1=$user;
	    $dt=$_POST['rd'];
	    $to=$_POST['tr'];
	    $msg=$_POST['msg'];
	    $impopoint=$_POST['msg2'];
	    //print_r(array_filter($linksArray, function($value) { return $value !== ''; }));
	    $res = array_map('trim',explode(",",$to));
	    $res2 = array_filter($res);
		$size = sizeof($res2);
		foreach ($res2 as $key => $value) {
	
			    $sql1 = "SET FOREIGN_KEY_CHECKS=0;";
			    $sql2 ="INSERT INTO `text_msg`(from_id,from_name,to_name,msg_content,important_point,valid_till)
			            	VALUES ('".$from_id."','".$from_name1."','".$value."','".$msg."','".$impopoint."','".$dt."');";
			    $sql3 = "SET FOREIGN_KEY_CHECKS=1;";
			    $res2 = $conn->query($sql1);
			    $res1 = $conn->query($sql2);
			    $res3 = $conn->query($sql3);

		 }
		 echo "New record created successfully.";
	
}
?>