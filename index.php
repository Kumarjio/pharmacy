<?php 
  include_once __DIR__.'/common/config.php'; 
  session_start();
  if(!empty($_POST["submit"])){
     # Fetch all the data from form submission.
  $username = !empty($_POST["uname"])     ? trim($_POST["uname"])     : "";
  $password = !empty($_POST["pwd"])       ? trim($_POST["pwd"]) : "";
  $user_type = !empty($_POST["user"])      ? trim($_POST["user"]) : "";
  switch ($user_type) {
		  	case 'admin':
	  			$sql = "SELECT * FROM `login` WHERE u_name= ? AND password= ?";
	  			$stmt=$conn->prepare($sql);
	  			$stmt->bind_param("ss",$username,$password);
	  			$stmt->execute();
	  			$result = $stmt->get_result();
	  			if($result->num_rows > 0){
	  					$_SESSION["current_user"] =$username;
	 					header("location:Admin/dashboard.php"); 
				}
				else{
					    $_SESSION["form_error"] = "Invalid user.";
					    header("location: index.php#ivu");
					    exit;
				}
		  	break;
			case 'manager':
				$sql = "SELECT * FROM `manager` WHERE m_name= ? AND contact= ?";
	  			$stmt=$conn->prepare($sql);
	  			$stmt->bind_param("si",$username,$password);
	  			$stmt->execute();
	  			$result = $stmt->get_result();
	  			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
   					$saved[] = $row;
				}
	  			if($result->num_rows > 0){
	  					$_SESSION["current_user2"] =$username;
	  					$_SESSION['u_id']=$saved[0]['m_id'];
	 					header("location:Manager/dashboard.php"); 
				}
				else{
					    $_SESSION["form_error"] = "Invalid user.";
					    header("location: index.php#ivu");
					    exit;
				}  
			break;
			case 'pharmacist':
				$sql = "SELECT * FROM `pharmacist` WHERE name= ? AND contact= ?";
	  			$stmt=$conn->prepare($sql);
	  			$stmt->bind_param("si",$username,$password);
	  			$stmt->execute();
	  			$result = $stmt->get_result();
	  			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
   					$saved[] = $row;
				}
	  			if($result->num_rows > 0){
	  					$_SESSION["current_user3"] =$username;
	  					$_SESSION['u_id2']=$saved[0]['p_id'];
	 					header("location:Pharmacist/dashboard.php"); 
				}
				else{
					    $_SESSION["form_error"] = "Invalid user.";
					    header("location: index.php#ivu");
					    exit;
				}    
			break;
			case 'cashier':
				$sql = "SELECT * FROM `cashier` WHERE name= ? AND contact= ?";
	  			$stmt=$conn->prepare($sql);
	  			$stmt->bind_param("si",$username,$password);
	  			$stmt->execute();
	  			$result = $stmt->get_result();
	  			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
   					$saved[] = $row;
				}
	  			if($result->num_rows > 0){
	  					$_SESSION["current_user4"] =$username;
	  					$_SESSION['u_id3']=$saved[0]['c_id'];
	 					header("location:Cashier/dashboard.php"); 
				}
				else{
					    $_SESSION["form_error"] = "Invalid user.";
					    header("location: index.php#ivu");
					    exit;
				}    
			break;
		  	default:
		  		 echo "Invalid User";
		  		break;
  	}
 }
  //$remember = !empty($_POST["remember"])        ? trim($_POST["remember"])        : "";
  // if (!$username) {
  //   $_SESSION["form_error"] = "Invalid user name.";
  //   header("location: index.php#iu");
  //   exit;
  // }
  // if (!$password) {
  //   $_SESSION["form_error"] = "Invalid password.";
  //   header("location: index.php#ip");
  //   exit;
  // } 
  // $query = "SELECT * FROM `login_user` WHERE uname = ? AND password = ?";
  // $stmt = $conn->prepare($query);
  // $stmt->bind_param("ss", $username, $password);
  // $stmt->execute();
  // $result = $stmt->get_result();
  
  //  else {
  //   $_SESSION["form_error"] = "Invalid user.";
  //   header("location: index.php#ivu");
  //   exit;
  // }
  // }
  //
