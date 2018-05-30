<?php
/**
 * Created by PhpStorm.
 * User: 张桓
 * develop Administrator
 * Date: 2016/11/30
 * Time: 18:29
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
 */
namespace Admin\Controller;
use Think\Controller;
use Tools\PPage;
use Admin\Common\AdminController;
class EvaluateController extends Controller{
    /**
     * 屏蔽错误路由
     */
    public function _empty(){
        $this->display('Index/error');
        exit();
    }

    /**
     *尚未评教的学生
     */
    public function eva_stu(){
        if (IS_POST){
            $keywords = trim($_POST['keywords']);
            $obj = D("Stuinfo");
            $condition["stu_class"] = array('like', '%'.$keywords.'%');
            $condition["stu_major"] = array('like', '%'.$keywords.'%');
            $condition["stu_num"] = array('like', '%'.$keywords.'%');
            $condition["stu_name"] = array('like', '%'.$keywords.'%');
            $condition['_logic'] = 'OR';
            $list = $obj->where($condition)->select();
            $this->assign('list', $list);
            $this->display();
        } else {
            $obj = M("Stuinfo");
            $total = $obj->where('eva_status=0')->count();
            $per_obj = M("Config");
            $per_page = $per_obj->find();
            $per = $per_page['page_per'];
            $pageObj = new PPage($total, $per);
            $sql = "SELECT sid, stu_class, stu_name, stu_num, stu_major, eva_status FROM neu_stuinfo WHERE eva_status='0'" . $pageObj->limit;
            $list = $obj->query($sql);
            $show = $pageObj->fpage(array(1, 2, 3, 4, 5, 6, 7, 8));
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->display();
        }
    }

    /**
     * 已评教的学生
     */
    public function evaed_stu(){
        if (IS_POST){
            $keywords = trim($_POST['keywords']);
            $obj = D("Stuinfo");
            $condition["stu_class"] = array('like', '%'.$keywords.'%');
            $condition["stu_major"] = array('like', '%'.$keywords.'%');
            $condition["stu_num"] = array('like', '%'.$keywords.'%');
            $condition["stu_name"] = array('like', '%'.$keywords.'%');
            $condition['_logic'] = 'OR';
            $list = $obj->where($condition)->select();
            $this->assign('list', $list);
            $this->display();
        } else {
            $obj = M("Stuinfo");
            $total = $obj->where('eva_status=1')->count();
            $per_obj = M("Config");
            $per_page = $per_obj->find();
            $per = $per_page['page_per'];
            $pageObj = new PPage($total, $per);
            $sql = "SELECT sid, stu_class, stu_name, stu_num, stu_major, eva_status FROM neu_stuinfo WHERE eva_status='1'" . $pageObj->limit;
            $list = $obj->query($sql);
            $show = $pageObj->fpage(array(1, 2, 3, 4, 5, 6, 7, 8));
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->display();
        }
    }

    /**
     * 计算每道题总分
     * @param $course_id
     * @return float
     */
    private function questionI($course_id, $question_num){
        $obj = M("evaeanswer");
        //选A的得分
        $sqlA = "SELECT count(*) as c from neu_evaeanswer where course_id='$course_id' and question_num = '$question_num' and answer_radio='1'";
        $ansA = $obj->query($sqlA);
        $scoreA = $ansA[0]['c'] * 95;
        //选B的得分
        $sqlB = "SELECT count(*) as c from neu_evaeanswer where course_id='$course_id' and question_num = '$question_num' and answer_radio='2'";
        $ansB = $obj->query($sqlB);
        $scoreB = $ansB[0]['c'] * 85;
        //选C的得分
        $sqlC = "SELECT count(*) as c from neu_evaeanswer where course_id='$course_id' and question_num = '$question_num' and answer_radio='3'";
        $ansC = $obj->query($sqlC);
        $scoreC = $ansC[0]['c'] * 75;
        //选C的得分
        $sqlD = "SELECT count(*) as c from neu_evaeanswer where course_id='$course_id' and question_num = '$question_num' and answer_radio='4'";
        $ansD = $obj->query($sqlD);
        $scoreD = $ansD[0]['c'] * 65;
        //选C的得分
        $sqlE = "SELECT count(*) as c from neu_evaeanswer where course_id='$course_id' and question_num = '$question_num' and answer_radio='5'";
        $ansE = $obj->query($sqlE);
        $scoreE = $ansE[0]['c'] * 55;
        return $scoreA + $scoreB + $scoreC + $scoreD + $scoreE;

    }

