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
    <?php include_once('../common/header.php'); ?>
      <script type="text/javascript">
          
         $(document).ready(function(){
            $('#new_select').hide();
        function viewStatus(){
            
                $.ajax({
                    type:"GET",
                    url:"p-complain-ajax.php?p=1",
                    success: function(result){
                        $(".status").html(result);
                    }
                });
            }

            $("#cfrm,#adfrm").on('submit',function(e){
            e.preventDefault();
              $.ajax({  
                      url: "p-complain-ajax.php?p=insert1",
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

            viewStatus();
            setInterval(function(){
                viewStatus();
            },1000); 
              $('.rma').on('mouseover', function(){
                 $('#to').empty();
            });
            $(document).on('keyup','.dn',function(){
                   var drug=$("#uname11").val();
                    $.ajax({
                        type:"post",
                        url:"p-complain-ajax.php?p=cname",
                        data:{drug},
                        success: function(result){
                           $(".status1").html(result);
                           $(".status").remove();
                        }
                    });
            });
          
      });
         $(document).on('click','.ddel',function(){
              if(confirm("Are you sure you want to delete this")){
               var col_name3 = $(this).attr("id"); 
               $.ajax({
                        url:"p-complain-ajax.php?p=ddel",
                        method:"post",
                        data:{col_name3},
                        success: function(data){
                             alert(data);
                            }
                      });
                  }
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

    <script type="text/javascript">
        function fetch_select(val)
        {
         $.ajax({
         type: 'post',
         url: 'p-complain-ajax.php?p=retriverecord',
         data: {
          get_option:val
         },
         success: function (response) {
                $('#new_select').show();
                document.getElementById("new_select").innerHTML=response;
                if(response<1){
                $('#new_select').hide(); 
                }
            }
         });
        }
        function on_change(value){
            var options = $('#new_select').val();
            var tovalue = $('#to').val();
            if(tovalue.indexOf(options) != -1){
                var finaltovalue=tovalue.replace(options,"");
                           $('#to').empty();
                           $('#to').append(finaltovalue.trim());
            }else{
                $('#to').append(options+", \t");
            }
        }


</script>
<style type="text/css">
        input[type="text"]
            {
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
              tr,td{
                padding:5px;
                margin:5px;
                font-size: 12px;
            }
        input {padding:5px; border:1px solid #999; border-radius:4px; -moz-border-radius:4px; -web-kit-border-radius:4px; -khtml-border-radius:4px;}
    </style>
</head>
<body>

<div class="wrapper">
    
  
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
                    <a href="prescription.php">
                        <i class="ti-tag" style="color: #00001a;"></i>
                        <p style="color: #00001a;">Prescription</p>
                    </a>
                </li>
                <li>
                    <a href="stock.php">
                        <i class="ti-support" style="color: #ff6633;"></i>
                        <p style="color: #00001a;">Stock</p>
                    </a>
                </li>
                <li>
                    <a href="invoice.php">
                        <i class="ti-notepad" style="color: #00e673 ;"></i>
                        <p style="color: #00001a;">Receipt</p>
                    </a>
                </li>
                <li>
                    <a href="receipts.php">
                        <i class="ti-receipt" style="color: #e60073;"></i>
                        <p style="color: #00001a;">Invoice</p>
                    </a>
                </li>
                 <li class="active">
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
                <li class="active-pro">]
                    <a href="http://ferventis.com">
                        <i class="ti-heart" style="color: red;"></i>
                        <p style="color: #00001a;">by Ferventis</p>
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
                        <h4 class="title text-center">Message Box</h4>
                    </div>
    					         <div class="content">
                        <div class="container-fluid table-responsive" style="margin-top:5px;">
                          <div class="row">
                            <div class="col-md-1 text-right">
                               <button type="button" name="addform" class="btn btn-info btn-wd btn-fill" onclick="uniqueId();" data-toggle="modal" data-target="#modal1">Message Form</button>
                            </div>
                            <div class="col-md-offset-8  col-md-3 text-left">
                              <input type="text" class="form-control input-sm txt dn" id="uname11" name="uname11" placeholder="Enter search data"/>
                            </div>
                            </div>  
                        </div>                      
                          <div class="status1">
                            
                          </div>
                          <div class="status" style="margin-top:-25px;">
                            
                          </div>
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
          <h6 class="modal-title text-center text-primary">Message Form</h6>
        </div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data" id="cfrm">   
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="to">Choose User:</label>
                          <div class="col-sm-3" id="select_box">                                  
                            <select onchange="fetch_select(this.value);" class="form-control border-input">
                                    <option>Select User Group</option>
                                    <option value="ad">Admin</option>
                                    <option value="ma">Manager</option>
                                    <option value="ph">Pharmacist</option>
                                    <option value="ca">Cashier</option>
                            </select>
                          </div>
                          <div class="col-sm-3">          
                                <select id="new_select" multiple="multiple" onchange="on_change(this.value);" class="form-control border-input">
                                    <option value=""> Choose User</option>
                                </select>
                          </div>
                          <div class="col-sm-3 text-right">          
                            <input type="button" class="rma btn btn-fill btn-danger btn-wd" value="Remove All">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="to">To:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="to" id="to" rows="2" cols="2" style="background-color:Black; color:Lime;" readonly=""> </textarea> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="id2">Message Id:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="id2"  name="id2" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="fn">Message By:</label>
                          <div class="col-sm-9">          
                            <input type="text" class="form-control border-input" id="fn"  name="fn" value="<?php echo $user; ?>" style="background-color:Black; color:Lime;" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="msg">Content:</label>
                          <div class="col-sm-9">          
                            <textarea class="form-control border-input"  name="msg" id="msg" rows="3" cols="3"> </textarea> 
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="control-label col-sm-3" for="rd">On Date:</label>
                          <div class="col-sm-9">          
                            <input type="date" class="form-control border-input" name="rd" id="rd">
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