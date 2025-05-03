<?php
function getBitcoinFearGreedIndex() {
    $url = 'https://api.alternative.me/fng/';
    
    try {
        // 获取数据
        $data = file_get_contents($url);
        $json = json_decode($data, true);
        
        if (isset($json['data'][0]['value'])) {
            $value = (int)$json['data'][0]['value'];
            $classification = $json['data'][0]['value_classification'];
            $timestamp = $json['data'][0]['timestamp'];
            
            return [
                'value' => $value,
                'classification' => $classification,
                'timestamp' => date('Y-m-d H:i:s', $timestamp),
                'interpretation' => interpretFearGreedIndex($value)
            ];
        } else {
            return ['error' => '无法获取恐惧贪婪指数数据'];
        }
    } catch (Exception $e) {
        return ['error' => 'API请求失败: ' . $e->getMessage()];
    }
}

// 解释恐惧贪婪指数
function interpretFearGreedIndex($value) {
    if ($value <= 25) {
        return "极度恐惧 - 市场可能超卖，是买入机会";
    } elseif ($value <= 45) {
        return "恐惧 - 市场谨慎";
    } elseif ($value <= 55) {
        return "中性 - 市场平衡";
    } elseif ($value <= 75) {
        return "贪婪 - 市场乐观";
    } else {
        return "极度贪婪 - 市场可能过热，考虑谨慎";
    }
}

// 获取并显示结果
$result = getBitcoinFearGreedIndex();

if (isset($result['error'])) {
    echo "错误: " . $result['error'];
} else {
    echo "<h2>比特币恐惧贪婪指数</h2>";
    echo "<p>当前指数: <strong>{$result['value']} ({$result['classification']})</strong></p >";
    echo "<p>更新时间: {$result['timestamp']}</p >";
    echo "<p>解读: <strong>{$result['interpretation']}</strong></p >";
    
    // 可视化展示
    echo '<div style="width:100%; background:#eee; height:30px; margin:10px 0;">';
    echo '<div style="width:'.$result['value'].'%; background:';
    echo ($result['value'] > 50) ? 'green' : 'red';
    echo '; height:30px;"></div></div>';
    
    echo "<h3>指数参考标准</h3>";
    echo "<ul>";
    echo "<li>0-25: 极度恐惧</li>";
    echo "<li>26-45: 恐惧</li>";
    echo "<li>46-55: 中性</li>";
    echo "<li>56-75: 贪婪</li>";
    echo "<li>76-100: 极度贪婪</li>";
    echo "</ul>";
}
?>
