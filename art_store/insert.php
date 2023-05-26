<?php
    include 'mysqlModel.php';
    mysqlModel();

    $sql = "DELETE FROM user WHERE username = 'heiheii'";
    $res = $adcModel($sql);
//    $sql = "UPDATE user SET useremail='xiaoyu' WHERE username='xiaoyu'";
//    $name='heih';
//    $email='200000qq.com';
//    $pass='123456';
//    $sql = "INSERT INTO user(username,useremail,u_pass) VALUES('{$name}','{$email}','{$pass}')";
////    $res = mysqli_fetch_assoc($result);
////    var_dump($res);
////    $res = mysqli_fetch_assoc($result);
////    var_dump($res);
//    if($result && mysqli_affected_rows($link)>0){
//        echo mysqli_insert_id($link);
//    }

