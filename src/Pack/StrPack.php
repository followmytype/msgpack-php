<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;

class StrPack extends BasePack
{
    public function pack(string $str) 
    {
        $strLen = strlen($str);

        if ($strLen < 32) {
            $hex = dechex($this::$str + $strLen);
        } elseif ($strLen < 256) {
            $hex = dechex($this::$str8) . $this->leftAddZero($strLen, 2);
        } elseif ($strLen < 65536) {
            $hex = dechex($this::$str16) . $this->leftAddZero($strLen, 4);
        } elseif ($strLen < 4294967296) {
            $hex = dechex($this::$str32) . $this->leftAddZero($strLen, 8);
        }

        return hex2bin($hex) . $str;
    }
}