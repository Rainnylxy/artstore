<?php
//用于存储已经注册的用户，实现用户的
class user
{
    var $conn;

    function __construct(){
        //连接数据库
        $this->conn= mysqli_connect(HOST,USER,PASSWORD,DATABASE);
        mysqli_set_charset($this->conn,CHARSET);
    }
    function __destruct()
    {
        // TODO: Implement __destruct() method.
        mysqli_close($this->conn);
    }

    //按照条件获得对应的列表
    function getUsersList($cond){
        $sql = "SELECT * FROM user " . $cond;
        return mysqli_query($this->conn,$sql);
    }
    //根据条件获得单个艺术品
    function getUser($cond){
        $sql = "SELECT * FROM user " . $cond;
        $res=$this->conn->query($sql)->fetch_row();
        return $res;
    }
    //修改某一属性值
    function change($change){
        $sql = "UPDATE comment SET ".$change;
        $this->conn->query($sql);
        return mysqli_affected_rows($this->conn);
    }
}