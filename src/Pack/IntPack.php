<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;

class IntPack extends BasePack
{
    public static function pack(int $int) 
    {
        if ($int < 128) {
            $hex = parent::leftAddZero($int, 2);
        } elseif ($int < 256) {
            $hex = parent::leftAddZero($int, 2);
            $hex = dechex(parent::$int8) . $hex;
        } elseif ($int < 65536) {
            $hex = parent::leftAddZero($int, 4);
            $hex = dechex(parent::$int16) . $hex;
        } elseif ($int < 4294967296) {
            $hex = parent::leftAddZero($int, 8);
            $hex = dechex(parent::$int32) . $hex;
        } elseif ($int < pow(2, 64)) {
            $hex = parent::leftAddZero($int, 16);
            $hex = dechex(parent::$int64) . $hex;
        }

        return hex2bin($hex);
    }
}