    /**
     * 评教总分排名结果展示
     */
    public function eva_result(){
        if (IS_POST){
            $keywords = trim($_POST['keywords']);
            $obj = D("eva_result");
            $condition["course_name"] = array('like', '%'.$keywords.'%');
            $condition["course_teacher"] = array('like', '%'.$keywords.'%');
            $condition["course_id"] = array('like', '%'.$keywords.'%');
            $condition['_logic'] = 'OR';
            $list = $obj->field("course_id ci, course_name cn, course_teacher ct, course_score cs, eva_stu_num esn, eva_stu_actual esa, eva_avg ea")->where($condition)->order("eva_avg DESC")->select();
            $this->assign('list', $list);
            $this->display();
        } else {
            $obj = M("eva_result");
            $total = $obj->count();
            $per_obj = M("Config");
            $per_page = $per_obj->find();
            $per = $per_page['page_per'];
            $pageObj = new PPage($total, $per);
            $sql = "SELECT course_id ci, course_name cn, course_teacher ct, course_score cs, eva_stu_num esn, eva_stu_actual esa, eva_avg ea FROM neu_eva_result ORDER BY eva_avg DESC " . $pageObj->limit;
            $list = $obj->query($sql);
            $show = $pageObj->fpage(array(1, 2, 3, 4, 5, 6, 7, 8));
            $this->assign('list', $list);
            $this->assign('page', $show);
            $this->display();
        }
    }

    /**
     *历史，暂时不用
     */
    public function eva_result_old(){

        /**
         * 获得 1、平均分；2、总分；3、参评人数
         */
        $obj = M("evata");
        //从neu_evata表中 取得不重复的课程编号
        $course_info = $obj->distinct(true)->field('course_id')->select();
        //获取总课程数
        $len = count($course_info);
        /**
         * 循环这里的课程编号的下标就行
         * 设置没有时间限制，0标志让该段代码执行完成，不限制执行时间
         */
        set_time_limit(0);
        for ($j=0; $j<$len; $j++) {
            $course_id = $course_info[$j]['course_id'];
            /**
             * 从neu_evata这张表中查出对应课程的评教人数
             */
            $sql = "select count(*) c from neu_evata where course_id='$course_id'";
            $num = $obj->query($sql)[0]['c'];
            $sum = 0;
            for ($i = 1; $i < 8; $i++) {
                $sum += 0.10 * $this->questionI($course_id, $i);
            }
            $sum += 0.15 * $this->questionI($course_id, 0);
            $sum += 0.15 * $this->questionI($course_id, 8);

            /**
             * 获得1、课程名称；2、任课教师；3、课程编号
             */
            $course_NameTeacher = $obj->where("course_id='$course_id'")->find();
            $course_name = $course_NameTeacher['course_name'];
            $course_teacher = $course_NameTeacher['course_teacher'];
            /**
             * 将数据分装成数组
             */
            $data[$j]['course_id'] = $course_id;
            $data[$j]['sum'] = $sum;
            $data[$j]['num'] = $num;
            $data[$j]['name'] = $course_name;
            $data[$j]['teacher'] = $course_teacher;
            $data[$j]['avg'] = $sum / $num;

        }
        /**
         * 按照平均分排序
         */
        $sort = array(
            'direction' => 'SORT_DESC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序
            'field'     => 'avg',       //排序字段
        );
        $arrSort = array();
        foreach($data AS $uniqid => $row){
            foreach($row AS $key=>$value){
                $arrSort[$key][$uniqid] = $value;
            }
        }
        if($sort['direction']){
            array_multisort($arrSort[$sort['field']], constant($sort['direction']), $data);
        }
        $this->assign('data', $data);
        $this->display();
    }

    /**
     * 学生自定义评教结果展示
     */
    public function eva_person(){
        if (IS_POST){
            $keywords = trim($_POST['keywords']);
            $obj = D("Evata");
//            $condition["course_name"] = array('like', '%'.$keywords.'%');
//            $condition['_logic'] = "AND";
            $data = $obj->field("course_id, course_teacher, course_name,stu_comment")->where("stu_comment <>'' AND( course_teacher LIKE '%$keywords%' OR course_name LIKE '%$keywords%' )")->select();
            $this->assign('data', $data);
            $this->display();
        }else {
            $obj = M("Evata");
            $total = $obj->where("stu_comment <>''")->count();
            $per_obj = M("Config");
            $per_page = $per_obj->find();
            $per = $per_page['page_per'];
            $pageObj = new PPage($total, $per);
            $sql = "SELECT course_id, course_teacher, course_name,stu_comment FROM neu_Evata WHERE stu_comment<>''" . $pageObj->limit;
            $data = $obj->query($sql);
            $show = $pageObj->fpage(array(1, 2, 3, 4, 5, 6, 7, 8));
            $this->assign('page', $show);
            $this->assign('data', $data);
            $this->display();
        }
    }

