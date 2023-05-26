<?php
    include "../../classes/artWork.php";
    $artworkEntity = new artWork();
    $cond = "";
    $res = $artworkEntity->getWorksList($cond);
    $sname=$_SESSION['sname']??"";
    $sartist=$_SESSION['sartist']??"";
    $order=$_SESSION['paixu']??"";
    $allsearch=$_SESSION['allsearch']??"";
    if(isset($_POST['sname'])){
       $sname=$_POST['sname'];
        $_SESSION['sname']=$_POST['sname'];
    }
    if(isset($_POST['sartist'])){
        $sartist=$_POST['sartist'];
        $_SESSION['sartist']=$_POST['sartist'];
    }
    if(isset($_POST['paixu'])){
        $order=$_POST['paixu'];
        $_SESSION['paixu']=$_POST['paixu'];
    }
    if(isset($_POST['allsearch'])){
        $allsearch=$_POST['allsearch'];
        $_SESSION['allsearch']=$_POST['allsearch'];
    }
    if($allsearch){
        $cond=$cond."WHERE CONCAT(name,artist, describ) LIKE CONCAT('%', '{$allsearch}', '%')";
        if($sname){
            $cond=$cond." AND (name LIKE '%{$sname}%')";
        }
        if($sartist){
            $cond=$cond." AND (artist LIKE '%{$sartist}%')";
        }
    }else if($sname){
        $cond=$cond."WHERE (name LIKE '%{$sname}%')";
        if($sartist){
            $cond=$cond." AND (artist LIKE '%{$sartist}%')";
        }
    }else if($sartist){
        $cond=$cond."WHERE (artist LIKE '%{$sartist}%')";
    }

    if($order=="visits"){
        $cond=$cond." ORDER BY {$order} DESC";
    }else if($order=="price"){
        $cond=$cond." ORDER BY {$order}";
    }else if($order=="name"){
        $cond=$cond." ORDER BY CONVERT(name USING GBK)";
    }else if($sname){
        $cond=$cond."ORDER BY(
            CASE
                WHEN name='{$sname}' THEN 1
                WHEN name LIKE CONCAT('{$sname}','%') THEN 2
                WHEN name LIKE '%{$sname}%' THEN 3
                ELSE 4
                END
        )";
        if($sartist){
            $cond=$cond." AND (
            CASE
                WHEN artist='{$sartist}' THEN 1
                WHEN artist LIKE CONCAT('{$sartist}','%') THEN 2
                WHEN artist LIKE '%{$sartist}%' THEN 3
                ELSE 4
                END
        )";
        }
    }else if($sartist){
        $cond=$cond."ORDER BY(
            CASE
                WHEN artist='{$sartist}' THEN 1
                WHEN artist LIKE CONCAT('{$sartist}','%') THEN 2
                WHEN artist LIKE '%{$sartist}%' THEN 3
                ELSE 4
                END
        )";
    }

    $result=$artworkEntity->getWorksList($cond);
    $totalNum=mysqli_num_rows($result);
    if($totalNum){
        $pageNum= $_SESSION['pageNum'] ?? 1;
        $pageSize=6;
        $totalPage = ceil($totalNum / $pageSize);
        if($pageNum<1){
            $pageNum=1;
        }else if($pageNum>$totalPage){
            $pageNum=$totalPage;
        }
        $offset = ($pageNum-1)*$pageSize;
    }else{
        $offset=0;
        $pageSize=0;
        $totalPage=0;
        $pageNum=1;
    }
    $cond=$cond." LIMIT $offset,$pageSize";
    $res=$artworkEntity->getWorksList($cond);
    include "../view/searchPage.html";
