<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/5 17:21
 */


namespace fit\queue;


use fit\builder\RedisBuilder;
use fit\common\Functions;

class DelayQueue
{
    const REDIS_KEY_TASK = 'fit_delay_queue_task';
    const REDIS_KEY_EXECUTOR = 'fit_delay_queue_executor';

    /**
     * 投递任务
     * @param int $timestamp 执行时间：unix时间戳
     * @param int $executorId 任务执行器ID
     * @param array $task 任务
     * @param string $keyAlias 自定义唯一键别名，能够找回，用于查询队列任务
     * @return string 键名
     * @throws \Exception
     * @throws \Throwable
     */
    public function postTask(int $timestamp,int $executorId,array $task,string $keyAlias=''){
        $task['__index'] = 0; // 任务执行次数计数器
        $task['__timestamp'] = $timestamp;
        $task['__executorId'] = $executorId;
        $task['__keyAlias'] = $keyAlias;

        $key = Functions::uuid();
        $redis = RedisBuilder::getInstance();
        $redis->zAdd(self::REDIS_KEY_TASK, $timestamp, $key);
        $redis->set($key, json_encode($task));
        $keyAlias && $redis->set($keyAlias, $key);
        return $key;
    }

    /**
     * 移除任务
     * @param string $keyAlias 键别名
     */
    public function removeTask(string $keyAlias){
        $redis = RedisBuilder::getInstance();
        $key = $redis->get($keyAlias);
        $redis->zRem(self::REDIS_KEY_TASK, $key);
        $redis->delete($key);
        $redis->delete($keyAlias);
    }

    /**
     * 增加执行器
     * @param string $class 执行器完整类名
     */
    public function addExecutor(string $class){
        $redis = RedisBuilder::getInstance();
        $list = json_decode($redis->get(self::REDIS_KEY_EXECUTOR), true);
        $list = $list ? $list : [];
        $list[] = $class;
        $redis->set(self::REDIS_KEY_EXECUTOR, json_encode($list));
    }

    /**
     * 获取执行器列表
     * @return array
     */
    public function getExecutors(){
        $redis = RedisBuilder::getInstance();
        $list = json_decode($redis->get(self::REDIS_KEY_EXECUTOR), true);
        $list = $list ? $list : [];
        return $list;
    }

    /**
     * 执行任务
     * 队列服务器需要配合Monitor处理异常、错误、失败的任务
     * @return array 失败的任务数组
     * @throws \Exception
     * @throws \Throwable
     */
    public function run(){
        try{
            $redis = RedisBuilder::getInstance();
            // 一轮取100条
            $keys = $redis->zRange(self::REDIS_KEY_TASK, 0, 99);
            $executors = $this->getExecutors();
            $time = time();
            $failTasks = []; // 回收失败的任务
            foreach ($keys as $key){
                $task = json_decode($redis->get($key), true);
                if($task['__timestamp'] > $time){
                    break;
                }
                $executorClass = $executors[$task['__executorId']];
                // 执行成功 或者 执行三次 后删除
                if($executorClass::run($task) === true || (++$task['__index'] ==3)){
                    if($task['__index'] ==3){
                        $failTasks[] = $task;
                    }
                    $redis->zRem(self::REDIS_KEY_TASK, $key);
                    $redis->delete($key);
                    $task['__keyAlias'] && $redis->delete($task['__keyAlias']);
                }else{
                    $redis->set($key, json_encode($task));
                }
            }
            return $failTasks;
        }catch (\Exception $e){
            throw $e;
        }catch (\Throwable $e){
            throw $e;
        }
    }
}