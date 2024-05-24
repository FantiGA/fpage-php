<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>翻页组件fpage(php)演示 by Jun Wu</title>
<link href="php.fpage-1.1.1.css" rel="stylesheet" type="text/css" media="screen">
</head>

<body>
<?php
require_once 'fpage.php';

$o = '{
	"current": 456,
	"total": 100000,
	"per": 50,
	"type": "js",
	"ext": "javascript: goto(###);",
	"mode": "<*>="
}';
$page = $page3 = new fpage ( $o );

$o2 = '{
	"current": 12,
	"total": 10000,
	"per": 50,
	"type": "js",
	"ext": "javascript: goto(###);",
	"mode": "<*>="
}';
$page2 = new fpage ( $o2 );



echo $page->show ();
echo '<br />';
echo $page2->show ();
echo '<br />';
echo $page3->show ();
?>
</body>
</html>
