<?php
namespace CZJ\MsgPack\Pack;

class Spec
{
    public static $int = 0x00;
    public static $int8 = 0xcc;
    public static $int16 = 0xcd;
    public static $int32 = 0xce;
    public static $int64 = 0xcf;
    public static $str = 0xa0;
    public static $str8 = 0xd9;
    public static $str16 = 0xda;
    public static $str32 = 0xdb;
    public static $map = 0x80;
    public static $array = 0x90;
    public static $null = 0xc0;
    public static $false = 0xc2;
    public static $true = 0xc3;
}