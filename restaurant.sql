-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： mariadb
-- 產生時間： 2023 年 03 月 25 日 09:53
-- 伺服器版本： 10.7.4-MariaDB-1:10.7.4+maria~focal
-- PHP 版本： 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `restaurant`
--

-- --------------------------------------------------------

--
-- 資料表結構 `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, '台式料理'),
(2, '日式料理'),
(3, '韓式料理'),
(4, '義式料理'),
(5, '美式料理'),
(6, '甜點'),
(7, '飲料');

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `_user` int(10) NOT NULL,
  `_restaurant` int(10) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `_user` int(10) NOT NULL,
  `_restaurant` int(10) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 資料表結構 `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `_category` int(10) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `_category`, `description`, `image`) VALUES
(1, '築間幸福鍋物', 1, '築間幸福鍋物唯一擁有自有海產拱應鏈，獨創招牌石頭鍋湯底風味令人回味無窮，以高性價比餐點滿足顧客需求。除海鮮鍋物外提供優質牛豬羊肉火鍋料理，呈現食材原味。', '/image/jhujian.jpg'),
(2, '地表最強燒肉丼', 2, '《激高CP值》完勝燒肉的戰役！小資族也可以輕鬆吃的丼飯，牛、豚、干貝等都有，海陸大盛一起GET。你看見那Ｑ彈米飯上肥滋滋的油花嗎？這麼好吃的丼飯哪裡找！午晚餐最佳首選，幸福就從這開丼。', '/image/kaidon.jpg'),
(3, '豆腐村韓國嫩豆腐煲專門店', 3, '來自家鄉傳承的韓式料理風味，歷經三十年耕耘，造就「豆腐村」對食材情感與品味堅持，\r\n亦以手工製成非基改豆腐與韓式石鍋米飯口感，\r\n創造家鄉最具經典韓食傳統餐點，同時滿足台灣人的味蕾與健康養身之道。', '/image/tofu_village.jpg'),
(4, '創義麵 Creative Pasta', 4, '我們以義、台料理為靈感，藉由彈牙的現煮麵盛載當季食材的美味，創造屬於台灣人的義大利麵。希望每個人在這裡都能找到一道療癒料理，踏進創義麵就能輕鬆脫下整日的煩惱與疲憊，與我們一起好好吃一頓飯。', '/image/creative_pasta.jpg'),
(5, '德州美墨炸雞', 5, '德州美墨炸雞以進口原料特別調製7種特殊醬料醃製，讓雞肉完全吸收醬料的味道，並於下鍋前以兩道黃金裹粉程序，造就外酥內嫩、垂涎三尺的德州美墨炸雞。', '/image/rangers.jpg'),
(6, 'OMOMO 韓系飲品咖啡廳', 6, '漫步在中央公園，不難發現一間隱身在公園旁的小仙境，獨棟裝潢的飾品咖啡廳！  ｜Welcome to｜ 【全台首間】韓系飲品咖啡廳 ft. 飾品店 享受置身於首爾街道上的幸福慢生活 戴著飾品｜喝著咖啡，詠嘆美好日常。', '/image/omomo.jpg'),
(7, '再睡5分鐘 NAP TEA', 7, '由YouTube界珍奶女神-滴妹與團隊共同創辦的品牌。朝願景「讓每天多一點療癒」前進，致力成為帶給人療癒的品牌。以療癒為核心，將每個細節做到超乎期待，成為一個值得分享的品牌。', '/image/napteazzz.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
