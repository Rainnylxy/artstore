<?php
include '../../classes/artWork.php';
$artworkEntity = new artWork();
    if(isset($_GET['artid'])){
        $art=$artworkEntity->getWork("WHERE id='{$_GET['artid']}'");
        $photopath=$art[11];
        $artid=$_GET['artid'];
    }else{
        $photopath="../../public/img/添加图片.png";
        $artid=0;
    }
    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
        $filename = $file['name'];
        if($filename){
            $pathname = $file['tmp_name'];
            $data=array('smfile'=>new \CURLFile(realpath($pathname)));
    
            $ch=curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($ch,CURLOPT_URL,'https://sm.ms/api/v2/upload');
            curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization:cgO8xQaUrsCsZycoK3iFVHn2y1X29ld5'));
            curl_setopt($ch,CURLOPT_POST,true);
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
    
            $res=curl_exec($ch);
            if($error=curl_error($ch)){
                echo $error;
            }else{
                curl_close($ch);
                $res=json_decode($res,true);
                $photopath=isset($res['images'])?$res['images']:$res['data']['url'];
            }
        }
    }
    if(isset($_POST['name'])){
        if(!$artid){
            $addsql="INSERT IGNORE INTO artwork (name,artist,price,uploaddate,username,date,width,height,describ,style,path,sect) VALUES ('{$_POST['name']}','{$_POST['artist']}','{$_POST['price']}',NOW(),'{$_SESSION['username']}','{$_POST['date']}','{$_POST['width']}','{$_POST['height']}','{$_POST['describe']}','{$_POST['style']}','{$photopath}','{$_POST['sect']}')";
            $artworkEntity->conn->query($addsql);
            echo "<script>alert('upload success!')</script>";
        }else{
            $seaql="WHERE id='{$artid}'";
            $art=$artworkEntity->getWork($seaql);
            if($art[14]==1){
                echo "<script>alert('It has been sold. you can not change it!')</script>";
                exit;
            }
            $changesql="UPDATE artwork set name='{$_POST['name']}',artist='{$_POST['artist']}',price='{$_POST['price']}',uploaddate=NOW(),username='{$_SESSION['username']}',date='{$_POST['date']}',width='{$_POST['width']}',height='{$_POST['height']}',
                        describ='{$_POST['describe']}',style='{$_POST['style']}',path='{$photopath}',sect='{$_POST['sect']}' WHERE id='$artid'";
            $artworkEntity->conn->query($changesql);
            if(mysqli_affected_rows($artworkEntity->conn)>0){
                $changeSql="UPDATE artwork SET changestatus='1' WHERE id='$artid'";
                $artworkEntity->conn->query($changeSql);
            }
            $art=$artworkEntity->getWork("WHERE id='{$artid}'");
            echo "<script>alert('change success!')</script>";
        }
    }
    include '../view/uploadAndChange.html';
