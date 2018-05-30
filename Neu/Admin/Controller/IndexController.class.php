<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * Date: 2016/10/2
 * Time: 15:19
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
namespace Admin\Controller;
use Admin\Common\AdminController;
use Think\Controller;
use Think\Upload;
use Think\UploadFile;
use Think\Verify;
use Tools\PPage;

//直接使用adminController作为权限控制，没有登录的用户直接跳转到登录的界面
class IndexController extends AdminController{

    /**
     * 屏蔽空操作方法
     */
    public function _empty(){
        $this->display('404');
        exit();
    }

    /**
     * 首页展示
     */
    public function index(){
        $this->display();
    }

    public function head(){
        $this->display();
    }

    /**
     * 左侧导航菜单
     */
    public function left(){
        //根据管理员获得其角色，进而获得对应的权限
        //①根据管理员id信息获得其本身记录信息
        $admin_id = session('admin_id');
        $manager_info = D('Manager')->find($admin_id);
        $role_id = $manager_info['admin_role_id'];
        //②根据$role_id获得本身记录信息
        $role_info = D('Role')->find($role_id);
        $auth_ids = $role_info['role_auth_ids'];
        //超级管理员没有权限限制
        //③根据$auth_ids获得具体权限
        if ($admin_id === 1){		//超级管理员，所有权限
            $auth_infoA = D('Auth')->where("auth_level=0")->select();   	//父级
            $auth_infoB = D('Auth')->where("auth_level=1")->select();		//子级
        } else {
            $auth_infoA = D('Auth')->where("auth_level=0 and auth_id in ($auth_ids)")->select();   	//父级
            $auth_infoB = D('Auth')->where("auth_level=1 and auth_id in ($auth_ids)")->select();	//子级
        }
        $this->assign('auth_infoA' ,$auth_infoA);
        $this->assign('auth_infoB' ,$auth_infoB);
        $this->display();
    }

    /**
     * 右侧主体部分
     */
    public function right(){
        $this->assign('time', time());
        $this->display();
    }

