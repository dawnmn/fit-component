<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/12 10:44
 */


namespace fit\queue;


class TestExecutor implements Executor
{
    function run($task)
    {
        echo $task['content'];
        file_put_contents(__DIR__.'/c.log', date('Y-m-d H:i:s').'save content:'.$task['content']);
        return true;
    }
}