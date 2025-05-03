<?php
session_start();

// 假设我们有一个名为 $username 和 $password 的POST请求
$username = $_POST['username'];
$password = $_POST['password'];

// 这里我们硬编码了用户名和密码，仅用于示例
$valid_username = 'admin';
$valid_password = 'password123';

if ($username == $valid_username && $password == $valid_password) {
    // 登录成功，设置会话变量
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;
    header("Location: welcome.php"); // 重定向到欢迎页面
    exit();
} else {
    // 登录失败，显示错误消息
    echo "用户名或密码错误。";
}
?>
