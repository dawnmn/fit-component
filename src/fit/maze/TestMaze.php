<?php
/**
 * @copyright   时刻共享
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
    public function setRule()
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
        $this->step[] = 'a';
        return true;
    }
    public function b(){
        $this->step[] = 'b';
        return false;
    }
    public function c(){
        $this->step[] = 'c';
        return true;
    }
    public function d(){
        $this->step[] = 'd';
        return true;
    }
    public function e(){
        $this->step[] = 'e';
        return false;
    }
    public function f(){
        $this->step[] = 'f';
        return false;
    }
    public function g(){
        $this->step[] = 'g';
        return false;
    }
    public function h(){
        $this->step[] = 'h';
        return false;
    }
}