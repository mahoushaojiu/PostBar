function check(){
    var username=document.getElementById('username').value;
    var passwd=document.getElementById('passwd').value;
    if(checkName(username)&&checkPasswd(passwd)){
        return true;
    }else{
        document.getElementById("recheck").innerHTML="请正确输入帐号名和密码";
        return false;
    }
}
function checkName(name) {
    if(name.length!=0){
        var rep=new RegExp("[ \t]");
        if(!rep.test(name)){
            return true;
        }
    }
    return false;
}
function checkPasswd(passwd){
    if(passwd.length!=0){
        var rep=new RegExp("[^A-z][^0-9]");
        if(!rep.test(passwd)){
            return true;
        }
    }
    return false;
}
function renew(){
    document.getElementById('recheck').innerHTML="&nbsp;";
    document.getElementById('mess').innerHTML="&nbsp;";
}
function changeVerify(){
    var veri=document.getElementById('ver');
    veri.src=veri.src+'?'+Math.random();
}


