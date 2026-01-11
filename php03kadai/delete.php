<?php
// --------------------------------------
// 1. DB接続
// --------------------------------------
try {
    $config = require __DIR__ . '/../../config/php03kadaiconfig/php03kadaiconfig.php';//config.php を読み込む

    $pdo = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8",//DB接続
        $config['user'],//ユーザー名
        $config['pass']//パスワード
    );
} catch (PDOException $e) {
    exit('DB_CONNECT_ERROR: ' . $e->getMessage());//DB接続エラーの場合、エラー文を表示して終了
}

// --------------------------------------
// 2. id取得
// --------------------------------------
$id = $_GET['id'];  // URLの?id=◯ を取得

// --------------------------------------
// 3. 削除SQL
// --------------------------------------
$sql = "DELETE FROM gs_an_tablekadai3 WHERE id = :id";//指定idのデータを削除するSQL文
$stmt = $pdo->prepare($sql);//SQL準備
$stmt->bindValue(':id', $id, PDO::PARAM_INT);//idをバインド
$status = $stmt->execute();//SQL実行

// --------------------------------------
// 4. 削除後の処理
// --------------------------------------
if ($status === false) {//SQL実行に失敗した場合
    $error = $stmt->errorInfo();//エラー情報取得
    exit("SQL_ERROR: " . $error[2]);//エラー文表示して終了
} else {
    // 削除後は一覧ページへ戻す
    header("Location: select.php");//一覧ページへリダイレクト
    exit();//終了
}
