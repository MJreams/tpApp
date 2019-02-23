<?php

namespace app\Common\Controller;

use think\Controller;

class BaseController extends Controller
{

    /**
     * 生成验证码
     * @param int num 验证码的位数
     * @return int vercode 验证码
     */
    public function getVerificationCode($num){//生成四位短信验证码
            $min = pow(10,$num-1);
            $max = pow(10,$num)-1;
            $vercode = rand($min,$max);
            return $vercode;
    }

    /**
     * 检验手机号是否合法
     * @param $phone  手机号
     * @return bool   合法返回true，不合法返回false
     */
    public function inspectPhoneNum($phone){
        $rule = '/^0?(13|14|15|17|18)[0-9]{9}$/';
        $result = preg_match($rule, $phone);
        if ($result)
            return true;
        return false;
    }

    /**
     * 检验非法字符
     * des:检验非法字符串防止sql注入等等
     * @param String string 待验证的字符串
     * @return bool true为存在不合法字符，false为不存在
     */
    public function inspectIllegalString($string){
        $pattern_tel = '/select|insert|update|CR|document|LF|eval|delete|script|alert|\'|\/\*|\#|\--|\ --|\/|\*|\-|\+|\=|\~|\*@|\*!|\$|\<|\>|\?|\$|\-|\%|\^|\&|\(|\)|\/|\/\/|\.\.\/|\.\/|union|into|load_file|outfile/';
        if(preg_match($pattern_tel,$string))
            return true;//存在
        return false;//不存在
    }

    /**
     * 返回符合规范的字符串
     * @param $string  待转义的字符串
     * @return string 转义后的字符串
     */
    public function regularString($string){
        //htmlspecialchars可以对一些特殊字符进行转义
        return htmlspecialchars($string);
    }

    /**
     * [TestArray 检测数组是一维还是二维]
     * @param [type] $array [数组]
     * @return int   1为一维数组，2为二维数组，3不是数组
     */
    function TestArray($array){
        if(is_array($array)){
            foreach($array as $v){
                if(is_array($v)){
                    $Int_Array = 2;
                }else{
                    $Int_Array = 1;
                }
            }
        }else{
            $Int_Array = 3;
        }

        return $Int_Array;
    }

    /**
     * @param 获得输入的参数
     * @return $param 处理之后的数据
     * warning:原先有这个函数，只不过现在获取完后再对数据验证一下
     * 调用inspectIllegalString()方法
     * 如果出错则返回去除特殊字符的字符串regularString()方法
     */
    public function getParam($param){

        foreach($param as $key=>$value){
            if($this->inspectIllegalString($value)){
                $param[$key] = $this->regularString($value);
            }

        }
        return $this->object_to_array($param);
    }

    /**
     * 对象 转 数组
     *
     * @param object $obj 对象
     * @return array
     */
    public function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)object_to_array($v);
            }
        }

        return $obj;
    }
}