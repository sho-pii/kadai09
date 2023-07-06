<!-- 登録処理 -->
<?php
// ini_set("display_errors", 'On');
// error_reporting(E_ALL);

require_once('../functions.php');
$pdo = connectDB();

    if (!empty($_FILES['image']['name'])) {
    $created_at = $_POST['created_at'];
    $updated_at = $_POST['created_at'];
    $title   = $_POST['title'];
    $image = file_get_contents($_FILES['image']['tmp_name']);
    $content = $_POST['content'];
    $type = $_FILES['image']['type'];

    $stmt = $pdo->prepare(
        'INSERT INTO
                            blog_table(
                                created_at, updated_at, title, content, type, image
                                )
                            VALUES (
                                :created_at,:updated_at, :title, :content, :type, :image
                                );'
    );

    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);
    $stmt->bindValue(':created_at', $created_at, PDO::PARAM_STR);
    $stmt->bindValue(':updated_at', $updated_at, PDO::PARAM_STR);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image, PDO::PARAM_STR);
    $status = $stmt->execute(); //実行
    } 

    header('Location: select.php');
    exit();

