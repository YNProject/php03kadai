<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>読書データ登録</title>
    <link href="css/reset.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <span class="page-title">読書データ登録</span>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>読書データ登録</legend>

                <label>書籍名：<input type="text" name="bookname"></label><br>
                <label>著者：<input type="text" name="author"></label><br>
                <label>書籍URL：<input type="text" name="bookURL"></label><br>
                <label>書籍コメント：<input type="text" name="bookcomment"></label><br>
                <label>書籍画像：<input type="text" name="imgURL"></label><br>

                <input type="submit" value="送信">
            </fieldset>

            <!-- ▼ ここに一覧ページへのリンクを追加 ▼ -->
            <div class="link-area">
                <a href="select.php" class="list-link">▶ 登録データ一覧へ</a>
            </div>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>
