<?php 
session_start();
include('../../connect.php');
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$text='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Display all POST parameters
    foreach ($_POST as $key => $value) {
        $text.= "Parameter Name: " . htmlspecialchars($key) . "\n";
        $text.= "Parameter Value: " . htmlspecialchars($value) . "\n\n";
    }
} else {
    $text= "No POST data received.";
}

echo $text;

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");

fwrite($myfile, $text);
fclose($myfile);