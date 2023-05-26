function toSomePageChoose(data){
   var chopage=(data.innerText);
    slicePage(chopage)
}
function toSomePageInput(){
    var inpage = document.getElementById('inputpage').value;
    slicePage(inpage)
}
function toLastPage(){
    var pageNow = document.getElementById('pageNum').innerText;
    slicePage(--pageNow)
}
function toNextPage(){
    var pageNow = document.getElementById('pageNum').innerText;
    slicePage(++pageNow)
}
function slicePage(pageNum){
    var msg="pageNum="+pageNum;
    console.log(msg)
    var request=new XMLHttpRequest();
    request.open('POST','./getPageNum.php',true);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    request.send(msg)
    request.onreadystatechange=function (){
        if(request.readyState==4&&request.status==200){
            console.log("success connect!!")
        }
    }
    window.location.href="./index.php?a=showSearch";
}
