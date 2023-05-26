<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="referrer" content="no-referrer">
    <title>homePageAfter</title>
    <link href="../include/css/homePageBefore.css" rel="stylesheet">
    <script src="../include/js/homePage.js"></script>
    <script src="../include/js/jquery-3.5.1.min.js"></script>
</head>
<body onload="sliceImg()">
<?PHP
include '../../classes/artWork.php';
$artWorks = new artWork();
$cond="ORDER BY visits desc";
$list = $artWorks->getWorksList($cond);
?>
<div id="main-div">
    <div>
        <span id="name-logo">Wisdom Waste</span>
        <br>
        <span id="describe">you can find anything that you are interested in</span>
        <a href="./index.php?a=showSearch" class="search">Search</a>
        <a href="./index.php?a=personalSpace" class="right-up-link" id="username"><?=$username?></a>
        <a href="./index.php?a=showHomePageAfter&b=logout" class="right-up-link" id="logout">Logout</a>
    </div>
    <div>
        <br>
        <span id="medium-p">W i s d o m--W a s t e</span>
        <span id="medium-intro">A place where art waste lives in</span>
        <br><br><br>
        <nav class="medium-nav">
            <a href="./index.php?a=showHomePageAfter" class="nav-link" id="homepage">HomePage</a>
            <a href="./index.php?a=personalSpace" class="nav-link">My Space</a>
            <a href="./index.php?a=showAllDetails" class="nav-link">ShopDetails</a>
            <a href="./index.php?a=shoppingCart" class="nav-link" id="cart">My Cart</a>
            <a href="./index.php?a=uploadAndChange" class="nav-link">Upload</a>
        </nav>
    </div>
    <br><br>
    <div id="slide-up">
        <div id="slide-left" >
            <span class="img-class">featured</span>
            <br>
            <span class="img-class">--</span>
            <div>
                <img src="../../public/img/homeMainPhoto.png" alt="轮播图" id="img-change"/>
                <nav class="pointList">
                    <span class="point"></span>
                    <span class="point"></span>
                    <span class="point"></span>
                    <span class="point"></span>
                    <span class="point"></span>
                </nav>
            </div>
        </div>
        <div id="slide-right">
            <span class="img-class">hottest</span>
            <br>
            <span class="img-class">--</span>
            <br>
            <div id="hottest-frame" style="">
                <?PHP
                $i=0;
                while(($i<3)&&($row = $list->fetch_row()))
                {
                    ?>
                    <div style="margin-left: 0;width: 180px;padding-left: 0;display: inline-block"><a href="./index.php?a=showArtDetail&artid=<?=$row[12]?>"><img src="<?=$row[11]?>" alt="最热作品1" class="latest-work"></a></div>
                    <div class="msg">
                        <span>Name: </span><?=$row[0]?><br>
                        <span>Artist: </span><?=$row[1]?><br>
                        <span>Price: </span>$<?=$row[2]?>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                        <span>Visits: </span><?=$row[3]?$row[3]:'0000'?><br>
                        <span>Introduction: <span><?=$row[9]?$row[9]:'no introduction'?>
                    <br>
                    <a href="./index.php?a=showArtDetail&artid=<?=$row[12]?>" class="right-up-link">See Details</a>
                    </div>
                    <?php
                    $i++;
                }
                ?>
            </div>
        </div>
    </div>
    <br>
    <br>
    <div id="slide-down">
        <span class="img-class-low">latest</span>
        <br>
        <span class="img-class-low">--</span>
        <br><br>
        <div >
            <?php
            $cond="ORDER BY uploaddate DESC";
            $list=$artWorks->getWorksList($cond);
            $i=0;
            while(($row=$list->fetch_row())&&($i<4)){
                ?>
                <div class="img-down">
                    <a href="./index.php?a=showArtDetail&artid=<?=$row[12]?>">
                        <img src="<?=$row[11]?>" class="hottest-work">
                    </a>
                    <br>
                    <div class="msg">
                        <span>Name: </span><?=$row[0]?><br>
                        <span>Artist: </span><?=$row[1]?>&nbsp;&nbsp;
                        <span>Price: </span>$<?=$row[2]?>&nbsp;&nbsp;&nbsp;&nbsp;<br>
                        <span>Uploaddate: </span><?=$row[4]?><br>
                        <span>Introduction: <span><?=$row[9]?$row[9]:'no introduction'?>
                    <br>
                    <a href="./index.php?a=showArtDetail&artid=<?=$row[12]?>" class="right-up-link">See Details</a>
                                <br><br>
                    </div>
                </div>
                <?php
                $i++;}
            ?>
        </div>
    </div>
    </div>
    <div id="foot">
        <br><br>
        <hr>
        Have a good mood these days.
        <br>
        this is just available for lxy@2022. if you have any question, please send email to 2975533710@qq.com
        <br>
    </div>
</div>
</body>
</html>