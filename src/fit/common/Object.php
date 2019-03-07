<?php
/**
 * @author      dawn
 * @since       2018/12/11 17:13
 */

namespace fit\common;


class Object
{
    public function __get($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter();
        }else{
            return null;
        }
    }

    public function __set($name, $value)
    {
        $setter = 'set'.$name;
        if(method_exists($this, $setter)){
            $this->$setter($value);
        }
    }

    public function __isset($name)
    {
        $getter = 'get' . $name;
        if (method_exists($this, $getter)) {
            return $this->$getter() !== null;
        }else{
            return false;
        }
    }

    public function __unset($name)
    {
        $setter = 'set' . $name;
        if (method_exists($this, $setter)) {
            $this->$setter(null);
        }
    }
}