<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * develope Administrator
 * Date: 2016/11/16
 * Time: 23:25
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


namespace Home\Controller;
use Think\Controller;

class ShutController extends Controller{

    /**
     * 系统不开放时候的提示
     */
    public function shutdown(){
        $obj = M('Config');
        $result = $obj->find();
        $this->assign('info', $result);
        $this->display();
    }

}
  