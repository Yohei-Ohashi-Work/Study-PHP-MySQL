<?php

require_once('./common.php');
require_once('./blog.php');

$com = new Common();
$blog = new Blog();
$result = $blog->delete($_GET['id']);

?>

<p><a href="./">戻る</a></p>