<?php
session_start();
include("db.php");
$restaurantId = $_GET['id'] ?? null;
if ($restaurantId == null) {
    header('location: /index.php');
}
$sql = 'SELECT * FROM `restaurant` WHERE `restaurant`.`id` = ' . $restaurantId;
$result = $conn->query($sql);
$restaurant = mysqli_fetch_assoc($result);
if ($restaurant == null) {
    header('location: /index.php');
}
$sql = 'SELECT * FROM `category` LIMIT 10';
$result = $conn->query($sql);
$categoryList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categoryList[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$restaurant['name']?> - 餐廳推薦系統</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
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
    <div class="main">
        <?php if ($categoryList): ?>
        <div class="category-list">
            <?php foreach ($categoryList as $category): ?>
            <a href="/category.php?id=<?=$category['id']?>" class="category"><?=$category['name']?></a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <span class="section-title"><?=$restaurant['name']?></span>
        <div class="restaurant-list">
        </div>
    </div>
</body>
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved.
</footer>
</html>