<? 
include 'vars.php';
include 'db.php';
$sdom = $_SERVER['DOCUMENT_ROOT'].'/simplehtmldom/simple_html_dom.php';

// Checks
$error = '';
$back = "Location: http://".$_SERVER['HTTP_HOST'].rtrim(dirname($_SERVER['PHP_SELF']), '/\\')."?error=";

//Check if SimpleHtmlDom is loaded
if( file_exists($sdom) && is_readable($sdom) && include($sdom)) {
} else {
	$error = ' SimpleHTMLDOM library is missing. Download library from <a href="http://simplehtmldom.sourceforge.net">simplehtmldom.sourceforge.net</a> to <code>/simplehtmldom</code> folder.';
	header($back.$error);
};
$html = file_get_html("http://".$site."/panel/?a=users;l=find;p=1;g=1", false, $context);
foreach($html->find('.myWinError ') as $myWinError) {
		if ( strlen($myWinError) > 10) {
			$error = ' Check your site security settings.';
            header($back.$error);
		};
	};
//Check if script can access admin panel at all
foreach($html->find('#lform ') as $lform) {
        if ( strlen($lform) > 10 && $error == '') {
            $error = ' Check cookie and make sure the admin panel is open in another tab.';
            header($back.$error);
        };
    };
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
        <!--<a href="view.php?site=<?php echo $site; ?>&userGoupID=<?php echo $userGroupID; ?>&startpage=<?php echo $startpage; ?>&pages=<?php echo $pages; ?>&uCozsoName=<?php echo $uCozsoName; ?>&uCozsoValue=<?php echo $uCozsoValue; ?>">view</a>-->
        <div id="vars">
        <ul>
            <li>Site: <?php echo $site; ?></li>
            <li>UsergroupID = <?php echo $userGroupID; ?></li>
            <li>Working on pages from <?php echo $startpage; ?> to <?php echo $pages; ?></li>
            <li>Table name: <?php echo $table; ?></li>
            <li>Session cookie: <?php echo $uCozsoName; ?>=<?php echo $uCozsoValue; ?></li>
            
        </ul>
            <hr />
        </div>
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
		var uri = "parser.php?site=<? echo $site; ?>&userGoupID=<? echo $userGroupID; ?>&startpage="+i+"&pages="+i+"&uCozsoName=<?php echo $uCozsoName; ?>&uCozsoValue=<?php echo $uCozsoValue; ?>";
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-2455268-27', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>