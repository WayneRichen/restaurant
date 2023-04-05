 # 餐廳推薦系統

## 資料表規格

### category - 餐廳分類資料表
欄位|id*|name|
|--|--|--|
類型|int|varchar|
說明|分類索引，主鍵|分類名稱|
|範例|1|台式料理|

### restaurant - 餐廳資料表
欄位|id*|name|_category|description|image|rank
|--|--|--|--|--|--|--|
類型|int|varchar|int|text|varchar|float|
說明|餐廳索引，主鍵|餐廳名稱|分類，category 外鍵|描述|圖片|評分|
|範例|1|築間幸福鍋物|1|築間幸福鍋物唯一擁有自有海產拱應鏈，獨創招牌石頭鍋湯底風味令人回味無窮，以高性價比餐點滿足顧客需求。|/image/jhujian.png|4.9|

### user - 使用者資料表
欄位|id*|name|email|password|
|--|--|--|--|--|
類型|int|varchar|varchar|varchar|
說明|使用者索引，主鍵|使用者姓名|Email，唯一值|密碼|
|範例|1|陳宜真|irene@email.com|password|

### comment - 評論資料表
欄位|id*|_user|_restaurant|content|
|--|--|--|--|--|
類型|int|int|int|text
說明|評論索引，主鍵|使用者 id，外鍵|餐廳 id，外鍵|評論內容
|範例|1|1|1|點餐方式是選擇主餐跟湯底，菜盤採自助式拿去。蔬菜補菜蠻快的，但動線有點擁擠，跟其他分店比起來新鮮度稍差一些。

### reservation - 訂位資料表
欄位|id*|_user|_restaurant|time|
|--|--|--|--|--|
類型|int|int|int|datetime
說明|訂位索引，主鍵|使用者 id，外鍵|餐廳 id，外鍵|訂位時間
|範例|1|1|1|2023-04-01 12:00:00