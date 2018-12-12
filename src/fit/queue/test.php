<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/12 10:40
 */
require '../../../vendor/autoload.php';
require '../common/Functions.php';
require 'DelayQueue.php';
require 'Executor.php';
require 'TestExecutor.php';

$delayQueue = new \fit\queue\DelayQueue();
// 添加执行器
$delayQueue->addExecutor('fit\\queue\\TestExecutor');
var_dump($delayQueue->getExecutors());

$delayQueue->postTask(time()+20, 0, ['content'=>'this is joe'], 'test_executor_key_alias_1');
$delayQueue->postTask(time(), 0, ['content'=>'this is jack'], 'test_executor_key_alias_2');
$delayQueue->postTask(time()-10, 0, ['content'=>'this is mark'], '');
$delayQueue->postTask(time()+120, 0, ['content'=>'this is rose'], '');

$redis = \fit\builder\RedisBuilder::getInstance();
$keys = $redis->zRange(\fit\queue\DelayQueue::REDIS_KEY_TASK, 0, -1);
var_dump($keys);
foreach ($keys as $key){
    var_dump($redis->get($key));
}

$delayQueue->removeTask('test_executor_key_alias_1');

$keys = $redis->zRange(\fit\queue\DelayQueue::REDIS_KEY_TASK, 0, -1);
var_dump($keys);
foreach ($keys as $key){
    var_dump($redis->get($key));
}

$delayQueue->run();

$keys = $redis->zRange(\fit\queue\DelayQueue::REDIS_KEY_TASK, 0, -1);
var_dump($keys);
foreach ($keys as $key){
    var_dump($redis->get($key));
}


