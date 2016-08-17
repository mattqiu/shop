<?php
/**
 * Created by 张世彪.
 * Date: 2016/8/14 11:17
 */
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        layout(false);
    }
    public function index()
    {
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
    public function center()
    {
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
    public function head()
    {
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
    public function left()
    {
        $mg_id = session('id');
        $mg_name = session('name');
        if ($mg_name == 'admin') {
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
        } else {
            //管理员（role_id）--->角色--->权限
            //根据管理员的角色获得对应的权限ids信息
            $roleinfo = M('Manager')
                ->alias('m')
                ->join('left join __ROLE__ as r on m.role_id=r.role_id')
                ->field('r.role_auth_ids')
                ->where(array('m.mg_id'=>$mg_id))
                ->find();
            $auth_ids = $roleinfo['role_auth_ids'];
            $authInfoA = M('Auth')
                ->where(array(
                    'auth_level'=>0,
                    'auth_id'=>array(
                        'in',$auth_ids
                    )))
                ->select();
            $authInfoB = M('Auth')
                ->where(array(
                    'auth_level'=>1,
                    'auth_id'=>array(
                        'in',$auth_ids
                    )))
                ->select();
        }

        $this->assign('authInfoA', $authInfoA);
        $this->assign('authInfoB', $authInfoB);
        $this->display();
    }
    public function right()
    {
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
    public function down()
    {
        C('SHOW_PAGE_TRACE', false);
        $this->display();
    }
}