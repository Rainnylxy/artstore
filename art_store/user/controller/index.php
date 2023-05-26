<?php
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = 'lxy962464.';
    const DATABASE = 'artstore';
    const CHARSET = 'utf8mb4';
    $method = $_GET['m']??'index';//代表若没有get传入，则默认为index
    $a = $_GET['a']??'showHomePageBefore';
    include 'function.php';
    include '../../mysqlModel.php';
    $method();
    $a();
