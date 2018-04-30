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
            function updateData(){              
                $("#dform2,#up").on('submit',function(){
                $.ajax({  
                  url: "p-medicine-ajax.php?p=dinsert2",
                  type: "post",
                  data: new FormData(this),
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(msg){
                      alert(msg);
                      //$('#myModal3').modal('hide');
                      $('#dform')[0].reset();      
                    }   
                });
                alert("New was updated successfully.");
                });
            }
          $(document).ready(function(){
                function drugData(){
                        $.ajax({
                            type:"GET",
                            url:"p-medicine-ajax.php?p=drgd",
                            success: function(result){
                                $("#drug").html(result);
                            }
                        });
                    }
            $(document).on('click','.dup',function(){
                    var col_name2 = $(this).attr("id"); 
                    $.ajax({
                    url:"p-medicine-ajax.php?p=dup",
                    method:"post",
                    data:{col_name2},
                    success:function(data){
                      $('#fetch-data').html(data);    
                      }
                   });
            });
            $(document).on('click','.mview',function(){
                    var col_name2 = $(this).attr("id"); 
                    $.ajax({
                    url:"p-medicine-ajax.php?p=mview",
                    method:"post",
                    data:{col_name2},
                    success:function(data){
                      $('#view-fetch-data').html(data);    
                      }
                   });
            });
            $(document).on('click','.ddel',function(){
                if(confirm("Are you sure you want to delete this")){
                var col_name3 = $(this).attr("id"); 
                $.ajax({
                  url:"p-medicine-ajax.php?p=ddel",
                  method:"post",
                  data:{col_name3},
                  success: function(data){
                            alert(data);
                          }
                    });
                }
            });
             $("#dform").on('submit',function(){
              $.ajax({  
                  url: "p-medicine-ajax.php?p=dinsert",
                  type: "post",
                  data: new FormData(this),
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(msg){
                      alert(msg);
                      //$('#myModal3').modal('hide');
                      $('#dform')[0].reset();      
                }   
              });
              alert("New record created successfully.");
          });
             
            drugData();
            setInterval(function(){
                            drugData()
                    },2000); 

            $(document).on('keyup','.dn',function(){
                   var drug=$("#uname11").val();
                    $.ajax({
                        type:"post",
                        url:"p-medicine-ajax.php?p=dname",
                        data:{drug},
                        success: function(result){
                           $("#sdrug").html(result);
                           $("#drug").remove();
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
        document.getElementById("id").value =  "PH"+idd;
        document.getElementById("id1").value = "CH"+idd;
      }
    </script>
   <style type="text/css">
        input[type="text"],input[type="date"],textarea,
            select.form-control {
              background: transparent;
              border: none;
              border-bottom: 1px solid #000000;
              -webkit-box-shadow: none;
              box-shadow: none;
              border-radius: 0;
            }
            input[type="text"],
            select.form-control:focus {
              -webkit-box-shadow: none;
              box-shadow: none;
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
                <li class="active">
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
                <li>
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
                <li>
                    <a href="notifications.php">
                        <i class="ti-bell" style="color:  #ff5c33;"></i>
                        <p style="color: #00001a;">Notifications</p>
                    </a>
                </li>

            </ul>
        </div>
</div>
?>
    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					<div class="header">
                    <h4 class="title text-center">-: Drug Information's :-</h4>
                        <!-- Medicines  -->
                    </div>
                      <div class="container-fluid table-responsive" style="margin-top:5px;">
                        <div class="row">
                          <div class="col-md-1 text-right">
                             <button type="button" name="padd" class="btn btn-info btn-fill"  data-toggle="modal" data-target="#myModal3" onclick="uniqueId();">Add</button>
                          </div>
                          <div class="col-md-offset-7  col-md-4 text-left">
                            <input type="text" class="form-control input-sm txt dn" id="uname11" name="uname11" placeholder="Enter search data"/>
                          </div>
                          </div>  
                      </div>
                    <div class="msg" id="sdrug" style="margin-top:-50px;">    
                        
                    </div>
                    <div class="msg" id="drug" style="margin-top:-50px;">    
    
                    </div>
				</div>
			</div>
		</div>

		<!-- footer is here -->
        <?php //include_once('../common/footer.php'); ?>

    </div>
</div>


 <div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title text-center text-primary">Update Data</h6>
        </div>
        <div class="modal-body">
             <div id="fetch-data">

            </div> 
        </div>
      </div>     
    </div>
   </div>
    <div class="modal fade" id="viewModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h6 class="modal-title text-center text-primary">View Data</h6>
        </div>
        <div class="modal-body">
             <div id="view-fetch-data">

            </div> 
        </div>
      </div>     
    </div>
   </div>
    <div class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Drug's Information</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="dform">
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group">
                      <label class="control-label col-sm-3" for="id2">Drug Id:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control " id="id2"  name="id2" readonly="readonly" style="color:black;font-weight:bold;">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="mn">Name:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control " id="mn"  name="mn" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="mtype">Drug Type:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control " id="mtype" name="mtype" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="ctg">Category:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control " id="ctg" name="ctg">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pc">Price:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="pc" name="pc">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="trn">Tray No:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="trn" name="trn">
                      </div>
                    </div> 
                    
                </div>
                <div class="col-md-6">
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="avl">Availability:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="avl" name="avl">
                      </div>
                    </div> 
                    
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="ad">Add by:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="ad" name="ad" value="<?php echo $user; ?>" style="color:black;font-weight:bold;"  readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="mf">Mfd:</label>
                      <div class="col-sm-9">          
                        <input type="date" class="form-control" id="mf" name="mf">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="exp">Exp:</label>
                      <div class="col-sm-9">          
                        <input type="date" class="form-control" id="exp" name="exp">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pkts">No. Of Packets:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control" id="pkts" name="pkts">
                      </div>
                    </div> 
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="cmp">Composition:</label>
                      <div class="col-sm-9">          
                        <textarea class="form-control border-input" rows="4" cols="4" name="cmp" id="cmp"></textarea>
                      </div>
                </div>
                </div>
                <div class="col-md-12">
                
                <div class="form-group">        
                      <div class="col-sm-offset-4 col-sm-8">
                        <button type="button" class="btn btn-danger btn-fill btn-wd" 
                         data-dismiss="modal"> Close </button>
                        <input type="submit" class="btn btn-success btn-fill btn-wd" value="Submit" id="submit" onclick="uniqueId();" name="submit">
                      </div>
                </div>
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

