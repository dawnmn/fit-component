<?php
/**
 * @author      dawn
 * @since       2018/12/25 9:37
 */


namespace fit\api;

interface Resource
{
    function item();
    function items();
    function add();
    function del();
    function upd();
}