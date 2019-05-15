<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/5/15 16:43
 */

require 'Excel.php';

$excel = new \fit\excel\Excel();
$excel->downloadTable('订单信息', [
    ['no','订单号','30', '@'],
    ['goods_name','商品名称','30'],
],
    [
        ['no'=>123123123,'goods_name'=>'asdfasdf'],
        ['no'=>123123123,'goods_name'=>'asdfasdf'],
        ['no'=>123123123,'goods_name'=>'asdfasdf'],
    ]
);