<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2017/10/30 17:38
 */

namespace fit\builder;

/**
 * 用单例的方式实例化Redis，获取实例时进行断线重连
 */
class RedisBuilder
{
    const HOST = '127.0.0.1';
    const PORT = 6379;

    private static $instance = null;

    private function __construct()
    {
        ini_set('default_socket_timeout', -1);
        self::$instance = new \Redis();
        self::$instance->connect(self::HOST, self::PORT);
    }

    private function __wakeup()
    {
    }

    private function __clone()
    {
    }

    private static function ping(){
        try {
            if (self::$instance->ping() == '+PONG') {
                return true;
            } else {
                return false;
            }
        }catch (\Exception $e){
            return false;
        }
    }

    /**
     * 外部获取redis的方法
     */
    public static function getInstance(){
        if(!self::$instance){
            new RedisBuilder();
        }else{
            // 断线重连
            if(!self::ping()){
                self::$instance->connect(self::HOST, self::PORT);
            }
        }
        return self::$instance;
    }
}