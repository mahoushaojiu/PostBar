<?php
define ('APP_PATH',ROOT_PATH.'/Application');
define ('ZIPHP_PATH',ROOT_PATH.'/ZiPHP');
define ('CORE_PATH',ZIPHP_PATH.'/Core'); //核心库
define ('CONF_PATH',ZIPHP_PATH.'/Conf'); //配置文件目录
require_once(CONF_PATH . '/config.php');
require_once(CORE_PATH . '/Router.class.php');
require_once(CORE_PATH . '/Start.class.php');
require_once(CORE_PATH . '/Controller.class.php');
require_once(CORE_PATH . '/View.class.php');
require_once(CORE_PATH . '/Model.class.php');
require_once(APP_PATH . '/Common/function.php');
header("Content-type:text/html;charset=utf-8");
session_start();