    /**
     * 从数据库里读取数据并写入Excel表中
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     */
    public function exportExcel($expTitle,$expCellName,$expTableData){
        set_time_limit(0);

        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFont()->setName('黑体')->setSize(16)->setBold(true);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('FCF7B6');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "尚未评教人数统计");//向合并后的单元格中写入表头

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
     * 尚未参与评教的学生 信息下载
     */
    public function dLoad_stu(){
        set_time_limit(0);
        $xlsName  = "stu";
        $xlsCell  = array(
            array('stu_class','专业班级'),
            array('stu_name','姓名'),
            array('stu_num','学号'),
            array('stu_major','专业'),
            array('eva_status','评教状态'),
        );
        $xlsModel = M('Stuinfo');

        $xlsData  = $xlsModel->Field('stu_class, stu_num, stu_major, stu_name, eva_status')->where("eva_status = '0'")->select();
        $len = count($xlsData);
        for ($i = 0; $i<$len; $i++){
            $xlsData[$i]['eva_status'] = "尚未评教";
        }
//        dump($xlsData);
//             exit();
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
    }

    /**
     * 已经参与评教的学生信息下载
     */
    public function dLoad_stu_eva(){
        set_time_limit(0);
        $xlsName  = "stu";
        $xlsCell  = array(
            array('stu_class','专业班级'),
            array('stu_name','姓名'),
            array('stu_num','学号'),
            array('stu_major','专业'),
            array('eva_status','评教状态'),
        );
        $xlsModel = M('Stuinfo');

        $xlsData  = $xlsModel->Field('stu_class, stu_num, stu_major, stu_name, eva_status')->where("eva_status = '1'")->select();
        $len = count($xlsData);
        for ($i = 0; $i<$len; $i++){
            $xlsData[$i]['eva_status'] = "已经完成评教";
        }

        $this->exportExce_eva($xlsName,$xlsCell,$xlsData);
    }

    /**
     * 从数据库里读取数据并写入Excel表中
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     */
    public function exportExce_eva($expTitle,$expCellName,$expTableData){
        set_time_limit(0);

        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFont()->setName('黑体')->setSize(16)->setBold(true);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('FCF7B6');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "已经参与评教人数统计");//向合并后的单元格中写入表头

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
     * 学生自定义评价下载
     */
    public function dLoad_stu_person(){
        set_time_limit(0);
        $xlsName  = "stu";
        $xlsCell  = array(
            array('course_name','课程名称'),
            array('course_id','课程编号'),
            array('course_teacher','任课教师'),
            array('stu_comment','学生自评'),
        );
        $xlsModel = M('Evata');
        $xlsData  = $xlsModel->Field('course_name, course_id, course_teacher, stu_comment')->where("stu_comment<>''")->select();
        $this->exportExce_person($xlsName,$xlsCell,$xlsData);
    }

    /**
     * 从数据库里读取数据并写入Excel表中
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     */
    public function exportExce_person($expTitle,$expCellName,$expTableData){
        set_time_limit(0);

        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(100);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFont()->setName('黑体')->setSize(16)->setBold(true);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('FCF7B6');

        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "学生自评");//向合并后的单元格中写入表头

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
     *评教结果展示 下载
     */
    public function dLoad_stu_res(){
        $xlsName  = "result";
        $xlsCell  = array(
            array('course_id','课程编号'),
            array('course_name','课程名称'),
            array('course_teacher','任课教师'),
            array('course_score','总分'),
            array('eva_stu_num','理论参评人数'),
            array('eva_stu_actual','实际参评人数'),
            array('eva_avg','平均分'),
        );
        $xlsModel = M('Eva_result');
        $xlsData  = $xlsModel->Field('course_id, course_name, course_teacher, course_score, eva_stu_num, eva_stu_actual, eva_avg')->order("eva_avg DESC")->select();
        $this->exportExce_res($xlsName,$xlsCell,$xlsData);
    }

    /**
     * 从数据库里读取数据并写入Excel表中
     * @param $expTitle
     * @param $expCellName
     * @param $expTableData
     */
    public function exportExce_res($expTitle,$expCellName,$expTableData){
        set_time_limit(0);

        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $_SESSION['account'].date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);
        vendor("PHPExcel");
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H');
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(25);
        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFont()->setName('黑体')->setSize(16)->setBold(true);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet(0)->getStyle('D')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//总分左对齐
        $objPHPExcel->getActiveSheet(0)->getStyle('E')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//参评人数左对齐
        $objPHPExcel->getActiveSheet(0)->getStyle('F')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//平均分左对齐
        $objPHPExcel->getActiveSheet(0)->getStyle('G')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_LEFT);//平均分左对齐
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setRGB('FCF7B6');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "评教结果");//向合并后的单元格中写入表头
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'2', $expCellName[$i][1]);
        }
        for($i=0; $i<$dataNum; $i++){
            for($j=0; $j<$cellNum; $j++){
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

}