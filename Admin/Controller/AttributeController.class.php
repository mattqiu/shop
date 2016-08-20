<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/20 14:33
 */
namespace Admin\Controller;

use Tools\AdminController;

class AttributeController extends AdminController
{
    public function showlist()
    {
        $daohang = array(
            'first'  =>  '属性管理',
            'second' =>  '属性列表',
            'third'  =>  '添加',
            'url'    =>  U('tianjia'),
        );
        $this->assign('daohang', $daohang);
        $infoattr = M('Attribute')
                    ->alias('a')
                    ->join('__TYPE__ t on a.type_id=t.type_id')
                    ->field('t.type_name,a.*')
                    ->select();
        $this->assign('infoattr', $infoattr);

        $typeinfo = M('Type')->select();
        $this->assign('typeinfo', $typeinfo);
        $this->display();
    }

    public function getInfoByType()
    {
        $type_id = I('get.type_id');
        if ($type_id>0) {
            $attrinfo = M('Attribute')
                ->alias('a')
                ->join('__TYPE__ t on t.type_id=a.type_id')
                ->field('a.*,t.type_name')
                ->where(array('a.type_id'=>$type_id))
                ->select();
        } else {
            $attrinfo = M('Attribute')
                ->alias('a')
                ->join('__TYPE__ t on t.type_id=a.type_id')
                ->field('a.*,t.type_name')
                ->select();
        }
        //给$attrinfo做遍历，是的数据与html标记结合并返回给ajax
        $s = "";
        foreach ($attrinfo as $k => $v) {
            $s .= '<tr>
                <td height="20" bgcolor="#FFFFFF"><div align="center">
                    <input type="checkbox" name="checkbox3" id="checkbox3">
                </div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">'.$v['attr_id'].'</div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">'.$v['attr_name'].'</div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">'.$v['type_name'].'</div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">';
            $s .= $v['attr_sel'] == '0'?'单选':'多选';
            $s .= '</div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">';
            $s .= $v['attr_write'] == '0'?'手工录入':'列表选取';
            $s .= '</div></td>
                <td height="20" bgcolor="#FFFFFF" class="STYLE19"><div align="center">'.$v['attr_vals'].'</div></td><td height="20" bgcolor="#FFFFFF"><div align="center"><span class="STYLE21">
<a href="/index.php/Admin/Attribute/edit.html" style="color: #3f9aff"><img src="/Public/Admin/images/edit.gif" width="10" height="10">修改</a>
        <img src="/Public/Admin/images/del.gif" width="10" height="10"> 删除 | 查看 </span></div></td>
 </tr>';
        }
        echo $s;
    }
    public function tianjia()
    {
        $type = M('Attribute');
        if (IS_POST) {
            //把可选值的中文逗号 替换为 英文逗号
            $_POST['attr_vals'] = str_replace('，', ',', $_POST['attr_vals']);
            $data = $type->create();
            if ($type->add($data)) {
                $this->success('添加成功！', U('showlist'), 1);
            } else {
                $this->error('添加失败', U('tianjia'), 1);
            }
        } else {
            $daohang = array(
                'first'  =>  '属性管理',
                'second' =>  '属性添加',
                'third'  =>  '返回',
                'url'    =>  U('showlist'),
            );
            $this->assign('daohang', $daohang);
            $typeinfo = M('Type')->select();
            $this->assign('typeinfo', $typeinfo);
            $this->display();
        }
    }
}