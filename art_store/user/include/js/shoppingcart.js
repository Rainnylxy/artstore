function confirmPay(){
    var sellflag=document.getElementById('sellflag').value;
    var selloutname=document.getElementById('selloutname').value;
    var allmoney=document.getElementById('allprice').value;
    var leftmoney=document.getElementById('myleft').value;
    var newmoney=leftmoney-allmoney;
    if(sellflag==1){
        alert("Sorry, artwork "+selloutname+" has been sold out!");
    }else if(newmoney<0){
        alert("Sorry, your left money is not enough!")
    }else if(allmoney==0){
        return 0;
    }else{
        var newmoney=leftmoney-allmoney;
        var request=new XMLHttpRequest();
        request.open('POST','./index.php?a=shoppingCart',true);
        request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        var msg="delete=1"+"&newmoney="+newmoney;
        request.send(msg)
        request.onreadystatechange=function (){
            if(request.readyState==4&&request.status==200){
                alert("succeed creating your orders!")
            }
        }
        $("#dialog").hide()
        $("#dialog-mask").hide()
        window.location.href="./index.php?a=shoppingCart";
    }
}