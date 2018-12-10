<?php

namespace fit\maze;


class Visitor
{
    public $maze;
    public $result;

    public function __construct(Maze $maze)
    {
        $this->maze = $maze;
        $this->result = false;
    }

    public function visit(Node $node)
    {
        foreach ($node->getChildren() as $child) {
            if($this->result){
                break;
            }else{
                $child->accept($this);
            }
        }
    }
}
