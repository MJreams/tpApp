<?php

namespace app\Common\Model;

use app\Common\Model\BaseModel;

class ModuleModel extends BaseModel
{
    //	设置当前模型对应的完整数据表名称
    protected $table = 'NP_Module';


    /**
     * 将模块添加至模块表中
     * @param array data 获取到的数据
     * @return int code 自增键值id
     */
    static public function addModule($data)
    {
        //如果存在就COU_Id就把这个键值去掉
        if(array_key_exists("COU_Id",$data)){
            unset($data["COU_Id"]);
        }
        //向数据库中存储这个课程的信息
        $Module = new self();
        $Module->data = $data;
        //使用insertGetId方法，在存储数据的同时返回数据的自增键值
        $MOD_Id = $Module->insertGetId($data);
        return $MOD_Id;
    }

    /**
     * 删除模块
     * @param $MOD_Id
     * @return bool
     */
    static public function delModule($MOD_Id){

        $Module = self::get($MOD_Id);
        //如果该数据存在则删除并返回true
        if($Module != null){
            $Module->delete();
            return true;
        }
        return false;
    }


}