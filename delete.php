<?php

session_start();

// DB接続します
require_once('funcs.php');
$pdo = db_conn();

// ID取得
$id = $_GET['id'];

// データ削除SQL作成
$stmt = $pdo->prepare("DELETE FROM gs_bookmark_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    $error = $stmt->errorInfo();
    exit("ErrorQuery:" . $error[2]);
} else {
    // 登録一覧ページへリダイレクト
    header('Location: select.php');
    exit;
}