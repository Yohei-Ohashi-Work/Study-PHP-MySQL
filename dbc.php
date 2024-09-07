<?php

class Dbc
{
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
        $dbh = $this->dbConnect();
        // ①SQL文の準備
        $sql = 'SELECT * FROM blog';
        // ②SQLの実行
        $stmt = $dbh->query($sql);
        // ③SQLの結果を受け取る
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        $dbh = null;
    }

    // 3. カテゴリ名を表示する
    // 引数： 数字
    // 返り値： カテゴリーの文字列
    function setCategoryName($category)
    {
        if ($category === '1') {
            return '日常';
        } elseif ($category === '2') {
            return 'プログラミング';
        } else {
            return 'その他';
        }
    }

    // 引数： $id
    // 返り値： $result
    function getBlog($id)
    {
        if (empty($id)) {
            exit('IDが不正です。');
        }

        $dbh = $this->dbConnect();

        // SQL準備
        $stmt = $dbh->prepare('SELECT * FROM blog WHERE id = :id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        // SQL実行
        $stmt->execute();
        // 結果を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            exit('ブログがありません。');
        }

        return $result;
    }

    // 引数： $blogs
    // 返り値： $result
    function blogCreate($blogs)
    {
        $sql = 'INSERT INTO
                blog(title, content, category, publish_status)
            VALUES
                (:title, :content, :category, :publish_status)';

        $dbh = $this->dbConnect();
        $dbh->beginTransaction();
        try {
            $stmt = $dbh->prepare($sql);
            $stmt->bindValue(':title', $blogs['title'], PDO::PARAM_STR);
            $stmt->bindValue(':content', $blogs['content'], PDO::PARAM_STR);
            $stmt->bindValue(':category', $blogs['category'], PDO::PARAM_INT);
            $stmt->bindValue(':publish_status', $blogs['publish_status'], PDO::PARAM_INT);
            $stmt->execute();
            $dbh->commit();
            echo 'ブログを投稿しました！';
        } catch (PDOException $e) {
            $dbh->rollBack();
            exit($e);
        }
    }
}
