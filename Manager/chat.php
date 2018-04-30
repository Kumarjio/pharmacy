<?php 
include_once '../common/config.php';  

session_start();
if(! $_SESSION['current_user2']){
    header("location:index.php");
    exit();
}
$sql = " SELECT  *FROM  `medicine_stock_info`";
    $stmt = $conn->query($sql);
    $chart_data="";
    while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
        $chart_data .="{ m_id:'".$row['id']."',
                         avialability:'".$row['avialability']."',
                         sold_drug:'".$row['sold_qnty']."',
                         modified_date:'".$row['modified_date']."' }, ";
    }
    $chart_data = substr($chart_data,0,-2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>test-chat</title>
    <?php include_once('../common/header.php'); ?>
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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

<!-- End Of Side Bar -->
    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					         <div class="header">
                        <h4 class="title text-center">CHAT STATICSTICS SECTION - 1</h4>
                        <!-- Showing Chat 
                        1 -> Showing All Active User
                        2 -> Message Sending themselve
                        3 -> Grouping Id
                        4 -> Block User -->
                        <!--  
                             Data Visualizations    

                             1 -> medicine stock information (avialability)
                             2 -> To check how many medicine are sold out
                             3 -> whcih medicines is highly sale.
                             4 -> About User
                         --> 
                        <div id="myfirstchart" style="height: 250px;"></div>
                    </div>
					
				      </div>

                 <div class="card">
                    <div class="header">
                        <h4 class="title text-center">CHAT STATICSTICS SECTION - 2</h4>
                        <!--  
                             Data Visualizations    

                             1 -> medicine stock information (avialability)
                             2 -> To check how many medicine are sold out
                             3 -> whcih medicines is highly sale.
                             4 -> About User
                         -->
                        <div id="chart" style="height: 250px;"></div>
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
<script type="text/javascript">
new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['value']
});

new Morris.Bar({
    element:'chart',
    data:[<?php echo $chart_data; ?>],
    xkey:'modified_date',
    ykeys:['m_id','avialability','sold_drug'],
    labels:['m_id','avialability','sold_drug'],
    hideHover:'auto',
    stacked:true,
});

new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart1',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
    { year: '2008', value: 20 },
    { year: '2009', value: 10 },
    { year: '2010', value: 5 },
    { year: '2011', value: 5 },
    { year: '2012', value: 20 }
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
</script>