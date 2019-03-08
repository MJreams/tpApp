<?php
namespace app\upload\controller;

use app\Common\Model\ResultModel as Res;
use app\Common\Controller\UploadController;
use think\Request;

use think\Controller;
class UploadFileController extends UploadController
{
    public function uploadFile(Request $request)
    {
        /* 1、获得用户发来的文件类型数据以及一些其他字段 获得数据data中有 上传文件、文件名称、课程ID、模块ID、描述 */

        //$fileData 里面的内容 COU_Id/:MOD_Id/:CWARE_Name/[:CWARE_Des]
        //获取课程id
        $COU_Id = $request->param('COU_Id');
        //获取单元id
        $MOD_Id = $request->param('MOD_Id');
        //获取文件信息
        $file = $request->file('CWARE_Name');
        var_dump($file->getInfo()['name']);
        if($COU_Id == null || $MOD_Id == null || $file == null)
            return "不能为空";
        /*2、检测发来文件后缀是否合法调用detectFileSuffix()方法，如果和合法，将后缀提出放入data数组中座位类型*/
        $fileName = $file->getInfo()['name'];//获取到上传文件的 String name;
        if(parent::detectFileSuffix($fileName)){
            //如果可以上传的话
            $info = $file->move(ROOT_PATH .'public/upload/wwx','09');
            if($info){
                //上传成功
                echo $info->getExtension();

            }else{
                //上传失败
                echo $file->getError();
            }
        }else{
            //如果不能进行上传的话。
        }

    }
}