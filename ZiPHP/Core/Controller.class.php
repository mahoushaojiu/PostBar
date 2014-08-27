<?php
class Controller {
    protected $view = NULL;

    public function __construct()
    {
        $this->view = new View();
    }
    public function assign($var, $value = '')
    {
        $this->view->assign($var, $value);
    }
    public function display($file)
    {
        $this->view->display($file);
    }
    protected function loadModel($modelName,$ar='')
    {
        $modelFile = MODEL_PATH.'/Model/' . $modelName . 'Model.class.php';
        if(!file_exists($modelFile))
            die('模型'.$modelName.'不存在');
        include($modelFile);
        $class = ucwords($modelName);
        if(!class_exists($class))
            die('模型'.$modelName.'未定义');;
        $model = new $class($ar);
        return $model;
    }
}
