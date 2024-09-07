<?php

// 関数一つに一つの機能のみを持たせる
// 1. データベース接続
// 2. データを取得する
// 3. カテゴリ名を表示する

// 1. データベース接続
// 引数： なし
// 返り値： 接続結果を返す
function dbConnect()
{
    $dsn = 'mysql:host=localhost;dbname=study_blog_app;charset=utf8';
    $user = 'blog_user';
    $pass = 'Hashi123';

    try {
        $dbh = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);
    } catch (PDOException $e) {
        echo "接続失敗<br>{$e->getMessage()}";
        exit();
    };

    return $dbh;
}

// 2. データを取得する
// 引数： なし
// 返り値： 取得したデータ
function getAllBlog()
{
    $dbh = dbConnect();
    // ①SQL文の準備
    $sql = 'SELECT * FROM blog';
    // ②SQLの実行
    $stmt = $dbh->query($sql);
    // ③SQLの結果を受け取る
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
}

// 取得したデータを表示
$blogData = getAllBlog();

// 3. カテゴリ名を表示する
// 引数： 数字
// 返り値： カテゴリーの文字列
function setCategoryName($category)
{
    if ($category === '1') {
        return 'ブログ';
    } elseif ($category === '2') {
        return 'ブログ';
    } else {
        return 'その他';
    }
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h2>ブログ一覧</h2>
    <table>
        <tr>
            <th>No</th>
            <th>タイトル</th>
            <th>カテゴリ</th>
        </tr>
        <?php foreach ($blogData as $column): ?>
            <tr>
                <td><?php echo $column['id'] ?></td>
                <td><?php echo $column['title'] ?></td>
                <td><?php echo setCategoryName($column['category']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>