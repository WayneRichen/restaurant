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
$sql = 'SELECT * FROM `category` LIMIT 10'; // 查詢資料庫取得前 10 個分類
$result = $conn->query($sql); // 執行查詢
$categoryList = []; // 儲存分類資訊的陣列
while ($row = mysqli_fetch_assoc($result)) { // 將查詢結果放入陣列
    $categoryList[] = $row;
}
$sql = 'SELECT * FROM `comment` JOIN `user` ON `user`.`id` = `comment`.`_user` WHERE `comment`.`_restaurant` = ' . $restaurantId; // 這段 SQL 語法是在選擇某個餐廳底下的所有留言，並且還會顯示留言者的個人資料。具體來說，這個 SQL 語法會把留言表(comment)和使用者表(user)做聯集(join)，使用者表和留言表會透過使用者ID(_user)和留言者欄位(_restaurant)做連結。在WHERE子句中，會篩選出屬於特定餐廳的留言，這個特定的餐廳是$restaurantId。最後，通過選擇所有欄位的方式(*)，顯示出所有相關的資訊。
$result = $conn->query($sql); // 將SQL查詢語句傳遞給$conn物件，並返回查詢結果
$commentList = []; // 建立一個空陣列，用於儲存獲取的資料
while ($row = mysqli_fetch_assoc($result)) { // 遍歷查詢結果，將每一行資料存儲到$commentList陣列中
    $commentList[] = $row; // 將目前行的資料添加到$commentList陣列的末尾
}
$conn->close(); // 關閉資料庫連線
?>
<!DOCTYPE html> <!-- 宣告文件類型為 HTML5 -->
<html lang="zh-Hant"> <!-- 設定語言為繁體中文 -->
<head>
    <meta charset="UTF-8"> <!-- 設定文件編碼為 UTF-8 -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> <!-- 設定瀏覽器相容性 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- 設定裝置寬度及縮放比例 -->
    <title><?=$restaurant['name']?> - 餐廳推薦系統</title> <!-- 設定網頁標題，使用 PHP 印出餐廳名稱 -->
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
        <?php if ($categoryList): ?> <!-- 判斷是否有分類清單 -->
        <div class="category-list"> <!-- 設定分類清單區塊的樣式 -->
            <?php foreach ($categoryList as $category): ?> <!-- 使用迴圈輸出分類清單 -->
            <a href="/category.php?id=<?=$category['id']?>" class="category"><?=$category['name']?></a> <!-- 設定分類的超連結及名稱 -->
            <?php endforeach; ?> <!-- 迴圈結束 -->
        </div>
        <?php endif; ?> <!-- 判斷結束 -->
        <div class="restaurant-content"> <!-- 一個名為"restaurant-content"的div容器開始 -->
            <?php if (!empty($restaurant['image'])): ?> <!-- 如果$restaurant['image']不為空，則執行下面的代碼 -->
            <img src="<?=$restaurant['image']?>" /> <!-- 顯示餐廳圖片，圖片來源為$restaurant['image'] -->
            <?php endif; ?> <!-- 結束if語句 -->
            <h1 class="restaurant-name"><?=$restaurant['name']?></h1> <!-- 顯示餐廳名稱，名稱來源為$restaurant['name']，使用class為"restaurant-name"的樣式 -->
            <span>評分：<?=$restaurant['rank']?></span>
            <p><?=$restaurant['description']?></p> <!-- 顯示餐廳描述，描述來源為$restaurant['description'] -->
            <div class="comments">
                <h2 class="comments-title">評論</h2>
                <?php if (empty($commentList)): ?> <!-- 如果評論列表為空 -->
                    這裡還沒有任何評論，成為第一個評論的人！
                <?php else: ?> <!-- 如果評論列表不為空 -->
                    <!-- 顯示每個評論的姓名和內容 -->
                    <?php foreach ($commentList as $comment): ?>
                        <div class="comment">
                            <span><?= $comment['name'] ?></span><br>
                            <?= $comment['content'] ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php if (empty($_SESSION['id'])): ?> <!-- 如果使用者未登入 -->
                    立即<a href="/login.html">登入</a>發表評論！
                <?php else: ?> <!-- 如果使用者已登入 -->
                    <form class="new-comment" action="/comment.php" method="POST"> <!-- 顯示發表評論的表單 -->
                        <textarea rows="9" name="comment"></textarea> <!-- 評論的內容 -->
                        <input type="hidden" name="restaurant" value="<?=$restaurant['id']?>" /> <!-- 隱藏的欄位，用來傳遞餐廳 ID -->
                        <div class="comment-submit">
                            <button type="submit">送出</button> <!-- 送出按鈕 -->
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div> <!-- 結束div容器 -->
    </div>
    <a href="/reservation.php?id=<?=$restaurant['id']?>" class="float"><!-- 連結至餐廳訂位頁面的按鈕，使用 PHP 的 $restaurant['id'] 變數取得餐廳 ID，並將其傳遞至 reservation.php 頁面進行處理，class="float" 則是為了讓按鈕浮動於畫面右下角。 -->
        立即訂位
    </a>
</body> <!-- HTML 文件主要內容結束 -->
<footer>
    &copy; <script>document.write(new Date().getFullYear())</script> 餐廳推薦系統 - All Rights Reserved. <!-- 設定頁尾版權資訊 -->
</footer>
</html> <!-- HTML 文件結束 -->
