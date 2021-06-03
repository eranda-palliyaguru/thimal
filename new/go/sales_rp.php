<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sales Report</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Select2 -->
<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include("hed.php"); ?>
  <?php include("sidebar.php"); ?>

  <style>
th
{
  vertical-align: bottom;
  text-align: center;
}

th span
{
  -ms-writing-mode: tb-rl;
  -webkit-writing-mode: vertical-rl;
  writing-mode: vertical-rl;
  transform: rotate(180deg);
  white-space: nowrap;
}
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sales Report</h1>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Add You Filter</h3>
              </div>
              <!-- /.card-header -->
              <form  method="get">
             <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

             <label>Date</label>



                    From :<input type="text" style="width:123px; padding:4px;" name="d1" id="datepicker" value="<?php echo $_GET['d1']; ?>" autocomplete="off" />
                    To:<input type="text" style="width:123px; padding:4px;" name="d2" id="datepickerd"  value="<?php echo $_GET['d2']; ?>" autocomplete="off"/>






                      </div>
             </div>

             <div class="col-md-6">
              <div class="form-group">
                <div class="input-group">
                <div class="input-group-addon">
                <label>customer</label>
                </div>
                <select class="form-control select2bs4" name="cus" style="width: 350px;" autofocus >
                <option value="all"> All Customer </option>

             <?php
                $result = $db->prepare("SELECT * FROM customer ORDER by customer_id ASC ");
             $result->bindParam(':userid', $res);
             $result->execute();
             for($i=0; $row = $result->fetch(); $i++){
             ?>
             <option value="<?php echo $row['customer_id'];?>"><?php echo $row['customer_id']."_".$row['customer_name']; ?>    </option>
             <?php
             }
             ?>
                </select>
             </div>
             </div></div>


             </div>


             <div class="row">



             <div class="col-md-3">
                              <div class="form-group">
                                <div class="input-group">
                                <div class="input-group-addon">
                                <label>Lorry</label>
                                 </div>
                                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"   name="lorry"  autofocus >
                                <option value="all"> All Lorry </option>

                         <?php
                                $result = $db->prepare("SELECT * FROM lorry ORDER by lorry_id ASC ");
                   $result->bindParam(':userid', $res);
                   $result->execute();
                   for($i=0; $row = $result->fetch(); $i++){
                 ?>
                   <option ><?php echo $row['lorry_no']; ?>    </option>
                 <?php
                       }
                     ?>
                                </select>
                       </div>	</div>	</div>

             <div class="col-md-3">
                       <div class="form-group">
                         <div class="input-group">
                         <div class="input-group-addon">
                         <label>products</label>
                         </div>
                         <select class="form-control select2" name="product"  autofocus >
                         <option value="all"> All Customer </option>
                         <option value="1"> Gas </option>
                         <option value="2"> Cylinder </option>
                         <option value="3"> Accessory </option>

                         </select>
                 </div></div></div>


             <div class="col-md-3">
             <div class="form-group">
             <div class="input-group">
             <div class="input-group-addon">
             <b>Customer Type</b>
               </div>
               <select class="form-control select2" name="customer_type"  >
                   <option value="all">All Customer</option>
                   <option value="1">Channel</option>
                   <option value="2">commercial</option>
                   <option value="3">Apartment</option>
                   </select>
               </div>
               </div></div>


             </div>

             <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
             <i class="icon icon-search icon-large"></i> Search
             </button>



             <br>


                </form>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped" data-show-fullscreen="true">
                  <thead>


                    <tr>


                      <th>Invoice</th>
                      <th>Date AND Lorry</th>
                      <th>Customer</th>

               <th  >12.5kg</th>
               <th  >5kg</th>
                <th  >37.5kg</th>

              <th  >2kg</th>
               <?php
              $qty=0;

            $result1 = $db->prepare("SELECT * FROM products WHERE  product_id>='9' ORDER by product_id ASC");
            $result1->bindParam(':userid', $d2);
                    $result1->execute();
                    for($i=0; $row = $result1->fetch(); $i++){
                  $id=$row['product_id'];


          ?>
              <th  style="" ><span> <?php echo $row['gen_name']; ?></span></th>
               <?php } ?>


              <th>Pay Type</th>
              <th>Chq Date</th>
              <th>Amount</th>
              <th>Margin</th>
                    </tr>



                    </thead>

                  <tbody>
                    <?php
                  date_default_timezone_set("Asia/Colombo");
                  $hh=date("Y/m/d");
                  $tot=0;	$tot_f=0; $cash_pay=0; $chq_pay=0; $credit_pay=0; $cash_pay1=0; $chq_pay1=0; $credit_pay1=0;

                  $e12=''; $e5=''; $e32=''; $e2='';  $g12=''; $g5=''; $g32=''; $g2='';


                    $d1=$_GET['d1'];
                    $d2=$_GET['d2'];
                    $cus_id=$_GET['cus'];
                    $lorry =$_GET['lorry'];
                    $product =$_GET['product'];
                    $cus_type =$_GET['customer_type'];


                  if($product=='all'){ $pro1='0'; $pro2='50'; }
                  if($product=='1'){$pro1='0'; $pro2='5'; }
                  if($product=='2'){$pro1='4'; $pro2='9'; }
                  if($product=='3'){$pro1='9'; $pro2='50'; }


                  if($cus_id=="all"){

                  if($lorry=="all"){ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
                  }else{ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and lorry_no='$lorry' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
                  }



                  $cus=">0";

                  }else{
                  if($lorry=="all"){ $result2 = $db->prepare("SELECT * FROM sales WHERE  customer_id='$cus_id' and action='1' and date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
                  }else{ $result2 = $db->prepare("SELECT * FROM sales WHERE  action='1' and lorry_no='$lorry' and customer_id='$cus_id' AND date BETWEEN '$d1' and '$d2' ORDER by transaction_id DESC");
                  }
                  $cus="=".$cus_id;
                  }



                    $result2->bindParam(':userid', $d2);
                    $result2->execute();
                    for($i=0; $row2 = $result2->fetch(); $i++){
                    $invo=$row2['invoice_number'];
                    $customer_id=$row2['customer_id'];


                  $emty_miter=0;
                    $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id > '$pro1' AND product_id < '$pro2' and  action='0' ");

                        $result->bindParam(':userid', $d1);
                              $result->execute();
                              for($i=0; $row = $result->fetch(); $i++){
                   $emty_miter = $row['qty'];
                      }
                  $cus_t=0;
                  if ($cus_type=="all") {$result = $db->prepare("SELECT * FROM customer WHERE  customer_id='$customer_id'  ");}else {
                  $result = $db->prepare("SELECT * FROM customer WHERE  customer_id='$customer_id' AND type='$cus_type'  ");
                  }
                          $result->bindParam(':userid', $d1);
                                $result->execute();
                                for($i=0; $row = $result->fetch(); $i++){
                     $cus_t = $row['customer_id'];
                        }

                  if($emty_miter > 0){
                  if($cus_t > 0){

                  ?>
                            <tr>

                    <td><?php echo $row2['transaction_id'];?></td>
                    <td><?php echo $row2['date'];?>
                  <span class="pull-right badge bg-green"><?php echo $row2['lorry_no'];?> </span>
                    </td>
                              <td><?php echo $row2['name'];?></td>

                  <?php
                      $ter=4;

                    for($pro_id1 = 0; $pro_id1 < (int)$ter; $pro_id1++) {
                          $pro_id=$pro_id1+1;
                    $pro_id_e=$pro_id1+5;
                  ?>



                    <td><span class="pull-right badge bg-muted"><?php

                  $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id_e' AND action='0' ");

                      $result->bindParam(':userid', $d1);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                  echo $row['qty'];


                  if ($pro_id_e=='5') { $e12+=$row['qty']; }
                  if ($pro_id_e=='6') { $e5+=$row['qty']; }
                  if ($pro_id_e=='7') { $e32+=$row['qty']; }
                  if ($pro_id_e=='8') { $e2+=$row['qty']; }
                    }
                  ?></span>
                  <span class="pull-right badge bg-yellow"><?php

                  $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' AND action='0' ");

                      $result->bindParam(':userid', $d1);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                  echo $row['qty'];

                  if ($pro_id=='1') { $g12+=$row['qty']; }
                  if ($pro_id=='2') { $g5+=$row['qty']; }
                  if ($pro_id=='3') { $g32+=$row['qty']; }
                  if ($pro_id=='4') { $g2+=$row['qty']; }
                    }
                  ?></span></td>
                      <?php } ?>
                  <?php
                  $result111212 = $db->prepare("SELECT * FROM products WHERE product_id >'9' ");

                  $result111212->bindParam(':userid', $d1);
                      $result111212->execute();
                      for($i=0; $row111212 = $result111212->fetch(); $i++){
                  $pro_id= $row111212['product_id'];




                  ?>



                    <td><span class="pull-right badge bg-muted"><?php

                  $result = $db->prepare("SELECT * FROM sales_list WHERE  invoice_no='$invo' and product_id='$pro_id' AND action='0' ");

                      $result->bindParam(':userid', $d1);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                  echo $row['qty'];
                    }
                  ?></span></td>

                      <?php } ?>

                  <?php

                  $result = $db->prepare("SELECT * FROM payment WHERE  invoice_no='$invo' ");

                      $result->bindParam(':userid', $d1);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                  $type= $row['type'];
                  $ch_date=$row['chq_date'];
                    }

                    $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'credit' AND action > '0'  ");
                    $result->bindParam(':userid', $d1);
                          $result->execute();
                          for($i=0; $row = $result->fetch(); $i++){
                    $credit_pay1= $row['sum(amount)'];
                    }
                    $credit_pay+= $credit_pay1;

                    $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'cash' AND action > '0'  ");
                      $result->bindParam(':userid', $d1);
                            $result->execute();
                            for($i=0; $row = $result->fetch(); $i++){
                    $cash_pay1=$row['sum(amount)'];
                    }
                    $cash_pay+=$cash_pay1;

                    $result = $db->prepare("SELECT sum(amount) FROM payment WHERE  invoice_no='$invo' AND type = 'chq' AND action > '0'  ");
                        $result->bindParam(':userid', $d1);
                              $result->execute();
                              for($i=0; $row = $result->fetch(); $i++){
                    $chq_pay1= $row['sum(amount)'];
                      }
                      $chq_pay+= $chq_pay1;
                  ?>

                  <td><?php echo $type;?></td>
                  <td><?php echo $ch_date;?></td>


                  <td><?php echo $row2['amount'];?></td>
                  <td><?php echo $row2['profit'];?>
                  <a href="bill2.php?id=<?php echo $row2['invoice_number'];?>"   title="Click to pay" >
                      <button class="btn btn-primary">View</button></a></td>


                    <?php
                  $tot+=$row2['amount'];
                  $tot_f+=$row2['profit'];

                  } } }


                  ?>
                    </tr>
                  
                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>


<!-- select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>


<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->

<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>

<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>

<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>

<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>


<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="../plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap4 Duallistbox -->
<script src="../../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>


<script>
  $(function () {

    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,"select": true,

      dom: 'Bfrtip',
       buttons: [
           {
               extend: 'print',
               customize: function ( win ) {
                   $(win.document.body)
                       .css( 'font-size', '8pt' )


                   $(win.document.body).find( 'table' )
                       .addClass( 'compact' )
                       .css( 'font-size', 'inherit' );
               }
           }
       ,'pdf','colvis']

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
//--------------------------------------------------------------

//-------------------------------------------------
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });


    $('#example').DataTable( {
         dom: 'Bfrtip',
         buttons: [
             {
                 extend: 'print',
                 customize: function ( win ) {
                     $(win.document.body)
                         .css( 'font-size', '10pt' )
                     $(win.document.body).find( 'table' )
                         .addClass( 'compact' )
                         .css( 'font-size', 'inherit' );
                 }
             }
         ]
     } );



  $('.select2').select2();
  $('.select2bs4').select2({
     theme: 'bootstrap4'
   })
  });
  $(document).ready(function(){

  })
</script>
<script src="jquery.tableTotal.js"></script>
</body>
</html>
