<?php

require_once('./common.php');
require_once('./blog.php');

$com = new Common();
$blog = new Blog();
$result = $blog->getById($_GET['id']);

$id = $result['id'];
$title = $result['title'];
$content = $result['content'];
$category = (int)$result['category'];
$publish_status = (int)$result['publish_status'];

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>BlogForm</title>
</head>

<body>
    <h2>ブログ編集フォーム</h2>
    <form action="blog_update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $com->h($id) ?>">
        <p>ブログタイトル：</p>
        <input type="text" name="title" value="<?php echo $com->h($title) ?>" />
        <p>ブログ本文：</p>
        <textarea name="content" id="content" cols="30" rows="10"><?php echo $com->h($content) ?></textarea>
        <br />
        <p>カテゴリ：</p>
        <select name="category">
            <option value="1" <?php if ($category === 1) echo 'selected' ?>>日常</option>
            <option value="2" <?php if ($category === 2) echo 'selected' ?>>プログラミング</option>
        </select>
        <br />
        <input type="radio" name="publish_status" value="1" <?php if ($publish_status === 1) echo 'checked' ?> />公開
        <input type="radio" name="publish_status" value="2" <?php if ($publish_status === 2) echo 'checked' ?> />非公開
        <br />
        <input type="submit" value="更新" />
    </form>
    <p><a href="./">戻る</a></p>
</body>

</html>