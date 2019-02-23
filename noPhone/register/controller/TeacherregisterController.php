<?php

namespace app\login\controller;

use app\Common\Controller\RegisterController;


use think\Request;

use app\Common\Model\AbstractLoginModel as Abs;
use app\Common\Model\TeacherRegisterModel;
use app\Common\Model\BaseModel;

class TeacherregisterController extends RegisterController
{
    public function register(Request $request)
    {
        //获取用户注册的信息
        $data = RegisterController::getTeacherParam($request);
        //data中的请求参数
        $dataPhone = $data['TEA_Phone'];
        $dataName = $data['TEA_Name'];

        if($data['TEA_Vercode']==NULL){//没有传验证码的情况
            //验证用户名与手机号合法性
            if (array_key_exists('msg', $data))
                return Abs::result(301, $data['msg']);
            //验证数据库中是否已经存在该手机号或者用户名
            $checkResult = TeacherRegisterModel::check($dataName,$dataPhone);
            if ($checkResult != "ok")
                return Abs::result(302, $checkResult);
            //生成短信验证码
            $vercode = parent::getVercode(4);
            $data['TEA_Vercode'] = $vercode;//将验证码存在data中，方便存储到数据库.
            //var_dump($data);

            if(BaseModel::sendVerificationCode($dataPhone,$vercode)){//发送验证码
                //允许注册之后将数据保存下来
                $data['TEA_Pass'] = md5($data['TEA_Pass']);//将密码用md5加密
                TeacherRegisterModel::saveVercode($data);
                return Abs::result(304, '验证码发送成功');

            }
        }else{//带着验证码过来的情况
            $dataPhone = $data['TEA_Phone'];
            if(TeacherRegisterModel::checkVerificationCode($dataPhone,$data['TEA_Vercode'])){
                //更新数据库里面的isKey(是否激活)值后保存
                TeacherRegisterModel::chageKey($dataPhone);
                return Abs::result(300, '注册成功');

            }
            return Abs::result(303, '验证码错误');
        }
    }
}