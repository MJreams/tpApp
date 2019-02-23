<?php
//教师注册
namespace app\Common\Model;

use app\Common\Model\AbstractLoginModel as Abs;
use think\Model;

class TeacherRegisterModel extends Abs
{
    //	设置当前模型对应的完整数据表名称
    protected $table = 'NP_Teacher';

    /**
     * @param $name  用户名
     * @param $num  手机号
     * @return string  错误信息
     */
    static public function check($name,$num)
    {
        $res = "ok";
        //验证用户名是否已经存在
        $Name = array('TEA_Name' =>$name);
        $Student = self::get($Name);
        if(!is_null($Student))
            //如果存在则返回错误
            $res = "用户名已经存在";
        //验证手机号是否存在
        $map = array('TEA_Phone' => $num);
        $Student = self::get($map);
        if(!is_null($Student))
            //如果存在则返回错误
            $res = "手机号已经存在";
        return $res;
    }

    /**
     * 新添加用户数据
     * @param $data 需要新增加的用户
     */
    static public function saveVercode($data)
    {

        $Student = new self();
        $Student->data = $data;
        $Student->save();

    }

    /**
     * 检验验证码与手机号是否匹配
     * @param $phone
     * @param $vercode
     * @return bool
     */
    static public function checkVerificationCode($phone,$vercode)
    {
        $map = array('TEA_Phone' => $phone);
        $Student = self::get($map);
        if($Student['TEA_Vercode'] == $vercode)
            return true;
        return false;
        //return $Student;
    }

    /**
     * 更改是否激活参数
     * @param $phone   手机号
     */
    static public function chageKey($phone)
    {
        //获取数据
        $map = array('TEA_Phone' => $phone);
        $Student = self::get($map);
        $Student->TEA_isKey = 1;//要更新的值
        $Student->validate()->save();//保存
    }


}