<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/5 16:08
 */


namespace fit\rpc;


use fit\common\Functions;
use fit\curl\Curl;

class Rpc
{
    public static function API(string $url, array $data, array $headers = []){
        if($result = json_decode(Curl::post($url, $data, $headers), true)){
            return $result;
        }else{
            $data['__url'] = $url;
            return Functions::responseData(510,'rpc调用失败', $data);
        }
    }
}