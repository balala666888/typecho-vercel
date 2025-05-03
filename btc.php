<?php
// CoinGecko API URL（公共价格数据，不需要API Key）
$apiUrl = 'https://api.coingecko.com/api/v3/simple/price?ids=bitcoin&vs_currencies=usd';

// 初始化cURL会话
$ch = curl_init($apiUrl);

// 设置cURL选项，将响应作为字符串返回而不是直接输出
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// 执行cURL会话并获取响应
$response = curl_exec($ch);

// 检查是否有cURL错误
if (curl_errno($ch)) {
    echo 'cURL Error: ' . curl_error($ch);
} else {
    // 将响应转换为PHP数组
    $data = json_decode($response, true);

    // 检查是否成功获取数据且数据包含比特币价格
    if (isset($data['bitcoin']['usd'])) {
        $bitcoinPrice = $data['bitcoin']['usd'];
        echo "当前比特币价格为: " . $bitcoinPrice . " USD";
    } else {
        echo "无法获取比特币价格，请检查API URL是否正确。";
    }
}

// 关闭cURL会话
curl_close($ch);
?>
