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

if($r =='Cashier'){

include_once("sidebar2.php");
}
if($r =='admin'){

include_once("sidebar.php");
}

?>


    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
        <small>Preview</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

	
	
	<?php
		include('connect.php');
 date_default_timezone_set("Asia/Colombo");
 $cash=$_SESSION['SESS_FIRST_NAME'];

                  $date =  date("Y/m/d");					
			
				$result = $db->prepare("SELECT sum(amount) FROM sales WHERE    date='$date' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  $amount=$row['sum(amount)'];
				}
				



                $result = $db->prepare("SELECT sum(amount) FROM sales WHERE    date='$date' AND cashier='$cash' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  $amount_cash=$row['sum(amount)'];
				}		

				
				
				
				$result = $db->prepare("SELECT sum(amount) FROM sales WHERE    date='$date' AND cashier='Buddika' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  $bamount_cash=$row['sum(amount)'];
				}	




				

				
				
				
				
				$result = $db->prepare("SELECT * FROM customer  ");
				$result->bindParam(':userid', $date);
				$result->execute();
				$tre = $result->rowcount();
                
				
				
				
				date_default_timezone_set("Asia/Colombo");
				$date=date("Y/m/d");
				$month=date("Y/M");
				
			
				
				
			?>
	
	
	
	
	
	 <div class="row">
	 
	 
	 
	 
	 <?php     $r=$_SESSION['SESS_LAST_NAME'];

if($r =='Cashier'){
	?>
	 
	

 <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $amount1_cash; ?></h3>

              <p> My Total Interest</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $amount_cash; ?></sup></h3>

              <p>My Total Collection </p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $she_cash; ?></h3>

              <p>Today My Share Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
</div>

	
<?php }

else{
 ?>
	 
	 
	 
	 
	 
	
	 
	 
	 
	 
	 
	 
	 <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              
                
             
              <!-- /.widget-user-image -->
              <h2 class="widget-user-username">Nagoda Yard</h2>
              <h4 class="widget-user-desc"></h4>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked"><?php
			  $result = $db->prepare("SELECT * FROM products WHERE product_name>=1  ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  
					?>
                <form method="post" action="update_yard.php">
                 <li><?php echo $row['gen_name']; ?> <input  style="width:8" type="text" name="qty"  value="<?php echo $row['qty']; ?>" class="form-control pull-right"  >
                 <br>
                 <input type="hidden" name="yard"  value="1" class="form-control pull-right"  >
                 <input type="hidden" name="product_id"  value="<?php echo $row['product_id']; ?>" class="form-control pull-right"  >
                 <input class="btn btn-info" name="com" type="submit" valu="Submit" ></li>
                 </form>
                
                <?php } ?>
				<?php
			  $result = $db->prepare("SELECT * FROM products WHERE product_name='' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  
					?>
                <form method="post" action="update_yard.php">
                 <li><?php echo $row['gen_name']; ?> <input  style="width:8" type="text" name="qty"  value="<?php echo $row['qty']; ?>" class="form-control pull-right"  >
                 <br>
                 <input type="hidden" name="yard"  value="1" class="form-control pull-right"  >
                 <input type="hidden" name="product_id"  value="<?php echo $row['product_id']; ?>" class="form-control pull-right"  >
                 <input class="btn btn-info" name="com" type="submit" valu="Submit" ></li>
                 </form><?php } ?>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
		
		
		
		
		
		
		
		
		
		
		<div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
              <div class="widget-user-image">
                
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"> Payagala Yard</h3>
              <h5 class="widget-user-desc"></h5>
            </div>
            <div class="box-footer no-padding">
              <ul >
			  <?php
			  $result = $db->prepare("SELECT * FROM products WHERE product_name>=1  ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  
					?>
					<form method="post" action="update_yard.php">
                 <li><?php echo $row['gen_name']; ?> <input  style="width:8" type="text" name="qty"  value="<?php echo $row['qty2']; ?>" class="form-control pull-right"  >
                 <br>
                 <input type="hidden" name="yard"  value="2" class="form-control pull-right"  >
                 <input type="hidden" name="product_id"  value="<?php echo $row['product_id']; ?>" class="form-control pull-right"  >
                 <input class="btn btn-info" name="com" type="submit" valu="Submit" ></li>
                 </form>
                <?php } ?>
				<?php
			  $result = $db->prepare("SELECT * FROM products WHERE product_name='' ");
				
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
				  
				  
					?>
                 <form method="post" action="update_yard.php">
                 <li><?php echo $row['gen_name']; ?> <input  style="width:8" type="text" name="qty"  value="<?php echo $row['qty2']; ?>" class="form-control pull-right"  >
                 <br>
                 <input type="hidden" name="yard"  value="2" class="form-control pull-right"  >
                 <input type="hidden" name="product_id"  value="<?php echo $row['product_id']; ?>" class="form-control pull-right"  >
                 <input class="btn btn-info" name="com" type="submit" valu="Submit" ></li>
                 </form><?php } ?>
              </ul>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
		
		
		
		
		
	
		
		<?php } ?>
	



	
	
		
		
		
		
		
		 
		  
		  
		  
		  






		 </section> 
</div>
    </div>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->
  <?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../../plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>



 


<!-- page script
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#lineChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
      datasets: [
        {
          label: "Total Loan Amount",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [<?php  echo $m1; ?>, <?php  echo $m2; ?>, <?php  echo $m3; ?>, <?php  echo $m4; ?>, <?php  echo $m5; ?>, <?php  echo $m6; ?>, <?php  echo $m7; ?>, <?php  echo $m8; ?>, <?php  echo $m9; ?>, <?php  echo $m10; ?>, <?php  echo $m11; ?>, <?php  echo $m12; ?>] 
        },
       
		{
          label: "Total Collection",
          fillColor: "rgba(60,141,188,0.9)",
          strokeColor: "rgba(60,141,188,0.8)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(60,141,188,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [<?php  echo $m1t; ?>, <?php  echo $m2t; ?>, <?php  echo $m3t; ?>, <?php  echo $m4t; ?>, <?php  echo $m5t; ?>, <?php  echo $m6t; ?>, <?php  echo $m7t; ?>, <?php  echo $m8t; ?>, <?php  echo $m9t; ?>, <?php  echo $m10t; ?>, <?php  echo $m11t; ?>, <?php  echo $m12t; ?>]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: 700,
        color: "#f56954",
        highlight: "#f56954",
        label: "Chrome"
      },
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "IE"
      },
      {
        value: 400,
        color: "#f39c12",
        highlight: "#f39c12",
        label: "FireFox"
      },
      {
        value: 600,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Safari"
      },
      {
        value: 300,
        color: "#3c8dbc",
        highlight: "#3c8dbc",
        label: "Opera"
      },
      {
        value: 100,
        color: "#d2d6de",
        highlight: "#d2d6de",
        label: "Navigator"
      }
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
 -->
</body>
</html>
