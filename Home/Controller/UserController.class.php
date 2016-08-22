<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/14 10:32
 */

namespace Home\Controller;
use Think\Controller;
use Think\Verify;

class UserController extends Controller
{
    public function login()
    {
        if (IS_POST) {
            $yzm = new Verify();
            $data = I('post.');
            $rs = $yzm->check($data['checkcode']);
            if (!$rs) {
                $this->error('验证码错误!');
            }
            $rst = M('User')->where(array('user_name'=>$data['user_name'],'user_pwd'=>$data['user_pwd']))->find();
            if ($rst) {
                session('user_name', $rst['user_name']);
                session('user_id', $rst['user_id']);
                $this->redirect('Index/index');
            } else {
                $this->error('账号或者密码错误', U('login'), 1);
            }
        }
        $this->display();
    }
    public function register()
    {
        $this->display();
    }

    public function logout()
    {
        session(null);
        $this->redirect('Index/index');
    }
    public function yanzhengma()
    {
        $cfg = array(
            'useImgBg'  =>  false,           // 使用背景图片 
            'fontSize'  =>  16,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  30,               // 验证码图片高度
            'imageW'    =>  150,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        );
        $yzm = new Verify($cfg);
        $yzm->entry();
    }
}