<?php
session_start();
include("db.php");
$categoryId = $_GET['id'] ?? null;
if ($categoryId == null) {
    header('location: /');
}
$sql = 'SELECT * FROM `category` WHERE `category`.`id` = ' . $categoryId;
$result = $conn->query($sql);
$thisCategory = mysqli_fetch_assoc($result);
if ($thisCategory == null) {
    header('location: /');
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
    <title><?=$thisCategory['name']?> - 餐廳推薦系統</title>
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
        <span class="section-title"><?=$thisCategory['name']?></span>
        <div class="restaurant-list">
        </div>
    </div>
</body>
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved.
</footer>
</html>