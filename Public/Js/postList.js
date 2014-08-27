function checkPost(){
    var ed=document.getElementById('myEditor');
    var ti=document.getElementById('inputi').value;
    ti=checkReg(ti);
    if(ti.length==0){
        alert('标题不能为空');
        return false;
    }
    return true;
}
function checkReg (ti) {
    var regexp=/\s+/g;
    return ti.replace(regexp,'');
}
