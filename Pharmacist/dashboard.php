<?php 
include_once '../common/config.php'; 
session_start();
if(! $_SESSION['current_user3'] && ! $_SESSION['u_id2']){
    header("location:../index.php");
    exit();
}
if(isset($_SESSION['current_user3']) && isset($_SESSION['u_id2'])){
    $user = $_SESSION['current_user3'];
    $user_id = $_SESSION['u_id2'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
          
         $(document).ready(function(){
        function viewStatus(){
            
                $.ajax({
                    type:"GET",
                    url:"p-dashboard-ajax.php?p=1",
                    success: function(result){
                        $(".status").html(result);
                    }
                });
            }
        function viewMsg(){

                $.ajax({
                    type:"GET",
                    url:"p-dashboard-ajax.php?p=2",
                    success: function(result){
                        $(".msg").html(result);
                    }
                });
            }
            viewStatus();viewMsg();
            setInterval(function(){
                viewStatus(),viewMsg()
            },1000); 

         $('.add').on('mouseover', function() {
            var options = $('#phr').val();
            $('#tr').append(options+", \n");
         });

         $('.add2').on('mouseover', function() {
            var options = $('#chr').val();
            $('#tr').append(options+", \n");
         });

         $('.add3').on('mouseover', function() {
            var options = $('#mnr').val();
            $('#tr').append(options+", \n");
         });
        $('.removeAll3').on('mouseover', function() {
            $('#tr').empty();
        });

        $("#cfrm,#adfrm").on('submit',function(e){
            e.preventDefault();
              $.ajax({  
                      url: "p-dashboard-ajax.php?p=insert1",
                      type: "post",
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(msg){
                          alert(msg);
                          //$('#modal1').modal('hide');
                          $('#cfrm')[0].reset();      
                    }   
                  });
              });
          $("#cfrm1,#adfrm2").on('submit',function(e){
            e.preventDefault();
              $.ajax({  
                      url: "p-dashboard-ajax.php?p=insert2",
                      type: "post",
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(msg){
                          alert(msg);
                          //$('#modal2').modal('hide');
                          $('#cfrm1')[0].reset();      
                    }   
                  });
              });

    });

    </script>
    <script type="text/javascript">
       
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
                <div class="card">
					<div class="header">
                        <h4 class="title text-center">Pharmacist Requests</h4>
                    </div>
                    <div class="content">
                                    <div class="col-md-offset-3 col-md-3 text-right">
                                        <!-- <input type="text" class="form-control border-input input-sm txt" id="uname" name="uname" placeholder="Enter search data"/> -->
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" name="addform" class="btn btn-info btn-wd btn-fill"  data-toggle="modal" data-target="#modal1">Request Form</button>
                                    </div>
                      <div class="status content">
                        
                      </div>
                    </div>
				</div>
                <div class="content card">
                    <div class="header">
                        <h4 class="title text-center">Message Content</h4>
                    </div>
                    <div class="content">
                                    <div class="col-md-offset-3 col-md-3 text-right">
                                        <!-- <input type="text" class="form-control border-input input-sm txt" id="uname" name="uname" placeholder="Enter search data"/> -->
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="button" name="addform" class="btn btn-info btn-wd btn-fill"  data-toggle="modal" data-target="#modal2">Message Form</button>
                                    </div>
                    </div>
                    <div class="msg content">
                        Pharmacist Request Showing status
                    </div>
                </div>
			</div>
		</div>

		<!-- footer is here -->
        <?php //include_once('../common/footer.php'); ?>

    </div>
</div>

 <div class="modal fade" id="modal1" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title text-center text-primary">Request Form</h6>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="cfrm">
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="id">User Id:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="id"  name="id" value="<?php echo $user_id; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fn">User Name:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="fn"  name="fn" value="<?php echo $user; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                       <div class="form-group">
                          <label class="control-label col-sm-3" for="user">User Type:</label>
                          <div class="col-sm-9">          
                            <select class="form-control border-input"  name="user" id="user">
                                            <!-- <option value="Manager">Manager</option> -->
                                            <option value="Pharmacist">Pharmacist</option>
                                            <!-- <option value="Cashier">Cashier</option> -->
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="msg">Message:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="msg" id="msg" rows="6" cols="6"> </textarea> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="p_type">Permission Type:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" name="p_type" id="p_type">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="rd">Request Date:</label>
                          <div class="col-sm-9">          
                            <input type="date" class="form-control border-input" name="rd" id="rd">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="st">Status:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" name="st" id="st" value="Pending" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-9">
                            <button type="button" class="btn  btn-fill  btn-danger" 
                             data-dismiss="modal"> Close </button>
                            <input type="submit" class="btn btn-fill  btn-success" value="Submit" id="adfrm" name="adfrm">
                          </div>
                        </div>
                    </form>            
                </div>
      </div>     
    </div>
   </div>
    <div class="modal fade" id="modal2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title text-center text-primary">Message Form</h6>
        </div>
        <div class="modal-body">
          <!-- -->
             <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="cfrm1">
                        <div class="form-group">
                          <!-- <label class="control-label col-sm-3" for="fn">To:</label> -->
                          <div class="col-sm-2">          
                            <select class="form-control form-control border-input s1" name="ph" id="phr" multiple="true" tabindex="1">
                                <option value="" selected=""></option>
                                <?php 
                                    $sql2 ="SELECT name FROM `pharmacist`";
                                    $stmt2 = $conn->query($sql2);
                                    while($row = $stmt2->fetch_array(MYSQLI_ASSOC))
                                    {
                                        echo "<option value='". $row['name']."'>".$row['name']."</option>";
                                    }
                                ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <button class="add form-control btn btn-success btn-fill ">Add</button>
                            
                          </div>
                          <div class="col-sm-2">          
                            <select class="form-control form-control border-input s2" name="ch" id="chr" multiple="true" tabindex="1">
                                <option value="" selected=""></option>
                                <?php 
                                    $sql2 ="SELECT name FROM `cashier`";
                                    $stmt2 = $conn->query($sql2);
                                    while($row = $stmt2->fetch_array(MYSQLI_ASSOC))
                                    {
                                        echo "<option value='". $row['name']."'>".$row['name']."</option>";
                                    }
                                ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <button class="add2 form-control btn btn-success btn-fill">Add</button>
                            
                          </div>
                          <div class="col-sm-2">          
                            <select class="form-control form-control border-input s3 " name="mn" id="mnr" multiple="true" tabindex="1">
                                <option value="" selected=""></option>
                                <?php 
                                    $sql2 ="SELECT m_name FROM `manager`";
                                    $stmt2 = $conn->query($sql2);
                                    while($row = $stmt2->fetch_array(MYSQLI_ASSOC))
                                    {
                                        echo "<option value='". $row['m_name']."'>".$row['m_name']."</option>";
                                    }
                                ?>
                            </select>
                          </div>
                          <div class="col-sm-2">
                            <button class="add3 form-control btn btn-success btn-fill">Add</button>
                            <br>
                           
                            <button class="removeAll3 form-control btn btn-danger btn-fill">Remove All</button>
                          </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="tr">To Recipient's:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="tr" id="tr" rows="6" cols="6"> </textarea> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="msg">Message:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="msg" id="msg" rows="6" cols="6"> </textarea> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="msg2">Important Point:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="msg2" id="msg2" rows="6" cols="6"> </textarea> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="rd">Valid Till:</label>
                          <div class="col-sm-9">          
                            <input type="date" class="form-control border-input" name="rd" id="rd">
                          </div>
                        </div>
                        <div class="form-group">        
                          <div class="col-sm-offset-3 col-sm-9">
                      <button type="button" class="btn  btn-fill  btn-danger" 
                             data-dismiss="modal"> Close </button>
                            <input type="submit" class="btn btn-fill  btn-success" value="Submit" id="adfrm2" name="adfrm2">
                          </div>
                        </div>
            </form>             
        </div>
      </div>     
    </div>
   </div>
</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>


