<?php

namespace app\search\controller;

use app\Common\Model\ResultModel as Res;
use app\Common\Controller\SearchController;
use think\Request;
//引用course模型
use app\Common\Model\CourseModel;

class SearchcourseController extends SearchController
{
    /**
     * 根据课程号查询课程
     * @return result() 其中包含该课程的所有信息，用json格式包装
     */
    public function searchCourseID(Request $request)
    {
        //获得用户输入的课程ID
        $data = parent::getCourseParam($request);
        //调用CourseModel的searchCourseID方法
        $result = CourseModel::searchCourseID($data);
        if($result){
            //返回result()函数
            return Res::result(400,$result);
        }else{
            return Res::result(401,"获取失败，课程id不存在");
        }
    }
}