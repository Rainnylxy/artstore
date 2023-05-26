<?php
include '../../classes/artWork.php';
$artworkEntity=new artWork();
$username=$_SESSION['username'];
$artworkid=isset($_POST['artworkid'])?$_POST['artworkid']:0;
$_SESSION['artworkid']='';
if(isset($_POST['delete'])&&$_POST['delete']){
    $searchByUserSql="WHERE (id in (SELECT artworkid FROM shopcart WHERE username='{$username}')) AND status=0";
    $shoparts=$artworkEntity->getWorksList($searchByUserSql);
    while($res=$shoparts->fetch_row()){
        $updateStatussql="UPDATE artwork SET status=1 WHERE id='{$res[12]}'";
        $artworkEntity->conn->query($updateStatussql);
        $updateOrderSql="INSERT IGNORE INTO  orderlist(artworkid,artworkname,artworkprice,ordertime,buyname,sellname) VALUES('{$res[12]}','{$res[0]}','{$res[2]}',NOW(),'{$username}','{$res[5]}')";
        $artworkEntity->conn->query($updateOrderSql);
        $deleteCartsql="DELETE FROM shopcart WHERE username='{$username}' AND artworkid='{$res[12]}'";
        $artworkEntity->conn->query($deleteCartsql);
    }
}
if($artworkid&&isset($_SESSION['artworkid'])&&$_SESSION['artworkid']!=$artworkid){
    $deletesql="DELETE FROM shopcart WHERE artworkid='{$artworkid}' AND username='{$username}'";
    $artworkEntity->conn->query($deletesql);
    $_SESSION['artworkid']=$artworkid;
}
$searchByUserSql="WHERE (id in (SELECT artworkid FROM shopcart WHERE username='{$username}'))";
$shoparts=$artworkEntity->getWorksList($searchByUserSql);
$usersql="SELECT * FROM user WHERE username='{$username}'";
$user=$artworkEntity->conn->query($usersql)->fetch_row();
include '../view/shoppingCart.html';
