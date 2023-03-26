<?php
$servername = "mariadb";  // 設定要連接的資料庫伺服器名稱，連接本機 MySQL 請輸入 localhost
$username = "root";  // 資料庫使用者名稱
$password = "";  // 資料庫使用者密碼
$dbname = "restaurant";  // 要連接的資料庫名稱

$conn = new mysqli($servername, $username, $password, $dbname);  // 建立一個新的 MySQLi 物件，用來連接到指定的 MySQL 資料庫

// 檢查是否成功連接到 MySQL 資料庫，如果連線失敗則印出錯誤訊息並結束程式
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}