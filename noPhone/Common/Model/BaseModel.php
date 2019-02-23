<?php

namespace app\Common\Model;

use think\Model;
//引用发短信类接口start
use app\Common\Common\SmsSingleSender;
use app\Common\Common\SmsMultiSender;
//end
class BaseModel extends Model
{
    /**
     * 发送验证码给手机
     * @return int code 状态码
     */

    //流程
    //获得用户输入的手机号
    //检测用户输入的手机是否合法 调用inspectPhoneNum方法
    //生成验证码(4位)
    //调用TeacherModel的sendVerificationCode方法
    //返回状态码
    static public function sendVerificationCode($phone,$vercode)
    {
        // 短信应用SDK AppID
        $appid = 1400184314; // 1400开头
        // 短信应用SDK AppKey
        $appkey = "64ffa5a8a883a629eac7c7bb9be711c6";
        // 需要发送短信的手机号码
        $phoneNumbers = [$phone];
        // 短信模板ID，需要在短信应用中申请
        $templateId = 279069;  // NOTE: 这里的模板ID`7839`只是一个示例，真实的模板ID需要在短信控制台中申请
        // 签名
        $smsSign = "Dreams孤独患者"; // NOTE: 这里的签名只是示例，请使用真实的已申请的签名，签名参数使用的是`签名内容`，而不是`签名ID`
        // 单发短信
        try {
            $ssender = new SmsSingleSender($appid, $appkey);
            $result = $ssender->send(0, "86", $phoneNumbers[0], "noPhone app提醒您，".$vercode."为您的登录验证码，请于2分钟内填写。如非本人操作，请忽略本短信。", "", "");
            $rsp = json_decode($result);
            return true;//$result;
        } catch(\Exception $e) {
            return false;//$e;
        }
            //echo "\n";
    }
}