<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/4/30 14:46
 */


namespace fit\logic\ruler;

use fit\logic\ec\RulerEC;

class IdRuler
{
    public $queryBuilder = null;

    /**
     * @param string $exp 表达式 示例：(money,200,1000 & enable) | (fat & height)
     * @param string $numClassPath
     * @return mixed
     */
    public function execute(string $exp, string $numClassPath){
        $rulerEC = new RulerEC();
        $rulerEC->init($numClassPath);
        return $rulerEC->calculate($exp);
    }
}