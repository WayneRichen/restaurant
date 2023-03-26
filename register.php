<?php
session_start(); // 啟用session
include("db.php"); // 引入資料庫連線設定檔案
// 從 POST 取得使用者輸入的名稱、電子信箱和密碼
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// 對使用者電子信箱進行 mysqli 防注入處理
$email = mysqli_real_escape_string($conn, $email);

// 查詢資料庫中是否已經存在此電子信箱
$sql = "SELECT * FROM user WHERE email = '$email'";
$result = $conn->query($sql);

// 若資料庫已存在此電子信箱，則顯示錯誤訊息
if ($result->num_rows > 0) {
    echo "<script>alert('該 Email 已經註冊過，請再試一次');window.location.replace('register.html');</script>";
} else {
    // 若資料庫不存在此電子信箱，則將使用者資料插入資料庫中
    $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        // 設定 session 變數
        $_SESSION["id"] = mysqli_insert_id($conn);
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        // 顯示成功訊息
        echo "<script>alert('註冊成功，即將跳轉回首頁');window.location.replace('/index.php');</script>";
    } else {
        // 若插入資料失敗，顯示錯誤訊息
        echo "<script>alert('註冊失敗: ". $sql .'  ' . $conn->error . "');window.location.replace('/register.html');</script>";
    }
}

// 關閉資料庫連線
$conn->close();
?>