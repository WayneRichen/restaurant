<?php
session_start(); // 開始 PHP Session
include("db.php"); // 匯入資料庫連線檔案
$restaurantId = $_GET['id'] ?? null; // 從 GET 取得餐廳 ID
if ($restaurantId == null) { // 如果餐廳 ID 是 null，將網頁導向首頁
    header('location: /index.php');
}
$sql = 'SELECT * FROM `restaurant` WHERE `restaurant`.`id` = ' . $restaurantId; // 查詢資料庫取得該餐廳的詳細資訊
$result = $conn->query($sql); // 執行查詢
$restaurant = mysqli_fetch_assoc($result); // 將查詢結果轉換成陣列
if ($restaurant == null) { // 如果查詢結果為 null，將網頁導向首頁
    header('location: /index.php');
}
$sql = "SELECT * FROM `reservation` WHERE `reservation`.`_restaurant` = $restaurantId ORDER BY `reservation`.`time`";
$result = $conn->query($sql); // 將SQL查詢語句傳遞給$conn物件，並返回查詢結果
$reservationList = []; // 建立一個空陣列，用於儲存獲取的資料
while ($row = mysqli_fetch_assoc($result)) { // 遍歷查詢結果，將每一行資料存儲到$reservationList陣列中
    $reservationList[] = $row; // 將目前行的資料添加到$reservationList陣列的末尾
}
$conn->close(); // 關閉資料庫連線
?>
<!DOCTYPE html> <!-- 宣告文件類型為 HTML5 -->
<html lang="zh-Hant"> <!-- 設定語言為繁體中文 -->
<head>
    <meta charset="UTF-8"> <!-- 設定文件編碼為 UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- 設定瀏覽器相容性 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 設定裝置寬度及縮放比例 -->
    <title>訂位 <?=$restaurant['name']?> - 餐廳推薦系統</title> <!-- 設定網頁標題，使用 PHP 印出餐廳名稱 -->
    <link rel="stylesheet" href="common.css"> <!-- 引入共用的 CSS 樣式表 -->
    <link rel="stylesheet" href="index.css"> <!-- 引入首頁的 CSS 樣式表 -->
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
    <div class="main"> <!-- 設定主要區塊的樣式 -->
        <div class="restaurant-content"> <!-- 一個名為"restaurant-content"的div容器開始 -->
        <h1 class="restaurant-name">訂位 <?=$restaurant['name']?></h1> <!-- 顯示餐廳名稱，名稱來源為$restaurant['name']，使用class為"restaurant-name"的樣式 -->
        <form method="POST" action="/reserve.php"> <!-- 預約表單 -->
            <input type="hidden" name="restaurant" value="<?=$restaurant['id']?>" /> <!-- 隱藏的餐廳 ID，使用 PHP 的短語法 echo 將 $restaurant['id'] 的值填入 value 屬性 -->
            <div>
                <!-- 日期選擇器，使用 HTML5 新增的 date 屬性，最小值為今天，最大值為一個月後 -->
                <label for="date">日期：</label>
                <input type="date" name="date" min="<?=date('Y-m-d')?>" max="<?=date('Y-m-d', strtotime('+1 month'))?>" class="datetime" required>
            </div>
            <div>
                <!-- 時間選擇器，使用 HTML5 新增的 time 屬性 -->
                <label for="time">時間：</label>
                <input type="time" name="time" class="datetime" required>
            </div>
            <div class="comment-submit">
                <!-- 送出按鈕 -->
                <button type="submit">預約</button>
            </div>
        </form>
        <?php if ($reservationList): ?> <!-- 如果有預約紀錄，顯示預約一覽表 -->
        <div>
            <table>
                <thead>
                    <tr>
                        <td>預約一覽</td>
                    </tr>
                </thead>
                <?php foreach($reservationList as $reservation): ?> <!-- 在這個 foreach 迴圈中，$reservationList 是一個陣列，其中每個元素代表一筆預約記錄。迴圈會逐一將 $reservationList 中的元素賦值給 $reservation 變數，並執行迴圈內的程式碼，直到 $reservationList 中的所有元素都被處理完畢。 -->
                <tr>
                    <td><?=date('Y-m-d l H:i', strtotime($reservation['time']))?></td> <!-- 使用 date() 函式將預約時間轉換成指定格式的日期字串 -->
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
        </div> <!-- 結束div容器 -->
    </div>
</body> <!-- HTML 文件主要內容結束 -->
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved. <!-- 設定頁尾版權資訊 -->
</footer>
</html> <!-- HTML 文件結束 -->
