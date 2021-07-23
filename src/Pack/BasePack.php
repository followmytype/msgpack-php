<?php
namespace CZJ\MsgPack\Pack;
/**
 * 基底，放上轉換規則
 */
class BasePack
{
    public static $null = 0xc0;
    public static $false = 0xc2;
    public static $true = 0xc3;
    public static $int = 0x00;
    public static $int8 = 0xcc;
    public static $int16 = 0xcd;
    public static $int32 = 0xce;
    public static $int64 = 0xcf;
    public static $str = 0xa0;
    public static $str8 = 0xd9;
    public static $str16 = 0xda;
    public static $str32 = 0xdb;
    public static $array = 0x90;
    public static $array16 = 0xdc;
    public static $array32 = 0xdd;
    public static $map = 0x80;
    public static $map16 = 0xde;
    public static $map32 = 0xdf;

    /**
     * 通用的function，因為他轉換資料的規則是"資料型態+後面資料的長度+資料內容"
     * 而顯示"資料的長度"這邊顯示固定的位數，所以當"資料的長度"不夠時要補上零
     * 例如現在要顯示的位數為四個：0000，而我的資料長度為10，這邊就要顯示0010
     * 第一個參數是資料長度，第二個參數是位數
     * %x是將後面的數字用十六進位顯示出來
     * %08x是顯示八位數，不足的前方補零
     */
    protected static function leftAddZero(int $int, int $num)
    {
        return sprintf("%0" . $num . "x", $int);
    }
}