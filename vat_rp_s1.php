<!DOCTYPE html>
<html>
<?php
include("head.php");
include("connect.php");
?>

<body class="hold-transition skin-blue sidebar-mini">
    <?php
include_once("auth.php");
$r=$_SESSION['SESS_LAST_NAME'];
$user_lewal=$_SESSION['USER_LEWAL'];
if($r =='Cashier'){

header("location:./../../../index.php");
}
if($r =='admin'){

include_once("sidebar.php");
}
?>




    <link rel="stylesheet" href="datepicker.css" type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(function() {
        $("#datepicker1").datepicker({
            dateFormat: 'yy/mm/dd'
        });
        $("#datepicker2").datepicker({
            dateFormat: 'yy/mm/dd'
        });

    });
    </script>




    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
            VAT SCHEDULE 01
                <small>Preview</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Forms</a></li>
                <li class="active">Advanced Elements</li>
            </ol>
        </section>

        <br>


        <form action="" method="get">
            <center>





                From :<input type="text" style="width:223px; padding:4px;" name="d1" id="datepicker" value=""
                    autocomplete="off" />
                To:<input type="text" style="width:223px; padding:4px;" name="d2" id="datepickerd" value=""
                    autocomplete="off" />

              

                <button class="btn btn-info" style="width: 123px; height:35px; margin-top:-8px;margin-left:8px;"
                    type="submit">
                    <i class="icon icon-search icon-large"></i> Search
                </button>



                <br>



            </center>
        </form>


        <section class="content">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> Sales VAT <a
                            href="vat_rp_s1_print.php?d1=<?php echo $_GET['d1'] ?>&d2=<?php echo $_GET['d2'] ?>"
                            title="Click to Print">
                            <button class="btn btn-danger">Print</button></a></h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Serial No </th>
                                <th>Invoice Date</th>
                                <th> Tax Invoice No</th>
                                <th>Purchaser's TIN</th>
                                <th>Name of the Purchaser</th>
                                <th>Description </th>
                                <th>Value of supply</th>
                                <th>VAT Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                               include("connect.php");
				                $d1=$_GET['d1'];
				                $d2=$_GET['d2'];
                                $tot=0;$vat=0;
                                $result1 = $db->prepare("SELECT * FROM sales JOIN customer ON sales.customer_id=customer.customer_id WHERE  sales.action='1' AND sales.date BETWEEN '$d1' and '$d2' ");
                                $result1->bindParam(':userid', $c);
                                $result1->execute();
                                for($i=0; $row = $result1->fetch(); $i++){
                                    list($y, $m,$d) = explode('-', $row['date']);
                                    $date=$m.'-'.$d.'-'.$y;
                                			?>

                            <tr>
                                <td><?php echo $i+1;?></td>
                                <td><?php echo $date;?></td>
                                <td><?php echo $row['transaction_id'];?></td>
                                <td><?php echo $row['vat_no'];?></td>
                                <td><?php echo $row['name'];?></td>
                                <td>Refill Gas and related items</td>
                                <td><?php echo number_format(($row['amount']/118)*100,2);?></td>
                                <td><?php echo number_format(($row['amount']/118)*18,2) ; ?></td>

                            </tr>
                            <?php $tot+=($row['amount']/118)*100; $vat+=($row['amount']/118)*18; }   ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <td colspan="6"></td>
                            <td>Rs.<?php echo number_format($tot,2);?></td>
                            <td>Rs.<?php echo number_format($vat,2);?></td>
                        </tfoot>
                    </table>






                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
    </div>
    <!-- /.col -->





    <!-- Main content -->

    <!-- /.row -->

    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

    <script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- page script -->
    <script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });

        $(".select2").select2();

    });


    $('#datepicker').datepicker({
        autoclose: true,
        datepicker: true,
        format: 'yyyy-mm-dd '
    });
    $('#datepicker').datepicker({
        autoclose: true
    });



    $('#datepickerd').datepicker({
        autoclose: true,
        datepicker: true,
        format: 'yyyy-mm-dd '
    });
    $('#datepickerd').datepicker({
        autoclose: true
    });
    </script>
</body>

</html>