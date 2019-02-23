<?php

namespace think\mymodel;

use think\Model;
//使用数据库模块
use think\Db;
class AbstractLoginModel extends Model
{
    /*
     * 验证注册用户是否已经存在
     * @param string $usernam 用户名
     * int flag 标志 ，1为学生，0为教师，默认为1
     * @return bool   true 已经存在不能注册  false 不存在可以注册
     */
    public static function exist($username,$flag = 1)
    {
        //  $flag == 1验证是否可以注册学生用户
        if($flag) {
            $result = Db::table('NP_Student')->where('STU_Name',$username)->find();
            if($result == null)
                return true;
            else
                return false;
        }
        //否则验证是否可以注册教师用户
        else{
            $result = Db::table('NP_Teacher')->where('TEA_Name',$username)->find();
            if($result == null)
                return true;
            else
                return false;
        }
    }
}