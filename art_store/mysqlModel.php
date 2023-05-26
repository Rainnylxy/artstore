<?php
    function mysqlModel(){
        //连接数据库

        include 'config/config.php';
        $link = mysqli_connect(HOST,USER,PASSWORD,DATABASE) or die('fail to connect the database');
        mysqli_set_charset($link,CHARSET);
        //增删改
        GLOBAL $adcModel;
        $adcModel = function($sql) use($link){
            $result = mysqli_query($link,$sql);
            if($result && mysqli_affected_rows($link)>0){
                $id = mysqli_insert_id($link);
                $affected = mysqli_affected_rows($link);
                //关闭数据库的链接
                mysqli_close($link);
                //若为插入操作，则返回id。否则返回影响行
                return !empty($id)?$id:$affected;
            }else{
                mysqli_close($link);
                return false;
            }
        };
        //查询数据，返回二维数组
        GLOBAL $searchModel;
        $searchModel = function ($sql) use($link){
            //查询操作返回对象
            $result = mysqli_query($link,$sql);
            $arr = array();
            if($result && mysqli_num_rows($result)>0){
                while ($row = mysqli_fetch_assoc($result)){
                    $arr[] = $row;
                }
            }
            mysqli_close($link);
            return $arr;
        };
        //统计数据总数（分页）
        GLOBAL $totalModel;
        $totalModel = function ($sql) use($link){
            $result = mysqli_query($link,$sql);
            if($result && mysqli_num_rows($result)>0){
                $num = mysqli_num_rows($result);
                mysqli_close($link);
                return $num;
            }else{
                mysqli_close($link);
                return 0;
            }
        };
        //查询单条数据
        GLOBAL $getModel;
        $getModel = function ($sql) use ($link){
            $result = mysqli_query($link,$sql);
            $arr = array();
            if($result && mysqli_num_rows($result)>0){
                $arr = mysqli_fetch_assoc($result);
                mysqli_close($link);
            }
            return $arr;
        };
        //关闭数据库
    }
