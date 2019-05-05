<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/5/5 10:32
 */

namespace fit\ruler\id;

require '../../logic/ec/ExpressionCalculate.php';
require '../Compiler.php';
require '../Executor.php';
require '../Ruler.php';
require 'IdCompiler.php';
require 'IdRulerNum.php';
require 'IdRuler.php';

use fit\ruler\Executor;

class CardExpire implements IdRulerNum {
    public function getNum()
    {
        return [21, 234, 25, 204, 2342];
    }
}

class PerUser implements IdRulerNum{
    public function getNum()
    {
        return [1,2,3,4,5];
    }
}

class HasFit implements IdRulerNum{
    public function getNum()
    {
        return [1,2,3,5,6,7,21];
    }
}

$exp = '(CardExpire,1545782400,1552176000 | PerUser) & HasFit';

class PrintExecutor implements Executor{
    function run($target, ...$args): bool
    {
        var_dump($target);
        return true;
    }
}

$ruler = new IdRuler(new IdCompiler(), new PrintExecutor());
// 第二个参数为解析器里面运算数类命名空间
if($ruler->apply($exp, 'fit\\ruler\\id\\')){
    echo ' | success';
}else{
    echo ' | error';
}