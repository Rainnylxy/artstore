<?php
$OWNER="souvil";
$REPO="artstore-images";
$PATH="uploading/";
$file=$_FILES['file'];
$filename=$file['name'];
function send_post($url,$post_data){
    $postdata=http_build_query($post_data);
    $options=array(
      'http'=> array(
          'method'=>'POST',
          'header'=>'Content-type:application/x-www-form-urlencoded',
          'content'=>$postdata,
          'timeout'=> 15*60
      )
    );
    $context=stream_context_create($options);
    $result=file_get_contents($url,false,$context);
    return $result;
}
//需要根据文件名生成指定的请求URL
$pathname=$file['tmp_name'];
$img=file_get_contents($pathname);
$path="https://gitee.com/api/v5/repos/$OWNER/$REPO/contents/$PATH".$filename;
$data['access_token']="33c11f5e8a60030a36dbea132bd4cdbc";
$data['message']="add photo";
$data['content']=base64_encode($img);
$res=send_post($path,$data);
echo json_encode($res);
