<!-- 作成記事一覧 -->
<?php
// ini_set("display_errors", 'On');
// error_reporting(E_ALL);

require_once('../functions.php');
$pdo = connectDB();

$stmt = $pdo->prepare('SELECT * FROM blog_table ORDER BY updated_at DESC');
$status = $stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>記事作成</title>
    <link rel="stylesheet" href="../css/create.css">
</head>

<body>
  <header>
    <a class="linkTo" href="create.php">記事作成</a>
    <a class="linkTo" href="../index.php">トップ</a>
  </header>
  <main>
    <fieldset>
      <legend>記事一覧</legend>
      <table>
        <thead>
            <tr>
                <th>id</th>
                <th>タイトル</th>
                <th>本文</th>
                <th>更新日時</th>
                <th>作成日時</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
          <?php foreach($results as $result): ?>
            <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['title']; ?></td>
                <td><?php echo $result['content']; ?></td>
                <td><?php echo $result['updated_at']; ?></td>
                <td><?php echo $result['created_at']; ?></td>
                <td>
                    <button type="button" class="btn btn-green" onclick="location.href='detail.php?id=<?php echo $result['id']; ?>'">編集</button>
                    <button type="button" class="btn btn-red" onclick="location.href='delete.php?id=<?php echo $result['id'];?>'">削除</button>
                </td>
                
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </fieldset>
  </main>
</body>

</html>