<?php
namespace Home\Controller;
use Home\Common\DecideController;
use Home\Model\stuinfoModel;
use Think\Controller;
use Think\Verify;

class IndexController extends Controller {
    /**
     * 判断系统是否开放
     */
    public function _initialize(){
        $obj = M('Config');
        $result = $obj->select();
        if ($result[0]['avaliable'] != 1) {
            $this->redirect('Shut/shutdown');
        }
    }

    /**
     * 屏蔽空操作方法
     */
    public function _empty(){
        $this->display('error');
    }

    /**
     * 登录页
     */
    public function index(){
        if (IS_POST){
            $student = new stuinfoModel();
            if ($student->create($_POST)){
                $verify = new Verify();
                if ($verify->check($_POST['captcha'])){
                    $info = $student->getData($_POST['stu_num'], $_POST['stu_pwd']);
                    if($info == 0){         //学号不存在
                        $this->ajaxReturn(2);
                    } else if($info == -1){ //密码错误
                        $this->ajaxReturn(3);
                    } else {
                        //登录成功，session持久化学生信息，页面跳转到个人信息页面
                        session('sid', $info['sid']);
                        session('stu_name', $info['stu_name']);
                        session('stu_num', $info['stu_num']);
                        $this->ajaxReturn(4);//('Action/Index');
                    }
                } else {
                    $this->ajaxReturn(1);
                }
            } else {
                $this->error($student->getError());
            }
        } else {
            $this->display();
        }


    }

    /**
     * 验证码
     */
    public function verifyImg(){
        $cfg = array(
            'imageH' => 45,
            'imageW' => 200,
            'length' => 5,
            'useCurve'  =>  true,            // 是否画混淆曲线
            'useNoise'  =>  true,            // 是否添加杂点
            'bg'        =>  array(253, 251, 254),  // 背景颜色
            'fontSize' => 20,
            'useCurve'  =>  false,            // 是否画混淆曲线
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取

        ) ;
        $vry = new Verify($cfg);
        $vry->entry();
    }







}
