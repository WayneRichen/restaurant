<?php
session_start(); // 啟動 session
include("db.php"); // 匯入 db.php 檔案，連接資料庫
$categoryId = $_GET['id'] ?? null; // 從網址取得分類 ID，若不存在則設為 null
if ($categoryId == null) { // 如果分類 ID 為 null
    header('location: /index.php'); // 導向首頁
}
$sql = 'SELECT * FROM `category` WHERE `category`.`id` = ' . $categoryId; // 準備 SQL 查詢語句，取得指定分類的資料
$result = $conn->query($sql); // 執行查詢
$thisCategory = mysqli_fetch_assoc($result); // 取得查詢結果的第一行資料
if ($thisCategory == null) { // 如果取得的資料為 null
    header('location: /index.php'); // 導向首頁
}
$sql = 'SELECT * FROM `restaurant` WHERE `restaurant`.`_category` = ' . $categoryId; // 準備 SQL 查詢語句，取得指定分類下的餐廳資料
$result = $conn->query($sql); // 執行查詢
$restaurantList = []; // 宣告一個空的餐廳列表陣列
while ($row = mysqli_fetch_assoc($result)) { // 取得每一行的餐廳資料，並以關聯陣列的方式存入 $row
    $restaurantList[] = $row; // 將 $row 加入 $restaurantList 陣列
}
$sql = 'SELECT * FROM `category` LIMIT 10'; // 準備 SQL 查詢語句，取得前 10 筆分類資料
$result = $conn->query($sql); // 執行查詢
$categoryList = []; // 宣告一個空的分類列表陣列
while ($row = mysqli_fetch_assoc($result)) { // 取得每一行的分類資料，並以關聯陣列的方式存入 $row
    $categoryList[] = $row; // 將 $row 加入 $categoryList 陣列
}
$conn->close(); // 關閉資料庫連線
?>
<!DOCTYPE html> <!-- 告知瀏覽器文件類型為 HTML5 -->
<html lang="zh-Hant"> <!-- 設定語言為繁體中文 -->
<head> <!-- 文件的 header 部分 -->
    <meta charset="UTF-8"> <!-- 設定文件的字元編碼方式為 UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- 設定相容性為 IE 的最新版本 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 設定 viewport 寬度為裝置螢幕寬度，並設定預設縮放比例為 1.0 -->
    <title><?=$thisCategory['name']?> - 餐廳推薦系統</title> <!-- 設定網頁標題為目前的分類名稱 -->
    <link rel="stylesheet" href="common.css"> <!-- 匯入共用的 CSS 檔案 -->
    <link rel="stylesheet" href="index.css"> <!-- 匯入 index 專用的 CSS 檔案 -->
</head>
<body> <!-- 文件的 body 部分 -->
    <header class="header"> <!-- 網頁 header -->
        <h1 class="logo"><a href="/index.php">餐廳推薦系統</a></h1> <!-- 網頁標題 -->
        <ul class="main-nav"> <!-- 網頁主導覽列 -->
            <?php if (!empty($_SESSION['name'])): ?> <!-- 這是一個PHP的條件語句，用來檢查是否有使用者登入網站。如果有，就會顯示使用者的名字以及登出按鈕，否則就會顯示登入和註冊按鈕。 -->
            <li><a>Hi! <?= $_SESSION['name'] ?></a></li> <!-- 這是一個PHP的短碼，用來顯示使用者的名字。< ?= ?>是一種簡寫，相當於< ?php echo ?>。 -->
            <li><a href="/logout.php">登出</a></li> <!-- 這是一個列表項，用來顯示登出按鈕。<a>是一個超連結標籤，用來將按鈕與登出功能連結起來。 -->
            <?php else: ?>
            <li><a href="/login.html">登入</a></li> <!-- 這是一個列表項，用來顯示登入按鈕。<a>標籤的href屬性指定了按鈕要前往的網頁。 -->
            <li><a href="/register.html">註冊</a></li> <!-- 這是一個列表項，用來顯示註冊按鈕。<a>標籤的href屬性指定了按鈕要前往的網頁。 -->
            <?php endif; ?> <!-- 這是一個PHP的結束語句，用來結束if條件語句。 -->
        </ul>
    </header>
    <div class="main"> <!-- 主要內容區塊 -->
        <?php if ($categoryList): ?> <!-- 若有分類資料則顯示 -->
        <div class="category-list"> <!-- 分類列表區塊 -->
            <?php foreach ($categoryList as $category): ?> <!-- 利用迴圈產生分類連結 -->
            <a href="/category.php?id=<?=$category['id']?>" class="category"><?=$category['name']?></a> <!-- 分類連結 -->
            <?php endforeach; ?> <!-- 迴圈結束 -->
        </div>
        <?php endif; ?> <!-- 判斷結束 -->
        <span class="section-title"><?=$thisCategory['name']?></span> <!-- 顯示目前分類名稱 -->
        <div class="restaurant-list"> <!-- 餐廳列表區塊 -->
            <?php foreach ($restaurantList as $restaurant): ?> <!-- 使用迴圈產生每一個餐廳的卡片 -->
            <a href="/restaurant.php?id=<?=$restaurant['id']?>" class="restaurant-card"> <!-- 餐廳卡片的超連結 -->
                <div class="restaurant-card-image"> <!-- 餐廳卡片的圖片區塊 -->
                    <img src="<?=$restaurant['image']?>" alt="<?=$restaurant['name']?>" /> <!-- 餐廳卡片的圖片 -->
                </div>
                <div class="restaurant-card-content"> <!-- 餐廳卡片的內容區塊 -->
                    <span class="restaurant-card-title"><?=$restaurant['name']?></span> <!-- 餐廳卡片的標題 -->
                    <div class="restaurant-card-text"> <!-- 餐廳卡片的文字內容 -->
                        <?=$restaurant['description']?> <!-- 餐廳的描述 -->
                    </div>
                </div>
            </a>
            <?php endforeach; ?> <!-- 迴圈結束 -->
        </div>
    </div>
</body>
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved.  <!-- 頁尾宣告 -->
</footer>
</html>