<?php

$dsn = 'mysql:host=localhost;dbname=study_blog_app;charset=utf8';
$user = 'blog_user';
$pass = 'Hashi123';


try {
    $dbh = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo '接続成功';
    $dbh = null;
} catch (PDOException $e) {
    //throw $th;
    echo "接続失敗<br>{$e->getMessage()}";
    exit();
}
