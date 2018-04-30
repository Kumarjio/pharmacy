<?php 
session_start();
if(! $_SESSION['current_user3']){
    header("location:../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once('../common/header.php'); ?>
</head>
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
                    <a href="medicines.php">
                        <i class="ti-mouse" style="color: #e60073;"></i>
                        <p style="color: #00001a;">Drug</p>
                    </a>
                </li>

                <li>
                    <a href="statistics.php">
                        <i class="ti-bar-chart" style="color: #00001a;"></i>
                        <p style="color: #00001a;">Statistics</p>
                    </a>
                </li>
                <li>
                    <a href="notes.php">
                        <i class="ti-clipboard" style="color: #00e673 ;"></i>
                        <p style="color: #00001a;">Note</p>
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

            </ul>
        </div>
</div>
    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					<div class="header">
                        <h4 class="title text-center">Notifications</h4>
                            Notifications
                    </div>
					
				</div>
			</div>
		</div>

		<!-- footer is here -->
        <?php //include_once('../common/footer.php'); ?>

    </div>
</div>


</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>