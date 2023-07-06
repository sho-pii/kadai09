<?php
require_once 'functions.php';

$pdo = connectDB();

$sql = 'SELECT * FROM blog_table WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', (int)$_GET['id']);
$stmt->execute();
$image = $stmt->fetch();

header('Content-type:'.$image['type']);
echo $image['image'];

?>