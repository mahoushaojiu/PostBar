<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>表情层弹出后，点击之外区域层消失</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="robots" content="index,follow" />
    <link rel="stylesheet" type="text/css" href="reset.css" />
    <style type="text/css">
        body{ text-align: center;}
        .container{ margin: 0 auto;}
        .popup{ background-color: #33CC99; display: none; width: 200px; height: 200px; /*position: absolute; left: 400px; top: 100px;*/ border: 5px solid #FF9999; border-radius: 5px; margin: 0 auto; margin-top: 100px; }
        .popup ul li{ line-height: 1.5em;}
    </style>
    <script type="text/javascript" src="jquery-1.7.min.js"></script>
    <script type="text/javascript">

    </script>
</head>
<body>
<div class="container">
    <p><button id="btnPop" type="button" onclick="return showPopup();">弹出div层</button></p>
    <div id="popup" class="popup">
        <ul>
            <li><span>css</span></li>
            <li><span>html</span></li>
            <li><span>js</span></li>
            <li><span>csharp</span></li>
            <li><span>sql</span></li>
        </ul>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    function showPopup(){
        document.getElementById("popup").style.display = "block";
    }
    function hidePopup(){
        document.getElementById("popup").style.display = "none";
    }
    document.getElementById("popup").onclick = function(e){
        e = e || window.event;
        if(window.event){
            e.cancelBubble = true;
        } else {
            e.stopPropagation();
        }
    };
    document.body.onclick = function(e){
        e = e || window.event;
        var target = e.target || e.srcElement;
        if(target.id === "puaddf") return;
        hidePopup();
    };
</script>