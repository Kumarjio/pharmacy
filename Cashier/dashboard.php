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
    <title>Dashboard::Cashier</title>
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
        //setTimeout(function(){viewData(),drugRate()},2000);   
            function drugTotalSale(){ 
                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=dts",
                    success: function(result){
                        $("#dts").html(result);
                    }
                });
            }
            function drugSoldQnty(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=dsq",
                    success: function(result){
                        $("#dsq").html(result);
                    }
                });
            }
            function patientCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=pc",
                    success: function(result){
                        $("#ptc").html(result);
                    }
                });
            }
              function TotalPresCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tpc",
                    success: function(result){
                        $("#totalpres").html(result);
                    }
                });
            }
            function PresCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=prsc",
                    success: function(result){
                        $("#npt").html(result);
                    }
                });
            }
            function TotalAvailabeDrug(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tadd",
                    success: function(result){
                        $("#tad").html(result);
                    }
                });
            }
            function TotalReceiptCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tnorr",
                    success: function(result){
                        $("#tnor").html(result);
                    }
                });
            }
            function ReceiptCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tnortt",
                    success: function(result){
                        $("#tnort").html(result);
                    }
                });
            }
            function TotalComplainCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tnocc",
                    success: function(result){
                        $("#tnoc").html(result);
                    }
                });
            }
            function TotalInvoiceCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tidd",
                    success: function(result){
                        $("#tnoi").html(result);
                    }
                });
            }
            function InvoiceCount(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=tic",
                    success: function(result){
                        $("#tid").html(result);
                    }
                });
            }
           drugTotalSale();drugSoldQnty();patientCount();TotalInvoiceCount();TotalComplainCount();
           TotalReceiptCount();TotalAvailabeDrug();TotalPresCount();InvoiceCount();ReceiptCount();
           PresCount();
            setInterval(function(){
                         drugTotalSale();drugSoldQnty();patientCount();TotalInvoiceCount();TotalComplainCount();
                         TotalReceiptCount();TotalAvailabeDrug();TotalPresCount();InvoiceCount();ReceiptCount();
                         PresCount();
            },3000);  
        });

        </script>
</head>
<body>
<div class="wrapper">
	
    <!-- sidebar is here -->
    <?php include_once('manager-sidebar.php'); 
        //include_once __DIR__.'../../common/sidebar.php'; 
    ?>

    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-warning text-center">
                                                <i class="ti-server"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <!-- Display Avialbale Medicine Packets. linkes More(go to the medicine page and display all medicines.) -->
                                                <p>Total Drug's Capacity</p>
                                                 <span id="total-drug"></span> 100000 Pkts
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload" style="color:green"></i> Updated now
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-success text-center">
                                                <i class="ti-wallet"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <!-- Sold Medicine Today how much packet. -->
                                                <p>Drug's Sold Today(Rupees)</p>
                                                &#x20b9; <span id="dts"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-calendar text-info"></i> Last day
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-danger text-center">
                                                <i class="ti-pulse"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <!-- Display How Many Pharamacist Group and How Many total pharmacist. links go to the page(Users Manage Page.) -->
                                                <p>Drug's Sold Today(Pkts)</p>
                                                <span id="dsq"></span> Pkts
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-timer" style="color:black;"></i> In the last hour
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>No. Of Patient's</p>
                                                <span id="ptc"></span> Persons
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload" style="color:green"></i> Updated now
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big text-center">
                                                <i class="ti-tag" style="color:#00001a;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <!-- Display Avialbale Medicine Packets. linkes More(go to the medicine page and display all medicines.) -->
                                                <p>Total No. Of Prescriptions</p>
                                                 <span id="totalpres"></span> Nos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-star" style="color:red"></i> From The First Day
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big  text-center">
                                                <i class="ti-support" style="color: #ff6633;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">                                                
                                                <p>Available Drug's</p>
                                                <span id="tad"></span> Pkts
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-timer" style="color:black"></i> In the last hour
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big  text-center">
                                                <i class="ti-tag" style="color:#00001a;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>Today Prescription's</p>
                                                <span id="npt"></span> Nos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-star" style="color:red"></i> From The First Day
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big text-center">
                                                <i class="ti-notepad" style="color: #00e673 ;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>Total No. Of Recipt</p>
                                                <span id="tnor"></span> Nos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload" style="color:green"></i> Updated now
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big  text-center">
                                                <i class="ti-notepad" style="color: #00e673 ;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>Today No. Of Receipts</p>
                                                 <span id="tnort"></span> Nos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload" style="color:green"></i> Updated now
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big text-center">
                                               <i class="ti-receipt" style="color: #e60073;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>Total No. Of Invoice</p>
                                                 <span id="tnoi"></span> No.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-star" style="color:red"></i> From The First Day
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big  text-center">
                                                <i class="ti-rocket" style="color: red ;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <!-- Display How Many Pharamacist Group and How Many total pharmacist. links go to the page(Users Manage Page.) -->
                                                <p>Total No. Of Complains</p>
                                                <span id="tnoc"></span> Nos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload" style="color:green"></i> Updated now
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <div class="icon-big text-center">
                                                <i class="ti-receipt" style="color: #e60073;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>Today Invoice (Dispatch)</p>
                                                <span id="tid"></span> Nos
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-reload" style="color:green"></i> Updated now
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="col-md-12">
            <div class="card">
                     <div id="drugav" class="content table-responsive">
                         tie a datavisualization is here . just put a graph.
                     </div> 
                </div>
            </div>
        <?php //include_once('../common/footer.php'); ?>

    </div>
</div>


</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>