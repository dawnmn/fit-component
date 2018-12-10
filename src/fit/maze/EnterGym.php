<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/10 17:07
 */


namespace fit\maze;


class EnterGym extends Maze
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
        $this->wrong[] = 'a';
        return false;
    }
    public function b(){
        $this->wrong[] = 'b';
        return false;
    }
    public function c(){
        $this->wrong[] = 'c';
        return false;
    }
    public function d(){
        $this->wrong[] = 'd';
        return false;
    }
    public function e(){
        $this->wrong[] = 'e';
        return false;
    }
    public function f(){
        $this->wrong[] = 'f';
        return false;
    }
    public function g(){
        $this->wrong[] = 'g';
        return false;
    }
    public function h(){
        $this->wrong[] = 'h';
        return false;
    }
}