<?php
class Post extends Model {
    public function getHeadAllList(){
        $sql="select title,content,user_name,user.user_id,time,admin from
        head left join user on head.user_id=user.user_id order by lastime desc";
        $result=$this->execute_dql($sql);
        return $result;
    }
    public function getHeadPage(Page $pageserver){
        $pageSize=$pageserver->getPageSize();
        $pageNow=$pageserver->getPageNow();
        $sql="select post_id,title,content,user_name,from_unixtime(time,'%m-%d %h:%i') as time,user.user_id,admin from
        head left join user on head.user_id=user.user_id order by lastime desc".
        " limit ".($pageSize*($pageNow-1)).",".$pageSize ;
        $result=$this->execute_dql($sql);
        foreach($result as &$val){
            $postid=$val['post_id'];
            $sql="select count(1) as count from reply where post_id='$postid'";
            $re=$this->execute_dql($sql);
            $replyCount=$re[0]['count'];
            $val['replyCount']=$replyCount;
        }
        return $result;
    }
    public function getAllTitleCount() {
        $sql="select count(title) as count from post";
        $result=$this->execute_dql($sql);
        return $result[0]['count'];
    }
    public function addTitle($title){
        $title=$this->real_escape_string($title);
        $title=htmlentities($title);
        $sql="insert into post (title) values ('$title')";
        $this->execute_dml($sql);
        return $this->insert_id;
    }
};
?>