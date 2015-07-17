<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "blog");
$link = mysql_connect(DB_SERVER, DB_USER, DB_PASS);
if (!$link) {
die('Don\'t connect: ' . mysql_error());
}
$db_selected = mysql_select_db(DB_NAME, $link);
if (!$db_selected) {
die ('Don\'t connect to database: ' . mysql_error());
}
mysql_set_charset('utf8');

?>