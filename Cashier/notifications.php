<?php 
session_start();
if(! $_SESSION['current_user4'] && ! $_SESSION['u_id3']){
    header("location:../index.php");
    exit();
}
if(isset($_SESSION['current_user4']) && isset($_SESSION['u_id3'])){
    $user = $_SESSION['current_user4'];
    $user_id = $_SESSION['u_id3'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
    <?php include_once('../common/header.php'); ?>
</head>
<body>

</body>
</html>
<body>

<div class="wrapper">
    
    <!-- sidebar is here -->
    <div class="sidebar" data-background-color="white" data-active-color="danger">
        <div class="sidebar-wrapper">
                    <div class="logo">
                        <a href="http://www.ferventis.com/" class="simple-text">
                            <img src="../assets/img/ferv.png" class="img-responsive">
                        </a>
                    </div>

                    <ul class="nav">
                        <li>
                            <a href="dashboard.php">
                                <i class="ti-panel" style="color:green"></i>
                                <p style="color: #00001a;">Dashboard</p>
                            </a>
                        </li>
                        <li>
                            <a href="prescription.php">
                                <i class="ti-tag" style="color: #00001a;"></i>
                                <p style="color: #00001a;">Prescription</p>
                            </a>
                        </li>
                        <li>
                            <a href="stock.php">
                                <i class="ti-support" style="color: #ff6633;"></i>
                                <p style="color: #00001a;">Stock</p>
                            </a>
                        </li>
                        <li>
                            <a href="invoice.php">
                                <i class="ti-notepad" style="color: #00e673 ;"></i>
                                <p style="color: #00001a;">Receipt</p>
                            </a>
                        </li>
                        <li>
                            <a href="receipts.php">
                                <i class="ti-receipt" style="color: #e60073;"></i>
                                <p style="color: #00001a;">Invoice</p>
                            </a>
                        </li>
                        <li>
                            <a href="complains.php">
                                <i class="ti-rocket" style="color: red ;"></i>
                                <p style="color: #00001a;">Message</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="notifications.php">
                                <i class="ti-bell" style="color:  #ff5c33;"></i>
                                <p style="color: #00001a;">Notifications</p>
                            </a>
                        </li>
                        <li class="active-pro">
                            <a href="http://ferventis.com">
                                <i class="ti-heart" style="color: red;"></i>
                                <p style="color: #00001a;">by Ferventis</p>
                            </a>
                        </li>
                    </ul>
                </div>
    </div>
    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					<div class="header">
                        <h4 class="title text-center">NOTIFICATION</h4>
                        Notification from Manager | Admin.
                    </div>
					
				</div>
			</div>
		</div>

		<!-- footer is here -->
        <?php include_once('../common/footer.php'); ?>

    </div>
</div>


</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>