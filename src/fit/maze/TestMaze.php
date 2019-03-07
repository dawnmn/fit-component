<?php
/**
 * @author      dawn
 * @since       2018/12/10 17:07
 */

namespace fit\maze;

/**
 * Class TestMaze
 * @package fit\maze
 */
class TestMaze extends Maze
{
    protected function setRule()
    {
        $this->builder->value('a')
            ->leaf('b')
            ->tree('c')
                ->tree('d')
                    ->leaf('g')
                    ->leaf('h')
                    ->end()
                ->leaf('e')
                ->leaf('f')
                ->end();
    }

    public function root(){
        return true;
    }

    public function a(){
        return true;
    }
    public function b(){
        return false;
    }
    public function c(){
        return true;
    }
    public function d(){
        return true;
    }
    public function e(){
        return false;
    }
    public function f(){
        return false;
    }
    public function g(){
        return false;
    }
    public function h(){
        return false;
    }
}