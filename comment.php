<?php
session_start(); // 啟動 Session
include("db.php"); // 匯入資料庫連線檔案
if ($_SERVER['REQUEST_METHOD'] === 'POST') { // 檢查表單是否已提交
    if (isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['restaurant']) && !empty($_POST['restaurant'])) { // 檢查評論欄位以及餐廳 ID 是否存在且不為空
        $userid = $_SESSION['id']; // 取得目前 Session 中的 userid
        $restaurantid = $_POST['restaurant']; // 取得提交的餐廳 id

        // 將評論插入 comment 資料表
        $comment = $_POST['comment'];
        $sql = "INSERT INTO comment (_user, _restaurant, content) VALUES ('$userid', '$restaurantid', '$comment')";

        if ($conn->query($sql) === TRUE) {
            if (isset($_SERVER['HTTP_REFERER'])) { // 新增留言成功，導向原本的頁面
                echo "<script>alert('新增評論成功');window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
            } else { // 如果無法獲取上一個頁面的 URL，則導向首頁
                echo "<script>alert('新增評論成功');window.location.replace('/index.php');</script>";
            }
        } else {
            if (isset($_SERVER['HTTP_REFERER'])) { // 新增留言失敗，導向原本的頁面
                echo "<script>alert('新增評論失敗');window.location.replace('" . $_SERVER['HTTP_REFERER'] . "');</script>";
            } else { // 如果無法獲取上一個頁面的 URL，則導向首頁
                echo "<script>alert('新增評論失敗');window.location.replace('/index.php');</script>";
            }
        }
        // 關閉資料庫連線
        $conn->close();
    }
} else { // 沒有提交評論則導回首頁
    header('location: /index.php');
}
// 沒有提交評論則導回首頁
header('location: /index.php');