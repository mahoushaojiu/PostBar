<?php
//框架的引导类(驱动类)
class Start {
    static public function begin(){
        $router=new Router();
        $module=$router->module;
        $class=$router->controller;
        $method=$router->action;
        $file=APP_PATH.'/'.$module.'/Controller/'.$class.'Controller.class.php';
        if(!file_exists($file))
            die('模块不存在或控制器不存在');
        require_once ($file);
        $class.='Controller';
        if(!class_exists($class))
            die('类不存在');
        if(!method_exists($class,$method))
            die('方法不存在');
        define ('MODEL_PATH',APP_PATH.'/'.$module);
        $instance=new $class();
        $instance->$method();
    }
}
?>