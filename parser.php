<?
include $_SERVER['DOCUMENT_ROOT'].'/simplehtmldom/simple_html_dom.php';
include $_SERVER['DOCUMENT_ROOT'].'/rsbs/db.php';

/* transform user input into variables //expected values */
$userGroupID =	filter_var($_GET["userGoupID"],	FILTER_SANITIZE_NUMBER_FLOAT);	//1-999
$startpage = 	filter_var($_GET["startpage"],	FILTER_SANITIZE_NUMBER_FLOAT);	//1-n
$pages = 		filter_var($_GET["pages"],	FILTER_SANITIZE_NUMBER_FLOAT);		//1-n
$dlanguageuCozso = filter_var($_GET["dlanguageuCozso"],	FILTER_SANITIZE_FULL_SPECIAL_CHARS);

/* Let's use site name and user group as file name and name of a table where we are storing data */
$site_z =  htmlspecialchars($_GET["site"]); //russianstepbystep.com
$site_a = preg_replace("/(https:\/\/|http:\/\/|www)/", '', $site_z);
$site = $site_a;
//$site = explode('/', $site_a, 2)[0]; //this value will be used to access the admin panel; Requires PHP 5.4

$table_z = preg_replace("/[^A-Za-z0-9 ]/", '', $site);
$table = $table_z.$userGroupID;

/* values check*/
if ($pages < 1) {$pages = 1;}
if ($userGroupID < 1) {$userGroupID = 1;}
if ($startpage < 1) {$startpage = 1;}

$sql_create_table = "CREATE TABLE IF NOT EXISTS $table (login VARCHAR(60),name VARCHAR(60),ip VARCHAR(15),email VARCHAR(50) UNIQUE)";
$result = mysql_query($sql_create_table);
if (!$result) {die('Invalid query: ' . mysql_error());}

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: dlanguageuCozso=".$dlanguageuCozso
  )
);
$context = stream_context_create($opts);

//URI example http://example.com/panel/?a=users;l=find;p=1;g=1");
for ($p = $startpage; $p <= $pages; $p++) {
    $url = htmlspecialchars("http://".$site."/panel/?a=users;l=find;p=".$p.";g=".$userGroupID);
	$users = 0;

	// Open the file using the HTTP headers set above
	$html = file_get_html($url, false, $context);
	foreach($html->find('table.myTbl') as $myTbl) {
		foreach($myTbl->find('tr') as $tr) {
			$login = $tr->find('td', 1)->plaintext;
			$name = $tr->find('td', 4)->plaintext;
			$email = $tr->find('td', 5)->plaintext;
			
			if ($email != 'E-mail') {
				$sql = "INSERT IGNORE INTO $table (login, name, email) VALUES ( '$login', '$name', '$email' )";
				$result = mysql_query($sql);		
				if (!$result) {die('Invalid query: ' . mysql_error());} else {$users++;}
			}
		}
		echo("<li>Page ".$p."; ".$users." processed.</li>");
};

}

mysql_close($conn);
?>
