<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/5 16:35
 */


namespace fit\monitor;

/**
 * 系统监控器
 * 推荐实现：PhpException Slow ResponseDataException
 * Interface Monitor
 * @package fit\monitor
 */
interface Monitor
{
    /**
     * 过滤器
     * @return mixed
     */
    public function filter();

    /**
     * 存储
     * @return mixed
     */
    public function save();
}