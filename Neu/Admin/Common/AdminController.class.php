<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/2
 * Time: 16:24
 * john_3 web俱乐部
 * supporter: yun
 * author: john
 * ============================================================================
 * 版权所有 2016-2026 john_3网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.John_3.com；
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 *
 */

namespace Admin\Common;
use Think\Controller;

class AdminController extends Controller{

    /**
     * 处理空操作方法
     */
    public function _empty(){
        $this->display('404');
    }


    /**
     * 初始化操作方法，类似于构造方法
     */
    public function _initialize(){
        //判断用户是否登录
        $admin_user = session('admin_user');
        if (!$admin_user){
            $this->error('抱歉您还没有登录，请先登录...', u('Manager/Login'));
        }
    }

    /**
     * AdminController constructor.
     * 构造方法
     */
    public function __construct(){
        parent::__construct();

        //获得当前用户访问的“控制器/操作方法”信息
        $current_ac = CONTROLLER_NAME.'-'.ACTION_NAME;
        //获得当前用户“允许”访问的权限信息
        //admin_id ---  role ---- auth
        $admin_id = session('admin_id');
        $admin_name = session('admin_name');
        $manager_info = D('Manager')->find($admin_id);
        $role_id = $manager_info['admin_role_id'];
        //根据$role_id获得角色信息

        $role_info = D('Role')->find($role_id);
        $auth_ac = $role_info['role_auth_ac'];      //获得权限对应的控制器、操作方法


        //默认大家都可可以访问的权限
        $allow_ac = 'Manager-login,Manager-logout,Index-error,Index-404,Manager-verifyImg,Index-index,Index-left,Index-head,Index-right';
        //越权翻墙访问判断
//         ①当前访问的权限必须出现在其权限列表里边
//         ②当前访问的权限 也没有出现在 默认允许访问的权限列表里边

//         当前访问的权限与允许访问的权限做对比
//         strpos($haystack, $needle)   用于判断小的字符串在一个大的字符串中第一次出现的位置
        if (strpos($auth_ac, $current_ac) === false  &&  strpos($allow_ac, $current_ac) === false){

//             exit('没有权限访问!');
//             redirect('Index/404');


            $this->_empty();
        }
    }


}



