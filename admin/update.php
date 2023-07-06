<!-- 記事更新処理 -->
<?php
// ini_set("display_errors", 'On');
// error_reporting(E_ALL);

$created_at = $_POST['created_at'];
$updated_at = $_POST['updated_at'];
$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id'];

require_once('../functions.php');
$pdo = connectDB();

if (!empty($_FILES['image']['tmp_name'])) {
  // 画像ファイルが選択されている場合の処理
  $image = file_get_contents($_FILES['image']['tmp_name']);
  $type = $_FILES['image']['type'];

  $stmt = $pdo->prepare('UPDATE blog_table
                          SET updated_at = :updated_at,
                              created_at = :created_at,
                              title = :title,
                              type = :type,
                              content = :content,
                              image = :image
                          WHERE id = :id;');

  $stmt->bindValue(':title', $title, PDO::PARAM_STR);
  $stmt->bindValue(':content', $content, PDO::PARAM_STR);
  $stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
  $stmt->bindValue(':updated_at', $updated_at, PDO::PARAM_STR);
  $stmt->bindValue(':type', $type, PDO::PARAM_STR);
  $stmt->bindValue(':image', $image, PDO::PARAM_STR);
} else {
  // 画像ファイルが選択されていない場合の処理
  $stmt = $pdo->prepare('UPDATE blog_table
                          SET updated_at = :updated_at,
                              created_at = :created_at,
                              title = :title,
                              content = :content
                          WHERE id = :id;');

  $stmt->bindValue(':title', $title, PDO::PARAM_STR);
  $stmt->bindValue(':content', $content, PDO::PARAM_STR);
  $stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
  $stmt->bindValue(':updated_at', $updated_at, PDO::PARAM_STR);
}

$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

if ($status === false) {
  $error = $stmt->errorInfo();
  exit('SQLError:' . print_r($error, true));
} else {
  header('Location: select.php');
  exit();
}
