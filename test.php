<?php 
echo('start');
$path = $_SERVER['DOCUMENT_ROOT'].'/demo.html';
if( file_exists($path) && is_readable($path) && include($path)) { 
 echo 'File is included';
} else {
  echo 'Fail';
};

echo('<br>');
echo('end');
?>
