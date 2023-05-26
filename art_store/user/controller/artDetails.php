<?php
    include '../../classes/artWork.php';
    include '../../classes/comment.php';
    include '../../classes/user.php';
    $artWork = new artWork();
    $artId = isset($_GET['artid'])?$_GET['artid']:"";
    $addVisit = isset($_GET['addVisit'])?$_GET['addVisit']:1;
    //防止页面刷新多次改变id
    $artname = isset($_GET['artname'])?$_GET['artname']:"";
    if($artId){
        $sql="WHERE id='{$artId}'";
        $test=$artWork->getWork($sql);
        if(!$test){
            //当订单中的商品被删除时，在allartwork表里面查询来查看商品详细信息
            $ssql="SELECT * FROM allartwork WHERE id='{$artId}'";
            $artInfo=$artWork->conn->query($ssql)->fetch_row();
            if($addVisit){
                $addsql="UPDATE allartwork SET visits=visits+1 WHERE id='{$artId}'";
                $artWork->conn->query($addsql);
                $artWork->change("visits=visits+1 WHERE id='{$artId}'");
            }
        }else{
            $artId=$test[12];
            if($addVisit){
                $artWork->change("visits=visits+1 WHERE id='{$artId}'");
            }
            $cond="WHERE id='{$artId}'";
            $artInfo = $artWork->getWork($cond);
        }
        if($username){
            $addfootsql="INSERT IGNORE INTO userfoot(username,artworkid,artworkname) VALUES ('{$username}','{$artId}','{$artInfo[0]}')";
            $artWork->conn->query($addfootsql);
            $sql1="SELECT * FROM userfoot WHERE username='{$username}' ORDER BY id";
            $a=$artWork->conn->query($sql1)->num_rows;
            $temp=$artWork->conn->query($sql1)->fetch_row();
            if($a>5){
               $updatesql="DELETE FROM userfoot WHERE username='{$username}' AND id='$temp[3]'";
               $artWork->conn->query($updatesql);
            }
        }
    }
    include '../view/artDetails.html';
