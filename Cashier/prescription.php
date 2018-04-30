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
    <title>Prescription</title>
    <?php include_once('../common/header.php'); ?>
    <script type="text/javascript">
          $(document).ready(function(){

            $("#pform").on('submit',function(e){
                e.preventDefault();         
              $.ajax({  
                      url: "c-prescription-ajax.php?p=pa_insert",
                      type: "post",
                      data: new FormData(this),
                      cache: false,
                      contentType: false,
                      processData: false,
                      success: function(msg){
                          printRecipt();
                    }   
                  });
              });
            function printRecipt(){
                var id = $("#pa_id").val(); 
                $.ajax({
                url:"c-recipts-ajax.php?p=print",
                method:"post",
                data:{id:id},
                success:function(data){
                    $('#get-recipt').html(data);          
                  }
               });
            }
            $(document).on('keyup','.mname',function(){
                var mname = $(this).val();
                $.ajax({
                url:"c-prescription-ajax.php?p=mname1",
                method:"post",
                data:{mname},
                success:function(data){
                  $('#fetch-medicines').html(data);    
                  }
               });
            });
            $(document).on('click','.dadd',function(){

                var drug_id = $(this).attr("id");
                var pa_name = $("#pa_nm").val();
                var pa_id = $("#pa_id").val(); 
                var m_n = $("#nm").val();
                var m_t = $("#mt").val(); 
                var m_ct = $("#mct").val();
                var exp = $("#exp").val();
                var m_p = $("#mp").val(); 
                var m_av = $("#av").val();
                $.ajax({
                url:"c-prescription-ajax.php?p=tempo_insert",
                method:"post",
                data:{drug_id:drug_id,pa_name:pa_name,pa_id:pa_id,m_n:m_n,m_t:m_t,m_ct:m_ct,exp:exp,m_p:m_p,m_av:m_av},
                success:function(data){
                    displayDrug();
                  }
               });
            });
            $(document).on('click','.remove',function(){
                var id = $(this).attr("pid");
                $.ajax({
                url:"c-prescription-ajax.php?p=del",
                method:"post",
                data:{id:id},
                success:function(data){
                    displayDrug();
                  }
               });
            });
            function displayDrug(){
                var pa_id = $("#pa_id").val(); 
                $.ajax({
                    type:"GET",
                    url:"c-prescription-ajax.php?p=disp",
                    data:{pa_id},
                    success: function(result){
                        $("#pres").html(result);
                    }
                });
            }
            displayDrug();
            // setInterval(function(){
            //     displayDrug()
            // },3000);

            $("body").delegate(".qnty","keyup",function(event){

                event.preventDefault();
                var prodid=$(this).attr('pid');
                var item1=$("#qntyf-"+prodid).val();
                var price=$("#qnty-"+prodid).val();
                var total=item1*price;
                $('#amt-'+prodid).val(total);
            })
            $(document).on('keyup','.qnty',function(){
                calculateSum();
                var prodid=$(this).attr('pid');
                var amt=$('#amt-'+prodid).val();
                var qunt=$('#qnty-'+prodid).val();
                $.ajax({
                    type:"post",
                    url:"c-prescription-ajax.php?p=temp_update",
                    data:{prodid:prodid,amt:amt,qunt:qunt},
                    success: function(result){
                       
                    }
                });
            });
            $(document).on('mouseover','.qnty',function(){
                calculateSum();
                var prodid=$(this).attr('pid');
                var amt=$('#amt-'+prodid).val();
                var qunt=$('#qnty-'+prodid).val();
                $.ajax({
                    type:"post",
                    url:"c-prescription-ajax.php?p=temp_update",
                    data:{prodid:prodid,amt:amt,qunt:qunt},
                    success: function(result){
                       
                    }
                });
            });
            $(document).on('mouseover','.tab',function(){
                calculateSum();
            });
            function calculateSum(){
                    var sum = 0;
                    //iterate through each textboxes and add the values
                    $(".price").each(function(index,element) {
                    //add only if the value is number
                    var data = $(element).val();
                    // alert(data);
                    // exit();
                    if (!isNaN(this.value) && this.value.length != 0){
                        sum += parseFloat(this.value);
                    }
                    else if (this.value.length != 0){
                        $(this).css("background-color", "red");
                    }
                });
                $("#gtotal").val(sum.toFixed(2));
                $("#nettotal").val(sum.toFixed(2));
            }
        });
    </script>

    <style type="text/css">
        input[type="text"],
            select.form-control {
              background: transparent;
              border:none;
              border-bottom: 1px solid #000000;
              -webkit-box-shadow: none;
              box-shadow: none;
              border-radius: 0;
            }

            input[type="text"]:focus,
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

    <div class="main-panel">
		<?php include_once('manager-navbar.php'); ?>

		<div class="content">
            <div class="container-fluid">
                <div class="card">
					<div class="header">
                        <h4 class="title text-center">-: Prescription :-</h4>
                    </div> 
                    <div class="content" id="get-recipt">   
                        <form class="form-horizontal" method="post" action="get-recipt-page.php" enctype="multipart/form-data" id="pform">
                            <div class="col-sm-6 text-right">
                                <table>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Patient ID :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_id" id="pa_id" size="40px;"><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Patient Name :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_nm" id="pa_nm" size="40px;"><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Age :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_ag" size="40px;"><br>
                                        </td>
                                    </tr>
                                </table><br><hr>
                            </div>
                            <div class="col-sm-6 text-right">
                                <table>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Gender :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_gn" size="40px;"><br> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Refered By :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_refer" size="40px;"><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label style="font-size: 12px;">Disease Name :</label>
                                        </td>
                                        <td>
                                            <input type="text" name="pa_ds" size="40px;"><br>
                                        </td>
                                    </tr>
                                </table><br><hr>
                            </div>
                        <div class="form-group">
                              <label class="control-label col-sm-2" style="font-size: 12px;" for="mn">Enter Medicine Name :</label>
                              <div class="col-sm-9">          
                                <input type="text"  id="mn" name="mn" class="mname" style="font-size: 12px;">
                              </div>
                              <div class="col-sm-12" id="fetch-medicines" style="font-size:14px; margin-top:5px;">
                                
                              </div>
                        </div><hr>
                        <div id="pres">

                        </div><br>
                        <div class="form-group">
                          <div class="col-sm-offset-3 col-sm-6 text-center">
                            <input type="submit" class="btn btn-danger btn-fill" value="Get Invoice" id="submit" name="submit">
                          </div>
                        </div>
                    </form>  
                        
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