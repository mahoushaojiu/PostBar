<?php
class Router {
    public $module;
    public $controller;
    public $action;
    public function __construct(){
        global $CONFIG;
        $this->module=$CONFIG['router']['default_module'];
        $this->controller=$CONFIG['router']['default_controller'];
        $this->action=$CONFIG['router']['default_action'];
        $this->analysis();
    }
    private function analysis(){
        global $CONFIG;
        $urlType=$CONFIG['router']['url_type'];
        if($urlType==2){
            if(!empty($_GET['m']))
                $this->$_GET['m'];
            if(!empty($_GET['c']))
                $this->$_GET['c'];
            if(!empty($_GET['a']))
                $this->$_GET['a'];
        }else if($urlType==1){
            if(isset($_SERVER['PATH_INFO']))
            {
                $path    = trim($_SERVER['PATH_INFO'], '/');
                $pathar   = explode('/', $path);
                $tem;
                if($tem=array_shift($pathar))
                    $this->module=ucfirst($tem);
                if($tem=array_shift($pathar))
                    $this->controller=ucfirst($tem);
                if($tem=array_shift($pathar))
                    $this->action=$tem;
            }
        }
    }
}
