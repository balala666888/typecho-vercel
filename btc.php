<?php
$apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd&x_cg_demo_api_key=CG-NRDfCrYvDnwimvWbb4XgfdWu';

$ch = curl_init($apiUrl);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 10,
    CURLOPT_HTTPHEADER => ['User-Agent: MyApp/1.0']  // 模拟浏览器请求
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} elseif ($httpCode != 200) {
    echo "API请求失败，HTTP状态码：{$httpCode}";
} else {
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "JSON解析失败：" . json_last_error_msg();
    } elseif (isset($data['bitcoin']['usd'])) {
        echo "当前比特币价格：" . $data['bitcoin']['usd'] . " USD";
    } else {
        echo "价格字段缺失，响应数据：" . print_r($data, true);
    }
}

curl_close($ch);
?>
