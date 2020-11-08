<?php
/* Database config */
$db_host		= 'localhost';
$db_user		= 'cloudarm_1';
$db_pass		= 'Rathunona1.';
$db_database	= 'cloudarm_thimal'; 
/* End config */

$db = new PDO('mysql:host='.$db_host.';dbname='.$db_database, $db_user, $db_pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>