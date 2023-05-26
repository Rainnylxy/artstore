<?php
    session_start();
    $chars='23456789abcdefghjkmnpqrst';//设置候选字符，排除易混淆字符
    $n=strlen($chars);
    $code=$chars[rand(0,$n-1)].$chars[rand(0,$n-1)].$chars[rand(0,$n-1)].$chars[rand(0,$n-1)];
    //将验证码存入session
    $_SESSION['checkCode']=$code;
    $im = imagecreate(70,30);
    //第一次使用为设置背景颜色
    imagecolorallocate($im,204,216,226);
    //获得绘制的颜色
    $color = imagecolorallocate($im,0,0,0);
    imagestring($im, 5,6,4,$code[0].' '.$code[1].' '.$code[2].' '.$code[3],$color);
    header("Content-Type:image/jpeg");
    imagejpeg($im);
    imagedestroy($im);