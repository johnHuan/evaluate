<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * develope Administrator
 * Date: 2016/11/18
 * Time: 19:38
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

namespace Home\Model;
use Think\Model;

class stuinfoModel extends Model{
    protected $_validate = array(
        array('stu_num', 'require', '学号不得为空！'),
        array('stu_num', '6,10', '学号位数不正确！', 3, 'length'),
        array('stu_pwd', 'require', '密码必填！'),
        array('stu_pwd', '6,20', '密码位数不正确！', 3, 'length'),
        array('captcha', 'require', '验证码必填！'),

    );

    public function getData($stu_num, $stu_pwd){
        $info = $this->where("stu_num = {$stu_num}")->find();
        if ($info){
            if ($info['stu_pwd'] == $stu_pwd){
                return $info;
            } else {
                return -1;
            }
        } else {
            return 0;
        }
    }
}
  