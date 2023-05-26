function sliceImg(){
    var imgs=[];
    var a=1;
    var url="http://121.37.103.201/user/controller/homePagePath.php";
    $.ajax({
        url: url,
        method:"post",
        success:function (res){
            console.log(res);
            imgs=JSON.parse(res);
            var img=document.getElementById('img-change');
            var points= document.getElementsByClassName('point');
            var index=0;
            var len =imgs.length;
            points[0].style.backgroundColor='black';
            function slideShow(){
                index++;
                if(index>=len) index=0;
                img.src=imgs[index];
                for(var i=0;i<len;i++){
                    points[i].style.backgroundColor='transparent';
                }
                points[index].style.backgroundColor='black';
            }
            setInterval(slideShow,2000)
        },
        error:function (){
            alert("error")
        }
    })
}