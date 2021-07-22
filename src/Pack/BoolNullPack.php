<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;

class BoolNullPack extends BasePack
{
    public function pack($data) 
    {
        if (is_null($data)) {
            return chr($this::$null);
        }
        if (is_bool($data)) {
            return $data ? chr($this::$true) : chr($this::$false);
        }
    }
}