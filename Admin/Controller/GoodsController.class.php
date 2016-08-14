<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/14 11:48
 */
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller
{
    public function showlist()
    {
        $info = M('Goods')->select();
        $this -> assign('info', $info);
        $this -> display();
    }
    public function tianjia()
    {
        if (IS_POST) {
            $data = I('post.');
            $data['goods_introduce'] = fangXSS($_POST['goods_introduce']);
            $data['add_time'] = time();
            $data['upd_time'] = time();
            $goods = M('Goods');
            if ($goods->add($data)) {
                $this->success('添加商品成功！', U('showlist'), 1);
            } else {
                $this->error('添加商品失败！', U('tianjia'), 1);
            }
        } else {
            $this->display();
        }
    }
    public function update()
    {
        $this->display();
    }
}