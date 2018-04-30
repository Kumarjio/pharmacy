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
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
    $(document).ready(function(){
        //setTimeout(function(){viewData(),drugRate()},2000); 
        
        function viewData(){ 
                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p1=a",
                    success: function(result){
                        $("#total-drug").html(result);
                    }
                });
            }  
            function drugRate(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=b",
                    success: function(result){
                        $("#total-drug2").html(result);
                    }
                });
            }
            function drugRate2(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=dts",
                    success: function(result){
                        $("#drgr").html(result);
                    }
                });
            }
            function activeUser(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=au",
                    success: function(result){
                        $("#active-user").html(result);
                    }
                });
            }
            function drug_Available(){ 

                $.ajax({
                    type:"GET",
                    url:"dashboard-ajax.php?p2=da",
                    success: function(result){
                        $("#drugav").html(result);
                    }
                });
            }
            function patientCount(){ 

                $.ajax({
                    type:"GET",
                    url:"../Cashier/dashboard-ajax.php?p2=pc",
                    success: function(result){
                        $("#ptc").html(result);
                    }
                });
            }
            function ReceiptCount(){ 

                $.ajax({
                    type:"GET",
                    url:"../Cashier/dashboard-ajax.php?p2=tnortt",
                    success: function(result){
                        $("#tnort").html(result);
                    }
                });
            }
            function InvoiceCount(){ 

                $.ajax({
                    type:"GET",
                    url:"../Cashier/dashboard-ajax.php?p2=tic",
                    success: function(result){
                        $("#tid").html(result);
                    }
                });
            }
            viewData();drugRate();drugRate2();activeUser();drug_Available();patientCount();ReceiptCount();InvoiceCount();
            setInterval(function(){
                        viewData(),drugRate2(),drugRate(),activeUser(),drug_Available();patientCount();ReceiptCount();InvoiceCount(); // this will run after every 5 seconds
                        },1000);  
        });

        </script>
<style type="text/css">
    table,tr,th,td{
        padding:5px;
        margin:5px;
        /*border-bottom: 1px solid red;*/
    }
    .ths,.tds{
        padding-left:120px;
    }
    .thn,.tdn{
        padding-left:50px;
    }

</style>

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
                                                 <span id="">100000</span> Pkts
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
                                                <p>Drug's Sold Today(Rs)</p>
                                               <span id="drgr"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="footer">
                                        <hr />
                                        <div class="stats">
                                            <i class="ti-calendar" style="color:blue"></i> Today
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
                                                <p>Drug's Sold Today(Pkts)</p>
                                                <span id="total-drug2"></span> Pkts
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
                                            <div class="icon-big icon-info text-center">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">
                                                <p>Total Active Users</p>
                                                <?php echo "19"; ?>
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
                                            <div class="icon-big  text-center">
                                                <i class="ti-support" style="color: #ff6633;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-7">
                                            <div class="number">                                                
                                                <p>Available Drug's</p>
                                                <span id="total-drug"></span> Pkts
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Quick Order Drug's</h4>
                            </div>
                                 <div id="drugav" class="content table-responsive"></div> 
                                <div class="footer">
                                   <div class="chart-legend">
                                        <i class="fa fa-circle text-warning"></i> ! The above drug's are the insufficient available
                                    </div>
                                    <hr/>
                                    <div class="stats">
                                        <i class="ti-timer"></i> Lattest Insufficient Drug's Information lesser than 30 pkts
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Active User</h4>
                            </div>
                                 <div id="active-user" class="content table-responsive"></div>
                             <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-success"></i> Active
                                        <i class="fa fa-circle text-danger"></i>  Block
                                        <i class="fa fa-circle text-warning"></i> Inactive
                                    </div>
                                    <hr/>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated Now 
                                    </div>
                                </div>
                        </div>
                    </div>
			</div>
		</div>
    </div>
		<!-- footer is here -->
        <?php //include_once('../common/footer.php'); ?>

</div>


</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>
