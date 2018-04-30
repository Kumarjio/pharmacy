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
    <title>Invoice</title>
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            function displayRecipts(){
                $.ajax({
                    type:"GET",
                    url:"c-recipts-ajax.php?p=disp",
                    success: function(result){
                        $("#reciptsdisplay").html(result);
                    }
                });
            }
            displayRecipts();
            setInterval(function(){
                displayRecipts();
            },1000)
           $(document).on('click','.print',function(){
                var id = $(this).attr("pid");
                $.ajax({
                url:"c-recipts-ajax.php?p=print",
                method:"post",
                data:{id:id},
                success:function(data){
                    $("#reciptsdisplay").remove();
                    $("#prc").html(data);
                  }
                });
            });
            $(document).on('click','.remove',function(){
                var id = $(this).attr("pid");
                $.ajax({
                url:"c-recipts-ajax.php?p=del",
                method:"post",
                data:{id:id},
                success:function(data){
                    alert(data);
                  }
               });
            });
        })
    </script>
     <style type="text/css">
        input[type="text"],
            select.form-control {
              background: transparent;
              border: none;
              border-bottom: 1px solid #000000;
              -webkit-box-shadow: none;
              box-shadow: none;
              border-radius: 0;
            }

            input[type="text"]:focus,
            select.form-control:focus {
              -webkit-box-shadow: none;
              box-shadow: none;
            }
            tr,td{
                padding:5px;
                margin:5px;
                font-size: 12px;
            }
            input {padding:5px; border:1px solid #999; border-radius:4px; -moz-border-radius:4px; -web-kit-border-radius:4px; -khtml-border-radius:4px;}
    </style>
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
                        <li >
                            <a href="invoice.php">
                                <i class="ti-notepad" style="color: #00e673 ;"></i>
                                <p style="color: #00001a;">Receipt</p>
                            </a>
                        </li>
                        <li class="active">
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
    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					<div class="header">
                        <h4 class="title text-center">-: Invoice :-</h4>
                        <br>
                    </div>
    				<div class="content" id="reciptsdisplay">

                    </div>
                    <div class="content" id="prc">

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