<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/5 16:57
 */


namespace fit\common;


class Functions
{
    /**
     * API返回数据格式
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return array
     */
    public static function responseData(int $code = 200, string $msg = '', array $data = [])
    {
        $response = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
        ];
        return $response;
    }

    /**
     * 根据 ramsey/uuid 生成uuid
     * @param string|null 盐值
     * @return string
     * @throws \Exception
     */
    public static function uuid(){
        $macAddress = self::getMacAddress();
        $macAddress = str_replace(':', '', $macAddress);
        return \Ramsey\Uuid\Uuid::uuid1($macAddress)->toString();
    }

    /**
     *  随机字符串生成器
     * @param int $type
     * @param int $length
     * @return string
     */
    public static function randStr($type = 1, $length = 8){
        switch ($type) {
            case 0:
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789+_-=?*^%$#@!';
                break;
            case 1:
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                break;
            case 2:
                $chars = '0123456789';
                break;
            case 3:
                $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
        }
        $code = '';
        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $code;
    }

    public static function getMacAddress(){
        @exec("sudo ifconfig -a", $result);
        $tempArray = array();
        foreach ( $result as $value ){
            if (
                preg_match("/[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f][:-]"."[0-9a-f][0-9a-f]/i",$value,
                    $tempArray ) ){
                return $tempArray[0];
            }
        }
    }
}