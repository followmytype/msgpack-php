<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\Spec;

class IntPack
{
    public function pack(int $int) 
    {
        if ($int < 128) {
            $hex = $this->addZero($int, 2);
        } elseif ($int < 256) {
            $hex = $this->addZero($int, 2);
            $hex = dechex(Spec::$int8) . $hex;
        } elseif ($int < 65536) {
            $hex = $this->addZero($int, 4);
            $hex = dechex(Spec::$int16) . $hex;
        } elseif ($int < 4294967296) {
            $hex = $this->addZero($int, 8);
            $hex = dechex(Spec::$int32) . $hex;
        } elseif ($int < pow(2, 64)) {
            $hex = $this->addZero($int, 16);
            $hex = dechex(Spec::$int64) . $hex;
        }

        return hex2bin($hex);
    }

    private function addZero(int $int, int $num)
    {
        return sprintf("%0" . $num . "x", $int);
    }
}