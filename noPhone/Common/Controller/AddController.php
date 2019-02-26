<?php

namespace app\Common\Controller;

use app\Common\Controller\BaseController;
use http\Env\Request;

class AddController extends BaseController
{
    /**
     * @param $request
     * @return mixed   获取到的参数
     */
    public function getAddCourseParam($request)
    {
        return parent::getParam($request->param());//$request->param()方式可获取所有参数,并调用父类方法进行过滤

    }
}