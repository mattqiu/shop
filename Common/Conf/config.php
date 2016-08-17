<?php
return array(
	//'配置项'=>'配置值'
    'SHOW_PAGE_TRACE' => TRUE,
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'root',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'sp_',    // 数据库表前缀

    'SITE_URL'  =>  'http://www.shop.com/',
    //为前台css,js,img配置路径变量
    'CSS_URL'   =>  '/Public/Home/style/',
    'JS_URL'   =>  '/Public/Home/js/',
    'IMG_URL'   =>  '/Public/Home/images/',
    //为后台css,js,img配置路径变量
    'AD_CSS_URL'   =>  '/Public/Admin/css/',
    'AD_JS_URL'   =>  '/Public/Admin/js/',
    'AD_IMG_URL'   =>  '/Public/Admin/images/',
    //为第三方插件css,js,img配置路径变量
    'PLUGIN'   =>  '/Common/Plugin/',
);