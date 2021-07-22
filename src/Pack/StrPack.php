<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\Spec;

class StrPack
{
    public function pack(string $str) 
    {
        $strLen = strlen($str);

        if ($strLen < 32) {
            $hex = dechex(Spec::$str + $strLen);
        } elseif ($strLen < 256) {
            $hex = dechex(Spec::$str8) . $this->leftAddZero($strLen, 2);
        } elseif ($strLen < 65536) {
            $hex = dechex(Spec::$str16) . $this->leftAddZero($strLen, 4);
        } elseif ($strLen < 4294967296) {
            $hex = dechex(Spec::$str32) . $this->leftAddZero($strLen, 8);
        }

        return hex2bin($hex) . $str;
    }

    private function leftAddZero(int $int, int $num)
    {
        return sprintf("%0" . $num . "x", $int);
    }
}