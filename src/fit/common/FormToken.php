<?php
/**
 * @author      dawn
 * @since       2018/12/11 16:53
 */

namespace fit\common;

use fit\builder\RedisBuilder;

class FormToken
{
    const REDIS_PREFIX_FORM_TOKEN = 'form_token_';

    public static function build($key){
        $token = Functions::randStr(1, 16);
        $redis = RedisBuilder::getInstance();
        $redis->set(self::REDIS_PREFIX_FORM_TOKEN.$key, $token, 3600);
        return $token;
    }

    public static function check($token, $key){
        $redis = RedisBuilder::getInstance();
        if($token && ($redis->get(self::REDIS_PREFIX_FORM_TOKEN.$key) == $token)){
            $redis->delete(self::REDIS_PREFIX_FORM_TOKEN.$key);
            return true;
        }else{
            return false;
        }
    }
}