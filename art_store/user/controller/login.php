<?php
    session_start();
    $username = $_POST['username'];
    $u_pass = $_POST['password'];
    $code = $_POST['checkCode'];
    if($code != $_SESSION['checkCode']){
        $data['code']= 403;
        $data['msg']='check node error!';
    }else{
        include '../../mysqlModel.php';
        include 'tokenAndHashSalt.php';
        $sql = "SELECT * FROM user WHERE username='{$username}' OR useremail='{$username}'";
        mysqlModel();
        $res = $getModel($sql);
        if(!$res){
            $data['code']=401;
            $data['msg']='without this user!';
        }else {
            $hashPwd=getHashPwd($u_pass,$res['salt']);
            if($hashPwd != $res['u_pass']){
                $data['code']=402;
                $data['msg']='password error!';
            }else{

                //    $sql = "UPDATE user SET useremail='xiaoyu' WHERE username='xiaoyu'";
//                $token = createToken($res['id']);
                $_SESSION['username']=$res['username'];
//                $sql = "UPDATE user SET token='{$token}' WHERE id='{$res['id']}'";
//                $updateRes = $adcModel($sql);
                    $data['code']=200;
                    $data['msg']='success login!';
            }
        }
    }
    exit(json_encode($data)) ;

