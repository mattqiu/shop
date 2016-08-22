<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/14 10:24
 */
namespace Home\Controller;

use Think\Controller;
class GoodsController extends Controller
{
    public function showlist()
    {
        $info = M('Goods')
                    ->order('goods_id desc')
                    ->field('goods_name,goods_price,goods_small_logo,goods_id')
                    ->select();
        $this->assign('info', $info);
        $this->display();
    }
    public function goods()
    {
        $goods_id = I('get.goods_id');
        $goodsinfo = M('Goods')->where(array('goods_id'=>$goods_id))->find();
        $this->assign('goodsinfo', $goodsinfo);
        //多选属性信息
        $attrinfo = M('Goods_attr')
                    ->alias('ga')
                    ->join('__ATTRIBUTE__ a on ga.attr_id=a.attr_id')
                    ->field('a.attr_id,a.attr_name,group_concat(ga.attr_value)  attr_values')
                    ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'1'))
                    ->group('ga.attr_id')
                    ->select();
        foreach ($attrinfo as $k => $v) {
            $attrinfo[$k]['attr_values'] = explode(',', $v['attr_values']);
        }
        $this->assign('attrinfo', $attrinfo);
        //单选属性
        $attrinfo1 = M('Goods_attr')
            ->alias('ga')
            ->join('__ATTRIBUTE__ a on ga.attr_id=a.attr_id')
            ->field('a.attr_name,ga.attr_value')
            ->where(array('ga.goods_id'=>$goods_id,'a.attr_sel'=>'0'))
            ->select();
        $this->assign('attrinfo1', $attrinfo1);
        //商品图片
        $picinfo = M('Goods_pics')
                    ->where(array('goods_id'=>$goods_id))
                    ->select();
        $this->assign('picinfo', $picinfo);
        $this->display();
    }
}