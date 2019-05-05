<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/5/5 9:32
 */


namespace fit\ruler\id;


abstract class IdRulerNum
{
    protected $param;
    public function __construct($param)
    {
        $this->param = $param;
    }

    abstract function getNum();
}