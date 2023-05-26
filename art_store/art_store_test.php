<?php
   $link=mysqli_connect('localhost','root','lxy962464.','artstore') or die('连接数据库失败');
   var_dump($link);
   $r = mysqli_set_charset($link,'utf8mb4');
   var_dump($r);
   $sql = "SELECT username FROM user WHERE id=30";
   $result = $link->query($sql);//执行成功返回对象，失败返回FALSE
   var_dump($result);
   $rows = mysqli_num_rows($result);
   var_dump($rows);

//   if($rows){
//       $row=mysqli_fetch_assoc($result);//从头开始返回一行的数据
//       var_dump($row);
//       echo '<h1>'.$row['username'].'</h1>';
//   }
   mysqli_close($link);