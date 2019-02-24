<?php

namespace app\Common\Controller;

use app\Common\Controller\BaseController;

class RegisterController extends BaseController
{
    /**
     *获取学生的登陆请求信息
     * @param $request  请求类
     * @return mixed
     */
    public function getStudentParam($request)
    {
        $data = $request->param();//$request->param()方式可获取所有参数
        $data = parent::getParam($data);//调用父类方法进行过滤
        if(!parent::inspectIllegalString($data['STU_Name'])){
            if(parent::inspectPhoneNum($data['STU_Phone']))
                return $data;
            $data['msg'] = "手机号不合法";
            return $data;
        }
        $data['msg'] = "用户名不合法";
        return $data;
    }

    /**
     *获取教师的登陆请求信息
     * @param $request  请求类
     * @return mixed
     */
    public function getTeacherParam($request)
    {
        $data = $request->param();//$request->param()方式可获取所有参数
        $data = parent::getParam($data);//调用父类方法进行过滤
        if(!parent::inspectIllegalString($data['TEA_Name'])){
            if(parent::inspectPhoneNum($data['TEA_Phone']))
                return $data;
            $data['msg'] = "手机号不合法";
            return $data;
        }
        $data['msg'] = "用户名不合法";
        return $data;
    }

    /**
     * @param $num 验证码位数
     * @return mixed   验证码
     */
    public function getVercode($num)
    {
        return parent::getVerificationCode($num);
    }
}