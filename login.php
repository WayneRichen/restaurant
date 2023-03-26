<?php
session_start(); // 啟動 session
include("db.php"); // 匯入資料庫連線設定

$email = $_POST['email']; // 獲取表單提交的 Email
$password = $_POST['password']; // 獲取表單提交的密碼

$email = mysqli_real_escape_string($conn, $email); // 使用 mysqli_real_escape_string 防止 SQL 注入攻擊，對 $email 進行處理

// 構建查詢語句，查詢是否有匹配的使用者名稱和密碼
$sql = "SELECT * FROM `user` WHERE `user`.`email` = '$email' AND `user`.`password` = '$password';";
$result = $conn->query($sql); // 執行 SQL 查詢

// 檢查查詢結果是否有匹配的用戶
if ($result->num_rows > 0) { // 如果查詢到匹配的用戶
    $row = $result->fetch_assoc(); // 獲取查詢結果的第一行作為陣列
    $_SESSION["id"] = $row['id']; // 把用戶 ID 儲存在 session 中
    $_SESSION["name"] = $row['name']; // 把用戶名稱儲存在 session 中
    $_SESSION["email"] = $row['email']; // 把用戶 Email 儲存在 session 中
    header('location: /index.php'); // 跳轉到首頁
} else {
    echo "<script>alert('帳號密碼錯誤');window.location.replace('login.html');</script>"; // 提示帳號或密碼錯誤，並跳轉到登入頁面
}
$conn->close(); // 關閉資料庫連線
?>