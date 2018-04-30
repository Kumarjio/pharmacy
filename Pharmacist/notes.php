<?php 
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
            //$('#to').remove();
            // set each div unique id.
            function viewNotes(){
                $.ajax({
                    type:"GET",
                    url:"p-notes-ajax.php?p=1",
                    success: function(result){
                        $(".status").html(result);
                    }
                });
            }
            viewNotes();
            setInterval(function(){
                viewNotes();
            },1000); 

            $("#cfrm,#adfrm").on('submit',function(e){
            e.preventDefault();
              $.ajax({  
                      url: "p-notes-ajax.php?p=insert",
                      type: "post",
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(msg){
                          alert(msg);
                          $('#modal1').modal('hide');
                          $('#cfrm')[0].reset();      
                    }   
                  });
              });
            $(document).on('click','.removeButton',function(){
               var col_name3 = $(this).attr("id"); 
               $.ajax({
                        url:"p-notes-ajax.php?p=del",
                        method:"post",
                        data:{col_name3},
                        success: function(data){
                             alert(data);
                            }
                      });
          });
    });
    </script>
     <script type="text/javascript">
      function uniqueNumber(){
          var date = Date.now();
          if (date <= uniqueNumber.previous) {
              date = ++uniqueNumber.previous;
          } else {
              uniqueNumber.previous = date;
          }
          return date;
      }
      uniqueNumber.previous = 0;
      function ID(){
        return uniqueNumber();
      }
      function uniqueId(){
        var idd = ID();
        document.getElementById("id2").value = idd;
      }
      
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
                    <a href="medicines.php">
                        <i class="ti-mouse" style="color: #e60073;"></i>
                        <p style="color: #00001a;">Drug</p>
                    </a>
                </li>

                <li>
                    <a href="statistics.php">
                        <i class="ti-bar-chart" style="color: #00001a;"></i>
                        <p style="color: #00001a;">Statistics</p>
                    </a>
                </li>
                <!-- <li>
                    <a href="chat.php">
                        <i class="ti-thought" style="color: #ff6633;"></i>
                        <p style="color: #00001a;">Chat Section</p>
                    </a>
                </li> -->
                <li class="active">
                    <a href="notes.php">
                        <i class="ti-clipboard" style="color: #00e673 ;"></i>
                        <p style="color: #00001a;">Note</p>
                    </a>
                </li>
                <li>
                    <a href="complains.php">
                        <i class="ti-rocket" style="color: red ;"></i>
                        <p style="color: #00001a;">Message</p>
                    </a>
                </li>
               <!--  <li> 
                    <a href="search.php">
                        <i class="ti-search" style="color: #00001a;"></i>
                        <p style="color: #00001a;">Permissions</p>
                    </a>
                </li> -->
                <li>
                    <a href="notifications.php">
                        <i class="ti-bell" style="color:  #ff5c33;"></i>
                        <p style="color: #00001a;">Notifications</p>
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
                        <h4 class="title text-center">NOTE & FILE</h4>
                           <div class="col-md-offset-10 text-right">
                                            <button type="button" name="addform" class="btn btn-info btn-wd btn-fill" onclick="uniqueId();" data-toggle="modal" data-target="#modal1">Add Note</button>
                            </div>

                    </div><br>
				</div>
			</div>
            <div class="status">
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
          <h6 class="modal-title text-center text-primary" onclick="uniqueId();">Add Notes</h6>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="cfrm"> 
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="id2">Note Id:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="id2"  name="id2" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fn">User Id:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="fn"  name="fn" value="<?php echo $user_id; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fn2">User Name:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="fn2"  name="fn2" value="<?php echo $user; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="msg">Content:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="msg" id="msg" rows="8" cols="8"> </textarea> 
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
</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>