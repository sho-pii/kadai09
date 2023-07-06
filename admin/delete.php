<!-- 記事削除処理 -->
<?php
$id = $_GET['id'];

require_once('../functions.php');
$pdo = connectDB();

$stmt = $pdo->prepare('DELETE FROM blog_table WHERE id = :id');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute(); //実行

if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    header('Location: select.php');
    exit();
}