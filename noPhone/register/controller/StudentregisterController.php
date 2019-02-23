<?php

namespace app\register\controller;

use app\Common\Controller\RegisterController;

use think\Request;

use app\Common\Model\AbstractLoginModel as Abs;
use app\Common\Model\StudentRegisterModel;
use app\Common\Model\BaseModel;
class StudentregisterController extends RegisterController
{
    public function register(Request $request)
    {
        //获取用户注册的信息
        $data = RegisterController::getStudentParam($request);
        //data中的请求参数
        $dataPhone = $data['STU_Phone'];
        $dataName = $data['STU_Name'];

        if($data['STU_Vercode']==NULL){//没有传验证码的情况
            //验证用户名与手机号合法性
            if (array_key_exists('msg', $data))
                return Abs::result(301, $data['msg']);
            //验证数据库中是否已经存在该手机号或者用户名
            $checkResult = StudentRegisterModel::check($dataName,$dataPhone);
            if ($checkResult != "ok")
                return Abs::result(302, $checkResult);
            //生成短信验证码
            $vercode = parent::getVercode(4);
            $data['STU_Vercode'] = $vercode;//将验证码存在data中，方便存储到数据库.
            //var_dump($data);
                //var_dump(BaseModel::sendVerificationCode($dataPhone,$vercode));
                if(BaseModel::sendVerificationCode($dataPhone,$vercode)){//发送验证码
                    //允许注册之后将数据保存下来
                    StudentRegisterModel::saveVercode($data);
                    return Abs::result(304, '验证码发送成功');
                }else return Abs::result(303, '验证码发送失败');
        }else{//带着验证码过来的情况
            $dataPhone = $data['STU_Phone'];
            if(StudentRegisterModel::checkVerificationCode($dataPhone,$data['STU_Vercode'])){
                //更新数据库里面的isKey(是否激活)值后保存
                $data['STU_Pass'] = md5($data['STU_Pass']);//将密码用md5加密
                StudentRegisterModel::chageKey($dataPhone);
                return Abs::result(300, '注册成功');

            }
            return Abs::result(305, '验证码错误');
        }
    }
}