<?php
namespace CZJ\MsgPack\Pack;

use CZJ\MsgPack\Pack\BasePack;
/**
 * 轉換布林空值(null)的方法
 */
class BoolNullPack extends BasePack
{
    /**
     * 布林跟空值(null)都有固定的表示方法
     * 直接轉換回傳就好
     */
    public static function pack($data) 
    {
        if (is_null($data)) {
            return chr(parent::$null);
        }
        if (is_bool($data)) {
            return $data ? chr(parent::$true) : chr(parent::$false);
        }
    }
}