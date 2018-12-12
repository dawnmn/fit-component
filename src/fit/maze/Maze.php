<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/10 16:54
 */


namespace fit\maze;


abstract class Maze
{
    // 存储轨迹
    public $step = [];

    protected $builder;

    public function __construct()
    {
        $this->builder = new NodeBuilder();
    }

    public function run(){
        $this->setRule();

        $node = $this->builder->getNode();
        $visitor = new Visitor($this);
        $node->accept($visitor);
        return $visitor->result;
    }

    // 制定你的迷宫单元 ...
    protected abstract function setRule();
}