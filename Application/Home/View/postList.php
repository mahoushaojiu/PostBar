<?php
?>
<!DOCTYPE html>
<html>
<head>
    <title>欢迎来到贴吧</title>
    <meta http-equiv="content-type" charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="/postBar/Public/Css/postList.css"/>
</head>
<body>
<script src="/postBar/Public/Js/postList.js" async="async">
</script>
<div id="contianer">
    <div id="head">
        <?php if(!isset($_SESSION['userId']))
            echo '<div id="user"><span><a href="/postBar/index.php/Home/Login">登陆</a> | <a href="#">注册</a></span></div>';
        else{
            echo "<div id='user'><span><a class='userbar' href='#'>{$_SESSION['userName']}</a>";
            echo " | <a class='userbar' href='/postBar/index.php/Home/Login/logout'>退出</a></span></div>";
        }
        ?>
        <div id="head-pic">
            <div id="intruduction">
                <a href="#"> <img src="/postBar/Public/Image/n1.gif" /></a>
            </div>
        </div>
        <div id="meum">
                <a href="#" class="inmeum">看贴</a><a href="#" class="inmeum">精品</a>
        </div>
    </div>
    <div id="main">
        <div id="list">
            <?php
            foreach($post as $value) {
                echo <<<FLAG
            <div id="post">
                <div id="number">{$value['replyCount']}</div>
                <div id="top">
                    <div id="in-top">
                        <a target='_blank' href="/postBar/index.php/Home/Reply/main?pid={$value['post_id']}" id="title">
                        <div>{$value['title']}</div></a>
                    </div>
                    <div id="author"><a href="#" id="author-name">{$value['user_name']}</a></div>
                </div>
                <div id="utitle">
                    <div id="content">
FLAG;
                    echo strip_tags($value['content']);
                echo <<<FLAG
                    </div>
                    <div id="time">{$value['time']}</div>
                </div>
                <div id="picture"></div>
            </div>
FLAG;
            }
            ?>
        </div>
        <div id="right">
            <div id="head-portrait">
                <img src="<?php echo $userMess['portrait'];?>"/>
            </div>
            <div id="user-message">
                用户名: <span><?php echo $userMess['user_name']; ?></span>
            </div>
            <div id="post-intr">
                <p>主题: <?php echo $postCount; ?></p>
                <p>回复: <?php echo $replyCount; ?></p>
                <p>人数: <?php echo $userCount; ?></p>
            </div>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div id="page">
        <?php echo $pageBar;?>
    </div>
    <div id="istream">
        <form method="post" action="/postBar/index.php/Home/Index/addPost"
              onsubmit="return checkPost()">
            <table>
                <?php if(isset($isLogin)){ ?>
                <tr><td>发表话题:</td></tr>
                <?php }else{ ?>
                <tr><td>发表话题前请登录:</td></tr>
                <?php } ?>
                <tr><td><input type="text" id="inputi" name="title" maxlength="30"/></td></tr>
                <tr><td><div id="public">
                            <?php
                            require ('/srv/http/postBar/Public/Umeditor/index.html');?>
                </div></td></tr>
                <tr><td><input type="text" id="verifyt" maxlength="4" name="verify"/><img src="/postBar/Public/Image/n1.gif" id="verifyi"></td></tr>
                <tr><td>
                        <?php if(isset($isLogin)){ ?>
                            <input type="submit" value="发帖"/>
                        <?php }else{ ?>
                            <input type="submit" value="发帖" disabled="disabled"  />
                        <?php } ?>
                    </td></tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
