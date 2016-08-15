<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/14 10:49
 */

namespace Admin\Controller;

use Think\Controller;
class ManagerController extends Controller
{
    public function login()
    {
        if (IS_POST) {
            $info = I('post.');
            $verify = new \Think\Verify();
            if (!$verify->check($info['chknumber'])) {
                $this->error('验证码错误！', U('login'), 1);
            } else {
                $model = M('Manager');
                $map['mg_name'] = $info['user'];
                $map['mg_pwd']  = md5($info['pwd']);
                $rs = $model->where($map)->find();
                if ($rs) {
                    $this->success('登录成功！', U('Index/index'), 1);
                } else {
                    $this->error('登录失败！', U('login'), 1);
                }
            }
        } else {
            $this->display();
        }
    }
    public function checkimg()
    {
        $cfg = array(
            'useImgBg'  =>  false,           // 使用背景图片
            'fontSize'  =>  11,              // 验证码字体大小(px)
            'useCurve'  =>  false,            // 是否画混淆曲线
            'useNoise'  =>  false,            // 是否添加杂点
            'imageH'    =>  25,               // 验证码图片高度
            'imageW'    =>  80,               // 验证码图片宽度
            'length'    =>  4,               // 验证码位数
        );
        $verify = new \Think\Verify($cfg);
        $verify -> entry();
    }
}