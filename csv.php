<?php


class csv extends mysqli
{
	private $state_csv = false;
	public function __construct()
	{
		parent::__construct("localhost","colorb69_1","rathunona1.","colorb69_family");
		if ($this->connect_error) {

			echo "Fail to connection_timeout".$this->connect_error;

		}
	}
public function inport($file)
{
	$file = fopen($file, 'r');

	while( ($row = fgetcsv($file,1000,",")) !==false) {

		$r1=$row [1];
		$r2=$row [2];
		$r3=$row [3];
		$r4=$row [4];
	//	$r4=$row [5];
		$r6=$row [6];
		$r7=$row [7];




     include('connect.php');

	  	//$value = "'". implode("','", $row)."'";
	  $q = "INSERT INTO customer(customer_name,address,contact,membership_number,area,root)
		VALUES('$r2','$r3','$r6','$r1','$r7','$r4')";
	  	if ($this->query($q)) {
	  		$this->state_csv = true;
	  	}else{
	  		$this->state_csv = false;
	  		echo $this->error;
	  	}

	  }




?>
