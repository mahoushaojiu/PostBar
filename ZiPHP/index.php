<?php
//php 框架的入口
define ('ROOT_PATH',dirname(__DIR__)); //框架根目录
require_once(ROOT_PATH . '/ZiPHP/init.php');
$st=new Start();;
$st::begin();
