<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/4/30 14:46
 */


namespace fit\ruler\id;

use fit\ruler\Ruler;

class IdRuler extends Ruler
{
    /**
     * @param mixed $target 表达式 示例：(money,200,1000 & enable) | (fat & height)
     * @param array ...$args unit_class_path 类名路径
     * @return bool
     */
    public function apply($target, ...$args): bool {
        if($target = $this->compile($target, $args[0])){
            unset($args[0]);
            return $this->execute($target, ...$args);
        }else{
            return false;
        }
    }

    function compile($target, ...$args)
    {
        return $this->compiler->compile($target, $args[0]);
    }

    function execute($target, ...$args): bool
    {
        return $this->executor->run($target, ...$args);
    }
}