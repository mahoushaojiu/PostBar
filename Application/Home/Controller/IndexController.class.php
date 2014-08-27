<?php
class IndexController extends Controller{
    public function main(){
        $pageNow=isset($_GET['pa'])?$_GET['pa']:1;
        $post=$this->loadModel('Post');
        $postCount=$post->getAllTitleCount();
        $page=$this->loadModel('Page',
            array('10',$pageNow,$postCount,'/postBar/index.php/Home/Index?','pageblock','pageblock_now',5));
        $result=$post->getHeadPage($page);
        $this->assign('post',$result);
        $this->assign('postCount',$postCount);
        $this->assign('pageBar',$page->showPageBar());

        $user=$this->loadModel('User');
        $user->tryKeepLogin();
        if(isset($_SESSION['userId'])){
            $result=$user->getUserMessage($_SESSION['userId']);
            $this->assign('isLogin',1);
        }
        else
            $result=array('user_name'=>'游客','portrait'=>'/postBar/Public/Image/HeadPortrait/default.png');
        $userCount=$user->userCount();
        $this->assign('userMess',$result);
        $this->assign('userCount',$userCount);

        $reply=$this->loadModel("Reply");
        $replyCount=$reply->getReplyCount();
        $this->assign('replyCount',$replyCount);

        $url=curPageURL();
        setcookie('previous',$url,0,'/');
        $this->display('postList');
    }
    public function addPost() {
        print_r($_POST);
        if(empty($_POST['title'])||!trim($_POST['title'])){
            echo '标题不能为空';
            exit;
        }
        $title=$_POST['title'];
        $content=trim($_POST['editorValue']);
        $post=$this->loadModel('Post');
        $postId=$post->addTitle($title);
        $reply=$this->loadModel('Reply');
        session_start();
        if(empty($_SESSION['userId'])){
            echo '用户未登陆';
            exit;
        }
        $userId=$_SESSION['userId'];
        $reply->addReply($postId,$userId,$content);
        header("Location:http://localhost/postBar/index.php");
    }
}