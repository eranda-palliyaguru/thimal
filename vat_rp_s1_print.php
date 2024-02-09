<?php
include("connect.php");

// Fetch data from the database
$d1 = $_GET['d1'];
$d2 = $_GET['d2']; $sr=1;
$result1 = $db->prepare("SELECT * FROM sales JOIN customer ON sales.customer_id=customer.customer_id WHERE sales.action='1' AND  sales.date BETWEEN '$d1' and '$d2' ");
$result1->execute();

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sales_data.csv"');

// Create a file pointer connected to the output stream
$fp = fopen('php://output', 'w');

// Add the CSV headers
$header = array("Serial No", "Invoice Date", "Tax Invoice No", "Purchaser's TIN", "Name of the Purchaser", "Description", "Value of supply", "VAT Amount");
fputcsv($fp, $header);

// Loop through the data and write it to the CSV file
while ($row = $result1->fetch()) {
    list($y, $m, $d) = explode('-', $row['date']);
    $date = $m.'-'.$d.'-'.$y;
    
    
    // Prepare data for CSV
    $data = array(
        $sr+=1,
        $date,
        $row['transaction_id'],
        $row['vat_no'],
        $row['name'],
        'Refill Gas and related items',
        number_format(($row['amount'] / 118) * 100, 2),
        number_format(($row['amount'] / 118) * 18, 2)
    );

    // Write data to CSV
    fputcsv($fp, $data);
}

// Close the file pointer
fclose($fp);

exit(); 
?>
