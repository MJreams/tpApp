<?php

namespace app\Common\Model;
//返回请求信息

use app\Common\Model\BaseModel;

class ResultModel extends BaseModel
{
    /**
     * 返回result
     * @param $code   状态码
     * @param $msg    提示信息
     * @param null $id   用户id  默认为null
     * @param null $sessionID  sessionId  默认为null
     * @return string   返回请求信息
     */
    static public function result($code,$msg,$id=null,$sessionID=null)
    {
        $result = array(
            'code' => $code,
            'msg'  => $msg,
            'data' =>array(
                'id' => $id,
                'sessionID' => $sessionID
            )
        );
        if($code == 400){
            $result['msg'] = "查找成功";
            $result['data'] = json_decode($msg);
        }
        return json_encode($result);
    }
}