    /**
     * 上传选课结果
     */
    public function uploadcourseSelected(){
        if ($_POST){
            $captcha = $_POST['captcha'];
            $verify = new Verify();
            if ($verify->check($captcha)){
                //验证码正确
                if ($_FILES){
                    $config =  array(
                        'maxSize'=>3145728,
                        'savePath'=>'/',
                    );
                    //上传
                    $upload = new Upload($config);
                    $info = $upload->upload();
                    if (!$info) {
                        $this->ajaxReturn($upload->getError());
                    } else {
                        $obj = M('Scourse');
                        $count1 = $obj->count();
//                        $this->ajaxReturn($count1);    //3
                        //写入数据库
                        //获取上传文件信息
                        $file_name = './Uploads' . $info['courseSelected']['savepath'] . $info['courseSelected']['savename'];
                        $file = fopen($file_name, 'r');
                        $stu = array();
                        $k = 0;
                        while(!feof($file)) {
                            $stu[$k] = $this->trimall(fgets($file));
                            $k++;
                        }
                        fclose($file);
                        $stu = array_filter($stu);
                        $len = count($stu);

                        for ($i=1; $i<$len; $i++){
                            set_time_limit(0);
                            $str = $stu[$i];
                            $arr = preg_split("/([a-zA-Z0-9]+)/", $str, 0, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
                            $dest['stu_num'] = $arr[0];
                            $dest['stu_name'] = $arr[1];
                            $dest['course_id'] = substr($arr[2], 6, 10);
                            if ($arr[4] == 'VB'){
                                $dest['course_name'] = $arr[3].$arr[4].$arr[5];
                            }else{
                                $dest['course_name'] = $arr[3];
                            }
                            $result = $obj->add($dest);
                        }
                        $count = $result - $count1;
                        $this->ajaxReturn($count);
                    }
                }else{
                    //文件未能被上传
                    $this->ajaxReturn(2);
                }
            } else {
                //验证码错误
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }


    /**
     * 上传课程清单
     */
    public function uploadcourses(){
        //上传文件
        if ($_FILES){
            $config =  array(
                'maxSize'=>3145728,
                'savePath'=>'/',
            );
            $upload = new Upload($config);
            $info = $upload->upload();
            if (!$info) {
                $this->ajaxReturn($upload->getError());
            } else {
                $this->ajaxReturn($info);
            }
        } else if($_POST) {
            $verify = new Verify();
            if ($verify->check($_POST['captcha'])) {
                $temp = json_decode($_POST['info']);

                if(!is_null($temp)){
//                $this->ajaxReturn(999);

//                    //数据写入
//                    $temp = json_decode($_POST['info']);
                    $file_name = './Uploads'.$temp->courses->savepath.$temp->courses->savename;

                    vendor("PHPExcel");
                    $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                    $objPHPExcel = $objReader->load($file_name, $encode = 'utf-8');

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                    for ($i = 2;  $i<=$highestRow;   $i++)    {
                        $data[$i]['course_id'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                        $data[$i]['course_name'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                        $data[$i]['course_teacher'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                        $data[$i]['course_obj'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                        $data[$i]['course_period'] = $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                        $data[$i]['course_score'] = $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
                    }
                    $obj = M('Courses');
                    $obj->startTrans(); //启用事务
                    $count = $obj->count();            //数据库里的行数
                    $len = count($data)+1;
                    for ($i = 2; $i<=$len;$i++){
                        $result = $obj->add($data[$i]);
                    }
                    if ($result) {
                        $obj->commit();//成功则提交
                    } else {
                        $obj->rollback();//不成功，则回滚
                    }
                    $this->ajaxReturn($result - $count);


                } else{
                    $this->ajaxReturn(2);
                }
                //$this->ajaxReturn("验证码正确");
            } else {
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }

    /**
     * 上传学生信息
     */
    public function uploadstu(){
        //上传文件
        if ($_FILES){
            $config =  array(
                'maxSize'=>3145728,
                'savePath'=>'/',
            );
            $upload = new Upload($config);
            $info = $upload->upload();
            if (!$info) {
                $this->ajaxReturn($upload->getError());
            } else {
                $this->ajaxReturn($info);
            }
        } else if($_POST) {
            $verify = new Verify();
            if ($verify->check($_POST['captcha'])) {
                if($_POST['info'] != ""){
                    //数据写入
                    $temp = json_decode($_POST['info']);
                    $file_name = './Uploads'.$temp->student->savepath.$temp->student->savename;

                    vendor("PHPExcel");
                    $objReader = \PHPExcel_IOFactory::createReader('Excel5');
                    $objPHPExcel = $objReader->load($file_name,$encode='utf-8');

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow(); // 取得总行数
                    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
                    $obj = M('Stuinfo');
                    $count1 = $obj->count();
//                    $this->ajaxReturn($highestRow);
                    for ($i = 2; $i <= $highestRow; $i++) {
                        set_time_limit(0);
                        $data['stu_class'] = $objPHPExcel->getActiveSheet()->getCell("A" . $i)->getValue();
                        $data['stu_name'] = $objPHPExcel->getActiveSheet()->getCell("B" . $i)->getValue();
                        $data['stu_num'] = $objPHPExcel->getActiveSheet()->getCell("C" . $i)->getValue();
                        $data['stu_major'] = $objPHPExcel->getActiveSheet()->getCell("D" . $i)->getValue();
                        $data['stu_year'] = $objPHPExcel->getActiveSheet()->getCell("E" . $i)->getValue();
                        $data['stu_comment'] = $objPHPExcel->getActiveSheet()->getCell("F" . $i)->getValue();
                        $data['stu_adjust'] = $objPHPExcel->getActiveSheet()->getCell("G" . $i)->getValue();
                        $data['stu_sex'] = $objPHPExcel->getActiveSheet()->getCell("H" . $i)->getValue();
                        $data['stu_class_id'] = $objPHPExcel->getActiveSheet()->getCell("I" . $i)->getValue();
                        $data['stu_major_id'] = $objPHPExcel->getActiveSheet()->getCell("J" . $i)->getValue();
                        $data['stu_id_card'] = $objPHPExcel->getActiveSheet()->getCell("K" . $i)->getValue();
                        $last6id = substr($data['stu_id_card'], 12, 6);
                        $data['stu_pwd'] = $last6id;
                        $result = $obj->add($data);
                    }
                    $count = $result - $count1;
                    $this->ajaxReturn($count);
                } else{
                    $this->ajaxReturn(2);
                }
            } else {
                $this->ajaxReturn(1);
            }
        }
        $this->display();
    }

    /**
     * @param $str
     * @return mixed
     * 删除空格
     */
    public function trimall($str){
        $qian=array(" ","　","\t");
        $hou=array("");
        return str_replace($qian,$hou,$str);
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

    /**
     * 下载页面
     */
    public function download(){
        $this->display();
    }

    /**
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     * 下载操作
     */
    public function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    /**
     * 管理数据表
     */
    public function manageSheet($r=""){
        switch ($r){
            case 1:
//                dump("评教结果数据表");
                $obj = M("Eva_result");
                $sql = "TRUNCATE TABLE neu_eva_result";
                $result = $obj->query($sql);
                if(!$result){
                    $this->success("成功清除：评教结果数据表");
                } else {
                    $this->error("数据表清除失败");
                }
                break;
            case 2:
//                dump("单选问题答案数据表");
                $obj = M("Evaeanswer");
                $sql = "TRUNCATE TABLE neu_evaeanswer";
                $result = $obj->query($sql);
                if(!$result){
                    $this->success("成功清除：单选问题答案数据表");
                } else {
                    $this->error("数据表清除失败");
                }
                break;
            case 3:
//                dump("自定义评价数据表");
                $obj = M("Evata");
                $sql = "TRUNCATE TABLE neu_evata";
                $result = $obj->query($sql);
                if(!$result){
                    $this->success("成功清除：自定义评价数据表");
                } else {
                    $this->error("数据表清除失败");
                }
                break;
            case 4:
//                dump("选课清单数据表");
                $obj = M("Scourse");
                $sql = "TRUNCATE TABLE neu_scourse";
                $result = $obj->query($sql);
                if(!$result){
                    $this->success("成功清除：选课清单数据表");
                } else {
                    $this->error("数据表清除失败");
                }
                break;
            case 5:
//                dump("学生信息数据表");
                $obj = M("Stuinfo");
                $sql = "TRUNCATE TABLE neu_stuinfo";
                $result = $obj->query($sql);
                if(!$result){
                    $this->success("成功清除：学生信息数据表");
                } else {
                    $this->error("数据表清除失败");
                }
                break;
            case 6:
//                dump("方案课程数据表");
                $obj = M("Courses");
                $sql = "TRUNCATE TABLE neu_courses";
                $result = $obj->query($sql);
                if(!$result){
                    $this->success("成功清除：方案课程数据表");
                } else {
                    $this->error("数据表清除失败");
                }
                break;
            default:

        }
            if (IS_POST){
                $lower = $_POST['lower'];
                $upper = $_POST['upper'];
                switch ($_POST['flag']){
                    case 1:
                        $obj = M("Eva_result");
                        $result = $obj->where("cid>=$lower and cid<=$upper")->delete();
                        if($result){
                            $this->ajaxReturn($result);
                        } else {
                            $this->ajaxReturn(-1);
                        }
                        break;
                    case 2:
                        $obj = M("Evaeanswer");
                        $result = $obj->where("eid>=$lower and eid<=$upper")->delete();
                        if($result){
                            $this->ajaxReturn($result);
                        } else {
                            $this->ajaxReturn(-1);
                        }
                        break;
                    case 3:
                        $obj = M("Evata");
                        $result = $obj->where("eid>=$lower and eid<=$upper")->delete();
                        if($result){
                            $this->ajaxReturn($result);
                        } else {
                            $this->ajaxReturn(-1);
                        }
                        break;
                    case 4:
                        $obj = M("Scourse");
                        $result = $obj->where("sid>=$lower and sid<=$upper")->delete();
                        if($result){
                            $this->ajaxReturn($result);
                        } else {
                            $this->ajaxReturn(-1);
                        }
                        break;
                    case 5:
                        $obj = M("Stuinfo");
                        $result = $obj->where("sid>=$lower and sid<=$upper")->delete();
                        if($result){
                            $this->ajaxReturn($result);
                        } else {
                            $this->ajaxReturn(-1);
                        }
                        break;
                    case 6:
                        $obj = M("Courses");
                        $result = $obj->where("kid>=$lower and kid<=$upper")->delete();
                        if($result){
                            $this->ajaxReturn($result);
                        } else {
                            $this->ajaxReturn(-1);
                        }
                        break;
                    default:
                        $this->ajaxReturn(-2);

                }
            } else {
                $this->display();
            }


    }

}


