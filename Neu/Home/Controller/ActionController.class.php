<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * develop Administrator
 * Date: 2016/11/18
 * Time: 22:33
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
use Home\Common\DecideController;
use Home\Model\stuinfoModel;

class ActionController extends DecideController{

    /**
     * 屏蔽空操作方法
     */
    public function _empty(){
        $this->display('Index/error');
    }

    /**
     * 欢迎页列出个人信息
     */
    public function Index(){
        $info = M('Stuinfo');
        $sid = session('sid');
        $data = $info->where("sid = {$sid}")->find();           //按照sid从学生信息表中拿到数据
        $stu_major = mb_substr($data['stu_major'],0, 2, 'utf-8');            //测绘、采矿
        $stu_num = $data['stu_num'];
        $objS = M("Scourse");
        $selectedCourses = $objS->where("stu_num = '$stu_num'")->select();  //按照学号从课程清单中拿到数据
        $length = count($selectedCourses);  //7
        $objc = M("Courses");
        for ($i=0; $i<$length; $i++){
            $cor_id = $selectedCourses[$i]['course_id'];
            $info1 = $objc->where("course_id = '$cor_id' AND course_obj LIKE '$stu_major%'")->find();
            if (is_null($info1)){
                $selectedCourses[$i]['course_teacher'] = '本学院老师';
                $selectedCourses[$i]['course_score'] = '/';
                $selectedCourses[$i]['course_period'] = '/';
            } else {
                $selectedCourses[$i]['course_teacher'] = $info1['course_teacher'];
                $selectedCourses[$i]['course_score'] = $info1['course_score'];
                $selectedCourses[$i]['course_period'] = $info1['course_period'];
            }
        }
        $this->assign('courses', $selectedCourses);
        $this->assign('data', $data);
        $this->display();
    }


    /**
     * 用户退出
     */
    public function logout(){
        session('[destroy]');
        $this->success('退出成功', U('Index/Index'));
    }

    /**
     * 修改密码
     */
    public function updatePwd(){
        if (IS_POST){
            $student = M('Stuinfo');
            $sid = session('sid');
            if ($_POST['stu_pwdNew'] == $_POST['stu_pwdNC']){
                $info = $student->where("sid='$sid'")->find();
                if ($_POST['stu_pwdOld'] == $info['stu_pwd']){
                    $data['stu_pwd'] = $_POST['stu_pwdNew'];
                    $result = $student->where("sid = '$sid'")->save($data);
                    if ($result){
                        $this->success("密码修改成功!", U('Home/Index/Index'));
                    } else {
                        $this->error("密码修改失败！");
                    }
                } else {
                    $this->error("旧密码不正确！");
                }
            } else {
                $this->error("确认密码与密码不一致！");
            }
        }
        $this->display();
    }

    /**
     * 四六级报名
     */
    public function cet46(){
        $this->display();
    }

    /**
     * 补考报名
     */
    public function reExam(){
        $this->display();
    }

