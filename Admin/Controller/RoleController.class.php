<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/17 11:33
 */
namespace Admin\Controller;

use Think\Auth;
use Think\Controller;

class RoleController extends Controller{
    public function showlist()
    {
        $daohang = array(
            'first'  =>  '权限管理',
            'second' =>  '角色列表',
            'third'  =>  '添加角色',
            'url'    =>  U('Role/tianjia'),
        );
        $this->assign('daohang', $daohang);
        $info = M('Role')->select();
        $this->assign('info', $info);
        $this->display();
    }
    public function distribute()
    {
        $daohang = array(
            'first'  =>  '权限管理',
            'second' =>  '分配角色',
            'third'  =>  '返回',
            'url'    =>  U('Role/showlist'),
        );
        $this->assign('daohang', $daohang);
        if (IS_POST) {
            //收集form表单，设置角色权限
            //①把收集的全新的id信息拼装为字符串
            $authids = implode(',', $_POST['authid']);
            //②根据①获得权限的‘控制器和操作方法’
            $authinfo = M('Auth')
                        ->where(array(
                            'auth_level'=>array(
                                'gt', 0
                            ),
                            'auth_id'=>array(
                                'in', $authids
                            )
                        ))
                        ->select();
            //从$authinfo里面获得控制器和操作器和操作方法进行拼装
            $s = "";
            foreach ($authinfo as $k => $v) {
                $s .= $v['auth_c'] . "-" . $v['auth_a'] . ',';
            }
            $s = rtrim($s, ',');
            //③实现角色数据更新
            $arr['role_id'] = I('post.role_id');
            $arr['role_auth_ids'] = $authids;
            $arr['role_auth_ac'] = $s;
            if (M('Role')->save($arr)) {
                $this->success('权限分配成功', U('showlist'), 1);
            } else {
                $this->error('权限分配失败', U('distribute', array(
                    'role_id'=>$arr['role_id'])), 1);
            }
        } else {
            $role_id = I('get.role_id');
            $roleinfo = M('Role')->where('role_id='.$role_id)->find();
            $this->assign('roleinfo', $roleinfo);
            $authInfoA = M('Auth')
                ->where(array(
                    'auth_level'=>0,
                ))
                ->select();
            $authInfoB = M('Auth')
                ->where(array(
                    'auth_level'=>1,
                ))
                ->select();
            $this->assign('authInfoA', $authInfoA);
            $this->assign('authInfoB', $authInfoB);
            $this->display();
        }

    }
}