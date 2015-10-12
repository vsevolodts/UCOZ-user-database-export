<?php 
/* transform user input into variables //expected values */
$userGroupID =	filter_var($_GET["userGoupID"], FILTER_SANITIZE_NUMBER_FLOAT);	//1-999
$startpage = 	filter_var($_GET["startpage"], FILTER_SANITIZE_NUMBER_FLOAT);	//1-n
$pages = 		filter_var($_GET["pages"], FILTER_SANITIZE_NUMBER_FLOAT);		//1-n
$uCozsoName =   trim(filter_var($_GET["uCozsoName"], FILTER_SANITIZE_FULL_SPECIAL_CHARS), " \t\n\r\0\x0B");
$uCozsoValue =  trim(filter_var($_GET["uCozsoValue"], FILTER_SANITIZE_FULL_SPECIAL_CHARS), " \t\n\r\0\x0B");

/* Let's use site name and user group as file name and name of a table where we are storing data */
$site_z =  htmlspecialchars($_GET["site"]); //expected value: 'example.com'
$site_a = preg_replace("/(https:\/\/|http:\/\/|www.)/", '', $site_z);
$site = explode('/', $site_a, 2)[0];

$table_z = preg_replace("/[^A-Za-z0-9 ]/", '', $site);
$table = $table_z.$userGroupID;

/* values check*/
if ($pages < 1) {$pages = 1;}
if ($userGroupID < 1) {$userGroupID = 1;}
if ($startpage < 1) {$startpage = 1;}

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: ".$uCozsoName."=".$uCozsoValue
  )
);
$context = stream_context_create($opts);

?>
