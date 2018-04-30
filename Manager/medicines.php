<?php 
session_start();
if(! $_SESSION['current_user2']){
    header("location:../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Drug Information's</title>
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
        function drugCategory(){
                $.ajax({
                    type:"GET",
                    url:"medicine-ajax.php?p=1",
                    success: function(result){
                        $("#drug-cat").html(result);
                    }
                });
            }
        function drugData(){
                $.ajax({
                    type:"GET",
                    url:"medicine-ajax.php?p=2",
                    success: function(result){
                        $("#drug-data").html(result);
                    }
                });
            }
        drugCategory();
        // setInterval(function(){
        //         drugCategory()//drugData()//,drugData() //pharmaInactive() pharmaBlock(),cashierActive(),cashierInactive(),cashierBlock() // this will run after every 5 seconds
        //     },1000); 

    });     
    </script>
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
                            <a href="user-manage.php">
                                <i class="ti-user" style="color: #00001a;"></i>
                                <p style="color: #00001a;">User's Manage</p>
                            </a>
                        </li>
                        <li>
                            <a href="chat.php">
                                <i class="ti-bar-chart" style="color: #ff6633;"></i>
                                <p style="color: #00001a;">Statistics</p>
                            </a>
                        </li>
                        <li>
                            <a href="data-table.php">
                                <i class="ti-layout-column3" style="color: #00e673 ;"></i>
                                <p style="color: #00001a;">Data Table</p>
                            </a>
                        </li>
                        <li class="active">
                            <a href="medicines.php">
                                <i class="ti-mouse" style="color: #e60073;"></i>
                                <p style="color: #00001a;">Drug</p>
                            </a>
                        </li>
                        <li>
                            <a href="complains.php">
                                <i class="ti-rocket" style="color: red ;"></i>
                                <p style="color: #00001a;">Message</p>
                            </a>
                        </li>
                        <li>
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
<!-- End Of Side Bar -->

    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
              <div class="container-fluid">
                    <!-- <div class="card" id="drug-data">
        			 &nbsp;&nbsp;&nbsp;&nbsp; <i class="fa ti-hand-point-right text-danger"></i> ! Showing Drug's Informatinos Category Wise.
    				</div> -->
    		  </div>
              <div id="drug-cat">
                    
                            
              </div> 
            <?php //include_once('../common/footer.php'); ?>
        </div>
    </div>


</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>