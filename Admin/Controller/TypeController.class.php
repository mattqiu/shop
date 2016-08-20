<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/20 11:36
 */
namespace Admin\Controller;

use Tools\AdminController;

class TypeController extends AdminController{
    public function showlist()
    {
        $daohang = array(
            'first'  =>  '类型管理',
            'second' =>  '类型列表',
            'third'  =>  '添加',
            'url'    =>  U('tianjia'),
        );
        $this->assign('daohang', $daohang);
        $info = M('Type')->select();
        $this->assign('info', $info);
        $this->display();
    }

    public function tianjia()
    {
        $type = M('Type');
        if (IS_POST) {
            $data = $type->create();
            if ($type->add($data)) {
                $this->success('添加成功！', U('showlist'), 1);
            } else {
                $this->error('添加失败', U('tianjia'), 1);
            }
        } else {
            $daohang = array(
                'first'  =>  '类型管理',
                'second' =>  '类型列表',
                'third'  =>  '返回',
                'url'    =>  U('showlist'),
            );
            $this->assign('daohang', $daohang);
            $this->display();
        }
    }
}