<?php

$dsn = 'mysql:host=localhost;dbname=study_blog_app;charset=utf8';
$user = 'blog_user';
$pass = 'Hashi123';


try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    // echo '接続成功<br>';
    // ①SQL文の準備
    $sql = 'SELECT * FROM blog';
    // ②SQLの実行
    $stmt = $dbh->query($sql);
    // ③SQLの結果を受け取る
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
} catch (PDOException $e) {
    echo "接続失敗<br>{$e->getMessage()}";
    exit();
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
        <?php foreach ($result as $column): ?>
            <tr>
                <td><?php echo $column['id'] ?></td>
                <td><?php echo $column['title'] ?></td>
                <td><?php echo $column['category'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>