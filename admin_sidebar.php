<?php if ($user_lewal == 1) {?>

<li>
      <a  href="index.php">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        <span class="pull-right-container">

        </span>
      </a>
    </li>

    <li>
    <a  href="bill_remove_app.php">
      <i class="fa fa-ban"></i> <span>Bill Removal</span>
      <span class="pull-right-container">
      </span>
    </a>
    </li>

    <li>
    <a  href="stock_adjust_app.php">
      <i class="fa fa-cubes"></i> <span>STOCK Adjustment</span>
      <span class="pull-right-container">
      </span>
    </a>
    </li>


<li class="treeview">
      <a href="#">
        <i class="fa fa-bank"></i>
        <span>Bank</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="deposit.php"><i class="fa fa-circle-o text-aqua "></i>Deposit</a></li>
  <li><a href="withdraw.php"><i class="fa fa-circle-o text-red "></i>Withdraw </a></li>
  <li><a href="chq_return.php"><i class="fa fa-circle-o text-red "></i>CHQ Return </a></li>
  <li><a href="chq_action.php"><i class="fa fa-circle-o text-red "></i>CHQ Realiz </a></li>
      </ul>
    </li>








    <li class="treeview">
      <a href="#">
        <i class="fa fa-line-chart"></i>
        <span>Report</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>



      <ul class="treeview-menu">

        <li><a href="sales_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>&cus=all"><i class="fa fa-circle-o text-aqua "></i> Sales Report</a></li>

  <li><a href="sales_credit.php"><i class="fa fa-circle-o text-aqua "></i> Credit Report</a></li>
  <li><a href="sales_credit_pay.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>&cus=all"><i class="fa fa-circle-o text-aqua "></i> Credit Payment Report</a></li>

<li><a href="bank_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-aqua "></i> Bank Report</a></li>

  <li><a href="pay_sum.php"><i class="fa fa-circle-o text-aqua "></i>Payment Summary </a></li>
  <li><a href="loding_list.php?id=<?php echo $date;?>&lorry=0"><i class="fa fa-circle-o text-aqua "></i> Loading Report</a></li>
  <li><a href="expenses_sum.php?d1=<?php echo $date;?>"><i class="fa fa-circle-o text-aqua "></i> Expenses Report </a></li>
<li><a href="stock_rp.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>"><i class="fa fa-circle-o text-aqua "></i> Stock Report</a></li>

    <li>
          <a href="#"><i class="fa fa-line-chart text-red"></i>Sub Report
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
            <ul class="treeview-menu">
    <li><a href="sales_rp_special.php?d1=<?php echo date("Y-m-d");?>&d2=<?php echo date("Y-m-d");?>&cus=all"><i class="fa fa-circle-o text-aqua "></i>Special Price Sales</a></li>
    <li><a href="sales_all_rp.php?d1=<?php echo $date;?>"><i class="fa fa-circle-o text-aqua "></i> Day End Report </a></li>
    <li><a href="damage_view.php"><i class="fa fa-circle-o text-aqua "></i> Damage Report</a></li>
<li><a href="stock_error.php"><i class="fa fa-circle-o text-aqua "></i> Stock Error</a></li>
    <li><a href="purchase_view.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>"><i class="fa fa-circle-o text-aqua "></i> Purchase Report</a></li>
<li><a href="purchase_pay_rp.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>"><i class="fa fa-circle-o text-aqua "></i> Purchase Pay Report</a></li>
<li><a href="sales_dll_rp.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>&cus=all"><i class="fa fa-circle-o text-aqua "></i> Sales Delete Report</a></li>

<li><a href="sales_rp_month.php?d1=<?php echo $date;?>&d2=<?php echo $date;?>"><i class="fa fa-circle-o text-aqua "></i> Sales Month Report</a></li>
            </ul>
          </li>

          <li>
          <a href="#"><i class="fa fa-line-chart text-red"></i>Back Date Report
          <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
            <ul class="treeview-menu">
            <li><a href="sales_credit_back_date.php"><i class="fa fa-circle-o text-aqua "></i> Credit Report</a></li>

            </ul>
          </li>

  </a></li>
      </ul>
    </li>


<?php } ?>
