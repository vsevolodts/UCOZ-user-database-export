<?
include $_SERVER['DOCUMENT_ROOT'].'/simplehtmldom/simple_html_dom.php';
include 'db.php';

$table_z =	htmlspecialchars($_GET["table"]);
$table =	preg_replace("/[^A-Za-z0-9 ]/", '', $table_z);

/* Last page is parsed: let's create CSV file */
$result = mysql_query("SELECT * FROM $table");
if (!$result) {die('Invalid query: ' . mysql_error());} 

$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fname = 'files/'.$table.'.csv';
$fp = fopen($fname, 'w');
while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {
     fputcsv($fp, $row);
}
fclose($fp);

echo ('<h3><a href="'.$fname.'">Download list</a></h3>');

mysql_close($conn);
?>
