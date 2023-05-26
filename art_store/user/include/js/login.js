function test(){
    var username = document.getElementById('username').value;
    var pwd = document.getElementById('password').value;
    var checkCode = document.getElementById('check-code').value;
    if(!username){
        document.getElementById('hint').innerText='* please input username or email';
        return false;
    }else if(isNotRightUsername(username)){
        document.getElementById('hint').innerText='* username or email illegal';
        return false;
    }else{
        document.getElementById('hint').innerText='';
    }

    if(!pwd){
        document.getElementById('hint').innerText='* please input password';
        return false;
    }else if(isNotRightPwd(pwd)){
        document.getElementById('hint').innerText='* password illegal';
        return false;
    }else{
        document.getElementById('hint').innerText='';
    }

    if(!checkCode){
        document.getElementById('hint').innerText='* please input checkCode';
        return false;
    }else if(isNotRightCode(checkCode)){
        document.getElementById('hint').innerText='* check code illegal';
        return false;
    }else{
        document.getElementById('hint').innerText='';
    }
    function isNotRightUsername(username){
        var patternName = new RegExp('^[\\w-]{4,15}$');
        var patternEmail = new RegExp('^[\\w]+@+[\\w]+\\.{1}[\\w]{2,}$');
        return !patternName.test(username)&&!patternEmail.test(username);
    }
    function isNotRightPwd(password){
        var pattern = new RegExp('^(?![0-9]+$)[\\w-\\@\\$\\%\\^\\&\\*\\?\\!]{6,}$');
        return !pattern.test(password)
    }
    function isNotRightCode(checkCode){
        var pattern = new RegExp('^[a-z0-9A-Z]{4}$');
        return !pattern.test(checkCode)
    }
}
function Submit(){
    var username = document.getElementById('username').value;
    var pwd = document.getElementById('password').value;
    var checkCode = document.getElementById('check-code').value;
    var request = new XMLHttpRequest();
    request.open('POST','./login.php',true);
    request.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
    var msg = "username="+username+"&password="+pwd+"&checkCode="+checkCode;
    console.log(msg)
    request.send(msg)
    request.onreadystatechange=function (){
        if(request.readyState==4&&request.status==200){
            var res = JSON.parse(request.responseText)
            console.log(res);
            // window.location.href='./index.php?a=show'
            if(res.code == 403){
               alert('check code error!')
            }else if(res.code === 402){
                alert('password error!')
            }else if(res.code === 401){
                alert('without this user!')
            }else if(res.code === 200){
                alert('success login!')
                window.location.href='./index.php?a=showHomePageAfter'
            }else{
                alert('error connect to the server!')
            }
        }
     }

}
