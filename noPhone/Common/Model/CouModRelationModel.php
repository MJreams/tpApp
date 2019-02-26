<?php
//教师注册
namespace app\Common\Model;

use app\Common\Model\BaseModel;
use think\Model;

class CouModRelationModel extends BaseModel
{
    //	设置当前模型对应的完整数据表名称
    protected $table = 'NP_CouModRelation';

    /**
     * 向连接表中添加课程数据
     * @param $TCOU_Id   课程id 课程表中必须存在该id
     * @param $MOD_Id   课程id
     * @return mixed    返回连接表中的西南增加的id
     */
    static public function addCourseModuleRelation($COU_Id,$MOD_Id){
        $data['COU_Id'] = $COU_Id;
        $data['MOD_Id'] = $MOD_Id;
        $CouMod = new self();
        $CouMod->data = $data;
        //使用insertGetId方法，在存储数据的同时返回数据的自增键值
        $CouModuleId = $CouMod->insertGetId($data);
        return $CouModuleId;
    }

    /**
     * 删除连接表中添加课程模块数据
     * @param $COU_Id
     * @return bool
     */
    static public function delCourseModuleRelation($MOD_Id){
        self::destroy(['MOD_Id' => $MOD_Id]);
        return true;
    }

    /**
     * 查找连接表中的数据
     */
    static public function searchCMRelation(){

    }
}