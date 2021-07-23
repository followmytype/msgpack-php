<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;

class StrPack extends BasePack
{
    public static function pack(string $str) 
    {
        $strLen = strlen($str);

        if ($strLen < 32) {
            $hex = dechex(parent::$str + $strLen);
        } elseif ($strLen < 256) {
            $hex = dechex(parent::$str8) . parent::leftAddZero($strLen, 2);
        } elseif ($strLen < 65536) {
            $hex = dechex(parent::$str16) . parent::leftAddZero($strLen, 4);
        } elseif ($strLen < 4294967296) {
            $hex = dechex(parent::$str32) . parent::leftAddZero($strLen, 8);
        }

        return hex2bin($hex) . $str;
    }
}