<!-- トップページ -->
<?php
// ini_set("display_errors", 'On');
// error_reporting(E_ALL);

  require_once('functions.php');
  $pdo = connectDB();

  $stmt = $pdo->prepare("SELECT * FROM blog_table ORDER BY updated_at DESC LIMIT 20 ");
  $stmt->execute();
  $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ブログ</title>
  <link rel="stylesheet" href="css/style.css"><!-- 共通CSS -->
  <link rel="stylesheet" href="css/top.css">
</head>
<body>
  <!-- ヘッダー -->
  <header id="header">
    <div class="headerBox">
      <div class="headerLogo">
        <a href="index.php"><h1 class="logoTitle">ブログ</h1></a>
        <p class="logoSubtitle">オウンドメディア</p>
      </div>
      <div class="linkToCreateBox">
        <a class="linkToCreate" href="admin/create.php">記事作成</a>
      </div>
    </div>
  </header>
  <!-- メイン -->
  <main>
  <section class="ly_section">
    <div class="ly_section_inner">

      <ul class="card_items">
        <?php foreach($results as $result): ?>
          <li>
            <a class="card_item" href="page.php?id=<?php echo $result['id']; ?>">
              <article>
                <figure class="card_item_imgWrapper">
                  <img src="image.php?id=<?php echo $result['id']; ?>" alt="">
                </figure>
                <div class="card_item_body">
                  <time datetime=" <?php echo $result['updated_at']; ?>" class="card_item_time">
                    <?php echo $result['updated_at']; ?>
                  </time>
                  <h3 class="card_item_ttl"><?php echo $result['title']; ?></h3>
                </div>
              </article>
            </a>
          </li>
      <?php endforeach; ?>
      </ul>
      </div>
    </section>
  </main>
  <!-- フッター -->
  <footer id="footer">
    <p class="footerText">Copyright @ 2023 BLOG, inc</p>
  </footer>

</body>
</html>