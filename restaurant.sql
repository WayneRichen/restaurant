-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： mariadb
-- 產生時間： 2023 年 03 月 31 日 04:54
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
  `image` varchar(200) NOT NULL,
  `rank` float NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `restaurant`
--

INSERT INTO `restaurant` (`id`, `name`, `_category`, `description`, `image`, `rank`) VALUES
(1, '築間幸福鍋物', 1, '築間幸福鍋物唯一擁有自有海產拱應鏈，獨創招牌石頭鍋湯底風味令人回味無窮，以高性價比餐點滿足顧客需求。除海鮮鍋物外提供優質牛豬羊肉火鍋料理，呈現食材原味。<br>日本A5和牛鍋物<br><img src=\"https://www.jhujian.com.tw/upload/fac_list_pic/tw_fac_list_19i12_qg4srkff6m.jpg\" />', '/image/jhujian.jpg', 4.9),
(2, '地表最強燒肉丼', 2, '《激高CP值》完勝燒肉的戰役！小資族也可以輕鬆吃的丼飯，牛、豚、干貝等都有，海陸大盛一起GET。你看見那Ｑ彈米飯上肥滋滋的油花嗎？這麼好吃的丼飯哪裡找！午晚餐最佳首選，幸福就從這開丼。', '/image/kaidon.jpg', 4.7),
(3, '豆腐村韓國嫩豆腐煲專門店', 3, '來自家鄉傳承的韓式料理風味，歷經三十年耕耘，造就「豆腐村」對食材情感與品味堅持，\r\n亦以手工製成非基改豆腐與韓式石鍋米飯口感，\r\n創造家鄉最具經典韓食傳統餐點，同時滿足台灣人的味蕾與健康養身之道。', '/image/tofu_village.jpg', 4.5),
(4, '創義麵 Creative Pasta', 4, '我們以義、台料理為靈感，藉由彈牙的現煮麵盛載當季食材的美味，創造屬於台灣人的義大利麵。希望每個人在這裡都能找到一道療癒料理，踏進創義麵就能輕鬆脫下整日的煩惱與疲憊，與我們一起好好吃一頓飯。', '/image/creative_pasta.jpg', 4.8),
(5, '德州美墨炸雞', 5, '德州美墨炸雞以進口原料特別調製7種特殊醬料醃製，讓雞肉完全吸收醬料的味道，並於下鍋前以兩道黃金裹粉程序，造就外酥內嫩、垂涎三尺的德州美墨炸雞。', '/image/rangers.jpg', 4.9),
(6, 'OMOMO 韓系飲品咖啡廳', 6, '漫步在中央公園，不難發現一間隱身在公園旁的小仙境，獨棟裝潢的飾品咖啡廳！  ｜Welcome to｜ 【全台首間】韓系飲品咖啡廳 ft. 飾品店 享受置身於首爾街道上的幸福慢生活 戴著飾品｜喝著咖啡，詠嘆美好日常。', '/image/omomo.jpg', 4.2),
(7, '再睡5分鐘 NAP TEA', 7, '由YouTube界珍奶女神-滴妹與團隊共同創辦的品牌。朝願景「讓每天多一點療癒」前進，致力成為帶給人療癒的品牌。以療癒為核心，將每個細節做到超乎期待，成為一個值得分享的品牌。', '/image/napteazzz.jpg', 4.4),
(8, 'PEPPER LUNCH 胡椒廚房', 2, 'Pepper Lunch胡椒廚房，嚴選各式新鮮食材，經由您自已來混合拌炒，再搭配我們特調秘製醬汁，打造奇妙料理體驗，同時創造自我風格的專屬美味！\r\n日本專利鐵板，可於70秒內快速加熱至260度，輕鬆鎖住食材的鮮嫩原味，而鐵板在經過20分鐘後，仍可維持80度高溫，提供您健康溫暖的熱食享受！\r\n胡椒廚房希望讓每一位客人了解－在胡椒廚房「你就是主廚！」\r\n讓每一道料理透過客人的巧手，完美呈現它的好滋味。', '/image/pepperlunch.jpg', 4.7),
(9, '大戶屋', 2, '讓大眾的飲食生活趨向更好\r\n是大戶屋經營外食連鎖餐館真誠的理念\r\n大戶屋深信為了讓大眾的身體更健康、擁有更充沛的精力\r\n必須用嚴謹的作業與真心的態度提供大眾健康美味旦平價的家庭料理\r\n大白屋\r\n用心安排餐點營養的均衡\r\n僅限使用對身體有益的食材\r\n嚴格選定食材產地，不添加任何多餘的東西\r\n用滿滿的心意 ，現場手工調製，體現食材原味與力量的料理\r\n大戶屋帶給您原汁原味的日本家庭料理', '/image/ootoya.jpg', 4.2),
(10, '橘色涮涮屋', 1, '台灣頂級鍋物始祖-橘色涮涮屋，創始店位於台北東區巷弄，以「新鮮食材」、「優雅空間」、「貼心服務」為特色，是許多政商名流用餐或宴客的首選。\r\n橘色餐飲集團的創立從橘色涮涮屋為起始點...\r\n橘色涮涮屋由過往長期旅居美國並在美國即從事專業餐飲的 袁永定先生所創辦。\r\n\r\n當初以希望能夠開設心目中最嚮往的頂級涮涮鍋餐廳，設定目標後，嗅聞了當時的市場動向，加上過往的豐富餐飲經驗、在客戶服務獨特的服務心法，在2000年末，以橘色涮涮屋打開了橘色餐飲事業的開端。\r\n\r\n隨著時光推移，以顧客服務導向、優雅舒適空間等核心經營理念陸續籌劃了Extension 1 by 橘色、Sakura健康生活館、美式早午餐餐廳M One Cafe、M One Spa，將生活中各式可以透過體驗的享受，以橘色餐飲的服務衷心，以嚮同好。', '/image/orangeshabushabu.jpg', 4),
(11, '北村豆腐家', 3, '北村八景位於韓國首爾，以傳統韓屋建築風格而聞名。回憶中，北村有著百年韓屋曲線流暢的木頭屋頂、低而寬木門窗、方形堅固的柱墩及陳年泡菜甕，在這裡猶如回到久未見的家鄉。', '/image/hanoktofu.png', 4.5),
(12, 'NU PASTA', 4, 'NU堅持嚴選食材、創新餐點美味，讓您享用物超所值的新美食饗宴。一盤簡單的義大利麵，承載著對家人用心與疼惜，就是這份簡單的愛與感動，成就了現在的NU PASTA！\r\n\r\nNU PASTA是以義大利麵、義式焗飯、專業手工茶飲、創意小點的創意品牌，用高品質的原料與技術，呈現出現點主食，精緻、平價的餐點服務，希望人人都能享有五星級的待遇與五星級的享受。\r\n\r\n讓消費者在明亮的開放式空間裡享受美食所帶來的美感與誘惑，感動您視覺、味覺、嗅覺的新飲食創意品牌。', '/image/nupasta.webp', 4.6),
(13, '冒煙的喬', 5, '冒煙的喬餐廳提供各具特色餐廳擺設與多種異國料理，讓您盡情享受悠閒的氛圍及融合美食的精彩饗宴，攜手共譜異國的浪漫！\r\n\r\n冒煙的喬系列餐廳除了特製美墨經典料理，豐富多樣的異國融合餐點，是在地人口耳相傳的歡聚首選。此外，由品牌延伸成立的「瑪瑪米亞精緻外燴」與「冒煙的喬外燴」，專業而細膩的貼心服務，滿足各式活動展演需求。從高雄、墾丁、台南到台中，冒煙的喬系列餐廳與旅店，以深入人心的特色建築群像，逐步成為城市地標及美食先驅。', '/image/smokeyjoes.jpg', 4.8),
(14, '聖瑪麗', 6, '用聖瑪莉的心，觸動美好的味覺饗宴＂，觸動大眾你我的心。 聖瑪莉擁有 35 年以上烘焙經驗，堅持新鮮食材與進口原物料，並結合時尚潮流，將烘焙帶入嶄新的領域。  除了每日新鮮出爐麵包，也提供多種精緻甜點，讓消費者每日都有新感受新體驗。 我們希望帶給你的不只是麵包而是幸福的暖心力量。並將「明亮、溫暖、健康、歡樂」傳播到每一個角落。', '/image/sunmerry.jpg', 4.2),
(15, '大苑子', 7, '「大苑」本為台灣某個時期的古地名，我們自詡為「台灣之子」，因此命名為「大苑子」。秉持著台灣精神，大苑子不僅要帶給大家美味且健康的茶飲，更要創造每一次的感動，更多一點用心，服務親切視每位客人如家人，嚴選當令鮮果產地契作直送以確保品質，就像 LOGO 中所展現「家」的感覺。', '/image/dayungs.jpg', 4.7);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
