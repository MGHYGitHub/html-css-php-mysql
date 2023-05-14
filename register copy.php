<?php


error_reporting(0);

$username = ($_POST['username']);

$password = trim($_POST['password']);

$conn = mysqli_connect('localhost', 'root', '040122');

//如果有错误，存在错误号
if (mysqli_errno($conn)) {

    echo mysqli_error($conn);

    exit;
}

mysqli_select_db($conn, 'test');   //选择数据库

mysqli_set_charset($conn, 'utf8');   //选择字符集

$sql1 ="insert into user(username,password) values('".$username."','" .$password."')";

$result = mysqli_query($conn, $sql1);//针对user这个数据库进行查询, 查询是否存在有这个用户

$row = mysqli_num_rows($result);//输出查询结果，传给$row



if($_POST['username']==NULL){
    echo "<script>alert('用户名不能为空');location.href='register.html';</script>";
}
else if($_POST['password']== NULL){
    echo "<script>alert('密码不能为空');location.href='register.html';</script>";
}
else{
    if(mysqli_affected_rows($conn)){
        echo "<script>alert('用户名已存在');location.href='register.html';</script>";
    }else{
        $sql1 ="insert into user(username,password) values('".$username."','" .$password."')";//PHP MySQL 插入数据
        $result = mysqli_query($conn, $sql1);//判断插入数据是否成功
        if(mysqli_affected_rows($conn)){
            echo "<script>alert('注册失败！');location.href='register.html';</script>";
        }else{
            echo "<script>alert('注册成功！');location.href='index.html';</script>";
        }
    }
}
mysqli_close($conn);

?>
