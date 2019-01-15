<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/1/14 17:23
 */
namespace fit\lock;

interface Lock
{
    function lock(string $key, int $expire);
    function unlock(string $key);
}