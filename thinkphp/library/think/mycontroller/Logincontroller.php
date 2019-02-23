<?php

namespace think\mycontroller;
use think\Controller;
//登陆模块父类
class Logincontroller extends Controller
{
    /* getParam()  获取用户名与密码
     *
     */
    public function getParam($request)
    {
        if($request->isPost()) {
            $username = $request->param('username');
            $password = $request->param('password');
            $data['username'] = trim($username);
            $data['password'] = trim($password);
        }
        return $data;
    }
}