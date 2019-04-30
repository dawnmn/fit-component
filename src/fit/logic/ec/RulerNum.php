<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/4/30 17:29
 */


namespace fit\logic\ec;


abstract class RulerNum
{
    protected $param = [];
    public function __construct(array $param)
    {
        $this->param = $param;
    }

    abstract public function getNum();
}