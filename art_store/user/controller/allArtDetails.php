<?php
    include '../../classes/artWork.php';
    $allArtWork = new artWork();
    $cond="";
    $allArtWorkList =$allArtWork->getWorksList($cond);
    include '../view/allArtDetails.html';
