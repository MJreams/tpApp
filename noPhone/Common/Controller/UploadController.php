<?php

namespace app\Common\Controller;

use app\Common\Controller\BaseController;

/**
 * Class UploadController
 * @package app\Common\Controller
 */
class UploadController extends BaseController
{
    //定义上传路径
    protected $rootPath = "./public/";
    //定义可上传文件类型
    protected $fileArray = array("zip","jpg","png","doc","docx","mp4","mp3","jpeg","ppt");
    //定义文件大小
    protected $fileMaxSize = "31457280";


    /**
     * 检测上传文件是否合法
     * @param $fileName
     */
    public function detectFileSuffix($fileName)
    {
        //获取后缀名
        $type = explode('.',$fileName);
        $num = count($type);
        $type = $type[$num-1];
        //判断是否能够进行上传
        if(!in_array($type,$this->fileArray)){
            return false;
        }//能上传返回true
        return true;
    }
}