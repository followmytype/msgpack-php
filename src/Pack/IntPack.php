<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;
/**
 * 轉換單一整數的方法
 */
class IntPack extends BasePack
{
    /**
     * 當整數轉換時，取得他在十六進位的表示方法(補零後的結果)
     * 而當整數位在某個區間時就要加上他的"頭"
     * 頭宣告在父類別，雖然是用十六進位去宣告的，但還是要把它轉成十六進位的字串，後續才好處理
     * 最後回傳十六進制轉乘二進制的結果
     */
    public static function pack(int $int) 
    {
        if ($int >= 0) {
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
        } else {
            if ($int >= -32) {
                // $int = parent::$negInt + $int + 1;
                // $hex = parent::leftAddZero($int, 2, false);
                $hex = substr(dechex($int), -2);
            } elseif ($int >= -128) {
                // $int = parent::$negInt + $int + 1;
                // $hex = dechex(parent::$sInt8) . parent::leftAddZero($int, 2, false);
                $hex = dechex(parent::$sInt8) . substr(dechex($int), -2);
            } elseif ($int >= -32768) {
                // $hex = parent::leftAddZero(parent::$negInt, 4, false);
                // $hex = dechex(parent::$sInt16) . dechex(hexdec($hex) + $int + 1);
                $hex = dechex(parent::$sInt16) . substr(dechex($int), -4);
            } elseif ($int >= -2147483648) {
                // $hex = parent::leftAddZero(parent::$negInt, 8, false);
                // $hex = dechex(parent::$sInt32) . dechex(hexdec($hex) + $int + 1);
                $hex = dechex(parent::$sInt32) . substr(dechex($int), -8);
            } elseif ($int >= -1 * pow(2, 63)) {
                $hex = dechex(parent::$sInt64) . dechex($int);
            }
        }

        return hex2bin($hex);
    }
}