<?php
require __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

try {
    $client = new Client([
        'base_uri' => 'https://www.okx.com/api/v5/', // 欧易 API 基础地址:ml-citation{ref="5,6" data="citationList"}
        'timeout' => 3.0,
        'headers' => ['Accept' => 'application/json']
    ]);

    // 请求现货交易对最新价格接口
    $response = $client->get('market/ticker', [
        'query' => ['instId' => 'BTC-USDT'] // 指定比特币/USDT交易对:ml-citation{ref="5,6" data="citationList"}
    ]);

    $data = json_decode($response->getBody(), true);
    $latestPrice = $data['data'][0]['last'] ?? null;

    if ($latestPrice) {
        echo "【欧易比特币实时价格】\n";
        echo "当前价：$latestPrice USDT\n";
        echo "更新时间：" . date('Y-m-d H:i:s') . "\n";
    } else {
        throw new Exception('价格数据解析异常');
    }

} catch (GuzzleException $e) {
    die("API 请求失败: " . $e->getMessage() . ":ml-citation{ref="6" data="citationList"}");
} catch (Exception $e) {
    die("程序错误: " . $e->getMessage());
}
