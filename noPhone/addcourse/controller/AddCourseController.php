<?php

namespace app\addcourse\controller;

//老师添加课程

use app\Common\Controller\AddController;
use think\Request;
use app\Common\Model\ResultModel as Res;
use app\Common\Model\CourseModel;
class AddCourseController extends AddController
{
    public function addCourse(Request $request)
    {
        //获取老师输入的课程信息["TEA_Id"]为老师id
        //["COU_Name"]["COU_Dep"]["COU_School"]["COU_Tel"]为课程信息

        $data = parent::getAddCourseParam($request);
        //数据库中存储该数据，并且返回其自增id
        $COU_Id = CourseModel::addCourse($data);
        //如果课程信息存储成功，则向连接表中继续存储，否则停止并返回错误。
        if($COU_Id != null){

        }else{

        }
        var_dump($data);
    }
}