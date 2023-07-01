<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Margin Report</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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

<body class="sidebar-mini sidebar-collapse sidebar-closed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("hed.php"); ?>
        <?php include("sidebar.php"); ?>

        <style>
        th {
            vertical-align: bottom;
            text-align: center;
        }

        th span {
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
                            <h1>Margin Report</h1>
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
                                <form method="get">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label>Date</label>



                                                From :<input type="date" style="width:123px; padding:4px;" name="d1"
                                                    id="datepicker" value="<?php echo $_GET['d1']; ?>"
                                                    autocomplete="off" />
                                                To:<input type="date" style="width:123px; padding:4px;" name="d2"
                                                    id="datepickerd" value="<?php echo $_GET['d2']; ?>"
                                                    autocomplete="off" />






                                            </div>
                                        </div>




                                    </div>




                                    <button class="btn btn-info"
                                        style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;"
                                        type="submit">
                                        <i class="icon icon-search icon-large"></i> Search
                                    </button>



                                    <br>


                                </form>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Sales DataTable </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped"
                                        data-show-fullscreen="true">
      			<tr >
              <th style="background-color:#aba272"></th>
      				<th colspan="3" style="background-color:#aba272"><center>Dealer Kaluthara</center></th>
              <th colspan="3"style="background-color:#aba272" ><center>Dealer Colombo</center></th>
              <th colspan="3"style="background-color:#aba272"><center>Selling</center></th>
      				<th colspan="3"style="background-color:#aba272"><center>Discount</center></th>
              <th colspan="3"style="background-color:#aba272"><center>Total</center> </th>
                   </tr>

                    <tr>
                      <th style="background-color:#aba272">Product Name</th>
                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                      <th style="background-color:rgba(191,161,6,0.42)">QTY</th>
              				<th style="background-color:rgba(191,161,6,0.73)">Value</th>
                      <th style="background-color:#bfa106">Margin</th>

                            </tr>
      		<?php
          $d1=$_GET['d1'];
          $d2=$_GET['d2'];
      		$total=0;
      		//$invo=$_GET['id'];
$or_d1=$d1;
$margin_total=0;
          $result1 = $db->prepare("SELECT * FROM products  ORDER by product_id ASC");
  				$result1->bindParam(':userid', $d2);
          $result1->execute();
          for($i=0; $row1 = $result1->fetch(); $i++){
          $tebal_id=$row1['product_id'];
          $price=$row1['price'];
          $price2=$row1['price2'];
          $price_o=$row1['o_price'];
        //  $area=$row1['area'];
        $dealer=0;$dealer1=0; $dealer_qty=0;$dealer_qty1=0; $sell=0;$sell_val=0;  $dis=0;$dis_val=0; $sell_m=0;$dis_m=0;$dis_m1=0; $dealer_m=0;  $dealer_m1=0; $sell_v1=0;

                  $result1122 = $db->prepare("SELECT * FROM price_update WHERE product_id='$tebal_id'  ORDER BY id ASC ");
                  $result1122->bindParam(':userid', $invo);
                  $result1122->execute();
                  for($i=0; $row1122 = $result1122->fetch(); $i++){

include("../../sales_all_rp_price_update.php");

              }

?>
<tr>
       <td style="background-color:#aba272"> <a href="pnl_product.php?d1=<?php echo $d1 ?>&d2=<?php echo $d2 ?>&pro=<?php echo $row1['product_id']; ?> "> <?php echo $row1['gen_name']; ?> </a></td>

  <!------------------------------------------------------------------------------ Kaluthara ---------------------------------------------------------------------->
       <td style="background-color:rgba(191,161,6,0.42)">
         <?php $dealer_qty_s=0;
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dealer_qty_s=$row['sum(qty)'];}

            echo $dealer_qty+$dealer_qty_s;

       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND area='2' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){  $dealer_s  = $row['sum(amount)'];  }
         echo number_format($dealer+$dealer_s,2);

           $dma=$dealer_s-($price_o*$dealer_qty_s);
       ?></td>

       <td style="background-color:#bfa106"> <?php     echo number_format($dealer_m=$dma+$dealer_m,2);   ?></td>

  <!------------------------------------------------------------------------------ Colombo ---------------------------------------------------------------------->
       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND  price = '$price' AND  price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dealer_qty1_s=$row['sum(qty)'];}
        echo  $dealer_qty1+$dealer_qty1_s;



       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id'   AND  price = '$price' AND price_id='0' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){  $dealer1_s= $row['sum(amount)']; }
        echo $dealer1+$dealer1_s;


        $dma1=$dealer1_s-($price_o*$dealer_qty1_s);
       ?></td>

       <td style="background-color:#bfa106"> <?php  echo number_format($dealer_m1=$dma1+$dealer_m1,2);  ?></td>



  <!------------------------------------------------------------------------------ Selling ---------------------------------------------------------------------->
       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0'  AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $sell_s=$row['sum(qty)'];}
            echo $sell+$sell_s;
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0'  AND price > '$price2' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $sell_val_s=$row['sum(amount)']; }
            echo number_format($sell_val+$sell_val_s,2);

            $sell_ma=$sell_val_s-($price_o*$sell_s)
       ?></td>

       <td style="background-color:#bfa106"> <?php  echo number_format($sell_m=$sell_m+$sell_ma,2);   ?></td>


  <!------------------------------------------------------------------------------------ Discount ------------------------------------------------------------------------------------->

       <td style="background-color:rgba(191,161,6,0.42)">
         <?php
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0' AND price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis_s=$row['sum(qty)'];}
            echo $dis=$dis+$dis_s;
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id' AND price_id='0' AND price < '$price' AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis_val_s=$row['sum(amount)'];}
            echo number_format($dis_val+$dis_val_s,2);

            $dis_ma=($price-$price_o)*$dis_s;
            $ma11=$dis_val_s-($price*$dis_s);
       ?></td>

       <td style="background-color:#bfa106"> <?php    echo number_format($dis_ma=$dis_ma+$dis_m1,2);   ?>(<?php   echo $ma11+$dis_m;   ?>)</td>

  <!-------------------------------------------------------------------------------------------- Total ------------------------------------------------------------------------------------>

       <td style="background-color:rgba(191,161,6,0.42)">
         <?php 				$d1=$_GET['d1'];
         				$d2=$_GET['d2'];
         $result = $db->prepare("SELECT sum(qty) FROM sales_list WHERE product_id='$tebal_id' AND    action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $dis1=$row['sum(qty)'];
            echo $row['sum(qty)']; }
       ?></td>
       <td style="background-color:rgba(191,161,6,0.73)">
         <?php
         $result = $db->prepare("SELECT sum(amount) FROM sales_list WHERE product_id='$tebal_id'  AND  action='0' AND date BETWEEN '$d1' and '$d2' ");
         $result->bindParam(':userid', $invo);
         $result->execute();
         for($i=0; $row = $result->fetch(); $i++){ $total+=$row['sum(amount)'];
            echo number_format($row['sum(amount)'],2); }
       ?></td>

       <td style="background-color:#bfa106"> <?php $margin_total+=$dealer_m+$dealer_m1+$sell_m+$dis_ma;   echo number_format($dealer_m+$dealer_m1+$sell_m+$dis_ma,2); // Margin total  ?></td>



      				 </tr>

      				 <?php
      			 }?>
             <tr>

               <td colspan="14"style="background-color:#aba272"><center>Total</center> </td>
               <td style="background-color:#aba272"> Rs.<?php   echo number_format($total,2); // Sales Value total  ?></td>
               <td style="background-color:#aba272"> Rs.<?php   echo number_format($margin_total,2); // Margin total  ?></td>
             </tr>
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
    $(function() {

        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": true,
            "select": true,

            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '8pt')


                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }, 'pdf', 'colvis']

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


        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                extend: 'print',
                customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '10pt')
                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                }
            }]
        });



        $('.select2').select2();
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
    $(document).ready(function() {

    })
    </script>
    <script src="jquery.tableTotal.js"></script>
</body>

</html>