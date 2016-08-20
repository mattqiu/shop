<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/17 16:21
 */
namespace Admin\Controller;

use Tools\AdminController;

class AuthController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'first'  =>  '权限管理',
            'second' =>  '权限列表',
            'third'  =>  '添加',
            'url'    =>  U('Auth/tianjia'),
        );
        $this->assign('daohang', $daohang);
        $info = M('Auth')->order('auth_path')->select();
        $this->assign('info', $info);
        $this->display();
    }

    public function tianjia()
    {
        $daohang = array(
            'first'  =>  '权限管理',
            'second' =>  '权限添加',
            'third'  =>  '返回',
            'url'    =>  U('Auth/showlist'),
        );
        $this->assign('daohang', $daohang);
        $auth = M('Auth');
        if (IS_POST) {
            $data = $auth->create();
            $newid = $auth->add();
            if ($data['auth_pid'] == 0) {
                $path = $newid;
            } else {
                $pinfo = $auth->find($data['auth_pid']);
                $path = $pinfo['auth_path'] . "-" . $newid;
            }
            $auth_level = substr_count($path, '-');
            $arr['auth_id'] = $newid;
            $arr['auth_level'] = $auth_level;
            $arr['auth_path'] = $path;
            if ($auth->save($arr)) {
                $this->success('添加成功', U('showlist'), 1);
            } else {
                $this->error('添加失败', U('tianjia'), 1);
            }
        } else {
            $authInfoA = $auth->where('auth_level=0')->select();
            $this->assign('authInfoA', $authInfoA);
            $this->display();
        }
    }
}