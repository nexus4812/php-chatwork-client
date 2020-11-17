# php-chatwork-client

[チャットワークAPI](https://developer.chatwork.com/ja/index.html)をPHPで利用する為のライブラリです。

## 利用要件
このライブラリを利用するには下記の要件を満たす必要があります。

```text
PHP >= 7.1.3
ext-json PHP拡張
ext-curl PHP拡張
チャットワークAPIトークンの発行
```

## 使い方
オブジェクトの生成

```php
$chatwork = Nexus\ChatworkClient\Api\Chatwork::create('## Your API Token ##');
```


取得結果は`Nexus\ChatworkClient\Entities`で定義されたオブジェクトが返されます。

```php
// 自分の情報を取得する
$me = $chatwork->me()->getMe();

echo($me->room_id);             // 322
echo($me->name);                // Nexus
echo($me->avatar_image_url);    // https://example.com/abc.png
```


結果が複数の場合、Laravelの[Collection](https://readouble.com/laravel/8.x/ja/collections.html)クラスが返されます
```php
// タスク期限が明日のタスクを抽出する
$tomorrow = Carbon::Today()->addDay();
$tasks = $chatwork->myTask()->getTasks()->filter(function (Task $task) {
    // タイムスタンプはすべてCarbonで取得できます
    return $tomorrow->isSameDay($task->limitTime());
});

$tasks->each(function (Task $task) {
    echo($task->room->name);    // 営業運用チームチャット
    echo($task->body);          // A社の提案資料作成をお願いします
});
```