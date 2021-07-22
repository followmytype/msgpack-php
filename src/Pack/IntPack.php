<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;

class IntPack extends BasePack
{
    public function pack(int $int) 
    {
        if ($int < 128) {
            $hex = $this->leftAddZero($int, 2);
        } elseif ($int < 256) {
            $hex = $this->leftAddZero($int, 2);
            $hex = dechex($this::$int8) . $hex;
        } elseif ($int < 65536) {
            $hex = $this->leftAddZero($int, 4);
            $hex = dechex($this::$int16) . $hex;
        } elseif ($int < 4294967296) {
            $hex = $this->leftAddZero($int, 8);
            $hex = dechex($this::$int32) . $hex;
        } elseif ($int < pow(2, 64)) {
            $hex = $this->leftAddZero($int, 16);
            $hex = dechex($this::$int64) . $hex;
        }

        return hex2bin($hex);
    }
}