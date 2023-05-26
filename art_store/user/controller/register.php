<?php
    error_reporting(0);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $flag=1;
    if(!preg_match('^[\\w-]{4,15}$',$username)){
        $flag=0;
    }
    if(!preg_match('^[\\w]+@+[\\w]+\\.{1}[\\w]{2,}$',$email)){
        $flag=0;
    }
    if(!preg_match('^(?![0-9]+$)[\\w-\\@\\$\\%\\^\\&\\*\\?\\!]{6,}$',$passsword)){
        $flag=0;
    }
    if(!preg_match('^[0-9]{11}$',$phome)){
        $flag=0;
    }
    if(!($username&&$passsword&&$email&&$phone&&$address)){
        $flag=0;
    }
    
    if($flag==0){
        exit( "<script>alert('please input right information!');
            window.location.href='./index.php?a=showRegister';
        </script>");
    }
    include 'tokenAndHashSalt.php';

    $salt = createSalt($password);
    $u_pass = getHashPwd($password,$salt);

    include '../../mysqlModel.php';
    mysqlModel();
    $sql = "SELECT * FROM user WHERE username='{$username}' OR useremail='{$email}'";
    $res = $getModel($sql);
    if($res){
        exit( "<script>alert('this user has existed!');
            window.location.href='./index.php?a=showRegister';
        </script>");
    }
    $sql = "INSERT INTO user(username,useremail,u_pass,salt,phone,address) VALUES('{$username}','{$email}','{$u_pass}','{$salt}','{$phone}','{$address}')";
    mysqlModel();
    $res = $adcModel($sql);
    if($res){
        exit( "<script>
                alert('success register!')
                window.location.href='./index.php?a=show';
              </script>");
    }