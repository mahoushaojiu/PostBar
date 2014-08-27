<?php

class Reply extends Model{
    public function getReply($pid){
        $pid=$this->real_escape_string($pid);
        $sql="select reply_id,content,user_name,time from reply left join user on
        reply.user_id=user.user_id where post_id=$pid order by time asc";
        $result=$this->execute_dql($sql);
        foreach($result as &$value){
           $re_result=$this->getF_Reply($value['reply_id']);
            if(!empty($re_result))
                $value['f_reply']=$re_result;
        }
        return $result;
    }

    public function getReplyCount(){
        $sql="select count(1) as count from reply";
        $resutl=$this->execute_dql($sql);
        return $resutl[0]['count'];
    }

    public function getReplyPage(Page $pageserver,$pid){
        $pid=$this->real_escape_string($pid);
        $pageSize=$pageserver->getPageSize();
        $pageNow=$pageserver->getPageNow();
        $sql="select reply_id,content,user_name,from_unixtime(time,'%Y-%m-%d %h:%i') as time,
        portrait,fnumber,admin from reply left join user on
        reply.user_id=user.user_id where post_id=$pid order by fnumber asc
         limit ".($pageSize*($pageNow-1)).",".$pageSize;
        $result=$this->execute_dql($sql);
        foreach($result as &$value){
            $re_result=$this->getF_Reply($value['reply_id']);
            if(!empty($re_result))
                $value['f_reply']=$re_result;
        }
        return $result;
    }
    public function getReplyCountById($pid){
        $pid=$this->real_escape_string($pid);
        $sql="select count(reply_id) as page from reply where post_id=$pid";
        $result=$this->execute_dql($sql);
        return $result[0]['page'];
    }
    private function getF_Reply($reply_id){
        $reply_id=$this->real_escape_string($reply_id);
        $sql="select user_name,content,portrait,from_unixtime(time,'%y-%m-%d %h:%i') as time from
        (select reply_id,user_name,portrait,content,time from
        f_reply left join user on f_reply.user_id=user.user_id)
        as newtable  where reply_id=$reply_id order by time asc";
        $result=$this->execute_dql($sql);
        return $result;
    }
    public function addReply($postId,$userId,$content){
        $fnumber=$this->getReplyCountById($postId)+1;
        $sql="insert into reply (post_id,user_id,content,time,fnumber)
        values ($postId,$userId,'$content',".time().",$fnumber)";
        $this->execute_dml($sql);
        $sql='update post set lastime='.time()." where post_id=$postId";
        $this->execute_dml($sql);
    }
}
