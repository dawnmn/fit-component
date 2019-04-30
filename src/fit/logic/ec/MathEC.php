<?php
/**
 * @author      dawn
 * @since       2019/4/30 14:07
 */


namespace fit\logic\ec;

// 示例
class MathEC extends ExpressionCalculate
{
    const PATTERN = '/((?:[\w,]+)|(?:[\(\)\+\-\*\/])){1}/';
    const OP_PRIORITY = [
        '('=>0,
        ')'=>0,
        '+'=>1,
        '-'=>1,
        '*'=>2,
        '/'=>2,
    ];

    protected function operator($numLeft, $numRight, string $op){
        $numLeft = (int)$numLeft;
        $numRight = (int)$numRight;
        switch ($op){
            case '+':
                return $numLeft+$numRight;
            case '-':
                return $numLeft-$numRight;
            case '*':
                return $numLeft*$numRight;
            case '/':
                return $numLeft/$numRight;
        }
    }

    protected function validate($input){
        if(preg_match_all('/[^\d\(\)\+\-\*\/\s]+/', $input)){
            return false;
        }else{
            return true;
        }
    }
}