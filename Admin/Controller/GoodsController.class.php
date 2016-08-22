<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/14 11:48
 */
namespace Admin\Controller;

use Tools\AdminController;

class GoodsController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'first'  =>  '商品管理',
            'second' =>  '商品列表',
            'third'  =>  '添加',
            'url'    =>  U('Goods/tianjia'),
        );
        $this->assign('daohang', $daohang);
        $info = M('Goods')->select();
        $this -> assign('info', $info);
        $this -> display();
    }
    public function tianjia()
    {
        $daohang = array(
            'first'  =>  '商品管理',
            'second' =>  '添加商品',
            'third'  =>  '返回',
            'url'    =>  U('Goods/showlist'),
        );
        $this->assign('daohang', $daohang);
        if (IS_POST) {
            $this->deal_logo();
            $data = I('post.');
            $data['goods_introduce'] = fangXSS($_POST['goods_introduce']);
            $data['add_time'] = time();
            $data['upd_time'] = time();
            $goods = M('Goods');
            if ($newid = $goods->add($data)) {
                //相册上传
                $this->deal_pics($newid); //添加、处理相册
                $this->deal_attr($newid);
                $this->success('添加商品成功！', U('showlist'), 1);
            } else {
                $this->error('添加商品失败！', U('tianjia'), 1);
            }
        } else {
            $typeinfo = M('Type')->select();
            $this->assign('typeinfo', $typeinfo);
            $this->display();
        }
    }
    /*
     * 给商品维护‘属性’信息
     * 就是给goods_attr表填充信息
     */
    public function deal_attr($goods_id)
    {
        M('GoodsAttr')->where(array('goods_id'=>$goods_id))->delete();
        foreach ($_POST['goods_attr_id'] as $k => $v){
            //$k是属性的id值信息
            foreach ($v as $vv) {
                if (!empty($vv)) {
                    //给sp_goods_attr表填充数据
                    $arr['goods_id'] = $goods_id;
                    $arr['attr_id'] = $k;
                    $arr['attr_value'] = $vv;
                    M('GoodsAttr')->add($arr);
                }
            }
        }
    }
    /*
     * 给商品添加相册图片
     */
    private function deal_pics($goods_id)
    {
        //做判断，至少需要选中一个相册
        $havePics = false;
        foreach ($_FILES['goods_pics']['error'] as $v) {
            if ($v === 0){
                $havePics = true;
                break;
            }
        }
        //至少选择一个相册，才做上传处理
        if ($havePics === true) {
            //批量上传多个图片的处理
            $up = new \Think\Upload();
            $up -> rootPath = "./Public/Pics/";
            $z = $up -> upload(array($_FILES['goods_pics']));
            $im = new \Think\Image();
            //现在需要制作缩略图
            foreach ($z as $k => $v) {
                $nowpic = $up -> rootPath.$v['savepath'].$v['savename'];
                //给当前相册图片制作缩略图,一图边三个小图
                $im -> open($nowpic);
                $im -> thumb(800, 800, 6);
                $pics_b = $up -> rootPath.$v['savepath']."big_".$v['savename'];
                $im -> save($pics_b);
                $im -> thumb(350, 350, 6);
                $pics_m = $up -> rootPath.$v['savepath']."mid_".$v['savename'];
                $im -> save($pics_m);
                $im -> thumb(50, 50, 6);
                $pics_s = $up -> rootPath.$v['savepath']."sma_".$v['savename'];
                $im -> save($pics_s);
                //存入数据库
                $info['goods_id'] = $goods_id;
                $info['pics_big'] = $pics_b;
                $info['pics_mid'] = $pics_m;
                $info['pics_sma'] = $pics_s;
                M('GoodsPics') -> add($info);
        }

        }
    }
    /*
     * 给商品logo图片处理
     */
    private function deal_logo()
    {
        //判断附件有上传，并且没有问题
        if ($_FILES['goods_file']['error'] === 0) {
            //修改商品的时候，如果有上传新的logo图片，就要删除之前的logo
            if (!empty($_POST['goods_id'])) {//判断‘是否是修改商品’的逻辑
                $logoinfo = M('Goods')->find($_POST['goods_id']);
                if (!empty($logoinfo['goods_big_logo'])) {
                    unlink($logoinfo['goods_big_logo']);
                }
                if (!empty($logoinfo['goods_small_logo'])) {
                    unlink($logoinfo['goods_small_logo']);
                }
            }
            $up = new \Think\Upload();
            $up -> rootPath = './Public/Logo/';
            //上传图片
            $z = $up -> uploadOne($_FILES['goods_file']);
            //拼装图片的路径名
            //例如：./Public/Logo/2016-08-15/jdh24fk873.jpg
            $bigPathName = $up -> rootPath . $z['savepath'] . $z['savename'];
            //把图片路径名设置给$_POST,后续代码会存储到数据库
            $_POST['goods_big_logo'] = $bigPathName;
            //根据logo原图再制作一个缩略图（150*150）
            $im = new \Think\Image();
            $im -> open($bigPathName);
            $im -> thumb(150, 150);
            //缩略图路径名设置
            $smallPathName = $up -> rootPath . $z['savepath'] . "small_" . $z['savename'];
            $im -> save($smallPathName);
            //把缩略图存储给数据库
            $_POST['goods_small_logo'] = $smallPathName;
        }
    }
    //修改商品
    public function update()
    {
        $daohang = array(
            'first'  =>  '商品管理',
            'second' =>  '修改商品',
            'third'  =>  '返回',
            'url'    =>  U('Goods/showlist'),
        );
        $this->assign('daohang', $daohang);
        $goods_id = I('get.goods_id');
        $goods = M('Goods');
        if (IS_POST) {
            //logo图片的上传处理
            $this->deal_logo();

            $this->deal_pics($goods_id);
            $this->deal_attr($goods_id);
            $data = I('post.');
            $data['upd_time'] = time();
            $data['goods_introduce'] = fangXSS($_POST['goods_introduce']);
            if ($goods->save($data)) {
                $this->success('修改商品成功！', U('showlist'), 1);
            } else {
                $this->error('修改商品失败！');
            }
        } else {

            $typeinfo = M('Type')->select();
            $this->assign('typeinfo', $typeinfo);
            $info = $goods -> find($goods_id);
            $this->assign('good', $info);
            //获取商品相册信息
            $pc = M('GoodsPics')->where(array('goods_id' => $goods_id))->select();
            $this->assign('pc', $pc);
            $this->display();
        }
    }
    public function delPics()
    {
        $pics_id = I('get.pics_id');
        $picsinfo = M('GoodsPics')->find($pics_id);
        unlink($picsinfo['pics_big']);
        unlink($picsinfo['pics_mid']);
        unlink($picsinfo['pics_sma']);
        M('GoodsPics')->delete($pics_id);
    }
    //添加商品ajax
    public function getAttrInfoByType()
    {
        $type_id = I('get.type_id');
        $attrinfo = M('Attribute')
                    ->where(array('type_id'=>$type_id))
                    ->field('attr_id,attr_name,attr_sel,attr_vals')
                    ->select();
        echo json_encode($attrinfo);
    }
    //修改商品ajax
    //根据‘类型id’，‘商品id’获得对应的商品信息
    public function getAttrInfoByType2()
    {
        $type_id = I('get.type_id');
        $goods_id = I('get.goods_id');
        //获取【实体】属性列表信息
        $attrinfo1 = M('Attribute')
                    ->alias('a')
                    ->join('left join __GOODS_ATTR__ ga on a.attr_id=ga.attr_id')
                    ->where(array('a.type_id'=>$type_id,'ga.goods_id'=>$goods_id))
                    ->field('a.attr_id,a.attr_name,a.attr_sel,a.attr_vals,group_concat(ga.attr_value) as attr_values')
                    ->group('a.attr_id')
                    ->select();
        //获取【空壳】属性列表信息
        $attrinfo2 = M('Attribute')
            ->where(array('type_id'=>$type_id))
            ->field('attr_id,attr_name,attr_sel,attr_vals')
            ->select();
        foreach ($attrinfo2 as $k => $v) {
            $newattrinfo[$v['attr_id']] = $v;
            foreach ($attrinfo1 as $kk => $vv) {
                if ($v['attr_id'] == $vv['attr_id']) {
                    $newattrinfo[$v['attr_id']]['attr_values'] = $vv['attr_values'];
                }
            }
        }
        echo json_encode($newattrinfo);
    }
}