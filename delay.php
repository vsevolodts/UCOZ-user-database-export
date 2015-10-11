<? 
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Ucoz DB export tool</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h1>Process of parcing</h1>
      <div id="responce"></div>
	  <div id="download"></div>   
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
$(function() {

function sendDelayedAjax(i, uri) {
  setTimeout(function() {
	$.ajax({
		  url: uri,
		  context: document.body
		}).success(function( data ) {
		  $('#responce').append(data);
		}).error(function( data ) {
		  $('#responce').append(data);
		});
  }, (i-<? echo $startpage; ?>)* 1000);
}

	for (i = <? echo $startpage; ?>; i <= <? echo $pages; ?>; i++) {
		var uri = "parser.php?site=<? echo $site; ?>&userGoupID=<? echo $userGroupID; ?>&startpage="+i+"&pages="+i+"&dlanguageuCozso=<? echo $dlanguageuCozso; ?>";
		sendDelayedAjax(i, uri);
		
		if (i == <? echo $pages; ?>) {
			setTimeout(function() {generateFile();}, <? echo $pages; ?>*1000);
		};
		
	}; //end of loop
	;

function generateFile() {
	$.ajax({
		url: "download.php?table=<? echo $table; ?>",
		  context: document.body
		}).success(function( data ) {
		  $('#download').html(data);
		}).error(function( data ) {
		  $('#download').html(data);
		}); 
}
	
});
</script>
</body>
</html>