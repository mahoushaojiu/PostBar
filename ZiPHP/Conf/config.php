<?php
//php的配置文件
$CONFIG['db']=array(
    'db_host'           =>      'localhost',
    'db_user'           =>      'zz',
    'db_passwd'       =>      '123',
    'db_database'       =>      'postbar',
    'db_prefix'         =>      '',
    'db_charset'        =>      'utf8',
);

$CONFIG['router'] = array(
    'default_module'         => 'Home',
    'default_controller'     =>'Index',  //系统默认控制器
    'default_action'         =>'main',  //系统默认控制器
    'url_type'               =>1,    //定义URL的形式 1 是/x/x/x模式 2是get
);