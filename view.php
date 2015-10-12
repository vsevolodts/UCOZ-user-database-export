<?
 /* THis file is for debugging purposes only */
include $_SERVER['DOCUMENT_ROOT'].'/simplehtmldom/simple_html_dom.php';
include 'db.php';
include 'vars.php';

/* Check if dynamic IP is allowed */
$html = file_get_html("http://".$site."/panel/?a=users;l=find;p=1;g=1", false, $context);

foreach($html->find('.myWinError ') as $myWinError) {
		if ( strlen($myWinError) > 10) {
			echo ('<div class="alert alert-error"><h2>Script can\'t log in: please check your site settings</h2> <p class="error">'.$myWinError->plaintext.'</p></div>');
			die();			
		};
	};

/* Check if script can access admin panel at all*/
foreach($html->find('#lform ') as $lform) {
		if ( strlen($lform) > 10) {
			echo ('<div class="alert alert-error"><h2>Please check cookie</h2> <p>Script was not able to access the admin panel because cookie is not valid or expire.</p></div>');
            echo ($html);
		};
	};

for ($p = $startpage; $p <= $pages; $p++) {
    $url = htmlspecialchars("http://".$site."/panel/?a=users;l=find;p=".$p.";g=".$userGroupID);
	$users = 0; //count number of successfully added users per page
	$records = 0;
	// Open the file using the HTTP headers set above
	$html = file_get_html($url, false, $context);
	//check if cookie is set correctly
	foreach($html->find('#lform ') as $lform) {
		if ( strlen($lform) > 10) {
			echo ('<div class="alert alert-error"><h2>Please check cookie</h2> <p>Script was not able to access the admin panel because cookie is not valid or expire.</p></div>');
echo ($html);
			die();			
		};
	};
	
	foreach($html->find('table.myTbl') as $table) {
		foreach($table->find('tr') as $tr) {
			$login = $tr->find('td', 1)->plaintext;
			$name = $tr->find('td', 4)->plaintext;
			$email = $tr->find('td', 5)->plaintext;			
			if ($email != 'E-mail') {
				$sql = "INSERT INTO users (login, name, useremail) VALUES ( '$login', '$name', '$email' )";
				$result = mysql_query($sql);		
				if ($result) {$users++;}
				$records++;
			}
		}
		echo("<li>Page ".$p."; ".$records." records processed; ".$users." new user added.</li>");
	};
}
mysql_close($conn);
?>
