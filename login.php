<?php
error_reporting(0);
//第一次登陆的时候，通过用户输入的信息来确认用户
 if ( (($_POST['username']))!=NULL && (($_POST['password'])!=NULL)) {
    $userName = $_POST['username'];
    $password = $_POST['password'];
    //从db获取用户信息
    //PS：数据库连接信息改成自己的 分别为主机 数据库用户名 密码
    $conn = mysqli_connect('localhost:3306','root','040122');

    mysqli_select_db($conn,'test');

    $sql = "select username,password from user where username = '$userName' and password='$password'";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($res);
    if	($row['username']!=$userName) {
        echo '不能登陆!';
        header('Location:index.html');
    }
    else if($row['username']==$userName&&$row['password']!=$password)
    {
        echo '不能登陆!!';
        header('Location:index.html');
    }
    else if($row['username']!=$userName&&$row['password']!=$password) {
        echo '不能登陆!!!';
        header('Location:index.html');
    }
    
    else if($row['username']==$userName&&$row['password'] ==$password) {
        //如果密码验证通过，设置一个cookies，把用户名保存在客户端
        setcookie('username',$userName,time()+3600);//设置一个小时
        //最后跳转到登录后的欢迎页面
        /*echo '登陆成功!';
        header('Location:https://mghy.lanzouf.com/i0BWF0w6oy2j');//跳转到最后的欢迎页面*/
        echo "<script>alert('登陆成功！！');location.href='https://mghy.lanzouf.com/i0BWF0w6oy2j';</script>";
    }
    }
    else {
        echo '登陆失败';
        header('Location:index.html');//跳转到失败页面
    }

if ( (($_COOKIE['username']) != null)  && (($_COOKIE['password']) != null) ) {
    $userName = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    //从db获取用户信息
    //PS：数据库连接信息改成自己的 分别为主机 数据库用户名 密码
    $conn = mysqli_connect('localhost','root','password','test');
    $res = mysqli_query($conn,"select * from user where username =  '$userName' ");
    $row = mysqli_fetch_assoc($res);
    if ($row['password'] == $password) {
        //验证通过后跳转到登录后的欢迎页面
        header('Location: https://mghy.lanzouf.com/i0BWF0w6oy2j' . "?username=$userName");
    }
}
else {
    echo "<script>alert('用户名或密码错误');location.href='index.html';</script>";
}


?>
