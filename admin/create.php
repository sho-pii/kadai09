<!-- 記事作成画面 -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>記事作成</title>
    <link rel="stylesheet" href="../css/create.css">
</head>

<body>
  <header>
    <a class="linkTo" href="select.php">記事一覧</a>
    <a class="linkTo" href="../index.php">トップ</a>
  </header>
  <main>
    <form method="POST" action="insert.php" enctype="multipart/form-data">
      <div class="jumbotron">
        <fieldset>
            <legend>記事作成</legend>
            <div class="form-group"><!-- 日付時間 -->
              <input type="datetime-local" name="created_at">
            </div>
            <div class="form-group"><!-- タイトル -->
              <p>タイトル</p>
              <input type="text" name="title" style="width:600px; height:30px;">
            </div>
            <div class="form-group"><!-- 画像 -->
              <p>トップ画像を選択</p>
              <input type="file" name="image">
            </div>
            <div class="form-group"><!-- 本文 -->
              <p>本文</p>
              <textarea name="content" style="width:600px; height:300px;"></textarea>
            </div>
            <input type="submit" value="送信" style="margin:20px 0; width:100px; height:30px;">
          </fieldset>
      </div>
    </form>
  </main>
</body>

</html>