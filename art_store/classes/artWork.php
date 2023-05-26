<?php
//用于对表artWork的数据库进行访问操作
//表的每个字段对应类的每个成员变量
class artWork
{
    public $name;
    public $author;
    public $price;
    public $visits;
    public $uploaddate;
    public $workdate;
    public $width;
    public $height;
    public $describe;
    public $style;
    public $path;
    public $commentid;
    public $conn;

    function __construct(){
        //连接数据库
        $this->conn= mysqli_connect(HOST,USER,PASSWORD,DATABASE);
        mysqli_set_charset($this->conn,CHARSET);
    }
    function __destruct()
    {
        mysqli_close($this->conn);
    }

    //按照条件获得对应的列表
    function getWorksList($cond){
        $sql = "SELECT * FROM artwork " . $cond;
        return mysqli_query($this->conn,$sql);
    }
    //根据条件获得单个艺术品
    function getWork($cond){
        $sql = "SELECT * FROM artwork " . $cond;
        $res=$this->conn->query($sql)->fetch_row();
        return $res;
    }
    //修改某一属性值
    function change($change){
        $sql = "UPDATE artwork SET ".$change;
        $this->conn->query($sql);
        return mysqli_affected_rows($this->conn);
    }
}