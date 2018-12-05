<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/5 18:49
 */


namespace fit\queue;


interface Executor
{
    public function run($task);
}