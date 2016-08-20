<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/20 9:30
 */
namespace Tools;

use Think\Controller;

class AdminController extends Controller
{
    function __construct()
    {
        parent::__construct();


        $mg_id = session('id');
        $mg_name = session('name');

        //对用户访问的权限进行控制
        $nowAC = CONTROLLER_NAME.'-'.ACTION_NAME;

        $allowAC2 = "Manager-login";

        if (empty($mg_name) && strpos($allowAC2, $nowAC) === false) {

            $js = <<<eof
<script>window.top.location.href = "/index.php/Admin/Manager/login";</script>
eof;
            echo $js;
        } else {
            //获取当前用户角色的权限信息
            $roleinfo = M('Manager')
                ->alias('m')
                ->join('left join __ROLE__ r on m.role_id=r.role_id')
                ->where('m.mg_id='.$mg_id)
                ->field('r.role_auth_ac')
                ->find();
            //当前用户拥有的权限
            $authAC = $roleinfo['role_auth_ac'];

            //系统许可权限
            $allowAC = 'Manager-login,Manager-loginout,Index-index,Index-left,Index-right,Index-center,Index-head,Index-down';
            //权限访问控制
            //①没有访问本身拥有的权限
            //②没有访问系统许可的权限
            //③用户还不是超级管理员admin
            //以上①②同时满足就是‘越权访问’
            //判断$nowAC是否
            if (strpos($authAC, $nowAC) === false && strpos($allowAC, $nowAC) === false && $mg_name !== 'admin') {
                exit("没有权限访问！");
            }
        }

    }
}