    /**
     * 教学评估界面
     */
    public function evaluate(){
        $info = M('Stuinfo');
        $sid = session('sid');
        /**
         * 用户评教完成提价了最终结果
         */
        if (IS_POST){
            if($_POST['flag'] == 1){
                $obj0 = M("Stuinfo");
                $dat['eva_status'] = 1;
                $map0["stu_num"] = session('stu_num');
                $obj0->startTrans(); //启用事务
                $result0 = $obj0->where($map0)->save($dat);
                if ($result0) {
                    $obj0->commit();//成功则提交
                    $this->ajaxReturn(1);
                } else {
                    $obj0->rollback();//不成功，则回滚
                    $this->ajaxReturn(2);
                }
            }
        }

        $data = $info->where("sid = {$sid}")->find();           //按照sid从学生信息表中拿到数据
        $stu_major = mb_substr($data['stu_major'],0, 2, 'utf-8');            //测绘、采矿
        $objS = M("Scourse");
        $stu_num = $data['stu_num'];
        $selectedCourses = $objS->group("course_id")->where("stu_num = '$stu_num'")->select();  //按照学号从课程清单中拿到数据
//        $selectedCourses = $objS->where("stu_num = '$stu_num'")->select();  //按照学号从课程清单中拿到数据
//        dump($selectedCourses);
        $length = count($selectedCourses);  //47
//        dump($length);
        $objc = M("Courses");
        for ($i=0; $i<$length; $i++){
            $cor_id = $selectedCourses[$i]['course_id'];
            $info1 = $objc->where("course_id = '$cor_id' AND course_obj LIKE '%$stu_major%'")->find();     //按照课程id从选课清单中拿到选课数据
            if (is_null($info1)){
                unset($selectedCourses[$i]);
            } else {
                if(is_null($info1['course_teacher'])){
                    unset($selectedCourses[$i]);
                } else {
                    $selectedCourses[$i]['course_teacher'] = $info1['course_teacher'];
                    $selectedCourses[$i]['course_score'] = $info1['course_score'];
                    $selectedCourses[$i]['course_period'] = $info1['course_period'];
//                    $selectedCourses[$i]['course_group'] = $info1['course_group'];
                    $selectedCourses[$i]['course_obj'] = $info1['course_obj'];
                }
            }
        }
        $this->assign('info', $selectedCourses);
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 评教操作
     */
    public function evaluateDo(){
        $course_id = $_GET['sid'];          //取得url上的链接课程变量
        $obj = M('Courses');
        $info = $obj->where("course_id = '$course_id'")->find();
        if (IS_POST){
            //每门课评教后的结果

            //做四件事
            /**
             * 1、将每道题的评教总结果写入 Evata表中
             * 2、每道题的单选结果写入 Evaeanswer表中
             * 3、将选课清单里的当前评教课程的评教状态改为1
             * 4、统计评教结果   eva_result
             */

            $obj1 = M("Evata");
            $obj1->startTrans(); //启用事务
            $datas["course_id"] = $course_id;
            $datas["course_name"] = $info["course_name"];
            $datas["course_teacher"] = $info["course_teacher"];
            $datas['stu_num'] = session('stu_num');
            $datas["stu_name"] = session("stu_name");
            $datas["stu_comment"] = htmlspecialchars($_POST["stu_comment"]);
//            dump($datas);
//            exit();
//@@@
            $result1 = $obj1->add($datas);          //向每门课的最终（大）结果中写入数据

            //每道问题单选答案表
            $obj2 = M("Evaeanswer");
            for ($i=0; $i<12; $i++){
                $lala[$i]["course_id"] = $course_id;
                $lala[$i]["question_num"] = $i;
                $a = $i+1;
                $keys = "eva_level".$a;
                $lala[$i]["answer_radio"] = $_POST[$keys];
            }
            $len1 = count($lala);
            for ($i = 0; $i< $len1;$i++){
//@@@
//                dump($lala);
//                exit();
                $result2 = $obj2->add($lala[$i]);                 //保存每道题的单选按钮信息
            }

            $obj3 = M("Scourse");
            $va["stu_evaluate_status"] = 1;
            $map["course_id"] = $course_id;
            $map["stu_num"] = session("stu_num");
//@@@
            $result3 = $obj3->where($map)->save($va);         //修改选课清单信息

            $obj4 = M("Eva_result");
            $eva_res_data['course_id'] = $course_id;
            $eva_res_data["course_name"] = $info["course_name"];
            $eva_res_data["course_teacher"] = $info["course_teacher"];
            //拿着当前课程的id去数表Eva_result里找，如果没找到就写入，如果找到就修改
            $flag = $obj4->where("course_id = '$course_id'")->find();
            if (is_null($flag)){

                //取得应该评教的人数
//                dump($course_id);
                $eva_res_data['eva_stu_num'] = $obj3->where("course_id = '$course_id'")->count();
//                dump($eva_res_data);
//                exit();

                //数据库里还没有，需要插入
//                dump("没有该课程，需要insert");
                $eva_res_data2_8["course_score"] = 0;
                $eva_res_data19["course_score"] = 0;

                //2、 3、 4、 5、 6、 7、 8 这7道题各值10%
//                dump($_POST);
//                dump($_POST['eva_level1']);             //第1题跟第9题值15%
//                dump($_POST['eva_level9']);
                switch ($_POST['eva_level1']){
                    case 1:     //选了A，打95分
                        $eva_res_data19["course_score"] += 95;
                        break;
                    case 2:    //选了B，打85分
                        $eva_res_data19["course_score"] += 85;
                        break;
                    case 3:    //选了C，打75分
                        $eva_res_data19["course_score"] += 75;
                        break;
                    case 4:    //选了D，打65分
                        $eva_res_data19["course_score"] += 65;
                        break;
                    case 5:    //选了E，打55分
                        $eva_res_data19["course_score"] += 55;
                        break;
                }
                switch ($_POST['eva_level9']){
                    case 1:     //选了A，打95分
                        $eva_res_data19["course_score"] += 95;
                        break;
                    case 2:    //选了B，打85分
                        $eva_res_data19["course_score"] += 85;
                        break;
                    case 3:    //选了C，打75分
                        $eva_res_data19["course_score"] += 75;
                        break;
                    case 4:    //选了D，打65分
                        $eva_res_data19["course_score"] += 65;
                        break;
                    case 5:    //选了E，打55分
                        $eva_res_data19["course_score"] += 55;
                        break;
                }

                for ($i=2; $i<9; $i++){
//                    $a = $i+1;
                    $keys = "eva_level".$i;
//                    dump($_POST[$keys]);
                    switch ($_POST[$keys]){
                        case 1:     //选了A，打95分
                            $eva_res_data2_8["course_score"] += 95;
                            break;
                        case 2:    //选了B，打85分
                            $eva_res_data2_8["course_score"] += 85;
                            break;
                        case 3:    //选了C，打75分
                            $eva_res_data2_8["course_score"] += 75;
                            break;
                        case 4:    //选了D，打65分
                            $eva_res_data2_8["course_score"] += 65;
                            break;
                        case 5:    //选了E，打55分
                            $eva_res_data2_8["course_score"] += 55;
                            break;
                    }
                }
//@@@
//                dump($eva_res_data19['course_score']*0.15);
//                dump($eva_res_data2_8["course_score"]*0.1);
                $eva_res_data['course_score'] = $eva_res_data19['course_score']*0.15 + $eva_res_data2_8["course_score"]*0.1;
                $eva_res_data['eva_stu_actual'] = 1;
                $eva_res_data['eva_avg'] = $eva_res_data['course_score'] /  $eva_res_data['eva_stu_actual'];
//                dump($eva_res_data);
//                exit();
                $result4 = $obj4->add($eva_res_data);
            } else {
                //数据库里已有该课程信息，需要修改
//                dump("数据库里已有该课程信息，只需要update");
                $course_score_original = $flag['course_score'];          //85.0000000000
                $eva_stu_actual = $flag['eva_stu_actual'];          //85.0000000000
//                dump($eva_res_data);
//                exit();
                $eva_res_data2_8["course_score"] = 0;
                $eva_res_data19["course_score"] = 0;

                //2、 3、 4、 5、 6、 7、 8 这7道题各值10%
//                dump($_POST);
//                dump($_POST['eva_level1']);             //第1题跟第9题值15%
//                dump($_POST['eva_level9']);
                switch ($_POST['eva_level1']){
                    case 1:     //选了A，打95分
                        $eva_res_data19["course_score"] += 95;
                        break;
                    case 2:    //选了B，打85分
                        $eva_res_data19["course_score"] += 85;
                        break;
                    case 3:    //选了C，打75分
                        $eva_res_data19["course_score"] += 75;
                        break;
                    case 4:    //选了D，打65分
                        $eva_res_data19["course_score"] += 65;
                        break;
                    case 5:    //选了E，打55分
                        $eva_res_data19["course_score"] += 55;
                        break;
                }
                switch ($_POST['eva_level9']){
                    case 1:     //选了A，打95分
                        $eva_res_data19["course_score"] += 95;
                        break;
                    case 2:    //选了B，打85分
                        $eva_res_data19["course_score"] += 85;
                        break;
                    case 3:    //选了C，打75分
                        $eva_res_data19["course_score"] += 75;
                        break;
                    case 4:    //选了D，打65分
                        $eva_res_data19["course_score"] += 65;
                        break;
                    case 5:    //选了E，打55分
                        $eva_res_data19["course_score"] += 55;
                        break;
                }

                for ($i=2; $i<9; $i++){
//                    $a = $i+1;
                    $keys = "eva_level".$i;
//                    dump($_POST[$keys]);
                    switch ($_POST[$keys]){
                        case 1:     //选了A，打95分
                            $eva_res_data2_8["course_score"] += 95;
                            break;
                        case 2:    //选了B，打85分
                            $eva_res_data2_8["course_score"] += 85;
                            break;
                        case 3:    //选了C，打75分
                            $eva_res_data2_8["course_score"] += 75;
                            break;
                        case 4:    //选了D，打65分
                            $eva_res_data2_8["course_score"] += 65;
                            break;
                        case 5:    //选了E，打55分
                            $eva_res_data2_8["course_score"] += 55;
                            break;
                    }
                }
//@@@
//                dump($eva_res_data19['course_score']*0.15);
//                dump($eva_res_data2_8["course_score"]*0.1);
                $course_score_new = $eva_res_data19['course_score']*0.15 + $eva_res_data2_8["course_score"]*0.1;
                $eva_res_data['eva_stu_actual'] = $eva_stu_actual + 1;
                $eva_res_data['course_score'] = $course_score_original + $course_score_new;
                $eva_res_data['eva_avg'] = $eva_res_data['course_score'] /  $eva_res_data['eva_stu_actual'];
//                dump($eva_res_data);
//                exit();
//@@@
                $cour_id = $flag['course_id'];
                $result4 = $obj4->where("course_id = '$cour_id'")->save($eva_res_data);
            }

            if ($result1 && $result2 && $result3 && $result4 ) {
                $obj->commit();//成功则提交
                $this->success('恭喜您！ 提交成功！', 'evaluate');
            } else {
                $obj->rollback();//不成功，则回滚
                $this->error('提交失败，请重试');
            }

        } else {
            $que = M("question");
            $data = $que->select();
            $this->assign('info', $info);
            $this->assign('question', $data);
            $this->display();
        }
    }



}
