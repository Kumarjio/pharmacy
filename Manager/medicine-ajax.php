<?php 
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';
if($pa=="1"){

	$sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
			medicine_stock_info.m_id,SUM(medicine_stock_info.avialability) AS available,medicine_stock_info.sold_qnty
			FROM `medicine_info`
			INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id WHERE 1=1 GROUP BY medicine_info.m_category ORDER BY medicine_info.m_name ASC"; //
	$stmt = $conn->query($sql);

	?>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
		$catg = $row['m_category'];
			?>
			
			 <div class="col-lg-6 col-sm-12">
                            <div class="card">
                                <div class="content">
                                    <div class="row">
                                        <div class="col-xs-2">
                                            <div class="icon-big text-center">
                                                 <i class="ti-mouse" style="color: #e60073;"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <!-- <div class="icon-big text-center">
                                                 <i class="ti-mouse" style="color: #e60073;"></i>
                                            </div> -->
                                            <li>Name</li>
                                            <li>Type</li>
                                            <li>Category</li>
                                            <li>Available</li>
                                        </div>
                                        <div class="col-xs-7">
                                            
                                              <?php                                        
                                              	echo $row['m_name']."<br>";
                                              	echo $row['m_type']."<br>";
                                              	echo "<b>".$row['m_category']."</b><br>";
                                              	echo $row['available']."<br>";
                                              ?>
                                            
                                        </div>
                                    </div><br>
                                    
                                    <div class="row">
                                    			<div class="panel-group">
												    <div class="panel panel-default" id="accordion">
												      <div class="panel-heading">
												        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $row['m_id']; ?>"><h4 class="panel-title">
												          Click To More <i class="ti-plus" style="float: right;"></i>
												        </h4></a>
												      </div>
												      <div id="<?php echo $row['m_id']; ?>" class="panel-collapse collapse" >
												        <div class="panel-body">
												        	<?php 

						                                   		 $sql = "SELECT medicine_info.m_id,medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
																	medicine_stock_info.m_id,medicine_stock_info.avialability ,medicine_stock_info.tray_no,medicine_stock_info.add_drug_pkts_no,medicine_stock_info.add_drug_date,medicine_compositions.mfg_date,medicine_compositions.exp_date
																	FROM `medicine_info`
																	INNER JOIN `medicine_stock_info`  ON medicine_info.m_id = medicine_stock_info.m_id
																	INNER JOIN `medicine_compositions`  ON medicine_info.m_id = medicine_compositions.m_id WHERE medicine_info.m_category='".$catg."' "; //
																    $stmt2 = $conn->query($sql);
																    while($row1 = $stmt2->fetch_array(MYSQLI_ASSOC)){
								                                    ?>
								                                    <div class="row">
								                                    	<div class="col-xs-6">
								                                    		Name -<br>
								                                    		Type -<br>
								                                    		Add Date -<br>
								                                    		Availability -<br>
								                                    		Tray No -<br>								                                    		
								                                    		Price -<br>
								                                    		Pkts No -<br>
								                                    		Mfg_Date -<br>
								                                    		Exp_Date -<br> 
								                                    		<hr>
								                                    	</div>
								                                    	<div class="col-xs-6">
								                                    		<?php
								                                    		    echo "<b>".$row1['m_name']."</b><br>";
								                                              	echo $row1['m_type']."<br>";
								                                              	echo $row1['add_drug_date']."<br>";
								                                              	echo $row1['avialability']."<br>";
								                                              	echo $row1['tray_no']."<br>";
								                                              	echo $row1['m_price']."<br>";
								                                              	echo $row1['add_drug_pkts_no']."<br>";
								                                              	echo "<b>".$row1['mfg_date']."</b><br>";
								                                              	echo "<b>".$row1['exp_date']."</b><br>";					                                              	
								                                         ?>
								                                         <hr>
								                                    	</div>
								                                    </div>
								                                   <?php } ?>

												        </div>
												        
												      </div>
												    </div>
												 </div>
                                    </div>
                                    <div class="stats">
                                            <i class="ti-reload"></i> Updated now
                                    </div>
                                </div>
                            </div>
                        </div>

	<?php
	}
}
if($pa=="2"){
	$sql = "SELECT medicine_info.m_name,medicine_info.m_type,medicine_info.m_price,medicine_info.m_category,
			medicine_stock_info.m_id,medicine_stock_info.avialability,medicine_stock_info.sold_qnty
			FROM `medicine_info`
			INNER JOIN `medicine_stock_info`  ON medicine_info.id = medicine_stock_info.m_id WHERE 1=1";
	$stmt = $conn->query($sql);
	?>
	<center><h6 style="padding:5px;margin:5px; font-weight: bold;">Drug Detail's</h6></center>
	 <table class="table">
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Category</th>
            <th>Price</th>
            <th>Available</th>
            <th>Drug Sales</th>
	<?php
	while($row = $stmt->fetch_array(MYSQLI_ASSOC)){
				echo "<tr><td>";
					echo $row['m_id'];
				echo "</td><td>";				
					echo $row['m_name'];
				echo "</td><td>";				
					echo $row['m_type'];
				echo "</td><td>";				
					echo $row['m_category'];
				echo "</td><td>";				
					echo $row['m_price'];
				echo "</td><td>";				
					echo $row['avialability'];
				echo "</td><td>";				
					echo $row['sold_qnty'];
				?>
				</td></tr>
	<?php
	}
	echo "</table>";
	
}
?>
					


