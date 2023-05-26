<?php
//所有后台的方法
function index(){
    //登录拦截
    function intercept(){
        session_start();
        $username=$_SESSION['username'];
        if(!$username){
            echo '<script>
            alert("please login!")
            window.location.href="index.php?a=show"</script>';
            exit;
        }
    }
    //显示登录前首页
    function showHomePageBefore(){
        include 'homePageBefore.php';
    }
    //显示登录后首页
    function showHomePageAfter(){
        session_start();
        if(isset($_GET['b'])){
            $_SESSION['username']="";
        }
        $username=$_SESSION['username'];
        if(!$username){
            echo '<script>
            window.location.href="index.php?a=show"</script>';
            exit;
        }
        $username=$_SESSION['username'];
        include 'homePageAfter.php';
    }
    //显示登录页
    function show(){
        $error='';
        $username='';
        $u_pass='';
        include '../view/login.html';
    }
    //显示注册页
    function showRegister(){
        include '../view/register.html';
    }
    //展示所有商品的详情页
    function showAllDetails(){
        session_start();
        $username=isset($_SESSION['username'])?$_SESSION['username']:"";
        include './allArtDetails.php';
    }
    //展示某商品详情页
    function showArtDetail(){
        session_start();
        $username=isset($_SESSION['username'])?$_SESSION['username']:"";
        include './artDetails.php';
    }
    //显示搜索页面
    function showSearch(){
        session_start();
        $username=isset($_SESSION['username'])?$_SESSION['username']:"";
        include './searchPage.php';
    }
    //显示上传与修改页面
    function uploadAndChange(){
        intercept();
        $username=$_SESSION['username'];
        include './uploadAndChange.php';
    }
    //显示个人中心页面
    function personalSpace(){
        intercept();
        include './personalSpace.php';
    }
    //个人购物车页面
    function shoppingCart(){
        intercept();
        include './shoppingCart.php';
    }
}