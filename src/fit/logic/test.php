<?php
/**
 * @copyright   时刻共享
 * @author      dawn
 * @since       2019/4/30 15:00
 */

namespace fit\logic;

require '../../../vendor/autoload.php';
require 'ruler/IdRuler.php';
require 'ec/RulerEC.php';
require 'ec/RulerNum.php';
require '../common/Config.php';

use fit\logic\ec\RulerNum;
use fit\logic\ruler\IdRuler;

class CardExpire extends RulerNum{
    public function getNum()
    {
        return [21, 234, 25, 204, 2342];
    }
}

class PerUser extends RulerNum{
    public function getNum()
    {
        return [1,2,3,4,5];
    }
}

class HasFit extends RulerNum{
    public function getNum()
    {
        return [1,2,3,5,6,7,21];
    }
}

$exp = 'CardExpire,1545782400,1552176000 & (PerUser & HasFit)?';

$idRuler = new IdRuler();
var_dump($idRuler->execute($exp,'fit\\logic\\'));
