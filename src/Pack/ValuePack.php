<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BoolNullPack;
use CZJ\MsgPack\Pack\IntPack;
use CZJ\MsgPack\Pack\StrPack;
/**
 * 這是一個trait，轉換單一數值的方法
 */
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