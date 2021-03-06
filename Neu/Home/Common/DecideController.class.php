<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/5
 * Time: 10:08
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


namespace Home\Common;
use Think\Controller;

class DecideController extends Controller{

    /**
     * 初始化页面都要执行的方法，类似于构造方法
     */
    public function _initialize(){
        $obj = M('Config');
        $result = $obj->select();

        /**
         * 判断系统是否开放
         */
        if($result[0]['avaliable'] != 1){
            $this->redirect('Shut/shutdown');
        }


        /**
         *判断用户访问的时候是否登录
         */
        $sid = session('sid');
        if (!$sid){
            $this->error('抱歉您还没有登录，请先登录...', u('Index/Index'));
        }
    }

}
 

 
    