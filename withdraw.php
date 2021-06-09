<!DOCTYPE html>
<html>
	 <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.min.css">
  <link rel="stylesheet" href="../../plugins/fullcalendar/fullcalendar.print.css" media="print">
<?php
include("head.php");
include("connect.php");
date_default_timezone_set("Asia/Colombo");
?>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
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

<link rel="stylesheet" href="datepicker.css"
        type="text/css" media="all" />
    <script src="datepicker.js" type="text/javascript"></script>
    <script src="datepicker.ui.min.js"
        type="text/javascript"></script>
   <script src='js/jquery-1.12.3.js'></script>
 <script src='js/jquery.dataTables.min.js'></script>


    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Withdraw
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">Payment</li>
      </ol>
    </section>

    <!-- Main content -->
   <section class="content">
      <div class="row">

		<div class="col-md-2">

			 <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Withdraw Payment</h3>


		 	<div class="form-group">

		<form method="post" action="withdraw_save.php">
			<input type="hidden" value='' id="datepicker" name="source"  >
			<input type="hidden" value='' id="datepicker" name="chq_no"  >
        <div class="box-body">





              <div class="form-group">
                <label>Type</label>
  <select class="form-control " name="type" style="width: 100%;" id="p_type" onchange="view_payment_date(this.value);" autofocus tabindex="1" >
	                <option value="1" style="color: #A7A7A7">Select Type</option>
                    <option value="Chq">Chq</option>
					<option value="Bank">Bank to Bank Transfer</option>
                </select>
				</div>





              <div class="form-group">
				   <label>Amount</label>
                <input type="text" value='' name="amount" class="form-control" tabindex="2" >
                </div>






              <div class="form-group" >
                <label>Recipient</label>
               <input type="text" value=''  name="reci" class="form-control" tabindex="3">
				</div>



              <div class="form-group" >
                <label>Reason or Comment</label>
               <input type="text" value=''  name="com" class="form-control" tabindex="3">
				</div>


				<div id='chq_no' style="display:none;" >

              <div class="form-group">
               <label>Chq No.</label>
                <input type="number"   name="ch_no" class="form-control pull-right" >
                  </div>

		 <div class="form-group" >
               <label>Chq Date <b style="color: #DD0408">(YYYY-MM-DD)</b></label>
         <input data-provide="datepicker" data-date-format="yyyy-mm-dd" type="text" class="form-control pull-right" name="chq_date"   value="" autocomplete="off"/>
                  </div>


				  </div>

              <div class="form-group" id='source' style="display:none;">
                <label>Bank Name</label>
               <input type="text" value=''  name="bank" class="form-control pull-right" tabindex="3">
				</div>


			<div class="form-group" >
               <label>Issued Date <b style="color: #DD0408">(YYYY-MM-DD)</b></label>
         <input data-provide="datepicker" data-date-format="yyyy-mm-dd"  type="text" class="form-control pull-right" name="i_date"   value="<?php echo date("Y-m-d"); ?>" autocomplete="off"/>
                  </div>






			  <div class="form-group">




        </div>
      </div>


      <!-- /.box -->
<div class="form-group" id='buton' style="display:none;" >

			  <input class="btn btn-info" type="submit" value="Submit" >
			  </form>
			  </div></div></div></div>



		  </div>




        <!-- /.col -->
        <div class="col-md-10">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>

	   	<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Withdraw List</h3>


		 	<div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
				<th>ID</th>
				<th>Date</th>
				<th>Type</th>
				<th>Amount (Rs.)</th>
                <th>Bank</th>
				<th>CHQ No</th>
				<th>CHQ Date</th>
				<th>Balance</th>
                <th>#</th>
                </tr>
                </thead>
                <tbody>

<?php $result = $db->prepare("SELECT * FROM bank WHERE date='$date' and action='0' and type='5' or type='4'");

					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){


				echo '<tr class="record">';



					   ?>


               <td><?php echo $row['id'];   ?> </td>
	       <td><?php echo $row['date'];   ?> </td>
				<td><?php echo $row['type'];   ?> </td>
	<td>Rs.<?php echo $row['amount'];   ?></td>
					<td><?php echo $row['bank'];   ?></td>
				<td><?php echo $row['chq_no'];   ?></td>
				<td><?php echo $row['chq_date'];   ?></td>
              <td><?php echo $row['balance'];   ?></td>
<td>

<a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click to Delete" >
				  <button class="btn btn-danger"><i class="icon-trash">x</i></button></a>
</td>
                </tr>


				<?php }   ?>
				</tbody>

              </table>
		</div></div></div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
          <!-- /.box -->



    <!-- /.content -->
  </div>

  <!-- /.content-wrapper -->
    <?php
  include("dounbr.php");
?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<script src="js/jquery.js"></script>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->


<!-- ./wrapper -->





<!-- bootstrap datepicker -->
<script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>

<script src="../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Slimscroll -->
<script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- bootstrap color picker -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="../../plugins/fullcalendar/fullcalendar.min.js"></script>

<script>



  $(function () {
    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
		<?php $result = $db->prepare("SELECT * FROM bank WHERE action='0' AND type > '2'  ");
					$result->bindParam(':userid', $date);
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
		  $date=$row['chq_date'];
		  $type=$row['type'];
		  $action=$row['chq_action'];
		  $receive=$row['receive'];
		  $split =  explode("-", $date);
		    $y= $split[0];
			$m= $split[1];
			$d= $split[2];
		  ?>

        {
		  title: '<?php echo $row['amount']."-".$row['receive']; ?>',
          start: '<?php echo $y." ,".$m," ,".$d;?>',
          backgroundColor:"<?php if($type=='5'){echo "#002091";} ?><?php if($type=='3'){echo "#f39c12";}  if($type=='4'){echo "#690dde";} if($type=='6'){echo "#d60000";} ?>", //red
          borderColor: "<?php if($action=='3'){echo "#ff0000";} ?><?php if($action=='0'){echo "#000000";} ?><?php if($action=='2'){echo "#07f01e";} ?>" //red
        },

     <?php } ?>
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });


 function view_payment_date(type){
	if(type=='Bank'){
	document.getElementById('source').style.display='block';
	document.getElementById('chq_no').style.display='none';
	document.getElementById('buton').style.display='block';
		} else if(type=='Chq'){
		document.getElementById('chq_no').style.display='block';
		document.getElementById('source').style.display='none';
		document.getElementById('buton').style.display='block';
			}else {
		document.getElementById('chq_no').style.display='none';
		document.getElementById('source').style.display='none';
		document.getElementById('buton').style.display='none';
			}
	 }




		$('#datepicker').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepicker').datepicker({ autoclose: true });



	$('#datepickerd').datepicker({  autoclose: true, datepicker: true,  format: 'yyyy-mm-dd '});
    $('#datepickerd').datepicker({ autoclose: true  });
</script>

 <script type="text/javascript">

$(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });


</script>
</body>
</html>
