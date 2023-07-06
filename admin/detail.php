<!-- 記事更新ページ -->
<?php
// ini_set("display_errors", 'On');
// error_reporting(E_ALL);

$id = isset($_GET['id'])? htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8'):'';

if($id==''){
    header('location:index.php');
}

require_once('../functions.php');
$pdo = connectDB();

$sql = 'SELECT * FROM blog_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$_GET['id']);
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>記事編集</title>
    <link rel="stylesheet" href="../css/create.css">
    <style>
      .created_at {
        display: none;
      }
    </style>
</head>

<body>
  <header>
    <a class="linkToSelect" href="select.php">記事一覧</a>
  </header>
  <main>
    <form method="POST" action="update.php" enctype="multipart/form-data">
      <div class="jumbotron">
        <fieldset>
          <legend>記事編集</legend>
            <div class="form-group"><!-- 日付時間 -->
              <input type="datetime-local" name="updated_at" value="<?= date('Y-m-d\TH:i', strtotime($result[0]['created_at'])) ?>">
            </div>
            <div class="form-group"><!-- タイトル -->
              <p>タイトル</p>
              <input type="text" name="title" style="width:600px; height:30px;" value="<?= $result[0]['title'] ?>">
            </div>
            <div class="form-group"><!-- 画像 -->
              <p>トップ画像を選択</p>
              <input type="file" name="image" >
            </div>
            <p>
            <img class="img" src="../image.php?id=<?php echo $result[0]['id']; ?> " style="width:300px; height:auto;"></p>
            <div class="form-group"><!-- 本文 -->
              <p>本文</p>
              <textarea name="content" style="width:600px; height:300px;"><?= $result[0]['content'] ?></textarea>
            </div>
            <input class="created_at" type="datetime-local" name="created_at" value="<?= date('Y-m-d\TH:i', strtotime($result[0]['created_at'])) ?>">
            <input type="hidden" name="id" value="<?= $result[0]['id'] ?>">
            <input type="submit" value="更新" style="margin:20px 0; width:100px; height:30px;">
          </fieldset>
      </div>
    </form>
  </main>
</body>

</html>