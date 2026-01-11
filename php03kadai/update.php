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
// 2. POSTデータ取得
// --------------------------------------
$id          = $_POST['id'];
$bookname    = $_POST['bookname'];
$author      = $_POST['author'];
$bookURL     = $_POST['bookURL'];
$bookcomment = $_POST['bookcomment'];
$imgURL      = $_POST['imgURL'];

// --------------------------------------
// 3. UPDATE文作成
// --------------------------------------
$sql = "UPDATE gs_an_tablekadai3 
        SET bookname = :bookname,
            author = :author,
            bookURL = :bookURL,
            bookcomment = :bookcomment,
            imgURL = :imgURL,
            indate = sysdate()
        WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':bookURL', $bookURL, PDO::PARAM_STR);
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);
$stmt->bindValue(':imgURL', $imgURL, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();

// --------------------------------------
// 4. 更新後処理
// --------------------------------------
if ($status === false) {
    $error = $stmt->errorInfo();
    exit("SQL_ERROR: " . $error[2]);
} else {
    header("Location: select.php");
    exit();
}
