<?php
// --------------------------------------
// 1. DB接続
// --------------------------------------
try {
    $config = require __DIR__ . '/../../config/php03kadaiconfig/php03kadaiconfig.php';

    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",
        $config['user'],
        $config['pass']
    );
} catch (PDOException $e) {
    exit('DB_CONNECT_ERROR: ' . $e->getMessage());
}

// --------------------------------------
// 2. GETで受け取ったidを取得
// --------------------------------------
$id = $_GET['id'];

// --------------------------------------
// 3. 該当データ1件を取得
// --------------------------------------
$sql = "SELECT * FROM gs_an_tablekadai3 WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status === false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR: " . $error[2]);
}

$value = $stmt->fetch(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>読書データ編集</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="page-title">読書データ編集</span>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>読書データ編集</legend>

                <label>書籍名：
                    <input type="text" name="bookname" value="<?= $value['bookname'] ?>">
                </label><br>

                <label>著者：
                    <input type="text" name="author" value="<?= $value['author'] ?>">
                </label><br>

                <label>書籍URL：
                    <input type="text" name="bookURL" value="<?= $value['bookURL'] ?>">
                </label><br>

                <label>書籍コメント：
                    <input type="text" name="bookcomment" value="<?= $value['bookcomment'] ?>">
                </label><br>

                <label>書籍画像URL：
                    <input type="text" name="imgURL" value="<?= $value['imgURL'] ?>">
                </label><br>

                <!-- 更新に必要な id を hidden で送る -->
                <input type="hidden" name="id" value="<?= $value['id'] ?>">

                <input type="submit" value="更新">
            </fieldset>

            <!-- ▼ 一覧ページへのリンク ▼ -->
            <div class="link-area">
                <a href="select.php" class="list-link">▶ 登録データ一覧へ</a>
            </div>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>
