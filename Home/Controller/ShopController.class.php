<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/23 10:28
 */
namespace Home\Controller;
use Think\Controller;
//超市控制器
class ShopController extends Controller {
    //添加商品到购物车
    public function addCart()
    {
        //当前被添加到购物车的商品id
        $goods_id = I('get.goods_id');
        //商品添加给购物车的具体信息有：id,goods_name,price,number,total_price
        $goodsinfo = M('Goods')->find($goods_id);
        $data['goods_id'] = $goods_id;
        $data['goods_name'] = $goodsinfo['goods_name'];
        $data['goods_price'] = $goodsinfo['goods_price'];
        $data['goods_buy_number'] = 1;
        $data['goods_total_price'] = $goodsinfo['goods_price'];

        $cart = new \Tools\Cart();
        $cart->add($data);

        //获得购物车商品“总数量，总价格”，并返回
        $numberprice = $cart->getNumberPrice();
        echo json_encode($numberprice);
    }
    //展示购物车商品列表信息
    public function flow1()
    {
        $cart = new \Tools\Cart();
        $cartinfo = $cart->getCartInfo();

        $goods_ids = implode(',', array_keys($cartinfo));
        $logoinfo = M('Goods')
                    ->field('goods_id,goods_small_logo')
                    ->where(array('goods_id'=>array('in',$goods_ids)))
                    ->select();
        //把$logoinfo 和$cartinfo 整合
        foreach ($cartinfo as $k => $v) {
            foreach ($logoinfo as $kk => $vv) {
                if ($k == $vv['goods_id']) {
                    $cartinfo[$k]['logo'] = $vv['goods_small_logo'];
                }
            }
        }
        $this->assign('cartinfo', $cartinfo);
        $totalprice = $cart->getNumberPrice();
        $this->assign('totalprice', $totalprice);
        $this->display();
    }
    //修改商品数量
    public function changeNumber()
    {
        $goods_id = I('get.goods_id');
        $num = I('get.num');
        $cart = new \Tools\Cart();
        $xiaojiprice = $cart->changeNumber($num, $goods_id);
        //获得购物车商品“总金额”并返回
        $numberprice = $cart->getNumberPrice();
        echo json_encode(array('xiaoji'=>$xiaojiprice,'zongji'=>$numberprice));
    }
    //删除购物车商品
    public function delGoods()
    {
        $goods_id = I('get.goods_id');
        $cart = new \Tools\Cart();
        $cart->del($goods_id);
        $numberprice = $cart->getNumberPrice();
        echo json_encode($numberprice);
    }
    //制作生成订单方法
    public function flow2()
    {
        if (IS_POST) {
            //1) 生成订单信息：给两个数据表维护数据
            //(订单表、订单商品关联表)
            //a. 维护订单表数据
            $cart = new \Tools\Cart();
            $numberprice = $cart -> getNumberPrice();

            $order = M('Order');
            $shuju = $order -> create();  //收集post表单信息
            $shuju['order_number'] = 'itcast-php48-'.date('YmdHis').'-'.mt_rand(1000,9999); //类似 itcast-php48-20160823172051-5314
            $shuju['order_price'] =$numberprice['price'];
            $shuju['add_time'] =$shuju['upd_time'] = time();
            $shuju['user_id'] = session('user_id');
            $orderid = $order -> add($shuju);

            //b.维护"订单商品关联表"数据
            //  获得购物车的每个商品信息并添加给数据表sp_order_goods即可
            $cartinfo = $cart -> getCartInfo();
            $shuju2 = array();
            foreach($cartinfo as $k => $v){
                $shuju2['order_id']         = $orderid;
                $shuju2['goods_id']         = $k;
                $shuju2['goods_price']      = $v['goods_price'];
                $shuju2['goods_number']     = $v['goods_buy_number'];
                $shuju2['goods_total_price'] = $v['goods_total_price'];
                M('OrderGoods')->add($shuju2);
            }

            //2) 清空购物车信息
            $cart->delall();
            echo "生成订单ok...";
            //3) 支付实现
        } else {
            $user_name = session('user_name');
            if (empty($user_name)) {
                session('back_url','Shop/flow2');
                $this->redirect('User/login');
            }
            $cart = new \Tools\Cart();
            $cartinfo = $cart->getCartInfo();

            $goods_ids = implode(',', array_keys($cartinfo));
            $logoinfo = M('Goods')
                ->field('goods_id,goods_small_logo')
                ->where(array('goods_id'=>array('in',$goods_ids)))
                ->select();
            //把$logoinfo 和$cartinfo 整合
            foreach ($cartinfo as $k => $v) {
                foreach ($logoinfo as $kk => $vv) {
                    if ($k == $vv['goods_id']) {
                        $cartinfo[$k]['logo'] = $vv['goods_small_logo'];
                    }
                }
            }
            $this->assign('cartinfo', $cartinfo);
            $totalprice = $cart->getNumberPrice();
            $this->assign('totalprice', $totalprice);
            $this->display();
        }

    }
}