<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BoolNullPack;
use CZJ\MsgPack\Pack\IntPack;
use CZJ\MsgPack\Pack\StrPack;

trait ValuePack
{
    public function valuePack($data) 
    {
        if (is_bool($data) || is_null($data)) {
            return BoolNullPack::pack($data);
        }
        if (is_int($data)) {
            return IntPack::pack($data);
        }
        if (is_string($data)) {
            return StrPack::pack($data);
        }
    }
}