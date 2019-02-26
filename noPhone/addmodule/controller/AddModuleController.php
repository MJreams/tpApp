<?php

namespace app\addmodule\controller;

//添加model单元

use app\Common\Controller\AddController;
use think\Request;
use app\Common\Model\ResultModel as Res;
use app\Common\Model\ModuleModel;//模块表
use app\Common\Model\CouModRelationModel;//课程模块连接表

class AddModuleController extends AddController
{

    /**
     * 添加课程中的模块
     * @param Request $request
     * @return mixed
     */
    public function addModule(Request $request)
    {
        //获取COU_Id和MOD_Name信息

        $data = parent::getAddCourseParam($request);
        //添加module信息
        $MOD_Id = ModuleModel::addModule($data);
        if($MOD_Id != null){
            //向连接表中存储数据
            $CouModuleId = CouModRelationModel::addCourseModuleRelation($data['COU_Id'],$MOD_Id);
            if($CouModuleId != null){
                //返回成功信息
                return Res::result(500,"添加成功");
            }else{
                //返回课程模块连接表存储失败信息,并删除刚刚存储的课程信息
                ModuleModel::delModule($MOD_Id);
                return Res::result(502,"连接表添加失败");
            }
        }else{
            //返回模块表存储失败信息
            return Res::result(501,"主表存储失败");
        }
        //dump($data);
    }

    public function delModule(Request $request)
    {
        $data = parent::getAddCourseParam($request);
        $MOD_Id = $data['MOD_Id'];
        //删除之前先将数据查询出来备份一下。
        /**
         * 备份连接表
         */
        //删除连接表中的数据
        if(CouModRelationModel::delCourseModuleRelation($MOD_Id) == true){
            //删除Module表中的数据
            if(ModuleModel::delModule($MOD_Id)){
                return Res::result(600,"删除成功");
            }else{
                //如果删除课程表中的数据失败，则恢复连接表中的数据，并返回错误
                /**
                 * 恢复连接表数据
                 */
                return Res::result(601,"主表删除失败");
            }
        }else{
            return Res::result(602,"连接表删除失败");
        }
    }
}