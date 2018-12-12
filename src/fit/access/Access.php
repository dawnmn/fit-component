<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2018/12/11 16:32
 */

namespace fit\access;

interface Access
{
    function login(array $data);

    function registersmscode(array $data);

    function register(array $data);

    function init(array $data);

    function auth(array $data);
}