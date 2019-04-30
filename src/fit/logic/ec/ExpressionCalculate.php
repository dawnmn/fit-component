<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/4/30 9:59
 */


namespace fit\logic\ec;


abstract class ExpressionCalculate
{
    // 伪正则，子类必须覆盖
    const PATTERN = '/((?:[你的运算数]+)|(?:[你的运算符])){1}/';
    // 运算符优先级，子类必须覆盖
    const OP_PRIORITY = [
        '('=>0, // 括号优先级最低
        ')'=>0,
    ];

    public function explode(string $infixExp){
        preg_match_all(static::PATTERN, $infixExp, $match);
        return $match[1];
    }

    public function infix2suffix(string $input){
        $input = $this->explode($input);

        $opStack = [];
        $output = [];

        $opPriority = static::OP_PRIORITY;
        foreach ($input as $token){
            if(isset($opPriority[$token])){
                if($token == '('){
                    array_push($opStack, $token);
                }elseif ($token == ')'){
                    while (($opTemp = array_pop($opStack)) != '('){
                        array_push($output, $opTemp);
                    }
                }else {
                    while ($opStack && $opPriority[$opStack[count($opStack) - 1]] >= $opPriority[$token]) {
                        array_push($output, array_pop($opStack));
                    }
                    array_push($opStack, $token);
                }
            }else{
                array_push($output, $token);
            }
        }

        while ($opTemp = array_pop($opStack)){
            array_push($output, $opTemp);
        }

        return $output;
    }

    public function calculate(string $input){
        if(!$this->validate($input)){
            return false;
        }

        $input = $this->infix2suffix($input);
        $numStack = [];

        $opPriority = static::OP_PRIORITY;
        foreach ($input as $token){
            if(isset($opPriority[$token])){
                $numRight = array_pop($numStack);
                $numLeft = array_pop($numStack);
                array_push($numStack,$this->operator($numLeft, $numRight, $token));
            }else{
                array_push($numStack, $token);
            }
        }
        return array_pop($numStack);
    }

    abstract protected function operator($numLeft, $numRight, string $op);

    abstract protected function validate($input);
}