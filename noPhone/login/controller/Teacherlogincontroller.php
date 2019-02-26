<?php

namespace app\Login\controller;
//教师登陆
use app\Common\Controller\LoginController;
use app\Common\Model\TeacherLoginModel as TeacherModel;
use think\Request;

class TeacherLoginController extends LoginController
{
    public function login(Request $request)
    {
            //获取用户名和密码 $data[username,password]
            $data = Logincontroller::getParam($request);
            //实例化学生登录模块
            $Teacher = new TeacherModel;
            //获取能否登陆的结果
            $result = $Teacher->login($data['TEA_Name'],$data['TEA_Pass']);
            return $result;

    }
}