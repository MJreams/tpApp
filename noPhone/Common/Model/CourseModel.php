<?php

namespace app\Common\Model;

use app\Common\Model\BaseModel;

class CourseModel extends BaseModel
{
    //	设置当前模型对应的完整数据表名称
    protected $table = 'NP_Course';

    /**
     * 查询课程信息
     * @param $data $data里面只有一个数据 COU_Id
     * @return bool|string 信息
     */
    static function searchCourseID($data)
    {
        //提取COU_Id
        $COU_Id = $data['COU_Id'];
        $map = array('COU_Id' => $COU_Id);
        $course = self::get($map);
        if(!is_null($course)){
            //如果该id号对应的课程存在就获取该课程信息
            return json_encode($course);
        }else{
            return false;
        }
    }
    /**
     * 将课程添加至课程表中
     * @param array data 获取到的数据
     * @return int code 状态码
     */
    static public function addCourse($data)
    {
        //如果存在就TEA_Id就把这个键值去掉
        if(array_key_exists("TEA_Id",$data)){
            unset($data["TEA_Id"]);
        }
        //向数据库中存储这个课程的信息
        $Course = new self();
        $Course->data = $data;
        //使用insertGetId方法，在存储数据的同时返回数据的自增键值
        $COU_Id = $Course->insertGetId($data);
        return $COU_Id;
    }

    /**
     * @param $COU_Id
     * @return bool
     */
    static public function delCourse($COU_Id){

        $Course = self::get($COU_Id);
        //如果该数据存在则删除并返回true
        if($Course != null){
            $Course->delete();
            return true;
        }
        return false;
    }


}