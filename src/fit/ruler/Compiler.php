<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/5/5 9:51
 */


namespace fit\ruler;


interface Compiler
{
    function compile($target, ...$args);
}