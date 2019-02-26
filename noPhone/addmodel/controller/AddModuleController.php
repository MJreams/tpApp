<?php

namespace app\addmodule\controller;

//添加model单元

use app\Common\Controller\AddController;
use think\Request;
use app\Common\Model\ResultModel as Res;

class AddModuleController extends AddController
{
    public function addmodule(Request $request)
    {
        //获取课程id信息["COU_Id"]为课程id...id必须存在，否则会报错
        //
        //$data = parent::getAddCourseParam($request);
        echo "ddd";
    }
}