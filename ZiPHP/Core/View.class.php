<?php
class View {
    protected $vars=array();
    public function assign($var, $value)
    {
        if(is_array($var)) { //如果是数组, 那么将它合并到属性$vars中
            $this->vars = array_merge($this->vars, $var);
        }
        else { //否则将$var为下标$value为值, 增加到$vars中
            $this->vars[$var] = $value;
        }
    }
    public function display($file){
        if(!empty($this->vars))
            extract($this->vars);
//        ob_end_clean();  //非调试
        ob_end_flush();   //调试
        ob_start();
        require (MODEL_PATH.'/View/'.$file.'.php');
        $content=ob_get_contents();  //发送完报头 , 留下内容
        ob_end_clean();
        //缓冲内容可做模板处理
        echo $content;
    }
}