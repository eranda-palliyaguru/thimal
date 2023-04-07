<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CUSTOMERS</title>

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
                            <h1>CUSTOMER DATA</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php 
                $result = $db->prepare("SELECT count(customer_id) FROM customer WHERE action='0' ");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ echo $row['count(customer_id)']; }
                 ?></h3>

                                    <p>NUMBER OF CUSTOMER</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <a href="?id=all" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php 
                $result = $db->prepare("SELECT count(customer_id) FROM customer WHERE action='0' AND type='1' ");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ echo $row['count(customer_id)']; }
                 ?></h3>

                                    <p>Channel</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <a href="?id=1" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php 
                $result = $db->prepare("SELECT count(customer_id) FROM customer WHERE action='0' AND type='2' ");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ echo $row['count(customer_id)']; }
                 ?></h3>

                                    <p>Commercial</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-hotel"></i>
                                </div>
                                <a href="?id=2" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php 
                $result = $db->prepare("SELECT count(customer_id) FROM customer WHERE action='0' AND type='3' ");
                $result->bindParam(':userid', $res);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){ echo $row['count(customer_id)']; }
                 ?></h3>

                                    <p>Apartment</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-building"></i>
                                </div>
                                <a href="?id=3" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-12">


                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped"
                                        data-show-fullscreen="true">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>CUSTOMER NAME</th>
                                                <th>CONTACT NO</th>
                                                <th>ADDRESS</th>
                                                <th>TYPE</th>
                                                <?php $d1=$_GET["d1"]; $d2=$_GET["d2"];
                                                $result1 = $db->prepare("SELECT sales_list.name FROM sales LEFT JOIN sales_list ON sales.invoice_number=sales_list.invoice_no  WHERE sales.date BETWEEN '$d1' AND '$d2' GROUP BY sales_list.product_id ORDER BY sales_list.product_id ASC");
            $result1->bindParam(':userid', $d2);
                    $result1->execute();
                    for($i=0; $row = $result1->fetch(); $i++){
                  


          ?>
              <th  style="" ><span> <?php echo $row['name']; ?></span></th>
               <?php } ?>
                                                <th>#</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                  date_default_timezone_set("Asia/Colombo");
                  $id=$_GET['id'];

                  if($id=="all"){ 
                    $result2 = $db->prepare("SELECT * FROM customer  ORDER by customer_id DESC");
                  }else{
                    $result2 = $db->prepare("SELECT * FROM customer WHERE  type='$id'  ORDER by customer_id DESC");
                  }

                    $result2->bindParam(':userid', $d2);
                    $result2->execute();
                    for($i=0; $row = $result2->fetch(); $i++){
                        if($row['action'] =="0"){$action='<span class="badge badge-success">Active</span>';
                        }else{$action='<span class="badge badge-danger">Deactive</span>';}

                        if($row['type'] =="1"){$type='<span class="badge badge-success">Channel</span>';}
                        if($row['type'] =="2"){$type='<span class="badge badge-warning">Commercial</span>';}
                        if($row['type'] =="3"){$type='<span class="badge badge-danger">Apartment</span>';}
                        
                  ?>
                  <tr>
                    <td><?php echo $row['customer_id']; ?></td>
                    <td><?php echo $row['customer_name']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $type; ?></td>
                    <td><?php echo $action; ?></td>
                    <td>
                    <a href="profile.php?id=<?php echo $row['customer_id']; ?>" class="btn btn-primary btn-xs"><i class="fa fa-user"></i></a>
                    </td>
                  </tr>
                  <?php } ?>

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