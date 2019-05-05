<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/5/5 9:53
 */


namespace fit\ruler;


interface Executor
{
    function run($target, ...$args): bool ;
}