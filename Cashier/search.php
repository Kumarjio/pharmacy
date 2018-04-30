<?php include_once('../common/header.php'); ?>
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
                <div class="card">
					<div class="header">
                        <h4 class="title text-center">Search</h4>
                        Search Operation
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