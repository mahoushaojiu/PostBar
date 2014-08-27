<?php
class Page {
    private  $pageSize;
    private  $pageNow;
    private  $rowCount;
    private  $pageCount;
    private  $link;
    private  $aclass;
    private  $offset;
    private  $nclass;

    public function __construct($ar) {
        $this->pageSize=$ar[0];
        $this->pageNow=$ar[1];
        $this->rowCount=$ar[2];
        $this->link=$ar[3];
        $this->aclass=$ar[4];
        $this->nclass=$ar[5];
        $this->offset=$ar[6];
        $this->pageCount=ceil($this->rowCount/$this->pageSize);
        if($this->pageNow>$this->pageCount){
            trigger_error('pageNow more big');
            $this->pageNow=$this->pageCount;
        }
    }
    public function getPageSize(){
        return $this->pageSize;
    }
    public function setPageSize($pageSize){
        $this->pageSize = $pageSize;
    }
    public function getPageNow(){
        return $this->pageNow;
    }
    public function setPageNow($pageNow){
        $this->pageNow = $pageNow;
    }
    public function getPageCount(){
        return $this->pageCount;
    }
    public function setPageCount($pageCount){
        $this->pageCount = $pageCount;
    }
    public function showPageBar() {
        $offset=$this->offset;
        if($this->pageNow<=$offset)
            $begin=1;
        else if($offset+$this->pageNow>$this->pageCount){
            $begin=$this->pageCount-$offset*2+1;
            if($begin<=0)
                $begin=1;
        }
        else
            $begin=$this->pageNow-$offset+1;

        $return='';
        if($this->pageNow>1){
            $return.=$this->firstPage();
            $return.=$this->upPage();
        }
        for($i=$begin,$n=0;$n<$offset*2&&$i<=$this->pageCount;++$i,++$n){
            if($i==$this->pageNow){
                $return.= "<a href="."$this->link"."pa=$i"." class="."$this->nclass".">$i</a> ";
                continue;
            }
            $return.= "<a href="."$this->link"."pa=$i"." class="."$this->aclass".">$i</a> ";
        }
        if($this->pageNow!=$this->pageCount){
            $return.=$this->downPage();
            $return.=$this->lastPage();
        }
        return $return;
    }
    private function firstPage() {
        return "<a href="."$this->link"."pa=1"." class="."$this->aclass".">首页</a> ";
    }
    private function lastPage() {
        return "<a href="."$this->link"."pa=$this->pageCount"." class="."$this->aclass".">尾页</a> ";
    }
    private function upPage() {
        $var=$this->pageNow-1;
        return "<a href="."$this->link"."pa=$var"." class="."$this->aclass".">上一页</a> ";
    }
    private function downPage() {
        $var=$this->pageNow+1;
        return "<a href="."$this->link"."pa=$var"." class="."$this->aclass".">下一页</a> ";
    }
};
?>