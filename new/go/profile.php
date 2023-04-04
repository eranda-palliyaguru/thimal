<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PROFILE</title>

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
                            <h1>PROFILE</h1>
                        </div>

                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->

            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                            <?php $id=$_GET['id'];
             
             $result = $db->prepare("SELECT * FROM customer WHERE customer_id='$id' ");
             $result->bindParam(':userid', $res);
             $result->execute();
             for($i=0; $row = $result->fetch(); $i++){ 
                if($row['type'] =="1"){$type='<span class="badge badge-success">Channel</span>';}
                if($row['type'] =="2"){$type='<span class="badge badge-warning">Commercial</span>';}
                if($row['type'] =="3"){$type='<span class="badge badge-danger">Apartment</span>';}
            
             ?>
                            <!-- Profile Image -->
                            <div class="card card-yellow card-outline">
                                <div class="card-body box-profile">
                                    <h3 class="profile-username text-center"><?php echo $row['customer_name']; ?></h3>

                                    <p class="text-muted text-center"><?php echo $type; ?></p>

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Total Sales</b> <a
                                                class="float-right">Rs.<?php 
                                            $result1 = $db->prepare("SELECT sum(amount) FROM sales WHERE customer_id='$id' AND action='1' ");
                                            $result1->bindParam(':userid', $res);
                                            $result1->execute();
                                                for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format( $row1['sum(amount)'],2); } ?></a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Cash</b> <a class="float-right">
                                                Rs.<?php 
                                            $result1 = $db->prepare("SELECT sum(amount) FROM payment WHERE customer_id='$id' AND action >'0' AND type='cash' AND invoice_no >'0' ");
                                            $result1->bindParam(':userid', $res);
                                            $result1->execute();
                                                for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format( $row1['sum(amount)'],2); } ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>CHQ</b> <a class="float-right">
                                                Rs.<?php 
                                            $result1 = $db->prepare("SELECT sum(amount) FROM payment WHERE customer_id='$id' AND action >'0' AND type='chq' AND invoice_no >'0' ");
                                            $result1->bindParam(':userid', $res);
                                            $result1->execute();
                                                for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format( $row1['sum(amount)'],2); } ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Credit</b> <a class="float-right">
                                                Rs.<?php 
                                            $result1 = $db->prepare("SELECT sum(amount) FROM payment WHERE customer_id='$id' AND action >'0' AND type='credit' AND invoice_no >'0' ");
                                            $result1->bindParam(':userid', $res);
                                            $result1->execute();
                                                for($i=0; $row1 = $result1->fetch(); $i++){ echo number_format( $row1['sum(amount)'],2); } ?>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->

                            <!-- About Me Box -->
                            <div class="card card-yellow">
                                <div class="card-header">
                                    <h3 class="card-title">About Me</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-phone mr-1"></i> Contact No</strong>

                                    <p class="text-muted"><?php echo $row['contact'] ?></p>

                                    <hr>

                                    <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                                    <p class="text-muted"><?php echo $row['address'] ?> </p>

                                    <hr>

                                    <strong><i class="fas fa-pencil-alt mr-1"></i>Type</strong>

                                    <p class="text-muted">
                                        <?php echo $type; ?>
                                    </p>

                                    <hr>
                                    <strong><i class="fas fa-users mr-1"></i>GROUP</strong>

                                    <p class="text-muted">
                                        <?php $cat_id=$row['category'];
                                        $result1 = $db->prepare("SELECT * FROM customer_category WHERE id='$cat_id' ");
                                        $result1->bindParam(':userid', $res);
                                        $result1->execute();
                                            for($i=0; $row1 = $result1->fetch(); $i++){ echo $row1['name']; }?>
                                    </p>

                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card card-yellow">
                                <div class="card-header">
                                    <h3 class="card-title">About Accountant</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <strong><i class="fas fa-user mr-1"></i>Name</strong>

                                    <p class="text-muted"><?php echo $row['acc_name'] ?></p>

                                    <hr>

                                    <strong><i class="fas fa-phone mr-1"></i> Contact No</strong>

                                    <p class="text-muted"><?php echo $row['acc_no']; ?></p>







                                </div>
                                <!-- /.card-body -->
                            </div>
                            <?php 
                            $pr12=$row['price_12'];
                            $pr37=$row['price_37'];
                            $pr5=$row['price_5'];
                            $pr2=$row['price_2'];
                         } ?>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#price"
                                                data-toggle="tab">Price</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline"
                                                data-toggle="tab">Timeline</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings"
                                                data-toggle="tab">Settings</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="price">
                                            <!-- Post -->
                                            <div class="post">
                                                <div class="row">
                                                <?php $result = $db->prepare("SELECT * FROM products WHERE    product_id < '5' ORDER by product_id ASC");			
				                                   $result->bindParam(':userid', $date);
                                                   $result->execute();
                                                   for($i=0; $row = $result->fetch(); $i++){ 
				                                   $proid=$row['product_id']; $price=0;
                                                   if($proid==1){$pr_type=$pr12;}
                                                   if($proid==2){$pr_type=$pr5;}
                                                   if($proid==3){$pr_type=$pr37;}
                                                   if($proid==4){$pr_type=$pr2;}

                                                   if($pr_type==0){$pr_name="Dealer Price"; $price=$row['price'];}
                                                   else{$pr_name="Sell Price";$price=$row['sell_price'];}
		                                           ?>

                                                <div class="col-md-3 col-sm-3 col-xs-3">
                                                    <div class="info-box">
                                                        <span class="info-box-icon bg-yellow"><img
                                                                src="../../<?php echo $row['img'];?>"
                                                                style="width: <?php echo $row['img_siz']-10;?>px"></span>

                                                        <div class="info-box-content">
                                                            <span><?php echo $row['gen_name'];?></span>
                                                            <span><?php echo $pr_name;?></span>
                                                            <span class="info-box-number">Rs.<?php echo  number_format($price,2); ?></span>
                                                        </div>
                                                        <!-- /.info-box-content -->
                                                    </div>
                                                    <!-- /.info-box -->
                                                </div>

                                                <?php }  ?>
                                                </div>
                                                
                                            </div>
                                            <!-- /.post -->

                                            <!-- Post -->
                                            <div class="post clearfix">
                                                <div class="user-block">
                                                    <h3>Special Price</h3>
                                                    
                                                </div>
                                                <!-- /.user-block -->
                                               <table class="table table-bordered table-striped"> 
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $cat_id=$row['category'];
                                                $result1 = $db->prepare("SELECT * FROM special_price WHERE customer_id='$id' ");
                                                $result1->bindParam(':userid', $res);
                                                $result1->execute();
                                                for($i=0; $row = $result1->fetch(); $i++){?>
                                                    <tr>
                                                        <td><?php echo $row['id'] ?></td>
                                                        <th><?php echo $row['product_name']; ?></th>
                                                        <th>Rs.<?php echo $row['price']; ?></th>
                                                    </tr>
                                                <?php } ?>
                                                </tbody>
                                               </table>

                                               
                                            </div>
                                            <!-- /.post -->

                                        </div>
                                        <!-- /.tab-pane -->
                                        <div class="tab-pane" id="timeline">
                                            <!-- The timeline -->
                                            <div class="timeline timeline-inverse">
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                    <span class="bg-danger">
                                                        10 Feb. 2014
                                                    </span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-envelope bg-primary"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                                        <h3 class="timeline-header"><a href="#">Support Team</a> sent
                                                            you an email</h3>

                                                        <div class="timeline-body">
                                                            Etsy doostang zoodles disqus groupon greplin oooj voxy
                                                            zoodles,
                                                            weebly ning heekya handango imeem plugg dopplr jibjab,
                                                            movity
                                                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo
                                                            kaboodle
                                                            quora plaxo ideeli hulu weebly balihoo...
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-user bg-info"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 5 mins
                                                            ago</span>

                                                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                                                            accepted your friend request
                                                        </h3>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-comments bg-warning"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 27 mins
                                                            ago</span>

                                                        <h3 class="timeline-header"><a href="#">Jay White</a> commented
                                                            on your post</h3>

                                                        <div class="timeline-body">
                                                            Take me to your leader!
                                                            Switzerland is small and neutral!
                                                            We are more like Germany, ambitious and misunderstood!
                                                        </div>
                                                        <div class="timeline-footer">
                                                            <a href="#" class="btn btn-warning btn-flat btn-sm">View
                                                                comment</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <!-- timeline time label -->
                                                <div class="time-label">
                                                    <span class="bg-success">
                                                        3 Jan. 2014
                                                    </span>
                                                </div>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <div>
                                                    <i class="fas fa-camera bg-purple"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="far fa-clock"></i> 2 days
                                                            ago</span>

                                                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded
                                                            new photos</h3>

                                                        <div class="timeline-body">
                                                            <img src="https://placehold.it/150x100" alt="...">
                                                            <img src="https://placehold.it/150x100" alt="...">
                                                            <img src="https://placehold.it/150x100" alt="...">
                                                            <img src="https://placehold.it/150x100" alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- END timeline item -->
                                                <div>
                                                    <i class="far fa-clock bg-gray"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="settings">
                                            <form class="form-horizontal">
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputName"
                                                            placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail"
                                                        class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputEmail"
                                                            placeholder="Email">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputName2"
                                                            placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputExperience"
                                                        class="col-sm-2 col-form-label">Experience</label>
                                                    <div class="col-sm-10">
                                                        <textarea class="form-control" id="inputExperience"
                                                            placeholder="Experience"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputSkills"
                                                        class="col-sm-2 col-form-label">Skills</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" id="inputSkills"
                                                            placeholder="Skills">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox"> I agree to the <a href="#">terms
                                                                    and conditions</a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit" class="btn btn-danger">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div><!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
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