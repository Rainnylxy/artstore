<?php
//用于对表comment进行相关操作
class comment
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
    function getCommentsList($cond){
        $sql = "SELECT * FROM comment " . $cond;
        return mysqli_query($this->conn,$sql);
    }
    //根据条件获得单个艺术品
    function getComment($cond){
        $sql = "SELECT * FROM comment " . $cond;
        $res=$this->conn->query($sql)->fetch_row();
        return $res;
    }
    //修改某一属性值
    function change($change){
        $sql = "UPDATE comment SET ".$change;
        $this->conn->query($sql);
        return mysqli_affected_rows($this->conn);
    }
    //删除某一内容
    function delete($delete){
        $sql = "DELETE FROM comment ".$delete;
        $this->conn->query($sql);
        return mysqli_affected_rows($this->conn);
    }
}