<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/10 16:54
 */


namespace fit\maze;


abstract class Maze
{
    // 错误路径收集器
    public $wrong = [];

    protected $builder;

    public function __construct()
    {
        $this->builder = new NodeBuilder();
    }

    public abstract function setRule();

    public function run(){
        $this->setRule();

        $node = $this->builder->getNode();
        $visitor = new Visitor($this);
        $node->accept($visitor);
        return $visitor->result;
    }

    // 制定你的迷宫单元 ...
}