<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;

class BoolNullPack extends BasePack
{
    public static function pack($data) 
    {
        if (is_null($data)) {
            return chr(parent::$null);
        }
        if (is_bool($data)) {
            return $data ? chr(parent::$true) : chr(parent::$false);
        }
    }
}