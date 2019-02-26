<?php

namespace app\addcourse\controller;

//老师添加课程

use app\Common\Controller\AddController;
use think\Request;
use app\Common\Model\ResultModel as Res;
use app\Common\Model\CourseModel;//添加课程模块
use app\Common\Model\TeaCouRelationModel;//存储老师课程连接模块
class AddCourseController extends AddController
{
    /**
     * 添加课程信息和教师课程连接表信息
     * @param Request $request request获取数据
     * @return mixed
     */
    public function addCourse(Request $request)
    {
        //获取老师输入的课程信息["TEA_Id"]为老师id...id必须存在，否则会报错
        //报错解决  ： https://www.lovey0u.cn/Dgdhz/sqlstate23000%EF%BC%9Asql%E6%B7%BB%E5%8A%A0%E6%95%B0%E6%8D%AE%E6%97%B6%E5%A4%96%E9%94%AE%E6%8A%A5%E9%94%99%E5%A4%84%E7%90%86.html
        //["COU_Name"]["COU_Dep"]["COU_School"]["COU_Tel"]为课程信息

        $data = parent::getAddCourseParam($request);
        //数据库中存储该数据，并且返回其自增id
        $CouId = CourseModel::addCourse($data);
        //如果课程信息存储成功，则向连接表中继续存储，否则停止并返回错误。
        if($CouId != null){
            //向连接表中存储数据
            $TeaCouId = TeaCouRelationModel::addTeacherCourseRelation($data['TEA_Id'],$CouId);
            if($TeaCouId != null){
                //返回成功信息
                return Res::result(500,"课程添加成功");
            }else{
                //返回老师课程连接表存储失败信息,并删除刚刚存储的课程信息
                CourseModel::delCourse($CouId);
                return Res::result(502,"连接表添加成功");
            }
        }else{
            //返回课程表存储失败信息
            return Res::result(501,"主表添加成功");
        }
        //var_dump($data);
    }

    /**
     * 删除课程
     * @param Request $request
     * @return mixed
     */
    public function delCourse(Request $request){
        $data = parent::getAddCourseParam($request);
        $COU_Id = $data['COU_Id'];
        //删除之前先将数据查询出来备份一下。
        /**
         * 备份连接表
         */

        //删除连接表中的数据
        if(TeaCouRelationModel::delTeacherCourseRelation($COU_Id) == true){
                //删除Course表中的数据
            if(CourseModel::delCourse($COU_Id)){
                return Res::result(600,"删除成功");
            }else{

                //如果删除课程表中的数据失败，则恢复连接表中的数据，并返回错误
                /**
                 * 恢复连接表数据
                 */
                return Res::result(601,"主表删除失败");
            }
        }else{
            Res::result(602,"连接表删除失败");
        }
    }
}