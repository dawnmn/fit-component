<?php
/**
 * @author      dawn
 * @since       2018/12/5 18:49
 */

namespace fit\queue;

interface Executor
{
    function run($task);
}