<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;
use CZJ\MsgPack\Pack\ValuePack;

class ArrayPack extends BasePack
{
    use ValuePack;

    public function pack(array $arr) 
    {
        if (empty($arr)) return $this->arrayHead($arr);

        if ($this->isMap($arr)) {
            $msgPack = $this->mapHead($arr);
            foreach ($arr as $key => $value) {
                $msgPack .= $this->valuePack($key);
                if (is_array($value)) {
                    $msgPack .= $this->pack($value);
                } else {
                    $msgPack .= $this->valuePack($value);
                }
            }
        } else {
            $msgPack = $this->arrayHead($arr);
            foreach ($arr as $value) {
                if (is_array($value)) {
                    $msgPack .= $this->pack($value);
                } else {
                    $msgPack .= $this->valuePack($value);
                }
            }
        }
        
        return $msgPack;
    }

    public function isMap(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

    private function arrayHead(array $arr)
    {
        $length = count($arr);

        if ($length < 16) {
            $hex = dechex($this::$array + $length);
        } elseif ($length < 65536) {
            $hex = dechex($this::$array16) . $this->leftAddZero($length, 4);
        } elseif ($length < pow(2, 32)) {
            $hex = dechex($this::$array32) . $this->leftAddZero($length, 8);
        }

        return hex2bin($hex);
    }

    private function mapHead(array $arr)
    {
        $length = count($arr);

        if ($length < 16) {
            $hex = dechex($this::$map + $length);
        } elseif ($length < 65536) {
            $hex = dechex($this::$map16) . $this->leftAddZero($length, 4);
        } elseif ($length < pow(2, 32)) {
            $hex = dechex($this::$map32) . $this->leftAddZero($length, 8);
        }

        return hex2bin($hex);
    }
}