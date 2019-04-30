<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/4/30 14:08
 */


namespace fit\logic\ec;


class RulerEC extends ExpressionCalculate
{
    const PATTERN = '/((?:[\w,]+)|(?:[\(\)\&\|])){1}/';
    const OP_PRIORITY = [
        '('=>0,
        ')'=>0,
        '&'=>1,
        '|'=>1
    ];

    public $specificationClassPath = '';
    public $queryBuilder = null;

    protected function operator($numLeft, $numRight, string $op){
        if(is_string($numLeft)){
            $numLeft = $this->parseNum($numLeft);
        }
        if(is_string($numRight)){
            $numRight = $this->parseNum($numRight);
        }

        switch ($op){
            case '&':
                return array_intersect($numLeft, $numRight);
            case '|':
                return array_merge($numLeft, $numRight);
        }
    }

    protected function getParam($num){
        $param = explode(',', $num);
        foreach ($param as &$item){
            $item = trim($item);
        }
        return $param;
    }

    protected function parseNum($num){
        $param = $this->getParam($num);
        $className = $this->specificationClassPath.$param[0];
        array_shift($param);
        return (new $className($param))->getNum();
    }

    public function init(string $specificationClassPath){
        $this->specificationClassPath = $specificationClassPath;
    }

    protected function validate($input){
        if(preg_match_all('/[^\w,\(\)\&\|\s]+/', $input)){
            return false;
        }else{
            return true;
        }
    }
}