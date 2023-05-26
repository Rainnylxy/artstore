<?php
$pageNum = isset($_POST['pageNum'])?(int)$_POST['pageNum']:1;
session_start();
$_SESSION['pageNum']=$pageNum;
$data['pageNum']=$pageNum;
exit(json_encode($data));