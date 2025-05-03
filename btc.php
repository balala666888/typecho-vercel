<?php
// 定义API请求参数  
$symbol = 'BTCUSDT';  
$api_url = "https://api.binance.com/api/v3/ticker/price?symbol=$symbol";  

// 初始化cURL请求:ml-citation{ref="2" data="citationList"}  
$ch = curl_init();  
curl_setopt($ch, CURLOPT_URL, $api_url);  
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
curl_setopt($ch, CURLOPT_TIMEOUT, 5);  // 设置超时时间  

// 发送请求并解析响应  
$response = curl_exec($ch);  
if (curl_errno($ch)) {  
    die("请求失败: " . curl_error($ch));  
}  
curl_close($ch);  

// 解码JSON数据  
$data = json_decode($response, true);  
if (json_last_error() !== JSON_ERROR_NONE) {  
    die("JSON解析失败: " . json_last_error_msg());  
}  

// 输出价格信息  
if (isset($data['price'])) {  
    echo "当前比特币价格（BTC/USDT）: " . $data['price'];  
} else {  
    echo "未获取到有效价格数据";  
}  
?>
