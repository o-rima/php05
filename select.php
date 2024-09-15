<?php

//SESSIONスタート
session_start();

require_once('funcs.php'); 
loginCheck();

//２．データ登録SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare('SELECT * FROM gs_bookmark_table');
$status = $stmt->execute();

//３．データ表示
if ($status == false) {
    sql_error($stmt);
}

if (isset($_SESSION['chk_ssid'])) {
    // ログインしている
    echo "ログイン中" ;
} else {
    // ログインしていない
    echo "ログインしていません";
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録一覧</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="main">
    <header>
        <nav>
            <a href="index.php">新規登録</a>
            <a>　</a>
            <form class="logout-form" action="logout.php" method="post" onsubmit="return confirm('本当にログアウトしますか？');">
            <button type="submit" class="logout-button">ログアウト</button>
        </form>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>登録一覧</h1>
            <div class="card-container">
                <?php while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    
                    <p><?= htmlspecialchars($result['date'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><?= htmlspecialchars($result['book_name'], ENT_QUOTES, 'UTF-8') ?></p>
                    <p><a href="<?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?>"><?= htmlspecialchars($result['book_url'], ENT_QUOTES, 'UTF-8') ?></a></p>
                    <p><?= htmlspecialchars($result['book_comment'], ENT_QUOTES, 'UTF-8') ?></p>
                    <div>
                    <img src="<?= h($r['image']) ?>" alt="">
                    </div>
                        <!-- 編集と削除のリンクを追加 -->
                        <a href="detail.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>">詳細</a> 
                        <a href="delete.php?id=<?= htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8') ?>" onclick="return confirm('本当に削除しますか？');">削除</a>
                <?php endwhile; ?>
            </div>
        </div>
    </main>
</body>
</html>


