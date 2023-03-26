<?php
session_start(); // 啟動 session 功能，可讓網頁在同一個使用者的不同頁面之間共用資料。
include("db.php"); // 匯入資料庫連接檔案 db.php，該檔案應該包含了與資料庫連接所需的程式碼。
// 建立 SQL 查詢字串，以查詢前 10 筆 category 資料。
$sql = 'SELECT * FROM `category` LIMIT 10';
// 執行 SQL 查詢，並儲存查詢結果至 $result 變數中。
$result = $conn->query($sql);
// 建立一個空陣列 $categoryList，用來儲存查詢結果。
$categoryList = [];
// 從 $result 中取出一筆資料，並將其儲存至 $categoryList 陣列中。這個動作會一直執行，直到沒有資料可以取得為止。
while ($row = mysqli_fetch_assoc($result)) {
    $categoryList[] = $row;
}
// 建立 SQL 查詢字串，以查詢所有 restaurant 資料。
$sql = 'SELECT * FROM `restaurant`';
// 執行 SQL 查詢，並儲存查詢結果至 $result 變數中。
$result = $conn->query($sql);
// 建立一個空陣列 $restaurantList，用來儲存查詢結果。
$restaurantList = [];
// 從 $result 中取出一筆資料，並將其儲存至 $restaurantList 陣列中。
while ($row = mysqli_fetch_assoc($result)) {
    $restaurantList[] = $row;
}
// 關閉資料庫連線
$conn->close();
?>
<!DOCTYPE html> <!-- 宣告文件類型為 HTML -->
<html lang="zh-Hant"> <!-- HTML 文件開始標籤，並設定語言為繁體中文 -->
<head> <!-- 網頁 Head 區塊 -->
    <meta charset="UTF-8"> <!-- 設定網頁字元編碼為 UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- 設定 IE 瀏覽器相容性標籤 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 設定網頁顯示比例 -->
    <title>餐廳推薦系統</title> <!-- 設定網頁標題 -->
    <link rel="stylesheet" href="common.css"> <!-- 匯入 common.css 樣式表 -->
    <link rel="stylesheet" href="index.css"> <!-- 匯入 index.css 樣式表 -->
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
    <!-- 網頁主要內容 -->
    <div class="main">
        <?php if ($categoryList): ?> <!-- 如果有分類清單，顯示分類清單區塊 -->
        <div class="category-list">
            <?php foreach ($categoryList as $category): ?> <!-- 利用迴圈產生分類連結 -->
            <a href="/category.php?id=<?=$category['id']?>" class="category"><?=$category['name']?></a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php if ($restaurantList): ?> <!-- 如果有餐廳清單，顯示餐廳推薦區塊 -->
        <span class="section-title">推薦餐廳</span>
        <div class="restaurant-list"> <!-- 餐廳列表區塊 -->
            <?php foreach ($restaurantList as $restaurant): ?> <!-- 利用迴圈產生餐廳卡片 -->
            <a href="/restaurant.php?id=<?=$restaurant['id']?>" class="restaurant-card">  <!-- 餐廳卡片的超連結 -->
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
        <?php endif; ?>
    </div>
</body>
<!-- 網頁頁尾 -->
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved. <!-- 頁尾宣告 -->
</footer>
</html>