<?php
session_start(); // 開始使用 session
session_destroy(); // 結束當前使用的 session
echo "<script>alert('登出成功，即將跳轉回首頁');window.location.replace('/index.php');</script>"; // 顯示訊息，並導向回首頁
?>