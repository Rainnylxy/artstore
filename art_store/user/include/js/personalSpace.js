function moneyTest(){
    var addMoney=document.getElementById('addMoney').value
    var moneyPattern=new RegExp('^[0-9]+$');
    if(!moneyPattern.test(addMoney)){
        document.getElementById('moneyhint').innerText="* Please input right number";
    }else{
        document.getElementById('moneyhint').innerText="";
    }
}