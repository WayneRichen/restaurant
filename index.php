<?php
session_start();
include("db.php");
$sql = 'SELECT * FROM `category` LIMIT 10';
$result = $conn->query($sql);
$categoryList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categoryList[] = $row;
}
$sql = 'SELECT * FROM `restaurant`';
$result = $conn->query($sql);
$restaurantList = [];
while ($row = mysqli_fetch_assoc($result)) {
    $restaurantList[] = $row;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>餐廳推薦系統</title>
    <link rel="stylesheet" href="common.css">
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header class="header">
        <h1 class="logo"><a href="/">餐廳推薦系統</a></h1>
        <ul class="main-nav">
            <li><a href="/login.php">登入</a></li>
            <li><a href="/register.php">註冊</a></li>
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
        <?php if ($restaurantList): ?>
        <span class="section-title">推薦餐廳</span>
        <div class="restaurant-list">
            <?php foreach ($restaurantList as $restaurant): ?>
            <a href="/restaurant.php?id=<?=$restaurant['id']?>" class="restaurant-card">
                <div class="restaurant-card-image">
                    <img src="<?=$restaurant['image']?>" alt="<?=$restaurant['name']?>" />
                </div>
                <div class="restaurant-card-content">
                    <span class="restaurant-card-title"><?=$restaurant['name']?></span>
                    <div class="restaurant-card-text">
                        <?=$restaurant['description']?>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved.
</footer>
</html>