<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/5/5 9:36
 */


namespace fit\ruler;


abstract class Ruler
{
    public $compiler;
    public $executor;
    public function __construct(Compiler $compiler, Executor $executor, ...$args)
    {
        $this->compiler = $compiler;
        $this->executor = $executor;
    }

    abstract public function compile($target, ...$args);

    abstract public function apply($target, ...$args): bool ;

    abstract public function execute($target, ...$args): bool ;
}