<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>直接操作数据表</title>
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/bootstrap/css/bootstrap.min.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-overrides.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/bootstrap/bootstrap-responsive.css" />
    <link type="text/css" rel="stylesheet" href="/evaluate2.1/Public/css/fileinput.css" media="all" />
</head>
<body>
    <div class="container">
        <h3 class="text-success  bg-warning breadcrumb">管理员直接操作数据表</h3>
        <h4 class="text-danger">数据宝贵请谨慎操作  <i>此操作不可逆，数据删除后将无法找回</i></h4>
        <table class="table table-bordered table-hover">
            <tr class="bg-info">
                <th>数据表</th>
                <th>清空操作</th>
                <th>删除指定范围的数据</th>
            </tr>
            <tr>
                <td><mark><b><a href="">评教结果</a></b></mark>数据表</td>
                <td><a class="btn btn-default" href="/evaluate2.1/index.php/Admin/Index/manageSheet?r=1" onclick="if (confirm('确定要清空评教结果数据表吗？ 建议先下载备份在清空')) return true; else return false;">清空评教结果表</a></td>
                <td>删除编号从：
                    <input id="lower1" class="inline-input"  type="text" style="width:40px;">到：
                    <input id="upper1" type="text" class="inline-input" style="width:40px;">
                    <div class="error1 file-error-message" style="margin-top: 10px; display: none;">
                        <span class="close1 close kv-error-close">×</span>
                        <ul>
                            <li class="errorTip1"></li>
                        </ul>
                    </div>
                    <button class="del1 btn btn-default" >删除</button>
                </td>
            </tr>
            <tr>
                <td><mark><b><a href="">单选问题答案</a></b></mark>数据表</td>
                <td><a class="btn btn-default" href="/evaluate2.1/index.php/Admin/Index/manageSheet?r=2" onclick="if (confirm('确定要清空单选问题答案数据表吗？')) return true; else return false;">清空单选问题答案表</a></td>
                <td>删除编号从：
                    <input id="lower2" class="inline-input"  type="text" style="width:40px;">到：
                    <input id="upper2" type="text" class="inline-input" style="width:40px;">
                    <div class="error2 file-error-message" style="margin-top: 10px; display: none;">
                        <span class="close2 close kv-error-close">×</span>
                        <ul>
                            <li class="errorTip2"></li>
                        </ul>
                    </div>
                    <button class="del2 btn btn-default" >删除</button>
                </td>
            </tr>
            <tr>
                <td><mark><b><a href="">自定义评价</a></b></mark>数据表</td>
                <td><a class="btn btn-default" href="/evaluate2.1/index.php/Admin/Index/manageSheet?r=3" onclick="if (confirm('确定要清空自定义评价数据表吗？')) return true; else return false;">清空自定义评价表</a></td>
                <td>删除编号从：
                    <input id="lower3" class="inline-input"  type="text" style="width:40px;">到：
                    <input id="upper3" type="text" class="inline-input" style="width:40px;">
                    <div class="error3 file-error-message" style="margin-top: 10px; display: none;">
                        <span class="close3 close kv-error-close">×</span>
                        <ul>
                            <li class="errorTip3"></li>
                        </ul>
                    </div>
                    <button class="del3 btn btn-default" >删除</button>
                </td>
            </tr>
            <tr>
                <td> <mark><b><a href="">选课清单</a></b></mark>数据表</td>
                <td><a class="btn btn-default" href="/evaluate2.1/index.php/Admin/Index/manageSheet?r=4" onclick="if (confirm('确定要清空选课清单数据表吗？')) return true; else return false;">清空选课清单表</a></td>
                <td>删除编号从：
                    <input id="lower4" class="inline-input"  type="text" style="width:40px;">到：
                    <input id="upper4" type="text" class="inline-input" style="width:40px;">
                    <div class="error4 file-error-message" style="margin-top: 10px; display: none;">
                        <span class="close4 close kv-error-close">×</span>
                        <ul>
                            <li class="errorTip4"></li>
                        </ul>
                    </div>
                    <button class="del4 btn btn-default" >删除</button>
                </td>
            </tr>
            <tr>
                <td> <mark><b><a href="">学生信息</a></b></mark>数据表</td>
                <td><a class="btn btn-default" href="/evaluate2.1/index.php/Admin/Index/manageSheet?r=5" onclick="if (confirm('确定要清空学生信息数据表吗？')) return true; else return false;">清空学生信息表</a></td>
                <td>删除编号从：
                    <input id="lower5" class="inline-input"  type="text" style="width:40px;">到：
                    <input id="upper5" type="text" class="inline-input" style="width:40px;">
                    <div class="error5 file-error-message" style="margin-top: 10px; display: none;">
                        <span class="close5 close kv-error-close">×</span>
                        <ul>
                            <li class="errorTip5"></li>
                        </ul>
                    </div>
                    <button class="del5 btn btn-default" >删除</button>
                </td>
            </tr>
            <tr>
                <td> <mark><b><a href="">方案课程</a></b></mark>数据表</td>
                <td><a class="btn btn-default" href="/evaluate2.1/index.php/Admin/Index/manageSheet?r=6" onclick="if (confirm('确定要清空方案课程数据表吗？')) return true; else return false;">清空方案课程表</a></td>
                <td>删除编号从：
                    <input id="lower6" class="inline-input"  type="text" style="width:40px;">到：
                    <input id="upper6" type="text" class="inline-input" style="width:40px;">
                    <div class="error6 file-error-message" style="margin-top: 10px; display: none;">
                        <span class="close6 close kv-error-close">×</span>
                        <ul>
                            <li class="errorTip6"></li>
                        </ul>
                    </div>
                    <button class="del6 btn btn-default" >删除</button>
                </td>
            </tr>

        </table>
    </div>
