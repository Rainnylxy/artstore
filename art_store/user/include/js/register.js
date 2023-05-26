function test(){
    var username = document.getElementById('username').value;
    var password1 = document.getElementById('password1').value;
    var password2 = document.getElementById('password2').value;
    var email = document.getElementById('email').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;

    var patternName = new RegExp('^[\\w-]{4,15}$');
    var patternEmail = new RegExp('^[\\w]+@+[\\w]+\\.{1}[\\w]{2,}$');
    var patternPwd = new RegExp('^(?![0-9]+$)[\\w-\\@\\$\\%\\^\\&\\*\\?\\!]{6,}$');
    var patternPhone = new RegExp('^[0-9]{11}$');

    if(!username){
        document.getElementById('username-tip').innerText='* please input username';
    }else if(!patternName.test(username)){
        document.getElementById('username-tip').innerText='* username illegal. input like soulvia';
    }else{
        document.getElementById('username-tip').innerText='';
    }

    if(!password1){
        document.getElementById('password-tip').innerText='* please input password';
    }else if(!patternPwd.test(password1)){
        document.getElementById('password-tip').innerText='* password illegal. input like st567.';
    }else if(username&&username===password1){
        document.getElementById('password-tip').innerText='username is same with password';
    }else{
        document.getElementById('password-tip').innerText='';
    }

    if(!password2){
        document.getElementById('confirm-password').innerText='* please input confirm password';
    }else{
        document.getElementById('confirm-password').innerText='';
    }

    if(password1&&password2&&(password1 !== password2)){
        document.getElementById('password-tip').innerText='* please input two same passwords';
        document.getElementById('confirm-password').innerText='* please input two same passwords';
    }else if(password1&&password2){
        document.getElementById('password-tip').innerText='';
        document.getElementById('confirm-password').innerText='';
    }

    if(!email){
        document.getElementById('email-tip').innerText='* please input email';
    }else if(!patternEmail.test(email)){
        document.getElementById('email-tip').innerText='* email illegal.input like 123@qq.com';
    }else{
        document.getElementById('email-tip').innerText='';
    }

    if(!phone){
        document.getElementById('phone-tip').innerText='* please input phone';
    }else if(!patternPhone.test(phone)){
        document.getElementById('phone-tip').innerText='* phone illegal. input 11 numbers';
    }else{
        document.getElementById('phone-tip').innerText='';
    }

    if(!address){
        document.getElementById('address-tip').innerText='* please input address';
    }else{
        document.getElementById('address-tip').innerText='';
    }
    // 设置密码的强度
    // 若为纯字母，纯符号显示weak
    // 若为数字+字母或者数字+符号或者字母+符号显示medium
    // 若为数字+字母+符号则显示strong
    var level=0;
    var password = document.getElementById('password1').value;
    if(password.match(/[a-zA-Z]/g)){
        level++;
    }
    if(password.match(/[-\@\$\%\^\&\*\?\!]/g)){
        level++;
    }
    if(password.match(/[0-9]/g)){
        level++;
    }
    if(level==0){
        document.getElementById('weak').style.display='none';
        document.getElementById('medium').style.display='none';
        document.getElementById('strong').style.display='none';
    }
    if(level==1){
        document.getElementById('weak').style.display='inline';
        document.getElementById('medium').style.display='none';
        document.getElementById('strong').style.display='none';
    }
    if(level==2){
        document.getElementById('medium').style.display='inline';
        document.getElementById('weak').style.display='inline';
        document.getElementById('strong').style.display='none';
    }
    if(level==3){
        document.getElementById('weak').style.display='inline';
        document.getElementById('medium').style.display='inline';
        document.getElementById('strong').style.display='inline';
    }
}