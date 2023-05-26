<?php
const HOST = 'localhost';
const USER = 'root';
const PASSWORD = 'lxy962464.';
const DATABASE = 'artstore';
const CHARSET = 'utf8mb4';
include "../../classes/artWork.php";
    $artworkEntity=new artWork();
    $artworks=$artworkEntity->getWorksList("");
    $i=0;
    while(($artwork=$artworks->fetch_row())&&$i<5){
        $data[$i]=$artwork[11];
        $i++;
    }
    exit(json_encode($data));