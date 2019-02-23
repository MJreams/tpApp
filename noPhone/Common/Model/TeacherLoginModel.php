<?php

namespace app\Common\Model;

use app\Common\Model\AbstractLoginModel as Abs;
use think\Model;

class TeacherLoginModel extends Abs
{
    //	设置当前模型对应的完整数据表名称
    protected $table = 'NP_Teacher';

    /**
     * 教师用户登录
     * @param string $username 用户名
     * @param string $password 密码
     * @return bool 成功返回true，失败返回false
     */
    static public function login($username,$password)
    {
        //验证用户是否存在
        $map = array('TEA_Name' => $username);
        $Student = self::get($map);
        if(!is_null($Student)){
            //如果用户名存在就获取他的id号
            $id = $Student['TEA_Id'];
            //验证密码是否正确
            if($Student->checkPassword($password))  {
                //登录
                return Abs::result(200,"登陆成功",$id);
            }
            return Abs::result(202,"密码错误",$id);
        }
//        $result['msg'] = "用户名为空";
        return Abs::result(201,"用户名不存在");
    }
    /**
     * 验证密码是否正确
     * @param string $password 密码
     * @return bool
     */
    public function checkPassword($password)
    {
        if($this->getData('TEA_Pass') == $password)
            return true;
        return false;
    }
}