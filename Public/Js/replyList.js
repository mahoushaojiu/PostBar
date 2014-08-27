function displyf(arg){
    var content=document.getElementsByClassName('f-reply-content')[arg];
    var test=document.getElementsByClassName('f-reply-div')[arg];
    var istream=document.getElementsByClassName('f-istream')[arg];
    var text=document.getElementsByTagName('textarea')[arg];
    if(test.getElementsByTagName('div').length>0){
        if(content.style.display=='none'){
             content.style.display='block';
        }
        else{
            content.style.display='none';
            istream.style.display='none';
        }
    }else{
        if(arg){
            if(istream.style.display=='none'){
                istream.style.display='block';
                text.focus();
            }else{
                istream.style.display='none';
            }
        }else{
            setFocus();
        }
    }
}
function disply_text(arg) {
    var fi=document.getElementsByClassName('f-istream')[arg];
    if(fi.style.display=='none'){
        fi.style.display='block';
    }
}
function checkReply(){
    var txt=document.getElementById('myEditor').textContent;
    txt=checkReg(txt);
    if(txt.length==0){
        alert('内容不能为空');
        return false;
    }
    if(txt.length>3000){
        alert('内容太多了');
        return false;
    }
    return true;
}
function checkFReply(num){
    var txt=document.getElementsByTagName('textarea')[num].value;
    txt=checkReg(txt);
    if(txt.length==0){
        alert('内容不能为空');
        return false;
    }
    if(txt.length>200){
        alert('内容太多了');
        return false;
    }
    return true;

}
function checkReg (ti) {
    var regexp=/\s+/g;
    return ti.replace(regexp,'');
}
function tofReply(fnum,num){
    disply_text(num);
    var user=document.getElementsByClassName('freplyName')[fnum].innerHTML;
    var txt='回复 '+user+':';
    var dest=document.getElementsByTagName('textarea')[num];
    dest.value=txt;
    dest.setSelectionRange(dest.value.length,dest.value.length);
    dest.focus();
}
