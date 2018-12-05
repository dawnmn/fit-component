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
     */
    public static function uuid($salt=null){
        return $salt ? \Ramsey\Uuid\Uuid::uuid1($salt)->toString() : \Ramsey\Uuid\Uuid::uuid1()->toString();
    }
}