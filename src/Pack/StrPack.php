<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;
/**
 * 轉換字串的方法
 */
class StrPack extends BasePack
{
    /**
     * 當字串轉換時，先取得他的字串長度當他的頭，將字串長度轉乘十六進位的表示方法(補零後的結果)
     * 而當字串長度位在某個區間時就要加上額外註記的"頭"，例如長度超過256(8-bit)，頭就要再加上0xd9
     * 頭宣告在父類別，雖然是用十六進位去宣告的，但還是要把它轉成十六進位的字串，後續才好處理
     * 最後回傳十六進制轉乘二進制的結果
     */
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