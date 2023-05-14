<?php

error_reporting(0);

$username = ($_POST['username']);

$password = trim($_POST['password']);

$conn = mysqli_connect('localhost', 'root', '040122');

if (!$conn) {
    die('连接MySQL失败! ' . mysqli_connect_errno());
}

if (!mysqli_select_db($conn, 'test')) {
    die('选择数据库失败! ' . mysqli_error($conn)); 
}

mysqli_set_charset($conn, 'utf8');

$sql = "SELECT COUNT(*) FROM user WHERE username='$username'";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_row($result);

if ($_POST['username']==NULL) {
    echo "<script>alert('用户名不能为空');location.href='register.html';</script>";
} else if ($_POST['password']== NULL) {
    echo "<script>alert('密码不能为空');location.href='register.html';</script>";
} else {
    if ($row[0] > 0) {
        echo "<script>alert('用户名已存在');location.href='register.html';</script>";
    } else {
        $sql = "INSERT INTO user (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "<script>alert('注册失败！');location.href='register.html';</script>";
        } else {
            echo "<script>alert('注册成功！');location.href='index.html';</script>";
        }
    }
}

mysqli_close($conn);

?>
