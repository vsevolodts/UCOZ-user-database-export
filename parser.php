<?
include $_SERVER['DOCUMENT_ROOT'].'/simplehtmldom/simple_html_dom.php';
include 'db.php';
include 'vars.php';

$sql_create_table = "CREATE TABLE IF NOT EXISTS $table (login VARCHAR(60),name VARCHAR(60),ip VARCHAR(15),email VARCHAR(50) UNIQUE)";
$result = mysql_query($sql_create_table);
if (!$result) {die('Invalid query: ' . mysql_error());}

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: ".$uCozsoName."=".$uCozsoValue
  )
);
$context = stream_context_create($opts);
$fp = fopen('http://'.$site, 'r', false, $context);


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
