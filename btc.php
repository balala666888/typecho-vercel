<?php
require 'vendor/autoload.php'; // 根据你的项目结构调整autoload.php的路径

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd');

$data = json_decode($response->getBody()->getContents(), true);

if (isset($data['bitcoin']['usd'])) {
    $bitcoinPrice = $data['bitcoin']['usd'];
    echo "当前比特币价格为: " . $bitcoinPrice . " USD";
} else {
    echo "无法获取比特币价格。";
}
?>
