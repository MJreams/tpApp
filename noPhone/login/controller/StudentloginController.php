<?php

namespace app\login\controller;

use app\Common\Controller\LoginController;
use app\Common\Model\StudentLoginModel as StudentModel;
use think\Request;

class Studentlogincontroller extends LoginController
{
    public function login(Request $request)
    {
        //if($request->isPost()){
            //获取用户名和密码 $data[username,password]
            $data = parent::getParam($request);

            //实例化学生登录模块
            $Student = new StudentModel;
            //获取能否登陆的结果
        //var_dump($data);
            $result = $Student->login($data['STU_Name'],$data['STU_Pass']);
            return $result;


    }
}