<?php  
session_start();
if(! $_SESSION['current_user2']){
    header("location:index.php");
    exit();
}
$user = isset($_SESSION['current_user2']) ? $_SESSION['current_user2']:'';
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Management::Manager</title>
<head>
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
    $(document).ready(function(){
        function viewData(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=1",
                    success: function(result){
                        $("#ur").html(result);
                    }
                });
            }
        function viewData2(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=2",
                    success: function(result){
                        $("#perm").html(result);
                    }
                });
            }
        $(document).on('click','.acp',function(){
                 var id = $(this).attr("id"); 
                 $.ajax({
                    url:"user-manage-ajax.php?p2=acp",
                    method:"post",
                    data:{id:id},
                    success:function(data){
                        $('#perm').html(data);
                        viewData2(); 
                    }
                 });
            });
         $(document).on('click','.rej',function(){
                 var id = $(this).attr("id");  
                 $.ajax({
                    url:"user-manage-ajax.php?p2=rej",
                    method:"post",
                    data:{id:id},
                    success:function(data){
                        $('#perm').html(data);
                        viewData2();
                    }
                });
             });
            function pharmaActive(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=pac",
                    success: function(result){
                        $("#act").html(result);
                    }
                });
            }
            function pharmaInactive(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=pia",
                    success: function(result){
                        $("#inact").html(result);
                    }
                });
            }
            function pharmaBlock(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=pbl",
                    success: function(result){
                        $("#block").html(result);
                    }
                });
            }
            function cashierActive(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=cac",
                    success: function(result){
                        $("#cact").html(result);
                    }
                });
            }
            function cashierInactive(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=cia",
                    success: function(result){
                        $("#cinact").html(result);
                    }
                });
            }
            function cashierBlock(){
                $.ajax({
                    type:"GET",
                    url:"user-manage-ajax.php?p=cbl",
                    success: function(result){
                        $("#cblock").html(result);
                    }
                });
            }
            $(document).on('click','.pbl',function(){
                var id = $(this).attr("id");
                $.ajax({
                    type:"GET",
                    data:{id:id},
                    url:"user-manage-ajax.php?p=pblpbl",
                    success: function(result){
                        
                    }
                });
            });
            $(document).on('click','.pbl1',function(){
                var id = $(this).attr("id");
                $.ajax({
                    type:"GET",
                    data:{id:id},
                    url:"user-manage-ajax.php?p=pbl1",
                    success: function(result){
                       
                    }
                });
            });
            $(document).on('click','.pblu',function(){
                var id = $(this).attr("id");
                $.ajax({
                    type:"GET",
                    data:{id:id},
                    url:"user-manage-ajax.php?p=pblu",
                    success: function(result){
                       
                    }
                });
            });
            $(document).on('click','.cbl',function(){
                var id = $(this).attr("id");
                $.ajax({
                    type:"GET",
                    data:{id:id},
                    url:"user-manage-ajax.php?p=cblcbl",
                    success: function(result){
                        
                    }
                });
            });
            $(document).on('click','.cbl1',function(){
                var id = $(this).attr("id");
                $.ajax({
                    type:"GET",
                    data:{id:id},
                    url:"user-manage-ajax.php?p=cbl1",
                    success: function(result){
                        
                    }
                });
            });
            $(document).on('click','.cblu',function(){
                var id = $(this).attr("id");
                $.ajax({
                    type:"GET",
                    data:{id:id},
                    url:"user-manage-ajax.php?p=cblu",
                    success: function(result){
                       
                    }
                });
            });
            viewData();viewData2();pharmaActive();pharmaInactive();pharmaBlock();cashierActive();cashierInactive();cashierBlock();
            setInterval(function(){
                viewData(),viewData2(),pharmaActive(),pharmaInactive(),pharmaBlock(),cashierActive(),cashierInactive(),cashierBlock() // this will run after every 2 seconds
            },1000); 

    });
        </script>

<style type="text/css">
.nav-pills>li.active>a, 
.nav-pills>li.active>a:focus, 
.nav-pills>li.active>a:hover {
    background-color: transparent !important;
}
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
                        <li class="active">
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
                        <li>
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
   <!-- end of sidebar -->
    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					<!-- <div class="header">
                        <h4 class="title text-center">USEER MANAGE</h4>
                    </div> -->
                        <!-- Showing All Users.
                        -> User Request
                        -> Read The Details and gives the permission. -->
                        <div class="content">
                         <ul class="nav nav-pills">
                                <li><a data-toggle="tab" href="#ur"><button type="button" class="btn btn-info btn-fill btn-wd">User's Request</button></a></li>
                                <li><a data-toggle="tab" href="#perm"><button type="button" class="btn btn-warning btn-fill btn-wd">Permissions</button></a></li>
                              </ul>
                              <div class="tab-content">
                                <div id="ur" class="content tab-pane fade in active">
                                    <!-- <div class="content table-responsive table-full-width"> -->
                                       
                                </div>
                                <div id="perm" class="content tab-pane fade">
                                  <!-- <div class="content table-responsive table-full-width"> -->
                                   
                                </div>
                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Pharmacist</h4>
                                <p class="category">Pharmacist Information's</p>
                            </div>
                            <div class="content">
                                <!-- <div id="chartPreferences" class="ct-chart ct-perfect-fourth"> -->
                                    <!-- -> Showing Pharmacist Group
                                    -> Show Active Pharmacist
                                    -> Show Deactive Pharmacist
                                    -> Create Group in Modal Form. -->
                                <!-- </div> -->
                                <ul class="nav nav-pills">
                                <li><a data-toggle="tab" href="#act"><button type="button" class="btn btn-success btn-fill">Active</button></a></li>
                                <li><a data-toggle="tab" href="#inact"><button type="button" class="btn btn-warning btn-fill">Inactive</button></a></li>
                                <li><a data-toggle="tab" href="#block"><button type="button" class="btn btn-danger btn-fill">Block</button></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="act" class="tab-pane fade in active">
                                     
                                    </div>
                                    <div id="inact" class="tab-pane fade">
                                      
                                    </div>
                                    <div id="block" class="tab-pane fade">
                                      
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-success"></i> Active
                                        <i class="fa fa-circle text-warning"></i> Inactive
                                        <i class="fa fa-circle text-danger"></i> Block
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated Now
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Cashier</h4>
                                <p class="category">Cashier Information's</p>
                            </div>
                            <div class="content">
                                <ul class="nav nav-pills">
                                <li><a data-toggle="tab" href="#cact"><button type="button" class="btn btn-success btn-fill">Active</button></a></li>
                                <li><a data-toggle="tab" href="#cinact"><button type="button" class="btn btn-warning btn-fill">Inactive</button></a></li>
                                <li><a data-toggle="tab" href="#cblock"><button type="button" class="btn btn-danger btn-fill">Block</button></a></li>
                                </ul>

                                <div class="tab-content">
                                    <div id="cact" class="tab-pane fade in active">
                                     
                                    </div>
                                    <div id="cinact" class="tab-pane fade">
                                      
                                    </div>
                                    <div id="cblock" class="tab-pane fade">
                                      
                                    </div>
                                </div>
                                <div class="footer">
                                    <div class="chart-legend">
                                        <i class="fa fa-circle text-success"></i> Active
                                        <i class="fa fa-circle text-warning"></i> Inactive
                                        <i class="fa fa-circle text-danger"></i> Block
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="ti-reload"></i> Updated Now
                                    </div>
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
</div>


</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>