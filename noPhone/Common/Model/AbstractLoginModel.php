<?php

namespace app\Common\Model;

//use think\Mdel;
use app\Common\Model\BaseModel;

class AbstractLoginModel extends BaseModel
{

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

        return json_encode($result);
    }
}