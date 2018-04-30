<?php 
session_start();
if(! $_SESSION["current_user"])
{
  header("location:../index.php");
  exit;
}
?>
<?php include_once('../common/header.php'); ?>
<body>
    <div class="wrapper">
    
     <?php include_once('admin-sidebar.php'); ?>
        <div class="main-panel">
            <?php include_once('admin-navbar.php'); ?>
                <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="header">
                        <h4 class="title text-center">Admin Dashboard</h4>
                        admin
                    </div>
                    
                </div>
            </div>
        </div>

             <?php include_once('../common/footer.php'); ?>

        </div>
    </div>
</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>