<?
include $_SERVER['DOCUMENT_ROOT'].'/simplehtmldom/simple_html_dom.php';
include 'db.php';
include 'vars.php';

$sql_create_table = "CREATE TABLE IF NOT EXISTS $table (login VARCHAR(60),name VARCHAR(60),ip VARCHAR(15),email VARCHAR(50) UNIQUE)";
$result = mysql_query($sql_create_table);
if (!$result) {die('Invalid query: ' . mysql_error());}

//URI example http://example.com/panel/?a=users;l=find;p=1;g=1");
for ($p = $startpage; $p <= $pages; $p++) {
    $url = htmlspecialchars("http://".$site."/panel/?a=users;l=find;p=".$p.";g=".$userGroupID);
	$users = 0;
    $records = 0;
	// Open the file using the HTTP headers set above
	$html = file_get_html($url, false, $context);
	foreach($html->find('table.myTbl') as $myTbl) {
		foreach($myTbl->find('tr') as $tr) {
			$login = rtrim($tr->find('td', 1)->plaintext, ' \* ');
            $ip = $tr->find('td', 2)->plaintext;
			$name = $tr->find('td', 4)->plaintext;
			$email = $tr->find('td', 5)->plaintext;
			
			if ($email != 'E-mail') {
				$sql = "INSERT INTO $table (login, ip, name, email) VALUES ( '$login', '$ip', '$name', '$email' )";
				$result = mysql_query($sql);		
				if ($result) {$users++;}
				$records++;
			}

		}
		echo("<li>Page ".$p."; ".$records." records processed; ".$users." new users added.</li>");
};

}

mysql_close($conn);
?>
