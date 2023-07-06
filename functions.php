<?php
function connectDB() {
  try {
  $db_name = 'kadai09'; //データベース名
  $db_id   = 'root'; //アカウント名
  $db_pw   = ''; //パスワード：MAMPは'root'
  $db_host = 'localhost'; //DBホスト
  $pdo = new PDO('mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host, $db_id, $db_pw);
  return $pdo;
} catch (PDOException $e) {
  exit('DB Connection Error:' . $e->getMessage());
}
}