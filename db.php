<?php
$db_host = ''; //enter MySQL database address or IP, for example 'mysql51-039.wc1.ord1.stabletransit.com' or 70.57.209.71
$db_name = ''; //enter database name
$db_user = ''; //enter database user name
$db_pass = ''; //enter database password

$noconnMessage = "Please enter credentials for your MySQL database in dp.php file. If you don't have one or don't know how to create one, you can use free on-line tool http://codegen.in/UCOZ-user-database-export/";

if ( $db_host == '' || $db_name == '' ||  db_user == '' || $db_pass == '' ||) {
	die($noconnMessage);
}

$conn = mysql_connect($db_host, $db_user, $db_pass, true);
if (!$conn) {
    die('Could not connect: ' . mysql_error());
};

if(!mysql_select_db($db_name, $conn)) {
	exit('DB is not selected' . mysql_error());
	};

	define('DB', $conn);