<script type="text/javascript" src="/evaluate2.1/Public/js/jquery.min.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput_locale_fr.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput_locale_es.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/canvas-to-blob.min.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/sortable.min.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/plugins/purify.min.js" ></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/fileinput.min.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/themes/fa/theme.js"></script>
<script type="text/javascript" src="/evaluate2.1/Public/bootstrapfileinput/js/locales/LANG.js"></script>
    <script>
        $(function(){

            for (var i=1; i <= 6; i++ ){
                $(("button.del"+i)).on('click', function(event){
                    event.preventDefault();
                    var currentTarget = event.target.className.substr(3, 1);           //得到点击的按钮数字
//                    console.log(currentTarget);
                    $(("span.close"+currentTarget)).on('click', function(){
                        $(("div.error"+currentTarget)).css('display', 'none');
                    });
                    lower = $(("input#lower"+currentTarget)).val();
                    upper = $(("input#upper"+currentTarget)).val();
                    if (lower == ''){
                        $(("input#lower"+currentTarget)).focus();
                        return false;
                    } else if(upper == ''){
                        $(("input#upper"+currentTarget)).focus();
                        return false;
                    }
                    else{
                        $.ajax({
                            type: 'POST',
                            url: '/evaluate2.1/index.php/Admin/Index/manageSheet',
                            data: {
                                flag: currentTarget,
                                lower: lower,
                                upper: upper,
                            },
                            success: function(res){

//                                $(("div.error" + currentTarget)).css('display', 'block');
//                                $("div.error" + currentTarget + " ul li.errorTip" + currentTarget).text(res);
                                if(res == -1){
                                    $(("div.error" + currentTarget)).css('display', 'block');
                                    $(("div.error" + currentTarget + " ul li.errorTip" + currentTarget)).text('删除失败！可能数据不存在！！');
                                } else if(res == -2){
                                    $(("div.error" + currentTarget)).css('display', 'block');
                                    $(("div.error" + currentTarget + " ul li.errorTip" + currentTarget)).text('删除失败！异常错误,错误原因:要删除的数据表未知');
                                } else{
                                    $(("div.error" + currentTarget)).css('display', 'block');
                                    $(("div.error" + currentTarget + " ul li.errorTip" + currentTarget)).text("成功删除"+res+"条数据");
                                    $(("input#lower"+currentTarget)).val("");
                                    $(("input#upper"+currentTarget)).val("");
                                }
                            }
                        });
                    }

                });
            }

            /**
             *1 评教结果数据表
             */



            /**
             *2 单选问题答案数据表
             */
/*
            $('span.close2').on('click', function(){
                $('div.error2').css('display', 'none');
            });
            $('button.del2').on('click', function(event){
                event.preventDefault();
                lower1 = $('input#lower2').val();
                upper1 = $('input#upper2').val();
                if (lower2 == '' || upper2 == ''){
                    $('input#lower2').focus();
                    return false;
                } else{
                    $.ajax({
                        type: 'POST',
                        url: '/evaluate2.1/index.php/Admin/Index/manageSheet',
                        data: {
                            flag: 2,
                            lower1: lower1,
                            upper1: upper1,
                        },
                        success: function(res){
                            if(res == 2){
                                $('div.error1').css('display', 'block');
                                $('div.error1 ul li.errorTip1').text('删除失败');
                            } else{
                                $('div.error1').css('display', 'block');
                                $('div.error1 li.errorTip1').text('删除成功');
                            }
                        }
                    });
                }

            });
*/

            /**
             * 3 自定义评价数据表
             */


            /**
             * 4 选课清单数据表
             */

            /**
             * 5 学生信息数据表
             */


            /**
             * 6 方案课程数据表
             */


        });
    </script>
</body>
</html>