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



                    From :<input type="date" style="width:123px; padding:4px;" name="d1" id="datepicker" value="<?php echo $_GET['d1']; ?>" autocomplete="off" />
                    To:<input type="date" style="width:123px; padding:4px;" name="d2" id="datepickerd"  value="<?php echo $_GET['d2']; ?>" autocomplete="off"/>






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
               <?php
               $d1=$_GET['d1'];
               $d2=$_GET['d2'];
               $cus_id=$_GET['cus'];
               $lorry =$_GET['lorry'];
               $product =$_GET['product'];
               $cus_type =$_GET['customer_type'];
              $qty=0;


            $result1 = $db->prepare("SELECT sales_list.name , sales_list.product_id FROM sales INNER JOIN sales_list ON sales.invoice_number=sales_list.invoice_no  WHERE sales.action='1' AND  sales.date BETWEEN '$d1' AND '$d2' GROUP BY sales_list.product_id ORDER BY sales_list.product_id ASC");
            $result1->bindParam(':userid', $d2);
                    $result1->execute();
                    for($i=0; $row = $result1->fetch(); $i++){
                  $product_row[]=$row['product_id'];

          ?>
              <th  style="" ><span> <?php echo $row['name']; ?></span></th>
               <?php } ?>
              <th>Amount</th>
              <th>#</th>
                    </tr>



                    </thead>

                  <tbody>
                    <?php
                  date_default_timezone_set("Asia/Colombo");
                  $hh=date("Y/m/d");


                    $d1=$_GET['d1'];
                    $d2=$_GET['d2'];
                    $cus_id=$_GET['cus'];
                    $lorry =$_GET['lorry'];
                    $product =$_GET['product'];
                    $cus_type =$_GET['customer_type'];

                    if($cus_type=="all"){$cus_type_q="";}else{ $cus_type_q="";}
                    if($cus_id=="all"){$cus_id_q="";}else{$cus_id_q="sales.customer_id='".$cus_id."' AND ";}



                    $result2 = $db->prepare("SELECT sales.transaction_id,sales.invoice_number , sales.name, sales.date, sales.amount FROM sales  WHERE  $cus_id_q  sales.action='1' and sales.date BETWEEN '$d1' and '$d2' ");
                    $result2->bindParam(':userid', $d2);
                    $result2->execute();
                    for($i=0; $row2 = $result2->fetch(); $i++){
                      $invo=$row2['invoice_number'];
                      $data[]=0;

                    $result3 = $db->prepare("SELECT qty , product_id FROM sales_list  WHERE invoice_no='$invo' ");
                    $result3->bindParam(':userid', $d2);
                    $result3->execute();
                    for($i=0; $row3 = $result3->fetch(); $i++){
                     $data[$row3['product_id']]=$row3['qty'];
                    }
                    
                  
                  ?>
                    <tr>

                    <td><?php echo $row2['transaction_id'];?></td>
                    <td><?php echo $row2['date'];?></td>
                    <td><?php echo $row2['name'];?></td>
                    
                    <?php 
                    sort($product_row);
                    $arrlength = count($product_row);
                    for($x = 0; $x < $arrlength; $x++) {  ?>
                    <td  <?php if(1 < 5){echo "style='background-color: #F39C12;'";} ?> ><?php echo $data[$product_row[$x]]; ?></td>
                    <?php unset($data[$product_row[$x]]); } ?>
                    <td><?php echo $row2['amount']; ?></td>
                    <td></td>
                   
                    </tr>
                    <?php }  ?>
                  
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