/*the rememberme option work pending is here..*/
  // if ($remember) {
  //   $userId  = $user["member_id"];
  //   $hashKey = md5(uniqid());
  //   $query   = "INSERT INTO `users_key`(user_id,hash_key) VALUES (?,?)";
  //   $stmt    = $conn->prepare($query);
  //   $stmt->execute([$userId, $hashKey]);
  //   $_SESSION["remember_cookie"] = $hashKey;  
  //   header("location: dashboard.php");
  // }
  // header("location: dashboard.php");
  // exit; 
// }
// if (!empty($_SESSION["remember_cookie"])) {
//   $expiry = time() + (30 * 24 * 60 * 60);
//   setcookie("fp", $_SESSION["remember_cookie"], $expiry);
//   unset($_SESSION["remember_cookie"]);
// }

//  }



?>
<!DOCTYPE html>
<html>
<head>
	<title>Chemio Pharmacy System</title>
		<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Paper Dashboard core CSS    -->
    <link href="assets/css/paper-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <!-- <link href="assets/css/demo.css" rel="stylesheet" /> -->

    <!--  Fonts and icons     -->
    <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet"> -->
    <!-- <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'> -->
    <link href="assets/css/themify-icons.css" rel="stylesheet">
    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
	<script src="assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard DEMO methods, don't include it in your project! -->
	<!-- <script src="assets/js/demo.js"></script> -->
	<style type="text/css">
		* {
			font-size: 13px;
		}
	</style>
</head>
<body style="background-color: black; color: white;">
<div class="container" style="margin-top:50px;">
	<!-- <div class="col-md-4"></div> -->
	 <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                   <div class="card card-user">
                            <div class="image">
                                <img src="assets/img/bg-login.png" alt="..." class="img-responsive" />
                            </div>
                            <div class="content">
                                <div class="author">
                                  <img class="avatar border-white" src="assets/img/default.png" alt="..." class="img-responsive" />
                                  <h4 class="title">Chemio Pharamcy<br />
                                     <a href="#"><small>@by_freventis</small></a>
                                  </h4>
                                </div>
                                <p class="description text-center">
                                <form method="post" name="login_user" action="">
	                    			<div class="form-group">
	                        			<label>User Type</label>
	                        			<select class="form-control border-input"  name="user" id="user">
	                        				<option value="admin">Admin</option>
	                        				<option value="manager">Manager</option>
	                        				<option value="pharmacist">Pharmacist</option>
	                        				<option value="cashier">Cashier</option>
	                        			</select>
	                    			</div>
	                    			<div class="form-group">
	                        			<label>User Name</label>
	                        			<input type="text" class="form-control border-input input-sm" id="uname" name="uname" placeholder="Enter User Name">
	                    			</div>
	                    			<div class="form-group">
	                        			<label>Password</label>
	                        			<input type="text" class="form-control border-input input-sm" id="pwd" name="pwd" placeholder="Enter Password">
	                    			</div>    			
          						</p>
	                            </div>
	                            <hr><hr>
	                            <div class="text-center">
	                                <div class="row">
	                                    <div class="col-md-12">
	                                        <button type="submit" name="submit" value="submit"  class="btn btn-primary btn-fill btn-wd">Login</button>
	                                    </div><br>
	                                </div>
	                            </div>
	                            </form>
	                            <br>
          					</div>
						</div>
					
</div>
<div><br><br>
	 <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                    	<li>
                            <a href="https://www.linkedin.com/in/ferventis-the-05978b107/">
                                Ferventis
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/in/abhilas-das-659b17120/">
                                Developer
                            </a>
                        </li>
                        <li>
                            <a href="http://www.ferventis.com/license">
                                Licenses
                            </a>
                        </li>
                        <li>
                            <a href="http://www.ferventis.com/license">
                                Licenses
                            </a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="http://www.ferventis.com">Ferventis</a>
                </div>
            </div>
        </footer>
</div>
</body>
</html>


