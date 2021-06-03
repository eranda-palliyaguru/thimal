<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product Return</title>

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




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product Return</h1>
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
                <h3 class="card-title">Fill</h3>
              </div>
              <!-- /.card-header -->
              <?php
              if (isset($_GET['id'])) {
                $id=$_GET['id'];
                $result = $db->prepare("SELECT * FROM return_bill WHERE id='$id'  ");
                $result->bindParam(':userid', $loading);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                $id=$row['id'];
                 $cus_id=$row['customer_id'];
                 ?>
                 <div class="col-6">
                  <b> Customer Name</b>   <span class="badge bg-danger"><?php echo $row['customer_name']; ?></span><br>
                  <b>Issued date</b>   <span class="badge bg-danger"><?php echo $row['issue_date']; ?></span><br>
                  <b>Loading ID</b>   <span class="badge bg-danger"><?php echo $row['loading_id']; ?></span><br>
                  <b>Reason</b>   <span class="badge bg-info"><?php echo $row['reason']; ?></span><br>
                               </div>
               <?php } }else { ?>
              <form action="save/bill_return_save.php" method="post">
             <div class="row">
             <div class="col-md-3">
                              <div class="form-group">
                                <label>Customer</label>
                                <div class="input-group">
                                <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"   name="cus"  autofocus >
                                   <option >  </option>
                                  <?php 	$result = $db->prepare("SELECT customer_id,customer_name FROM customer   ");

                                  					$result->bindParam(':userid', $date);
                                                  $result->execute();
                                                  for($i=0; $row = $result->fetch(); $i++){ ?>
                                <option value="<?php echo $row['customer_id']; ?>" > <?php echo $row['customer_name']; ?> </option>
                              <?php } ?>
                                </select>
                       </div>	</div>	</div>

             <div class="col-md-3">
                       <div class="form-group">
                         <label>Collected Loading id</label>
                         <div class="input-group">
                         <select class="form-control select2" name="loading" >
                         <option >  </option>
                         <?php 	$result = $db->prepare("SELECT transaction_id,lorry_no FROM loading   ");

                                   $result->bindParam(':userid', $date);
                                         $result->execute();
                                         for($i=0; $row = $result->fetch(); $i++){ ?>
                       <option value="<?php echo $row['transaction_id']; ?>" > <?php echo $row['transaction_id']." _ ".$row['lorry_no']; ?> </option>
                     <?php } ?>
                         </select>
                 </div></div></div>
             </div>

             <div class="row">
               <div class="col-md-3">
               <div class="form-group">
                 <label>Return Invoice No</label>
               <div class="input-group">
              <input type="number" class="form-control" name="invo" value="">
                 </div>
                 </div></div>

                 <div class="col-md-3">
                 <div class="form-group">
                   <label>Reason</label>
                 <div class="input-group">
                <input type="text" class="form-control" name="reason" value="">
                   </div>
                   </div></div>

                   <div class="col-md-3">
                   <div class="form-group">
                     <label>Product Issued Date</label>
                   <div class="input-group">
                  <input type="text" class="form-control" name="date" value="">
                     </div>
                     </div></div>
             </div>


             <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;" type="submit">
             <i class="icon icon-search icon-large"></i> NEXT
             </button>
                </form>
<?php } ?>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
<?php if (isset($_GET['id'])) { $id=$_GET['id'];
  $result = $db->prepare("SELECT * FROM return_bill WHERE id='$id' AND action='1' ");

      $result->bindParam(':userid', $d1);
            $result->execute();
            for($i=0; $row = $result->fetch(); $i++){
$c_id=$row['id'];
            }


if (isset($c_id)) {
echo '<a href="bill_return.php"> <button type="button" class="btn btn-success" name="New Return">New Return</button> </a>';
}else {


  ?><a href="bill_return.php"> <button type="button" class="btn btn-success" name="New Return">New Return</button> </a>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Product </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">




<form method="post" action="save/bill_return_list_save.php">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Products</label>

                <input type="hidden" value='<?php echo $invoice=$_GET['id']; ?>'  name="id"  >




                      <select class="form-control select2" name="product" class="form-control"  data-placeholder="Select a Product" style="width: 100%;" autofocus >


                <?php
                      $result = $db->prepare("SELECT * FROM products  ");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                ?>
                <option value="<?php echo $row['product_id'];?>"><?php echo $row['gen_name']; ?>    </option>
                <?php
                }
                ?>
                      </select>
                </div>
                    </div>

<div class="col-md-2">
                <div class="form-group">
                     <label>QTY:</label>
                      <div class="input-group date">
                        <input type="number" class="form-control" min="0" value=''  name="qty"  required>
                      </div>
                </div></div>
                <div class="col-md-3">


                  <div class="form-group">
                       <label>Price (Per qty)</label>

                        <div class="input-group date">

                          <input type="number" class="form-control" min="0" value=''  name="price"  required>
                        </div>
                  </div></div>
                  <div class="col-md-1">


                    <div class="form-group">
                         <label>.</label><div class="input-group date">
                    <input class="btn btn-info" type="submit" value="Submit" >
                          </div>  </div>
               </div></div>
                </form>


<br>

                  <div class="box-body">
                               <table id="example2" class="table table-bordered table-hover">
                                 <thead>
                                 <tr>
                                   <th>Item Name</th>
                                   <th>QTY</th>
                                   <th>Current Price</th>
                                   <th>Price</th>
                                   <th>Total</th>
                           <th>#</th>

                                 </tr>
                                 </thead>
                                 <tbody>
                         <?php $tot=0;
                         $result = $db->prepare("SELECT * FROM return_bill_list WHERE return_id='$id' AND action='0' ");
                     $result->bindParam(':userid', $res);
                     $result->execute();
                     for($i=0; $row = $result->fetch(); $i++){

                   ?>
                                 <tr class="record" >
                                   <td><?php echo $row['product_name']; ?></td>
                                   <td><?php echo $row['qty']; ?> </td>
                                   <td><?php echo $row['current_price']; ?> </td>
                                   <td><?php echo $row['price']; ?> </td>
                                   <td><?php echo $row['total']; ?> </td>

                           <td> <a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click to Delete" >
                           <button class="btn btn-danger"><i class="icon-trash">x</i></button></a></td>

                                 </tr>
                         <?php $tot+=$row['total']; }
                         ?>


                          </tbody>

                               </table>
                               <h2>TOTAL Rs.<?php echo $tot; ?></h2>
                             </div>

              </div>
              <!-- /.card-body -->
            </div>
<?php if ($tot > 0) { ?>

<div class="col-md-4">
  <div class="alert alert-danger alert-dismissible">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                   This process is irreversible
                 </div> </div>

            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Payment</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">




<form method="post" action="save/bill_return_payment_save.php">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Payment Type</label>

                <input type="hidden" value='<?php echo $invoice=$_GET['id']; ?>'  name="id"  >




                      <select class="form-control select2" name="type" class="form-control"  id="p_type" onchange="view_payment_date(this.value);" style="width: 100%;" autofocus >
                <option value=""></option>
                <option value="credit">Credit invoice</option>
                <option value="">Cash</option>
                <option value="">CHQ</option>
                </select>
                </div>
                    </div>


                <div class="col-md-2" id="credit_view" style="display:none;">
                                <div class="form-group">
                                     <label>Invoice NO [credit amount]</label>
                                      <div class="input-group date">
                                        <select class="form-control select2" name="invoice" class="form-control"  style="width: 100%;" autofocus >
                                  <option value=""></option>
                                  <?php   $result = $db->prepare("SELECT * FROM payment WHERE customer_id='$cus_id' AND type='credit' AND action='2'  ");
                              $result->bindParam(':userid', $res);
                              $result->execute();
                              for($i=0; $row = $result->fetch(); $i++){ $bal=$row['amount']-$row['pay_amount'];?>
                                  <option value="<?php echo $row['transaction_id']; ?>" <?php if ($tot>$bal) { echo "disabled"; } ?>><?php echo $row['sales_id']; ?>  ___[Rs.<?php echo $row['amount']-$row['pay_amount']; ?>]</option>
                                <?php } ?>
                                  </select>
                                      </div>
                                </div></div>


                <div class="col-md-3" id="cash_view" style="display:none;">
                  <div class="form-group" >
                       <label>Amount</label>

                        <div class="input-group date">

                          <input type="number" class="form-control" min="0"   name="cash"  value="<?php echo $tot; ?>" disabled>
                        </div>
                  </div></div>



  <div class="col-md-5" id="chq_view" style="display:none;">
    <div class="row">


    <div class="form-group" >
         <label>Amount</label>

          <div class="input-group date">

            <input type="number" class="form-control" min="0"  name="amount"  value="<?php echo $tot; ?>" disabled>
          </div>
    </div>
    <div class="form-group" >
         <label>CHQ NO</label>

          <div class="input-group date">

            <input type="number" class="form-control" min="0" value=''  name="chq_no"  >
          </div>
    </div>
    <div class="form-group" >
         <label>CHQ Date ( <a style="color:red">YYYY-MM-DD</a> )</label>

          <div class="input-group date">

            <input type="text" class="js-date form-control" maxlength="10" value="<?php echo date('Y-m-d'); ?>"  name="chq_date" >
          </div>
    </div>


  </div>
    </div>

                  <div class="col-md-1">


                    <div class="form-group" id='buton' style="display:none;">
                         <label>.</label><div class="input-group date">
                    <input class="btn btn-info" type="submit" value="Submit" >
                          </div>  </div>
               </div></div>

               <input type="hidden" name="amount" value="<?php echo $tot; ?>">
                </form>


              </div>
              <!-- /.card-body -->
            </div>

          <?php } }  }?>
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


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../../../plugins/fullcalendar/fullcalendar.min.js"></script>





