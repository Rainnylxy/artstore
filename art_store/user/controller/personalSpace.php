<?php
include '../../classes/user.php';
include '../../classes/artWork.php';
$artworkEntity=new artWork();
$userEntity = new user();
$username=$_SESSION['username'];
$sql="WHERE username='{$username}'";
if(isset($_POST['delete'])){
    $deleteSql="DELETE FROM artwork WHERE id='{$_POST['artworkid']}' AND username='{$username}' AND status=0";
    $userEntity->conn->query($deleteSql);
    if(mysqli_affected_rows($userEntity->conn)==0){
        $data['code']='401';
    }else{
        $data['code']='200';
    }
    exit(json_encode($data));
}
if(isset($_POST['addMoney'])){
    $addMoneySql="UPDATE user SET leftmoney=leftmoney+'{$_POST['addMoney']}' WHERE username='{$username}'";
    $userEntity->conn->query($addMoneySql);
}
$user=$userEntity->getUser($sql);
$artworks=$artworkEntity->getWorksList($sql);
$buySql="SELECT * FROM orderlist WHERE buyname='{$username}'";
$sellSql="SELECT * FROM orderlist WHERE sellname='{$username}'";
$buyList=$artworkEntity->conn->query($buySql);
$sellList=$artworkEntity->conn->query($sellSql);

$footsql="WHERE id in (SELECT artworkid FROM userfoot WHERE username='{$username}')";
$footarts=$artworkEntity->getWorksList($footsql);


include '../view/personalSpace.html';
