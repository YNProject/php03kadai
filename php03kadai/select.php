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
// 2. データ取得SQL
// --------------------------------------
$sql = "SELECT * FROM gs_an_tablekadai3";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

// --------------------------------------
// 3. データ取得
// --------------------------------------
$values = [];
if ($status) {
    $values = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR: " . $error[2]);
}

// JSON（必要なら）
$json = json_encode($values, JSON_UNESCAPED_UNICODE);
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>読書データ一覧</title>

    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="main">

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="page-title">読書データ一覧</span>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->


    <!-- Main[Start] -->
    <div class="list-container">

        <?php if (!empty($values)) { ?>
            <?php foreach ($values as $value) { ?>

                <div class="book-card">

                    <div class="book-img">
                        <img src="<?= $value["imgURL"] ?>" alt="book image">
                    </div>

                    <div class="book-info">
                        <h2 class="book-title"><?= $value["bookname"] ?></h2>
                        <p class="book-author">著者：<?= $value["author"] ?></p>
                        <p class="book-comment"><?= $value["bookcomment"] ?></p>
                        <a href="<?= $value["bookURL"] ?>" class="book-link" target="_blank">書籍URLを見る</a>
                        <p class="book-date">登録日：<?= $value["indate"] ?></p>

                        <a href="detail.php?id=<?= $value['id'] ?>" class="edit-link">[編集]</a>
                        <a href="delete.php?id=<?= $value['id'] ?>" class="delete-link">[削除]</a>
                    </div>


                </div>

            <?php } ?>
        <?php } else { ?>
            <p>データがありません。</p>
        <?php } ?>

        <!-- ▼ 下部に登録ページへのリンク ▼ -->
        <div class="link-area">
            <a href="index.php" class="list-link">▶ 読書データ登録へ</a>
        </div>

    </div>
    <!-- Main[End] -->

</body>

</html>