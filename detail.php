<?php

require_once('./common.php');
require_once('./blog.php');

$com = new Common();
$blog = new Blog();
$result = $blog->getById($_GET['id']);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ詳細</title>
</head>

<body>
    <h2>ブログ詳細</h2>
    <h3>タイトル： <?php echo $com->h($result["title"]) ?></h3>
    <p>投稿日時： <?php echo $com->h($result["post_at"]) ?></p>
    <p>カテゴリ： <?php echo $com->h($blog->setCategoryName($result["category"])) ?></p>
    <hr>
    <p>本文： <?php echo $com->h($result["content"]) ?></p>
    <p><a href="./">戻る</a></p>
</body>

</html>