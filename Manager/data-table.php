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
    <title>Data Table's</title>
    <?php include_once('../common/header.php'); ?>
     <script type="text/javascript">
        function updateData(){
          $("#pfrm,#pupd").on('submit',function(e){
            e.preventDefault();
              $.ajax({  
                      url: "data-table-ajax.php?p=pupdate",
                      type: "post",
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(msg){
                          alert(msg);
                          $('#updateModal').modal('hide');
                          $('#pfrm')[0].reset();      
                    }   
                  });
              });
          $("#cfrm,#cupd").on('submit',function(e){
            e.preventDefault();
              $.ajax({  
                      url: "data-table-ajax.php?p=cupdate",
                      type: "post",
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(msg){
                          alert(msg);
                          $('#updateModal').modal('hide');
                          $('#cfrm')[0].reset();      
                    }   
                  });
              });
        
      }
    $(document).ready(function(){
        function pharmaData(){
                $.ajax({
                    type:"GET",
                    url:"data-table-ajax.php?p=1",
                    success: function(result){
                        $("#pharma").html(result);
                    }
                });
            }
        function cashierData(){
                $.ajax({
                    type:"GET",
                    url:"data-table-ajax.php?p=2",
                    success: function(result){
                        $("#cashier").html(result);
                    }
                });
            }
        function drugData(){
                $.ajax({
                    type:"GET",
                    url:"data-table-ajax.php?p=3",
                    success: function(result){
                        $("#drug").html(result);
                    }
                });
            }
        $("#pform").on('submit',function(){
              $.ajax({  
                  url: "data-table-crud.php?p=pinsert",
                  type: "post",
                  data: new FormData(this),
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(msg){ 
                      alert(msg);                    
                      //$('#myModal').modal('hide');
                      $('#pform')[0].reset();      
                } 

              });
              alert("New record created successfully.");
          });
        $("#cform").on('submit',function(){
              $.ajax({  
                  url: "data-table-crud.php?p=cinsert",
                  type: "post",
                  data: new FormData(this),
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function(msg){
                      alert(msg);
                      //$('#myModal2').modal('hide');
                      $('#cform')[0].reset();      
                }   
              });
              alert("New record created successfully.");
          });
       
        $(document).on('click','.pup',function(){
           var col_name2 = $(this).attr("id"); 
           $.ajax({
            url:"data-table-crud.php?p=pup",
            method:"post",
            data:{col_name2},
            success:function(data){
              $('#fetch-data').html(data);    
              }
           });
        });
        $(document).on('click','.cup',function(){
           var col_name2 = $(this).attr("id"); 
           $.ajax({
            url:"data-table-crud.php?p=cup",
            method:"post",
            data:{col_name2},
            success:function(data){
              $('#fetch-data').html(data);    
              }
           });
        });
        $(document).on('click','.dup',function(){
           var col_name2 = $(this).attr("id"); 
           $.ajax({
            url:"data-table-crud.php?p=dup",
            method:"post",
            data:{col_name2},
            success:function(data){
              $('#fetch-data').html(data);    
              }
           });
        });
        $(document).on('click','.pview',function(){
           var col_name2 = $(this).attr("id"); 
           $.ajax({
            url:"data-table-crud.php?p=pview",
            method:"post",
            data:{col_name2},
            success:function(data){
              $('#view-fetch-data').html(data);    
              }
           });
        });
        $(document).on('click','.cview',function(){
           var col_name2 = $(this).attr("id"); 
           $.ajax({
            url:"data-table-crud.php?p=cview",
            method:"post",
            data:{col_name2},
            success:function(data){
              $('#view-fetch-data').html(data);    
              }
           });
        });
        $(document).on('click','.mview',function(){
           var col_name2 = $(this).attr("id"); 
           $.ajax({
            url:"data-table-crud.php?p=mview",
            method:"post",
            data:{col_name2},
            success:function(data){
              $('#view-fetch-data').html(data);    
              }
           });
        });
        $(document).on('click','.pdel',function(){
        if(confirm("Are you sure you want to delete this")){
         var col_name3 = $(this).attr("id"); 
         $.ajax({
                  url:"data-table-crud.php?p=pdel",
                  method:"post",
                  data:{col_name3},
                  success: function(data){
                       alert(data);
                      }
                });
            }
         });
        $(document).on('click','.cdel',function(){
        if(confirm("Are you sure you want to delete this")){
         var col_name3 = $(this).attr("id"); 
         $.ajax({
                  url:"data-table-crud.php?p=cdel",
                  method:"post",
                  data:{col_name3},
                  success: function(data){
                       alert(data);
                      }
                });
            }
         });
        $(document).on('click','.ddel',function(){
        if(confirm("Are you sure you want to delete this")){
         var col_name3 = $(this).attr("id"); 
         $.ajax({
                  url:"data-table-crud.php?p=ddel",
                  method:"post",
                  data:{col_name3},
                  success: function(data){
                       alert(data);
                      }
                });
            }
         });
        pharmaData();cashierData();drugData();
        setInterval(function(){
                pharmaData(),cashierData(),drugData() //pharmaInactive() pharmaBlock(),cashierActive(),cashierInactive(),cashierBlock() // this will run after every 5 seconds
            },2000); 
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
    .Emp table,tr,td 
    {
        padding-left: 20px;
    }
    /*.nav-pills>li.active>a, 
    .nav-pills>li.active>a:focus, 
    .nav-pills>li.active>a:hover {
    background-color: transparent !important;
    }*/
    </style>
</head>
<!-- start of sidebar -->
<div class="wrapper">
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
                        <li class="active">
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
                          <div class="content">
                              <ul class="nav nav-tabs">
                                <li class="active"><a data-toggle="tab" href="#pharma"><button type="button" class="btn btn-info btn-fill btn-wd">Pharmacist</button></a></li>
                                <li><a data-toggle="tab" href="#cashier"><button type="button" class="btn btn-warning btn-fill btn-wd">Cashier</button></a></li>
                                <li><a data-toggle="tab" href="#drug"><button type="button" class="btn btn-danger btn-fill btn-wd">Drug's</button></a></li>
                              </ul>
                            </div>
                    </div>
              </div>
                            <div class="tab-content">
                              <div id="pharma" class="tab-pane fade in active">

                              </div>
                              <div id="cashier" class="tab-pane fade">
                                
                              </div>
                              <div id="drug" class="tab-pane fade">
                               
                              </div>
                          </div>
        
			</div>
		</div>

		<!-- footer is here -->
        <?php //include_once('../common/footer.php'); ?>

    </div>
</div>

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pharmacist</h4>
        </div>
         <div class="modal-body">
                <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="pform">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="dt">Date Of Join:</label>
                      <div class="col-sm-9">          
                        <input type="date" class="form-control border-input" id="dt" name="dt" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="id">Id:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="id"  name="id" value="PH">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pn">Name:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="pn"  name="pn" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="emt">Emp Type:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="emt"  name="emt" value="GRADE-" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="sal">Salary:</label>
                      <div class="col-sm-9">          
                        <input type="number" class="form-control border-input" id="sal"  name="sal" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pwd">Password:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="pwd" name="pwd" value="chemio123">
                      </div>
                    </div>   
                    <div class="form-group">        
                      <div class="col-sm-offset-3 col-sm-9">
                        <button type="button" class="btn btn-danger btn-fill btn-wd" 
                         data-dismiss="modal"> Close </button>
                        <input type="submit" class="btn btn-success btn-fill btn-wd" value="Submit" id="submit" name="submit">
                      </div>
                    </div>
                  </form>  
          </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cashier</h4>
        </div>
        <div class="modal-body">

            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="cform">
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="dt">Date Of Join:</label>
                      <div class="col-sm-9">          
                        <input type="date" class="form-control border-input" id="dt" name="dt" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="id1">Id:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="id1"  name="id1" value="CH">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pn">Name:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="pn"  name="pn" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="emt">Emp Type:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="emt"  name="emt" value="GRADE-" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="sal">Salary:</label>
                      <div class="col-sm-9">          
                        <input type="number" class="form-control border-input" id="sal"  name="sal" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-3" for="pwd">Password:</label>
                      <div class="col-sm-9">          
                        <input type="text" class="form-control border-input" id="pwd" name="pwd" value="chemio123">
                      </div>
                    </div>   

                    <div class="form-group">        
                      <div class="col-sm-offset-3 col-sm-9">
                        <button type="button" class="btn btn-danger btn-fill btn-wd" 
                         data-dismiss="modal"> Close </button>
                        <input type="submit" class="btn btn-success btn-fill btn-wd" value="Submit" id="submit" name="submit">
                      </div>
                    </div>
                  </form>   
        </div>
      </div>
      
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
</body>
<?php include_once('../common/xtralink.php'); ?>
<!-- xtralink file is here.... -->
</html>

