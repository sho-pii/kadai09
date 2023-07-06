<!-- 記事ページ -->
<?php
ini_set("display_errors", 'On');
error_reporting(E_ALL);

$id = isset($_GET['id'])? htmlspecialchars($_GET['id'], ENT_QUOTES, 'utf-8'):'';

if($id==''){
    header('location:index.php');
}

require_once('functions.php');
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $result[0]['title']; ?>｜ブログ</title>
  <link rel="stylesheet" href="css/style.css"><!-- 共通CSS -->
  <link rel="stylesheet" href="css/page.css">
</head>
<body>
  <!-- ヘッダー -->
  <header id="header">
    <div class="headerBox">
      <div class="headerLogo">
        <a class="top" href="index.php"><h1 class="logoTitle">ブログ</h1></a>
        <p class="logoSubtitle">オウンドメディア</p>
      </div>
    </div>
  </header>
  <!-- メイン -->
  <main>
    <div class="mainBox">
      <p class="mainTime"><?php echo $result[0]['updated_at']; ?></p>
      <h1 class="mainTitle"><?php echo $result[0]['title']; ?></h1>
      <div class="imgBox"><img src="image.php?id=<?php echo $result[0]['id']; ?>" alt=""></div>
      <div class="mainText"><?php echo $result[0]['content']; ?></div>
    </div>
  </main>
  <!-- フッター -->
  <footer id="footer">
    <p class="footerText">Copyright @ 2023 TEST, inc</p>
  </footer>

</body>
</html>