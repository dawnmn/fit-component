<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/1/14 17:25
 */


namespace fit\lock;


class RedisLock implements Lock
{
    protected $redis;

    public function __construct(\Redis $redis)
    {
        $this->redis = $redis;
    }

    public function lock(string $key, int $expire){
        $time = microtime(true);
        if(!$this->redis->setnx($key, $time+$expire)){
            if($this->redis->get($key) < $time){
                $this->unlock($key);
                return $this->redis->setnx($key, $time+$expire);
            }
            return false;
        }
        return true;
    }

    public function unlock(string $key){
        $this->redis->del($key);
    }
}