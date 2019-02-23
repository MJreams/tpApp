<?php

namespace app\Common\Controller;

use app\Common\Controller\BaseController;

class LoginController extends BaseController
{
    /**
     * @param $request  请求类
     * @return mixed
     */
    public function getParam($request)
    {
        //if($request->isPost()) {
            //$data[$username] = trim($request->param($username));
            //$data[$password] = trim($request->param($password));
        //}
        $data = $request->param();//$request->param()方式可获取所有参数
        //$data = parent::getParam($data);
        return $data;
    }
}