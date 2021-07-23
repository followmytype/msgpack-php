<?php
namespace CZJ\MsgPack\Pack;

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

    protected static function leftAddZero(int $int, int $num)
    {
        return sprintf("%0" . $num . "x", $int);
    }
}