<?php
class ReplyController extends Controller{
    public function main(){
        session_start();
        $url=curPageURL();
        setcookie('previous',$url,0,'/');
        $pageNow=isset($_GET['pa'])?$_GET['pa']:1;
        $pid= isset($_GET['pid'])?$_GET['pid']:1;
        $reply=$this->loadModel('Reply');
        $replyCount=$reply->getReplyCountById($pid);
        $page=$this->loadModel('Page',
            array('10',$pageNow,$replyCount,"/postBar/index.php/Home/Reply?pid=$pid&",'pageblock','pageblock_now',5));
        $result=$reply->getReplyPage($page,$pid);
        $this->assign('reply',$result);
        $this->assign('pageBar',$page->showPageBar());

        $this->display('replyList');
    }
    public function addReply(){
        print_r($_POST);
        if(empty($_POST['editorValue'])){
            echo '你不能不输入内容';
            exit;
        }
        $content=trim($_POST['editorValue']);
        if(!str_replace(' ','',str_replace('&nbsp;','',strip_tags($content)))){
            echo '内容不合法';
            exit;
        }
        session_start();
        if(empty($_SESSION['userId'])){
            echo '你还没登陆 你想干什么!';
            exit;
        }
        $userId=$_SESSION['userId'];
        $reply=$this->loadModel('Reply');
        if(empty($_POST['postId'])){
            echo 'error1';
            exit;
        }
        $postId=$_POST['postId'];
        $reply->addReply($postId,$userId,$content);
        header("Location:{$_COOKIE['previous']}");
    }

}