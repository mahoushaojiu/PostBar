<?php
class User extends Model {
    public function getUserMessage($userid){
        $sql="select user_name,portrait from user where user_id=$userid";
        $result=$this->execute_dql($sql);
        return $result[0];

    }
    public function userCount(){
        $sql='select count(1) as count from user';
        $result=$this->execute_dql($sql);
        return $result[0]['count'];
    }
    public function tryLogin($userName,$passwd){
        $sql="select passwd,user_id from user where user_name='$userName'";
        $result=$this->execute_dql($sql);
        if(!empty($result)&&md5($passwd)==$result[0]['passwd']){
            $userId=$result[0]['user_id'];
            if(isset($_POST['auto'])){
                setcookie('userName',$userName,time()+24*7*3600,'/');
                setcookie('passwd',md5($passwd),time()+24*7*3600,'/');
            }
            session_start();
            $_SESSION['userName']=$userName;
            $_SESSION['passwd']=$passwd;
            $_SESSION['userId']=$userId;
            return $userId;
        }
        else
            return -1;
    }
    public function tryKeepLogin(){
        if(isset($_COOKIE['userName'])&&isset($_COOKIE['passwd'])){
            $userName=$_COOKIE['userName'];
            $passwd=$_COOKIE['passwd'];
            $sql="select passwd,user_id from user where user_name='$userName'";
            $result=$this->execute_dql($sql);
            if(!empty($result)&&$passwd==$result[0]['passwd']){
                $userId=$result[0]['user_id'];
                session_start();
                $_SESSION['userName']=$userName;
                $_SESSION['passwd']=$passwd;
                $_SESSION['userId']=$userId;
                return $userId;
            }
        }
            return -1;
    }
    public function getId(){
        if(!isset($this->user_id))
            die("id:$this->user_id is not set");
        return $this->user_id;
    }
};
?>