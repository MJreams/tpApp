<?php
//教师注册
namespace app\Common\Model;

use app\Common\Model\BaseModel;
use think\Model;

class TeaCouRelationModel extends BaseModel
{
    //	设置当前模型对应的完整数据表名称
    protected $table = 'NP_TeaCouRelation';

    /**
     * 向连接表中添加教师课程数据
     * @param $TEA_Id   教师id 教师表中必须存在该id
     * @param $COU_Id   课程id
     * @return mixed    返回连接表中的西南增加的id
     */
    static public function addTeacherCourseRelation($TEA_Id,$COU_Id){
        $data['TEA_Id'] = $TEA_Id;
        $data['COU_Id'] = $COU_Id;
        $TeaCou = new self();
        $TeaCou->data = $data;
        //使用insertGetId方法，在存储数据的同时返回数据的自增键值
        $TeaCouId = $TeaCou->insertGetId($data);
        return $TeaCouId;
    }

    /**
     * 删除连接表中添加教师课程数据
     * @param $COU_Id
     * @return bool
     */
    static public function delTeacherCourseRelation($COU_Id){
            self::destroy(['COU_Id' => $COU_Id]);
            return true;
    }

    /**
     * 查找连接表中的数据
     */
    static public function searchTCRelation(){

    }
}