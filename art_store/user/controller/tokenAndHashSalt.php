<?php
//    echo createSalt('adminn');
//    echo '<br>';
//    echo getHashPwd('adminn',createSalt('adminn'));
    function createSalt($password){
        $chars = md5($password);
        $n=strlen($chars);
        $salt = $chars[rand(0,$n-1)].$chars[rand(0,$n-1)].$chars[rand(0,$n-1)].$chars[rand(0,$n-1)].$chars[rand(0,$n-1)];
        return $salt;
    }
    function getHashPwd($password, $salt){
        return hash('md5',$password.$salt);
    }
    //利用userId产生token
    function createToken($userId){
        $time = time();
        //设置token过期时间为一天
        $endTime = $time + 86400;
        $info = $userId.'~'.$time.'~'.$endTime;
        $signature = hash('md5',$info);
        return $info.'~'.$signature;
    }

    //检查token,token是否存在在前端判断
    function checkToken($token){
         $explode = explode('~',$token);
         if(count($explode)==4){
             if(time()>$explode[2]){
                 $res['code']=402;
                 $res['msg']='token overdue!';
             }else{
                 $info = $explode[0].'~'.$explode[1].'~'.$explode[2];
                 $true_signature = hash('md5',$info);
                 if($true_signature == $explode[3]){
                     $res['code']=200;
                     $res['msg']='token legal!';
                 }else{
                     $res['code']=401;
                     $res['msg']='token illegal!';
                 }
             }
         }else{
             $res['code']=401;
             $res['msg']='token illegal!';
         }
         return $res;
    }
