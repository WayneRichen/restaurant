<?php
session_start(); // 開始 PHP Session
include("db.php"); // 匯入資料庫連線檔案
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // 檢查表單是否已提交
    // 取得前端傳來的餐廳 id 、日期時間
    $restaurant = $_POST['restaurant'];
    $date = $_POST["date"];
    $time = $_POST["time"];
    // 取得 session 中的使用者 id
    $user_id = $_SESSION["id"];

    // 將預約資料寫進資料庫
    $sql = "INSERT INTO reservation (_user, _restaurant, time) VALUES ('$user_id', '$restaurant','$date $time')"; // 此行程式碼使用 $sql 變數存儲一個 SQL 指令字串，用於在 reservation 資料表中新增一筆預約記錄。這個指令字串包含三個欄位：_user、_restaurant 和 time。透過變數插值，這些欄位會被設定為 $user_id、$restaurant 和 $date $time 的值。
    // 這個 if-else 敘述用於檢查 SQL 執行是否成功。如果成功，則會使用 JavaScript 彈窗顯示「預約成功」訊息，並將網頁重新導向回來源網頁；如果失敗，則會使用 JavaScript 彈窗顯示「預約失敗」訊息，並將網頁重新導向回來源網頁。這裡使用 $_SERVER['HTTP_REFERER'] 取得來源網頁的 URL。
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('預約成功');window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
    } else {
        echo "<script>alert('預約失敗');window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
    }
}
$conn->close(); // 關閉資料庫連線
// 沒有提交預約則導回首頁
header('location: /index.php');
?>