<script>

  $(function () {

    $('.select2').select2();
    $('.select2bs4').select2({
       theme: 'bootstrap4'
     })
//---------------------------------------------------------------------//

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

  });

  function view_payment_date(type){
   if(type=='credit'){
   document.getElementById('credit_view').style.display='block';
   document.getElementById('cash_view').style.display='none';
   document.getElementById('buton').style.display='block';
   document.getElementById('chq_view').style.display='none';
  } else if(type=='cash'){
     document.getElementById('cash_view').style.display='block';
     document.getElementById('credit_view').style.display='none';
     document.getElementById('buton').style.display='block';
     document.getElementById('chq_view').style.display='none';
   } else if(type=='chq'){
        document.getElementById('cash_view').style.display='none';
        document.getElementById('credit_view').style.display='none';
        document.getElementById('buton').style.display='block';
        document.getElementById('chq_view').style.display='block';
          }else {
     document.getElementById('cash_view').style.display='none';
     document.getElementById('credit_view').style.display='none';
     document.getElementById('buton').style.display='none';
     document.getElementById('chq_view').style.display='none';
       }
    }

  $(document).ready(function(){

  })


  var input = document.querySelectorAll('.js-date')[0];

  var dateInputMask = function dateInputMask(elm) {
    elm.addEventListener('keypress', function(e) {
      if(e.keyCode < 47 || e.keyCode > 57) {
        e.preventDefault();
      }

      var len = elm.value.length;

      // If we're at a particular place, let the user type the slash
      // i.e., 12/12/1212
      if(len !== 1 || len !== 3) {
        if(e.keyCode == 47) {
          e.preventDefault();
        }
      }

      // If they don't add the slash, do it for them...
      if(len === 4) {
        elm.value += '-';
      }

      // If they don't add the slash, do it for them...
      if(len === 7) {
        elm.value += '-';
      }
    });
  };

  dateInputMask(input);

</script>
<script src="jquery.tableTotal.js"></script>
</body>
</html>
